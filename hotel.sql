-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2023 at 07:26 AM
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

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`Booking_ID`, `payment`, `meal_type`, `checkin_date`, `checkout_date`, `address`, `staff_ID`, `guest_ID`) VALUES
(2, 13800, 'Half Board', '2023-12-21', '2023-12-28', '456 Oak Ave, London, UK', 1, 2),
(3, 15200, 'All Inclusive', '2023-12-22', '2023-12-29', '789 Rue de Paris, Paris, France', 1, 6),
(4, 12900, 'Room Only', '2023-12-23', '2023-12-30', '101 Berlinstra?e, Berlin, Germany', 2, 4),
(5, 13500, 'Breakfast Included', '2023-12-24', '2024-01-01', '202 Calle Madrid, Madrid, Spain', 1, 5),
(6, 14200, 'Full Board', '2023-12-25', '2024-01-02', '303 Via Roma, Rome, Italy', 2, 3),
(7, 13100, 'Half Board', '2023-12-26', '2024-01-03', '404 Tokyo-dori, Tokyo, Japan', 1, 7),
(8, 15600, 'All Inclusive', '2023-12-27', '2024-01-04', '505 Shanghai Lu, Shanghai, China', 2, 8),
(9, 55, 'break', '2022-01-01', '2022-03-01', 'aldokki', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `book_room`
--

CREATE TABLE `book_room` (
  `Room_ID` int(20) NOT NULL,
  `Booking_ID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_room`
--

INSERT INTO `book_room` (`Room_ID`, `Booking_ID`) VALUES
(1, 5),
(4, 9);

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

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`complain_ID`, `description`, `date`, `response`, `guest_ID`, `staff_ID`) VALUES
(1, 'Room not cleaned properly', '2023-12-18', 'Apologies for the inconvenience. We will send housekeeping immediately.', 3, 2),
(2, 'Air conditioning not working', '2023-12-21', 'Maintenance has been notified and will fix the issue as soon as possible.', 4, 1),
(3, 'Slow internet connection', '2023-12-22', 'We are working on improving the network speed. Please bear with us.', 5, 2),
(4, 'Long wait for room service', '2023-12-27', 'We are experiencing a high volume of orders. We are working to expedite service.', 8, 1),
(5, 'Food was cold', '2023-12-28', 'We will replace your meal with a fresh one. We apologize for the quality issue.', 6, 1),
(6, 'bad roomservice', '2022-01-01', NULL, 2, NULL),
(7, 'bad breakfast', '2023-02-02', NULL, 3, NULL);

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

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_ID`, `event_name`, `eventDate`, `description`, `manager_ID`) VALUES
(1, 'Concert', '2023-10-15', 'Holiday Party', 1),
(2, 'Conference', '2023-11-27', 'AI in Healthcare', 1),
(3, 'Networking Event', '2023-12-06', 'Project Management Skills', 1);

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

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_ID`, `guest_ID`, `feedbackDate`, `rating`, `comments`, `manager_ID`) VALUES
(1, 2, '2023-12-15', 5, 'Excellent event, very informative and well-organized.', 1),
(2, 3, '2023-12-18', 4, 'Friendly staff and great facilities.', 1),
(4, 6, '2023-12-21', 5, 'Beautiful view from the balcony, and the housekeeping team did a great job.', 1),
(5, 8, '2023-12-22', 4, 'Spa treatments were excellent, but the gym equipment could be updated.', 1),
(6, 5, '2023-12-23', 5, 'Concierge was fantastic, helped me plan a perfect day trip.', 1),
(7, 7, '2023-12-25', 4, 'Christmas decorations were amazing, but the bar service was slow on Christmas Eve.', 1),
(8, 4, '2023-12-28', 3, 'Noise from the construction zone next door was disruptive.', 1),
(9, 2, '0000-00-00', 4, 'good', 1),
(10, 2, '2023-12-24', 4, 'good', 1),
(11, 2, '2023-12-24', 5, 'verygood', 1);

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

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`guest_ID`, `passport_ID`, `nationality`, `phone`, `email`, `address`, `FName`, `LName`, `gender`, `age`, `card_number`) VALUES
(2, 13579111, 'American', 1135791113, 'derekhale@gmail.com', 'Beacon Hills, California', 'Derek', 'Hale', 'Male', 44, 135791113),
(3, 24681012, 'Saudi Arabian', 1246810121, 'nawafelroaily@gmail.com', 'Sakaka, El jouf', 'Nawaf', 'Elroaily', 'Male', 29, 246810121),
(4, 345678901, 'German', 1045678901, 'anna.schmidt@email.com', '101 Berlinstra?e, Berlin, Germany', 'Anna', 'Schmidt', 'Female', 30, 234567890),
(5, 456789012, 'Spanish', 1245678903, 'pablo.garcia@email.com', '202 Calle Madrid, Madrid, Spain', 'Pablo', 'Garcia', 'Male', 55, 456789012),
(6, 567890123, 'Italian', 1566701234, 'maria.rossi@email.com', '303 Via Roma, Rome, Italy', 'Maria', 'Rossi', 'Female', 25, 567890123),
(7, 678901234, 'Japanese', 1270192345, 'hiroshi.tanaka@email.com', '404 Tokyo-dori, Tokyo, Japan', 'Hiroshi', 'Tanaka', 'Male', 40, 678901234),
(8, 789012345, 'Chinese', 1289123456, 'li.wang@email.com', '505 Shanghai Lu, Shanghai, China', 'Li', 'Wang', 'Female', 32, 789012345);

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

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`manager_ID`, `FName`, `LName`, `email`, `title`, `dateOfBirth`, `salary`, `phone`, `username`) VALUES
(1, 'Ahmed', 'Ali', 'ahmedali@gmail.com', 'Manager', '1976-08-15', 40000, 1012345679, 'AhmedAli');

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

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`offer_name`, `discount_percentage`, `desription`, `start_date`, `end_date`, `manager_ID`) VALUES
('Business Traveler', 10, 'Free breakfast and Wi-Fi for business gu', '2023-08-01', '2023-10-31', 1),
('Family Fun', 15, '15% off for families with kids', '2023-07-01', '2023-09-30', 1),
('Summer Escape', 25, 'Save 25% on weekend stays', '2023-06-01', '2023-08-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rate_room`
--

CREATE TABLE `rate_room` (
  `Room_ID` int(20) NOT NULL,
  `guest_ID` int(20) NOT NULL,
  `room_rating` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_service`
--

CREATE TABLE `request_service` (
  `guest_ID` int(20) NOT NULL,
  `service_ID` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_service`
--

INSERT INTO `request_service` (`guest_ID`, `service_ID`) VALUES
(2, 1),
(3, 1),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `Room_ID` int(20) NOT NULL,
  `room_pic` varchar(20) DEFAULT NULL,
  `room_desription` varchar(300) DEFAULT NULL,
  `num of beds` int(12) NOT NULL,
  `PricePerNight` bigint(255) NOT NULL,
  `avalability` tinyint(1) NOT NULL,
  `capacity` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`Room_ID`, `room_pic`, `room_desription`, `num of beds`, `PricePerNight`, `avalability`, `capacity`) VALUES
(1, NULL, NULL, 1, 3500, 1, 2),
(2, NULL, NULL, 2, 6500, 1, 4),
(3, NULL, NULL, 1, 9500, 1, 4),
(4, NULL, NULL, 4, 8500, 1, 6),
(5, NULL, NULL, 2, 4500, 1, 2),
(6, NULL, NULL, 1, 6500, 1, 2);

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
  `price` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_ID`, `service_name`, `price`) VALUES
(1, 'Room Service', 250),
(2, 'Laundry', 100),
(3, 'Car Rental', 3000),
(4, 'Airport Transfer', 550);

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

--
-- Dumping data for table `sponser`
--

INSERT INTO `sponser` (`sponserName`, `start_date`, `end_date`, `sponser_type`, `manager_ID`) VALUES
('Airline Inc.', '2023-06-01', '2023-12-31', 'Travel Partner', 1),
('Event Planners', '2023-11-01', '2024-01-31', 'Event Management', 1),
('Local Restaurant', '2023-10-20', '2024-06-20', 'Catering Partner', 1),
('Tech Solutions', '2023-07-01', '2024-06-30', 'IT Provider', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_ID` int(20) NOT NULL,
  `FName` varchar(30) DEFAULT NULL,
  `LName` varchar(20) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `phone_number` int(40) DEFAULT NULL,
  `position` varchar(20) DEFAULT NULL,
  `salary` int(250) DEFAULT NULL,
  `working_hours` int(30) DEFAULT NULL,
  `bonus` int(20) DEFAULT NULL,
  `manager_ID` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `roomservice_ID` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_ID`, `FName`, `LName`, `age`, `phone_number`, `position`, `salary`, `working_hours`, `bonus`, `manager_ID`, `username`, `roomservice_ID`) VALUES
(1, 'Mazen', 'Mansour', 36, 1036567372, 'Receptionist', 5000, 8, NULL, 1, 'MansourMansour', NULL),
(2, 'Sama', 'Massoud', 31, 1126723832, 'Receptionist', 5500, 6, NULL, 1, 'SamaMassoud', NULL),
(3, 'Marwa', 'Hossam', 32, 1267489489, 'Room Service', 4900, 14, NULL, 1, 'MarwaHossam', NULL),
(4, 'Loay', 'Sherief', 40, 1578478478, 'Room Service', 4600, 14, NULL, 1, 'LoaySherief', NULL);

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
  ADD PRIMARY KEY (`Room_ID`) USING BTREE,
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
  ADD PRIMARY KEY (`service_ID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `Booking_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `complain_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `guest_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `Room_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`staff_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`guest_ID`) REFERENCES `guest` (`guest_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `complain_ibfk_2` FOREIGN KEY (`guest_ID`) REFERENCES `guest` (`guest_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`guest_ID`) REFERENCES `guest` (`guest_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `has_account`
--
ALTER TABLE `has_account`
  ADD CONSTRAINT `has_account_ibfk_2` FOREIGN KEY (`guest_ID`) REFERENCES `guest` (`guest_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
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
-- Constraints for table `sponser`
--
ALTER TABLE `sponser`
  ADD CONSTRAINT `sponser_ibfk_1` FOREIGN KEY (`manager_ID`) REFERENCES `manager` (`manager_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`manager_ID`) REFERENCES `manager` (`manager_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
