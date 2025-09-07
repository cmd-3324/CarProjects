-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 07, 2025 at 09:24 PM
-- Server version: 9.1.0
-- PHP Version: 8.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel11`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_user`
--

DROP TABLE IF EXISTS `car_user`;
CREATE TABLE IF NOT EXISTS `car_user` (
  `UserID` bigint UNSIGNED NOT NULL,
  `car_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`UserID`,`car_id`),
  KEY `car_user_car_id_foreign` (`car_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_user`
--

INSERT INTO `car_user` (`UserID`, `car_id`, `created_at`, `updated_at`) VALUES
(1, 3, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(1, 12, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(1, 14, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(2, 4, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(2, 11, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(3, 8, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(3, 10, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(4, 4, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(4, 11, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(5, 5, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(5, 9, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(5, 15, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(6, 1, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(7, 2, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(8, 1, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(8, 12, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(9, 3, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(9, 5, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(9, 11, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(10, 1, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(10, 6, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(10, 13, '2025-09-07 10:20:32', '2025-09-07 10:20:32'),
(11, 1966, '2025-09-07 10:23:49', '2025-09-07 10:23:49');

--
-- Triggers `car_user`
--
DROP TRIGGER IF EXISTS `after_car_user_insert`;
DELIMITER $$
CREATE TRIGGER `after_car_user_insert` AFTER INSERT ON `car_user` FOR EACH ROW BEGIN
                UPDATE cars
                SET sell_number = sell_number + 1,
                    available_as = available_as - 1
                WHERE car_id = NEW.car_id
                AND available_as > 0;
            END
$$
DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
