<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Data Pribadi Siswa</title>
    <link href="../../assets/img/sma12logo.png" rel="icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        body {
            background-image: url('../../img/Ungu dan Biru Modern.png'); /* Sesuaikan dengan path gambar Anda */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }
        .table-container {
            margin-top: 50px;
            background: rgba(255, 255, 255, 0.9); /* Transparansi card */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .table-title {
            margin-bottom: 20px;
            font-weight: bold;
            color: #3f51b5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="table-container">
            <h4 class="table-title center-align">Daftar Data Pribadi Siswa</h4>
            <table class="striped responsive-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Ahmad Fauzan</td>
                        <td>ahmad.fauzan@gmail.com</td>
                        <td>+62 812-3456-7890</td>
                        <td>XII IPA 1</td>
                        <td>
                            <a href="detail_siswa.php?id=1" class="btn-small blue lighten-2">Detail</a>
                            <a href="edit_siswa.php?id=1" class="btn-small orange lighten-1">Edit</a>
                            <a href="hapus_siswa.php?id=1" class="btn-small red lighten-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Siti Nurhaliza</td>
                        <td>siti.nurhaliza@gmail.com</td>
                        <td>+62 822-1234-5678</td>
                        <td>XII IPA 2</td>
                        <td>
                            <a href="detail_siswa.php?id=2" class="btn-small blue lighten-2">Detail</a>
                            <a href="edit_siswa.php?id=2" class="btn-small orange lighten-1">Edit</a>
                            <a href="hapus_siswa.php?id=2" class="btn-small red lighten-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
