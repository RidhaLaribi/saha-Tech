<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome')->with("id", null);
});
Route::get('/profile', function () {
    return view('profile');
});
