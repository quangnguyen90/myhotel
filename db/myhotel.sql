-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2015 at 08:25 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myhotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `gia_phong`
--

CREATE TABLE IF NOT EXISTS `gia_phong` (
  `loai_phong` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `don_gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gia_phong`
--

INSERT INTO `gia_phong` (`loai_phong`, `don_gia`) VALUES
('SIN', 5000),
('VIP', 9000),
('LOV', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE IF NOT EXISTS `phong` (
`so_phong` int(11) NOT NULL,
  `loai_phong` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `thue_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phong`
--

INSERT INTO `phong` (`so_phong`, `loai_phong`, `thue_id`) VALUES
(1, 'SIN', 11),
(2, 'SIN', 0),
(3, 'VIP', 0),
(4, 'VIP', 0),
(5, 'LOV', 9),
(6, 'LOV', 0);

-- --------------------------------------------------------

--
-- Table structure for table `thue_phong`
--

CREATE TABLE IF NOT EXISTS `thue_phong` (
`id` int(11) NOT NULL,
  `phong_so` int(11) NOT NULL,
  `ten_khach` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `pid` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `gioi_tinh` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_vao` date NOT NULL,
  `ngay_ra` date NOT NULL,
  `tien_coc` int(11) NOT NULL,
  `tien_phong` int(11) NOT NULL,
  `tien_mini_bar` int(11) NOT NULL,
  `tien_khac` int(11) NOT NULL,
  `ghi_chu` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `thue_phong`
--

INSERT INTO `thue_phong` (`id`, `phong_so`, `ten_khach`, `pid`, `gioi_tinh`, `ngay_vao`, `ngay_ra`, `tien_coc`, `tien_phong`, `tien_mini_bar`, `tien_khac`, `ghi_chu`) VALUES
(1, 11, 'Quang Nguyen', 'cm123456', 'a', '2015-04-15', '2015-04-30', 5000, 0, 0, 0, ''),
(2, 10, 'Phu Quang', 'cm1234567', 'a', '2015-04-15', '2015-04-30', 5000, 0, 0, 0, 'Nothing'),
(3, 9, 'Quang Phu', 'cm654321', 'a', '2015-04-15', '2015-04-30', 4000, 0, 0, 0, 'Yolo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
 ADD PRIMARY KEY (`so_phong`);

--
-- Indexes for table `thue_phong`
--
ALTER TABLE `thue_phong`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phong`
--
ALTER TABLE `phong`
MODIFY `so_phong` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `thue_phong`
--
ALTER TABLE `thue_phong`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
