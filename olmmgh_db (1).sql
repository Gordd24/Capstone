-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2022 at 07:12 AM
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
(67, '', 'admin03', '$2y$10$mYfc3qnpbp3v6rtorRv9Be2EAUdcETJRO/NNOsDnxQCwLEUCAoiSi', 'Dumbos', '', 'Hotdog', 'dindough@gmail.com', '7846', 'Administrator', '2022-01-16', '20:57:35'),
(68, '', 'admin09', '$2y$10$V07qhgKb.iusXYfh6puPieJowTyCeqHl4pTrQ7mBFA.xqoAnyjXQ2', 'Dumbo', '', 'Hotdog', 'dindough@gmail.com', '7846', 'Administrator', '2022-01-16', '21:32:49');

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
(14, 15, 'patient/15/admission/20220109102049-macchiato.pdf', '2022-01-09', '20220109102049-macchiato.pdf'),
(15, 15, 'patient/15/admission/20220109102052-macchiato.pdf', '2022-01-09', '20220109102052-macchiato.pdf'),
(16, 25, 'patient/25/admission/20220123122112-legaspi.pdf', '2022-01-23', '20220123122112-legaspi.pdf'),
(17, 25, 'patient/25/admission/20220123122115-legaspi.pdf', '2022-01-23', '20220123122115-legaspi.pdf'),
(18, 24, 'patient/24/admission/20220123122348-mendoza.pdf', '2022-01-23', '20220123122348-mendoza.pdf'),
(19, 24, 'patient/24/admission/20220123122510-mendoza.pdf', '2022-01-23', '20220123122510-mendoza.pdf'),
(20, 14, 'patient/14/admission/20220123122727-doe.pdf', '2022-01-23', '20220123122727-doe.pdf'),
(21, 14, 'patient/14/admission/20220123122957-doe.pdf', '2022-01-23', '20220123122957-doe.pdf'),
(22, 14, 'patient/14/admission/20220123123637-doe.pdf', '2022-01-23', '20220123123637-doe.pdf'),
(23, 26, 'patient/26/admission/20220123124644-balot.pdf', '2022-01-23', '20220123124644-balot.pdf'),
(24, 26, 'patient/26/admission/20220123124936-balot.pdf', '2022-01-23', '20220123124936-balot.pdf'),
(25, 26, 'patient/26/admission/20220123125112-balot.pdf', '2022-01-23', '20220123125112-balot.pdf'),
(26, 26, 'patient/26/admission/20220123125604-balot.pdf', '2022-01-23', '20220123125604-balot.pdf'),
(27, 24, 'patient/24/admission/2022012310104-mendoza.pdf', '2022-01-23', '2022012310104-mendoza.pdf'),
(28, 27, 'patient/27/admission/20220124122904-capule.pdf', '2022-01-24', '20220124122904-capule.pdf'),
(29, 26, 'patient/26/admission/20220124123643-balot.pdf', '2022-01-24', '20220124123643-balot.pdf');

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
(7, 14, 'patient/14/consultation/2021123041927-test.pdf', '2021-12-30', '2021123041927-test.pdf'),
(8, 15, 'patient/15/consultation/2022012310417-macchiato.pdf', '2022-01-23', '2022012310417-macchiato.pdf');

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
(1, 15, '2022-01-09', 'transferred'),
(2, 25, '2022-01-23', 'hama'),
(3, 24, '2022-01-23', 'hama'),
(4, 24, '2022-01-23', 'hama'),
(5, 14, '2022-01-23', 'hama'),
(6, 14, '2022-01-23', 'hama'),
(7, 14, '2022-01-23', 'hama'),
(8, 26, '2022-01-23', 'transferred'),
(9, 26, '2022-01-23', 'absconded'),
(10, 26, '2022-01-23', 'discharged'),
(11, 26, '2022-01-23', 'absconded'),
(12, 24, '2022-01-23', 'hama');

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
(40, 26, 'patient/26/laboratory_result/How_Many_Interviews_Are_Enough.pdf', '2022-01-16', 'How_Many_Interviews_Are_Enough.pdf'),
(41, 26, 'patient/26/laboratory_result/PROPOSALONGENDERDISCRIMINATION.pdf', '2022-01-16', 'PROPOSALONGENDERDISCRIMINATION.pdf'),
(42, 26, 'patient/26/laboratory_result/20211111123429-mendoza.pdf', '2022-01-17', '20211111123429-mendoza.pdf'),
(43, 14, 'patient/14/laboratory_result/How_Many_Interviews_Are_Enough.pdf', '2022-01-17', 'How_Many_Interviews_Are_Enough.pdf'),
(44, 26, 'patient/26/laboratory_result/20211111123429-mendoza.pdf', '2022-01-17', '20211111123429-mendoza.pdf');

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
(12, 24, 'patient/24/medical certificate/2022012310831-mendoza.pdf', '2022-01-23', '2022012310831-mendoza.pdf'),
(13, 26, 'patient/26/medical certificate/20220124125827-balot.pdf', '2022-01-24', '20220124125827-balot.pdf'),
(14, 28, 'patient/28/medical certificate/2022012420102-de jesus.pdf', '2022-01-24', '2022012420102-de jesus.pdf');

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
  `time_added` time DEFAULT NULL,
  `pass_status` varchar(20) NOT NULL DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_patients`
--

INSERT INTO `tbl_patients` (`patient_id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `contact_no`, `email`, `sex`, `religion`, `address`, `birthdate`, `occupation`, `status`, `record_status`, `date_added`, `time_added`, `pass_status`) VALUES
(14, '', '', 'Dean', '', 'Doe', '09089899291', 'deandoe@gmail.com', 'Female', 'Roman Catholic', 'Seoul, Korea', '1999-09-15', 'Streamer', 'Not Admitted', 'Active', '2021-12-02', '23:56:57', 'default'),
(15, '', '', 'Machi', '', 'Macchiato', '', NULL, 'Female', '', 'Malolos, Bulacan', '2021-12-03', '', 'Not Admitted', 'Active', '2021-12-03', '15:34:54', 'default'),
(24, '2420211201', '$2y$10$U7R5RthTEiaGvcJtsH06/.dCKtLUdWoWMKW0Ew9ImrQjBHF1n4Qhu', 'Jasper', 'Alvaro', 'Mendoza', '0989786731', 'jas@gmail.com', 'Male', 'Roman Catholic', 'Maunlad Homes', '2021-12-01', 'Rapper', 'Not Admitted', 'Active', '2021-12-30', '12:20:34', 'default'),
(25, '2520220106', '$2y$10$9CfN9vbVSmOHgv6JGp/GMONssphbbMCcENTSf29h/ZbaCPaT1Tzzy', 'Lady Jobel', 'Ignacio', 'Legaspi', '', 'ladyboj@gmail.com', 'Female', '', 'Batia, Bocaue', '2022-01-06', '', 'Not Admitted', 'Active', '2022-01-06', '14:00:00', 'default'),
(26, '2620220106', '$2y$10$PpRhosV.R7GXF8K2zRnMx.B6liPFH.oiuJ/2moPLmma96U23.euiO', 'Dexter', '', 'Balot', '', 'dex@gmail.com', 'Male', '', 'dex residence', '2022-01-06', '', 'Admitted', 'Active', '2022-01-06', '15:21:36', 'changed'),
(27, '27capule', '$2y$10$wXtTHDMMlRaWDcdx/d7RG.2/PhxUjstpZTg6gawoAQcE287l.Q/a.', 'Camila Marie', '', 'Capule', '', 'cmcpl17@gmail.com', 'Female', '', 'Malolos, Bulacan', '2022-01-23', '', 'Admitted', 'Active', '2022-01-23', '03:43:37', 'default'),
(28, '28dejesus', '$2y$10$UPBEj23K9YGI/DGYeoy1RuzIxA0bq2rLOogQE5vm0oiTlvD0qvUvC', 'Dindy', '', 'de Jesus', '', 'duwin@gmail.com', 'Female', '', 'Malolos, Bulacan', '1999-09-15', '', 'Not Admitted', 'Active', '2022-01-24', '00:01:00', 'changed');

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
  `request_status` varchar(60) NOT NULL,
  `view_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_requests`
