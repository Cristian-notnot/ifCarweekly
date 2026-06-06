<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home — IfCarweekly</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php
require_once __DIR__ . '/config.php';
include __DIR__ . '/navbar.php';
?>

<div class="container">
    <div class="card">
        <div class="hero-section">
            <div class="hero-image-wrap">
                <img src="assets/images/jerome_powell.jpg"
                     alt="Foto Dekan Charly Agusta Cristiano">
            </div>
            <div class="hero-content">
                <span class="tag">Sambutan Dekan</span>
                <h1>Charly Agusta Cristiano</h1>
                <p class="jabatan">Dekan Fakultas Ilmu Komputer &nbsp;&middot;&nbsp; 2024–2025</p>
                <p>
                    Selamat datang di Fakultas Ilmu Komputer. Kami berkomitmen
                    mencetak lulusan yang tidak hanya kompeten secara teknis, tetapi juga
                    mampu berinovasi dan beradaptasi dengan perkembangan teknologi global.
                </p>
                <div class="hero-actions">
                    <a href="profile.php"  class="btn btn-teal">Lihat Profile</a>
                    <a href="contact.php"  class="btn btn-outline">Hubungi Kami</a>
                    <a href="mahasiswa.php" class="btn btn-outline">Data Mahasiswa</a>
                </div>
            </div>
        </div>
    </div>

    <div class="info-grid">
        <div class="info-box">
            <h4>
                <span class="icon">&#127942;</span>
                Prestasi
            </h4>
            <ul>
                <li>Kaprodi terbaik tahun 2024–2025</li>
                <li>Juara pelari Kalcer tercepat se Jawa Tengah</li>
            </ul>
        </div>

        <div class="info-box">
            <h4>
                <span class="icon">&#128188;</span>
                Jabatan
            </h4>
            <ul>
                <li>Kaprodi Teknik Informatika</li>
                <li>Dosen Pengampu Mata Kuliah</li>
            </ul>
        </div>

        <div class="info-box">
            <h4>
                <span class="icon">&#128218;</span>
                Program Studi
            </h4>
            <ul>
                <li>Informatika</li>
                <li>Sistem Informasi</li>
                <li>Artificial Intelligence</li>
            </ul>
        </div>
    </div>
</div>

</body>
</html>