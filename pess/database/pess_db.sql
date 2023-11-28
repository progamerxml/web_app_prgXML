-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2022 at 02:57 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pess_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `allowance_list`
--

CREATE TABLE `allowance_list` (
  `payslip_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `amount` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allowance_list`
--

INSERT INTO `allowance_list` (`payslip_id`, `name`, `amount`) VALUES
(2, 'Gas Allowance', 1500),
(2, 'Rice', 500),
(2, 'Overtime', 540),
(3, 'Allowance 101', 1000),
(3, 'Allowance 102', 1500),
(3, 'Allowance 101', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `deduction_list`
--

CREATE TABLE `deduction_list` (
  `payslip_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `amount` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deduction_list`
--

INSERT INTO `deduction_list` (`payslip_id`, `name`, `amount`) VALUES
(2, 'PAGIBIG', 100),
(2, 'SSS', 300),
(3, 'Deduction 101', 1000),
(3, 'Deduction 102', 300),
(3, 'Deduction 103', 350);

-- --------------------------------------------------------

--
-- Table structure for table `department_list`
--

CREATE TABLE `department_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_list`
--

INSERT INTO `department_list` (`id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'IT Department', 'Information Technology Department', 1, 0, '2022-03-25 10:19:48', '2022-03-25 10:20:26'),
(2, 'HR Department', 'Human Resource Department', 1, 0, '2022-03-25 10:22:58', NULL),
(3, 'Marketing Department', 'Marketing Department', 1, 0, '2022-03-25 10:23:07', NULL),
(4, 'Accounting and Finance', 'Accounting and Finance Department', 1, 0, '2022-03-25 10:23:32', NULL),
(5, 'test', 'test', 1, 1, '2022-03-25 10:23:42', '2022-03-25 10:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `employee_list`
--

CREATE TABLE `employee_list` (
  `id` int(30) NOT NULL,
  `company_id` varchar(100) NOT NULL,
  `department_id` int(30) NOT NULL,
  `position_id` int(30) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `middle_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_list`
--

INSERT INTO `employee_list` (`id`, `company_id`, `department_id`, `position_id`, `first_name`, `middle_name`, `last_name`, `gender`, `email`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, '6231415', 1, 7, 'John', 'D', 'Smith', 'Male', 'jsmith231415@gmail.com', 1, 0, '2022-03-25 11:16:26', NULL),
(2, '10140715', 2, 1, 'Claire', 'C', 'Blake', 'Female', 'cblake6231415@gmail.com', 1, 0, '2022-03-25 11:24:05', NULL),
(3, '12345', 3, 3, 'Mark', 'T', 'Cooper', 'Male', 'mcooper@gmail.com', 0, 0, '2022-03-25 11:27:29', NULL),
(4, 'test', 2, 3, 'test', 'test', 'test', 'Male', 'test@tset', 0, 1, '2022-03-25 11:27:57', '2022-03-25 11:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_list`
--

CREATE TABLE `payroll_list` (
  `id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Monthly, 2= Semi-Monthly, 3= Daily',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll_list`
--

INSERT INTO `payroll_list` (`id`, `code`, `start_date`, `end_date`, `type`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, '20220315', '2022-03-01', '2022-03-15', 2, 1, 0, '2022-03-25 12:05:44', '2022-03-25 12:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `payslip_list`
--

CREATE TABLE `payslip_list` (
  `id` int(30) NOT NULL,
  `payroll_id` int(30) NOT NULL,
  `employee_id` int(30) NOT NULL,
  `days_present` float(10,1) NOT NULL,
  `days_absent` float(10,1) NOT NULL,
  `tardy_undertime` float(10,1) NOT NULL,
  `total_allowance` float NOT NULL DEFAULT 0,
  `total_deduction` float NOT NULL DEFAULT 0,
  `base_salary` float NOT NULL DEFAULT 0,
  `withholding_tax` float NOT NULL DEFAULT 0,
  `net` float NOT NULL DEFAULT 0,
  `file_path` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payslip_list`
--

INSERT INTO `payslip_list` (`id`, `payroll_id`, `employee_id`, `days_present`, `days_absent`, `tardy_undertime`, `total_allowance`, `total_deduction`, `base_salary`, `withholding_tax`, `net`, `file_path`, `date_created`, `date_updated`) VALUES
(2, 1, 1, 11.0, 0.0, 0.0, 2540, 400, 9000, 840, 10000, NULL, '2022-03-25 14:29:04', '2022-03-26 08:32:38'),
(3, 1, 2, 10.0, 1.0, 30.0, 4500, 1650, 25000, 0, 25435.2, NULL, '2022-03-25 17:02:41', '2022-03-26 08:23:57');

-- --------------------------------------------------------

--
-- Table structure for table `position_list`
--

CREATE TABLE `position_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position_list`
--

INSERT INTO `position_list` (`id`, `name`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Department Head', 1, 0, '2022-03-25 10:31:52', NULL),
(2, 'Office Clerk', 1, 0, '2022-03-25 10:32:01', NULL),
(3, 'Staff', 1, 0, '2022-03-25 10:32:26', NULL),
(4, 'Jr. Web Developer', 1, 0, '2022-03-25 10:34:04', NULL),
(5, 'Sr. Web Developer', 1, 0, '2022-03-25 10:34:11', NULL),
(6, 'PHP Developer', 1, 0, '2022-03-25 10:34:19', NULL),
(7, 'Full Stack Dev', 1, 0, '2022-03-25 10:34:38', NULL),
(8, 'test', 1, 0, '2022-03-25 10:35:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'XYZ Company Inc.'),
(6, 'short_name', 'Payslip - PHP'),
(11, 'logo', 'uploads/system-logo.png?v=1648173882'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/system-cover.png?v=1648173974');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/1624240500_avatar.png', NULL, 1, '2021-01-20 14:02:37', '2021-06-21 09:55:07'),
(10, 'Claire', 'Blake', 'cblake', '542d2760db6928e65bd10de7c16bb82c', 'uploads/avatar-10.png?v=1648021481', NULL, 2, '2022-03-23 15:44:41', '2022-03-23 15:44:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowance_list`
--
ALTER TABLE `allowance_list`
  ADD KEY `payslip_id` (`payslip_id`);

--
-- Indexes for table `deduction_list`
--
ALTER TABLE `deduction_list`
  ADD KEY `payslip_id` (`payslip_id`);

--
-- Indexes for table `department_list`
--
ALTER TABLE `department_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_list`
--
ALTER TABLE `employee_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `payroll_list`
--
ALTER TABLE `payroll_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payslip_list`
--
ALTER TABLE `payslip_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payroll_id` (`payroll_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `position_list`
--
ALTER TABLE `position_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department_list`
--
ALTER TABLE `department_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee_list`
--
ALTER TABLE `employee_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payroll_list`
--
ALTER TABLE `payroll_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payslip_list`
--
ALTER TABLE `payslip_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `position_list`
--
ALTER TABLE `position_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allowance_list`
--
ALTER TABLE `allowance_list`
  ADD CONSTRAINT `allowance_fk_payslip_id` FOREIGN KEY (`payslip_id`) REFERENCES `payslip_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `deduction_list`
--
ALTER TABLE `deduction_list`
  ADD CONSTRAINT `deduction_fk_payslip_id` FOREIGN KEY (`payslip_id`) REFERENCES `payslip_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `employee_list`
--
ALTER TABLE `employee_list`
  ADD CONSTRAINT `employee_fk_department_id` FOREIGN KEY (`department_id`) REFERENCES `department_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `employee_fk_position_id` FOREIGN KEY (`position_id`) REFERENCES `position_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `payslip_list`
--
ALTER TABLE `payslip_list`
  ADD CONSTRAINT `payslip_fk_payroll_id` FOREIGN KEY (`payroll_id`) REFERENCES `payroll_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
