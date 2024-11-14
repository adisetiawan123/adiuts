<?php
    //aturan
    $server = "localhost";
    $user   = "root";
    $pass   = "";
    $db     = "adiuts";

    $koneksi=mysqli_connect($server,$user,$pass,$db);

    //keterangan 
    if(!$koneksi) {
    die("koneksi gagal" . mysqli_coonect_error());

    } else {
    echo "koneksi berhasil";
    }

?>