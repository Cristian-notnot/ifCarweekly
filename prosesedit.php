<?php
// =============================================================
// prosesedit.php — Proses UPDATE data mahasiswa
// Dependensi: config.php, fungsi.php
// Hanya menerima POST dari editdata.php
// =============================================================

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/fungsi.php';

// --- Guard: tolak selain POST ---
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('mahasiswa.php');
}

// --- Validasi ID ---
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if (!$id) {
    redirect('mahasiswa.php', 'error');
}

// --- Pastikan data lama ada ---
$mhs = getMahasiswaById($id);
if (!$mhs) {
    redirect('mahasiswa.php', 'error');
}

// --- Ambil & bersihkan input teks ---
$nama    = trim(strip_tags($_POST['nama']    ?? ''));
$nim     = trim(strip_tags($_POST['nim']     ?? ''));
$jurusan = trim(strip_tags($_POST['jurusan'] ?? ''));
$email   = trim(strip_tags($_POST['email']   ?? ''));
$no_hp   = trim(strip_tags($_POST['no_hp']   ?? ''));

// --- Validasi field wajib ---
if (empty($nama) || empty($nim)) {
    die('Nama dan NIM wajib diisi.');
}
if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Format email tidak valid.');
}

// --- Proses foto ---
// Jika user upload foto baru → upload & hapus foto lama.
// Jika tidak → pertahankan nama foto lama.
$fotoLama  = $mhs['foto'];
$fotoBaru  = $fotoLama; // default: pakai foto lama

$adaFileBaru = isset($_FILES['foto'])
    && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE
    && !empty($_FILES['foto']['name']);

if ($adaFileBaru) {
    try {
        $fotoBaru = prosesUploadFoto($_FILES['foto']);
    } catch (RuntimeException $e) {
        die('Upload foto gagal: ' . $e->getMessage());
    }
}

// --- Simpan perubahan ke database ---
try {
    $ok = updateMahasiswa($id, $nama, $nim, $jurusan, $email, $no_hp, $fotoBaru);
} catch (mysqli_sql_exception $e) {
    // Rollback: hapus foto baru yang terlanjur terupload
    if ($adaFileBaru) {
        hapusFotoFisik($fotoBaru);
    }
    if ($e->getCode() === 1062) {
        die('NIM sudah digunakan mahasiswa lain.');
    }
    error_log('Update mahasiswa gagal: ' . $e->getMessage());
    die('Gagal memperbarui data. Silakan coba lagi.');
}

// --- Hapus foto lama jika berhasil diganti ---
if ($ok && $adaFileBaru && !empty($fotoLama) && $fotoLama !== $fotoBaru) {
    hapusFotoFisik($fotoLama);
}

// --- Redirect ---
redirect('mahasiswa.php', 'updated');