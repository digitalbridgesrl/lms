-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

CREATE DATABASE IF NOT EXISTS `library`;
USE `library`;

CREATE USER IF NOT EXISTS 'librarian'@'localhost' IDENTIFIED BY '8_2374y()5h23f87h';
GRANT ALL PRIVILEGES ON library.* TO 'librarian'@'localhost';


--
-- Table structure for table `lms_admin`
--

CREATE TABLE `lms_admin` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_admin`
--

INSERT INTO `lms_admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', 'info@digitalbridge.srl', 'admin', '4cf34194f97afa90c0626574e99bfec7', '2017-07-16 18:11:42');


--
-- Table structure for table `lms_tblauthors`
--

CREATE TABLE `lms_tblauthors` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `AuthorName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


--
-- Table structure for table `lms_tblpublishers`
--

CREATE TABLE `lms_tblpublishers` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `PublisherName` varchar(150) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  UNIQUE KEY `PublisherName_UNIQUE` (`PublisherName`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


--
-- Table structure for table `lms_tblshelf`
--

CREATE TABLE `lms_tblshelf` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `ShelfName` varchar(150) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `ShelfName_UNIQUE` (`ShelfName`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


--
-- Table structure for table `lms_tblcategory`
--

CREATE TABLE `lms_tblcategory` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `CategoryName` varchar(150) NOT NULL,
  `Status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `CategoryName_UNIQUE` (`CategoryName`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


--
-- Table structure for table `lms_tblbooks`
--

CREATE TABLE `lms_tblbooks` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `BookName` varchar(255) DEFAULT NULL,
  `BookSubtitle` varchar(255) DEFAULT NULL,
  `Volume` varchar(255) DEFAULT NULL,
  `TotVolume` varchar(255) DEFAULT NULL,
  `ShelfId` int(11) DEFAULT NULL,
  `CatId` int(11) DEFAULT NULL,
  `AuthorId` int(11) DEFAULT NULL,
  `PublisherId` int(11) DEFAULT NULL,
  `ISBNNumber` int(11) DEFAULT NULL,
  `InventoryNumber` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `ISBNNumber_UNIQUE` (`ISBNNumber`),
  UNIQUE KEY `InventoryNumber_UNIQUE` (`InventoryNumber`),
  KEY `fk_lms_tblbooks_shelf_id_idx` (`ShelfId`),
  KEY `fk_lms_tblbooks_category_id_idx` (`CatId`),
  KEY `fk_lms_tblbooks_author_id_idx` (`AuthorId`),
  KEY `fk_lms_tblbooks_publisher_id_idx` (`PublisherId`),
  CONSTRAINT `fk_lms_tblbooks_shelf_id` FOREIGN KEY (`ShelfId`) REFERENCES `lms_tblshelf` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lms_tblbooks_category_id` FOREIGN KEY (`CatId`) REFERENCES `lms_tblcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lms_tblbooks_author_id` FOREIGN KEY (`AuthorId`) REFERENCES `lms_tblauthors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lms_tblbooks_publisher_id` FOREIGN KEY (`PublisherId`) REFERENCES `lms_tblpublishers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


--
-- Table structure for table `lms_tblissuedbookdetails`
--

CREATE TABLE `lms_tblissuedbookdetails` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `BookId` int(11) DEFAULT NULL,
  `StudentID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ReturnDate` timestamp NULL DEFAULT NULL,
  `ReturnStatus` int(1) DEFAULT 0
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


--
-- Table structure for table `lms_tblstudents`
--

CREATE TABLE `lms_tblstudents` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `StudentId` varchar(100) DEFAULT NULL UNIQUE,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;



COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
