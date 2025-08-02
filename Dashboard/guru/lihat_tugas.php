<?php
include '../../database/db.php';
session_start();

// Validasi akses
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'guru') {
    exit('Akses ditolak.');
}

// Ambil ID tugas
if (!isset($_GET['id'])) {
    exit('ID tugas tidak ditemukan.');
}

$id = (int) $_GET['id'];
$stmt = $pdo->prepare("SELECT file_tugas FROM tugas_siswa WHERE id_tugas_siswa = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    exit('Data tugas tidak ditemukan.');
}

$file = basename($data['file_tugas']);
$path = "../../uploads/tugas_siswa/" . $file;

if (!file_exists($path)) {
    exit('File tidak tersedia.');
}

// Tentukan tipe file
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$contentType = finfo_file($finfo, $path);
finfo_close($finfo);

// Header untuk tampil langsung di browser
header('Content-Type: ' . $contentType);
header('Content-Disposition: inline; filename="' . $file . '"');
header('Content-Length: ' . filesize($path));

// Tampilkan file
readfile($path);
exit;
