<?php 
// koneksi
$conn = mysqli_connect("localhost", "root", "", "db_kulkopi");



function query($query) {

    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;   
    }
    return $rows;
}

function tambah($data){

    global $conn; 

    $nama =htmlspecialchars($data["nama_produk"]) ;
    $jp = htmlspecialchars($data["jenis_produk"]);
    $kp = htmlspecialchars($data["kesediaan_produk"]);
    $harga = htmlspecialchars($data["harga"]);
   
    // upload gambar
    $gambar = upload();

    if(!$gambar ){ 
        return false;
    }
    
    //insert data
    $query = "INSERT INTO produk
            VALUES
            ('','$nama','$jp','$kp','$harga','$gambar')
            
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
    
}

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek error
    if( $error === 4 ){
        echo " <script>
                alert('pilih gambar terlebih dahulu!');
        </script>
        ";
        return false;
    }

    //cek yang di upload
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar) ) ;

    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo " <script>
                    alert('yang anda upload bukan gambar!');
            </script>
            ";
        return false;
    }

    // cek ukuran file
    if( $ukuranFile > 1000000){
        echo "
            <script>
            alert('ukuran gambar terlalu besar!');
            <script>
        ";
        return false;
    }

    //lolos pengecekan
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}


function hapus($id){

    global $conn;
    mysqli_query($conn, "DELETE FROM produk WHERE id=$id");

return mysqli_affected_rows($conn);
}

function ubah($data){

    global $conn;

    $id = $data["id"];
    $nama =htmlspecialchars($data["nama_produk"]) ;
    $jp = htmlspecialchars($data["jenis_produk"]);
    $kp = htmlspecialchars($data["kesediaan_produk"]);
    $harga = htmlspecialchars($data["harga"]);
    $gambarlama = htmlspecialchars($data["gambarLama"]);

        if( $_FILES['gambar']['error'] === 4){
        $gambar = $gambarlama;
        } else {
            $gambar = upload();

        
        }


  
    
    //update data
    $query = "UPDATE produk SET
                nama_produk = '$nama',
                jenis_produk = '$jp',
                kesediaan_produk = '$kp',
                harga = '$harga',
                gambar = '$gambar'
                WHERE id = $id
                ";
            

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);


}

function cari($keyword){

    $query = "SELECT * FROM produk
                WHERE
                nama_produk LIKE '%$keyword%' OR
                jenis_produk LIKE '%$keyword%' OR
                kesediaan_produk LIKE '%$keyword%' OR
                harga LIKE '%$keyword%' 
                ";
    return query($query);
}

function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username lama ke baru
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "
            <script>
            alert('username yang dipilih suda terdaftar!');
            </script>
        ";
        return false;
    }
   
    // cek konfirmasi password
    if($password !== $password2){
        echo "<script>
            alert('konfirmasi password tidak sesaui!');
        <?script>";
        return false;
    }

    // enskripsi password

    $password = password_hash($password, PASSWORD_DEFAULT);
    
    mysqli_query($conn, "INSERT INTO user VALUES('','$username', '$email','$password')");
  
    return mysqli_affected_rows($conn); 
}



?>