<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Requestm extends Model
{
    protected $table = 'requests'; 
    

    protected $fillable = [
        'status',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
    public static function getMonthlyChartData()
    {
        return self::selectRaw("DATE_FORMAT(created_at, '%b') AS month")
            ->selectRaw("COUNT(*) AS total_requests")
            ->selectRaw("SUM(CASE WHEN status = 'Prête à être retirée' THEN 1 ELSE 0 END) AS processed_requests")
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupByRaw("DATE_FORMAT(created_at, '%m-%Y')")
            ->orderBy('created_at')
            ->limit(6)
            ->get();
    }

    public static function getStatusSummary()
    {
        return self::selectRaw("
            SUM(CASE WHEN status = 'Prête à être retirée' THEN 1 ELSE 0 END) AS processed,
            SUM(CASE WHEN status = 'In Progress' THEN 1 ELSE 0 END) AS pending,
            SUM(CASE WHEN status = 'Rejected' THEN 1 ELSE 0 END) AS rejected
        ")->first();
    }
}
