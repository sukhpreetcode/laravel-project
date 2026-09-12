@extends('layouts.app')

@section('title', 'Edit Doctor')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-9">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-5">

                    <h2 class="fw-bold mb-4">
                        Edit Doctor
                    </h2>


                    @if($errors->any())

                        <div class="alert alert-danger">

                            {{ $errors->first() }}

                        </div>

                    @endif


                    <form
                        action="{{ route('admin.doctors.update', $doctor) }}"
                        method="POST"
                    >

                        @csrf

                        @method('PUT')


                        <div class="row g-3">


                            <div class="col-md-6">

                                <label class="form-label">
                                    Doctor Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name', $doctor->name) }}"
                                    required
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Phone
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    value="{{ old('phone', $doctor->phone) }}"
                                    required
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email', $doctor->email) }}"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Specialization
                                </label>

                                <input
                                    type="text"
                                    name="specialization"
                                    class="form-control"
                                    value="{{ old('specialization', $doctor->specialization) }}"
                                    required
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Education / Qualification
                                </label>

                                <input
                                    type="text"
                                    name="qualification"
                                    class="form-control"
                                    value="{{ old('qualification', $doctor->qualification) }}"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Experience
                                </label>

                                <input
                                    type="text"
                                    name="experience"
                                    class="form-control"
                                    value="{{ old('experience', $doctor->experience) }}"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Body Part Specialist
                                </label>

                                <select
                                    name="specialist_body_part"
                                    class="form-select"
                                >

                                    @foreach([
                                        'Full Body',
                                        'Heart',
                                        'Brain',
                                        'Eye',
                                        'Ear',
                                        'Nose',
                                        'Throat',
                                        'Skin',
                                        'Bones',
                                        'Teeth',
                                        'Stomach',
                                        'Kidney',
                                        'Liver'
                                    ] as $part)

                                        <option
                                            value="{{ $part }}"
                                            @selected(
                                                old(
                                                    'specialist_body_part',
                                                    $doctor->specialist_body_part
                                                ) === $part
                                            )
                                        >
                                            {{ $part }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Consultation Fee
                                </label>

                                <input
                                    type="number"
                                    name="consultation_fee"
                                    class="form-control"
                                    min="0"
                                    value="{{ old('consultation_fee', $doctor->consultation_fee) }}"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Available Days
                                </label>

                                <input
                                    type="text"
                                    name="available_days"
                                    class="form-control"
                                    value="{{ old('available_days', $doctor->available_days) }}"
                                >

                            </div>


                            <div class="col-md-3">

                                <label class="form-label">
                                    Available From
                                </label>

                                <input
                                    type="time"
                                    name="available_from"
                                    class="form-control"
                                    value="{{ old('available_from', $doctor->available_from) }}"
                                >

                            </div>


                            <div class="col-md-3">

                                <label class="form-label">
                                    Available To
                                </label>

                                <input
                                    type="time"
                                    name="available_to"
                                    class="form-control"
                                    value="{{ old('available_to', $doctor->available_to) }}"
                                >

                            </div>


                            <div class="col-12">

                                <label class="form-label">
                                    Doctor Bio
                                </label>

                                <textarea
                                    name="bio"
                                    class="form-control"
                                    rows="4"
                                >{{ old('bio', $doctor->bio) }}</textarea>

                            </div>


                            <div class="col-12">

                                <div class="form-check">

                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        class="form-check-input"
                                        id="is_active"
                                        @checked(
                                            old(
                                                'is_active',
                                                $doctor->is_active
                                            )
                                        )
                                    >

                                    <label
                                        class="form-check-label"
                                        for="is_active"
                                    >
                                        Doctor is Active
                                    </label>

                                </div>

                            </div>

                        </div>


                        <div class="mt-4">

                            <button class="btn btn-primary">
                                Update Doctor
                            </button>

                            <a
                                href="{{ route('admin.doctors.index') }}"
                                class="btn btn-light"
                            >
                                Cancel
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection