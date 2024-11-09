-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2024 at 01:15 PM
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
(41, 7, 'PC', '2024-11-09', 1, '0000-00-00', 39, 42, 'declined', 0, '2024-11-07 14:53:06', 182),
(43, 10, 'PC', '2024-11-09', 1, '0000-00-00', 39, 42, 'On-Going', 1000, '2024-11-07 15:09:11', 182);

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
(41, 106, 39, 'Pending', NULL, '2024-11-03 22:31:12'),
(42, 96, 39, 'Therapists Have Responded to your request', NULL, '2024-11-03 22:31:57'),
(43, 106, 40, 'Pending', NULL, '2024-11-07 22:49:08'),
(44, 106, 41, 'Pending', NULL, '2024-11-07 22:53:06'),
(45, 96, 41, 'Therapists Have Declined to your request', NULL, '2024-11-07 22:56:59'),
(46, 106, 42, 'Pending', NULL, '2024-11-07 22:57:15'),
(47, 96, 42, 'Therapists Have Declined to your request', NULL, '2024-11-07 22:57:34'),
(48, 96, 41, 'Therapists Have Declined to your request', NULL, '2024-11-07 23:03:36'),
(49, 96, 42, 'Therapists Have Declined to your request', NULL, '2024-11-07 23:03:42'),
(50, 96, 41, 'Therapists Have Declined to your request', NULL, '2024-11-07 23:05:06'),
(51, 96, 42, 'Therapists Have Declined to your request', NULL, '2024-11-07 23:05:12'),
(52, 96, 41, 'Therapists Have Declined to your request', NULL, '2024-11-07 23:07:00'),
(53, 96, 41, 'Therapists Have Declined to your request', NULL, '2024-11-07 23:07:18'),
(54, 96, 41, 'Therapists Have Declined to your request', NULL, '2024-11-07 23:07:55'),
(55, 96, 41, 'Therapists Have Declined to your request', NULL, '2024-11-07 23:08:51'),
(56, 96, 41, 'Therapists Have Declined to your request', NULL, '2024-11-07 23:09:02'),
(57, 106, 43, 'Pending', NULL, '2024-11-07 23:09:11'),
(58, 96, 43, 'Therapists Have Responded to your request', NULL, '2024-11-07 23:09:21');

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
(42, 96, 'Anxiety,PTSD', 'Experiencing heightened anxiety due to work stress and PTSD from a past traumatic event.', ' Cebu City', 'Lahug', '672780dc095d9.png,672780dc09882.jpg', '672780dc09b75.jpg,672780dc09e02.jpg,672780dc0a21d.jpg'),
(43, 97, 'Depression,Grief', 'Struggling with depression after losing a family member and coping with grief.', ' Cebu City', 'Guadalupe', '672780dc26321.png,672780dc265e7.jpg', '672780dc26849.jpg,672780dc26a53.jpg,672780dc29eb3.jpg'),
(44, 98, 'OCD,Phobia', 'Experiencing obsessive-compulsive behaviors and a phobia of public spaces.', ' Cebu City', 'Mabolo', '672780dc487b7.png,672780dc48a98.jpg', '672780dc48d39.jpg,672780dc48fd1.jpg,672780dc4924e.jpg'),
(45, 99, 'Burnout,Stress', 'Experiencing burnout and stress from work demands, feeling overwhelmed.', ' Cebu City', 'Banilad', '672780dc63ca0.png,672780dc63f2c.jpg', '672780dc641ac.jpg,672780dc64412.jpg,672780dc64738.jpg'),
(46, 100, 'Eating Disorders,Body Image Issues', 'Struggling with an eating disorder and negative body image perceptions.', ' Cebu City', 'Carcar', '672780dc7ee1e.png,672780dc7f109.jpg', '672780dc84a61.jpg,672780dc84d4a.jpg,672780dc84fae.jpg'),
(47, 101, 'Relationship Issues,Anxiety', 'Facing challenges in personal relationships, leading to increased anxiety.', ' Cebu City', 'Talisay', '672780dca212d.png,672780dca2591.jpg', '672780dca283a.jpg,672780dca2abd.jpg,672780dca2d7c.jpg'),
(48, 102, 'ADHD,Focus Issues', 'Struggling with attention deficit hyperactivity disorder and focus-related challenges.', ' Cebu City', 'Mandaue', '672780dcc02de.png,672780dcc058a.jpg', '672780dcc07a8.jpg,672780dcc0a09.jpg,672780dcc0cd6.jpg'),
(49, 103, 'Bipolar Disorder,Mood Swings', 'Experiencing mood swings related to bipolar disorder, affecting daily life.', ' Cebu City', 'Liloan', '672780dce2261.png,672780dce2547.jpg', '672780dce27c1.jpg,672780dce2a3f.jpg,672780dce2c47.jpg'),
(50, 104, 'Stress,PTSD', 'Dealing with stress and PTSD symptoms from past experiences.', ' Cebu City', 'Lahug', '672780dd0b398.png,672780dd0b650.jpg', '672780dd0b91e.jpg,672780dd0bb52.jpg,672780dd0bd9d.jpg'),
(51, 105, 'Grief,Depression', 'Experiencing grief and depression after a significant loss.', ' Cebu City', 'Guadalupe', '672780dd2e416.png,672780dd2e6e8.jpg', '672780dd2eb53.jpg,672780dd2ede3.jpg,672780dd2f022.jpg');

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
(47, 39, 1000, 'Paid', '2024-11-03 22:35:54'),
(48, 43, 1000, 'Paid', '2024-11-07 23:10:02');

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
(14, 39, '2024-11-09,2024-11-11,2024-11-13,2024-11-16,2024-11-18,2024-11-20,2024-11-23,2024-11-25,2024-11-27,2024-11-30', 'You Have An appointment Today', 'unread'),
(15, 43, '2024-11-09,2024-11-11,2024-11-13,2024-11-16,2024-11-18,2024-11-20,2024-11-23,2024-11-25,2024-11-27,2024-11-30', 'You Have An appointment Today', 'unread');

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
(182, 39, 'Mon,Wed,Sat', '07:30:00', '13:30:00', 'Test 1', 'Done', '2024-11-07'),
(183, 39, 'Mon,Wed,Sat', '14:30:00', '15:30:00', 'Test 5', 'Available', '2024-11-07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_session`
--

CREATE TABLE `tbl_session` (
  `session_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `note` varchar(200) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `Time_startted` timestamp NOT NULL DEFAULT current_timestamp(),
  `appointment_id` int(11) NOT NULL,
  `Date_creadted` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_session`
--

INSERT INTO `tbl_session` (`session_id`, `duration`, `note`, `photo`, `status`, `Time_startted`, `appointment_id`, `Date_creadted`, `end_time`) VALUES
(51, 0, '', '', 'On-Going', '2024-11-09 15:18:37', 43, '2024-11-09 15:18:37', NULL);

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
  `barangay` varchar(200) DEFAULT NULL,
  `certificate` varchar(255) DEFAULT NULL,
  `contract` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_therapists`
--

INSERT INTO `tbl_therapists` (`therapist_id`, `user_id`, `case_handled`, `city`, `Radius`, `license_img`, `barangay`, `certificate`, `contract`) VALUES
(39, 106, 'Anxiety,Depression,Trauma', ' Cebu City', '', '672780f0a8237.png', 'Mabolo', NULL, NULL),
(40, 107, 'Stress,OCD,Phobia', ' Cebu City', '', '672780f0c3200.png', 'Lahug', NULL, NULL),
(41, 108, 'PTSD,Burnout,Grief', ' Cebu City', '', '672780f0de501.png', 'Banilad', NULL, NULL),
(42, 109, 'Eating Disorders,ADHD', ' Cebu City', '', '672780f1051c4.png', 'Guadalupe', NULL, NULL),
(43, 110, 'Relationship Issues,Stress,Trauma', ' Cebu City', '', '672780f1207ba.png', 'Talisay', NULL, NULL),
(44, 111, 'Grief,Depression,OCD', ' Cebu City', '', '672780f13b814.png', 'Lahug', NULL, NULL),
(45, 112, 'Anxiety,Bipolar Disorder,Trauma', ' Cebu City', '', '672780f155cac.png', 'Carcar', NULL, NULL),
(46, 113, 'ADHD,Eating Disorders', ' Cebu City', '', '672780f1709c3.png', 'Mandaue', NULL, NULL),
(47, 114, 'Stress,OCD,Depression', ' Cebu City', '', '672780f188936.png', 'Mabolo', NULL, NULL),
(48, 115, 'PTSD,Anxiety,Relationship Issues', ' Cebu City', '', '672780f1a349f.png', 'Liloan', NULL, NULL);

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
(96, 'Jessica', 'Garcia', 'Anne', '1992-05-14', 'jessica_p01', '$2y$10$tYzKEBiZxPJUR3DbqaQYr.2Bt7ADDv5AkSv3t.0/ic5KV3JLpRm4C', '09123456780', 'jessica01@example.com', 'P', '672780dc07861.jpg', 3000),
(97, 'Mike', 'Brown', 'James', '1987-08-23', 'mike_brown87', '$2y$10$34QK1iqDCR0jOsBQDHgFn.chYuGQLcAT8sLGSqIGSTo8yOUXQcvjG', '09234567891', 'mike.brown@example.com', 'P', '672780dc25ff0.jpg', 0),
(98, 'Sarah', 'Jones', 'Lynn', '1999-12-05', 'sarah_jones99', '$2y$10$WBn54WDsJgrfPR2FPQ4jr.XKZi1eszSAIRUw.o2egYMep90alX2He', '09345678902', 'sarah.jones@example.com', 'P', '672780dc48510.jpg', 0),
(99, 'David', 'Wilson', 'Mark', '1988-03-20', 'david_wilson88', '$2y$10$G4Gpf8p0J41qU/VynEP/L./5X1j5gg4rho8XOud0Dn6AsfWlY79xW', '09456789012', 'david.wilson@example.com', 'P', '672780dc63963.jpg', 0),
(100, 'Amy', 'Taylor', 'Marie', '1996-01-15', 'amy_taylor96', '$2y$10$hPdfogd86kEu5gGkHYhXy.xbKjnRxJoEX5aXPAkX1V7IUSN1tJmLC', '09567890123', 'amy.taylor@example.com', 'P', '672780dc7eb11.jpg', 0),
(101, 'John', 'Doe', 'Michael', '1977-11-25', 'john_doe77', '$2y$10$70XTd1NCOrPuU2LbCAPwtuYqP3krYu4ivHASseCwbp1eBGgwW2f3i', '09678901234', 'john.doe@example.com', 'P', '672780dca1d8f.jpg', 0),
(102, 'Linda', 'Smith', 'Ann', '1984-07-30', 'linda_smith84', '$2y$10$g/uWXF9CXrmiKlElx4CQq.NYhdEsAYQCdMkhbTDjEl.RYCBuie.Wi', '09789012345', 'linda.smith@example.com', 'P', '672780dcc0051.jpg', 0),
(103, 'Susan', 'Miller', 'Lee', '1991-02-14', 'susan_miller91', '$2y$10$HI1X.RrHk8qdDcWqZpc9vug/gqD.9ex0PNZtIJ0JxTam0nXZIwsyq', '09890123456', 'susan.miller@example.com', 'P', '672780dce1f5e.jpg', 0),
(104, 'Robert', 'James', 'Andrew', '1980-09-10', 'robert_james80', '$2y$10$LzrmBX5qESoBcEqvtaOJ.O9WzrwVrps6V80sIjAnIHxZMy8TLiWUW', '09123457890', 'robert.james@example.com', 'P', '672780dd0b0e4.jpg', 0),
(105, 'Karen', 'Moore', 'Elizabeth', '1985-10-20', 'karen_moore85', '$2y$10$o8.bl0B.ghqIk3rjOY.xG.wLbuKS7BHBJ8IzPgN2rGszi1lln0c86', '09234567803', 'karen.moore@example.com', 'P', '672780dd2e135.jpg', 0),
(106, 'Therese', 'Johnson', 'Anne', '1985-03-10', 'therajohn123', '$2y$10$1lVfVd/veI8pS/YDUaTtYuMlrCJL/upGtC./AmSTfIH6Q06H/dfZi', '09123456789', 'therajohn@example.com', 'T', '67278f8e0a519.jpg', 3000),
(107, 'Mary', 'Smith', 'Jane', '1990-07-22', 'marysmith987', '$2y$10$QmXp.Nkgmi1H/ExVrp2kF.ASDTcktwfT.HSE5oNRLZv8QSQnnaa7i', '09234567890', 'marysmith@sample.com', 'T', '672780f0c2f4c.jpg', 0),
(108, 'John', 'Wilson', 'David', '1980-11-15', 'johnther123', '$2y$10$34LlOFdWoSimh.XC3tByl.R3kIOsntsur0457jTN./Dq2HYOzaIYq', '09345678901', 'johnw@example.com', 'T', '672780f0de220.jpg', 0),
(109, 'Sarah', 'Brown', 'Beth', '1988-05-30', 'sarahb_ther', '$2y$10$Z2fbVmh57FcKjRoYw8Ujs..gEGl4XdinDi8aQBHwyTiySgFC9Sona', '09456789012', 'sarahb@example.com', 'T', '672780f104ec6.jpg', 0),
(110, 'Carlos', 'Garcia', 'Manuel', '1975-09-10', 'carlosther890', '$2y$10$qHn0C1b763su2og9LyJ3yekd8CGOnMI7UgAFmS8m6CNtZxD/FYgLa', '09567890123', 'carlosg@example.com', 'T', '672780f1204cf.jpg', 0),
(111, 'Jane', 'Taylor', 'Marie', '1992-12-17', 'jane_therapist', '$2y$10$La5nIjyiH0uSe9CV5.ZI/eHJHHss46NV4VStsjC5uZNBuMMN37XnW', '09678901234', 'janet@example.com', 'T', '672780f13b40c.jpg', 0),
(112, 'Patrick', 'Lee', 'Walter', '1979-04-14', 'patrick_w_ther', '$2y$10$tqcTy8IOO/ImpWpwS61.qOSY.qonTDkd4v7NvJIrWKQjt3hAZm/3y', '09789012345', 'patrickle@example.com', 'T', '672780f1559a2.jpg', 0),
(113, 'Elizabeth', 'Walker', 'Rose', '1984-06-29', 'elizabeththerapist', '$2y$10$WBSGFv952HJ.hnMEfKKbZeYpXKLkGW1mJ./TM/cU6SiOauIfg4OKq', '09890123456', 'eliza_w@example.com', 'T', '672780f1706e8.jpg', 0),
(114, 'Robert', 'Clark', 'Thomas', '1995-01-12', 'robertt_ther', '$2y$10$8W3QJ9w3EN1HVIZtq8s1rOSb1hBxrOrBFjeJK.U87Y5vnUU0WQV2a', '09901234567', 'robertc@example.com', 'T', '672780f18862d.jpg', 0),
(115, 'Amy', 'Evans', 'Patricia', '1986-08-04', 'amyp_therapist', '$2y$10$qCkzI8RcVLkanVv8AdxzSeaR72o.NisWsKA4LdaDIUTuBspF4.XkK', '09123457890', 'amy.evans@example.com', 'T', '672780f1a3196.jpg', 0);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_reminder`
--
ALTER TABLE `tbl_reminder`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_sched`
--
ALTER TABLE `tbl_sched`
  MODIFY `shed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `tbl_session`
--
ALTER TABLE `tbl_session`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_therapists`
--
ALTER TABLE `tbl_therapists`
  MODIFY `therapist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

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
-- Constraints for table `tbl_session`
--
ALTER TABLE `tbl_session`
  ADD CONSTRAINT `tbl_session_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `tbl_appointment` (`appointment_id`);

--
-- Constraints for table `tbl_therapists`
--
ALTER TABLE `tbl_therapists`
  ADD CONSTRAINT `tbl_therapists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`User_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
