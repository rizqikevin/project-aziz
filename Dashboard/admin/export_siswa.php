<?php
// Sertakan koneksi database
include '../../database/db.php';

// Load library PhpSpreadsheet
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Buat objek spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header untuk file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="data_siswa.xlsx"');
header('Cache-Control: max-age=0');

// Menambahkan header kolom
$sheet->setCellValue('A1', 'ID Siswa');
$sheet->setCellValue('B1', 'Nama Lengkap');
$sheet->setCellValue('C1', 'Kelas');

// Mengambil data siswa dari database
$students = $pdo->query("SELECT id_siswa, nama_lengkap, kelas FROM siswa")->fetchAll(PDO::FETCH_ASSOC);

// Mengisi data ke dalam spreadsheet
$row = 2;
foreach ($students as $student) {
    $sheet->setCellValue("A$row", $student['id_siswa']);
    $sheet->setCellValue("B$row", $student['nama_lengkap']);
    $sheet->setCellValue("C$row", $student['kelas']);
    $row++;
}

// Menyimpan file Excel dan mengirim ke browser
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
