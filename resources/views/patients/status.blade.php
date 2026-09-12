@extends('layouts.app')

@section('title', 'Appointment Status')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-9">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-5">


                    <div class="text-center mb-4">

                        <small class="text-muted">
                            APPOINTMENT TOKEN
                        </small>

                        <h2 class="fw-bold text-primary">
                            {{ $patient->appointment_token }}
                        </h2>

                    </div>


                    {{-- STATUS --}}

                    <div class="text-center mb-4">

                        @if($patient->status === 'Pending')

                            <span class="badge bg-warning text-dark fs-6 p-2">
                                Pending
                            </span>

                        @elseif($patient->status === 'Confirmed')

                            <span class="badge bg-success fs-6 p-2">
                                Confirmed
                            </span>

                        @elseif($patient->status === 'Cancelled')

                            <span class="badge bg-danger fs-6 p-2">
                                Cancelled
                            </span>

                        @else

                            <span class="badge bg-secondary fs-6 p-2">
                                Completed
                            </span>

                        @endif

                    </div>


                    <hr>


                    <h4 class="fw-bold">
                        Patient Details
                    </h4>


                    <div class="row mt-3">

                        <div class="col-md-6 mb-3">

                            <strong>Name</strong>

                            <div>
                                {{ $patient->name }}
                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Phone</strong>

                            <div>
                                {{ $patient->phone }}
                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Email</strong>

                            <div>
                                {{ $patient->email }}
                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Gender</strong>

                            <div>
                                {{ $patient->gender ?? '-' }}
                            </div>

                        </div>

                    </div>


                    <hr>


                    <h4 class="fw-bold">
                        Appointment Details
                    </h4>


                    <div class="row mt-3">

                        <div class="col-md-6 mb-3">

                            <strong>Doctor</strong>

                            <div>

                                @if($patient->doctor)

                                    Dr. {{ $patient->doctor->name }}

                                @else

                                    Not Assigned

                                @endif

                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Specialization</strong>

                            <div>

                                {{ $patient->doctor->specialization ?? '-' }}

                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Appointment Type</strong>

                            <div>
                                {{ $patient->appointment_type }}
                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Service</strong>

                            <div>
                                {{ $patient->service ?? '-' }}
                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Body Part</strong>

                            <div>
                                {{ $patient->body_part }}
                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Urgency</strong>

                            <div>
                                {{ $patient->urgency }}
                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Date</strong>

                            <div>

                                {{ $patient->appointment_at
                                    ? $patient->appointment_at->format('d M Y')
                                    : '-'
                                }}

                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Time</strong>

                            <div>

                                {{ $patient->appointment_at
                                    ? $patient->appointment_at->format('h:i A')
                                    : '-'
                                }}

                            </div>

                        </div>

                    </div>


                    @if($patient->patient_message)

                        <hr>

                        <div class="alert alert-light border">

                            <h5 class="fw-bold">
                                Your Message
                            </h5>

                            <p class="mb-0">
                                {{ $patient->patient_message }}
                            </p>

                        </div>

                    @endif


                    @if($patient->admin_notes)

                        <div class="alert alert-info">

                            <h5 class="fw-bold">
                                Message From Hospital
                            </h5>

                            <p class="mb-0">
                                {{ $patient->admin_notes }}
                            </p>

                        </div>

                    @endif


                    @if($errors->any())

                        <div class="alert alert-danger">

                            {{ $errors->first() }}

                        </div>

                    @endif


                    @if(session('success'))

                        <div class="alert alert-success">

                            {{ session('success') }}

                        </div>

                    @endif


                    @if(
                        !in_array(
                            $patient->status,
                            ['Cancelled', 'Completed']
                        )
                    )

                        <form
                            action="{{ route('patients.token.cancel') }}"
                            method="POST"
                            class="mt-4"
                        >

                            @csrf

                            <input
                                type="hidden"
                                name="appointment_token"
                                value="{{ $patient->appointment_token }}"
                            >

                            <button
                                type="submit"
                                class="btn btn-outline-danger"
                                onclick="return confirm('Are you sure you want to cancel this appointment?')"
                            >
                                Cancel Appointment
                            </button>

                        </form>

                    @endif


                    <div class="mt-4">

                        <a
                            href="{{ route('patients.token') }}"
                            class="btn btn-primary"
                        >
                            Check Another Token
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection