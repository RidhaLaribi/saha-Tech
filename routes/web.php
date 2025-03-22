<?php

use App\Http\Controllers\authController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('welcome')->with("id", Auth::user());
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('signin');

/*** */
Route::post("/login", [authController::class, 'login'])->name('login');

Route::post("/sign", [authController::class, 'store'])->name('sign');

/**** */

Route::get('/profile', function () {
    if (!auth()->check()) {
        return redirect()->route('/signin');
    }
    $user = auth::user();
    //return $user->rendezvous[1]->rendezvous;
    // ; //hada rendi-v afficher f calendier
    return view('profile')->with('r', $user->rendezvous)->with('user', auth::user());
})->name('profile');

Route::get('/loginp', function () {
    return view('loginp');
});

Route::get('/medecin', function () {
    return view('medecin');
})->name('medecin');

Route::get('/db', function () {
    return view('database');
});




