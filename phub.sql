-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2017 at 11:15 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phub`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `applicant_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `file_upload` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `acct_no` int(11) NOT NULL,
  `due_date` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `bill_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `adviser_id` int(11) NOT NULL,
  `class_description` varchar(255) NOT NULL,
  `enrollment_key` varchar(255) NOT NULL,
  `class_time_sched` varchar(255) NOT NULL,
  `class_day_sched` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `program_id`, `adviser_id`, `class_description`, `enrollment_key`, `class_time_sched`, `class_day_sched`, `status`) VALUES
(1, 3, 11, 'Hello.', 'o7R1GNvz', '13:00 - 16:00', 'Monday, Wednesday, Friday', 'ACTIVE'),
(2, 4, 5, 'Practicum 1', '6Qe0Iruw', '13:30 - 14:30', 'Monday, Wednesday, Friday', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_branch` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `company_contact` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'company.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `partner_id`, `company_name`, `company_branch`, `company_address`, `company_contact`, `image`) VALUES
(1, 3, 'Code Ramen Tech', 'Main Branch', 'IT Park', '93828948202', 'company.png'),
(2, 4, 'The TIDE', 'Sky Rise 1', 'IT Park', '9282383748', 'company.png'),
(3, 7, 'The TIDE', 'Main', 'IT Park', '8499284928', 'company.png'),
(4, 16, 'Company 1', 'Branch 1', 'Address 1', '09383838388', 'company_4.png'),
(5, 17, 'Nanatsu No Taizai', 'Main', 'Kaynes', '04948448833', 'company.png');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_key` varchar(255) NOT NULL,
  `school_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `department_dean` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_key`, `school_id`, `department_name`, `department_dean`, `contact_no`) VALUES
(3, 'pHK3htCXk4GMu5G', 9, 'CCS', 'Ninal', '938382783'),
(4, '4Aqh1cmqxKYrdYC', 9, 'Education', 'Tangpos', '9388829483'),
(5, 'hH8g7yM4tgbhcMV', 9, 'Engineering', 'Islao', '9938383838'),
(6, 'xFPPBvvM1KebBmD', 10, 'CCS', 'Rago', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `dept_admins`
--

CREATE TABLE `dept_admins` (
  `dept_admin_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `acct_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept_admins`
--

INSERT INTO `dept_admins` (`dept_admin_id`, `school_id`, `department_id`, `acct_no`) VALUES
(1, 9, 3, 7),
(2, 10, 6, 8),
(3, 9, 5, 13),
(4, 9, 4, 14),
(5, 0, 0, 16);

-- --------------------------------------------------------

--
-- Table structure for table `dtr`
--

