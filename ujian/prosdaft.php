<?php
// proses_daftar.php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: daftar.php');
    exit;
}

$nis = trim($_POST['nis']);
$nama = trim($_POST['nama']);
$kelas = trim($_POST['kelas']);
$alamat = trim($_POST['alamat']);

// upload foto
$uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

$fotoName = null;
if (!empty($_FILES['foto']['name'])) {
    $allowed = ['image/jpeg','image/png','image/jpg','image/webp'];
    $tmp = $_FILES['foto']['tmp_name'];
    $type = mime_content_type($tmp);
    if (!in_array($type, $allowed)) {
        echo "<script>alert('Format foto tidak didukung. Gunakan JPG/PNG.'); window.location='daftar.php';</script>";
        exit;
    }
    if ($_FILES['foto']['size'] > 2*1024*1024) {
        echo "<script>alert('Ukuran foto terlalu besar (max 2MB).'); window.location='daftar.php';</script>";
        exit;
    }
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $fotoName = uniqid('f_') . '.' . $ext;
    $dest = $uploadDir . $fotoName;
    if (!move_uploaded_file($tmp, $dest)) {
        echo "<script>alert('Gagal mengunggah foto.'); window.location='daftar.php';</script>";
        exit;
    }
}

// insert aman pakai prepared statement
$stmt = $koneksi->prepare("INSERT INTO pendaftar (nis,nama,kelas,alamat,foto) VALUES (?,?,?,?,?)");
$stmt->bind_param("sssss", $nis, $nama, $kelas, $alamat, $fotoName);
$ok = $stmt->execute();
$stmt->close();

if ($ok) {
    echo "<script>alert('Pendaftaran berhasil. Terima kasih!'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Gagal simpan data.'); window.location='daftar.php';</script>";
}
