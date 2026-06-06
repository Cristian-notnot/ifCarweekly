<?php
// =============================================================
// deletedata.php — Proses HAPUS data mahasiswa
// Dependensi: config.php, fungsi.php
// Dipanggil via link dari mahasiswa.php (GET + onclick confirm)
// =============================================================

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/fungsi.php';

// --- Validasi ID ---
// (int) cast saja tidak cukup — gunakan filter_input untuk validasi ketat
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

if (!$id) {
    redirect('mahasiswa.php', 'error');
}

// --- Hapus dari DB dan dapatkan nama file foto ---
try {
    $namaFoto = deleteMahasiswa($id);
} catch (mysqli_sql_exception $e) {
    error_log('Delete mahasiswa gagal: ' . $e->getMessage());
    redirect('mahasiswa.php', 'error');
}

// --- Hapus file foto fisik (jika ada) ---
// hapusFotoFisik() ada di fungsi.php — aman, pakai basename() untuk cegah path traversal
if ($namaFoto !== null) {
    hapusFotoFisik($namaFoto);
}

// --- Redirect ---
redirect('mahasiswa.php', 'deleted');