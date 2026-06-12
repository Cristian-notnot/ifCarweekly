<?php
// ahdata.php — Handler aman untuk menyimpan data mahasiswa
// Menggunakan fungsi yang ada di fungsi.php (prosesUploadFoto, insertMahasiswa)

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/fungsi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('tambahdata.php');
}

$nama    = trim(strip_tags($_POST['nama']    ?? ''));
$nim     = trim(strip_tags($_POST['nim']     ?? ''));
$jurusan = trim(strip_tags($_POST['jurusan'] ?? ''));
$email   = trim(strip_tags($_POST['email']   ?? ''));
$no_hp   = trim(strip_tags($_POST['no_hp']   ?? ''));

if (empty($nama) || empty($nim)) {
    die('Nama dan NIM wajib diisi.');
}

if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Format email tidak valid.');
}

$fotoNama = '';
$adaFile = isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE;

if ($adaFile) {
    try {
        $fotoNama = prosesUploadFoto($_FILES['foto']);
    } catch (RuntimeException $e) {
        die('Upload gagal: ' . $e->getMessage());
    }
} else {
    die('Foto wajib diupload.');
}

try {
    $ok = insertMahasiswa($nama, $nim, $jurusan, $email, $no_hp, $fotoNama);
} catch (mysqli_sql_exception $e) {
    // jika gagal, hapus foto yang sudah terupload
    hapusFotoFisik($fotoNama);
    error_log('Insert mahasiswa gagal: ' . $e->getMessage());
    die('Gagal menyimpan data. Silakan coba lagi.');
}

redirect('mahasiswa.php', 'added');
