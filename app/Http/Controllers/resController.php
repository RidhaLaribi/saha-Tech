<?php

namespace App\Http\Controllers;

use App\Models\MedecalFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnArgument;
use App\Models\User;
use App\Models\patient;
use Illuminate\Support\Facades\Hash;

class resController extends Controller
{
    function updateInfo(Request $request)
    {
        $request->validate([
            'pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // pic is optional
            'email' => 'required|email|unique:users,email,' . auth()->user()->id, // validate email
            'phone' => 'required|regex:/^[0-9]{10,15}$/', // validate phone (you can adjust the regex pattern if needed)
        ]);

        $user = auth::user();
        $patient = $user->patient[0];
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
            'files.*' => 'required|file', // Allow all file types up to 2MB
        ]);

        // Loop through the uploaded files and store them
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Store each file
                $path = $file->store('medical_files', 'public');
                $user = auth()->user();
                $patient = $user->patient[0];
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
        $patient = $user->patient[0];

        $files = MedecalFile::where('patient_id', $patient->id)->get();

        // Attach MIME types
        foreach ($files as $file) {
            $file->mime = Storage::disk('public')->mimeType($file->file_path);
        }

        return view(
            'profile',
            [
                'patient' => $patient,
                'files' => $files,
                'r' => $patient->rendezvous,
                'user' => $user
            ]
        );
    }





}