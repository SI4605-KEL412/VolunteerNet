<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <!-- Custom styles for this template -->
    @yield('styles')
    
    <!-- AOS (Animate on Scroll) for animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f0f4f8;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Header Styling */
        header {
            background: linear-gradient(135deg, #2a65a1, #6ca1d5); /* Gradasi biru yang lebih gelap */
            color: white;
            padding: 15px 0;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15); /* Shadow bawah header */
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 100;
        }

        .navbar-brand {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 1px;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: #ffcc00;
        }

        .navbar-nav .nav-item .nav-link {
            font-size: 1.1rem;
            font-weight: 500;
            color: #fff;
            transition: all 0.3s ease;
            margin-right: 20px;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #fff;
            background-color: #ffcc00;
            transform: translateY(-3px);
        }

        .navbar-nav .nav-item .nav-link.active {
            color: #ffcc00;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #2a65a1, #6ca1d5); /* Gradasi biru */
            color: white;
            padding: 120px 20px;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15); /* Shadow sekitar hero section */
            margin-top: 80px;
            border-radius: 12px;
            animation: fadeIn 1.5s ease-out;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 20px;
            animation: slideIn 1s ease-out;
        }

        .hero p {
            font-size: 1.5rem;
            font-weight: 300;
            max-width: 750px;
            margin: 0 auto;
            animation: slideIn 1.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Main Content */
        main {
            background: #fff;
            margin-top: 20px;
            padding: 40px 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1); /* Shadow untuk konten utama */
        }

        /* Footer Styling */
        footer {
            background-color: #2d2d2d;
            color: white;
            padding: 40px 0;
            text-align: center;
            margin-top: 40px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Shadow atas footer */
        }

        footer a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #ffcc00;
        }

        .btn-custom {
            background-color: #ffcc00;
            color: #fff;
            border-radius: 30px;
            padding: 12px 36px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
            border: none;
        }

        .btn-custom:hover {
            background-color: #e5b800;
            transform: translateY(-3px);
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.2rem;
            }

            .navbar-nav .nav-item .nav-link {
                font-size: 1rem;
                margin-right: 10px;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="container" data-aos="fade-down">
            <nav class="navbar navbar-expand-lg">
                <a href="/" class="navbar-brand h4 mb-0">Volunteer Net</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="{{route('')}}" class="nav-link active">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('feedback.index') }}" class="nav-link">Feedback</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" data-aos="fade-up">
        <h1>Welcome to Feedback Page</h1>
        <p>Give Your Feedback!</p>
        <a href="{{ route('feedback.index') }}" class="btn btn-custom mt-4">View Feedback List</a>
    </section>

    <!-- Main Content -->
    <main data-aos="fade-up">
        <div class="container" data-aos="fade-up">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Volunteer Net</p>
            <div class="social-icons mt-3">
                <a href="#" class="me-3"><i class="fab fa-facebook"></i></a>
                <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="me-3"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- AOS JS (Animate on Scroll) -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init(); // Initialize AOS
    </script>
</body>
</html>