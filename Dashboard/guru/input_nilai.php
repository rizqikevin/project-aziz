<?php
require '../../database/db.php';

// Proses Simpan Nilai
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simpan_nilai'])) {
    $nama = trim($_POST['nama'] ?? '');
    $kelas = trim($_POST['kelas'] ?? '');
    $mapel = trim($_POST['mapel'] ?? '');
    $nilai = isset($_POST['nilai']) ? (int)$_POST['nilai'] : null;

    if ($nama !== '' && $kelas !== '' && $mapel !== '' && $nilai !== null) {
        $query = "INSERT INTO nilai_siswa (nama, kelas, mata_pelajaran, nilai) VALUES (:nama, :kelas, :mapel, :nilai)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':nama' => $nama, ':kelas' => $kelas, ':mapel' => $mapel, ':nilai' => $nilai]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Proses Edit Nilai
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_nilai'])) {
    $id = (int)($_POST['id'] ?? 0);
    $nama = trim($_POST['nama'] ?? '');
    $kelas = trim($_POST['kelas'] ?? '');
    $mapel = trim($_POST['mapel'] ?? '');
    $nilai = isset($_POST['nilai']) ? (int)$_POST['nilai'] : null;

    if ($id > 0 && $nama !== '' && $kelas !== '' && $mapel !== '' && $nilai !== null) {
        $query = "UPDATE nilai_siswa SET nama=:nama, kelas=:kelas, mata_pelajaran=:mapel, nilai=:nilai WHERE id=:id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':nama'=>$nama, ':kelas'=>$kelas, ':mapel'=>$mapel, ':nilai'=>$nilai, ':id'=>$id]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Proses Hapus Nilai
if (isset($_GET['hapus_id'])) {
    $id = (int)$_GET['hapus_id'];
    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM nilai_siswa WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Ambil data kelas unik untuk filter/input dropdown
$kelas_options = ['10-IPA-1', '10-IPA-2','10-IPA-3', '10-IPS-1','10-IPS-2', '10-IPS-3', '11-IPA-1', '11-IPA-2','11-IPA-3', '11-IPS-1', '11-IPS-2', '11-IPS-3', '12-IPA-1', '12-IPA-2','12-IPA-3', '12-IPS-1', '12-IPS-2', '12-IPS-3']; // Ganti dengan data dari database jika perlu


// Ambil data mapel unik untuk filter/input dropdown
    $mata_pelajaran_options = ['Matematika', 'bahasa indonesia','bahasa inggris','bahasa sunda','fisika','Kimia', 'ekonomi','sejarah','sosiologi','biologi','agama','pertanian','perikanan']; // Ganti dengan data dari database jika perlu
 
// Ambil filter GET
$filterKelas = $_GET['kelas'] ?? '';
$filterMapel = $_GET['mapel'] ?? '';

// Query data nilai siswa dengan filter jika ada
$sql = "SELECT * FROM nilai_siswa WHERE 1";
$params = [];

if ($filterKelas !== '') {
    $sql .= " AND kelas = ?";
    $params[] = $filterKelas;
}
if ($filterMapel !== '') {
    $sql .= " AND mata_pelajaran = ?";
    $params[] = $filterMapel;
}

$sql .= " ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$nilai_siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard Nilai Siswa</title>
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Dashboard Nilai Siswa</h2>

    <!-- Filter -->
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="kelas" class="form-label">Filter Kelas</label>
            <select name="kelas" id="kelas" class="form-select">
                <option value="">-- Semua Kelas --</option>
                <?php foreach ($kelas_options as $kelas): ?>
                    <option value="<?= htmlspecialchars($kelas) ?>" <?= $filterKelas === $kelas ? 'selected' : '' ?>>
                        <?= htmlspecialchars($kelas) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="mapel" class="form-label">Filter Mata Pelajaran</label>
            <select name="mapel" id="mapel" class="form-select">
                <option value="">-- Semua Mapel --</option>
                <?php foreach ($mata_pelajaran_options as $mapel): ?>
                    <option value="<?= htmlspecialchars($mapel) ?>" <?= $filterMapel === $mapel ? 'selected' : '' ?>>
                        <?= htmlspecialchars($mapel) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
        </div>
    </form>

    <!-- Tombol Tambah Nilai -->
    <div class="mb-4 text-end">
         <a href="../guru.php" class="btn btn-secondary">← Balik ke Dashboard</a>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahNilai">+ Tambah Nilai</button>
    </div>

    <!-- Tabel Nilai -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($nilai_siswa)): ?>
                <tr><td colspan="6" class="text-center">Tidak ada data nilai.</td></tr>
            <?php else: ?>
                <?php foreach ($nilai_siswa as $i => $nilai): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($nilai['nama']) ?></td>
                        <td><?= htmlspecialchars($nilai['kelas']) ?></td>
                        <td><?= htmlspecialchars($nilai['mata_pelajaran']) ?></td>
                        <td><?= htmlspecialchars($nilai['nilai']) ?></td>
                        <td>
                            <a href="?hapus_id=<?= $nilai['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Nilai -->
<div class="modal fade" id="modalTambahNilai" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" class="modal-content">
            <input type="hidden" name="simpan_nilai" value="true" />
            <div class="modal-header">
                <h5 class="modal-title">Tambah Nilai Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nama Siswa</label>
                    <input type="text" name="nama" class="form-control" required />
                </div>
                <div class="mb-3">
                    <label>Kelas</label>
                    <select name="kelas" class="form-select" required>
                        <option value="">-- Pilih Kelas --</option>
                        <?php foreach ($kelas_options as $kelasOption): ?>
                            <option value="<?= htmlspecialchars($kelasOption) ?>"><?= htmlspecialchars($kelasOption) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Mata Pelajaran</label>
                    <select name="mapel" class="form-select" required>
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        <?php foreach ($mata_pelajaran_options as $mapelOption): ?>
                            <option value="<?= htmlspecialchars($mapelOption) ?>"><?= htmlspecialchars($mapelOption) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Nilai</label>
                    <input type="number" name="nilai" class="form-control" min="0" max="100" required />
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success w-100">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
