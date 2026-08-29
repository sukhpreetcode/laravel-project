@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold">
                Doctors
            </h1>

            <p class="text-muted">
                Manage hospital doctors
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

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>Doctor</th>
                            <th>Specialization</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Patients</th>
                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($doctors as $doctor)

                        <tr>

                            <td class="fw-semibold">
                                Dr. {{ $doctor->name }}
                            </td>

                            <td>
                                {{ $doctor->specialization }}
                            </td>

                            <td>
                                {{ $doctor->phone }}
                            </td>

                            <td>
                                {{ $doctor->email ?? '-' }}
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

                            <td colspan="6" class="text-center py-5">

                                No doctors found.

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