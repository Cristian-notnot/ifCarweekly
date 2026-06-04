<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "root", "ifCarweekly");
if($conn){
    echo "koneksi berhasil";    
}

// query ambil data mahasiswa
$query = mysqli_query($conn, "SELECT * FROM mahasiswa");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>data Mahasiswa Informatika 2026</title>
</head>
<body>
    <h1>Informatika 2026</h1>

    <table border="1" cellspacing="0" cellpadding="10px">
        <tr>
            <td><a href="index.php">Home</a></td>
            <td><a href="profile.php">Profile</a></td>
            <td><a href="contact.php">Contact</a></td>
            <td><a href="mahasiswa.php">Data Mahasiswa</a></td>
        </tr>
    </table>

    <br>

    <h2>Data Mahasiswa</h2>
    <a href="tambah_data.html">
        <button>Tambah Data</button>
    </a>
    <table border="1" cellpadding="10px" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Nim</th>
        <th>Jurusan</th>
        <th>Email</th>
        <th>No HP</th>
        <th>Foto</th>
    </tr>

    <?php
    $no = 1;

    while ($row = mysqli_fetch_assoc($query)):
    ?>
        <tr>
            <td align="center">
                <?= $no++; ?>
            </td>

            <td>
                <?= $row['nama']; ?>
            </td>

            <td>
                <?= $row['nim']; ?>
            </td>

            <td>
                <?= $row['jurusan']; ?>
            </td>

            <td>
                <?= $row['email']; ?>
            </td>

            <td>
                <?= $row['no_hp']; ?>
            </td>

            <td align="center">
                <img src="assets/images/<?= $row['foto']; ?>" width="120px">
            </td>
        </tr>

    <?php endwhile; ?>

</table>

</body>
</html>