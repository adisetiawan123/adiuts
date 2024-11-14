<?php
include "koneksi.php";

// Mengambil input dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Hash password sebelum disimpan ke database
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Memastikan koneksi ke database
if ($koneksi) {
    // Persiapkan query untuk menghindari SQL Injection
    $stmt = $koneksi->prepare("INSERT INTO adiuts (username, password) VALUES (?, ?)");
    
    // Bind parameter ke query
    $stmt->bind_param("ss", $username, $hashed_password);
    
    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>
                alert('Penambahan Admin Berhasil');
                document.location = 'login.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan Admin');
                document.location = 'register.php';
              </script>";
    }
    
    // Menutup statement
    $stmt->close();
} else {
    echo "<script>
            alert('Koneksi gagal!');
            document.location = 'register.php';
          </script>";
}

// Menutup koneksi ke database
$koneksi->close();
?>
