<?php
require '../../database/db.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = $_POST['nama_lengkap'] ?? '';
    $email = $_POST['email'] ?? '';
    $telepon = $_POST['telepon'] ?? '';
    $kelas = $_POST['kelas'] ?? '';
    $nama = $_POST['nama'] ?? '';
    
    $sql = "INSERT INTO siswa (nama_lengkap, email, telepon, kelas, nama) VALUES (:nama_lengkap, :email, :telepon, :kelas, :nama)";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([
            'nama_lengkap' => $nama_lengkap,
            'email' => $email,
            'telepon' => $telepon,
            'kelas' => $kelas,
            'nama' => $nama
        ]);
        echo "<div class='alert alert-success'>Data berhasil ditambahkan!</div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Gagal menambahkan data: " . $e->getMessage() . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Siswa</title>
    <!-- Favicon -->
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Input Data Siswa</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="telepon" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <input type="text" name="kelas" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="admin.php" class="btn btn-secondary">Kembali ke Admin</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
