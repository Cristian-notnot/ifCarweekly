<?php
// =============================================================
// prosestambah.php — Proses INSERT data mahasiswa
// Dependensi: config.php, fungsi.php
// Hanya menerima POST dari tambahdata.php
// =============================================================

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/fungsi.php';

// --- Guard: tolak selain POST ---
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('tambahdata.php');
}

// --- Ambil & bersihkan input teks ---
// strip_tags + trim untuk input.
// htmlspecialchars TIDAK dilakukan di sini — hanya saat OUTPUT ke HTML (pakai e()).
$nama    = trim(strip_tags($_POST['nama']    ?? ''));
$nim     = trim(strip_tags($_POST['nim']     ?? ''));
$jurusan = trim(strip_tags($_POST['jurusan'] ?? ''));
$email   = trim(strip_tags($_POST['email']   ?? ''));
$no_hp   = trim(strip_tags($_POST['no_hp']   ?? ''));

// --- Validasi field wajib ---
if (empty($nama) || empty($nim)) {
    die('Nama dan NIM wajib diisi.');
}

// --- Validasi email (opsional, tapi kalau diisi harus valid) ---
if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Format email tidak valid.');
}

// --- Proses upload foto ---
// prosesUploadFoto() ada di fungsi.php, melempar RuntimeException jika gagal.
// Ini menggantikan: validasi lemah lama + ALTER TABLE yang berbahaya.
$namaFile = '';

$adaFile = isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE;

if ($adaFile) {
    try {
        $namaFile = prosesUploadFoto($_FILES['foto']);
    } catch (RuntimeException $e) {
        die('Upload gagal: ' . $e->getMessage());
    }
} else {
    // Foto diwajibkan di form (required), tapi tambahkan guard di sini juga
    die('Foto wajib diupload.');
}

// --- Simpan ke database ---
try {
    $ok = insertMahasiswa($nama, $nim, $jurusan, $email, $no_hp, $namaFile);
} catch (mysqli_sql_exception $e) {
    // Rollback: hapus file yang sudah terupload
    hapusFotoFisik($namaFile);

    // Kode 1062 = Duplicate entry (NIM sudah ada)
    if ($e->getCode() === 1062) {
        die('NIM sudah terdaftar. Gunakan NIM yang berbeda.');
    }
    // Di produksi: log $e->getMessage() ke file, jangan tampilkan ke user
    error_log('Insert mahasiswa gagal: ' . $e->getMessage());
    die('Gagal menyimpan data. Silakan coba lagi.');
}

// --- Redirect ke halaman daftar dengan pesan sukses ---
redirect('mahasiswa.php', 'added');