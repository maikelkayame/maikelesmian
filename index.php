<?php
session_start();

if( !isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';



$produk = query("SELECT * FROM produk");

if( isset($_POST["cari"])){
    $produk = cari($_POST["keyword"]);
}

?>



<!DOCTYPE html>
<html lang="en">
<head>

     <!-- BOOTSTRAP CSS -->
     <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">


    <title>Halaman Admin</title>

</head>
<body class="bg-warning ">
    
<div class="container  ">
    <h1 class="fw-bold text-center mb-5 py-5">Daftar Produk</h1>

    <a href="logout.php" class="btn btn-light">Kelua</a> |
    <a href="tambah.php" class="btn btn-primary " >Tambah Produk</a> 
    <br><br>
    

    <form action="" method="post" class="d-flex">
        <input type="text" name="keyword" class="bg-info form-control me-2" size="40" autofocus 
        placeholder="masukan data pencarian.." autocomplete="off" id="keyword">

        <button type="submit" name="cari" id="tombol-cari" class="btn btn-secondary"> Cari </button>
    </form>

    <br><br>

    <div id="container" class=" row align-items-center">
    <table border="1" cellpadding="10" cellspacing="0">
       <tr class="bg-light">

        <th>Nama Produk</th>
        <th>Jenis Produk</th>
        <th>Kesediaan produk</th>
        <th>Harga</th>
        <th>Gambar</th>
        <th>Pilihan</th>

       </tr>

       <?php foreach($produk as $row ) : ?>
       <tr class="bg-success">

        <td><?= $row["nama_produk"]; ?></td>
        <td><?= $row["jenis_produk"]; ?></td>
        <td><?= $row["kesediaan_produk"]; ?></td>
        <td><?= $row["harga"];?></td>
        <td><img src="img/<?= $row["gambar"]; ?>" width="80"> </td>
        <td>
            <a href="ubah.php?id=<?= $row["id"]; ?>" class="btn btn-outline-primary">Ubah</a> |
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick =" return confirm('anda yakin mau menghapus data ini?');" class="btn btn-outline-light">Hapus</a>

        </td>

       </tr>

       <?php endforeach;?>
    
    </table>
    </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>