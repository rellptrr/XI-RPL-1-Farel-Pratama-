<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

$id = $_GET['id'];
$hapus = mysqli_query($koneksi, "DELETE FROM siswa WHERE id='$id'");

if ($hapus) {
  echo "<script>alert('Data berhasil dihapus!'); window.location='dashboard.php';</script>";
} else {
  echo "<script>alert('Gagal menghapus data!');</script>";
}
?>
