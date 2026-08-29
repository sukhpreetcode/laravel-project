<!DOCTYPE html>
<html>
<head>

    <title>Admin Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-dark">

<div class="container">

    <div
        class="row justify-content-center align-items-center"
        style="min-height:100vh;"
    >

        <div class="col-md-5">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-5">

                    <div class="text-center mb-4">

                        <div style="font-size:55px;">
                            🔐
                        </div>

                        <h2 class="fw-bold">
                            Admin Login
                        </h2>

                        <p class="text-muted">
                            Hospital Management System
                        </p>

                    </div>

                    @if($errors->any())

                        <div class="alert alert-danger">

                            {{ $errors->first() }}

                        </div>

                    @endif

                    <form
                        action="{{ route('admin.authenticate') }}"
                        method="POST"
                    >

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">
                                Username
                            </label>

                            <input
                                type="text"
                                name="username"
                                class="form-control form-control-lg"
                                placeholder="Admin username"
                                required
                            >

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control form-control-lg"
                                placeholder="Admin password"
                                required
                            >

                        </div>

                        <button
                            class="btn btn-dark btn-lg w-100"
                        >
                            Login to Admin Panel
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>