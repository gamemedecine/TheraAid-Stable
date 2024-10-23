-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2024 at 07:51 PM
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
(22, 66, 'Anxiety,PTSD', 'Experiencing heightened anxiety due to work stress and PTSD from a past traumatic event.', ' Cebu City', 'Lahug', '671936f6959d8.png,671936f695c8b.jpg', '671936f695eca.jpg,671936f6960c0.jpg,671936f6963a0.jpg'),
(23, 67, 'Depression,Grief', 'Struggling with depression after losing a family member and coping with grief.', ' Cebu City', 'Guadalupe', '671936f6b11c4.png,671936f6b149b.jpg', '671936f6b1746.jpg,671936f6b19b9.jpg,671936f6b1bcb.jpg'),
(24, 68, 'OCD,Phobia', 'Experiencing obsessive-compulsive behaviors and a phobia of public spaces.', ' Cebu City', 'Mabolo', '671936f6ca7c0.png,671936f6caa70.jpg', '671936f6cae47.jpg,671936f6cb0b4.jpg,671936f6cb2c7.jpg'),
(25, 69, 'Burnout,Stress', 'Experiencing burnout and stress from work demands, feeling overwhelmed.', ' Cebu City', 'Banilad', '671936f6e631c.png,671936f6e6541.jpg', '671936f6e688c.jpg,671936f6e6b21.jpg,671936f6ea8f9.jpg'),
(26, 70, 'Eating Disorders,Body Image Issues', 'Struggling with an eating disorder and negative body image perceptions.', ' Cebu City', 'Carcar', '671936f7157d9.png,671936f715a7f.jpg', '671936f715e03.jpg,671936f7160ec.jpg,671936f716416.jpg'),
(27, 71, 'Relationship Issues,Anxiety', 'Facing challenges in personal relationships, leading to increased anxiety.', ' Cebu City', 'Talisay', '671936f731a2d.png,671936f731c7a.jpg', '671936f731eb9.jpg,671936f73213b.jpg,671936f732480.jpg'),
(28, 72, 'ADHD,Focus Issues', 'Struggling with attention deficit hyperactivity disorder and focus-related challenges.', ' Cebu City', 'Mandaue', '671936f74f323.png,671936f74f536.jpg', '671936f74f72a.jpg,671936f74f8f7.jpg,671936f74fab2.jpg'),
(29, 73, 'Bipolar Disorder,Mood Swings', 'Experiencing mood swings related to bipolar disorder, affecting daily life.', ' Cebu City', 'Liloan', '671936f7693bc.png,671936f769641.jpg', '671936f769887.jpg,671936f769aef.jpg,671936f769d34.jpg'),
(30, 74, 'Stress,PTSD', 'Dealing with stress and PTSD symptoms from past experiences.', ' Cebu City', 'Lahug', '671936f792a76.png,671936f794663.jpg', '671936f7948a2.jpg,671936f794a6b.jpg,671936f794e70.jpg'),
(31, 75, 'Grief,Depression', 'Experiencing grief and depression after a significant loss.', ' Cebu City', 'Guadalupe', '671936f7af5ba.png,671936f7af7a1.jpg', '671936f7afd9e.jpg,671936f7affbd.jpg,671936f7b018e.jpg');

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
(19, 56, 'Anxiety,Depression,Trauma', ' Cebu City', '', '67192e211983a.png', '0000-00-00', 'Mabolo'),
(20, 57, 'Stress,OCD,Phobia', ' Cebu City', '', '67192e213aec4.png', '0000-00-00', 'Lahug'),
(21, 58, 'PTSD,Burnout,Grief', ' Cebu City', '', '67192e2152a96.png', '0000-00-00', 'Banilad'),
(22, 59, 'Eating Disorders,ADHD', ' Cebu City', '', '67192e216b3f3.png', '0000-00-00', 'Guadalupe'),
(23, 60, 'Relationship Issues,Stress,Trauma', ' Cebu City', '', '67192e21840b3.png', '0000-00-00', 'Talisay'),
(24, 61, 'Grief,Depression,OCD', ' Cebu City', '', '67192e219e2a2.png', '0000-00-00', 'Lahug'),
(25, 62, 'Anxiety,Bipolar Disorder,Trauma', ' Cebu City', '', '67192e21b8c7c.png', '0000-00-00', 'Carcar'),
(26, 63, 'ADHD,Eating Disorders', ' Cebu City', '', '67192e21d0db5.png', '0000-00-00', 'Mandaue'),
(27, 64, 'Stress,OCD,Depression', ' Cebu City', '', '67192e21e9206.png', '0000-00-00', 'Mabolo'),
(28, 65, 'PTSD,Anxiety,Relationship Issues', ' Cebu City', '', '67192e220d907.png', '0000-00-00', 'Liloan');

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
(56, 'Therese', 'Johnson', 'Anne', '1985-03-10', 'therajohn123', '$2y$10$wqTjJq9EnzJt4gT9BtFeoOBOS8wCyW.KDeHIUgX8psxWa4RWxKK92', '09123456789', 'therajohn@example.com', 'T', '67192e2117b9d.jpg', 0),
(57, 'Mary', 'Smith', 'Jane', '1990-07-22', 'marysmith987', '$2y$10$PBaPY1nE1weLg4TPp0i8u.XH/J2OqwqP70izx2.Rpl.8AyaZmh2bm', '09234567890', 'marysmith@sample.com', 'T', '67192e213aa04.jpg', 0),
(58, 'John', 'Wilson', 'David', '1980-11-15', 'johnther123', '$2y$10$vE2.cKl87X6p3Ui63aBHS.3wWkojjMwLsmjTRWWmHga/1F1Dx/OFy', '09345678901', 'johnw@example.com', 'T', '67192e21527ef.jpg', 0),
(59, 'Sarah', 'Brown', 'Beth', '1988-05-30', 'sarahb_ther', '$2y$10$GdOtr/YxDq.yla/P/S8TT.HT6wKbQSst6opZBIPXrU95k49ZN8IS6', '09456789012', 'sarahb@example.com', 'T', '67192e216b0bd.jpg', 0),
(60, 'Carlos', 'Garcia', 'Manuel', '1975-09-10', 'carlosther890', '$2y$10$CsMJtGVvvcQMcSmEe3UBV.QEwQz75ryuTYWKrEnWqv/JAFR3ROuny', '09567890123', 'carlosg@example.com', 'T', '67192e2183e2d.jpg', 0),
(61, 'Jane', 'Taylor', 'Marie', '1992-12-17', 'jane_therapist', '$2y$10$wQNcjxhcWQYpFwv0JdXFoe.YvYpFcgMyrQSGPNFUOpbPv7x6ccue.', '09678901234', 'janet@example.com', 'T', '67192e219de7a.jpg', 0),
(62, 'Patrick', 'Lee', 'Walter', '1979-04-14', 'patrick_w_ther', '$2y$10$yAAtUQzw7L4RurZY5nqpeOqA2nifkCQS0/9ByyCT6MmkovPAdpMVC', '09789012345', 'patrickle@example.com', 'T', '67192e21b89ad.jpg', 0),
(63, 'Elizabeth', 'Walker', 'Rose', '1984-06-29', 'elizabeththerapist', '$2y$10$388ld7EIXmu10eGI9CTiXui8Zuc/jiBci8.wX0MwYp65SkoGXJZlu', '09890123456', 'eliza_w@example.com', 'T', '67192e21d0b30.jpg', 0),
(64, 'Robert', 'Clark', 'Thomas', '1995-01-12', 'robertt_ther', '$2y$10$C2zisslCly3bkReVXkjSeOdQ.6AKs6zLfuROcg3loeuD6ZL4akEAy', '09901234567', 'robertc@example.com', 'T', '67192e21e8f33.jpg', 0),
(65, 'Amy', 'Evans', 'Patricia', '1986-08-04', 'amyp_therapist', '$2y$10$QW9liZe.IqQkruD7wqefK.Mym0QeLy3th0c2YZDysM7Jyx.z31lQG', '09123457890', 'amy.evans@example.com', 'T', '67192e220d677.jpg', 0),
(66, 'Jessica', 'Garcia', 'Anne', '1992-05-14', 'jessica_p01', '$2y$10$EYQrL/bM.eN1UjlBsAYQvOj.Nu4r9xQzlH/KPla2BnBlkHHqBwJma', '09123456780', 'jessica01@example.com', 'P', '671936f69572a.jpg', 0),
(67, 'Mike', 'Brown', 'James', '1987-08-23', 'mike_brown87', '$2y$10$J4dASyR4t/5SyXHBZXvJbeDhHE05uoFsvy31QF603.YDLAYmdchEi', '09234567891', 'mike.brown@example.com', 'P', '671936f6b0f3f.jpg', 0),
(68, 'Sarah', 'Jones', 'Lynn', '1999-12-05', 'sarah_jones99', '$2y$10$JBDqJab73Y7sJvU8UtI7i.o8sjCZOHJWgaTGKel4OoWg7NQGMv/gy', '09345678902', 'sarah.jones@example.com', 'P', '671936f6ca505.jpg', 0),
(69, 'David', 'Wilson', 'Mark', '1988-03-20', 'david_wilson88', '$2y$10$sFpyM3Pryo9xjupH.zCJ.eviNSFY2TF3k7/UPaWwOxMJ0MGeVj29q', '09456789012', 'david.wilson@example.com', 'P', '671936f6e6091.jpg', 0),
(70, 'Amy', 'Taylor', 'Marie', '1996-01-15', 'amy_taylor96', '$2y$10$B/jv33h2f8H5Mw27thmqluUUqVD9ENOBBEDoyf8jMWLBfirZ46yBa', '09567890123', 'amy.taylor@example.com', 'P', '671936f715532.jpg', 0),
(71, 'John', 'Doe', 'Michael', '1977-11-25', 'john_doe77', '$2y$10$UJ7u9ffCqxwribylwk9C1.49e3fMw85fpw9qM5veubjUHRf7cevGK', '09678901234', 'john.doe@example.com', 'P', '671936f73170d.jpg', 0),
(72, 'Linda', 'Smith', 'Ann', '1984-07-30', 'linda_smith84', '$2y$10$V.qOOyXf.OZ/UtqfvdxVW.iC.PT59RtJpi2ZCasiszA27G52Mro7a', '09789012345', 'linda.smith@example.com', 'P', '671936f74efa8.jpg', 0),
(73, 'Susan', 'Miller', 'Lee', '1991-02-14', 'susan_miller91', '$2y$10$N5duIz0Bhezz28nmZs/Q.OvP9X/MocKwYux2VozfTKRpzermiOfE6', '09890123456', 'susan.miller@example.com', 'P', '671936f7690d9.jpg', 0),
(74, 'Robert', 'James', 'Andrew', '1980-09-10', 'robert_james80', '$2y$10$FpvtACW/I22IC/B4ZSds0e88NAJVXlW8jhkislHC1wACbxwvwB4AG', '09123457890', 'robert.james@example.com', 'P', '671936f792569.jpg', 0),
(75, 'Karen', 'Moore', 'Elizabeth', '1985-10-20', 'karen_moore85', '$2y$10$6hTE4MCTf0nS8QmWgYHpc.mGBJcX17/Hpzs8Y7l/2ZxVWh8jxV2x.', '09234567803', 'karen.moore@example.com', 'P', '671936f7af342.jpg', 0);

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
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_reminder`
--
ALTER TABLE `tbl_reminder`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_sched`
--
ALTER TABLE `tbl_sched`
  MODIFY `shed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `tbl_session`
--
ALTER TABLE `tbl_session`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_therapists`
--
ALTER TABLE `tbl_therapists`
  MODIFY `therapist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

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
