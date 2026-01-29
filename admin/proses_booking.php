<?php
include '../backend/koneksi.php';

// Ambil data dari form
$name     = $_POST['name'];
$email    = $_POST['email'];
$room     = $_POST['room'];
$checkin  = $_POST['checkin'];
$checkout = $_POST['checkout'];
$price    = $_POST['price']; // harga per malam

// Upload file bukti
if (isset($_FILES['bukti']) && $_FILES['bukti']['error'] == 0) {
    $bukti      = $_FILES['bukti']['name'];
    $tmp_name   = $_FILES['bukti']['tmp_name'];
    $folder     = "../uploads/"; // pastikan folder ini ada dan bisa diwrite
    $bukti_file = time() . "_" . $bukti; // biar unik

    if (!move_uploaded_file($tmp_name, $folder . $bukti_file)) {
        echo "<script>alert('Gagal mengunggah bukti foto'); window.history.back();</script>";
        exit;
    }
} else {
    $bukti_file = null; // kalau nggak ada file
}

// Hitung lama menginap (hari)
$checkin_date  = strtotime($checkin);
$checkout_date = strtotime($checkout);
$lama_hari     = ceil(($checkout_date - $checkin_date) / (60 * 60 * 24));

if ($lama_hari < 1) {
    echo "<script>alert('Tanggal checkout harus setelah tanggal checkin'); window.history.back();</script>";
    exit;
}

// Hitung total harga
$total = $price * $lama_hari;

// Simpan ke database
$query = "INSERT INTO booking (name, email, room, checkin, checkout, price, total, bukti) 
          VALUES ('$name', '$email', '$room', '$checkin', '$checkout', '$price', '$total', '$bukti_file')";

if (mysqli_query($koneksi, $query)) {
    echo "<script>
            alert('Booking berhasil! Total: Rp $total');
            window.location.href = '../index.php';
          </script>";
} else {
    echo "<script>
            alert('Booking gagal: " . mysqli_error($koneksi) . "'); 
            window.history.back();
          </script>";
}
?>
