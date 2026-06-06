<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include __DIR__ . "/navbar.php"; ?>

<div class="container">
    <div class="card">
        <h2>Tambah Data Mahasiswa</h2>

        <form action="prosestambah.php" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="nama" required placeholder="Masukkan nama lengkap"></td>
                </tr>

                <tr>
                    <td>NIM</td>
                    <td><input type="number" name="nim" required placeholder="Masukkan NIM"></td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" placeholder="contoh@email.com"></td>
                </tr>

                <tr>
                    <td>No HP</td>
                    <td><input type="tel" name="no_hp" placeholder="08xxxxxxxxxx"></td>
                </tr>

                <tr>
                    <td>Jenis Kelamin</td>
                    <td>
                        <div class="radio-group">
                            <label><input type="radio" name="kelamin" value="Pria"> Pria</label>
                            <label><input type="radio" name="kelamin" value="Wanita"> Wanita</label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>Hobi</td>
                    <td>
                        <div class="checkbox-group">
                            <label><input type="checkbox" name="hobi[]" value="Buku"> Buku</label>
                            <label><input type="checkbox" name="hobi[]" value="Film"> Film</label>
                            <label><input type="checkbox" name="hobi[]" value="Game"> Game</label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>Alamat</td>
                    <td>
                        <textarea name="alamat" placeholder="Alamat lengkap rumah..."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Jurusan</td>
                    <td>
                        <select name="jurusan">
                            <option value="">-- Pilih Jurusan --</option>
                            <option>Informatika</option>
                            <option>Sistem Informasi</option>
                            <option>Teknik Komputer</option>
                            <option>Artificial Intelligence</option>
                            <option>Desain Grafis</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Foto</td>
                    <td>
                        <input type="file" name="foto">
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <button class="btn" type="submit">Tambah Data</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

</body>
</html>