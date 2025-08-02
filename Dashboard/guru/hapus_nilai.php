<?php
require '../../database/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan ID
    $query = "DELETE FROM nilai_siswa WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>alert('Nilai berhasil dihapus!'); window.location.href='input_nilai.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus nilai!'); window.location.href='input_nilai.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='input_nilai.php';</script>";
}
?>
