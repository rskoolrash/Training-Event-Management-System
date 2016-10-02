-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2016 at 08:09 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tpevent`
--

-- --------------------------------------------------------

--
-- Table structure for table `pl_event`
--

CREATE TABLE IF NOT EXISTS `pl_event` (
  `s_email` varchar(50) NOT NULL,
  `p_cid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_event`
--

CREATE TABLE IF NOT EXISTS `tr_event` (
  `s_email` varchar(50) NOT NULL,
  `e_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_admin`
--

CREATE TABLE IF NOT EXISTS `t_admin` (
  `a_id` varchar(50) NOT NULL,
  `a_name` varchar(100) NOT NULL,
  `a_email` varchar(50) NOT NULL,
  `a_pswd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_admin`
--

INSERT INTO `t_admin` (`a_id`, `a_name`, `a_email`, `a_pswd`) VALUES
('AD001', 'Dilraj Kaur', 'bindasweety@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `t_faculty`
--

CREATE TABLE IF NOT EXISTS `t_faculty` (
  `f_name` varchar(100) NOT NULL,
  `f_email` varchar(50) NOT NULL,
  `f_reg` varchar(20) NOT NULL,
  `f_phn` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_faculty`
--

INSERT INTO `t_faculty` (`f_name`, `f_email`, `f_reg`, `f_phn`) VALUES
('Rash', '07rashmi.kri@gmail.com', 'P0007', '9988776211'),
('Ankita Saigal', '130301eer024@cutm.ac.in', 'P0005', '8987546521'),
('Ansh Sinha', 'anshsinha0309@gmail.com', 'P0004', '9876556789'),
('Archana Kumari', 'archana@gmail.com', 'P0003', '9031723784'),
('Dilraj Kaur', 'dilrajkaur18@gmail.com', 'P0001', '9031043666'),
('Rashmi Ranjan Kar', 'rashmi@cutm.ac.in', 'P00418', '9439555222'),
('Rashmi Kumari', 'rashmi@gmail.com', 'P0002', '9778165111'),
('Rashmi Sharma', 'rskoolrash@gmail.com', 'P0006', '9898765667'),
('Sabiha Parween', 'sabiha@gmail.com', 'P0008', '9905551853');

-- --------------------------------------------------------

--
-- Table structure for table `t_gallary`
--

CREATE TABLE IF NOT EXISTS `t_gallary` (
  `g_id` varchar(50) NOT NULL,
  `g_file_name` varchar(500) NOT NULL,
  `f_email` varchar(50) NOT NULL,
  `folder_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_pevent`
--

CREATE TABLE IF NOT EXISTS `t_pevent` (
  `p_cid` varchar(10) NOT NULL,
  `p_cname` varchar(50) NOT NULL,
  `p_carrv` date NOT NULL,
  `p_pakage` varchar(50) NOT NULL,
  `p_docreq` varchar(7000) NOT NULL,
  `p_abt` varchar(10000) NOT NULL,
  `p_crit` varchar(10000) NOT NULL,
  `p_upl` date NOT NULL,
  `f_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_pfile`
--

CREATE TABLE IF NOT EXISTS `t_pfile` (
  `pf_id` varchar(20) NOT NULL,
  `p_file_name` varchar(500) NOT NULL,
  `f_email` varchar(60) NOT NULL,
  `p_cid` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_reg_coord`
--

CREATE TABLE IF NOT EXISTS `t_reg_coord` (
  `f_email` varchar(50) NOT NULL,
  `rc_pswd` varchar(50) NOT NULL,
  `rc_status` varchar(20) NOT NULL,
  `rc_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_stud`
--

CREATE TABLE IF NOT EXISTS `t_stud` (
  `s_id` varchar(50) NOT NULL,
  `s_pswd` varchar(50) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_email` varchar(50) NOT NULL,
  `s_reg` varchar(20) NOT NULL,
  `s_branch` varchar(10) NOT NULL,
  `s_ph` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_stud`
--

INSERT INTO `t_stud` (`s_id`, `s_pswd`, `s_name`, `s_email`, `s_reg`, `s_branch`, `s_ph`) VALUES
('ST0001', '6fjVjMe4', 'RASHMI KUMARI', '130301csl061@cutm.ac.in', '130301csl061', 'CSE', '9778165489'),
('ST0002', 'stu', 'DILRAJ KAUR', '130301csl062@cutm.ac.in', '130301csl062', 'CSE', '9467893456');

-- --------------------------------------------------------

--
-- Table structure for table `t_tevent`
--

CREATE TABLE IF NOT EXISTS `t_tevent` (
  `e_id` varchar(50) NOT NULL,
  `e_title` varchar(500) NOT NULL,
  `e_venue` varchar(50) NOT NULL,
  `e_date` date NOT NULL,
  `e_desc` varchar(500) NOT NULL,
  `e_upld` date NOT NULL,
  `f_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_tfile`
--

CREATE TABLE IF NOT EXISTS `t_tfile` (
  `tf_id` varchar(20) NOT NULL,
  `t_file_name` varchar(500) NOT NULL,
  `f_email` varchar(60) NOT NULL,
  `e_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pl_event`
--
ALTER TABLE `pl_event`
  ADD KEY `s_email` (`s_email`), ADD KEY `p_cid` (`p_cid`);

--
-- Indexes for table `tr_event`
--
ALTER TABLE `tr_event`
  ADD KEY `s_email` (`s_email`), ADD KEY `e_id` (`e_id`);

--
-- Indexes for table `t_faculty`
--
ALTER TABLE `t_faculty`
  ADD PRIMARY KEY (`f_email`);

--
-- Indexes for table `t_gallary`
--
ALTER TABLE `t_gallary`
  ADD KEY `f_email` (`f_email`);

--
-- Indexes for table `t_pevent`
--
ALTER TABLE `t_pevent`
  ADD PRIMARY KEY (`p_cid`), ADD KEY `f_email` (`f_email`);

--
-- Indexes for table `t_pfile`
--
ALTER TABLE `t_pfile`
  ADD KEY `f_email` (`f_email`), ADD KEY `p_cid` (`p_cid`);

--
-- Indexes for table `t_reg_coord`
--
ALTER TABLE `t_reg_coord`
  ADD KEY `f_email` (`f_email`);

--
-- Indexes for table `t_stud`
--
ALTER TABLE `t_stud`
  ADD PRIMARY KEY (`s_email`);

--
-- Indexes for table `t_tevent`
--
ALTER TABLE `t_tevent`
  ADD PRIMARY KEY (`e_id`), ADD KEY `f_email` (`f_email`);

--
-- Indexes for table `t_tfile`
--
ALTER TABLE `t_tfile`
  ADD KEY `f_email` (`f_email`), ADD KEY `e_id` (`e_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pl_event`
--
ALTER TABLE `pl_event`
ADD CONSTRAINT `pl_event_ibfk_1` FOREIGN KEY (`s_email`) REFERENCES `t_stud` (`s_email`),
ADD CONSTRAINT `pl_event_ibfk_2` FOREIGN KEY (`p_cid`) REFERENCES `t_pevent` (`p_cid`);

--
-- Constraints for table `tr_event`
--
ALTER TABLE `tr_event`
ADD CONSTRAINT `tr_event_ibfk_1` FOREIGN KEY (`s_email`) REFERENCES `t_stud` (`s_email`),
ADD CONSTRAINT `tr_event_ibfk_2` FOREIGN KEY (`e_id`) REFERENCES `t_tevent` (`e_id`);

--
-- Constraints for table `t_gallary`
--
ALTER TABLE `t_gallary`
ADD CONSTRAINT `t_gallary_ibfk_1` FOREIGN KEY (`f_email`) REFERENCES `t_faculty` (`f_email`);

--
-- Constraints for table `t_pevent`
--
ALTER TABLE `t_pevent`
ADD CONSTRAINT `t_pevent_ibfk_1` FOREIGN KEY (`f_email`) REFERENCES `t_faculty` (`f_email`);

--
-- Constraints for table `t_pfile`
--
ALTER TABLE `t_pfile`
ADD CONSTRAINT `t_pfile_ibfk_1` FOREIGN KEY (`f_email`) REFERENCES `t_reg_coord` (`f_email`),
ADD CONSTRAINT `t_pfile_ibfk_2` FOREIGN KEY (`p_cid`) REFERENCES `t_pevent` (`p_cid`);

--
-- Constraints for table `t_reg_coord`
--
ALTER TABLE `t_reg_coord`
ADD CONSTRAINT `t_reg_coord_ibfk_1` FOREIGN KEY (`f_email`) REFERENCES `t_faculty` (`f_email`);

--
-- Constraints for table `t_tevent`
--
ALTER TABLE `t_tevent`
ADD CONSTRAINT `t_tevent_ibfk_1` FOREIGN KEY (`f_email`) REFERENCES `t_faculty` (`f_email`);

--
-- Constraints for table `t_tfile`
--
ALTER TABLE `t_tfile`
ADD CONSTRAINT `t_tfile_ibfk_1` FOREIGN KEY (`f_email`) REFERENCES `t_reg_coord` (`f_email`),
ADD CONSTRAINT `t_tfile_ibfk_2` FOREIGN KEY (`e_id`) REFERENCES `t_tevent` (`e_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
