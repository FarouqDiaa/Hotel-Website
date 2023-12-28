-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2023 at 06:37 AM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `BOOKROOM` (IN `pay` INT, IN `meal` VARCHAR(20), IN `checkin` DATE, IN `checkout` DATE, IN `guestId` INT, IN `type` INT, IN `staffid` INT)   BEGIN
    IF type = 0 THEN
        INSERT INTO `booking` (`payment`, `meal_type`, `checkin_date`, `checkout_date`, `guest_ID`) VALUES
(pay, meal, checkin, checkout, adress, guestId);
        INSERT INTO `book_room`(`Room_ID`, `Booking_ID`) VALUES
(room_id,(SELECT max(Booking_ID) FROM booking));
    ELSE
        INSERT INTO `booking` (`payment`, `meal_type`, `checkin_date`, `checkout_date`, `staff_ID`, `guest_ID`) VALUES
(pay, meal, checkin, checkout, adress, staffID, guestId);
        INSERT INTO `book_room`(`Room_ID`, `Booking_ID`) VALUES 
(room_id,(SELECT max(Booking_ID) FROM booking));
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CANCELBOOK` (IN `bookingid` INT(20), IN `checkoutdate` DATE)   BEGIN 
    DECLARE CIN DATE;
    DELETE FROM book_room 
    WHERE Booking_ID = bookingid;
    SELECT checkin_date 
    INTO CIN
    FROM booking
    WHERE Booking_ID = bookingid;
    IF CIN IS NULL THEN
        UPDATE `booking` 
        SET `checkout_date` = NULL 
        WHERE Booking_ID = bookingid;
    ELSE 
        UPDATE `booking` 
        SET `checkout_date` = checkoutdate 
        WHERE Booking_ID = bookingid;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteEvent` (IN `eventId` INT(20))   BEGIN
