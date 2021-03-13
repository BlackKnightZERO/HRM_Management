-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2020 at 08:19 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saka_leave_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `clock_in` varchar(100) DEFAULT NULL,
  `clock_out` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `clock_in`, `clock_out`, `created_at`, `updated_at`, `date`, `status`) VALUES
(27, 16, '12:16:51', '12:17:01', NULL, NULL, '2020-11-22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_name`) VALUES
(1, 'Machinery'),
(5, 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(11) NOT NULL,
  `designation_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `designation_name`) VALUES
(1, 'Associate Director'),
(37, 'executive IT');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(20) NOT NULL,
  `RFID` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `department_id` int(20) NOT NULL,
  `designation_id` int(20) NOT NULL,
  `join_date` date NOT NULL,
  `date_of_birth` date NOT NULL,
  `blood_group` varchar(20) NOT NULL,
  `official_mobile_no` varchar(20) NOT NULL,
  `personal_mobile_no` varchar(20) NOT NULL,
  `official_email_1` varchar(50) NOT NULL,
  `official_email_2` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `employee_role` tinyint(4) NOT NULL,
  `profile_pic_path` varchar(250) NOT NULL,
  `dept_head` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `RFID`, `name`, `department_id`, `designation_id`, `join_date`, `date_of_birth`, `blood_group`, `official_mobile_no`, `personal_mobile_no`, `official_email_1`, `official_email_2`, `password`, `employee_role`, `profile_pic_path`, `dept_head`) VALUES
(3, '', 'Durbar Hore Partha', 5, 37, '2018-11-01', '0000-00-00', '', '01706926920', '', 'admin@gmail.com', '', '$2y$12$pAnFfpiaGCD/vrtaftwIAeNeEkyeTY.UqqULxxJU3I3Zr/ROlyqlW', 1, 'http://192.168.88.83/CI_HRM/ProfilePicture/default.png', 1),
(16, '', 'ayon', 1, 1, '2020-11-19', '0000-00-00', '', '0167234234', '', 'ayon@gmail.com', '', '$2y$10$b7cJNnsFaOLw.pfQAA5bPudIugOQarkQG5MKktnnCrSrWOng2.Uxa', 0, 'http://192.168.88.83/CI_HRM/ProfilePicture/default.png', 1),
(17, '', 'poojarani', 5, 37, '2020-11-14', '0000-00-00', '', '6374280798', '', 'poojaranimewasingh@gmail.com', '', '$2y$10$76InzCnkYQyYSRCbxpZmS.ZE22beC5AbGcjYMhSjXTXAvwmuiBX5i', 0, 'http://192.168.88.83/CI_HRM/ProfilePicture/default.png', 0),
(19, '', 'sam', 5, 37, '2020-11-22', '0000-00-00', '', '6374280798', '', 'sam@gmail.com', '', '$2y$10$l.prklZ05q/Bq/8h8sNyHurAcIQI5WgDzuOnJWLajLMyl.v0khKdi', 0, 'http://192.168.88.83/CI_HRM/ProfilePicture/default.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `leave_type` varchar(30) NOT NULL,
  `leave_start` date NOT NULL,
  `leave_end` date NOT NULL,
  `leave_reason` varchar(300) NOT NULL,
  `current_status_from_dept_head` int(11) NOT NULL,
  `current_status_from_top` tinyint(4) NOT NULL,
  `note_from_dept_head` varchar(200) NOT NULL,
  `note_from_top` varchar(200) NOT NULL,
  `leave_requested_on` date NOT NULL,
  `leave_approved_denied_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `employee_id`, `leave_type`, `leave_start`, `leave_end`, `leave_reason`, `current_status_from_dept_head`, `current_status_from_top`, `note_from_dept_head`, `note_from_top`, `leave_requested_on`, `leave_approved_denied_on`) VALUES
(31, 17, 'Sick Leave', '2020-11-16', '2020-11-23', 'fever', 2, 0, '', '', '2020-11-21', '2020-11-21'),
(32, 17, 'Sick Leave', '2020-11-22', '2020-11-23', 'fever', 1, 0, '', '', '2020-11-21', '2020-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `notice_title` varchar(100) NOT NULL,
  `notice_post_date` date NOT NULL,
  `notice_submitter_id` int(11) NOT NULL,
  `notice_description` varchar(255) NOT NULL,
  `notice_liked_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `notice_title`, `notice_post_date`, `notice_submitter_id`, `notice_description`, `notice_liked_id`) VALUES
(15, 'self emp', '2020-11-21', 3, 'tomorrow is  holiday', ',17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `designation_id` (`designation_id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notice_submitter_id` (`notice_submitter_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`designation_id`) REFERENCES `designation` (`id`);

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `notice_ibfk_1` FOREIGN KEY (`notice_submitter_id`) REFERENCES `employee` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
