<?php
// order.php - form Order Now (hanya untuk user yang sudah login)
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: Login_Version2.php');
    exit;
}
require_once 'koneksi_Version5.php';

// Ambil data user untuk prefill
$user_id = $_SESSION['user_id'];
$stmt = $mysqli->prepare("SELECT username, email FROM users WHERE id = ? LIMIT 1");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();

// Tampilkan pesan sukses/error jika ada
$order_success = $_SESSION['order_success'] ?? '';
$order_errors = $_SESSION['order_errors'] ?? [];
unset($_SESSION['order_success'], $_SESSION['order_errors']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order Now</title>
  <style>
    /* Gunakan style serupa Login/Register agar konsisten */
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');
    body { min-height:100vh; font-family:'Montserrat',Arial,sans-serif; margin:0; background: linear-gradient(120deg,#12c2e9,#c471ed 70%,#f64f59 100%); display:flex; align-items:center; justify-content:center; padding:20px; }
    .card { background:rgba(255,255,255,0.97); width:100%; max-width:720px; padding:28px; border-radius:18px; box-shadow:0 6px 30px rgba(12,32,80,0.07); }
    h2{ margin-top:0; color:#333; text-shadow:0 2px 8px #f64f5955; }
    .grid { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    .form-group { margin-bottom:12px; }
    label{ display:block; font-weight:600; color:#1274b3; margin-bottom:6px; }
    input[type="text"], input[type="email"], input[type="tel"], input[type="number"], textarea {
      width:100%; padding:10px 12px; border-radius:8px; border:none; background:#ece9f7; outline:none;
    }
    textarea{ min-height:100px; resize:vertical; }
    .btn { display:inline-block; background:linear-gradient(90deg,#12c2e9 16%,#c471ed 85%,#f64f59 100%); color:#fff; padding:12px 18px; border-radius:10px; border:none; cursor:pointer; font-weight:700; }
    .msg { padding:10px 12px; border-radius:8px; margin-bottom:12px; }
    .msg.success{ background:#e8fff0; color:#12702a; border:1px solid #bfeacb; }
    .msg.error{ background:#ffecec; color:#b52222; border:1px solid #f5c2c2; }
    table{ width:100%; border-collapse:collapse; margin-top:12px; }
    td, th{ padding:10px; border-bottom:1px solid #eef0f6; text-align:left; }
    @media (max-width:720px){ .grid{ grid-template-columns:1fr; } }
  </style>
</head>
<body>
  <div class="card">
    <h2>Order Now</h2>

    <?php if ($order_success): ?>
      <div class="msg success"><?php echo htmlspecialchars($order_success); ?></div>
    <?php endif; ?>
    <?php if (!empty($order_errors)): ?>
      <div class="msg error"><?php echo htmlspecialchars(implode('<br>', $order_errors)); ?></div>
    <?php endif; ?>

    <form action="order_process_Version6.php" method="post" novalidate>
      <div class="grid">
        <div class="form-group">
          <label for="full_name">Nama Lengkap</label>
          <input type="text" id="full_name" name="full_name" required value="<?php echo htmlspecialchars($username ?? ''); ?>">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email ?? ''); ?>">
        </div>
        <div class="form-group">
          <label for="phone">Telepon</label>
          <input type="tel" id="phone" name="phone" placeholder="0812xxxx" >
        </div>
        <div class="form-group">
          <label for="total">Total (Rp)</label>
          <input type="number" id="total" name="total" step="0.01" min="0" placeholder="0.00" required>
        </div>
        <div style="grid-column:1/-1" class="form-group">
          <label for="items">Pesanan (menu / catatan)</label>
          <textarea id="items" name="items" placeholder="Tulis menu yang dipesan beserta jumlah..." required></textarea>
        </div>
        <div style="grid-column:1/-1" class="form-group">
          <label for="address">Alamat / Catatan Pengiriman</label>
          <textarea id="address" name="address" placeholder="Alamat lengkap atau catatan..." ></textarea>
        </div>
      </div>

      <div style="margin-top:12px;">
        <button type="submit" class="btn">Kirim Pesanan</button>
        <a href="orders_Version6.php" style="margin-left:12px; text-decoration:none;" class="btn" >Lihat Pesanan Saya</a>
      </div>
    </form>
  </div>
</body>
</html>