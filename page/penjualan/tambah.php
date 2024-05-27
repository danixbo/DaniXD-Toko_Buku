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
include '../../layout/header.php';
include '../../config/database.php';

$database = new database();
$database->conn();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal'];
    $kode_buku = $_POST['kode_buku'];
    $jumlah = $_POST['jumlah'];
    $diskon = $_POST['diskon'];
    $sub_total = $_POST['sub_total'];

    foreach ($kode_buku as $index => $id_buku) {
        $jumlah_buku = $jumlah[$index];
        $diskon_buku = $diskon[$index];
        $sub_total_buku = $sub_total[$index];

        $sql = "INSERT INTO penjualan (id_buku, jumlah, diskon, tanggal, sub_total) VALUES (?, ?, ?, ?, ?)";
        $params = [$id_buku, $jumlah_buku, $diskon_buku, $tanggal, $sub_total_buku];
        $database->execute($sql, $params);
    }

    header('Location: tambah.php');
    exit;
}

$query = "SELECT * FROM buku";
$buku = $database->data($query);

$buku_json = json_encode($buku);
$database->close(); // Menutup koneksi setelah mengambil data
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
          Tambah Data
        </h2>
        <div class="mb-6">
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Tanggal</span>
              <input type="date" id="tanggal" name="tanggal" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe" value="<?= date("Y-m-d") ?>" readonly/>
            </label>
        </div>

        <div class="mb-6">
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Total</span>
              <input type="text" id="total" name="total" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe" readonly/>
            </label>
        </div>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
          <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
              <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                  <th class="px-4 py-3">Kode Buku</th>
                  <th class="px-4 py-3">Judul</th>
                  <th class="px-4 py-3">Penerbit</th>
                  <th class="px-4 py-3">Harga</th>
                  <th class="px-4 py-3">Jumlah</th>
                  <th class="px-4 py-3">Diskon</th>
                  <th class="px-4 py-3">Sub Total</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <tr class="text-gray-700 dark:text-gray-400">
                  <td class="px-4 py-3 text-sm">
                    <input name="kode_buku[]" class="kode_buku block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe" />
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <input name="judul[]" class="judul block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe" readonly/>
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <input name="penerbit[]" class="penerbit block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe" readonly/>
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <input name="harga[]" class="harga block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe" readonly/>
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <input name="jumlah[]" class="jumlah block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe" />
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <input name="diskon[]" class="diskon block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe" />
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <input name="sub_total[]" class="sub_total block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe" readonly/>
                  </td>
                </tr>
              </tbody>

            </table>
          </div>
          <div class="gap-6 grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
              <button type="button" id="tambah-baris"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Tambah Pembelian
              </button>
              <button type="submit"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Simpan Pembelian
              </button>
          </div>
        </div>
      </div>
    </main>
  </div>
  </div>
</body>

<script>
  let data_buku = <?= $buku_json ?>;

  document.addEventListener('input', function(event) {
    if (event.target.classList.contains('kode_buku')) {
      let id_buku = event.target.value;
      let row = event.target.closest('tr');
      let buku = data_buku.find(b => b.id_buku == id_buku);

      if (buku) {
        row.querySelector('.judul').value = buku.judul;
        row.querySelector('.penerbit').value = buku.penerbit;
        row.querySelector('.harga').value = buku.harga_jual;
        row.querySelector('.diskon').value = buku.diskon || 0;
        calculateSubTotal(row); 
      } else {
        row.querySelector('.judul').value = '';
        row.querySelector('.penerbit').value = '';
        row.querySelector('.harga').value = '';
        row.querySelector('.diskon').value = '';
        row.querySelector('.sub_total').value = '';
      }
      calculateTotal();
    }
  });

  document.addEventListener('input', function(event) {
    if (event.target.classList.contains('jumlah') || event.target.classList.contains('diskon')) {
      let row = event.target.closest('tr');
      calculateSubTotal(row);
      calculateTotal();
    }
  });

  document.getElementById('tambah-baris').addEventListener('click', function() {
    let newRow = document.querySelector('#tbody-pembelian tr').cloneNode(true);
    newRow.querySelectorAll('input').forEach(input => input.value = '');
    document.getElementById('tbody-pembelian').appendChild(newRow);
  });

  document.addEventListener('click', function(event) {
    if (event.target.classList.contains('remove')) {
      let row = event.target.closest('tr');
      row.remove();
      calculateTotal();
    }
  });

  function calculateSubTotal(row) {
    let harga = parseFloat(row.querySelector('.harga').value) || 0;
    let jumlah = parseFloat(row.querySelector('.jumlah').value) || 0;
    let diskon = parseFloat(row.querySelector('.diskon').value) || 0;

    let sub_total = (harga * jumlah) - diskon;
    row.querySelector('.sub_total').value = sub_total.toFixed(2);
  }

  function calculateTotal() {
    let total = 0;
    document.querySelectorAll('.sub_total').forEach(function(sub_total) {
      total += parseFloat(sub_total.value) || 0;
    });
    document.getElementById('total').value = total.toFixed(2);
  }

</script>