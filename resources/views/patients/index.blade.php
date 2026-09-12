@extends('layouts.app')

@section('content')

<div class="container py-5">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h1 class="fw-bold">
Patient Records
</h1>

<p class="text-muted">
Manage hospital appointments and patient information.
</p>

</div>

<a
    href="{{ route('patients.create') }}"
    class="btn btn-primary"
>

+ New Appointment

</a>

</div>


<div class="card border-0 shadow-sm rounded-4">

<div class="card-body">

<div class="table-responsive">

<table class="table align-middle">

<thead>

<tr>

<th>Patient</th>

<th>Contact</th>

<th>Appointment</th>

<th>Body Part</th>

<th>Doctor</th>

<th>Status</th>

<th>Action</th>

</tr>

</thead>


<tbody>

@forelse($patients as $patient)

<tr>

<td>

<strong>
{{ $patient->name }}
</strong>

<br>

<small class="text-muted">

{{ $patient->appointment_type }}

</small>

</td>


<td>

{{ $patient->phone }}

<br>

<small>
{{ $patient->email }}
</small>

</td>


<td>

{{ $patient->appointment_at
    ? $patient->appointment_at->format('d M Y')
    : '-' }}

<br>

<small>

{{ $patient->appointment_at
    ? $patient->appointment_at->format('h:i A')
    : '-' }}

</small>

</td>


<td>

<span class="badge bg-light text-dark">

{{ $patient->body_part }}

</span>

</td>


<td>

{{ $patient->doctor->name ?? 'Not Assigned' }}

<br>

<small class="text-muted">

{{ $patient->doctor->specialization ?? '' }}

</small>

</td>


<td>

@if($patient->status === 'Approved')

<span class="badge bg-success">
Approved
</span>

@elseif($patient->status === 'Cancelled')

<span class="badge bg-danger">
Cancelled
</span>

@elseif($patient->status === 'Completed')

<span class="badge bg-primary">
Completed
</span>

@else

<span class="badge bg-warning text-dark">
Pending
</span>

@endif

</td>


<td>

<a
    href="{{ route('patients.show', $patient) }}"
    class="btn btn-sm btn-outline-primary"
>

View

</a>

</td>

</tr>

@empty

<tr>

<td
    colspan="7"
    class="text-center py-5"
>

No appointments found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

</div>

@endsection