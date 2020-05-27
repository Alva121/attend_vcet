-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2020 at 07:47 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attend`
--

-- --------------------------------------------------------

--
-- Table structure for table `attenance`
--

CREATE TABLE `attenance` (
  `id` int(11) NOT NULL,
  `s_id` varchar(100) NOT NULL,
  `hours` time NOT NULL,
  `course` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attenance`
--

INSERT INTO `attenance` (`id`, `s_id`, `hours`, `course`, `created_at`) VALUES
(1, 'vtuoo1', '01:00:00', 'cor001', '2020-03-20 16:17:47'),
(2, 'vtuoo1', '02:00:00', 'cor001', '2020-03-20 16:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `c_id` varchar(50) NOT NULL,
  `f_id` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `total_hours` time NOT NULL,
  `total_class` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `c_id`, `f_id`, `course`, `total_hours`, `total_class`, `created_at`) VALUES
(1, 'cor001', 'tvtu001', 'course1', '02:00:00', 1, '0000-00-00 00:00:00'),
(2, 'cor002', 'tvtu001', 'course2', '04:00:00', 2, '0000-00-00 00:00:00'),
(3, 'cor003', 'tvtu002', 'course3', '00:00:00', 0, '2020-05-22 15:47:50');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `t_usn` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `t_usn`, `name`, `dept`, `email`, `phone`, `role`, `password`, `created_at`) VALUES
(3, 'avtu001', 'admin', 'office', 'admin@gmail.com', '123456789', 'Admin', '12345678', '2020-03-21 11:10:34'),
(4, 'tvcet003', 'Kin', 'OFFICE', 'alva@gmail.com', '1234567890', 'Admin', 'tvcet0031234567890', '2020-05-22 15:30:55'),
(6, 'tvcet004', 'Manish', 'CS', 'manish@gmail.com', '12345678', 'Teacher', 'tvcet00412345678', '2020-05-27 11:10:42'),
(1, 'tvtu001', 'tech1', 'cs', 'tech1@gmail.com', '123456789', 'Teacher', '12345678', '2020-03-20 16:14:24'),
(2, 'tvtu002', 'tech2', 'cs', 'tech2@gmail.com', '123456789', 'Teacher', '12345678', '2020-03-20 16:14:59');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `usn` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `sem` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'Student',
  `password` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `usn`, `name`, `email`, `dept`, `sem`, `role`, `password`, `created_at`, `phone`) VALUES
(3, 'vcet003', 'Kin', 'kin@gmail.com', 'cs', '3st', 'Student', 'vcet003cs', '2020-03-23 10:13:32', '123456789'),
(2, 'vtu002', 'std2', 'std2@gmail.com', 'cs', '1st', 'Student', '12345678', '2020-03-20 16:12:47', '123456789'),
(1, 'vtuoo1', 'std1', 'std1@gmail.com', 'cs', '1st', 'Student', '12345678', '2020-03-20 16:11:00', '123456789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attenance`
--
ALTER TABLE `attenance`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `s_id` (`s_id`),
  ADD KEY `course` (`course`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `f_id` (`f_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`t_usn`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`usn`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attenance`
--
ALTER TABLE `attenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attenance`
--
ALTER TABLE `attenance`
  ADD CONSTRAINT `attenance_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `user` (`usn`),
  ADD CONSTRAINT `attenance_ibfk_2` FOREIGN KEY (`course`) REFERENCES `class` (`c_id`);

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `staff` (`t_usn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
