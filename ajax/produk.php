<?php

require '../functions.php';

$keyword = $_GET["keyword"];
$query = "SELECT * FROM produk
        WHERE
        nama_produk LIKE '%$keyword%' OR
        jenis_produk LIKE '%$keyword%' OR
        kesediaan_produk LIKE '%$keyword%' OR
        harga LIKE '%$keyword%' 
        ";
$produk = query($query);
?>

<table border="1" cellpadding="10" cellspacing="0">
       <tr>

        <th>Nama Produk</th>
        <th>Jenis Produk</th>
        <th>Kesediaan produk</th>
        <th>Harga</th>
        <th>Gambar</th>
        <th>Pilihan</th>

       </tr>

       <?php foreach($produk as $row ) : ?>
       <tr>

        <td><?= $row["nama_produk"]; ?></td>
        <td><?= $row["jenis_produk"]; ?></td>
        <td><?= $row["kesediaan_produk"]; ?></td>
        <td><?= $row["harga"];?></td>
        <td><img src="img/<?= $row["gambar"]; ?>" width="80"> </td>
        <td>
            <a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick =" return confirm('anda yakin mau menghapus data ini?');">Hapus</a>

        </td>

       </tr>

       <?php endforeach;?>
    
    </table>