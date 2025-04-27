<?php
namespace App\Http\Controllers;

use App\Models\Patient;
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
}
