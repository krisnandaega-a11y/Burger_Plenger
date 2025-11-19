<?php
// Login.php (mengganti Login.html supaya bisa menampilkan pesan)
session_start();
$err = $_SESSION['login_error'] ?? '';
$success = $_SESSION['success'] ?? '';
unset($_SESSION['login_error'], $_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Website</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');
    body { min-height: 100vh; font-family: 'Montserrat', Arial, sans-serif; margin: 0;
      background: linear-gradient(120deg, #12c2e9, #c471ed 70%, #f64f59 100%);
      display: flex; align-items: center; justify-content: center; }
    .login-container {
      background: rgba(255,255,255,0.97); width: 100%; max-width: 390px; box-sizing: border-box;
      padding: 44px 28px 32px 28px; border-radius: 26px;
      box-shadow: 0 4px 32px rgba(44,62,80,0.13), 0 2px 10px rgba(200,80,180,0.09);
      display: flex; flex-direction: column; align-items: center; position: relative;
      animation: slideDown 0.6s cubic-bezier(.17,.67,.83,.67);
    }
    @keyframes slideDown { from {transform: translateY(-60px);opacity:0;} to {transform: translateY(0);opacity:1;} }
    .login-header { display:flex; align-items:center; justify-content:center; margin-bottom:28px; width:100%; }
    .login-header svg { width:38px; height:38px; margin-right:7px; fill:#12c2e9; filter: drop-shadow(0 0 6px #c471ed8c); }
    .login-header h2 { margin:0; font-size:2em; color:#333; font-weight:700; letter-spacing:2.5px; text-shadow:0 2px 8px #f64f5955; }
    form { width:100%; }
    .form-group { margin-bottom:21px; position:relative; width:100%; }
    .form-group label { display:block; margin-bottom:6px; font-weight:600; color:#1274b3; font-size:1em; letter-spacing:0.3px; }
    .form-group input { width:100%; box-sizing:border-box; padding:11px 40px 11px 14px; border:none; border-radius:8px; background:#ece9f7; font-size:1em; color:#403f44; box-shadow:0 1px 5px rgba(44,62,80,0.08); transition:box-shadow .2s, background .2s; outline:none; min-width:0; overflow:hidden; max-width:100%; display:block; }
    .form-group input:focus { background:#e2f6fa; box-shadow:0 2px 18px #f64f591c; }
    .form-group .input-icon { position:absolute; right:12px; top:39px; width:20px; height:20px; fill:#c471ed; opacity:0.7; pointer-events:none; }
    .link-row { display:flex; justify-content:space-between; gap:16px; margin-top:6px; margin-bottom:12px; }
    .link-row a { color:#12c2e9; font-size:1em; font-weight:500; text-decoration:none; padding:6px 8px; border-radius:6px; background:#f3f3fa; border:1px solid #e7ecfb; }
    .link-row a:hover { color:#fff; background: linear-gradient(90deg,#12c2e9 40%,#c471ed 100%); }
    .msg { width:100%; margin-bottom:12px; padding:10px 12px; border-radius:8px; font-size:0.95em; }
    .msg.error { background:#ffecec; color:#b52222; border:1px solid #f5c2c2; }
    .msg.success { background:#e8fff0; color:#12702a; border:1px solid #bfeacb; }
    button { background: linear-gradient(90deg, #12c2e9 16%, #c471ed 85%, #f64f59 100%); color: white; border: none; padding: 14px 0; width: 100%; border-radius: 11px; font-size: 1.13em; letter-spacing: 1px; font-weight: 600; cursor: pointer; box-shadow: 0 7px 32px #c471ed18, 0 2px 10px #f64f591a; margin-bottom: 3px; transition: box-shadow .15s, background .19s; }
    button:hover { background: linear-gradient(270deg,#f64f59 50%, #c471ed 85%, #12c2e9 100%); box-shadow: 0 8px 36px #c471ed34, 0 2px 12px #f64f5933; }
    @media (max-width:480px) { body{padding:16px;} .login-container{padding:29px 8px 20px 8px;} .login-header svg{width:29px;height:29px;} .login-header h2{font-size:1.2em;} .form-group .input-icon{top:34px;} }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-header">
      <svg viewBox="0 0 32 32"><circle cx="16" cy="11" r="7"/><path d="M5 27c-0.4-5.3 7-8.3 11-8.3s11 3 11 8.3v2A2 2 0 0 1 25 29H7a2 2 0 0 1-2-2v-2z"/></svg>
      <h2>Login</h2>
    </div>

    <?php if ($err): ?>
      <div class="msg error"><?php echo htmlspecialchars($err); ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
      <div class="msg success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <form action="login_process_Version3.php" method="post" novalidate>
      <div class="form-group">
        <label for="username">Nama Pengguna / Email</label>
        <input type="text" id="username" name="username" placeholder="Masukkan username atau email..." required autocomplete="username">
        <svg class="input-icon" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M3 20c0-3 4-5 9-5s9 2 9 5v2H3v-2z"/></svg>
      </div>

      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <input type="password" id="password" name="password" placeholder="Masukkan password..." required autocomplete="current-password">
        <svg class="input-icon" viewBox="0 0 24 24"><path d="M6 11V7a6 6 0 0 1 12 0v4"/><rect x="6" y="11" width="12" height="9" rx="2"/><circle cx="12" cy="16" r="1.5"/></svg>
      </div>

      <div class="link-row">
        <a href="Lupa Password.html">Lupa Password?</a>
        <a href="Register_Version2.php">Registrasi</a>
      </div>

      <button type="submit">Masuk</button>
    </form>
  </div>
</body>
</html>