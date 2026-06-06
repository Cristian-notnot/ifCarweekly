<?php
// =============================================================
// fungsi.php — Helper Fungsi & Database
// Dependensi: config.php
// =============================================================

require_once __DIR__ . '/config.php';

// -------------------------------------------------------------
// KONEKSI — Singleton Pattern
// Koneksi dibuat sekali per request, dipakai ulang.
// Menghindari overhead buka-tutup koneksi berulang kali.
// -------------------------------------------------------------
function koneksi(): mysqli
{
    static $conn = null;

    if ($conn === null) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $conn->set_charset('utf8mb4');
    }

    return $conn;
}

// -------------------------------------------------------------
// OUTPUT ESCAPING — Cegah XSS
// Selalu pakai e() saat menampilkan data ke HTML.
// Jangan pakai htmlspecialchars di input/DB — hanya di output.
// -------------------------------------------------------------
function e(string $val): string
{
    return htmlspecialchars($val, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// -------------------------------------------------------------
// REDIRECT dengan pesan status
// -------------------------------------------------------------
function redirect(string $url, string $status = ''): void
{
    $loc = $status ? $url . '?status=' . urlencode($status) : $url;
    header('Location: ' . $loc);
    exit;
}

// -------------------------------------------------------------
// AMBIL SEMUA MAHASISWA
// -------------------------------------------------------------
function getAllMahasiswa(): array
{
    return koneksi()
        ->query('SELECT * FROM mahasiswa ORDER BY id DESC')
        ->fetch_all(MYSQLI_ASSOC);
}

// -------------------------------------------------------------
// CARI MAHASISWA BERDASARKAN ID
// -------------------------------------------------------------
function getMahasiswaById(int $id): ?array
{
    $stmt = koneksi()->prepare('SELECT * FROM mahasiswa WHERE id = ? LIMIT 1');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $row ?: null;
}

// -------------------------------------------------------------
// INSERT MAHASISWA BARU
// -------------------------------------------------------------
function insertMahasiswa(
    string $nama, string $nim, string $jurusan,
    string $email, string $no_hp, string $foto
): bool {
    $stmt = koneksi()->prepare(
        'INSERT INTO mahasiswa (nama, nim, jurusan, email, no_hp, foto)
         VALUES (?, ?, ?, ?, ?, ?)'
    );
    $stmt->bind_param('ssssss', $nama, $nim, $jurusan, $email, $no_hp, $foto);
    $ok = $stmt->execute();
    $stmt->close();
    return $ok;
}

// -------------------------------------------------------------
// UPDATE MAHASISWA
// -------------------------------------------------------------
function updateMahasiswa(
    int $id, string $nama, string $nim, string $jurusan,
    string $email, string $no_hp, string $foto
): bool {
    $stmt = koneksi()->prepare(
        'UPDATE mahasiswa
         SET nama=?, nim=?, jurusan=?, email=?, no_hp=?, foto=?
         WHERE id=?'
    );
    $stmt->bind_param('ssssssi', $nama, $nim, $jurusan, $email, $no_hp, $foto, $id);
    $ok = $stmt->execute();
    $stmt->close();
    return $ok;
}

// -------------------------------------------------------------
// HAPUS MAHASISWA
// -------------------------------------------------------------
function deleteMahasiswa(int $id): ?string
{
    // Ambil nama foto dulu sebelum dihapus (untuk hapus file fisik)
    $mhs = getMahasiswaById($id);
    if (!$mhs) return null;

    $stmt = koneksi()->prepare('DELETE FROM mahasiswa WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();

    return $mhs['foto']; // kembalikan nama file foto
}

// -------------------------------------------------------------
// PROSES UPLOAD FOTO
// Mengembalikan nama file baru, atau melempar Exception jika gagal.
// -------------------------------------------------------------
function prosesUploadFoto(array $file): string
{
    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Upload gagal dengan kode error: ' . $file['error']);
    }

    if ($file['size'] > MAX_FILE_SIZE) {
        throw new RuntimeException('Ukuran foto melebihi batas 2 MB.');
    }

    // Validasi MIME type (lebih aman dari ekstensi)
    $finfo    = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($file['tmp_name']);

    if (!in_array($mimeType, ALLOWED_MIME, true)) {
        throw new RuntimeException('Tipe file tidak diizinkan. Gunakan JPG, PNG, GIF, atau WEBP.');
    }

    // Validasi ekstensi
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ALLOWED_EXT, true)) {
        throw new RuntimeException('Ekstensi file tidak valid.');
    }

    // Nama file acak — mencegah overwrite & path traversal
    $namaFile = bin2hex(random_bytes(16)) . '.' . $ext;

    // Buat folder jika belum ada
    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0755, true);
    }

    if (!move_uploaded_file($file['tmp_name'], UPLOAD_DIR . $namaFile)) {
        throw new RuntimeException('Gagal memindahkan file ke server.');
    }

    return $namaFile;
}

// -------------------------------------------------------------
// HAPUS FILE FOTO FISIK (aman — cek dulu sebelum unlink)
// -------------------------------------------------------------
function hapusFotoFisik(string $namaFile): void
{
    if (empty($namaFile)) return;
    $path = UPLOAD_DIR . basename($namaFile); // basename() cegah path traversal
    if (file_exists($path)) {
        unlink($path);
    }
}