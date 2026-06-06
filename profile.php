<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile — IfCarweekly</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php
require_once __DIR__ . '/config.php';
include __DIR__ . '/navbar.php';
?>

<div class="container narrow">
    <div class="card simple-page">
        <h2>Profile Program Studi</h2>
        <p class="subtitle">Informasi tentang Program Studi Fakultas Ilmu Komputer</p>
        <hr class="divider">

        <p style="color:var(--c-text-2); font-size:14.5px; line-height:1.8;">
            Program Studi Fakultas Ilmu Komputer didirikan untuk mempersiapkan lulusan yang
            memiliki kompetensi di bidang rekayasa perangkat lunak, kecerdasan buatan,
            jaringan komputer, dan keamanan sistem informasi. Kurikulum kami dirancang
            mengikuti perkembangan industri teknologi terkini.
        </p>

        <div class="info-grid mt-2">
            <div class="info-box">
                <h4><span class="icon">&#128203;</span> Detail Prodi</h4>
                <ul>
                    <li>Akreditasi: <strong>Baik Sekali</strong></li>
                    <li>Gelar: S.Kom.</li>
                    <li>Masa Studi: 4 Tahun</li>
                    <li>Sistem: SKS</li>
                </ul>
            </div>
            <div class="info-box">
                <h4><span class="icon">&#127979;</span> Peminatan</h4>
                <ul>
                    <li>Software Engineering</li>
                    <li>Data Science & AI</li>
                    <li>Cybersecurity</li>
                    <li>IoT & Embedded System</li>
                </ul>
            </div>
        </div>
    </div>
</div>

</body>
</html>