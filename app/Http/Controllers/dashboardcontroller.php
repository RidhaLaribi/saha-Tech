<?php
namespace App\Http\Controllers;

use App\Models\Requestm; 
use Illuminate\Http\Request;

class dashboardcontroller extends Controller
{
    public function index()
    {
        $monthlyData = Requestm::getMonthlyChartData();
        $months = $monthlyData->pluck('month');
        $totalRequests = $monthlyData->pluck('total_requests');
        $processedRequests = $monthlyData->pluck('processed_requests');

        $pieData = Requestm::getStatusSummary();

        return view('doctors', compact(
            'months',
            'totalRequests',
            'processedRequests',
            'pieData'
        ));
    }
}
