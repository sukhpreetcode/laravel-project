@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-5 text-center">

                    <div style="font-size:70px;">
                        ✅
                    </div>

                    <h1 class="fw-bold text-success">
                        Appointment Confirmed
                    </h1>

                    <p class="text-muted">
                        Your appointment has been successfully booked.
                    </p>

                    <hr>

                    <div class="text-start">

                        <p>
                            <strong>Patient:</strong>
                            {{ $patient->name }}
                        </p>

                        <p>
                            <strong>Doctor:</strong>
                            {{ $doctor->name }}
                        </p>

                        <p>
                            <strong>Specialization:</strong>
                            {{ $doctor->specialization }}
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
                            <strong>Email:</strong>
                            {{ $patient->email }}
                        </p>

                    </div>

                    <div class="alert alert-info">

                        📧 Appointment details have been sent to your email.

                    </div>

                    <a
                        href="{{ route('dashboard') }}"
                        class="btn btn-primary"
                    >
                        Back to Home
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection