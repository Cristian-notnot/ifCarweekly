<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact — IfCarweekly</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php
require_once __DIR__ . '/config.php';
include __DIR__ . '/navbar.php';
?>

<div class="container narrow">
    <div class="card simple-page">
        <h2>Hubungi Kami</h2>
        <p class="subtitle">Informasi kontak Fakultas Ilmu Komputer</p>
        <hr class="divider">

        <div class="contact-grid">
            <div class="contact-item">
                <strong>&#128205; Alamat</strong>
                Jl. Kedungmundu Raya No. 18, Semarang, Jawa Tengah 50275
            </div>
            <div class="contact-item">
                <strong>&#128222; Telepon</strong>
                <a href="tel:+6285727794394">(024) 85727794394</a>
            </div>
            <div class="contact-item">
                <strong>&#128231; Email</strong>
                <a href="mailto:ppg@unimus.ac.id">ppg@unimus.ac.id</a>
            </div>
            <div class="contact-item">
                <strong>&#128336; Jam Layanan</strong>
                Senin – Jumat, 08.00 – 16.00 WIB
            </div>
        </div>

        <p class="mt-3" style="font-size:14px; color:var(--c-text-3); text-align:center;">
            Untuk pertanyaan akademik, silakan kunjungi langsung ruang Fakultas Ilmu Komputer.
        </p>
    </div>
</div>

</body>
</html>