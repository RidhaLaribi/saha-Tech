<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Rendezvous;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Card totals
        $totalPatients = Patient::count();
        $totalDoctors = Doctor::count();
        $totalRequests = Rendezvous::count();

        // Pie chart: appointment status summary
        $pieData = Rendezvous::query()
            ->selectRaw("COALESCE(SUM(CASE WHEN status = 'Confirmé' THEN 1 ELSE 0 END),0)   AS confirmed")
            ->selectRaw("COALESCE(SUM(CASE WHEN status = 'En Attente' THEN 1 ELSE 0 END),0) AS pending")
            ->selectRaw("COALESCE(SUM(CASE WHEN status = 'Annulé'    THEN 1 ELSE 0 END),0) AS cancelled")
            ->first();

        // Six-month labels (from 5 months ago → this month)
        $start = Carbon::now()->subMonths(5)->startOfMonth();
        $months = collect();
        for ($i = 0; $i < 6; $i++) {
            $months->push($start->copy()->addMonths($i)->format('M'));
        }

        // Helper to get counts per month
        $agg = function ($modelClass, $dateCol) use ($start) {
            return $modelClass::query()
                ->where($dateCol, '>=', $start)
                ->selectRaw("DATE_FORMAT(MIN($dateCol),'%b') AS month")
                ->selectRaw("COUNT(*) AS cnt")
                ->groupByRaw("YEAR($dateCol), MONTH($dateCol)")
                ->orderByRaw("YEAR($dateCol), MONTH($dateCol)")
                ->get()
                ->keyBy('month')
                ->map->cnt;
        };

        // Monthly series
        $apptData = $agg(Rendezvous::class, 'rendezvous');
        $patientData = $agg(Patient::class, 'created_at');
        $doctorData = $agg(Doctor::class, 'created_at'); // ← NEW

        // Pad appointment, patient & doctor arrays to exactly six entries
        $apptTotals = [];
        $patientTotals = [];
        $doctorTotals = [];
        foreach ($months as $m) {
            $apptTotals[] = $apptData->get($m, 0);
            $patientTotals[] = $patientData->get($m, 0);
            $doctorTotals[] = $doctorData->get($m, 0);     // ← NEW
        }

        return view('admin', [
            'totalPatients' => $totalPatients,
            'totalDoctors' => $totalDoctors,
            'totalRequests' => $totalRequests,
            'pieData' => $pieData,
            'pendingRequests' => $pieData->pending,
            'processedRequests' => $pieData->confirmed,
            'rejectedRequests' => $pieData->cancelled,
            'months' => $months,
            'apptTotals' => $apptTotals,
            'patientTotals' => $patientTotals,
            'doctorTotals' => $doctorTotals,        // ← NEW
        ]);
    }

    public function validateDocShow(Request $request)
    {
        $query = Doctor::with('user') // eager-load user info if needed
            ->where('available', 0);  // only show non-validated doctors

        // Search filter: match type or specialty
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(specialty) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhere('type', 'like', '%' . $search . '%');
            });
        }

        // Optional filter: exact type
        if ($type = $request->query('type')) {
            $query->where('type', $type);
        }

        // Optional filter: exact specialty
        if ($specialty = $request->query('specialty')) {
            $query->where('specialty', $specialty);
        }

        $doctors = $query->orderBy('created_at', 'desc')
            ->paginate(15)
            ->appends($request->query());


        return view('/adminrequest', [  // adjust view name if needed
            'doctors' => $doctors,
            'search' => $search,
            'type' => $type,
            'specialty' => $specialty,
        ]);
    }
    public function validateDoctor($doctorId)
    {
        // Retrieve the doctor by ID
        $doctor = Doctor::findOrFail($doctorId);

        // Update the doctor to mark as validated (available = 1)
        $doctor->available = 1;
        $doctor->save();

        // Redirect back with a success message
        return redirect()->route('rendad')->with('success', 'Doctor validated successfully.');
    }



}

