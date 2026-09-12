@extends('layouts.app')

@section('content')

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-9">

<div class="card border-0 shadow-lg rounded-4">

<div class="card-body p-5">

<h2 class="fw-bold mb-2">
    Add New Doctor
</h2>

<p class="text-muted mb-4">
    Add professional information and availability.
</p>


<form
    method="POST"
    action="{{ route('doctors.store') }}"
>

@csrf


<div class="row g-4">


<div class="col-md-6">

<label class="form-label fw-semibold">
Doctor Name
</label>

<input
    name="name"
    class="form-control"
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
>

</div>


<div class="col-md-6">

<label class="form-label fw-semibold">
Phone
</label>

<input
    name="phone"
    class="form-control"
    required
>

</div>


<div class="col-md-6">

<label class="form-label fw-semibold">
Specialization
</label>

<select
    name="specialization"
    class="form-select"
    required
>

<option value="">
Select specialization
</option>

<option>General Physician</option>
<option>Cardiologist</option>
<option>Neurologist</option>
<option>Orthopedic Surgeon</option>
<option>Dermatologist</option>
<option>Ophthalmologist</option>
<option>ENT Specialist</option>
<option>Gastroenterologist</option>
<option>Nephrologist</option>
<option>Gynecologist</option>
<option>Urologist</option>
<option>Dentist</option>
<option>Pediatrician</option>
<option>General Surgeon</option>

</select>

</div>


<div class="col-md-6">

<label class="form-label fw-semibold">
Qualification / Study
</label>

<input
    name="qualification"
    class="form-control"
    placeholder="MBBS, MD, MS..."
>

</div>


<div class="col-md-6">

<label class="form-label fw-semibold">
Experience
</label>

<input
    name="experience"
    class="form-control"
    placeholder="Example: 8 Years"
>

</div>


<div class="col-md-6">

<label class="form-label fw-semibold">
Specialist Body Part
</label>

<select
    name="specialist_body_part"
    class="form-select"
>

<option>Full Body</option>
<option>Heart</option>
<option>Brain / Nervous System</option>
<option>Eyes</option>
<option>Ears</option>
<option>Nose / Throat</option>
<option>Teeth / Mouth</option>
<option>Chest</option>
<option>Lungs</option>
<option>Stomach</option>
<option>Liver</option>
<option>Kidneys</option>
<option>Bones / Joints</option>
<option>Back / Spine</option>
<option>Skin</option>
<option>Urinary System</option>
<option>Children</option>
<option>Women's Health</option>

</select>

</div>


<div class="col-md-6">

<label class="form-label fw-semibold">
Consultation Fee
</label>

<input
    type="number"
    step="0.01"
    name="consultation_fee"
    class="form-control"
    placeholder="₹"
>

</div>


<div class="col-12">

<label class="form-label fw-semibold">
Doctor Biography
</label>

<textarea
    name="bio"
    rows="4"
    class="form-control"
    placeholder="Doctor's professional introduction..."
></textarea>

</div>


<div class="col-md-6">

<label class="form-label fw-semibold">
Available Days
</label>

<input
    name="available_days"
    class="form-control"
    placeholder="Mon, Tue, Wed, Fri"
>

</div>


<div class="col-md-3">

<label class="form-label fw-semibold">
Available From
</label>

<input
    type="time"
    name="available_from"
    class="form-control"
>

</div>


<div class="col-md-3">

<label class="form-label fw-semibold">
Available To
</label>

<input
    type="time"
    name="available_to"
    class="form-control"
>

</div>


<div class="col-12">

<div class="form-check">

<input
    type="checkbox"
    name="is_active"
    value="1"
    class="form-check-input"
    checked
>

<label class="form-check-label">

Doctor is currently available

</label>

</div>

</div>


<div class="col-12">

<button
    class="btn btn-primary btn-lg w-100"
>

Add Doctor

</button>

</div>


</div>

</form>

</div>

</div>

</div>

</div>

</div>

@endsection