<?php
include 'database/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $password_raw = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];
    $telepon = $_POST['telepon'] ?? null;
    $kelas = ($role === 'siswa') ? ($_POST['kelas'] === 'custom' ? $_POST['kelas_custom'] : $_POST['kelas']) : null;
    $mata_pelajaran = ($role === 'guru') ? $_POST['mata_pelajaran'] ?? null : null;

    // Validasi password cocok
    if ($password_raw !== $confirm_password) {
        echo "<script>alert('Password dan konfirmasi tidak cocok!'); window.history.back();</script>";
        exit;
    }

    // Validasi email tidak boleh sama
    $cek = $pdo->prepare("SELECT id_user FROM users WHERE email = :email");
    $cek->execute(['email' => $email]);
    if ($cek->fetch()) {
        echo "<script>alert('Email sudah terdaftar. Gunakan email lain.'); window.history.back();</script>";
        exit;
    }

    // Simpan password terenkripsi
    $password = password_hash($password_raw, PASSWORD_BCRYPT);

    try {
        $sql = "INSERT INTO users (nama_lengkap, email, password, telepon, role, kelas, mata_pelajaran, created_at) 
                VALUES (:nama_lengkap, :email, :password, :telepon, :role, :kelas, :mata_pelajaran, NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nama_lengkap', $nama_lengkap);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':telepon', $telepon);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':kelas', $kelas);
        $stmt->bindParam(':mata_pelajaran', $mata_pelajaran);

        if ($stmt->execute()) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
        } else {
            throw new Exception("Error: " . $stmt->errorInfo()[2]);
        }
    } catch (Exception $e) {
        echo "<script>alert('Registrasi gagal: {$e->getMessage()}');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - E-Learning</title>
    <link href="assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/warna.css" rel="stylesheet">
    <link rel="icon" href="assets/img/logo new.png">
    <img class="img-fluid position-absolute w-100 h-100" src="assets/img/login.jpg" alt="" style="object-fit: cover;">
    <link href="assets/css/warna.css" rel="stylesheet">
</head>
<body>
    <div class="card p-4">
        <h3 class="text-center mb-3">Form Registrasi</h3>
        <form method="POST" action="" id="registerForm">
            <div class="mb-2">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" required>
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="mb-2">
                <label for="Konfirmasi Password" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
            </div>
            <div class="mb-2">
                <label for="Role" class="form-label">Role</label>
                <select class="form-select" name="role" id="role" onchange="toggleFields()" required>
                    <option value="">Pilih Role</option>
                    <option value="admin">Admin</option>
                    <option value="guru">Guru</option>
                    <option value="siswa">Siswa</option>
                </select>
            </div>
            <div class="mb-2" id="telepon-container" style="display:none;">
                <label for="Telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control" name="telepon">
            </div>
            <div class="mb-2" id="kelas-container" style="display:none;">
                <label for="Kelas" class="form-label">Kelas</label>
                <select class="form-select" name="kelas" id="kelas" onchange="toggleCustomInput()">
                    <option value="#">Pilih Kelas</option>
                        <!-- kelas 10 -->
                        <option value="10-IPS-1">10-IPS-1</option>
                        <option value="10-IPS-2">10-IPS-2</option>
                        <option value="10-IPS-3">10-IPS-3</option>
                        <option value="10-IPA-1">10-IPA-1</option>
                        <option value="10-IPA-2">10-IPA-2</option>
                        <option value="10-IPA-3">10-IPA-3</option>
                        <!-- kelas 11 -->
                        <option value="11-IPS-1">11-IPS-1</option>
                        <option value="11-IPS-2">11-IPS-2</option>
                        <option value="11-IPS-3">11-IPS-3</option>
                        <option value="11-IPA-1">11-IPA-1</option>
                        <option value="11-IPA-2">11-IPA-2</option>
                        <option value="11-IPA-3">11-IPA-3</option>
                        <!-- kelas 12 -->
                        <option value="12-IPS-1">12-IPS-1</option>
                        <option value="12-IPS-2">12-IPS-2</option>
                        <option value="12-IPS-3">12-IPS-3</option>
                        <option value="12-IPA-1">12-IPA-1</option>
                        <option value="12-IPA-2">12-IPA-2</option>
                        <option value="12-IPA-3">12-IPA-3</option>
                        <option value="custom">Custom</option>
                </select>
                <input type="text" class="form-control mt-2" name="kelas_custom" id="kelas_custom" placeholder="Masukkan kelas" style="display:none;">
            </div>
            <div class="mb-2" id="mata-pelajaran-container" style="display:none;">
                <label for="Mata pelajaran" class="form-label">Mata Pelajaran</label>
                <select class="form-select" name="mata_pelajaran">
                    <option value="">Pilih Mata Pelajaran</option>
                        <option value="Matematika">Matematika</option>
                        <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                        <option value="bahasa inggris">bahasa inggris</option>
                        <option value="bahasa sunda">bahasa sunda</option>
                        <option value="Fisika">Fisika</option>
                        <option value="kimia">kimia</option>
                        <option value="PJOK">PJOK</option>
                        <option value="agama">agama</option>
                        <option value="seni">seni budaya</option>
                        <option value="biologi">biologi</option>
                        <option value="ekonomi">ekonomi</option>
                        <option value="sejarah">sejarah</option>
                        <option value="pertanian">pertanian</option>
                        <option value="perikanan">perikanan</option>
                        <option value="TIK">TIK</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
            <p class="text-center mt-2">Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </form>
    </div>

    <!-- SCRIPT -->
    <script>
        function toggleFields() {
            const role = document.getElementById('role').value;
            document.getElementById('telepon-container').style.display = role === 'guru' || role === 'siswa' ? 'block' : 'none';
            document.getElementById('kelas-container').style.display = role === 'siswa' ? 'block' : 'none';
            document.getElementById('mata-pelajaran-container').style.display = role === 'guru' ? 'block' : 'none';
        }

        function toggleCustomInput() {
            const kelas = document.getElementById('kelas').value;
            document.getElementById('kelas_custom').style.display = kelas === 'custom' ? 'block' : 'none';
        }

        // Validasi client-side untuk konfirmasi password
        document.getElementById("registerForm").addEventListener("submit", function(e) {
            const pass = document.getElementById("password").value;
            const confirm = document.getElementById("confirm_password").value;
            if (pass !== confirm) {
                alert("Password dan konfirmasi tidak cocok!");
                e.preventDefault();
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
