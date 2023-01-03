<?php

require 'functions.php';

if( isset ($_POST["register"])) {

    if ( registrasi($_POST) > 0 ) {
        echo "<script>
                alert('user baru berhasil ditambahkan!');
        </script>";
    }else{
        echo mysqli_error($conn);
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

        <title>Halaman Registrasi</title>
        <style>
            label{
                display: block;
            }
        </style>

    </head>
    <body class="bg-warning">

    <h1 class="fw-bold mb-5 py-5 text-center"> Halaman Registrasi</h1>

    <div class="container text-center fw-bold">
    <form action="" method="post">

    <ul>

        <li>
            <label for="username">User Name :</label> 
            <input type="text" name="username" id="username" required placeholder="user name"><br><br>
        </li>

        <li>
            <label for="email"> Email :</label>
            <input type="email" name="email" id="email" required placeholder="email.@gmail.com"><br><br>
        </li>

        <li>
            <label for="password">Password :</label>
            <input type="password" name="password" id="password" placeholder="your password"><br><br>
        </li>

        <li>
            <label for="password2">Konfirmasi Password :</label>
            <input type="password" name="password2" id="password2" placeholder="your password"><br><br>
        </li>
        
        <li class="d-grid gap-2 d-md-2">
             <button type="submit" name="register" class="btn btn-primary">
                    Register
            </button>
        </li>
    </ul>

    </form>

    </body>
</html>