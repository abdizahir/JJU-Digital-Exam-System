SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


-- ------------ College Table ---------------
CREATE TABLE colleges (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- ------------ Department Table ---------------
CREATE TABLE departments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  college_id INT,
  FOREIGN KEY (college_id) REFERENCES colleges(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ------------ Sections Table ---------------
CREATE TABLE sections (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(1) NOT NULL,
  department_id INT,
  FOREIGN KEY (department_id) REFERENCES departments(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;





-- ------------ User Table ---------------
CREATE TABLE `user` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(18) NOT NULL,
  `name` varchar(50) NOT NULL,
  `fatherName` varchar(50) DEFAULT NULL,
  `gender` ENUM('M', 'F') NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` ENUM('student', 'teacher', 'header', 'admin') DEFAULT 'student',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `year` ENUM('1st', '2nd', '3rd', '4th') DEFAULT null, 
  `college_id` INT DEFAULT NULL,
  `department_id` INT DEFAULT NULL,
  `section_id` INT DEFAULT NULL,
  
  FOREIGN KEY (`college_id`) REFERENCES `colleges`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`department_id`) REFERENCES `departments`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`section_id`) REFERENCES `sections`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ------------ Answer Table ---------------
CREATE TABLE `answer` (
  `qid` text NOT NULL,
  `ansid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `exam` (
  `eid` INT AUTO_INCREMENT PRIMARY KEY,     
  `title` VARCHAR(100) NOT NULL,          
  `mark` INT NOT NULL,                     
  `total` INT NOT NULL,                 
  `time` BIGINT NOT NULL,             
  `intro` TEXT NOT NULL,        
  `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creator_id` INT NOT NULL,                  
  `department_id` INT NOT NULL,                
  `year` ENUM('1st', '2nd', '3rd', '4th') DEFAULT NULL, 

  FOREIGN KEY (`creator_id`) REFERENCES `user`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`department_id`) REFERENCES `departments`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `history` (
  `email` varchar(50) NOT NULL,
  `eid` text NOT NULL,
  `score` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `options` (
  `qid` varchar(50) NOT NULL,
  `option` varchar(5000) NOT NULL,
  `optionid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `questions` (
  `eid` text NOT NULL,
  `qid` text NOT NULL,
  `qns` text NOT NULL,
  `choice` int(10) NOT NULL,
  `sn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `rank` (
  `email` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- 
-- 
-- 
-- 
-- Insert into user (Admin)
INSERT INTO `user` (`email`, `password`, `name`,`role`) VALUES
('admin@gmail.com', 'admin', 'Admin', 'admin');

INSERT INTO `colleges` (`name`) VALUES 
('Engineering and Technology'),
('Education and Behavioral Studies'),
('Business economics'),
('Social Sciences & Humanities'),
('Natural and Computational Science');

INSERT INTO `departments` (`name`, `college_id`) VALUES 
('Civil Engineering', 1),                                 
('Construction Technology and Management', 1),           
('Electrical and Computer Engineering', 1),              
('Hydraulics Engineering', 1),                           
('Mechanical Engineering', 1),                           
('Computer Science', 1),                                 
('Information Technology', 1),                           
('Software Engineering', 1),                             
('Psychology', 2),                                       
('Early Childhood Care and Education (ECCE)', 2),        
('Educational Planning and Management', 2),              
('Accounting', 3),                                       
('Management', 3),                                       
('Public administration', 3),                            
('Development Management', 3),                           
('Sociology', 4),                                        
('Ethiopian Languages and Literature', 4),               
('English Language and Literature', 4),                  
('Arabic Language and Literature', 4),                   
('Geography and Environmental Studies', 4),              
('History and Heritage Management', 4),                  
('Political Science and International Relations', 4),    
('Biology', 5),                                          
('Chemistry', 5),                                        
('Physics', 5),                                          
('Statistics', 5),                                       
('Geology', 5);                                          

INSERT INTO `sections` (`name`, `department_id`) VALUES 
('A', 1), ('A', 2), ('A', 3), ('A', 4), ('A', 5), ('A', 6), ('A', 7), ('A', 8), ('A', 9), ('A', 10),
('A', 11), ('A', 12), ('A', 13), ('A', 14), ('A', 15), ('A', 16), ('A', 17), ('A', 18), ('A', 19), 
('A', 20), ('A', 21), ('A', 22), ('A', 23), ('A', 24), ('A', 25), ('A', 26), ('A', 27), ('B', 27);


-- Insert into user (Headers)
INSERT INTO `user` (`email`, `password`, `name`, `fatherName`, `gender`, `phone`, `role`, `college_id`, `department_id`) VALUES
('header@gmail.com', 'header', 'Header', '', 'M', '251', 'header', 1, 1),
('fatima@gmail.com', 'pass1234', 'Fatima', 'Mahmoed', 'F', '25191234561', 'header', 1, 18),
('yousef@gmail.com', 'pass1234', 'Yousef', 'Abdullah', 'M', '25191234562', 'header', 4, 3),
('noura@gmail.com', 'pass1234', 'Noura', 'Abdullah', 'F', '25191234563', 'header', 2, 11),
('jamal@gmail.com', 'pass1234', 'Jamal', 'Hassan', 'M', '25191234564', 'header', 3, 12),
('kassem@gmail.com', 'pass1234', 'Kassem', 'Ahmed', 'M', '25191234565', 'header', 5, 25);

-- Insert into user (Teachers)
INSERT INTO `user` (`email`, `password`, `name`, `fatherName`, `gender`, `phone`, `role`, `college_id`, `department_id`) VALUES
('ahmed1@gmail.com', 'pass123', 'Ahmed ', 'Abdullah', 'M', '25192234561', 'teacher', 4, 22),
('sarah1@gmail.com', 'pass123', 'Sarah', 'Ali', 'F', '25192234562', 'teacher', 3, 13),
('osama1@gmail.com', 'pass123', 'Osama', 'Ahmed', 'M', '25192234563', 'teacher', 2, 11),
('faiza1@gmail.com', 'pass123', 'Faiza', 'Mohamed', 'F', '25192234564', 'teacher', 4, 21),
('abdullah1@gmail.com', 'pass123', 'Abdullah', 'Mohamed', 'M', '25192234565', 'teacher', 1, 8),
('mohamed1@gmail.com', 'pass123', 'Mohamed', 'Ibrahim', 'M', '25192234566', 'teacher', 1, 3),
('rania1@gmail.com', 'pass123', 'Rania', 'Omar', 'F', '25192234567', 'teacher', 1, 7),
('khaled1@gmail.com', 'pass123', 'Khaled', 'Yassin', 'M', '25192234568', 'teacher', 4, 19),
('layla1@gmail.com', 'pass123', 'Layla', 'Mansour', 'F', '25192234569', 'teacher', 4, 17),
('mohamed2@gmail.com', 'pass123', 'Mohamed', 'Jamal', 'M', '25192234570', 'teacher', 1, 2),
('huda1@gmail.com', 'pass123', 'Huda', 'Kamal', 'F', '25192234571', 'teacher', 4, 16),
('ammar1@gmail.com', 'pass123', 'Ammar', 'Saeed', 'M', '25192234572', 'teacher', 5, 26),
('nour1@gmail.com', 'pass123', 'Nour', 'Zaid', 'F', '25192234573', 'teacher', 3, 14),
('tariq1@gmail.com', 'pass123', 'Tariq', 'Nasr', 'M', '25192234574', 'teacher', 2, 9),
('nadine1@gmail.com', 'pass123', 'Nadine', 'Fadel', 'F', '25192234575', 'teacher', 1, 1);


-- Insert into user (Student)
INSERT INTO `user` (`email`, `password`, `name`, `fatherName`, `gender`, `phone`, `role`, `year`, `college_id`, `department_id`, `section_id`) VALUES
('student@gmail.com', 'student', 'Student1', '','M', '251', 'student', '1st', 1, 7, 1),
('student1@gmail.com', 'pass123', 'Ahmad', 'Nasser', 'M', '25192241001', 'student', '1st', 1, 1, 1),
('student2@gmail.com', 'pass123', 'Youssef', 'Youssef', 'M', '25192241002', 'student', '2nd', 2, 9, 1),
('student3@gmail.com', 'pass123', 'Sara', 'Jamal', 'F', '25192241003', 'student', '3rd', 3, 12, 1),
('student4@gmail.com', 'pass123', 'Omar', 'Ahmed', 'M', '25192241004', 'student', '1st', 4, 19, 1),
('student5@gmail.com', 'pass123', 'Layla', 'Khalil', 'F', '25192241005', 'student', '4th', 5, 24, 1),
('student6@gmail.com', 'pass123', 'Reem', 'Fouad', 'F', '25192241006', 'student', '2nd', 1, 6, 1),
('student7@gmail.com', 'pass123', 'Tariq', 'Amr', 'M', '25192241007', 'student', '3rd', 2, 10, 1),
('student8@gmail.com', 'pass123', 'Maryam', 'Noor', 'F', '25192241008', 'student', '1st', 3, 13, 1),
('student9@gmail.com', 'pass123', 'Khaled', 'Hatem', 'M', '25192241009', 'student', '4th', 4, 22, 1),
('student10@gmail.com', 'pass123', 'Dina', 'Salem', 'F', '25192241010', 'student', '2nd', 5, 25, 1),
('student11@gmail.com', 'pass123', 'Ali', 'Tamer', 'M', '25192241011', 'student', '1st', 1, 7, 1),
('student12@gmail.com', 'pass123', 'Lina', 'Nabil', 'F', '25192241012', 'student', '3rd', 2, 11, 1),
('student13@gmail.com', 'pass123', 'Hassan', 'Zaki', 'M', '25192241013', 'student', '2nd', 3, 15, 1),
('student14@gmail.com', 'pass123', 'Nour', 'Mostafa', 'F', '25192241014', 'student', '4th', 4, 20, 1),
('student15@gmail.com', 'pass123', 'Fathi', 'Jamal', 'M', '25192241015', 'student', '1st', 5, 23, 1),
('student16@gmail.com', 'pass123', 'Ahmad', 'Fouad', 'M', '25192241016', 'student', '2nd', 1, 1, 1),
('student17@gmail.com', 'pass123', 'Reem', 'Nasser', 'F', '25192241017', 'student', '3rd', 2, 9, 1),
('student18@gmail.com', 'pass123', 'Tariq', 'Ziad', 'M', '25192241018', 'student', '4th', 3, 14, 1),
('student19@gmail.com', 'pass123', 'Layla', 'Hatem', 'F', '25192241019', 'student', '1st', 4, 18, 1),
('student20@gmail.com', 'pass123', 'Khaled', 'Amr', 'M', '25192241020', 'student', '2nd', 5, 26, 1),
('student21@gmail.com', 'pass123', 'Sara', 'Tamer', 'F', '25192241021', 'student', '3rd', 1, 2, 1),
('student22@gmail.com', 'pass123', 'Ali', 'Noor', 'M', '25192241022', 'student', '4th', 2, 10, 1),
('student23@gmail.com', 'pass123', 'Maya', 'Zaki', 'F', '25192241023', 'student', '1st', 3, 13, 1),
('student24@gmail.com', 'pass123', 'Omar', 'Salem', 'M', '25192241024', 'student', '2nd', 4, 17, 1),
('student25@gmail.com', 'pass123', 'Lina', 'Khalil', 'F', '25192241025', 'student', '3rd', 5, 21, 1),
('student26@gmail.com', 'pass123', 'Ahmad', 'Ziad', 'M', '25192241026', 'student', '1st', 1, 4, 1),
('student27@gmail.com', 'pass123', 'Dina', 'Fathi', 'F', '25192241027', 'student', '2nd', 2, 11, 1),
('student28@gmail.com', 'pass123', 'Hassan', 'Mostafa', 'M', '25192241028', 'student', '3rd', 3, 12, 1),
('student29@gmail.com', 'pass123', 'Nour', 'Jamal', 'F', '25192241029', 'student', '4th', 4, 16, 1),
('student30@gmail.com', 'pass123', 'Youssef', 'Nabil', 'M', '25192241030', 'student', '1st', 5, 24, 1);





--
-- Table structure for table `exam`



-- --------------------------------------------------------

--
-- Table structure for table `history`
--


-- --------------------------------------------------------

--
-- Table structure for table `options`
--


--
-- Dumping data for table `options`
--



-- --------------------------------------------------------

--
-- Table structure for table `questions`
--


--
-- Dumping data for table `questions`
--


-- --------------------------------------------------------

--
-- Table structure for table `rank`
--


--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`email`, `score`, `time`) VALUES
('student@gmail.com', 12, '2025-04-28 10:16:45');

-- --------------------------------------------------------


