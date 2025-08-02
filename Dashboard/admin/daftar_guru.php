<?php
session_start();

// Periksa apakah pengguna adalah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Redirect ke halaman login jika bukan admin
    exit;
}

require_once '../../database/db.php'; // Pastikan file db.php ada dan berfungsi

// Ambil data guru dari database
try {
    // Tambahkan kolom password di SELECT query
    $query = "SELECT id_user, nama_lengkap, email, telepon, mata_pelajaran, password FROM users WHERE role = 'guru'";
    $stmt = $pdo->query($query);
    $guruList = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Daftar Guru</title>
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Daftar Guru</h1>
    <a href="../admin.php" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Password</th> <!-- Kolom password ditambahkan -->
                <th>Telepon</th>
                <th>Mata Pelajaran</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($guruList)): ?>
                <?php $no = 1; ?>
                <?php foreach ($guruList as $guru): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($guru['nama_lengkap']); ?></td>
                        <td><?= htmlspecialchars($guru['email']); ?></td>
                        <td><?= htmlspecialchars($guru['password']); ?></td> <!-- Tampilkan password plain text -->
                        <td><?= htmlspecialchars($guru['telepon']); ?></td>
                        <td><?= htmlspecialchars($guru['mata_pelajaran']); ?></td>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data guru.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
