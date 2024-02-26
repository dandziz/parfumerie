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
-- Cấu trúc bảng cho bảng `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumb` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint NOT NULL,
  `img_sort` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `mediable_id` int UNSIGNED NOT NULL,
  `mediable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `media`
--

INSERT INTO `media` (`id`, `name`, `img`, `thumb`, `type`, `img_sort`, `status`, `mediable_id`, `mediable_type`, `created_at`, `updated_at`) VALUES
(1, 'afnan-9pm-edp1708947707-1.jpeg', 'perfumes/4/afnan-9pm-edp1708947707-1.jpeg', 'perfumes/4/thumb/afnan-9pm-edp1708947707-1.jpeg', 2, 1, 1, 4, 'App\\Models\\Perfume', '2024-02-26 11:41:47', '2024-02-26 11:42:00'),
(2, 'afnan-9pm-edp1708947707-2.jpeg', 'perfumes/4/afnan-9pm-edp1708947707-2.jpeg', 'perfumes/4/thumb/afnan-9pm-edp1708947707-2.jpeg', 1, 2, 1, 4, 'App\\Models\\Perfume', '2024-02-26 11:41:47', '2024-02-26 11:41:58'),
(3, 'afnan-9pm-edp1708947707-3.jpeg', 'perfumes/4/afnan-9pm-edp1708947707-3.jpeg', 'perfumes/4/thumb/afnan-9pm-edp1708947707-3.jpeg', 3, 3, 1, 4, 'App\\Models\\Perfume', '2024-02-26 11:41:47', '2024-02-26 11:42:02'),
(4, 'afnan-9pm-edp1708947707-4.jpeg', 'perfumes/4/afnan-9pm-edp1708947707-4.jpeg', 'perfumes/4/thumb/afnan-9pm-edp1708947707-4.jpeg', 0, 4, 1, 4, 'App\\Models\\Perfume', '2024-02-26 11:41:47', '2024-02-26 11:41:47'),
(5, 'afnan-9pm-edp1708947707-5.jpeg', 'perfumes/4/afnan-9pm-edp1708947707-5.jpeg', 'perfumes/4/thumb/afnan-9pm-edp1708947707-5.jpeg', 0, 5, 1, 4, 'App\\Models\\Perfume', '2024-02-26 11:41:47', '2024-02-26 11:41:47'),
(6, 'afnan-9pm-edp1708947707-6.jpeg', 'perfumes/4/afnan-9pm-edp1708947707-6.jpeg', 'perfumes/4/thumb/afnan-9pm-edp1708947707-6.jpeg', 0, 6, 1, 4, 'App\\Models\\Perfume', '2024-02-26 11:41:48', '2024-02-26 11:41:48'),
(7, 'afnan-9pm-edp1708947708-7.jpeg', 'perfumes/4/afnan-9pm-edp1708947708-7.jpeg', 'perfumes/4/thumb/afnan-9pm-edp1708947708-7.jpeg', 0, 7, 1, 4, 'App\\Models\\Perfume', '2024-02-26 11:41:48', '2024-02-26 11:41:48'),
(8, 'afnan-9pm-edp1708947708-8.jpeg', 'perfumes/4/afnan-9pm-edp1708947708-8.jpeg', 'perfumes/4/thumb/afnan-9pm-edp1708947708-8.jpeg', 0, 8, 1, 4, 'App\\Models\\Perfume', '2024-02-26 11:41:48', '2024-02-26 11:41:48'),
(9, 'french-coffee1708947747-1.jpeg', 'perfumes/1/french-coffee1708947747-1.jpeg', 'perfumes/1/thumb/french-coffee1708947747-1.jpeg', 2, 1, 1, 1, 'App\\Models\\Perfume', '2024-02-26 11:42:27', '2024-02-26 11:42:38'),
(10, 'french-coffee1708947747-2.jpeg', 'perfumes/1/french-coffee1708947747-2.jpeg', 'perfumes/1/thumb/french-coffee1708947747-2.jpeg', 1, 2, 1, 1, 'App\\Models\\Perfume', '2024-02-26 11:42:27', '2024-02-26 11:42:36'),
(11, 'french-coffee1708947747-3.jpeg', 'perfumes/1/french-coffee1708947747-3.jpeg', 'perfumes/1/thumb/french-coffee1708947747-3.jpeg', 3, 3, 1, 1, 'App\\Models\\Perfume', '2024-02-26 11:42:27', '2024-02-26 11:42:41'),
(12, 'french-coffee1708947748-4.jpeg', 'perfumes/1/french-coffee1708947748-4.jpeg', 'perfumes/1/thumb/french-coffee1708947748-4.jpeg', 0, 4, 1, 1, 'App\\Models\\Perfume', '2024-02-26 11:42:28', '2024-02-26 11:42:28'),
(13, 'french-coffee1708947748-5.jpeg', 'perfumes/1/french-coffee1708947748-5.jpeg', 'perfumes/1/thumb/french-coffee1708947748-5.jpeg', 0, 5, 1, 1, 'App\\Models\\Perfume', '2024-02-26 11:42:28', '2024-02-26 11:42:28'),
(14, 'french-coffee1708947748-6.jpeg', 'perfumes/1/french-coffee1708947748-6.jpeg', 'perfumes/1/thumb/french-coffee1708947748-6.jpeg', 0, 6, 1, 1, 'App\\Models\\Perfume', '2024-02-26 11:42:29', '2024-02-26 11:42:29'),
(15, 'french-coffee1708947749-7.jpeg', 'perfumes/1/french-coffee1708947749-7.jpeg', 'perfumes/1/thumb/french-coffee1708947749-7.jpeg', 0, 7, 1, 1, 'App\\Models\\Perfume', '2024-02-26 11:42:29', '2024-02-26 11:42:29'),
(16, 'french-coffee1708947749-8.jpeg', 'perfumes/1/french-coffee1708947749-8.jpeg', 'perfumes/1/thumb/french-coffee1708947749-8.jpeg', 0, 8, 1, 1, 'App\\Models\\Perfume', '2024-02-26 11:42:30', '2024-02-26 11:42:30'),
(17, 'versace-eros-for-men-edt1708947789-1.jpeg', 'perfumes/2/versace-eros-for-men-edt1708947789-1.jpeg', 'perfumes/2/thumb/versace-eros-for-men-edt1708947789-1.jpeg', 2, 1, 1, 2, 'App\\Models\\Perfume', '2024-02-26 11:43:09', '2024-02-26 11:43:17'),
(18, 'versace-eros-for-men-edt1708947789-2.jpeg', 'perfumes/2/versace-eros-for-men-edt1708947789-2.jpeg', 'perfumes/2/thumb/versace-eros-for-men-edt1708947789-2.jpeg', 1, 2, 1, 2, 'App\\Models\\Perfume', '2024-02-26 11:43:09', '2024-02-26 11:43:14'),
(19, 'versace-eros-for-men-edt1708947789-3.jpeg', 'perfumes/2/versace-eros-for-men-edt1708947789-3.jpeg', 'perfumes/2/thumb/versace-eros-for-men-edt1708947789-3.jpeg', 3, 3, 1, 2, 'App\\Models\\Perfume', '2024-02-26 11:43:10', '2024-02-26 11:43:19'),
(20, 'versace-eros-for-men-edt1708947790-4.jpeg', 'perfumes/2/versace-eros-for-men-edt1708947790-4.jpeg', 'perfumes/2/thumb/versace-eros-for-men-edt1708947790-4.jpeg', 0, 4, 1, 2, 'App\\Models\\Perfume', '2024-02-26 11:43:10', '2024-02-26 11:43:10'),
(21, 'versace-eros-for-men-edt1708947790-5.jpeg', 'perfumes/2/versace-eros-for-men-edt1708947790-5.jpeg', 'perfumes/2/thumb/versace-eros-for-men-edt1708947790-5.jpeg', 0, 5, 1, 2, 'App\\Models\\Perfume', '2024-02-26 11:43:10', '2024-02-26 11:43:10'),
(22, 'versace-eros-for-men-edt1708947790-6.jpeg', 'perfumes/2/versace-eros-for-men-edt1708947790-6.jpeg', 'perfumes/2/thumb/versace-eros-for-men-edt1708947790-6.jpeg', 0, 6, 1, 2, 'App\\Models\\Perfume', '2024-02-26 11:43:10', '2024-02-26 11:43:10'),
(23, 'versace-eros-for-men-edt1708947790-7.jpeg', 'perfumes/2/versace-eros-for-men-edt1708947790-7.jpeg', 'perfumes/2/thumb/versace-eros-for-men-edt1708947790-7.jpeg', 0, 7, 1, 2, 'App\\Models\\Perfume', '2024-02-26 11:43:10', '2024-02-26 11:43:10'),
(24, 'versace-eros-for-men-edt1708947790-8.jpeg', 'perfumes/2/versace-eros-for-men-edt1708947790-8.jpeg', 'perfumes/2/thumb/versace-eros-for-men-edt1708947790-8.jpeg', 0, 8, 1, 2, 'App\\Models\\Perfume', '2024-02-26 11:43:10', '2024-02-26 11:43:10'),
(25, 'mancera-paris-black-gold-edp1708947834-1.jpeg', 'perfumes/3/mancera-paris-black-gold-edp1708947834-1.jpeg', 'perfumes/3/thumb/mancera-paris-black-gold-edp1708947834-1.jpeg', 2, 1, 1, 3, 'App\\Models\\Perfume', '2024-02-26 11:43:54', '2024-02-26 11:44:02'),
(26, 'mancera-paris-black-gold-edp1708947834-2.jpeg', 'perfumes/3/mancera-paris-black-gold-edp1708947834-2.jpeg', 'perfumes/3/thumb/mancera-paris-black-gold-edp1708947834-2.jpeg', 1, 2, 1, 3, 'App\\Models\\Perfume', '2024-02-26 11:43:54', '2024-02-26 11:44:00'),
(27, 'mancera-paris-black-gold-edp1708947834-3.jpeg', 'perfumes/3/mancera-paris-black-gold-edp1708947834-3.jpeg', 'perfumes/3/thumb/mancera-paris-black-gold-edp1708947834-3.jpeg', 3, 3, 1, 3, 'App\\Models\\Perfume', '2024-02-26 11:43:54', '2024-02-26 11:44:04'),
(28, 'mancera-paris-black-gold-edp1708947834-4.jpeg', 'perfumes/3/mancera-paris-black-gold-edp1708947834-4.jpeg', 'perfumes/3/thumb/mancera-paris-black-gold-edp1708947834-4.jpeg', 0, 4, 1, 3, 'App\\Models\\Perfume', '2024-02-26 11:43:55', '2024-02-26 11:43:55'),
(29, 'mancera-paris-black-gold-edp1708947835-5.jpeg', 'perfumes/3/mancera-paris-black-gold-edp1708947835-5.jpeg', 'perfumes/3/thumb/mancera-paris-black-gold-edp1708947835-5.jpeg', 0, 5, 1, 3, 'App\\Models\\Perfume', '2024-02-26 11:43:55', '2024-02-26 11:43:55'),
(30, 'mancera-paris-black-gold-edp1708947835-6.jpeg', 'perfumes/3/mancera-paris-black-gold-edp1708947835-6.jpeg', 'perfumes/3/thumb/mancera-paris-black-gold-edp1708947835-6.jpeg', 0, 6, 1, 3, 'App\\Models\\Perfume', '2024-02-26 11:43:55', '2024-02-26 11:43:55'),
(31, 'mancera-paris-black-gold-edp1708947835-7.jpeg', 'perfumes/3/mancera-paris-black-gold-edp1708947835-7.jpeg', 'perfumes/3/thumb/mancera-paris-black-gold-edp1708947835-7.jpeg', 0, 7, 1, 3, 'App\\Models\\Perfume', '2024-02-26 11:43:55', '2024-02-26 11:43:55'),
(32, 'mancera-paris-black-gold-edp1708947835-8.jpeg', 'perfumes/3/mancera-paris-black-gold-edp1708947835-8.jpeg', 'perfumes/3/thumb/mancera-paris-black-gold-edp1708947835-8.jpeg', 0, 8, 1, 3, 'App\\Models\\Perfume', '2024-02-26 11:43:55', '2024-02-26 11:43:55');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
