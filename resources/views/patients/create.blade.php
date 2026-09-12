@extends('layouts.app')

@section('content')

<style>

    .appointment-page {
        background: #f4f7fb;
        min-height: 100vh;
        padding: 50px 0;
    }

    .appointment-card {
        border: 0;
        border-radius: 24px;
        overflow: hidden;
    }

    .appointment-header {
        background: linear-gradient(135deg, #0d6efd, #084298);
        color: white;
        padding: 40px;
    }

    .appointment-header h1 {
        font-weight: 800;
    }

    .form-section {
        padding: 30px;
        border-bottom: 1px solid #eee;
    }

    .section-title {
        font-weight: 700;
        color: #123;
        margin-bottom: 20px;
    }

    .form-control,
    .form-select {
        border-radius: 12px;
        padding: 12px 15px;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: 0 0 0 3px rgba(13,110,253,.12);
    }

    .appointment-type-card {
        border: 2px solid #e8edf5;
        border-radius: 15px;
        padding: 18px;
        cursor: pointer;
        transition: .2s;
    }

    .appointment-type-card:hover {
        border-color: #0d6efd;
        background: #f5f9ff;
    }

    .submit-btn {
        border-radius: 14px;
        padding: 15px;
        font-weight: 700;
    }

</style>


<div class="appointment-page">

<div class="container">

<div class="row justify-content-center">

<div class="col-xl-10">

<div class="card appointment-card shadow-lg">

    <!-- HEADER -->

    <div class="appointment-header">

        <h1>
            Book Your Hospital Appointment
        </h1>

        <p class="mb-0">
            Tell us about your health concern and our hospital team
            will assign the appropriate doctor.
        </p>

    </div>


    @if($errors->any())

        <div class="alert alert-danger m-4">

            <strong>Please fix the following:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


<form
    action="{{ route('patients.store') }}"
    method="POST"
>

@csrf


<!-- PATIENT INFORMATION -->

<div class="form-section">

<h4 class="section-title">
    👤 Patient Information
</h4>

<div class="row g-4">

<div class="col-md-6">

<label class="form-label fw-semibold">
    Full Name
</label>

<input
    type="text"
    name="name"
    class="form-control"
    value="{{ old('name') }}"
    placeholder="Enter patient full name"
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
    class="form-control"
    value="{{ old('email') }}"
    placeholder="patient@example.com"
    required
>

</div>


<div class="col-md-6">

<label class="form-label fw-semibold">
    Phone Number
</label>

<input
    type="text"
    name="phone"
    class="form-control"
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
    class="form-select"
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
    class="form-control"
    value="{{ old('date_of_birth') }}"
>

</div>


<div class="col-md-6">

<label class="form-label fw-semibold">
    Address
</label>

<input
    type="text"
    name="address"
    class="form-control"
    value="{{ old('address') }}"
    placeholder="City / Address"
>

</div>

</div>

</div>


<!-- APPOINTMENT TYPE -->

<div class="form-section">

<h4 class="section-title">
    🏥 What do you need?
</h4>

<div class="row g-3">

<div class="col-md-3">

<label class="appointment-type-card d-block">

<input
    type="radio"
    name="appointment_type"
    value="Normal Checkup"
    {{ old('appointment_type') == 'Normal Checkup' ? 'checked' : '' }}
    required
>

<strong>
    Normal Checkup
</strong>

<div class="small text-muted">
    General consultation
</div>

</label>

</div>


<div class="col-md-3">

<label class="appointment-type-card d-block">

<input
    type="radio"
    name="appointment_type"
    value="Medical Service"
    {{ old('appointment_type') == 'Medical Service' ? 'checked' : '' }}
>

<strong>
    Medical Service
</strong>

<div class="small text-muted">
    Tests / treatment / consultation
</div>

</label>

</div>


<div class="col-md-3">

<label class="appointment-type-card d-block">

<input
    type="radio"
    name="appointment_type"
    value="Operation"
    {{ old('appointment_type') == 'Operation' ? 'checked' : '' }}
>

<strong>
    Operation
</strong>

<div class="small text-muted">
    Surgical consultation
</div>

</label>

</div>


<div class="col-md-3">

<label class="appointment-type-card d-block">

<input
    type="radio"
    name="appointment_type"
    value="Emergency"
    {{ old('appointment_type') == 'Emergency' ? 'checked' : '' }}
>

<strong>
    Emergency
</strong>

<div class="small text-muted">
    Urgent medical concern
</div>

</label>

</div>

</div>

</div>


<!-- BODY PART -->

<div class="form-section">

<h4 class="section-title">
    🩺 Which body part is affected?
</h4>

<div class="row g-4">

<div class="col-md-6">

<label class="form-label fw-semibold">
    Body Part / Area
</label>

<select
    name="body_part"
    class="form-select"
    required
>

<option value="">
    Select affected body part
</option>

<option value="Full Body">Full Body / General</option>

<option value="Head">Head</option>

<option value="Brain / Nervous System">
    Brain / Nervous System
</option>

<option value="Eyes">Eyes</option>

<option value="Ears">Ears</option>

<option value="Nose / Throat">
    Nose / Throat
</option>

<option value="Teeth / Mouth">
    Teeth / Mouth
</option>

<option value="Neck">Neck</option>

<option value="Chest">Chest</option>

<option value="Heart">Heart</option>

<option value="Lungs">
    Lungs / Breathing
</option>

<option value="Stomach">
    Stomach / Digestive System
</option>

<option value="Liver">Liver</option>

<option value="Kidneys">Kidneys</option>

<option value="Urinary System">
    Urinary System
</option>

<option value="Bones / Joints">
    Bones / Joints
</option>

<option value="Back / Spine">
    Back / Spine
</option>

<option value="Skin">
    Skin / Hair
</option>

<option value="Legs">
    Legs
</option>

<option value="Arms / Hands">
    Arms / Hands
</option>

<option value="Other">
    Other
</option>

</select>

</div>


<div class="col-md-6">

<label class="form-label fw-semibold">
    Required Service
</label>

<select
    name="service"
    class="form-select"
>

<option value="">
    Select service
</option>

<option value="General Consultation">
    General Consultation
</option>

<option value="Health Checkup">
    Full Health Checkup
</option>

<option value="Blood Test">
    Blood Test
</option>

<option value="X-Ray">
    X-Ray
</option>

<option value="Ultrasound">
    Ultrasound
</option>

<option value="CT Scan">
    CT Scan
</option>

<option value="MRI">
    MRI
</option>

<option value="Physiotherapy">
    Physiotherapy
</option>

<option value="Dental Service">
    Dental Service
</option>

<option value="Eye Checkup">
    Eye Checkup
</option>

<option value="Surgical Consultation">
    Surgical Consultation
</option>

<option value="Other">
    Other
</option>

</select>

</div>

</div>

</div>


<!-- HEALTH DETAILS -->

<div class="form-section">

<h4 class="section-title">
    📋 Health Details
</h4>

<div class="row g-4">


<div class="col-12">

<label class="form-label fw-semibold">
    What problem are you facing?
</label>

<textarea
    name="symptoms"
    class="form-control"
    rows="4"
    placeholder="Describe symptoms, pain, discomfort or problem..."
    required
>{{ old('symptoms') }}</textarea>

</div>


<div class="col-md-6">

<label class="form-label fw-semibold">
    Previous Medical History
</label>

<textarea
    name="medical_history"
    class="form-control"
    rows="4"
    placeholder="Previous diseases, medicines, allergies, etc."
>{{ old('medical_history') }}</textarea>

</div>


<div class="col-md-6">

<label class="form-label fw-semibold">
    Operation / Surgery Details
</label>

<textarea
    name="operation_details"
    class="form-control"
    rows="4"
    placeholder="If operation is required or previously performed, provide details"
>{{ old('operation_details') }}</textarea>

</div>


<div class="col-md-6">

<label class="form-label fw-semibold">
    Urgency
</label>

<select
    name="urgency"
    class="form-select"
>

<option value="Normal">
    Normal
</option>

<option value="Soon">
    Need appointment soon
</option>

<option value="Urgent">
    Urgent
</option>

<option value="Emergency">
    Emergency
</option>

</select>

</div>

</div>

</div>


<!-- DATE -->

<div class="form-section">

<h4 class="section-title">
    📅 Appointment Schedule
</h4>

<div class="row g-4">

<div class="col-md-6">

<label class="form-label fw-semibold">
    Preferred Appointment Date & Time
</label>

<input
    type="datetime-local"
    name="appointment_at"
    class="form-control"
    value="{{ old('appointment_at') }}"
    required
>

</div>


<div class="col-md-6">

<label class="form-label fw-semibold">
    Additional Message
</label>

<textarea
    name="admin_notes"
    class="form-control"
    rows="2"
    placeholder="Any additional information for hospital staff"
>{{ old('admin_notes') }}</textarea>

</div>

</div>

<div class="mb-4">

    <label class="form-label fw-semibold">
        Message for Hospital / Admin
    </label>

    <textarea
        name="patient_message"
        class="form-control"
        rows="4"
        placeholder="Write any additional information you want to tell the hospital..."
    >{{ old('patient_message') }}</textarea>

</div>
</div>


<!-- SUBMIT -->

<div class="p-4">

<button
    type="submit"
    class="btn btn-primary btn-lg w-100 submit-btn"
>

🩺 Submit Appointment Request

</button>

</div>


</form>

</div>

</div>

</div>

</div>

</div>

@endsection