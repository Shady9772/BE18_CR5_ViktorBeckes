-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2023 at 05:23 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be18_cr5_animal_adoption_viktorbeckes`
--
CREATE DATABASE IF NOT EXISTS `be18_cr5_animal_adoption_viktorbeckes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be18_cr5_animal_adoption_viktorbeckes`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(300) NOT NULL,
  `age` varchar(3) NOT NULL,
  `size` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `vaccinated` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `name`, `description`, `age`, `size`, `picture`, `vaccinated`, `location`, `status`) VALUES
(46, 'Mr. Fluffy Pants', 'really small and really cute, alsi pretty fluffy', '3', 'small', '642839d62988d.jpg', 'no', 'Buchengasse 44', 'adop'),
(47, 'Mrs. Scary Marry', 'she really afraid of humans, you need to be gentle with her.', '1', 'small', '6428418023a97.jpg', 'no', 'Somegasse 5', 'user'),
(48, 'Shady', 'he si really hgue and really lazy, maybe a diet needed.', '10', 'big', '6428471a3172a.jpg', 'yes', 'Lazystrasse 8', 'user'),
(50, 'bubbles', 'he hate everyone so good luck', '9', 'small', '642849a6c47b9.jpg', 'yes', 'FunnyStreet 55', 'user'),
(51, 'Katie Purry', 'hes a little slow but veryy cutee', '11', 'small', '64284a029327e.jpeg', 'no', 'CrazyStrasse 66', 'user'),
(52, 'Snoop Dog', 'likes to walk a lot.', '11', 'huge', '64284a83e02c0.jpg', 'yes', 'LuckyStreet 33', 'user'),
(53, 'Dogzilla', 'too big to keep in an apartment.', '10', 'huge', '64284af54a363.jpg', 'no', 'ScaryStrasse 178', 'user'),
(54, 'Sally O’Malley', 'really small girl, lots of energy.', '9', 'small', '64284b5d3e5fc.jpg', 'yes', 'SomeStreet 123', 'user'),
(55, 'Chew-barka', 'small boy, bites a lot!!!!', '2', 'small', '64284baa24c1e.jpg', 'no', 'StarStreet 58', 'user'),
(56, 'Spitz', 'hes goofy as he can be, funny little bugger!', '5', 'small', '64284c2cf11ee.jpg', 'yes', 'NoMandsStreet 88', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone_number`, `address`, `password`, `date_of_birth`, `email`, `picture`, `status`) VALUES
(1, 'test', 'test', '', '', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1111-11-11', 'viktorb9772@gmail.com', 'something.jpg', 'user'),
(3, 'viktor', 'beckes', '06606684758', 'Buchengasse 1', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '9999-11-11', 'l@l.com', '64275f749c9f9.jpg', 'adm'),
(5, 'Viktor', 'Beckes', '06606684758', 'Buchengasse 101', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1997-06-17', 'viktorbeckes@gmail.com', 'something.jpg', 'user'),
(6, 'victor', 'Beckes', '06606684758', 'Buchengasse 101', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1111-11-11', 'viktorbeckes1@gmail.com', '642837c4db847.jpg', 'user'),
(7, 'danny', 'sammy', '06606684758', 'Buchengasse 1', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1111-11-11', 'sam@g.com', '642838a11a021.jpg', 'adm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
