<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome')->with("id", null);
});

Route::get('/login', function () {
    return view('login')->with("id", null);
});
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/loginp', function () {
    return view('loginp');
});
