@extends('layouts.app')

@section('content')

<div class="container py-5">

<div class="text-center mb-5">

<h1 class="fw-bold">
Hospital Services
</h1>

<p class="text-muted">
Explore the services available through our hospital system.
</p>

</div>


<div class="row g-4">


@foreach([

'General Consultation',

'Full Body Health Checkup',

'Blood Testing',

'X-Ray',

'Ultrasound',

'CT Scan',

'MRI',

'Physiotherapy',

'Eye Checkup',

'Dental Services',

'Surgical Consultation',

'Emergency Care',

] as $service)

<div class="col-md-4">

<div class="card border-0 shadow-sm rounded-4 h-100">

<div class="card-body p-4">

<h4>
{{ $service }}
</h4>

<p class="text-muted">

Our hospital team provides professional
support and consultation for this service.

</p>

<a
href="{{ route('patients.create') }}"
class="btn btn-primary"
>

Book Now

</a>

</div>

</div>

</div>

@endforeach

</div>

</div>

@endsection