-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 28, 2017 at 06:14 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `question_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`, `admin_status`) VALUES
(1, 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Questions`
--

CREATE TABLE `Questions` (
  `Question_Id` int(11) NOT NULL,
  `Questions_Template_Id` int(11) NOT NULL,
  `Question_name` text NOT NULL,
  `Question_Input_Type` varchar(50) NOT NULL,
  `Question_DateTime` datetime NOT NULL,
  `Status` tinyint(4) NOT NULL COMMENT '1 for active, 2 for inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Questions`
--

INSERT INTO `Questions` (`Question_Id`, `Questions_Template_Id`, `Question_name`, `Question_Input_Type`, `Question_DateTime`, `Status`) VALUES
(1, 11, 'dfgdfgdf', '2', '2017-03-29 02:35:05', 1),
(2, 11, 'fgdfgdfg', '0', '2017-03-29 02:35:05', 1),
(3, 11, '', '0', '2017-03-29 02:35:05', 1),
(8, 12, 'question 1', 'select', '2017-03-29 02:42:01', 2),
(9, 12, 'question2', 'text', '2017-03-29 02:42:01', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Template`
--

CREATE TABLE `Template` (
  `Template_Id` int(11) NOT NULL,
  `Template_Name` varchar(250) NOT NULL,
  `Template_Create_Datetime` datetime NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 for active & 2 for inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Template`
--

INSERT INTO `Template` (`Template_Id`, `Template_Name`, `Template_Create_Datetime`, `Status`) VALUES
(11, 'fdgdfg', '2017-03-29 02:35:05', 1),
(12, 'my template', '2017-03-29 02:40:10', 2);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `User_Id` int(11) NOT NULL,
  `User_Full_Name` varchar(155) NOT NULL,
  `User_Email` varchar(255) NOT NULL,
  `User_Mob_No` bigint(20) NOT NULL,
  `User_Password` varchar(255) NOT NULL,
  `User_Device_Type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 for android & 2 for iPhon',
  `User_Device_Token` text NOT NULL,
  `User_Created_Datetime` datetime DEFAULT NULL,
  `User_Last_Login` datetime DEFAULT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 for active, 2 for inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`User_Id`, `User_Full_Name`, `User_Email`, `User_Mob_No`, `User_Password`, `User_Device_Type`, `User_Device_Token`, `User_Created_Datetime`, `User_Last_Login`, `Status`) VALUES
(1, 'Hemant rawat', 'hemant@gmail.com', 9981104347, 'ddsfdsfdsf313sdf4dsf354sdfds', 0, 'dfsdfd5df5dsf5sdf4s5df45sdf', '2017-03-24 00:00:00', '2017-03-24 00:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Questions`
--
ALTER TABLE `Questions`
  ADD PRIMARY KEY (`Question_Id`),
  ADD KEY `Questions_Template_Id` (`Questions_Template_Id`);

--
-- Indexes for table `Template`
--
ALTER TABLE `Template`
  ADD PRIMARY KEY (`Template_Id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`User_Id`),
  ADD UNIQUE KEY `User_Email` (`User_Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Questions`
--
ALTER TABLE `Questions`
  MODIFY `Question_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `Template`
--
ALTER TABLE `Template`
  MODIFY `Template_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Questions`
--
ALTER TABLE `Questions`
  ADD CONSTRAINT `Questions_ibfk_1` FOREIGN KEY (`Questions_Template_Id`) REFERENCES `Template` (`Template_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
