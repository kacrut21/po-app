<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $now = Carbon::now();

        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth   = $now->copy()->endOfMonth();
        $prevStart    = $now->copy()->subMonth()->startOfMonth();
        $prevEnd      = $now->copy()->subMonth()->endOfMonth();

        // This month orders
        $thisMonthOrders = Order::where('user_id', $userId)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->get();

        // Previous month for growth calculation
        $prevMonthOmzet = Order::where('user_id', $userId)
            ->whereBetween('created_at', [$prevStart, $prevEnd])
            ->sum('total_amount');

        $omzetBulanIni = $thisMonthOrders->sum('total_amount');
        $omzetGrowth = $prevMonthOmzet > 0
            ? round((($omzetBulanIni - $prevMonthOmzet) / $prevMonthOmzet) * 100, 1)
            : 0;

        // Active orders (not selesai)
        $activeOrders = Order::where('user_id', $userId)
            ->whereNotIn('order_status', ['selesai'])
            ->count();

        // Completed this month
        $selesaiBulanIni = $thisMonthOrders->where('order_status', 'selesai')->count();

        // Orders due in 2 days
        $upcoming = Order::where('user_id', $userId)
            ->whereNotIn('order_status', ['selesai'])
            ->whereBetween('delivery_date', [$now, $now->copy()->addDays(2)])
            ->count();

        // Avg margin from menus
        $avgMargin = Menu::where('user_id', $userId)
            ->whereNotNull('margin')
            ->avg('margin') ?? 0;

        // Latest 3 active orders for quick view
        $recentOrders = Order::where('user_id', $userId)
            ->whereNotIn('order_status', ['selesai'])
            ->with('items.menu')
            ->latest('delivery_date')
            ->limit(3)
            ->get();

        return view('pages.dashboard', compact(
            'omzetBulanIni', 'omzetGrowth',
            'activeOrders', 'selesaiBulanIni',
            'upcoming', 'avgMargin',
            'recentOrders'
        ));
    }
}
