<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data — IfCarweekly</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php
require_once __DIR__ . '/config.php';
include __DIR__ . '/navbar.php';
?>

<div class="container narrow">
    <div class="card">
        <div class="page-header">
            <h2>Tambah Data Mahasiswa</h2>
            <a href="mahasiswa.php" class="btn btn-outline btn-sm">&#8592; Kembali</a>
        </div>

        <form action="prosestambah.php" method="POST" enctype="multipart/form-data"
              onsubmit="this.querySelector('[type=submit]').disabled = true">
            <table class="form-table">
                <tr>
                    <td>Nama <span class="req">*</span></td>
                    <td>
                        <input type="text" name="nama" required
                               placeholder="Masukkan nama lengkap" maxlength="100">
                    </td>
                </tr>
                <tr>
                    <td>NIM <span class="req">*</span></td>
                    <td>
                        <input type="text" name="nim" required
                               placeholder="Contoh: 22010001" maxlength="13"
                               pattern="[0-9]+" title="Hanya angka">
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="email" name="email"
                               placeholder="contoh: nama@gmail.com" maxlength="100">
                    </td>
                </tr>
                <tr>
                    <td>No HP</td>
                    <td>
                        <input type="tel" name="no_hp"
                               placeholder="contoh: 08xxxxxxxxxx" maxlength="13">
                    </td>
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
                        <textarea name="alamat" placeholder="Alamat lengkap..." maxlength="500"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Jurusan</td>
                    <td>
                        <select name="jurusan">
                            <option value="">-- Pilih Jurusan --</option>
                            <option value="Informatika">Informatika</option>
                            <option value="Teknologi Informasi">Sistem Informasi</option>
                            <option value="Sains Data">Sains Data</option>
                            <option value="Rekayasa Keamanan Siber">Rekayasa Keamanan Siber</option>
                            <option value="Artificial Intelligence">Artificial Intelligence</option>
                            <option value="S1 Desain Komunikasi Visual (DKV)">S1 Desain Komunikasi Visual (DKV)</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Foto <span class="req">*</span></td>
                    <td>
                        <input type="file" name="foto" id="fotoInput" required
                               accept="image/jpeg,image/png,image/gif,image/webp"
                               onchange="previewFoto(this)">
                        <p class="form-hint">Format: JPG, PNG, GIF, WEBP. Maksimal 2 MB.</p>
                        <!-- Preview foto sebelum upload -->
                        <div id="previewWrap" style="display:none; margin-top:10px">
                            <img id="previewImg" src="" alt="Preview foto"
                                 style="width:80px;height:80px;object-fit:cover;border-radius:50%;border:2px solid var(--c-border)">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" class="btn btn-teal btn-block">
                            &#10003; Simpan Data
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<script>
// Preview foto sebelum upload (tanpa library)
function previewFoto(input) {
    const wrap = document.getElementById('previewWrap');
    const img  = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            wrap.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        wrap.style.display = 'none';
    }
}
</script>

</body>
</html>