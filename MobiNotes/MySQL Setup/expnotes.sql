
-- Database: `expnotes`
--
CREATE DATABASE IF NOT EXISTS `expnotes` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `expnotes`;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `code` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`code`, `name`) VALUES
('ALL', 'All'),
('AGL', 'Applied Geology'),
('AGP', 'Applied Geophysics'),
('CME', 'Chemical Engineering'),
('CVE', 'Civil Engineering'),
('CSE', 'Computer Science and Engineering'),
('CSD', 'Computer Science and Engineering (Dual Degree)'),
('EE', 'Electrical Engineering'),
('ECE', 'Electronics and Communication Engineering'),
('EIE', 'Electronics and Instrumentation Engineering'),
('EP', 'Engineering Physics'),
('EVE', 'Environmental Engineering'),
('MNC', 'Mathematics and Computing'),
('MECH', 'Mechanical Engineering'),
('FME', 'Mineral Engineering'),
('ME', 'Mining Engineering'),
('MME', 'Mining Machinery Engineering'),
('PE', 'Petroleum Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `docs`
--

CREATE TABLE `docs` (
  `sl` mediumint(9) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `upvote` mediumint(9) DEFAULT 0,
  `created` varchar(100) NOT NULL,
  `branch` varchar(3) NOT NULL,
  `semester` varchar(4) NOT NULL,
  `uploader` varchar(10) NOT NULL,
  `description` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `docs`
--

INSERT INTO `docs` (`sl`, `filename`, `upvote`, `created`, `branch`, `semester`, `uploader`, `description`) VALUES
(8, 'M - 3.pdf', 0, '2019-10-29 06:14:25', 'ALL', '3', 'cse_admin', 'Engineering Mathematics - III syllabus for CS 3 Sem 2017 scheme _ VTU CBCS 17MAT31 Syllabus'),
(9, 'ADE.pdf', 1, '2019-10-29 06:15:17', 'CSE', '3', 'cse_admin', 'Analog and Digital Electronics syllabus for CS 3 Sem 2017 scheme | VTU CBCS 17CS32 Syllabus'),
(10, 'DS.pdf', 3, '2019-10-29 06:16:28', 'CSE', '3', 'cse_admin', 'Data Structures and Applications syllabus'),
(11, 'CO.pdf', 2, '2019-10-29 06:17:00', 'CSE', '3', 'cse_admin', 'Computer Organization syllabus'),
(12, 'Unix.pdf', 2, '2019-10-29 06:17:42', 'CSE', '3', 'cse_admin', 'Unix and Shell Programming syllabus'),
(13, 'DMS.pdf', 2, '2019-10-29 06:18:30', 'CSE', '3', 'cse_admin', 'Discrete Mathematical Structures syllabus ');

-- --------------------------------------------------------

--
-- Table structure for table `stud`
--

CREATE TABLE `stud` (
  `id` varchar(20) NOT NULL,
  `pwd` varchar(200) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stud`
--

INSERT INTO `stud` (`id`, `pwd`, `email`, `name`) VALUES
('lakshmi', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lkgowda2012@gmail.co', NULL),
('PRAJWAL', '123456', 'prajwal@gmail.com', NULL),
('rakesh', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'rakeshrohitt21@gmail', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(10) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `about` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `pwd`, `email`, `name`, `about`) VALUES
('Admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin@gmail.com', '', ''),
('cse_admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'cse_admin@gmail.com', 'Raghavendra  B K', 'HOD\r\nDept., of CSE\r\nBGS Institue of Technology'),
('cv_admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'cv_admin@gmail.com', '', ''),
('EC_admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'ec_admin@gmail.com', '', ''),
('mech_admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'mech_admin@gmail.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `user_id` varchar(10) NOT NULL,
  `doc_id` mediumint(9) NOT NULL,
  `vote` mediumint(9) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`user_id`, `doc_id`, `vote`) VALUES
('lakshmi', 1, 1),
('abcde', 1, 1),
('karthi', 2, 1),
('rakesh', 2, 1),
('abcde', 2, 0),
('PRAJWAL', 13, 1),
('PRAJWAL', 12, 1),
('PRAJWAL', 11, 1),
('PRAJWAL', 10, 1),
('lakshmi', 13, 1),
('lakshmi', 12, 1),
('cse_admin', 10, 1),
('cse_admin', 9, 1),
('lakshmi', 11, 1),
('lakshmi', 10, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `docs`
--
ALTER TABLE `docs`
  ADD PRIMARY KEY (`sl`),
  ADD UNIQUE KEY `filename` (`filename`);

--
-- Indexes for table `stud`
--
ALTER TABLE `stud`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `docs`
--
ALTER TABLE `docs`
  MODIFY `sl` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;