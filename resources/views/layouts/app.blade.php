<!DOCTYPE html>
<html>
<head>
    <title>Hospital Management System</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #222;
        }

        .navbar {
            background: #1769aa;
            color: white;
            padding: 18px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            font-size: 22px;
        }

        .nav a {
            color: white;
            text-decoration: none;
            margin-left: 18px;
        }

        .nav a:hover {
            opacity: .7;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 35px auto;
            animation: showPage .5s ease;
        }

        @keyframes showPage {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,.08);
            margin-bottom: 20px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .stat {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,.08);
        }

        .stat h1 {
            margin-top: 10px;
            color: #1769aa;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #1769aa;
            color: white;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            background: #1769aa;
            color: white;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-danger {
            background: #d9534f;
        }

        .btn-success {
            background: #28a745;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            margin: 8px 0 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        label {
            font-weight: bold;
        }

        .alert {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        @media(max-width: 800px) {
            .cards {
                grid-template-columns: 1fr 1fr;
            }

            .nav {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="navbar">

    <h2>🏥 MediCare Hospital</h2>

    <div class="nav">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('patients.index') }}">Patients</a>
        <a href="{{ route('doctors.index') }}">Doctors</a>
        <a href="{{ route('appointments') }}">Appointments</a>
    </div>

</div>

<div class="container">

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

</div>

</body>
</html>