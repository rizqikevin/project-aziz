<?php include '../inc/db.php'; ?>

<h2>Daftar Tatap Muka Hari Ini</h2>

<table border="1">
    <tr>
        <th>Jam</th>
        <th>Guru</th>
        <th>Mata Pelajaran</th>
        <th>Kelas</th>
        <th>Materi</th>
        <th>Link</th>
        <th>Aksi</th>
    </tr>
    <?php
    $stmt = $pdo->query("SELECT * FROM jadwal_tatap_muka ORDER BY jam ASC");
    while ($row = $stmt->fetch()) {
        echo "<tr>
                <td>{$row['jam']}</td>
                <td>{$row['guru']}</td>
                <td>{$row['mapel']}</td>
                <td>{$row['kelas']}</td>
                <td>{$row['materi']}</td>
                <td><a href='{$row['link']}' target='_blank'>Gabung</a></td>
                <td>
                    <form action='presensi.php' method='POST'>
                        <input type='hidden' name='jadwal_id' value='{$row['id']}'>
                        <input type='text' name='siswa' placeholder='Nama Anda' required>
                        <button type='submit'>Presensi</button>
                    </form>
                </td>
              </tr>";
    }
    ?>
</table>
