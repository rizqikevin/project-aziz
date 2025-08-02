<?php
require '../../database/db.php';

$stmt = $pdo->query("SELECT * FROM mata_pelajaran ORDER BY nama_mapel ASC"); // Bisa ganti 'created_at' jika tidak ada
$mapel = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mata Pelajaran</title>
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link rel="stylesheet" href="../../assets/css/styile.css">
</head>
<body>
<div class="container">
    <h2>📚 Daftar Mata Pelajaran</h2>
    <a href="tambah_mapel.php" class="btn">+ Tambah Mata Pelajaran</a>
    <a href="../admin.php" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Dibuat</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($mapel as $m): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($m['nama_mapel']) ?></td>
                <td><?= isset($m['created_at']) ? $m['created_at'] : '-' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
