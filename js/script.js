// ambil elemen 
var keyword = document.getElementById('keyword');
var tombolCari = document.getElementById('tombol-cari');
var container = document.getElementById('container');

// tambahkan even 
keyword.addEventListener('keyup', function(){

    // buat objeck
    var xhr = new XMLHttpRequest();

    //cek kesiapan 
    xhr.onreadystatechange = function (){
        if( xhr.readyState == 4 && xhr.status == 200){
            container.innerHTML = xhr.responseText;
        }
    }


    // exekusi ajax
    xhr.open('GET','ajax/produk.php?keyword=' + keyword.value,true);
    xhr.send();

});