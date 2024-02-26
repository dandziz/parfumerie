-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th2 26, 2024 lúc 11:44 AM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `perfume_price`
--

CREATE TABLE `perfume_price` (
  `id` bigint UNSIGNED NOT NULL,
  `perfume_id` bigint UNSIGNED NOT NULL,
  `capacity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` tinyint NOT NULL DEFAULT '0',
  `import_price` int UNSIGNED NOT NULL,
  `price` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `perfume_price`
--

INSERT INTO `perfume_price` (`id`, `perfume_id`, `capacity`, `quantity`, `import_price`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'CHIẾT 10ML', 0, 100000, 195000, '2024-02-26 11:32:20', '2024-02-26 11:32:20', NULL),
(2, 1, 'CHIẾT 20ML', 1, 265000, 375000, '2024-02-26 11:32:40', '2024-02-26 11:32:44', NULL),
(3, 1, 'FULLBOX 100ML', 0, 1000000, 1200000, '2024-02-26 11:32:55', '2024-02-26 11:32:55', NULL),
(4, 2, 'CHIẾT 10ML', 1, 200000, 285000, '2024-02-26 11:33:20', '2024-02-26 11:33:20', NULL),
(5, 2, 'CHIẾT 20ML', 1, 450000, 550000, '2024-02-26 11:33:32', '2024-02-26 11:33:32', NULL),
(6, 2, 'FULLBOX 100ML', 1, 1750000, 1950000, '2024-02-26 11:33:48', '2024-02-26 11:33:48', NULL),
(7, 3, 'CHIẾT 10ML', 1, 215000, 315000, '2024-02-26 11:34:14', '2024-02-26 11:34:14', NULL),
(8, 3, 'CHIẾT 20ML', 0, 515000, 615000, '2024-02-26 11:34:26', '2024-02-26 11:34:26', NULL),
(9, 3, 'FULLBOX 100ML', 0, 2450000, 2650000, '2024-02-26 11:35:12', '2024-02-26 11:35:12', NULL),
(10, 4, 'CHIẾT 10ML', 0, 155000, 255000, '2024-02-26 11:35:49', '2024-02-26 11:35:49', NULL),
(11, 4, 'CHIẾT 20ML', 1, 380000, 495000, '2024-02-26 11:36:12', '2024-02-26 11:36:12', NULL),
(12, 4, 'FULLBOX 100ML', 0, 1000000, 1350000, '2024-02-26 11:36:25', '2024-02-26 11:36:25', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `perfume_price`
--
ALTER TABLE `perfume_price`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `perfume_price_perfume_id_capacity_unique` (`perfume_id`,`capacity`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `perfume_price`
--
ALTER TABLE `perfume_price`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `perfume_price`
--
ALTER TABLE `perfume_price`
  ADD CONSTRAINT `perfume_price_perfume_id_foreign` FOREIGN KEY (`perfume_id`) REFERENCES `perfumes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
