<?php
include 'database/db.php';
session_start();

$token = $_GET['token'] ?? null;
$showForm = false;
$message = '';

if ($token) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token = :token");
    $stmt->execute(['token' => $token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $showForm = true;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password = :password, reset_token = NULL WHERE id_user = :id");
            $stmt->execute([':password' => $new_password, ':id' => $user['id_user']]);

            $message = "<div class='alert alert-success text-center'>Password berhasil direset. <a href='login.php'>Login di sini</a></div>";
            $showForm = false;
        }
    } else {
        $message = "<div class='alert alert-danger text-center'>Token tidak valid atau telah digunakan.</div>";
    }
} else {
    $message = "<div class='alert alert-warning text-center'>Token tidak ditemukan.</div>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="assets/img/logo new.png">
    <link href="assets/css/warna.css" rel="stylesheet">
    <img class="img-fluid position-absolute w-100 h-100" src="assets/img/login.jpg" alt="" style="object-fit: cover;">
</head>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h4>Atur Ulang Password</h4>
        </div>
        <div class="card-body p-4">
            <?= $message ?>

            <?php if ($showForm): ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <button type="submit" class="btn btn-custom w-100">Reset Password</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
