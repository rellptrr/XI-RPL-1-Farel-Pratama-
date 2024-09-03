<?php
// Data Profil
$nama = "Raka Maulana";
$umur = 25;
$gender = "Laki-laki";
$sekolah = "Permanufakturan Universitas Teknologi Internasional Negeri Gorontalo (PUTING)";
$cita_cita = "Menjadi CEO Google";
$cewe = "Beriman kepada Tuhan";
$image_src = "the rock.jfif";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Singkat</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to left, #003366, #4F4F4F);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            padding: 30px;
            max-width: 600px;
            width: 100%;
            text-align: center;
            color: #333;
        }
        h1 {
            color: #002F6C;
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 600;
        }
        p {
            font-size: 18px;
            line-height: 1.8;
            margin: 10px 0;
            color: #555;
        }
        strong {
            color: #002F6C;
        }
        .profile-info {
            background-color: #F4F4F4;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            border: 1px solid #DDD;
        }
        .profile-img {
            border-radius: 50%;
            width: 180px;
            height: 180px;
            object-fit: cover;
            margin-bottom: 20px;
            border: 4px solid #002F6C;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Profil Singkat</h1>
        <img src="<?php echo $image_src; ?>" alt="Profile Picture" class="profile-img">
        <div class="profile-info">
            <p><strong>Nama:</strong> <?php echo $nama; ?></p>
            <p><strong>Umur:</strong> <?php echo $umur; ?> tahun</p>
            <p><strong>Gender:</strong> <?php echo $gender; ?></p>
            <p><strong>Cita-cita:</strong> <?php echo $cita_cita; ?></p>
            <p><strong>Tipikal Cewe:</strong> <?php echo $cewe; ?></p>
            <p><strong>Sekolah:</strong> <?php echo $sekolah; ?></p>
        </div>
    </div>
</body>
</html>
