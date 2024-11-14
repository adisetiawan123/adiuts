<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo("<script>alert('Anda belum login! silahkan login');</script>");
    header('Location: login.php');
} else {
    header('Location: dashboard.php');
}
?>
