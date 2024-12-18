-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 05:52 PM
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
-- Database: `bimbel_db1`
--

-- --------------------------------------------------------

--
-- Table structure for table `carousel_ads`
--

CREATE TABLE `carousel_ads` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `financial_reports`
--

CREATE TABLE `financial_reports` (
  `id` int(11) NOT NULL,
  `report_name` varchar(100) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` enum('income','expense') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id`, `course_id`, `title`, `content`, `file_url`, `date_created`, `kategori`) VALUES
(1, 232, 'ASDASD', 'ASDDASSAD', 'Algoritma dan Metode Pencarian Data.pdf', '2024-12-14 14:15:45', 'pengenalan'),
(2, 213312, 'asdas', 'adsda', 'Algoritma dan Metode Pencarian Data.pdf', '2024-12-14 14:17:58', 'pertemuan'),
(3, 2, 'saadas', 'sadas', 'Algoritma dan Metode Pencarian Data.pdf', '2024-12-15 05:35:22', 'pertemuan');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `features` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `price`, `description`, `features`, `image`) VALUES
(1, 'Paket 1on1', 500000.00, 'Paket belajar 1on1 dengan tutor berpengalaman.', '4x pertemuan per bulan, Durasi 90 menit per pertemuan, Materi pelajaran sekolah, Kelas offline', './img/kursus.jpeg'),
(2, 'Paket 1on3', 750000.00, 'Paket belajar 1on3 dengan tutor berpengalaman.', '8x pertemuan per bulan, Durasi 120 menit per pertemuan, Materi pelajaran sekolah, Kelas offline dan online, Modul latihan tambahan', './img/kursus.jpeg'),
(3, 'Paket 1on5', 1000000.00, 'Paket belajar 1on5 dengan tutor berpengalaman.', '12x pertemuan per bulan, Durasi 120 menit per pertemuan, Materi pelajaran sekolah, Kelas offline dan online, Modul latihan tambahan, Konsultasi pribadi, Tryout bulanan', './img/kursus.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id` int(11) NOT NULL,
  `bulan_mulai` varchar(20) NOT NULL,
  `tahun_mulai` varchar(4) NOT NULL,
  `lama_belajar` int(11) NOT NULL,
  `tingkat_pendidikan` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `kurikulum` varchar(50) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id`, `bulan_mulai`, `tahun_mulai`, `lama_belajar`, `tingkat_pendidikan`, `kelas`, `kurikulum`, `total_harga`, `created_at`) VALUES
(1, 'Januari', '2024', 3, 'SD', '2', 'Kurikulum 2013', 1700000, '2024-12-17 13:21:34'),
(2, 'November', '2024', 3, 'SMP', '7', 'Kurikulum 2013', 1700000, '2024-12-17 15:13:57'),
(3, 'Oktober', '2025', 6, 'SMP', '9', 'Kurikulum 2018', 3200000, '2024-12-17 15:16:19'),
(4, 'Januari', '2025', 3, 'SD', '3', 'Kurikulum 2013', 1700000, '2024-12-18 16:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `paket_belajar`
--

CREATE TABLE `paket_belajar` (
  `id_paket` int(11) NOT NULL,
  `bulan_mulai` tinyint(4) NOT NULL CHECK (`bulan_mulai` between 1 and 12),
  `tahun_mulai` year(4) NOT NULL,
  `lama_belajar` tinyint(4) NOT NULL CHECK (`lama_belajar` between 3 and 12),
  `tingkat_pendidikan` enum('SD','SMP','SMA') NOT NULL,
  `kelas` tinyint(4) NOT NULL CHECK (`kelas` between 1 and 12),
  `kurikulum` varchar(50) NOT NULL,
  `tanggal_pilih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text DEFAULT NULL,
  `status` enum('pending','completed','failed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `registration_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `tingkat` varchar(25) NOT NULL,
  `kurikulum` varchar(255) NOT NULL,
  `start_month` int(11) NOT NULL,
  `start_year` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `total_harga` varchar(25) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`registration_id`, `user_id`, `package_id`, `class`, `tingkat`, `kurikulum`, `start_month`, `start_year`, `duration`, `total_harga`, `created_at`) VALUES
(1, 26, 1, 3, '0', 'Kurikulum 2013', 0, 2025, 3, '1700000', '2024-12-18 23:45:18'),
(2, 25, 1, 7, '0', 'Kurikulum 2018', 0, 2025, 6, '3200000', '2024-12-18 23:46:48');

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `enrollment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `subject_specialty` varchar(100) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_id` datetime NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `regency` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_id`, `created_id`, `email`, `phone`, `province`, `regency`, `district`, `address`, `is_active`) VALUES
(1, 'Janu', '123', 3, '2024-10-26 12:20:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'chris', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, '2024-10-26 12:50:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'tio', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, '2024-10-26 12:53:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Tio Raksa', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, '2024-10-27 16:06:17', 'tioraksa15@gmail.com', '081282688986', '32', '3215', '3215113', '', NULL),
(11, 'Christoper', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, '2024-10-27 17:49:30', 'chris12@gmail.com', '9888888', '32', '3215', '3215031', 'jiududuu', NULL),
(12, 'sultan', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, '2024-10-27 17:55:09', 'kiki123@gmail.com', '+62 88298175313', '32', '3215', '3215031', 'ttttttf', NULL),
(13, 'jaenudin', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, '2024-11-02 00:02:59', 'jaenudin@gmail.com', '9384748848', '32', '3214', '3214090', 'jiududuu', NULL),
(14, 'januu', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, '2024-11-02 23:05:23', 'janu123@gmail.com', '88298175313', '32', '3204', '3204140', 'jhhh', NULL),
(15, 'ojan', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, '2024-11-03 00:02:06', 'chris12@gmail.com', '9384748848', '34', '3402', '3402170', 'ww', NULL),
(16, 'tioraksa', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, '2024-12-08 17:19:56', 'tiotio12@gmail.com', '+62 88298175313', '32', '3215', '3215113', 'lkk', NULL),
(17, 'rafli', '25334c4d86d94ee57ab9fbbbf32b33a8b63d5f73da4398b8ea4d74e3f39c8a10', 4, '2024-12-08 21:33:12', 'rafli@gmail.com', '08810982093', '32', '3215', '3215113', 'paracis', NULL),
(18, 'tes', 'ce0f6c28b5869ff166714da5fe08554c70c731a335ff9702e38b00f81ad348c6', 2, '2024-12-08 23:34:23', 'tes@gmail.com', '', '32', '3217', '3217130', 'tes', NULL),
(19, 'tes1', '970f3fce6e109b8e83d902c4de153d8b0386f0ccba23ac71e070859d5091ff84', 3, '2024-12-08 23:39:24', 'tes1@gmail.com', '89092348', '61', '6172', '6172010', 'sad', NULL),
(21, 'asdasd', '688787d8ff144c502c7f5cffaafe2cc588d86079f9de88304c26b0cb99ce91c6', 1, '2024-12-09 22:57:21', 'as@gmail.com', '42324324', '51', '5171', '5171010', 'wqe', NULL),
(22, 'tes2', 'c0f7fb669c010900ba45f93e56d871ee6bad05451b323e280ee0d2065af6fe44', 1, '2024-12-12 22:00:13', 'tes2@gmail.com', '23123', '31', '3172', '3172090', 'sad', NULL),
(23, 'guru1', '2770c78f51bb70e3e1e4271378c633eb06c94bc359198c208531950fb8f61900', 2, '2024-12-17 22:43:18', 'guru1@gmail.com', '3123123', NULL, NULL, NULL, 'guru1', NULL),
(24, 'guru2', 'c05478aad2f526db2dce958e2d2fac973a8755129a45aa016eb7d3ee287c98e0', 2, '2024-12-17 22:44:46', 'guru2@gmail.com', '33123213', NULL, NULL, NULL, 'guru2', NULL),
(25, 'tes3', '75ad39c365275e0247c1ca868d4b0b56f8c1f2300a414615d3bef65c2f98ccef', 1, '2024-12-18 22:31:56', 'tes3@gmail.com', '1232132', '53', '5301', '5301022', 'tes3', 0),
(26, 'tes4', '4d87ff3759e450e5a8e282f891c0d6c62de7abc1f3557b5693729f308e8b1d7c', 1, '2024-12-18 22:50:30', 'tes4@gmail.com', '312312', '32', '3215', '3215112', 'tes4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE `users_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_role`
--

INSERT INTO `users_role` (`id`, `role`) VALUES
(1, 'student'),
(2, 'teacher'),
(3, 'admin'),
(4, 'founder');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carousel_ads`
--
ALTER TABLE `carousel_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `financial_reports`
--
ALTER TABLE `financial_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket_belajar`
--
ALTER TABLE `paket_belajar`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`registration_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carousel_ads`
--
ALTER TABLE `carousel_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_reports`
--
ALTER TABLE `financial_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paket_belajar`
--
ALTER TABLE `paket_belajar`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD CONSTRAINT `student_courses_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `student_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `users_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
