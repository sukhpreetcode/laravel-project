<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PatientController extends Controller
{
    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'gender' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'appointment_at' => 'required|date|after:now',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Automatically select doctor
        |--------------------------------------------------------------------------
        */

        $doctor = Doctor::withCount([
            'patients' => function ($query) {
                $query->where('appointment_at', '>=', now());
            }
        ])
        ->orderBy('patients_count')
        ->first();

        if (!$doctor) {
            return back()
                ->withInput()
                ->withErrors([
                    'appointment_at' => 'No doctor is currently available.'
                ]);
        }

        $patient = Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'doctor_id' => $doctor->id,
            'appointment_at' => $request->appointment_at,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Send confirmation email
        |--------------------------------------------------------------------------
        */

        if ($patient->email) {
            Mail::raw(
                "Hello {$patient->name},

Your hospital appointment has been confirmed.

Doctor: {$doctor->name}
Specialization: {$doctor->specialization}
Date & Time: {$patient->appointment_at->format('d M Y, h:i A')}

Please arrive 15 minutes before your appointment.

Thank you,
Hospital Management System",
                function ($message) use ($patient) {
                    $message
                        ->to($patient->email)
                        ->subject('Appointment Confirmation');
                }
            );
        }

        return view('patients.confirmation', compact(
            'patient',
            'doctor'
        ));
    }
}