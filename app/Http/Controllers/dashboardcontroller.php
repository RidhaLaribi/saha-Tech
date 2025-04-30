<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Rendezvous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonImmutable;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Dashboard summary (charts and stats) for authenticated doctor
     */
    public function dashboard()
    {
        // Ensure the logged-in user is a doctor and retrieve their doctor record
        $user = Auth::user();
        if ($user->role !== 'doctor') {
            abort(403, 'Only doctors may view this page.');
        }
        $doctor = Doctor::where('user_id', $user->id)->firstOrFail();
        $doctorId = $doctor->id;

        // Pie chart summary
        $pieData = Rendezvous::getStatusSummary($doctorId) ?? (object)[
            'confirmed' => 0,
            'pending'   => 0,
            'cancelled' => 0,
        ];

        $processedRequests = $pieData->confirmed;
        $pendingRequests   = $pieData->pending;
        $rejectedRequests  = $pieData->cancelled;
        $totalRequests     = $processedRequests + $pendingRequests + $rejectedRequests;

        // Six-month line chart data
        $chartData = Rendezvous::getMonthlyChartData($doctorId)->keyBy('month');
        $months    = [];
        $totals    = [];
        $confirmed = [];
        



        
        $base = CarbonImmutable::now();
        for ($i = 5; $i >= 0; $i--) {
            // use no-overflow so that Feb 30 becomes Feb 28 (or 29)
            $label = $base->subMonthsNoOverflow($i)->format('M');
            $months[] = $label;
            if (isset($chartData[$label])) {
                $totals[]    = (int) $chartData[$label]->total;
                $confirmed[] = (int) $chartData[$label]->confirmed;
            } else {
                $totals[]    = 0;
                $confirmed[] = 0;
            }
        }

        return view('doctors', compact(
            'months',
            'totals',
            'confirmed',
            'pieData',
            'totalRequests',
            'pendingRequests',
            'processedRequests',
            'rejectedRequests'
        ));
    }

    /**
     * List and filter this doctor’s appointments
     */
    public function index(Request $request)
    {
        // Retrieve doctor record from logged-in user
        $doctor = Doctor::where('user_id', Auth::id())->firstOrFail();
        $doctorId = $doctor->id;

        $query = Rendezvous::with('patient')
                          ->where('doctor_id', $doctorId);

        if ($search = $request->query('search')) {
            $query->whereHas('patient', fn($q) =>
                $q->where('name', 'like', "%{$search}%")
            );
        }
        if ($type = $request->query('type')) {
            $query->where('type', $type);
        }
        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        $appointments = $query
            ->orderBy('rendezvous', 'desc')
            ->paginate(15)
            ->appends($request->query());

        return view('requestrendi', [
            'appointments' => $appointments,
            'search'       => $search,
            'type'         => $type,
            'status'       => $status,
        ]);
    }

    /**
     * Update status of an appointment
     */
    public function updateStatus(Request $request, Rendezvous $appointment)
    {
        // Verify this user owns the appointment
        $doctor = Doctor::where('user_id', Auth::id())->firstOrFail();
        if ($appointment->doctor_id !== $doctor->id) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'status' => 'required|in:Confirmé,Annulé',
        ]);

        $appointment->update(['status' => $request->status]);

        return back()->with('success', 'Statut mis à jour.');
    }


    public function uploadPic(Request $request)
{
    $request->validate([
        'pic' => 'required|image|mimes:jpeg,png,jpg,gif',
    ]);

    $doctor = Auth::user()->doctor;

    if ($request->hasFile('pic')) {
        $file = $request->file('pic');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('doctor_pics', $filename, 'public');

        // Update the doctor's pic path
        $doctor->pic = $path;
        $doctor->save();
    }

    return back()->with('success', 'Profile picture updated!');
}

}
