@extends('layouts.app')

@section('content')

<div style="display:flex; justify-content:space-between; margin-bottom:20px;">

    <h1>Patients</h1>

    <a class="btn" href="{{ route('patients.create') }}">
        + Add Patient
    </a>

</div>

<div class="card">

<table>

<tr>
    <th>Name</th>
    <th>Phone</th>
    <th>Gender</th>
    <th>Doctor</th>
    <th>Action</th>
</tr>

@forelse($patients as $patient)

<tr>

    <td>{{ $patient->name }}</td>

    <td>{{ $patient->phone }}</td>

    <td>{{ $patient->gender }}</td>

    <td>
        {{ $patient->doctor->name ?? 'Not Assigned' }}
    </td>

    <td>

        <a class="btn"
           href="{{ route('patients.show', $patient) }}">
            View
        </a>

        <a class="btn"
           href="{{ route('patients.edit', $patient) }}">
            Edit
        </a>

        <form
            action="{{ route('patients.destroy', $patient) }}"
            method="POST"
            style="display:inline">

            @csrf
            @method('DELETE')

            <button class="btn btn-danger"
                    onclick="return confirm('Delete patient?')">
                Delete
            </button>

        </form>

    </td>

</tr>

@empty

<tr>
    <td colspan="5">
        No patients found.
    </td>
</tr>

@endforelse

</table>

</div>

@endsection