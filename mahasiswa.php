<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa — IfCarweekly</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/fungsi.php';
include __DIR__ . '/navbar.php';

// Ambil semua data
$mahasiswas = getAllMahasiswa();

// Pesan flash dari redirect setelah proses CRUD
$alertMap = [
    'added'   => ['tipe' => 'success', 'ikon' => '&#10003;', 'teks' => 'Data mahasiswa berhasil ditambahkan.'],
    'updated' => ['tipe' => 'success', 'ikon' => '&#10003;', 'teks' => 'Data mahasiswa berhasil diperbarui.'],
    'deleted' => ['tipe' => 'danger',  'ikon' => '&#9888;',  'teks' => 'Data mahasiswa berhasil dihapus.'],
    'error'   => ['tipe' => 'warning', 'ikon' => '&#9888;',  'teks' => 'Terjadi kesalahan. Silakan coba lagi.'],
];
$alertKey  = isset($_GET['status']) ? e($_GET['status']) : '';
$alertData = $alertMap[$alertKey] ?? null;
?>

<div class="container">
    <div class="card">
        <div class="page-header">
            <h2>Data Mahasiswa</h2>
            <a href="tambahdata.php" class="btn btn-teal">
                &#43; Tambah Data
            </a>
        </div>

        <?php if ($alertData): ?>
            <div class="alert alert-<?= $alertData['tipe'] ?>">
                <span class="alert-icon"><?= $alertData['ikon'] ?></span>
                <span><?= $alertData['teks'] ?></span>
            </div>
        <?php endif; ?>

        <?php if (empty($mahasiswas)): ?>
            <div class="empty-state">
                <div class="empty-icon">&#128100;</div>
                <p>Belum ada data mahasiswa yang terdaftar.</p>
                <a href="tambahdata.php" class="btn btn-teal">+ Tambah Mahasiswa Pertama</a>
            </div>

        <?php else: ?>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Jurusan</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($mahasiswas as $i => $mhs): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>

                            <td>
                                <?php if (!empty($mhs['foto'])): ?>
                                    <img
                                        class="foto-thumb"
                                        src="<?= e(UPLOAD_URL . $mhs['foto']) ?>"
                                        alt="Foto <?= e($mhs['nama']) ?>"
                                        loading="lazy"
                                    >
                                <?php else: ?>
                                    <div class="no-foto" title="Tidak ada foto">&#128100;</div>
                                <?php endif; ?>
                            </td>

                            <!-- Semua output di-escape dengan e() untuk mencegah XSS -->
                            <td style="font-weight:600"><?= e($mhs['nama']) ?></td>
                            <td style="font-family:monospace"><?= e($mhs['nim']) ?></td>

                            <td>
                                <?php if (!empty($mhs['jurusan'])): ?>
                                    <span class="badge-jurusan"><?= e($mhs['jurusan']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if (!empty($mhs['email'])): ?>
                                    <a href="mailto:<?= e($mhs['email']) ?>"><?= e($mhs['email']) ?></a>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>

                            <td><?= e($mhs['no_hp'] ?: '—') ?></td>

                            <td>
                                <div class="action-cell">
                                    <a href="editdata.php?id=<?= (int)$mhs['id'] ?>"
                                       class="btn btn-warning btn-sm">
                                        &#9998; Edit
                                    </a>
                                    <a href="deletedata.php?id=<?= (int)$mhs['id'] ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Hapus data <?= e(addslashes($mhs['nama'])) ?>?\nTindakan ini tidak bisa dibatalkan.')">
                                        &#128465; Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div><!-- .table-responsive -->

            <p class="text-muted text-sm mt-2">
                Total: <?= count($mahasiswas) ?> mahasiswa terdaftar.
            </p>
        <?php endif; ?>

    </div><!-- .card -->
</div><!-- .container -->

</body>
</html>