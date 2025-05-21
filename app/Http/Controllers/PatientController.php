<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Rendezvous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SomeNotification;
use App\Models\Doctor;


class PatientController extends Controller
{


    public function show(Patient $patient)
    {
        // Optional: ensure the logged-in doctor actually has this patient
        // if ($patient->doctor_id !== Auth::id()) { abort(403); }

        return view('profile', compact('patient'));
    }





    public function book(Request $request)
    {
        // 1) Validate incoming data
        $data = $request->validate([
            'doctor_id'    => 'required|exists:doctors,id',
            'scheduled_at' => 'required|string',
            'type'         => 'required|string',
            'pid'          => 'nullable|integer',
            'tel'          => 'nullable|string',
        ]);

        // 2) Build an array of datetimes
        $datetimeArray = array_filter(
            array_map('trim', explode(',', $data['scheduled_at']))
        );

        // 3) Determine patient identifier
        $patientValue = $data['pid'] ?? $data['tel'];

        // 4) Create all rendez-vous records
        $createdAppointments = [];
        foreach ($datetimeArray as $datetime) {
            $createdAppointments[] = Rendezvous::create([
                'patient_id' => $patientValue,
                'doctor_id'  => $data['doctor_id'],
                'rendezvous' => $datetime,
                'type'       => $data['type'],
            ]);
        }

        // 5) Load the doctor’s user and send the notification
        $doctor = Doctor::findOrFail($data['doctor_id']);
        $user   = $doctor->user; // assumes Doctor model has a `user()` relation

        $user->notify(new SomeNotification([
            'message' => 'You have new appointment request(s).',
            'url'     => route('rend'),
        ]));

        // 6) Redirect back with success
        return back()->with('success', 'Ton rendez-vous a bien été enregistré !');
    }


}
