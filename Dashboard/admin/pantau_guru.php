<?php
session_start();
include('../../database/db.php');

// Cek role admin (optional, sesuaikan dengan sistem kamu)
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../login.php');
    exit();
}

try {
    $sql = "SELECT g.nama_lengkap AS guru, g.email, g.mata_pelajaran, 
                   t.kelas, t.judul_tugas, t.created_at
            FROM users g
            JOIN tugas_guru t ON g.id_user = t.id_guru
            WHERE g.role = 'guru'
            ORDER BY t.created_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error saat mengambil data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Pantau Guru Mengerjakan Tugas</title>
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Pantau Guru Mengerjakan Tugas</h1>
    <a href="../admin.php" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

    <?php if (empty($data)): ?>
        <div class="alert alert-info">Belum ada tugas dari guru.</div>
    <?php else: ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Email</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
                <th>Judul Tugas</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $index => $row): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($row['guru']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['mata_pelajaran']) ?></td>
                    <td><?= htmlspecialchars($row['kelas']) ?></td>
                    <td><?= htmlspecialchars($row['judul_tugas']) ?></td>
                    <td><?= date('d-m-Y H:i', strtotime($row['created_at'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
