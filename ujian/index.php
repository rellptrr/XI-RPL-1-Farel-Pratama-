<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda - Ujian</title>
  <style>
    /* ====== STYLE UNTUK BERANDA ====== */
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #dce7ff, #ffffff);
      color: #333;
    }

    /* HEADER */
    header {
      background-color: #004aad;
      color: white;
      text-align: center;
      padding: 20px 0;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    header h1 {
      margin: 0;
      font-size: 1.8rem;
    }

    nav {
      margin-top: 10px;
    }

    nav a {
      text-decoration: none;
      color: white;
      background-color: #007bff;
      padding: 10px 15px;
      border-radius: 5px;
      margin: 0 5px;
      transition: 0.3s;
    }

    nav a:hover {
      background-color: #0056b3;
    }

    /* HERO SECTION */
    .hero {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 80px 10%;
      gap: 50px;
      background: linear-gradient(to right, #f0f4ff, #ffffff);
    }

    .hero-text {
      flex: 1;
      max-width: 600px;
    }

    .hero-text h2 {
      font-size: 2.2rem;
      color: #004aad;
      margin-bottom: 15px;
    }

    .hero-text p {
      font-size: 1.1rem;
      color: #555;
      margin-bottom: 25px;
    }

    .btn {
      display: inline-block;
      background-color: #004aad;
      color: white;
      text-decoration: none;
      padding: 12px 25px;
      border-radius: 6px;
      transition: 0.3s;
      font-weight: 500;
    }

    .btn:hover {
      background-color: #0066ff;
      transform: scale(1.05);
    }

    .hero-image {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .hero-image img {
      max-width: 90%;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.2);
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }

    /* FOOTER */
    footer {
      background-color: #004aad;
      color: white;
      text-align: center;
      padding: 15px 0;
      position: relative;
      bottom: 0;
      width: 100%;
      margin-top: 40px;
    }

    footer p {
      margin: 0;
      font-size: 0.9rem;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
      .hero {
        flex-direction: column;
        text-align: center;
      }
      .hero-image img {
        width: 80%;
      }
    }
  </style>
</head>

<body>
  <header>
    <h1>Sistem Data Pendaftaran Siswa</h1>
    <nav>
      <a href="index.php">Beranda</a>
      <a href="login.php">Login</a>
      <a href="dashboard.php">Data Pendaftar</a>
    </nav>
  </header>

  <section class="hero">
    <div class="hero-text">
      <h2>Selamat Datang di Website Sekolah Cerdas</h2>
      <p>Kelola data siswa dengan mudah dan cepat. Akses sistem pendaftaran siswa hanya dengan beberapa klik!</p>
      <a href="login.php" class="btn">Mulai Sekarang</a>
    </div>
    <div class="hero-image">
      <img src="https://i.ibb.co/ys6Q9D3/school.png" alt="Sekolah">
    </div>
  </section>

  <footer>
    <p>&copy; 2025 Sekolah Cerdas. All Rights Reserved.</p>
  </footer>
</body>
</html>
