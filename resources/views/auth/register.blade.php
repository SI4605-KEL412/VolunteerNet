<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register | Volunteer Net</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(135deg, #004080 0%, #0066cc 50%, #6a5acd 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .register-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      padding: 40px 30px;
      width: 100%;
      max-width: 480px;
      color: #333;
    }

    .register-card h4 {
      font-weight: bold;
      color: #004080;
      text-align: center;
      margin-bottom: 25px;
    }

    .form-control,
    .form-select {
      border-radius: 10px;
      padding: 10px 15px;
      border: 1px solid #ccc;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #0066cc;
      box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
    }

    .btn-register {
      background: linear-gradient(90deg, #0066cc, #6a5acd);
      color: #fff;
      border: none;
      padding: 10px;
      border-radius: 25px;
      font-weight: bold;
      width: 100%;
      transition: 0.3s;
    }

    .btn-register:hover {
      background: linear-gradient(90deg, #005bb5, #594fc9);
    }

    .bottom-text {
      text-align: center;
      margin-top: 15px;
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
  <div class="register-card">
    <h4>Buat Akun</h4>
    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
          value="{{ old('name') }}" required autofocus>
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
          value="{{ old('email') }}" required>
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
          name="password" required>
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
      </div>

      <div class="mb-3">
        <label for="role" class="form-label">Register as</label>
        <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
          <option value="" disabled selected>Pilih Role</option>
          <option value="user" @if(old('role')=='user' ) selected @endif>User</option>
          <option value="admin" @if(old('role')=='admin' ) selected @endif>Admin</option>
        </select>
        @error('role')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-register">Register</button>

      <div class="bottom-text">
        Sudah Mempunyai Akun? <a href="{{ route('login') }}">Login!</a>
      </div>
      <div class="text-center mt-3">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">←Kembali ke Halaman Utama</a>
        </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
