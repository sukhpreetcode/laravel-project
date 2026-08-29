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
            'specialization' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
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