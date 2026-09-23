-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2026 at 03:39 PM
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
-- Database: `clincore_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `department_tab`
--

CREATE TABLE `department_tab` (
  `sn` int(11) NOT NULL,
  `department_id` varchar(255) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `describtion` varchar(255) NOT NULL,
  `status_id` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_tab`
--

INSERT INTO `department_tab` (`sn`, `department_id`, `department_name`, `describtion`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'DEPARTMENT20260923025713', 'General Medicine', 'Healthcare Services', 'Active', '2026-09-23 05:57:13', '2026-09-23 12:57:13'),
(2, 'DEPARTMENT20260923025853', 'Cardiology', 'Specializes in the diagnosis and treatment of heart-related conditions', 'Active', '2026-09-23 05:58:53', '2026-09-23 12:58:53'),
(3, 'DEPARTMENT20260923030014', 'Pediatrics', 'Dedicated to the health and well-being of children', 'Active', '2026-09-23 06:00:14', '2026-09-23 13:00:14'),
(4, 'DEPARTMENT20260923030206', 'Dermatology', 'Focuses on the treatment of skin conditions', 'Active', '2026-09-23 06:02:06', '2026-09-23 13:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_tab`
--

CREATE TABLE `doctor_tab` (
  `sn` int(11) NOT NULL,
  `doctor_id` varchar(100) NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `specialist` varchar(255) NOT NULL,
  `department_id` varchar(255) NOT NULL,
  `status_id` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_tab`
--

CREATE TABLE `patient_tab` (
  `sn` int(11) NOT NULL,
  `patient_id` varchar(100) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `treatment` varchar(255) NOT NULL,
  `password_otp` varchar(255) NOT NULL,
  `doctor_id` varchar(255) NOT NULL,
  `room_id` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_tab`
--

CREATE TABLE `role_tab` (
  `sn` int(11) NOT NULL,
  `role_id` varchar(100) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_tab`
--

CREATE TABLE `room_tab` (
  `sn` int(11) NOT NULL,
  `room_id` varchar(100) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `capacity` varchar(255) DEFAULT NULL,
  `status_id` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status_tab`
--

CREATE TABLE `status_tab` (
  `sn` int(11) NOT NULL,
  `status_id` varchar(100) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_tab`
--

INSERT INTO `status_tab` (`sn`, `status_id`, `status_name`, `created_at`, `updated_at`) VALUES
(1, 'A', 'Active', '2026-09-21 06:23:33', '2026-09-21 13:23:33'),
(2, 'I', 'Inactive', '2026-09-21 06:23:33', '2026-09-21 13:23:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department_tab`
--
ALTER TABLE `department_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `doctor_tab`
--
ALTER TABLE `doctor_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `patient_tab`
--
ALTER TABLE `patient_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `role_tab`
--
ALTER TABLE `role_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `room_tab`
--
ALTER TABLE `room_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `status_tab`
--
ALTER TABLE `status_tab`
  ADD PRIMARY KEY (`sn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department_tab`
--
ALTER TABLE `department_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctor_tab`
--
ALTER TABLE `doctor_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_tab`
--
ALTER TABLE `patient_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_tab`
--
ALTER TABLE `role_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_tab`
--
ALTER TABLE `room_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_tab`
--
ALTER TABLE `status_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
