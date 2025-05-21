<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | Volunteer Net</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      background: linear-gradient(135deg, #004080 0%, #0066cc 50%, #6a5acd 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      padding: 40px 30px;
      width: 100%;
      max-width: 420px;
      color: #333;
    }

    .login-card h4 {
      font-weight: bold;
      color: #004080;
      text-align: center;
      margin-bottom: 25px;
    }

    .form-control {
      border-radius: 10px;
      padding: 10px 15px;
      border: 1px solid #ccc;
    }

    .form-control:focus {
      border-color: #0066cc;
      box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
    }

    .btn-login {
      background: linear-gradient(90deg, #0066cc, #6a5acd);
      color: #fff;
      border: none;
      padding: 10px;
      border-radius: 25px;
      font-weight: bold;
      width: 100%;
      transition: 0.3s;
    }

    .btn-login:hover {
      background: linear-gradient(90deg, #005bb5, #594fc9);
    }

    .form-check-label {
      font-size: 0.9rem;
    }

    .bottom-text {
      text-align: center;
      margin-top: 20px;
      font-size: 0.95rem;
    }

    .bottom-text a {
      color: #0066cc;
      text-decoration: none;
    }

    .bottom-text a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <h4>Login to VolunteerNet</h4>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
        <label class="form-check-label" for="remember_me">Remember Me</label>
      </div>
      <button type="submit" class="btn btn-login">Login</button>
      <div class="bottom-text mt-3">
        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
      </div>
    </form>
        <div class="text-center mt-3">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">←Kembali ke Halaman Utama</a>
        </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
