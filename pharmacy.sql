-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2017 at 11:21 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

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
  `status` set('P','D','A') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'P' COMMENT 'สถานะการเห็นชอบ approve,pending,disapprove',
  `data_type` set('evaluate','special','syllabus') COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชนิดของเอกสารที่เห็นชอบ',
  `level_approve` int(11) NOT NULL COMMENT 'ขั้นการเห็นชอบ (กรรมการ, หัวหน้าภาค)',
  `comment` text CHARACTER SET utf8,
  `semester_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `approval_course`
--

INSERT INTO `approval_course` (`approve_id`, `teacher_id`, `course_id`, `status`, `data_type`, `level_approve`, `comment`, `semester_id`, `date`) VALUES
(1, 'E160020', '204411', 'A', 'evaluate', 1, 'ไม่ผ่านครับ', 31, '2017-08-18 05:47:00'),
(2, 'E160041', '204411', 'D', 'evaluate', 1, 'ผ่านครับ', 31, '2017-08-18 08:09:26'),
(3, 'E160030', '204411', 'P', 'evaluate', 1, NULL, 31, '2017-08-18 05:47:52'),
(4, 'E160031', '204411', 'P', 'syllabus', 1, NULL, 31, '2017-08-18 08:10:07'),
(5, 'E160043', '204411', 'A', 'syllabus', 1, NULL, 31, '2017-08-18 08:10:09'),
(6, 'D160003', '204411', 'P', 'syllabus', 1, NULL, 31, '2017-08-18 08:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `approval_special`
--

CREATE TABLE `approval_special` (
  `approval_id` int(11) NOT NULL,
  `instructor_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `level_approve` int(11) NOT NULL,
  `status` set('P','D','A') COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(100) NOT NULL,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `zone` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name_eng` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `code`, `zone`, `name`, `name_eng`) VALUES
(1, '00', '0', ' -', 'none'),
(2, '10', '1', 'กรุงเทพมหานคร', 'Krung Thep Maha Nakhon'),
(3, '11', '2', 'สมุทรปราการ', 'Samut Prakan'),
(4, '12', '2', 'นนทบุรี', 'Nonthaburi'),
(5, '13', '2', 'ปทุมธานี', 'ปทุมธานี'),
(6, '14', '2', 'พระนครศรีอยุธยา', 'Phra Nakhon Si Ayutthaya'),
(7, '15', '2', 'อ่างทอง', 'Ang Thong'),
(8, '16', '2', 'ลพบุรี', 'Lop Buri'),
(9, '17', '2', 'สิงห์บุรี', 'Sing Buri'),
(10, '18', '2', 'ชัยนาท', 'Chai Nat'),
(11, '19', '2', 'สระบุรี', 'Saraburi'),
(12, '20', '2', 'ชลบุรี', 'Chon Buri'),
(13, '21', '2', 'ระยอง', 'Rayong'),
(14, '22', '2', 'จันทบุรี', 'Chanthaburi'),
(15, '23', '2', 'ตราด', 'Trat'),
(16, '24', '2', 'ฉะเชิงเทรา', 'Chachoengsao'),
(17, '25', '2', 'ปราจีนบุรี', 'Prachin Buri'),
(18, '26', '2', 'นครนายก', 'Nakhon Nayok'),
(19, '27', '2', 'สระแก้ว', 'Sra Kaew'),
(20, '30', '4', 'นครราชสีมา', 'Nakhon Ratchasima'),
(21, '31', '4', 'บุรีรัมย์', 'Buri Ram'),
(22, '32', '4', 'สุรินทร์', 'Surin'),
(23, '33', '4', 'ศรีสะเกษ', 'Si Sa Ket'),
(24, '34', '4', 'อุบลราชธานี', 'Ubon Ratchathani'),
(25, '35', '4', 'ยโสธร', 'Yasothon'),
(26, '36', '4', 'ชัยภูมิ', 'Chaiyaphum'),
(27, '37', '4', 'อำนาจเจริญ', 'Amnat Charoen'),
(28, '39', '4', 'หนองบัวลำภู', 'Nong Bua Lam Phu'),
(29, '40', '4', 'ขอนแก่น', 'Khon Kaen'),
(30, '41', '4', 'อุดรธานี', 'Udon Thani'),
(31, '42', '4', 'เลย', 'Loei'),
(32, '43', '4', 'หนองคาย', 'Nong Khai'),
(33, '44', '4', 'มหาสารคาม', 'Maha Sarakham'),
(34, '45', '4', 'ร้อยเอ็ด', 'Roi Et'),
(35, '46', '4', 'กาฬสินธุ์', 'Kalasin'),
(36, '47', '4', 'สกลนคร', 'Sakon Nakhon'),
(37, '48', '4', 'นครพนม', 'Nakhon Phanom'),
(38, '49', '4', 'มุกดาหาร', 'Mukdahan'),
(39, '50', '3', 'เชียงใหม่', 'Chiang Mai'),
(40, '51', '3', 'ลำพูน', 'Lamphun'),
(41, '52', '3', 'ลำปาง', 'Lampang'),
(42, '53', '3', 'อุตรดิตถ์', 'Uttaradit'),
(43, '54', '3', 'แพร่', 'Phrae'),
(44, '55', '3', 'น่าน', 'Nan'),
(45, '56', '3', 'พะเยา', 'Phayao'),
(46, '57', '3', 'เชียงราย', 'Chiang Rai'),
(47, '58', '3', 'แม่ฮ่องสอน', 'Mae Hong Son'),
(48, '60', '3', 'นครสวรรค์', 'Nakhon Sawan'),
(49, '61', '3', 'อุทัยธานี', 'Uthai Thani'),
(50, '62', '3', 'กำแพงเพชร', 'Kamphaeng Phet'),
(51, '63', '3', 'ตาก', 'Tak'),
(52, '64', '3', 'สุโขทัย', 'Sukhothai'),
(53, '65', '3', 'พิษณุโลก', 'Phisanulok'),
(54, '66', '3', 'พิจิตร', 'Phichit'),
(55, '67', '3', 'เพชรบูรณ์', 'Phetchabun'),
(56, '70', '2', 'ราชบุรี', 'Ratchaburi'),
(57, '71', '2', 'กาญจนบุรี', 'Kanchanaburi'),
(58, '72', '2', 'สุพรรณบุรี', 'Suphan Buri'),
(59, '73', '2', 'นครปฐม', 'Nakhon Pathom'),
(60, '74', '2', 'สมุทรสาคร', 'Samut Sakon'),
(61, '75', '2', 'สมุทรสงคราม', 'Samut Songkram'),
(62, '76', '2', 'เพชรบุรี', 'Phetchaburi'),
(63, '77', '2', 'ประจวบคีรีขันธ์', 'Prachuap Khiri Khan'),
(64, '80', '5', 'นครศรีธรรมราช', 'Nakhon Si Thammarat'),
(65, '81', '5', 'กระบี่', 'Krabi'),
(66, '82', '5', 'พังงา', 'Phangnga'),
(67, '83', '5', 'ภูเก็ต', 'Phuket'),
(68, '84', '5', 'สุราษฎร์ธานี', 'Surat Thani'),
(69, '85', '5', 'ระนอง', 'Ranong'),
(70, '86', '5', 'ชุมพร', 'Chumphon'),
(71, '90', '5', 'สงขลา', 'Songkhla'),
(72, '91', '5', 'สตูล', 'Satun'),
(73, '92', '5', 'ตรัง', 'Trang'),
(74, '93', '5', 'พัทลุง', 'Phatthalung'),
(75, '94', '5', 'ปัตตานี', 'Pattani'),
(76, '95', '5', 'ยะลา', 'Yala'),
(77, '96', '5', 'นราธิวาส', 'Narathiwat'),
(78, '97', '4', 'บึงกาฬ', '');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(20) NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `short` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `eng` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `code`, `short`, `name`, `eng`) VALUES
(1, '000', '', '-', ''),
(2, '001', 'SCO', 'สก๊อตแลนด์', 'Scottland'),
(3, '002', 'BUR', 'พม่า', 'Burma'),
(4, '036', 'AUS', 'ออสเตรเลีย', 'Australia'),
(5, '040', 'AUT', 'ออสเตรีย', 'Austria'),
(6, '050', 'BGD', 'บังคลาเทศ', 'Bangladesh'),
(7, '056', 'BEL', 'เบลเยี่ยม', 'Belgium'),
(8, '076', 'BRA', 'บราซิล', 'Brasil'),
(9, '096', 'BRN', 'บรูไน', 'Brunei'),
(10, '100', 'BGR', 'บุลกาเรีย', 'Bulgaria'),
(11, '11', '', 'อามีเนีย', 'Amenia'),
(12, '116', 'KHM', 'กัมพูชา', 'Cambodia'),
(13, '12', '', 'ฟิลิปปินส์', 'Phillippine'),
(14, '124', 'CAN', 'แคนาดา', 'Canada'),
(15, '144', 'LKA', 'ศรีลังกา', 'Sri Lanka'),
(16, '156', 'CHN', 'สาธารณรัฐประชาชนจีน', 'China'),
(17, '158', 'TWN', 'ไต้หวัน', 'Taiwan'),
(18, '192', 'CUB', 'คิวบา', 'Cuba'),
(19, '208', 'DNK', 'เดนมาร์ก', 'Denmark'),
(20, '246', 'FIN', 'ฟินแลนด์', 'Finland'),
(21, '250', 'FRA', 'ฝรั่งเศส', 'France'),
(22, '276', 'DEU', 'เยอรมัน', 'Germany'),
(23, '300', 'GRC', 'กรีซ', 'Greece'),
(24, '344', 'HKG', 'ฮ่องกง', 'Hong Kong'),
(25, '348', 'HUN', 'ฮังการี', 'Hungary'),
(26, '356', 'IND', 'อินเดีย', 'India'),
(27, '360', 'IDN', 'อินโดนีเซีย', 'Indonesia'),
(28, '376', 'ISR', 'อิสราเอล', 'Israel'),
(29, '380', 'ITA', 'อิตาลี', 'Italy'),
(30, '392', 'JPN', 'ญี่ปุ่น', 'Japan'),
(31, '404', 'KEN', 'เคนยา', 'Kenya'),
(32, '408', 'PRK', 'เกาหลี', 'Korea'),
(33, '418', 'LAO', 'ลาว', 'Lao'),
(34, '458', 'MYS', 'มาเลเซีย', 'Malaysia'),
(35, '484', 'MEX', 'เม็ตซิโก', 'Mexico'),
(36, '524', 'NPL', 'เนปาล', 'Nepal'),
(37, '528', 'NLD', 'เนเธอแลนด์', 'Netherland'),
(38, '554', 'NZL', 'นิวซีแลนด์', 'Newzealand'),
(39, '578', 'NOR', 'นอรเวย์', 'Norway'),
(40, '586', 'PAK', 'ปากีสถาน', 'Pakistan'),
(41, '604', 'PER', 'เปรู', 'Peru'),
(42, '608', 'PHL', 'สาธารณรัฐฟิลิปปินส์', 'Philippines'),
(43, '616', 'POL', 'โปแลนด์', 'Poland'),
(44, '620', 'PRT', 'โปรตุเกส', 'Protugal'),
(45, '642', 'ROM', 'โรมาเนีย', 'Rumania'),
(46, '643', 'RUS', 'รัสเซีย', 'Russian Federation'),
(47, '702', 'SGP', 'สิงคโปร์', 'Singapore'),
(48, '704', 'VNM', 'เวียตนาม', 'Vietnam'),
(49, '710', 'ZAF', 'แอฟริกาใต้', 'South Africa'),
(50, '724', 'ESP', 'สเปน', 'Spain'),
(51, '752', 'SWE', 'สวีเดน', 'Sweden'),
(52, '756', 'CHE', 'สวิสเซอร์แลนด์', 'Switzerland'),
(53, '764', 'THA', 'ไทย', 'Thailand'),
(54, '818', 'EGY', 'สาธารณรัฐอาหรับอียิปต์', 'Egypt'),
(55, '826', 'GBR', 'สหราชอาณาจักร', 'United Kingdom'),
(56, '840', 'USA', 'สหรัฐอเมริกา', 'United States Of America');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` varchar(7) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสวิชา',
  `credit_total` int(11) NOT NULL COMMENT 'หน่วยกิจรวม',
  `hr_lecture` int(11) NOT NULL COMMENT 'จำนวนชั่วโมง_วิชาบรรยาย_ต่อสัปดาห์',
  `hr_lab` int(11) NOT NULL COMMENT 'จำนวนชั่วโมง_วิชาแลป_ต่อสัปดาห์',
  `hr_self` int(11) NOT NULL COMMENT 'จำนวนชั่วโมง_เรียนด้วยตัวเอง_ต่อสัปดาห์',
  `absent_evaluate` set('F','U','C') COLLATE utf8_unicode_ci NOT NULL COMMENT 'เกรด_นศ ขาดสอบ',
  `evaluate_grade` set('SU','AF') COLLATE utf8_unicode_ci NOT NULL COMMENT 'วิธีการให้เกรด',
  `evaluate_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'วิธีการตัดเกรด',
  `course_open` set('new','old') COLLATE utf8_unicode_ci NOT NULL COMMENT 'ประเภทของวิชา (เก่า/ใหม่)',
  `study_type` set('lecture','lab','leclab','speacial','training','seminar','other') COLLATE utf8_unicode_ci NOT NULL COMMENT 'ลักษณะของวิชา',
  `course_type` set('elective','required') COLLATE utf8_unicode_ci NOT NULL COMMENT 'ประเภทของวิชา(บังคับ/เสรี)',
  `semester_id` int(11) NOT NULL COMMENT 'รหัสของเทอม',
  `speacial_lecture_percent` float NOT NULL DEFAULT '0' COMMENT 'ร้อยละของจำนวน ชม ต่อหัวข้อที่เชิญอาจารย์พิเศษมาสอน',
  `mid_lec` float NOT NULL COMMENT 'สัดส่วนคะแนนภาคทฤษฏี(กลางภาค)',
  `mid_lab` float NOT NULL COMMENT 'สัดส่วนคะแนนภาคปฏิบัติ(กลางภาค)',
  `final_lec` float NOT NULL COMMENT 'สัดส่วนคะแนนภาคทฤษฏี(ปลายภาค)',
  `final_lab` float NOT NULL COMMENT 'สัดส่วนคะแนนภาคปฏิบัติ(ปลายภาค)',
  `other_lec` float NOT NULL COMMENT 'สัดส่วนคะแนนภาคทฤษฏี(อื่นๆ)',
  `other_lab` float NOT NULL COMMENT 'สัดส่วนคะแนนภาคปฏิบัติ(อื่นๆ)',
  `department_id` int(11) NOT NULL COMMENT 'รหัสภาควิชา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `credit_total`, `hr_lecture`, `hr_lab`, `hr_self`, `absent_evaluate`, `evaluate_grade`, `evaluate_type`, `course_open`, `study_type`, `course_type`, `semester_id`, `speacial_lecture_percent`, `mid_lec`, `mid_lab`, `final_lec`, `final_lab`, `other_lec`, `other_lab`, `department_id`) VALUES
('461525', 3, 3, 0, 6, 'F', 'AF', 'criterion', 'new', 'lecture', 'elective', 1, 0, 50, 0, 50, 0, 0, 0, 1);

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
-- Table structure for table `course_name`
--

CREATE TABLE `course_name` (
  `id` int(11) NOT NULL,
  `course_id` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `course_name_en` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `course_name_th` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course_name`
