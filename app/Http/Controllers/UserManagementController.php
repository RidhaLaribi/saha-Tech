<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\patient;
use App\Models\doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UsersRequest;

class UserManagementController extends Controller
{
    public function __construct()
    {
        // This middleware runs before every action in this controller
        $this->middleware(function($request, $next) {
            $user = Auth::user();
            // If there's no logged‑in user OR they aren't an admin, abort:
            if (! $user || $user->role !== 'admin') {
                abort(403, 'Unauthorized.');
            }
            return $next($request);
        });
    }
    public function index()
    {
        // Admins
        $admins = User::where('role', 'admin')->get();

        // Patients (users whose role is patient)
        $patients = User::where('role', 'patient')->get();

        // Doctors; eager-load their one-to-one Doctor record and their many Patients
        $doctors = User::with('doctor')
                   ->where('role', 'doctor')
                   ->get();

        return view('adminusers', compact('admins', 'patients', 'doctors'));
    }
    public function store(Request $request)
    {
        // 1) Validate —
        $data = $request->validate([
            'pic'      => 'nullable|image',
            'name'     => 'required|string|max:191',
            'email'    => 'required|email|unique:users,email',
            'tel'      => 'required|string|max:20',   // <— matches input name
            'password' => 'required|string',
        ]);

        // 2) Upload avatar if given
        if ($request->hasFile('pic')) {
            $data['pic'] = $request->file('pic')
                                  ->store('avatars','public');
        }

        // 3) Force role
        $data['role']     = 'admin';

        // 4) Hash password
        $data['password'] = Hash::make($data['password']);



        // 6) Create the user
        User::create($data);

        return back()->with('success','Admin user added successfully.');
    }

    public function registrp(UsersRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->telephone,
            'role' => $request->type,
            'password' => Hash::make($request->password),
        ]);

        $doctor = doctor::create([
            'user_id' => $user->id,
            'doctor_ref' => $request->enum,
            'age' => $request->age,
            'gender' => $request->sexe,
            'type' => $request->type,
            'specialty' => $request->specialite,
            'available'=>1,

        ]);

        return redirect()->route('users')
            ->with('success', "doctor added");
    }

    function sign(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'age' => 'required',
            'sexe' => 'required',
            'telephone' => 'required',
            'password' => 'required'
        ]);

        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(value: $request->password), // Hashing the password before storing
            'tel' => $request->telephone
        ]);


        patient::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'age' => $request->age,
            'sexe' => $request->sexe,

        ]);
        return redirect()->route('users')
            ->with('success', "patient added!");

    }

    public function search(Request $request)
{
    // 1) grab filters
    $type  = $request->input('type');    // 'admin','patient','doctor','lab' or null = all
    $query = $request->input('q');       // search string

    // 2) base query builder for users
    $users = User::query();

    // 3) filter by role/type if set
    if ($type) {
        $users->where('role', $type);
    }

    // 4) filter by id, name or role if search string provided
    if ($query) {
        $users->where(function($q) use ($query) {
            // if they typed a number, match ID exactly
            if (is_numeric($query)) {
                $q->where('id', $query);
            }
            // match name or role by partial
            $q->orWhere('name', 'like', "%{$query}%")
              ->orWhere('role', 'like', "%{$query}%");
        });
    }

    // 5) eager‑load relationships needed for each role
    $admins   = (clone $users)->where('role','admin')->get();
    $patients = (clone $users)->where('role','patient')->with('patient')->get();
    $doctors  = (clone $users)->where('role','doctor')->with('doctor')->get();
    $labs      = (clone $users)->where('role','lab')->with('lab')->get();

    // 6) return view with filtered collections
    return view('adminusers', compact('admins','patients','doctors','labs','type','query'));
}

public function destroy(Patient $patient): RedirectResponse
{
    // Grab the related user
    $user = $patient->user;

    // 1) Delete the patient row
    $patient->delete();

    // 2) Delete the user account
    $user->delete();

    return redirect()->back()
                     ->with('success',
                           'Le patient et son compte utilisateur ont été supprimés.');
}

public function destroydoc(Doctor $doctor): RedirectResponse
{
    // 1) Grab the related user
    $user = $doctor->user;
    

    // 2) Delete the doctor row
    $doctor->delete();

    // 3) Delete the user account
    $user->delete();

    return redirect()
        ->back()
        ->with('success', 'Praticien et compte utilisateur supprimés avec succès.');
}


    public function destroyad(int $id): RedirectResponse
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $admin->delete();

        return redirect()
            ->back()
            ->with('success', 'L’administrateur a bien été supprimé.');
    }


}
