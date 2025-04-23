<?php

namespace App\Http\Controllers;

use App\Models\doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\RendezVous;


class doctorController extends Controller
{

    /**
     * Handle the doctor profile update form submission.
     */

    public function showAvPage()
    {
        $doctor = doctor::find([
            'user_id' => Auth::id(),
        ]);
        return view('availability', ['r' => $doctor[0]->rendez, 'doctor' => $doctor[0]]);
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
}
