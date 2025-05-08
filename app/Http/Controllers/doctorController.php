<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\doctor;
use App\Models\MedecalFile;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\RendezVous;
use Illuminate\Support\Facades\Storage;


class doctorController extends Controller
{

    /**
     * Handle the doctor profile update form submission.
     */

    public function showAvPage()
    {
        $doctor = doctor::firstOrNew([
            'user_id' => Auth::id(),
        ]);
        return view('availability', ['r' => $doctor->rendez, 'doctor' => $doctor]);
    }
    public function updateInfo(Request $request)
    {
        // 1) Validate incoming data
        $data = $request->validate([
            'wilaya' => 'required|string|max:100',
            'ville' => 'required|string|max:100',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'work_days' => 'required|string',
            'home_visit' => 'nullable|boolean',
        ]);
        // 2) Find or create the doctor's record by the authenticated user
        $doctor = doctor::firstOrNew([
            'user_id' => Auth::id(),
        ]);

        // 3) Map form inputs to model fields
        $doctor->location = $data['wilaya'] . ',' . $data['ville'];
        $doctor->price = $data['price'];
        $doctor->description = $data['description'];
        $doctor->work_days = $data['work_days'];
        $doctor->home_visit = $request->has('home_visit');
        $doctor->rating = 0;

        // 4) Save the changes
        $doctor->save();

        // 5) Redirect back with a success message
        return redirect()
            ->back()
            ->with('success', 'Your profile has been updated successfully.');
    }
    public function showThisPatient(Patient $patient)
    {
        if (!auth()->check()) {
            return redirect()->route('signin');
        }

        $u = $patient->user;


        $patients = $u->patient;


        $index = session('id_p', 0);
        if (!isset($patients[session('id_p')])) {
            $index = 0;
            session(['id_p' => 0]);
        }

        $patient = $patients[$index];




        $files = MedecalFile::where('patient_id', $patient->id)->get();

        // Attach MIME types
        foreach ($files as $file) {
            $file->mime = Storage::disk('public')->mimeType($file->file_path);
        }
        $notes = $patient->notes;



        // Assume this is your list of appointments (could be from DB or array of Carbon dates)
        $dates = [
            '2025-04-09 12:30:00',
            '2025-04-10 10:00:00',
            '2025-04-08 16:00:00', // past
        ];

        $now = Carbon::now();

        // Convert all to Carbon and filter future dates
        // $upcoming = collect($dates)
        //     ->map(fn($d) => Carbon::parse($d))
        //     ->filter(fn($date) => $date->greaterThan($now))
        //     ->sort()
        //     ->first(); // Get the soonest one

        // if ($upcoming) {
        //     echo "Next appointment: " . $upcoming->toDateTimeString();
        // } else {
        //     echo "No upcoming appointments";
        // }

        $next = Rendezvous::where('patient_id', $patient->id)
            ->where('rendezvous', '>', now())
            ->orderBy('rendezvous', 'asc')
            ->first();
        session(['modifying' => true]);
        return view(
            'profile',
            [
                'patient' => $patient,
                'patients' => $patients,
                'files' => $files,
                'r' => $patient->rendezvous,
                'user' => Auth::user(),
                'notes' => $notes,
                'next' => $next,
            ]
        );
    }
    function addNote(Request $request)
    {
        $request->validate([
            'note' => 'required',
            'rdvid' => 'required',
            'docid' => 'required',
            'ptnid' => 'required',
        ]);
        $user = auth()->user();
        $patient = Patient::findSole([$request->ptnid]);




        Consultation::create([
            "note" => $request->note,
            'patient_id' => $patient->id,
            'rendez_vous_id' => $request->rdvid,
            'doctor_id' => $user->id
        ]);
        return redirect()->back()->with('success', 'note successfully added!');

    }
    function showSearch(Request $r)
    {
        $doctors = Doctor::with('user')
            ->where('available', 1)
            ->get();

        $counts = [
            'all' => Doctor::where('available', '=', '1')->count(),
            'praticien' => Doctor::where('type', 'doctor')->where('available', '=', '1')->count(),
            'clinique' => Doctor::where('type', 'laboratoire')->where('available', '=', '1')->count(),
        ];

        return view('medecin', [
            'doctors' => $doctors
            ,
            'counts' => $counts
        ]);
    }
}
