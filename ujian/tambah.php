<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

if (isset($_POST['simpan'])) {
  $nis = $_POST['nis'];
  $nama = $_POST['nama'];
  $kelas = $_POST['kelas'];
  $alamat = $_POST['alamat'];

  $query = mysqli_query($koneksi, "INSERT INTO siswa (nis, nama, kelas, alamat) VALUES ('$nis','$nama','$kelas','$alamat')");

  if ($query) {
    echo "<script>alert('Data berhasil ditambahkan!'); window.location='dashboard.php';</script>";
  } else {
    echo "<script>alert('Gagal menambahkan data!');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Data Siswa</title>
  <link rel="stylesheet" href="style.css">
</head>
<bod
