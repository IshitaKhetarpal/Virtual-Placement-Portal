-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2018 at 01:31 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testproject`
--



--
-- Table structure for table `organisation`
--

CREATE TABLE `organisation` 
(
  `o_id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `logo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `employer_credentials`
--
CREATE TABLE `orgcred`
(	
	`oc_id` int NOT NULL,
	`email` varchar(200) NOT NULL,
	`password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `jobsapplied`
--

CREATE TABLE `jobsapplied` 
(
  `id` int NOT NULL,
  `date` date NOT NULL,
  `pid` int NOT NULL,
  `s_id` int NOT NULL,
  `status` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




--
-- Table structure for table `message`
--

CREATE TABLE `message` 
(
  `id` int NOT NULL,
  `date` date NOT NULL,
  `from` int NOT NULL,
  `to` int NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Table structure for table `post`
--

CREATE TABLE `post` 
(
  `id` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `o_id` int NOT NULL,
  `c_name` varchar(200) NOT NULL,
  `role` varchar(500) NOT NULL,
  `cgpa` varchar(100) NOT NULL,
  `ctc` varchar(200) NOT NULL,
  `employmentType` varchar(500) NOT NULL,
  `reqs` varchar(5000) NOT NULL,
  `category` varchar(500) NOT NULL,
  `branch` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL,
  `jd` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `seeker`
--

CREATE TABLE `seeker` 
(
  `s_id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `o_id` int NOT NULL,
  `usn` varchar(200) NOT NULL,
  `branch` varchar(200) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `dob` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `seekermarks` 
(
  `sm_id` int NOT NULL,
  `cgpa` varchar(100) NOT NULL DEFAULT 0,
  `m10` varchar(10) NOT NULL DEFAULT 0,
  `m12` varchar(10) NOT NULL DEFAULT 0,
  `resume` varchar(200) NOT NULL DEFAULT 0,
  `mrc10` varchar(200) NOT NULL DEFAULT 0,
  `mrc12` varchar(200) NOT NULL DEFAULT 0,
  `mrcc` varchar(200) NOT NULL DEFAULT 0
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  
--
-- Table structure for table `student_credentials`
--
CREATE TABLE `seekercred`
(	
	`sc_id` int NOT NULL,
	`email` varchar(200) NOT NULL,
	`password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `student_verification`
--
CREATE TABLE `verified`
(	
	`sv_id` int NOT NULL,
	`usn` varchar(200) NOT NULL,
	`status` int NOT NULL DEFAULT -1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Indexes for table `employer`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `jobsapplied`
--
ALTER TABLE `jobsapplied`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobapplied_seekerFK` (`s_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employer_postFK` (`o_id`);

--
-- Indexes for table `seeker`
--
ALTER TABLE `seeker`
  ADD PRIMARY KEY (`s_id`);
  
--
-- Indexes for table `seeker`
--
ALTER TABLE `seekercred`
  ADD PRIMARY KEY (`email`);
  
--
-- Indexes for table `seeker`
--
ALTER TABLE `orgcred`
  ADD PRIMARY KEY (`email`);
  
ALTER TABLE `seekermarks`
  ADD PRIMARY KEY (`sm_id`);
  
  
ALTER TABLE `verified`
 ADD PRIMARY KEY (`usn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `organisation`
  MODIFY `o_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `jobsapplied`
--
ALTER TABLE `jobsapplied`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `seeker`
--
ALTER TABLE `seeker`
  MODIFY `s_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;



--
-- Constraints for Foreign Keys
--
ALTER TABLE `jobsapplied`
  ADD CONSTRAINT `jobapplied_seekerFK` FOREIGN KEY (`s_id`) REFERENCES `seeker` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `post`
  ADD CONSTRAINT `org_postFK` FOREIGN KEY (`o_id`) REFERENCES `organisation` (`o_id`) ON DELETE CASCADE ON UPDATE CASCADE;
  
ALTER TABLE `orgcred`
	ADD CONSTRAINT `org_crds` FOREIGN KEY (`oc_id`) REFERENCES `organisation`(`o_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `seeker`
  ADD CONSTRAINT `org_seekerFK` FOREIGN KEY (`o_id`) REFERENCES `organisation` (`o_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `seekercred`
	ADD CONSTRAINT `seeker_crds` FOREIGN KEY (`sc_id`) REFERENCES `seeker`(`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;
	
ALTER TABLE `seekermarks`
	ADD CONSTRAINT `seeker_marks` FOREIGN KEY (`sm_id`) REFERENCES `seeker`(`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;
	
ALTER TABLE `verified`
	ADD CONSTRAINT `verification` FOREIGN KEY (`sv_id`) REFERENCES `seeker`(`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
