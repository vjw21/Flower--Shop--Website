-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2025 at 04:02 PM
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
-- Database: `flower_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(113, 2, 26, 'Lily Flower Boquet', '70', '3', '3.jpeg'),
(117, 0, 24, 'Red Rose Flower  Boquet', '300', '3', '1.jpeg'),
(118, 14, 25, 'Sun Flower Boquet', '90', '2', '2.jpg'),
(119, 14, 92, 'Red Rose Flower  Boquet', '300', '1', '1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` int(30) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(8, 11, 'kamal', 'kamal12@gmail.com', 2637383, 'efw'),
(9, 11, 'k', 'kw2344', 352222222, 'edb'),
(10, 11, 'r', '34', 5677, '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `placed_on` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(23, 2, 'kenu', '07893744657', 'kenu1@gmail.com', 'Cash on delivery', 'flat no. 45, kandy road, kandy, kandy, Sri Lanka, 4567', 'Pansy Flower Boquet (2)', '160', '02-09-24', ''),
(24, 2, 'henry', '0784356353', 'henry@gmail.com', 'Paypal', 'flat no. 47, colombo road, malabe, malabe, Sri Lanka, 4567', 'Tulip Flower Boquet (4)', '320', '02-09-24', 'pending'),
(25, 2, 'kenu', '07893744657', 'kenu1@gmail.com', 'Paypal', 'flat no. 45, kandy road, kandy, kandy, Sri Lanka, 4567', 'Poppy Flower Boquet (1)', '120', '02-09-24', 'completed'),
(26, 10, 'anne', '0789463747', 'anne@gmail.com', '', 'flat no. 56, main street, colombo, colombo, sri lanka, 1122', 'Sun Flower Boquet (2),Red Rose Flower  Boquet (1)', '480', '03-09-24', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `product_detail` varchar(255) NOT NULL,
  `image` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `product_detail`, `image`) VALUES
(24, 'Red Rose Flower  Boquet', '300', 'A red rose is the symbol of eternal love and passion. The meaning of red roses can stand for true love, courage, respect.', '1.jpeg'),
(25, 'Sun Flower Boquet', '90', 'Sunflowers symbolize longevity, faith, adoration, loyalty, delight, and happiness.', '2.jpg'),
(26, 'Lily Flower Boquet', '70', 'At the top, they divide into three to seven stems, each with a single bud. Open flowers are six-pointed, white and trumpet-shaped. ', '3.jpeg'),
(27, 'Daisy Flower Boquet', '85', 'Due to their bright and cheerful nature, daisies are most often used to symbolize purity and innocence. ', '4.jpg'),
(28, 'Orchid Flower Boquet', '75', 'Orchid symbolizes love, respect, dignity & admiration. ', '5.jpg'),
(29, 'Aster Flower Boquet', '60', 'This plant blooms in a pretty shade of purple, with a fan of petals around a bold yellow centre.', '6.jpg'),
(30, 'Bluebell Flower Boquet', '40', 'Enchanting and iconic, bluebells are a favourite with the fairies and a sure sign spring is in full swing. ', '7.jpg'),
(31, 'Poppy Flower Boquet', '120', 'Poppies are amazing flowers - all that papery, pettily, ruffly exuberance crammed tightly into the bud casing - unfurling, unfolding as the days go on. ', '8.jpg'),
(32, 'Pansy Flower Boquet', '80', 'Heart-shaped or rounded leaves sprout from the base, and oblong or oval leaves grow from the stems. ', '9.jpg'),
(33, 'Hibiscus Flower Boquet', '55', 'The Hibiscus flowers are showy and conspicuous. It is usually borne singly but sometimes can be seen in clusters. ', '10.jpg'),
(36, 'Jasmine Flower Bouquet', '130', 'The bouquet often has clusters of small, star-shaped flowers paired with lush green foliage to accentuate the purity and elegance of the blooms.', '11.jpeg'),
(37, 'Tulip Flower Boquet', '80', 'The bouquet exudes simplicity and sophistication, often symbolizing perfect love and fresh beginnings.', '12.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(2, 'kenu', 'kenu1@gmail.com', '$2y$10$LPjKMQB0V.AzOive8mxvFOxjthho1wpdU//kZfzbbVAnVj6f6QDbu', 'user'),
(3, 'maria', 'maria@gmail.com', '$2y$10$yblS3k5mlYIfH8wgwNq5w.rChBjkfN54jnv6YtwHMPltAukhohj4q', 'user'),
(5, 'henuka', 'henuka@gmail.com', '$2y$10$MzUperuqRq7J/Tb1/i78ZuJqoF6kE99HIW52jk099EVMOAymd5uRO', 'admin'),
(7, 'Jack', 'jack@gmail.com', '$2y$10$4b7oBJhN8jYMWNRs8IiUeuZlKmSqDLzMEH8GXB7gY6NKdpPRNZjL.', 'user'),
(8, 'sithuli', 'sithuli1@gmail.com', '$2y$10$5pJeqzVh/k6aIGiBTq4W/.NUGljBNb4Ut1B/VoHxJxDOOjpVbbdCS', 'user'),
(9, 'Henry', 'henry@gmail.com', '$2y$10$0KjP4PHyZo9Ii8lZBMkvvOIQXf/bjQ/nB/YDIERqYKgU6Rg6VQF9.', 'user'),
(10, 'anne', 'anne@gmail.com', '$2y$10$amuO2/yafPO.8ksT1ToTvOh2znRnvUgen/Ii.IS1CCVupJW95gOhS', 'user'),
(11, 'marry', 'marry@gmail.com', '$2y$10$VTf0oOGz/g0b1CLKCSvwHemmrMcd2pkkqJ2iw98QuNul24JIadvy6', 'user'),
(12, 'jennie', 'jennie1@gmail.com', '$2y$10$dmEPJeRwVpJN7iNwIRoqM.q66uft7CJ8l2EIwj9bagZX3g0wyKB0m', 'user'),
(13, 'wick', 'wick1@gmail.com', '$2y$10$6JZrGx4T/UY1..cE7RDvCOa.RFjxVmVuWX6ZleeWDsnF9aB1Pj7re', 'admin'),
(14, 'anju', 'anju1@gmail.com', '$2y$10$VIenUDhIo5eKAT4e3vWRT.Wr2q1gwt39UwSr/XCGeAsEDjbi2e5Ca', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(80, 2, 24, 'Red Rose Flower  Boquet', '200', '1.jpeg'),
(81, 2, 32, 'Pansy Flower Boquet', '80', '9.jpg'),
(82, 2, 33, 'Hibiscus Flower Boquet', '55', '10.jpg'),
(85, 0, 27, 'Daisy Flower Boquet', '85', '4.jpg'),
(87, 0, 24, 'Red Rose Flower  Boquet', '200', '1.jpeg'),
(90, 2, 37, 'Tulip Flower Boquet', '80', '12.jpeg'),
(91, 10, 24, 'Red Rose Flower  Boquet', '300', '1.jpeg'),
(92, 14, 24, 'Red Rose Flower  Boquet', '300', '1.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
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
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
