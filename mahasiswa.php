<?php

   require_once __DIR__ . "/fungsi.php";
   $qmahasiswa = "SELECT * FROM mahasiswa";
   $mahasiswas = tampildata($qmahasiswa);

   
   

//    if($koneksi){
//     echo "koneksi berhasil";
//    };

    // $query = "SELECT * FROM mahasiswa";
    // $result = mysqli_query($koneksi, $query);

    //ambil data (fetch ) dari lemari
    //mysqli_fetch_row
    //mysqli_fetch_assoc
    //mysqli_fetch_object
    //mysqli_fetch_array

    //mysqli_fetch_row
//    while($mhs = mysqli_fetch_row($result)) 
//     {
//     var_dump($mhs);
//     }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>
    <H1>DATA Mahasiswa</H1>
    
    <table border="1" cellspacing="0" cellpadding="10px">
        <tr>
          <div class="navbar">
             <a href="index.php">Home</a>
             <a href="profile.php">Profile</a>
             <a href="contact.php">Contact</a>
             <a href="mahasiswa.php">Mahasiswa</a>
</div>
        </tr>
    </table>
    <br>
    <hr/>
    <h2>Data Mahasiswa</h2>

    <a href="tambahdata.php">
        <button>Tambah Data</button>
    </a>
    
    <table border="1" cellspacing="0" cellpadding="10px">
        <tr>
            <th>No</th>
            <th>nama</th>
             <th>NIM</th>
            <th>Jurusan</th>
             <th>Email</th>
            <th>No. HP</th>
            <th>foto</th>
           
        </tr>
    <?php
        $i =1;
        foreach($mahasiswas as $mhs)
    {
    ?>
        <tr>
            <td><?= $i?></td>
            <td><?php echo $mhs["nama"]?></td>
            <td><?= $mhs["nim"]?></td>
            <td><?= $mhs["jurusan"]?></td>
            <td><?= $mhs["email"]?></td>
            <td><?= $mhs["no_hp"]?></td>
            <td>
            <a href="editdata.php?id=<?= $mhs['id'] ?>">
            <button>Edit</button>
            </a>

            <a href="deletedata.php?id=<?= $mhs['id'] ?>">
            <button>Delete</button>
            </a>
            </td>
<?php
$i++;
    }
?>
    
</body>
</html>