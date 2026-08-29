@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-5">

                    <h2 class="fw-bold mb-4">
                        Edit Doctor
                    </h2>

                    <form
                        action="{{ route('admin.doctors.update', $doctor) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label">
                                Doctor Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ $doctor->name }}"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Specialization
                            </label>

                            <input
                                type="text"
                                name="specialization"
                                value="{{ $doctor->specialization }}"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Phone
                            </label>

                            <input
                                type="text"
                                name="phone"
                                value="{{ $doctor->phone }}"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ $doctor->email }}"
                                class="form-control"
                            >

                        </div>

                        <button class="btn btn-primary">
                            Update Doctor
                        </button>

                        <a
                            href="{{ route('admin.doctors.index') }}"
                            class="btn btn-light"
                        >
                            Cancel
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection