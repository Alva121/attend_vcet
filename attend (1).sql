-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2020 at 11:48 AM
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
(1, 'vtuoo1', '02:00:00', 'cor001', '2020-03-20 16:17:47'),
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
(1, 'cor001', 'tvtu001', 'course1', '00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'cor002', 'tvtu001', 'course2', '00:00:00', 0, '0000-00-00 00:00:00');

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
  `role` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `t_usn`, `name`, `dept`, `email`, `role`, `password`, `created_at`) VALUES
(1, 'tvtu001', 'tech1', 'cs', 'tech1@gmail.com', 'Teacher', '12345678', '2020-03-20 16:14:24'),
(2, 'tvtu002', 'tech2', 'cs', 'tech2@gmail.com', 'Teacher', '12345678', '2020-03-20 16:14:59');

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
  `role` varchar(50) NOT NULL DEFAULT 'Student',
  `password` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `usn`, `name`, `email`, `dept`, `role`, `password`, `created_at`) VALUES
(2, 'vtu002', 'std2', 'std2@gmail.com', 'cs', 'Student', '12345678', '2020-03-20 16:12:47'),
(1, 'vtuoo1', 'std1', 'std1@gmail.com', 'cs', 'Student', '12345678', '2020-03-20 16:11:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
