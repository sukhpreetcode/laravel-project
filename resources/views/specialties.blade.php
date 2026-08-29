<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Specialties - Sukh Hospital System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        .specialty-card {
            background: white;
            border: 0;
            border-radius: 18px;
            padding: 28px;
            height: 100%;
            box-shadow: 0 8px 30px rgba(0,0,0,.06);
        }

    </style>

</head>

<body class="bg-light">

<nav class="navbar bg-white shadow-sm">

    <div class="container">

        <a
            href="{{ route('dashboard') }}"
            class="navbar-brand fw-bold"
        >
            Sukh Hospital System
        </a>

        <a
            href="{{ route('dashboard') }}"
            class="btn btn-outline-dark"
        >
            Home
        </a>

    </div>

</nav>


<div class="container py-5">

    <div class="text-center mb-5">

        <h1 class="fw-bold">
            Our Specialties
        </h1>

        <p class="text-muted">
            Medical and surgical services available at
            Sukh Hospital System.
        </p>

    </div>


    <div class="row g-4">


        <div class="col-md-6 col-lg-4">

            <div class="specialty-card">

                <h4 class="fw-bold">
                    General Surgery
                </h4>

                <p class="text-muted">
                    General surgical procedures and treatment
                    for common medical conditions.
                </p>

            </div>

        </div>


        <div class="col-md-6 col-lg-4">

            <div class="specialty-card">

                <h4 class="fw-bold">
                    Full Body Operations
                </h4>

                <p class="text-muted">
                    Surgical care and procedures for different
                    parts of the body according to patient needs
                    and specialist consultation.
                </p>

            </div>

        </div>


        <div class="col-md-6 col-lg-4">

            <div class="specialty-card">

                <h4 class="fw-bold">
                    Orthopedic Care
                </h4>

                <p class="text-muted">
                    Treatment and surgical care for bones,
                    joints, muscles and related conditions.
                </p>

            </div>

        </div>


        <div class="col-md-6 col-lg-4">

            <div class="specialty-card">

                <h4 class="fw-bold">
                    Cardiology
                </h4>

                <p class="text-muted">
                    Heart-related consultation, diagnosis
                    and treatment.
                </p>

            </div>

        </div>


        <div class="col-md-6 col-lg-4">

            <div class="specialty-card">

                <h4 class="fw-bold">
                    Neurology
                </h4>

                <p class="text-muted">
                    Medical consultation for brain, nerve
                    and nervous-system conditions.
                </p>

            </div>

        </div>


        <div class="col-md-6 col-lg-4">

            <div class="specialty-card">

                <h4 class="fw-bold">
                    General Medicine
                </h4>

                <p class="text-muted">
                    Diagnosis and treatment for common
                    medical conditions and illnesses.
                </p>

            </div>

        </div>


        <div class="col-md-6 col-lg-4">

            <div class="specialty-card">

                <h4 class="fw-bold">
                    Emergency Care
                </h4>

                <p class="text-muted">
                    Emergency medical assistance and
                    immediate patient assessment.
                </p>

            </div>

        </div>


        <div class="col-md-6 col-lg-4">

            <div class="specialty-card">

                <h4 class="fw-bold">
                    Diagnostic Services
                </h4>

                <p class="text-muted">
                    Medical tests and diagnostic support
                    for accurate treatment planning.
                </p>

            </div>

        </div>


        <div class="col-md-6 col-lg-4">

            <div class="specialty-card">

                <h4 class="fw-bold">
                    Post-Operative Care
                </h4>

                <p class="text-muted">
                    Follow-up care and monitoring after
                    medical procedures and operations.
                </p>

            </div>

        </div>

    </div>


    <div class="text-center mt-5">

        <a
            href="{{ route('patients.create') }}"
            class="btn btn-primary btn-lg"
        >
            Book an Appointment
        </a>

    </div>

</div>

</body>

</html>