-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2026 at 02:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codehouse_reg`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `author` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `category`, `content`, `image`, `created_at`, `author`) VALUES
(9, 'خلي الشعب يدرسم ', 'تطوير الويب', 'يدرس يدرس ', '1768635499', '2026-01-16 17:33:53', NULL),
(10, 'ما بش داعي لكليات الحاسوب في الجامعات بعد الان ', 'أساسيات الحاسوب', 'خطط دراسية وكورسات تطلع اقوى مبرمج ', '1768641311', '2026-01-16 17:34:53', NULL),
(11, 'مشاريع تطبيقية تساهم في فهم الهيكل البرمجي والمنطق', 'تطوير تطبيقات الهاتف', 'ادرس معنا وطبق كمان ', '1768581473_1750a58318f0f48b03b5d3722f325120.jpg', '2026-01-16 19:37:53', NULL),
(12, 'DDD', 'تطوير الويب', 'DDD', '1768598717', '2026-01-17 00:23:55', NULL),
(13, 'XX', '', 'XX', '1768598703_1750a58318f0f48b03b5d3722f325120.jpg', '2026-01-17 00:25:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`) VALUES
(1, 'ibrahim', 'alnowirah', 'i.nowirah@gmail.com', '$2y$10$IhS9.tl5zGuw8Pl4x2MpzeOOkDRfGo7cnoNCoG9km3HVPcR.qtZwC', '2026-01-16 13:22:34'),
(2, 'akrm', 'almespahy', 'akrm@gmail.com', '$2y$10$tgZAmOgjp0ClvEIN6EK0h.6iZ3M/WgjsH.tqSISlh8sieqQ1S3idW', '2026-01-16 13:22:34'),
(3, 'eyad', 'alwadey', 'eyad@gamil.com', '$2y$10$ZjqNWyDL8LkL2Fn/VYOylut9M7HMA4vMnjP.0tIVj5cslENPjfpV2', '2026-01-16 13:22:34'),
(4, 'osamah', 'aljapopy', 'osamah@gmail.com', '$2y$10$3Nk6a.bCED5HEEM0zEM.0eGbemBhGonKpD72Y8TOUMn4K/AvK7Wi2', '2026-01-16 13:22:34'),
(5, 'ahmed', 'almekhlafy', 'yiminic987@kwifa.com', '$2y$10$z51d39t2Nexleo0CdIFY9efPyUi6x9TgGpinEL8kVbxKvNlZzZGVC', '2026-01-16 13:22:34'),
(6, 'ibrahim', 'alwadey', 'oxaamgbpn4656@oxaam.com', '$2y$10$s4wFVsaEA82wnD7Cjk4CneoMmTZXsPeY8iLtZrg5goeRZd.fLfFq2', '2026-01-16 13:22:34'),
(8, 'hamood', 'alsamay', 'ssssssss@gamil.com', '$2y$10$DOrYrmrO9Mc8W50d4caZ6OW/g1E4VpCGmNFmQZm1k3YMQcxnY9ShO', '2026-01-16 13:22:34'),
(9, 'osamah', 'alrajehy', 'oasamah123@gamil.com', '$2y$10$CaJ.7zyDoScv1tN8431WIuaPsyLD9kMo/OyZobNoYKpD8BsIQcAKu', '2026-01-16 13:22:34'),
(11, 'emad', 'alazazy', 'alazazy@gmail.com', '$2y$10$fzXX.lA5u1ZdGfZQe2HJvOM3VNF.lyDyZVo5Zo4Kev13sA1tIdLcK', '2026-01-16 19:03:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
