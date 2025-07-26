<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="card p-4 shadow" style="width: 400px;">
        <h4 class="text-center mb-3">Register Akun</h4>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button name="daftar" class="btn btn-primary w-100">Daftar</button>
            <div class="text-center mt-3">
                Sudah punya akun? <a href="login.php">Login</a>
            </div>
        </form>

        <?php
        if (isset($_POST['daftar'])) {
            $nama = htmlspecialchars($_POST['nama_lengkap']);
            $u = htmlspecialchars($_POST['username']);
            $p = md5($_POST['password']);

            $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$u'");
            if (mysqli_num_rows($cek) > 0) {
                echo '<div class="alert alert-warning mt-3">Username sudah digunakan.</div>';
            } else {
                mysqli_query($koneksi, "INSERT INTO users (nama_lengkap, username, password, level) VALUES ('$nama', '$u', '$p', 'client')");
                echo '<div class="alert alert-success mt-3">Pendaftaran berhasil! Mengalihkan ke halaman login...</div>';
                echo '<meta http-equiv="refresh" content="2;url=login.php">';
            }
        }
        ?>
    </div>
</body>
</html>
