@extends('layouts.app')

@section('content')

<h1>Hospital Dashboard</h1>

<p style="margin:10px 0 25px;">
    Welcome to MediCare Hospital Management System
</p>

<div class="cards">

    <div class="stat">
        <p>👨‍⚕️ Doctors</p>
        <h1>10</h1>
    </div>

    <div class="stat">
        <p>🧑 Patients</p>
        <h1>50</h1>
    </div>

    <div class="stat">
        <p>📅 Appointments</p>
        <h1>15</h1>
    </div>

    <div class="stat">
        <p>🏥 Departments</p>
        <h1>6</h1>
    </div>

</div>

<br>

<div class="card">

    <h2>Quick Actions</h2>

    <br>

    <a class="btn" href="{{ route('patients.create') }}">
        Add Patient
    </a>

    <a class="btn btn-success" href="{{ route('doctors.create') }}">
        Add Doctor
    </a>

</div>

@endsection