<?php
session_start();
include '../backend/koneksi.php';

$nama  = $_POST['nama'];
$sandi = $_POST['sandi'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM admin 
     WHERE nama='$nama' AND sandi='$sandi'"
);

if (mysqli_num_rows($query) === 1) {
    $_SESSION['admin'] = true;
    header("Location: dashboard.php");
    exit;
} else {
    echo "<script>
            alert('Login Gagal!');
            window.location='loginadmin.php';
          </script>";
}
?>