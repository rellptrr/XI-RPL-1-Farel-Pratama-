<?php
// daftar.php - form pendaftaran
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Form Pendaftaran</title>
  <link rel="stylesheet" href="style.css"/>
</head>
<body>
  <header class="header">
    <div class="title">
      <img src="https://via.placeholder.com/80.png?text=Logo" alt="">
      <div>
        <h1>Form Pendaftaran</h1>
        <p>Isi data dengan lengkap</p>
      </div>
    </div>
    <div><a href="index.php" class="btn btn-primary">Kembali</a></div>
  </header>

  <div class="container">
    <div class="left">
      <div class="card">
        <form action="proses_daftar.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nis">NIS</label>
            <input type="text" name="nis" id="nis" required>
          </div>
          <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" required>
          </div>
          <div class="form-group">
            <label for="kelas">Kelas / Jurusan</label>
            <input type="text" name="kelas" id="kelas" required>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" required></textarea>
          </div>
          <div class="form-group">
            <label for="foto">Foto (jpg/png)</label>
            <input type="file" name="foto" id="foto" accept="image/*" required>
          </div>
          <button type="submit" class="btn btn-green">Kirim Pendaftaran</button>
        </form>
      </div>
    </div>

    <aside class="right">
      <div class="card">
        <h3>Perhatian</h3>
        <p>Pastikan foto jelas dan ukuran file tidak terlalu besar (maks ~2MB).</p>
      </div>
    </aside>
  </div>

  <div class="footer">© <?=date('Y')?> SMKN 2 Bandung</div>
</body>
</html>