--

INSERT INTO `course_name` (`id`, `course_id`, `course_name_en`, `course_name_th`, `updated_date`) VALUES
(3, '460100', 'LEARNING THROUGH ACTIVITIES 1   ', 'การเรียนรู้ผ่านกิจกรรม  1', '2017-08-19 07:21:00'),
(4, '460201', 'LEARNING THROUGH ACTIVITIES 2', 'การเรียนรู้ผ่านกิจกรรม  2', '2017-08-19 07:45:26'),
(5, '460202', 'LEARNING THROUGH ACTIVITIES 3', 'การเรียนรู้ผ่านกิจกรรม  3', '2017-08-19 07:45:26'),
(6, '202141', 'BIOLOGY FOR PHARMACY STUDENTS            ', 'ชีววิทยาสำหรับนักศึกษาเภสัชศาสตร์', '2017-08-19 07:45:26'),
(7, '202142', 'BIOLOGY LABORATORY FOR PHARMACY STUDENTS', 'ปฏิบัติการชีววิทยาสำหรับนักศึกษาเภสัชศาสตร์', '2017-08-19 07:45:26'),
(8, '203151', 'GENERAL CHEMISTRY FOR THE HEALTH SCIENCES', 'เคมีทั่วไปสำหรับวิทยาศาสตร์สุขภาพ ', '2017-08-19 07:45:26'),
(9, '203157', 'GENERAL CHEMISTRY LABORATORY FOR THE HEALTH SCIENCES', 'ปฏิบัติการเคมีทั่วไปสำหรับวิทยาศาสตร์สุขภาพ', '2017-08-19 07:45:26'),
(10, '203203', 'ORGANIC CHEMISTRY 1 ', 'เคมีอินทรีย์ 1', '2017-08-19 07:45:26'),
(11, '203204', 'ORGANIC CHEMISTRY 2', 'เคมีอินทรีย์ 2', '2017-08-19 07:45:26'),
(12, '203207', 'ORGANIC CHEMISTRY LABORATORY 1  ', 'ปฏิบัติการเคมีอินทรีย์ 1', '2017-08-19 07:45:26'),
(13, '203208', 'ORGANIC CHEMISTRY LABORATORY 2', 'ปฏิบัติการเคมีอินทรีย์ 2', '2017-08-19 07:45:26'),
(14, '203226', 'PHYSICAL CHEMISTRY ', 'เคมีฟิสิกัล', '2017-08-19 07:45:26'),
(15, '206107', 'MATHEMATICS FOR PHARMACY STUDENTS', 'คณิตศาสตร์สำหรับนักศึกษาเภสัชศาสตร์   ', '2017-08-19 07:45:26'),
(16, '207137', 'PHYSICS FOR  PHARMACY STUDENTS', 'ฟิสิกส์สำหรับนักศึกษาเภสัชศาสตร์', '2017-08-19 07:45:26'),
(17, '301241', 'ANATOMY FOR PHARMACY STUDENTS', 'กายวิภาคศาสตร์สำหรับนักศึกษาเภสัชศาสตร์', '2017-08-19 07:45:26'),
(18, '303242', 'BIOCHEMISTRY FOR PHARMACY STUDENTS  ', 'ชีวเคมีสำหรับนักศึกษาเภสัชศาสตร์', '2017-08-19 07:45:26'),
(19, '311241', 'MICROBIOLOGY FOR PHARMACY STUDENTS  ', 'จุลชีววิทยาสำหรับนักศึกษาเภสัชศาสตร์', '2017-08-19 07:45:26'),
(20, '317242', 'PARASITOLOGY FOR PHARMACY STUDENTS', 'ปรสิตวิทยาสำหรับนักศึกษาเภสัชศาสตร์', '2017-08-19 07:45:26'),
(21, '320342', 'PHARMACOLOGY FOR PHARMACY STUDENTS 1', 'เภสัชวิทยาสำหรับนักศึกษาเภสัช 1', '2017-08-19 07:45:26'),
(22, '320343', 'PHARMACOLOGY FOR PHARMACY STUDENTS 2', 'เภสัชวิทยาสำหรับนักศึกษาเภสัช 2', '2017-08-19 07:45:26'),
(23, '321242', 'PHYSIOLOGY FOR PHARMACY STUDENTS ', 'สรีรวิทยาสำหรับนักศึกษาเภสัชศาสตร์', '2017-08-19 07:45:26'),
(24, '462151', 'PHARMACY ORIENTATION', 'นิเทศเภสัชศาสตร์', '2017-08-19 07:45:26'),
(25, '463201', 'PHARMACEUTICAL BOTANY', 'เภสัชพฤกษศาสตร์', '2017-08-19 07:45:26'),
(26, '463251', 'PHARMACEUTICAL DOSAGE FORM 1', 'เภสัชภัณฑ์ 1', '2017-08-19 07:45:26'),
(27, '463252', 'PHARMACEUTICAL DOSAGE FORM 2', 'เภสัชภัณฑ์  2', '2017-08-19 07:45:26'),
(28, '463311', 'PHARMACEUTICAL BIOTECHNOLOGY 1', 'เทคโนโลยีชีวภาพทางเภสัชศาสตร์ 1', '2017-08-19 07:45:26'),
(29, '463331', 'ORGANIC MEDICINAL CHEMISTRY 1', 'อินทรีย์เคมีทางยา 1', '2017-08-19 07:45:26'),
(30, '463332', 'ORGANIC MEDICINAL CHEMISTRY 2', 'อินทรีย์เคมีทางยา 2', '2017-08-19 07:45:26'),
(31, '463341', 'PHARMACEUTICAL QUALITY ASSURANCE  1 ', 'เภสัชประกันคุณภาพ 1', '2017-08-19 07:45:26'),
(32, '463342', 'PHARMACEUTICAL QUALITY ASSURANCE 2 ', 'เภสัชประกันคุณภาพ 2', '2017-08-19 07:45:26'),
(33, '463353', 'PHARMACEUTICAL DOSAGE FORM  3', 'เภสัชภัณฑ์ 3', '2017-08-19 07:45:26'),
(34, '463354', 'PHARMACEUTICAL DOSAGE FORM 4', 'เภสัชภัณฑ์ 4', '2017-08-19 07:45:26'),
(35, '463402', 'DRUGS FROM NATURAL ORIGIN', 'ยาจากธรรมชาติ', '2017-08-19 07:45:26'),
(36, '463433', 'ORGANIC MEDICINAL CHEMISTRY  3', 'อินทรีย์เคมีทางยา 3', '2017-08-19 07:45:26'),
(37, '463455', 'PHARMACEUTICAL DOSAGE FORM  5', 'เภสัชภัณฑ์ 5', '2017-08-19 07:45:26'),
(38, '464301', 'FUNDAMENTAL OF PHARMACOKINETICS ', 'หลักการพื้นฐานทางเภสัชจลนศาสตร์', '2017-08-19 07:45:26'),
(39, '464302', 'TOXICOLOGY     ', 'พิษวิทยา', '2017-08-19 07:45:26'),
(40, '464311', 'DISEASES AND  PHARMACOTHERAPY 1', 'โรคและเภสัชบำบัด 1', '2017-08-19 07:45:26'),
(41, '464312', 'DISEASES AND  PHARMACOTHERAPY 2    ', 'โรคและเภสัชบำบัด 2 ', '2017-08-19 07:45:26'),
(42, '464341', 'HEALTH AND PHARMACEUTICAL INFORMATION', 'สารสนเทศทางสุขภาพและเภสัชกรรม', '2017-08-19 07:45:26'),
(43, '464391', 'PHARMACY JOB TRAINING IN COMMUNITY', 'การฝึกปฏิบัติงานวิชาชีพเภสัชศาสตร์ในชุมชน ', '2017-08-19 07:45:26'),
(44, '464401', 'PRINCIPLE OF PHARMACEUTICAL CARE ', 'หลักการทางบริบาลเภสัชกรรม', '2017-08-19 07:51:49'),
(45, '464402', 'INTEGRATION IN PHARMACY', 'บูรณาการทางเภสัชศาสตร์', '2017-08-19 07:51:49'),
(46, '464403', 'PATIENT INTERVIEW AND DRUG DISPENSING', 'การสัมภาษณ์ผู้ป่วยและการจ่ายยา', '2017-08-19 07:51:49'),
(47, '464413', 'DISEASES AND  PHARMACOTHERAPY 3', 'โรคและเภสัชบำบัด 3', '2017-08-19 07:51:49'),
(48, '464441', 'PHARMACOEPIDEMIOLOGY 1', 'เภสัชระบาดวิทยา 1 ', '2017-08-19 07:51:49'),
(49, '464442', 'PHARMACOECONOMICS 1', 'เภสัชเศรษฐศาสตร์ 1 ', '2017-08-19 07:51:49'),
(50, '464443', 'PHARMACY JURISPRUDENCE AND ETHICS', 'นิติเภสัชกรรมและจรรยาบรรณวิชาชีพเภสัชกรรม', '2017-08-19 07:51:49'),
(51, '464445', 'PHARMACY PUBLIC HEALTH', 'เภสัชสาธารณสุขศาสตร์', '2017-08-19 07:51:49'),
(52, '464446', 'PHARMACY MANAGEMENT AND ADMINISTRATION ', 'การบริหารและการจัดการทางเภสัชกรรม', '2017-08-19 07:51:49'),
(53, '464481', 'SEMINAR IN PHARMACY ', 'สัมมนาเภสัชกรรม', '2017-08-19 07:51:49'),
(54, '464492', 'PHARMACY JOB TRAINING IN DRUGSTORE AND HOSPITAL      ', 'การฝึกปฏิบัติงานวิชาชีพเภสัชศาสตร์ในร้านยาและโรงพยาบาล', '2017-08-19 07:51:49'),
(55, '464502', 'NEW DRUGS            ', 'ยาใหม่  ', '2017-08-19 07:51:49'),
(56, '464582', 'SEMINAR IN PHARMACY PROFESSION', 'สัมมนาวิชาชีพเภสัชศาสตร์   ', '2017-08-19 07:51:49');