DELETE FROM `event` WHERE `event_ID` = eventId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `FIRESTAFF` (IN `staffid` INT)   BEGIN
	DELETE FROM `staff`
	WHERE staff_ID = staffid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ManageEvents` (IN `eventName` VARCHAR(40), IN `eventDate` DATE, IN `description` VARCHAR(40), IN `managerId` INT(20))   BEGIN
INSERT INTO `event` (`event_name`, `eventDate`, `description`, `manager_ID`) 
                                VALUES (eventName, eventDate, description, managerId);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATEBONUS` (IN `bonusin` INT, IN `staffid` INT)   BEGIN
	UPDATE `staff`
	SET bonus = bonusin
	WHERE staff_ID = staffid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATECHECKDATES` (IN `checkout` DATE, IN `checkin` DATE, IN `bookingid` INT)   BEGIN
	UPDATE `booking`
	SET checkin_date = checkin,
	checkout_date = checkout
	WHERE booking_ID = bookingid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATECOMPLAINTS` (IN `responsein` VARCHAR(100), IN `guestid` INT)   BEGIN
	UPDATE `complain`
	SET repsone = responsein
	WHERE guest_ID = guestid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATESALARY` (IN `salaryin` INT, IN `staffid` INT)   BEGIN
	UPDATE `staff`
	SET salary = salaryin
	WHERE staff_ID = staffid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `VIEWBOOKING` (IN `guestid` INT, IN `type` INT)   BEGIN
    IF type = 0 THEN
        SELECT * FROM `booking` WHERE `guest_ID` = guestid;
    ELSE
        SELECT br.`Booking_ID`, `payment`, `meal_type`, `checkin_date`, `checkout_date`, `staff_ID`, `guest_ID` 
        FROM `booking` b, `book_room` br 
        WHERE br.Booking_ID = b.Booking_ID;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `type`) VALUES
('AhmedAbdulrahman', 'AhmedAbdulrahman1', 2),
('AhmedAli', 'AhmedAli', 3),
('AhmedMohamed', 'Ahmed..Mohamed', 0),
('AmrHassan', 'amrhasssan', 0),
('BasmaMohamed', '@1BasmaMohamed', 2),
('eyadayman', 'eyadayman', 0),
('farouqfarouq', 'farouqfarouq', 0),
('FatimaMoahmed', 'Fatima2.Mohamed', 0),
('guest1', '$2y$10$wm2R0J0LvSgYq/3U.L5P8OBrhmCT0tPiI', 0),
('KhaledSaid', 'KhaledSaid', 1),
('LinaMahmoud', 'Lina.Mahmoud', 2),
('LoaySherief', 'LoaySherief', 2),
('mahmoud_21', 'mahmoud_21', 0),
('MansourMansour\r\n', 'MansourMansour', 1),
('MarwaHossam', 'MarwaHossam', 2),
('NadiaGamall', 'NadiaGamall', 0),
('nohasamy', 'nohasamy', 0),
('NourHassan', 'Nour_Hassan', 1),
('OmarAli', 'OMARALI', 2),
('rawanosama', 'rawanosama', 0),
('SamaMassoud', 'SamaMassoud', 1),
('samisayed', 'samisayed', 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `Booking_ID` int(20) NOT NULL,
  `payment` int(20) DEFAULT NULL,
  `meal_type` varchar(20) DEFAULT NULL,
  `checkin_date` date DEFAULT NULL,
  `checkout_date` date DEFAULT NULL,
  `staff_ID` int(20) DEFAULT NULL,
  `guest_ID` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`Booking_ID`, `payment`, `meal_type`, `checkin_date`, `checkout_date`, `staff_ID`, `guest_ID`) VALUES
(1, 200, 'Breakfast', '2023-12-12', '2023-12-21', 2, 1),
(2, 300, 'Lunch', '2024-12-04', '2024-12-23', 1, 2),
(3, 100, 'Dinner', '2024-02-07', '2024-03-19', 4, 3),
(4, 150, 'Breakfast-Lunch', '2023-12-15', '2024-05-22', 1, 4),
(5, 400, 'Breakfast', '2023-12-05', '2023-12-21', 4, 5),
(6, 350, 'Lunch', '2023-12-20', '2024-01-01', 3, 6),
(10, 100, 'Launch', '2023-12-27', '2024-01-05', NULL, 10),
(11, 300, 'launch', '2022-11-11', '2022-11-20', NULL, 7),
(12, 250, 'breakfast', '2023-02-02', '2023-02-16', NULL, 8),
(13, 250, 'breakfast', '2023-02-16', '2023-03-16', NULL, 9);

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
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 10);

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

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_ID`, `event_name`, `eventDate`, `description`, `manager_ID`) VALUES
(1, 'Concert', '2023-10-15', 'Holiday Party', 1),
(2, 'Conference', '2023-11-27', 'AI in Healthcare', 1),
(5, 'ca', '2024-12-12', 'LEARN CMP', 1),
(6, 'cairokee', '2024-01-01', 'amir', 1);

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
  `passport_ID` bigint(20) NOT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
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
(1, 30307042101567, 'EGYPT', '01225979467', 'samysamy2@gmail.com', 'dokki', 'sami', 'sayed', 'M', 23, 4220140),
(2, 30307042101578, 'EGYPT', '01125979647', 'nohasamy@gmail.com', 'haram', 'noha', 'samy', 'F', 25, 4220133),
(3, 20207092101567, 'EGYPT', '01225899467', 'farouqfarouq@gmail.com', 'giza', 'farouq', 'diaa', 'M', 50, 4220123),
(4, 20208042101562, 'EGYPT', '01025979641', 'mahmoud_21@gmail.com', 'helwan', 'mahmoud', 'aly', 'M', 62, 4220141),
(5, 20204042101960, 'EGYPT', '01525899441', 'eyadayman@gmail.com', 'haram', 'Eyad', 'Ayman', 'M', 16, 4220111),
(6, 20208048901518, 'EGYPT', '01225979561', 'rawanosama@gmail.com', 'ainhelwan', 'Rawan', 'Osama', 'F', 27, 4220115),
(7, 30401234567819, 'Egypt', '01234567322', 'ahmedmohamed@gmail.com', 'Cairo', 'Ahmed', 'Mohamed', 'M', 30, 9874321),
(8, 30201234567890, 'Egypt', '01023345678', 'fatimamohamed@gmail.com', '6 October', 'Fatima', 'Mohamed', 'F', 25, 4873210),
(9, 30405060102604, 'Egypt', '01134389012', 'amrhassan@gmail.com', 'Giza', 'Amr', 'Hassan', 'M', 35, 4232109),
(10, 30408729836637, 'Egypt', '01545780123', 'nadiagamal@gmail.com', 'Zayed', 'Nadia', 'Gamal', 'F', 28, 6543210);

-- --------------------------------------------------------

--
-- Table structure for table `has_account`
--

