-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 07, 2025 at 09:25 PM
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
-- Table structure for table `carsusers`
--

DROP TABLE IF EXISTS `carsusers`;
CREATE TABLE IF NOT EXISTS `carsusers` (
  `UserID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `UserName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `carsusers_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carsusers`
--

INSERT INTO `carsusers` (`UserID`, `UserName`, `Active`, `email`, `email_verified_at`, `phone_number`, `Location`, `Avatar`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'jeromy.kuhn', 1, 'margot.koelpin@example.com', NULL, '+1-707-448-5629', 'Johannastad', 'BATCH-2021', '$2y$12$2Hv6cEJiv3uKaCzf/cUeHum2VNOem34JH680YWdafomJVjXAGUuo.', NULL, '2025-09-07 10:20:31', '2025-09-07 10:20:31'),
(2, 'gbrekke', 1, 'sherwood.grady@example.org', NULL, '951.638.7520', 'North Kaylee', 'BATCH-8891', '$2y$12$r4saB8JpDX4NdG8db9B2.OLEikIq.yJe4jgxYbcP.8A2lry0Z3i.y', NULL, '2025-09-07 10:20:31', '2025-09-07 10:20:31'),
(3, 'zstoltenberg', 1, 'michel81@example.net', NULL, '(520) 380-4841', 'D\'angelofurt', 'BATCH-1962', '$2y$12$rixTejOt7sKejVtCvGk/xuJE1zg3Gm7bjYSyFQX1MIuT6UrQdy0dK', NULL, '2025-09-07 10:20:31', '2025-09-07 10:20:31'),
(4, 'greenfelder.holden', 1, 'rippin.kellie@example.org', NULL, '+18156134588', 'Port Nico', 'BATCH-8396', '$2y$12$e4holIpAXqeeH.TDGhF1zuhxt6FOivJG7ovcK1HY8uOdjzoSxQzmG', NULL, '2025-09-07 10:20:31', '2025-09-07 10:20:31'),
(5, 'runte.horace', 1, 'jarrod.watsica@example.net', NULL, '+1 (346) 371-9583', 'Port Cecile', 'BATCH-4727', '$2y$12$n.4dsNCQvOunuv0itkxpb.yXQr7XjjuCDhkXLVoVkmTG79xsKdWXu', NULL, '2025-09-07 10:20:31', '2025-09-07 10:20:31'),
(6, 'qosinski', 1, 'garland23@example.org', NULL, '405.624.2902', 'Murphychester', 'BATCH-5893', '$2y$12$6LQVLZFzxACY8RPAyo.uJ.5J7uXu8gP9BrlB8ZY7ZGsNQn5PfwEPi', NULL, '2025-09-07 10:20:31', '2025-09-07 10:20:31'),
(7, 'kathlyn.gislason', 1, 'larkin.ceasar@example.net', NULL, '(380) 203-7086', 'West Isomberg', 'BATCH-5780', '$2y$12$OHzQ3fZH2J4.16AyxVWUmumCKsXxSGaSjdfQkdqIyaUe1wWRNFBn2', NULL, '2025-09-07 10:20:31', '2025-09-07 10:20:31'),
(8, 'fay10', 1, 'cole.dion@example.com', NULL, '517.731.1749', 'South Eribertobury', 'BATCH-4574', '$2y$12$SB0D8nbx6r0Yyn7OtEDJ5uwGZ0A/A2sWZ/1Iz4F/o2t10sDAmtBUS', NULL, '2025-09-07 10:20:31', '2025-09-07 10:20:31'),
(9, 'ppagac', 1, 'qhowell@example.net', NULL, '1-689-450-8636', 'South Anais', 'BATCH-9673', '$2y$12$W211tJa2Q84RwsO6ufo9JOzXd3GAv17t.e7jJlp7pKi3/tyOsoZse', NULL, '2025-09-07 10:20:31', '2025-09-07 10:20:31'),
(10, 'demario94', 1, 'padberg.wilber@example.com', NULL, '602.772.6711', 'Batzberg', 'BATCH-4885', '$2y$12$eoL8wdfbdccsaC.eYQdy9.qhi0dwLFKk98a35A7VWjaZn8KwQ0G0u', NULL, '2025-09-07 10:20:31', '2025-09-07 10:20:31'),
(11, 'ee', 1, 'sdf@yahoo.com', NULL, '3243', 'USA-New York-Buffalo', NULL, '$2y$12$ULYduJLKiwEK8SUrUK.1Te2OdMkZFcXHogID9w3m/ReTOLpfOeK6G', 'TEzXRAIRhOq29c1woWyrNh4QdCofWBUDLoH5gvRWkTYGlFJ7hqcKNGEC27dR', '2025-09-07 10:20:52', '2025-09-07 10:20:52');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
