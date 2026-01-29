<?php

include 'koneksi.php';
$name = $_POST['name'];
$email = $_POST['email'];
$room = $_POST['room'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];

$query = "INSERT INTO booking(name, email, room, checkin, checkout)
VALUES ('$name', '$email', '$room', '$checkin', '$checkout')";

mysqli_query($koneksi, $query);

header('Location: ../index.php?pesan=success');
?>