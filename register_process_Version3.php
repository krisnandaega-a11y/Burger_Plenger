<?php
// register_process.php
session_start();
require_once 'koneksi_Version5.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: Register_Version2.php');
    exit;
}

// Ambil & bersihkan input
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

$errors = [];
if (strlen($username) < 3) $errors[] = "Username minimal 3 karakter.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email tidak valid.";
if (strlen($password) < 6) $errors[] = "Password minimal 6 karakter.";
if ($password !== $confirm) $errors[] = "Password dan konfirmasi tidak sama.";

if (!empty($errors)) {
    $_SESSION['register_errors'] = $errors;
    $_SESSION['old'] = ['username'=>$username, 'email'=>$email];
    header('Location: Register_Version2.php');
    exit;
}

// Cek unik username/email
$sql = "SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1";
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    $_SESSION['register_errors'] = ["Database error: ". $mysqli->error];
    header('Location: Register_Version2.php');
    exit;
}
$stmt->bind_param('ss', $username, $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $_SESSION['register_errors'] = ["Username atau email telah terdaftar."];
    $_SESSION['old'] = ['username'=>$username, 'email'=>$email];
    $stmt->close();
    header('Location: Register_Version2.php');
    exit;
}
$stmt->close();

// Hash password dan simpan user baru
$hash = password_hash($password, PASSWORD_DEFAULT);
$insert = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($insert);
if (!$stmt) {
    $_SESSION['register_errors'] = ["Database error: ". $mysqli->error];
    header('Location: Register_Version2.php');
    exit;
}
$stmt->bind_param('sss', $username, $email, $hash);
$ok = $stmt->execute();
$stmt->close();

if ($ok) {
    $_SESSION['success'] = "Registrasi berhasil. Silakan login.";
    header('Location: Login_Version2.php');
    exit;
} else {
    $_SESSION['register_errors'] = ["Gagal menyimpan data: ". $mysqli->error];
    header('Location: Register_Version2.php');
    exit;
}
?>