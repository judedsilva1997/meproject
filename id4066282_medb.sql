-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 30, 2018 at 05:56 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id4066282_medb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Attendance`
--

CREATE TABLE `Attendance` (
  `RollNo` int(10) NOT NULL,
  `Percentage` int(4) NOT NULL,
  `Remarks` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Month` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Approve` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Dean`
--

CREATE TABLE `Dean` (
  `RollNo` int(10) NOT NULL,
  `Approve` int(1) NOT NULL,
  `Month` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Faculty`
--

CREATE TABLE `Faculty` (
  `RollNo` int(11) NOT NULL,
  `Remarks` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Month` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Approve` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `GrantInfo`
--

CREATE TABLE `GrantInfo` (
  `RollNo` int(7) NOT NULL,
  `Attendance` int(3) DEFAULT NULL,
  `AttRemarks` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GuideRemarksAtt` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GuideRemarksWork` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FacultyRemarks` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MECoordinator` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Dean` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Month` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Guide`
--

CREATE TABLE `Guide` (
  `RollNo` int(10) NOT NULL,
  `RemarksAttendance` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `RemarksWork` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Month` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Approve` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `MECoordinator`
--

CREATE TABLE `MECoordinator` (
  `RollNo` int(11) NOT NULL,
  `RemarksME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Approve` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Month` varchar(5) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Role`
--

CREATE TABLE `Role` (
  `Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `TypeId` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `State`
--

CREATE TABLE `State` (
  `CurrentYear` int(4) NOT NULL,
  `CurrentMonth` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Allow` int(1) NOT NULL,
  `ID` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Students`
--

CREATE TABLE `Students` (
  `RollNo` int(7) NOT NULL,
  `Name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Contact` bigint(11) NOT NULL,
  `Branch` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `Batch` int(4) NOT NULL,
  `AttCoordiator` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Guide` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Faculty` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `MECoordinator` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Teachers`
--

CREATE TABLE `Teachers` (
  `Name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Contact` bigint(11) NOT NULL,
  `Password` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Branch` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `SignedIn` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `UserType`
--

CREATE TABLE `UserType` (
  `TypeId` int(2) NOT NULL,
  `Type` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`RollNo`);

--
-- Indexes for table `Teachers`
--
ALTER TABLE `Teachers`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `UserType`
--
ALTER TABLE `UserType`
  ADD PRIMARY KEY (`TypeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `UserType`
--
ALTER TABLE `UserType`
  MODIFY `TypeId` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