CREATE TABLE `has_account` (
  `username` varchar(100) NOT NULL,
  `guest_ID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `has_account`
--

INSERT INTO `has_account` (`username`, `guest_ID`) VALUES
('samisayed', 1),
('nohasamy', 2),
('farouqfarouq', 3),
('mahmoud_21', 4),
('eyadayman', 5),
('rawanosama', 6),
('AhmedMohamed', 7),
('FatimaMoahmed', 8),
('AmrHassan', 9),
('NadiaGamall', 10);

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
(1, 2);

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
(1, 'single.jpg', 'Classic Single Room:Step into comfort with our Classic Single Room.', 1, 1500, 0, 1),
(2, 'single.jpg', 'Deluxe Double Room:Indulge in the spacious elegance of our Deluxe Double Room.', 1, 1200, 0, 2),
(3, 'double.jpg', 'Executive Suite:Experience luxury in our Executive Suite, where sophistication meets comfort.', 3, 2800, 0, 6),
(4, 'single.jpg', 'Family Friendly Suite:Perfect for families, our Family Friendly Suite provides a welcoming environment for everyone. ', 1, 1100, 0, 2),
(5, 'double.jpg', 'Modern Business Room:Stay productive and comfortable in our Modern Business Room. Designed with the needs of business travelers in mind, this room boasts a well-equipped workspace and high-speed internet, ensuring a seamless blend of work and relaxation.', 2, 1600, 0, 4),
(6, 'double.jpg', NULL, 3, 4200, 0, 6),
(7, 'double.jpg', 'Contemporary Loft:For a unique and stylish experience, choose our Contemporary Loft. With its modern design and open layout, this room offers a chic urban escape. Relax in the trendy ambiance and enjoy the artistic flair of your surroundings.', 2, 1700, 1, 4),
(8, 'single.jpg', 'Panoramic View Room:Wake up to breathtaking vistas in our Panoramic View Room. Perched high above the city, this room offers sweeping views of the surroundings. Whether day or night, immerse yourself in the beauty of your surroundings from the comfort of your private oasis.', 1, 1250, 1, 2);

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
  `manager_ID` int(20) NOT NULL,
  `pic` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sponser`
--

INSERT INTO `sponser` (`sponserName`, `start_date`, `end_date`, `sponser_type`, `manager_ID`, `pic`) VALUES
('Double Dare', '2023-06-01', '2023-12-31', 'Drink', 1, 'dd-sponsor.jpg'),
('V7', '2023-11-01', '2024-01-31', 'Drink', 1, 'v7-sponsor.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_ID` int(20) NOT NULL,
  `FName` varchar(30) DEFAULT NULL,
  `LName` varchar(20) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `phone_number` varchar(40) DEFAULT NULL,
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
(1, 'Mazen', 'Mansour', 36, '01036567372', 'Room Service', 5000, 8, NULL, 1, 'MansourMansour', 1),
(2, 'Sama', 'Massoud', 31, '01126723832', 'Room Service', 5500, 6, 90, 1, 'SamaMassoud', 2),
(3, 'Marwa', 'Hossam', 32, '01267489489', 'Receptionist', 4900, 14, NULL, 1, 'MarwaHossam', NULL),
(4, 'Loay', 'Sherief', 40, '01578478478', 'Receptionist', 4600, 14, NULL, 1, 'LoaySherief', NULL),
(5, 'Ahmed', 'Abdulrahman', 30, '01236789110', 'Receptionist', 5000, 13, NULL, 1, 'AhmedAbdulrahman', NULL),
(6, 'Basma', 'Mohammed', 25, '01015678901', 'Receptionist', 3000, 15, NULL, 1, 'BasmaMohamed', NULL),
(7, 'Khaled', 'Said', 35, '01134589012', 'Room Service', 2000, 20, NULL, 1, 'KhaledSaid', NULL),
(8, 'Nour', 'Hassan', 28, '01545690123', 'Room Service', 2500, 20, NULL, 1, 'NourHassan', NULL),
(9, 'Omar', 'Ali', 32, '01156789234', 'Receptionist', 4000, 15, NULL, 1, 'OmarAli', NULL);

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
  ADD PRIMARY KEY (`manager_ID`),
  ADD KEY `username` (`username`);

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
  MODIFY `Booking_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `complain_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `guest_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `Room_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`username`) REFERENCES `account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

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
