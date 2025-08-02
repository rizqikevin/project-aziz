<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

require '../../database/db.php';

// Ambil data tugas siswa yang terkirim
$sql = "SELECT ts.id_tugas_siswa, ts.nama_lengkap AS siswa, ts.file_tugas, ts.created_at AS tanggal_kirim,
               tg.kelas, tg.mata_pelajaran, tg.judul_tugas
        FROM tugas_siswa ts
        JOIN tugas_guru tg ON ts.id_tugas = tg.id_tugas
        WHERE ts.status = 'Terkirim'
        ORDER BY ts.created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tugasList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pantau Tugas Siswa</title>
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Pantau Tugas Siswa</h1>
    <a href="../admin.php" class="btn btn-secondary mb-3">← Kembali ke Dashboard</a>
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Mapel</th>
                <th>Judul Tugas</th>
                <th>Tanggal Kirim</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($tugasList): ?>
                <?php $no = 1; foreach ($tugasList as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['siswa']) ?></td>
                        <td><?= htmlspecialchars($row['kelas']) ?></td>
                        <td><?= htmlspecialchars($row['mata_pelajaran']) ?></td>
                        <td><?= htmlspecialchars($row['judul_tugas']) ?></td>
                        <td><?= htmlspecialchars($row['tanggal_kirim']) ?></td>
                        <td>
                            <a class="btn btn-primary btn-sm"
                               href="../../uploads/tugas_siswa/<?= rawurlencode($row['file_tugas']) ?>"
                               target="_blank">📎 Unduh</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" class="text-center">Belum ada tugas terkirim.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
