@extends('layouts.app')

@section('content')

<h1>Doctor - Patient Assignment</h1>

<div class="card">

<h3>Doctor handles patients through the Patient section.</h3>

<p>
When adding or editing a patient, select the doctor responsible
for that patient.
</p>

<br>

<a class="btn" href="{{ route('patients.index') }}">
Manage Patients
</a>

</div>

@endsection