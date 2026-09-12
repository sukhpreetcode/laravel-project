<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class AdminDoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::withCount('patients')
            ->latest()
            ->get();

        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([

    'name' => 'required|string|max:100',

    'email' => 'nullable|email',

    'phone' => 'required|string|max:20',

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

        Doctor::create($request->only([
            'name',
            'specialization',
            'phone',
            'email',
        ]));

        return redirect()
            ->route('admin.doctors.index')
            ->with('success', 'Doctor added successfully.');
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'specialization' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
        ]);

        $doctor->update($request->only([
            'name',
            'specialization',
            'phone',
            'email',
        ]));

        return redirect()
            ->route('admin.doctors.index')
            ->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->patients()->exists()) {

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