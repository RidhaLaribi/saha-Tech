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
use App\Http\Controllers\doctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserManagementController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;



Route::get('/', function () {
    // return Auth::user();
    return view('welcome')->with("id", Auth::user());
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('signin');

/*** */
Route::post("/login", [authController::class, 'login'])->name('login');

Route::post("/sign", [authController::class, 'store'])->name('auth.sign');

Route::post('/registerp', [authController::class, 'registrp'])->name('registerp');





/**** */

Route::get('/profile', [resController::class, "showProfile"])->name('profile');

Route::get('/loginp', function () {
    return view('loginp');
})->name('loginp');

Route::get(
    '/medecin',
    [doctorController::class, 'showSearch']
)->name('medecin');

Route::post("logout", [authController::class, 'logout'])->name("logout");



Route::post('toggle-modify', [resController::class, 'toggleModify'])->name('modify.toggle');

Route::post("update", [resController::class, 'updateInfo'])->name("modify");







Route::post('upload-file', [resController::class, 'upload'])->name('files.upload');

Route::delete('/rendezvous/{id}', [resController::class, 'destroy'])->name('rendezvous.destroy');


//Route::get("change-patient", [resController::class, ''])->name("changep.toggle");
Route::post('/changep', [resController::class, 'changep'])->name('changep.toggle');

Route::post("/addMember", [resController::class, "addMember"])->name("addMember");
Route::post("del", [resController::class, 'delPatient'])->name("remove_P");


Route::get('/test-notif', [NotificationController::class, 'sendTest'])
    ->middleware('auth')
    ->name('notifications.test');



Route::middleware(['auth'])
    ->get('/doctorDashBoard', [dashboardController::class, 'dashboard'])
    ->name('dashboard');

Route::get("/availability", [doctorController::class, 'showAvPage'])->name("avbl")->middleware('auth');

Route::post('/availability/update-info', [doctorController::class, 'updateInfo'])
    ->name('doctor.updateInfo')
    ->middleware('auth');



Route::middleware(['auth'])
    ->get('/rend', [
        dashboardcontroller::class,
        'index'
    ])->name('rend');


Route::middleware(['auth'])
    ->get('/rendconfirme', [
        dashboardcontroller::class,
        'indexconfirme'
    ])->name('rendconfirme');

Route::middleware(['auth'])
    ->patch(
        '/rend/{appointment}',
        [dashboardcontroller::class, 'updateStatus']
    )
    ->name('doctor.appointments.update');


Route::get('/rendconfirme/search', [dashboardController::class, 'search'])->name('laboratoires.search');




Route::middleware('auth')->group(function () {
    // Mark all as read
    Route::post('/doctorDashBoard', [NotificationController::class, 'clear'])
        ->name('clearnotif');



    Route::post('/rend', [NotificationController::class, 'clear'])->name('clearnotif');
    // Send a test notification

});
Route::post("addNote", [doctorController::class, 'addNote'])->name("addnote");



Route::middleware('auth')
    ->get('rend/{patient}', [PatientController::class, 'show'])
    ->name('doctor.patient.show');


Route::post('/doctorDashBoard', [dashboardcontroller::class, 'uploadPic'])->name('uploadpic');
Route::
    get('profile{patient}', [doctorController::class, 'showThisPatient'])
    ->
    middleware('auth')
    ->name('doctor.patient.show');







Route::get('/admindash', [AdminDashboardController::class, 'index'])
    ->name('admindash')
    ->middleware('auth');

Route::middleware(['auth'])
    ->get('/praticienRequest', [
        AdminDashboardController::class,
        'validateDocShow'
    ])->name('rendadmin');

Route::delete(
    '/admin/doctors/{doctor}',
    [AdminDashboardController::class, 'destroyDoctor']
)
    ->name('admin.doctor.destroy')
    ->middleware('auth');

Route::patch('/admin/doctors/{doctor}/validate', [AdminDashboardController::class, 'validateDoctor'])->name('admin.doctor.validate');



Route::get('/users', [UserManagementController::class, 'index'])
    ->name('users');
//  ->middleware('can:admin');



Route::post('/users/sign', [UserManagementController::class, 'sign'])
    ->name('users.sign');


Route::post('/users/register', [UserManagementController::class, 'registrp'])
    ->name('registerpad');

Route::post('/users', [UserManagementController::class, 'store'])
    ->name('store');



Route::get('/users/search', [UserManagementController::class, 'search'])
    ->name('users.search');


Route::delete('doctors/{doctor}', [UserManagementController::class, 'destroydoc'])->name('doctors.destroy');
Route::delete('patients/{patient}', [UserManagementController::class, 'destroy'])->name('patients.destroy');
Route::delete('admins/{admin}', [UserManagementController::class, 'destroyad'])->name('admins.destroy');


Route::post('/medecin', [PatientController::class, 'book'])->name('appointments.store');



// Show “Forgot Password” form
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

// Handle form submit and send reset link
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// Show the actual “Reset Password” form (with token)
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

// Handle the password reset submission
Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update');



use App\Http\Controllers\DoctorRatingController;

Route::middleware('auth')->group(function () {
    // Show form
    Route::get('/doctors/{doctor}/rate', [doctorController::class, 'createrate'])
        ->name('doctors.rate.form');

    // Handle submission
    Route::post('/doctors/{doctor}/rate', [doctorController::class, 'storerate'])
        ->name('doctors.rate.submit');
});
