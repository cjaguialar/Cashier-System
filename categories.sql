-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2025 at 08:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cashier_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(30000, 'Alcoholic Beverages'),
(18000, 'Baby Products'),
(11000, 'Bakery'),
(15000, 'Baking Supplies'),
(16000, 'Beverage Enhancers'),
(24000, 'Beverages'),
(25000, 'Biscuits and Wafers'),
(26000, 'Canned Goods'),
(31000, 'Coffee & Tea'),
(27000, 'Condiments & Sauces'),
(10000, 'Dairy'),
(12000, 'Dairy Alternatives'),
(37000, 'Dairy-Free Products'),
(32000, 'Energy & Sports Drinks'),
(19000, 'Frozen Foods'),
(34000, 'Fruits'),
(38000, 'Gluten-Free Items'),
(14000, 'Grains & Rice'),
(17000, 'Household Essentials'),
(29000, 'Juices'),
(20000, 'Meat'),
(36000, 'Organic Products'),
(21000, 'Personal Care'),
(39000, 'Pet Food'),
(22000, 'Sanitary'),
(35000, 'Seafood'),
(13000, 'Snacks'),
(28000, 'Soft Drinks'),
(33000, 'Vegetables');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39001;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
