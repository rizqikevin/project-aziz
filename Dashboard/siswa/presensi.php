<?php include '../inc/db.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $siswa = $_POST['siswa'];
    $jadwal_id = $_POST['jadwal_id'];

    $stmt = $pdo->prepare("INSERT INTO presensi (siswa, jadwal_id) VALUES (?, ?)");
    $stmt->execute([$siswa, $jadwal_id]);

    echo "Presensi berhasil. <a href='lihat_jadwal.php'>Kembali</a>";
}
?>
