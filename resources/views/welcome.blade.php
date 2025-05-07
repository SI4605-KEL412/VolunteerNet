<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Welcome Section -->
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 text-center">
                <div class="card shadow-lg p-5">
                    <h1 class="display-4">Welcome to Our Platform</h1>
                    <p class="lead mt-3">Join us today to access all the features and start exploring.</p>

                    <div class="mt-4">
                        <!-- Button to Login -->
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg mx-2">Login</a>

                        <!-- Button to Register -->
                        <a href="{{ route('register') }}" class="btn btn-secondary btn-lg mx-2">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Link to Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
