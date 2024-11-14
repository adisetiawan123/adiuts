<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

// Membuat koneksi baru
$conn = new mysqli('localhost', 'root', '', 'adiuts');

// Memeriksa koneksi
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}

// Menggunakan prepared statement untuk mencegah SQL injection
$stmt = $conn->prepare("SELECT * FROM adiuts WHERE username = ?");
if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->bind_param("s", $username);  // Bind hanya username, karena kita akan memverifikasi password nanti
$stmt->execute();
$result = $stmt->get_result();

// Memeriksa apakah user ada
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Ambil data user
    
    // Memeriksa apakah password cocok dengan hash yang ada di database
    if (password_verify($password, $user['password'])) {
        // Password valid, buat session dan arahkan ke dashboard
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit(); // Pastikan untuk keluar dari skrip setelah redirect
    } else {
        echo "<script>alert('Password salah!'); window.location='login.php';</script>";
    }
} else {
    echo "<script>alert('Username tidak ditemukan!'); window.location='login.php';</script>";
}

// Menutup statement dan koneksi
$stmt->close();
$conn->close();
?>
