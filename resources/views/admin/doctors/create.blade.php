@extends('layouts.app')

@section('title', 'Add Doctor')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-9">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-5">

                    <h2 class="fw-bold mb-4">
                        Add New Doctor
                    </h2>


                    @if($errors->any())

                        <div class="alert alert-danger">

                            @foreach($errors->all() as $error)

                                <div>
                                    {{ $error }}
                                </div>

                            @endforeach

                        </div>

                    @endif


                    <form
                        action="{{ route('admin.doctors.store') }}"
                        method="POST"
                    >

                        @csrf


                        <div class="row g-3">


                            <div class="col-md-6">

                                <label class="form-label">
                                    Doctor Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name') }}"
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
                                    value="{{ old('phone') }}"
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
                                    value="{{ old('email') }}"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Specialization
                                </label>

                                <select
                                    name="specialization"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        Select Specialization
                                    </option>

                                    <option value="General Physician">
                                        General Physician
                                    </option>

                                    <option value="Cardiologist">
                                        Cardiologist
                                    </option>

                                    <option value="Neurologist">
                                        Neurologist
                                    </option>

                                    <option value="Orthopedic">
                                        Orthopedic
                                    </option>

                                    <option value="Dermatologist">
                                        Dermatologist
                                    </option>

                                    <option value="Ophthalmologist">
                                        Ophthalmologist
                                    </option>

                                    <option value="ENT Specialist">
                                        ENT Specialist
                                    </option>

                                    <option value="Gynecologist">
                                        Gynecologist
                                    </option>

                                    <option value="Dentist">
                                        Dentist
                                    </option>

                                    <option value="Surgeon">
                                        Surgeon
                                    </option>

                                    <option value="Other">
                                        Other
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Education / Qualification
                                </label>

                                <input
                                    type="text"
                                    name="qualification"
                                    class="form-control"
                                    placeholder="MBBS, MD, MS..."
                                    value="{{ old('qualification') }}"
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
                                    placeholder="5 Years"
                                    value="{{ old('experience') }}"
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

                                    <option value="">
                                        Select Body Part
                                    </option>

                                    <option value="Full Body">
                                        Full Body
                                    </option>

                                    <option value="Heart">
                                        Heart
                                    </option>

                                    <option value="Brain">
                                        Brain
                                    </option>

                                    <option value="Eye">
                                        Eye
                                    </option>

                                    <option value="Ear">
                                        Ear
                                    </option>

                                    <option value="Nose">
                                        Nose
                                    </option>

                                    <option value="Throat">
                                        Throat
                                    </option>

                                    <option value="Skin">
                                        Skin
                                    </option>

                                    <option value="Bones">
                                        Bones
                                    </option>

                                    <option value="Teeth">
                                        Teeth
                                    </option>

                                    <option value="Stomach">
                                        Stomach
                                    </option>

                                    <option value="Kidney">
                                        Kidney
                                    </option>

                                    <option value="Liver">
                                        Liver
                                    </option>

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
                                    value="{{ old('consultation_fee') }}"
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
                                    placeholder="Mon, Tue, Wed, Fri"
                                    value="{{ old('available_days') }}"
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
                                    value="{{ old('available_from') }}"
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
                                    value="{{ old('available_to') }}"
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
                                    placeholder="Doctor experience, expertise and additional information..."
                                >{{ old('bio') }}</textarea>

                            </div>


                            <div class="col-12">

                                <div class="form-check">

                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        class="form-check-input"
                                        id="is_active"
                                        checked
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
                                Add Doctor
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