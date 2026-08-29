@extends('layouts.app')

@section('content')

<h1>Add Patient</h1>

<div class="card">

<form action="{{ route('patients.store') }}" method="POST">

@csrf

<label>Name</label>
<input type="text" name="name" required>

<label>Email</label>
<input type="email" name="email">

<label>Phone</label>
<input type="text" name="phone" required>

<label>Gender</label>

<select name="gender">
    <option value="">Select Gender</option>
    <option>Male</option>
    <option>Female</option>
    <option>Other</option>
</select>

<label>Date of Birth</label>
<input type="date" name="date_of_birth">

<label>Address</label>
<textarea name="address"></textarea>

<label>Assign Doctor</label>

<select name="doctor_id">

    <option value="">Not Assigned</option>

    @foreach($doctors as $doctor)

        <option value="{{ $doctor->id }}">
            {{ $doctor->name }} - {{ $doctor->specialization }}
        </option>

    @endforeach

</select>

<button class="btn btn-success">
    Save Patient
</button>

</form>

</div>

@endsection