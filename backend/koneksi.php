<?php
$hostname = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$database = getenv('DB_NAME');
$port     = 4000;

$koneksi = mysqli_init();
mysqli_ssl_set($koneksi, NULL, NULL, NULL, NULL, NULL);
mysqli_real_connect($koneksi, $hostname, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>