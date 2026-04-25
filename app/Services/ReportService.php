<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ReportService
{
    public function getSummary($period = 'this_month')
    {
        $userId = Auth::id();

        [$startDate, $endDate] = $this->getDateRange($period);

        // Orders in period (completed ones count as revenue)
        $orders = Order::where('user_id', $userId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $totalOmzet = $orders->sum('total_amount');
        $totalOrders = $orders->count();
        $selesai = $orders->where('order_status', 'selesai')->count();
        $pending = $orders->whereNotIn('order_status', ['selesai'])->count();

        // Calculate real revenue from completed orders only
        $omzetSelesai = $orders->where('order_status', 'selesai')->sum('total_amount');

        // For margin: use avg margin from menu items in orders
        $menuIds = OrderItem::whereIn('order_id', $orders->pluck('id'))->pluck('menu_id')->unique();
        $avgMargin = Menu::where('user_id', $userId)
            ->whereIn('id', $menuIds)
            ->whereNotNull('margin')
            ->avg('margin') ?? 0;

        // Best selling menus
        $topMenus = OrderItem::whereIn('order_id', $orders->pluck('id'))
            ->selectRaw('menu_id, SUM(quantity) as total_qty, SUM(subtotal) as total_revenue')
            ->groupBy('menu_id')
            ->with('menu')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get()
            ->filter(fn($item) => $item->menu)
            ->values();

        // Previous period for comparison
        [$prevStart, $prevEnd] = $this->getPreviousRange($period, $startDate, $endDate);
        $prevOrders = Order::where('user_id', $userId)
            ->whereBetween('created_at', [$prevStart, $prevEnd])
            ->get();
        $prevOmzet = $prevOrders->sum('total_amount');

        $omzetGrowth = $prevOmzet > 0
            ? round((($totalOmzet - $prevOmzet) / $prevOmzet) * 100, 1)
            : 0;

        return [
            'omzet' => $totalOmzet,
            'omzet_growth' => $omzetGrowth,
            'total_orders' => $totalOrders,
            'selesai' => $selesai,
            'pending' => $pending,
            'avg_margin' => round($avgMargin, 1),
            'top_menus' => $topMenus,
            'period_label' => $this->getPeriodLabel($period),
        ];
    }

    private function getDateRange($period)
    {
        return match ($period) {
            'last_month' => [
                Carbon::now()->subMonth()->startOfMonth(),
                Carbon::now()->subMonth()->endOfMonth(),
            ],
            '3_months' => [
                Carbon::now()->subMonths(3)->startOfMonth(),
                Carbon::now()->endOfMonth(),
            ],
            default => [ // this_month
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth(),
            ],
        };
    }

    private function getPreviousRange($period, $startDate, $endDate)
    {
        $diff = $startDate->diffInDays($endDate) + 1;
        return [
            $startDate->copy()->subDays($diff),
            $startDate->copy()->subDay(),
        ];
    }

    private function getPeriodLabel($period)
    {
        return match ($period) {
            'last_month' => 'Bulan Lalu',
            '3_months' => '3 Bulan',
            default => 'Bulan Ini',
        };
    }
}
