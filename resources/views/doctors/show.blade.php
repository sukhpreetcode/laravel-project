@extends('layouts.app')

@section('content')

<h1>Doctor Details</h1>

<div class="card">

<h2>{{ $doctor->name }}</h2>

<br>

<p>
    <b>Specialization:</b>
    {{ $doctor->specialization }}
</p>

<p>
    <b>Phone:</b>
    {{ $doctor->phone }}
</p>

<p>
    <b>Email:</b>
    {{ $doctor->email }}
</p>

<br>

<h3>Patients handled by this doctor</h3>

<br>

@if($doctor->patients->count())

    @foreach($doctor->patients as $patient)

        <p>
            🧑 {{ $patient->name }}
        </p>

    @endforeach

@else

    <p>No patients assigned.</p>

@endif

<br>

<a class="btn" href="{{ route('doctors.index') }}">
    Back
</a>

</div>

@endsection