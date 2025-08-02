<?php
require '../../database/db.php';

// Ambil kelas unik untuk dropdown filter
$kelas_query = "SELECT DISTINCT kelas FROM nilai_siswa";
$kelas_data = $pdo->query($kelas_query)->fetchAll(PDO::FETCH_ASSOC);

// Ambil data nilai berdasarkan filter
$query = "SELECT * FROM nilai_siswa WHERE 1=1";
$params = [];

if (!empty($_GET['nama'])) {
    $query .= " AND nama LIKE :nama";
    $params[':nama'] = "%" . $_GET['nama'] . "%";
}

if (!empty($_GET['kelas'])) {
    $query .= " AND kelas = :kelas";
    $params[':kelas'] = $_GET['kelas'];
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$nilai_siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Nilai Siswa</title>
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Lihat Nilai Siswa</h2>

        <!-- Tombol Kembali ke Home -->
        <div class="d-flex justify-content-between mb-3">
            <a href="../siswa.php" class="btn btn-secondary">⬅ Kembali ke Home</a>
        </div>

        <!-- Filter Form -->
        <form method="GET" class="row g-3 mb-3">
            <div class="col-md-4">
                <input type="text" name="nama" class="form-control" placeholder="Cari berdasarkan nama..." value="<?= isset($_GET['nama']) ? htmlspecialchars($_GET['nama']) : ''; ?>">
            </div>
            <div class="col-md-4">
                <select name="kelas" class="form-select">
                    <option value="">Pilih Kelas</option>
                    <?php foreach ($kelas_data as $row) : ?>
                        <option value="<?= htmlspecialchars($row['kelas']); ?>" <?= (isset($_GET['kelas']) && $_GET['kelas'] == $row['kelas']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($row['kelas']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Cari</button>
            </div>
        </form>

        <!-- Tabel Nilai -->
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($nilai_siswa as $nilai) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($nilai['nama']); ?></td>
                            <td><?= htmlspecialchars($nilai['kelas']); ?></td>
                            <td><?= htmlspecialchars($nilai['mata_pelajaran']); ?></td>
                            <td><?= $nilai['nilai']; ?></td>
                            <td><?= date('d-m-Y', strtotime($nilai['created_at'])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($nilai_siswa)) : ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data ditemukan.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
