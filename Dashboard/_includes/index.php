<?php
$kursus_list = [
  1 => '📐 Matematika',
  2 => '📖 Bahasa Indonesia',
  3 => '🧬 Biologi',
  4 => '⚗️ Kimia',
  5 => '🧲 Fisika',
  6 => '👥 Sosiologi',
  7 => '🗣️ Bahasa Sunda',
  8 => '💰 Ekonomi',
  9 => '🏰 Sejarah',
  10 => '💻 TIK',
  11 => '🌱 Pertanian',
  12 => '🐟 Perikanan',
  13 => '📖 inggris',
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Beranda - BelajarKu</title>
  <!-- Favicon -->
  <link href="../../assets/img/sma12logo.png" rel="icon" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap');

    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: 'Quicksand', sans-serif;
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: #fff;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    header {
      padding: 2.5rem 1rem;
      text-align: center;
      background: rgba(0,0,0,0.15);
      box-shadow: 0 2px 10px rgba(0,0,0,0.3);
      border-bottom-left-radius: 1rem;
      border-bottom-right-radius: 1rem;
    }

    header h1 {
      margin: 0;
      font-size: 2.5rem;
      font-weight: 700;
      letter-spacing: 1px;
      text-shadow: 0 2px 6px rgba(0,0,0,0.4);
    }

    /* Tombol Kembali ke Dashboard modern dan timbul (neumorphism) */
    .btn-kembali {
      display: inline-block;
      margin: 1.5rem auto 2rem;
      padding: 0.75rem 2rem;
      background: #764ba2;
      border-radius: 50px;
      font-weight: 700;
      font-size: 1.1rem;
      color: #fff;
      text-decoration: none;
      text-align: center;
      box-shadow:
        6px 6px 12px #5a3576,
        -6px -6px 12px #8e6ec9;
      transition: box-shadow 0.3s ease, transform 0.3s ease;
      user-select: none;
      max-width: 220px;
    }

    .btn-kembali:hover {
      box-shadow:
        inset 6px 6px 12px #5a3576,
        inset -6px -6px 12px #8e6ec9;
      transform: translateY(-3px);
      color: #e0d7ff;
    }

    main {
      flex: 1;
      max-width: 1100px;
      margin: 0 auto 2rem;
      padding: 0 1rem;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 2rem;
    }

    .kursus-card {
      position: relative;
      background: rgba(255, 255, 255, 0.15);
      border-radius: 18px;
      padding: 1.5rem;
      color: #fff;
      text-decoration: none;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      transition: transform 0.3s ease, background 0.3s ease;
      overflow: hidden;
    }

    .kursus-card:hover {
      transform: translateY(-6px);
      background: rgba(255, 255, 255, 0.2);
    }

    .kursus-card::before {
      content: "";
      position: absolute;
      top: -30%;
      right: -30%;
      width: 150%;
      height: 150%;
      background: radial-gradient(circle, rgba(255,255,255,0.1), transparent 60%);
      transform: rotate(25deg);
      z-index: 0;
    }

    .kursus-content {
      position: relative;
      z-index: 1;
    }

    .kursus-title {
      font-size: 1.3rem;
      font-weight: 700;
      margin-bottom: 1rem;
      text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .btn-pelajari {
      display: inline-block;
      padding: 0.5rem 1rem;
      background: #fff;
      color: #764ba2;
      font-weight: 600;
      border-radius: 50px;
      text-decoration: none;
      box-shadow: 0 3px 10px rgba(255,255,255,0.3);
      transition: background 0.3s ease, color 0.3s ease;
    }

    .btn-pelajari:hover {
      background: #764ba2;
      color: #fff;
    }

    footer {
      text-align: center;
      padding: 1rem;
      font-size: 0.9rem;
      background: rgba(0,0,0,0.1);
      color: #eee;
      margin-top: auto;
    }
  </style>
</head>
<body>

<header>
  <h1>📚 BelajarKu </h1>
</header>

<!-- Tombol Kembali ke Dashboard -->
<a href="../siswa.php" class="btn-kembali" aria-label="Kembali ke Dashboard">← Kembali ke Dashboard</a>

<main>
  <?php foreach ($kursus_list as $id => $judul): ?>
    <a href="kursus.php?id=<?= $id ?>" class="kursus-card">
      <div class="kursus-content">
        <div class="kursus-title"><?= htmlspecialchars($judul) ?></div>
        <span class="btn-pelajari">Pelajari →</span>
      </div>
    </a>
  <?php endforeach; ?>
</main>

<footer>
  &copy; <?= date('Y') ?> BelajarKu. Semangat belajar! 🚀
</footer>

</body>
</html>
