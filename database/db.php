<?php
// db.php
$host = 'localhost';  // Ganti dengan host database Anda, misalnya 'localhost' atau IP
$dbname = 'ajis';     // Nama database Anda
$username = 'root';   // Username database, biasanya 'root' untuk XAMPP
$password = '';       // Password untuk username database, kosongkan jika tidak ada

try {
    // Membuat koneksi PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Menampilkan error jika ada masalah
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
    exit();
}
?>
