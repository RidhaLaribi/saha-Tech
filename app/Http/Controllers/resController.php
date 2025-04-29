<?php

namespace App\Http\Controllers;

use App\Models\consultation;
use App\Models\MedecalFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnArgument;
use App\Models\User;
use App\Models\patient;
use App\Models\Rendezvous;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class resController extends Controller
{
    function updateInfo(Request $request)
    {
        $request->validate([
            'pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // pic is optional
            'email' => 'required|email|unique:users,email,' . auth()->user()->id, // validate email
            'phone' => 'required|regex:/^[0-9]{10,15}$/', // validate phone (you can adjust the regex pattern if needed)
        ]);

        $user = auth()->user();
        $patients = $user->patient;

        $index = session('id_p', 0);
        if (!isset($patients[$index])) {
            $index = 0;
            session(['id_p' => 0]);
        }

        $patient = $patients[$index];
        $path = $patient->pic; // Current image path


        // If the user has a current image, delete it before uploading the new one
        if ($path && Storage::disk('public')->exists($path) && $request->hasFile('pic')) {
            Storage::disk('public')->delete($path); // Delete old image
        }

        // Store the new image
        if ($request->hasFile('pic')) {
            $picPath = $request->file('pic')->store('profile_pictures', 'public'); // Store new image
            $patient->update(["pic" => $picPath]); // Update the user profile with the new image path
            return redirect()->back();
        }

        $user->update(["email" => $request->email]);
        $user->update(["tel" => $request->phone]);



        return redirect()->back();





    }
    public function toggleModify(Request $request)
    {
        if (session('modifying') == true) {
            session(['modifying' => false]); // store in session
        } else
            session(['modifying' => true]); // store in session

        return redirect()->back(); // go back to the same page
    }

    public function upload(Request $request)
    {
        // Validate that multiple files are being uploaded, no specific type
        $request->validate([
            'files.*' => 'required|file',
            'pid' => 'required',
            // Allow all file types up to 2MB
        ]);
        // Loop through the uploaded files and store them
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Store each file
                $path = $file->store('medical_files', 'public');

                $user = User::findOrFail($request->pid);

                $patients = $user->patient;

                $index = session('id_p', 0);
                if (!isset($patients[$index])) {
                    $index = 0;
                    session(['id_p' => 0]);
                }

                $patient = $patients[$index];

                // Save the file information in the database
                MedecalFile::create([
                    'file_path' => $path, // Store the file path
                    'patient_id' => $patient->id, // Assuming you're associating the file with the logged-in user
                ]);
            }
        }

        return redirect()->back()->with('success', 'Files uploaded successfully!');
    }

    public function showProfile()
    {
        if (!auth()->check()) {
            return redirect()->route('signin');
        }

        $user = auth()->user();
        $patients = $user->patient;


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


        return view(
            'profile',
            [
                'patient' => $patient,
                'patients' => $patients,
                'files' => $files,
                'r' => $patient->rendezvous,
                'user' => $user,
                'notes' => $notes,
                'next' => $next,
            ]
        );
    }
    public function changep(Request $request)
    {
        // Validate the incoming request to ensure 'id' is provided and is a number
        $request->validate([
            'id' => 'required|integer',
        ]);

        // Set the session variable to the new ID
        session(['id_p' => $request->id]);

        // Optionally, redirect back with a message
        return redirect()->back()->with('success', 'Patient changed successfully!');
    }

    public function addMember(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'relation' => 'required|string',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'files.*' => 'nullable|file|max:5120' // 5MB max per file
        ]);

        $user = auth()->user();

        // Create the patient
        $p = Patient::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'age' => $request->age,
            'sexe' => $request->gender,
            'rel' => $request->relation,
        ]);

        // Handle file uploads
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('medical_files', 'public');

                MedecalFile::create([
                    'file_path' => $path,
                    'patient_id' => $p->id,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Patient and files added successfully!');
    }

    function delPatient(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        Patient::where(['id' => $request->id])->delete();
        return redirect()->back()->with('success', 'Patient and files deleted successfully!');
    }



}