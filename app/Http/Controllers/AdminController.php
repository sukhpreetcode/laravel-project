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


            return redirect()->route(
                'admin.dashboard'
            );
        }


        return back()->withErrors([

            'username' =>
                'Invalid admin username or password.'

        ]);
    }


    public function dashboard(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Dashboard Patient Query
        |--------------------------------------------------------------------------
        */

        $patientQuery =
            Patient::with('doctor');


        /*
        |--------------------------------------------------------------------------
        | Search Name / Token / Phone
        |--------------------------------------------------------------------------
        */

        $patientQuery->when(

            $request->filled('search'),

            function ($query) use ($request) {

                $search =
                    trim($request->search);


                $query->where(function ($q) use ($search) {

                    $q->where(
                        'name',
                        'LIKE',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'appointment_token',
                        'LIKE',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'phone',
                        'LIKE',
                        "%{$search}%"
                    );

                });

            }

        );


        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        $patientQuery->when(

            $request->filled('status'),

            function ($query) use ($request) {

                $query->where(
                    'status',
                    $request->status
                );

            }

        );


        /*
        |--------------------------------------------------------------------------
        | From Date
        |--------------------------------------------------------------------------
        */

        $patientQuery->when(

            $request->filled('from_date'),

            function ($query) use ($request) {

                $query->whereDate(
                    'appointment_at',
                    '>=',
                    $request->from_date
                );

            }

        );


        /*
        |--------------------------------------------------------------------------
        | To Date
        |--------------------------------------------------------------------------
        */

        $patientQuery->when(

            $request->filled('to_date'),

            function ($query) use ($request) {

                $query->whereDate(
                    'appointment_at',
                    '<=',
                    $request->to_date
                );

            }

        );


        /*
        |--------------------------------------------------------------------------
        | Latest 4 Matching Patients
        |--------------------------------------------------------------------------
        */

        $patients =
            $patientQuery

                ->orderBy(
                    'appointment_at',
                    'desc'
                )

                ->take(4)

                ->get();


        /*
        |--------------------------------------------------------------------------
        | Doctors
        |--------------------------------------------------------------------------
        */

        $doctors = Doctor::withCount(
            'patients'
        )

            ->orderBy('name')

            ->get();


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalPatients =
            Patient::count();


        $totalDoctors =
            Doctor::count();


        $todayAppointments =
            Patient::whereDate(
                'appointment_at',
                today()
            )->count();


        $upcomingAppointments =
            Patient::where(
                'appointment_at',
                '>=',
                now()
            )

            ->where(
                'status',
                '!=',
                'Cancelled'
            )

            ->count();


        return view(

            'admin.dashboard',

            compact(

                'patients',

                'doctors',

                'totalPatients',

                'totalDoctors',

                'todayAppointments',

                'upcomingAppointments'

            )

        );
    }


    public function logout()
    {
        session()->forget([

            'admin_logged_in',

            'admin_name'

        ]);


        return redirect()->route(
            'admin.login'
        );
    }
}