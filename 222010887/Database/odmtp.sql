-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 05:32 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `odmtp`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `Assessment_ID` int(50) NOT NULL,
  `Title` text NOT NULL,
  `Course_ID` int(50) NOT NULL,
  `Questions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`Assessment_ID`, `Title`, `Course_ID`, `Questions`) VALUES
(1, '0', 1, '6'),
(2, '0', 3, '5'),
(3, '0', 1, '3'),
(4, 'CAT OF WEB', 3, '5'),
(5, 'Math', 2, 'what is mathematics?');

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `Attendee_ID` int(50) NOT NULL,
  `User_ID` int(50) NOT NULL,
  `Workshop_ID` int(50) NOT NULL,
  `RegistrationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`Attendee_ID`, `User_ID`, `Workshop_ID`, `RegistrationDate`) VALUES
(1, 1, 1, '2024-05-09'),
(5, 4, 1, '2024-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `Certificate_ID` int(50) NOT NULL,
  `Course_ID` int(50) NOT NULL,
  `User_ID` int(50) NOT NULL,
  `IssueDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `curriculum`
--

CREATE TABLE `curriculum` (
  `Course_ID` int(50) NOT NULL,
  `Title` text NOT NULL,
  `Description` text NOT NULL,
  `Level` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curriculum`
--

INSERT INTO `curriculum` (`Course_ID`, `Title`, `Description`, `Level`) VALUES
(1, 'WEB', 'creating website', 'level2'),
(2, 'JAVA', 'java script', 'level2'),
(3, 'JAVA', 'java script', 'level 1');

-- --------------------------------------------------------

--
-- Table structure for table `digital marketing resource`
--

CREATE TABLE `digital marketing resource` (
  `Resource_ID` int(50) NOT NULL,
  `Title` text NOT NULL,
  `Description` text NOT NULL,
  `URL` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Feedback_ID` int(50) NOT NULL,
  `Course_ID` int(50) NOT NULL,
  `User_ID` int(50) NOT NULL,
  `Rating` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `Instructor_ID` int(50) NOT NULL,
  `FullName` text NOT NULL,
  `Expertise` text NOT NULL,
  `Bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` int(50) NOT NULL,
  `User_ID` int(50) NOT NULL,
  `AmountPaid` int(50) NOT NULL,
  `PaymentDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_Id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_Id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'rita', 'kagabe', 'kagaberita', 'ritakagabe@gmail.com', '0784961446', '$2y$10$DF/sCU0dkeM1rI95zkf/Z.AhwAFQ.A7pJgV51fdgZM7mVj/SCsMjK', '2024-05-22 11:45:03', '790', 0),
(3, 'baraka', 'rita', 'barakarita', 'barakarita@gmail.com', '078888881', '$2y$10$gYJZvlM6fm7DKoJiBfo9WuyAZuDWfwn0Cl0YMGjgSnycW.6MOqn12', '2024-05-22 11:49:28', '444', 0),
(4, 'louange', 'Gisubizo', 'natacha@gmail.com', 'louange@gmail.com', '09877655', '$2y$10$ikXmyz4ATW6nxSR5Ubuy.uL.RHMqDodTaJVrPV/WqAeLxKlX0tKWe', '2024-05-22 14:21:46', '678', 0);

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE `workshops` (
  `Workshop_ID` int(50) NOT NULL,
  `Title` text NOT NULL,
  `Description` text NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`Workshop_ID`, `Title`, `Description`, `Date`) VALUES
(1, 'webtrainings', 'website trainings', '2024-05-22'),
(2, 'web creation', ' reation of website', '2024-04-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`Assessment_ID`);

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`Attendee_ID`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`Certificate_ID`);

--
-- Indexes for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`Course_ID`);

--
-- Indexes for table `digital marketing resource`
--
ALTER TABLE `digital marketing resource`
  ADD PRIMARY KEY (`Resource_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Feedback_ID`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`Instructor_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_Id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workshops`
--
ALTER TABLE `workshops`
  ADD PRIMARY KEY (`Workshop_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
