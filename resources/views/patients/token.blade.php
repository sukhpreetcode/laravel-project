@extends('layouts.app')

@section('title', 'Check Appointment')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-5">

                    <h2 class="fw-bold text-center">
                        Check Your Appointment
                    </h2>

                    <p class="text-muted text-center">
                        Enter the token number you received after booking.
                    </p>


                    @if($errors->any())

                        <div class="alert alert-danger">

                            {{ $errors->first() }}

                        </div>

                    @endif


                    @if(session('success'))

                        <div class="alert alert-success">

                            {{ session('success') }}

                        </div>

                    @endif


                    <form
                        action="{{ route('patients.token.check') }}"
                        method="POST"
                    >

                        @csrf

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Appointment Token
                            </label>

                            <input
                                type="text"
                                name="appointment_token"
                                class="form-control form-control-lg text-center"
                                placeholder="Example: SUKH-A8K92P"
                                value="{{ old('appointment_token') }}"
                                required
                            >

                        </div>


                        <button
                            class="btn btn-primary w-100 btn-lg"
                        >
                            Check Appointment
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection