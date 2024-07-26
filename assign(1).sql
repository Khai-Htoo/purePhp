-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 25, 2024 at 05:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assign`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `message`, `title`) VALUES
(1, 'Alana Cole', 'Corrupti in ab exer', 'Molestiae culpa dolo'),
(2, 'Abra Daniel', 'Duis recusandae Con', 'Aut rerum et reprehe'),
(3, 'Drew Patterson', 'Necessitatibus non d', 'Et dolore vero atque'),
(4, 'Drew Patterson', 'Necessitatibus non d', 'Et dolore vero atque'),
(5, 'Geoffrey Mccoy test', 'Ullam vel tempor rer', 'Repellendus Et id ');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `stautus` enum('pending','accept','reject') NOT NULL DEFAULT 'pending',
  `product_name` varchar(2000) NOT NULL,
  `price` int(200) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `qty`, `total`, `address`, `stautus`, `product_name`, `price`, `image`) VALUES
(20, 1, 24, 11136, 'Rerum amet saepe el', 'accept', 'Diana Cooke', 464, 'shirt1.jpg'),
(21, 1, 678, 402732, 'Et odit aliquip magn', 'accept', 'Alexis Conner', 594, 'toy1.jpg'),
(22, 1, 224, 224000, 'Proident labore vol', 'accept', 'Chastity Martin ', 1000, 'shoe4.jpg'),
(23, 1, 930, 930000, 'Minus itaque aliquam', 'accept', 'Chastity Martin ', 1000, 'shoe4.jpg'),
(24, 1, 712, 447848, 'Totam vel id quia vo', 'accept', 'Ursula Winters', 629, 'macbookairm1.jpeg'),
(25, 1, 602, 140868, 'Voluptas id Nam et ', 'reject', 'Fulton Ray', 234, 'toy3.jpg'),
(26, 1, 132, 83028, 'Nemo dolore cupidita', 'accept', 'Ursula Winters', 629, 'macbookairm1.jpeg'),
(27, 1, 249, 147906, 'Inventore iusto quia', 'accept', 'Alexis Conner', 594, 'toy1.jpg'),
(28, 1, 142, 130214, 'Culpa quam pariatur', 'reject', 'Kim Ewing', 917, 'toy3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `medicine_name` varchar(150) NOT NULL,
  `medicine_description` text NOT NULL,
  `image` text NOT NULL,
  `price` int(100) NOT NULL,
  `adult` tinyint(1) NOT NULL DEFAULT 0,
  `kid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `medicine_name`, `medicine_description`, `image`, `price`, `adult`, `kid`) VALUES
(1, 'Hilda Jensen', 'Ut voluptas accusant', 'shirt4.jpg', 105, 1, 1),
(2, 'Kim Ewing', 'Aliquip officia in d', 'toy3.jpg', 917, 1, 0),
(3, 'Nissim Dickerson', 'Ex saepe sed sit ull', 'shoe3.jpg', 402, 1, 0),
(4, 'Benjamin Gill', 'Consequatur Amet n', 'toy3.jpg', 388, 1, 0),
(5, 'Stephen Price', 'Et harum et eum adip', 'mokey.png', 516, 1, 1),
(6, 'Blossom Cole', 'Illo quia in culpa n', 'loading.gif', 31, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `isAdmin`) VALUES
(1, 'user', 'user@gmail.com', '$2y$10$TWcx/aOMhiVsgsQD1ilm..gOtLtelXOTS.8llKXPQpiPwfMdNelfi', 0),
(2, 'admin', 'admin@gmail.com', '$2y$10$ks1RCq73GDl6d/UhzZMw..t2/tsBadkL84QEQxmhTawmEP8g4Vf0a', 1),
(3, 'Catherine Deleon', 'test@gmail.com', '$2y$10$iZwvVxIXeklkN/Qw/H2Mv.dkgCMLgG1mRg3ItJlH304dIxaBs3Wj.', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
