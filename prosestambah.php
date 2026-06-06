<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Koneksi Database
$conn = mysqli_connect("localhost", "root", "root", "ifcarweekly");

if(!$conn){
    die("Koneksi gagal : " . mysqli_connect_error());
}

// Ambil data form
$nama = htmlspecialchars($_POST['nama']);
$nim = htmlspecialchars($_POST['nim']);
$jurusan = htmlspecialchars($_POST['jurusan'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$no_hp = htmlspecialchars($_POST['no_hp'] ?? '');

// Validasi upload foto
if(empty($_FILES['foto']['name'])){
    die("Foto wajib diupload");
}

$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

$dirUpload = "aset/image/";

// Buat folder jika belum ada
if(!is_dir($dirUpload)){
    mkdir($dirUpload, 0755, true);
}

// Upload file
if(!move_uploaded_file($tmp, $dirUpload . $foto)){
    die("Upload foto gagal");
}

// Pastikan AUTO_INCREMENT sinkron dengan nilai id tertinggi
$nextIdResult = mysqli_query($conn, "SELECT IFNULL(MAX(id),0)+1 AS next_id FROM mahasiswa");
$nextIdRow = mysqli_fetch_assoc($nextIdResult);
$nextId = $nextIdRow['next_id'] ?? 1;
mysqli_query($conn, "ALTER TABLE mahasiswa AUTO_INCREMENT = {$nextId}");

// Prepared Statement
$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO mahasiswa 
    (nama, nim, jurusan, email, no_hp, foto) 
    VALUES (?, ?, ?, ?, ?, ?)"
);

if(!$stmt){
    die("Prepare gagal : " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    "ssssss",
    $nama,
    $nim,
    $jurusan,
    $email,
    $no_hp,
    $foto
);

try {
    $insert = mysqli_stmt_execute($stmt);
} catch (mysqli_sql_exception $e) {
    echo "Gagal menyimpan data: " . $e->getMessage();
    exit;
}

if($insert){
    header("Location: mahasiswa.php");
    exit;
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>

