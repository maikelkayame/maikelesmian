<?php

session_start();

if( !isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

   if( isset($_POST["submit"]) ) {
    
    if( tambah($_POST) > 0 ){
        echo "
              <script>
              alert('data berhasil di tambahkan!');
              document.location.href = 'index.php';
              </script>  
            ";
    }else{
        echo "
              <script>
              alert('data gagal di tambahkan!');
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


        <title>Tambah Data Produk</title>
        <style>
            label{
                display:block;
                
            }
        </style>
    </head>
    <body class="bg-warning ">

        <h1 class="text-center fw-bold mb-5 py-5">Tambah Data Produk</h1>
           
        <div class="container text-center  fw-bolder ">
        <form action="" method="post" enctype="multipart/form-data">
            <ul >
                <li class="mb-4">
                    <label for="nama_produk">Nama Produk :</label>
                    <input type="text" name="nama_produk" id="nama_produk" required>

                </li>

                <li class="mb-4">
                    <label for="jenis_produk">Jenis Produk :</label>
                    <input type="text" name="jenis_produk" id="jenis_produk" required>

                </li>

                <li class="mb-4">
                    <label for="kesediaan_produk">Kesediaan Produk :</label>
                    <input type="text" name="kesediaan_produk" id="kesediaan_produk" required>

                </li>

                <li class="mb-4">
                    <label for="harga">Harga :</label>
                    <input type="text" name="harga" id="harga" required>

                </li>

                <li class="mb-4
                >
                    <label for="gambar">Gambar :</label>
                    <input type="file" name="gambar" id="gambar" required>

                </li>

               <li class=" d-grid col-12 text-center   ">
                <button type="submit" name="submit" class=" btn btn-primary   ">Tambah Data </button>
               </li>
                

                
            </ul>


        </form>
        </div>
    </body>
</html>