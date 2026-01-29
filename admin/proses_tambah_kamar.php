<?php
include '../backend/koneksi.php';

$nama     = $_POST['nama_kamar'];
$harga    = $_POST['harga'];
$fasilitas= $_POST['fasilitas'];

if (!isset($_FILES['gambar_kamar'])) {
    die("Gambar belum dipilih");
}

$gambar = $_FILES['gambar_kamar']['name'];
$tmp    = $_FILES['gambar_kamar']['tmp_name'];

move_uploaded_file($tmp, "../kamar/".$gambar);

mysqli_query($koneksi, "
  INSERT INTO room (nama_kamar, gambar_kamar, harga, fasilitas)
  VALUES ('$nama', '$gambar', '$harga', '$fasilitas')
");

header("Location: dashboard.php");
