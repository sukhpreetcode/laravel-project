@extends('layouts.app')

@section('title', 'Appointment Confirmation')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-5 text-center">

                    <div style="font-size:70px;">
                        ✅
                    </div>

                    <h1 class="fw-bold text-success">
                        Appointment Request Received
                    </h1>

                    <p class="text-muted">
                        Your appointment request has been successfully submitted.
                    </p>


                    {{-- TOKEN --}}

                    <div class="alert alert-primary rounded-4 my-4">

                        <small class="text-muted">
                            YOUR APPOINTMENT TOKEN
                        </small>

                        <h2 class="fw-bold mb-1">
                            {{ $patient->appointment_token }}
                        </h2>

                        <small>
                            Save this token to check your appointment status.
                        </small>

                    </div>


                    <div class="text-start">

                        <h5 class="fw-bold mb-3">
                            Appointment Details
                        </h5>

                        <p>
                            <strong>Patient:</strong>
                            {{ $patient->name }}
                        </p>

                        <p>
                            <strong>Doctor:</strong>
                            Dr. {{ $doctor->name }}
                        </p>

                        <p>
                            <strong>Specialization:</strong>
                            {{ $doctor->specialization }}
                        </p>

                        <p>
                            <strong>Appointment Type:</strong>
                            {{ $patient->appointment_type }}
                        </p>

                        <p>
                            <strong>Service:</strong>
                            {{ $patient->service ?? 'Not specified' }}
                        </p>

                        <p>
                            <strong>Body Part:</strong>
                            {{ $patient->body_part }}
                        </p>

                        <p>
                            <strong>Date:</strong>
                            {{ $patient->appointment_at->format('d M Y') }}
                        </p>

                        <p>
                            <strong>Time:</strong>
                            {{ $patient->appointment_at->format('h:i A') }}
                        </p>

                        <p>
                            <strong>Status:</strong>

                            <span class="badge bg-warning text-dark">
                                {{ $patient->status }}
                            </span>

                        </p>

                    </div>


                    @if($patient->patient_message)

                        <div class="alert alert-light border text-start mt-4">

                            <strong>
                                Your Message:
                            </strong>

                            <p class="mb-0 mt-2">
                                {{ $patient->patient_message }}
                            </p>

                        </div>

                    @endif


                    <div class="alert alert-info mt-4">

                        📧 Appointment details have been sent to your email.

                    </div>


                    <div class="d-flex gap-2 justify-content-center flex-wrap">

                        <a
                            href="{{ route('patients.token') }}"
                            class="btn btn-primary"
                        >
                            Check Appointment
                        </a>

                        <a
                            href="{{ route('dashboard') }}"
                            class="btn btn-outline-secondary"
                        >
                            Back to Home
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection