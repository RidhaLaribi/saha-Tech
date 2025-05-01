<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;             // your default user table
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index()
    {
        // Admins
        $admins = User::where('role', 'admin')->get();

        // Patients (users whose role is patient)
        $patients = User::where('role', 'patient')->get();

        // Doctors; eager-load their one-to-one Doctor record and their many Patients
        $doctors = User::with(['doctor', 'patient'])
                       ->where('role', 'doctor')
                       ->get();

        return view('adminusers', compact('admins', 'patients', 'doctors'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'pic'        => 'nullable|image|max:2048',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users',
            'tel'        => 'required|string|max:20',
            'role'       => ['required', Rule::in(['admin','patient','doctor'])],
            'password'   => 'required|string|min:8|confirmed',
    
            // patient-specific
            'age'        => 'required_if:role,patient|nullable|integer|min:0',
            'sexe'       => 'required_if:role,patient|nullable|in:Homme,Femme',
            'rel'        => 'nullable|string|max:255',
    
            // doctor-specific
            'doctor_ref' => 'required_if:role,doctor|nullable|string|max:255',
            'gender'     => 'required_if:role,doctor|nullable|in:male,female',
            'type'       => 'required_if:role,doctor|nullable|string|max:50',
            'specialty'  => 'required_if:role,doctor|nullable|string|max:100',
            'location'   => 'nullable|string|max:255',
            'price'      => 'nullable|numeric|min:0',
            'description'=> 'nullable|string',
            'work_days'  => 'nullable|array',
            'home_visit' => 'nullable|boolean',
        ]);
    
        // 1) Upload pic if present
        if($request->hasFile('pic')){
          $path = $request->file('pic')->store('avatars','public');
          $data['pic'] = $path;
        }
    
        // 2) Create the base user
        $user = User::create([
          'pic'      => $data['pic'] ?? null,
          'name'     => $data['name'],
          'email'    => $data['email'],
          'tel'      => $data['tel'],
          'role'     => $data['role'],
          'password' => Hash::make($data['password']),
        ]);
    
        // 3) Depending on role, create related record
        if($data['role'] === 'patient') {
            Patient::create([
              'user_id' => $user->id,
              'pic'     => $data['pic'] ?? null,
              'name'    => $data['name'],
              'age'     => $data['age'],
              'sexe'    => $data['sexe'],
              'rel'     => $data['rel'] ?? null,
            ]);
        }
    
        if($data['role'] === 'doctor') {
            Doctor::create([
              'user_id'     => $user->id,
              'doctor_ref'  => $data['doctor_ref'],
              'age'         => $data['age'],
              'gender'      => $data['gender'],
              'type'        => $data['type'],
              'specialty'   => $data['specialty'],
              'pic'         => $data['pic'] ?? null,
              'location'    => $data['location'] ?? null,
              'price'       => $data['price'] ?? null,
              'description' => $data['description'] ?? null,
              'work_days'   => isset($data['work_days']) ? json_encode($data['work_days']) : null,
              'home_visit'  => $data['home_visit'] ?? false,
            ]);
        }
    
        return back()->with('success',"New {$data['role']} “{$data['name']}” added.");
    }
    
}
