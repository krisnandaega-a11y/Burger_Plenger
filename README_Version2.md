```markdown
# Project: Login & Register (PHP + MySQL) — Demo

Ini adalah paket contoh sederhana untuk registrasi dan login menggunakan PHP (mysqli), menyimpan user ke MySQL (phpMyAdmin). Cocok untuk pengembangan lokal (XAMPP) atau di-hosting.

Isi folder:
- db_login.sql — SQL untuk membuat database & tabel `users`.
- koneksi.php — file koneksi ke database.
- register_process.php — proses registrasi (POST).
- login_process.php — proses login (POST).
- logout.php — logout user.
- Register.php — form registrasi (menampilkan pesan server-side).
- Login.php — form login (menampilkan pesan server-side).
- index.php — contoh halaman protected.
- README.md — file ini.

## Cara menjalankan (di Windows pake XAMPP)
1. Install XAMPP dari https://www.apachefriends.org/ (jika belum).
2. Start Apache dan MySQL di XAMPP Control Panel.
3. Buka http://localhost/phpmyadmin
4. Import file `db_login.sql`:
   - Klik database -> Import -> pilih file `db_login.sql` -> Go.
   - Atau buat database `db_login` dan buat tabel `users` sesuai SQL.
5. Salin semua file project ke folder project di `htdocs`, misal:
   `C:\xampp\htdocs\myproject\`
6. Buka browser:
   - Register page: http://localhost/myproject/Register.php
   - Login page: http://localhost/myproject/Login.php
7. Setelah registrasi sukses, login dengan username/email dan password yang dibuat.
8. Setelah login, kamu akan diarahkan ke `index.php` (halaman dilindungi).
9. Untuk logout, klik tombol Logout dan session akan dihapus.

## Catatan keamanan & saran
- Password disimpan menggunakan `password_hash()` (aman). Saat login menggunakan `password_verify()`.
- Jangan simpan kredensial (koneksi.php) ke repo publik tanpa proteksi.
- Untuk produksi: gunakan HTTPS, CSRF token, validasi sisi server, rate limiting, email verification.
- Pada deployment di shared hosting, sesuaikan credential MySQL (user/password) di `koneksi.php`.

## Jika mau saya push file ke GitHub
Berikan nama repository dengan format `owner/repo` dan saya bantu siapkan langkah push (atau buat PR) — saya akan butuh akses repo atau kamu bisa lakukan `git push` sendiri setelah saya kirimkan file.
```