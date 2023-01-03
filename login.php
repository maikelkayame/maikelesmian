<?php
session_start();
require 'functions.php';

if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil user name berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE
     id = $id");

    $row = mysqli_fetch_assoc($result);
    // cek cookie dan username
    if($key === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }
    }


if( isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}



    if( isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"]; 

      $result = mysqli_query($conn, "SELECT * FROM user WHERE
      username = '$username'");  

        // cek user name
        if( mysqli_num_rows($result) === 1 ){

        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
        
            // set session 
            $_SESSION["login"] = true;

            // cek remember me
            if(isset($_POST['remember'])){
                // buat cookie
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time()+60);
            }
           
            header("location: index.php");
            exit;
        }
        }

    $error = true;


    }


?>


<!DOCTYPE html>
<html>
    <head>
        <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">


        <title>Halama Login</title>

   


    </head>

    <body class=" fixet-bootom text-center py-2 bg-warning">
    <div class="container  fst-italic mb-2 py-2 " >
    <h1 class=" mb-5">Halaman login</h1>
    <?php if( isset($error)) : ?>
            <p style="color: red; font-style: italic; "> username / password salah!</p>
        <?php endif; ?>
       
    <form action="" method="post">

    <ul>
        <li>
            <label for="username">Username :</label>
            <input class="mb-2"  type="text" name="username" id="username">
        </li>

        <li>
            <label for="password">Password :</label>
            <input class="mb-2" type="password" name="password" id="password">
        </li>


        <li>
            <input type="checkbox" name="remember" id="remember">
            <label class="mb-2 fw-bold" for="remember">Remember Me </label>
        </li>

        <li>
            <button class="btn btn-info btn-lg" type="submit" name="login">Login :</button>
        </li>



    </ul>


    </form>
    </div>
        

    </body>
</html>