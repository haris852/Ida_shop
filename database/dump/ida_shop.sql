-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.4.24-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Membuang data untuk tabel ida_shop.failed_jobs: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.migrations: ~6 rows (lebih kurang)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_05_15_021015_create_products_table', 1),
	(7, '2023_05_15_024221_add_image_column_products', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.password_reset_tokens: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.personal_access_tokens: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.products: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT IGNORE INTO `products` (`id`, `category`, `name`, `image`, `weight`, `description`, `stock`, `price`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'food', 'Sapi', NULL, 100, 'Sapi', 100, 100000, 1, 1, 1, '2023-05-15 02:46:13', '2023-05-15 02:46:13');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.users: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `name`, `sex`, `phone`, `address`, `avatar`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 1, '081515144982', 'Sumber Sari, Jember, Jawa Timur', '64619e1d9e6a7ccoS9xfa_400x400.jpg', 'admin@mail.com', NULL, '$2y$10$vGkiGd6F74Z9tf209PT5PO/nMM4ZG7JVDhuFAiYXRCz30v8eOnKOS', 'admin', NULL, '2023-05-15 02:21:50', '2023-05-15 02:51:09'),
	(2, 'Faqih', 1, '08384738287', 'Sumber Sari, Jember, Jawa Timur', '64619e512e58030soccer-ronaldo-1-76fd-mediumSquareAt3X.jpg', 'faqih@mail.com', NULL, '$2y$10$SSDl0wYBZ3DYs2hS0dR4t.OW7rFp8Tgkr.KmBn1yce4eDEV83DQ8O', 'user', NULL, '2023-05-15 02:52:01', '2023-05-15 02:52:01');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
