<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnArgument;
use App\Models\User;
use App\Models\patient;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make(value: $request->password), // Hashing the password before storing
            'tel' => $request->telephone
        ]);


        patient::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'age' => $request->age,
            'sexe' => $request->sexe,

        ]);
        return redirect()->route('login')
            ->with('success', "Welcome to Sahateck Family! Your health journey starts here. We're honored to be part of your care.");

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




}
