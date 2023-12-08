-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2023 at 04:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `create_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentID` bigint(11) NOT NULL,
  `blogID` bigint(20) NOT NULL,
  `UserNAME` varchar(255) NOT NULL,
  `Comment` text NOT NULL,
  `DateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `blogID`, `UserNAME`, `Comment`, `DateTime`) VALUES
(1, 2, 'john', 'better be ready👍', '2023-11-13 16:22:51'),
(2, 5, 'john', 'got to be fitttt👍👍👍', '2023-11-13 16:23:18'),
(3, 7, 'john', '👍👍👍👍👍👍👍', '2023-11-13 16:23:32'),
(4, 2, 'Annie', 'scary indeed. will robots replace humanity soon?', '2023-11-13 16:24:50'),
(5, 3, 'Annie', 'LOVE IT!!❤️❤️❤️❤️❤️❤️❤️❤️', '2023-11-13 16:25:30'),
(7, 4, 'Annie', '❤️❤️❤️❤️', '2023-11-13 16:26:37'),
(8, 7, 'Annie', 'This is helpful!❤️', '2023-11-13 16:27:48'),
(10, 6, 'Annie', '❤️❤️❤️❤️❤️❤️', '2023-11-13 16:28:58'),
(11, 2, 'Jane', 'can\'t wait for another season of replacement of humanity🙄🙄', '2023-11-13 16:31:14'),
(12, 3, 'Jane', 'I need my pahinga hayssss..', '2023-11-13 16:31:44'),
(13, 6, 'Jane', 'Food is life❤️', '2023-11-13 16:32:03'),
(14, 7, 'Jane', 'very helpful indeed😊❤️', '2023-11-13 16:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `blogID` bigint(20) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_content` varchar(255) NOT NULL,
  `dateTime_created` datetime NOT NULL,
  `blog_cat` varchar(255) NOT NULL,
  `blog_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`blogID`, `blog_title`, `blog_content`, `dateTime_created`, `blog_cat`, `blog_pic`) VALUES
(2, 'Revolutionizing the Future: The Latest Breakthroughs in Artificial Intelligence', 'Explore the cutting-edge advancements in artificial intelligence that are reshaping industries and paving the way for a new era of innovation.', '2023-11-13 23:09:06', 'technology', 'uploads/artificial-intelligence-robot.jpeg'),
(3, 'Wanderlust Chronicles: Unveiling Hidden Gems in Southeast Asia', 'Embark on a virtual journey through the enchanting landscapes and cultural treasures of Southeast Asia, discovering lesser-known destinations that will ignite your wanderlust.', '2023-11-13 23:11:03', 'travel', 'uploads/BC891A02-0456-49B9-AD65-01FAB3D9D518.jpeg'),
(4, 'Elegance Redefined: Unveiling the Latest Fashion Trends for the Season', 'Dive into the world of fashion as we unveil the hottest trends, styling tips, and must-have wardrobe essentials that will redefine your sense of elegance and style.', '2023-11-13 23:14:01', 'fashion', 'uploads/depositphotos_206432966-stock-photo-attractive-fashionable-woman-posing-white.jpg'),
(5, 'Fit and Fab: A Comprehensive Guide to Achieving Your Fitness Goals', 'Empower yourself with expert tips, workout routines, and nutrition advice in this comprehensive guide to help you embark on a fitness journey that leads to a healthier, more vibrant you.', '2023-11-13 23:15:27', 'fitness', 'uploads/360_F_174212531_cerVf4uP6vinBWieBB46p2P5xVhnsNSK.jpg'),
(6, 'Culinary Adventures: Exploring Global Flavors in Your Kitchen', 'Embark on a gastronomic journey as we explore diverse and delectable recipes from around the world, bringing the flavors of different cultures to your kitchen.', '2023-11-13 23:19:00', 'food', 'uploads/lily-banse--YHSwy6uqvk-unsplash.jpg'),
(7, 'Balancing Act: Navigating the Demands of Career and Personal Life', 'Discover practical strategies and insightful advice for achieving a harmonious balance between your professional and personal life, enhancing your overall well-being.', '2023-11-13 23:20:45', 'lifestyle', 'uploads/start-healthy-lifestyle.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `passwords` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `passwords`) VALUES
('admin', '$2y$10$JUbZZoevGN2mbOPcm2OxquDMFdcu1U5lYIK1.VKTdFoKb1gYlrX.O'),
('Annie', '$2y$10$YLBZW/auA3Phin4AzBAoPuq7a8JPNbl27FRDJi/dYHU7Z8wpPpD4S'),
('Jane', '$2y$10$XDLA5uTwurgXpt5OFd7mfutB7XGvIQxZRtATiot5yy0bufkKWMT9y'),
('john', '$2y$10$b56t9UrdFwyrPubhswmdwe1wxpCwRPIftsyiERjaPAjoByoTIQ382');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `FK_blog` (`blogID`),
  ADD KEY `FK_Username` (`UserNAME`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`blogID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`,`passwords`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `blogID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_Username` FOREIGN KEY (`UserNAME`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `FK_blog` FOREIGN KEY (`blogID`) REFERENCES `post` (`blogID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
