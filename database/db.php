<?php
// db.php
$host = 'db2';  // Ganti dengan host database Anda, misalnya 'localhost' atau IP
$dbname = 'dblearning';     // Nama database Anda
$username = 'learning_user';   // Username database, biasanya 'root' untuk XAMPP
$password = 'learning_pass';       // Password untuk username database, kosongkan jika tidak ada

try {
    // Membuat koneksi PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Menampilkan error jika ada masalah
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
    exit();
}
?>