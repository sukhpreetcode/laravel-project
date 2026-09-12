<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PatientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDoctorController;
use App\Http\Controllers\AdminPatientController;


/*
|--------------------------------------------------------------------------
| PUBLIC WEBSITE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');


/*
|--------------------------------------------------------------------------
| PATIENT
|--------------------------------------------------------------------------
*/

Route::get(
    '/add-patient',
    [PatientController::class, 'create']
)->name('patients.create');

Route::post(
    '/add-patient',
    [PatientController::class, 'store']
)->name('patients.store');

Route::get(
    '/check-appointment',
    [PatientController::class, 'tokenPage']
)->name('patients.token');

Route::post(
    '/check-appointment',
    [PatientController::class, 'checkToken']
)->name('patients.token.check');

Route::post(
    '/cancel-appointment',
    [PatientController::class, 'cancelByToken']
)->name('patients.token.cancel');
/*
|--------------------------------------------------------------------------
| ABOUT HOSPITAL
|--------------------------------------------------------------------------
*/

Route::get('/about', function () {
    return view('about');
})->name('about');


/*
|--------------------------------------------------------------------------
| SPECIALTIES
|--------------------------------------------------------------------------
*/

Route::get('/specialties', function () {
    return view('specialties');
})->name('specialties');


/*
|--------------------------------------------------------------------------
| ADMIN LOGIN
|--------------------------------------------------------------------------
*/

Route::get(
    '/admin/login',
    [AdminController::class, 'login']
)->name('admin.login');

Route::post(
    '/admin/login',
    [AdminController::class, 'authenticate']
)->name('admin.authenticate');


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::middleware('admin')
    ->prefix('admin')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [AdminController::class, 'dashboard']
        )->name('admin.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Logout
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/logout',
            [AdminController::class, 'logout']
        )->name('admin.logout');


        /*
        |--------------------------------------------------------------------------
        | Doctor CRUD
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/doctors',
            [AdminDoctorController::class, 'index']
        )->name('admin.doctors.index');

        Route::get(
            '/doctors/create',
            [AdminDoctorController::class, 'create']
        )->name('admin.doctors.create');

        Route::post(
            '/doctors',
            [AdminDoctorController::class, 'store']
        )->name('admin.doctors.store');

        Route::get(
            '/doctors/{doctor}/edit',
            [AdminDoctorController::class, 'edit']
        )->name('admin.doctors.edit');

        Route::put(
            '/doctors/{doctor}',
            [AdminDoctorController::class, 'update']
        )->name('admin.doctors.update');

        Route::delete(
            '/doctors/{doctor}',
            [AdminDoctorController::class, 'destroy']
        )->name('admin.doctors.destroy');


        /*
        |--------------------------------------------------------------------------
        | Patient Records
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/patients',
            [AdminPatientController::class, 'index']
        )->name('admin.patients.index');
        Route::get(
    '/patients',
    [AdminPatientController::class, 'index']
)->name('admin.patients.index');


Route::get(
    '/patients/{patient}',
    [AdminPatientController::class, 'show']
)->name('admin.patients.show');


Route::post(
    '/patients/{patient}/status',
    [AdminPatientController::class, 'updateStatus']
)->name('admin.patients.status');


Route::delete(
    '/patients/{patient}/cancel',
    [AdminPatientController::class, 'cancel']
)->name('admin.patients.cancel');

        Route::delete(
            '/patients/{patient}/cancel',
            [AdminPatientController::class, 'cancel']
        )->name('admin.patients.cancel');

    });

    Route::view('/about', 'pages.about')
    ->name('about');

Route::view('/specialties', 'pages.specialties')
    ->name('specialties');

Route::view('/services', 'pages.services')
    ->name('services');

Route::view('/contact', 'pages.contact')
    ->name('contact');

