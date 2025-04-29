SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ------------ User Table ---------------
CREATE TABLE `user` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(18) NOT NULL,
  `name` varchar(50) NOT NULL,
  `fatherName` varchar(50) DEFAULT NULL,
  `gender` ENUM('M', 'F') NOT NULL,
  `college` varchar(100) DEFAULT NULL,
  `department` VARCHAR(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` ENUM('student', 'teacher', 'header') DEFAULT 'student',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `user` (`id`,`email`, `password`, `name`, `fatherName`, `gender`, `college`, `department`, `phone`, `role`, `date`) VALUES
(1,'teacher@gmail.com', 'teacher','Teacher1', '', 'M', 'IOT', '','0123456', 'teacher', NOW()), 
(500,'header@gmail.com', 'header','header1', '', 'M', 'IOT', '','84151', 'header', NOW()), 
(1000,'student@gmail.com', 'student','Student1', '', 'M', 'IOT', 'IT','0123457', 'student', NOW()); 

-- ------------ Answer Table ---------------
CREATE TABLE `answer` (
  `qid` text NOT NULL,
  `ansid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `answer` (`qid`, `ansid`) VALUES
('q001', 'b'),
('q002', 'b'),
('q003', 'b'),
('q004', 'b');

-- ------------ History Table ---------------
CREATE TABLE `history` (
  `email` varchar(50) NOT NULL,
  `eid` text NOT NULL,
  `score` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `history` (`email`, `eid`, `score`, `level`, `mark`, `wrong`, `date`) VALUES
('student@gmail.com', 'quiz001', 4, 1, 4, 1, NOW()),
('student@gmail.com', 'quiz002', 8, 2, 8, 2, NOW());

-- ------------ Options Table ---------------
CREATE TABLE `options` (
  `qid` varchar(50) NOT NULL,
  `option` varchar(5000) NOT NULL,
  `optionid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
('q004', 'Carbon Dioxide', 'd');

-- ------------ Questions Table ---------------
CREATE TABLE `questions` (
  `eid` text NOT NULL,
  `qid` text NOT NULL,
  `qns` text NOT NULL,
  `choice` int(10) NOT NULL,
  `sn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `questions` (`eid`, `qid`, `qns`, `choice`, `sn`) VALUES
('quiz001', 'q001', 'What is 2 + 2?', 4, 1),
('quiz001', 'q002', 'What is 5 * 3?', 4, 2),
('quiz002', 'q003', 'What planet is known as the Red Planet?', 4, 1),
('quiz002', 'q004', 'What is H2O commonly known as?', 4, 2);

-- ------------ Exam Table ---------------
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

INSERT INTO `exam` (`eid`, `title`, `mark`, `total`, `time`, `intro`, `date`, `email`) VALUES
('quiz001', 'Basic Math Quiz', 1, 5, 5, 'Test your basic math skills!', NOW(), 'teacher@gmail.com'),
('quiz002', 'Science Fundamentals', 2, 10, 10, 'A quiz about basic science concepts.', NOW(), 'teacher@gmail.com');

-- ------------ Rank Table ---------------
CREATE TABLE `rank` (
  `email` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `rank` (`email`, `score`, `time`) VALUES
('student@gmail.com', 12, NOW());