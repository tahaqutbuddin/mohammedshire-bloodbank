-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2023 at 07:40 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `fullname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `is_active` int(11) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `inserted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `fullname`, `email`, `password`, `is_active`, `last_login`, `inserted_at`) VALUES
(1, 'admin', 'Taha Admin', 'admin@gmail.com', 'dc58d7ea8da4fda292b8396bc346f11cc4f2b2bf7c520437e864e01bf7ad1cdbbb4ba7a1bf1b1e3102aa1d06dcb8f48f9b737b288efc2355874fe84a4ecebacc', 1, '2023-01-08 22:27:01', '2023-01-07 15:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`) VALUES
(1, 'hawl wadaag'),
(2, 'hodon'),
(3, 'wardhiigley'),
(4, 'madiino'),
(5, 'waabari'),
(6, 'xamar jajab'),
(7, 'xamar weyne'),
(8, 'shangaani'),
(9, 'cabdi caziiz'),
(10, 'kaaraan'),
(11, 'hiliwaa'),
(12, 'boondheere'),
(13, 'yaaqshiid'),
(14, 'dayniile'),
(15, 'kaxda'),
(16, 'shibis'),
(17, 'warta nabada');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `user_id` int(11) NOT NULL,
  `firstName` varchar(256) NOT NULL,
  `lastName` varchar(256) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(256) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `picture` varchar(1000) NOT NULL,
  `bloodtype` varchar(10) NOT NULL,
  `district` int(11) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`user_id`, `firstName`, `lastName`, `email`, `phone`, `password`, `gender`, `picture`, `bloodtype`, `district`, `role`, `is_active`, `created_at`, `last_login`) VALUES
(9, 'Mohammed', 'shire', 'mohammedshire20@gmail.com', '+92330000990', '08de05d5eeee2504c57a1f6b88f0f074f8450d230cce46e4178ef690b275984164abd53eff6e5042f3605965e40abc428560355f1cc764bb6f2667a580a66f7f', 'male', './assets/img/profilePictures/8a5dccb84b265f00f50b4c35cff11fd9.JPG', 'AB+', 7, 'user', 1, '2022-12-05 10:37:00', '2022-12-05 10:43:12'),
(11, 'Saleem', 'Shakir', 'saleem@gmail.com', '+923348025252', 'b48c648a03fb45c36d1861af70b8e9175cd0863cfae71d3dc8bc5d33f2cbc4619cd0ff854bbcab28bee4a58dbab6358559a1101e9410f2220de143492034fdd9', 'female', '../assets/img/profilePictures/3762002b379bf3db93612c33a47cfec9.jpg', 'B+', 16, 'user', 1, '2023-01-09 07:11:31', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
