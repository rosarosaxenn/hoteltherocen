<?php
include '../backend/koneksi.php';

$id        = $_POST['id_room'];
$nama      = $_POST['nama_kamar'];
$harga     = $_POST['harga'];
$fasilitas = $_POST['fasilitas'];

if (!empty($_FILES['gambar_kamar']['name'])) {
    $gambar = $_FILES['gambar_kamar']['name'];
    $tmp    = $_FILES['gambar_kamar']['tmp_name'];
    move_uploaded_file($tmp, "../kamar/" . $gambar);

    $query = "UPDATE room SET
                nama_kamar='$nama',
                harga='$harga',
                fasilitas='$fasilitas',
                gambar_kamar='$gambar'
              WHERE id_room='$id'";
} else {
    $query = "UPDATE room SET
                nama_kamar='$nama',
                harga='$harga',
                fasilitas='$fasilitas'
              WHERE id_room='$id'";
}

mysqli_query($koneksi, $query);
header("Location: dashboard.php");
