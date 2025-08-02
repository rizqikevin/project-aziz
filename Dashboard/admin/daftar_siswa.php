<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

require_once '../../database/db.php';

try {
    $query = "SELECT id_user, nama_lengkap, email, password, telepon, kelas FROM users WHERE role = 'siswa'";
    $stmt = $pdo->query($query);
    $siswaList = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Daftar Siswa</title>
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Daftar Siswa</h1>
    <a href="../admin.php" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Password</th> <!-- Tampilkan password apa adanya -->
                <th>Telepon</th>
                <th>Kelas</th>

            </tr>
        </thead>
        <tbody>
            <?php if (!empty($siswaList)): ?>
                <?php $no = 1; ?>
                <?php foreach ($siswaList as $siswa): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($siswa['nama_lengkap']); ?></td>
                        <td><?= htmlspecialchars($siswa['email']); ?></td>
                        <td><?= htmlspecialchars($siswa['password']); ?></td>
                        <td><?= htmlspecialchars($siswa['telepon']); ?></td>
                        <td><?= htmlspecialchars($siswa['kelas']); ?></td>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data siswa.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
