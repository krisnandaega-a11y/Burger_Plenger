<?php
// order_process.php - simpan pesanan ke tabel orders
session_start();
require_once 'koneksi_Version5.php';

if (empty($_SESSION['user_id'])) {
    header('Location: Login_Version2.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: order_Version6.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$full_name = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$items = trim($_POST['items'] ?? '');
$total = $_POST['total'] ?? '0';

$errors = [];
if ($full_name === '') $errors[] = "Nama lengkap wajib diisi.";
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email tidak valid.";
if ($items === '') $errors[] = "Detail pesanan wajib diisi.";
if (!is_numeric($total) || (float)$total < 0) $errors[] = "Total tidak valid.";

if (!empty($errors)) {
    $_SESSION['order_errors'] = $errors;
    header('Location: order_Version6.php');
    exit;
}

// Simpan ke tabel orders
$sql = "INSERT INTO orders (user_id, full_name, email, phone, address, items, total) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    $_SESSION['order_errors'] = ["Database error: " . $mysqli->error];
    header('Location: order_Version6.php');
    exit;
}
$tot = number_format((float)$total, 2, '.', '');
$stmt->bind_param('isssssd', $user_id, $full_name, $email, $phone, $address, $items, $tot);
$ok = $stmt->execute();
$stmt->close();

if ($ok) {
    $_SESSION['order_success'] = "Pesanan berhasil dikirim. Terima kasih!";
    // Anda bisa redirect ke halaman detail or orders list
    header('Location: order_success_Version6.php');
    exit;
} else {
    $_SESSION['order_errors'] = ["Gagal menyimpan pesanan: " . $mysqli->error];
    header('Location: order_Version6.php');
    exit;
}
?>