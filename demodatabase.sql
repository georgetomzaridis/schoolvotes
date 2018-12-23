-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: db24.grserver.gr:3306
-- Χρόνος δημιουργίας: 24 Δεκ 2018 στις 00:24:38
-- Έκδοση διακομιστή: 10.2.18-MariaDB
-- Έκδοση PHP: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `georgeto231710_3gelvotes`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `codes`
--

CREATE TABLE `codes` (
  `ID` int(11) NOT NULL,
  `VoteCode` text NOT NULL,
  `VoteCodeStatus` text NOT NULL,
  `VoteCodeCreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `codes`
--

INSERT INTO `codes` (`ID`, `VoteCode`, `VoteCodeStatus`, `VoteCodeCreatedAt`) VALUES
(1306, '123456', 'active', '2018-12-07 21:22:57'),
(1307, '654321', 'active', '2018-12-07 21:23:16');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `logs`
--

CREATE TABLE `logs` (
  `ID` int(11) NOT NULL,
  `VoteCode` text NOT NULL,
  `SystemLogs` text NOT NULL,
  `DateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `people`
--

CREATE TABLE `people` (
  `ID` int(11) NOT NULL,
  `FullName` text NOT NULL,
  `Department` text NOT NULL,
  `VoteCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `people`
--

INSERT INTO `people` (`ID`, `FullName`, `Department`, `VoteCount`) VALUES
(30, 'John Doe', 'A2', 0),
(31, 'Charlie Root', 'B5', 1),
(32, 'Mich Jenkins', 'G2', 0),
(33, 'George Bonzai', 'F5', 80),
(34, 'Manolis Kiagias', 'F5', 100),
(35, 'George Tomzaridis', 'H7', 81),
(36, 'Jonhson Alterson', 'T3', 2),
(37, 'Giannis Ligopsixakis', 'A8', 100);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `settings`
--

CREATE TABLE `settings` (
  `ID` int(11) NOT NULL,
  `SettingName` text NOT NULL,
  `SettingValue` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `settings`
--

INSERT INTO `settings` (`ID`, `SettingName`, `SettingValue`) VALUES
(1, 'systemstatus', 'off'),
(2, 'systemstatus_msg', 'Message to show if the platform closed ');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`ID`);

--
-- Ευρετήρια για πίνακα `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`ID`);

--
-- Ευρετήρια για πίνακα `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`ID`);

--
-- Ευρετήρια για πίνακα `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `codes`
--
ALTER TABLE `codes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1308;

--
-- AUTO_INCREMENT για πίνακα `logs`
--
ALTER TABLE `logs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT για πίνακα `people`
--
ALTER TABLE `people`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT για πίνακα `settings`
--
ALTER TABLE `settings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
