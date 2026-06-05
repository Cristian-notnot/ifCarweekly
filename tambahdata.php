<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input data mahasiswa</title>
</head>
<body>
    <h2>Tambah Data Mahasiswa</h2>
    <form action="mahasiswa.html" method="post">
    <table >
        <tr>
            <td><label for="nama">Nama</label></td>
            <td>:</td>
            <td><input type="text" name="nama" id="nama"/></td>
        </tr>
        <tr>
            <td><label for="nim">NIM</label></td>
            <td>:</td>
            <td><input type="text" name="nim" id="nim"/></td>
        </tr>
        <tr>
            <td><label for="foto">Foto</label></td>
            <td>:</td>
            <td><input type="file" name="foto" id="foto"/></td>
        </tr>
    
    </table>
    <button type="submit" name="submit" id="submit">Tambah data</button>
    </form>
</body>
</html>