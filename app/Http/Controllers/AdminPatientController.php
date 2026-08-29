<?php

namespace App\Http\Controllers;

use App\Models\Patient;

class AdminPatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with('doctor')
            ->orderBy('appointment_at', 'asc')
            ->get();

        return view('admin.patients.index', compact('patients'));
    }

    public function cancel(Patient $patient)
    {
        $patient->delete();

        return redirect()
            ->route('admin.patients.index')
            ->with('success', 'Appointment cancelled successfully.');
    }
}