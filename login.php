<?php
// Gunakan PDO untuk koneksi ke database
include 'database/db.php'; // Pastikan path ini benar sesuai dengan struktur folder Anda

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Menyiapkan query untuk memeriksa data pengguna
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql); // Ganti $conn dengan $pdo
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Login berhasil, set session
            $_SESSION['user_id'] = $user['id_user'];  // Pastikan kolom id_user sesuai dengan tabel
            $_SESSION['role'] = $user['role'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

            // Redirect berdasarkan role
            if ($user['role'] == 'admin') {
                header('Location: Dashboard/admin.php');
            } elseif ($user['role'] == 'guru') {
                header('Location: Dashboard/guru.php');
            } elseif ($user['role'] == 'siswa') {
                header('Location: Dashboard/siswa.php');
            }
            exit;
        } else {
            $error = "Email atau password salah!";
        }
    } catch (Exception $e) {
        $error = "Terjadi kesalahan: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>E-LEARNING</title>
    <!-- Favicon -->
    <link href="assets/img/sma12logo.png" rel="icon" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
     <link href="assets/css/warna.css" rel="stylesheet">
     <img class="img-fluid position-absolute w-100 h-100" src="assets/img/login.jpg" alt="" style="object-fit: cover;">
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h3>Login</h3>
        </div>
        <div class="card-body">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-custom w-100">Login</button>
            </form>
            <p class="text-center mt-3"><a href="register.php">Daftar di sini</a></p>
            <p class="text-center mt-2"><a href="forgot_password.php">Lupa password?</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
