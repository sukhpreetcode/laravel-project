@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold">
                Admin Dashboard
            </h1>

            <p class="text-muted">
                Welcome back, {{ session('admin_name') }}
            </p>

        </div>

        <div>

            <a
                href="{{ route('admin.doctors.index') }}"
                class="btn btn-primary"
            >
                Manage Doctors
            </a>

            <a
                href="{{ route('admin.logout') }}"
                class="btn btn-outline-danger"
            >
                Logout
            </a>

        </div>

    </div>

    <div class="row g-4 mb-4">

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

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">

                <h4 class="fw-bold">
                    Patient Records
                </h4>

            </div>

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

                                <div class="fw-semibold">
                                    {{ $patient->name }}
                                </div>

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

                                    Not assigned

                                @endif

                            </td>

                            <td>

                                {{ $patient->appointment_at
                                    ? $patient->appointment_at->format('d M Y, h:i A')
                                    : '-' }}

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