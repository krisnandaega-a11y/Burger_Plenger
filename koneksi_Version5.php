<?php
// koneksi.php
// Sesuaikan credential jika menggunakan hosting / user mysql berbeda
$host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'db_login';

$mysqli = new mysqli($host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_errno) {
    // Di development tampilkan error, di production log dan tampilkan pesan umum
    die("Koneksi gagal: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8mb4");
?>