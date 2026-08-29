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
                All hospital patient appointments
            </p>

        </div>

        <a
            href="{{ route('admin.dashboard') }}"
            class="btn btn-outline-dark"
        >
            ← Dashboard
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <div class="card shadow-sm rounded-4 border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>#</th>
                            <th>Patient</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Doctor</th>
                            <th>Appointment Date</th>
                            <th>Appointment Time</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($patients as $patient)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>

                                <strong>
                                    {{ $patient->name }}
                                </strong>

                                <br>

                                <small class="text-muted">
                                    {{ $patient->gender ?? 'N/A' }}
                                </small>

                            </td>

                            <td>
                                {{ $patient->phone }}
                            </td>

                            <td>
                                {{ $patient->email }}
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

                                @else

                                    -

                                @endif

                            </td>

                            <td>

                                @if($patient->appointment_at)

                                    {{ $patient->appointment_at->format('h:i A') }}

                                @else

                                    -

                                @endif

                            </td>

                            <td>

                                @if(
                                    $patient->appointment_at &&
                                    $patient->appointment_at->isPast()
                                )

                                    <span class="badge bg-secondary">
                                        Completed
                                    </span>

                                @else

                                    <span class="badge bg-success">
                                        Upcoming
                                    </span>

                                @endif

                            </td>

                            <td>

                                <form
                                    action="{{ route('admin.patients.cancel', $patient) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to cancel this appointment?')"
                                    >
                                        Cancel Appointment
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="9"
                                class="text-center py-5"
                            >

                                <h5>
                                    No Patient Records
                                </h5>

                                <p class="text-muted">
                                    No appointments have been booked yet.
                                </p>

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