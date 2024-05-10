-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: fdb1029.awardspace.net
-- Generation Time: Aug 11, 2023 at 08:40 PM
-- Server version: 8.0.32
-- PHP Version: 8.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4316951_egyhealth`
--

-- --------------------------------------------------------

--
-- Table structure for table `clincals`
--

CREATE TABLE `clincals` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hospital_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clincals`
--

INSERT INTO `clincals` (`id`, `name`, `hospital_id`, `created_at`, `updated_at`) VALUES
(3, 'جراحة', 2, NULL, NULL),
(4, 'باطنة', 2, NULL, NULL),
(5, 'اسنان', 1, NULL, NULL),
(6, 'اسنان', 2, NULL, NULL),
(7, 'عيون', 1, NULL, NULL),
(8, 'عيون', 2, NULL, NULL),
(11, 'باطنة', 1, '2023-05-19 06:59:18', '2023-05-19 06:59:18'),
(12, 'جراحة', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` int DEFAULT NULL,
  `specialty` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hospital_id` int NOT NULL,
  `clincal_id` int NOT NULL,
  `presence_days` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `national_id` bigint DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `phone`, `specialty`, `hospital_id`, `clincal_id`, `presence_days`, `remember_token`, `national_id`, `password`, `image`, `created_at`, `updated_at`) VALUES
