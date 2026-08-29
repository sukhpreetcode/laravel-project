<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::withCount('patients')->get();

        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'specialization' => 'required',
            'phone' => 'required',
        ]);

        Doctor::create($request->all());

        return redirect()
            ->route('doctors.index')
            ->with('success', 'Doctor added successfully');
    }

    public function show(Doctor $doctor)
    {
        $doctor->load('patients');

        return view('doctors.show', compact('doctor'));
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return redirect()
            ->route('doctors.index')
            ->with('success', 'Doctor deleted successfully');
    }
}