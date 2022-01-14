-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2022 at 09:23 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olmmgh_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounts`
--

CREATE TABLE `tbl_accounts` (
  `acc_id` int(40) NOT NULL,
  `auto_id` varchar(255) NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `password` varchar(300) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `position` varchar(40) NOT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`acc_id`, `auto_id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `email`, `emp_id`, `position`, `date_created`, `time_created`) VALUES
(53, '', 'jasper', '$2y$10$3HENUn.l5XDj4WIxzx7mMuR.eJYqupbE1LNkUtlvR/y3JsTbL94ta', 'Jasper Jake', 'Alvaro', 'Mendoza', 'jaspercake@gmail.com', '5634', 'Administrator', '2021-12-14', '13:52:31'),
(55, '', 'admin01', '$2y$10$i2/zlpvWv54lapOe.tXhae8MOyiJX53Dt54becIRbJWC0ryb9ssC.', 'din', 's', 'doughs', 'dindough@gmail.com', '7846', 'Administrator', '2021-12-28', '14:35:17'),
(65, 'EMP_65', 'admin06', '$2y$10$E50n.pLUVzJ1S.5QcbKK9uMzLQNnP0PtKW7v7agQwAko18g8t7iBC', 'Jake', '', 'Peralta', 'admin06@gmail.com', '7856', 'Administrator', '2022-01-04', '16:00:27'),
(66, 'EMP_66', 'administrator4n', '$2y$10$BzUvAI3EjNWuoxS2mMIXC.dshzc0XdQuLmjFCM/7Meq5j3Q5zVBqy', 'Administrator', '', 'Administrator', 'administrator4n2022@gmail.com', '00001', 'Administrator', '2022-01-09', '08:51:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admission`
--

CREATE TABLE `tbl_admission` (
  `record_admission_id` int(20) NOT NULL,
  `patient_id` int(20) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admission`
--

INSERT INTO `tbl_admission` (`record_admission_id`, `patient_id`, `pdf_path`, `date`, `file_name`) VALUES
(8, 14, 'patient/14/admission/2021123050126-test.pdf', '2021-12-30', '2021123050126-test.pdf'),
(9, 15, 'patient/15/admission/2021123182815-macchiato.pdf', '2021-12-31', '2021123182815-macchiato.pdf'),
(10, 24, 'patient/24/admission/2022010615835-mendoza.pdf', '2022-01-06', '2022010615835-mendoza.pdf'),
(11, 24, 'patient/24/admission/2022010615837-mendoza.pdf', '2022-01-06', '2022010615837-mendoza.pdf'),
(12, 25, 'patient/25/admission/2022010620121-legaspi.pdf', '2022-01-06', '2022010620121-legaspi.pdf'),
(13, 26, 'patient/26/admission/2022010632417-balot.pdf', '2022-01-06', '2022010632417-balot.pdf'),
(14, 15, 'patient/15/admission/20220109102049-macchiato.pdf', '2022-01-09', '20220109102049-macchiato.pdf'),
(15, 15, 'patient/15/admission/20220109102052-macchiato.pdf', '2022-01-09', '20220109102052-macchiato.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_consult`
--

CREATE TABLE `tbl_consult` (
  `record_cons_id` int(20) NOT NULL,
  `patient_id` int(20) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_consult`
--

INSERT INTO `tbl_consult` (`record_cons_id`, `patient_id`, `pdf_path`, `date`, `file_name`) VALUES
(7, 14, 'patient/14/consultation/2021123041927-test.pdf', '2021-12-30', '2021123041927-test.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discharge`
--

CREATE TABLE `tbl_discharge` (
  `discharge_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `disposition` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_discharge`
--

INSERT INTO `tbl_discharge` (`discharge_id`, `patient_id`, `date`, `disposition`) VALUES
(1, 15, '2022-01-09', 'transferred');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lab_result`
--

CREATE TABLE `tbl_lab_result` (
  `lab_result_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_lab_result`
--

INSERT INTO `tbl_lab_result` (`lab_result_id`, `patient_id`, `pdf_path`, `date`, `file_name`) VALUES
(7, 26, 'patient/26/laboratory_result/PROPOSALONGENDERDISCRIMINATION.pdf', '2022-01-08', 'PROPOSALONGENDERDISCRIMINATION.pdf'),
(8, 26, 'patient/26/laboratory_result/How_Many_Interviews_Are_Enough.pdf', '2022-01-09', 'How_Many_Interviews_Are_Enough.pdf'),
(9, 26, 'patient/26/laboratory_result/How_Many_Interviews_Are_Enough.pdf', '2022-01-09', 'How_Many_Interviews_Are_Enough.pdf'),
(10, 26, 'patient/26/laboratory_result/_.._patient_14_medical certificate_2012-09-15-test (2).pdf', '2022-01-09', '_.._patient_14_medical certificate_2012-09-15-test (2).pdf'),
(11, 26, 'patient/26/laboratory_result/AlmeraJohnMark_Declaration_IT401.pdf', '2022-01-09', 'AlmeraJohnMark_Declaration_IT401.pdf'),
(12, 26, 'patient/26/laboratory_result/AlmeraJohnMark_Declaration_IT401.pdf', '2022-01-09', 'AlmeraJohnMark_Declaration_IT401.pdf'),
(13, 26, 'patient/26/laboratory_result/AlmeraJohnMark_Declaration_IT401.pdf', '2022-01-09', 'AlmeraJohnMark_Declaration_IT401.pdf'),
(14, 26, 'patient/26/laboratory_result/AlmeraJohnMark_Declaration_IT401.pdf', '2022-01-09', 'AlmeraJohnMark_Declaration_IT401.pdf'),
(15, 26, 'patient/26/laboratory_result/AlmeraJohnMark_Declaration_IT401.pdf', '2022-01-09', 'AlmeraJohnMark_Declaration_IT401.pdf'),
(16, 26, 'patient/26/laboratory_result/AlmeraJohnMark_Declaration_IT401.pdf', '2022-01-09', 'AlmeraJohnMark_Declaration_IT401.pdf'),
(17, 26, 'patient/26/laboratory_result/BSIT4N_Almera_JohnMark_Resume.pdf', '2022-01-09', 'BSIT4N_Almera_JohnMark_Resume.pdf'),
(18, 26, 'patient/26/laboratory_result/BSIT4N_Almera_JohnMark_Resume.pdf', '2022-01-09', 'BSIT4N_Almera_JohnMark_Resume.pdf'),
(19, 26, 'patient/26/laboratory_result/BSIT4N_Almera_JohnMark_Resume.pdf', '2022-01-09', 'BSIT4N_Almera_JohnMark_Resume.pdf'),
(20, 26, 'patient/26/laboratory_result/BSIT4N_Almera_JohnMark_Resume.pdf', '2022-01-09', 'BSIT4N_Almera_JohnMark_Resume.pdf'),
(21, 26, 'patient/26/laboratory_result/BSIT4N_Almera_JohnMark_Resume.pdf', '2022-01-09', 'BSIT4N_Almera_JohnMark_Resume.pdf'),
(22, 26, 'patient/26/laboratory_result/BSIT4N_Almera_JohnMark_Resume.pdf', '2022-01-09', 'BSIT4N_Almera_JohnMark_Resume.pdf'),
(23, 26, 'patient/26/laboratory_result/BSIT4N_Almera_JohnMark_Resume.pdf', '2022-01-09', 'BSIT4N_Almera_JohnMark_Resume.pdf'),
(24, 26, 'patient/26/laboratory_result/PLEDGE OF COMMITMENT.pdf', '2022-01-14', 'PLEDGE OF COMMITMENT.pdf'),
(25, 26, 'patient/26/laboratory_result/PLEDGE OF COMMITMENT.pdf', '2022-01-14', 'PLEDGE OF COMMITMENT.pdf'),
(26, 26, 'patient/26/laboratory_result/PLEDGE OF COMMITMENT.pdf', '2022-01-14', 'PLEDGE OF COMMITMENT.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_med_cert`
--

CREATE TABLE `tbl_med_cert` (
  `record_med_cert_id` int(20) NOT NULL,
  `patient_id` int(20) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_med_cert`
--

INSERT INTO `tbl_med_cert` (`record_med_cert_id`, `patient_id`, `pdf_path`, `date`, `file_name`) VALUES
(9, 26, 'patient/26/medical certificate/2022010983104-balot.pdf', '2022-01-09', '2022010983104-balot.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_password_reset`
--

CREATE TABLE `tbl_password_reset` (
  `email` varchar(255) NOT NULL,
  `email_key` varchar(255) NOT NULL,
  `exp_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients`
--

CREATE TABLE `tbl_patients` (
  `patient_id` int(30) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `sex` varchar(10) NOT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `address` varchar(150) NOT NULL,
  `birthdate` varchar(30) NOT NULL,
  `occupation` varchar(30) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `record_status` varchar(255) NOT NULL,
  `date_added` date DEFAULT NULL,
  `time_added` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_patients`
--

INSERT INTO `tbl_patients` (`patient_id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `contact_no`, `email`, `sex`, `religion`, `address`, `birthdate`, `occupation`, `status`, `record_status`, `date_added`, `time_added`) VALUES
(14, '', '', 'Dean', '', 'Doe', '09089899291', 'deandoe@gmail.com', 'Female', 'Roman Catholic', 'Seoul, Korea', '1999-09-15', 'Streamer', 'Not Admitted', 'Active', '2021-12-02', '23:56:57'),
(15, '', '', 'Machi', '', 'Macchiato', '', NULL, 'Female', '', 'Malolos, Bulacan', '2021-12-03', '', 'Not Admitted', 'Active', '2021-12-03', '15:34:54'),
(24, '2420211201', '$2y$10$U7R5RthTEiaGvcJtsH06/.dCKtLUdWoWMKW0Ew9ImrQjBHF1n4Qhu', 'Jasper', 'Alvaro', 'Mendoza', '0989786731', 'jas@gmail.com', 'Male', 'Roman Catholic', 'Maunlad Homes', '2021-12-01', 'Rapper', 'Not Admitted', 'Active', '2021-12-30', '12:20:34'),
(25, '2520220106', '$2y$10$9CfN9vbVSmOHgv6JGp/GMONssphbbMCcENTSf29h/ZbaCPaT1Tzzy', 'Lady Jobel', 'Ignacio', 'Legaspi', '', 'ladyboj@gmail.com', 'Female', '', 'Batia, Bocaue', '2022-01-06', '', 'Not Admitted', 'Active', '2022-01-06', '14:00:00'),
(26, '2620220106', '$2y$10$jtvs7h/aA5zTy7UlIiiLYe9EL5.fOZqS0yfdxqDR2FzvUdm5PUA6e', 'Dexter', '', 'Balot', '', 'dex@gmail.com', 'Male', '', 'dex residence', '2022-01-06', '', 'Not Admitted', 'Active', '2022-01-06', '15:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requests`
--

CREATE TABLE `tbl_requests` (
  `request_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `result_type` varchar(60) NOT NULL,
  `request_date` date NOT NULL,
  `request_time` time NOT NULL,
  `request_status` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_requests`
--

INSERT INTO `tbl_requests` (`request_id`, `patient_id`, `result_type`, `request_date`, `request_time`, `request_status`) VALUES
(67, 26, 'cross_matching', '2022-01-09', '14:53:45', 'responded'),
(68, 26, 'blood_urea_nitrogen', '2022-01-09', '14:53:45', 'responded'),
(69, 26, 'fasting_blood_sugar', '2022-01-09', '14:53:45', 'responded'),
(70, 26, 'urinalysis', '2022-01-09', '14:54:36', 'created'),
(71, 26, 'fasting_blood_sugar', '2022-01-09', '14:58:53', 'responded'),
(72, 26, 'complete_blood_count', '2022-01-09', '15:03:01', 'responded'),
(73, 26, 'complete_blood_count', '2022-01-09', '15:07:53', 'responded'),
(74, 26, 'platelet_count', '2022-01-09', '15:07:53', 'responded'),
(75, 26, 'blood_typing', '2022-01-09', '15:07:53', 'responded'),
(76, 26, 'cross_matching', '2022-01-09', '15:07:53', 'responded'),
(77, 26, 'hepatitis_b', '2022-01-09', '15:07:54', 'responded'),
(78, 26, 'blood_urea_nitrogen', '2022-01-09', '15:07:54', 'responded'),
(79, 26, 'creatinine', '2022-01-09', '15:07:54', 'responded'),
(80, 26, 'fasting_blood_sugar', '2022-01-09', '15:07:54', 'responded'),
(81, 26, 'fecalysis', '2022-01-09', '15:07:54', 'responded'),
(82, 26, 'cholesterol', '2022-01-09', '15:07:54', 'responded'),
(83, 26, 'uric_acid', '2022-01-09', '15:07:54', 'responded'),
(84, 26, 'urinalysis', '2022-01-09', '15:07:54', 'responded'),
(85, 26, 'complete_blood_count', '2022-01-14', '14:40:08', 'responded'),
(86, 26, 'platelet_count', '2022-01-14', '14:40:08', 'responded'),
(87, 26, 'blood_typing', '2022-01-14', '14:40:08', 'responded'),
(88, 26, 'complete_blood_count', '2022-01-14', '14:40:18', 'responded'),
(89, 26, 'uric_acid', '2022-01-14', '14:40:26', 'responded'),
(90, 26, 'cross_matching', '2022-01-14', '15:17:57', 'responded'),
(91, 26, 'hepatitis_b', '2022-01-14', '15:17:58', 'responded'),
(92, 26, 'fasting_blood_sugar', '2022-01-14', '15:17:58', 'responded'),
(93, 26, 'cholesterol', '2022-01-14', '15:19:10', 'created'),
(94, 26, 'platelet_count', '2022-01-14', '15:53:59', 'responded'),
(95, 26, 'cross_matching', '2022-01-14', '15:57:33', 'responded'),
(96, 26, 'hepatitis_b', '2022-01-14', '15:57:33', 'responded'),
(97, 26, 'blood_urea_nitrogen', '2022-01-14', '15:57:33', 'responded'),
(98, 26, 'fasting_blood_sugar', '2022-01-14', '15:57:33', 'responded'),
(99, 26, 'fecalysis', '2022-01-14', '15:57:34', 'responded'),
(100, 26, 'complete_blood_count', '2022-01-14', '16:05:34', 'responded'),
(101, 26, 'cross_matching', '2022-01-14', '16:05:48', 'responded'),
(102, 26, 'complete_blood_count', '2022-01-14', '16:17:23', 'responded'),
(103, 26, 'complete_blood_count', '2022-01-14', '16:17:31', 'responded'),
(104, 26, 'fasting_blood_sugar', '2022-01-14', '16:21:34', 'responded');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_responses`
--

CREATE TABLE `tbl_responses` (
  `response_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `response_status` varchar(60) NOT NULL,
  `view_status` varchar(20) NOT NULL,
  `response_date` date NOT NULL,
  `response_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_responses`
--

INSERT INTO `tbl_responses` (`response_id`, `patient_id`, `request_id`, `response_status`, `view_status`, `response_date`, `response_time`) VALUES
(65, 26, 89, 'already available', 'viewed', '2022-01-14', '14:42:52'),
(66, 26, 88, 'already available', 'viewed', '2022-01-14', '15:02:47'),
(67, 26, 85, 'not available', 'viewed', '2022-01-14', '15:03:00'),
(68, 26, 86, 'available', '', '2022-01-14', '15:03:22'),
(69, 26, 87, 'already available', 'viewed', '2022-01-14', '15:03:44'),
(70, 26, 91, 'already available', 'viewed', '2022-01-14', '15:18:29'),
(71, 26, 92, 'available', 'viewed', '2022-01-14', '15:18:39'),
(72, 26, 90, 'not available', 'viewed', '2022-01-14', '15:18:44'),
(73, 26, 93, 'available', 'viewed', '2022-01-14', '15:19:10'),
(74, 26, 94, 'not available', 'viewed', '2022-01-14', '15:54:07'),
(75, 26, 99, 'already available', 'viewed', '2022-01-14', '15:57:47'),
(76, 26, 96, 'already available', 'viewed', '2022-01-14', '15:57:49'),
(77, 26, 95, 'already available', 'viewed', '2022-01-14', '15:57:50'),
(78, 26, 97, 'not available', 'viewed', '2022-01-14', '16:01:45'),
(79, 26, 98, 'already available', 'viewed', '2022-01-14', '16:02:14'),
(80, 26, 104, 'not available', 'viewed', '2022-01-14', '16:22:00'),
(81, 26, 103, 'already available', 'viewed', '2022-01-14', '16:22:06'),
(82, 26, 101, 'already available', 'viewed', '2022-01-14', '16:22:17'),
(83, 26, 102, 'already available', 'viewed', '2022-01-14', '16:22:19'),
(84, 26, 100, 'already available', 'viewed', '2022-01-14', '16:22:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `tbl_admission`
--
ALTER TABLE `tbl_admission`
  ADD PRIMARY KEY (`record_admission_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `tbl_consult`
--
ALTER TABLE `tbl_consult`
  ADD PRIMARY KEY (`record_cons_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `tbl_discharge`
--
ALTER TABLE `tbl_discharge`
  ADD PRIMARY KEY (`discharge_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `tbl_lab_result`
--
ALTER TABLE `tbl_lab_result`
  ADD PRIMARY KEY (`lab_result_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `tbl_med_cert`
--
ALTER TABLE `tbl_med_cert`
  ADD PRIMARY KEY (`record_med_cert_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `tbl_requests`
--
ALTER TABLE `tbl_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `tbl_responses`
--
ALTER TABLE `tbl_responses`
  ADD PRIMARY KEY (`response_id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `acc_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tbl_admission`
--
ALTER TABLE `tbl_admission`
  MODIFY `record_admission_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_consult`
--
ALTER TABLE `tbl_consult`
  MODIFY `record_cons_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_discharge`
--
ALTER TABLE `tbl_discharge`
  MODIFY `discharge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_lab_result`
--
ALTER TABLE `tbl_lab_result`
  MODIFY `lab_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_med_cert`
--
ALTER TABLE `tbl_med_cert`
  MODIFY `record_med_cert_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  MODIFY `patient_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_requests`
--
ALTER TABLE `tbl_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `tbl_responses`
--
ALTER TABLE `tbl_responses`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_admission`
--
ALTER TABLE `tbl_admission`
  ADD CONSTRAINT `tbl_admission_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patients` (`patient_id`);

--
-- Constraints for table `tbl_consult`
--
ALTER TABLE `tbl_consult`
  ADD CONSTRAINT `tbl_consult_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patients` (`patient_id`);

--
-- Constraints for table `tbl_discharge`
--
ALTER TABLE `tbl_discharge`
  ADD CONSTRAINT `tbl_discharge_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patients` (`patient_id`);

--
-- Constraints for table `tbl_lab_result`
--
ALTER TABLE `tbl_lab_result`
  ADD CONSTRAINT `tbl_lab_result_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patients` (`patient_id`);

--
-- Constraints for table `tbl_med_cert`
--
ALTER TABLE `tbl_med_cert`
  ADD CONSTRAINT `tbl_med_cert_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patients` (`patient_id`);

--
-- Constraints for table `tbl_requests`
--
ALTER TABLE `tbl_requests`
  ADD CONSTRAINT `tbl_requests_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patients` (`patient_id`);

--
-- Constraints for table `tbl_responses`
--
ALTER TABLE `tbl_responses`
  ADD CONSTRAINT `tbl_responses_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `tbl_requests` (`request_id`),
  ADD CONSTRAINT `tbl_responses_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patients` (`patient_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
