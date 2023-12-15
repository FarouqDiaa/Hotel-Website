-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 11:33 PM
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
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(100) NOT NULL,
  `password` int(100) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `Booking_ID` int(20) NOT NULL,
  `payment` int(20) NOT NULL,
  `meal_type` varchar(20) DEFAULT NULL,
  `checkin_date` date DEFAULT NULL,
  `checkout_date` date DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `staff_ID` int(20) DEFAULT NULL,
  `guest_ID` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_room`
--

CREATE TABLE `book_room` (
  `Room_ID` int(20) NOT NULL,
  `Booking_ID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE `complain` (
  `complain_ID` int(20) NOT NULL,
  `description` varchar(40) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `response` varchar(100) DEFAULT NULL,
  `guest_ID` int(20) DEFAULT NULL,
  `staff_ID` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_ID` int(20) NOT NULL,
  `event_name` varchar(40) DEFAULT NULL,
  `eventDate` date DEFAULT NULL,
  `description` varchar(40) DEFAULT NULL,
  `manager_ID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_ID` int(20) NOT NULL,
  `guest_ID` int(20) DEFAULT NULL,
  `feedbackDate` date DEFAULT NULL,
  `rating` int(5) DEFAULT NULL,
  `comments` varchar(300) DEFAULT NULL,
  `manager_ID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `guest_ID` int(20) NOT NULL,
  `passport_ID` int(20) NOT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `phone` int(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `FName` varchar(100) DEFAULT NULL,
  `LName` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `card_number` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `has_account`
--

CREATE TABLE `has_account` (
  `username` varchar(100) NOT NULL,
  `guest_ID` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `manager_ID` int(20) NOT NULL,
  `FName` varchar(30) DEFAULT NULL,
  `LName` varchar(30) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `salary` int(200) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `offer_name` varchar(30) NOT NULL,
  `discount_percentage` int(3) DEFAULT NULL,
  `desription` varchar(40) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `manager_ID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rate_room`
--

CREATE TABLE `rate_room` (
  `Room_ID` int(20) NOT NULL,
  `guest_ID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_service`
--

CREATE TABLE `request_service` (
  `guest_ID` int(20) NOT NULL,
  `service_ID` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `Room_ID` int(20) NOT NULL,
  `room_pic` varchar(20) DEFAULT NULL,
  `desription` varchar(300) DEFAULT NULL,
  `num of beds` int(12) NOT NULL,
  `PricePerNight` bigint(255) NOT NULL,
  `avalability` tinyint(1) NOT NULL,
  `capacity` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roomserviceorder`
--

CREATE TABLE `roomserviceorder` (
  `service_ID` int(20) NOT NULL,
  `staff_ID` int(20) NOT NULL,
  `room_ID` int(20) NOT NULL,
  `order_ID` int(20) NOT NULL,
  `is_finished` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_ID` int(20) NOT NULL,
  `service_name` varchar(40) DEFAULT NULL,
  `pice` int(200) DEFAULT NULL,
  `is_finished` tinyint(1) DEFAULT NULL,
  `staff_ID` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sponser`
--

CREATE TABLE `sponser` (
  `sponserName` varchar(40) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `sponser_type` varchar(40) DEFAULT NULL,
  `manager_ID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_ID` int(20) NOT NULL,
  `FName` varchar(30) DEFAULT NULL,
  `LName` varchar(20) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `position` varchar(20) DEFAULT NULL,
  `salary` int(250) DEFAULT NULL,
  `working_hours` int(30) DEFAULT NULL,
  `bonus` int(20) DEFAULT NULL,
  `manager_ID` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `roomservice_ID` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_phones`
--

CREATE TABLE `staff_phones` (
  `staff_ID` int(20) NOT NULL,
  `phone_numbers` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `password` (`password`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`Booking_ID`),
  ADD KEY `booking_ibfk_2` (`staff_ID`),
  ADD KEY `booking_ibfk_3` (`guest_ID`);

--
-- Indexes for table `book_room`
--
ALTER TABLE `book_room`
  ADD PRIMARY KEY (`Room_ID`,`Booking_ID`),
  ADD KEY `book_room_ibfk_2` (`Booking_ID`);

--
-- Indexes for table `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`complain_ID`),
  ADD KEY `complain_ibfk_1` (`staff_ID`),
  ADD KEY `complain_ibfk_2` (`guest_ID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_ID`),
  ADD KEY `event_ibfk_1` (`manager_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_ID`),
  ADD KEY `feedback_ibfk_1` (`manager_ID`),
  ADD KEY `guest_ID` (`guest_ID`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`guest_ID`),
  ADD UNIQUE KEY `passport_ID` (`passport_ID`);

--
-- Indexes for table `has_account`
--
ALTER TABLE `has_account`
  ADD PRIMARY KEY (`username`),
  ADD KEY `has_account_ibfk_2` (`guest_ID`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`manager_ID`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`offer_name`),
  ADD KEY `offer_ibfk_1` (`manager_ID`);

--
-- Indexes for table `rate_room`
--
ALTER TABLE `rate_room`
  ADD PRIMARY KEY (`Room_ID`,`guest_ID`),
  ADD KEY `guest_ID` (`guest_ID`);

--
-- Indexes for table `request_service`
--
ALTER TABLE `request_service`
  ADD PRIMARY KEY (`guest_ID`),
  ADD KEY `request_service_ibfk_2` (`service_ID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`Room_ID`);

--
-- Indexes for table `roomserviceorder`
--
ALTER TABLE `roomserviceorder`
  ADD PRIMARY KEY (`service_ID`,`staff_ID`,`room_ID`,`order_ID`),
  ADD KEY `roomserviceorder_ibfk_1` (`room_ID`),
  ADD KEY `roomserviceorder_ibfk_2` (`staff_ID`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_ID`),
  ADD KEY `service_ibfk_1` (`staff_ID`);

--
-- Indexes for table `sponser`
--
ALTER TABLE `sponser`
  ADD PRIMARY KEY (`sponserName`),
  ADD KEY `sponser_ibfk_1` (`manager_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_ID`),
  ADD KEY `staff_ibfk_1` (`manager_ID`);

--
-- Indexes for table `staff_phones`
--
ALTER TABLE `staff_phones`
  ADD PRIMARY KEY (`staff_ID`,`phone_numbers`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`staff_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`guest_ID`) REFERENCES `guest` (`guest_ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `book_room`
--
ALTER TABLE `book_room`
  ADD CONSTRAINT `book_room_ibfk_1` FOREIGN KEY (`Room_ID`) REFERENCES `room` (`Room_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_room_ibfk_2` FOREIGN KEY (`Booking_ID`) REFERENCES `booking` (`Booking_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complain`
--
ALTER TABLE `complain`
  ADD CONSTRAINT `complain_ibfk_1` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`staff_ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `complain_ibfk_2` FOREIGN KEY (`guest_ID`) REFERENCES `guest` (`guest_ID`) ON DELETE SET NULL;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`manager_ID`) REFERENCES `manager` (`manager_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`manager_ID`) REFERENCES `manager` (`manager_ID`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`guest_ID`) REFERENCES `guest` (`guest_ID`);

--
-- Constraints for table `has_account`
--
ALTER TABLE `has_account`
  ADD CONSTRAINT `has_account_ibfk_2` FOREIGN KEY (`guest_ID`) REFERENCES `guest` (`guest_ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `has_account_ibfk_3` FOREIGN KEY (`username`) REFERENCES `account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `offer_ibfk_1` FOREIGN KEY (`manager_ID`) REFERENCES `manager` (`manager_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rate_room`
--
ALTER TABLE `rate_room`
  ADD CONSTRAINT `rate_room_ibfk_2` FOREIGN KEY (`Room_ID`) REFERENCES `room` (`Room_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rate_room_ibfk_3` FOREIGN KEY (`guest_ID`) REFERENCES `guest` (`guest_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_service`
--
ALTER TABLE `request_service`
  ADD CONSTRAINT `request_service_ibfk_1` FOREIGN KEY (`guest_ID`) REFERENCES `guest` (`guest_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_service_ibfk_2` FOREIGN KEY (`service_ID`) REFERENCES `service` (`service_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roomserviceorder`
--
ALTER TABLE `roomserviceorder`
  ADD CONSTRAINT `roomserviceorder_ibfk_1` FOREIGN KEY (`room_ID`) REFERENCES `room` (`Room_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roomserviceorder_ibfk_2` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`staff_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roomserviceorder_ibfk_3` FOREIGN KEY (`service_ID`) REFERENCES `service` (`service_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`staff_ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `sponser`
--
ALTER TABLE `sponser`
  ADD CONSTRAINT `sponser_ibfk_1` FOREIGN KEY (`manager_ID`) REFERENCES `manager` (`manager_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`manager_ID`) REFERENCES `manager` (`manager_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff_phones`
--
ALTER TABLE `staff_phones`
  ADD CONSTRAINT `staff_phones_ibfk_1` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`staff_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
