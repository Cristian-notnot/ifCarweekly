```php
<?php

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

$insert = mysqli_stmt_execute($stmt);

if($insert){
    header("Location: mahasiswa.php");
    exit;
}else{
    echo "Gagal menyimpan data : " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>
```
