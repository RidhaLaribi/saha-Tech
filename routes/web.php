<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome')->with("id", null);
});
