-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 05:45 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc`
--

CREATE TABLE `acc` (
  `no` int(15) NOT NULL,
  `academicqualification` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `acc`
--

INSERT INTO `acc` (`no`, `academicqualification`) VALUES
(1, 'ثانوي'),
(2, 'جامعي');

-- --------------------------------------------------------

--
-- Table structure for table `admen`
--

CREATE TABLE `admen` (
  `id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admen`
--

INSERT INTO `admen` (`id`, `password`) VALUES
('admen', 12345);

-- --------------------------------------------------------

--
-- Table structure for table `books_info`
--

CREATE TABLE `books_info` (
  `registering_no` int(50) NOT NULL,
  `classification_no` float NOT NULL,
  `bookaddress` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `authorname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `edition` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `publication_address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `publisher` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `date` date NOT NULL,
  `pages_numbers` int(50) NOT NULL,
  `size` decimal(50,0) NOT NULL,
  `dept_no` int(11) NOT NULL,
  `img` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books_info`
--

INSERT INTO `books_info` (`registering_no`, `classification_no`, `bookaddress`, `authorname`, `edition`, `publication_address`, `publisher`, `date`, `pages_numbers`, `size`, `dept_no`, `img`) VALUES
(15, 579, 'مقدمة في علم الكائنات الدقيقة', 'جاد الله يوسف فضل الله', 'الاولى', 'مصر ', 'الدار الدولية ', '1982-09-29', 573, '24', 10, ''),
(16, 410, 'مدخل الي علم اللغة', 'ابراهيم محمود خليل', 'الاولى', 'عمان', 'دار السيرة للنشر والتوزيع', '2010-03-12', 264, '24', 1, ''),
(18, 387, 'شذرات من الموروث الثقافي السوداني', 'فرح عيسى محمد', 'الاولى', 'السودان', 'حصاد', '2008-09-24', 222, '24', 9, ''),
(21, 962, 'عصر البطولة في سنار', 'احمد المعتص الشيخ', 'الاولى', 'الخرطوم', 'مطبعة برنتك', '2011-05-02', 488, '22', 9, ''),
(25, 321, 'مناقشات حول الديموقراطية والوحدة الوطنية', 'محمد علي جادين', 'الاولى', 'السودان', 'دار عزة', '2003-09-21', 241, '24', 9, ''),
(33, 214, 'معالم الثقافة الاسلامية', 'عبد الرحيم عمر محب الدين', 'الاولى', 'السودان', 'شركة مطابع السودان', '2007-06-16', 487, '24', 2, ''),
(34, 214, 'ثفافة اسلامية', 'محمود نواصرة', 'العربية', 'الاردن', 'دار البازوري', '2016-09-02', 79, '24', 2, ''),
(37, 210, 'الاسلام دين العولمة ', 'عيسى ابراهيم الخضر', 'الاولى', 'السودان', 'شركة مطابع السودان', '2011-09-11', 2240, '24', 2, ''),
(43, 306, 'الكرم في الارث العربي السوداني ', 'عصام احمد يشير', 'الاولى', 'السودان', 'مجلس الدراسات الاقليمي', '1989-05-05', 227, '24', 9, ''),
(55, 306, 'الهوية السودانية تفكيك المقولات الفاسدة', 'غسان علي عثمان', 'الاولى', 'السودان', 'المكتبة الوطنية ', '2015-08-24', 110, '24', 9, ''),
(61, 240, 'مفهو النوحيد ومستقيل الحضارة', 'محمد الحسن عبد الكريم صالح', 'الاولى', 'السودان', 'دار عزة', '2015-09-04', 200, '24', 2, ''),
(63, 415, 'االتطبيق  النحوي', 'عبده الراجحي', 'الاولى', 'عمان', 'دار السيرة للنشر والتوزيع', '2008-05-12', 432, '24', 1, ''),
(70, 320, 'دراسات في الزحدة الوطنية في السودان', 'العجب احمد الطريفي', 'الاولى', 'السودان', 'مجلس الدراسات الاقليمي', '1988-09-11', 210, '24', 9, ''),
(71, 962, 'الحركة الوطنية السودانية ', 'علي حامد', 'الاولى', 'الخرطوم', 'دار جامعة الخرطوم للنشر ', '2000-02-01', 321, '20', 9, ''),
(76, 962, 'اضواء على مشكلة جنوب السودان', 'محجوب صالح', 'الاولى', 'الخرطوم', 'فهرسة المكتبة الوطنية', '2006-06-12', 118, '24', 9, ''),
(78, 410, 'المهارات اللغوية', 'محمد عبدالله بربر الحاج', 'الاولى', 'الخرطوم', 'فهرسة المكتبة الوطنية', '2015-02-12', 118, '24', 1, ''),
(160, 612, 'علم التشريح السريري', 'عميد روفانيال', 'الاولى', 'سوريا', 'دار المعاجم للطباعة والنشر والتوزيع والترجم', '1997-11-12', 789, '24', 3, ''),
(251, 611, 'علم التشريح البشري  الوطيفي', 'قرشي محمد علي', 'الاولى', 'سوريا', 'دار ابن النفيس', '1998-06-14', 654, '24', 3, ''),
(323, 612, 'الموجز الارشادي عن فيزيوجيا الانسان ', 'فرح', 'الاولى', 'الكويت', 'مركز تعريب العلوم الصحية', '2003-06-12', 944, '24', 10, ''),
(1657, 617.7, 'معجم العين وامراضها', 'صادق الهلالي', 'الاولى', 'مصر', 'المكتب الاقليمي لشؤق البحر المتوسط', '1993-02-12', 317, '24', 5, ''),
(1838, 617.7, 'اطلس ملون في التشخيص العيني', 'حسان احمد قميحة ', 'الثانية', 'انجلترا', 'دار ابن النفيس', '1998-09-15', 179, '24', 5, ''),
(1849, 618, 'تقويم الفكين والاسنان ', 'مروان موقع ', 'الا', 'سوريا', 'دار القلم العربي', '1999-09-12', 867, '24', 4, ''),
(2248, 617, 'الامراض الجراحية', 'مصطفى النور', 'الاولى', 'سوريا', 'كلية الطب جامعة دمشق', '1992-05-21', 272, '24', 7, ''),
(2843, 618.92, 'the short text of pediatrics', 'suraj gupte', '11', 'new delhi ', 'aiims', '2009-03-14', 1015, '24', 11, ''),
(3085, 611, 'علم التشريح التطبيقي', 'عدنان مصطفى ', 'الاولى', 'سوريا', 'مطبعة الروضة ', '1981-08-12', 889, '24', 0, ''),
(3094, 612, 'علم التشريح التطبيقي الراس والعنق', 'عدنان مصطفى', 'الاولى', 'سوريا', 'مطبعة الروضة', '2001-04-12', 889, '24', 0, ''),
(3156, 617.5, 'استخدامات الليزر في الطب', 'احمد علي يوسف', 'الاولى', 'الكويت', 'مركز تعريب العلوم الصحية', '2015-09-05', 96, '24', 0, ''),
(3185, 619.98, 'مدخل الي الانتروبولجيا البيولوجية', 'علي عبد العزيز ', 'الاولى ', 'الاردن', 'المركز العربي', '1997-08-22', 285, '24', 0, ''),
(3197, 617, 'فن وعلم العلاج التحفظي للانسان', 'علي نور', 'الثانية', 'القاهرة', 'الدار العربية للنشر والتوزيغ', '1985-08-12', 1031, '24', 0, ''),
(3229, 617, 'الجراحة الاكلينيكية', 'الفريد كوشري واخرون', 'الاولى', 'الكويت', 'مركز التعريب للعلوم الصحية', '2007-02-09', 782, '24', 0, ''),
(3231, 617.15, 'دليل الطالب في امراض العظام والكسور ', 'فرانك', 'الاولى', 'سوريا', 'مركز تعريب العلوم الصحية', '1992-10-17', 272, '24', 0, ''),
(3413, 612, 'humn physiology', 'nm muthayya', 'forth edition', 'delhi', 'sanat printers', '2010-10-12', 4322, '24', 0, ''),
(3518, 612, 'gangogs review', ' kim barrett', 'twenty fifth edition', 'collfornia', '', '2015-03-12', 727, '24', 0, ''),
(3522, 612, 'exercise physiology', 'williiam mcardiie', 'first editiion', 'calfornia', 'lippincott williarns and wikins', '1981-08-12', 999, '24', 0, ''),
(3694, 618, 'general embryology', 'elrakhawy', 'first', 'egypt', 'الحقوق محفوظة للمؤلف', '2000-09-23', 184, '22', 0, ''),
(3697, 618, 'apractical guide to neonatal care', 'suhair', 'first', 'khartoom', 'national library cataloging ', '2018-06-29', 125, '24', 0, ''),
(3698, 618, 'apractical', '', '', '', '', '0000-00-00', 0, '0', 0, ''),
(90269, 611, 'اطلس تشريح جسم الانسان', 'محمود الجزيري', 'الثانية', 'سوريا', 'مكتبة المركز المعاصر', '1993-05-12', 999, '24', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `ddd`
--

CREATE TABLE `ddd` (
  `degree` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ddd`
--

INSERT INTO `ddd` (`degree`) VALUES
('deplom'),
('dh.d'),
('master');

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `dept_no` int(10) NOT NULL,
  `deptname` varchar(30) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`dept_no`, `deptname`) VALUES
(1, 'اللغة العربية'),
(2, 'ثقافة اسلامية'),
(3, 'تشريح'),
(4, 'طب اسنات'),
(5, 'عيون'),
(6, 'ادوية'),
(7, 'جراحة'),
(8, 'علم الامراض'),
(9, 'علوم اجتماعية'),
(10, 'فسولوجيا');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(50) NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `secondname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `telephone` int(50) NOT NULL,
  `address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `degree` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `birthdate` date NOT NULL,
  `employment` date NOT NULL,
  `academicqualification` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `firstname`, `secondname`, `telephone`, `address`, `degree`, `birthdate`, `employment`, `academicqualification`) VALUES
(1, 'سماح', 'حسن', 9876543, 'البورت', 'دبلوم', '2024-11-02', '2024-11-10', 'ثانوي'),
(2, 'سارة', 'حسن', 2345678, 'البورت', 'دبلوم', '2023-12-04', '2024-11-05', 'جامعي'),
(3, 'فاطمة ', 'محمد', 657677467, 'البورت', 'دبلوم', '2023-12-04', '2024-11-01', 'ثانوي'),
(4, 'تالين', 'حسن', 4567890, 'البورت', 'دبلوم', '2023-09-13', '2024-10-28', 'جامعي');

-- --------------------------------------------------------

--
-- Table structure for table `lo`
--

CREATE TABLE `lo` (
  `id` int(10) NOT NULL,
  `password` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lo`
--

INSERT INTO `lo` (`id`, `password`) VALUES
(1, 'semsem');

-- --------------------------------------------------------

--
-- Table structure for table `mem`
--

CREATE TABLE `mem` (
  `memberno` int(5) NOT NULL,
  `name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `college` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` int(15) NOT NULL,
  `address` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mem`
--

INSERT INTO `mem` (`memberno`, `name`, `college`, `telephone`, `address`, `degree`) VALUES
(1, 'samah', 'it', 9876543, 'port', 'deplom'),
(2, 'sara', 'it', 98765432, 'port', 'deplom'),
(3, 'joory', 'cs', 98765432, 'port', 'master'),
(4, 'fatooma', 'it', 2345678, 'port', 'master'),
(5, 'soso', 'it', 123456, 'port', 'ph.d'),
(6, 'ssss', 'ir', 0, 'asdfgh', 'deplom');

-- --------------------------------------------------------

--
-- Table structure for table `metaphor`
--

CREATE TABLE `metaphor` (
  `registering_no` int(50) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `cardno` int(50) NOT NULL,
  `collage` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `deptname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `bookname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `loandate` date NOT NULL,
  `returndate` date NOT NULL,
  `signature` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `libsymbol` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `violation` int(10) NOT NULL,
  `day` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metaphor`
--

INSERT INTO `metaphor` (`registering_no`, `name`, `cardno`, `collage`, `deptname`, `bookname`, `loandate`, `returndate`, `signature`, `libsymbol`, `violation`, `day`) VALUES
(13, 'samah', 0, 'cs&it', 'it', 'صفحات من اللغة والنحو', '2024-11-01', '2024-11-07', 'sara', 'med', 1500, 1),
(18, 'fatooma', 2, 'cs&it', 'it', 'شذرات من الموروث الثقافي السوداني', '2024-11-02', '2024-11-08', 'sara', 'med', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `user` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nots` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc`
--
ALTER TABLE `acc`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `books_info`
--
ALTER TABLE `books_info`
  ADD PRIMARY KEY (`registering_no`);

--
-- Indexes for table `ddd`
--
ALTER TABLE `ddd`
  ADD PRIMARY KEY (`degree`);

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`dept_no`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `lo`
--
ALTER TABLE `lo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mem`
--
ALTER TABLE `mem`
  ADD PRIMARY KEY (`memberno`);

--
-- Indexes for table `metaphor`
--
ALTER TABLE `metaphor`
  ADD PRIMARY KEY (`registering_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc`
--
ALTER TABLE `acc`
  MODIFY `no` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `books_info`
--
ALTER TABLE `books_info`
  MODIFY `registering_no` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90270;
--
-- AUTO_INCREMENT for table `lo`
--
ALTER TABLE `lo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mem`
--
ALTER TABLE `mem`
  MODIFY `memberno` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `metaphor`
--
ALTER TABLE `metaphor`
  MODIFY `registering_no` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
