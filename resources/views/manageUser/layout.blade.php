<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VolunteerNet - User Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .bg-card{
            background-color: #002B5B!important;
        }
        .bg-primary {
            background-color: #0B2447 !important;
        }
        .btn-primary {
            background-color: #1a3a6e;
            border-color: #1a3a6e;
        }
        .btn-primary:hover {
            background-color: #152e57;
            border-color: #152e57;
        }
        .text-primary {
            color: #1a3a6e !important;
        }
        .nav-link.text-white:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 0.25rem;
        }
    </style>

</head>
<body>
    @yield('content')

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
