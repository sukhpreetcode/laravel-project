@extends('layouts.app')

@section('content')

<div class="container py-5">

<div class="text-center mb-5">

<h1 class="fw-bold">
Contact Sukh Hospital System
</h1>

<p class="text-muted">
Our hospital team is here to help.
</p>

</div>


<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card border-0 shadow-sm rounded-4">

<div class="card-body p-5">

<h4>
Hospital Information
</h4>

<hr>

<p>
<strong>Hospital:</strong>
Sukh Hospital System
</p>

<p>
<strong>Location:</strong>
Jalandhar, Punjab, India
</p>

<p>
<strong>Email:</strong>
{{ env('HOSPITAL_ADMIN_EMAIL') }}
</p>

<p>
<strong>Emergency:</strong>
Contact your local emergency medical service
for urgent emergencies.
</p>

<a
href="{{ route('patients.create') }}"
class="btn btn-primary mt-3"
>

Book an Appointment

</a>

</div>

</div>

</div>

</div>

</div>

@endsection