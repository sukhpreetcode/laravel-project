<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        @yield('title', 'Sukh Hospital System')
    </title>

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

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 12px 15px;
        }

        .btn {
            border-radius: 10px;
        }

    </style>

</head>

<body>

<nav class="navbar shadow-sm">

    <div class="container">

        <a
            href="{{ route('dashboard') }}"
            class="navbar-brand fw-bold"
        >
            Sukh Hospital System
        </a>

        @if(session('admin_logged_in'))

            <div>

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="btn btn-sm btn-outline-primary"
                >
                    Dashboard
                </a>

                <a
                    href="{{ route('admin.doctors.index') }}"
                    class="btn btn-sm btn-primary"
                >
                    Manage Doctors
                </a>

            </div>

        @endif

    </div>

</nav>

<main>

    @yield('content')

</main>

</body>

</html>php art