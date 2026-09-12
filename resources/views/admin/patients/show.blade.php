@extends('layouts.app')

@section('title', 'Patient Details')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold">
                Patient Details
            </h1>

            <p class="text-muted">
                Complete appointment information
            </p>

        </div>


        <a
            href="{{ route('admin.patients.index') }}"
            class="btn btn-outline-primary"
        >
            ← Patient Records
        </a>

    </div>


    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if($errors->any())

        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>

    @endif


    {{-- TOKEN --}}

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body text-center p-4">

            <small class="text-muted">
                APPOINTMENT TOKEN
            </small>

            <h2 class="fw-bold text-primary">
                {{ $patient->appointment_token }}
            </h2>

        </div>

    </div>


    <div class="row g-4">


        {{-- PATIENT INFORMATION --}}

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Patient Information
                    </h4>


                    <p>
                        <strong>Name:</strong>
                        {{ $patient->name }}
                    </p>

                    <p>
                        <strong>Email:</strong>
                        {{ $patient->email }}
                    </p>

                    <p>
                        <strong>Phone:</strong>
                        {{ $patient->phone }}
                    </p>

                    <p>
                        <strong>Gender:</strong>
                        {{ $patient->gender ?? '-' }}
                    </p>

                    <p>
                        <strong>Date of Birth:</strong>

                        {{ $patient->date_of_birth
                            ? $patient->date_of_birth->format('d M Y')
                            : '-'
                        }}

                    </p>

                    <p>
                        <strong>Address:</strong>
                        {{ $patient->address ?? '-' }}
                    </p>

                </div>

            </div>

        </div>


        {{-- APPOINTMENT INFORMATION --}}

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Appointment Information
                    </h4>


                    <p>
                        <strong>Doctor:</strong>

                        @if($patient->doctor)

                            Dr. {{ $patient->doctor->name }}

                        @else

                            Not Assigned

                        @endif

                    </p>


                    <p>
                        <strong>Specialization:</strong>

                        {{ $patient->doctor->specialization ?? '-' }}

                    </p>


                    <p>
                        <strong>Appointment Type:</strong>
                        {{ $patient->appointment_type }}
                    </p>


                    <p>
                        <strong>Service:</strong>
                        {{ $patient->service ?? '-' }}
                    </p>


                    <p>
                        <strong>Body Part:</strong>
                        {{ $patient->body_part }}
                    </p>


                    <p>
                        <strong>Urgency:</strong>
                        {{ $patient->urgency }}
                    </p>


                    <p>
                        <strong>Date:</strong>

                        {{ $patient->appointment_at
                            ? $patient->appointment_at->format('d M Y')
                            : '-'
                        }}

                    </p>


                    <p>
                        <strong>Time:</strong>

                        {{ $patient->appointment_at
                            ? $patient->appointment_at->format('h:i A')
                            : '-'
                        }}

                    </p>

                </div>

            </div>

        </div>


        {{-- MEDICAL DETAILS --}}

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Health Details
                    </h4>


                    <p>
                        <strong>Symptoms:</strong>
                    </p>

                    <div class="bg-light rounded-3 p-3 mb-3">
                        {{ $patient->symptoms ?? '-' }}
                    </div>


                    <p>
                        <strong>Medical History:</strong>
                    </p>

                    <div class="bg-light rounded-3 p-3 mb-3">
                        {{ $patient->medical_history ?? '-' }}
                    </div>


                    <p>
                        <strong>Operation Details:</strong>
                    </p>

                    <div class="bg-light rounded-3 p-3">
                        {{ $patient->operation_details ?? '-' }}
                    </div>

                </div>

            </div>

        </div>


        {{-- PATIENT MESSAGE --}}

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        💬 Message From Patient
                    </h4>


                    @if($patient->patient_message)

                        <div class="alert alert-info">

                            {{ $patient->patient_message }}

                        </div>

                    @else

                        <p class="text-muted">
                            Patient did not send an additional message.
                        </p>

                    @endif


                    @if($patient->admin_notes)

                        <hr>

                        <h5 class="fw-bold">
                            Previous Admin Message
                        </h5>

                        <div class="alert alert-light border">

                            {{ $patient->admin_notes }}

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- STATUS MANAGEMENT --}}

        <div class="col-12">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Manage Appointment
                    </h4>


                    <form
                        action="{{ route('admin.patients.status', $patient) }}"
                        method="POST"
                    >

                        @csrf


                        <div class="row g-3">

                            <div class="col-md-4">

                                <label class="form-label">
                                    Appointment Status
                                </label>

                                <select
                                    name="status"
                                    class="form-select"
                                >

                                    <option
                                        value="Pending"
                                        @selected($patient->status === 'Pending')
                                    >
                                        Pending
                                    </option>

                                    <option
                                        value="Confirmed"
                                        @selected($patient->status === 'Confirmed')
                                    >
                                        Confirmed
                                    </option>

                                    <option
                                        value="Cancelled"
                                        @selected($patient->status === 'Cancelled')
                                    >
                                        Cancelled
                                    </option>

                                    <option
                                        value="Completed"
                                        @selected($patient->status === 'Completed')
                                    >
                                        Completed
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-8">

                                <label class="form-label">
                                    Message / Note for Patient
                                </label>

                                <textarea
                                    name="admin_notes"
                                    class="form-control"
                                    rows="3"
                                    placeholder="Example: Your appointment has been confirmed..."
                                >{{ $patient->admin_notes }}</textarea>

                            </div>

                        </div>


                        <button class="btn btn-primary mt-3">

                            Save Appointment

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection