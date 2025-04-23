<?php

namespace App\Http\Controllers;

use App\Models\Rendezvous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     // $this->middleware('role:doctor');
    // }

    public function dashboard()
    {
        // 1) pie chart summary
        $pieData = Rendezvous::getStatusSummary();

        $processedRequests = $pieData->confirmed;
        $pendingRequests   = $pieData->pending;
        $rejectedRequests  = $pieData->cancelled;
        $totalRequests     = $processedRequests + $pendingRequests + $rejectedRequests;

        // 2) six-month line chart data
        $chartData = Rendezvous::getMonthlyChartData();
        $months    = $chartData->pluck('month');
        $totals    = $chartData->pluck('total');
        $confirmed = $chartData->pluck('confirmed');

        return view('doctors', compact(
            'months',
            'totals',
            'confirmed',
            'totalRequests',
            'pendingRequests',
            'processedRequests',
            'rejectedRequests',
            'pieData'
        ));
    }
}
