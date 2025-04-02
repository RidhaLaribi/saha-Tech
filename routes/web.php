<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\docController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;



Route::get('/', function () {

    return view('welcome')->with("id", Auth::user());
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('signin');

/*** */
Route::post("/login", [authController::class, 'login'])->name('login');

Route::post("/sign", [authController::class, 'store'])->name('sign');

Route::post('/registerp', [docController::class, 'store'])->name('registerp');

/**** */
Route::get('/docdash', function () {
    return view('doctors');
})->name('doctors');

Route::get('/profile', function () {
    if (!auth()->check()) {
        return redirect()->route('signin');
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






