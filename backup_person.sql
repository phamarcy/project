-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 17, 2017 at 03:01 AM
-- Server version: 10.0.30-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backup.person`
--

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
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(5) NOT NULL,
  `code` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `code`, `name`) VALUES
(2, '1201', 'สํานักงานคณะ'),
(3, '1202', 'ภาควิชาบริบาลเภสัชกรรม'),
(4, '1203', 'ภาควิชาวิทยาศาสตร์เภสัชกรรม'),
(5, '1204', 'หน่วยงานอื่นๆ ในสังกัด'),
(6, '1205', 'ศูนย์ปฏิบัติการเภสัชชุมชน'),
(7, '1206', 'ศูนย์บริการเภสัชกรรม');

-- --------------------------------------------------------

--
-- Table structure for table `duty`
--

CREATE TABLE `duty` (
  `id` int(5) NOT NULL,
  `code` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `duty`
--

INSERT INTO `duty` (`id`, `code`, `name`) VALUES
(2, '1', 'ข้าราชการพลเรือนในมหาวิทยาลัย-สาย ก'),
(3, '2', 'ข้าราชการพลเรือนในมหาวิทยาลัย-สาย ข'),
(4, '3', 'ข้าราชการพลเรือนในมหาวิทยาลัย-สาย ค'),
(5, '4', 'พนักงานมหาวิทยาลัย-พนักงานวิชาการ'),
(6, '5', 'พนักงานมหาวิทยาลัย-พนักงานปฎิบัติการ'),
(7, '6', 'พนักงานมหาวิทยาลัยชั่วคราว(พนักงาน ส่วนงาน)'),
(8, '7', 'ลูกจ้างประจำ'),
(9, '8', 'ลูกจ้างชั่วคราว'),
(10, '9', 'ไม่ระบุ');

-- --------------------------------------------------------

--
-- Table structure for table `edu`
--

CREATE TABLE `edu` (
  `id` int(5) NOT NULL,
  `code` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name_eng` varchar(100) NOT NULL,
  `sort_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `edu`
--

INSERT INTO `edu` (`id`, `code`, `name`, `name_eng`, `sort_name`) VALUES
(1, '01', 'ประถมศึกษา', 'Primary School', 'ป.'),
(2, '02', 'มัธยมศึกษาตอนต้น', 'Junior High School', 'ม. ต้น'),
(3, '03', 'มัธยมศึกษาตอนปลาย', 'Senior High School', 'ม. ปลาย'),
(4, '04', 'ประกาศนียบัตรวิชาชีพ', 'Vocational Certificate', 'ปวช.'),
(5, '05', 'ประกาศนียบัตรวิชาชีพเทคนิค', 'Technical Certificate', 'ปวท.'),
(6, '06', 'ประกาศนียบัตรวิชาชีพชั้นสูง', 'High Vocational Certificate', 'ปวส.'),
(7, '07', 'อนุปริญญา', '', 'อนุ ป.'),
(8, '08', 'ต่ำกว่าปริญญาตรี', '', 'ต่ำกว่าตรี'),
(9, '09', 'การศึกษาผู้ใหญ่ภาคค่ำ', 'Adult Education', 'ภาคค่ำ'),
(10, '10', 'ปริญญาตรี', 'B.A.', 'ป.ตรี'),
(11, '11', 'สูงกว่าปริญญาตรี', '', 'สูงกว่าตรี'),
(12, '12', 'ประกาศนียบัตร', '', 'ประกาศนียบัตร'),
(13, '20', 'ปริญญาโท', 'M.A.', 'ป.โท'),
(14, '21', 'สูงกว่าปริญญาโท', '', 'สูงกว่าโท'),
(15, '30', 'ปริญญาเอก', 'Ph.D.', 'ป.เอก'),
(16, '31', 'สูงกว่าปริญญาเอก', '', 'สูงกว่าเอก');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(60) NOT NULL,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `no` int(5) NOT NULL,
  `years` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `edu_code` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `edu_branch` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `school` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `grade` decimal(20,2) NOT NULL,
  `expert` text NOT NULL,
  `rec_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- --------------------------------------------------------

--
-- Table structure for table `excutive`
--

CREATE TABLE `excutive` (
  `id` int(60) NOT NULL,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prefix_name` varchar(20) NOT NULL,
  `position_work` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position_de` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position_groups` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rec_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- --------------------------------------------------------

--
-- Table structure for table `expert`
--

CREATE TABLE `expert` (
  `id` int(5) NOT NULL,
  `code` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `expert`
--

INSERT INTO `expert` (`id`, `code`, `name`, `note`) VALUES
(1, '1', 'ชำนาญการ 6', '6'),
(2, '2', 'ชำนาญการ 7 - 8', '7-8'),
(3, '3', 'เชี่ยวชาญ 9', '9'),
(4, '4', 'เชี่ยวชาญพิเศษ 9', '9'),
(5, '5', 'เชี่ยวชาญพิเศษ 10', '10');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(5) NOT NULL,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name_sort` varchar(100) NOT NULL,
  `dep_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `code`, `name`, `name_sort`, `dep_code`) VALUES
(6, '120103', 'งานนโยบายและแผนและประกันคุณภาพการศึกษา', 'งานนโยบายและแผนฯ', '1201'),
(4, '120104', 'งานการเงิน การคลัง และพัสดุ', 'งานการเงินพัสดุฯ', '1201'),
(5, '120105', 'งานบริหารงานวิจัย บริการวิชาการ และวิเทศสัมพันธ์', 'งานบริหารงานวิจัยฯ', '1201'),
(7, '120102', 'งานบริการการศึกษาและพัฒนาคุภาพนักศึกษา', 'งานบริการการศึกษาฯ', '1201'),
(8, '120101', 'งานบริหารทั่วไป', 'งานบริหารฯ', '1201');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(5) NOT NULL,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dep_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `code`, `name`, `dep_code`) VALUES
(1, '000000', 'ไม่ระบุ', 'ไม่ระบุ'),
(2, '100000', 'อาจารย์', 'อ.'),
(13, '204012', 'พนักงานรักษาความปลอดภัย', 'พนักงานรักษาความปลอดภัย'),
(20, '205015', 'นักวิทยาศาสตร์', 'นักวิทยาศาสตร์'),
(23, '206019', 'นักวิจัย', 'นักวิจัย'),
(30, '207015', 'พนักงานขับรถยนต์', 'พนักงานขับรถยนต์'),
(47, '214011', 'เภสัชกร', 'เภสัชกร'),
(57, '218026', 'นักวิชาการคอมพิวเตอร์', 'นักวิชาการคอมพิวเตอร์'),
(72, '301022', 'พนักงานธุรการ', 'พ.ธุรการ'),
(82, '302019', 'เจ้าหน้าที่บริหารงานทั่วไป (ชำนาญการพิเศษ)', 'จ.บริหารงานทั่วไป'),
(96, '308009', 'พนักงานบัญชี', 'พ.บัญชี'),
(99, '308035', 'นักวิชาการเงินและบัญชี', 'นักวิชาการเงินและบัญชี'),
(115, '314021', 'พนักงานวิทยาศาสตร์', 'พ.วิทยาศาสตร์'),
(125, '320025', 'พนักงานเข้าเล่ม', 'พนักงานเข้าเล่ม'),
(209, 'x67000', 'พนักงานเก็บเงิน', 'พนักงานเก็บเงิน'),
(210, 'x68000', 'พนักงานคลังและเวชภัณฑ์', 'พนักงานคลังและเวชภัณฑ์'),
(212, 'x70000', 'พนักงานบัญชีและธุรการ', 'พนักงานบัญชีและธุรการ'),
(213, 'x71000', 'พนักงานบริการเอกสารทั่วไป', 'พนักงานบริการเอกสารทั่วไป'),
(214, 'x71001', 'พนักงานสถานที่', 'พนักงานสถานที่'),
(216, 'x71003', 'พนักงานห้องปฎิบัติการ', 'พนักงานห้องปฎิบัติการ'),
(217, 'x71004', 'พนักงานพิมพ์', 'พนักงานพิมพ์'),
(218, 'x71005', 'เจ้าหน้าที่สำนักงาน', 'เจ้าหน้าที่สำนักงาน'),
(219, 'x71006', 'พนักงานบริการทั่วไป', 'พนักงานบริการทั่วไป'),
(220, 'x71007', 'พนักงานบริการฝีมือ(ด้านเทคนิคและเครื่องยนต์)', 'พนักงานบริการฝีมือ(ด้านเทคนิคและเครื่องยนต์)'),
(221, 'x71008', 'พนักงานปฏิบัติงาน', 'พนักงานปฏิบัติงาน'),
(224, 'x71011', 'นักการเงินและบัญชี', 'นักการเงินและบัญชี'),
(225, 'x71012', 'พนักงานบริการฝีมือ (ด้านวิทยาศาสตร์และการแพทย์)', 'พนักงานบริการฝีมือ (ด้านวิทยาศาสตร์และการแพทย์)'),
(226, 'x71013', 'พนักงานบริการฝีมือ (ด้านสำนักงาน)', 'พนักงานบริการฝีมือ (ด้านสำนักงาน)'),
(227, 'x71014', 'นักวิทยาศาสตร์เกษตร', 'นักวิทยาศาสตร์เกษตร'),
(228, 'x71015', 'พนักงานช่าง', 'พนักงานช่าง'),
(229, 'x71016', 'นักวิชาการศึกษา', 'นักวิชาการศึกษา');

-- --------------------------------------------------------

--
-- Table structure for table `position_bk`
--

CREATE TABLE `position_bk` (
  `id` int(5) NOT NULL,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dep_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `position_bk`
--

INSERT INTO `position_bk` (`id`, `code`, `name`, `dep_code`) VALUES
(1, '000000', 'ไม่ระบุ', 'ไม่ระบุ'),
(2, '100000', 'อาจารย์', 'อ.'),
(7, '202014', 'บรรณารักษ์', 'บรรณารักษ์'),
(9, '203018', 'นักวิชาการโสตทัศนศึกษา', 'นักวิชาการโสตทัศนศึกษา'),
(13, '204012', 'พนักงานรักษาความปลอดภัย', 'พนักงานรักษาความปลอดภัย'),
(14, '204013', 'คนงานห้องทดลอง', 'คนงานห้องทดลอง'),
(16, '204015', 'ช่างไม้', 'ช่างไม้'),
(18, '204030', 'เจ้าหน้าที่วิทยาศาสตร์', 'เจ้าหน้าที่วิทยาศาสตร์'),
(19, '205014', 'นักกิจการนักศึกษา', 'นักกิจการนักศึกษา'),
(20, '205015', 'นักวิทยาศาสตร์', 'นักวิทยาศาสตร์'),
(21, '205016', 'พนักงานวิทยาศาสตร์', 'พนักงานวิทยาศาสตร์'),
(23, '206019', 'นักวิจัย', 'นักวิจัย'),
(24, '206020', 'พนักงานประจำห้องทดลอง', 'พนักงานประจำห้องทดลอง'),
(25, '206026', 'เจ้าหน้าที่วิจัย', 'จ.วิจัย'),
(26, '206030', 'เจ้าหน้าที่วิเคราะห์โครงการวิจัย', 'จ.วิเคราะห์โครงการวิจัย'),
(28, '207013', 'พนักงานเก็บเงิน', 'พนักงานเก็บเงิน'),
(30, '207015', 'พนักงานขับรถยนต์', 'พนักงานขับรถยนต์'),
(36, '208021', 'เจ้าหน้าที่บริหารงานวิจัย', 'เจ้าหน้าที่บริหารงานวิจัย'),
(37, '209011', 'เจ้าหน้าที่ระบบงานคอมพิวเตอร์', 'จ.ระบบงานคอมพิวเตอร์'),
(38, '210015', 'เจ้าหน้าที่วิเคราะห์นโยบายและแผน', 'จ.วิเคราะห์นโยบายและแผน'),
(47, '214011', 'เภสัชกร', 'เภสัชกร'),
(53, '217030', 'พนักงานการเงิน', 'พนักงานการเงิน'),
(55, '218014', 'พนักงานพิมพ์ดีด ชั้น 3', 'พนักงานพิมพ์ดีด ชั้น 3'),
(56, '218025', 'พนักงานพิมพ์ดีด ชั้น 2', 'พนักงานพิมพ์ดีด ชั้น 2'),
(57, '218026', 'นักวิชาการคอมพิวเตอร์', 'นักวิชาการคอมพิวเตอร์'),
(59, '219019', 'เจ้าหน้าที่วิเทศสัมพันธ์', 'จ.วิเทศสัมพันธ์'),
(71, '301015', 'เจ้าหน้าที่ธุรการ', 'จ.ธุรการ'),
(72, '301022', 'พนักงานธุรการ', 'พ.ธุรการ'),
(75, '301026', 'นักบัญชี', 'นักบัญชี'),
(81, '302010', 'เลขานุการ', 'เลขานุการ'),
(82, '302019', 'เจ้าหน้าที่บริหารงานทั่วไป (ชำนาญการพิเศษ)', 'จ.บริหารงานทั่วไป'),
(83, '303012', 'เจ้าหน้าที่พิมพ์ดีด', 'จ.พิมพ์ดีด'),
(84, '303013', 'พนักงานพิมพ์ดีด', 'พ.พิมพ์ดีด'),
(86, '304016', 'เจ้าหน้าที่ประชาสัมพันธ์', 'จ.ประชาสัมพันธ์'),
(87, '304023', 'นักประชาสัมพันธ์', 'นักประชาสัมพันธ์'),
(88, '304030', 'พนักงานประชาสัมพันธ์', 'พ.ประชาสัมพันธ์'),
(90, '305010', 'บุคคลากร', 'บุคคลากร'),
(91, '305011', 'เจ้าหน้าที่บุคคล', 'จ.บุคคล'),
(94, '307017', 'นิติกร', 'นิติกร'),
(96, '308009', 'พนักงานบัญชี', 'พ.บัญชี'),
(97, '308010', 'เจ้าหน้าที่การเงินและบัญชี', 'จ.การเงินและบัญชี'),
(98, '308028', 'พนักงานการเงินและบัญชี', 'พ.การเงินและบัญชี'),
(99, '308035', 'นักวิชาการเงินและบัญชี', 'นักวิชาการเงินและบัญชี'),
(100, '308042', 'เจ้าหน้าที่บริหารงานการเงินและบัญชี', 'จ.บริหารงานการเงินและบัญชี'),
(103, '310011', 'เจ้าหน้าที่พัสดุ', 'จ.พัสดุ'),
(104, '310027', 'พนักงานพัสดุ', 'พ.พัสดุ'),
(105, '310041', 'นักวิชาการพัสดุ', 'นักวิชาการพัสดุ'),
(106, '310059', 'เจ้าหน้าที่บริหารงานพัสดุ', 'จ.บริหารงานพัสดุ'),
(108, '311020', 'พนักงานอัดสำเนา', 'พนักงานบริการอัดสำเนา'),
(111, '312017', 'เจ้าหน้าที่ห้องสมุด', 'จ.ห้องสมุด'),
(112, '312024', 'พนักงานห้องสมุด', 'พ.ห้องสมุด'),
(113, '313010', 'เจ้าหน้าที่โสตทัศนศึกษา', 'จ.โสตทัศนศึกษา'),
(114, '313028', 'พนักงานโสตทัศนศึกษา', 'พ.โสตทัศนศึกษา'),
(115, '314021', 'พนักงานวิทยาศาสตร์', 'พ.วิทยาศาสตร์'),
(116, '315018', 'เจ้าหน้าที่การเกษตร', 'จ.การเกษตร'),
(117, '315025', 'พนักงานการเกษตร', 'พ.การเกษตร'),
(125, '320025', 'พนักงานเข้าเล่ม', 'พนักงานเข้าเล่ม'),
(127, '322015', 'คนงาน', 'คนงาน'),
(128, '322022', 'คนสวน', 'คนสวน'),
(138, '328017', 'ผู้ช่วยเภสัชกร', 'ผู้ช่วยเภสัชกร'),
(154, '336018', 'เจ้าหน้าที่พิมพ์', 'จ.พิมพ์'),
(155, '336025', 'ช่างพิมพ์', 'ช่างพิมพ์'),
(160, '338014', 'เจ้าหน้าที่คอมพิวเตอร์', 'จ.คอมพิวเตอร์'),
(161, '338015', 'เจ้าหน้าที่เครื่องคอมพิวเตอร์', 'จ.เครื่องคอมพิวเตอร์'),
(162, '338022', 'พนักงานเครื่องคอมพิวเตอร์', 'พ.เครื่องคอมพิวเตอร์'),
(204, 'x62000', 'บุคลากร', ''),
(205, 'x63000', 'นักวิเคราะห์นโยบายและแผน', 'นักวิเคราะห์นโยบายและแผน'),
(206, 'x64000', 'ผู้ปฏิบัติงานบริหาร', 'ผู้ปฏิบัติงานบริหาร'),
(207, 'x65000', 'ผู้ปฏิบัติงานวิทยาศาสตร์', 'ผู้ปฏิบัติงานวิทยาศาสตร์'),
(208, 'x66000', 'นักเทคโนโลยีสารสนเทศ', 'นักเทคโนโลยีสารสนเทศ'),
(209, 'x67000', 'พนักงานเก็บเงิน', 'พนักงานเก็บเงิน'),
(210, 'x68000', 'พนักงานคลังและเวชภัณฑ์', 'พนักงานคลังและเวชภัณฑ์'),
(211, 'x69000', 'พนักงานการเงิน', 'พนักงานการเงิน'),
(212, 'x70000', 'พนักงานบัญชีและธุรการ', 'พนักงานบัญชีและธุรการ'),
(213, 'x71000', 'พนักงานบริการเอกสารทั่วไป', 'พนักงานบริการเอกสารทั่วไป'),
(214, 'x71001', 'พนักงานสถานที่', 'พนักงานสถานที่'),
(215, 'x71002', 'พนักงานทั่วไป', 'พนักงานทั่วไป'),
(216, 'x71003', 'พนักงานห้องปฎิบัติการ', 'พนักงานห้องปฎิบัติการ'),
(217, 'x71004', 'พนักงานพิมพ์', 'พนักงานพิมพ์'),
(218, 'x71005', 'เจ้าหน้าที่สำนักงาน', 'เจ้าหน้าที่สำนักงาน'),
(219, 'x71006', 'พนักงานบริการทั่วไป', 'พนักงานบริการทั่วไป'),
(220, 'x71007', 'พนักงานบริการฝีมือ(ด้านเทคนิคและเครื่องยนต์)', 'พนักงานบริการฝีมือ(ด้านเทคนิคและเครื่องยนต์)'),
(221, 'x71008', 'พนักงานปฏิบัติงาน', 'พนักงานปฏิบัติงาน'),
(222, 'x71009', 'พนักงานบริการฝีมือ (ด้านวิทยาศาสตร์และการแพทย์)', 'พนักงานบริการฝีมือ (ด้านวิทยาศาสตร์และการแพทย์)'),
(223, 'x71010', 'พนักงานบริการฝีมือ (ด้านสำนักงาน)', 'พนักงานบริการฝีมือ (ด้านสำนักงาน)'),
(224, 'x71011', 'นักการเงินและบัญชี', 'นักการเงินและบัญชี'),
(225, 'x71012', 'พนักงานบริการฝีมือ (ด้านวิทยาศาสตร์และการแพทย์)', 'พนักงานบริการฝีมือ (ด้านวิทยาศาสตร์และการแพทย์)'),
(226, 'x71013', 'พนักงานบริการฝีมือ (ด้านสำนักงาน)', 'พนักงานบริการฝีมือ (ด้านสำนักงาน)'),
(227, 'x71014', 'นักวิทยาศาสตร์เกษตร', 'นักวิทยาศาสตร์เกษตร'),
(228, 'x71015', 'พนักงานช่าง', 'พนักงานช่าง');

-- --------------------------------------------------------

--
-- Table structure for table `position_de`
--

CREATE TABLE `position_de` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_eng` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `position_de`
--

INSERT INTO `position_de` (`id`, `name`, `name_eng`) VALUES
(1, 'ฝ่ายวิชาการ', 'for Academic Affairs'),
(2, 'ฝ่ายบริหารและศิษย์เก่าสัมพันธ์', 'for Administrative and Alumni Affairs'),
(3, 'ฝ่ายวิจัยและวิเทศสัมพันธ์', 'for Research and International  Relations'),
(4, 'ฝ่ายวิชาชีพและบริการวิชาการ', 'for Professional Training and Academic Service'),
(5, 'ฝ่ายวิเทศสัมพันธ์และสื่อสารองค์กร', 'for International  Relations and Corporate Communication'),
(6, 'ฝ่ายนโยบายและแผนและบริการวิชาการ', 'for Policy and Planning and Academic Service'),
(12, 'ฝ่ายวิชาการ', 'for Academic Affairs'),
(7, 'ฝ่ายแผนงานและพัฒนาคุณภาพ', 'for Planning and Quality Assurance'),
(8, 'ฝ่ายพัฒนาคุณภาพนักศึกษา', 'for Student Development'),
(15, 'ฝ่ายบัณฑิตศึกษา', 'for Graduate Studies'),
(16, 'ฝ่ายเทคโนโลยีสารสนเทศ', ' for Information Technology');

-- --------------------------------------------------------

--
-- Table structure for table `position_dean`
--

CREATE TABLE `position_dean` (
  `id` int(50) NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `position_dean`
--

INSERT INTO `position_dean` (`id`, `code`, `name`) VALUES
(1, 'X001', 'คณบดี'),
(2, 'X002', 'รองคณบดีฝ่ายวิชาการ'),
(3, 'X003', 'รองคณบดีฝ่ายบริหารและศิษย์เก่าสัมพันธ์'),
(4, 'X004', 'รองคณบดีฝ่ายวิจัยและวิเทศสัมพันธ์'),
(5, 'X005', 'รองคณบดีฝ่ายแผนงานและพัฒนาคุณภาพ'),
(6, 'X006', 'ผู้ช่วยคณบดีฝ่ายบัณฑิตศึกษา'),
(7, 'X007', 'ผู้ช่วยคณบดีฝ่ายวิชาชีพและบริการวิชาการ'),
(8, 'X008', 'ผู้ช่วยคณบดีฝ่ายพัฒนานักศึกษา'),
(9, 'X009', 'หัวหน้าศูนย์บริการเภสัชกรรม'),
(10, 'X010', 'ผู้อำนวยการศูนย์ปฏิบัติการเภสัชชุมชน'),
(11, 'X011', 'หัวหน้าภาควิชาวิทยาศาสตร์เภสัชกรรม'),
(12, 'X012', 'หัวหน้าภาควิชาบริบาลเภสัชกรรม'),
(13, 'X013', 'รองหัวหน้าภาควิชาวิทยาศาสตร์เภสัชกรรม'),
(14, 'X014', 'รองหัวหน้าภาควิชาบริบาลเภสัชกรรม'),
(15, 'X015', 'เลขานุการคณะเภสัชศาสตร์'),
(16, 'X016', 'หัวหน้างานบริหารทั่วไป'),
(17, 'X017', 'หัวหน้างาน การเงิน การคลัง และพัสดุ'),
(18, 'X018', 'หัวหน้างานนโยบายและแผนและประกันคุณภาพการศึกษา'),
(19, 'X019', 'หัวหน้างานบริการการศึกษาและพัฒนาคุณภาพนักศึกษา'),
(20, 'X020', 'หัวหน้างานบริหารงานวิจัย บริการวิชาการ วิเทศสัมพันธ์'),
(21, 'X021', 'ผู้ช่วยคณบดีฝ่ายเทคโนโลยีสารสนเทศ');

-- --------------------------------------------------------

--
-- Table structure for table `position_work`
--

CREATE TABLE `position_work` (
  `id` int(10) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_eng` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `position_work`
--

INSERT INTO `position_work` (`id`, `code`, `name`, `name_eng`) VALUES
(1, 'E20000', 'คณบดี', 'Dean of Faculty of Pharmacy'),
(2, 'E21000', 'รองคณบดี', 'Associate Dean'),
(3, 'E22000', 'ผู้ช่วยคณบดี', 'Assistant Dean'),
(4, 'E23000', 'หัวหน้าศูนย์', 'Head'),
(5, 'E24000', 'ผู้อำนวยการศูนย์', 'Director'),
(6, 'E25000', 'รองหัวหน้าศูนย์', 'Vice Head'),
(7, 'E26000', 'หัวหน้าภาควิชา', 'Head'),
(8, 'E27000', 'รองหัวหน้าภาควิชา', 'Vice Head'),
(10, 'E28000', 'เลขานุการคณะฯ', '');

-- --------------------------------------------------------

--
-- Table structure for table `posi_acade`
--

CREATE TABLE `posi_acade` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `detail` varchar(100) NOT NULL,
  `name_eng` varchar(255) NOT NULL,
  `majer` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `posi_acade`
--

INSERT INTO `posi_acade` (`id`, `name`, `detail`, `name_eng`, `majer`) VALUES
(1, 'ศ.ดร.', 'ศาตราจารย์(ดร.)', '', ''),
(2, 'ศ.', 'ศาตราจารย์', '', ''),
(3, 'รศ.ดร.', 'รองศาสตรจารย์(ดร.)', 'Assoc.Prof.', 'Ph.D.'),
(4, 'รศ.', 'รองศาสตรจารย์', 'Assoc.Prof.', 'M.Sc.'),
(5, 'ผศ.ดร.', 'ผู้ช่วยศาสตรจารย์(ดร.)', 'Assist.Prof.', 'Ph.D.'),
(6, 'ผศ.', 'ผู้ช่วยศาสตรจารย์', 'Assist.Prof.', 'M.Sc.'),
(7, 'อ.ดร.', 'อาจารย์(ดร.)', '', 'Ph.D.'),
(8, 'อ.', 'อาจารย์', '', ''),
(9, 'รศ.ดร.', 'Dr.rer.nat.', 'Assoc.Prof.', 'Dr.rer.nat.');

-- --------------------------------------------------------

--
-- Table structure for table `prefix`
--

CREATE TABLE `prefix` (
  `id` int(5) NOT NULL,
  `code` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name_full` varchar(200) NOT NULL,
  `name_eng` varchar(50) NOT NULL,
  `name_all` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `prefix`
--

INSERT INTO `prefix` (`id`, `code`, `name`, `name_full`, `name_eng`, `name_all`) VALUES
(1, '01', 'นาย', 'นาย', 'Mr.', ''),
(2, '02', 'นางสาว', 'นางสาว', 'Mrs.', ''),
(3, '03', 'นาง', 'นาง', 'Ms.', ''),
(4, '04', 'อ.', 'อาจารย์', 'Lecturer', 'อาจารย์'),
(5, '05', 'ดร.', 'ดร.', 'Dr.', 'อาจารย์'),
(6, '06', 'อ.ดร.', 'อาจารย์ ดร.', 'Lecturer', 'อาจารย์'),
(7, '07', 'ผศ.', 'ผู้ช่วยศาสตราจารย์', 'Assistant Professor.', 'ผู้ช่วยศาสตราจารย์'),
(8, '08', 'รศ.', 'รองศาสตราจารย์', 'Associate professor.', 'รองศาสตราจารย์'),
(9, '09', 'ศ.', 'ศาสตราจารย์', 'Professor.', 'ศาสตราจารย์'),
(10, '10', 'ผศ.ดร.', 'ผู้ช่วยศาสตราจารย์ ดร.', 'Assistant Professor.Dr.', 'ผู้ช่วยศาสตราจารย์'),
(11, '11', 'รศ.ดร.', 'รองศาสตราจารย์ ดร.', 'Associate professor.Dr.', 'รองศาสตราจารย์'),
(12, '12', 'ศ.ดร.', 'ศาสตราจารย์ ดร.', 'Professor.Dr.', 'ศาสตราจารย์'),
(13, '13', 'ม.ร.ว.', 'ม.ร.ว.', '', ''),
(14, '14', 'มล.', 'มล.', '', ''),
(15, '15', 'รศ.มล.', 'รศ.มล.', '', ''),
(16, '16', 'ว่าที่ร้อยตรี', 'ว่าที่ร้อยตรี', '', ''),
(17, '17', 'ว่าที่พันตรี', 'ว่าที่พันตรี', '', ''),
(18, '18', 'สิบเอก', 'สิบเอก', '', ''),
(19, '19', 'สิบโท', 'สิบโท', '', ''),
(20, '20', 'สิบตรี', 'สิบตรี', '', ''),
(21, '21', 'พันเอก', 'พันเอก', '', ''),
(22, '22', 'พันโท', 'พันโท', '', ''),
(23, '23', 'พันตรี', 'พันตรี', '', ''),
(24, '24', 'ว่าที่ร้อยเอก', 'ว่าที่ร้อยเอก', '', ''),
(25, '25', 'ว่าที่ร้อยโท', 'ว่าที่ร้อยโท', '', ''),
(26, '26', 'ร้อยเอก', 'ร้อยเอก', '', ''),
(27, '27', 'ร้อยโท', 'ร้อยโท', '', ''),
(28, '28', 'ร้อยตรี', 'ร้อยตรี', '', ''),
(29, '29', 'จ่าสิบเอก', 'จ่าสิบเอก', '', ''),
(30, '30', 'Prof.', 'Prof.', '', ''),
(31, '31', 'Assoc. Prof.', 'Assoc. Prof.', '', ''),
(32, '32', 'Dr.', 'Dr.', '', ''),
(33, '33', 'ภก.', 'เภสัชกร', '', ''),
(34, '34', 'ภญ.', 'เภสัชกร', '', ''),
(36, '36', 'อ.ภก.', 'อาจารย์ ภก.', 'Lecturer', 'อาจารย์ '),
(37, '37', 'อ.ภญ.', 'อาจารย์ ภญ.', 'Lecturer', 'อาจารย์ '),
(38, '38', 'อ.ดร.ภก.', 'อาจารย์ ดร.ภก.', 'Lecturer', 'อาจารย์ '),
(39, '39', 'อ.ดร.ภญ.', 'อาจารย์ ดร.ภญ.', 'Lecturer', 'อาจารย์ '),
(40, '40', 'ผศ.ดร.ภก.', 'ผู้ช่วยศาสตราจารย์ ดร.ภก.', 'Assistant Professor.Dr.', 'ผู้ช่วยศาสตราจารย์'),
(41, '41', 'ผศ.ดร.ภญ.', 'ผู้ช่วยศาสตราจารย์ ดร.ภญ.', 'Assistant Professor.Dr.', 'ผู้ช่วยศาสตราจารย์'),
(42, '42', 'ผศ.ภก.', 'ผู้ช่วยศาสตราจารย์ ภก.', 'Assistant Professor.', 'ผู้ช่วยศาสตราจารย์'),
(43, '43', 'ผศ.ภญ.', 'ผู้ช่วยศาสตราจารย์ ภญ.', 'Assistant Professor.', 'ผู้ช่วยศาสตราจารย์'),
(44, '44', 'รศ.ภก.', 'รองศาสตราจารย์ ภก.', 'Associate professor.', 'รองศาสตราจารย์ '),
(45, '45', 'รศ.ภญ.', 'รองศาสตราจารย์ ภญ.', 'Associate professor.', 'รองศาสตราจารย์ '),
(46, '46', 'รศ.ดร.ภก.', 'รองศาสตราจารย์ ดร.ภก.', 'Associate professor.Dr.', 'รองศาสตราจารย์ '),
(47, '47', 'รศ.ดร.ภญ.', 'รองศาสตราจารย์ ดร.ภญ.', 'Associate professor.Dr.', 'รองศาสตราจารย์ '),
(48, '48', 'ศ.ภก.', 'ศาตราจารย์ ภก.', 'Professor.', 'ศาตราจารย์ '),
(49, '49', 'ศ.ภญ.', 'ศาตราจารย์ ภญ.', 'Professor.', 'ศาตราจารย์ '),
(50, '50', 'ศ.ดร.ภก.', 'ศาตราจารย์ ดร.ภก.', 'Professor.Dr.', 'ศาตราจารย์ '),
(51, '51', 'ศ.ดร.ภญ.', 'ศาตราจารย์ ดร.ภญ.', 'Professor.Dr.', 'ศาตราจารย์ ');

-- --------------------------------------------------------

--
-- Table structure for table `prefix_1`
--

CREATE TABLE `prefix_1` (
  `id` int(5) NOT NULL,
  `code` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name_full` varchar(200) NOT NULL,
  `name_eng` varchar(50) NOT NULL,
  `name_all` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `prefix_1`
--

INSERT INTO `prefix_1` (`id`, `code`, `name`, `name_full`, `name_eng`, `name_all`) VALUES
(1, '01', 'นาย', 'นาย', '', ''),
(2, '02', 'นางสาว', 'นางสาว', '', ''),
(3, '03', 'นาง', 'นาง', '', ''),
(4, '04', 'อ.', 'อาจารย์', '', 'อาจารย์'),
(5, '05', 'ดร.', 'ดร.', '', 'อาจารย์'),
(6, '06', 'อ.ดร.', 'อาจารย์ ดร.', '', 'อาจารย์'),
(7, '07', 'ผศ.', 'ผู้ช่วยศาสตราจารย์', '', 'ผู้ช่วยศาสตราจารย์'),
(8, '08', 'รศ.', 'รองศาสตราจารย์', '', 'รองศาสตราจารย์'),
(9, '09', 'ศ.', 'ศาสตราจารย์', '', 'ศาสตราจารย์'),
(10, '10', 'ผศ.ดร.', 'ผู้ช่วยศาสตราจารย์ ดร.', '', 'ผู้ช่วยศาสตราจารย์'),
(11, '11', 'รศ.ดร.', 'รองศาสตราจารย์ ดร.', '', 'รองศาสตราจารย์'),
(12, '12', 'ศ.ดร.', 'ศาสตราจารย์ ดร.', '', 'ศาสตราจารย์'),
(13, '13', 'ม.ร.ว.', 'ม.ร.ว.', '', ''),
(14, '14', 'มล.', 'มล.', '', ''),
(15, '15', 'รศ.มล.', 'รศ.มล.', '', ''),
(16, '16', 'ว่าที่ร้อยตรี', 'ว่าที่ร้อยตรี', '', ''),
(17, '17', 'ว่าที่พันตรี', 'ว่าที่พันตรี', '', ''),
(18, '18', 'สิบเอก', 'สิบเอก', '', ''),
(19, '19', 'สิบโท', 'สิบโท', '', ''),
(20, '20', 'สิบตรี', 'สิบตรี', '', ''),
(21, '21', 'พันเอก', 'พันเอก', '', ''),
(22, '22', 'พันโท', 'พันโท', '', ''),
(23, '23', 'พันตรี', 'พันตรี', '', ''),
(24, '24', 'ว่าที่ร้อยเอก', 'ว่าที่ร้อยเอก', '', ''),
(25, '25', 'ว่าที่ร้อยโท', 'ว่าที่ร้อยโท', '', ''),
(26, '26', 'ร้อยเอก', 'ร้อยเอก', '', ''),
(27, '27', 'ร้อยโท', 'ร้อยโท', '', ''),
(28, '28', 'ร้อยตรี', 'ร้อยตรี', '', ''),
(29, '29', 'จ่าสิบเอก', 'จ่าสิบเอก', '', ''),
(30, '30', 'Prof.', 'Prof.', '', ''),
(31, '31', 'Assoc. Prof.', 'Assoc. Prof.', '', ''),
(32, '32', 'Dr.', 'Dr.', '', ''),
(33, '33', 'ภก.', 'เภสัชกร', '', ''),
(34, '34', 'ภญ.', 'เภสัชกร', '', ''),
(36, '36', 'อ.ภก.', 'อาจารย์ ภก.', '', 'อาจารย์ '),
(37, '37', 'อ.ภญ.', 'อาจารย์ ภญ.', '', 'อาจารย์ '),
(38, '38', 'อ.ดร.ภก.', 'อาจารย์ ดร.ภก.', '', 'อาจารย์ '),
(39, '39', 'อ.ดร.ภญ.', 'อาจารย์ ดร.ภญ.', '', 'อาจารย์ '),
(40, '40', 'ผศ.ดร.ภก.', 'ผู้ช่วยศาสตราจารย์ ดร.ภก.', '', 'ผู้ช่วยศาสตราจารย์'),
(41, '41', 'ผศ.ดร.ภญ.', 'ผู้ช่วยศาสตราจารย์ ดร.ภญ.', '', 'ผู้ช่วยศาสตราจารย์'),
(42, '42', 'ผศ.ภก.', 'ผู้ช่วยศาสตราจารย์ ภก.', '', 'ผู้ช่วยศาสตราจารย์'),
(43, '43', 'ผศ.ภญ.', 'ผู้ช่วยศาสตราจารย์ ภญ.', '', 'ผู้ช่วยศาสตราจารย์'),
(44, '44', 'รศ.ภก.', 'รองศาสตราจารย์ ภก.', '', 'รองศาสตราจารย์ '),
(45, '45', 'รศ.ภญ.', 'รองศาสตราจารย์ ภญ.', '', 'รองศาสตราจารย์ '),
(46, '46', 'รศ.ดร.ภก.', 'รองศาสตราจารย์ ดร.ภก.', '', 'รองศาสตราจารย์ '),
(47, '47', 'รศ.ดร.ภญ.', 'รองศาสตราจารย์ ดร.ภญ.', '', 'รองศาสตราจารย์ '),
(48, '48', 'ศ.ภก.', 'ศาตราจารย์ ภก.', '', 'ศาตราจารย์ '),
(49, '49', 'ศ.ภญ.', 'ศาตราจารย์ ภญ.', '', 'ศาตราจารย์ '),
(50, '50', 'ศ.ดร.ภก.', 'ศาตราจารย์ ดร.ภก.', '', 'ศาตราจารย์ '),
(51, '51', 'ศ.ดร.ภญ.', 'ศาตราจารย์ ดร.ภญ.', '', 'ศาตราจารย์ ');

-- --------------------------------------------------------

--
-- Table structure for table `religion`
--

CREATE TABLE `religion` (
  `id` int(5) NOT NULL,
  `code` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `religion`
--

INSERT INTO `religion` (`id`, `code`, `name`) VALUES
(1, '00', ' -'),
(2, '01', 'พุทธ'),
(3, '02', 'คริสต์'),
(4, '03', 'ชินโต'),
(5, '04', 'อิสลาม'),
(6, '05', 'พราหม์'),
(7, '06', 'บาไฮ'),
(8, '07', 'มะหะหมัด');

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

CREATE TABLE `research` (
  `id` int(60) NOT NULL,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `research1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `research2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `research3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `research4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `research5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `research6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `research7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rec_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(255) NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสพนักงาน',
  `prefix_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `prefix_posi` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `o_fname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `o_lname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `e_lname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `e_fname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dep_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `job_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `unit_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `position_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `position_dean` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `duty_code` int(10) NOT NULL,
  `sex` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `id_card` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `birth_dates` date NOT NULL,
  `birth_place` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานที่เกิด',
  `blood` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `nation` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `religion` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tambol` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `amphur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `marry` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `marry_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `child` int(5) NOT NULL,
  `father` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `mother` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `family` int(5) NOT NULL,
  `work_status` int(2) NOT NULL COMMENT 'สถานะทำงาน',
  `in_date` date NOT NULL,
  `end_date` date NOT NULL,
  `kbk` int(5) NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `files_sig` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trans_date` date NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email_exe` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rec_date` datetime NOT NULL,
  `ksj` int(5) NOT NULL,
  `tnj` int(5) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(5) NOT NULL,
  `IsNormal` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `moo_ban` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `moo` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `road` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `soi` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tel_o` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `branch` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `code`, `prefix_code`, `prefix_posi`, `fname`, `lname`, `o_fname`, `o_lname`, `e_lname`, `e_fname`, `dep_code`, `job_code`, `unit_code`, `position_code`, `position_dean`, `duty_code`, `sex`, `id_card`, `birth_dates`, `birth_place`, `blood`, `nation`, `country`, `religion`, `address`, `tambol`, `amphur`, `city`, `zip`, `tel`, `marry`, `marry_name`, `child`, `father`, `mother`, `family`, `work_status`, `in_date`, `end_date`, `kbk`, `photo`, `files_sig`, `trans_date`, `email`, `email_exe`, `rec_date`, `ksj`, `tnj`, `username`, `password`, `level`, `IsNormal`, `moo_ban`, `moo`, `road`, `soi`, `tel_o`, `branch`) VALUES
(1, '0', '01', '', 'เอนก', 'สายวงค์', ' ', ' ', '', 'Aanek', '1201', '120101', '12010103', 'x71006', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(2, '000', '33', '', 'วุฒิกร', 'ใยชิด', ' ', ' ', '', 'Wuttikorn', '1205', '', '', '214011', '', 5, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'wuttigorn@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(3, '0000000', '01', '', 'สุพันธ์', 'สุยะ', ' ', ' ', '', 'Supan', '1201', '120101', '12010103', 'x71006', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'suphan.su@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(4, '00003', '34', '', 'ณิลยา', 'เตชอังกูร', ' ', ' ', '', 'nilaya', '1205', '', '', '214011', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 4, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(5, '00004', '01', '', 'เอกชัย', 'สุริยะวงค์วรรณ์', ' ', ' ', 'Suriyawongwan', 'Eakachai', '1205', '', '', 'x68000', '', 5, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'Dear5884@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(6, '000001', '02', '', 'จีรา', 'อินต๊ะปาน', ' ', ' ', '', 'Jeera', '1205', '', '', 'x67000', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(7, '397', '03', '', 'อุสา', 'อุ่นเมือง', ' ', ' ', '', 'Ausa', '1201', '120101', '12010103', 'x71006', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'usa.a@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(8, '001', '33', '', 'อรรฆพล', 'พรพรหม', ' ', ' ', 'Pornprom', 'Akaphol', '1205', '', '', '214011', '', 5, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(9, '0010', '01', '', 'โกศล', 'คำปา', ' ', ' ', '', 'Koson', '1205', '', '', 'x68000', '', 5, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(10, '0011', '03', '', 'สุคนธ์ทิพย์', 'เที่ยงคำ', ' ', ' ', '', 'Sukhontip', '1205', '', '', '301022', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'nui.sureewan@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(11, '0015', '02', '', 'สุรีวัลย์', 'เที่ยงคำ', ' ', ' ', 'Thiangkum', 'Sureewan', '1205', '', '', 'x70000', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sureewan.thiangkum@cmu.ac.th', 'nui.sureewan@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(12, '0016', '02', '', 'ยุพาดา', 'ศรีเมืองมูล', ' ', ' ', '', 'Yupada', '1205', '', '', 'x67000', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(13, '002', '03', '', 'ศิริลักษณ์', 'ทาทิพย์', ' ', ' ', 'tatip', 'Siriluck', '1205', '', '', '308009', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'siriluck_nusa@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(14, '003', '03', '', 'ปรียา', 'กันธะผัด', ' ', ' ', 'Kantapat', 'Preeya', '1205', '', '', '308035', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'lukkob@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(15, '004', '34', '', 'อัจฉริยา', 'คำยิ่งโยชน์', ' ', ' ', 'Kumyingyoch', 'Autchariya', '1205', '', '', '214011', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(16, 'E160020', '02', '', 'กุสุมา', 'ภาคภูมิ', ' ', ' ', 'pakpoom', 'kusuma', '1201', '120101', '12010102', 'x71008', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'kusuma.pakpoom@cmu.ac.th', 'peung-noy@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(17, 'E160041', '02', '', 'รสสุคนธ์', 'สุขสบาย', ' ', ' ', 'Suksabay', 'Rossukon', '1201', '120103', '12010304', '218026', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'rossukon.t@cmu.ac.th', 'rossukon.cmu@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(18, 'E160030', '38', '', 'วสันต์', 'กาติ๊บ', ' ', ' ', 'Katip', 'Wasan', '1202', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'wasan.katip@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(19, 'E160042', '03', '', 'ศรีวิไล', 'เจริญเมือง', ' ', ' ', 'CHAREONMUNG', 'SRIVILAI', '1201', '120104', '12010402', 'x71008', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sriwilai.c@cmu.ac.th', 'srivilai_c@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(20, '011', '01', '', 'ฐานันดร', 'นามสีฐาน', ' ', ' ', 'Namsitan', 'Tanundon', '1201', '120101', '12010103', 'x71015', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 4, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'tanundoo_480@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(21, 'E160039', '01', '', 'ประจวบ', 'ไชยนาง', ' ', ' ', 'Chainang', 'Prajoub', '1201', '120103', '12010304', 'x71015', '', 5, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'prajoub.c@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(22, 'A160020', '02', '', 'สมพร', 'พวงประทุม', ' ', ' ', 'POUNGPRATOOM', 'SOMPORN', '1201', '120101', '', 'x71008', 'X016', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'somporn.po@cmu.ac.th', 'spsompornp@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(23, 'D160006', '04', '', 'ธวัชชัย', 'เหลืองโสภาพรรณ', ' ', ' ', 'LAUNGSOPAPARN', 'TAWATCHAI', '1202', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 4, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'tawatchai.l@cmu.ac.th', 'tawatch007@yahoo.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(24, '024', '02', '', 'กรรณิการ์', 'ก๋องแก้ว', ' ', ' ', 'KONGKAEW', 'KANNIKA', '1202', '', '', 'x71008', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'kannika.kongkaew@cmu.ac.th', 'kongkaew.kan@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(25, '0270', '02', '', 'พัชรี', 'ตรงเพียรเลิศ', ' ', ' ', 'TRONGPEINLERT', 'PATCHAREE', '1201', '120101', '12010103', 'x71008', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'patcharee.t@cmu.ac.th', 'jochoja@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(26, '0273', '01', '', 'ไพสน', 'คำใจ', ' ', ' ', 'KOMEJI', 'PISON', '1201', '120101', '12010103', 'x71006', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(27, '0274', '01', '', 'ยงยุทธ', 'ไชยน้อย', ' ', ' ', 'CHAINOI', 'YONGYUT', '1201', '120101', '12010103', 'x71006', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'yongyut.ch@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(28, '0275', '01', '', 'สมพล', 'วงค์เทพ', ' ', ' ', 'WONGTHEP', 'SOMPOL', '1201', '120101', '12010103', 'x71006', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 4, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(29, '0279', '03', '', 'ชัญญา', 'ต๊ะตา', ' ', ' ', '', 'Chanya', '1202', '', '', 'x71008', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 4, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'chanya.tata@cmu.ac.th', 'chanyatata@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(30, 'D160010', '37', '', 'วรธิมา', 'สีลวานิช', ' ', ' ', 'silavanich', 'voratima', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'voratima.silavanich@cmu.ac.th', 'voratima_silavanich@yahoo.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(31, 'D160007', '41', '', 'ภูขวัญ', 'อรุณมานะกุล', ' ', ' ', 'ARUNMANAKUL', 'POUKWAN', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'poukwan.arun@cmu.ac.th', 'poukwan@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(32, 'D160009', '39', '', 'มันติวีร์', 'นิ่มวรพันธุ์', ' ', ' ', 'Nimworapan', 'Mantiwee', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'mantiwee.nim@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(33, 'E160051', '03', '', 'กนกอร', 'แสนอาษา', ' ', ' ', 'SANARSA', 'KANOK-ON', '1201', '120102', '12010203', 'x71008', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'kanok-on.sanarsa@cmu.ac.th', 'chaonayzaa@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(34, 'E160037', '02', '', 'เสาวลักษณ์', 'ไชยเมฆา', ' ', ' ', 'chaimekha', 'saowaluk', '1201', '120102', '12010201', 'x71008', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'saowaluk.chai@cmu.ac.th', 'jeeranutja@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(35, 'D160002', '01', '', 'ลิขิต', 'สุภาสาย', ' ', ' ', 'supasai', 'likit', '1201', '120103', '12010304', 'x71008', '', 5, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'likit.s@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(36, '0301', '02', '', 'แจ่มศรี', 'วงค์ชะรัตน์', ' ', ' ', 'wongsharath', 'Jamsri', '1201', '120101', '12010101', 'x71008', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'jamsri.w@cmu.ac.th', 'kunaor2010@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(37, '031', '03', '', 'จารุณี', 'เกิดสวัสดิ์', ' ', ' ', 'Kerdsawat', 'Jarunee', '1206', '', '', 'x71008', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 4, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'aom131@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(38, 'E160018', '37', '', 'ประภาพร', 'เป็งธินา', ' ', ' ', 'PENGTHINA', 'PRAPAPORN', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 1, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'prapaporn.pengthina@cmu.ac.th', 'modtanoy_nunan@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(39, 'E160032', '36', '', 'ภัทรพันธ์', 'สุขวุฒิชัย', ' ', ' ', 'SUKWUTTICHAI', 'PATTARAPAN', '1202', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'pattarapan.suk@cmu.ac.th', 'sukwuttichai@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(40, '035', '02', '', 'กมลธนัสร์', 'ศรีสุวรรณ', ' ', ' ', '', 'Kamoltanut', '1201', '120102', '12010204', 'x71008', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 4, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'ks_sine@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(41, '036', '02', '', 'จุรีรัตน์', 'สัญญาลักษณ์', ' ', ' ', 'sanyaluck', '่jureerat', '1201', '120104', '12010402', 'x71008', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'jureerat.sanyaluck@cmu.ac.th', 'sanyaluck24@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(42, 'E160038', '02', '', 'กรรณิการ์', 'พงศ์นฤมิตร', ' ', ' ', 'pongnarumit', 'kannikar', '1203', '', '', 'x71008', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'kannikar.p@cmu.ac.th', 'k.pongnaruemit@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(43, 'D160004', '02', '', 'อุมาพร', 'ภูสด', ' ', ' ', 'PUSOD', 'UMAPORN', '1201', '120105', '12010503', '205015', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'umaporn.pu@cmu.ac.th', 'kookkaijung@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(44, 'D160008', '39', '', 'กรรณิกา', 'เทียรฆนิธิกูล', ' ', ' ', 'Thiankhanithikun', 'Kannika', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'kannika.th@cmu.ac.th', 'kungkannika@yahoo.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(45, 'D160003', '01', '', 'สุวัฒน์', 'งามดี', ' ', ' ', 'Ngamdee', 'suwat', '1201', '120103', '', 'x71008', 'X018', 5, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'suwat.ng@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(46, 'E160031', '37', '', 'เรวดี', 'วงศ์ปการันย์', ' ', ' ', 'WONGPAKARAN', 'REWADEE', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'rewadee.w@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(47, 'E160043', '02', '', 'ณัฐพร', 'อ๋องคณา', ' ', ' ', 'Ongkana', 'Nathaporn', '1201', '120102', '12010201', 'x71008', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'nathaporn.ong@cmu.ac.th', 'nat.baerchen@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(48, 'E160040', '02', '', 'เสาวฤณีย์', 'แสงศรีจันทร์', ' ', ' ', 'Sangsrijan', 'Saowarunee', '1206', '', '', '205015', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'saowarunee.s@cmu.ac.th', 'saowarunee.s@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(49, 'E160022', '02', '', 'พัชรรักษ์', 'ใจคำปิง', ' ', ' ', 'JAIKAMPING', 'PATCHARARAK', '1201', '120102', '12010204', 'x71008', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'patchararak.j@cmu.ac.th', 'jaikamping@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(50, 'E160026', '02', '', 'สิริลักษณ์', 'แสงศรีจันทร์', ' ', ' ', 'Sangsrijan', 'Siriluk', '1206', '', '', '205015', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sirilak.sa@cmu.ac.th', 'tikkies87.ss@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(51, '0621', '03', '', 'กุลธวัช', 'เซี่ยงวงษ์', ' ', ' ', 'siangwong', 'kunthawat', '1206', '', '', '205015', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'kunthawat.s@cmu.ac.th', 'kunseejunya@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(52, 'E160021-0', '02', '', 'ณัฐธิดา', 'เหลืองเพียรสมุท', ' ', ' ', 'Luengpiansamut', 'Natthida', '1206', '', '', '214011', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 4, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'Nutthida.l@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(53, 'D160011', '41', '', 'อำไพ', 'พฤติวรพงศ์กุล', ' ', ' ', 'PHRUTIVORAPONGKUL', 'AMPAI', '1203', '', '', '100000', 'X006', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'ampai.phrutiv@cmu.ac.th', 'phampai@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(54, '0896', '41', '', 'ดุจฤดี', 'ชินวงศ์', ' ', ' ', 'CHINWONG', 'DUJRUDEE', '1202', '', '', '100000', '', 1, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'dujrudee.c@cmu.ac.th', 'pinkybeautiful2006@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(55, 'D160005', '02', '', 'อุมาพร', 'ปัญญา', ' ', ' ', 'PANYA', 'UMAPORN', '1201', '120105', '', 'x71008', 'X020', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'umaporn.p@cmu.ac.th', 'umaporn.ooy@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(56, '1491', '01', '', 'ทองสุข', 'แก้วเรือน', ' ', ' ', 'KAEWRUAN', 'THONGSOOK', '1201', '120102', '12010201', 'x71000', '', 7, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'thongsuk.k@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(57, '1495', '01', '', 'พล', 'มหาวัน', ' ', ' ', 'MAHAWAN', 'POL', '1201', '120101', '12010103', '204015', '', 7, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(58, '1496', '02', '', 'บุญปั๋น', 'ไอถิน', ' ', ' ', 'ITIN', 'BOONPUN', '1201', '120101', '12010103', 'x71001', '', 7, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'boonpun.i@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(59, '1498', '01', '', 'สมศักดิ์', 'ไอถิน', ' ', ' ', 'AITIN', 'SOMSAK', '1201', '120101', '12010103', '204012', '', 7, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(60, '1500', '01', '', 'วรเชษฐ์', 'จันทิมา', ' ', ' ', 'JHANTIMA', 'VORACHED', '1201', '120102', '12010201', '320025', '', 7, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'worached.j@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(61, 'C160005', '03', '', 'พัชรินทร์', 'วังคะวงษ์', ' ', ' ', 'WOUNGKAWONG', 'PATCHARIN', '1201', '120105', '', 'x71013', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'patcharin.wang@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(62, '1511', '01', '', 'บัญชา', 'อุ่นคำ', ' ', ' ', 'UNKUM', 'BUNCHAR', '1201', '120101', '12010103', '207015', '', 7, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'bunchar.un@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(63, '1513', '01', '', 'ไสว', 'บุญหล้า', ' ', ' ', 'BOONLAR', 'SAWAI', '1201', '120101', '12010103', '204012', '', 7, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sawai.bo@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(64, '1516', '03', '', 'วิภาวี', 'เสวะกะ', ' ', ' ', 'SEWAKA', 'WIPAWEE', '1201', '120102', '12010201', 'x71004', '', 7, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'wipawee.sewaka@cmu.ac.th', 'wipatida@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(65, '1517', '03', '', 'นิวาศ', 'วงศ์คำ', ' ', ' ', 'WONGKUM', 'NIWAS', '1201', '120101', '12010103', 'x71001', '', 7, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'niwas.w@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(66, '1518', '01', '', 'วีระชาติ', 'คำปา', ' ', ' ', 'KHAMPA', 'WEERACHAT', '1201', '120101', '12010103', '301022', '', 7, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'weerachat.khampa@cmu.ac.th', 'Chati_ball@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(67, 'C160003', '03', '', 'ศิรดา', 'กลิ่นน้อย', ' ', ' ', 'GLINNOI', 'SIRADA', '1201', '120104', '12010402', 'x71013', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sirada.k@cmu.ac.th', 'sirada2506@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(68, '1521', '03', '', 'ภักดิ์ดี', 'นาคอ่อน', ' ', ' ', 'NAKON', 'PUKDEE', '1201', '120101', '12010103', 'x71001', '', 7, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'pukdee.n@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(69, 'C160004', '01', '', 'เสน่ห์', 'ตาสา', ' ', ' ', 'TASA', 'SANAE', '1201', '120103', '12010304', 'x71006', '', 5, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sanae.t@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(70, 'C160006', '03', '', 'ดวงเดือน', 'แก้วดวงแสง', ' ', ' ', 'KAEWDUANSANG', 'DOUNGDUAN', '1201', '120104', '12010402', 'x71012', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'jeed_97@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(71, 'C160001', '03', '', 'วลัยภรณ์', 'ฟองตระกูล', ' ', ' ', 'FONGTRAGOON', 'VALAIPORN', '1201', '120103', '12010302', 'x71012', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'valai_porn.f@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(72, 'C160002', '03', '', 'จีราวรรณ', 'บัวแก้ว', ' ', ' ', 'BOUWKEAW', 'JERAWAN', '1201', '120101', '12010101', 'x71012', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'jeerawan.b@cmu.ac.th', 'jeerawan.buakeaw@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(73, '1526', '01', '', 'สุเทพ', 'ปัญญามณี', ' ', ' ', 'punyamanee', 'suthep', '1201', '120101', '12010103', 'x71003', '', 7, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'suthep.punya@cmu.ac.th', 'thep1234@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(74, '1527', '01', '', 'นิคม', 'อรุณวิไล', ' ', ' ', 'ARONVILAI', 'NIKOM', '1203', '', '', 'x71011', '', 7, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'nikom.a@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(75, '1528', '02', '', 'พรรณี', 'แซ่โง้ว', ' ', ' ', 'SANGNOW', 'PUNNEE', '1203', '', '', '301022', '', 7, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'punnee.s@cmu.ac.th', 'punnee46@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(76, '1529', '02', '', 'จันทร์เพ็ญ', 'ชัยชนะ', ' ', ' ', ' CHAICHANA ', 'JUNPHEN', '1201', '120101', '12010102', '301022', '', 7, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'junphen.ch@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(77, '1531', '02', '', 'แจ่มจันทร์', 'วงศ์จันทร์', ' ', ' ', 'wongchan', 'jamjan', '1203', '', '', '314021', '', 7, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'naruchol.w@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(78, '1532', '01', '', 'สมชาย', 'ไอถิน', ' ', ' ', 'Itin', 'Somchai', '1201', '120102', '12010201', '301022', '', 7, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'somchai.i@cmu.ac.th', ' somchai.itin@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(79, '1534', '03', '', 'อัญชลี', 'เทพวงค์', ' ', ' ', 'THEPPAWONG', 'ANCHALEE', '1201', '120101', '12010103', 'x71001', '', 7, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'anchalee.thep@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(80, 'D160001', '03', '', 'เรืองรอง', 'คำปา', ' ', ' ', 'KHAMPA', 'REONGRONG', '1201', '120104', '12010401', 'x71011', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'reongrong.k@cmu.ac.th', 'reongrong@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(81, '1536', '01', '', 'สุรพล', 'วงศ์หาญ', ' ', ' ', 'WONGHAN', 'SURAPOL', '1201', '120101', '12010103', 'x71001', '', 7, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'surapol.w@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(82, '1884', '03', '', 'ศิราพร', 'บุญยืน', ' ', ' ', 'BOONYUEN', 'SIRAPORN', '1201', '120101', '12010103', 'x71016', '', 2, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'siraporn.b@cmu.ac.th', 'Siraporn206@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(83, 'A160019', '03', '', 'อุไรวรรณ', 'แอ็บบลิ่ง', ' ', ' ', 'Ebbeling', 'Uraiwan', '1201', '120102', '', 'x71008', 'X019', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'uraiwan.e@cmu.ac.th', 'awodette@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(84, 'A160043', '43', '', 'ปาจรีย์', 'ศรีอุทธา', ' ', ' ', 'SRIUTTHA', 'PAJAREE', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'pajaree.s@cmu.ac.th', 'mookpj@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(85, '1892', '39', '', 'อรุณรัตน์', 'ลักษณ์ศิริ', ' ', ' ', 'Lucksiri', 'Aroonrut', '1202', '', '', '100000', '', 1, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'aroonrut.l@cmu.ac.th', 'noilucksiri@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(86, 'A160005', '08', '', 'วรรณดี', 'แต้โสตถิกุล', ' ', ' ', 'TAESOTIKUL', 'WANDEE', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'wandee.t@cmu.ac.th', 'wandee50@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(87, 'A160050', '40', '', 'ทรงวุฒิ', 'ยศวิมลวัฒน์', ' ', ' ', 'YOTSAWIMONWAT', 'SONGWUT', '1203', '', '', '100000', 'X003', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'songwut.y@cmu.ac.th', 'songwut.y@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(88, '1895', '47', '', 'อรอนงค์', 'กิตติพงษ์พัฒนา', ' ', ' ', 'KITTIPONGPATANA', 'ORNANONG', '1203', '', '', '100000', '', 1, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'ornanong.kit@cmu.ac.th', 'ornanongkittipongpatana@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(89, 'A160013', '47', '', 'สุพร', 'จารุมณี', ' ', ' ', 'CHARUMANEE', 'SUPORN', '1203', '', '', '100000', 'X011', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'suporn.charumanee@cmu.ac.th', 'chsupoen@yahoo.com, chsuporn@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(90, '1898', '47', '', 'สิริพร', 'บูรพาเดชะ', ' ', ' ', 'BURAPADAJA', 'SIRIPORN', '1202', '', '', '100000', '', 1, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'Siriporn.b@cmu.ac.th', 'siriporncmu@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(91, 'A160036', '47', '', 'บุษบัน', 'ศิริธัญญาลักษณ์', ' ', ' ', 'SIRITHUNYALUG', 'BUSABAN', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'busaban.s@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(92, 'A160034', '40', '', 'สยาม', 'แก้ววิชิต', ' ', ' ', 'KAEWVICHIT', 'SAYAM', '1203', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sayam.k@cmu.ac.th', 'sayamkvc@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(93, 'A160058', '08', '', 'เอื้อพร', 'ไชยวรรณ', ' ', ' ', 'CHAIWON', 'AUEPORN', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'aueporn.ch@cmu.ac.th', 'Ta_1515@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(94, 'A160035', '45', '', 'พิมพร', 'ลีลาพรพิสิฐ', ' ', ' ', 'Leelapornpisid', 'Pimporn', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'pimporn.lee@cmu.ac.th', 'pimleelaporn@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(95, 'A160040', '08', '', 'ปราโมทย์', 'ทิพย์ดวงตา', ' ', ' ', 'TIPDUANGTA', 'PRAMOTE', '1203', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'phiptpdn@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(96, 'A160027', '46', '', 'จักรพันธ์', 'ศิริธัญญาลักษณ์', ' ', ' ', 'SIRITHUNYALUG', 'JAKKAPAN', '1203', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'jakkapan.s@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(97, 'A160022', '12', '', 'จีรเดช', 'มโนสร้อย', ' ', ' ', 'MANOSROI', 'JEERADEJ', '1203', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'jiradej.manosroi8@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(98, 'A160016', '03', '', 'พรพิมล', 'จาปัญญะ', ' ', ' ', 'JAPUNYA', 'PORNPIMON', '1201', '120102', '12010203', 'x71008', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'ponpimon.j@cmu.ac.th', 'pornpimon4354@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(99, 'A160012', '08', '', 'นภาพร', 'โออริยกุล', ' ', ' ', 'O-ARIYAKUL', 'NABHAPORN', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'changmoo@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(100, '294', '01', '', 'ชานนท์', 'อ่ำศรี', ' ', ' ', '', 'Chanon', '1201', '120101', '12010103', 'x71007', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'charnon.amsri@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(101, '305', '01', '', 'ธนรัตน์', 'สุวรรณเสวตร', ' ', ' ', '', 'Thanarat', '1201', '120101', '12010103', 'x71007', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 4, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'tanarat.s@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(102, '3088', '01', '', 'สมพงษ์', 'ชนะกอก', ' ', ' ', 'CHANAKOK', 'SOMPONG', '1201', '120101', '12010103', '302019', '', 3, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sompongphar@hotmail.com', 'sompong.ch@cmu.ac.th', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(103, 'A160038', '03', '', 'อุมารินทร์', 'รัตนเพชร', ' ', ' ', 'Rattanapet', 'UMARIN', '1201', '120104', '12010402', 'x71005', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'umarin216959@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(104, 'A160003', '02', '', 'อาภรณ์', 'โชติธนานันท์', ' ', ' ', 'CHOTITANANUNT', 'APORN', '1201', '120102', '12010202', 'x71008', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 3, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'aporn.cho@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(105, 'A160048', '02', '', 'อัมพร', 'อินวงค์', ' ', ' ', 'INWONG', 'UMPORN', '1201', '120102', '12010201', 'x71005', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'umporn.i@cmu.ac.th', 'iumporn@yahoo.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(106, 'A160030', '03', '', 'วรรณา', 'กาบศรี', ' ', ' ', 'KABSEE', 'WANNA', '1203', '', '', '314021', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'wanna.kab@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(107, 'A160031', '01', '', 'ประภาส', 'ภูเวียง', ' ', ' ', 'phoowiang', 'prapart', '1203', '', '', '205015', '', 5, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'prapart.p@cmu.ac.th', 'prapartp3@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(108, 'A160029', '03', '', 'สุภฎารัตน์', 'สุธีพรวิโรจน์', ' ', ' ', 'SUTEEPORNWIROJ', 'SUPADARATH', '1203', '', '', '314021', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'supadarath.sutee@cmu.ac.th', 'pharpost@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(109, '3913', '01', '', 'อนุ', 'สุต๋า', ' ', ' ', 'SUTA', 'A-NU', '1201', '120101', '12010103', 'x71006', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'a-nu.s@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(110, 'E160050', '01', '', 'นรากร', 'คำฟู', ' ', ' ', 'Khamfoo', 'Narakorn', '1203', '', '', '205015', '', 5, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'narakorn.kh@cmu.ac.th', 'narakornpadd@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(111, '392', '02', '', 'สุธินี', 'นาแก้ว', ' ', ' ', 'NARKEAW', 'SUTINEY', '1201', '120105', '12010502', 'x71008', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sutiney.n@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(112, 'A160018', '03', '', 'รวิภา', 'วงศ์บุศยรัตน์', ' ', ' ', 'wongbusayarut', 'ravipa', '1201', '120103', '', 'x71008', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'ravipa.w@cmu.ac.th', 'ravipaw@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(113, '5099', '47', '', 'กนกพร', 'นิวัฒนนันท์', ' ', ' ', 'NIWATANANUN', 'KANOKPORN', '1202', '', '', '100000', '', 1, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'kanokporn.n@cmu.ac.th', 'kniwatan@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(114, 'A160042', '46', '', 'วิรัตน์', 'นิวัฒนนันท์', ' ', ' ', 'Niwatananun', 'Wirat', '1202', '', '', '100000', 'X001', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'wirat.n@cmu.ac.th', 'wiratn@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(115, '5101', '47', '', 'ศิริพร', 'โอโกโนกิ', ' ', ' ', 'OKONOGI', 'SIRIPORN', '1203', '', '', '100000', '', 1, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'siriporn.okonogi@cmu.ac.th', 'okng2000@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(116, '5102', '47', '', 'ศิริวิภา', 'ปิยะมงคล', ' ', ' ', 'PIYAMONGKOL', 'SIRIVIPA', '1203', '', '', '100000', 'X004', 1, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sirivipa.p@cmu.ac.th', 'khva1318@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(117, 'A160033', '03', '', 'ชินานารถ', 'ศรีจันทร์ดร', ' ', ' ', 'Srichandorn', 'Chinanart', '1201', '120101', '12010101', 'x71008', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'chinanart.s@cmu.ac.th', 'chinanart@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(118, 'B160003', '01', '', 'สิทธา', 'สภาวจิตร', ' ', ' ', 'SAPAVAJIT', 'SITTA', '1201', '120101', '12010103', 'x71008', '', 5, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sitta.s@cmu.ac.th', 'sitta.pharmacy@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(119, 'A160047', '02', '', 'จินดา', 'ภิโล', ' ', ' ', 'PILO', 'CHINDA', '1201', '120105', '12010501', 'x71008', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'chinda@cmu.ac.th', 'rx.jinda@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(120, '5576', '46', '', 'ภูริวัฒน์', 'ลี้สวัสดิ์', ' ', ' ', 'LEESAWAT', 'PHURIWAT', '1203', '', '', '100000', '', 1, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'phuriwat.l@cmu.ac.th', 'drphuriwat@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(121, 'A160044', '03', '', 'ไพลิน', 'อินต๊ะใหม่', ' ', ' ', 'INTAMAI', 'PAILIN', '1201', '120104', '12010401', 'x71008', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'pailin.in@cmu.ac.th', 'pailin.in@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(122, 'A160010', '46', '', 'สุรพล', 'นธการกิจกุล', ' ', ' ', 'NATAKANKITKUL', 'SURAPOL', '1203', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'surapol.nat@cmu.ac.th', 'surapolhsri@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(123, 'B160009', '44', '', 'โชคชัย', 'วงศ์สินทรัพย์', ' ', ' ', 'WONGSINSUP', 'CHOKCHAI', '1202', '', '', '100000', 'X012', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'chokchai.wongsinsup@cmu.ac.th', 'chok2909@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' ');
INSERT INTO `staff` (`id`, `code`, `prefix_code`, `prefix_posi`, `fname`, `lname`, `o_fname`, `o_lname`, `e_lname`, `e_fname`, `dep_code`, `job_code`, `unit_code`, `position_code`, `position_dean`, `duty_code`, `sex`, `id_card`, `birth_dates`, `birth_place`, `blood`, `nation`, `country`, `religion`, `address`, `tambol`, `amphur`, `city`, `zip`, `tel`, `marry`, `marry_name`, `child`, `father`, `mother`, `family`, `work_status`, `in_date`, `end_date`, `kbk`, `photo`, `files_sig`, `trans_date`, `email`, `email_exe`, `rec_date`, `ksj`, `tnj`, `username`, `password`, `level`, `IsNormal`, `moo_ban`, `moo`, `road`, `soi`, `tel_o`, `branch`) VALUES
(124, '6000', '40', '', 'สุระรอง', 'ชินวงศ์', ' ', ' ', 'CHINWONG', 'SURARONG', '1202', '', '', '100000', '', 1, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'surarong.chinwong@cmu.ac.th', 'surarong@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(125, 'A160032', '02', '', 'วรรณนรี', 'เจริญทรัพย์', ' ', ' ', 'CHAROENSUP', 'WANNAREE', '1203', '', '', '205015', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'wannaree.charoensup@cmu.ac.th', 'wannareec@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(126, 'A160046', '01', '', 'สัมพันธ์', 'วงค์เทพ', ' ', ' ', 'VONGTHEP', 'SUMPUN', '1203', '', '', 'x71014', '', 5, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sumpun.v@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(127, 'A160045', '03', '', 'ศรีพรรณ', 'สรรสวาสดิ์', ' ', ' ', 'SANSAWAS', 'SRIPHAN', '1201', '120104', '', 'x71011', 'X017', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sriphan.s@cmu.ac.th', 'sriphan02@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(128, 'A160054', '39', '', 'นราวดี', 'เนียมหุ่น', ' ', ' ', '', 'Narawadee', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'narawadee.n@cmu.ac.th', 'narawade_n@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(129, 'A160017', '03', '', 'อมรรัตน์', 'พลขาง', ' ', ' ', 'TASA', 'AMORNRAT', '1201', '120104', '12010402', 'x71005', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'amornrat.tasa@cmu.ac.th', 'amornrattasa@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(130, 'B160002', '45', '', 'อุษณีย์', 'คำประกอบ', ' ', ' ', 'KUMPRAGOB', 'USANEE', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'usanee.k@cmu.ac.th', 'pmistvch@chiangmail.ac.th', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(131, 'A160057', '40', '', 'ไชยวัฒน์', 'ไชยสุต', ' ', ' ', 'CHAIYASUT', 'CHAIYAVAT', '1203', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'chaiyavat.c@cmu.ac.th', 'chaiyavat@yahoo.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(132, '6249', '47', '', 'อัญชลี', 'เพิ่มสุวรรณ', ' ', ' ', 'permsuwan', 'unchalee', '1202', '', '', '100000', '', 1, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'unchalee.permsuwan@cmu.ac.th', 'unchalee.permsuwan@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(133, 'A160021', '02', '', 'ดวงพร', 'ชัชวารี', ' ', ' ', 'CHATVAREE', 'DUANGPORN', '1203', '', '', 'x71008', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'duangporn.chat@cmu.ac.th', 'duangpch@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(134, 'A160052', '41', '', 'สุนีย์', 'จันทร์สกาว', ' ', ' ', 'CHANSAKAOW', 'SUNEE', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sunee.c@cmu.ac.th', 'chsunee@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(135, 'B160004', '02', '', 'วัชรี', 'ศรีประจวบ', ' ', ' ', 'SRIPRAJUAB', 'WATCHAREE', '1202', '', '', 'x71008', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'watcharee.d@cmu.ac.th', 'watchareed@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(136, 'A160059', '41', '', 'ชฎารัตน์', 'อัมพะเศวต', ' ', ' ', 'Ampasavate', 'Chadarat', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'chadarat.a@cmu.ac.th', 'aimchadarat@windowslive.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(137, 'A160039', '41', '', 'ชุลีกร', 'สอนสุวิทย์', ' ', ' ', 'Sornsuvit', 'Chuleegone', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'chuleegone.sornsuvit@cmu.ac.th', 'chujang@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(138, 'B160007', '45', '', 'ชบาไพร', 'โพธิ์สุยะ', ' ', ' ', 'PHOSUYA', 'CHABAPHAI', '1202', '', '', '100000', 'X010', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'chabaphai.p@cmu.ac.th', 'chaba.pharmacy@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(139, '6556', '39', '', 'ชิดชนก', 'เรือนก้อน', ' ', ' ', 'RUENGORN', 'CHIDCHANOK', '1202', '', '', '100000', '', 1, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'chidchanok.r@cmu.ac.th', 'mei.ruengorn@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(140, '6557', '46', '', 'นิสิต', 'กิตติพงษ์พัฒนา', ' ', ' ', 'KITTIPONGPATANA', 'NISIT', '1203', '', '', '100000', '', 1, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'nisit.k@cmu.ac.th', 'nisitk@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(141, 'A160055', '41', '', 'รัตนาภรณ์', 'อาวิพันธ์', ' ', ' ', 'AWIPHAN', 'RATANAPORN', '1202', '', '', '100000', 'X005', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'ratanaporn.a@cmu.ac.th', 'ratanaaw@yahoo.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(142, '6588', '47', '', 'หทัยกาญจน์', 'เชาวนพูนผล', ' ', ' ', 'Chowwanapoonpohn', 'Hathaikan', '1202', '', '', '100000', 'X002', 1, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'hathaikan.chow@cmu.ac.th', 'hathaik@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(143, '6610', '41', '', 'พักตร์วิภา', 'สุวรรณพรหม', ' ', ' ', 'Suwannaprom', 'Puckwipa', '1202', '', '', '100000', '', 1, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'puckwipa.suwan@cmu.ac.th', 'puckwipa@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(144, 'A160056', '37', '', 'เดือนกาญจน์', 'สุทธิเวทย์', ' ', ' ', 'SUTTHIWAIT', 'DUANKAN', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'duankan.s@cmu.ac.th', 'sutthiwet@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(145, '6647', '41', '', 'วิสินี', 'จันทร์มหเสถียร', ' ', ' ', 'CHANMAHASATHIEN', 'WISINEE', '1203', '', '', '100000', '', 1, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'wisinee.c@cmu.ac.th', 'wisineec@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(146, 'A160028', '39', '', 'เพ็ญกาญจน์', 'กาญจนรัตน์', ' ', ' ', 'Kanjanarat', 'Penkarn', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'penkarn.k@cmu.ac.th', 'penkarnk@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(147, 'A160049', '39', '', 'ดรุณี', 'หงษ์วิเศษ', ' ', ' ', 'Hongwiset', 'Darunee', '1203', '', '', '100000', 'X009', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'darunee.h@cmu.ac.th', 'nooleklek@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(148, 'A160041', '39', '', 'วรรณกมล', 'สอนสิงห์', ' ', ' ', '', 'Wannakamol', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'wannakamol.s@cmu.ac.th', 'wannakamol@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(149, 'A160051', '40', '', 'สกนธ์', 'สุภากุล', ' ', ' ', 'SUPAKUL', 'SAKON', '1202', '', '', '100000', 'X021', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sakon.s@cmu.ac.th', 'ssupakul@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(150, '7005', '41', '', 'สุนทรา', 'เอกอนันต์กุล', ' ', ' ', 'Eakanunkul', 'Suntara', '1203', '', '', '100000', '', 1, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'suntara.e@cmu.ac.th', 'eakanunkul@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(151, '7009', '42', '', 'ยงยุทธ', 'เรือนทา', ' ', ' ', 'Ruanta', 'Yongyuth', '1202', '', '', '100000', '', 1, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'yongyuth.ruanta@cmu.ac.th', 'yongyuth2006@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(152, 'A160037', '39', '', 'ภูริดา', 'เวียนทอง', ' ', ' ', 'vientong', 'purida', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'purida.v@cmu.ac.th', 'wpurida@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(153, 'A160053', '38', '', 'สุพัฒน์', 'จิรานุสรณ์กุล', ' ', ' ', 'JIRANUSORNKUL', 'SUPAT', '1203', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'supat.jira@cmu.ac.th', 'supatjira@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(154, 'E160005', '38', '', 'สมจริง', 'รุ่งแจ้ง', ' ', ' ', 'ROONGJANG', 'SOMJING', '1203', '', '', '100000', 'X008', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'Somjing.r@cmu.ac.th', 'somjing@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(155, 'E160001', '36', '', 'สินธุ์วิสุทธิ์', 'สุธีชัย', ' ', ' ', 'SUTHEECHAI', 'SINWISUT', '1202', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sinwisuth.s@cmu.ac.th', 'i-tua-saeb@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(156, 'E160003', '36', '', 'วันชนะ', 'สิงห์หัน', ' ', ' ', 'SINGHAN', 'WANCHANA', '1202', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 1, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'na_ice@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(157, 'E160004', '38', '', 'จักรพันธ์', 'จุลศรีไกวัล', ' ', ' ', 'Julsrigival', 'Jakaphun', '1203', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'jakaphun.jul@cmu.ac.th', 'jakaphun@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(158, 'E160006', '03', '', 'ปิยพร', 'มานะกิจ', ' ', ' ', 'MANAKIJ', 'PIYAPORN', '1201', '120103', '12010301', 'x71008', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'piyaporn.manakij@cmu.ac.th', 'jib_020@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(159, 'E160007', '41', '', 'รังษินี', 'พงษ์ประดิษฐ', ' ', ' ', 'Phongpradist', 'Rungsinee', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'rungsinee.p@cmu.ac.th', 'auan_rx@hotmail', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(160, 'E160008', '38', '', 'เฉลิมพงษ์', 'แสนจุ้ม', ' ', ' ', 'Saenjum', 'Chalermpong', '1203', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'chalermpong.s@cmu.ac.th', 'chalermpong.saenjum@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(161, 'E160009', '41', '', 'วรรธิดา', 'ชัยญาณะ', ' ', ' ', 'Chaiyana', 'Wantida', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'wantida.chaiyana@cmu.ac.th', 'Aa_Rx105@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(162, 'E160010', '41', '', 'เพ็ญศักดิ์', 'จันทราวุธ', ' ', ' ', 'Jantrawut', 'Pensak', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'pensak.j@cmu.ac.th', 'amuamu_j@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(163, 'E160011', '41', '', 'วรินทร', 'รักษ์ศิริวณิช', ' ', ' ', 'Ruksiriwanich', 'Warintorn', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'warintorn.ruksiri@cmu.ac.th', 'yammy109@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(164, 'E160012', '36', '', 'เอกลักษณ์', 'อินทรักษา', ' ', ' ', 'Intharuksa', 'Aekkhaluck', '1203', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'aekkhaluck.int@cmu.ac.th', 'aekkhaluck@yahoo.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(165, 'E160013', '06', '', 'ศศิธร', 'ศิริลุน', ' ', ' ', 'Sirilun', 'Sasithorn', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sasithorn.s@cmu.ac.th', 'ssirilun@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(166, 'E160014', '36', '', 'สุรพล', 'โนชัยวงศ์', ' ', ' ', 'Nochaiwong', 'Surapon', '1202', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 1, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'tommy_amarni@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(167, 'E160015', '37', '', 'จันทร์นภัสสร์', 'ชะตาคำ', ' ', ' ', 'CHATAKHUM', 'JANNAPAS', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 1, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'jannapas.ch@cmu.ac.th', 'padmoo@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(168, 'E160016', '39', '', 'บัณฑิตาภรณ์', 'ศิริจันทร์ชื่น', ' ', ' ', 'Sirichanchuen', 'Buntitabhon', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'buntitabhon.s@cmu.ac.th', 'buntitabhon@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(169, 'E160017', '37', '', 'สุธินี', 'แต้โสตถิกุล', ' ', ' ', 'TAESOTTIKIL', 'SUTHINEE', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 1, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'suthinee.tae@cmu.ac.th', 'suthinee8013@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(170, 'E160019', '41', '', 'ศิริตรี', 'สุทธจิตต์', ' ', ' ', 'Suttajit', 'Siritree', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'siritree.s@cmu.ac.th', 'siritree@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(171, 'E160023', '38', '', 'นพดล', 'ชลอธรรม', ' ', ' ', 'Chalortham', 'Nopphadol', '1203', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'nopphadol.chalortham@cmu.ac.th', 'nopphadolc@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(172, 'E160025-0', '04', '', 'มิ่งขวัญ', 'ณ ตะกั่วทุ่ง', ' ', ' ', 'NA TAKUATHUNG', 'MINGKWAN', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 4, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'mingkwan.n@cmu.ac.th', 'k_mingkwan@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(173, 'E160027', '03', '', 'มนัชยา', 'ทุนคำ', ' ', ' ', 'TOONKUM', 'MANATCHAYA', '1206', '', '', '214011', '', 5, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'manatchaya.w@cmu.ac.th', 'wnatcha@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(174, 'E160028', '01', '', 'ฐปณวัชญ์', 'ปันแก้ว', ' ', ' ', 'PUNKAEW', 'thapanawat ', '1201', '120104', '12010401', 'x71008', '', 5, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'somchet.pu@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(175, 'E160024', '39', '', 'รัตติรส', 'คนการณ์', ' ', ' ', 'Khonkarn', 'Ruttiros', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'ruttiros.khonkarn@cmu.ac.th', 'pharrutty@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(185, '027', '01', '', 'เกียรติขจร', 'สุขไกรไทย', ' ', ' ', 'sukkraithai', 'kietkhajorn', '1201', '120102', '12010202', 'x71008', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'kietkhajorn.su@cmu.ac.th', 'sk-sky@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(186, '028', '02', '', 'นันนธี', 'จอมนงค์', ' ', ' ', 'chomnong', 'nannatee', '1201', '120103', '12010302', 'x71008', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'nannatee.c@cmu.ac.th', 'cnannatee@yahoo.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(187, '022', '02', '', 'ประภัสสร', 'แสงศรีจันทร์', ' ', ' ', 'Sangsrijan', 'prapatsorn', '1206', '', '', 'x71008', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'prapatsorn.s@cmu.ac.th', 'koy_prapatsorn_@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(188, '111111', '03', '', 'อรกัญญา', 'เมธา', ' ', ' ', '', 'aonkanya', '1201', '', '', '301022', '', 9, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(189, '021', '02', '', 'อัสมาอ์', 'ใบนานา', ' ', ' ', 'ิbainana', 'assama', '1201', '120102', '12010204', 'x71008', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'assama.b@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(190, 'E160045', '41', '', 'บราลี', 'ปัญญาวุธโธ', ' ', ' ', 'punyawudho', 'baralee', '1202', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'baralee.p@cmu.ac.th', 'pbaralee@yahoo.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(191, 'E160033', '36', '', 'จักรพันธ์', 'อยู่ดี', ' ', ' ', 'yoodee', 'jakapun', '1202', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 1, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'ukapun.y@cmu.ac.th', 'yjukapun@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(192, 'E160044', '39', '', 'กนกวรรณ', 'เกียรติสิน', ' ', ' ', 'keattisin', 'kanokwan', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'kanokwan.k@cmu.ac.th', 'ppp_pook@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(193, '027-0', '01', '', 'สันติ', 'กินยา', ' ', ' ', 'kinya', 'santi', '1206', '', '', '205015', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 4, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'santi.kinya@cmu.ac.th', 'kinya379@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(194, '7010', '01', '', 'เฉลิม', 'สุภัควงศ์', ' ', ' ', 'Suphakwong', 'chaloem', '1201', '120101', '12010103', 'x71006', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'chaloerm.s@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(195, '0001', '02', '', 'กนกลักษณ์', 'เบญจสุวรรณ', ' ', ' ', 'benjasuwan', 'kanoklak', '1204', '', '', '000000', '', 9, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'kanoklak.ben@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(205, '023', '01', '', 'ศราวุธ', 'สร้อยฟ้า', ' ', ' ', 'soyfa', 'sarawut', '1201', '120101', '12010103', 'x71007', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'sarawut.soyfa@cmu.ac.th', 'sarawut.soyfa@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(200, '11111', '01', '', 'บรรพต', 'แก่นสาร', ' ', ' ', 'gansan', 'banpot', '1201', '120101', '12010103', 'x71015', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 4, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'banpot.g@cmu.ac.th', 'yam_adidas_nick@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(201, 'E160036', '41', '', 'นันทวรรณ', 'กิติกรรณากรณ์', ' ', ' ', 'kitikannakorn', 'nantawarn', '1202', '', '', '100000', 'X007', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'nantawarn.k@cmu.ac.th', 'rx048@yahoo.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(202, '026', '01', '', 'คธาวุธ', 'สมบูรณ์', ' ', ' ', 'somboon', 'katawoot', '1201', '', '', 'x71008', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 4, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'katawoot.s@cmu.ac.th', 'ken_1732@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(203, '025', '02', '', 'ดรุณี', 'โตวิเชียร', ' ', ' ', 'towichiar', 'darunee', '1201', '120102', '12010202', 'x71006', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'darunee.to@cmu.ac.th', 'tewkabeer.852@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(204, 'E160029', '39', '', 'จุฑามาศ', 'เจียรนัยกุลวานิช', ' ', ' ', 'jiaranaikulwanitch', 'jutamas', '1203', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'jutamas.jia@cmu.ac.th', 'jutamas.jia@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(208, 'S4160050', '02', '', 'ปรียานุช', 'อินทะปัด', ' ', ' ', 'intapat', 'preeyanoot', '1202', '', '', 'x71008', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'preeyanoot.int@cmu.ac.th', 'ooypyn@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(209, 'E160002', '36', '', 'ธวัชชัย', 'นาคราชนิยม', ' ', ' ', 'nakkaratniyom', 'thawatchai', '1202', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 4, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', '', 'tnakkarat@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(210, 'E160034', '36', '', 'ณัฐพงศ์', 'ทิตย์วงศ์', ' ', ' ', 'tidwong', 'nattapong', '1202', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'nattapong.tidwong@cmu.ac.th', 'tidwong.n@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(211, 'S4160036', '01', '', 'รังสรรค์', 'พรรณเทียน', ' ', ' ', 'phuntien', 'rungsun', '1201', '120101', '12010103', 'x71015', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'rungsun.p@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(212, 'E160049', '39', '', 'อารยา', 'ไรวา', ' ', ' ', 'raiwa', 'araya', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'araya.raiwa@gmail.com', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(213, 'E160048', '39', '', 'เทพิน', 'จันทร์มหเสถียร', ' ', ' ', 'junmahasathien', 'taepin', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'taepin.j@cmu.ac.th', 'phoenixj035@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(214, 's4160038', '02', '', 'นิภา', 'แก้วบุญเรือง', ' ', ' ', 'kaewboonrueng', 'nipa', '1201', '', '', 'x71008', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'nipa.kaew@cmu.ac.th', '', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(216, '016', '01', '', 'ณรงค์พร', 'ผังวิวัฒน์', ' ', ' ', 'pungwiwat', 'narongporn', '1206', '', '', '205015', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'narongporn.p@cmu.ac.th', 'ืnpungwiwat@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(217, 'E160052', '39', '', 'ผาณิต', 'ธรรมรัตน์', ' ', ' ', 'thammarat', 'phanit', '1203', '', '', '100000', '', 4, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'phanit.thamma@cmu.ac.th', 'pthamma@ncsu.edu', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(218, 'E160021', '33', '', 'พีรพงศ์', 'ศรีฝั้น', ' ', ' ', 'srifun', 'peerapong', '1206', '', '', '214011', '', 5, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'peerapong.sr@cmu.ac.th', 'peerapong.sf@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(221, '00025', '02', '', 'ปุณญานุช', 'เรือนทา', ' ', ' ', 'ruantha', 'poonyanut', '1201', '120105', '12010503', '205015', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'poonyanut.r@cmu.ac.th', 'mattiga153@windowslive.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(222, 'E160055', '36', '', 'กันต์', 'แดงสืบตระกูล', ' ', ' ', 'daengsueptrakun', 'kan', '1202', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'kan.daeng@cmu.ac.th', 'daengsueptrakun.k@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(220, 'E160025', '36', '', 'เกียรติเกรียงไกร', 'โกยรัตโกศล', ' ', ' ', 'koyratkoson', 'kiatkriangkrai', '1202', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'kiatkriangkrai.k@cmu.ac.th', 'kiatkriangkrai.kk@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(223, 'E160053', '38', '', 'ปรัชญา', 'ทิพย์ดวงตา', ' ', ' ', 'tipduangta', 'pratchaya', '1203', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'pratchaya.t@cmu.ac.th', 'p.tipduangta@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(224, 'E160035', '36', '', 'จิรวิชญ์', 'ยาดี', ' ', ' ', 'yadee', '่jirawit', '1202', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'jirawit.yadee@cmu.ac.th', 'jirawit.n@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(225, 'E160047', '36', '', 'ชยุตพงศ์', 'ใจใส', ' ', ' ', 'chaisai', 'chayutthaphong', '1202', '', '', '100000', '', 4, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'chayutthaphong.c@cmu.ac.th', 'c.chayutthaphong@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(226, 'S4160005', '01', '', 'ธนรัตน์', 'ทนนวงค์', ' ', ' ', 'tanonwong', 'tanarat', '1202', '', '', 'x71008', '', 6, '1', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'tanarat.t@cmu.ac.th', 'tanarat.cmu@gmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' '),
(227, 'S4160048', '02', '', 'วรรณิศา', 'กระจาย', ' ', ' ', 'krajay', 'wannisa', '1201', '120104', '12010401', 'x71011', '', 6, '2', ' ', '0000-00-00', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 0, ' ', ' ', 0, 0, '0000-00-00', '0000-00-00', 0, ' ', '', '0000-00-00', 'wannisa.k@cmu.ac.th', 'wannisa_kr55@hotmail.com', '0000-00-00 00:00:00', 0, 0, ' ', ' ', 0, 'TRUE', ' ', ' ', ' ', ' ', ' ', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `staff_mis`
--

CREATE TABLE `staff_mis` (
  `id` int(255) NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสพนักงาน',
  `bill` int(5) NOT NULL,
  `salary` int(5) NOT NULL,
  `education` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_mis`
--

INSERT INTO `staff_mis` (`id`, `code`, `bill`, `salary`, `education`) VALUES
(1, '0', 0, 0, 0),
(2, '000', 0, 0, 0),
(3, '0000000', 0, 0, 0),
(4, '00003', 0, 0, 0),
(5, '00004', 0, 0, 0),
(6, '000001', 0, 0, 0),
(7, '397', 0, 0, 0),
(8, '001', 0, 0, 0),
(9, '0010', 0, 0, 0),
(10, '0011', 0, 0, 0),
(11, '0015', 0, 0, 0),
(12, '0016', 0, 0, 0),
(13, '002', 0, 0, 0),
(14, '003', 0, 0, 0),
(15, '004', 0, 0, 0),
(16, 'E160020', 0, 0, 0),
(17, 'E160041', 0, 0, 0),
(18, 'E160030', 0, 0, 0),
(19, 'E160042', 0, 0, 0),
(20, '011', 0, 0, 0),
(21, 'E160039', 0, 0, 0),
(22, 'A160020', 0, 0, 0),
(23, 'D160006', 0, 0, 0),
(24, '024', 0, 0, 0),
(25, '0270', 0, 0, 0),
(26, '0273', 0, 0, 0),
(27, '0274', 0, 0, 0),
(28, '0275', 0, 0, 0),
(29, '0279', 0, 0, 0),
(30, 'D160010', 0, 0, 0),
(31, 'D160007', 0, 0, 0),
(32, 'D160009', 0, 0, 0),
(33, 'E160051', 0, 0, 0),
(34, 'E160037', 0, 0, 0),
(35, 'D160002', 0, 0, 0),
(36, '0301', 0, 0, 0),
(37, '031', 0, 0, 0),
(38, 'E160018', 0, 0, 0),
(39, 'E160032', 0, 0, 0),
(40, '035', 0, 0, 0),
(41, '036', 0, 0, 0),
(42, 'E160038', 0, 0, 0),
(43, 'D160004', 0, 0, 0),
(44, 'D160008', 0, 0, 0),
(45, 'D160003', 0, 0, 0),
(46, 'E160031', 0, 0, 0),
(47, 'E160043', 0, 0, 0),
(48, 'E160040', 0, 0, 0),
(49, 'E160022', 0, 0, 0),
(50, 'E160026', 0, 0, 0),
(51, '0621', 0, 0, 0),
(52, 'E160021-0', 0, 0, 0),
(53, 'D160011', 0, 0, 0),
(54, '0896', 0, 0, 0),
(55, 'D160005', 0, 0, 0),
(56, '1491', 0, 0, 0),
(57, '1495', 0, 0, 0),
(58, '1496', 0, 0, 0),
(59, '1498', 0, 0, 0),
(60, '1500', 0, 0, 0),
(61, 'C160005', 0, 0, 0),
(62, '1511', 0, 0, 0),
(63, '1513', 0, 0, 0),
(64, '1516', 0, 0, 0),
(65, '1517', 0, 0, 0),
(66, '1518', 0, 0, 0),
(67, 'C160003', 0, 0, 0),
(68, '1521', 0, 0, 0),
(69, 'C160004', 0, 0, 0),
(70, 'C160006', 0, 0, 0),
(71, 'C160001', 0, 0, 0),
(72, 'C160002', 0, 0, 0),
(73, '1526', 0, 0, 0),
(74, '1527', 0, 0, 0),
(75, '1528', 0, 0, 0),
(76, '1529', 0, 0, 0),
(77, '1531', 0, 0, 0),
(78, '1532', 0, 0, 0),
(79, '1534', 0, 0, 0),
(80, 'D160001', 1, 0, 0),
(81, '1536', 0, 0, 0),
(82, '1884', 0, 0, 0),
(83, 'A160019', 0, 0, 0),
(84, 'A160043', 0, 0, 0),
(85, '1892', 0, 0, 0),
(86, 'A160005', 0, 0, 0),
(87, 'A160050', 0, 0, 0),
(88, '1895', 0, 0, 0),
(89, 'A160013', 0, 0, 0),
(90, '1898', 0, 0, 0),
(91, 'A160036', 0, 0, 0),
(92, 'A160034', 0, 0, 0),
(93, 'A160058', 0, 0, 0),
(94, 'A160035', 0, 0, 0),
(95, 'A160040', 0, 0, 0),
(96, 'A160027', 0, 0, 0),
(97, 'A160022', 0, 0, 0),
(98, 'A160016', 0, 0, 0),
(99, 'A160012', 0, 0, 0),
(100, '294', 0, 0, 0),
(101, '305', 0, 0, 0),
(102, '3088', 0, 0, 0),
(103, 'A160038', 0, 0, 0),
(104, 'A160003', 0, 0, 0),
(105, 'A160048', 0, 0, 0),
(106, 'A160030', 0, 0, 0),
(107, 'A160031', 0, 0, 0),
(108, 'A160029', 0, 0, 0),
(109, '3913', 0, 0, 0),
(110, 'E160050', 0, 0, 0),
(111, '392', 0, 0, 0),
(112, 'A160018', 0, 0, 0),
(113, '5099', 0, 0, 0),
(114, 'A160042', 0, 0, 0),
(115, '5101', 0, 0, 0),
(116, '5102', 0, 0, 0),
(117, 'A160033', 0, 0, 0),
(118, 'B160003', 0, 0, 0),
(119, 'A160047', 0, 0, 0),
(120, '5576', 0, 0, 0),
(121, 'A160044', 1, 0, 0),
(122, 'A160010', 0, 0, 0),
(123, 'B160009', 0, 0, 0),
(124, '6000', 0, 0, 0),
(125, 'A160032', 0, 0, 0),
(126, 'A160046', 0, 0, 0),
(127, 'A160045', 1, 0, 0),
(128, 'A160054', 0, 0, 0),
(129, 'A160017', 0, 0, 0),
(130, 'B160002', 0, 0, 0),
(131, 'A160057', 0, 0, 0),
(132, '6249', 0, 0, 0),
(133, 'A160021', 0, 0, 0),
(134, 'A160052', 0, 0, 0),
(135, 'B160004', 0, 0, 0),
(136, 'A160059', 0, 0, 0),
(137, 'A160039', 0, 0, 0),
(138, 'B160007', 0, 0, 0),
(139, '6556', 0, 0, 0),
(140, '6557', 0, 0, 0),
(141, 'A160055', 0, 0, 0),
(142, '6588', 0, 0, 0),
(143, '6610', 0, 0, 0),
(144, 'A160056', 0, 0, 0),
(145, '6647', 0, 0, 0),
(146, 'A160028', 0, 0, 0),
(147, 'A160049', 0, 0, 0),
(148, 'A160041', 0, 0, 0),
(149, 'A160051', 0, 0, 0),
(150, '7005', 0, 0, 0),
(151, '7009', 0, 0, 0),
(152, 'A160037', 0, 0, 0),
(153, 'A160053', 0, 0, 0),
(154, 'E160005', 0, 0, 0),
(155, 'E160001', 0, 0, 0),
(156, 'E160003', 0, 0, 0),
(157, 'E160004', 0, 0, 0),
(158, 'E160006', 0, 0, 0),
(159, 'E160007', 0, 0, 0),
(160, 'E160008', 0, 0, 0),
(161, 'E160009', 0, 0, 0),
(162, 'E160010', 0, 0, 0),
(163, 'E160011', 0, 0, 0),
(164, 'E160012', 0, 0, 0),
(165, 'E160013', 0, 0, 0),
(166, 'E160014', 0, 0, 0),
(167, 'E160015', 0, 0, 0),
(168, 'E160016', 0, 0, 0),
(169, 'E160017', 0, 0, 0),
(170, 'E160019', 0, 0, 0),
(171, 'E160023', 0, 0, 0),
(172, 'E160025-0', 0, 0, 0),
(173, 'E160027', 0, 0, 0),
(174, 'E160028', 1, 1, 0),
(175, 'E160024', 0, 0, 0),
(185, '027', 0, 0, 0),
(186, '028', 0, 0, 0),
(187, '022', 0, 0, 0),
(188, '111111', 0, 0, 0),
(189, '021', 0, 0, 0),
(190, 'E160045', 0, 0, 0),
(191, 'E160033', 0, 0, 0),
(192, 'E160044', 0, 0, 0),
(193, '027-0', 0, 0, 0),
(194, '7010', 0, 0, 0),
(195, '0001', 0, 0, 0),
(205, '023', 0, 0, 0),
(200, '11111', 0, 0, 0),
(201, 'E160036', 0, 0, 0),
(202, '026', 0, 0, 0),
(203, '025', 0, 0, 0),
(204, 'E160029', 0, 0, 0),
(208, 'S4160050', 0, 0, 0),
(209, 'E160002', 0, 0, 0),
(210, 'E160034', 0, 0, 0),
(211, 'S4160036', 0, 0, 0),
(212, 'E160049', 0, 0, 0),
(213, 'E160048', 0, 0, 0),
(214, 's4160038', 0, 0, 0),
(216, '016', 0, 0, 0),
(217, 'E160052', 0, 0, 0),
(218, 'E160021', 0, 0, 0),
(221, '00025', 0, 0, 0),
(222, 'E160055', 0, 0, 0),
(220, 'E160025', 0, 0, 0),
(223, 'E160053', 0, 0, 0),
(224, 'E160035', 0, 0, 0),
(225, 'E160047', 0, 0, 0),
(226, 'S4160005', 0, 0, 0),
(227, 'S4160048', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(60) NOT NULL,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `job_code` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `code`, `job_code`, `name`) VALUES
(1, '12010101', '120101', 'หน่วยธุรการและสารบรรณ'),
(2, '12010102', '120101', 'หน่วยบริหารงานบุคคล'),
(3, '12010103', '120101', 'หน่วยอาคารสถานที่และยานพาหนะ'),
(4, '12010304', '120103', 'หน่วยเทคโนโลยีสารสนเทศ'),
(5, '12010201', '120102', 'หน่วยหลักสูตรทะเบียนและพัฒนาวิชาการ'),
(6, '12010202', '120102', 'หน่วยกิจการนักศึกษา'),
(7, '12010203', '120102', 'หน่วยบัณฑิตศึกษา'),
(8, '12010204', '120102', 'หน่วยฝีกงานและพัฒนาวิชาชีพ'),
(9, '12010301', '120103', 'หน่วยแผนและงบประมาณ'),
(10, '12010302', '120103', 'หน่วยประกันคุณภาพการศึกษา'),
(11, '12010401', '120104', 'หน่วยการเงินและบัญชี'),
(12, '12010402', '120104', 'หน่วยพัสดุ'),
(13, '12010501', '120105', 'หน่วยบริหารงานวิจัย'),
(14, '12010502', '120105', 'หน่วยวิเทศสัมพันธ์'),
(15, '12010503', '120105', 'หน่วยบริการเครื่องมือกลาง');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(5) NOT NULL,
  `code` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `code`, `name`) VALUES
(1, '1', 'Administrator'),
(2, '2', 'Person_admin'),
(3, '3', 'Asset_admin'),
(4, '4', 'Building_admin'),
(5, '5', 'Finance_admin'),
(6, '6', 'Person_staff'),
(7, '7', 'Commit_staff'),
(8, '8', 'Course_staff'),
(9, '9', 'Student_staff'),
(10, '10', 'Research_staff'),
(11, '11', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `work_status`
--

CREATE TABLE `work_status` (
  `id` int(5) NOT NULL,
  `code` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `work_status`
--

INSERT INTO `work_status` (`id`, `code`, `name`, `color`) VALUES
(1, '0', 'ทำงานปกติ', '#009900'),
(2, '1', 'ลาศึกษา', '#CCCC33'),
(3, '3', 'เกษียณอายุราชการ', '#0066FF'),
(4, '4', 'ลาออก', '#FF6600'),
(5, '5', 'ไล่ออก', '#FF0000'),
(6, '6', 'เสียชีวิต', '#666666');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duty`
--
ALTER TABLE `duty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu`
--
ALTER TABLE `edu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `excutive`
--
ALTER TABLE `excutive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert`
--
ALTER TABLE `expert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_bk`
--
ALTER TABLE `position_bk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_de`
--
ALTER TABLE `position_de`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_dean`
--
ALTER TABLE `position_dean`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_work`
--
ALTER TABLE `position_work`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posi_acade`
--
ALTER TABLE `posi_acade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prefix`
--
ALTER TABLE `prefix`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prefix_1`
--
ALTER TABLE `prefix_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `religion`
--
ALTER TABLE `religion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `research`
--
ALTER TABLE `research`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_mis`
--
ALTER TABLE `staff_mis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_status`
--
ALTER TABLE `work_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `duty`
--
ALTER TABLE `duty`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `edu`
--
ALTER TABLE `edu`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `excutive`
--
ALTER TABLE `excutive`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expert`
--
ALTER TABLE `expert`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;
--
-- AUTO_INCREMENT for table `position_bk`
--
ALTER TABLE `position_bk`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;
--
-- AUTO_INCREMENT for table `position_de`
--
ALTER TABLE `position_de`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `position_dean`
--
ALTER TABLE `position_dean`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `position_work`
--
ALTER TABLE `position_work`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `posi_acade`
--
ALTER TABLE `posi_acade`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `prefix`
--
ALTER TABLE `prefix`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `prefix_1`
--
ALTER TABLE `prefix_1`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `religion`
--
ALTER TABLE `religion`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `research`
--
ALTER TABLE `research`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;
--
-- AUTO_INCREMENT for table `staff_mis`
--
ALTER TABLE `staff_mis`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `work_status`
--
ALTER TABLE `work_status`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
