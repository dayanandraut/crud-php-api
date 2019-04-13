-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2019 at 08:12 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tutorials`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `header` varchar(200) NOT NULL,
  `url` varchar(300) NOT NULL,
  `story` blob NOT NULL,
  `author` varchar(100) NOT NULL,
  `thumbnail_image_url` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `date`, `header`, `url`, `story`, `author`, `thumbnail_image_url`) VALUES
(1, 'Creating api', '2019-04-08', 'Testing', 'www.daya.com', 0x6372656174696e672061706920697320656173792e206c65747320646f206974, 'daya', ''),
(2, 'Game of thrones', '2019-04-09', 'Got', 'www.got.in', 0x676f6e6e612072656c61657365206f6e203134746820617072696c2e206920616d206578696369746564, 'suman', ''),
(3, 'Silicon Valley', '2019-04-10', 'SCV', 'www.silica.in', 0x49206c6f76652073696c69636f6e2076616c6c6579, 'I love silicon valley', ''),
(5, 'Madhesh Crisis', '2019-04-11', 'MDS', 'www.basiyabhat.in', 0x4c6966652069732062656175746966756c, 'kumaraguru', ''),
(9, 'Kathmandu', '2019-04-11', 'katm', 'tmk.com', 0x266c743b702667743b7965732069206d2068657265266c743b2f702667743b266c743b702667743b646f696e67207468697320266c743b622667743b736372697074696e67266c743b2f622667743b266c743b2f702667743b, 'Dayanand', '/assets/img/ktm.jpeg'),
(10, 'Lyf', '2019-04-14', 'Life is ok', 'www.cam12.com', 0x6d7973746f72793132, 'Dayanand', '/asset/pic.jpg'),
(11, 'Life1', '2019-04-15', 'Why So Difficult', 'www.lifeLine.com', 0x6d7973746f72792069732076657279207765697264, 'Daya', 'asset/pic/1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
