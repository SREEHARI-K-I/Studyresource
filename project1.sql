-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2025 at 02:00 PM
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
-- Database: `project1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_verification`
--

CREATE TABLE `admin_verification` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_verification`
--

INSERT INTO `admin_verification` (`id`, `admin_id`, `email`, `password`) VALUES
(10, 'KTU3450', 'sura@gmail.com', 'abyz1234');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `event_date` date NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `event_date`, `image_path`, `created_by`, `created_at`) VALUES
(1, 'Xplore\'24', 'State Level Techfest at GCEK.', '2025-02-12', 'uploads/events/1744815024_5-mb-example-file.pdf', 6, '2025-04-17 04:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `semester`, `subject`, `file_path`, `status`, `uploaded_at`) VALUES
(2, 7, 1, 'Lifeskill', 'uploads/notes/1744732610_5-mb-example-file.pdf', 'pending', '2025-04-15 15:56:50');

-- --------------------------------------------------------

--
-- Table structure for table `pending_events`
--

CREATE TABLE `pending_events` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_description` text DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_events`
--

INSERT INTO `pending_events` (`id`, `student_id`, `event_title`, `event_description`, `event_date`, `file_path`, `status`, `created_at`) VALUES
(6, 6, 'Agnitus\'25', 'National Level Techfest at COET.', '2025-08-12', 'uploads/events/1744782992_5-mb-example-file.pdf', 'pending', '2025-04-16 05:56:32'),
(9, 9, 'Hackatly', 'Hackathon at COET.', '2025-02-15', 'uploads/events/1744861304_5-mb-example-file.pdf', 'rejected', '2025-04-17 03:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `pyqs`
--

CREATE TABLE `pyqs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pyqs`
--

INSERT INTO `pyqs` (`id`, `user_id`, `year`, `semester`, `subject`, `file_path`, `status`, `uploaded_at`) VALUES
(1, 7, 2024, 1, 'Lifeskill', 'uploads/notes/1744735404_5-mb-example-file.pdf', 'pending', '2025-04-15 16:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_number` varchar(50) NOT NULL,
  `role` enum('student','admin') DEFAULT 'student',
  `admin_id` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `register_number`, `role`, `admin_id`, `created_at`) VALUES
(1, 'sreeh', 'sreeh@gmail.com', '$2y$10$GfwwbnhAU9.lQm3wZYK51uy.Qa6FiR4aIQpMQQaAstiWBxaErVr.C', '1300', 'student', NULL, '2025-03-30 12:00:02'),
(5, 'nived', 'nj@gmail.com', '$2y$10$4LfLEv5.kIOmrT3mVnFO5u2NJD5G3dJijFcG5BkeKz.9WjEEBhQvC', '1280', 'student', NULL, '2025-04-12 07:23:45'),
(6, 'Aiswarya', 'aisu@gmail.com', '$2y$10$PAvOBILmk1thnpB6zNL5Eu6o6OBEG0hblwaB6sbVgr5Wa9RXBRY1O', '1230', 'student', NULL, '2025-04-12 07:38:59'),
(7, 'Suresh', 'sura@gmail.com', '$2y$10$nYlrOg3AaZjymF9bthO8SeZdR7PtHAKqw9FEiOiOyVRhyM1FxIqye', '9000', 'admin', 'KTU3450', '2025-04-12 15:07:47'),
(8, 'Anagha U', 'anagha@gmail.com', '$2y$10$SfxD0.vNZNH8UM8KriqTg./1VGYaRuHih0QMTC4cn8CL2.u9DGxoi', '1235', 'student', NULL, '2025-04-14 16:25:52'),
(9, 'Ujwal', 'uju@gmail.com', '$2y$10$uRJEOGX5YWG8CV1MW.M.fuf3pmyaweZNbDAdW74uiVFSs4VY6M5Wi', '1305', 'student', NULL, '2025-04-14 17:02:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_verification`
--
ALTER TABLE `admin_verification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_id` (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pending_events`
--
ALTER TABLE `pending_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pyqs`
--
ALTER TABLE `pyqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `register_number` (`register_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_verification`
--
ALTER TABLE `admin_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pending_events`
--
ALTER TABLE `pending_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pyqs`
--
ALTER TABLE `pyqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pyqs`
--
ALTER TABLE `pyqs`
  ADD CONSTRAINT `pyqs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
