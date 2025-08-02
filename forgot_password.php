<?php
include 'database/db.php';
session_start();

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Cek apakah email terdaftar
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $reset_token = bin2hex(random_bytes(32));
        $stmt = $pdo->prepare("UPDATE users SET reset_token = :token WHERE email = :email");
        $stmt->execute(['token' => $reset_token, 'email' => $email]);

        $reset_link = "reset_password.php?token=" . $reset_token;
        $success = "Kami telah mengirimkan link reset password ke email Anda. (Simulasi)<br><a href='$reset_link'>$reset_link</a>";
    } else {
        $error = "Email tidak ditemukan dalam sistem.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link href="assets/img/sma12logo.png" rel="icon" />
    <link href="assets/css/warna.css" rel="stylesheet">
     <img class="img-fluid position-absolute w-100 h-100" src="assets/img/login.jpg" alt="" style="object-fit: cover;">
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h4>Lupa Password</h4>
            <p>Masukkan email Anda untuk mengatur ulang password</p>
        </div>
        <div class="card-body p-4">
            <?php if ($success): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php elseif ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="contoh@email.com" required>
                </div>
                <button type="submit" class="btn btn-custom w-100">Kirim Link Reset</button>
            </form>

            <div class="mt-3 text-center">
                <a href="login.php">← Kembali ke Login</a>
            </div>
        </div>
    </div>
</body>
</html>
