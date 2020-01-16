-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2017 at 04:59 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comicallz`
--

-- --------------------------------------------------------

--
-- Table structure for table `comics`
--

CREATE TABLE `comics` (
  `comicsId` int(10) NOT NULL,
  `authorId` int(10) NOT NULL,
  `comicsName` varchar(150) NOT NULL,
  `comicsPath` varchar(150) NOT NULL,
  `comicsProPic` varchar(150) NOT NULL,
  `comicsAbout` varchar(1000) NOT NULL,
  `genres` varchar(100) NOT NULL,
  `uploadedDate` varchar(80) NOT NULL,
  `comicsCount` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comics`
--

INSERT INTO `comics` (`comicsId`, `authorId`, `comicsName`, `comicsPath`, `comicsProPic`, `comicsAbout`, `genres`, `uploadedDate`, `comicsCount`) VALUES
(1, 1, 'Oyasumi Punpun', 'Profile/Comics/Oyasumi Punpun', 'Profile/Comics/Oyasumi Punpun/Information/01.jpg', 'A beautiful story about punpun who lives a hard life because of his parents and social anxiety he posses. Somehow he watches a girl and fall in love with her. Story continues, Become a part of this story and enjoy it.', 'Romance', '2017-05-03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_Id` int(10) NOT NULL,
  `fileName` varchar(70) NOT NULL,
  `File` blob NOT NULL,
  `user_Id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(15) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `penName` varchar(50) NOT NULL,
  `Password` varchar(160) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `proPic` varchar(100) DEFAULT NULL,
  `About` varchar(250) DEFAULT NULL,
  `joinDate` varchar(50) NOT NULL,
  `memberSince` varchar(30) NOT NULL,
  `salt` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `firstName`, `lastName`, `penName`, `Password`, `Email`, `proPic`, `About`, `joinDate`, `memberSince`, `salt`) VALUES
(1, 'ComicallZ', 'Corporation', 'comicallZ', '12345678', 'comicallz@gmail.com', 'Profile/Users/1/06.jpg', 'This is Web based PlatForm for everyone to upload Comics and share it with each other', 'Wednesday 3rd of May 2017 06:00:22 PM', '2017-05-03', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`comicsId`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comics`
--
ALTER TABLE `comics`
  MODIFY `comicsId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_Id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
