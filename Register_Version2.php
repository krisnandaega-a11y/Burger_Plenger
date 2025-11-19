<?php
// Register.php (mengganti Register.html supaya menampilkan pesan)
session_start();
$errors = $_SESSION['register_errors'] ?? [];
$success = $_SESSION['success'] ?? '';
$old = $_SESSION['old'] ?? [];
unset($_SESSION['register_errors'], $_SESSION['success'], $_SESSION['old']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrasi Website</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');
    body {
      min-height: 100vh;
      font-family: 'Montserrat', Arial, sans-serif;
      margin: 0;
      background: linear-gradient(120deg, #12c2e9, #c471ed 70%, #f64f59 100%);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .register-container {
      background: rgba(255,255,255,0.97);
      width: 100%;
      max-width: 390px;
      box-sizing: border-box;
      padding: 44px 28px 32px 28px;
      border-radius: 26px;
      box-shadow: 0 4px 32px rgba(44,62,80,0.13), 0 2px 10px rgba(200,80,180,0.09);
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
      animation: slideDown 0.6s cubic-bezier(.17,.67,.83,.67);
    }
    @keyframes slideDown {
      from {transform: translateY(-60px);opacity:0;}
      to   {transform: translateY(0);opacity:1;}
    }
    .register-header {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 28px;
      width: 100%;
    }
    .register-header svg {
      width: 38px;
      height: 38px;
      margin-right: 7px;
      fill: #12c2e9;
      filter: drop-shadow(0 0 6px #c471ed8c);
    }
    .register-header h2 {
      margin: 0;
      font-size: 2em;
      color: #333;
      font-weight: 700;
      letter-spacing: 2.5px;
      text-shadow: 0 2px 8px #f64f5955;
    }
    form { width: 100%; }
    .form-group {
      margin-bottom: 21px;
      position: relative;
      width: 100%;
    }
    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #1274b3;
      font-size: 1em;
      letter-spacing: 0.3px;
    }
    .form-group input {
      width: 100%;
      box-sizing: border-box;
      padding: 11px 40px 11px 14px;
      border: none;
      border-radius: 8px;
      background: #ece9f7;
      font-size: 1em;
      color: #403f44;
      box-shadow: 0 1px 5px rgba(44,62,80,0.08);
      transition: box-shadow .2s, background .2s;
      outline: none;
      min-width: 0; 
      overflow: hidden;
      max-width: 100%;
      display: block;
    }
    .form-group input:focus {
      background: #e2f6fa;
      box-shadow: 0 2px 18px #f64f591c;
    }
    .form-group .input-icon {
      position: absolute;
      right: 12px;
      top: 39px;
      width: 20px;
      height: 20px;
      fill: #c471ed;
      opacity: 0.7;
      pointer-events: none;
    }
    .login-link {
      display: inline-block;
      color: #12c2e9;
      font-size: 1em;
      font-weight: 500;
      text-align: right;
      margin-top: 6px;
      margin-bottom: 12px;
      text-decoration: none;
      transition: color .16s;
    }
    .login-link:hover {
      color: #f64f59;
      text-decoration: underline;
    }
    button {
      background: linear-gradient(90deg, #12c2e9 16%, #c471ed 85%, #f64f59 100%);
      color: white;
      border: none;
      padding: 14px 0;
      width: 100%;
      border-radius: 11px;
      font-size: 1.13em;
      letter-spacing: 1px;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 7px 32px #c471ed18, 0 2px 10px #f64f591a;
      margin-bottom: 3px;
      transition: box-shadow .15s, background .19s;
  </style>
</head>
<body>
  <div class="register-container">
    <div class="register-header">
      <svg viewBox="0 0 32 32"><rect x="7" y="7" width="18" height="18" rx="5" /><path d="M16 11v6" stroke="#12c2e9" stroke-width="2"/><circle cx="16" cy="19" r="1.5" fill="#c471ed"/></svg>
      <h2>Registrasi</h2>
    </div>

    <?php if (!empty($errors)): ?>
      <div class="msg error"><?php echo htmlspecialchars(implode('<br>', $errors)); ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="msg success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <form action="register_process_Version3.php" method="post" novalidate>
      <div class="form-group">
        <label for="username">Nama Pengguna</label>
        <input type="text" id="username" name="username" placeholder="Masukkan username..." required autocomplete="username" value="<?php echo htmlspecialchars($old['username'] ?? ''); ?>">
        <svg class="input-icon" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M3 20c0-3 4-5 9-5s9 2 9 5v2H3v-2z"/></svg>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Masukkan email..." required autocomplete="email" value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>">
        <svg class="input-icon" viewBox="0 0 24 24"><rect x="2" y="6" width="20" height="12" rx="3" ry="3"/><polyline points="2,6 12,13 22,6"/></svg>
      </div>

      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <input type="password" id="password" name="password" placeholder="Masukkan kata sandi..." required autocomplete="new-password">
        <svg class="input-icon" viewBox="0 0 24 24"><path d="M6 11V7a6 6 0 0 1 12 0v4"/><rect x="6" y="11" width="12" height="9" rx="2"/><circle cx="12" cy="16" r="1.5"/></svg>
      </div>

      <div class="form-group">
        <label for="confirm_password">confirm_password</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Ulangi kata sandi..." required autocomplete="new-password">
        <svg class="input-icon" viewBox="0 0 24 24">
          <circle cx="12" cy="8" r="4"/>
          <rect x="6" y="12" width="12" height="7" rx="2"/>
        </svg>

      <a href="Login_Version2.php" class="login-link">Sudah punya akun? Login</a>
      <button type="submit">Registrasi</button>
    </form>
  </div>
</body>
</html>