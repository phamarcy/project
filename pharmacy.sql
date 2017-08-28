-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2017 at 11:52 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval_course`
--

CREATE TABLE `approval_course` (
  `approve_id` int(11) NOT NULL COMMENT 'รหัสการเห็นชอบ',
  `teacher_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสอาจารย์',
  `course_id` varchar(7) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสวิชา',
  `status` set('0','1','2','3','4') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT 'สถานะการเห็นชอบ 0 ไม่เห็นชอบ 1 รอกรอกข้อมูล 2 รอพิจารณา 3 มีแก้ไข 4 ผ่าน',
  `data_type` set('evaluate','special','syllabus') COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชนิดของเอกสารที่เห็นชอบ',
  `level_approve` set('1','2','','') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT 'ขั้นการเห็นชอบ (กรรมการ, หัวหน้าภาค)',
  `comment` text CHARACTER SET utf8,
  `semester_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `approval_course`
--

INSERT INTO `approval_course` (`approve_id`, `teacher_id`, `course_id`, `status`, `data_type`, `level_approve`, `comment`, `semester_id`, `date`) VALUES
(6, '1234', '460100', '2', 'evaluate', '1', '', 31, '2017-08-27 10:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `approval_special`
--

CREATE TABLE `approval_special` (
  `approval_id` int(11) NOT NULL,
  `instructor_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `level_approve` int(11) NOT NULL,
  `status` set('0','1','2','3','4') COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `semester_id` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `approval_special`
--

