<?php

   require "fungsi.php";
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
            <td><a href="index.php">Home</a></td>
            <td><a href="profile.php">Profile</a></td>
            <td><a href="contact.php">Contact</a></td>
            <td><a href="mahasiswa.php">Data Mahasiswa</a></td>
        </tr>
    </table>
    <br>
    <hr/>
    <h2>Data Mahasiswa</h2>

    <a href="ambahData.php">
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
            <th>aksi</th>
           
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
            <td><img src="assets/images/<?= $mhs["foto"]?>" width ="80px" alt=""></td>
            <td><a href="editdata.php"><button>Edit</button></a>
            <a href="deletedata.php"><button>Delete</button></a></td>
        </tr>
<?php
$i++;
    }
?>

    </table>
</body>
</html>