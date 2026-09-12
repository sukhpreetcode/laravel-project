<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PatientController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Appointment Form
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('patients.create');
    }


    /*
    |--------------------------------------------------------------------------
    | Store Appointment
    |--------------------------------------------------------------------------
    */

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

            'patient_message' =>
                'nullable|string|max:2000',
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

                    $query->where(
                        'status',
                        '!=',
                        'Cancelled'
                    );
                }

            ])

            ->orderBy('patients_count')

            ->first();


        /*
        |--------------------------------------------------------------------------
        | Fallback Doctor
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

                        $query->where(
                            'status',
                            '!=',
                            'Cancelled'
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
        | Generate Unique Token
        |--------------------------------------------------------------------------
        */

        do {

            $token =
                'SUKH-' .
                strtoupper(
                    Str::random(8)
                );

        } while (
            Patient::where(
                'appointment_token',
                $token
            )->exists()
        );


        /*
        |--------------------------------------------------------------------------
        | Create Patient
        |--------------------------------------------------------------------------
        */

        $patient = Patient::create([

            'appointment_token' =>
                $token,

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

            'patient_message' =>
                $request->patient_message,

            'admin_notes' =>
                null,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Email Patient
        |--------------------------------------------------------------------------
        */

        try {

            Mail::raw(

                "Hello {$patient->name},

Your appointment request has been received.

TOKEN NUMBER:
{$patient->appointment_token}

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

Use your token number to check your appointment status.

Thank you,
Sukh Hospital System",

                function ($message) use ($patient) {

                    $message
                        ->to($patient->email)
                        ->subject(
                            'Sukh Hospital Appointment - ' .
                            $patient->appointment_token
                        );
                }
            );

        } catch (\Throwable $e) {

            // Email fail hone par appointment delete nahi hoga.
        }


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


        try {

            Mail::raw(

                "NEW HOSPITAL APPOINTMENT

TOKEN:
{$patient->appointment_token}

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

Patient Message:
{$patient->patient_message}

Status:
Pending

Please login to the hospital admin panel.",

                function ($message) use ($adminEmail) {

                    $message
                        ->to($adminEmail)
                        ->subject(
                            'NEW APPOINTMENT - ' .
                            $patient->appointment_token
                        );
                }
            );

        } catch (\Throwable $e) {

            // Email fail hone par appointment delete nahi hoga.
        }


        return view(
            'patients.confirmation',
            compact(
                'patient',
                'doctor'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Patient Token Search Page
    |--------------------------------------------------------------------------
    */

    public function tokenPage()
    {
        return view('patients.token');
    }


    /*
    |--------------------------------------------------------------------------
    | Find Appointment By Token
    |--------------------------------------------------------------------------
    */

    public function checkToken(Request $request)
    {
        $request->validate([

            'appointment_token' =>
                'required|string|max:30',

        ]);


        $patient = Patient::with('doctor')

            ->where(
                'appointment_token',
                strtoupper(
                    trim(
                        $request->appointment_token
                    )
                )
            )

            ->first();


        if (!$patient) {

            return back()

                ->withInput()

                ->withErrors([

                    'appointment_token' =>
                        'Appointment not found. Please check your token number.'

                ]);
        }


        return view(
            'patients.status',
            compact('patient')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Patient Cancel Appointment
    |--------------------------------------------------------------------------
    */

    public function cancelByToken(Request $request)
    {
        $request->validate([

            'appointment_token' =>
                'required|string|max:30',

        ]);


        $patient = Patient::where(

            'appointment_token',

            strtoupper(
                trim(
                    $request->appointment_token
                )
            )

        )->first();


        if (!$patient) {

            return back()->withErrors([

                'appointment_token' =>
                    'Appointment not found.'

            ]);
        }


        if (
            in_array(
                $patient->status,
                [
                    'Cancelled',
                    'Completed'
                ]
            )
        ) {

            return back()->withErrors([

                'appointment_token' =>
                    'This appointment cannot be cancelled now.'

            ]);
        }


        $patient->status = 'Cancelled';

        $patient->save();


        return back()->with(
            'success',
            'Appointment cancelled successfully.'
        );
    }
}