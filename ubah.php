<?php

session_start();
if( !isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require 'functions.php';


// Ambil data 
$id = $_GET["id"];

// queri data
$prdk = query(" SELECT * FROM produk WHERE id = $id")[0];


// cek koneksi
   if( isset($_POST["submit"]) ) {
    
    if( ubah($_POST) > 0 ){
        echo "
              <script>
              alert('data berhasil di ubah!');
              document.location.href = 'index.php';
              </script>  
            ";
    }else{
        echo "
              <script>
              alert('data gagal di ubah!');
              document.location.href = 'index.php';
              </script>  
            ";
    }
   } 

?>

<!DOCTYPE html>
<html>
    <head>
        <!-- BOOTSTRAP CSS -->
     <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

        <title>Ubah Data Produk</title>
        <style>
            label{
                font-family: 'Times New Roman', Times, serif;
                display: block;
                
            }
        </style>
    </head>
    <body class="bg-warning">

        <h1 class="fw-bold text-center mb-5 py-5">Ubah Data Produk</h1>

        <div class="container text-center fw-bold ">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $prdk["id"];?>">
            <input type="hidden" name="gambarLama" value="<?= $prdk["gambar"]; ?>">
            <ul>
                <li class="mb-4">
                    <label for="nama_produk">Nama Produk :</label>
                    <input type="text" name="nama_produk" id="nama_produk" required value="<?= $prdk ["nama_produk"];?>">

                </li>

                <li class="mb-4">
                    <label for="jenis_produk">Jenis Produk :</label>
                    <input type="text" name="jenis_produk" id="jenis_produk" required value="<?= $prdk ["jenis_produk"];?>">

                </li>

                <li class="mb-4">
                    <label for="kesediaan_produk">Kesediaan Produk :</label>
                    <input type="text" name="kesediaan_produk" id="kesediaan_produk" required value="<?= $prdk ["kesediaan_produk"];?>">

                </li>

                <li class="mb-4">
                    <label for="harga">Harga :</label>
                    <input type="text" name="harga" id="harga" required value="<?= $prdk ["harga"];?>">

                </li>

                <li class="mb-4">
                    <label for="gambar">Gambar :</label> <br>
                    <img src="img/<?= $prdk['gambar']; ?>" width="100"> <br>
                    <input type="file" name="gambar" id="gambar">

                </li>

               <li class="mb-4 d-grid col-12 mx-auto ">
                <button type="submit" name="submit" class="btn btn-primary">Ubah data </button>
               </li>
                

                
            </ul>


        </form>
    </body>
</html>