INSERT INTO `approval_special` (`approval_id`, `instructor_id`, `teacher_id`, `level_approve`, `status`, `comment`, `semester_id`, `updated_date`) VALUES
(3, '0000000001', '1234', 1, '2', '', 31, '2017-08-28 04:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course_id` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `course_name_en` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `course_name_th` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `credit` int(11) NOT NULL COMMENT 'หน่วยกิจ',
  `hr_lec` int(11) NOT NULL COMMENT 'จำนวนช่วยโมงบรรยาย',
  `hr_lab` int(11) NOT NULL COMMENT 'จำนวนชั่วโมงปฏิบัติการ',
  `hr_self` int(11) NOT NULL COMMENT 'จำนวนขั่วโมงเรียนรู้ได้ด้วยตนเอง',
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_id`, `course_name_en`, `course_name_th`, `credit`, `hr_lec`, `hr_lab`, `hr_self`, `updated_date`) VALUES
(3, '460100', 'LEARNING THROUGH ACTIVITIES 1   ', 'การเรียนรู้ผ่านกิจกรรม  1', 0, 0, 0, 0, '2017-08-19 07:21:00'),
(4, '460201', 'LEARNING THROUGH ACTIVITIES 2', 'การเรียนรู้ผ่านกิจกรรม  2', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(5, '460202', 'LEARNING THROUGH ACTIVITIES 3', 'การเรียนรู้ผ่านกิจกรรม  3', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(6, '202141', 'BIOLOGY FOR PHARMACY STUDENTS            ', 'ชีววิทยาสำหรับนักศึกษาเภสัชศาสตร์', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(7, '202142', 'BIOLOGY LABORATORY FOR PHARMACY STUDENTS', 'ปฏิบัติการชีววิทยาสำหรับนักศึกษาเภสัชศาสตร์', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(8, '203151', 'GENERAL CHEMISTRY FOR THE HEALTH SCIENCES', 'เคมีทั่วไปสำหรับวิทยาศาสตร์สุขภาพ ', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(9, '203157', 'GENERAL CHEMISTRY LABORATORY FOR THE HEALTH SCIENCES', 'ปฏิบัติการเคมีทั่วไปสำหรับวิทยาศาสตร์สุขภาพ', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(10, '203203', 'ORGANIC CHEMISTRY 1 ', 'เคมีอินทรีย์ 1', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(11, '203204', 'ORGANIC CHEMISTRY 2', 'เคมีอินทรีย์ 2', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(12, '203207', 'ORGANIC CHEMISTRY LABORATORY 1  ', 'ปฏิบัติการเคมีอินทรีย์ 1', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(13, '203208', 'ORGANIC CHEMISTRY LABORATORY 2', 'ปฏิบัติการเคมีอินทรีย์ 2', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(14, '203226', 'PHYSICAL CHEMISTRY ', 'เคมีฟิสิกัล', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(15, '206107', 'MATHEMATICS FOR PHARMACY STUDENTS', 'คณิตศาสตร์สำหรับนักศึกษาเภสัชศาสตร์   ', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(16, '207137', 'PHYSICS FOR  PHARMACY STUDENTS', 'ฟิสิกส์สำหรับนักศึกษาเภสัชศาสตร์', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(17, '301241', 'ANATOMY FOR PHARMACY STUDENTS', 'กายวิภาคศาสตร์สำหรับนักศึกษาเภสัชศาสตร์', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(18, '303242', 'BIOCHEMISTRY FOR PHARMACY STUDENTS  ', 'ชีวเคมีสำหรับนักศึกษาเภสัชศาสตร์', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(19, '311241', 'MICROBIOLOGY FOR PHARMACY STUDENTS  ', 'จุลชีววิทยาสำหรับนักศึกษาเภสัชศาสตร์', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(20, '317242', 'PARASITOLOGY FOR PHARMACY STUDENTS', 'ปรสิตวิทยาสำหรับนักศึกษาเภสัชศาสตร์', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(21, '320342', 'PHARMACOLOGY FOR PHARMACY STUDENTS 1', 'เภสัชวิทยาสำหรับนักศึกษาเภสัช 1', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(22, '320343', 'PHARMACOLOGY FOR PHARMACY STUDENTS 2', 'เภสัชวิทยาสำหรับนักศึกษาเภสัช 2', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(23, '321242', 'PHYSIOLOGY FOR PHARMACY STUDENTS ', 'สรีรวิทยาสำหรับนักศึกษาเภสัชศาสตร์', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(24, '462151', 'PHARMACY ORIENTATION', 'นิเทศเภสัชศาสตร์', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(25, '463201', 'PHARMACEUTICAL BOTANY', 'เภสัชพฤกษศาสตร์', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(26, '463251', 'PHARMACEUTICAL DOSAGE FORM 1', 'เภสัชภัณฑ์ 1', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(27, '463252', 'PHARMACEUTICAL DOSAGE FORM 2', 'เภสัชภัณฑ์  2', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(28, '463311', 'PHARMACEUTICAL BIOTECHNOLOGY 1', 'เทคโนโลยีชีวภาพทางเภสัชศาสตร์ 1', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(29, '463331', 'ORGANIC MEDICINAL CHEMISTRY 1', 'อินทรีย์เคมีทางยา 1', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(30, '463332', 'ORGANIC MEDICINAL CHEMISTRY 2', 'อินทรีย์เคมีทางยา 2', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(31, '463341', 'PHARMACEUTICAL QUALITY ASSURANCE  1 ', 'เภสัชประกันคุณภาพ 1', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(32, '463342', 'PHARMACEUTICAL QUALITY ASSURANCE 2 ', 'เภสัชประกันคุณภาพ 2', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(33, '463353', 'PHARMACEUTICAL DOSAGE FORM  3', 'เภสัชภัณฑ์ 3', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(34, '463354', 'PHARMACEUTICAL DOSAGE FORM 4', 'เภสัชภัณฑ์ 4', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(35, '463402', 'DRUGS FROM NATURAL ORIGIN', 'ยาจากธรรมชาติ', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(36, '463433', 'ORGANIC MEDICINAL CHEMISTRY  3', 'อินทรีย์เคมีทางยา 3', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(37, '463455', 'PHARMACEUTICAL DOSAGE FORM  5', 'เภสัชภัณฑ์ 5', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(38, '464301', 'FUNDAMENTAL OF PHARMACOKINETICS ', 'หลักการพื้นฐานทางเภสัชจลนศาสตร์', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(39, '464302', 'TOXICOLOGY     ', 'พิษวิทยา', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(40, '464311', 'DISEASES AND  PHARMACOTHERAPY 1', 'โรคและเภสัชบำบัด 1', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(41, '464312', 'DISEASES AND  PHARMACOTHERAPY 2    ', 'โรคและเภสัชบำบัด 2 ', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(42, '464341', 'HEALTH AND PHARMACEUTICAL INFORMATION', 'สารสนเทศทางสุขภาพและเภสัชกรรม', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(43, '464391', 'PHARMACY JOB TRAINING IN COMMUNITY', 'การฝึกปฏิบัติงานวิชาชีพเภสัชศาสตร์ในชุมชน ', 0, 0, 0, 0, '2017-08-19 07:45:26'),
(44, '464401', 'PRINCIPLE OF PHARMACEUTICAL CARE ', 'หลักการทางบริบาลเภสัชกรรม', 0, 0, 0, 0, '2017-08-19 07:51:49'),
(45, '464402', 'INTEGRATION IN PHARMACY', 'บูรณาการทางเภสัชศาสตร์', 0, 0, 0, 0, '2017-08-19 07:51:49'),
(46, '464403', 'PATIENT INTERVIEW AND DRUG DISPENSING', 'การสัมภาษณ์ผู้ป่วยและการจ่ายยา', 0, 0, 0, 0, '2017-08-19 07:51:49'),
(47, '464413', 'DISEASES AND  PHARMACOTHERAPY 3', 'โรคและเภสัชบำบัด 3', 0, 0, 0, 0, '2017-08-19 07:51:49'),
(48, '464441', 'PHARMACOEPIDEMIOLOGY 1', 'เภสัชระบาดวิทยา 1 ', 0, 0, 0, 0, '2017-08-19 07:51:49'),
(49, '464442', 'PHARMACOECONOMICS 1', 'เภสัชเศรษฐศาสตร์ 1 ', 0, 0, 0, 0, '2017-08-19 07:51:49'),
(50, '464443', 'PHARMACY JURISPRUDENCE AND ETHICS', 'นิติเภสัชกรรมและจรรยาบรรณวิชาชีพเภสัชกรรม', 0, 0, 0, 0, '2017-08-19 07:51:49'),
(51, '464445', 'PHARMACY PUBLIC HEALTH', 'เภสัชสาธารณสุขศาสตร์', 0, 0, 0, 0, '2017-08-19 07:51:49'),
(52, '464446', 'PHARMACY MANAGEMENT AND ADMINISTRATION ', 'การบริหารและการจัดการทางเภสัชกรรม', 0, 0, 0, 0, '2017-08-19 07:51:49'),
(53, '464481', 'SEMINAR IN PHARMACY ', 'สัมมนาเภสัชกรรม', 0, 0, 0, 0, '2017-08-19 07:51:49'),
(54, '464492', 'PHARMACY JOB TRAINING IN DRUGSTORE AND HOSPITAL      ', 'การฝึกปฏิบัติงานวิชาชีพเภสัชศาสตร์ในร้านยาและโรงพยาบาล', 0, 0, 0, 0, '2017-08-19 07:51:49'),
(55, '464502', 'NEW DRUGS            ', 'ยาใหม่  ', 0, 0, 0, 0, '2017-08-19 07:51:49'),
(56, '464582', 'SEMINAR IN PHARMACY PROFESSION', 'สัมมนาวิชาชีพเภสัชศาสตร์   ', 0, 0, 0, 0, '2017-08-19 07:51:49');

-- --------------------------------------------------------

--
-- Table structure for table `course_hire`
--

CREATE TABLE `course_hire` (
  `hire_id` int(7) UNSIGNED ZEROFILL NOT NULL,
  `course_id` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `instructor_id` int(7) UNSIGNED ZEROFILL NOT NULL,
  `semester_id` int(11) NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_responsible`
--

CREATE TABLE `course_responsible` (
  `respon_id` int(11) NOT NULL,
  `course_id` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `department_id` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `semester_id` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course_responsible`
--

INSERT INTO `course_responsible` (`respon_id`, `course_id`, `teacher_id`, `department_id`, `semester_id`, `updated_date`) VALUES
(1, '460100', '1234', '1202', 31, '2017-08-24 03:51:55'),
(2, '460202', '1234', '1202', 31, '2017-08-25 04:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `deadline`
--

CREATE TABLE `deadline` (
  `deadline_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `deadline_type` int(11) NOT NULL,
  `open_date` date NOT NULL,
  `last_date` date NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `deadline`
--

INSERT INTO `deadline` (`deadline_id`, `semester_id`, `deadline_type`, `open_date`, `last_date`, `updated_date`) VALUES
(1, 31, 1, '2017-08-09', '2017-08-16', '2017-08-18 14:09:38'),
(2, 31, 3, '2017-08-16', '2017-08-22', '2017-08-17 08:19:24'),
(4, 31, 2, '2017-08-17', '2017-08-25', '2017-08-17 08:18:56'),
(6, 31, 4, '2017-08-16', '2017-08-25', '2017-08-24 08:42:37'),
(7, 31, 5, '2017-08-15', '2017-08-29', '2017-08-24 08:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expenses_id` int(11) NOT NULL COMMENT 'รหัสรายจ่าย',
  `instructor_id` int(11) NOT NULL COMMENT 'รหัสอาจารย์ที่เชิญมาบรรยาย',
  `expense_type_id` int(11) NOT NULL COMMENT 'รหัสประเภทการใช้จ่าย',
  `amount` float NOT NULL COMMENT 'จำนวนหน่วย',
  `extra` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อพิเศษ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expenses_id`, `instructor_id`, `expense_type_id`, `amount`, `extra`) VALUES
(1, 1, 1, 20, '');

-- --------------------------------------------------------

--
-- Table structure for table `expenses_type`
--

CREATE TABLE `expenses_type` (
  `type_id` int(11) NOT NULL COMMENT 'รหัสประเภทการใช้จ่าย',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อประเภทการใช้จ่าย',
  `price_per_unit` float NOT NULL DEFAULT '1' COMMENT 'ราคาต่อหน่วย',
  `unit_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ชื่อหน่วย(ชม กม)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expenses_type`
--

INSERT INTO `expenses_type` (`type_id`, `name`, `price_per_unit`, `unit_name`) VALUES
(1, 'ปริญญาตรีบรรยาย', 400, 'ชั่วโมง'),
(2, 'ปริญญาตรีปฏิบัติการ', 200, 'ชั่วโมง'),
(3, 'รถยนต์ส่วนตัว', 4, 'กิโลเมตร'),
(4, 'เครื่องบิน', 0, NULL),
(5, 'taxi', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group_assessor`
--

CREATE TABLE `group_assessor` (
  `id` int(11) NOT NULL,
  `teacher_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `group_num` set('1','2','3','4') COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_assessor`
--

INSERT INTO `group_assessor` (`id`, `teacher_id`, `group_num`, `updated_date`) VALUES
(1, '1234', '1', '2017-08-28 04:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL COMMENT 'รัน autoincrement',
  `user_id` int(11) NOT NULL COMMENT 'ID user',
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'รายละเอียด',
  `action_type` int(11) NOT NULL COMMENT 'ประเภทการแจ้งเตือน',
  `added_by` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เพิ่มโดยใคร',
  `added_date` datetime NOT NULL COMMENT 'วันเวลาที่เพิ่ม',
  `read_by` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ถูกอ่านโดย',
  `read_date` datetime NOT NULL COMMENT 'วันเวลาที่ถูกอ่าน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `score_id` int(11) NOT NULL COMMENT 'รหัสคะแนน',
  `grade` varchar(3) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เกรด',
  `max` float NOT NULL COMMENT 'คะแนนสูงสุด',
  `min` float NOT NULL COMMENT 'คะแนนต่ำสุด',
  `course_id` varchar(7) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสวิชา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL COMMENT 'รหัสเทอม',
  `semester_num` int(11) NOT NULL COMMENT 'เทอม (1,2)',
  `year` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ปีการศึกษา',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `semester_num`, `year`, `update_date`) VALUES
(31, 1, '2560', '2017-08-17 08:11:35');

-- --------------------------------------------------------

--
-- Table structure for table `speacial_lecture`
--

CREATE TABLE `speacial_lecture` (
  `lecture_id` int(11) NOT NULL COMMENT 'รหัสวิชาพิเศษ',
  `lecture_name` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อวิชาพิเศษ',
  `date` date NOT NULL COMMENT 'วันที่เรียน',
  `time` time NOT NULL COMMENT 'เวลาเรียน',
  `room` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ห้องเรียน',
  `reason` text COLLATE utf8_unicode_ci COMMENT 'เหตุผลที่เชิญอาจารย์มาบรรยาย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `speacial_lecture_instructor`
--

CREATE TABLE `speacial_lecture_instructor` (
  `id` int(11) NOT NULL COMMENT 'รหัสเฉพาะ',
  `instructor_id` int(7) UNSIGNED ZEROFILL NOT NULL COMMENT 'รหัสอาจารย์พิเศษ',
  `lecture_id` int(11) NOT NULL COMMENT 'รหัสวิชาพิเศษ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `speacial_lecture_instructor`
--

INSERT INTO `speacial_lecture_instructor` (`id`, `instructor_id`, `lecture_id`) VALUES
(1, 0000001, 0),
(2, 1234789654, 1),
(3, 1234567, 1);

-- --------------------------------------------------------

--
-- Table structure for table `special_instructor`
--

CREATE TABLE `special_instructor` (
  `instructor_id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อ',
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'นามสกุล'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `special_instructor`
--

INSERT INTO `special_instructor` (`instructor_id`, `firstname`, `lastname`) VALUES
(00000000010, 'อดิลักษณ์', 'ชูประทีป'),
(00000000011, 'undefined', ''),
(00000000012, 'อดิลักษณ์ชูประทีป', '');

-- --------------------------------------------------------

--
-- Table structure for table `subject_assessor`
--

CREATE TABLE `subject_assessor` (
  `assessor_id` int(11) NOT NULL,
  `assessor_group_num` set('1','2','3','4') COLLATE utf8_unicode_ci NOT NULL,
  `course_id` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subject_assessor`
--

INSERT INTO `subject_assessor` (`assessor_id`, `assessor_group_num`, `course_id`, `updated_date`) VALUES
(1, '1', '460100', '2017-08-28 04:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `training_id` int(11) NOT NULL COMMENT 'รหัสกิจกรรมวิชา',
  `type` set('seminar','lab') COLLATE utf8_unicode_ci NOT NULL COMMENT 'ประเภทกิจกรรมวิชา (สัมนา/ปฏิบัติ)',
  `score` float NOT NULL COMMENT 'สัดส่วนการให้คะแนน',
  `course_id` varchar(7) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสวิชา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approval_course`
--
ALTER TABLE `approval_course`
  ADD PRIMARY KEY (`approve_id`);

--
-- Indexes for table `approval_special`
--
ALTER TABLE `approval_special`
  ADD PRIMARY KEY (`approval_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_hire`
--
ALTER TABLE `course_hire`
  ADD PRIMARY KEY (`hire_id`);

--
-- Indexes for table `course_responsible`
--
ALTER TABLE `course_responsible`
  ADD PRIMARY KEY (`respon_id`);

--
-- Indexes for table `deadline`
--
ALTER TABLE `deadline`
  ADD PRIMARY KEY (`deadline_id`),
  ADD UNIQUE KEY `semester_id` (`semester_id`,`deadline_type`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expenses_id`);

--
-- Indexes for table `expenses_type`
--
ALTER TABLE `expenses_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `group_assessor`
--
ALTER TABLE `group_assessor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`score_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`),
  ADD UNIQUE KEY `unique_index` (`semester_num`,`year`);

--
-- Indexes for table `speacial_lecture`
--
ALTER TABLE `speacial_lecture`
  ADD PRIMARY KEY (`lecture_id`);

--
-- Indexes for table `speacial_lecture_instructor`
--
ALTER TABLE `speacial_lecture_instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_instructor`
--
ALTER TABLE `special_instructor`
  ADD PRIMARY KEY (`instructor_id`);

--
-- Indexes for table `subject_assessor`
--
ALTER TABLE `subject_assessor`
  ADD PRIMARY KEY (`assessor_id`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`training_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approval_course`
--
ALTER TABLE `approval_course`
  MODIFY `approve_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการเห็นชอบ', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `approval_special`
--
ALTER TABLE `approval_special`
  MODIFY `approval_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `course_hire`
--
ALTER TABLE `course_hire`
  MODIFY `hire_id` int(7) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course_responsible`
--
ALTER TABLE `course_responsible`
  MODIFY `respon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `deadline`
--
ALTER TABLE `deadline`
  MODIFY `deadline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expenses_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสรายจ่าย', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `expenses_type`
--
ALTER TABLE `expenses_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประเภทการใช้จ่าย', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `group_assessor`
--
ALTER TABLE `group_assessor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รัน autoincrement';
--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสคะแนน';
--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสเทอม', AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `speacial_lecture`
--
ALTER TABLE `speacial_lecture`
  MODIFY `lecture_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสวิชาพิเศษ';
--
-- AUTO_INCREMENT for table `speacial_lecture_instructor`
--
ALTER TABLE `speacial_lecture_instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสเฉพาะ', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `special_instructor`
--
ALTER TABLE `special_instructor`
  MODIFY `instructor_id` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `subject_assessor`
--
ALTER TABLE `subject_assessor`
  MODIFY `assessor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสกิจกรรมวิชา';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
