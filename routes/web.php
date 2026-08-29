<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');


/*
|--------------------------------------------------------------------------
| Patient Routes
|--------------------------------------------------------------------------
*/

Route::resource('patients', PatientController::class);


/*
|--------------------------------------------------------------------------
| Doctor Routes
|--------------------------------------------------------------------------
*/

Route::get('/doctors', [DoctorController::class, 'index'])
    ->name('doctors.index');

Route::get('/doctors/create', [DoctorController::class, 'create'])
    ->name('doctors.create');

Route::post('/doctors', [DoctorController::class, 'store'])
    ->name('doctors.store');

Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])
    ->name('doctors.show');

Route::delete('/doctors/{doctor}', [DoctorController::class, 'destroy'])
    ->name('doctors.destroy');


/*
|--------------------------------------------------------------------------
| Extra Pages
|--------------------------------------------------------------------------
*/

Route::view('/appointments', 'appointments')->name('appointments');

Route::view('/departments', 'departments')->name('departments');

Route::view('/assignments', 'assignments')->name('assignments');

Route::view('/reports', 'reports')->name('reports');

Route::view('/hospital', 'hospital')->name('hospital');

Route::view('/contact', 'contact')->name('contact');

Route::view('/about', 'about')->name('about');

Route::view('/settings', 'settings')->name('settings');