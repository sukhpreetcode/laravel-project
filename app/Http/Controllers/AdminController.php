<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
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
        $patients = Patient::with('doctor')
            ->latest()
            ->get();

        $doctors = Doctor::withCount('patients')->get();

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