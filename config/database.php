<?php

$host = "localhost";
$db = "toko_buku_2";
$user = "root";
$pass = "";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
// mysqli_close($conn);
?>