<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnArgument;
use App\Models\User;
use App\Models\patient;
use App\Models\doctor;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SomeNotification;

class authController extends Controller
{
    function showWelcome()
    {
        $user = auth::user();
        return view("welcome", compact('user'));

    }
    function showLogin(Request $r)
    {
        return view("login");
    }
    function store(Request $request)
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
            'password' => Hash::make(value: $request->password),
            'tel' => $request->telephone
        ]);


        patient::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'age' => $request->age,
            'sexe' => $request->sexe,

        ]);
        return redirect()->route('login')
            ->with('success', "Welcome to HeyDoc Family! Your health journey starts here. We're honored to be part of your care.");

    }

    public function login(Request $r)
    {
        $r->validate([
            "iden" => 'required',
            "password" => 'required'
        ]);

        // Find user by name


        // Check if password is correct

        // Log in manually since Auth::attempt() is failing due to 'pass' column
        if (auth::attempt(["email" => $r->iden, "password" => $r->password])) {
            $r->session()->regenerate();
            session(['user' => Auth::user()]);
            return redirect()->route("home");
        }
        return back()->withErrors(['login' => 'Invalid email or password.']);

    }
    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect('/');
    }


    public function registrp(UsersRequest $request)
    {
        if ($request->type == "laboratoire" || $request->type == "doctor") {
            $role = "doctor";
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->telephone,
            'role' => $role,
            'password' => Hash::make($request->password),
        ]);

        if ($user->wasRecentlyCreated) {
            $doctor = doctor::create([
                'user_id' => $user->id,
                'doctor_ref' => $request->enum,
                'age' => $request->age,
                'gender' => $request->sexe,
                'type' => $request->type,
                'specialty' => $request->specialite,

            ]);

            if (!$doctor->wasRecentlyCreated) {
                $user->delete();
            }
        }
         $admins = User::where('role','admin')->get();

            Notification::send(
                $admins,
                new SomeNotification([
                    'message' => 'Nouvelle demande d\'inscription de '
                               . $user->name
                               . ' en tant que '
                               . $request->type . '.',
                    'url'     => route('rendadmin') // point to your admin page
                ])
            );

        return redirect()->route('loginp')
            ->with('success', "Nous examinerons votre demande sous 48 heures ⏰.
            check ur email soon");
    }

    public function forgot(Request $r)
    {
        $r->validate(['email' => 'required']);


    }

}



