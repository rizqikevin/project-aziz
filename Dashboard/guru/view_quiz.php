<?php
// view_quiz.php
require_once '../../database/db.php'; // Sesuaikan path

$openai_api_key = 'ISI_API_KEY_KAMU'; // Ganti dengan API key dari OpenAI

function evaluateEssay($question, $studentAnswer, $modelAnswer, $apiKey) {
    $prompt = "Pertanyaan: $question\n\nJawaban Siswa: $studentAnswer\n\nJawaban Ideal: $modelAnswer\n\nBerdasarkan kesesuaian jawaban siswa dengan jawaban ideal, berikan penilaian dari 0 sampai 100 dan ringkasan evaluasi.\n\nJawaban:";

    $data = [
        "model" => "gpt-3.5-turbo",
        "messages" => [
            ["role" => "system", "content" => "Kamu adalah guru yang menilai jawaban esai siswa."],
            ["role" => "user", "content" => $prompt]
        ],
        "temperature" => 0.3
    ];

    $ch = curl_init("https://api.openai.com/v1/chat/completions");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer $apiKey"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);
    return $result['choices'][0]['message']['content'] ?? "Gagal mengevaluasi.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answers = $_POST['answers'] ?? [];
    $total_questions = 0;
    $correct_answers = 0;
    $incorrect_answers = 0;
    $all_answered = true;

    $query = "SELECT * FROM quiz_questions ORDER BY id ASC";
    $stmt = $pdo->query($query);
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($questions as $question) {
        $total_questions++;

        if (!isset($answers[$question['id']]) || trim($answers[$question['id']]) === '') {
            $all_answered = false;
        }

        if ($question['question_type'] === 'pg' && isset($answers[$question['id']])) {
            if ($answers[$question['id']] === $question['correct_answer']) {
                $correct_answers++;
            } else {
                $incorrect_answers++;
            }
        }

        if ($question['question_type'] === 'esay' && isset($answers[$question['id']])) {
            $evaluation = evaluateEssay(
                $question['question'],
                $answers[$question['id']],
                $question['model_answer'] ?? '',
                $openai_api_key
            );

            echo "<div class='alert alert-secondary'><strong>Pertanyaan Esai:</strong> " . htmlspecialchars($question['question']) . "<br><strong>Penilaian AI:</strong><br>$evaluation</div>";
        }
    }

    $score = ($total_questions > 0) ? round(($correct_answers / $total_questions) * 100, 2) : 0;

    echo "<div class='alert alert-info text-center'>Skor Anda: $score</div>";
    echo "<div class='alert alert-warning text-center'>Jumlah soal salah: $incorrect_answers</div>";

    if ($all_answered) {
        $pdo->exec("DELETE FROM quiz_questions");
        echo "<div class='alert alert-success text-center'>Semua soal telah dijawab. Soal dihapus dari database.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kerjakan Quiz</title>
    <!-- Favicon -->
    <link href="../../assets/img/sma12logo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
            max-width: 600px;
            padding: 15px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(32, 132, 209, 0.1);
        }

        .alert {
            margin-top: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Kerjakan Quiz</h2>
    <form method="POST">
        <div class="table-responsive">
            <table class="table table-striped table-bordered quiz-table">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban Anda</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM quiz_questions ORDER BY id ASC";
                $stmt = $pdo->query($query);

                if ($stmt->rowCount() > 0) {
                    $no = 1;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . $no++ . '</td>';
                        echo '<td>' . htmlspecialchars($row['question']) . '</td>';

                        if ($row['question_type'] === 'pg') {
                            echo '<td>';
                            foreach (['A', 'B', 'C', 'D'] as $option) {
                                $value = $row['option_' . strtolower($option)];
                                if (!empty($value)) {
                                    $inputId = $row['id'] . '-' . $option;
                                    echo "<div class='form-check'>
                                        <input class='form-check-input' type='radio' name='answers[{$row['id']}]' value='$option' id='$inputId'>
                                        <label class='form-check-label' for='$inputId'>" . htmlspecialchars($value) . "</label>
                                    </div>";
                                }
                            }
                            echo '</td>';
                        } elseif ($row['question_type'] === 'esay') {
                            echo '<td><textarea class="form-control" name="answers[' . $row['id'] . ']" rows="3" placeholder="Tulis jawaban Anda..."></textarea></td>';
                        }

                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="3" class="text-center">Belum ada soal tersedia.</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex flex-column flex-md-row gap-2 mt-3">
            <button type="submit" class="btn btn-primary w-100 w-md-auto">Kirim</button>
            <a href="../siswa.php" class="btn btn-secondary w-100 w-md-auto">Kembali</a>
        </div>
    </form>
</div>
</body>
</html>
