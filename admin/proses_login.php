<?php
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "select * from admin where username='$username' and password='$password'";
$query = mysqli_query($koneksi, $sql);

$cek = mysqli_num_rows($query);

if($cek > 0){
    echo "<script>alert('Selamat Datang Admin'); document.location = 'dashboard.php'; </script>";
}else{
    echo "<script>alert('Maaf username atau passwor salah'); document.location = 'login.php'; </script>";
}
?>