<?php
include "koneksi.php";
session_start();

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM datas WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION["username"] = $user["username"];
    header("Location: dashboard.php");
    exit();
  } else {
    $error = "❌ Username atau password salah!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Sistem Data Pendaftaran Siswa</title>
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #e8f0fe;
      background-image: linear-gradient(120deg, #e0f2ff 0%, #f6fbff 100%);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-card {
      background-color: #ffffff;
      border: 1px solid #cde4ff;
      border-radius: 15px;
      padding: 40px;
      width: 400px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      transition: 0.3s;
    }

    .login-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .login-card h2 {
      text-align: center;
      color: #004aad;
      margin-bottom: 20px;
    }

    .login-card img {
      display: block;
      margin: 0 auto 10px;
      width: 80px;
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-8px); }
    }

    label {
      display: block;
      font-weight: 600;
      color: #004aad;
      margin-bottom: 6px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #b3d1ff;
      border-radius: 8px;
      margin-bottom: 15px;
      font-size: 1rem;
      transition: 0.3s;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
      outline: none;
    }

    .btn-login {
      background-color: #004aad;
      color: white;
      border: none;
      padding: 12px 0;
      width: 100%;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
    }

    .btn-login:hover {
      background-color: #0066ff;
      transform: scale(1.03);
      box-shadow: 0 0 10px rgba(0, 102, 255, 0.5);
    }

    .error {
      background-color: #ffe0e0;
      color: #b30000;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 15px;
      text-align: center;
      font-size: 0.9rem;
      border: 1px solid #ffb3b3;
    }

    .back-link {
      display: inline-block;
      margin-top: 15px;
      text-align: center;
      width: 100%;
      color: #004aad;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
    }

    .back-link:hover {
      color: #0066ff;
      text-decoration: underline;
    }

    .footer {
      text-align: center;
      font-size: 0.8rem;
      color: #666;
      margin-top: 15px;
    }

    /* === tampilan kotak tabel seperti halaman data siswa === */
    .login-card {
      background: linear-gradient(180deg, #ffffff 60%, #f8fbff 100%);
      border: 1px solid #dce9ff;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <img src="https://i.ibb.co/ys6Q9D3/school.png" alt="Logo Sekolah">
    <h2>Login Akun</h2>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <form action="" method="POST">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="Masukkan Username" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Masukkan Password" required>

      <button type="submit" name="login" class="btn-login">Masuk</button>
    </form>

    <a href="index.php" class="back-link">← Kembali ke Beranda</a>
    <div class="footer">© 2025 Sekolah Cerdas. All Rights Reserved.</div>
  </div>

</body>
</html>
