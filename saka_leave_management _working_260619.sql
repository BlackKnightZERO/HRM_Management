-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2019 at 07:23 AM
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
(6, 'Admin'),
(7, 'Intern');

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
  `password` varchar(200) NOT NULL,
  `employee_role` tinyint(4) NOT NULL,
  `profile_pic_path` varchar(250) NOT NULL,
  `dept_head` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `RFID`, `name`, `department_id`, `designation_id`, `join_date`, `date_of_birth`, `blood_group`, `official_mobile_no`, `personal_mobile_no`, `official_email_1`, `official_email_2`, `password`, `employee_role`, `profile_pic_path`, `dept_head`) VALUES
(1, '', 'Arif Faysal', 5, 11, '2019-04-03', '1994-03-17', 'B+', '01670239024', '01670239024', 'ayon.arif.10@gmail.com', '', '$2y$10$IF.cSbPB/tb.dwMBJv1yyuXsYScpnKRNgKp7Z8szfWemFMULxF0tC', 1, 'http://192.168.88.83/CI_HRM/ProfilePicture/10897960_10205124039852336_5591500229351470726_n.jpg', 0),
(3, '', 'partha', 5, 25, '2019-04-09', '2019-04-22', 'o+', '0173345437', '', 'partha@gmail.com', '', '$2y$10$5vdAhrexQc4.mS4dW3MZMOjp17ExbxY.Ryvkf1DC72y2EZDq0IuQS', 0, 'http://192.168.88.83/CI_HRM/ProfilePicture/29258472_10214332586300242_720523085629457968_n1.jpg', 0),
(6, '', 'Shams Ahmed', 6, 31, '2018-09-14', '2019-06-20', 'A+', '723894234', '', 'sams@gmail.com', '', '$2y$10$6Stcy4.CqGL7LNzVpFuP8.UB3tKAmwWB0A.qexp5YjoZsOdSIfYjm', 1, 'http://192.168.88.83/CI_HRM/ProfilePicture/cool-anime-girl-profile-pictures-71.jpg', 0),
(7, '', 'Rafi Ahmed', 2, 9, '2018-05-10', '2019-06-10', '', '17238771298', '', 'rafi@gmail.com', '', '$2y$10$2CqlyPeE.xxqv.zp6SsRbu/qvCgX/biY62ohOqZOwsOJ8kl9PkuYu', 0, 'http://192.168.88.83/CI_HRM/ProfilePicture/images.jpg', 0),
(9, '', 'Akib Zaman', 5, 11, '2019-05-09', '2019-06-10', 'B+', '01672323232', '01813456567', 'akib@gmail.com', 'akib2@gmail.com', '$2y$10$F9E9YAT0kimU86K1vJE/Zu9NQAk4gJ7x15HtY/OMJ0Ci3bmYQPkoC', 0, 'http://[::1]/CI_HRM/ProfilePicture/character1.gif', 0),
(12, '', 'sabu babu', 5, 6, '2019-05-01', '2019-05-04', 'B+', '0191678432', '65345184000', 'sabu@gmail.com', 'ssrhfkj@gmail.com', '$2y$10$nq4t8yvmWA/stHlvzbUnYuSadx/VytqXO5KAO.CdfakavuiWME0H2', 0, 'http://192.168.88.83/CI_HRM/ProfilePicture/FB_IMG_1558345960467.jpg', 0),
(13, '', 'moon', 5, 3, '2019-03-21', '2019-06-20', 'B+', '01733237878', '18927391', 'moon@gmail.com', '', '$2y$10$6.kuGJRR9..ucwi/L90dp.q51CEscNPxsx4nfdfC7cQbZWH01GRX2', 0, 'http://192.168.88.83/CI_HRM/ProfilePicture/dc6rlq7-70ae3ef4-0c5c-468d-bf6c-1eb4becf62ae1.gif', 1),
(14, '', 'rifat mabin', 1, 3, '2019-05-02', '2019-06-10', '', '0181343434', '', 'rifat@gmail.com', '', '$2y$10$M6IgUhEUA7bMcBdVPgDQjeacuPNJZsgUJiJj7pBhCWyHpEeRJWJii', 0, 'http://192.168.88.83/CI_HRM/ProfilePicture/QueenDaenerysTargaryenIronThrone_PNG.png', 1),
(15, '', 'Nusrat Jahan Mimmy', 1, 11, '2019-06-02', '2019-06-13', 'A+', '0168505050', '', 'mimmy@gmail.com', '', '$2y$10$gscFlL054BtSPAR7MnkMqOug2UMvL1yC/G7YS9L/xYQ6EIvRTR3Cq', 0, 'http://[::1]/CI_HRM/ProfilePicture/unnamed.png', 0);

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
(1, 3, 'Compensatory Leave', '2019-05-06', '2019-05-08', 'Business Travel to Thiland', 2, 0, '', '', '0000-00-00', '0000-00-00'),
(2, 3, 'Sick Leave', '2019-05-06', '2019-05-09', 'Food Posioning', 2, 0, '', '', '0000-00-00', '0000-00-00'),
(3, 7, 'Sick Leave', '2019-05-15', '2019-05-17', 'High Fever', 0, 0, '', '', '0000-00-00', '0000-00-00'),
(5, 9, 'Compensatory Leave', '2019-05-18', '2019-05-20', 'compensatory leave for  17 May work', 0, 0, '', '', '0000-00-00', '0000-00-00'),
(7, 9, 'Sick Leave', '2019-05-20', '2019-05-21', 'sick fever', 2, 0, '', '', '0000-00-00', '0000-00-00'),
(10, 12, 'Annual Leave', '2019-05-22', '2019-05-23', 'fjxkgzhfclh', 1, 0, '', '', '0000-00-00', '2019-05-26'),
(11, 3, 'Sick Leave', '2019-05-22', '2019-05-24', 'Allergy fever', 1, 0, '', '', '0000-00-00', '0000-00-00'),
(12, 3, 'Sick Leave', '2019-05-22', '2019-05-24', 'Allergy fever', 1, 0, '', '', '0000-00-00', '0000-00-00'),
(13, 13, 'Annual Leave', '2019-05-24', '2019-05-25', 'checking reason', 2, 0, '', '', '0000-00-00', '2019-05-26'),
(14, 3, 'Sick Leave', '2019-05-22', '2019-05-24', 'sickness', 1, 0, '', '', '0000-00-00', '2019-05-26'),
(15, 13, 'Annual Leave', '2019-05-23', '2019-05-24', 'Taking annual leave', 1, 0, '', '', '0000-00-00', '0000-00-00'),
(16, 13, 'Compensatory Leave', '2019-05-23', '2019-05-25', 'Moon@', 1, 0, '', '', '0000-00-00', '2019-06-12'),
(19, 3, 'Compensatory Leave', '2019-05-26', '2019-05-27', 'No Reason To Be Specified !', 2, 0, '', '', '2019-05-26', '2019-05-26'),
(20, 13, 'Annual Leave', '2019-05-26', '2019-05-28', 'To Meet Black Knight Zero', 0, 0, '', '', '2019-05-26', '0000-00-00'),
(22, 9, 'Sick Leave', '2019-05-28', '2019-05-29', 'Sickness', 2, 0, '', '', '2019-05-27', '2019-06-12'),
(23, 9, 'Sick Leave', '2019-05-29', '2019-05-30', 'Broken Leg', 0, 0, '', '', '2019-05-27', '0000-00-00'),
(24, 9, 'Sick Leave', '2019-06-10', '2019-06-14', 'Jaundice Sickness', 0, 0, '', '', '2019-06-10', '2019-06-15'),
(25, 3, 'Sick Leave', '2019-06-10', '2019-06-13', 'Head Injury', 2, 0, '', '', '2019-06-10', '2019-06-12'),
(26, 13, 'Sick Leave', '0001-01-01', '0001-01-01', 'sick', 0, 0, '', '', '2019-06-12', '2019-06-12'),
(27, 3, 'Sick Leave', '2019-06-12', '2019-06-14', 'fever', 2, 0, '', '', '2019-06-12', '2019-06-12'),
(28, 12, 'Annual Leave', '2019-06-13', '2019-06-17', 'Want to take the full annual leave', 1, 0, '', '', '2019-06-13', '2019-06-13'),
(29, 3, 'Sick Leave', '2019-06-15', '2019-06-17', 'no rsn', 0, 0, '', '', '2019-06-15', '2019-06-17'),
(30, 9, 'Sick Leave', '2019-06-22', '2019-06-25', 'Tooth Extraction', 1, 0, '', '', '2019-06-22', '2019-06-22');

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
(1, 'Taking a break', '2019-05-06', 1, 'Our company is going on a tour at the end of June', ''),
(2, 'Checking Title', '2019-05-06', 1, 'Checking Details', ''),
(3, 'Checking Title', '2019-05-06', 1, 'Checking Details', ''),
(4, 'Minimum Leave', '2019-05-06', 1, 'Not more than 3 days leave is allowed', ''),
(5, 'Checking TItle', '2019-05-06', 1, 'Checking Details', ''),
(6, 'Checking new Title', '2019-05-07', 1, '12.28PM', ''),
(7, '7/5/19', '2019-05-07', 1, '12.30PM', ''),
(8, 'Leave Types', '2019-05-08', 1, 'Our Company provides 3 types of leaves to the employees. \r\n1. Sick leave\r\n2. annual leave\r\n3. compensatory leave\r\n\r\nwe have 20 annual leaves & 2 sick leaves per month', ',3,7,9,11'),
(9, 'Ramadan Office Time', '2019-05-12', 1, 'Ramdan Office hour for Saka as follows :\r\nOffice Start -> 09:00AM\r\nOffice End -> 04:00PM', ',9,11,12,13'),
(10, 'Employee Salary Date', '2019-05-12', 1, 'Employees are requested to collect there salary from Accounts from 28th-30th of current month.', ',4,7,3,9,11,12,14,15,13'),
(11, 'Microsoft Outlook Error', '2019-05-13', 6, 'Its to be noted many employees are facing problems in MS Outlook outgoing email errors. Do this simple change in setting -> \r\nOpen the Account Settings dialog; ...\r\nSelect the Data Files tab.\r\nSelect the mailbox for which you want to reset the cache. ...\r', ',4,9,10,11,3,13'),
(12, 'Scanning Technique', '2019-05-13', 1, 'The entrance laptop has the main scanner. \r\nSteps :\r\n1. Put the page inside scanner \r\n2. Open the laptop beside the scanner \r\n3. On Desktop Open Adobe Acrobat 5.0 \r\n4. From top bar go to File->import->scan\r\n5. Wait for completing scan\r\n6. From top bar go ', ',7,11,9,12,14,13'),
(13, 'Sales & Service team(updated)', '2019-05-20', 6, 'Its is to notify the sales & service employees to inform specifically their gps attendance & site image upload to be done correctly everyday.', ',9,11,13');

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
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notice_submitter_id` (`notice_submitter_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
