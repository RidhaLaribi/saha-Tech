<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Rendezvous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonImmutable;
use Carbon\Carbon;


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
        $pieData = Rendezvous::getStatusSummary($doctorId) ?? (object) [
            'confirmed' => 0,
            'pending' => 0,
            'cancelled' => 0,
        ];

        $processedRequests = $pieData->confirmed;
        $pendingRequests = $pieData->pending;
        $rejectedRequests = $pieData->cancelled;
        $totalRequests = $processedRequests + $pendingRequests + $rejectedRequests;

        // Six-month line chart data
        $chartData = Rendezvous::getMonthlyChartData($doctorId)->keyBy('month');
        $months = [];
        $totals = [];
        $confirmed = [];







        $base = CarbonImmutable::now();
        for ($i = 5; $i >= 0; $i--) {
            // use no-overflow so that Feb 30 becomes Feb 28 (or 29)
            $label = $base->subMonthsNoOverflow($i)->format('M');
            $months[] = $label;
            if (isset($chartData[$label])) {
                $totals[] = (int) $chartData[$label]->total;
                $confirmed[] = (int) $chartData[$label]->confirmed;
            } else {
                $totals[] = 0;
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
        // 1) Identify the logged-in doctor
        $doctor = Doctor::where('user_id', Auth::id())->firstOrFail();
        $doctorId = $doctor->id;

        // 2) Shared patient-name filter
        $search = $request->query('search');

        // 3) Base for pending (must have patient, not emergency, and not past)
        $pendingBaseQuery = Rendezvous::with('patient')
            ->where('doctor_id', $doctorId)
            ->where('status', 'En Attente')
            ->where('type', '!=', 'emergency')
            ->where('rendezvous', '>=', Carbon::now())
            ->when(
                $search,
                fn($q) =>
                $q->whereHas(
                    'patient',
                    fn($q2) =>
                    $q2->where('name', 'like', "%{$search}%")
                )
            );

        // 4) Emergencies: keep all emergencies that are not in the past
        $emergencies = Rendezvous::with('patient')
            ->where('doctor_id', $doctorId)
            ->where('type', 'emergency')
            ->where('rendezvous', '>=', Carbon::now())
            ->orderBy('rendezvous', 'desc')
            ->get();

        // 5) Pending table: clone, order, paginate
        $appointments = (clone $pendingBaseQuery)
            ->orderBy('rendezvous', 'desc')
            ->paginate(15)
            ->appends($request->only('search'));

        // 6) Lab list (unchanged)
        $laboratoires = Doctor::where('type', 'laboratoire')->get();

        // 7) Render view
        return view('requestrendi', [
            'emergencies' => $emergencies,
            'appointments' => $appointments,
            'search' => $search,
            'laboratoires' => $laboratoires,
        ]);
    }


    /**
     * Display only confirmed rendez-vous for the logged-in doctor,
     * with today’s appointments first.
     */
    public function indexconfirme(Request $request)
    {
        // 1) Get current doctor
        $doctor = Doctor::where('user_id', Auth::id())->firstOrFail();

        // 2) Optional patient name search
        $patientSearch = $request->query('search');

        // 3) Build the query: only status = 'Confirmé'
        $appointments = Rendezvous::with('patient')
            ->where('doctor_id', $doctor->id)
            ->where('status', 'Confirmé')
            ->when(
                $patientSearch,
                fn($q) =>
                $q->whereHas(
                    'patient',
                    fn($q2) =>
                    $q2->where('name', 'like', "%{$patientSearch}%")
                )
            )
            // 4) Order: today's date first, then by time ascending
            ->orderByRaw(
                "DATE(rendezvous) = ? DESC",
                [Carbon::today()->toDateString()]
            )
            ->orderBy('rendezvous', 'asc')
            ->paginate(15)
            ->appends($request->only(['search']));

        // 5) Still build your lab list (unchanged)
        $laboSearch = $request->query('labo_search');

        $laboratoires = Doctor::where('type', 'laboratoire')
            ->with('User')
            ->when(
                $laboSearch,
                fn($q) =>
                $q->where(function ($q2) use ($laboSearch) {
                    $q2->whereHas(
                        'User',
                        fn($u) =>
                        $u->where('name', 'like', "%{$laboSearch}%")
                            ->orWhere('tel', 'like', "%{$laboSearch}%")
                    )
                        ->orWhere('specialty', 'like', "%{$laboSearch}%");
                })
            )
            ->get();

        // 6) Render view with both lists
        return view('confirmérendesvous', [
            'appointments' => $appointments,
            'search' => $patientSearch,
            'laboratoires' => $laboratoires,
            'labo_search' => $laboSearch,
        ]);
    }






    /**
     * Update status of an appointment
     */
    public function updateStatus(Request $request, Rendezvous $appointment)
    {
        // 1) Ensure the authenticated doctor owns this appointment
        $doctor = Doctor::where('user_id', Auth::id())->firstOrFail();
        if ($appointment->doctor_id !== $doctor->id) {
            abort(403, 'Unauthorized');
        }

        // 2) Validate only Confirmé or Annulé statuses
        $request->validate([
            'status' => 'required|in:Confirmé,Annulé',
        ]);

        // 3) Update the appointment’s status
        $appointment->update(['status' => $request->status]);

        // 4) If this is an emergency appointment, shift only *confirmed* later slots on the same day +30m
        if ($appointment->type === 'emergency' && $request->status == 'Confirmé') {
            $urgentTime = $appointment->rendezvous;
            $date = $urgentTime->toDateString();

            $laterAppointments = Rendezvous::where('doctor_id', $doctor->id)
                ->whereDate('rendezvous', $date)          // same calendar day
                ->where('rendezvous', '>', $urgentTime)  // strictly after the urgence
                ->where('status', 'Confirmé')            // only confirmed appointments
                ->orderBy('rendezvous')
                ->get();

            foreach ($laterAppointments as $slot) {
                // Add 30 minutes and re‑assign to the attribute
                $slot->rendezvous = $slot->rendezvous->addMinutes(30);
                $slot->save();
            }

        }

        return back()->with('success', 'Statut mis à jour.');
    }



    public function uploadPic(Request $request)
    {
        $request->validate([
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);


        $user = Auth::user();

        if (!$request->hasFile('pic')) {
            return back()->withErrors(['pic' => 'No file uploaded.']);
        }


        // store the file
        $file = $request->file('pic');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('profile_pics', $filename, 'public');

        // decide where to save it
        if ($user->role === 'doctor' && $user->doctor) {
            // doctor: pic is on the doctor profile
            $profile = $user->doctor;
        } else {


            $profile = $user;
        }




        $profile->pic = $path;
        $profile->save();


        return back()->with('success', 'Profile picture updated!');
    }




}
