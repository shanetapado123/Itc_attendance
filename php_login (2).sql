-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2025 at 12:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_user` text NOT NULL,
  `admin_password` text NOT NULL,
  `admin_created` text NOT NULL,
  `admin_createdby` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_user`, `admin_password`, `admin_created`, `admin_createdby`) VALUES
('admin', 'admin', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `clockinout`
--

CREATE TABLE `clockinout` (
  `emId` text NOT NULL,
  `itc_name` text NOT NULL,
  `itc_clock` text NOT NULL,
  `itc_status` text NOT NULL,
  `itc_amin` text NOT NULL,
  `itc_department` text NOT NULL,
  `itc_date` text NOT NULL,
  `itc_amout` text NOT NULL,
  `itc_pmin` text NOT NULL,
  `itc_pmout` text NOT NULL,
  `itc_search` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clockinout`
--

INSERT INTO `clockinout` (`emId`, `itc_name`, `itc_clock`, `itc_status`, `itc_amin`, `itc_department`, `itc_date`, `itc_amout`, `itc_pmin`, `itc_pmout`, `itc_search`) VALUES
('22-1-1-0541', 'Shane Michael Diaz Tapado', 'AM Shift', 'am', '12:27:54', 'Japan Daiso', '2024-11-05', '03:32:25', '', '', 'f30728564fb3891f887f34610f25f630'),
('22-1-1-0541', 'Shane Michael Diaz Tapado', 'AM Shift', 'am', '03:32:56', 'Japan Daiso', '2024-11-05', '', '', '', 'a0b18b831460298dcdd6328770be985a'),
('22-1-1-0541', 'Shane Michael Diaz Tapado', 'PM Shift', 'am', '', 'Japan Daiso', '2024-11-05', '', '03:33:16', '05:56:35', '33d965fb0a4bcc0cc91f1bec0f494e43'),
('22-1-1-0541', 'Shane Michael Diaz Tapado', 'PM Shift', 'pm', '', 'Japan Daiso', '2024-11-12', '', '02:44:51', '', 'ef3129e73321f2d467154b90e8611ac2'),
('22-1-1-0541', 'Shane Michael Diaz Tapado', 'AM Shift', 'pm', '02:45:13', 'Japan Daiso', '2024-11-12', '02:57:15', '', '', '6f7dc5332f6454ac12473f37c93508ec');

-- --------------------------------------------------------

--
-- Table structure for table `empid`
--

CREATE TABLE `empid` (
  `EmpID` varchar(45) NOT NULL,
  `itc_name` varchar(45) NOT NULL,
  `itc_address` varchar(45) NOT NULL,
  `itc_department` varchar(45) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `mobile` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employeeid`
--

CREATE TABLE `employeeid` (
  `emId` varchar(45) NOT NULL,
  `itc_name` varchar(45) NOT NULL,
  `itc_address` varchar(100) NOT NULL,
  `itc_contact` varchar(45) NOT NULL,
  `itc_department` text NOT NULL,
  `itc_gender` varchar(1) NOT NULL,
  `filename` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employeeid`
--

INSERT INTO `employeeid` (`emId`, `itc_name`, `itc_address`, `itc_contact`, `itc_department`, `itc_gender`, `filename`) VALUES
('22-1-1-0541', 'Shane Michael Diaz Tapado', 'San Agustin Iba Zambales', '09673011680', 'Japan Daiso', 'M', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employeeid`
--
ALTER TABLE `employeeid`
  ADD PRIMARY KEY (`emId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
