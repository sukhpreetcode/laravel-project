@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="container py-4">


    {{-- HEADER --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold">
                Admin Dashboard
            </h1>

            <p class="text-muted mb-0">
                Welcome back, {{ session('admin_name') }}
            </p>

        </div>

        <div>

            <a
                href="{{ route('admin.patients.index') }}"
                class="btn btn-outline-primary"
            >
                All Patient Records
            </a>

            <a
                href="{{ route('admin.logout') }}"
                class="btn btn-outline-danger"
            >
                Logout
            </a>

        </div>

    </div>


    {{-- STATISTICS --}}

    <div class="row g-4 mb-5">


        <div class="col-md-3">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <p class="text-muted mb-1">
                        Total Patients
                    </p>

                    <h2 class="fw-bold">
                        {{ $totalPatients }}
                    </h2>

                </div>

            </div>

        </div>


        <div class="col-md-3">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <p class="text-muted mb-1">
                        Total Doctors
                    </p>

                    <h2 class="fw-bold">
                        {{ $totalDoctors }}
                    </h2>

                </div>

            </div>

        </div>


        <div class="col-md-3">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <p class="text-muted mb-1">
                        Today's Appointments
                    </p>

                    <h2 class="fw-bold">
                        {{ $todayAppointments }}
                    </h2>

                </div>

            </div>

        </div>


        <div class="col-md-3">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <p class="text-muted mb-1">
                        Upcoming
                    </p>

                    <h2 class="fw-bold">
                        {{ $upcomingAppointments }}
                    </h2>

                </div>

            </div>

        </div>

    </div>


    {{-- DOCTORS --}}

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>

            <h3 class="fw-bold mb-1">
                Doctors
            </h3>

            <p class="text-muted">
                Current hospital doctors
            </p>

        </div>

        <a
            href="{{ route('admin.doctors.index') }}"
            class="btn btn-primary"
        >
            Manage Doctors
        </a>

    </div>


    <div class="row g-4 mb-5">

        @forelse($doctors as $doctor)

            <div class="col-md-6 col-lg-4">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body p-4">

                        <h5 class="fw-bold">
                            Dr. {{ $doctor->name }}
                        </h5>

                        <p class="text-primary mb-2">
                            {{ $doctor->specialization }}
                        </p>

                        <p class="text-muted mb-1">
                            Phone: {{ $doctor->phone }}
                        </p>

                        <p class="text-muted mb-1">
                            Email: {{ $doctor->email ?? 'Not available' }}
                        </p>

                        <p class="text-muted mb-0">
                            Assigned Patients:
                            <strong>
                                {{ $doctor->patients_count }}
                            </strong>
                        </p>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-light border">
                    No doctors available.
                </div>

            </div>

        @endforelse

    </div>


    {{-- LATEST 4 PATIENTS --}}

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>

            <h3 class="fw-bold mb-1">
                Latest Patient Records
            </h3>

            <p class="text-muted">
                Showing the latest 4 appointments
            </p>

        </div>

        <a
            href="{{ route('admin.patients.index') }}"
            class="btn btn-outline-primary"
        >
            View All Patient Records
        </a>

    </div>


    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>Patient</th>
                            <th>Phone</th>
                            <th>Doctor</th>
                            <th>Appointment</th>

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
                                    {{ $patient->email }}
                                </small>

                            </td>

                            <td>
                                {{ $patient->phone }}
                            </td>

                            <td>

                                @if($patient->doctor)

                                    Dr. {{ $patient->doctor->name }}

                                @else

                                    Not Assigned

                                @endif

                            </td>

                            <td>

                                @if($patient->appointment_at)

                                    {{ $patient->appointment_at->format('d M Y, h:i A') }}

                                @else

                                    -

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="text-center py-5"
                            >
                                No patient records.
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