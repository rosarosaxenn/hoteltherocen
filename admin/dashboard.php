<?php
session_start();
include '../backend/koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: loginadmin.php");
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: loginadmin.php");
    exit;
}

$room = mysqli_query($koneksi, "SELECT * FROM room ORDER BY id_room");
$editRoom = null;

if (isset($_GET['edit'])) {
    $idEdit = $_GET['edit'];
    $qEdit = mysqli_query($koneksi, "SELECT * FROM room WHERE id_room='$idEdit'");
    $editRoom = mysqli_fetch_assoc($qEdit);
}

// total booking
$qTotal = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM booking");
$totalBooking = mysqli_fetch_assoc($qTotal);

// booking hari ini
$qHariIni = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM booking WHERE checkin = CURDATE()"
);
$bookingHariIni = mysqli_fetch_assoc($qHariIni);

// keluar hari ini
$qKeluarHariIni = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM booking WHERE checkout = CURDATE()"
);
$keluarHariIni = mysqli_fetch_assoc($qKeluarHariIni);

// total pemasukan
$qIncome = mysqli_query(
    $koneksi,
    "SELECT SUM(total) AS income FROM booking"
);
$income = mysqli_fetch_assoc($qIncome);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="icon" href="../img/sampul.jpg">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 font-serif">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-pink-800 text-white p-6">
            <h2 class="text-2xl font-bold mb-8">Admin <span class="text-pink-300">RoCen</span></h2>

            <nav class="space-y-4">
                <a class="block p-2 rounded bg-pink-500" href="#dashboard">Dashboard</a>                
                <a class="block p-2 rounded hover:bg-pink-500" href="#data-kamar">Data Kamar</a>
                <a class="block p-2 rounded hover:bg-pink-500" href="#data-booking">Data Booking</a>
                <a class="block p-2 rounded hover:bg-pink-500" href="../index.php">User Page</a>
                <a class="block p-2 rounded hover:bg-pink-500" href="?logout=true">Logout</a>
            </nav>
        </aside>

        <!-- MAIN -->
        <main class="flex-1 p-8">

            <h1 class="text-3xl font-bold mb-6" id="dashboard">Dashboard</h1>

            <!-- CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500">Total Booking</p>
                    <h2 class="text-4xl font-bold">
                        <?= $totalBooking['total']; ?>
                    </h2>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500">Check-in Hari Ini</p>
                    <h2 class="text-4xl font-bold">
                        <?= $bookingHariIni['total']; ?>
                    </h2>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500">Check-out Hari Ini</p>
                    <h2 class="text-4xl font-bold">
                        <?= $keluarHariIni['total']; ?>
                    </h2>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500">Total Pemasukan</p>
                    <h2 class="text-4xl font-bold">
                        Rp <?= number_format($income['income'], 0, ',', '.'); ?>
                    </h2>
                </div>
            </div>

            <!-- TAMBAH KAMAR -->
            <div class="bg-white rounded-xl shadow p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4">Tambah Kamar</h2>
                <form action="proses_tambah_kamar.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="block mb-2">Nama Kamar</label>
                        <input type="text" name="nama_kamar" class="border border-gray-300 p-2 w-full" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Gambar Room</label>
                        <input type="file" name="gambar_kamar" class="border border-gray-300 p-2 w-full" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Harga</label>
                        <input type="number" name="harga" class="border border-gray-300 p-2 w-full" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Fasilitas</label>
                        <input type="text" name="fasilitas" class="border border-gray-300 p-2 w-full" required>
                    </div>
                    <button type="submit" class="bg-pink-500 text-white p-2 rounded">Tambah Kamar</button>
                </form>
            </div>

            <?php if (isset($_GET['edit'])) { ?>
                <div class="bg-white rounded-xl shadow p-6 mb-8 border-2 border-blue-200">
                    <h2 class="text-xl font-semibold mb-4">
                        Edit Kamar
                    </h2>

                    <form action="proses_edit_kamar.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_room" value="<?= $editRoom['id_room']; ?>">

                        <div class="mb-4">
                            <label class="block mb-2">Nama Kamar</label>
                            <input type="text" name="nama_kamar"
                                value="<?= $editRoom['nama_kamar']; ?>"
                                class="border p-2 w-full" required>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2">Gambar Room</label>
                            <input type="file" name="gambar_kamar" class="border p-2 w-full">
                            <p class="text-sm text-gray-500 mt-1">
                                Kosongkan jika tidak mengganti gambar
                            </p>
                            <img src="../kamar/<?= $editRoom['gambar_kamar']; ?>" class="w-24 mt-2">
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2">Harga</label>
                            <input type="number" name="harga"
                                value="<?= $editRoom['harga']; ?>"
                                class="border p-2 w-full" required>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2">Fasilitas</label>
                            <input type="text" name="fasilitas"
                                value="<?= $editRoom['fasilitas']; ?>"
                                class="border p-2 w-full" required>
                        </div>

                        <div class="flex gap-3">
                            <button class="bg-pink-500 text-white px-4 py-2 rounded">
                                Update
                            </button>
                            <a href="dashboard.php"
                                class="bg-gray-400 text-white px-4 py-2 rounded">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            <?php } ?>


            <!--Kamar-->
            <div class="bg-white rounded-xl shadow p-6 mb-8" id="data-kamar">
                <h2 class="text-xl font-semibold mb-4">Data Kamar</h2>

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 text-left">Nama Kamar</th>
                            <th class="py-2 text-left">Gambar</th>
                            <th class="py-2 text-left">Harga</th>
                            <th class="py-2 text-left">Fasilitas</th>
                            <th class="py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($r = mysqli_fetch_assoc($room)) { ?>
                            <tr class="border-b">
                                <td><?= $r['nama_kamar']; ?></td>
                                <td>
                                    <img src="../kamar/<?= $r['gambar_kamar']; ?>" class="w-20">
                                </td>
                                <td>Rp <?= number_format($r['harga'], 0, ',', '.'); ?></td>
                                <td><?= $r['fasilitas']; ?></td>
                                <td>
                                    <a href="dashboard.php?edit=<?= $r['id_room']; ?>" class="bg-blue-500 px-3 py-3 rounded-4xl mr-3 text-white">Edit</a>
                                    <a href="proses_hapus_kamar.php?id=<?= $r['id_room']; ?>" class="bg-red-500 px-3 py-3 rounded-4xl mr-3 text-white">Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- TABLE BOOKING -->
            <div class="bg-white rounded-xl shadow p-6" id="data-booking">
                <h2 class="text-xl font-semibold mb-4">Data Booking</h2>

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 text-left">Nama</th>
                            <th class="py-2 text-left">Email</th>
                            <th class="py-2 text-left">Kamar</th>
                            <th class="py-2 text-left">Check-in</th>
                            <th class="py-2 text-left">Check-out</th>
                            <th class="py-2 text-left">Harga</th>
                            <th class="py-2 text-left">Total</th>
                            <th class="py-2 text-left">Bukti Pembayaran</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $data = mysqli_query($koneksi, "SELECT * FROM booking ORDER BY id_tamu");
                        while ($row = mysqli_fetch_assoc($data)) {
                        ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2"><?= $row['name']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td><?= $row['room']; ?></td>
                                <td><?= $row['checkin']; ?></td>
                                <td><?= $row['checkout']; ?></td>
                                <td>Rp <?= number_format($row['price'], 0, ',', '.'); ?></td>
                                <td>Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>
                                <td>
                                    <img src="../uploads/<?= $row['bukti']; ?>" alt="Bukti Pembayaran" class="w-20">
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </main>
    </div>

</body>

</html>