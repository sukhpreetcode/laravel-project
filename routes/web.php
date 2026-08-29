<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PatientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDoctorController;


/*
|--------------------------------------------------------------------------
| Public Website
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');


/*
|--------------------------------------------------------------------------
| Patient Appointment
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


/*
|--------------------------------------------------------------------------
| Admin Login
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
| Protected Admin Panel
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->prefix('admin')->group(function () {

    Route::get(
        '/dashboard',
        [AdminController::class, 'dashboard']
    )->name('admin.dashboard');

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
});