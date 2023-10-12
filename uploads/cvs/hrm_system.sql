-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2023 at 04:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrm_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`) VALUES
(1, 'mbongz@ebongs.com', '1234', '2023-08-30 14:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `appraisals_view`
--

CREATE TABLE `appraisals_view` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `comms` int(5) NOT NULL,
  `punct` int(5) NOT NULL,
  `tech` int(5) NOT NULL,
  `opp` int(5) NOT NULL,
  `coll` int(5) NOT NULL,
  `rel` int(5) NOT NULL,
  `comm` varchar(200) NOT NULL,
  `overall` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appraisals_view`
--

INSERT INTO `appraisals_view` (`ID`, `name`, `comms`, `punct`, `tech`, `opp`, `coll`, `rel`, `comm`, `overall`) VALUES
(0, '1', 0, 4, 4, 4, 0, 4, 'good ', 20);

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `clock_in` time NOT NULL,
  `clock_out` time NOT NULL,
  `total_work` float NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `create_by` varchar(30) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT NULL,
  `modified_by` varchar(30) DEFAULT NULL,
  `modified_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `create_by`, `create_date`, `modified_by`, `modified_date`) VALUES
(1, 'IT', 1, 'Admin', '2017-05-24 06:37:11', '', '2017-05-05 18:00:00'),
(2, 'Coaching', 1, 'Admin', '2017-05-24 06:37:29', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `gender` char(6) NOT NULL,
  `email` varchar(30) NOT NULL,
  `department` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `position` varchar(50) NOT NULL,
  `usertype` varchar(1) NOT NULL,
  `address` varchar(100) NOT NULL,
  `summary` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `password`, `gender`, `email`, `department`, `phone`, `position`, `usertype`, `address`, `summary`) VALUES
(1, 'Mbongeni', 'Moyo', '1234', 'Male', 'mbongz@ebongs.com', 'IT', '0779575788', 'Senior Manager', 'a', '34 Arundel Schools Road', 'CEO and GP');

-- --------------------------------------------------------

--
-- Table structure for table `employee_designations`
--

CREATE TABLE `employee_designations` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `created_by` varchar(30) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT NULL,
  `modified_by` varchar(30) DEFAULT NULL,
  `modified_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `employee_designations`
--

INSERT INTO `employee_designations` (`id`, `title`, `status`, `created_by`, `create_date`, `modified_by`, `modified_date`) VALUES
(1, 'Teacher', 1, 'Admin', '2017-05-24 06:36:17', '', '2017-05-24 06:36:17'),
(2, 'Programmer', 1, 'Admin', '2017-05-03 18:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_leavs`
--

CREATE TABLE `employee_leavs` (
  `id` int(11) NOT NULL,
  `leave_id` int(11) NOT NULL,
  `total_leave_yarly` int(11) NOT NULL,
  `deducated_leav` int(11) NOT NULL,
  `remaining_leav` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modfied_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `item` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holiday_informations`
--

CREATE TABLE `holiday_informations` (
  `id` int(11) NOT NULL,
  `holiday_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `types` varchar(30) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modfied_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `holydays`
--

CREATE TABLE `holydays` (
  `id` int(11) NOT NULL,
  `attendace_id` int(11) NOT NULL,
  `month` date NOT NULL,
  `day` date NOT NULL,
  `year` date NOT NULL,
  `description` varchar(155) NOT NULL,
  `status` int(11) NOT NULL,
  `crated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `employee` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL,
  `leav_to` date NOT NULL,
  `leav_from` date NOT NULL,
  `total_leav` int(11) NOT NULL,
  `staus` varchar(20) NOT NULL DEFAULT '',
  `comments` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `employee`, `type`, `leav_to`, `leav_from`, `total_leav`, `staus`, `comments`) VALUES
(1, 'Bernard Gwatura', 'Annual', '0000-00-00', '2023-08-10', 0, 'Approved', 'hfhhf');

-- --------------------------------------------------------

--
-- Table structure for table `live_events`
--

CREATE TABLE `live_events` (
  `id` int(11) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `insert_by` varchar(30) NOT NULL,
  `insert_date` timestamp NULL DEFAULT NULL,
  `update_by` varchar(30) NOT NULL,
  `update_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `live_events`
--

INSERT INTO `live_events` (`id`, `subject`, `event_date`, `event_time`, `description`, `status`, `insert_by`, `insert_date`, `update_by`, `update_date`) VALUES
(1, 'Event', '2017-05-03', '00:17:00', 'sdfsdfsdf', 1, 'sxssdsa', '2017-05-29 18:00:00', '', NULL),
(2, 'Live Event', '2017-05-06', '12:59:00', 'dfgfgfg', 0, 'admin', '2017-05-23 15:03:11', '', NULL),
(3, 'Mitting', '2017-05-13', '12:59:00', 'xcvzxcvc', 1, 'admin', '2017-05-23 15:04:01', '', NULL),
(4, 'Outgoing', '2017-05-25', '12:59:00', 'gjhygjhjhhgjhjh', 1, 'admin', '2017-05-24 04:04:43', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `notice_date` date NOT NULL,
  `notice_time` time NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `insert_by` varchar(30) NOT NULL,
  `insert_date` timestamp NULL DEFAULT NULL,
  `update_by` varchar(30) NOT NULL,
  `update_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `subject`, `notice_date`, `notice_time`, `description`, `status`, `insert_by`, `insert_date`, `update_by`, `update_date`) VALUES
(6, 'Board Mitting', '2017-05-22', '10:01:00', 'fh htyt rtyt t rt', 1, 'admin', '2017-05-21 20:00:50', '', NULL),
(7, '', '0000-00-00', '00:00:00', '', 1, 'admin', '2017-05-23 14:57:17', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `renum`
--

CREATE TABLE `renum` (
  `renum_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `salary` int(11) NOT NULL,
  `allowances` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_designations`
--
ALTER TABLE `employee_designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_leavs`
--
ALTER TABLE `employee_leavs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holiday_informations`
--
ALTER TABLE `holiday_informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holydays`
--
ALTER TABLE `holydays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_events`
--
ALTER TABLE `live_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_designations`
--
ALTER TABLE `employee_designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_leavs`
--
ALTER TABLE `employee_leavs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holiday_informations`
--
ALTER TABLE `holiday_informations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holydays`
--
ALTER TABLE `holydays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_events`
--
ALTER TABLE `live_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
