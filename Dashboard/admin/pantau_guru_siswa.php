<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Koneksi ke database
require_once '../../database/db.php';

// Ambil data guru
try {
    $queryGuru = "SELECT id_guru, nama_lengkap, email, mata_pelajaran FROM guru ORDER BY nama_lengkap";
    $resultGuru = $conn->query($queryGuru)->fetchAll(PDO::FETCH_ASSOC);
    
    $querySiswa = "SELECT d_siswa, id_user,	kelas,	jurusan	alamat,	created_at FROM siswa ORDER BY id_user";
    $resultSiswa = $conn->query($querySiswa)->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantau Guru dan Murid</title>
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Pantau Guru dan Murid</h1>

    <h2 class="mt-4">Data Guru</h2>
    <?php if (!empty($resultGuru)) : ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Mata Pelajaran</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultGuru as $index => $guru) : ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td><?= htmlspecialchars($guru['nama_lengkap']); ?></td>
                        <td><?= htmlspecialchars($guru['email']); ?></td>
                        <td><?= htmlspecialchars($guru['mata_pelajaran']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="alert alert-warning">Tidak ada data guru yang tersedia.</p>
    <?php endif; ?>

    <h2 class="mt-5">Data Murid</h2>
    <?php if (!empty($resultSiswa)) : ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Kelas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultSiswa as $index => $siswa) : ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td><?= htmlspecialchars($siswa['nama_lengkap']); ?></td>
                        <td><?= htmlspecialchars($siswa['email']); ?></td>
                        <td><?= htmlspecialchars($siswa['kelas']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="alert alert-warning">Tidak ada data siswa yang tersedia.</p>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
