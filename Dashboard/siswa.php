<?php 
session_start();

if ($_SESSION['role'] != 'siswa') {
    header("Location: login.php");
    exit;
}

$nama_lengkap = $_SESSION['nama_lengkap'] ?? 'Nama tidak ditemukan';
$user_id = $_SESSION['user_id'] ?? 'ID tidak ditemukan';

if (!isset($_SESSION['kelas'])) {
    error_log("Kelas belum tersedia di sesi untuk user ID: $user_id");
 
} else {
    $kelas = $_SESSION['kelas'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="../assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../assets/img/gambar1.jpg'); /* Ganti dengan path gambar latar belakang */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Arial', sans-serif;
            color: white;
        }
        .sidebar {
            height: 100%;
            background-color: #343a40;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            padding-top: 20px;
            background: rgba(0, 0, 0, 0.7); /* Transparan pada sidebar */
        }
        .sidebar a {
            color: #ddd;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            border-bottom: 1px solid #444;
        }
        .sidebar a:hover {
            background-color:rgb(62, 88, 116);
            color: white;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .navbar-custom {
            background-color:rgb(51, 84, 119);
        }
        .card {
            background-color: rgba(255, 255, 255, 0.8); /* Transparan pada card */
        }
        .card-body {
            padding: 30px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center text-white"><?= htmlspecialchars($nama_lengkap) ?></h4>
        <hr class="text-white">
        <a href="siswa/daftar_tugas.php">Daftar tugas</a>
        <a href="siswa/lihat_nilai.php">nilai</a>
        <a href="guru/view_quiz.php">quiz</a>
        <a href="_includes/index.php">Study at home</a>
        <a href="../login.php" class="btn btn-danger m-2">Logout</a>
    </div>

    <!-- Main content area -->
    <div class="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Dashboard</a>
            </div>
        </nav>

       <!-- Dashboard Content -->
        <div class="container mt-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Selamat datang, <?= htmlspecialchars($nama_lengkap) ?>!</h3>
                    <p class="card-text">ID Pengguna: <?= htmlspecialchars($user_id) ?></p>
                    
                    <hr>
                </div>
            </div>
        </div>
        </div>


    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
