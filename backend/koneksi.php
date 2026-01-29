<?php
$koneksi = mysqli_connect("localhost", "root", "", "hoteltherocen_db");

if(!$koneksi){
    die("koneksi gagal: " . mysqli_connect_error());
}
?>