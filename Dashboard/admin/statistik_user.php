<?php
// Koneksi ke database
include('../../database/db.php');

// Query untuk mendapatkan statistik
$query = "SELECT role, COUNT(*) as total FROM users GROUP BY role";
$stmt = $pdo->prepare($query);
$stmt->execute();
$stats = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query untuk total pengguna
$query_total = "SELECT COUNT(*) as total_user FROM users";
$stmt_total = $pdo->prepare($query_total);
$stmt_total->execute();
$total_user = $stmt_total->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Statistik Pengguna</title>
    <!-- Favicon -->
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Data Statistik Pengguna</h1>
        <a href="../admin.php" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

        <!-- Tampilkan Total Pengguna -->
        <div class="card mb-3">
            <div class="card-header">
                <h4>Total Pengguna</h4>
            </div>
            <div class="card-body">
                <p>Total Pengguna: <strong><?= $total_user ?></strong></p>
            </div>
        </div>

        <!-- Tampilkan Statistik Berdasarkan Role -->
        <div class="card mb-3">
            <div class="card-header">
                <h4>Statistik Berdasarkan Role</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Jumlah Pengguna</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stats as $stat): ?>
                            <tr>
                                <td><?= ucfirst($stat['role']); ?></td>
                                <td><?= $stat['total']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
