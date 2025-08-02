<?php
session_start();
require '../../database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap = $_POST['nama_lengkap'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $telepon = $_POST['telepon'] ?? '';
    $role = $_POST['role'] ?? '';
    $kelas = $_POST['kelas'] ?? '';
    $mata_pelajaran = $_POST['mata_pelajaran'] ?? '';

    // Cek email sudah terdaftar
    $query = "SELECT COUNT(*) FROM users WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);
    $exists = $stmt->fetchColumn();

    if ($exists > 0) {
        $_SESSION['error'] = "Email sudah terdaftar.";
        header('Location: tambah_user.php');
        exit();
    } else {
        // Proses simpan sesuai role
        if ($role == 'siswa') {
            $query = "INSERT INTO users (nama_lengkap, email, password, telepon, role, kelas, created_at) 
                      VALUES (?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$nama_lengkap, $email, $password, $telepon, $role, $kelas]);
            header('Location: daftar_siswa.php');
            exit();
        } elseif ($role == 'guru') {
            $query = "INSERT INTO users (nama_lengkap, email, password, telepon, role, mata_pelajaran, created_at) 
                      VALUES (?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$nama_lengkap, $email, $password, $telepon, $role, $mata_pelajaran]);
            header('Location: daftar_guru.php');
            exit();
        } elseif ($role == 'admin') {
            $query = "INSERT INTO users (nama_lengkap, email, password, telepon, role, created_at) 
                      VALUES (?, ?, ?, ?, ?, NOW())";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$nama_lengkap, $email, $password, $telepon, $role]);
            header('Location: ../admin.php');
            exit();
        } else {
            $_SESSION['error'] = "Role tidak valid.";
            header('Location: tambah_user.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengguna Baru</title>
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">➕ Tambah Pengguna Baru</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password (Teks Biasa)</label>
            <input type="text" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon">
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="guru">Guru</option>
                <option value="siswa">Siswa</option>
            </select>
        </div>

        <div class="mb-3" id="kelas-field" style="display:none;">
            <label for="kelas" class="form-label">Kelas (untuk Siswa)</label>
            <input type="text" class="form-control" id="kelas" name="kelas">
        </div>

        <div class="mb-3" id="mata-pelajaran-field" style="display:none;">
            <label for="mata_pelajaran" class="form-label">Mata Pelajaran (untuk Guru)</label>
            <input type="text" class="form-control" id="mata_pelajaran" name="mata_pelajaran">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="../admin.php" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>

<script>
    const roleSelect = document.getElementById('role');
    const kelasField = document.getElementById('kelas-field');
    const mataPelajaranField = document.getElementById('mata-pelajaran-field');

    roleSelect.addEventListener('change', () => {
        const role = roleSelect.value;

        // Kelas hanya untuk siswa
        kelasField.style.display = role === 'siswa' ? 'block' : 'none';

        // Mata pelajaran hanya untuk guru
        mataPelajaranField.style.display = role === 'guru' ? 'block' : 'none';
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
