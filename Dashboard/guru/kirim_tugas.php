<?php
include '../../database/db.php';
session_start();

// Cek login dan role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'guru') {
    header('Location: ../../login.php');
    exit;
}

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file_tugas'])) {
    $mata_pelajaran = trim($_POST['mata_pelajaran']);
    $kelas = $_POST['kelas'];
    $judul_tugas = trim($_POST['judul_tugas']);
    $deskripsi = trim($_POST['deskripsi']);
    $deadline = $_POST['deadline'];
    $file_tugas = $_FILES['file_tugas'];

    // Validasi kelas yang diizinkan
    $kelas_terdaftar = [
        '10-IPA-1', '10-IPA-2', '10-IPA-3',
        '10-IPS-1', '10-IPS-2', '10-IPS-3',
        '11-IPA-1', '11-IPA-2', '11-IPS-1',
        '12-IPA-1', '12-IPA-2', '12-IPS-1'
    ];

    if (!in_array($kelas, $kelas_terdaftar)) {
        $error = "Kelas yang dipilih tidak valid!";
    } else {
        // Validasi file
        $allowed_types = ['pdf', 'doc', 'docx', 'xlsx', 'pptx', 'zip'];
        $file_ext = strtolower(pathinfo($file_tugas['name'], PATHINFO_EXTENSION));

        if ($file_tugas['error'] === UPLOAD_ERR_OK && in_array($file_ext, $allowed_types)) {
            $upload_dir = '../../uploads/tugas/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $file_name = time() . '_' . basename($file_tugas['name']);
            $upload_path = $upload_dir . $file_name;

            if (move_uploaded_file($file_tugas['tmp_name'], $upload_path)) {
                try {
                    $stmt = $pdo->prepare("INSERT INTO tugas_guru (mata_pelajaran, kelas, judul_tugas, deskripsi, deadline, file_tugas, status)
                                           VALUES (:mata_pelajaran, :kelas, :judul_tugas, :deskripsi, :deadline, :file_tugas, 'pending')");
                    $stmt->execute([
                        ':mata_pelajaran' => $mata_pelajaran,
                        ':kelas' => $kelas,
                        ':judul_tugas' => $judul_tugas,
                        ':deskripsi' => $deskripsi,
                        ':deadline' => $deadline,
                        ':file_tugas' => $file_name
                    ]);

                    $success = "Tugas berhasil dikirim ke kelas <strong>$kelas</strong>.";
                } catch (PDOException $e) {
                    $error = "Terjadi kesalahan saat menyimpan data: " . $e->getMessage();
                }
            } else {
                $error = "Gagal memindahkan file ke server.";
            }
        } else {
            $error = "Tipe file tidak valid atau error saat upload.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kirim Tugas</title>
    <!-- Favicon -->
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eef1f4;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            max-width: 700px;
            width: 100%;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            background: white;
        }
    </style>
</head>
<body>

<div class="card">
    <h3 class="text-center mb-4">Kirim Tugas ke Kelas</h3>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Mata Pelajaran</label>
            <input type="text" name="mata_pelajaran" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kelas Tujuan</label>
            <select name="kelas" class="form-select" required>
                <option value="">Pilih Kelas</option>
                <option value="10-IPA-1">10-IPA-1</option>
                <option value="10-IPA-2">10-IPA-2</option>
                <option value="10-IPA-3">10-IPA-3</option>
                <option value="10-IPS-1">10-IPS-1</option>
                <option value="10-IPS-2">10-IPS-2</option>
                <option value="10-IPS-3">10-IPS-3</option>
                <option value="11-IPA-1">11-IPA-1</option>
                <option value="11-IPA-2">11-IPA-2</option>
                <option value="11-IPS-1">11-IPS-1</option>
                <option value="12-IPA-1">12-IPA-1</option>
                <option value="12-IPA-2">12-IPA-2</option>
                <option value="12-IPS-1">12-IPS-1</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Judul Tugas</label>
            <input type="text" name="judul_tugas" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label>Deadline</label>
            <input type="datetime-local" name="deadline" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Upload File</label>
            <input type="file" name="file_tugas" class="form-control" required>
            <div class="form-text">Format yang diperbolehkan: .pdf, .doc, .docx, .xlsx, .pptx, .zip</div>
        </div>
        <div class="d-flex justify-content-between">
            <a href="../guru.php" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Kirim Tugas</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
