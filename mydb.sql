-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 06:02 AM
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
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(10) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`, `role`) VALUES
('head@gmail.com', 'head', 'head');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `qid` text NOT NULL,
  `ansid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`qid`, `ansid`) VALUES
('67fc8129543b5', '67fc812974f91'),
('67fc8129d2795', '67fc8129deb15'),
('67fc88981ae11', '67fc8898309a6');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `email` varchar(50) NOT NULL,
  `eid` text NOT NULL,
  `score` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `sahi` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `qid` varchar(50) NOT NULL,
  `option` varchar(5000) NOT NULL,
  `optionid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`qid`, `option`, `optionid`) VALUES
('67fc80e26cbe6', 'data', '67fc80e2a5cee'),
('67fc80e26cbe6', 'date', '67fc80e2a5cf3'),
('67fc80e26cbe6', 'a&b', '67fc80e2a5cf4'),
('67fc80e26cbe6', 'conections', '67fc80e2a5cf5'),
('67fc8129543b5', 'data', '67fc812974f88'),
('67fc8129543b5', 'date', '67fc812974f8f'),
('67fc8129543b5', 'a&b', '67fc812974f90'),
('67fc8129543b5', 'conections', '67fc812974f91'),
('67fc8129d2795', 'a mobile', '67fc8129deafc'),
('67fc8129d2795', 'a tv', '67fc8129deb0d'),
('67fc8129d2795', 'a network device', '67fc8129deb15'),
('67fc8129d2795', 'none', '67fc8129deb1b'),
('67fc88981ae11', 'data', '67fc88983099e'),
('67fc88981ae11', 'structure', '67fc8898309a5'),
('67fc88981ae11', 'data strucre & algorthem', '67fc8898309a6'),
('67fc88981ae11', 'none', '67fc8898309a7');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `eid` text NOT NULL,
  `qid` text NOT NULL,
  `qns` text NOT NULL,
  `choice` int(10) NOT NULL,
  `sn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`eid`, `qid`, `qns`, `choice`, `sn`) VALUES
('67fc806da8b25', '67fc80e26cbe6', 'what is networking?', 4, 1),
('67fc806da8b25', '67fc8129543b5', 'what is networking?', 4, 1),
('67fc806da8b25', '67fc8129d2795', 'what is switch', 4, 2),
('67fc885d6aec9', '67fc88981ae11', 'what is dsa?', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `eid` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `sahi` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `time` bigint(20) NOT NULL,
  `intro` text NOT NULL,
  `tag` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`eid`, `title`, `sahi`, `wrong`, `total`, `time`, `intro`, `tag`, `date`, `email`) VALUES
('67fbe34bda506', 'Aslamualykum Abd', 2, 1, 2, 11, 'wdsdsf', '$', '2025-04-13 16:16:11', 'head@gmail.com'),
('67fbe5011f267', 'Aslamualykum Abd2', 3, 1, 3, 11, 'dsadx', '###', '2025-04-13 16:23:29', 'head@gmail.com'),
('67fbe665b00e6', 'Aslamualykum Abd', 2, 1, 2, 11, 'dsvfsc', '$', '2025-04-13 16:29:25', 'head@gmail.com'),
('67fbe6fe10bfc', 'Aslamualykum Abd', 2, 1, 2, 11, 'dsfdadA', '$', '2025-04-13 16:31:58', 'head@gmail.com'),
('67fbe8ee8ec2b', 'Aslamualykum Abd', 2, 1, 2, 11, 'sdadsads', '$', '2025-04-13 16:40:14', 'head@gmail.com'),
('67fc806da8b25', 'Aslamualykum Abd', 2, 1, 2, 11, 'dsvsfsf', '###', '2025-04-14 03:26:37', 'head@gmail.com'),
('67fc885d6aec9', 'C++', 2, 1, 1, 10, 'dfsfsf', '$', '2025-04-14 04:00:29', 'head@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `email` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(50) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `college` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mob` bigint(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
