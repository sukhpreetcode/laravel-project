@extends('layouts.app')

@section('content')

<h1>Patient Details</h1>

<div class="card">

<h2>{{ $patient->name }}</h2>

<br>

<p><b>Email:</b> {{ $patient->email }}</p>

<p><b>Phone:</b> {{ $patient->phone }}</p>

<p><b>Gender:</b> {{ $patient->gender }}</p>

<p><b>Date of Birth:</b> {{ $patient->date_of_birth }}</p>

<p><b>Address:</b> {{ $patient->address }}</p>

<p>
    <b>Doctor:</b>

    {{ $patient->doctor->name ?? 'Not Assigned' }}

</p>

<br>

<a class="btn"
   href="{{ route('patients.edit', $patient) }}">
   Edit Patient
</a>

<a class="btn"
   href="{{ route('patients.index') }}">
   Back
</a>

</div>

@endsection