CREATE TABLE `dtr` (
  `dtr_id` int(11) NOT NULL,
  `intern_id` int(11) NOT NULL,
  `diary` text NOT NULL,
  `time_in` varchar(255) NOT NULL,
  `time_out` varchar(255) NOT NULL,
  `dtr_status` varchar(255) NOT NULL DEFAULT 'ON DUTY'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dtr`
--

INSERT INTO `dtr` (`dtr_id`, `intern_id`, `diary`, `time_in`, `time_out`, `dtr_status`) VALUES
(1, 1, 'Haha. This is my Diary. Are you crazy?', '31 January, 2017 - 11:57 PM', '01 February, 2017 - 12:02 AM', 'RECORDED'),
(2, 1, '', '01 February, 2017 - 12:02 AM', '01 February, 2017 - 12:02 AM', 'DECLINED'),
(3, 1, '', '01 February, 2017 - 12:02 AM', '01 February, 2017 - 12:02 AM', 'DECLINED'),
(4, 1, '', '01 February, 2017 - 12:02 AM', '01 February, 2017 - 12:02 AM', 'DECLINED'),
(5, 1, '', '01 February, 2017 - 12:03 AM', '01 February, 2017 - 12:12 AM', 'RECORDED'),
(6, 1, '', '01 February, 2017 - 12:12 AM', '01 February, 2017 - 12:12 PM', 'DECLINED'),
(7, 1, '', '01 February, 2017 - 01:05 AM', '01 February, 2017 - 01:05 PM', 'RECORDED'),
(8, 1, '', '01 February, 2017 - 11:06 PM', '2 February, 2017 - 11:06 AM', 'RECORDED'),
(9, 1, '', '02 February, 2017 - 11:07 PM', '3 February, 2017 - 11:07 AM', 'RECORDED'),
(10, 1, '', '01 February, 2017 - 01:09 AM', '01 February, 2017 - 01:09 PM', 'RECORDED'),
(11, 1, '', '03 February, 2017 - 03:21 PM', '04 February, 2017 - 03:29 PM', 'DECLINED'),
(12, 1, '', '04 February, 2017 - 03:29 PM', '05 February, 2017 - 03:32 PM', 'DECLINED'),
(13, 1, '', '01 February, 2017 - 01:19 PM', '2 February, 2017 - 01:19 AM', 'RECORDED'),
(14, 1, '', '02 February, 2017 - 01:49 AM', '02 February, 2017 - 01:49 PM', 'RECORDED'),
(15, 1, '', '02 February, 2017 - 01:51 PM', '3 February, 2017 - 01:51 AM', 'RECORDED'),
(16, 1, '', '03 February, 2017 - 01:53 PM', '4 February, 2017 - 01:53 AM', 'RECORDED'),
(17, 1, '', '04 February, 2017 - 01:56 AM', '04 February, 2017 - 01:56 PM', 'RECORDED'),
(18, 1, '', '04 February, 2017 - 02:01 PM', '05 February, 2017 - 02:01 AM', 'RECORDED'),
(19, 1, '', '02 February, 2017 - 03:34 AM', '02 February, 2017 - 03:40 AM', 'RECORDED'),
(20, 1, 'Hello. It''s me. I am Awesome.', '02 February, 2017 - 05:30 PM', '02 February, 2017 - 06:39 PM', 'RECORDED'),
(21, 1, 'Today, I did a lot of things. Things that only me who can do.', '02 February, 2017 - 06:56 PM', '02 February, 2017 - 07:04 PM', 'RECORDED'),
(22, 1, 'It''s so awesome today.', '03 February, 2017 - 04:16 PM', '04 February, 2017 - 02:31 AM', 'RECORDED'),
(23, 1, 'Haha.', '04 February, 2017 - 02:32 AM', '04 February, 2017 - 02:32 PM', 'RECORDED'),
(24, 3, 'Lingaw kaayo. Nag code ko pero daghan ug error. Haha.', '04 February, 2017 - 02:32 AM', '04 February, 2017 - 02:32 PM', 'RECORDED'),
(25, 3, 'Hello there Hi :D', '08 February, 2017 - 03:24 AM', '08 February, 2017 - 04:55 AM', 'RECORDED'),
(26, 1, 'Milo everyday.', '08 February, 2017 - 04:55 AM', '08 February, 2017 - 04:55 PM', 'RECORDED'),
(27, 3, '', '08 February, 2017 - 04:57 AM', '', 'ON DUTY'),
(28, 1, 'This is the last. Haha.', '09 February, 2017 - 01:46 AM', '09 February, 2017 - 02:01 AM', 'RECORDED'),
(29, 1, 'I''m coding today. I''m testing my code too.', '11 February, 2017 - 12:38 AM', '11 February, 2017 - 12:39 AM', 'RECORDED'),
(30, 1, '', '11 February, 2017 - 01:08 AM', '11 February, 2017 - 01:09 AM', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `hired_interns`
--

CREATE TABLE `hired_interns` (
  `intern_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `date_hired` varchar(255) NOT NULL,
  `dept_assigned` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interns`
--

CREATE TABLE `interns` (
  `intern_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `hiredate` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interns`
--

INSERT INTO `interns` (`intern_id`, `trainer_id`, `student_id`, `hiredate`, `position`) VALUES
(1, 4, 3, '13 January, 2017', 'Programmer'),
(3, 4, 10, '04 February, 2017 - 02:30 AM', ''),
(4, 20, 19, '27 February, 2017 - 05:09 PM', ''),
(5, 20, 19, '27 February, 2017 - 05:09 PM', ''),
(6, 20, 19, '27 February, 2017 - 05:11 PM', '');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_desc` text NOT NULL,
  `slots_available` int(11) NOT NULL,
  `date_posted` varchar(255) NOT NULL,
  `acct_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_desc`, `slots_available`, `date_posted`, `acct_no`) VALUES
