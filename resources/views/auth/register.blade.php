<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register | Volunteer Net</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'float': 'float 6s ease-in-out infinite',
            'slideInUp': 'slideInUp 0.6s ease-out',
            'fadeIn': 'fadeIn 0.8s ease-out',
            'pulse-slow': 'pulse 3s infinite',
          },
          keyframes: {
            float: {
              '0%, 100%': { transform: 'translateY(0px)' },
              '50%': { transform: 'translateY(-20px)' }
            },
            slideInUp: {
              '0%': { transform: 'translateY(100px)', opacity: '0' },
              '100%': { transform: 'translateY(0)', opacity: '1' }
            },
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' }
            }
          }
        }
      }
    }
  </script>
  <style>
    .gradient-bg {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .glass-effect {
      backdrop-filter: blur(16px);
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .floating-shapes {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
    }
    .shape {
      position: absolute;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
    }
    .shape-1 {
      width: 100px;
      height: 100px;
      top: 20%;
      left: 10%;
      animation: float 6s ease-in-out infinite;
    }
    .shape-2 {
      width: 150px;
      height: 150px;
      top: 60%;
      right: 10%;
      animation: float 8s ease-in-out infinite reverse;
    }
    .shape-3 {
      width: 80px;
      height: 80px;
      bottom: 20%;
      left: 20%;
      animation: float 7s ease-in-out infinite;
    }
  </style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center p-4 relative">
  <!-- Floating Background Shapes -->
  <div class="floating-shapes">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
  </div>

  <!-- Register Card -->
  <div class="relative z-10 w-full max-w-md">
    <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl p-8 animate-slideInUp">
      <!-- Header -->
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-4 animate-pulse-slow">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
          </svg>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Buat Akun</h2>
        <p class="text-gray-600">Bergabunglah dengan komunitas volunteer</p>
      </div>

      <!-- Form -->
      <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Full Name -->
        <div class="group">
          <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
            Full Name
          </label>
          <div class="relative">
            <input
              type="text"
              id="name"
              name="name"
              value="{{ old('name') }}"
              required
              autofocus
              class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 group-hover:border-blue-300 @error('name') border-red-500 @enderror"
              placeholder="Masukkan nama lengkap"
            >
            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
            </div>
          </div>
          @error('name')
          <p class="mt-1 text-sm text-red-600 animate-fadeIn">{{ $message }}</p>
          @enderror
        </div>

        <!-- Email -->
        <div class="group">
          <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
            Email Address
          </label>
          <div class="relative">
            <input
              type="email"
              id="email"
              name="email"
              value="{{ old('email') }}"
              required
              class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 group-hover:border-blue-300 @error('email') border-red-500 @enderror"
              placeholder="nama@email.com"
            >
            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
            </div>
          </div>
          @error('email')
          <p class="mt-1 text-sm text-red-600 animate-fadeIn">{{ $message }}</p>
          @enderror
        </div>

        <!-- Password -->
        <div class="group">
          <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
            Password
          </label>
          <div class="relative">
            <input
              type="password"
              id="password"
              name="password"
              required
              class="w-full px-4 py-3 pl-12 pr-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 group-hover:border-blue-300 @error('password') border-red-500 @enderror"
              placeholder="Minimal 8 karakter"
            >
            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
              </svg>
            </div>
            <button
              type="button"
              onclick="togglePassword('password')"
              class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
            >
              <svg id="eye-password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
              </svg>
            </button>
          </div>
          @error('password')
          <p class="mt-1 text-sm text-red-600 animate-fadeIn">{{ $message }}</p>
          @enderror
        </div>

        <!-- Confirm Password -->
        <div class="group">
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
            Confirm Password
          </label>
          <div class="relative">
            <input
              type="password"
              id="password_confirmation"
              name="password_confirmation"
              required
              class="w-full px-4 py-3 pl-12 pr-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 group-hover:border-blue-300"
              placeholder="Ulangi password"
            >
            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <button
              type="button"
              onclick="togglePassword('password_confirmation')"
              class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
            >
              <svg id="eye-password_confirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
              </svg>
            </button>
          </div>
        </div>

        <!-- Role Selection -->
        <div class="group">
          <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
            Register as
          </label>
          <div class="relative">
            <select
              id="role"
              name="role"
              required
              class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 group-hover:border-blue-300 appearance-none bg-white @error('role') border-red-500 @enderror"
            >
              <option value="" disabled selected>Pilih Role</option>
              <option value="user" @if(old('role')=='user' ) selected @endif>User</option>
              <option value="admin" @if(old('role')=='admin' ) selected @endif>Admin</option>
            </select>
            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
              </svg>
            </div>
            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>
          </div>
          @error('role')
          <p class="mt-1 text-sm text-red-600 animate-fadeIn">{{ $message }}</p>
          @enderror
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        >
          <span class="flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
            Register
          </span>
        </button>

        <!-- Login Link -->
        <div class="text-center">
          <p class="text-gray-600">
            Sudah mempunyai akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300 hover:underline">
              Login!
            </a>
          </p>
        </div>

        <!-- Back to Home -->
        <div class="text-center pt-4 border-t border-gray-200">
          <a
            href="{{ route('home') }}"
            class="inline-flex items-center text-gray-600 hover:text-gray-800 transition-colors duration-300"
          >
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Halaman Utama
          </a>
        </div>
      </form>
    </div>
  </div>

  <script>
    function togglePassword(fieldId) {
      const field = document.getElementById(fieldId);
      const eyeIcon = document.getElementById('eye-' + fieldId);

      if (field.type === 'password') {
        field.type = 'text';
        eyeIcon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
        `;
      } else {
        field.type = 'password';
        eyeIcon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        `;
      }
    }

    // Form validation animation
    document.addEventListener('DOMContentLoaded', function() {
      const inputs = document.querySelectorAll('input, select');

      inputs.forEach(input => {
        input.addEventListener('blur', function() {
          if (this.value) {
            this.classList.add('border-green-300');
            this.classList.remove('border-gray-300');
          } else {
            this.classList.remove('border-green-300');
            this.classList.add('border-gray-300');
          }
        });
      });

      // Password strength indicator
      const passwordInput = document.getElementById('password');
      const confirmPasswordInput = document.getElementById('password_confirmation');

      passwordInput.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;

        if (password.length >= 8) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;

        // Visual feedback based on strength
        if (strength < 2) {
          this.classList.remove('border-yellow-300', 'border-green-300');
          this.classList.add('border-red-300');
        } else if (strength < 3) {
          this.classList.remove('border-red-300', 'border-green-300');
          this.classList.add('border-yellow-300');
        } else {
          this.classList.remove('border-red-300', 'border-yellow-300');
          this.classList.add('border-green-300');
        }
      });

      // Confirm password matching
      confirmPasswordInput.addEventListener('input', function() {
        if (this.value === passwordInput.value && this.value !== '') {
          this.classList.remove('border-red-300');
          this.classList.add('border-green-300');
        } else if (this.value !== '') {
          this.classList.remove('border-green-300');
          this.classList.add('border-red-300');
        }
      });
    });
  </script>
</body>
</html>