-- --------------------------------------------------------

--
-- Table structure for table `course_responsible`
--

CREATE TABLE `course_responsible` (
  `respon_id` int(11) NOT NULL,
  `course_id` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `semester_id` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(4, 31, 2, '2017-08-17', '2017-08-25', '2017-08-17 08:18:56');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL COMMENT 'รหัสภาควิชา',
  `department_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อภาควิชา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
(1, 'วิทยาศาสตร์เภสัชกรรม'),
(2, 'บริบาลเภสัชกรรม');

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
  `id` int(11) NOT NULL,
  `instructor_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อ',
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'นามสกุล',
  `postion` varchar(70) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ตำแหน่ง',
  `qualification` varchar(256) COLLATE utf8_unicode_ci NOT NULL COMMENT 'คุณวุฒิ/สาขาที่เชี่ยวชาญ',
  `workplace` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานที่ทำงาน',
  `contact_place` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานที่ติดต่อ',
  `phone_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `fax` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'โทรสาร'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `special_instructor`
--

INSERT INTO `special_instructor` (`id`, `instructor_id`, `firstname`, `lastname`, `postion`, `qualification`, `workplace`, `contact_place`, `phone_number`, `fax`) VALUES
(1, '0000001', 'อดิลักษณ์', 'ชูประทีป', 'ชำนาญการพิเศษ', 'หน่วยจู่โจมใต้น้ำพิเศษ', 'มหาวิทยาลัยเชียงใหม่', '192/296', '0898512480', '1');

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
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_hire`
--
ALTER TABLE `course_hire`
  ADD PRIMARY KEY (`hire_id`);

--
-- Indexes for table `course_name`
--
ALTER TABLE `course_name`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `approval_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course_hire`
--
ALTER TABLE `course_hire`
  MODIFY `hire_id` int(7) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course_name`
--
ALTER TABLE `course_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `course_responsible`
--
ALTER TABLE `course_responsible`
  MODIFY `respon_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deadline`
--
ALTER TABLE `deadline`
  MODIFY `deadline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสภาควิชา', AUTO_INCREMENT=3;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสกิจกรรมวิชา';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
