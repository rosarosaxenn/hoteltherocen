<?php
// Mengambil data dari Environment Variables yang baru kamu input tadi
$hostname = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$database = getenv('DB_NAME');
$port     = 4000; // TiDB Cloud standarnya menggunakan port 4000

$conn = mysqli_connect($hostname, $username, $password, $database, $port);

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
} 
// Jika berhasil, variabel $conn siap digunakan untuk query!
?>