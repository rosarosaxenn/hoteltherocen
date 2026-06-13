<?php
$hostname = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$database = getenv('DB_NAME');
$port     = 4000;

$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
mysqli_real_connect($conn, $hostname, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL);

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>