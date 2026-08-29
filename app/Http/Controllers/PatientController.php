<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with('doctor')->latest()->get();

        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        $doctors = Doctor::all();

        return view('patients.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        Patient::create($request->all());

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient added successfully');
    }

    public function show(Patient $patient)
    {
        $patient->load('doctor');

        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        $doctors = Doctor::all();

        return view('patients.edit', compact('patient', 'doctors'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        $patient->update($request->all());

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient updated successfully');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient deleted successfully');
    }
}