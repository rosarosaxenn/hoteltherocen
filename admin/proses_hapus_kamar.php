<?php
include '../backend/koneksi.php';

$id = $_GET['id'];

// hapus data kamar
mysqli_query($koneksi, "DELETE FROM room WHERE id_room = '$id'");

echo "
<script>
    alert('Room berhasil dihapus');
    window.location.href = 'dashboard.php';
</script>
";
exit;
?>

