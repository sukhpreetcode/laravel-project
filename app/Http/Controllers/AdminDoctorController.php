<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class AdminDoctorController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Doctor List + Search + Filters
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Doctor::withCount(
            'patients'
        );


        /*
        |--------------------------------------------------------------------------
        | Search Doctor Name
        |--------------------------------------------------------------------------
        */

        $query->when(

            $request->filled('search'),

            function ($query) use ($request) {

                $search =
                    trim($request->search);

                $query->where(
                    'name',
                    'LIKE',
                    "%{$search}%"
                );
            }

        );


        /*
        |--------------------------------------------------------------------------
        | Specialization
        |--------------------------------------------------------------------------
        */

        $query->when(

            $request->filled('specialization'),

            function ($query) use ($request) {

                $query->where(
                    'specialization',
                    $request->specialization
                );
            }

        );


        /*
        |--------------------------------------------------------------------------
        | Education / Qualification
        |--------------------------------------------------------------------------
        */

        $query->when(

            $request->filled('qualification'),

            function ($query) use ($request) {

                $query->where(
                    'qualification',
                    'LIKE',
                    '%' .
                    $request->qualification .
                    '%'
                );
            }

        );


        $doctors =
            $query

                ->orderBy('name')

                ->paginate(12)

                ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Filter Options
        |--------------------------------------------------------------------------
        */

        $specializations =
            Doctor::whereNotNull(
                'specialization'
            )

                ->where(
                    'specialization',
                    '!=',
                    ''
                )

                ->distinct()

                ->orderBy(
                    'specialization'
                )

                ->pluck(
                    'specialization'
                );


        $qualifications =
            Doctor::whereNotNull(
                'qualification'
            )

                ->where(
                    'qualification',
                    '!=',
                    ''
                )

                ->distinct()

                ->orderBy(
                    'qualification'
                )

                ->pluck(
                    'qualification'
                );


        return view(

            'admin.doctors.index',

            compact(

                'doctors',

                'specializations',

                'qualifications'

            )

        );
    }


    public function create()
    {
        return view(
            'admin.doctors.create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store Doctor
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'name' =>
                'required|string|max:100',

            'email' =>
                'nullable|email',

            'phone' =>
                'required|string|max:20',

            'specialization' =>
                'required|string|max:100',

            'qualification' =>
                'nullable|string|max:150',

            'experience' =>
                'nullable|string|max:100',

            'specialist_body_part' =>
                'nullable|string|max:100',

            'bio' =>
                'nullable|string',

            'available_days' =>
                'nullable|string|max:200',

            'available_from' =>
                'nullable',

            'available_to' =>
                'nullable',

            'consultation_fee' =>
                'nullable|numeric|min:0',

        ]);


        Doctor::create([

            'name' =>
                $request->name,

            'email' =>
                $request->email,

            'phone' =>
                $request->phone,

            'specialization' =>
                $request->specialization,

            'qualification' =>
                $request->qualification,

            'experience' =>
                $request->experience,

            'specialist_body_part' =>
                $request->specialist_body_part,

            'bio' =>
                $request->bio,

            'available_days' =>
                $request->available_days,

            'available_from' =>
                $request->available_from,

            'available_to' =>
                $request->available_to,

            'consultation_fee' =>
                $request->consultation_fee,

            'is_active' =>
                $request->has('is_active'),

        ]);


        return redirect()

            ->route(
                'admin.doctors.index'
            )

            ->with(
                'success',
                'Doctor added successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(Doctor $doctor)
    {
        return view(

            'admin.doctors.edit',

            compact('doctor')

        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Doctor $doctor
    ) {

        $request->validate([

            'name' =>
                'required|string|max:100',

            'specialization' =>
                'required|string|max:100',

            'phone' =>
                'required|string|max:20',

            'email' =>
                'nullable|email',

            'qualification' =>
                'nullable|string|max:150',

            'experience' =>
                'nullable|string|max:100',

            'specialist_body_part' =>
                'nullable|string|max:100',

            'bio' =>
                'nullable|string',

            'available_days' =>
                'nullable|string|max:200',

            'available_from' =>
                'nullable',

            'available_to' =>
                'nullable',

            'consultation_fee' =>
                'nullable|numeric|min:0',

        ]);


        $doctor->update([

            'name' =>
                $request->name,

            'specialization' =>
                $request->specialization,

            'phone' =>
                $request->phone,

            'email' =>
                $request->email,

            'qualification' =>
                $request->qualification,

            'experience' =>
                $request->experience,

            'specialist_body_part' =>
                $request->specialist_body_part,

            'bio' =>
                $request->bio,

            'available_days' =>
                $request->available_days,

            'available_from' =>
                $request->available_from,

            'available_to' =>
                $request->available_to,

            'consultation_fee' =>
                $request->consultation_fee,

            'is_active' =>
                $request->has('is_active'),

        ]);


        return redirect()

            ->route(
                'admin.doctors.index'
            )

            ->with(
                'success',
                'Doctor updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy(Doctor $doctor)
    {
        if (
            $doctor
                ->patients()
                ->exists()
        ) {

            return back()->withErrors([

                'doctor' =>
                    'This doctor has patients assigned. Reassign patients before deleting.'

            ]);
        }


        $doctor->delete();


        return back()->with(
            'success',
            'Doctor deleted successfully.'
        );
    }
}