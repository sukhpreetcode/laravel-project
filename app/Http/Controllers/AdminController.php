<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (
            $request->username === 'sukh' &&
            $request->password === 'sukhpreet'
        ) {
            session([
                'admin_logged_in' => true,
                'admin_name' => 'Sukh'
            ]);

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'username' => 'Invalid admin username or password.'
        ]);
    }

    public function dashboard()
    {
        /*
        |--------------------------------------------------------------------------
        | Only latest 4 patient records
        |--------------------------------------------------------------------------
        */

        $patients = Patient::with('doctor')
            ->orderBy('appointment_at', 'desc')
            ->take(4)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | All doctors for dashboard display
        |--------------------------------------------------------------------------
        */

        $doctors = Doctor::withCount('patients')
            ->orderBy('name')
            ->get();

        $totalPatients = Patient::count();

        $totalDoctors = Doctor::count();

        $todayAppointments = Patient::whereDate(
            'appointment_at',
            today()
        )->count();

        $upcomingAppointments = Patient::where(
            'appointment_at',
            '>=',
            now()
        )->count();

        return view('admin.dashboard', compact(
            'patients',
            'doctors',
            'totalPatients',
            'totalDoctors',
            'todayAppointments',
            'upcomingAppointments'
        ));
    }

    public function logout()
    {
        session()->forget([
            'admin_logged_in',
            'admin_name'
        ]);

        return redirect()->route('admin.login');
    }
}