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
include '../../layout/header.php';
include '../../config/database.php';

$database = new database();
$database->conn();

$query = "SELECT p.*, b.judul, b.penerbit FROM penjualan p JOIN buku b ON p.id_buku = b.id_buku";
$penjualan = $database->data($query);
?>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
        <?php
        include '../../layout/footer.php';
        ?>
        <main class="h-full pb-16 overflow-y-auto">
            <div class="container grid px-6 mx-auto">
                <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    Data
                </h2>
                <div>
                    <a href="tambah.php"><button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Tambah Penjualan
                    </button></a>
                </div>
                <div class="w-full overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">Tanggal</th>
                                    <th class="px-4 py-3">Kode Buku</th>
                                    <th class="px-4 py-3">Judul</th>
                                    <th class="px-4 py-3">Penerbit</th>
                                    <th class="px-4 py-3">Jumlah</th>
                                    <th class="px-4 py-3">Diskon</th>
                                    <th class="px-4 py-3">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                <?php foreach ($penjualan as $baris) : ?>
                                    <td class="border px-4 py-3"><?= $baris['tanggal'] ?></td>
                                    <td class="border px-4 py-3"><?= $baris['id_buku'] ?></td>
                                    <td class="border px-4 py-3"><?= $baris['judul'] ?></td>
                                    <td class="border px-4 py-3"><?= $baris['penerbit'] ?></td>
                                    <td class="border px-4 py-3"><?= $baris['jumlah'] ?></td>
                                    <td class="border px-4 py-3"><?= $baris['diskon'] ?></td>
                                    <td class="border px-4 py-3"><?= $baris['sub_total'] ?></td>
                                <?php endforeach; ?>
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