--

INSERT INTO `tbl_requests` (`request_id`, `patient_id`, `result_type`, `request_date`, `request_time`, `request_status`, `view_status`) VALUES
(107, 25, 'platelet_count', '2022-01-14', '20:10:23', 'responded', 'viewed'),
(108, 25, 'blood_typing', '2022-01-14', '20:10:23', 'responded', 'viewed'),
(109, 25, 'platelet_count', '2022-01-14', '20:14:26', 'responded', 'viewed'),
(110, 25, 'blood_urea_nitrogen', '2022-01-14', '20:14:26', 'responded', 'viewed'),
(111, 25, 'hepatitis_b', '2022-01-14', '20:14:46', 'responded', 'viewed'),
(112, 25, 'fasting_blood_sugar', '2022-01-14', '20:14:46', 'responded', 'viewed'),
(113, 25, 'platelet_count', '2022-01-14', '20:17:42', 'responded', 'viewed'),
(114, 25, 'hepatitis_b', '2022-01-14', '20:17:43', 'responded', 'viewed'),
(115, 25, 'cross_matching', '2022-01-14', '20:17:58', 'responded', 'viewed'),
(116, 25, 'hepatitis_b', '2022-01-14', '20:18:41', 'responded', 'viewed'),
(117, 25, 'fasting_blood_sugar', '2022-01-14', '20:18:41', 'responded', 'viewed'),
(118, 25, 'blood_urea_nitrogen', '2022-01-14', '20:18:46', 'responded', 'viewed'),
(119, 25, 'hepatitis_b', '2022-01-14', '20:20:28', 'responded', 'viewed'),
(120, 25, 'fasting_blood_sugar', '2022-01-14', '20:20:58', 'responded', 'viewed'),
(121, 25, 'uric_acid', '2022-01-14', '20:20:58', 'responded', 'viewed'),
(122, 25, 'cross_matching', '2022-01-15', '02:55:04', 'responded', 'viewed'),
(123, 25, 'hepatitis_b', '2022-01-15', '02:55:04', 'responded', 'viewed'),
(124, 26, 'platelet_count', '2022-01-16', '19:26:10', 'responded', 'viewed'),
(125, 25, 'uric_acid', '2022-01-16', '19:26:14', 'responded', 'viewed'),
(126, 25, 'blood_typing', '2022-01-16', '19:27:17', 'responded', 'viewed'),
(127, 26, 'fasting_blood_sugar', '2022-01-16', '19:27:35', 'responded', 'viewed'),
(128, 25, 'uric_acid', '2022-01-16', '19:27:39', 'responded', 'viewed'),
(129, 26, 'fasting_blood_sugar', '2022-01-16', '19:30:47', 'responded', 'viewed'),
(130, 26, 'fecalysis', '2022-01-16', '19:30:47', 'responded', 'viewed'),
(131, 26, 'cross_matching', '2022-01-16', '19:30:57', 'responded', 'viewed'),
(132, 26, 'creatinine', '2022-01-16', '19:30:57', 'responded', 'viewed'),
(133, 25, 'creatinine', '2022-01-16', '19:31:35', 'responded', 'viewed'),
(134, 14, 'urinalysis', '2022-01-16', '22:08:07', 'created', ''),
(135, 14, 'urinalysis', '2022-01-16', '22:09:22', 'created', ''),
(136, 15, 'cholesterol', '2022-01-16', '22:09:54', 'created', ''),
(137, 14, 'uric_acid', '2022-01-16', '22:14:48', 'created', ''),
(138, 14, 'cholesterol', '2022-01-16', '22:23:25', 'created', ''),
(139, 26, 'cross_matching', '2022-01-16', '22:25:20', 'responded', 'viewed'),
(140, 26, 'fasting_blood_sugar', '2022-01-16', '22:25:20', 'responded', 'viewed'),
(141, 26, 'uric_acid', '2022-01-16', '22:30:46', 'responded', 'viewed'),
(142, 26, 'fecalysis', '2022-01-16', '22:33:12', 'responded', 'viewed'),
(143, 26, 'uric_acid', '2022-01-16', '22:33:12', 'responded', 'viewed'),
(144, 26, 'urinalysis', '2022-01-16', '22:33:12', 'responded', 'viewed'),
(145, 14, 'uric_acid', '2022-01-16', '22:37:35', 'created', ''),
(146, 26, 'creatinine', '2022-01-16', '22:38:28', 'responded', 'viewed'),
(147, 26, 'cholesterol', '2022-01-16', '22:38:28', 'responded', 'viewed'),
(148, 26, 'fecalysis', '2022-01-16', '22:53:35', 'created', ''),
(149, 26, 'platelet_count', '2022-01-16', '22:54:08', 'responded', 'viewed'),
(150, 26, 'cross_matching', '2022-01-17', '12:24:56', 'responded', 'viewed'),
(151, 26, 'creatinine', '2022-01-17', '12:24:57', 'responded', 'viewed'),
(152, 14, 'uric_acid', '2022-01-17', '12:29:21', 'created', '');

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
(112, 14, 134, 'available', 'viewed', '2022-01-16', '22:08:07'),
(113, 14, 135, 'available', 'viewed', '2022-01-16', '22:09:22'),
(114, 15, 136, 'available', 'viewed', '2022-01-16', '22:09:54'),
(115, 14, 137, 'available', 'viewed', '2022-01-16', '22:14:48'),
(116, 14, 138, 'available', 'viewed', '2022-01-16', '22:23:25'),
(122, 14, 145, 'available', 'viewed', '2022-01-16', '22:37:36'),
(126, 26, 148, 'available', 'viewed', '2022-01-16', '22:53:36'),
(127, 26, 149, 'available', 'viewed', '2022-01-16', '22:54:29'),
(128, 26, 151, 'available', 'viewed', '2022-01-17', '12:25:38'),
(129, 14, 152, 'available', 'sent', '2022-01-17', '12:29:21'),
(130, 26, 150, 'available', 'viewed', '2022-01-17', '12:30:02');

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
  MODIFY `acc_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_admission`
--
ALTER TABLE `tbl_admission`
  MODIFY `record_admission_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_consult`
--
ALTER TABLE `tbl_consult`
  MODIFY `record_cons_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_discharge`
--
ALTER TABLE `tbl_discharge`
  MODIFY `discharge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_lab_result`
--
ALTER TABLE `tbl_lab_result`
  MODIFY `lab_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_med_cert`
--
ALTER TABLE `tbl_med_cert`
  MODIFY `record_med_cert_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  MODIFY `patient_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_requests`
--
ALTER TABLE `tbl_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `tbl_responses`
--
ALTER TABLE `tbl_responses`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

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
