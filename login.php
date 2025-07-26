<?php
session_start();
include 'config/koneksi.php';

if (isset($_POST['login'])) {
    $u = $_POST['username'];
    $p = md5($_POST['password']);
    $q = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$u' AND password='$p'");
    $d = mysqli_fetch_array($q);
    if ($d) {
        $_SESSION['users'] = $d;
        if ($d['level'] == 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: client/dashboard.php");
        }
        exit;
    } else {
        $error = "Login gagal! Periksa kembali username & password.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="card p-4 shadow" style="width: 400px;">
        <h4 class="text-center mb-3">Login Akun</h4>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            <div class="text-center mt-3">
                Belum punya akun? <a href="register.php">Register</a>
            </div>
        </form>

        <?php if (isset($error)) : ?>
        <div class="alert alert-danger mt-3"><?= $error; ?></div>
        <?php endif; ?>
    </div>
</body>

</html>