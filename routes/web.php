<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\resController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\docController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\dashboardcontroller;
use App\Notifications\SomeNotification;




Route::get('/', function () {

    return view('welcome')->with("id", Auth::user());
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('signin');

/*** */
Route::post("/login", [authController::class, 'login'])->name('login');

Route::post("/sign", [authController::class, 'store'])->name('sign');

Route::post('/registerp', [authController::class, 'registrp'])->name('registerp');





/**** */
Route::get('/docdash', function () {
    return view('doctors');
})->name('doctors');
Route::get('/news', function () {
    return view('news');
})->name('news');
Route::get('/rend', function () {
    return view('requestrendi');
})->name('rend');
Route::get('/profile', [resController::class, "showProfile"])->name('profile');

Route::get('/loginp', function () {
    return view('loginp');
})->name('loginp');

Route::get('/medecin', function () {
    return view('medecin');
})->name('medecin');

Route::post("logout", [authController::class, 'logout'])->name("logout");



Route::post('toggle-modify', [resController::class, 'toggleModify'])->name('modify.toggle');

Route::post("update", [resController::class, 'updateInfo'])->name("modify");







Route::post('/upload-file', [resController::class, 'upload'])->name('files.upload');


//Route::get("change-patient", [resController::class, ''])->name("changep.toggle");
Route::post('/changep', [resController::class, 'changep'])->name('changep.toggle');

Route::post("/addMember", [resController::class, "addMember"])->name("addMember");
Route::post("del", [resController::class, 'delPatient'])->name("remove_P");
Route::post("addNote", [resController::class, 'addNote'])->name("addnote");

Route::middleware('auth')->group(function () {
    // Mark all as read
    Route::post('/docdash', [NotificationController::class, 'clear'])
         ->name('clearnotif');



     Route::post('/rend', [NotificationController::class, 'clear'])->name('clearnotif');
    // Send a test notification
    
});
Route::get('/test-notif', [NotificationController::class,'sendTest'])
     ->middleware('auth')
     ->name('notifications.test');
