<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Welcome | Volunteer Net</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    html, body {
      scroll-behavior: smooth;
      margin: 0;
      padding: 0;
      min-height: 100%;
      background: linear-gradient(to bottom, #0066cc, #f0f8ff); /* biru ke putih */
      color: #003366;
    }

    .hero {
    height: 100vh;
    background: linear-gradient(135deg, #004080 0%, #0066cc 50%, #6a5acd 100%);
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    text-align: center;
    padding: 0 20px;
    }

    .btn-custom {
      width: 150px;
      margin: 10px;
      border-radius: 25px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      transition: transform 0.3s ease;
    }

    .btn-custom:hover {
      transform: scale(1.05);
    }

    .section {
    padding: 80px 20px;
    background: linear-gradient(to bottom, #ffffff 0%, #e6f0ff 50%, #ccddff 100%);
    }

    h1, h2 {
      animation: fadeInDown 1.2s ease-in-out;
    }

    p {
      animation: fadeIn 1.5s ease-in-out;
    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    /* Untuk menyamakan ukuran gambar carousel */
    .carousel-item img {
      height: 400px;
      object-fit: cover;
    }
  </style>
</head>
<body>

<!-- Hero Section -->
<section class="hero">
  <h1 class="mb-3">Welcome to VolunteerNet</h1>
  <p class="mb-4">Gabung jadi relawan atau admin untuk dampak yang lebih besar!</p>
  <div>
    <a href="{{ route('login') }}" class="btn btn-light btn-custom">Login</a>
    <a href="{{ route('register') }}" class="btn btn-outline-light btn-custom">Register</a>
  </div>
  <a href="#about" class="btn text-white mt-5">↓ Scroll Down</a>
</section>

<!-- Carousel Section -->
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://radarlampung.disway.id/upload/2a6e9eb9b34168c9d78edcea53e10f46.jpeg" class="d-block w-100" alt="Volunteer">
    </div>
    <div class="carousel-item">
      <img src="https://ap-southeast-2-seek-apac.graphassets.com/AEzBCRO50TYyqbV6XzRDQz/resize=width:1200,height:801/Cp1UFcHGR9KqHNIhE1Q3" class="d-block w-100" alt="Teamwork">
    </div>
    <div class="carousel-item">
      <img src="https://awsimages.detik.net.id/community/media/visual/2023/01/03/aksi-pandawara-dengan-membuat-konten-bersih-bersih-sungai-banyak-mendapat-apresiasi-dari-berbagai-kalangan-1_169.jpeg?w=1200" class="d-block w-100" alt="Helping">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<!-- Scroll Section -->
<section class="section" id="about">
  <div class="container">
    <h2 class="text-center mb-4">Mengapa Bergabung?</h2>
    <p class="lead text-center">
      Kami adalah platform yang menghubungkan individu peduli dengan organisasi yang membutuhkan. Daftar sebagai relawan atau EO, dan jadi bagian dari perubahan!
    </p>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
