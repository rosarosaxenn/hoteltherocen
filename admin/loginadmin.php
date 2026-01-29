<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="icon" href="../img/sampul.jpg">
    <link rel="icon" href="img/sampul.jpg">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
</head>

<body>
    <div 
  class="h-screen bg-fixed bg-cover bg-center flex items-center justify-center"
  style="background-image: url('../img/bg.jpg');"
>

        <div class="text-white text-center font-serif" data-aos="fade-up">
            <h1 class="text-7xl font-bold">Admin Hotel The RoCen</h1>
            <h3 class="text-white text-center text-xl">Silakan login terlebih dahulu</h3>

            <form action="proses_loginadmin.php" method="POST" class="mt-3 font-bold w-100 mx-auto">
                <div class="text-left">
                    <label for="nama" class="block mb-1">Nama:</label>
                    <input type="text" id="nama" name="nama" required class="w-full p-2 rounded border border-gray-300 text-white">

                    <label for="sandi" class="block mb-1">Password:</label>
                    <input type="password" id="sandi" name="sandi" required class="w-full p-2 rounded border border-gray-300 text-white">
                </div>
                
                <button type="submit" class="w-30 mt-3 rounded-full bg-pink-500 hover:bg-pink-600 transition-colors p-2 rounded font-semibold">
                    Login
                </button>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

</body>

</html>