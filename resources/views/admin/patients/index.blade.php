@extends('layouts.app')

@section('title', 'Patient Records')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold">
                Patient Records
            </h1>

            <p class="text-muted mb-0">
                Search and manage hospital appointments
            </p>

        </div>


        <a
            href="{{ route('admin.dashboard') }}"
            class="btn btn-outline-primary"
        >
            ← Dashboard
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


    {{-- FILTERS --}}

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body">

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
                                All Status
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


                    <div class="col-md-2">

                        <label class="form-label">
                            Doctor
                        </label>

                        <select
                            name="doctor_id"
                            class="form-select"
                        >

                            <option value="">
                                All Doctors
                            </option>

                            @foreach($doctors as $doctor)

                                <option
                                    value="{{ $doctor->id }}"
                                    @selected(
                                        request('doctor_id') == $doctor->id
                                    )
                                >
                                    Dr. {{ $doctor->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-2">

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


                    <div class="col-md-2">

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
                        href="{{ route('admin.patients.index') }}"
                        class="btn btn-outline-secondary"
                    >
                        Reset
                    </a>

                </div>

            </form>

        </div>

    </div>


    {{-- TABLE --}}

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

                                    <br>

                                    <small class="text-muted">

                                        {{ $patient->doctor->specialization }}

                                    </small>

                                @else

                                    Not Assigned

                                @endif

                            </td>


                            <td>

                                @if($patient->appointment_at)

                                    {{ $patient->appointment_at->format('d M Y') }}

                                    <br>

                                    <small>

                                        {{ $patient->appointment_at->format('h:i A') }}

                                    </small>

                                @else

                                    -

                                @endif

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
                                    View Details
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center py-5"
                            >

                                <h5>
                                    No Patient Records
                                </h5>

                                <p class="text-muted">
                                    No appointment matches your filter.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>


            <div class="mt-3">

                {{ $patients->links() }}

            </div>

        </div>

    </div>

</div>

@endsection