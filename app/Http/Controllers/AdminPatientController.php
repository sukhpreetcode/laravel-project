<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AdminPatientController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Patient Records + Search + Filters
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Patient::with('doctor');


        /*
        |--------------------------------------------------------------------------
        | Search Name / Token / Phone
        |--------------------------------------------------------------------------
        */

        $query->when(
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
        | Status Filter
        |--------------------------------------------------------------------------
        */

        $query->when(
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
        | Doctor Filter
        |--------------------------------------------------------------------------
        */

        $query->when(
            $request->filled('doctor_id'),
            function ($query) use ($request) {

                $query->where(
                    'doctor_id',
                    $request->doctor_id
                );
            }
        );


        /*
        |--------------------------------------------------------------------------
        | From Date
        |--------------------------------------------------------------------------
        */

        $query->when(
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

        $query->when(
            $request->filled('to_date'),
            function ($query) use ($request) {

                $query->whereDate(
                    'appointment_at',
                    '<=',
                    $request->to_date
                );
            }
        );


        $patients = $query

            ->orderBy(
                'appointment_at',
                'desc'
            )

            ->paginate(15)

            ->withQueryString();


        $doctors = Doctor::orderBy('name')
            ->get();


        return view(
            'admin.patients.index',
            compact(
                'patients',
                'doctors'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Patient Detailed Page
    |--------------------------------------------------------------------------
    */

    public function show(Patient $patient)
    {
        $patient->load('doctor');

        return view(
            'admin.patients.show',
            compact('patient')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Status
    |--------------------------------------------------------------------------
    */

    public function updateStatus(
        Request $request,
        Patient $patient
    ) {

        $request->validate([

            'status' =>
                'required|in:Pending,Confirmed,Cancelled,Completed',

            'admin_notes' =>
                'nullable|string|max:2000',

        ]);


        $patient->status =
            $request->status;


        if ($request->filled('admin_notes')) {

            $patient->admin_notes =
                $request->admin_notes;
        }


        $patient->save();


        return back()->with(
            'success',
            'Patient appointment updated successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Old Cancel Route - Keep Safe
    |--------------------------------------------------------------------------
    */

    public function cancel(Patient $patient)
    {
        $patient->status =
            'Cancelled';

        $patient->save();


        return redirect()

            ->route(
                'admin.patients.index'
            )

            ->with(
                'success',
                'Appointment cancelled successfully.'
            );
    }
}