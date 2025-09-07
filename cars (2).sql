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
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `car_id` bigint NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `available_as` int NOT NULL DEFAULT '0',
  `sell_number` int NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `engine` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horsepower` int DEFAULT NULL,
  `torque` int DEFAULT NULL,
  `main_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_images` json DEFAULT NULL,
  `discription` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `car_id`, `name`, `available_as`, `sell_number`, `price`, `engine`, `horsepower`, `torque`, `main_image`, `gallery_images`, `discription`, `created_at`, `updated_at`) VALUES
(1, 170611, 'Bayer, Goodwin and Collier', 6, 0, 41954.00, 'ENG-3990', 164, 300, 'https://via.placeholder.com/640x480.png/002277?text=transport+ullam', '[\"https://via.placeholder.com/640x480.png/007733?text=transport+ipsa\", \"https://via.placeholder.com/640x480.png/00ff00?text=transport+culpa\", \"https://via.placeholder.com/640x480.png/0000ff?text=transport+dolorum\"]', 'Nam culpa dolorem ea aliquid. Officia eum quia aut dignissimos aspernatur aut. Nihil non perferendis voluptatem non et.', '2025-09-07 10:20:31', '2025-09-07 10:20:32'),
(2, 822072, 'Yundt-Schimmel', 6, 0, 22629.00, 'ENG-1138', 168, 488, 'https://via.placeholder.com/640x480.png/006688?text=transport+vero', '[\"https://via.placeholder.com/640x480.png/007722?text=transport+quidem\", \"https://via.placeholder.com/640x480.png/000055?text=transport+rem\", \"https://via.placeholder.com/640x480.png/0044cc?text=transport+fuga\"]', 'Et non enim numquam reiciendis. Qui dolores fugiat vero unde. Ea exercitationem tempora dolor.', '2025-09-07 10:20:31', '2025-09-07 10:20:32'),
(3, 1966, 'Hintz Inc', 5, 1, 89805.00, 'ENG-6193', 112, 207, 'https://via.placeholder.com/640x480.png/001144?text=transport+repudiandae', '[\"https://via.placeholder.com/640x480.png/008822?text=transport+ipsum\", \"https://via.placeholder.com/640x480.png/0022cc?text=transport+nisi\", \"https://via.placeholder.com/640x480.png/002233?text=transport+veritatis\"]', 'In eveniet sit ut cumque aspernatur consequuntur. Cupiditate est quod est accusamus pariatur. Veniam ut velit aut porro. Nam dignissimos sit excepturi autem et est non.', '2025-09-07 10:20:31', '2025-09-07 10:20:32'),
(4, 36409, 'Spencer Group', 6, 0, 62182.00, 'ENG-6653', 209, 441, 'https://via.placeholder.com/640x480.png/000000?text=transport+aspernatur', '[\"https://via.placeholder.com/640x480.png/0077ff?text=transport+sequi\", \"https://via.placeholder.com/640x480.png/00dddd?text=transport+quisquam\", \"https://via.placeholder.com/640x480.png/00ccaa?text=transport+ut\"]', 'Dignissimos qui in dolorum vitae eum. Nostrum ut ipsum atque molestias est. Tempore eligendi quam in culpa. Ut nesciunt nobis molestiae veritatis reprehenderit qui consectetur.', '2025-09-07 10:20:31', '2025-09-07 10:20:32'),
(5, 77164, 'Haag LLC', 6, 0, 47011.00, 'ENG-8231', 274, 183, 'https://via.placeholder.com/640x480.png/007777?text=transport+qui', '[\"https://via.placeholder.com/640x480.png/00ccbb?text=transport+reprehenderit\", \"https://via.placeholder.com/640x480.png/00ffbb?text=transport+sunt\", \"https://via.placeholder.com/640x480.png/0000cc?text=transport+quasi\"]', 'Perferendis omnis at dolore est. Quaerat aut exercitationem magni deserunt ut id dignissimos. Facere magni fugit est sint at omnis doloremque quos. Molestiae et illum delectus aliquam voluptatem.', '2025-09-07 10:20:31', '2025-09-07 10:20:32'),
(6, 52046, 'Cruickshank-Ledner', 6, 0, 6803.00, 'ENG-4305', 91, 278, 'https://via.placeholder.com/640x480.png/002288?text=transport+eos', '[\"https://via.placeholder.com/640x480.png/004488?text=transport+veniam\", \"https://via.placeholder.com/640x480.png/00aa66?text=transport+expedita\", \"https://via.placeholder.com/640x480.png/0099dd?text=transport+quia\"]', 'Quae in autem mollitia deserunt reiciendis. Et consequatur rerum voluptatum quia et voluptas. Magnam nemo explicabo laboriosam nostrum. Et sapiente sapiente recusandae.', '2025-09-07 10:20:31', '2025-09-07 10:20:32'),
(7, 675779, 'Wehner-Wilderman', 6, 0, 77355.00, 'ENG-1572', 145, 467, 'https://via.placeholder.com/640x480.png/00ee77?text=transport+iusto', '[\"https://via.placeholder.com/640x480.png/0033aa?text=transport+aut\", \"https://via.placeholder.com/640x480.png/001111?text=transport+voluptas\", \"https://via.placeholder.com/640x480.png/006633?text=transport+eius\"]', 'Mollitia quia qui assumenda alias qui. Perspiciatis vel facere dolor quos dolorum. Animi architecto similique quisquam dolor eum.', '2025-09-07 10:20:31', '2025-09-07 10:20:32'),
(8, 835616, 'Bradtke PLC', 6, 0, 58631.00, 'ENG-7765', 86, 372, 'https://via.placeholder.com/640x480.png/00aaee?text=transport+omnis', '[\"https://via.placeholder.com/640x480.png/00aa55?text=transport+in\", \"https://via.placeholder.com/640x480.png/00aa00?text=transport+dolores\", \"https://via.placeholder.com/640x480.png/00ee55?text=transport+soluta\"]', 'Ratione maiores soluta ea veritatis et eos. Iusto unde fuga nesciunt illum culpa eius et. Aut voluptatem sunt ullam.', '2025-09-07 10:20:31', '2025-09-07 10:20:32'),
(9, 63085, 'McClure Group', 6, 0, 28337.00, 'ENG-9491', 112, 496, 'https://via.placeholder.com/640x480.png/001100?text=transport+quam', '[\"https://via.placeholder.com/640x480.png/009977?text=transport+soluta\", \"https://via.placeholder.com/640x480.png/0066dd?text=transport+pariatur\", \"https://via.placeholder.com/640x480.png/002222?text=transport+blanditiis\"]', 'Sint aliquid et porro. Maxime officia dolores ullam porro asperiores. Unde sequi ea qui sed.', '2025-09-07 10:20:31', '2025-09-07 10:20:32'),
(10, 778137, 'Lubowitz-Armstrong', 6, 0, 27042.00, 'ENG-7763', 346, 485, 'https://via.placeholder.com/640x480.png/0077bb?text=transport+sed', '[\"https://via.placeholder.com/640x480.png/002222?text=transport+sit\", \"https://via.placeholder.com/640x480.png/00cc44?text=transport+et\", \"https://via.placeholder.com/640x480.png/00bb00?text=transport+cum\"]', 'Aspernatur omnis nam eum est maiores expedita inventore. Earum qui officia enim est. Occaecati qui expedita quo cum velit quia.', '2025-09-07 10:20:31', '2025-09-07 10:20:32'),
(11, 305062, 'Hudson-Abbott', 6, 0, 92267.00, 'ENG-7548', 109, 442, 'https://via.placeholder.com/640x480.png/009966?text=transport+expedita', '[\"https://via.placeholder.com/640x480.png/003333?text=transport+dolorem\", \"https://via.placeholder.com/640x480.png/00bbff?text=transport+tenetur\", \"https://via.placeholder.com/640x480.png/007788?text=transport+nostrum\"]', 'Excepturi cumque dolores laborum ut placeat magni aut. Praesentium vel ratione aliquam unde sed voluptatem. Necessitatibus omnis et eos.', '2025-09-07 10:20:31', '2025-09-07 10:20:32'),
(12, 844223, 'Wyman and Sons', 6, 0, 80290.00, 'ENG-8376', 73, 208, 'https://via.placeholder.com/640x480.png/00aa44?text=transport+aut', '[\"https://via.placeholder.com/640x480.png/003311?text=transport+quo\", \"https://via.placeholder.com/640x480.png/003333?text=transport+magni\", \"https://via.placeholder.com/640x480.png/00aa00?text=transport+eos\"]', 'Quidem enim qui quas praesentium laudantium nihil sit. Aut voluptas consectetur aut consectetur pariatur consequatur eligendi quia. Quod est dolore nihil sit facilis eum tempore. Odio quas adipisci impedit eius assumenda omnis.', '2025-09-07 10:20:31', '2025-09-07 10:20:32'),
(13, 728314, 'Huels-Durgan', 6, 0, 35999.00, 'ENG-7395', 139, 346, 'https://via.placeholder.com/640x480.png/00ffee?text=transport+laudantium', '[\"https://via.placeholder.com/640x480.png/0033dd?text=transport+aliquid\", \"https://via.placeholder.com/640x480.png/009977?text=transport+accusamus\", \"https://via.placeholder.com/640x480.png/007700?text=transport+hic\"]', 'Ut ab vitae ut aut rerum aut. Vitae rem sed voluptatem ab unde expedita. Laudantium exercitationem corrupti est culpa iure est. Qui iste qui dolorum eius ipsam commodi asperiores omnis.', '2025-09-07 10:20:31', '2025-09-07 10:20:32'),
(14, 914314, 'Glover, Auer and Schuster', 6, 0, 61467.00, 'ENG-6944', 262, 327, 'https://via.placeholder.com/640x480.png/008899?text=transport+magnam', '[\"https://via.placeholder.com/640x480.png/0022cc?text=transport+libero\", \"https://via.placeholder.com/640x480.png/0088ee?text=transport+laudantium\", \"https://via.placeholder.com/640x480.png/00bb99?text=transport+accusantium\"]', 'Voluptas ducimus magnam quia. Et aut rerum veritatis aperiam eos. Nulla asperiores quasi qui omnis vel consequatur. Voluptatem ut ut ut consequatur explicabo. Dolor qui non dicta asperiores molestiae.', '2025-09-07 10:20:31', '2025-09-07 10:20:32'),
(15, 546471, 'Abbott, Mayert and Fadel', 6, 0, 18706.00, 'ENG-7222', 284, 215, 'https://via.placeholder.com/640x480.png/006600?text=transport+quisquam', '[\"https://via.placeholder.com/640x480.png/00cc22?text=transport+sed\", \"https://via.placeholder.com/640x480.png/00aabb?text=transport+vel\", \"https://via.placeholder.com/640x480.png/001166?text=transport+mollitia\"]', 'Amet possimus ut cupiditate corporis qui. In nihil sunt temporibus corrupti. Et laboriosam in omnis magni.', '2025-09-07 10:20:32', '2025-09-07 10:20:32');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
