<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnArgument;
use App\Models\User;
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
        return view("loginp");
    }
    function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(value: $request->password) // Hashing the password before storing
        ]);

        return "User created";
    }

    public function login(Request $r)
    {
        $r->validate([
            "email" => 'required',
            "password" => 'required'
        ]);

        // Find user by name


        // Check if password is correct

        // Log in manually since Auth::attempt() is failing due to 'pass' column
        if (auth::attempt(["email" => $r->email, "password" => $r->password])) {

            $r->session()->regenerate();

            session(['user' => Auth::user()]);

            return redirect()->route("home");
        }

    }
    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect('/');
    }




}
