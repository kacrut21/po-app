<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index(Request $request)
    {
        $period = $request->query('period', 'this_month');
        $summary = $this->reportService->getSummary($period);
        return view('pages.laporan', compact('summary', 'period'));
    }

    public function exportExcel(Request $request)
    {
        $period = $request->query('period', 'this_month');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        
        if (!$startDate || !$endDate) {
            [$start, $end] = $this->reportService->getDateRange($period);
            $startDate = $start->toDateString();
            $endDate = $end->toDateString();
        }
        
        $filename = 'Laporan_Pesanan_' . $period;
        if ($request->query('start_date')) {
            $filename = 'Laporan_Pesanan_' . $startDate . '_to_' . $endDate;
        }
        $filename .= '.xlsx';

        return Excel::download(new OrdersExport($startDate, $endDate), $filename);
    }
}
