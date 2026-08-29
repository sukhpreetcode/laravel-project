@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-5">

                    <div class="text-center mb-4">
                        <div class="display-5">🏥</div>

                        <h1 class="fw-bold mt-2">
                            Book Your Appointment
                        </h1>

                        <p class="text-muted">
                            Fill in your details and our system will automatically assign the best available doctor.
                        </p>
                    </div>

                    @if($errors->any())

                        <div class="alert alert-danger">
                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>
                        </div>

                    @endif

                    <form action="{{ route('patients.store') }}" method="POST">

                        @csrf

                        <div class="row g-3">

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Full Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control form-control-lg"
                                    value="{{ old('name') }}"
                                    placeholder="Enter your name"
                                    required
                                >

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control form-control-lg"
                                    value="{{ old('email') }}"
                                    placeholder="you@example.com"
                                    required
                                >

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Phone
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control form-control-lg"
                                    value="{{ old('phone') }}"
                                    placeholder="Enter phone number"
                                    required
                                >

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Gender
                                </label>

                                <select
                                    name="gender"
                                    class="form-select form-select-lg"
                                >

                                    <option value="">
                                        Select Gender
                                    </option>

                                    <option value="Male">
                                        Male
                                    </option>

                                    <option value="Female">
                                        Female
                                    </option>

                                    <option value="Other">
                                        Other
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Date of Birth
                                </label>

                                <input
                                    type="date"
                                    name="date_of_birth"
                                    class="form-control form-control-lg"
                                    value="{{ old('date_of_birth') }}"
                                >

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Appointment Date & Time
                                </label>

                                <input
                                    type="datetime-local"
                                    name="appointment_at"
                                    class="form-control form-control-lg"
                                    required
                                >

                            </div>

                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Address
                                </label>

                                <textarea
                                    name="address"
                                    class="form-control"
                                    rows="3"
                                    placeholder="Enter your address"
                                >{{ old('address') }}</textarea>

                            </div>

                        </div>

                        <div class="alert alert-info mt-4">

                            <strong>Automatic Doctor Assignment</strong>

                            <br>

                            You do not need to select a doctor.
                            Our system will automatically assign an available doctor.

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary btn-lg w-100 rounded-3"
                        >
                            🩺 Book Appointment
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection