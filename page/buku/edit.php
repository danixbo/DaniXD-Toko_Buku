<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tables - Windmill Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../../assets/css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="../../assets/js/init-alpine.js"></script>
</head>

<?php
include '../../config/database.php';

$sql = 'SELECT * FROM buku WHERE id_buku = ' . $_GET['id'];
$hasil = $conn->query($sql);
$data = $hasil->fetch_assoc();

if (isset($_POST['id_buku'])) {
    $sql = 'UPDATE buku SET 
            judul    = "' . $_POST['judul'] . '"   ,
            penulis  = "' . $_POST['penulis'] . '" ,
            penerbit = "' . $_POST['penerbit'] . '",
            stok     = "' . $_POST['stok'] . '"    ,
            harga_pokok = "' . $_POST['harga_pokok'] . '",
            WHERE id_buku = ' . $_GET['id_buku'];
            $conn->query($sql);
            header('Location: index.php');
        }
?>


<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
    <!-- Desktop sidebar -->
      <?php
      include '../../layout/footer.php';
      ?>
      <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Edit Data
          </h2>
          <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?= $data['id_buku']; ?>">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Judul</span>
                    <input name="judul"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Judul baru" value="<?= $data['judul']; ?>" />
                </label>
                <div class="mt-4"></div>
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Penulis</span>
                    <input name="penulis"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Penulis baru" value="<?= $data['penulis']; ?>" />
                </label>
                <div class="mt-4"></div>
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Penerbit</span>
                    <input name="penerbit"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Penerbit baru" value="<?= $data['penerbit']; ?>" />
                </label>
                <div class="mt-4"></div>
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Stok</span>
                    <input name="stok"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Stok baru" value="<?= $data['stok']; ?>" />
                </label>
                <div class="mt-4"></div>
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Harga</span>
                    <input name="harga"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Harga baru" value="<?= $data['harga_pokok']; ?>" />
                </label>
                <div class="mt-8 flex">
                    <div>
                        <button type="submit" name="submit"
                            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
        </div>
      </main>
    </div>
  </div>
</body>

</html>