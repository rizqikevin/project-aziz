<?php
// db.php
$pdo = new PDO("mysql:host=localhost;dbname=ajis", "root", "");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tatap Muka Online</title>
  <link href="../../assets/img/sma12logo.png" rel="icon" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      margin: 0;
    }
    .navbar {
      background: #2f80ed;
      color: white;
      padding: 1rem;
      text-align: center;
    }
    .container {
      max-width: 900px;
      margin: 2rem auto;
      background: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }
    h2 {
      color: #333;
    }
    .btn {
      display: inline-block;
      padding: 10px 16px;
      margin-top: 10px;
      text-decoration: none;
      background: #27ae60;
      color: white;
      border-radius: 6px;
    }
    iframe {
      width: 100%;
      height: 500px;
      border: none;
      margin-top: 1rem;
      border-radius: 10px;
    }
    form {
      margin-bottom: 2rem;
    }
    input[type="text"], input[type="url"], input[type="time"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    label {
      font-weight: bold;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 2rem;
    }
    th, td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: left;
    }
    th {
      background: #f9f9f9;
    }
  </style>
</head>
<body>

<div class="navbar">📹 Tatap Muka Online - Jitsi Integration</div>
<a href="../siswa.php" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>
  <?php
  // Proses simpan jadwal
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $stmt = $pdo->prepare("INSERT INTO jadwal_tatap_muka (guru, mapel, kelas, jam, link, materi) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->execute([
          $_POST['guru'], $_POST['mapel'], $_POST['kelas'], $_POST['jam'], $_POST['link'], $_POST['materi']
      ]);
      echo "<script>alert('Jadwal berhasil ditambahkan!'); window.location='tatap_muka.php';</script>";
  }

  // Tampilkan semua jadwal
  echo "<h2>Daftar Tatap Muka (Siswa)</h2>";
  $data = $pdo->query("SELECT * FROM jadwal_tatap_muka ORDER BY jam ASC")->fetchAll();
  if ($data) {
      echo "<table>
              <tr>
                <th>Jam</th>
                <th>Guru</th>
                <th>Kelas</th>
                <th>Mapel</th>
                <th>Gabung</th>
              </tr>";
      foreach ($data as $row) {
          echo "<tr>
                  <td>{$row['jam']}</td>
                  <td>{$row['guru']}</td>
                  <td>{$row['kelas']}</td>
                  <td>{$row['mapel']}</td>
                  <td><a class='btn' href='?room={$row['link']}&nama={$row['mapel']}-{$row['kelas']}'>Gabung</a></td>
                </tr>";
      }
      echo "</table>";
  } else {
      echo "<p>Belum ada jadwal.</p>";
  }

  // Jika room dipilih, tampilkan Jitsi iframe
  if (isset($_GET['room'])) {
      $url = htmlspecialchars($_GET['room']);
      $roomName = htmlspecialchars($_GET['nama']);
      echo "<h2>Sesi Tatap Muka: $roomName</h2>";
      echo "<iframe src='$url' allow='camera; microphone; fullscreen'></iframe>";
  }
  ?>

</div>
</body>
</html>
