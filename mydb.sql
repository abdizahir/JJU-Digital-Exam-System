-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 12:36 PM
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
('q001', 'b'),
('q002', 'b'),
('q003', 'b'),
('q004', 'b'),
('680f5ee06f168', '680f5ee08b904'),
('680f9751e038c', '680f975271d07'),
('680f980d773f3', '680f980e8af9f'),
('680f9afbb5d3a', '680f9afbdf0f7'),
('680f9bf5045b2', '680f9bf5328a8'),
('68109a01bf1e7', '68109a01e9509');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `eid` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `mark` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `time` bigint(20) NOT NULL,
  `intro` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`eid`, `title`, `mark`, `total`, `time`, `intro`, `date`, `email`) VALUES
('quiz001', 'Basic Math Quiz', 1, 5, 5, 'Test your basic math skills!', '2025-04-28 10:16:44', 'teacher@gmail.com'),
('quiz002', 'Science Fundamentals', 2, 10, 10, 'A quiz about basic science concepts.', '2025-04-28 10:16:44', 'teacher@gmail.com'),
('680f5e94f132e', 'Oprating System', 3, 1, 5, 'oprating system', '2025-04-28 10:55:16', 'teacher@gmail.com'),
('680f961e49a96', 'Chava', 5, 1, 10, 'jj', '2025-04-28 14:52:14', 'teacher@gmail.com'),
('680f9728e223b', 'Nmn', 4, 1, 10, 'nmn', '2025-04-28 14:56:40', 'teacher@gmail.com'),
('680f97d549b7b', 'Yy', 5, 1, 5, 'yy', '2025-04-28 14:59:33', 'teacher@gmail.com'),
('680f9ad828e69', 'Bb', 5, 1, 10, 'bb', '2025-04-28 15:12:24', 'teacher@gmail.com'),
('680f9bc1aaa25', 'Ww', 3, 1, 6, 'ww', '2025-04-28 15:16:17', 'teacher@gmail.com'),
('681099bc0e8ee', 'Programing', 3, 1, 10, 'prog', '2025-04-29 09:19:56', 'fowzy@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `email` varchar(50) NOT NULL,
  `eid` text NOT NULL,
  `score` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`email`, `eid`, `score`, `level`, `mark`, `wrong`, `date`) VALUES
('student@gmail.com', 'quiz001', 4, 1, 4, 1, '2025-04-28 10:16:43'),
('student@gmail.com', 'quiz002', 8, 2, 8, 2, '2025-04-28 10:16:43'),
('student@gmail.com', '680f5e94f132e', 3, 1, 1, 0, '2025-04-28 10:57:14'),
('student@gmail.com', '680f9728e223b', 4, 1, 1, 0, '2025-04-28 14:57:50'),
('student@gmail.com', '680f97d549b7b', 0, 1, 0, 0, '2025-04-28 15:01:01'),
('student@gmail.com', '680f9ad828e69', 5, 1, 1, 0, '2025-04-28 15:13:38'),
('student@gmail.com', '680f9bc1aaa25', 3, 1, 1, 0, '2025-04-28 15:18:10'),
('student@gmail.com', '681099bc0e8ee', 3, 1, 1, 0, '2025-04-29 09:21:40');

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
('q001', '3', 'a'),
('q001', '4', 'b'),
('q001', '5', 'c'),
('q001', '6', 'd'),
('q002', '10', 'a'),
('q002', '15', 'b'),
('q002', '20', 'c'),
('q002', '25', 'd'),
('q003', 'Earth', 'a'),
('q003', 'Mars', 'b'),
('q003', 'Venus', 'c'),
('q003', 'Jupiter', 'd'),
('q004', 'Oxygen', 'a'),
('q004', 'Water', 'b'),
('q004', 'Hydrogen', 'c'),
('q004', 'Carbon Dioxide', 'd'),
('680f5ee06f168', 'James Gosling', '680f5ee08b8f8'),
('680f5ee06f168', 'Charles Babbage', '680f5ee08b904'),
('680f5ee06f168', 'Dennis Ritchie', '680f5ee08b907'),
('680f5ee06f168', 'Bjarne Stroustrup', '680f5ee08b909'),
('680f9751e038c', '.php', '680f975271d07'),
('680f9751e038c', 'jigjiga unity', '680f975271d10'),
('680f9751e038c', 'Ahmed', '680f975271d25'),
('680f9751e038c', 'Muhsin', '680f975271d26'),
('680f980d773f3', 'central prossec unit', '680f980e8af96'),
('680f980d773f3', 'Mahad', '680f980e8af9e'),
('680f980d773f3', 'japan united', '680f980e8af9f'),
('680f980d773f3', 'none', '680f980e8afa1'),
('680f9afbb5d3a', '2', '680f9afbdf0f7'),
('680f9afbb5d3a', '3', '680f9afbdf101'),
('680f9afbb5d3a', '4', '680f9afbdf124'),
('680f9afbb5d3a', '5', '680f9afbdf127'),
('680f9bf5045b2', 'a', '680f9bf5328a8'),
('680f9bf5045b2', 'v', '680f9bf5328b4'),
('680f9bf5045b2', '', '680f9bf5328b7'),
('680f9bf5045b2', '', '680f9bf5328b9'),
('68109a01bf1e7', 'A programming language is a system of notation for writing computer programs. ', '68109a01e9509'),
('68109a01bf1e7', '$REQUEST', '68109a01e9514'),
('68109a01bf1e7', 'Dennis Ritchie', '68109a01e9517'),
('68109a01bf1e7', 'none', '68109a01e9519');

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
('quiz001', 'q001', 'What is 2 + 2?', 4, 1),
('quiz001', 'q002', 'What is 5 * 3?', 4, 2),
('quiz002', 'q003', 'What planet is known as the Red Planet?', 4, 1),
('quiz002', 'q004', 'What is H2O commonly known as?', 4, 2),
('680f5e94f132e', '680f5ee06f168', 'Who is the father of Computers?\r\n\r\n', 4, 1),
('680f9728e223b', '680f9751e038c', 'what is php', 4, 1),
('680f97d549b7b', '680f980d773f3', 'whats cpu', 4, 1),
('680f9ad828e69', '680f9afbb5d3a', '1+1', 4, 1),
('680f9bc1aaa25', '680f9bf5045b2', 'what is ww', 4, 1),
('681099bc0e8ee', '68109a01bf1e7', 'what is programing', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `email` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`email`, `score`, `time`) VALUES
('student@gmail.com', 12, '2025-04-28 10:16:45');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(18) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `gender` enum('M','F') NOT NULL,
  `college` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('admin','head','teacher','student') DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `name`, `gender`, `college`, `phone`, `role`) VALUES
(1000, 'student@gmail.com', 'student', 'Student1', 'M', 'IOT', '0123457', 'student'),
(1001, 'admin@gmail.com', 'admin', 'Admin', 'M', 'IOT', '251937480905', 'admin'),
(1005, 'tensaye@gmail.com', 'tensaye', 'tensaye', 'M', 'IOT', '0100223311', 'teacher'),
(1007, 'fowzy@gmail.com', 'fowzy', 'fowzy', 'M', 'IOT', '0100223322', 'head');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
