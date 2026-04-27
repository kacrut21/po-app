<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Auth;

class OrdersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = Order::where('user_id', Auth::id())
            ->with(['items.menu', 'items.addons.menuAddon']);

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('delivery_date', [$this->startDate . ' 00:00:00', $this->endDate . ' 23:59:59']);
        }

        return $query->orderBy('delivery_date', 'asc')->get();
    }

    public function headings(): array
    {
        return [
            'TANGGAL KIRIM',
            'NO',
            'NOMOR PO',
            'NAMA CUSTOMER',
            'JENIS ACARA',
            'PESANAN (DETAIL)',
            'TOTAL HARGA',
            'DP (DIBAYAR)',
            'SISA BAYAR',
            'METODE',
            'STATUS BAYAR',
            'STATUS ORDER',
            'CATATAN'
        ];
    }

    public function map($order): array
    {
        static $no = 0;
        $no++;

        $itemsDetail = $order->items->map(function ($item) {
            $text = $item->menu ? $item->menu->name : 'Menu Terhapus';
            $text .= " ({$item->quantity} porsi)";
            
            if ($item->addons->count() > 0) {
                $addonsText = $item->addons->map(function ($a) {
                    return "+" . ($a->menuAddon ? $a->menuAddon->name : 'Addon');
                })->implode(', ');
                $text .= " [Addons: {$addonsText}]";
            }
            
            return $text;
        })->implode("\n");

        return [
            date('d/m/Y H:i', strtotime($order->delivery_date)),
            $no,
            $order->order_number,
            $order->customer_name,
            $order->event_type ?? '-',
            $itemsDetail,
            $order->total_amount,
            $order->down_payment,
            $order->total_amount - $order->down_payment,
            $order->payment_method,
            $order->payment_status,
            ucfirst($order->order_status),
            $order->notes ?? '-'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '6C3DE3']
                ]
            ],
            'F' => ['alignment' => ['wrapText' => true]],
        ];
    }
}
