-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2017 at 06:23 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `herodating`
--

-- --------------------------------------------------------

--
-- Table structure for table `gift`
--

CREATE TABLE `gift` (
  `title` varchar(50) COLLATE utf8_danish_ci NOT NULL,
  `image` varchar(50) COLLATE utf8_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Dumping data for table `gift`
--

INSERT INTO `gift` (`title`, `image`) VALUES
('Bat and baseball', 'bat.jpg'),
('Bike', 'bike.jpg'),
('Cake', 'cake.png'),
('Diamond', 'diamond.png'),
('Rose', 'rose.png'),
('Umbrella', 'umbrella.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `liketable`
--

CREATE TABLE `liketable` (
  `id` int(11) NOT NULL,
  `likeSender` varchar(100) COLLATE utf8_danish_ci NOT NULL,
  `likeReceiver` varchar(100) COLLATE utf8_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Dumping data for table `liketable`
--

INSERT INTO `liketable` (`id`, `likeSender`, `likeReceiver`) VALUES
(1, 'Superman', 'Batman'),
(2, 'Batman', 'Supergirl'),
(3, 'Batman', 'Supergirl'),
(4, 'Batman', 'Supergirl'),
(5, 'Batman', 'Supergirl'),
(8, 'Batman', 'Supergirl'),
(9, 'Batman', 'Supergirl'),
(10, 'Batman', 'Supergirl'),
(11, 'Batman', 'Supergirl'),
(12, 'Batman', 'Superman'),
(13, 'Batman', 'The Flash'),
(14, 'Supergirl', 'Wonder woman'),
(15, 'Wonder woman', 'Supergirl'),
(16, 'Supergirl', 'Batman'),
(17, 'Supergirl', 'Batman'),
(18, 'Supergirl', 'Batman'),
(19, 'Batman', 'The Flash'),
(20, 'Batman', 'The Flash'),
(21, 'Batman', 'Supergirl'),
(22, 'Batman', 'Supergirl'),
(23, 'The Flash', 'Batman');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `messageReceiver` varchar(100) COLLATE utf8_danish_ci NOT NULL,
  `messageSender` varchar(100) COLLATE utf8_danish_ci NOT NULL,
  `private` tinyint(1) NOT NULL,
  `messageText` varchar(255) COLLATE utf8_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `messageReceiver`, `messageSender`, `private`, `messageText`) VALUES
(11, 'Batman', 'Supergirl', 1, 'Private message'),
(15, 'Supergirl', 'Batman', 0, 'I am Batman'),
(16, 'Superman', 'Batman', 0, 'I am Batman'),
(17, 'The Flash', 'Batman', 0, 'I am Batman'),
(19, 'Batman', 'Supergirl', 0, 'this is a testmessage from ui'),
(21, 'Supergirl', 'Batman', 0, 'Hello supergirl. also this is a test from ui'),
(22, 'Supergirl', 'Batman', 1, 'Hello Supergirl. This is a private message test from ui'),
(23, 'Supergirl', 'Batman', 0, 'Hi Supergirl what are you doing today? Also important: I am Batman'),
(24, 'The Flash', 'Superman', 0, 'Hey flash');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `superheroName` varchar(100) COLLATE utf8_danish_ci NOT NULL,
  `age` int(11) NOT NULL,
  `superpower` varchar(100) COLLATE utf8_danish_ci NOT NULL,
  `interest` varchar(100) COLLATE utf8_danish_ci NOT NULL,
  `favoritDatingSpot` varchar(50) COLLATE utf8_danish_ci NOT NULL,
  `profilePicture` varchar(50) COLLATE utf8_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`superheroName`, `age`, `superpower`, `interest`, `favoritDatingSpot`, `profilePicture`) VALUES
('Batman', 34, 'I am the Batman                                                                                    ', 'Saving gotham                                                                                    ', 'Dinner in the caves near Gotham city              ', 'batman.jpg'),
('Supergirl', 24, 'Super strength and speed. Flight', 'Saving the world', 'Secret', 'supergirl.jpg'),
('Superman', 34, 'Superhuman strength and speed. Flight. Heat vision. Freezing breath. X-ray vision', 'Saving the world', 'Metropolis center park', 'superman.png'),
('The Flash', 27, 'Super speed            ', 'Saving the world. Traveling in time and dimentions            ', 'CC Jiters            ', 'flash.jpg'),
('Wonder woman', 30, 'Super strenght and speed. Flight', 'Saving the world', 'Amezonia', 'wonderWoman.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_can_send_gift`
--

CREATE TABLE `user_can_send_gift` (
  `giftSender` varchar(100) COLLATE utf8_danish_ci NOT NULL,
  `giftReceiver` varchar(100) COLLATE utf8_danish_ci NOT NULL,
  `giftTitle` varchar(50) COLLATE utf8_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Dumping data for table `user_can_send_gift`
--

INSERT INTO `user_can_send_gift` (`giftSender`, `giftReceiver`, `giftTitle`) VALUES
('Batman', 'Supergirl', 'Cake'),
('Supergirl', 'Wonder woman', 'Rose'),
('Wonder woman', 'Supergirl', 'Rose'),
('Supergirl', 'Batman', 'Cake'),
('Supergirl', 'Batman', 'Rose'),
('Batman', 'Supergirl', 'Bat and baseball'),
('Batman', 'Supergirl', 'Diamond'),
('Batman', 'Superman', 'Bike'),
('Batman', 'The Flash', 'Bike'),
('Batman', 'The Flash', 'Diamond'),
('The Flash', 'Batman', 'Bat and baseball');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gift`
--
ALTER TABLE `gift`
  ADD PRIMARY KEY (`title`);

--
-- Indexes for table `liketable`
--
ALTER TABLE `liketable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likeSender` (`likeSender`),
  ADD KEY `likeReceiver` (`likeReceiver`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messageSender` (`messageSender`),
  ADD KEY `messageReceiver` (`messageReceiver`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`superheroName`);

--
-- Indexes for table `user_can_send_gift`
--
ALTER TABLE `user_can_send_gift`
  ADD KEY `giftSender` (`giftSender`),
  ADD KEY `giftReceiver` (`giftReceiver`),
  ADD KEY `giftTitle` (`giftTitle`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `liketable`
--
ALTER TABLE `liketable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `liketable`
--
ALTER TABLE `liketable`
  ADD CONSTRAINT `liketable_ibfk_1` FOREIGN KEY (`likeSender`) REFERENCES `user` (`superheroName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `liketable_ibfk_2` FOREIGN KEY (`likeReceiver`) REFERENCES `user` (`superheroName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`messageReceiver`) REFERENCES `user` (`superheroName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`messageSender`) REFERENCES `user` (`superheroName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_can_send_gift`
--
ALTER TABLE `user_can_send_gift`
  ADD CONSTRAINT `user_can_send_gift_ibfk_1` FOREIGN KEY (`giftSender`) REFERENCES `user` (`superheroName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_can_send_gift_ibfk_2` FOREIGN KEY (`giftReceiver`) REFERENCES `user` (`superheroName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_can_send_gift_ibfk_3` FOREIGN KEY (`giftTitle`) REFERENCES `gift` (`title`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
