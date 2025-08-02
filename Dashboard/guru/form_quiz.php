<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Soal Quiz</title>
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Input Soal Quiz</h2>

    <form action="process_quiz.php" method="POST">
        <!-- Jenis Soal -->
        <div class="mb-3">
            <label for="question_type" class="form-label">Jenis Soal</label>
            <select class="form-select" id="question_type" name="question_type" required>
                <option value="">Pilih Jenis Soal</option>
                <option value="pg">Pilihan Ganda</option>
                <option value="esay">Esai</option>
            </select>
        </div>

        <!-- Pertanyaan -->
        <div class="mb-3">
            <label for="question" class="form-label">Pertanyaan</label>
            <textarea class="form-control" id="question" name="question" rows="3" required></textarea>
        </div>

        <!-- Pilihan Ganda -->
        <div id="multiple_choice_options" style="display: none;">
            <label class="form-label">Pilihan Jawaban</label>
            <input type="text" class="form-control mb-2" name="option_a" placeholder="Pilihan A">
            <input type="text" class="form-control mb-2" name="option_b" placeholder="Pilihan B">
            <input type="text" class="form-control mb-2" name="option_c" placeholder="Pilihan C">
            <input type="text" class="form-control mb-2" name="option_d" placeholder="Pilihan D">

            <!-- Jawaban Benar PG -->
            <div class="mb-3">
                <label for="correct_answer" class="form-label">Jawaban Benar</label>
                <select class="form-select" id="correct_answer" name="correct_answer">
                    <option value="">Pilih Jawaban Benar</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>
        </div>

        <!-- Esai -->
        <div id="essay_answer_section" style="display: none;">
            <div class="mb-3">
                <label for="essay_answer" class="form-label">Jawaban Benar (Esai)</label>
                <textarea class="form-control" id="essay_answer" name="essay_answer" rows="4" placeholder="Masukkan jawaban benar esai..."></textarea>
            </div>
        </div>

        <!-- Tombol -->
        <div class="d-flex flex-column flex-md-row gap-2 mt-3">
            <button type="submit" class="btn btn-primary w-100 w-md-auto">Simpan Soal</button>
            <a href="../guru.php" class="btn btn-secondary w-100 w-md-auto">Kembali ke Dashboard</a>
        </div>
    </form>
</div>

<script>
    const questionTypeSelect = document.getElementById('question_type');
    const multipleChoiceOptions = document.getElementById('multiple_choice_options');
    const essayAnswerSection = document.getElementById('essay_answer_section');

    questionTypeSelect.addEventListener('change', function () {
        const selected = this.value;
        multipleChoiceOptions.style.display = selected === 'pg' ? 'block' : 'none';
        essayAnswerSection.style.display = selected === 'esay' ? 'block' : 'none';
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
