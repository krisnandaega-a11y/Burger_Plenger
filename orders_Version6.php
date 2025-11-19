<?php
// orders.php - daftar pesanan user
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: Login_Version2.php');
    exit;
}
require_once 'koneksi_Version5.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT id, full_name, email, phone, address, items, total, status, created_at FROM orders WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pesanan Saya</title>
  <style>
    body{ font-family:Arial,Helvetica,sans-serif; background:#f7fafc; margin:0; padding:24px; }
    .card{ max-width:1000px; margin:24px auto; background:#fff; padding:20px; border-radius:12px; box-shadow:0 6px 30px rgba(12,32,80,0.06); }
    table{ width:100%; border-collapse:collapse; }
    th,td{ padding:10px; border-bottom:1px solid #eef0f6; text-align:left; vertical-align:top; }
    .status { padding:6px 10px; border-radius:8px; font-weight:700; }
    .status.pending{ background:#fff4e6; color:#b66a00; }
    .status.processing{ background:#e8f0ff; color:#0b5fff; }
    .status.completed{ background:#e8fff0; color:#12702a; }
    .status.cancelled{ background:#ffecec; color:#b52222; }
  </style>
</head>
<body>
  <div class="card">
    <h2>Pesanan Saya</h2>
    <?php if (empty($orders)): ?>
      <p>Belum ada pesanan. <a href="order_Version6.php">Buat pesanan sekarang</a></p>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Tgl</th>
            <th>Pesanan</th>
            <th>Total (Rp)</th>
            <th>Status</th>
          </tr>
        </thead>
        <div class="card">
        <a class="btn" href="index_Version3.php" style="background:#6c757d;margin-left:10px">Kembali ke Dashboard</a>
        <tbody>
          <?php foreach ($orders as $o): ?>
            <tr>
              <td><?php echo htmlspecialchars($o['id']); ?></td>
              <td><?php echo htmlspecialchars($o['created_at']); ?></td>
              <td>
                <strong><?php echo htmlspecialchars($o['full_name']); ?></strong><br>
                <?php echo nl2br(htmlspecialchars($o['items'])); ?><br>
                <small><?php echo nl2br(htmlspecialchars($o['address'])); ?></small>
              </td>
              <td><?php echo number_format((float)$o['total'],2,',','.'); ?></td>
              <td>
                <span class="status <?php echo htmlspecialchars($o['status']); ?>"><?php echo htmlspecialchars(ucfirst($o['status'])); ?></span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</body>
</html>