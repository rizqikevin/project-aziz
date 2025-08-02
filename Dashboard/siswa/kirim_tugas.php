<?php
require_once '../../database/db.php'; // Pastikan koneksi database sudah benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_tugas = $_POST['id_tugas'];
    $nama_siswa = $_POST['nama_siswa'];
    $status = 'Terkirim';
    $upload_dir = '../../uploads/tugas_siswa/';
    
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    if (!empty($_FILES['file_tugas']['name'])) {
        $file_name = time() . '_' . basename($_FILES['file_tugas']['name']);
        $file_path = $upload_dir . $file_name;
        
        if (move_uploaded_file($_FILES['file_tugas']['tmp_name'], $file_path)) {
            $query = "INSERT INTO tugas_siswa (nama_lengkap, id_tugas, file_tugas, status, created_at) VALUES (?, ?, ?, ?, NOW())";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$nama_siswa, $id_tugas, $file_name, $status]);
            echo "<script>alert('Tugas berhasil dikirim!'); window.location.href='daftar_tugas.php';</script>";
        } else {
            echo "<script>alert('Gagal mengunggah file.');</script>";
        }
    } else {
        echo "<script>alert('Pilih file untuk dikirim.');</script>";
    }
}

$id_tugas = $_GET['id_tugas'] ?? '';
$tugas = $pdo->prepare("SELECT judul_tugas FROM tugas_guru WHERE id_tugas = ?");
$tugas->execute([$id_tugas]);
$tugas_data = $tugas->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Tugas</title>
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Kirim Tugas</h2>
        <form action="kirim_tugas.php" method="POST" enctype="multipart/form-data" class="border p-4 rounded">
            <input type="hidden" name="id_tugas" value="<?php echo htmlspecialchars($id_tugas); ?>">
            <div class="mb-3">
                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                <input type="text" class="form-control" name="nama_siswa" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Tugas</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($tugas_data['judul_tugas'] ?? ''); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="mata_pelajaran" class="form-label">mata pelajaran</label>
                <input type="text" class="form-control" name="mata_pelajaran" required>
            </div>
            <div class="mb-3">
                <label for="file_tugas" class="form-label">Pilih File Tugas</label>
                <input type="file" class="form-control" name="file_tugas" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status Tugas</label>
                <input type="text" class="form-control" value="Terkirim" readonly>
            </div>
                 <!-- Tombol-tombol responsif -->
            <div class="d-flex flex-column flex-md-row gap-2 mt-3">
                <!-- Tombol Submit -->
                <form action="..." method="POST">
                    <button type="submit" class="btn btn-primary w-50 w-md-auto">Kirim</button>
                </form>

                <!-- Tombol Kembali -->
                <a href="daftar_tugas.php" class="btn btn-secondary w-50 w-md-auto">Kembali</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
