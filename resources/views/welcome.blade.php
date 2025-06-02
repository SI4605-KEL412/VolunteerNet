<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Welcome | Volunteer Net</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'fade-in-down': 'fadeInDown 1.2s ease-in-out',
            'fade-in': 'fadeIn 1.5s ease-in-out',
            'bounce-slow': 'bounce 2s infinite',
            'pulse-slow': 'pulse 3s infinite',
            'float': 'float 3s ease-in-out infinite',
          },
          keyframes: {
            fadeInDown: {
              '0%': {
                opacity: '0',
                transform: 'translateY(-20px)'
              },
              '100%': {
                opacity: '1',
                transform: 'translateY(0)'
              }
            },
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' }
            },
            float: {
              '0%, 100%': { transform: 'translateY(0px)' },
              '50%': { transform: 'translateY(-10px)' }
            }
          }
        }
      }
    }
  </script>
  <style>
    html {
      scroll-behavior: smooth;
    }

    .gradient-bg {
      background: linear-gradient(135deg, #1e40af 0%, #3b82f6 30%, #6366f1 70%, #8b5cf6 100%);
    }

    .glass-effect {
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .hover-glow:hover {
      box-shadow: 0 0 30px rgba(59, 130, 246, 0.5);
    }

    .text-shadow {
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .card-hover {
      transition: all 0.3s ease;
    }

    .card-hover:hover {
      transform: translateY(-10px) scale(1.02);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .parallax-bg {
      background-attachment: fixed;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
</head>
<body class="overflow-x-hidden">

<!-- Hero Section -->
<section class="relative h-screen gradient-bg flex items-center justify-center text-white overflow-hidden">
  <!-- Animated Background Elements -->
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute top-10 left-10 w-20 h-20 bg-white bg-opacity-10 rounded-full animate-float"></div>
    <div class="absolute top-20 right-20 w-16 h-16 bg-white bg-opacity-10 rounded-full animate-float" style="animation-delay: 1s;"></div>
    <div class="absolute bottom-20 left-20 w-24 h-24 bg-white bg-opacity-10 rounded-full animate-float" style="animation-delay: 2s;"></div>
    <div class="absolute bottom-10 right-10 w-12 h-12 bg-white bg-opacity-10 rounded-full animate-float" style="animation-delay: 0.5s;"></div>
  </div>

  <!-- Main Content -->
  <div class="text-center px-6 relative z-10">
    <h1 class="text-6xl md:text-7xl font-bold mb-6 animate-fade-in-down text-shadow">
      Welcome to
      <span class="bg-gradient-to-r from-yellow-300 to-orange-400 bg-clip-text text-transparent">
        VolunteerNet
      </span>
    </h1>
    <p class="text-xl md:text-2xl mb-8 animate-fade-in text-blue-100 max-w-2xl mx-auto">
      Gabung jadi relawan atau admin untuk dampak yang lebih besar!
    </p>

    <!-- CTA Buttons -->
    <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12 animate-fade-in" style="animation-delay: 0.3s;">
      <a href="{{ route('login') }}" class="group relative px-8 py-4 bg-white text-blue-600 font-semibold rounded-full hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 hover-glow shadow-lg inline-block">
        <span class="relative z-10">Login</span>
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
      </a>
      <a href="{{ route('register') }}" class="group relative px-8 py-4 glass-effect text-white font-semibold rounded-full hover:bg-white hover:bg-opacity-20 transition-all duration-300 transform hover:scale-105 border-2 border-white border-opacity-30 inline-block">
        <span class="relative z-10">Register</span>
      </a>
    </div>

    <!-- Scroll Indicator -->
    <div class="animate-bounce-slow cursor-pointer" onclick="document.getElementById('carousel').scrollIntoView({behavior: 'smooth'})">
      <div class="mx-auto w-6 h-10 border-2 border-white rounded-full flex justify-center">
        <div class="w-1 h-3 bg-white rounded-full mt-2 animate-pulse"></div>
      </div>
      <p class="mt-2 text-sm opacity-80">Scroll Down</p>
    </div>
  </div>

  <!-- Wave Animation at Bottom -->
  <div class="absolute bottom-0 left-0 w-full overflow-hidden">
    <svg class="relative block w-full h-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" fill="white"></path>
    </svg>
  </div>
</section>

<!-- Carousel Section -->
<section id="carousel" class="relative bg-white py-20">
  <div class="container mx-auto px-4">
    <div class="text-center mb-12">
      <h2 class="text-4xl font-bold text-gray-800 mb-4 animate-fade-in-down">
        Bergabunglah dengan Gerakan Kebaikan
      </h2>
      <p class="text-xl text-gray-600 animate-fade-in">
        Lihat bagaimana relawan membuat perbedaan di seluruh dunia
      </p>
    </div>

    <!-- Interactive Carousel -->
    <div class="relative max-w-4xl mx-auto">
      <div id="image-carousel" class="relative overflow-hidden rounded-2xl shadow-2xl">
        <div class="carousel-container flex transition-transform duration-500 ease-in-out">
          <div class="carousel-slide min-w-full relative">
            <img src="https://radarlampung.disway.id/upload/2a6e9eb9b34168c9d78edcea53e10f46.jpeg"
                 class="w-full h-96 object-cover" alt="Volunteer Activity">
            <div class="absolute inset-0 bg-gradient-to-t from-black from-0% via-transparent to-transparent"></div>
            <div class="absolute bottom-6 left-6 text-white">
              <h3 class="text-2xl font-bold mb-2">Aksi Relawan</h3>
              <p class="text-sm opacity-90">Membantu sesama dengan penuh dedikasi</p>
            </div>
          </div>

          <div class="carousel-slide min-w-full relative">
            <img src="https://ap-southeast-2-seek-apac.graphassets.com/AEzBCRO50TYyqbV6XzRDQz/resize=width:1200,height:801/Cp1UFcHGR9KqHNIhE1Q3"
                 class="w-full h-96 object-cover" alt="Teamwork">
            <div class="absolute inset-0 bg-gradient-to-t from-black from-0% via-transparent to-transparent"></div>
            <div class="absolute bottom-6 left-6 text-white">
              <h3 class="text-2xl font-bold mb-2">Kerja Tim</h3>
              <p class="text-sm opacity-90">Bersama-sama mencapai tujuan mulia</p>
            </div>
          </div>

          <div class="carousel-slide min-w-full relative">
            <img src="https://awsimages.detik.net.id/community/media/visual/2023/01/03/aksi-pandawara-dengan-membuat-konten-bersih-bersih-sungai-banyak-mendapat-apresiasi-dari-berbagai-kalangan-1_169.jpeg?w=1200"
                 class="w-full h-96 object-cover" alt="Environmental Action">
            <div class="absolute inset-0 bg-gradient-to-t from-black from-0% via-transparent to-transparent"></div>
            <div class="absolute bottom-6 left-6 text-white">
              <h3 class="text-2xl font-bold mb-2">Aksi Lingkungan</h3>
              <p class="text-sm opacity-90">Menjaga bumi untuk generasi mendatang</p>
            </div>
          </div>
        </div>

        <!-- Carousel Controls -->
        <button id="prev-btn" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-sm text-white p-3 rounded-full transition-all duration-300 group">
          <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
        </button>

        <button id="next-btn" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-sm text-white p-3 rounded-full transition-all duration-300 group">
          <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </button>
      </div>

      <!-- Carousel Indicators -->
      <div class="flex justify-center mt-6 space-x-2">
        <button class="carousel-indicator w-3 h-3 bg-blue-500 rounded-full transition-all duration-300" data-slide="0"></button>
        <button class="carousel-indicator w-3 h-3 bg-gray-300 hover:bg-gray-400 rounded-full transition-all duration-300" data-slide="1"></button>
        <button class="carousel-indicator w-3 h-3 bg-gray-300 hover:bg-gray-400 rounded-full transition-all duration-300" data-slide="2"></button>
      </div>
    </div>
  </div>
</section>

<!-- About Section -->
<section class="relative bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-20">
  <div class="container mx-auto px-4">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-5xl font-bold text-gray-800 mb-8 animate-fade-in-down">
        Mengapa Bergabung?
      </h2>
      <p class="text-xl text-gray-600 mb-12 leading-relaxed animate-fade-in">
        Kami adalah platform yang menghubungkan individu peduli dengan organisasi yang membutuhkan.
        Daftar sebagai relawan atau EO, dan jadi bagian dari perubahan!
      </p>

      <!-- Feature Cards -->
      <div class="grid md:grid-cols-3 gap-8 mt-16">
        <div class="card-hover bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
          <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-semibold text-gray-800 mb-4">Komunitas Peduli</h3>
          <p class="text-gray-600">Bergabung dengan ribuan relawan yang memiliki visi sama untuk membuat dunia lebih baik.</p>
        </div>

        <div class="card-hover bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
          <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-semibold text-gray-800 mb-4">Dampak Nyata</h3>
          <p class="text-gray-600">Setiap aksi yang Anda lakukan memberikan dampak positif langsung kepada masyarakat.</p>
        </div>

        <div class="card-hover bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
          <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-semibold text-gray-800 mb-4">Pembelajaran</h3>
          <p class="text-gray-600">Dapatkan pengalaman berharga dan kembangkan keterampilan melalui kegiatan volunteering.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="relative gradient-bg py-20 text-white">
  <div class="container mx-auto px-4 text-center">
    <h2 class="text-4xl font-bold mb-6 animate-fade-in-down">
      Siap Membuat Perbedaan?
    </h2>
    <p class="text-xl mb-8 opacity-90 animate-fade-in">
      Bergabunglah dengan kami hari ini dan mulai perjalanan kebaikan Anda!
    </p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in">
      <button class="px-8 py-4 bg-white text-blue-600 font-semibold rounded-full hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
        Daftar Sebagai Relawan
      </button>
      <button class="px-8 py-4 glass-effect text-white font-semibold rounded-full hover:bg-white hover:bg-opacity-20 transition-all duration-300 transform hover:scale-105 border-2 border-white border-opacity-30">
        Daftar Sebagai EO
      </button>
    </div>
  </div>
</section>

<script>
// Carousel functionality
let currentSlide = 0;
const slides = document.querySelectorAll('.carousel-slide');
const indicators = document.querySelectorAll('.carousel-indicator');
const totalSlides = slides.length;

function updateCarousel() {
  const container = document.querySelector('.carousel-container');
  container.style.transform = `translateX(-${currentSlide * 100}%)`;

  // Update indicators
  indicators.forEach((indicator, index) => {
    if (index === currentSlide) {
      indicator.classList.remove('bg-gray-300');
      indicator.classList.add('bg-blue-500');
    } else {
      indicator.classList.remove('bg-blue-500');
      indicator.classList.add('bg-gray-300');
    }
  });
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % totalSlides;
  updateCarousel();
}

function prevSlide() {
  currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
  updateCarousel();
}

// Event listeners
document.getElementById('next-btn').addEventListener('click', nextSlide);
document.getElementById('prev-btn').addEventListener('click', prevSlide);

// Indicator clicks
indicators.forEach((indicator, index) => {
  indicator.addEventListener('click', () => {
    currentSlide = index;
    updateCarousel();
  });
});

// Auto-play carousel
setInterval(nextSlide, 5000);

// Smooth scrolling for navigation
document.addEventListener('DOMContentLoaded', function() {
  // Add scroll animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, observerOptions);

  // Observe all animated elements
  document.querySelectorAll('.animate-fade-in, .animate-fade-in-down, .card-hover').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(el);
  });
});

// Add parallax effect
window.addEventListener('scroll', () => {
  const scrolled = window.pageYOffset;
  const parallaxElements = document.querySelectorAll('.parallax-bg');

  parallaxElements.forEach(element => {
    const speed = 0.5;
    element.style.transform = `translateY(${scrolled * speed}px)`;
  });
});

// Add loading animation
window.addEventListener('load', () => {
  document.body.style.opacity = '1';
  document.body.style.transition = 'opacity 0.5s ease';
});

// Initially hide body for smooth loading
document.body.style.opacity = '0';
</script>

</body>
</html>
