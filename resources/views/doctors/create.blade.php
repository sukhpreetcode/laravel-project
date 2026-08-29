@extends('layouts.app')

@section('content')

<h1>Add Doctor</h1>

<div class="card">

<form action="{{ route('doctors.store') }}" method="POST">

@csrf

<label>Doctor Name</label>

<input
    type="text"
    name="name"
    placeholder="Dr. Sharma"
    required
>

<label>Specialization</label>

<input
    type="text"
    name="specialization"
    placeholder="Cardiologist"
    required
>

<label>Phone</label>

<input
    type="text"
    name="phone"
    required
>

<label>Email</label>

<input
    type="email"
    name="email"
>

<button class="btn btn-success">
    Add Doctor
</button>

</form>

</div>

@endsection