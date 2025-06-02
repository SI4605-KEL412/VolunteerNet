<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Volunteer Net</title>
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
            'bounce-slow': 'bounce 2s infinite',
            'wiggle': 'wiggle 1s ease-in-out infinite',
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
            },
            wiggle: {
              '0%, 100%': { transform: 'rotate(-3deg)' },
              '50%': { transform: 'rotate(3deg)' }
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
      width: 120px;
      height: 120px;
      top: 15%;
      left: 15%;
      animation: float 7s ease-in-out infinite;
    }
    .shape-2 {
      width: 180px;
      height: 180px;
      top: 65%;
      right: 15%;
      animation: float 9s ease-in-out infinite reverse;
    }
    .shape-3 {
      width: 90px;
      height: 90px;
      bottom: 25%;
      left: 25%;
      animation: float 8s ease-in-out infinite;
    }
    .shape-4 {
      width: 60px;
      height: 60px;
      top: 35%;
      right: 25%;
      animation: float 6s ease-in-out infinite reverse;
    }
  </style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center p-4 relative">
  <!-- Floating Background Shapes -->
  <div class="floating-shapes">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
    <div class="shape shape-4"></div>
  </div>

  <!-- Login Card -->
  <div class="relative z-10 w-full max-w-md">
    <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl p-8 animate-slideInUp">
      <!-- Header -->
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-4 animate-pulse-slow">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
          </svg>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Welcome Back!</h2>
        <p class="text-gray-600">Masuk ke akun VolunteerNet Anda</p>
      </div>

      <!-- Form -->
      <form method="POST" action="{{ route('login') }}" class="space-y-6" id="loginForm">
        @csrf

        <!-- Email Address -->
        <div class="group">
          <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
            Email Address
          </label>
          <div class="relative">
            <input
              type="email"
              id="email"
              name="email"
              required
              autofocus
              class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 group-hover:border-blue-300"
              placeholder="you@example.com"
            >
            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
            </div>
            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-green-500 opacity-0 transition-opacity duration-300" id="emailCheck">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
            </div>
          </div>
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
              class="w-full px-4 py-3 pl-12 pr-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 group-hover:border-blue-300"
              placeholder="Enter your password"
            >
            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
              </svg>
            </div>
            <button
              type="button"
              onclick="togglePassword()"
              class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
            >
              <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
              </svg>
            </button>
          </div>
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input
              id="remember_me"
              name="remember"
              type="checkbox"
              class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition-colors"
            >
            <label for="remember_me" class="ml-2 block text-sm text-gray-700 cursor-pointer hover:text-gray-900 transition-colors">
              Remember Me
            </label>
          </div>
          <div class="text-sm">
            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300 hover:underline">
              Forgot Password?
            </a>
          </div>
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          id="submitBtn"
          class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 relative overflow-hidden"
        >
          <span class="flex items-center justify-center" id="btnContent">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
            </svg>
            Login
          </span>
          <!-- Loading spinner (hidden by default) -->
          <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300" id="loadingSpinner">
            <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
          </div>
        </button>

        <!-- Register Link -->
        <div class="text-center">
          <p class="text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300 hover:underline">
              Daftar di sini
            </a>
          </p>
        </div>

        <!-- Back to Home -->
        <div class="text-center pt-4 border-t border-gray-200">
          <a
            href="{{ route('home') }}"
            class="inline-flex items-center text-gray-600 hover:text-gray-800 transition-colors duration-300 group"
          >
            <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Halaman Utama
          </a>
        </div>
      </form>
    </div>

    <!-- Quick Stats (Floating Info Cards) -->
    <div class="absolute -top-20 -left-10 bg-white/20 backdrop-blur-sm rounded-2xl p-4 text-white animate-bounce-slow hidden md:block">
      <div class="flex items-center space-x-2">
        <svg class="w-8 h-8 text-yellow-300" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
        </svg>
        <div>
          <p class="text-sm font-semibold">1000+</p>
          <p class="text-xs opacity-80">Active Volunteers</p>
        </div>
      </div>
    </div>

    <div class="absolute -bottom-16 -right-10 bg-white/20 backdrop-blur-sm rounded-2xl p-4 text-white animate-bounce-slow delay-1000 hidden md:block">
      <div class="flex items-center space-x-2">
        <svg class="w-8 h-8 text-green-300" fill="currentColor" viewBox="0 0 24 24">
          <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div>
          <p class="text-sm font-semibold">500+</p>
          <p class="text-xs opacity-80">Projects Done</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordField = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');

      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
        `;
      } else {
        passwordField.type = 'password';
        eyeIcon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        `;
      }
    }

    // Enhanced form interactions
    document.addEventListener('DOMContentLoaded', function() {
      const emailInput = document.getElementById('email');
      const passwordInput = document.getElementById('password');
      const emailCheck = document.getElementById('emailCheck');
      const submitBtn = document.getElementById('submitBtn');
      const btnContent = document.getElementById('btnContent');
      const loadingSpinner = document.getElementById('loadingSpinner');
      const form = document.getElementById('loginForm');

      // Email validation with visual feedback
      emailInput.addEventListener('input', function() {
        const email = this.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (emailRegex.test(email)) {
          this.classList.remove('border-red-300');
          this.classList.add('border-green-300');
          emailCheck.classList.remove('opacity-0');
          emailCheck.classList.add('opacity-100');
        } else {
          this.classList.remove('border-green-300');
          this.classList.add('border-red-300');
          emailCheck.classList.remove('opacity-100');
          emailCheck.classList.add('opacity-0');
        }
      });

      // Password field visual feedback
      passwordInput.addEventListener('input', function() {
        if (this.value.length >= 6) {
          this.classList.remove('border-red-300');
          this.classList.add('border-green-300');
        } else if (this.value.length > 0) {
          this.classList.remove('border-green-300');
          this.classList.add('border-yellow-300');
        } else {
          this.classList.remove('border-green-300', 'border-yellow-300');
        }
      });

      // Enhanced form submission with loading state
      form.addEventListener('submit', function(e) {
        // Show loading state
        btnContent.classList.add('opacity-0');
        loadingSpinner.classList.remove('opacity-0');
        loadingSpinner.classList.add('opacity-100');
        submitBtn.disabled = true;

        // Simulate loading (remove this in production)
        setTimeout(() => {
          btnContent.classList.remove('opacity-0');
          loadingSpinner.classList.remove('opacity-100');
          loadingSpinner.classList.add('opacity-0');
          submitBtn.disabled = false;
        }, 2000);
      });

      // Add subtle animations to inputs
      const inputs = document.querySelectorAll('input');
      inputs.forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.classList.add('transform', 'scale-105');
        });

        input.addEventListener('blur', function() {
          this.parentElement.classList.remove('transform', 'scale-105');
        });
      });

      // Keyboard shortcuts
      document.addEventListener('keydown', function(e) {
        // Alt + L to focus email
        if (e.altKey && e.key === 'l') {
          e.preventDefault();
          emailInput.focus();
        }
        // Alt + P to focus password
        if (e.altKey && e.key === 'p') {
          e.preventDefault();
          passwordInput.focus();
        }
      });

      // Welcome message animation
      setTimeout(() => {
        const welcomeText = document.querySelector('h2');
        welcomeText.classList.add('animate-wiggle');
        setTimeout(() => {
          welcomeText.classList.remove('animate-wiggle');
        }, 1000);
      }, 1000);
    });

    // Fun Easter egg - Konami code
    let konamiCode = [];
    const konamiSequence = [
      'ArrowUp', 'ArrowUp', 'ArrowDown', 'ArrowDown',
      'ArrowLeft', 'ArrowRight', 'ArrowLeft', 'ArrowRight',
      'KeyB', 'KeyA'
    ];

    document.addEventListener('keydown', function(e) {
      konamiCode.push(e.code);

      if (konamiCode.length > konamiSequence.length) {
        konamiCode.shift();
      }

      if (konamiCode.join('') === konamiSequence.join('')) {
        // Easter egg activated!
        document.body.style.filter = 'hue-rotate(180deg)';
        setTimeout(() => {
          document.body.style.filter = 'none';
        }, 3000);
        konamiCode = [];
      }
    });
  </script>
</body>
</html>
