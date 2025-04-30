<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class Rendezvous extends Model
{
    protected $table = 'rendez_vous';
    public $timestamps = false;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'rendezvous',
        'status',
        'type',
    ];

    protected $casts = [
        'rendezvous' => 'datetime',
    ];

    /**
     * Scope query to a given doctor
     */
    public function scopeForDoctor($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }

    /**
     * Last 6 months of appointment counts (total vs confirmed) for a doctor.
     */
    public static function getMonthlyChartData($doctorId = null)
    {
        $doctorId = $doctorId ?: Auth::id();

        return self::forDoctor($doctorId)
            ->where('rendezvous', '>=', Carbon::now()->subMonths(6))
            ->selectRaw("DATE_FORMAT(MIN(rendezvous), '%b') AS month")
            ->selectRaw('COUNT(*) AS total')
            ->selectRaw("COALESCE(SUM(CASE WHEN status = 'Confirmé' THEN 1 ELSE 0 END),0) AS confirmed")
            ->groupByRaw('YEAR(rendezvous), MONTH(rendezvous)')
            ->orderByRaw('YEAR(rendezvous), MONTH(rendezvous)')
            ->get();
    }

    /**
     * Totals by status for the pie chart for a doctor.
     */
    public static function getStatusSummary($doctorId = null)
    {
        $doctorId = $doctorId ?: Auth::id();
    
        return self::forDoctor($doctorId)
            ->selectRaw(
                "COALESCE(SUM(CASE WHEN status = 'Confirmé' THEN 1 ELSE 0 END), 0) AS confirmed," .
                " COALESCE(SUM(CASE WHEN status = 'En Attente' THEN 1 ELSE 0 END), 0) AS pending," .
                " COALESCE(SUM(CASE WHEN status = 'Annulé' THEN 1 ELSE 0 END), 0) AS cancelled"
            )
            ->first();
    }
    

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}

