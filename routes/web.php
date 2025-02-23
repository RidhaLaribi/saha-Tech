<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome')->with("id", null);
});

Route::get('/login', function () {
    return view('login')->with("id", null);
});
Route::get('/profile', function () {
    $rendi = ['generaliste', '2025-02-07T16:30']; //hada rendi-v afficher f calendier
    return view('profile')->with('r', $rendi);
});
Route::get('/loginp', function () {
    return view('loginp');
});
