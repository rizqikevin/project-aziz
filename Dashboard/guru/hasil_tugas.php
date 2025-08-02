<?php
require_once '../../database/db.php';  // Pastikan path ini benar

$success_message = '';
$error_message = '';

// Ambil daftar tugas yang dikirim dengan status 'terkirim'
$query = "SELECT * FROM tugas_siswa WHERE status_pengiriman = 'terkirim' ORDER BY tanggal_pengiriman DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$tugas_siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Proses pengisian nilai
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nilai = $_POST['nilai'] ?? '';
    $id_tugas = $_POST['id_tugas'] ?? '';

    if (!empty($nilai) && is_numeric($nilai) && $nilai >= 0 && $nilai <= 100 && !empty($id_tugas)) {
        try {
            $update_query = "UPDATE tugas_siswa SET nilai = :nilai WHERE id = :id_tugas";
            $stmt = $pdo->prepare($update_query);
            $stmt->bindParam(':nilai', $nilai);
            $stmt->bindParam(':id_tugas', $id_tugas);
            
            if ($stmt->execute()) {
                $success_message = "Nilai berhasil disimpan!";
            } else {
                $error_message = "Gagal menyimpan nilai.";
            }
        } catch (PDOException $e) {
            $error_message = "Terjadi kesalahan: " . $e->getMessage();
        }
    } else {
        $error_message = "Harap masukkan nilai yang valid (antara 0 dan 100).";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek dan Berikan Nilai Tugas</title>
    <!-- Favicon -->
    <link href="../../assets/img/sma12logo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Daftar Tugas yang Dikirimkan Siswa</h2>

        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <?php if (count($tugas_siswa) > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Tugas</th>
                        <th>Tanggal Pengiriman</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tugas_siswa as $index => $tugas): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($tugas['nama_siswa']); ?></td>
                            <td><?php echo htmlspecialchars($tugas['kelas']); ?></td>
                            <td><?php echo htmlspecialchars($tugas['mata_pelajaran']); ?></td>
                            <td><?php echo htmlspecialchars($tugas['tugas']); ?></td>
                            <td><?php echo $tugas['tanggal_pengiriman']; ?></td>
                            <td>
                                <?php if ($tugas['nilai'] !== null): ?>
                                    <span class="badge bg-success"><?php echo $tugas['nilai']; ?></span>
                                <?php else: ?>
                                    <form action="cek_nilai_tugas.php" method="POST" class="d-inline">
                                        <input type="hidden" name="id_tugas" value="<?php echo $tugas['id']; ?>">
                                        <input type="number" name="nilai" min="0" max="100" required class="form-control w-25 d-inline" placeholder="Nilai">
                                        <button type="submit" class="btn btn-primary btn-sm ml-2">
                                            <i class="fas fa-save"></i> Simpan
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                            <td></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning">Belum ada tugas yang dikirimkan.</div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
