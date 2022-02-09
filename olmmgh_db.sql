-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2022 at 08:53 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olmmgh_db21`
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
(1, 'EMP_1', 'admin03', '$2y$10$mYfc3qnpbp3v6rtorRv9Be2EAUdcETJRO/NNOsDnxQCwLEUCAoiSi', 'Cris', NULL, 'Newsome', 'crisnewsome@gmail.com', '1111', 'Administrator', NULL, NULL),
(74, 'EMP_74', 'Doc1', '$2y$10$nuZg5KXKM0TwO3x5uCyx4OFibVz0Y9oegrG4v2RXV7DixJphJKVOa', 'John', '', 'Doe', 'doc@email.com', '1234', 'Doctor', '2022-02-10', '03:41:48'),
(75, 'EMP_75', 'medtech1', '$2y$10$hJFMpGZzO4PzU6yAhVDO9.V7WkFK3wO9OZUaAfdX5k7eCYxXOijjC', 'John', '', 'Santos', 'medtech@gmail.com', '654', 'Medical Technologist', '2022-02-10', '03:42:51'),
(76, 'EMP_76', 'admin2', '$2y$10$y7hAZQXTqGpFdfh.wqhEIuIKa9g3vlpHNrTNJXJr5mKi.68c3iwGy', 'Joy', '', 'Ramos', 'capstone4n@gmail.com', '456', 'Administrator', '2022-02-10', '03:43:44'),
(77, 'EMP_77', 'nurse1', '$2y$10$vVevGAjoptQN/jTyQw3ovuKeD2gI.iNXW5BONqV2Gx7SAk1.aqSe6', 'Jose', '', 'Reyes', 'qwerty@gmail.com', '43567', 'Nurse', '2022-02-10', '03:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admission`
--

CREATE TABLE `tbl_admission` (
  `record_admission_id` int(20) NOT NULL,
  `patient_id` int(20) NOT NULL,
  `pdf_path` varchar(255) DEFAULT 'ongoing',
  `date` date NOT NULL,
  `file_name` varchar(255) DEFAULT 'ongoing',
  `address` varchar(50) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `phil_health` varchar(50) DEFAULT NULL,
  `father` varchar(60) DEFAULT NULL,
  `mother` varchar(60) DEFAULT NULL,
  `spouse` varchar(60) DEFAULT NULL,
  `date_marriage` date DEFAULT NULL,
  `place_marriage` varchar(50) DEFAULT NULL,
  `room_no` int(11) DEFAULT NULL,
  `case_no` int(11) DEFAULT NULL,
  `cs` varchar(50) DEFAULT NULL,
  `date_admitted` date DEFAULT NULL,
  `time_admitted` time DEFAULT NULL,
  `physician` varchar(60) DEFAULT NULL,
  `diagnosis` varchar(535) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `admitted_by` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_consult`
--

CREATE TABLE `tbl_consult` (
  `record_cons_id` int(20) NOT NULL,
  `patient_id` int(20) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `complaint` varchar(535) NOT NULL,
  `personnel` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_consult`
--

INSERT INTO `tbl_consult` (`record_cons_id`, `patient_id`, `pdf_path`, `date`, `file_name`, `complaint`, `personnel`) VALUES
(22, 32, 'patient/32/consultation/2022021035049-cardona.pdf', '2022-02-10', '2022021035049-cardona.pdf', 'Headache', 'John Doe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discharge`
--

CREATE TABLE `tbl_discharge` (
  `discharge_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `record_admission_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `disposition` varchar(60) NOT NULL,
  `final_diagnosis` varchar(535) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history`
--

CREATE TABLE `tbl_history` (
  `history_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `uploaded_date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `record_id` int(11) NOT NULL,
  `record_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_history`
--

INSERT INTO `tbl_history` (`history_id`, `patient_id`, `uploaded_date_time`, `record_id`, `record_type`) VALUES
(55, 32, '2022-02-09 19:50:49', 22, 'consultation'),
(56, 32, '2022-02-09 19:51:31', 75, 'lab_result');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lab_result`
--

CREATE TABLE `tbl_lab_result` (
  `lab_result_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `result_type` varchar(50) NOT NULL,
  `uploader` varchar(60) NOT NULL,
  `release_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_lab_result`
--

INSERT INTO `tbl_lab_result` (`lab_result_id`, `patient_id`, `pdf_path`, `date`, `file_name`, `result_type`, `uploader`, `release_by`) VALUES
(75, 32, 'patient/32/laboratory_result/2022021035131CROSSMATCHING.pdf', '2022-02-10', '2022021035131CROSSMATCHING.pdf', 'cross_matching', 'Joy Ramos', 'John Santos');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_med_cert`
--

CREATE TABLE `tbl_med_cert` (
  `record_med_cert_id` int(20) NOT NULL,
  `patient_id` int(20) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `diagnosis` varchar(535) NOT NULL,
  `recommendation` varchar(535) NOT NULL,
  `physician` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(32, '32cardona', '$2y$10$hFoUk3zx8wif3XypWmxwguQ50iF6to0BgVl.ALzEYUkEdY8qhsr1q', 'Mark', '', 'Cardona', '', 'cardona@gmail.com', 'Male', '', 'Malolos Bulacan', '1980-10-10', '', 'Not Admitted', 'Active', '2022-02-10', '03:47:08', 'default');

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
(184, 32, 'cross_matching', '2022-02-10', '03:51:31', 'created', '');

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
(162, 32, 184, 'available', 'sent', '2022-02-10', '03:51:31');

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
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `record_admission_id` (`record_admission_id`);

--
-- Indexes for table `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD PRIMARY KEY (`history_id`);

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
  MODIFY `acc_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `tbl_admission`
--
ALTER TABLE `tbl_admission`
  MODIFY `record_admission_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_consult`
--
ALTER TABLE `tbl_consult`
  MODIFY `record_cons_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_discharge`
--
ALTER TABLE `tbl_discharge`
  MODIFY `discharge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tbl_lab_result`
--
ALTER TABLE `tbl_lab_result`
  MODIFY `lab_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tbl_med_cert`
--
ALTER TABLE `tbl_med_cert`
  MODIFY `record_med_cert_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  MODIFY `patient_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_requests`
--
ALTER TABLE `tbl_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `tbl_responses`
--
ALTER TABLE `tbl_responses`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

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
  ADD CONSTRAINT `tbl_discharge_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patients` (`patient_id`),
  ADD CONSTRAINT `tbl_discharge_ibfk_2` FOREIGN KEY (`record_admission_id`) REFERENCES `tbl_admission` (`record_admission_id`);

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
