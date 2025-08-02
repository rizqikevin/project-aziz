<?php
require_once '../../database/db.php'; // Pastikan koneksi database sudah benar

// Cek jika ada permintaan untuk menghapus tugas
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    try {
        // Hapus tugas dari tabel tugas_siswa
        $delete_query = "DELETE FROM tugas_siswa WHERE id_tugas = :delete_id";
        $delete_stmt = $pdo->prepare($delete_query);
        $delete_stmt->bindParam(':delete_id', $delete_id);
        $delete_stmt->execute();
    } catch (Exception $e) {
        die("Error deleting data: " . $e->getMessage());
    }
}

// Inisialisasi variabel untuk filter
$kelas_target = isset($_POST['kelas']) ? $_POST['kelas'] : '';
$mata_pelajaran_target = isset($_POST['mata_pelajaran']) ? $_POST['mata_pelajaran'] : '';

try {
    // Ambil daftar tugas yang belum dikirim oleh siswa berdasarkan filter
    $query = "
        SELECT t.id_tugas, t.mata_pelajaran, t.kelas, t.judul_tugas, t.deskripsi, 
               t.deadline, t.file_tugas, t.created_at, t.status, 
               CASE 
                   WHEN ts.id_tugas IS NOT NULL THEN 'Sudah Dikirim' 
                   ELSE 'Belum Dikirim' 
               END AS status_tugas
        FROM tugas_guru t
        LEFT JOIN tugas_siswa ts ON t.id_tugas = ts.id_tugas
        WHERE ts.id_tugas IS NULL
    ";

    // Tambahkan kondisi filter jika ada
    if ($kelas_target) {
        $query .= " AND t.kelas = :kelas_target";
    }
    if ($mata_pelajaran_target) {
        $query .= " AND t.mata_pelajaran = :mata_pelajaran_target";
    }

    $query .= " ORDER BY t.created_at DESC";

    $stmt = $pdo->prepare($query);
    
    // Bind parameter jika ada filter
    if ($kelas_target) {
        $stmt->bindParam(':kelas_target', $kelas_target);
    }
    if ($mata_pelajaran_target) {
        $stmt->bindParam(':mata_pelajaran_target', $mata_pelajaran_target);
    }

    $stmt->execute();
    $tugas_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error fetching data: " . $e->getMessage());
}

// Ambil daftar kelas dan mata pelajaran untuk dropdown
$kelas_options = ['10-IPA-1', '10-IPA-2','10-IPA-3', '10-IPS-1','10-IPS-2', '10-IPS-3', '11-IPA-1', '11-IPA-2','11-IPA-3', '11-IPS-1', '11-IPS-2', '11-IPS-3', '12-IPA-1', '12-IPA-2','12-IPA-3', '12-IPS-1', '12-IPS-2', '12-IPS-3']; // Ganti dengan data dari database jika perlu
$mata_pelajaran_options = ['Matematika', 'bahasa indonesia','bahasa inggris','bahasa sunda','fisika','Kimia', 'ekonomi','sejarah','sosiologi','biologi','agama','pertanian','perikanan']; // Ganti dengan data dari database jika perlu
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar File Tugas</title>
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Daftar File Tugas Guru</h2>

        <!-- Form Filter -->
        <form method="POST" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <select name="kelas" class="form-select">
                        <option value="">Pilih Kelas</option>
                        <?php foreach ($kelas_options as $kelas): ?>
                            <option value="<?php echo htmlspecialchars($kelas); ?>" <?php echo ($kelas == $kelas_target) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($kelas); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="mata_pelajaran" class="form-select">
                        <option value="">Pilih Mata Pelajaran</option>
                        <?php foreach ($mata_pelajaran_options as $mata_pelajaran): ?>
                            <option value="<?php echo htmlspecialchars($mata_pelajaran); ?>" <?php echo ($mata_pelajaran == $mata_pelajaran_target) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($mata_pelajaran); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <?php if (count($tugas_list) > 0): ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Tugas</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th>Judul Tugas</th>
                        <th>Deskripsi</th>
                        <th>Deadline</th>
                        <th>File Tugas</th>
                        <th>Status</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tugas_list as $index => $tugas): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($tugas['id_tugas']); ?></td>
                            <td><?php echo htmlspecialchars($tugas['mata_pelajaran']); ?></td>
                            <td><?php echo htmlspecialchars($tugas['kelas']); ?></td>
                            <td><?php echo htmlspecialchars($tugas['judul_tugas']); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($tugas['deskripsi'])); ?></td>
                            <td><?php echo htmlspecialchars($tugas['deadline']); ?></td>
                            <td>
                                <?php if (!empty($tugas['file_tugas'])): ?>
                                    <a href="../../uploads/tugas/<?php echo htmlspecialchars($tugas['file_tugas']); ?>" 
                                       target="_blank" 
                                       class="btn btn-primary btn-sm">
                                        Download File
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">No file uploaded</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge bg-<?php echo ($tugas['status_tugas'] == 'Sudah Dikirim') ? 'danger' : 'success'; ?>">
                                    <?php echo htmlspecialchars($tugas['status_tugas']); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($tugas['created_at']); ?></td>
                            <td>
                                <a href="kirim_tugas.php?id_tugas=<?php echo $tugas['id_tugas']; ?>" class="btn btn-success btn-sm">Kirim Tugas</a>
                                <a href="?delete_id=<?php echo $tugas['id_tugas']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning text-center">Belum ada tugas yang tersedia untuk dikirim.</div>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="../siswa.php" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
