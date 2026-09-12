@extends('layouts.app')

@section('content')

<div class="container py-5">

<div class="text-center mb-5">

<h1 class="fw-bold">
Our Specialties
</h1>

<p class="text-muted">
Specialist care for different health requirements.
</p>

</div>


<div class="row g-4">


@php

$specialties = [

'Cardiology' =>
'Heart and cardiovascular care',

'Neurology' =>
'Brain and nervous system care',

'Orthopedics' =>
'Bones, joints and spine',

'Dermatology' =>
'Skin, hair and related conditions',

'Ophthalmology' =>
'Eye examination and treatment',

'ENT' =>
'Ear, nose and throat care',

'Gastroenterology' =>
'Digestive system and stomach care',

'Nephrology' =>
'Kidney and urinary system care',

'General Surgery' =>
'Surgical consultation and procedures',

'Gynecology' =>
'Women’s health services',

'Pediatrics' =>
'Healthcare for children',

'Dentistry' =>
'Dental and oral healthcare',

];

@endphp


@foreach($specialties as $name => $description)

<div class="col-md-4">

<div class="card border-0 shadow-sm rounded-4 h-100">

<div class="card-body p-4">

<h4 class="fw-bold">
{{ $name }}
</h4>

<p class="text-muted">
{{ $description }}
</p>

<a
    href="{{ route('patients.create') }}"
    class="btn btn-outline-primary"
>

Book Appointment

</a>

</div>

</div>

</div>

@endforeach

</div>

</div>

@endsection