(2, 'ahmed ali', 1125268883, 'باطنة', 1, 11, 'Sunday, Monday', NULL, 3011, '2564659', NULL, '2023-02-16 14:38:01', '2023-02-16 14:38:01'),
(3, 'omar khaled', 1125268883, 'اسنان', 1, 5, 'Saturday', NULL, 3013, '$2y$10$Vp476.UmiCBPUS.8MbvJyOfVkaZAh.LlLem5LZHQjj1Phmu0tYDDq', NULL, '2023-02-21 09:06:38', '2023-02-21 09:06:38'),
(8, 'mohamed khaled', 1125268883, 'عيون', 1, 7, 'Wednesday', NULL, 3017, '$2y$10$9w6PhuIsJXHu.MPjobnR9umL/78JGR3PPZFPJs7lXh18UlyUl9jNa', NULL, '2023-03-06 11:04:50', '2023-03-06 11:04:50'),
(9, 'Omar mahmoud', 1123642142, 'جراحة', 1, 11, 'Tuesday, Thursday, Friday', NULL, 30126541253221, '$2y$10$d/.pWck3oNdk1yBC.mdFX.mV6hK.7obVGJAaggbxqY0x717ZGcPB6', NULL, '2023-04-14 11:20:07', '2023-04-14 11:20:07'),
(10, 'tarek adel', 1095827563, 'اسنان', 1, 5, 'Tuesday, Sunday', NULL, 30103654216514, '$2y$10$tWjnNP6DK4REG.M3Wr6jg.f2JEI0OZZlbp3eZjo3OMQSHLD5QYAde', '', '2023-05-19 10:00:55', '2023-05-19 10:00:55'),
(11, 'Ahmed khaled', 1125268883, 'جراحة', 1, 12, 'wednesday', NULL, 12345678912121, '$2y$10$sErJRHgF41YUTadBTxaYX.OS5LW/lv59Aw2Uyl03JjBbqkGLQ43W6', '', '2023-07-06 12:04:24', '2023-07-06 12:04:24'),
(15, 'Ahmed khaled22', NULL, 'جراحة', 1, 12, 'wednesday', NULL, NULL, '$2y$10$ARjipWTeAJk8IHU7LLt5COruYoV8habwQYfwrZ2lCDw5pnfsz6cCm', '', '2023-07-06 13:13:15', '2023-07-06 13:13:15'),
(20, 'ali', NULL, 'جراحة', 1, 12, 'wednesday', NULL, NULL, '$2y$10$EI9B2LDeLmhjHX7Uf1X3BOqk9X3nzKSe99VorTMuaTVKUa30t9t/u', '', '2023-07-06 13:48:41', '2023-07-06 13:48:41'),
(21, 'ahmed mohamed', NULL, 'اسنان', 1, 5, 'wednesday , sunday', NULL, NULL, '$2y$10$UaVz3x637WIw95RvGY2iB.ZjTEvE6FfqnSjINd8cXvhXVPpjYPMDG', '', '2023-07-12 07:44:36', '2023-07-12 07:44:36'),
(22, 'khaled', NULL, 'اسنان', 1, 5, 'wensday', NULL, NULL, '$2y$10$pkPc9Mys2Hc0C/pV.sPeyeaySAkNfsF2JVZfqVnU/JsU3zYTXgDUK', '', '2023-07-12 07:45:40', '2023-07-12 07:45:40'),
(23, 'ahmed', NULL, 'اسنان', 1, 5, 'الحد', NULL, NULL, '$2y$10$8H9ti6jmGFuuhbDbabbtJuUmJzPiTke7LwFM8dW9JcJxosqGdU3G6', '', '2023-08-07 15:10:52', '2023-08-07 15:10:52'),
(24, 'meshoo', NULL, 'جراحة', 1, 12, 'had', NULL, NULL, '$2y$10$n0x90yfxyUJBeXyIfB068e8DBMBIJ66AZl7PBvP32gRtz9K7K033y', '', '2023-08-07 16:18:45', '2023-08-07 16:18:45'),
(25, 'amr', NULL, 'جراحة', 1, 12, 'sasd', NULL, NULL, '$2y$10$28agYV8l4UoQ6l/EfPRAleNKjVifFBdidLj096GUl362hpBxDpVb6', '', '2023-08-08 18:01:23', '2023-08-08 18:01:23'),
(26, 'farag', NULL, 'جراحة', 1, 12, 'sat,sun,mon', NULL, NULL, '$2y$10$mLuaruzuraAgZuo7VQNR0OSrI.mVYW08leCp3S99WPF6Ye68WQIF2', '', '2023-08-11 14:16:28', '2023-08-11 14:16:28'),
(27, 'khaled', NULL, 'عيون', 1, 7, 'الحد و الاربع', NULL, NULL, '$2y$10$V4P9TcPmwSxwXI2F4hyyXuczttKGGppLlnTqDyJgpndg8Cg2iacbu', '', '2023-08-11 17:20:02', '2023-08-11 17:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_cases`
--

CREATE TABLE `emergency_cases` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `hospital_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_cases`
--

INSERT INTO `emergency_cases` (`id`, `user_id`, `hospital_id`, `created_at`, `updated_at`) VALUES
(2, 7, 1, '2023-03-06 10:18:08', '2023-03-06 10:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `rooms` int NOT NULL,
  `intensive_care` int NOT NULL,
  `quarantine_rooms` int NOT NULL,
  `emergency_days` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `clincals` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `address`, `rooms`, `intensive_care`, `quarantine_rooms`, `emergency_days`, `city`, `clincals`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'hehia hospital', 'hehia', 12, 6, 5, 'Monday - Sunday', 'Hehia', '3', '$2y$10$Xy2iNAABO9qkle8MScqwPeLQk6x/vYNjan2pUiu.A9jrTLgbtin1e', NULL, '2023-02-13 18:37:35', '2023-02-13 18:37:35'),
(2, 'zagazig hospital', 'Zagazig', 6, 3, 4, 'Wednesday', 'Zagazig', '', '1231313', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('tarekkhater103@gmail.com', '$2y$10$wdHWwnXBNrA06LRTL2Eo5OfECBtCqKbR2Hp69dKhPCN2eRl7/YIke', '2023-02-23 12:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `patient_histories`
--

CREATE TABLE `patient_histories` (
  `id` int NOT NULL,
  `national_id` bigint NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `phone` int NOT NULL,
  `chronic_disease` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gentic_disease` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `blood_type` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `disease_senstivity` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `medicine` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `surgey` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_histories`
--

INSERT INTO `patient_histories` (`id`, `national_id`, `full_name`, `user_id`, `phone`, `chronic_disease`, `gentic_disease`, `blood_type`, `disease_senstivity`, `medicine`, `surgey`, `created_at`, `updated_at`) VALUES
(1, 3010312456984, 'احمد عمر', 1, 1125268883, 'السكر', NULL, 'A', NULL, NULL, NULL, NULL, NULL),
(2, 3210126457983, 'عمر سعيد', 5, 123456988, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 30126897456532, 'طارق محمد السيد سيداحمد', 2, 1135642144, NULL, NULL, 'B', NULL, NULL, NULL, NULL, '2023-05-16 08:34:48'),
(4, 30236597413216, 'محمد خالد', 4, 0, NULL, NULL, 'O', NULL, NULL, NULL, NULL, NULL),
(9, 3010312456974, 'احمد عمر', 3, 1125264883, 'السكر', NULL, 'A', NULL, NULL, NULL, NULL, NULL),
(10, 3210126579823, 'عمر سعيد', 6, 123456988, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 301031689754, 'مازن علي عمر السيد خالد', 7, 1125268972, 'السكر', NULL, 'A', NULL, 'pandol', NULL, '2023-03-06 10:25:33', '2023-03-06 10:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 4, 'MySecret', 'd69c8221ae1856732f3f8bcc33de60b131275c9d0bc55d36cb4e12cb9a38ba5c', '[\"*\"]', NULL, NULL, '2023-02-20 17:14:50', '2023-02-20 17:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `doctor_id` int NOT NULL,
  `medicine` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `problem` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `user_id`, `doctor_id`, `medicine`, `problem`, `image`, `created_at`, `updated_at`) VALUES
(21, 7, 3, 'pandol', 'headache', '1678119403.jpg', '2023-03-06 14:16:43', '2023-03-06 14:16:43'),
(22, 2, 3, 'pandol', 'headache', NULL, '2023-03-06 14:18:47', '2023-03-06 14:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `doctor_id` int DEFAULT NULL,
  `hospital_id` int NOT NULL,
  `room_id` int DEFAULT NULL,
  `clincal_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'In progress',
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `national_id` bigint DEFAULT NULL,
  `phone` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `doctor_id`, `hospital_id`, `room_id`, `clincal_id`, `date`, `status`, `name`, `national_id`, `phone`, `created_at`, `updated_at`) VALUES
(15, 1, 3, 1, 1, NULL, '2023-03-03', 'rejected', NULL, NULL, NULL, '2023-03-04 07:29:26', '2023-03-04 17:16:20'),
(21, 1, 2, 1, 2, NULL, '2023-03-04', 'canceled', NULL, NULL, NULL, '2023-03-04 10:42:44', '2023-03-04 17:24:47'),
(23, 1, 3, 1, 1, NULL, '2023-03-04', 'rejected', NULL, NULL, NULL, '2023-03-05 07:14:59', '2023-03-05 07:17:36'),
(31, 7, 3, 1, 2, NULL, '2023-03-06', 'done', NULL, NULL, NULL, '2023-03-06 13:17:51', '2023-03-06 14:16:43'),
(32, 7, 3, 1, 2, NULL, '2023-03-06', 'done', NULL, NULL, NULL, '2023-03-26 09:09:19', '2023-03-27 13:34:30'),
(33, 7, 3, 1, 1, NULL, '2023-04-09', 'done', NULL, NULL, NULL, '2023-03-27 13:39:53', '2023-03-27 16:19:39'),
(34, 7, 3, 1, 1, NULL, '2023-04-09', 'done', NULL, NULL, NULL, '2023-03-27 16:45:20', '2023-03-27 23:02:20'),
(35, 7, 3, 1, 1, NULL, '2023-04-09', 'done', NULL, NULL, NULL, '2023-03-28 10:22:57', '2023-03-28 11:18:27'),
(36, 7, 3, 1, 1, NULL, '2023-04-09', 'done', NULL, NULL, NULL, '2023-03-28 11:21:35', '2023-03-28 11:22:33'),
(37, 7, 3, 1, 1, NULL, '2023-04-09', 'done', NULL, NULL, NULL, '2023-03-28 11:26:00', '2023-03-28 11:27:44'),
(38, 7, 3, 1, 1, NULL, '2023-04-09', 'done', NULL, NULL, NULL, '2023-03-28 11:28:00', '2023-03-28 11:30:31'),
(39, 7, 3, 1, 1, NULL, '2023-04-09', 'canceled', NULL, NULL, NULL, '2023-03-28 13:10:11', '2023-05-07 03:20:56'),
(40, 7, 3, 1, 1, NULL, '2023-04-09', 'done', NULL, NULL, NULL, '2023-03-28 13:15:35', '2023-03-28 15:18:22'),
(41, 7, 3, 1, 1, NULL, '2023-04-09', 'done', NULL, NULL, NULL, '2023-03-28 15:25:15', '2023-03-28 15:36:50'),
(42, 7, 3, 1, 1, NULL, '2023-04-09', 'rejected', NULL, NULL, NULL, '2023-03-28 15:38:32', '2023-03-28 15:40:43'),
(43, 1, 3, 1, 1, NULL, '2023-04-09', 'done', NULL, NULL, NULL, '2023-03-29 10:33:03', '2023-03-29 10:34:58'),
(47, 7, 3, 1, 1, NULL, '2023-04-21', 'rejected', NULL, NULL, NULL, '2023-04-16 23:52:33', '2023-04-16 23:53:53'),
(62, 7, NULL, 1, NULL, 7, '2023-05-21', 'canceled', NULL, NULL, NULL, '2023-05-07 04:12:20', '2023-05-07 04:12:20'),
(63, 7, NULL, 1, NULL, 7, '2023-05-21', 'done', NULL, NULL, NULL, '2023-05-07 05:27:05', '2023-05-08 09:18:31'),
(64, 7, NULL, 1, NULL, 7, '2023-05-08', 'rejected', NULL, NULL, NULL, '2023-05-08 09:20:13', '2023-05-08 09:36:11'),
(65, 7, NULL, 1, NULL, 7, '2023-05-08', 'done', NULL, NULL, NULL, '2023-05-08 09:36:22', '2023-05-08 10:13:55'),
(67, NULL, NULL, 1, NULL, 5, '2023-05-09', 'done', NULL, NULL, NULL, '2023-05-09 09:04:08', '2023-05-09 09:04:08'),
(68, NULL, NULL, 1, NULL, 5, '2023-05-09', 'done', NULL, NULL, NULL, '2023-05-09 09:04:46', '2023-05-09 09:04:46'),
(69, NULL, NULL, 1, NULL, 5, '2023-05-09', 'canceled', NULL, NULL, NULL, '2023-05-09 09:05:24', '2023-05-09 09:05:24'),
(70, NULL, NULL, 1, NULL, 5, '2023-05-09', 'done', NULL, NULL, NULL, '2023-05-09 09:10:37', '2023-05-09 09:10:37'),
(71, NULL, NULL, 1, NULL, 5, '2023-05-10', 'done', NULL, NULL, NULL, '2023-05-09 09:15:57', '2023-05-09 09:15:57'),
(72, NULL, NULL, 1, NULL, 7, '2023-05-09', 'done', NULL, NULL, NULL, '2023-05-09 09:17:39', '2023-05-09 09:17:39'),
(118, 2, NULL, 1, NULL, 12, '2024-05-11', 'done', NULL, NULL, NULL, '2023-07-04 14:10:19', '2023-07-04 14:10:19'),
(135, 2, NULL, 1, NULL, 12, '2024-05-11', 'done', NULL, NULL, NULL, '2023-08-08 08:20:22', '2023-08-08 08:20:22'),
(136, 33, NULL, 1, NULL, 3, '2025-05-12', 'rejected', NULL, NULL, NULL, NULL, NULL),
(137, 33, NULL, 1, NULL, 5, '2025-05-12', 'done', NULL, NULL, NULL, NULL, NULL),
(138, 33, NULL, 1, NULL, NULL, '2025-05-12', 'done', NULL, NULL, NULL, NULL, NULL),
(139, 2, NULL, 1, NULL, 12, '2024-05-11', 'done', NULL, NULL, NULL, '2023-08-11 11:33:05', '2023-08-11 11:43:04'),
(140, 2, NULL, 1, NULL, 12, '2024-05-11', 'done', NULL, NULL, NULL, '2023-08-11 11:43:51', '2023-08-11 11:43:51'),
(141, 33, NULL, 1, NULL, 12, '2023-09-19', 'rejected', NULL, NULL, NULL, '2023-08-11 14:14:06', '2023-08-11 14:15:31'),
(142, 38, NULL, 1, NULL, 12, '2023-08-31', 'done', NULL, NULL, NULL, '2023-08-11 14:25:47', '2023-08-11 14:30:47');

-- --------------------------------------------------------

--
-- Table structure for table `reset_code_passwords`
--

CREATE TABLE `reset_code_passwords` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reset_code_passwords`
--

INSERT INTO `reset_code_passwords` (`id`, `email`, `code`, `created_at`, `updated_at`) VALUES
(16, 'tarekkhater103@gmail.com', '811125', '2023-02-24 14:56:18', '2023-02-24 14:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int NOT NULL,
  `number` int NOT NULL,
  `floor` int NOT NULL,
  `hospital_id` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '''available'',''unavailable''',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `number`, `floor`, `hospital_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 202, 2, 1, 1, NULL, '2023-04-19 00:07:24'),
(2, 206, 3, 1, 0, NULL, '2023-05-05 10:40:07'),
(3, 205, 2, 1, 1, '2023-04-03 00:21:44', '2023-04-03 00:21:44'),
(5, 200, 2, 1, 1, '2023-04-03 00:51:09', '2023-04-11 17:03:58'),
(6, 201, 6, 1, 1, '2023-04-03 00:58:12', '2023-04-11 17:04:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `image`, `created_at`, `updated_at`) VALUES
(1, 'tarek', 'tarekkhater103@gmail.com', NULL, '$2y$10$SzSBrg5P6EOBksid/MNFMuyXDsdXLtr3IrX7OeuhofKzCxJqrHilm', NULL, NULL, '2023-02-12 14:55:29', '2023-02-24 14:35:08'),
(2, 'tarekkhater1', 'tarekkhater1@gmail.com', NULL, '$2y$10$mIaRGZe2CDpP/CA2SitnQO7eNwMU9Kf2.5zPH1DcjC4JIloqDaVvG', NULL, NULL, '2023-02-20 17:06:58', '2023-02-20 17:06:58'),
(3, 'tarekkhater2', 'tarekkhater2@gmail.com', NULL, '$2y$10$NA9d6drax8G6IQCpDdxpR.3.HaXKij.3l2UtxCjySih3qmQ4u7mj6', NULL, NULL, '2023-02-20 17:09:14', '2023-02-20 17:09:14'),
(4, 'tarekkhater3', 'tarekkhater3@gmail.com', NULL, '$2y$10$Ubec8jZtFjRuUn13QZcxyeiCkznt9WK353oNC7iJJYD6jWdZae9Ea', NULL, NULL, '2023-02-20 17:14:49', '2023-02-20 17:14:49'),
(5, 'tarekkhater4', 'tarekkhater4@gmail.com', NULL, '$2y$10$yUNrDCncz/sBUyB1KBj7QeDW0ygCkUZ6g9W4BwIfybNudd7sNji/m', NULL, NULL, '2023-02-20 17:17:26', '2023-02-20 17:17:26'),
(6, 'tarekkhater5', 'tarekkhater5@gmail.com', NULL, '$2y$10$SjLI48ZpjmaQxVa7KeyI3eOWKGLlC6/s8/5bv1NHoOo/J1T4It4Hq', NULL, NULL, '2023-02-20 17:26:54', '2023-02-20 17:26:54'),
(7, 'Mazen', 'tarekkhater6@gmail.com', NULL, '$2y$10$wWwDMrCRIV5vPapapOdQke2xsmZcuIoVV6o3UcwxZuXZWlFyPVX2C', NULL, NULL, '2023-03-06 08:12:21', '2023-03-06 08:12:21'),
(8, 'adsa', 'tarekkhater212@gmail.com', NULL, '$2y$10$jdVAHiN50Pzg3002aP79AewpK6quh7tT78HytUXNbbIcbCSUxdemq', NULL, NULL, '2023-03-10 07:24:59', '2023-03-10 07:24:59'),
(9, 'dsda', 'tarekkhater10s3@gmail.com', NULL, '$2y$10$3aM9Bisovu7ExOeK8iXiMO3YcgnR50fdUqJq6y4ejuQbt3pkzFIDq', NULL, NULL, '2023-03-10 09:23:55', '2023-03-10 09:23:55'),
(10, 'dasd', 'tarekkhater1s@gmail.com', NULL, '$2y$10$IZa6.W0UG6Cl2ZO28tsA8.jPeIUcqmWsDZcmsR4FGMKNmF2s93feu', NULL, NULL, '2023-03-10 09:25:57', '2023-03-10 09:25:57'),
(11, 'sasa', 'tarekkhater10w3@gmail.com', NULL, '$2y$10$voD54BMhdqDVCxuCkW/C1O6fig6UCoFGfret6oLNHYmi1JsfeC66m', NULL, NULL, '2023-03-10 09:29:25', '2023-03-10 09:29:25'),
(12, 'dasdas', 'tarekkhater1sad@gmail.com', NULL, '$2y$10$5WinpuacOD0KXAyv8o3Vz.45xSbpkRYD0XCYZJ7zMv1vcDinlTSTq', NULL, NULL, '2023-03-10 09:30:37', '2023-03-10 09:30:37'),
(13, 'dasd', 'dasda@gmail.com', NULL, '$2y$10$iJfNNlmp.qpRxMhEgG6lhulXNKLuSh3St9l6SKo0dMA77Ec2Mb1JG', NULL, NULL, '2023-03-10 09:41:03', '2023-03-10 09:41:03'),
(14, 'dasd', 'tarekkhater1s03@gmail.com', NULL, '$2y$10$IoJUY6g6tI.7xWIFP6rYLOAY3nKh7CdUF3e8NhZlptAQ4QxKSaShi', NULL, NULL, '2023-03-10 11:54:18', '2023-03-10 11:54:18'),
(15, 'dsa', 'tarekkhater1sa03@gmail.com', NULL, '$2y$10$50Bi4atA9q8tmoy6/Q9MVOylPh4IJnB8cM.vkO6tpW0199/avb7ee', NULL, NULL, '2023-03-10 11:55:22', '2023-03-10 11:55:22'),
(16, 'dsad', 'tarekkhater1sa@gmail.com', NULL, '$2y$10$tBQFTJG2f8kFdA4j9au4lOlElcsB1S0YnZedwg7eNwxvg6g9BQhQ6', NULL, NULL, '2023-03-10 12:00:51', '2023-03-10 12:00:51'),
(17, 'sad', 'tarekkhater103sda@gmail.com', NULL, '$2y$10$r79hfMQTlrXDd.h7k9ouf.Ne6Cv5.OUpzQbrlq529TIoVzFB0JYei', NULL, NULL, '2023-03-10 13:26:14', '2023-03-10 13:26:14'),
(18, 'cxzc', 'tarekkhater103dasd@gmail.com', NULL, '$2y$10$iH7UiK0siwzsDfm7LykEQuKdGl.I3EVd5QTstwIqH1laB7Bt3up1.', NULL, NULL, '2023-03-10 13:29:21', '2023-03-10 13:29:21'),
(19, 'csads', 'tarekkhater10sdasd3@gmail.com', NULL, '$2y$10$ds3lH4WAPa8bW9dfnw8eluecmiiXJXNjTiyGCz8Du2wtA5P3WdwSq', NULL, NULL, '2023-03-10 13:31:47', '2023-03-10 13:31:47'),
(20, 'sad', 'tarekkhater1dasda03@gmail.com', NULL, '$2y$10$K4RAWdgJpBNNlq1/eRt/Ve7vX8Kv6U3t0QHAP4/D3LQOuXW52w5pi', NULL, NULL, '2023-03-10 13:37:01', '2023-03-10 13:37:01'),
(21, 'dasd', 'tarekkhater10eqw4@gmail.com', NULL, '$2y$10$rMKpKIuO0oGB2aY4N1LsmeSpo6irwL9oE8i.PmWw7y0DCqmNL0jze', NULL, NULL, '2023-03-10 13:38:14', '2023-03-10 13:38:14'),
(22, 'dsad', 'tarekkhater1eqwe@gmail.com', NULL, '$2y$10$uKSLjYleVBxL2.F35wT.COsaJPIBctCz.rwJtonzKaNmZc5ZsKSkW', NULL, NULL, '2023-03-10 13:39:31', '2023-03-10 13:39:31'),
(23, 'dasd', 'tarekkhater1das03@gmail.comd', NULL, '$2y$10$z/d7xWdV5fpi0OAsbNbInefixE04FPRcDE/gjmsna.2Nd0nNIVLWa', NULL, NULL, '2023-03-10 13:40:50', '2023-03-10 13:40:50'),
(24, 'mohamed', 'tarekkhater10das63@gmail.com', NULL, '$2y$10$6HBbTT1J4WRWORaVgOCr9exSaG6LGLR39lMhWP6Cm7ukcNbbyQeDi', NULL, NULL, '2023-03-11 08:16:02', '2023-03-11 08:16:02'),
(25, 'sad', 'tarekkhater1qwe@gmail.com', NULL, '$2y$10$4KdSgBZN8Ce/EKBsf8UD2.ti0VXtKyOtTCs1oZwNjEY6KyAvXkodK', NULL, NULL, '2023-03-11 08:19:43', '2023-03-11 08:19:43'),
(26, 'asd', 'mario_1036@yahoo.com', NULL, '$2y$10$0TBjzQFMDmOGO8hwsFuEjeuyczuqla56jAs.lQjfCS0P19Du7WdJa', NULL, NULL, '2023-03-11 08:39:10', '2023-03-11 08:39:10'),
(27, 'dsadas', 'mario_1036dasdass@yahoo.com', NULL, '$2y$10$pizaWVxe1pa3Qe2VMSZy4OalwqaRErAPyvew9KG8oBnJ3yvzO.w2W', NULL, NULL, '2023-03-11 08:40:52', '2023-03-11 08:40:52'),
(28, 'das', 'tarekkhater10eqwe3@gmail.com', NULL, '$2y$10$AHKUhKvnskgR9QhoxOEohePPxJ4/mLnYKg.9NqQSEmTi3g2qj.JWy', NULL, NULL, '2023-03-12 16:16:58', '2023-03-12 16:16:58'),
(29, 'ahmed', 'tarekkhater1asds1@gmail.com', NULL, '$2y$10$LKIjx7FQVpXTW3D2nDb1S.fkSsm8q5iwOddWV4zDociri/O3kAFwO', NULL, NULL, '2023-03-17 09:29:06', '2023-03-17 09:29:06'),
(30, 'tarek', 'tarek@gmail.com', NULL, '$2y$10$8TTkTUujP.xAgH0XRdLoVeym6v/qA.qMTIpyBBPj/uNKgWCHm0eKC', NULL, NULL, '2023-04-29 11:00:23', '2023-04-29 11:00:23'),
(31, 'tarek', 'tarekkhaterr@gmail.com', NULL, '$2y$10$hmNdCT8u0KRdf4k7E45xIeGiBZpr1xXNYm91PM7NCF3YnS2WVtiIq', NULL, NULL, '2023-04-29 11:00:49', '2023-04-29 11:00:49'),
(32, 'raouf', 'ar2@gmail.comsad', NULL, '$2y$10$v38DDBrTcKjtbAfFABu4ke3n8CsN5Fgm1psX8btAK10DmsA5RoWuu', NULL, NULL, '2023-06-18 06:29:05', '2023-06-18 06:29:05'),
(33, 'raouf', 'ar2@gmail.com', NULL, '$2y$10$smWLvpTKkQv7bam.eUVCPOaQvRINdAE4yzF3rxqgWcP9zZEXZ5NFq', NULL, NULL, '2023-06-18 06:29:26', '2023-06-18 06:29:26'),
(34, 'raouf', 'ar23@gmail.com', NULL, '$2y$10$P7WeQpGoltEAgQ04f2NpZu68yA01OyM2IQJ1Tpi37dJT1BBRVH2HK', NULL, NULL, '2023-06-18 07:33:04', '2023-06-18 07:33:04'),
(35, 'ar', 'ar55@gmail.com', NULL, '$2y$10$eXDb6xYz.GbRm1NUeSd7w.pr4rTNwSZnbJogA95fNTBQ.NXuSfvLy', NULL, NULL, '2023-06-18 08:17:47', '2023-06-18 08:17:47'),
(36, 'raouf1', 'ar232@gmail.com', NULL, '$2y$10$rrqJOjp5BemMF.6rEynIZ.08Rev6vL0O/PZBUZEs8vHzqLhWjmwLi', NULL, NULL, '2023-07-06 07:09:12', '2023-07-06 07:09:12'),
(37, 'ahmed', 'aa@gmail.com', NULL, '$2y$10$y9bnXqbxZ6LFxsQX8azjnOC4RIEhnbx/85JNvYLVtKaSXcrqZIJtm', NULL, NULL, '2023-08-10 12:02:42', '2023-08-10 12:02:42'),
(38, 'ahmed fararg', 'raoufkhaleda@gmail.com', NULL, '$2y$10$ZRaWKoBAeUudB8okM.Fwa.uWRHdoUTbPTzqwdyDSnlnpjF3i05ubC', NULL, NULL, '2023-08-11 14:18:36', '2023-08-11 14:18:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clincals`
--
ALTER TABLE `clincals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rel1` (`hospital_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `national_id` (`national_id`),
  ADD KEY `doctors_ibfk_1` (`hospital_id`),
  ADD KEY `doctors_ibfk_2` (`clincal_id`);

--
-- Indexes for table `emergency_cases`
--
ALTER TABLE `emergency_cases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `re` (`hospital_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
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
-- Indexes for table `patient_histories`
--
ALTER TABLE `patient_histories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `national_id` (`national_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_ibfk_2` (`doctor_id`),
  ADD KEY `reservations_ibfk_3` (`clincal_id`),
  ADD KEY `reservations_ibfk_4` (`hospital_id`),
  ADD KEY `reservations_ibfk_5` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reset_code_passwords`
--
ALTER TABLE `reset_code_passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_id` (`hospital_id`);

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
-- AUTO_INCREMENT for table `clincals`
--
ALTER TABLE `clincals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `emergency_cases`
--
ALTER TABLE `emergency_cases`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_histories`
--
ALTER TABLE `patient_histories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `reset_code_passwords`
--
ALTER TABLE `reset_code_passwords`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clincals`
--
ALTER TABLE `clincals`
  ADD CONSTRAINT `rel1` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctors_ibfk_2` FOREIGN KEY (`clincal_id`) REFERENCES `clincals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `emergency_cases`
--
ALTER TABLE `emergency_cases`
  ADD CONSTRAINT `emergency_cases_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emergency_cases_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_histories`
--
ALTER TABLE `patient_histories`
  ADD CONSTRAINT `patient_histories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_3` FOREIGN KEY (`clincal_id`) REFERENCES `clincals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_4` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_5` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_6` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
