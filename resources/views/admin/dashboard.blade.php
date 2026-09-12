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


        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.patients.index') }}"
                class="btn btn-outline-primary"
            >
                All Patient Records
            </a>

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


    {{-- FILTERS --}}

    <div class="card border-0 shadow-sm rounded-4 mb-5">

        <div class="card-body">

            <h4 class="fw-bold mb-3">
                Search / Filter Appointments
            </h4>


            <form method="GET">

                <div class="row g-3">

                    <div class="col-md-4">

                        <label class="form-label">
                            Search
                        </label>

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Name / Token / Phone"
                            value="{{ request('search') }}"
                        >

                    </div>


                    <div class="col-md-2">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                        >

                            <option value="">
                                All
                            </option>

                            <option
                                value="Pending"
                                @selected(request('status') === 'Pending')
                            >
                                Pending
                            </option>

                            <option
                                value="Confirmed"
                                @selected(request('status') === 'Confirmed')
                            >
                                Confirmed
                            </option>

                            <option
                                value="Cancelled"
                                @selected(request('status') === 'Cancelled')
                            >
                                Cancelled
                            </option>

                            <option
                                value="Completed"
                                @selected(request('status') === 'Completed')
                            >
                                Completed
                            </option>

                        </select>

                    </div>


                    <div class="col-md-3">

                        <label class="form-label">
                            From Date
                        </label>

                        <input
                            type="date"
                            name="from_date"
                            class="form-control"
                            value="{{ request('from_date') }}"
                        >

                    </div>


                    <div class="col-md-3">

                        <label class="form-label">
                            To Date
                        </label>

                        <input
                            type="date"
                            name="to_date"
                            class="form-control"
                            value="{{ request('to_date') }}"
                        >

                    </div>

                </div>


                <div class="mt-3">

                    <button class="btn btn-primary">
                        🔎 Filter
                    </button>

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="btn btn-outline-secondary"
                    >
                        Reset
                    </a>

                </div>

            </form>

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
                            Education:
                            {{ $doctor->qualification ?? 'Not available' }}
                        </p>

                        <p class="text-muted mb-1">
                            Experience:
                            {{ $doctor->experience ?? 'Not available' }}
                        </p>

                        <p class="text-muted mb-1">
                            Specialist:
                            {{ $doctor->specialist_body_part ?? 'General' }}
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


    {{-- PATIENTS --}}

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>

            <h3 class="fw-bold">
                Patient Appointments
            </h3>

            <p class="text-muted">
                Latest 4 records matching your filter
            </p>

        </div>

        <a
            href="{{ route('admin.patients.index') }}"
            class="btn btn-outline-primary"
        >
            View All
        </a>

    </div>


    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>Token</th>

                            <th>Patient</th>

                            <th>Doctor</th>

                            <th>Appointment</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($patients as $patient)

                        <tr>

                            <td>

                                <span class="badge bg-primary">

                                    {{ $patient->appointment_token }}

                                </span>

                            </td>


                            <td>

                                <strong>
                                    {{ $patient->name }}
                                </strong>

                                <br>

                                <small class="text-muted">
                                    {{ $patient->phone }}
                                </small>

                            </td>


                            <td>

                                @if($patient->doctor)

                                    Dr. {{ $patient->doctor->name }}

                                @else

                                    Not Assigned

                                @endif

                            </td>


                            <td>

                                {{ $patient->appointment_at
                                    ? $patient->appointment_at->format('d M Y, h:i A')
                                    : '-'
                                }}

                            </td>


                            <td>

                                @if($patient->status === 'Pending')

                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>

                                @elseif($patient->status === 'Confirmed')

                                    <span class="badge bg-success">
                                        Confirmed
                                    </span>

                                @elseif($patient->status === 'Cancelled')

                                    <span class="badge bg-danger">
                                        Cancelled
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Completed
                                    </span>

                                @endif

                            </td>


                            <td>

                                <a
                                    href="{{ route('admin.patients.show', $patient) }}"
                                    class="btn btn-sm btn-primary"
                                >
                                    View
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center py-5"
                            >
                                No matching appointments.
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