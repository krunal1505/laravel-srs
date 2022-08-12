-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2022 at 09:18 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srs`
--

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `name`) VALUES
(1, 1, 'Alberta'),
(2, 1, 'British Columbia'),
(3, 1, 'Manitoba'),
(4, 1, 'New Brunswick'),
(5, 1, 'Newfoundland and Labrador'),
(6, 1, 'Northwest Territories'),
(7, 1, 'Nova Scotia'),
(8, 1, 'Nunavut'),
(9, 1, 'Ontario'),
(10, 1, 'Prince Edward Island'),
(11, 1, 'Quebec'),
(12, 1, 'Saskatchewan'),
(13, 1, 'Yukon Territory'),
(14, 2, 'Andhra Pradesh'),
(15, 2, 'Arunachal Pradesh'),
(16, 2, 'Assam'),
(17, 2, 'Bihar'),
(18, 2, 'Chandigarh'),
(19, 2, 'Chhattisgarh'),
(20, 2, 'Dadra and Nagar Haveli'),
(21, 2, 'Daman and Diu'),
(22, 2, 'Delhi'),
(23, 2, 'Goa'),
(24, 2, 'Gujarat'),
(25, 2, 'Haryana'),
(26, 2, 'Himachal Pradesh'),
(27, 2, 'Jammu and Kashmir'),
(28, 2, 'Jharkhand'),
(29, 2, 'Karnataka'),
(30, 2, 'Kenmore'),
(31, 2, 'Kerala'),
(32, 2, 'Madhya Pradesh'),
(33, 2, 'Maharashtra'),
(34, 2, 'Manipur'),
(35, 2, 'Meghalaya'),
(36, 2, 'Mizoram'),
(37, 2, 'Nagaland'),
(38, 2, 'Narora'),
(39, 2, 'Natwar'),
(40, 2, 'Odisha'),
(41, 2, 'Paschim Medinipur'),
(42, 2, 'Pondicherry'),
(43, 2, 'Punjab'),
(44, 2, 'Rajasthan'),
(45, 2, 'Sikkim'),
(46, 2, 'Tamil Nadu'),
(47, 2, 'Telangana'),
(48, 2, 'Tripura'),
(49, 2, 'UP'),
(50, 2, 'West Bengal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
