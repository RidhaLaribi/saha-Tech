<?php

namespace App\Http\Controllers;

use App\Models\doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class docController extends Controller
{
    
    public function store(Request $request)
{
    $request->validate([
        'prenom' => 'required|string|max:100',
        'nom'  => 'required|string|max:100',
        'age'        => 'nullable|integer',
        'sexe'     => 'required|in:Homme,Femme',
        'telephone'      => 'required',
        'email'      => 'required|email',
        'specialite'  => 'required|string',
        'password'   => 'required|min:6',
    ]);

    $user= User ::create([
        'nom' =>$request->name,
        'email'  => $request->email,
        'password'   => Hash::make($request->password),
    ]);

    $doctor = doctor::create([
        'prenom' => $request->name,
        'age'  => $request->age,
        'sexe'  => $request->gender,
        'telephone'   => $request->phone,
        'specialite'  => $request->specialty,
        
    ]);

    return redirect()->route('doctors')
                     ->with('success', 'Inscription réussie!');
}

}