(1, 'Junior Programmer with or without experience at least 18 years old. High School graduate.\r\n\r\nThanks.', 50, '28 January, 2017', 4),
(2, 'Web developer with atleast 1 year of experience. Knows php and willing to work as a fulltime.', 100, '28 January, 2017', 4),
(3, 'A developer with atleast 2 years of experience in programming. Knows basic OOP.', 19, '28 January, 2017', 4),
(6, 'Just a simple programmer who knows how to code.', 9, '08 February, 2017', 4),
(7, 'Hello', 300, '27 February, 2017', 4),
(8, 'Hello', 91, '27 February, 2017', 20);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `partner_id` int(11) NOT NULL,
  `partner_key` varchar(255) NOT NULL,
  `partner_type` varchar(255) NOT NULL,
  `partner_status` varchar(255) NOT NULL DEFAULT 'ACTIVE',
  `partner_dateadded` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`partner_id`, `partner_key`, `partner_type`, `partner_status`, `partner_dateadded`) VALUES
(1, '', 'school', 'DELETED', '23 December, 2016'),
(2, '', 'school', 'DELETED', '23 December, 2016'),
(3, '', 'company', 'DELETED', '23 December, 2016'),
(4, '', 'company', 'DELETED', '23 December, 2016'),
(7, 'WK6UFGKZKyWKofC', 'company', 'ACTIVE', '27 December, 2016'),
(8, 'o7gJsiOFQ2BEhF6', 'school', 'DELETED', '27 December, 2016'),
(9, 'Qr6IagNNC2Ro4KU', 'school', 'DELETED', '06 January, 2017'),
(10, 'ZQ78YFDwT915vFL', 'school', 'DELETED', '06 January, 2017'),
(11, '3HAY3qsBmPJRAFN', 'school', 'DELETED', '06 January, 2017'),
(12, 'tU6i3vZVKO9ZLFz', 'school', 'ACTIVE', '06 January, 2017'),
(13, 'iXyuDLBsYlt4MPl', 'school', 'ACTIVE', '06 January, 2017'),
(14, 'SeGyAGp6lSFcviz', 'school', 'ACTIVE', '06 January, 2017'),
(15, 'utGnoO0wPPUsL97', 'school', 'ACTIVE', '26 January, 2017'),
(16, 'ByD659T7IQHec1x', 'company', 'ACTIVE', '28 January, 2017'),
(17, 'ohfBH6rCA2u6u9C', 'company', 'ACTIVE', '27 February, 2017');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `acct_no` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `mode_of_payment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penalties`
--

