<?php
// Include file koneksi database
require_once '../../database/db.php'; // Pastikan path ke db.php benar

// Periksa apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $question_type = $_POST['question_type'];
    $question = $_POST['question'];

    // Periksa validasi umum
    if (empty($question_type) || empty($question)) {
        echo "<script>alert('Jenis soal dan pertanyaan wajib diisi.'); window.history.back();</script>";
        exit;
    }

    // Persiapkan query untuk memasukkan soal
    if ($question_type === 'pg') {
        // Ambil data untuk pilihan ganda
        $option_a = $_POST['option_a'];
        $option_b = $_POST['option_b'];
        $option_c = $_POST['option_c'];
        $option_d = $_POST['option_d'];
        $correct_answer = $_POST['correct_answer'];

        // Validasi tambahan untuk pilihan ganda
        if (empty($option_a) || empty($option_b) || empty($option_c) || empty($option_d) || empty($correct_answer)) {
            echo "<script>alert('Semua pilihan jawaban dan jawaban benar wajib diisi untuk soal pilihan ganda.'); window.history.back();</script>";
            exit;
        }

        // Query untuk soal pilihan ganda
        $query = "INSERT INTO quiz_questions (question_type, question, option_a, option_b, option_c, option_d, correct_answer) 
                  VALUES (:question_type, :question, :option_a, :option_b, :option_c, :option_d, :correct_answer);";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':question_type', $question_type);
        $stmt->bindParam(':question', $question);
        $stmt->bindParam(':option_a', $option_a);
        $stmt->bindParam(':option_b', $option_b);
        $stmt->bindParam(':option_c', $option_c);
        $stmt->bindParam(':option_d', $option_d);
        $stmt->bindParam(':correct_answer', $correct_answer);
    } elseif ($question_type === 'esay') {
        // Query untuk soal esai
        $query = "INSERT INTO quiz_questions (question_type, question) VALUES (:question_type, :question);";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':question_type', $question_type);
        $stmt->bindParam(':question', $question);
    } else {
        echo "<script>alert('Jenis soal tidak valid.'); window.history.back();</script>";
        exit;
    }

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Soal berhasil disimpan!'); window.location.href='form_quiz.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->errorInfo()[2] . "'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Metode request tidak valid.'); window.history.back();</script>";
}
?>
