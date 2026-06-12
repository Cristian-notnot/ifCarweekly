<?php
// =============================================================
// config.php — Konfigurasi Global Aplikasi
// Letakkan di root project. Jangan commit ke Git publik.
// =============================================================

// --- Database ---
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'ifcarweekly');

// --- Upload ---
define('UPLOAD_DIR', __DIR__ . '/aset/image/');  // path fisik server
define('UPLOAD_URL', 'aset/image/');              // path untuk HTML src=""

// --- Validasi File ---
define('ALLOWED_MIME', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
define('ALLOWED_EXT',  ['jpg', 'jpeg', 'png', 'gif', 'webp']);
define('MAX_FILE_SIZE', 2 * 1024 * 1024); // 2 MB

// --- Nama Aplikasi ---
define('APP_NAME', 'Fakultas Ilmu Komputer dan Teknologi Digital');

// --- Timezone ---
date_default_timezone_set('Asia/Jakarta');