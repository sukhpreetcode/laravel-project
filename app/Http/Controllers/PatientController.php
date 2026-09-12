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

            'appointment_type' =>
                'required|string|max:100',

            'service' =>
                'nullable|string|max:100',

            'body_part' =>
                'required|string|max:100',

            'symptoms' =>
                'required|string',

            'medical_history' =>
                'nullable|string',

            'operation_details' =>
                'nullable|string',

            'urgency' =>
                'required|string|max:50',

            'appointment_at' =>
                'required|date|after:now',

            'admin_notes' =>
                'nullable|string',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Find suitable doctor
        |--------------------------------------------------------------------------
        */

        $bodyPart = $request->body_part;


        $doctor = Doctor::where('is_active', true)

            ->where(function ($query) use ($bodyPart) {

                $query

                    ->where(
                        'specialist_body_part',
                        'LIKE',
                        "%{$bodyPart}%"
                    )

                    ->orWhere(
                        'specialization',
                        'LIKE',
                        "%{$bodyPart}%"
                    )

                    ->orWhere(
                        'specialist_body_part',
                        'LIKE',
                        '%Full Body%'
                    );

            })

            ->withCount([

                'patients' => function ($query) {

                    $query->where(
                        'appointment_at',
                        '>=',
                        now()
                    );

                }

            ])

            ->orderBy('patients_count')

            ->first();


        /*
        |--------------------------------------------------------------------------
        | If specialist not found, use any active doctor
        |--------------------------------------------------------------------------
        */

        if (!$doctor) {

            $doctor = Doctor::where(
                'is_active',
                true
            )

            ->withCount([

                'patients' => function ($query) {

                    $query->where(
                        'appointment_at',
                        '>=',
                        now()
                    );

                }

            ])

            ->orderBy('patients_count')

            ->first();

        }


        if (!$doctor) {

            return back()

                ->withInput()

                ->withErrors([
                    'appointment_at' =>
                        'No doctor is currently available.'
                ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Create patient appointment
        |--------------------------------------------------------------------------
        */

        $patient = Patient::create([

            'name' =>
                $request->name,

            'email' =>
                $request->email,

            'phone' =>
                $request->phone,

            'gender' =>
                $request->gender,

            'date_of_birth' =>
                $request->date_of_birth,

            'address' =>
                $request->address,

            'doctor_id' =>
                $doctor->id,

            'appointment_at' =>
                $request->appointment_at,

            'appointment_type' =>
                $request->appointment_type,

            'service' =>
                $request->service,

            'body_part' =>
                $request->body_part,

            'symptoms' =>
                $request->symptoms,

            'medical_history' =>
                $request->medical_history,

            'operation_details' =>
                $request->operation_details,

            'urgency' =>
                $request->urgency,

            'status' =>
                'Pending',

            'admin_notes' =>
                $request->admin_notes,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Email Patient
        |--------------------------------------------------------------------------
        */

        Mail::raw(

            "Hello {$patient->name},

Your appointment request has been received.

Appointment Type:
{$patient->appointment_type}

Body Part:
{$patient->body_part}

Service:
{$patient->service}

Doctor:
{$doctor->name}

Specialization:
{$doctor->specialization}

Appointment:
{$patient->appointment_at->format('d M Y, h:i A')}

Status:
Pending

Our hospital team will review your appointment.

Thank you,
Sukh Hospital System",

            function ($message) use ($patient) {

                $message
                    ->to($patient->email)
                    ->subject(
                        'Appointment Request Received'
                    );

            }

        );


        /*
        |--------------------------------------------------------------------------
        | Email Hospital Admin
        |--------------------------------------------------------------------------
        */

        $adminEmail =
            env(
                'HOSPITAL_ADMIN_EMAIL',
                'admin@example.com'
            );


        Mail::raw(

            "NEW HOSPITAL APPOINTMENT

Patient:
{$patient->name}

Email:
{$patient->email}

Phone:
{$patient->phone}

Gender:
{$patient->gender}

Appointment Type:
{$patient->appointment_type}

Service:
{$patient->service}

Body Part:
{$patient->body_part}

Symptoms:
{$patient->symptoms}

Medical History:
{$patient->medical_history}

Operation Details:
{$patient->operation_details}

Urgency:
{$patient->urgency}

Appointment Date:
{$patient->appointment_at->format('d M Y, h:i A')}

Assigned Doctor:
{$doctor->name}

Doctor Specialization:
{$doctor->specialization}

Status:
Pending

Please login to the hospital admin panel
to review this appointment.",

            function ($message) use ($adminEmail) {

                $message
                    ->to($adminEmail)
                    ->subject(
                        'NEW HOSPITAL APPOINTMENT'
                    );

            }

        );


        return view(
            'patients.confirmation',
            compact(
                'patient',
                'doctor'
            )
        );
    }
}