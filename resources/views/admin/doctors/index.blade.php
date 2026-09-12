@extends('layouts.app')

@section('title', 'Manage Doctors')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold">
                Doctors
            </h1>

            <p class="text-muted">
                Search and manage hospital doctors
            </p>

        </div>


        <a
            href="{{ route('admin.doctors.create') }}"
            class="btn btn-primary"
        >
            + Add Doctor
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


    {{-- FILTER --}}

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body">

            <form method="GET">

                <div class="row g-3">

                    <div class="col-md-4">

                        <label class="form-label">
                            Search Doctor
                        </label>

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Doctor name"
                            value="{{ request('search') }}"
                        >

                    </div>


                    <div class="col-md-4">

                        <label class="form-label">
                            Specialization
                        </label>

                        <select
                            name="specialization"
                            class="form-select"
                        >

                            <option value="">
                                All Specializations
                            </option>

                            @foreach($specializations as $specialization)

                                <option
                                    value="{{ $specialization }}"
                                    @selected(
                                        request('specialization') === $specialization
                                    )
                                >
                                    {{ $specialization }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-4">

                        <label class="form-label">
                            Education / Qualification
                        </label>

                        <select
                            name="qualification"
                            class="form-select"
                        >

                            <option value="">
                                All Education
                            </option>

                            @foreach($qualifications as $qualification)

                                <option
                                    value="{{ $qualification }}"
                                    @selected(
                                        request('qualification') === $qualification
                                    )
                                >
                                    {{ $qualification }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                <div class="mt-3">

                    <button class="btn btn-primary">
                        🔎 Search
                    </button>

                    <a
                        href="{{ route('admin.doctors.index') }}"
                        class="btn btn-outline-secondary"
                    >
                        Reset
                    </a>

                </div>

            </form>

        </div>

    </div>


    {{-- DOCTOR TABLE --}}

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>Doctor</th>

                            <th>Specialization</th>

                            <th>Education</th>

                            <th>Experience</th>

                            <th>Specialist</th>

                            <th>Availability</th>

                            <th>Patients</th>

                            <th>Actions</th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($doctors as $doctor)

                        <tr>

                            <td class="fw-semibold">

                                Dr. {{ $doctor->name }}

                                <br>

                                <small class="text-muted">

                                    {{ $doctor->phone }}

                                </small>

                            </td>


                            <td>

                                {{ $doctor->specialization }}

                            </td>


                            <td>

                                {{ $doctor->qualification ?? '-' }}

                            </td>


                            <td>

                                {{ $doctor->experience ?? '-' }}

                            </td>


                            <td>

                                {{ $doctor->specialist_body_part ?? '-' }}

                            </td>


                            <td>

                                @if($doctor->available_from && $doctor->available_to)

                                    {{ $doctor->available_from }}
                                    -
                                    {{ $doctor->available_to }}

                                    <br>

                                    <small class="text-muted">

                                        {{ $doctor->available_days }}

                                    </small>

                                @else

                                    Not specified

                                @endif

                            </td>


                            <td>

                                <span class="badge bg-primary">

                                    {{ $doctor->patients_count }}

                                </span>

                            </td>


                            <td>

                                <a
                                    href="{{ route('admin.doctors.edit', $doctor) }}"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    Edit
                                </a>


                                <form
                                    action="{{ route('admin.doctors.destroy', $doctor) }}"
                                    method="POST"
                                    class="d-inline"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Delete this doctor?')"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="text-center py-5"
                            >

                                No doctors found.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>


            <div class="mt-3">

                {{ $doctors->links() }}

            </div>

        </div>

    </div>

</div>

@endsection