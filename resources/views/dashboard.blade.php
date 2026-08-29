<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Sukh Hospital System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f6f8fc;
            color: #172033;
        }

        .navbar {
            background: white;
        }

        .hero {
            min-height: 78vh;
            display: flex;
            align-items: center;
        }

        .hero-card {
            background: white;
            border-radius: 30px;
            padding: 65px;
            box-shadow: 0 20px 60px rgba(0,0,0,.08);
        }

        .feature-card {
            background: #fff;
            border-radius: 18px;
            padding: 25px;
            height: 100%;
            box-shadow: 0 8px 30px rgba(0,0,0,.05);
        }

    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg shadow-sm">

    <div class="container">

        <a
            href="{{ route('dashboard') }}"
            class="navbar-brand fw-bold fs-4"
        >
            Sukh Hospital System
        </a>

        <div class="d-flex gap-2">

            <a
                href="{{ route('about') }}"
                class="btn btn-light"
            >
                About
            </a>

            <a
                href="{{ route('specialties') }}"
                class="btn btn-light"
            >
                Specialties
            </a>

            <a
                href="{{ route('admin.login') }}"
                class="btn btn-outline-dark"
            >
                Admin
            </a>

        </div>

    </div>

</nav>


<section class="hero">

    <div class="container">

        <div class="hero-card text-center">

            <h1 class="display-4 fw-bold">
                Sukh Hospital System
            </h1>

            <p class="lead text-muted mt-3">

                Trusted healthcare and professional medical
                services in Jalandhar.

            </p>

            <p
                class="text-muted mx-auto"
                style="max-width:700px;"
            >

                Book your appointment easily. Our system automatically
                assigns an available doctor according to the current
                appointment load.

            </p>

            <a
                href="{{ route('patients.create') }}"
                class="btn btn-primary btn-lg px-5 mt-4"
            >
                Add Patient / Book Appointment
            </a>

        </div>


        <div class="row g-4 mt-4">

            <div class="col-md-4">

                <div class="feature-card">

                    <h5 class="fw-bold">
                        Easy Appointment
                    </h5>

                    <p class="text-muted mb-0">

                        Book an appointment through a simple
                        online patient form.

                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="feature-card">

                    <h5 class="fw-bold">
                        Experienced Doctors
                    </h5>

                    <p class="text-muted mb-0">

                        Our hospital provides professional
                        medical and surgical services.

                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="feature-card">

                    <h5 class="fw-bold">
                        Patient Care
                    </h5>

                    <p class="text-muted mb-0">

                        Patient appointments are managed
                        through our hospital system.

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

</body>

</html>