<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;

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
}
