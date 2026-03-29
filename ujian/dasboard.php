<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM siswa");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Dashboard Data Siswa</h1>
    <nav>
      <a href="index.php">Beranda</a>
      <a href="tambah.php">Tambah Data</a>
      <a href="logout.php">Logout</a>
    </nav>
  </header>

  <div class="table-container">
    <h2>Daftar Siswa</h2>
    <table>
      <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
      <?php
      $no = 1;
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
                  <td>$no</td>
                  <td>{$row['nis']}</td>
                  <td>{$row['nama']}</td>
                  <td>{$row['kelas']}</td>
                  <td>{$row['alamat']}</td>
                  <td>
                      <a href='edit.php?id={$row['id']}' class='btn-edit'>Edit</a>
                      <a href='hapus.php?id={$row['id']}' class='btn-hapus' onclick='return confirm(\"Yakin?\")'>Hapus</a>
                  </td>
                </tr>";
          $no++;
      }
      ?>
    </table>
  </div>
</body>
</html>
