-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 04:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theraaid`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `message_text` text NOT NULL,
  `attachment_path` varchar(255) DEFAULT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `recipient_id`, `message_text`, `attachment_path`, `sent_at`, `is_read`) VALUES
(1, 53, 54, 'Hey, how\'s it going?', NULL, '2024-10-19 08:13:39', 1),
(2, 54, 53, 'I\'m good! How about you?', NULL, '2024-10-19 08:13:39', 1),
(3, 53, 54, 'Doing well, thanks!', NULL, '2024-10-19 08:13:39', 0),
(4, 53, 54, 'Check out this document.', '/attachments/doc1.pdf', '2024-10-19 08:13:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointment`
--

CREATE TABLE `tbl_appointment` (
  `appointment_id` int(11) NOT NULL,
  `num_of_session` int(11) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `is_aggreed` tinyint(1) NOT NULL,
  `date_accepted` date NOT NULL,
  `therapists_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `rate` float NOT NULL,
  `Date_creadted` timestamp NOT NULL DEFAULT current_timestamp(),
  `schedle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_appointment`
--

INSERT INTO `tbl_appointment` (`appointment_id`, `num_of_session`, `payment_type`, `start_date`, `is_aggreed`, `date_accepted`, `therapists_id`, `patient_id`, `status`, `rate`, `Date_creadted`, `schedle_id`) VALUES
(32, 10, 'PC', '2024-10-21', 1, '0000-00-00', 17, 21, 'On-Going', 1000, '2024-10-21 10:34:01', 173);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_notifications`
--

INSERT INTO `tbl_notifications` (`notification_id`, `user_id`, `appointment_id`, `type`, `is_read`, `created_at`) VALUES
(24, 54, 29, 'Pending', NULL, '2024-10-14 00:17:35'),
(25, 53, 29, 'Therapists Have Responded to your request', NULL, '2024-10-14 03:58:18'),
(26, 54, 30, 'Pending', NULL, '2024-10-14 05:31:35'),
(27, 54, 31, 'Pending', NULL, '2024-10-16 00:25:58'),
(28, 54, 32, 'Pending', NULL, '2024-10-21 18:34:01'),
(29, 53, 32, 'Therapists Have Responded to your request', NULL, '2024-10-21 21:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient`
--

CREATE TABLE `tbl_patient` (
  `patient_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `P_case` varchar(50) NOT NULL,
  `case_desc` varchar(200) NOT NULL,
  `City` varchar(100) NOT NULL,
  `barangay` varchar(200) NOT NULL,
  `assement_photo` varchar(500) NOT NULL,
  `mid_hisotry_photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_patient`
--

INSERT INTO `tbl_patient` (`patient_id`, `user_id`, `P_case`, `case_desc`, `City`, `barangay`, `assement_photo`, `mid_hisotry_photo`) VALUES
(21, 53, 'Case 2,Case 22,Back pain,Spine injury', 'Testing', ' Mandaue City', 'Banilad', '670ba59db5290.jpg,670ba59db5718.jpg', '670ba59db5a03.jpg,670ba59db5d1a.jpg,670ba59db5f69.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_paid` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `appointment_id`, `amount`, `status`, `date_paid`) VALUES
(34, 32, 100, 'Paid', '2024-10-21 22:25:04'),
(35, 32, 1000, 'Paid', '2024-10-21 22:25:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reminder`
--

CREATE TABLE `tbl_reminder` (
  `reminder_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `reminder_date` varchar(200) NOT NULL,
  `reminder_messsage` varchar(250) NOT NULL,
  `reminder_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reminder`
--

INSERT INTO `tbl_reminder` (`reminder_id`, `appointment_id`, `reminder_date`, `reminder_messsage`, `reminder_status`) VALUES
(3, 32, '2024-10-21,2024-10-23,2024-10-25,2024-10-28,2024-10-30,2024-11-01,2024-11-04,2024-11-06,2024-11-08,2024-11-11', 'You Have An appointment Today', 'unread'),
(4, 32, '2024-10-21,2024-10-23,2024-10-25,2024-10-28,2024-10-30,2024-11-01,2024-11-04,2024-11-06,2024-11-08,2024-11-11', 'You Have An appointment Today', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sched`
--

CREATE TABLE `tbl_sched` (
  `shed_id` int(11) NOT NULL,
  `therapists_id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `note` varchar(150) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sched`
--

INSERT INTO `tbl_sched` (`shed_id`, `therapists_id`, `day`, `start_time`, `end_time`, `note`, `status`, `date_created`) VALUES
(173, 17, 'Mon,Wed,Fri', '07:00:00', '12:00:00', 'Test 1', 'On-Going', '2024-10-14'),
(174, 17, 'Tue,THU,Sat', '12:00:00', '17:00:00', 'Test 2', 'Available', '2024-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_session`
--

CREATE TABLE `tbl_session` (
  `session_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `note` varchar(200) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `Time_startted` varchar(50) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `Date_creadted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_session`
--

INSERT INTO `tbl_session` (`session_id`, `duration`, `note`, `photo`, `status`, `Time_startted`, `appointment_id`, `Date_creadted`) VALUES
(15, 0, '', '', 'On-Going', '09:07:12pm', 24, '2024-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_therapists`
--

CREATE TABLE `tbl_therapists` (
  `therapist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `case_handled` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `Radius` varchar(200) NOT NULL,
  `license_img` varchar(100) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `barangay` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_therapists`
--

INSERT INTO `tbl_therapists` (`therapist_id`, `user_id`, `case_handled`, `city`, `Radius`, `license_img`, `date_created`, `barangay`) VALUES
(17, 54, 'Case 1,Case 2,Case 3,Case 4,Case 5,Case 6,Back pain,Spine injury,Dislocated bone', ' Mandaue City', '', '670ba9e35832a.jpg', '0000-00-00', 'Banilad'),
(18, 55, 'Case 20,Case 13,Case 10,Case 22', ' Mandaue City', '', '670bc47f5c6a3.jpg', '0000-00-00', 'Lahug');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `User_id` int(11) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `Mname` varchar(30) NOT NULL,
  `Bday` date NOT NULL,
  `UserName` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ContactNum` varchar(11) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `user_type` char(1) NOT NULL,
  `profilePic` varchar(100) NOT NULL,
  `E_wallet` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`User_id`, `Fname`, `Lname`, `Mname`, `Bday`, `UserName`, `Password`, `ContactNum`, `Email`, `user_type`, `profilePic`, `E_wallet`) VALUES
(53, 'Alexander', 'Mason', 'J.', '2005-10-09', 'Alexander', '$2y$10$jrfzHke6hB2MyeOaSnF03OLcZ5bNA.lRzvaCTHFeqyXyBHnfPgQp2', '12345678901', 'alexander1@gmail.com', 'P', '670ba59db49ad.jpg', 900),
(54, 'Victoria', 'Morgan', 'L.', '2005-10-09', 'Victoria', '$2y$10$X1t1xM6f.tiYEPL7ZIEY5OFqCdGxaDNg8ojYTj7hAYiP8xOIm.MEG', '12345678901', 'victoria1@gmail.com', 'T', '670ba9e357ff8.jpg', 1600),
(55, 'Morgan', 'Victoria', 'L.', '2005-10-09', 'Morgan', '$2y$10$djyk/2ocmxX4ARcv378x7.I0y8FgWLA5N.ZtikkfBFqFDEpGvtwju', '12345678901', 'morgan1@gmail.com', 'T', '670bc47f5c324.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `therapists_id` (`therapists_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `schedle_id` (`schedle_id`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_reminder`
--
ALTER TABLE `tbl_reminder`
  ADD PRIMARY KEY (`reminder_id`);

--
-- Indexes for table `tbl_sched`
--
ALTER TABLE `tbl_sched`
  ADD PRIMARY KEY (`shed_id`),
  ADD KEY `therapists_id` (`therapists_id`);

--
-- Indexes for table `tbl_session`
--
ALTER TABLE `tbl_session`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `tbl_therapists`
--
ALTER TABLE `tbl_therapists`
  ADD PRIMARY KEY (`therapist_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_reminder`
--
ALTER TABLE `tbl_reminder`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_sched`
--
ALTER TABLE `tbl_sched`
  MODIFY `shed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `tbl_session`
--
ALTER TABLE `tbl_session`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_therapists`
--
ALTER TABLE `tbl_therapists`
  MODIFY `therapist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD CONSTRAINT `tbl_appointment_ibfk_1` FOREIGN KEY (`therapists_id`) REFERENCES `tbl_therapists` (`therapist_id`),
  ADD CONSTRAINT `tbl_appointment_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patient` (`patient_id`),
  ADD CONSTRAINT `tbl_appointment_ibfk_3` FOREIGN KEY (`schedle_id`) REFERENCES `tbl_sched` (`shed_id`);

--
-- Constraints for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD CONSTRAINT `tbl_notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`User_id`);

--
-- Constraints for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  ADD CONSTRAINT `tbl_patient_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`User_id`);

--
-- Constraints for table `tbl_sched`
--
ALTER TABLE `tbl_sched`
  ADD CONSTRAINT `tbl_sched_ibfk_1` FOREIGN KEY (`therapists_id`) REFERENCES `tbl_therapists` (`therapist_id`);

--
-- Constraints for table `tbl_therapists`
--
ALTER TABLE `tbl_therapists`
  ADD CONSTRAINT `tbl_therapists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`User_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