CREATE TABLE `penalties` (
  `penalty_id` int(11) NOT NULL,
  `adviser_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `no_of_hours` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `phub_admin`
--

CREATE TABLE `phub_admin` (
  `admin_no` int(11) NOT NULL,
  `acct_no` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phub_admin`
--

INSERT INTO `phub_admin` (`admin_no`, `acct_no`, `status`, `date_added`) VALUES
(1, 6, 'Active', '6 December, 2016'),
(2, 9, 'Active', '11 December, 2016');

-- --------------------------------------------------------

--
-- Table structure for table `postleft`
--

CREATE TABLE `postleft` (
  `postleft_id` int(11) NOT NULL,
  `subplan_no` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postleft`
--

INSERT INTO `postleft` (`postleft_id`, `subplan_no`, `count`) VALUES
(1, 8, 8),
(2, 9, 13),
(3, 10, 30),
(4, 11, 99);

-- --------------------------------------------------------

--
-- Table structure for table `practicum_advisers`
--

CREATE TABLE `practicum_advisers` (
  `adviser_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `acct_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `practicum_advisers`
--

INSERT INTO `practicum_advisers` (`adviser_id`, `school_id`, `department_id`, `acct_no`) VALUES
(1, 10, 6, 5),
(2, 9, 4, 11);

-- --------------------------------------------------------

--
-- Table structure for table `practicum_programs`
--

CREATE TABLE `practicum_programs` (
  `program_id` int(11) NOT NULL,
  `program_title` varchar(255) NOT NULL,
  `program_description` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `startdate` varchar(255) NOT NULL,
  `enddate` varchar(255) NOT NULL,
  `no_of_hours` int(11) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'ACTIVE',
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `practicum_programs`
--

INSERT INTO `practicum_programs` (`program_id`, `program_title`, `program_description`, `semester`, `school_year`, `startdate`, `enddate`, `no_of_hours`, `status`, `department_id`) VALUES
(1, 'Practicum41', 'This program is for Practicum 41 second semester students only.', '2nd', 'S.Y. 2016 - 2017', '1 October, 2016', '31 March, 2017', 250, 'DELETED', 3),
(2, 'Practicum42', 'This program is only for those students who are currently enrolled in Practicum42. I am hoping for your reconsideration.', '2nd', 'S.Y. 2016 - 2017', '1 October, 2016', '3 March, 2017', 501, 'DELETED', 3),
(3, 'Practicum 43', 'This is the Practicum Program for the second semester.', '2nd', 'S.Y. 2017 - 2018', '', '', 250, 'ACTIVE', 4),
(4, 'Practicum1', '200hours', '1st', 'S.Y. 2017 - 2018', '5 January, 2017', '6 April, 2017', 200, 'ACTIVE', 6);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `request_status` varchar(255) NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `job_id`, `student_id`, `request_status`) VALUES
(1, 1, 4, 'CANCELED'),
(2, 3, 4, 'DECLINED'),
(3, 3, 4, 'DECLINED'),
(4, 2, 4, 'DECLINED'),
(5, 1, 4, 'CANCELED'),
(6, 3, 4, 'DECLINED'),
(7, 3, 4, 'DECLINED'),
(8, 3, 4, 'DECLINED'),
(9, 3, 4, 'DECLINED'),
(10, 3, 4, 'DECLINED'),
(11, 3, 5, 'DECLINED'),
(12, 2, 5, 'DECLINED'),
(13, 3, 4, 'DECLINED'),
(14, 3, 5, 'DECLINED'),
(15, 3, 5, 'DECLINED'),
(16, 3, 4, 'ACCEPTED'),
(17, 8, 19, 'CANCELED'),
(18, 8, 19, 'DECLINED'),
(19, 8, 19, 'ACCEPTED');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `school_id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_campus` varchar(255) NOT NULL,
  `school_address` varchar(255) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  `school_image` varchar(255) NOT NULL DEFAULT 'school.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`school_id`, `partner_id`, `school_name`, `school_campus`, `school_address`, `contact_no`, `school_image`) VALUES
(1, 1, 'University of Cebu', 'Main Campus', 'Sanciangko St. Cebu City', '9302382838', 'school.png'),
(2, 2, 'University of the Visayas', 'Main', 'Colon St. Cebu City', '9382928282', 'school.png'),
(3, 8, 'University of Cebu', 'Main', 'Sanciangko St. Cebu City', '93838279493', 'school.png'),
(4, 9, 'University of Cebu', 'Banilad', 'Banilad', '93838222', 'company_4.png'),
(5, 10, 'University of Cebu', 'METC', 'Mambaling', '9383398229', 'school.png'),
(6, 11, 'University of Cebu', 'METC', 'Mambaling', '988383888888', 'school.png'),
(7, 12, 'University of Cebu', 'METC', 'Mambaling', '999999', 'school.png'),
(8, 13, 'University of Cebu', 'LM', 'Lapu-Lapu - Mandaue', '982829999', 'school.png'),
(9, 14, 'University of Cebu', 'LM', 'Lapu-Lapu - Mandaue', '999383999', 'school_9.png'),
(10, 15, 'University of San Carlos', 'Main Campus', 'Pdel rosario', '090909090909', 'school.png');

-- --------------------------------------------------------

--
-- Table structure for table `school_admins`
--

CREATE TABLE `school_admins` (
  `school_admin_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `acct_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `hours_done` decimal(5,2) NOT NULL DEFAULT '0.00',
  `acct_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `school_id`, `department_id`, `class_id`, `hours_done`, `acct_no`) VALUES
(1, 0, 0, 1, '0.00', 0),
(2, 0, 0, 0, '0.00', 2),
(3, 9, 4, 1, '250.13', 3),
(4, 9, 4, 1, '13.52', 10),
(5, 0, 0, 0, '0.00', 12),
(6, 9, 5, 0, '0.00', 15),
(7, 0, 0, 0, '0.00', 17),
(8, 9, 4, 1, '0.00', 18),
(9, 9, 4, 1, '0.00', 19);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `subplan_no` int(11) NOT NULL,
  `acct_no` int(11) NOT NULL,
  `keygen` varchar(255) NOT NULL,
  `startdate` varchar(255) NOT NULL,
  `enddate` varchar(255) NOT NULL,
  `sub_status` varchar(255) NOT NULL DEFAULT 'ACTIVE',
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`subplan_no`, `acct_no`, `keygen`, `startdate`, `enddate`, `sub_status`, `description`) VALUES
(1, 4, 'gTrzLgYhrHP0UVj', '17 December, 2016', '17 April, 2016', 'TERMINATED', 'This is a four-months subscription.'),
(2, 4, 'SlP31ruUo2Jp4ko', '19 December, 2016', '19 August, 2016', 'TERMINATED', 'This is my subscription and I am so proud of it that I''ve subscribed to this. This is the new one.'),
(3, 5, 'J2NKNflz1h6kmJM', '30 December, 2016', '30 June, 2016', 'ACTIVE', 'Hello this is Adviser Ryan and I am subscribing for six months.'),
(4, 7, 'Z7KaxkR57SeSyJs', '22 December, 2016', '22 May, 2016', 'ACTIVE', 'Hello, this is my plan. I won''t tell you my plan, okay? Good.'),
(5, 8, 'wXAH72VOxbZrvIh', '12 June, 2017', '12 October, 2017', 'ACTIVE', '4months'),
(6, 4, 'z9lQg0BgNu4tgMA', '31 January, 2017', '31 July, 2017', 'TERMINATED', 'Haha.'),
(8, 4, 'vWojguxppouQE0J', '08 February, 2017 - 06:14 AM', '08 November, 2017 - 06:14 AM', 'ACTIVE', 'This subs starts at 10 posts.'),
(9, 4, 'Ff2I7JmfWAv7T8V', '11 February, 2017 - 01:23 AM', '11 November, 2017 - 01:23 AM', 'ACTIVE', 'This is my subscription.'),
(10, 4, 'kJvqxr1bQSPnuRR', '27 February, 2017 - 03:34 PM', '27 August, 2017 - 03:34 PM', 'ACTIVE', 'Gerald'),
(11, 20, 'VYVL1KrM3m1xDwZ', '27 February, 2017 - 03:43 PM', '27 March, 2017 - 03:43 PM', 'ACTIVE', 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `trainer_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `acct_no` int(11) NOT NULL,
  `acct_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`trainer_id`, `company_id`, `acct_no`, `acct_type`) VALUES
