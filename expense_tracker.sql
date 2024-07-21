-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 01:15 PM
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
-- Database: `expense_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoriestbl`
--

CREATE TABLE `categoriestbl` (
  `CategoryID` int(11) NOT NULL,
  `ExpenseID` int(20) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categoriestbl`
--

INSERT INTO `categoriestbl` (`CategoryID`, `ExpenseID`, `CategoryName`, `UserID`, `CreatedAt`, `UpdatedAt`) VALUES
(44, 44, 'entertainment', 2, '2023-12-29 07:37:33', '2023-12-29 07:37:33'),
(48, 48, 'food', 2, '2023-12-29 15:16:07', '2023-12-29 15:16:07'),
(49, 49, 'transportation', 2, '2023-12-29 15:48:09', '2023-12-29 15:48:09'),
(50, 50, 'entertainment', 2, '2024-01-02 14:08:08', '2024-01-02 14:08:08'),
(51, 51, 'transportation', 2, '2024-01-07 04:30:27', '2024-01-07 04:30:27'),
(54, 54, 'transportation', 3, '2024-02-01 07:11:23', '2024-02-01 07:11:23'),
(55, 55, 'entertainment', 3, '2024-02-01 07:12:29', '2024-02-01 07:12:29'),
(56, 56, 'entertainment', 3, '2024-02-01 07:13:23', '2024-02-01 07:13:23'),
(57, 57, 'entertainment', 3, '2024-02-02 14:47:20', '2024-02-02 14:47:20'),
(58, 58, 'food', 3, '2024-02-03 05:30:33', '2024-02-03 05:30:33'),
(59, 59, 'food', 2, '2024-02-11 07:22:14', '2024-02-11 07:22:14'),
(60, 60, 'food', 2, '2024-02-12 17:07:05', '2024-02-12 17:07:05'),
(61, 61, 'food', 6, '2024-02-12 17:14:08', '2024-02-12 17:14:08'),
(62, 62, 'food', 2, '2024-02-18 12:13:44', '2024-02-18 12:13:44'),
(63, 63, 'Electronics', 2, '2024-02-20 01:03:51', '2024-02-20 01:03:51'),
(64, 64, 'Entertainment', 2, '2024-02-20 01:22:37', '2024-02-20 01:22:37'),
(72, 72, 'Entertainment', 5, '2024-02-25 13:52:03', '2024-02-25 13:52:03'),
(73, 73, 'Transportation', 3, '2024-02-27 15:29:52', '2024-02-27 15:29:52'),
(74, 74, 'Entertainment', 3, '2024-02-27 15:30:20', '2024-02-27 15:30:20'),
(75, 75, 'Entertainment', 7, '2024-03-17 08:58:26', '2024-03-17 08:58:26'),
(76, 76, 'Entertainment', 7, '2024-03-17 09:21:11', '2024-03-17 09:21:11'),
(77, 77, 'Transportation', 7, '2024-03-17 09:22:40', '2024-03-17 09:22:40'),
(78, 78, 'Entertainment', 7, '2024-04-04 06:03:30', '2024-04-04 06:03:30'),
(79, 79, 'Transportation', 7, '2024-04-04 06:49:21', '2024-04-04 06:49:21'),
(80, 80, 'Transportation', 7, '2024-07-21 10:25:17', '2024-07-21 10:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `categorytbl`
--

CREATE TABLE `categorytbl` (
  `ID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorytbl`
--

INSERT INTO `categorytbl` (`ID`, `CategoryName`, `CreatedAt`) VALUES
(1, 'Entertainment', '2024-02-20 01:20:27'),
(2, 'Transportation', '2024-02-20 01:29:27'),
(3, 'Electronics', '2024-02-20 01:18:27'),
(6, 'Grocery', '2024-02-21 05:54:20'),
(9, 'Other', '2024-02-25 13:05:19'),
(13, 'Medical Expenses', '2024-03-17 09:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `expensetbl`
--

CREATE TABLE `expensetbl` (
  `ExpenseID` int(20) NOT NULL,
  `UserID` int(20) NOT NULL,
  `ExpenseCost` varchar(150) DEFAULT NULL,
  `ExpenseDate` date DEFAULT NULL,
  `ExpenseItem` varchar(200) DEFAULT NULL,
  `NoteDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `CategoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expensetbl`
--

INSERT INTO `expensetbl` (`ExpenseID`, `UserID`, `ExpenseCost`, `ExpenseDate`, `ExpenseItem`, `NoteDate`, `CategoryID`) VALUES
(44, 2, '300', '2023-12-28', 'Movie', '2023-12-29 07:37:30', 44),
(48, 2, '80', '2023-12-14', 'Parotta', '2023-12-29 15:16:06', 48),
(49, 2, '200', '2019-01-03', 'Bus Ticket', '2023-12-29 15:48:09', 49),
(50, 2, '120', '2023-12-30', 'Movie', '2024-01-02 14:08:06', 50),
(51, 2, '20', '2024-01-04', 'Bus Ticket', '2024-01-07 04:30:27', 51),
(54, 3, '20', '2024-02-01', 'Bus Ticket', '2024-02-01 07:11:22', 54),
(55, 3, '60', '2024-01-31', 'Document', '2024-02-01 07:12:29', 55),
(56, 3, '300', '2024-01-29', 'Film', '2024-02-01 07:13:22', 56),
(57, 3, '500', '2024-02-02', 'Movie', '2024-02-02 14:47:20', 57),
(58, 3, '45', '2024-02-03', 'Snacks', '2024-02-03 05:30:28', 58),
(59, 2, '20', '2024-02-09', 'Snacks', '2024-02-11 07:22:14', 59),
(60, 2, '80', '2024-02-12', 'Bovonto', '2024-02-12 17:07:04', 60),
(61, 6, '80', '2024-02-12', 'Bovonto', '2024-02-12 17:14:08', 61),
(62, 2, '20', '2024-02-18', 'Cream Bun', '2024-02-18 12:13:43', 62),
(63, 2, '200', '2024-02-20', 'Light', '2024-02-20 01:03:51', 63),
(64, 2, '500', '2024-02-20', 'Movie', '2024-02-20 01:22:37', 64),
(72, 5, '300', '2024-02-25', 'Movie', '2024-02-25 13:52:02', 72),
(73, 3, '500', '2023-12-30', 'Petrol', '2024-02-27 15:29:51', 73),
(74, 3, '2500', '2023-12-15', 'Tour', '2024-02-27 15:30:20', 74),
(75, 7, '20000', '2024-03-17', 'TV', '2024-03-17 08:58:26', 75),
(76, 7, '500', '2024-03-17', 'Movie', '2024-03-17 09:21:11', 76),
(77, 7, '30', '2024-03-17', 'Bus Ticket', '2024-03-17 09:22:40', 77),
(78, 7, '50', '2024-04-04', 'Movie', '2024-04-04 06:03:30', 78),
(79, 7, '30000', '2024-04-04', 'Bike', '2024-04-04 06:49:21', 79),
(80, 7, '50', '2024-07-22', 'Bus fair', '2024-07-21 10:25:16', 80);

-- --------------------------------------------------------

--
-- Table structure for table `sharedexpensestbl`
--

CREATE TABLE `sharedexpensestbl` (
  `SharedExpenseID` int(20) NOT NULL,
  `ExpenseID` int(20) NOT NULL,
  `PaidByUserID` int(20) NOT NULL,
  `SharedWithUserID` int(20) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Description` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sharedexpensestbl`
--

INSERT INTO `sharedexpensestbl` (`SharedExpenseID`, `ExpenseID`, `PaidByUserID`, `SharedWithUserID`, `Amount`, `Description`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 44, 2, 3, 100.00, 'For snacks', '2024-01-01 06:54:07', '2024-01-01 06:54:07'),
(3, 44, 2, 3, 123.00, '', '2024-01-01 07:28:05', '2024-01-01 07:28:05'),
(6, 49, 2, 3, 20.00, 'daily bus ticket', '2024-01-02 08:54:31', '2024-01-02 08:54:31'),
(34, 44, 2, 4, 12.00, 'jhvbshu vj', '2024-01-12 17:07:54', '2024-01-12 17:07:54'),
(35, 51, 2, 3, 10.00, '', '2024-01-15 16:38:53', '2024-01-15 16:38:53'),
(36, 44, 2, 3, 200.00, 'hgj7ut', '2024-01-16 01:36:25', '2024-01-16 01:36:25'),
(37, 44, 2, 3, 200.00, '', '2024-01-16 07:19:12', '2024-01-16 07:19:12'),
(38, 44, 2, 4, 689.00, 'bh vjihbi', '2024-01-16 07:58:38', '2024-01-16 07:58:38'),
(39, 44, 2, 3, 200.00, 'yfi7fy', '2024-01-16 08:00:15', '2024-01-16 08:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `userstbl`
--

CREATE TABLE `userstbl` (
  `UserID` int(20) NOT NULL,
  `FullName` varchar(150) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Password` varchar(150) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userstbl`
--

INSERT INTO `userstbl` (`UserID`, `FullName`, `Email`, `MobileNumber`, `Password`, `RegDate`) VALUES
(3, 'Subiksha', 'subikshajh@gmail.com', 6385387284, 'bedfe0309f9dd54532863356b0ed27c4', '2024-01-01 06:47:46'),
(5, 'Admin', 'admin@gmail.com', 987654321, '95db0357fafd0d349df4756a4966e969', '2024-01-31 16:28:02'),
(6, 'AbishekDharshan', 'dharshanashik@gmail.com', 9003728811, '60a9d3c1eb5df3ab1c369ece4a5111a3', '2024-02-12 17:10:41'),
(7, 'Thavasi ganesh', 'Thavasiganesh03@gmail.com', 9543395034, '12c907570178bbb3a5dbb27bd47c6808', '2024-02-25 12:57:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoriestbl`
--
ALTER TABLE `categoriestbl`
  ADD PRIMARY KEY (`CategoryID`),
  ADD KEY `fkExpenseID` (`ExpenseID`);

--
-- Indexes for table `categorytbl`
--
ALTER TABLE `categorytbl`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `expensetbl`
--
ALTER TABLE `expensetbl`
  ADD PRIMARY KEY (`ExpenseID`);

--
-- Indexes for table `sharedexpensestbl`
--
ALTER TABLE `sharedexpensestbl`
  ADD PRIMARY KEY (`SharedExpenseID`),
  ADD KEY `PaidByUserID` (`PaidByUserID`),
  ADD KEY `SharedWithUserID` (`SharedWithUserID`),
  ADD KEY `fkExpenseID1` (`ExpenseID`);

--
-- Indexes for table `userstbl`
--
ALTER TABLE `userstbl`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoriestbl`
--
ALTER TABLE `categoriestbl`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `categorytbl`
--
ALTER TABLE `categorytbl`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `expensetbl`
--
ALTER TABLE `expensetbl`
  MODIFY `ExpenseID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `sharedexpensestbl`
--
ALTER TABLE `sharedexpensestbl`
  MODIFY `SharedExpenseID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `userstbl`
--
ALTER TABLE `userstbl`
  MODIFY `UserID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categoriestbl`
--
ALTER TABLE `categoriestbl`
  ADD CONSTRAINT `fkExpenseID` FOREIGN KEY (`ExpenseID`) REFERENCES `expensetbl` (`ExpenseID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ExpenseID` FOREIGN KEY (`ExpenseID`) REFERENCES `expensetbl` (`ExpenseID`),
  ADD CONSTRAINT `fk_category_expense` FOREIGN KEY (`CategoryID`) REFERENCES `expensetbl` (`ExpenseID`);

--
-- Constraints for table `sharedexpensestbl`
--
ALTER TABLE `sharedexpensestbl`
  ADD CONSTRAINT `fkExpenseID1` FOREIGN KEY (`ExpenseID`) REFERENCES `expensetbl` (`ExpenseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sharedexpensestbl_ibfk_1` FOREIGN KEY (`ExpenseID`) REFERENCES `expensetbl` (`ExpenseID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
