<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data — IfCarweekly</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/fungsi.php';
include __DIR__ . '/navbar.php';

// Validasi ID dari URL: harus ada dan berupa angka positif
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

if (!$id) {
    redirect('mahasiswa.php', 'error');
}

// Ambil data mahasiswa yang akan diedit
$mhs = getMahasiswaById($id);

if (!$mhs) {
    // Data tidak ditemukan
    redirect('mahasiswa.php', 'error');
}
?>

<div class="container narrow">
    <div class="card">
        <div class="page-header">
            <h2>Edit Data Mahasiswa</h2>
            <a href="mahasiswa.php" class="btn btn-outline btn-sm">&#8592; Kembali</a>
        </div>

        <form action="prosesedit.php" method="POST" enctype="multipart/form-data"
              onsubmit="this.querySelector('[type=submit]').disabled = true">

            <!-- ID dikirim tersembunyi untuk proses update -->
            <input type="hidden" name="id" value="<?= (int)$mhs['id'] ?>">

            <table class="form-table">
                <tr>
                    <td>Nama <span class="req">*</span></td>
                    <td>
                        <!-- value diisi dengan data lama, di-escape untuk keamanan -->
                        <input type="text" name="nama" required
                               value="<?= e($mhs['nama']) ?>"
                               maxlength="100">
                    </td>
                </tr>
                <tr>
                    <td>NIM <span class="req">*</span></td>
                    <td>
                        <input type="text" name="nim" required
                               value="<?= e($mhs['nim']) ?>"
                               maxlength="20" pattern="[0-9]+" title="Hanya angka">
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="email" name="email"
                               value="<?= e($mhs['email']) ?>"
                               maxlength="100">
                    </td>
                </tr>
                <tr>
                    <td>No HP</td>
                    <td>
                        <input type="tel" name="no_hp"
                               value="<?= e($mhs['no_hp']) ?>"
                               maxlength="20">
                    </td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="kelamin" value="Pria"
                                    <?= ($mhs['kelamin'] ?? '') === 'Pria' ? 'checked' : '' ?>>
                                Pria
                            </label>
                            <label>
                                <input type="radio" name="kelamin" value="Wanita"
                                    <?= ($mhs['kelamin'] ?? '') === 'Wanita' ? 'checked' : '' ?>>
                                Wanita
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>
                        <textarea name="alamat" maxlength="500"
                                  placeholder="Alamat lengkap..."><?= e($mhs['alamat'] ?? '') ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Jurusan</td>
                    <td>
                        <select name="jurusan">
                            <option value="">-- Pilih Jurusan --</option>
                            <?php
                            $jurusanList = [
                                'Informatika', 'Sistem Informasi', 'Teknik Komputer',
                                'Artificial Intelligence', 'Desain Grafis'
                            ];
                            foreach ($jurusanList as $j):
                                $selected = $mhs['jurusan'] === $j ? 'selected' : '';
                            ?>
                                <option value="<?= e($j) ?>" <?= $selected ?>><?= e($j) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Foto</td>
                    <td>
                        <!-- Tampilkan foto lama jika ada -->
                        <?php if (!empty($mhs['foto'])): ?>
                            <div class="foto-preview-wrap">
                                <img src="<?= e(UPLOAD_URL . $mhs['foto']) ?>"
                                     alt="Foto <?= e($mhs['nama']) ?>">
                                <span class="text-muted text-sm">Foto saat ini</span>
                            </div>
                        <?php endif; ?>

                        <input type="file" name="foto" id="fotoInput"
                               accept="image/jpeg,image/png,image/gif,image/webp"
                               onchange="previewFoto(this)">
                        <p class="form-hint">
                            Kosongkan jika tidak ingin mengganti foto.<br>
                            Format: JPG, PNG, GIF, WEBP. Maks 2 MB.
                        </p>
                        <div id="previewWrap" style="display:none; margin-top:10px">
                            <img id="previewImg" src="" alt="Preview"
                                 style="width:80px;height:80px;object-fit:cover;border-radius:50%;border:2px solid var(--c-border)">
                            <p class="form-hint">Preview foto baru</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" class="btn btn-teal btn-block">
                            &#10003; Perbarui Data
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<script>
function previewFoto(input) {
    const wrap = document.getElementById('previewWrap');
    const img  = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; wrap.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    } else {
        wrap.style.display = 'none';
    }
}
</script>

</body>
</html>