(1, 4, 4, 0),
(2, 5, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `acct_no` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_of_birth` varchar(30) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `contactno` varchar(30) NOT NULL,
  `emailadd` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'face.jpg',
  `digitalsign` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`acct_no`, `username`, `password`, `firstname`, `middlename`, `lastname`, `address`, `date_of_birth`, `gender`, `contactno`, `emailadd`, `image`, `digitalsign`, `status`, `type`) VALUES
(1, 'geraldjohnt', 'biik', 'Gerald John', 'Fuertes', 'Tangpos', 'Cebu City', '19 April, 1997', 'Male', '+639254669851', 'geraldjohnt@gmail.com', 'face.jpg', '', '', 'student'),
(2, 'geraldjohnt', 'biiksan', 'Gerald John', 'Fuertes', 'Tangpos', 'Cebu City', '19 April, 1997', 'Male', '+639254669851', 'geraldjohnt@gmail.com', 'face.jpg', '', '', 'student'),
(3, 'dvine', 'biik', 'Divine Sarah', 'Nakila', 'Vasquez', 'Lutopan Toledo Cebu', '6 September, 1996', 'Male', '+639166335466', 'dvinevasquez@gmail.com', 'user_3.jpg', '', '', 'student'),
(4, 'trainer1', 'hello', 'Byron', 'Sagarino', 'Pacres', 'Cebu City', '21 November, 1996', 'Male', '+6398273827283', 'robynpacers@gmail.com', 'user_4.jpg', '', '', 'trainer'),
(5, 'adviser1', '123', 'Ryan', 'Moradas', 'Viajedor', 'Daan Bantayan', '25 February, 1990', 'Male', '+639828473688', 'ryanviajedor@gmail.com', 'user_5.jpg', '', '', 'adviser'),
(6, 'admin', 'biik', 'Gerald John', 'Fuertes', 'Tangpos', 'Cebu City Philippines', '19 April, 1997', 'Male', '+639254669851', 'geraldjohnt@gmail.com', 'user_6.jpg', '', '', 'admin'),
(7, 'deptadmin1', '456', 'Kyle', 'Navaja', 'Cabradilla', 'Banawa', '4 September, 1997', 'Male', '0937272837383', 'kyle@gmail.com', 'user_7.png', '', '', 'department admin/School admin'),
(8, 'deptadmin2', '123', 'Oliver', 'Villanueva', 'Cordova', 'Urgello', '6 June, 1996', 'Female', '+63982794839493', 'cordov@gmail.com', 'face.jpg', '', '', 'department admin/School admin'),
(9, 'admin', 'karen', 'Karen Marie', 'D.', 'Salazar', 'Cebu City', '11 December, 2015', 'Female', '+63983748378', 'karen@gmail.com', 'face.jpg', '', '', 'admin'),
(10, 'geddy', 'bootan', 'Geddylen April ', 'Dignos', 'Samosa', 'Cebu City', '6 April, 2017', 'Female', '09325436773', 'aprilgeddylen@gmail.com', 'face.jpg', '', '', 'student'),
(11, 'jdlean', 'bootan', 'Geddylen April ', 'Dignos', 'Samosa', 'Purok 4 Upper Kintanar Compound Camputhaw Cebu, City', '6 April, 2017', 'Female', '09325436773', 'aprilgeddylen@gmail.com', 'face.jpg', '', '', 'adviser'),
(12, 'baloyko', '123', 'Ronielou', 'Baloy', 'Jabadan', 'Cebu City Philippines', '3 January, 2017', 'Male', '+639837283782', 'baloy@gmail.com', 'face.jpg', '', '', 'student'),
(13, 'naruto', '456', 'Naruto', 'Hokage', 'Uzumaki', 'Konoha', '2 February, 1989', 'Male', '+639827872892', 'naruto@gmail.com', 'face.jpg', '', '', 'department admin'),
(14, 'sasuke', '123', 'Sasuke', 'Buang', 'Uchiha', 'Konoha', '1 March, 2017', 'Male', '+639847382789', 'sasuke@gmail.com', 'face.jpg', '', '', 'department admin'),
(15, 'Nathaniel', 'benolirao29', 'Nathaniel', 'Amamangpang', 'Benolirao', 'Cebu City', '29 March, 1998', 'Male', '0943494079', 'taniepoge@gmail.com', 'face.jpg', '', '', 'student'),
(16, 'alexgoot', 'gootmusic', 'Alex', 'Luag', 'Goot', 'New York', '1 January, 1989', 'Male', '+639827372678', 'alexgoot@gmail.com', 'face.jpg', '', '', 'department admin'),
(17, 'jesboy', '123', 'Jeswryne', 'Jes', 'Gonzales', 'Cebu City', '10 February, 2017', 'Male', '9928282828', 'jesboy@gmail.com', 'face.jpg', '', '', 'student'),
(18, 'geraldko', '123123', 'Gerald John', 'Fuertes', 'Tangpos', 'Cebu City', '19 April, 1997', 'Male', '093828273883', 'geraldjohnt@gmail.com', 'user_18.jpg', '', '', 'student'),
(19, 'talaver', '123', 'Joshua Mark', 'Tala', 'Talaver', 'Cebu City Philippines', '14 February, 2017', 'Male', '09876543211', 'tala@gmail.com', 'face.jpg', '', '', 'student'),
(20, 'meliodas', 'haha', 'Meliodas', 'Nanatsu', 'No Taizai', 'Kaynes', '9 February, 2017', 'Male', '093838383838', 'meliodas@gmail.com', 'face.jpg', '', '', 'trainer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`applicant_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `dept_admins`
--
ALTER TABLE `dept_admins`
  ADD PRIMARY KEY (`dept_admin_id`);

--
-- Indexes for table `dtr`
--
ALTER TABLE `dtr`
  ADD PRIMARY KEY (`dtr_id`);

--
-- Indexes for table `hired_interns`
--
ALTER TABLE `hired_interns`
  ADD PRIMARY KEY (`intern_id`);

--
-- Indexes for table `interns`
--
ALTER TABLE `interns`
  ADD PRIMARY KEY (`intern_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`partner_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `penalties`
--
ALTER TABLE `penalties`
  ADD PRIMARY KEY (`penalty_id`);

--
-- Indexes for table `phub_admin`
--
ALTER TABLE `phub_admin`
  ADD PRIMARY KEY (`admin_no`);

--
-- Indexes for table `postleft`
--
ALTER TABLE `postleft`
  ADD PRIMARY KEY (`postleft_id`);

--
-- Indexes for table `practicum_advisers`
--
ALTER TABLE `practicum_advisers`
  ADD PRIMARY KEY (`adviser_id`);

--
-- Indexes for table `practicum_programs`
--
ALTER TABLE `practicum_programs`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `school_admins`
--
ALTER TABLE `school_admins`
  ADD PRIMARY KEY (`school_admin_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  ADD PRIMARY KEY (`subplan_no`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`trainer_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`acct_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `applicant_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `dept_admins`
--
ALTER TABLE `dept_admins`
  MODIFY `dept_admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `dtr`
--
ALTER TABLE `dtr`
  MODIFY `dtr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `hired_interns`
--
ALTER TABLE `hired_interns`
  MODIFY `intern_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interns`
--
ALTER TABLE `interns`
  MODIFY `intern_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `partner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penalties`
--
ALTER TABLE `penalties`
  MODIFY `penalty_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `phub_admin`
--
ALTER TABLE `phub_admin`
  MODIFY `admin_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `postleft`
--
ALTER TABLE `postleft`
  MODIFY `postleft_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `practicum_advisers`
--
ALTER TABLE `practicum_advisers`
  MODIFY `adviser_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `practicum_programs`
--
ALTER TABLE `practicum_programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `school_admins`
--
ALTER TABLE `school_admins`
  MODIFY `school_admin_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `subplan_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `acct_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
