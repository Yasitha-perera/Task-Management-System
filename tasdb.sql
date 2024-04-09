-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2024 at 10:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `extends`
--

CREATE TABLE `extends` (
  `lid` int(11) NOT NULL,
  `uid` varchar(250) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `message` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Still Pending',
  `req_receiver` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `extends`
--

INSERT INTO `extends` (`lid`, `uid`, `subject`, `message`, `status`, `req_receiver`) VALUES
(7, 'alan', 'need extend', 'need extendneed extendneed extendneed extendneed extendneed extend', 'No Action', ''),
(10, 'alan', 'extend', 'extendextendextend', 'Approved', ''),
(11, 'john', 'new extend', 'extendextendextend', 'No Action', ''),
(12, 'john', 'new extend with selected admin', 'new extend with selected admin new extend with selected admin', 'Approved', 'admin2'),
(13, 'john', 'style=\"font-weight: bolder; color:darkblue;\" ', 'style=\"font-weight: bolder; color:darkblue;\" style=\"font-weight: bolder; color:darkblue;\" ', 'Rejected', 'admin'),
(14, 'alan', 'new extend with selected admin', 'new extendnew extend', 'No Action', 'admin'),
(15, 'john', 'ate New Task', 'ate New Taskate New Taskate New Task', 'Approved', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `filetype` varchar(100) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(225) NOT NULL,
  `task` varchar(100) NOT NULL,
  `susername` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `filename`, `filetype`, `upload_date`, `username`, `task`, `susername`) VALUES
(31, 'dwdqdcx.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '2024-02-08 09:21:21', 'john', 'new task2', 'admin'),
(32, 'dwdqdcx.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '2024-02-09 08:24:06', 'john', 'newsssss', 'admin'),
(37, 'New Microsoft Word Document (2).docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '2024-02-15 07:29:56', 'john', 'new task with selected user', 'admin2'),
(38, 'New Microsoft Word Document (2).docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '2024-02-15 08:00:07', 'admin2', 'new task with selected user', 'john'),
(39, 'New Microsoft Word Document (2).docx', '', '2024-02-15 08:35:12', 'admin2', 'new task2', 'john'),
(41, 'New Microsoft Word Document (2).docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '2024-02-15 09:01:53', 'admin', 'new task for nes', 'john'),
(42, 'New Microsoft Word Document (2).docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '2024-02-16 04:20:24', 'admin', 'new task with selected user', 'alan'),
(43, 'New Microsoft Word Document (2).docx', '', '2024-02-16 04:21:17', 'alan', 'new admin select task', 'admin'),
(44, 'New Microsoft Word Document (2).docx', '', '2024-02-22 06:36:15', 'john', 'new admin select task', 'admin'),
(45, 'New Microsoft Word Document (2).docx', '', '2024-02-22 06:36:48', 'john', 'new admin select task', 'admin'),
(46, 'New Microsoft Word Document (2).docx', '', '2024-02-22 06:43:09', 'john', 'new admin select task', 'admin'),
(47, 'tms-high-resolution-logo-transparent (1).png', '', '2024-02-22 06:44:27', 'john', 'new task with selected user', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` varchar(123) NOT NULL,
  `receiver` varchar(123) NOT NULL,
  `message` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `receiver`, `message`, `timestamp`) VALUES
(70, 'admin', 'john', 'qdqdq', '2024-02-13 09:13:39'),
(71, 'john', 'admin', 'efef', '2024-02-13 09:14:17'),
(72, 'admin', 'john', 'neww', '2024-02-13 09:19:48'),
(75, 'john', 'admin', 'john', '2024-02-13 09:22:49'),
(76, 'admin', 'john', 'admin', '2024-02-13 09:22:56'),
(120, 'admin', 'alan', 'dd', '2024-02-14 04:12:43'),
(121, 'admin', 'john', 'dd', '2024-02-14 04:12:48'),
(122, 'admin', 'john', 'wfwf', '2024-02-14 04:29:20'),
(123, 'admin', 'john', 'test1', '2024-02-15 03:53:23'),
(124, 'john', 'admin', 'test1', '2024-02-15 03:53:30'),
(125, 'admin2', 'john', 'test1', '2024-02-15 03:54:20'),
(126, 'john', 'admin2', 'test1', '2024-02-15 03:54:33'),
(127, 'john', 'admin', 'dd', '2024-02-15 09:20:22'),
(128, 'admin', 'john', 'new', '2024-02-15 09:20:47'),
(129, 'john', 'admin', 'new', '2024-02-15 09:20:54'),
(130, 'admin', 'john', 'new test', '2024-02-15 09:21:30'),
(131, 'john', 'admin', 'new test', '2024-02-15 09:21:39'),
(132, 'admin', 'alan', 'new test', '2024-02-15 09:22:05'),
(133, 'john', 'admin2', 'new test', '2024-02-15 09:22:23'),
(134, 'admin2', 'alan', 'newmtest', '2024-02-15 09:22:56'),
(135, 'john', 'admin2', 'new test', '2024-02-15 09:23:00'),
(137, 'admin2', 'alan', 'fwf', '2024-02-15 09:23:06'),
(138, 'admin2', 'john', 'ddd', '2024-02-15 09:23:35'),
(139, 'admin2', 'alan', 'new', '2024-02-15 09:23:58'),
(140, 'alan', 'admin', 'new', '2024-02-15 09:24:32'),
(141, 'alan', 'admin2', 'new', '2024-02-15 09:24:39'),
(145, 'admin', 'john', '', '2024-02-22 03:28:26'),
(146, 'admin', 'john', 'new', '2024-02-22 08:55:36'),
(147, 'john', 'admin', 'new', '2024-02-22 08:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `nid` int(11) NOT NULL,
  `message` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`nid`, `message`) VALUES
(1, ''),
(2, 'new notice'),
(3, 'new notice new noticenew notice new noticenew notice new noticenew notice new noticenew notice new noticenew notice new noticenew notice new noticenew notice new notice'),
(4, 'new noticeee'),
(5, '\r\nCertainly! Here\'s a sample notice suitable for an office setting:\r\n\r\nNotice: Office Closure for Maintenance\r\n\r\nDear Team,\r\n\r\nPlease be informed that our office will be closed for maintenance on [Date] from [Start Time] to [End Time]. During this period, our maintenance team will be conducting routine checks and necessary repairs to ensure the safety and functionality of our workplace.'),
(6, 'Notice is the legal concept describing a requirement that a party be aware of legal process affecting their rights, obligations or duties. There are several types of notice: public notice, actual notice, constructive notice'),
(7, 'Notice is the legal concept describing a requirement that a party be aware of legal process affecting their rights, obligations or duties. There are several types of notice: public notice, actual notice, constructive noticeNotice is the legal concept describing a requirement that a party be aware of legal process affecting their rights, obligations or duties. There are several types of notice: public notice, actual notice, constructive noticeNotice is the legal concept describing a requirement that a party be aware of legal process affecting their rights, obligations or duties. There are several types of notice: public notice, actual notice, constructive noticeNotice is the legal concept describing a requirement that a party be aware of legal process affecting their rights, obligations or duties. There are several types of notice: public notice, actual notice, constructive notice');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `tid` int(11) NOT NULL,
  `uid` varchar(250) NOT NULL,
  `description` varchar(350) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'Not Started',
  `username` varchar(250) NOT NULL,
  `task` varchar(100) NOT NULL,
  `creator` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`tid`, `uid`, `description`, `start_date`, `end_date`, `status`, `username`, `task`, `creator`) VALUES
(22, 'wick', 'dne[nfsmcosljfoafj', '2024-02-07', '2024-02-13', 'Not Started', 'wick', 'new task2', ''),
(23, 'john', 'newnewnewnewnewnewnew', '2024-02-21', '2024-02-29', 'In-Progress', 'john', 'newsssss', ''),
(24, 'alan', 'test', '2024-02-10', '2024-02-16', 'In-Progress', 'alan', 'new test', ''),
(25, 'alan', 'anytinganytinganytinganyting', '2024-02-12', '2024-02-20', 'Complete', 'alan', 'new task for nes', ''),
(27, 'john', 'test 11', '2024-02-14', '2024-02-22', 'Complete', 'john', 'new task', ''),
(28, 'john', 'new task with selected usernew task with selected user', '2024-02-15', '2024-03-07', 'Not Started', 'john', 'new task with selected user', 'admin2'),
(29, 'john', 'new admin select task new admin select task', '2024-02-15', '2024-02-29', 'Not Started', 'john', 'new admin select task', 'admin'),
(30, 'john', 'ate New Task ate New Task ate New Task', '2024-02-22', '2024-03-01', 'In-Progress', 'john', 'ate New Task ate New Task', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(123) NOT NULL,
  `email` varchar(222) NOT NULL,
  `password` varchar(122) NOT NULL,
  `usertype` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `usertype`) VALUES
(16, 'alan', 'alan@gmail.com', '$2y$10$IlFHMdN.3V.vlaVDGDD6QOkxnUxJQVWpPT4hSioTF1/uVnNPG8l5S', 'user'),
(20, 'john', 'john@gmail.com', '$2y$10$rEk8BS.vY167EaA11yxbsOyNJcT8hXmDj.qRdkUrzK1O9ufAYwLI2', 'user'),
(21, 'admin', 'admin@gmail.com', '$2y$10$2WMKwVO3XUM41TqHaE5.6Oa528Ih0ooXqxhL1cf7UhNC7N5yjEG0a', 'admin'),
(22, 'samuel', 'samuel1@gmail.com', '$2y$10$PQfTc6eGTDAn5iexf43aeuXIcofjjWwl1g5JdWFnLO9d215X3LxUO', 'user'),
(24, 'admin2', 'samuel@gmail.com', '$2y$10$zqvhSST8idl5pOMr6/cSkeTn6vEpgOZmH9Qs0f0SaQXqkse4ERqui', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `extends`
--
ALTER TABLE `extends`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_ibfk_3` (`sender`),
  ADD KEY `messages_ibfk_4` (`receiver`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `extends`
--
ALTER TABLE `extends`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `users` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver`) REFERENCES `users` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`sender`) REFERENCES `users` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_4` FOREIGN KEY (`receiver`) REFERENCES `users` (`username`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
