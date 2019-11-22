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

-- --------------------------------------------------------

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

-- --------------------------------------------------------

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
-- Dumping data for table `lms_tblauthors`
--

INSERT INTO `lms_tblauthors` (`id`, `AuthorName`, `creationDate`, `UpdationDate`) VALUES
(1, 'Anuj kumar', '2017-07-08 12:49:09', '2017-07-08 15:16:59'),
(2, 'Chetan Bhagatt', '2017-07-08 14:30:23', '2017-07-08 15:15:09'),
(3, 'Anita Desai', '2017-07-08 14:35:08', NULL),
(4, 'HC Verma', '2017-07-08 14:35:21', NULL),
(5, 'R.D. Sharma ', '2017-07-08 14:35:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lms_tblpublishers`
--

CREATE TABLE `lms_tblpublishers` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `PublisherName` varchar(150) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
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
-- Dumping data for table `lms_tblcategory`
--

INSERT INTO `lms_tblcategory` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(4, 'Romantic', 1, '2017-07-04 18:35:25', '2017-07-06 16:00:42'),
(5, 'Technology', 1, '2017-07-04 18:35:39', '2017-07-08 17:13:03'),
(6, 'Science', 1, '2017-07-04 18:35:55', '0000-00-00 00:00:00'),
(7, 'Management', 0, '2017-07-04 18:36:16', '0000-00-00 00:00:00');


-- --------------------------------------------------------

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
-- Dumping data for table `lms_tblbooks`
--

INSERT INTO `lms_tblbooks` (`id`, `BookName`, `CatId`, `AuthorId`, `ISBNNumber`, `RegDate`, `UpdationDate`) VALUES
(1, 'PHP And MySql programming', 5, 1, 222333, '2017-07-08 20:04:55', '2017-07-15 05:54:41'),
(3, 'physics', 6, 4, 1111, '2017-07-08 20:17:31', '2017-07-15 06:13:17');


-- --------------------------------------------------------

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
-- Dumping data for table `lms_tblissuedbookdetails`
--

INSERT INTO `lms_tblissuedbookdetails` (`id`, `BookId`, `StudentID`, `IssuesDate`, `ReturnDate`, `ReturnStatus`) VALUES
(1, 1, 'SID002', '2017-07-15 06:09:47', '2017-07-15 11:15:20', 1),
(2, 1, 'SID002', '2017-07-15 06:12:27', '2017-07-15 11:15:23', 1),
(3, 3, 'SID002', '2017-07-15 06:13:40', NULL, 0),
(4, 3, 'SID002', '2017-07-15 06:23:23', '2017-07-15 11:22:29', 1),
(5, 1, 'SID009', '2017-07-15 10:59:26', NULL, 0),
(6, 3, 'SID011', '2017-07-15 18:02:55', NULL, 0);

-- --------------------------------------------------------

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
