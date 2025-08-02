-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2025 at 10:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ajis`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mata_pelajaran` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_mapel`, `nama_mapel`, `created_at`) VALUES
(1, 'Matematika', '2025-07-20 18:20:13'),
(2, 'Bahasa Indonesia', '2025-07-20 18:20:13'),
(3, 'bahasa inggris', '2025-07-20 18:20:13'),
(4, 'bahasa sunda', '2025-07-20 18:20:13'),
(5, 'sejarah', '2025-07-20 18:20:13'),
(6, 'fisika', '2025-07-20 18:20:13'),
(7, 'kimia', '2025-07-20 18:20:13'),
(8, 'geografi', '2025-07-20 18:20:13'),
(9, 'pertanian', '2025-07-20 18:20:13'),
(10, 'perikanan', '2025-07-20 18:20:13'),
(11, 'sosiologi', '2025-07-20 18:20:13'),
(12, 'seni', '2025-07-20 18:20:13'),
(13, 'TIK', '2025-07-20 18:20:13'),
(14, 'PJOK', '2025-07-20 18:20:13'),
(15, 'ekonomi', '2025-07-20 18:20:13');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `mata_pelajaran` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `referensi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_siswa`
--

CREATE TABLE `nilai_siswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `mata_pelajaran` varchar(100) NOT NULL,
  `nilai` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_siswa`
--

INSERT INTO `nilai_siswa` (`id`, `nama`, `kelas`, `mata_pelajaran`, `nilai`, `created_at`) VALUES
(15, 'rahman', '10-IPA-1', 'Ekonomi', 80, '2025-08-02 03:31:28');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `question_type` enum('pg','esay') DEFAULT NULL,
  `question` text NOT NULL,
  `option_a` varchar(255) DEFAULT NULL,
  `option_b` varchar(255) DEFAULT NULL,
  `option_c` varchar(255) DEFAULT NULL,
  `option_d` varchar(255) DEFAULT NULL,
  `correct_answer` varchar(1) DEFAULT NULL,
  `model_answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tugas_guru`
--

CREATE TABLE `tugas_guru` (
  `id_tugas` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `mata_pelajaran` varchar(100) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `judul_tugas` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `deadline` datetime NOT NULL,
  `file_tugas` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tugas_guru`
--

INSERT INTO `tugas_guru` (`id_tugas`, `id_guru`, `mata_pelajaran`, `kelas`, `judul_tugas`, `deskripsi`, `deadline`, `file_tugas`, `status`, `created_at`) VALUES
(10, 0, 'bahasa indonesia', '10-IPA-2', 'uas', 'oke', '2025-07-21 17:53:00', '1753008796_SIJ+LPPM.pdf', 'pending', '2025-07-20 10:53:16'),
(11, 0, 'ekonomi', '12-IPA-2', 'uas', 'selesai ya bu', '2025-07-20 19:51:00', '1753015892_document (1).pdf', 'pending', '2025-07-20 12:51:32'),
(15, 0, 'ekonomi', '10-IPA-1', 'uas', 'selamat mengerjakan', '2025-08-02 09:51:00', '1754103123_catatan.docx', 'pending', '2025-08-02 02:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `tugas_siswa`
--

CREATE TABLE `tugas_siswa` (
  `id_tugas_siswa` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `mata_pelajaran` varchar(100) NOT NULL,
  `file_tugas` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto_tugas` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'selesai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tugas_siswa`
--

INSERT INTO `tugas_siswa` (`id_tugas_siswa`, `id_siswa`, `nama_lengkap`, `id_tugas`, `mata_pelajaran`, `file_tugas`, `created_at`, `foto_tugas`, `status`) VALUES
(13, 0, 'rahman', 15, '', '1754104717_catatan.docx', '2025-08-02 03:18:37', NULL, 'Terkirim');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `role` enum('pimpinan','admin','guru','siswa') NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `mata_pelajaran` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `email`, `password`, `telepon`, `role`, `kelas`, `mata_pelajaran`, `created_at`, `reset_token`) VALUES
(23, 'admin', 'admin@gmail.com', '$2y$10$zS6r6AiZl1gsyR/K/mvKuOQvxkUrW.v8RImAREjQRZjl2Ca8C8ZXG', '', 'admin', NULL, NULL, '2025-07-20 11:12:49', NULL),
(26, 'indah', 'indah@gmail.com', 'indah', '08321212667', 'guru', NULL, 'seni', '2025-07-20 11:56:11', NULL),
(27, 'rama', 'rama@gmail.com', 'rahma', '08321212667', 'siswa', '10-ips-1', NULL, '2025-07-20 12:20:07', NULL),
(28, 'bima prasetya', 'bima@gmail.com', 'bima', '08321212667', 'siswa', '11-ips-1', NULL, '2025-07-20 12:21:28', NULL),
(29, 'raka bumingraka', 'raka@gmail.com', 'raka', '083212775464', 'siswa', '10-ipa-2', NULL, '2025-07-20 12:22:22', NULL),
(30, 'rohman', 'rohman@gmail.com', 'rohman', '08321212543', 'guru', NULL, 'pjok', '2025-07-20 12:23:07', NULL),
(31, 'siti rodiatul', 'siti@gmail.com', 'siti', '08321212622', 'guru', NULL, 'geografi', '2025-07-20 12:24:03', NULL),
(32, 'putri regina', 'putriregina@gmail.com', 'putriregina', '083212125777', 'siswa', '12-ipa-2', NULL, '2025-07-20 12:27:26', NULL),
(33, 'admin1', 'admin1@gmail.com', 'admin123', '0832121266766', 'admin', NULL, NULL, '2025-07-20 12:28:31', NULL),
(34, 'vina altionita', 'vina@gmail.com', '$2y$10$wCEHcWT391t4/PKckphOyu6ZfrulAbaLCjbAEk3l/SVuDzrlvO2EO', '083263256555', 'guru', NULL, 'ekonomi', '2025-07-20 12:49:49', '301f423d58235aad3290231a4209e4c740087f191343ac6466c5ab04e6d40c52'),
(35, 'samsul', 'samsul@gmail.com', '$2y$10$9RoVOm/KGM0beyBUrujsG.NKGzYzmuSg7muNU/7FFf.semaPjtxSe', '08321212622', 'siswa', '12-IPA-2', NULL, '2025-07-20 12:55:41', NULL),
(36, 'rahman', 'rahman@gmail.com', '$2y$10$MJ3bbyb5mmG30cwXvWDxsOvcD.enUp6f3LSZ1rVd3vvCDsRZwfTmW', '083212125777', 'siswa', '10-IPA-1', NULL, '2025-08-02 02:54:18', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_siswa`
--
ALTER TABLE `nilai_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas_guru`
--
ALTER TABLE `tugas_guru`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `mata_pelajaran` (`mata_pelajaran`);

--
-- Indexes for table `tugas_siswa`
--
ALTER TABLE `tugas_siswa`
  ADD PRIMARY KEY (`id_tugas_siswa`),
  ADD KEY `id_tugas` (`id_tugas`),
  ADD KEY `mata_pelajaran` (`mata_pelajaran`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nilai_siswa`
--
ALTER TABLE `nilai_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tugas_guru`
--
ALTER TABLE `tugas_guru`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tugas_siswa`
--
ALTER TABLE `tugas_siswa`
  MODIFY `id_tugas_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tugas_siswa`
--
ALTER TABLE `tugas_siswa`
  ADD CONSTRAINT `tugas_siswa_ibfk_1` FOREIGN KEY (`id_tugas`) REFERENCES `tugas_guru` (`id_tugas`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
