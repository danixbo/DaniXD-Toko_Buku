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

  $query = "SELECT * FROM buku LIMIT 10";
  $hasil = $conn->query($query);

  if (isset($_POST["keyword"])) {
    $cari = $_POST["keyword"];

    $stmt = $conn->prepare("SELECT * FROM buku WHERE judul LIKE ? 
                            OR penulis LIKE ?
                            OR penerbit LIKE ?
                            OR stok LIKE ?
                            OR harga_pokok LIKE ? LIMIT 10");

    $keyword = "%$cari%";
    $stmt->bind_param("sssss", $keyword, $keyword, $keyword, $keyword, $keyword);

    $stmt->execute();

    $hasil = $stmt->get_result();
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
            Data
          </h2>

          <div class="flex justify-between mb-4">
            <!-- With actions -->
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
              Data Penulis
            </h4>
            <form method="POST" action="">
              <div class="flex">
                <input class="mr-2 block w-3/6 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="text" name="keyword" placeholder="Judul atau Penulis"/>
                <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" type="submit" name="submit">
                  Cari
                </button>
              </div>
            </form>
          </div>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">Penulis</th>
                    <th class="px-4 py-3">Penerbit</th>
                    <th class="px-4 py-3">Stok</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Aksi</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php 
                  $i = 1;
                  foreach($hasil as $data) :
                ?>
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm">
                      <?= $i; ?>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <?= $data["judul"]; ?>
                    </td>
                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                          <img class="object-cover w-full h-full rounded-full" src="https://source.unsplash.com/random" alt="" loading="lazy" />
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                          <p class="font-semibold"><?= $data["penulis"]; ?></p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <?= $data["penerbit"]; ?>
                    </td>
                    <td class="px-4 py-3 text-xs">
                      <span class="px-2 py-1 text-sm text-purple-700 bg-purple-100 rounded-full dark:bg-purple-700 dark:text-purple-100">
                        <?= $data["stok"]; ?>
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <?= $data["harga_pokok"]; ?>
                    </td>
                    <td class="px-4 py-3">
                      <div class="flex items-center space-x-4 text-sm">
                        <a href="edit.php?id=<?= $data['id_buku']; ?>" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-700 bg-purple-100 rounded-lg dark:text-green-100 dark:bg-green-700 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                          <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                          </svg>
                        </a>
                        <a href="delete.php?id=<?= $data['id_buku']; ?>" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-700 bg-red-100 rounded-lg dark:text-red-100 dark:bg-red-700 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                      </div>
                    </td>
                  </tr>
                  <?php $i++; endforeach; ?>
              </tbody>

              </table>
            </div>
            <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
              <span class="flex items-center col-span-3">
                Showing 10-30 of 100
              </span>
              <span class="col-span-2"></span>
              <!-- Pagination -->
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</body>

</html>