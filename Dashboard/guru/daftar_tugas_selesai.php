<?php
// koneksi database
$host = '127.0.0.1';
$db = 'ajis';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Ambil daftar kelas unik dari tabel tugas_guru
$kelasList = $pdo->query("SELECT DISTINCT kelas FROM tugas_guru ORDER BY kelas")->fetchAll();

// Ambil daftar mata pelajaran unik
$mapelList = $pdo->query("SELECT DISTINCT mata_pelajaran FROM tugas_guru ORDER BY mata_pelajaran")->fetchAll();

// Tangkap filter dari URL (GET)
$selectedKelas = $_GET['kelas'] ?? '';
$selectedMapel = $_GET['mapel'] ?? '';

// Query utama mengambil data tugas siswa bergabung dengan tugas guru
$sql = "SELECT 
    ts.id_tugas_siswa,
    ts.nama_lengkap AS siswa,
    ts.file_tugas,
    ts.created_at AS tanggal_kirim,
    tg.kelas,
    tg.mata_pelajaran,
    tg.judul_tugas
FROM tugas_siswa ts
JOIN tugas_guru tg ON ts.id_tugas = tg.id_tugas
WHERE ts.status = 'Terkirim'";

$params = [];
if ($selectedKelas) {
    $sql .= " AND tg.kelas = ?";
    $params[] = $selectedKelas;
}
if ($selectedMapel) {
    $sql .= " AND tg.mata_pelajaran = ?";
    $params[] = $selectedMapel;
}

$sql .= " ORDER BY tg.kelas, tg.mata_pelajaran, ts.created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$data = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Daftar Tugas Siswa Terkirim</title>
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background: #f4f7fb;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 1rem;
        }
        .btn-back {
            display: inline-block;
            margin-bottom: 1.5rem;
            padding: 10px 20px;
            background: #667eea;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
        }
        .btn-back:hover {
            background: #1a33d9ff;
        }
        form {
            margin-bottom: 1.5rem;
        }
        select, button[type="submit"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            background: #fff;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background: #eee;
        }
        td a {
            color: #667eea;
            text-decoration: none;
        }
        td a:hover {
            text-decoration: underline;
        }
        button {
            background: none;
            border: none;
            color: red;
            cursor: pointer;
        }
        button:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>📋 Daftar Tugas Siswa Terkirim</h1>
<a href="../guru.php" class="btn-back">&larr; Kembali ke Dashboard</a>

<!-- Form Filter -->
<form method="GET" action="">
    <label for="kelas">Kelas:</label>
    <select name="kelas" id="kelas">
        <option value="">-- Semua Kelas --</option>
        <?php foreach ($kelasList as $k): ?>
            <option value="<?= htmlspecialchars($k['kelas']) ?>" <?= $selectedKelas == $k['kelas'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($k['kelas']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="mapel">Mata Pelajaran:</label>
    <select name="mapel" id="mapel">
        <option value="">-- Semua Mapel --</option>
        <?php foreach ($mapelList as $m): ?>
            <option value="<?= htmlspecialchars($m['mata_pelajaran']) ?>" <?= $selectedMapel == $m['mata_pelajaran'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($m['mata_pelajaran']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">🔍 Tampilkan</button>
</form>

<?php if (empty($data)): ?>
    <p>Tidak ada data tugas ditemukan.</p>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>
            <th>Nama Siswa</th>
            <th>Judul Tugas</th>
            <th>Tanggal Kirim</th>
            <th>File</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $i => $ts): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($ts['kelas']) ?></td>
                <td><?= htmlspecialchars($ts['mata_pelajaran']) ?></td>
                <td><?= htmlspecialchars($ts['siswa']) ?></td>
                <td><?= htmlspecialchars($ts['judul_tugas']) ?></td>
                <td><?= htmlspecialchars($ts['tanggal_kirim']) ?></td>
                <td>
                    <a href="../../uploads/tugas_siswa/<?= htmlspecialchars($ts['file_tugas']) ?>" target="_blank">📎 Download</a>
                </td>
                <td>
                    <form method="POST" action="hapus_file.php" onsubmit="return confirm('Yakin ingin menghapus file ini?')">
                        <input type="hidden" name="id_tugas_siswa" value="<?= $ts['id_tugas_siswa'] ?>">
                        <input type="hidden" name="file_tugas" value="<?= htmlspecialchars($ts['file_tugas']) ?>">
                        <button type="submit">🗑 Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>
