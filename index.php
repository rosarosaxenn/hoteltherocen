<?php
include 'backend/koneksi.php';

$room = mysqli_query($koneksi, "SELECT * FROM room");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hotel The RoCen</title>

  <link rel="icon" href="img/sampul.jpg" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

  <style>
    html {
      scroll-behavior: smooth;
    }
  </style>

</head>

<body class="text-gray-800 font-serif">

  <!-- NAVBAR -->
  <header class="bg-pink-200 sticky top-0 z-50" data-aos="fade-down">
    <div class="container mx-auto flex justify-between items-center px-5 py-4">
      <h1 class="font-extrabold text-lg">Hotel The RoCen</h1>
      <ul class="flex gap-4 text-sm font-medium">
        <li><a href="#home" class="hover:text-pink-600">Home</a></li>
        <li><a href="#price" class="hover:text-pink-600">Price</a></li>
        <li><a href="#booking" class="hover:text-pink-600">Booking</a></li>
        <li><a href="#contact" class="hover:text-pink-600">Contact</a></li>
        <li><a href="#about" class="hover:text-pink-600">About</a></li>
      </ul>
    </div>
  </header>

  <!-- HERO -->
  <section id="home" class="h-screen bg-[url('img/bg.jpg')] bg-cover bg-center flex items-center justify-center" data-aos="fade-up">
    <div class="text-center text-white">
      <h1 class="text-5xl md:text-7xl font-bold">Hotel The RoCen</h1>
      <p class="mt-3 text-lg">Hotel terjangkau dengan fasilitas lengkap</p>
    </div>
  </section>

  <!-- PRICE LIST -->
  <section id="price" class="py-16" data-aos="fade-up">
    <h2 class="text-2xl font-bold text-center mb-10">Room's Price List</h2>

    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 px-5">

      <!-- CARD -->
      <?php while ($r = mysqli_fetch_assoc($room)) { ?>
        <div class="border rounded-xl p-4 text-center shadow hover:shadow-lg transition">
          <h3 class="text-xl font-semibold mb-3">
            <?= $r['nama_kamar']; ?>
          </h3>

          <img src="kamar/<?= $r['gambar_kamar']; ?>" class="mx-auto rounded-lg mb-3 w-full object-cover">

          <p class="font-medium">
            Rp <?= number_format($r['harga'], 0, ',', '.'); ?> / malam
          </p>

          <p class="text-sm text-gray-600">
            <?= $r['fasilitas']; ?>
          </p>

          <a href="#booking"
            class="mt-4 inline-block bg-pink-300 hover:bg-pink-400 px-4 py-2 rounded-full">
            Book Now
          </a>
        </div>
      <?php } ?>



    </div>
  </section>

  <!-- BOOKING -->
  <section id="booking" class="py-16 bg-gray-50" data-aos="fade-up">
    <h2 class="text-2xl font-bold text-center mb-8">Form Pemesanan</h2>

    <form action="admin/proses_booking.php" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto bg-white p-6 rounded-xl shadow">
      <label class="block mb-3">
        <span class="font-semibold">Nama Lengkap</span>
        <input type="text" name="name" class="w-full border rounded p-2 mt-1">
      </label>

      <label class="block mb-3">
        <span class="font-semibold">Email</span>
        <input type="email" name="email" class="w-full border rounded p-2 mt-1">
      </label>

      <label class="block mb-3">
        <span class="font-semibold">Pilih Kamar</span>
        <select name="room" class="w-full border rounded p-2 mt-1">
          <?php
          mysqli_data_seek($room, 0); // reset pointer
          while ($r = mysqli_fetch_assoc($room)) {
          ?>
            <option value="<?= $r['nama_kamar']; ?>">
              <?= $r['nama_kamar']; ?>
            </option>
          <?php } ?>
        </select>
      </label>


      <label class="block mb-3">
        <span class="font-semibold">Harga</span>
        <select name="price" class="w-full border rounded p-2 mt-1">
          <?php
          mysqli_data_seek($room, 0);
          while ($r = mysqli_fetch_assoc($room)) {
          ?>
            <option value="<?= $r['harga']; ?>">
              <?= $r['nama_kamar']; ?> -
              Rp <?= number_format($r['harga'], 0, ',', '.'); ?> / malam
            </option>
          <?php } ?>
        </select>
      </label>


      <label class="block mb-3">
        <span class="font-semibold">Check-in</span>
        <input type="date" name="checkin" class="w-full border rounded p-2 mt-1">
      </label>

      <label class="block mb-5">
        <span class="font-semibold">Check-out</span>
        <input type="date" name="checkout" class="w-full border rounded p-2 mt-1">
      </label>

      <label class="block mb-5">
        <span class="font-semibold">Upload Bukti Pembayaran</span>
        <input
          type="file"
          name="bukti"
          accept="image/*"
          class="w-full border rounded p-2 mt-1 bg-white cursor-pointer"
          required>
      </label>

      <button type="submit" class="w-full bg-pink-300 hover:bg-pink-400 py-2 rounded-full font-semibold">
        Pesan Sekarang
      </button>
    </form>
  </section>

  <!-- FOOTER -->
  <footer class="bg-pink-200 py-10" data-aos="fade-up">
    <div class="container mx-auto px-5 grid md:grid-cols-2 gap-6 text-center md:text-left">

      <div id="contact">
        <h3 class="text-xl font-bold mb-2">Contact</h3>
        <p>Email: info@hoteltherocen.com</p>
        <p>Telp: (021) 123-4567</p>
      </div>

      <div id="about">
        <h3 class="text-xl font-bold mb-2">About</h3>
        <p>Hotel The RoCen adalah hotel modern dengan layanan terbaik di pusat kota.</p>
      </div>

    </div>

    <div class="flex justify-center gap-5 mt-6">
      <img src="img/logo/wa.jpg" class="w-10 h-10">
      <img src="img/logo/ig.png" class="w-10 h-10">
      <img src="img/logo/map.jpg" class="w-10 h-10">
    </div>
  </footer>

  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init();

    function pesan() {
      alert("Pemesanan berhasil! Terima kasih 🙏");
    }
  </script>

</body>

</html>