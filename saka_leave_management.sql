-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2019 at 02:26 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
(2, 'Instrument'),
(3, 'Raw Material & Packaging'),
(4, 'Accounts'),
(5, 'IT'),
(6, 'Admin');

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
(2, 'Managing Director'),
(3, 'Director'),
(4, 'Sr. Engineer, Project'),
(5, 'Asst. Engineer, Project'),
(6, 'Engineer, Project'),
(7, 'Deputy Manager, Sales & Marketing'),
(8, 'Engineer, Technical Sales'),
(9, 'Asst. Manager, Technical Sales'),
(11, 'Engineer'),
(12, 'Asst. Manager, After Market'),
(13, 'Sr. Engineer, After Market'),
(14, 'Asst. Engineer, After Market'),
(15, 'Engineer, After Market'),
(16, 'Process Technologist'),
(17, 'Software Engineer, After Market'),
(19, 'Asst. Manager, Sales'),
(20, 'Sr. Engineer, Technical Sales'),
(21, 'Engineer, Sales & Service'),
(22, 'Head, Instrument Division'),
(23, 'Executive, Back Office Support'),
(24, 'Executive, Sales & Marketing'),
(25, 'Asst. Engineer'),
(26, 'Sr. Asst. Manager, After Market'),
(31, 'Executive, Application'),
(32, 'Executive, Sales'),
(33, 'Deputy Manager, Accounts'),
(34, 'Sr. Executive, Accounts'),
(35, 'Executive, Accounts'),
(36, 'Asst.Manager, Audit & Accounts');

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
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `RFID`, `name`, `department_id`, `designation_id`, `join_date`, `date_of_birth`, `blood_group`, `official_mobile_no`, `personal_mobile_no`, `official_email_1`, `official_email_2`, `password`) VALUES
(1, '', 'Arif Faysal', 5, 6, '2019-04-03', '1994-03-17', 'B+', '01670239024', '01670239024', 'ayon.arif.10@gmail.com', '', '$2y$10$6fBxcFHa8hrSBG/CRFkvcONEvJ6t3uaPaB3GzhDbjGMJ3REpkyX5a'),
(3, '', 'partha', 5, 25, '2019-04-09', '2019-04-01', '', '', '', 'partha@gmail.com', '', '$2y$10$6fBxcFHa8hrSBG/CRFkvcONEvJ6t3uaPaB3GzhDbjGMJ3REpkyX5a');

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
  `current_status_from_dept_head` tinyint(4) NOT NULL,
  `current_status_from_top` tinyint(4) NOT NULL,
  `note_from_dept_head` varchar(200) NOT NULL,
  `note_from_top` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
