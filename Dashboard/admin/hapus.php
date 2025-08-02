<?php
require '../../database/db.php';

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['nama']) && isset($_GET['kelas'])) {
    $nama = trim($_GET['nama']);
    $kelas = trim($_GET['kelas']);

    // Cek apakah data guru tersebut ada
    $cekQuery = "SELECT * FROM guru WHERE nama = :nama AND kelas = :kelas LIMIT 1";
    $cekStmt = $pdo->prepare($cekQuery);
    $cekStmt->execute([':nama' => $nama, ':kelas' => $kelas]);
    $guru = $cekStmt->fetch();

    if ($guru) {
        // Lanjut hapus
        $hapusQuery = "DELETE FROM guru WHERE nama = :nama AND kelas = :kelas";
        $hapusStmt = $pdo->prepare($hapusQuery);
        $hapusStmt->bindParam(':nama', $nama);
        $hapusStmt->bindParam(':kelas', $kelas);

        if ($hapusStmt->execute()) {
            echo "<script>alert('✅ Guru berhasil dihapus!'); window.location.href='data_guru.php';</script>";
        } else {
            echo "<script>alert('❌ Gagal menghapus guru.'); window.location.href='data_guru.php';</script>";
        }
    } else {
        echo "<script>alert('⚠️ Guru tidak ditemukan.'); window.location.href='data_guru.php';</script>";
    }
} else {
    echo "<script>alert('🚫 Permintaan tidak valid!'); window.location.href='data_guru.php';</script>";
}
?>
