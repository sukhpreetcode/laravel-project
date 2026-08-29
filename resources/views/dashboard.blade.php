<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>CarePoint Hospital</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f6f8fc;
        }

        .hero {
            min-height: 90vh;
            display: flex;
            align-items: center;
        }

        .hero-card {
            background: white;
            border-radius: 30px;
            padding: 60px;
            box-shadow: 0 20px 60px rgba(0,0,0,.08);
        }

        .icon {
            font-size: 70px;
        }

    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg bg-white shadow-sm">

    <div class="container">

        <a class="navbar-brand fw-bold fs-4">
            🏥 CarePoint
        </a>

        <a
            href="{{ route('admin.login') }}"
            class="btn btn-outline-dark"
        >
            Admin
        </a>

    </div>

</nav>

<section class="hero">

    <div class="container">

        <div class="hero-card text-center">

            <div class="icon">
                🏥
            </div>

            <h1 class="display-4 fw-bold mt-3">
                Quality Healthcare,
                <br>
                Made Simple.
            </h1>

            <p class="lead text-muted mt-3 mx-auto"
               style="max-width:650px;">

                Book your hospital appointment in a few simple steps.
                Our system automatically assigns an available doctor
                for you.

            </p>

            <a
                href="{{ route('patients.create') }}"
                class="btn btn-primary btn-lg px-5 mt-4"
            >
                🩺 Add Patient / Book Appointment
            </a>

            <div class="row mt-5 g-4">

                <div class="col-md-4">

                    <h5 class="fw-bold">
                        ⚡ Fast Booking
                    </h5>

                    <p class="text-muted">
                        Simple appointment process.
                    </p>

                </div>

                <div class="col-md-4">

                    <h5 class="fw-bold">
                        👨‍⚕️ Smart Assignment
                    </h5>

                    <p class="text-muted">
                        Doctor automatically assigned.
                    </p>

                </div>

                <div class="col-md-4">

                    <h5 class="fw-bold">
                        📧 Email Updates
                    </h5>

                    <p class="text-muted">
                        Appointment confirmation by email.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

</body>

</html>