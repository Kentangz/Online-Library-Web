-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 14, 2025 at 04:10 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `image`, `nama`, `email`, `password`, `created_at`, `updated_at`) VALUES
(64, 'images/admins/CCOtYWh8B7hYvEnM8EYnfaM0jrj4hZDFgcv8G16G.jpg', 'akuadmin', 'akuadminaseli@gmail.com', '$2y$12$WKCSow9j8A87vw93iPMEh.2.IZudzyUIyx3BsvwZiO6QW9h2JJZme', '2025-01-13 12:43:13', '2025-01-13 12:43:13'),
(65, NULL, 'akuadmin', 'akuadmin@gmail.com', '$2y$12$cwVvLp9hC90A.aAScuwdN.AooPYrkuHXDO9a7.cKvKWkRqog1N3zm', '2025-01-13 22:24:44', '2025-01-13 22:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id_buku` bigint UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori_id` bigint UNSIGNED DEFAULT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id_buku`, `image`, `judul`, `kategori_id`, `penulis`, `penerbit`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'images/books/XkNpvhPUvhSugfZ3B9tSGGPKzhCbZfGvvSsP9LLh.jpg', 'Asaeliwak', 1, 'Helo', '123', 123, '2025-01-04 13:53:23', '2025-01-13 12:19:06'),
(7, 'images/books/WOaQPY3l0Aow709zbxzsFFRei1jsJp3QxdfvNptq.png', 'Ini Edit', 5, 'Helo', '123', 123123, '2025-01-04 13:58:53', '2025-01-13 12:18:56'),
(11, 'images/books/CVFM9GGaUIrAx5GouUGv2CRVbxFBCFwdr9BJ2m1t.png', 'Aseliwak', 5, 'Akupenulis', 'Akupenerbit', 14, '2025-01-11 23:33:56', '2025-01-13 12:29:44'),
(12, 'images/books/A4sYGJxoc2Z9gEaOi2IuRNV8TMa7vUCEvuBEoFyY.png', 'aseliwak', 1, 'akupenulis', 'akupenerbit', 15, '2025-01-11 23:34:04', '2025-01-11 23:34:04'),
(13, 'images/books/N5SMsOyT6AUvYzqUBHLZRZ7sifmZeV4qBrZRFnXe.png', 'aseliwak', 1, 'akupenulis', 'akupenerbit', 16, '2025-01-11 23:34:10', '2025-01-11 23:34:10'),
(14, 'images/books/ALyOotK8F5kvbhrvCptQGsq7ftElbzAEShU7trbn.png', 'aseliwak', 1, 'akupenulis', 'akupenerbit', 17, '2025-01-11 23:34:16', '2025-01-11 23:34:16'),
(15, 'images/books/Pj6bYCY6qAptYDppaWFvgNL7T58lMdvIbH6dfgot.png', 'aseliwak', 1, 'akupenulis', 'akupenerbit', 18, '2025-01-11 23:34:21', '2025-01-11 23:34:21'),
(16, 'images/books/feMlEng3W5KWMhxb3GKFbY3a6HXs1qgkxBiQpbH7.png', 'aseliwak', 1, 'akupenulis', 'akupenerbit', 19, '2025-01-11 23:34:26', '2025-01-11 23:34:26'),
(18, 'images/books/Eh7p92uN7IuBE5DgI1jnoO0HyX08A2Ny2jiZ5myb.png', 'ini baru', 1, 'akupenulis', 'akupenerbit', 123, '2025-01-13 02:03:03', '2025-01-13 02:03:03'),
(19, 'images/books/tIrnyP9HCzfeXPtQViERojzRKlI0v7F997PFmv1X.jpg', 'aseliwak', 1, 'akupenulis', 'akupenerbit', 20, '2025-01-13 02:05:32', '2025-01-13 02:05:32'),
(20, 'images/books/pQ60AXQ43OZADCIkOUL46v0xLTPsSXvc8TY079KB.jpg', 'aseliwak', 1, 'akupenulis', 'akupenerbit', 20, '2025-01-13 02:05:34', '2025-01-13 02:05:34'),
(21, 'images/books/A4cwUonS2aWe3t2ixuswKH5Q7kuAAoMnRD2rAuoO.jpg', 'aseliwak', 1, 'akupenulis', 'akupenerbit', 20, '2025-01-13 02:05:38', '2025-01-13 02:05:38'),
(22, 'images/books/hJw9RK6uW0zp7OzNZ7XO57n3EMkNDADQj9768Vvy.jpg', 'aseliwak', 1, 'akupenulis', 'akupenerbit', 20, '2025-01-13 02:05:39', '2025-01-13 02:05:39'),
(23, 'images/books/yFNT9e83rSBCsU3GtiSHdEKpURyVl7AugtWjCi3R.jpg', 'aseliwak', 1, 'akupenulis', 'akupenerbit', 20, '2025-01-13 02:05:41', '2025-01-13 02:05:41'),
(24, 'images/books/n67OCpptgZXSfMXvCKfjspumhmlTMwmgU5UfAK8n.jpg', 'aseliwak', 1, 'akupenulis', 'akupenerbit', 20, '2025-01-13 02:05:42', '2025-01-13 02:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_kategori` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'ini kategori edit', '2025-01-03 10:35:41', '2025-01-13 11:47:21'),
(5, 'ini kategori baru', '2025-01-13 11:47:46', '2025-01-13 11:47:46'),
(7, 'ini kategori baru edit', '2025-01-13 12:30:43', '2025-01-13 12:31:09'),
(8, 'ini kategori baru baru baru', '2025-01-13 12:30:51', '2025-01-13 12:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `fines`
--

CREATE TABLE `fines` (
  `id_denda` bigint UNSIGNED NOT NULL,
  `id_transaksi` bigint UNSIGNED NOT NULL,
  `jumlah_denda` decimal(10,2) NOT NULL,
  `status_denda` enum('dibayar','belum dibayar') NOT NULL DEFAULT 'belum dibayar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fines`
--

INSERT INTO `fines` (`id_denda`, `id_transaksi`, `jumlah_denda`, `status_denda`, `created_at`, `updated_at`) VALUES
(1, 2, 0.00, 'belum dibayar', '2025-01-05 00:41:48', '2025-01-05 00:41:48'),
(2, 2, 0.00, 'belum dibayar', '2025-01-05 00:52:27', '2025-01-05 00:52:27'),
(3, 3, 0.00, 'dibayar', '2025-01-05 00:56:11', '2025-01-14 08:24:46'),
(4, 2, 1000.00, 'belum dibayar', '2025-01-05 00:56:30', '2025-01-05 00:56:30'),
(5, 6, 10000.00, 'belum dibayar', '2025-01-05 02:07:36', '2025-01-05 02:07:36'),
(8, 8, 100000.00, 'dibayar', '2025-01-05 02:32:16', '2025-01-05 03:42:07'),
(10, 21, 16000.00, 'dibayar', '2025-01-14 06:02:19', '2025-01-14 08:36:59'),
(11, 17, 1000.00, 'belum dibayar', '2025-01-14 08:09:51', '2025-01-14 08:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '0001_01_01_000000_create_users_table', 1),
(12, '0001_01_01_000001_create_cache_table', 1),
(13, '0001_01_01_000002_create_jobs_table', 1),
(14, '2025_01_01_101329_create_admins_table', 1),
(15, '2025_01_01_101408_create_users_table', 2),
(16, '2025_01_01_101630_create_categories_table', 2),
(17, '2025_01_01_102002_create_books_table', 3),
(18, '2025_01_01_102107_create_transactions_table', 4),
(23, '2025_01_01_102137_create_fines_table', 5),
(24, '2025_01_01_114730_create_personal_access_tokens_table', 5),
(25, '2025_01_04_203702_create_books_table', 6),
(26, '2025_01_04_204015_create_transactions_table', 7),
(27, '2025_01_04_204056_create_fines_table', 7),
(28, '2025_01_04_204527_create_transactions_table', 8),
(29, '2025_01_04_204839_create_fines_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BL5fUV5YhQrUgoMZgTItA4OpG4jViabHL2tRCSdJ', NULL, '127.0.0.1', 'PostmanRuntime/7.43.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ1ZEaEtnaWwyQXc4bzNUV3ZPbzY1Z3Zta3lsUUlMMHVVUGNNaHdhNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1735742613),
('hjz3rrfLieQ6upRg3wt0cOHKftYUDf3F3YHO67qe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUzQwSXFERndoMERVeW1ncnpPMks4MmhzR1NzU05aY0hDWUtQOHpIdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1736616418),
('JTyvphVeCmSuQn8P1EKvPupe8JWcOEieIkmlSfKU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmJwZ0R3ZHM0TGQ1THRRWFBSaVZyRTB5dmpuZlZOTXJ1QUgwQ1JMTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1735751688),
('VaMGQnhN7A1fm1W7emMJ7W0uAwDo5WqLjE95gboq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUZWS21RQmx5cER5ZVBVYmpoM3VsdUhpVkkwTU9HT1c3bVVrcUJZbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1735732466);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id_transaksi` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_buku` bigint UNSIGNED NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('dipinjam','kembali','telat') NOT NULL DEFAULT 'dipinjam',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id_transaksi`, `id_user`, `id_buku`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '2025-03-01', NULL, 'dipinjam', '2025-01-04 23:23:18', '2025-01-04 23:47:13'),
(3, 2, 1, '2025-01-05', '2025-01-06', 'dipinjam', '2025-01-04 23:24:05', '2025-01-04 23:24:05'),
(6, 2, 1, '2024-12-12', '2025-01-01', 'telat', '2025-01-05 02:07:36', '2025-01-05 02:07:36'),
(7, 2, 1, '2024-05-12', '2025-01-01', 'telat', '2025-01-05 02:08:48', '2025-01-05 02:08:48'),
(8, 2, 1, '2024-01-01', '2025-01-01', 'kembali', '2025-01-05 02:27:38', '2025-01-05 02:29:07'),
(9, 2, 1, '2020-01-01', '2025-01-01', 'telat', '2025-01-05 03:44:06', '2025-01-05 03:44:06'),
(10, 29, 1, '2025-01-14', NULL, 'dipinjam', '2025-01-14 04:15:56', '2025-01-14 04:15:56'),
(11, 29, 1, '2025-01-14', NULL, 'dipinjam', '2025-01-14 04:16:10', '2025-01-14 04:16:10'),
(12, 29, 1, '2025-01-14', NULL, 'dipinjam', '2025-01-14 04:17:16', '2025-01-14 04:17:16'),
(13, 2, 1, '2025-01-14', NULL, 'dipinjam', '2025-01-14 04:24:16', '2025-01-14 04:24:16'),
(14, 2, 7, '2025-01-14', NULL, 'dipinjam', '2025-01-14 04:25:20', '2025-01-14 04:25:20'),
(15, 2, 11, '2025-01-14', NULL, 'dipinjam', '2025-01-14 04:28:00', '2025-01-14 04:28:00'),
(16, 2, 12, '2025-01-14', NULL, 'dipinjam', '2025-01-14 04:28:58', '2025-01-14 04:28:58'),
(17, 2, 13, '2025-01-14', NULL, 'dipinjam', '2025-01-14 04:29:15', '2025-01-14 04:29:15'),
(18, 29, 1, '2025-01-14', NULL, 'dipinjam', '2025-01-14 05:01:51', '2025-01-14 05:01:51'),
(19, 29, 1, '2025-01-14', NULL, 'dipinjam', '2025-01-14 05:17:34', '2025-01-14 05:17:34'),
(20, 29, 1, '2025-01-15', NULL, 'dipinjam', '2025-01-14 05:20:37', '2025-01-14 05:20:37'),
(21, 29, 7, '2020-01-01', '2020-02-02', 'telat', '2025-01-14 06:02:19', '2025-01-14 06:02:19'),
(22, 5, 12, '2025-01-14', '2025-01-30', 'dipinjam', '2025-01-14 07:11:52', '2025-01-14 07:11:52'),
(23, 21, 13, '2025-01-14', '2025-01-21', 'dipinjam', '2025-01-14 07:23:43', '2025-01-14 07:23:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nomor_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `image`, `nama`, `email`, `password`, `nomor_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(2, NULL, 'akuuser', 'akuuser@gmail.com', '$2y$12$/VRKwi5NWmBa15S4Zo.EaueeAqcCOstHOIXw3SuJqSumGl1RmFyYq', NULL, NULL, '2025-01-02 02:26:13', '2025-01-02 02:26:13'),
(3, NULL, 'akuuser', 'akuuser@gmail.com', '$2y$12$cKOBKKqL6r8h4GUDLRR50upkHI9dphaYPbgXyUdJ0tDYRjxFFhhBO', NULL, NULL, '2025-01-02 02:29:39', '2025-01-02 02:29:39'),
(4, NULL, 'akuuser', 'akuuser@gmail.com', '$2y$12$R1n1rOi1zYALzYUF7Kf4Zuia9fZxRnmXfPGXUtP7.x0pjUU.5jnZy', NULL, NULL, '2025-01-02 02:30:07', '2025-01-02 02:30:07'),
(5, NULL, '123', '123123@sdf', '$2y$12$7tsZuWh6hFNtsyfLBjrJruaZj./qAXW8VYXZ1LJ.oSUJ5Gv5vDeU6', '123123123', '131231', '2025-01-02 02:31:58', '2025-01-02 03:24:49'),
(6, NULL, 'akuuser', 'akuuser@gmail.com', '$2y$12$5.XXdBhBydLJmnK3YO4Dp.AqrOFXnyyldGshuWxEPc.uNh0mg00vm', NULL, NULL, '2025-01-02 02:32:04', '2025-01-02 02:32:04'),
(7, NULL, 'akuuser', 'akuuser@gmail.com', '$2y$12$Gpbr2xoA4EwL6iDe6TlA5OWX7O/ZB1sRJC521byCC9wNM7PpqSJO6', NULL, NULL, '2025-01-02 02:32:12', '2025-01-02 02:32:12'),
(8, NULL, 'akuuser', 'akuuser@gmail.com', '$2y$12$UBQB/9NybWIAtvCCo4FUVe5Fx0B2sHM8Tx7rzJ5WGwb84wzGDrJlu', NULL, NULL, '2025-01-02 02:32:37', '2025-01-02 02:32:37'),
(9, 'images/users/UXgwOVwyTzl4fi3GhvDA5dZkQoV89VkpU7vntumL.jpg', 'akuuser', 'akuuser@gmail.com', '$2y$12$9WpSbXlHfplPbLo4T6EWZOl1gxzkyYql/k9tOvGFz1m.KCmz0ZTku', NULL, NULL, '2025-01-02 02:32:47', '2025-01-02 02:32:47'),
(10, 'images/users/LXqyiiRx8Z75WomFDL3waiSCbpVm3Ev3VNe2zbqP.jpg', 'akuuser', 'akuuser@gmail.com', '$2y$12$8lHZslty4h00Nv1HkFWrMeQjzrNYf3hbvyArq809yWl0HqyQJA2ce', NULL, NULL, '2025-01-02 02:34:21', '2025-01-02 02:34:21'),
(11, 'images/users/SmPQ7vMzJq2t4CME4bxnWCfarFn78DbKHpNMJ9HQ.jpg', 'akuuser', 'akuuser@gmail.com', '$2y$12$rmPn.rMv6wzoAZH4Bi6c7OfoM.wwNtVCJaAGKPEbpLoFAhE2TtiGS', NULL, NULL, '2025-01-02 02:34:57', '2025-01-02 02:34:57'),
(12, 'images/users/Quhyb7qjl2cy7M4tI1Io1SDuHF6GPrk1wt35gv1m.jpg', 'akuuser', 'akuuser@gmail.com', '$2y$12$cMRk1cwNoXVBzxfyQbGzLu9GoR7PEIxRk6ma9.YJiinBm.ZBF/4ra', NULL, NULL, '2025-01-02 02:36:00', '2025-01-02 02:36:00'),
(13, 'images/users/cRfGF4HWwkTNL2sJoz6lqgbrUpxwriUxeQMSp9LG.jpg', 'akuuser', 'akuuser@gmail.com', '$2y$12$7OsIDEHIP9ewIXAjV0GEyuG9Ob72F6NAKy4NelORNlvaMJl5Zg.2S', NULL, NULL, '2025-01-02 02:37:10', '2025-01-02 02:37:10'),
(14, 'images/users/KTJTS1Sv58p1LRdThd7d4cNyxER9LBUNlrXUarHL.jpg', 'akuuser', 'akuuser@gmail.com', '$2y$12$oDnShWFU5M8NAG.0kHe5XeVMtjtpD5s2PJzGU7jzNGDKETcAtbaXW', NULL, 'qweq', '2025-01-02 02:37:47', '2025-01-02 02:37:47'),
(15, 'images/users/u1OOE6zncrVV9yNXS8Ba8m0M4mbROqZlQIeRMfDV.jpg', 'akuuser', 'akuuser@gmail.com', '$2y$12$hvmrdSS5..rKE0kgBzrfg.WoESg7ee/EA.oq06N4n6v0w7YJhtXCa', '1233', 'qweq', '2025-01-02 02:42:35', '2025-01-02 02:42:35'),
(16, 'images/users/5DxAjCpuK89tb5cDozddGyGPiiqFx7H8OVHX2ohk.jpg', 'akuuser', 'akuuser@gmail.com', '$2y$12$N6s80P.vG3mMaZeawPYCtuWNGqR1y7F06lGFjCnEbGqjnYbYv/BwO', '1233', 'qweq', '2025-01-02 02:42:53', '2025-01-02 02:42:53'),
(17, 'images/users/afTtjVK04qnCRsPedg5WAnPiLCL9zW7GyRNnDDqM.jpg', 'akuuser', 'akuuser@gmail.com', '$2y$12$.DZFDIdNNZUeeLU.lajNx.Z3/4WbPDFUyw/ZMS/4mdqX3Au1eYg9.', '1233', 'qweq', '2025-01-02 03:15:45', '2025-01-02 03:15:45'),
(18, 'images/users/TJT90fDIHmSJdanf3aBwOpNyNdtGnfjsx6iZaRoK.jpg', 'akuuser', 'akuuser@gmail.com', '$2y$12$phAZ9QFb1KXuEp0uUo.YV.vCiLLHD.nnbSf39LM.dtOvB/xx2RCma', '1233', 'qweq', '2025-01-02 03:17:36', '2025-01-02 03:17:36'),
(19, 'images/users/IvQabBjzFG6JsjBIYsBRCluZMLWSXshtO1SpsLVc.jpg', 'akuuser', 'akuuser@gmail.com', '$2y$12$i7Koqeeq6jKho1yCkl.gQODD1bDbwYim5n8QzoRkIAsiS6UJ7VJKq', '1233', 'qweq', '2025-01-02 03:17:51', '2025-01-02 03:17:51'),
(20, 'images/users/I9H50bd3d4bJc8IBkatuKbwp4lAddtr9yCUXD8Qn.jpg', '123', 'akuuse2r@gmail.com', '$2y$12$G6e.fLYFSYgLdyql8y9UaOPA6ROfSB1lRez4M2SQo2kwHZiFI4dzy', NULL, NULL, '2025-01-02 03:26:03', '2025-01-02 03:46:24'),
(21, 'images/users/5zKx1yp6LHVAiXWUe3HwcYTQkF9bNaiwR96IuZjU.jpg', 'aku user fake', 'user@gmail.cpom', '$2y$12$femOHwkA4bdfKE5iciE2KO5v7wkQsg8MD0ZKcwhhE8C.swELGtwiy', '123123123', NULL, '2025-01-02 03:56:53', '2025-01-02 03:56:53'),
(23, 'images/users/O9y56bCcsFnRyQrzJj8AQ38CaCJta3tDtilZzgeC.jpg', '123', '123@f', '$2y$12$e4c6xR5Wwt23idKD8Z/O..jCb7u5ySuJywEJqmhJVa.s9YxIST8R6', '123', NULL, '2025-01-04 11:23:11', '2025-01-04 11:23:11'),
(24, 'images/users/mF99g5jbBAmMR1uwWfjtrs6lcBuEsXa4gZs6f30O.jpg', '123', '123@f', '$2y$12$pkr6Z7fJJKwvt.K24DBdwOQejdSB6fs7c.USoaRrtRRJWrmZCg47y', '123', NULL, '2025-01-04 11:23:20', '2025-01-04 11:23:20'),
(25, 'images/users/fgogVJ9r9mX4LscqD6TBSpfee2yih9sccBx4C0uI.jpg', 'aku', 'aku@gmail.com', '$2y$12$R2NWDHaxrc0cIdzZwHjAK.qOy72mpW.T2adBdsGMn6xdSGKHYoCGS', '123', NULL, '2025-01-13 20:41:15', '2025-01-13 20:41:15'),
(26, 'images/users/L7vDrdwuVU8lLeTJBod4SAAaIFmmRVEJF6HN59pr.jpg', 'aku', 'aku1@gmail.com', '$2y$12$.NJrzSmrvh/3gtWLK4FvMuS26iqWn502sC9cnsDGJQKmfSqLWZ8aO', '123', NULL, '2025-01-13 20:45:31', '2025-01-13 20:45:31'),
(27, 'images/users/GuGN55MF0QCtrS5OfmnY31Y1MojYmwD0JdXWJBdj.jpg', 'aku', 'aku19898@gmail.com', '$2y$12$ZAhcHlDxOx0i1b9yuNebtOTEflmb3LgiKpvDILG/nutePo2qdmMRC', '123', NULL, '2025-01-13 22:20:01', '2025-01-13 22:20:01'),
(28, NULL, 'aku', 'akupopo@gmail.com', '$2y$12$oaWHgCXZBVzmdzJADJonw.G4vZT4EhjYETdAT/swZbhbXbSkhdadW', '081', NULL, '2025-01-13 22:27:57', '2025-01-13 22:27:57'),
(29, 'images/users/7dtcolVGFQQQYazl1APIOV5uq6YbjdXI1uKX7eAU.png', 'Bintangaseli', 'bintangril@gmail.com', '$2y$12$hrAk.7KNoUANhoz9JDCHlezDLE0Yy2B4NqGcI3hSDr9HRbeCLZ65i', '081', 'akujawa', '2025-01-13 22:32:02', '2025-01-14 02:25:43'),
(30, 'images/users/N8c8xolf7Uiy4DkEIK8BOPEawWTgv0QDFc6nXW8X.png', 'Aku', 'aku1140@gmail.com', '$2y$12$B9JTHumtzL27CJ5hI6v59uAz4YZn7fhOKXJA8TxfjYJu3lowSrbLi', '12334', 'akuindonesia', '2025-01-14 02:20:38', '2025-01-14 02:24:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `books_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `fines`
--
ALTER TABLE `fines`
  ADD PRIMARY KEY (`id_denda`),
  ADD KEY `fines_id_transaksi_foreign` (`id_transaksi`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transactions_id_user_foreign` (`id_user`),
  ADD KEY `transactions_id_buku_foreign` (`id_buku`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id_buku` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_kategori` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fines`
--
ALTER TABLE `fines`
  MODIFY `id_denda` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaksi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `categories` (`id_kategori`) ON DELETE SET NULL;

--
-- Constraints for table `fines`
--
ALTER TABLE `fines`
  ADD CONSTRAINT `fines_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transactions` (`id_transaksi`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_id_buku_foreign` FOREIGN KEY (`id_buku`) REFERENCES `books` (`id_buku`),
  ADD CONSTRAINT `transactions_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
