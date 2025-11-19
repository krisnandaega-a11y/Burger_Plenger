<?php
// order_success.php - konfirmasi sederhana
session_start();
$msg = $_SESSION['order_success'] ?? '';
unset($_SESSION['order_success']);
if (empty($msg)) {
    header('Location: order_Version6.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order Success</title>
  <style>
    body{ font-family:Arial,Helvetica,sans-serif; background:#f7fafc; display:flex; align-items:center; justify-content:center; min-height:100vh; margin:0; }
    .card{ background:#fff;padding:28px;border-radius:14px;box-shadow:0 8px 36px rgba(12,32,80,0.06); max-width:640px; text-align:center;}
    .btn{ display:inline-block; padding:10px 14px; border-radius:8px; background:#12c2e9; color:#fff; text-decoration:none; font-weight:700; margin-top:12px; }
  </style>
</head>
<body>
  <div class="card">
    <h2>Pesanan Diterima</h2>
    <p><?php echo htmlspecialchars($msg); ?></p>
    <a class="btn" href="orders_Version6.php">Lihat Pesanan Saya</a>
    <a class="btn" href="index_Version3.php" style="background:#6c757d;margin-left:10px">Kembali ke Dashboard</a>
  </div>
</body>
</html>