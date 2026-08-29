@extends('layouts.app')

@section('content')

<h1>Edit Patient</h1>

<div class="card">

<form action="{{ route('patients.update', $patient) }}" method="POST">

@csrf
@method('PUT')

<label>Name</label>

<input
    type="text"
    name="name"
    value="{{ $patient->name }}"
    required
>

<label>Email</label>

<input
    type="email"
    name="email"
    value="{{ $patient->email }}"
>

<label>Phone</label>

<input
    type="text"
    name="phone"
    value="{{ $patient->phone }}"
    required
>

<label>Gender</label>

<select name="gender">

    <option {{ $patient->gender == 'Male' ? 'selected' : '' }}>
        Male
    </option>

    <option {{ $patient->gender == 'Female' ? 'selected' : '' }}>
        Female
    </option>

    <option {{ $patient->gender == 'Other' ? 'selected' : '' }}>
        Other
    </option>

</select>

<label>Date of Birth</label>

<input
    type="date"
    name="date_of_birth"
    value="{{ $patient->date_of_birth }}"
>

<label>Address</label>

<textarea name="address">{{ $patient->address }}</textarea>

<label>Doctor</label>

<select name="doctor_id">

    <option value="">Not Assigned</option>

    @foreach($doctors as $doctor)

        <option
            value="{{ $doctor->id }}"
            {{ $patient->doctor_id == $doctor->id ? 'selected' : '' }}
        >

            {{ $doctor->name }}

        </option>

    @endforeach

</select>

<button class="btn">
    Update Patient
</button>

</form>

</div>

@endsection