<?php
require '../../database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_mapel = $_POST['nama_mapel'];
    $deskripsi = $_POST['deskripsi'];

    $stmt = $pdo->prepare("INSERT INTO mata_pelajaran (nama_mapel, deskripsi) VALUES (?, ?)");
    $stmt->execute([$nama_mapel, $deskripsi]);

    echo "<script>alert('Mata pelajaran berhasil ditambahkan'); window.location='tampil_mapel.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mata Pelajaran</title>
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link rel="stylesheet" href="../../assets/css/styile.css">
</head>
<body>
<div class="container">
    <h2>➕ Tambah Mata Pelajaran</h2>

    <form method="POST" class="form-box">
        <label for="nama_mapel">Nama Mata Pelajaran</label>
        <input type="text" id="nama_mapel" name="nama_mapel" required>

        <button type="submit">Simpan</button>
    </form>

    <a href="tampil_mapel.php" class="back-link">← Kembali ke Daftar Mapel</a>
</div>
</body>
</html>
