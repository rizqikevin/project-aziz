<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id_tugas_siswa'] ?? null;
  $file = $_POST['file_tugas'] ?? null;

  if ($id && $file) {
    $host = '127.0.0.1'; $db = 'ajis'; $user = 'root'; $pass = ''; $charset = 'utf8mb4';
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC];
    try {
      $pdo = new PDO($dsn, $user, $pass, $options);

      // Hapus record dari database
      $stmt = $pdo->prepare("DELETE FROM tugas_siswa WHERE id_tugas_siswa = ?");
      $stmt->execute([$id]);

      // Hapus file dari server
      $file_path = "../../uploads/tugas_siswa/" . basename($file);
      if (file_exists($file_path)) {
        unlink($file_path);
      }

      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit;
    } catch (PDOException $e) {
      echo "Gagal menghapus: " . $e->getMessage();
    }
  } else {
    echo "Data tidak lengkap.";
  }
} else {
  echo "Metode tidak diperbolehkan.";
}
