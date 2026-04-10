-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2026 at 02:26 PM
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
-- Database: `brgy_poblacion_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` enum('Scheduled','Completed','Cancelled') DEFAULT 'Scheduled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `resident_id`, `request_id`, `appointment_date`, `appointment_time`, `status`, `created_at`) VALUES
(1, 1, 1, '2026-04-13', '09:00:00', 'Completed', '2026-04-10 03:44:43'),
(2, 1, 1, '2026-04-20', '09:00:00', 'Completed', '2026-04-10 05:21:01'),
(3, 2, 2, '2026-04-13', '14:00:00', 'Cancelled', '2026-04-10 05:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `clearance_requests`
--

CREATE TABLE `clearance_requests` (
  `id` int(11) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `tracking_no` varchar(20) NOT NULL,
  `resident_name` varchar(100) NOT NULL,
  `document_type` varchar(100) DEFAULT NULL,
  `contact_no` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `status` enum('Pending','Processing','Ready for Pickup','Released') DEFAULT 'Pending',
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verification_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clearance_requests`
--

INSERT INTO `clearance_requests` (`id`, `resident_id`, `tracking_no`, `resident_name`, `document_type`, `contact_no`, `email`, `purpose`, `status`, `applied_at`, `updated_at`, `verification_date`) VALUES
(1, 1, 'BOP-2026-8336', 'Shaina Jane Benosa Tanguan', 'Barangay Clearance', '09534178426', 'shaynatanguan8@gmail.com', 'sdsgsfsdfsfdsdf', 'Ready for Pickup', '2026-04-10 03:23:36', '2026-04-10 05:25:19', NULL),
(2, 2, 'BOP-2026-9049', 'User Resident', 'Barangay Clearance', '09534178426', 'user_resident@gmail.com', NULL, 'Processing', '2026-04-10 05:44:03', '2026-04-10 05:45:01', NULL),
(3, 2, 'BOP-2026-3112', 'User Resident', 'Barangay ID', '09123456789', 'user_resident@gmail.com', ': ', 'Pending', '2026-04-10 05:53:44', '2026-04-10 05:53:44', NULL),
(4, 2, 'BOP-2026-2174', 'User Resident', 'Barangay ID', '09123456789', 'user_resident@gmail.com', 'asdasd', 'Pending', '2026-04-10 05:55:27', '2026-04-10 05:55:27', NULL),
(5, 2, 'BOP-2026-4899', 'User Resident', 'Barangay Clearance', '09534178426', 'user_resident@gmail.com', 'qwwertrtytui', 'Ready for Pickup', '2026-04-10 06:02:09', '2026-04-10 12:22:13', NULL),
(6, 3, 'BOP-2026-3406', 'Example User', 'Certificate of Indigency', '09534178426', 'shainajane0102@gmail.com', 'Medical Assisstance', 'Ready for Pickup', '2026-04-10 12:23:45', '2026-04-10 12:23:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `full_name`, `email`, `password`, `contact_no`, `address`, `created_at`) VALUES
(1, 'Shaina Jane Benosa Tanguan', 'shaynatanguan8@gmail.com', 'shaina@123', NULL, NULL, '2026-04-10 02:58:37'),
(2, 'User Resident', 'user_resident@gmail.com', 'user@123', NULL, NULL, '2026-04-10 05:43:26'),
(3, 'Example User', 'shainajane0102@gmail.com', 'shainajane', NULL, NULL, '2026-04-10 12:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff') NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `full_name`, `created_at`) VALUES
(1, 'admin', '12345', 'admin', 'Shaina Jane Tanguan', '2026-04-10 02:32:41'),
(2, 'staff_user', '12345', 'staff', 'Barangay Clerk', '2026-04-10 02:32:41'),
(3, 'staff_01', 'staff101', 'staff', 'Staff user', '2026-04-10 02:47:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_id` (`resident_id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `clearance_requests`
--
ALTER TABLE `clearance_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tracking_no` (`tracking_no`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clearance_requests`
--
ALTER TABLE `clearance_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`request_id`) REFERENCES `clearance_requests` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
