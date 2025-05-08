<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Rendezvous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Optionally: $this->middleware('role:doctor');
    }

    public function show(Patient $patient)
    {
        // Optional: ensure the logged-in doctor actually has this patient
        // if ($patient->doctor_id !== Auth::id()) { abort(403); }

        return view('profile', compact('patient'));
    }


    public function book(Request $request)
    {
        $data = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'scheduled_at' => 'required',
            'type' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $datetimeString = $data['scheduled_at']; // e.g., "2025-05-10 14:00:00,2025-05-10 15:30:00"

        $datetimeArray = array_filter(array_map('trim', explode(',', $datetimeString)));

        // Optional: loop and save each appointment
        foreach ($datetimeArray as $datetime) {

            Rendezvous::create([
                'patient_id' => auth()->id(),
                'doctor_id' => $data['doctor_id'],
                'rendezvous' => $datetime,
                'type' => $data['type'],
            ]);
        }

        return redirect()->back()
            ->with('success', 'Ton rendez-vous a bien été enregistré !');
    }

}
