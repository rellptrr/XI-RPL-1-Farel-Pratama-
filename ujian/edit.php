<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
  $nis = $_POST['nis'];
  $nama = $_POST['nama'];
  $kelas = $_POST['kelas'];
  $alamat = $_POST['alamat'];

  $update = mysqli_query($koneksi, "UPDATE siswa SET nis='$nis', nama='$nama', kelas='$kelas', alamat='$alamat' WHERE id='$id'");

  if ($update) {
    echo "<script>alert('Data berhasil diubah!'); window.location='dashboard.php';</script>";
  } else {
    echo "<script>alert('Gagal mengubah data!');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Data Siswa</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Edit Data Siswa</h1>
    <nav>
      <a href="dashboard.php">Kembali</a>
    </nav>
  </header>

  <div class="login-container">
    <form method="POST">
      <input type="text" name="nis" value="<?php echo $data['nis']; ?>" required>
      <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>
      <input type="text" name="kelas" value="<?php echo $data['kelas']; ?>" required>
      <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>" required>
      <button type="submit" name="update">Update</button>
    </form>
  </div>
</body>
</html>
