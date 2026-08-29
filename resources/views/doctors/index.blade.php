@extends('layouts.app')

@section('content')

<div style="display:flex; justify-content:space-between;">

    <h1>Doctors</h1>

    <a class="btn" href="{{ route('doctors.create') }}">
        + Add Doctor
    </a>

</div>

<br>

<div class="card">

<table>

<tr>
    <th>Name</th>
    <th>Specialization</th>
    <th>Phone</th>
    <th>Patients</th>
    <th>Action</th>
</tr>

@foreach($doctors as $doctor)

<tr>

<td>{{ $doctor->name }}</td>

<td>{{ $doctor->specialization }}</td>

<td>{{ $doctor->phone }}</td>

<td>{{ $doctor->patients_count }}</td>

<td>

<a class="btn"
   href="{{ route('doctors.show', $doctor) }}">
   View
</a>

<form
    action="{{ route('doctors.destroy', $doctor) }}"
    method="POST"
    style="display:inline"
>

@csrf
@method('DELETE')

<button
    class="btn btn-danger"
    onclick="return confirm('Delete doctor?')"
>
    Delete
</button>

</form>

</td>

</tr>

@endforeach

</table>

</div>

@endsection