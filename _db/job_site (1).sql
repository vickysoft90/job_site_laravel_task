-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 12:27 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_location`
--

CREATE TABLE `job_location` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_location`
--

INSERT INTO `job_location` (`id`, `location`, `created_at`, `updated_at`) VALUES
(1, 'Chennai', '2024-03-04 05:48:38', '2024-03-04 05:48:38'),
(2, 'Bangalore', '2024-03-04 05:48:38', '2024-03-04 05:48:38'),
(3, 'Cuddalore', '2024-03-04 05:48:38', '2024-03-04 05:48:38'),
(4, 'Coimbatore', '2024-03-04 05:48:38', '2024-03-04 05:48:38'),
(5, 'Goa', '2024-03-04 05:48:38', '2024-03-04 05:48:38'),
(6, 'Pune', '2024-03-04 05:48:38', '2024-03-04 05:48:38'),
(7, 'Noida', '2024-03-04 05:48:38', '2024-03-04 05:48:38'),
(8, 'Vadalore', '2024-03-04 05:48:38', '2024-03-04 05:48:38'),
(9, 'Singanallure', '2024-03-04 05:48:38', '2024-03-04 05:48:38');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2024_03_04_102037_create_job_location_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(1) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `skill` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `notice` int(11) DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `location_id`, `skill`, `phone`, `experience`, `notice`, `picture`, `resume`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 1, NULL, '$2y$10$Y4BFQ7c8Pb1PbFMdmoCJ/erTRdNKKBL512pdA/vlIEKuHezks.gOi', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-04 05:48:38', '2024-03-04 05:48:38', NULL),
(2, 'user', 'user@gmail.com', 2, NULL, '$2y$10$Y4BFQ7c8Pb1PbFMdmoCJ/erTRdNKKBL512pdA/vlIEKuHezks.gOi', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-04 05:48:38', '2024-03-04 05:48:38', NULL),
(3, 'Dashawn Kuhic DDS', 'doyle.kathryn@example.org', 2, NULL, '$2y$10$Y4BFQ7c8Pb1PbFMdmoCJ/erTRdNKKBL512pdA/vlIEKuHezks.gOi', 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-04 05:48:38', '2024-03-04 05:48:38', NULL),
(4, 'Dr. Lyla Powlowski IV', 'nella24@example.org', 2, NULL, '$2y$10$Y4BFQ7c8Pb1PbFMdmoCJ/erTRdNKKBL512pdA/vlIEKuHezks.gOi', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-04 05:48:38', '2024-03-04 05:48:38', NULL),
(5, 'Rocky Batz', 'urunolfsdottir@example.com', 2, NULL, '$2y$10$Y4BFQ7c8Pb1PbFMdmoCJ/erTRdNKKBL512pdA/vlIEKuHezks.gOi', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-04 05:48:38', '2024-03-04 05:48:38', NULL),
(6, 'Shanel Raynor V', 'allene43@example.org', 2, NULL, '$2y$10$Y4BFQ7c8Pb1PbFMdmoCJ/erTRdNKKBL512pdA/vlIEKuHezks.gOi', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-04 05:48:38', '2024-03-04 05:48:38', NULL),
(7, 'vignesh', 'vickysoft.1990@gmail.com', 2, NULL, '$2y$10$ePQGQ79TMCMuca8D2c3kb.qGERzOUZu2x5Qz86UG8Xhxz6cdufXoC', 1, NULL, NULL, NULL, NULL, 'UIMG_2024030465e5ae81d0fc8.jpg', 'UIMG_2024030465e5ae94c09e2.pdf', NULL, '2024-03-04 05:49:26', '2024-03-04 05:51:58', '2024-03-04 05:51:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `job_location`
--
ALTER TABLE `job_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_location`
--
ALTER TABLE `job_location`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
