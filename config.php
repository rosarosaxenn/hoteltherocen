<?php
$host     = getenv('MYSQLHOST');
$port     = getenv('MYSQLPORT');
$db       = getenv('MYSQLDATABASE');
$user     = getenv('MYSQLUSER');
$password = getenv('MYSQLPASSWORD');

$conn = new mysqli($host, $user, $password, $db, (int)$port);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>