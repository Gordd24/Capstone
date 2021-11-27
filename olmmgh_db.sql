-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2021 at 09:43 AM
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
  `username` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `position` varchar(40) NOT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`acc_id`, `auto_id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `emp_id`, `position`, `date_created`, `time_created`) VALUES
(37, 'EMP_37', 'Ace', '$2y$10$d95hdk4l80fLkYPsbkKFzeMoz3Q5olCYrMp/VuBZIatjfWsACEKA6', 'Portgas', 'D.', 'Ace', '123', 'Doctor', '2000-01-01', '10:30:20'),
(41, 'EMP_41', 'admin', '$2y$10$/aYIMINFCDjCA6o2tM8dn.37M0Bex3TIm2a6u0s9WPCP3bdryrGA.', 'admin', 'admin', 'admin', 'admin', 'Administrator', '2000-12-02', '14:30:20'),
(42, 'EMP_42', 'boj', '$2y$10$0HlKaeWRXc14yl7TQPrC..gjeUb2/Ix97qNK5jBe59q5dvhHzRuge', 'Boj', '', 'Bojelz', '9090', 'Administrator', '2021-11-27', '23:00:00'),
(43, 'EMP_43', 'bojboj', '$2y$10$IwL75sO.hDcUSaqWFvLF/OxnLjeAC6.C55cNH.vqtpTqZVsxYFoXa', 'Bojel', '', 'Legaspi', '1010', 'Administrator', '2021-11-27', '09:04:24'),
(44, 'EMP_44', 'miles', '$2y$10$e2Fim1Tt86AFnU1Fc2/KAu47/3YFU8jw3mFeH2V9J80lex8MYYR5C', 'Miles', '', 'Morales', '0072', 'Administrator', '2021-11-27', '09:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admission`
--

CREATE TABLE `tbl_admission` (
  `record_admission_id` int(20) NOT NULL,
  `patient_id` int(20) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admission`
--

INSERT INTO `tbl_admission` (`record_admission_id`, `patient_id`, `pdf_path`, `date`, `file_name`) VALUES
(1, 3, 'patient/3/admission/2021111434500-legaspi.pdf', '2021-11-14', '2021111434500-legaspi.pdf'),
(2, 1, 'patient/1/admission/2021112320627-mendoza.pdf', '2021-11-23', '2021112320627-mendoza.pdf'),
(3, 1, 'patient/1/admission/20211126101552-mendoza.pdf', '2021-11-26', '20211126101552-mendoza.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_consult`
--

CREATE TABLE `tbl_consult` (
  `record_cons_id` int(20) NOT NULL,
  `patient_id` int(20) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_consult`
--

INSERT INTO `tbl_consult` (`record_cons_id`, `patient_id`, `pdf_path`, `date`, `file_name`) VALUES
(1, 5, 'patient/5/consultation/2021111434754-de jesus.pdf', '2021-11-14', '2021111434754-de jesus.pdf'),
(2, 1, 'patient/1/consultation/20211126101455-mendoza.pdf', '2021-11-26', '20211126101455-mendoza.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lab_result`
--

CREATE TABLE `tbl_lab_result` (
  `lab_result_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_lab_result`
--

INSERT INTO `tbl_lab_result` (`lab_result_id`, `patient_id`, `pdf_path`, `date`, `file_name`) VALUES
(1, 6, 'patient/6/laboratory_result/IT 403_Elective 5 (Web Systems and Technologies 3)_Syllabus.pdf', '2021-11-14', 'IT 403_Elective 5 (Web Systems and Technologies 3)_Syllabus.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_med_cert`
--

CREATE TABLE `tbl_med_cert` (
  `record_med_cert_id` int(20) NOT NULL,
  `patient_id` int(20) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_med_cert`
--

INSERT INTO `tbl_med_cert` (`record_med_cert_id`, `patient_id`, `pdf_path`, `date`, `file_name`) VALUES
(1, 1, 'patient/1/medical certificate/2021111433848-mendoza.pdf', '2021-11-14', '2021111433848-mendoza.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients`
--

CREATE TABLE `tbl_patients` (
  `patient_id` int(30) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `address` varchar(150) NOT NULL,
  `birthdate` varchar(30) NOT NULL,
  `occupation` varchar(30) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `record_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_patients`
--

INSERT INTO `tbl_patients` (`patient_id`, `first_name`, `middle_name`, `last_name`, `contact_no`, `sex`, `religion`, `address`, `birthdate`, `occupation`, `status`, `record_status`) VALUES
(1, 'Jasper Jake', 'Alvaro', 'Mendoza', '09089786754', 'Male', 'Roman Catholic', 'Maunlad Homes', '2021-10-28', 'Boxers', 'Not Admitted', 'Active'),
(3, 'Lady Bojel', 'Ignacio', 'Legaspi', '09089786754', 'Female', 'Katoliko', 'Batia Bocaue', '1999-12-23', 'Axie Scholar', 'Not Admitted', 'Active'),
(5, 'Dindy', 'Costales', 'de Jesus', '09089786754', 'Female', 'Roman Catholic', 'Malolos, Bulacan', '1999-09-15', 'Streamer', 'Not Admitted', 'Archive'),
(6, 'Dexter', '', 'Balot', '09089786754', 'Male', 'INC', 'Mc Arthur Highway', '2021-11-11', 'Doctor', 'Not Admitted', 'Archive'),
(8, 'Halord', 'Pechardo', 'de Tiger', '', 'Male', '', 'JEDS ISLAND', '1999-09-16', '', 'Not Admitted', 'Active');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `acc_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_admission`
--
ALTER TABLE `tbl_admission`
  MODIFY `record_admission_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_consult`
--
ALTER TABLE `tbl_consult`
  MODIFY `record_cons_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_lab_result`
--
ALTER TABLE `tbl_lab_result`
  MODIFY `lab_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_med_cert`
--
ALTER TABLE `tbl_med_cert`
  MODIFY `record_med_cert_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  MODIFY `patient_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- Constraints for table `tbl_lab_result`
--
ALTER TABLE `tbl_lab_result`
  ADD CONSTRAINT `tbl_lab_result_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patients` (`patient_id`);

--
-- Constraints for table `tbl_med_cert`
--
ALTER TABLE `tbl_med_cert`
  ADD CONSTRAINT `tbl_med_cert_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patients` (`patient_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
