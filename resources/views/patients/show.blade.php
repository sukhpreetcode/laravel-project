@extends('layouts.app')

@section('content')

<div class="container py-5">

<div class="row g-4">


<div class="col-lg-8">

<div class="card border-0 shadow-sm rounded-4">

<div class="card-body p-4">

<h2 class="fw-bold">
{{ $patient->name }}
</h2>

<p class="text-muted">
Patient Appointment Details
</p>


<hr>


<h5 class="fw-bold mt-4">
Patient Information
</h5>

<div class="row g-3">

<div class="col-md-6">

<strong>Email</strong>

<p>
{{ $patient->email }}
</p>

</div>


<div class="col-md-6">

<strong>Phone</strong>

<p>
{{ $patient->phone }}
</p>

</div>


<div class="col-md-6">

<strong>Gender</strong>

<p>
{{ $patient->gender ?? '-' }}
</p>

</div>


<div class="col-md-6">

<strong>Date of Birth</strong>

<p>
{{ $patient->date_of_birth
    ? $patient->date_of_birth->format('d M Y')
    : '-' }}
</p>

</div>

</div>


<hr>


<h5 class="fw-bold">
Appointment Information
</h5>

<div class="row g-3">

<div class="col-md-6">

<strong>Appointment Type</strong>

<p>
{{ $patient->appointment_type }}
</p>

</div>


<div class="col-md-6">

<strong>Body Part</strong>

<p>
{{ $patient->body_part }}
</p>

</div>


<div class="col-md-6">

<strong>Service</strong>

<p>
{{ $patient->service ?? '-' }}
</p>

</div>


<div class="col-md-6">

<strong>Urgency</strong>

<p>
{{ $patient->urgency }}
</p>

</div>


<div class="col-md-6">

<strong>Date & Time</strong>

<p>

{{ $patient->appointment_at
    ? $patient->appointment_at->format('d M Y, h:i A')
    : '-' }}

</p>

</div>


<div class="col-md-6">

<strong>Status</strong>

<p>
{{ $patient->status }}
</p>

</div>

</div>


<hr>


<h5 class="fw-bold">
Medical Information
</h5>


<strong>Symptoms / Problem</strong>

<p class="bg-light p-3 rounded">

{{ $patient->symptoms }}

</p>


<strong>Medical History</strong>

<p class="bg-light p-3 rounded">

{{ $patient->medical_history ?? 'Not provided' }}

</p>


<strong>Operation Details</strong>

<p class="bg-light p-3 rounded">

{{ $patient->operation_details ?? 'Not provided' }}

</p>

</div>

</div>

</div>


<div class="col-lg-4">

<div class="card border-0 shadow-sm rounded-4">

<div class="card-body p-4">

<h5 class="fw-bold">
Assigned Doctor
</h5>


@if($patient->doctor)

<h4 class="mt-3">
{{ $patient->doctor->name }}
</h4>

<p>

{{ $patient->doctor->specialization }}

</p>


<p>

<strong>Qualification:</strong><br>

{{ $patient->doctor->qualification ?? '-' }}

</p>


<p>

<strong>Experience:</strong><br>

{{ $patient->doctor->experience ?? '-' }}

</p>


<p>

<strong>Specialist:</strong><br>

{{ $patient->doctor->specialist_body_part ?? '-' }}

</p>

@else

<p>
Doctor not assigned.
</p>

@endif

</div>

</div>


<div class="card border-0 shadow-sm rounded-4 mt-4">

<div class="card-body p-4">

<h5 class="fw-bold">
Appointment Status
</h5>

<form
    method="POST"
    action="{{ route('patients.update', $patient) }}"
>

@csrf

@method('PUT')


<select
    name="status"
    class="form-select mb-3"
>

<option
    value="Pending"
    {{ $patient->status == 'Pending'
        ? 'selected'
        : '' }}
>
Pending
</option>

<option
    value="Approved"
    {{ $patient->status == 'Approved'
        ? 'selected'
        : '' }}
>
Approved
</option>

<option
    value="Completed"
    {{ $patient->status == 'Completed'
        ? 'selected'
        : '' }}
>
Completed
</option>

<option
    value="Cancelled"
    {{ $patient->status == 'Cancelled'
        ? 'selected'
        : '' }}
>
Cancelled
</option>

</select>


<button
    class="btn btn-primary w-100"
>

Update Status

</button>

</form>

</div>

</div>

</div>

</div>

</div>

@endsection