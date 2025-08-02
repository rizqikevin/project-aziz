<?php
include '../../database/db.php'; // Koneksi database

// Proses tambah siswa
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];

    $stmt = $pdo->prepare("INSERT INTO siswa (nama_lengkap, kelas) VALUES (?, ?)");
    if ($stmt->execute([$nama, $kelas])) {
        echo "<script>alert('Data siswa berhasil ditambahkan!'); window.location.href='input_siswa.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan siswa.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Input Data Siswa</title>
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { padding: 20px; }
        .container { max-width: 600px; }
    </style>
</head>
<body class="container">
    <h2 class="text-center mb-4">Input Data Siswa</h2>

    <div class="card p-4">
        <form method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Siswa</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" name="kelas" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Simpan</button>
        </form>
        <a href="../admin.php" class="btn btn-secondary mt-3 w-100">Kembali ke Dashboard</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
