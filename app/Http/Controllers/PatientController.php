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

    public function book(Request $request, $doctorId)
    {
        $data = $request->validate([
            'appointment_type' => 'required|string',
            'appointment_date' => 'required|date',
        ]);

        Rendezvous::create([
            'patient_id' => Auth::id(),
            'doctor_id' => $doctorId,
            'rendezvous' => $data['appointment_date'],
            'type' => $data['appointment_type'],
            'status' => 'En Attente',
        ]);

        return redirect()->back()->with('success', 'Rendez-vous réservé !');
    }
}
