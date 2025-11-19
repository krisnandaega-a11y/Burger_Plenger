<?php
// login_process.php
session_start();
require_once 'koneksi_Version5.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: Login_Version2.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    $_SESSION['login_error'] = "Isi username/email dan password.";
    header('Location: Login_Version2.php');
    exit;
}

$sql = "SELECT id, username, password FROM users WHERE username = ? OR email = ? LIMIT 1";
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    $_SESSION['login_error'] = "Database error: ". $mysqli->error;
    header('Location: Login_Version2.php');
    exit;
}
$stmt->bind_param('ss', $username, $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    $_SESSION['login_error'] = "Username/email tidak ditemukan.";
    $stmt->close();
    header('Location: Login_Version2.php');
    exit;
}

$stmt->bind_result($id, $user, $hash);
$stmt->fetch();
$stmt->close();

if (password_verify($password, $hash)) {
    session_regenerate_id(true);
    $_SESSION['user_id'] = $id;
    $_SESSION['username'] = $user;
    header('Location: index_Version3.php');
    exit;
} else {
    $_SESSION['login_error'] = "Password salah.";
    header('Location: Login_Version2.php');
    exit;
}
?>