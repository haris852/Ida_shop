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

-- Membuang data untuk tabel ida_shop.configuration_store: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `configuration_store` DISABLE KEYS */;
INSERT IGNORE INTO `configuration_store` (`id`, `code`, `name`, `address`, `phone`, `email`, `open_at`, `close_at`, `shipping_cost`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'STORE-001', 'Ida\'s Shop', 'Jl. Raya Kedung Halang No. 1', '081515144981', 'idashop@mail.com', '07:00:00', '16:00:00', 5000, 1, '2023-05-16 03:43:06', '2023-05-16 09:26:24');
/*!40000 ALTER TABLE `configuration_store` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.failed_jobs: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.messages: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT IGNORE INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
	(93, 4, 1, 'halo mas apakah pesanan saya terkirim?', 1, '2023-05-23 01:56:57', '2023-05-23 01:57:15'),
	(94, 1, 4, 'sudah mas', 0, '2023-05-23 01:57:06', '2023-05-23 01:57:06'),
	(95, 4, 1, 'terimakasih mas', 1, '2023-05-23 01:57:13', '2023-05-23 01:57:15');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.migrations: ~13 rows (lebih kurang)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_05_15_021015_create_products_table', 1),
	(6, '2023_05_15_024221_add_image_column_products', 1),
	(7, '2023_05_15_153409_change_category_products', 1),
	(8, '2023_05_16_033917_create_confguration_store_table', 2),
	(9, '2023_05_16_045704_add_unit_column_products', 3),
	(13, '2023_05_17_141406_create_transactions_table', 4),
	(14, '2023_05_17_142604_create_transaction_details_table', 4),
	(15, '2023_05_17_143101_create_reviews_table', 5),
	(16, '2023_05_17_200024_add_is_confirmed_column_transaction', 6),
	(17, '2023_05_17_201526_update_status_transactions_column', 7),
	(18, '2023_05_20_154244_add_proof_of_receipt_column_transactions', 8),
	(19, '2023_05_22_175936_create_messages_table', 9),
	(20, '2023_05_23_014501_add_is_active_users', 10),
	(21, '2023_05_21_151841_remove_product_id_column_reviews', 11),
	(22, '2023_05_23_044608_remove_product_id_transaction_details', 11);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.password_reset_tokens: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.personal_access_tokens: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.products: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT IGNORE INTO `products` (`id`, `category`, `name`, `image`, `weight`, `unit`, `description`, `stock`, `price`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'meat', 'Ayam Utuh', '6466d5a875ae8Daging ayam utuh.jpg', 500, 'gr', 'Ini adalah ayam', 90, 45000, 1, 1, 1, '2023-05-15 15:41:49', '2023-05-23 01:41:29'),
	(2, 'seafood', 'Dada Ayam', '646254479b989daging dada-ayam.jpeg', 1, 'kg', NULL, 497, 28000, 1, 1, 1, '2023-05-15 15:48:23', '2023-05-23 01:41:29');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.reviews: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT IGNORE INTO `reviews` (`id`, `transaction_id`, `rating`, `review`, `user_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(5, 5, 5, 'Bagus', 4, 4, NULL, '2023-05-23 01:41:39', '2023-05-23 01:41:39'),
	(6, 5, 5, 'Bagus', 4, 4, NULL, '2023-05-23 01:41:39', '2023-05-23 01:41:39');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.transactions: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT IGNORE INTO `transactions` (`id`, `transaction_code`, `receiver_name`, `receiver_phone`, `receiver_address`, `note`, `proof_of_payment`, `status`, `proof_of_receipt`, `is_confirmed`, `user_id`, `payment_method`, `total_price`, `shipping_price`, `total_payment`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(2, 'TRX-2023-0001', 'Ibnu', '081515144981', 'Sumber Sari, Jember, Jawa Timur', 'coba', '646538915b03e-Screenshot_16.jpg', 'success', NULL, 0, 3, 1, 73000, 5000, 73000, 3, 1, '2023-05-20 15:59:19', '2023-05-20 10:15:10'),
	(4, 'TRX-2023-0002', 'Ibnu', '08438537', 'Sumber Sari, Jember, Jawa Timur', NULL, NULL, 'success', '6468eda7dfb41-WhatsApp Image 2023-05-01 at 07.10.18.jpeg', 0, 3, 2, 315000, 5000, 315000, 3, 1, '2023-05-16 19:54:20', '2023-05-20 15:56:24'),
	(5, 'TRX-2023-0003', 'Fiki', '0394850', 'Sumber Sari, Jember, Jawa Timur', 'Taruh depan aja mas', '646c198e212ef-1683016814_WhatsApp Image 2023-05-01 at 07.10.18.jpeg', 'success', NULL, 0, 4, 1, 151000, 5000, 146000, 4, 1, '2023-05-23 01:40:01', '2023-05-23 01:41:29');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.transaction_details: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `transaction_details` DISABLE KEYS */;
INSERT IGNORE INTO `transaction_details` (`id`, `transaction_id`, `qty`, `price`, `total_price`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 45000, 45000, 3, NULL, '2023-05-17 15:59:19', '2023-05-17 15:59:19'),
	(2, 2, 1, 28000, 28000, 3, NULL, '2023-05-17 15:59:19', '2023-05-17 15:59:19'),
	(4, 4, 7, 45000, 315000, 3, NULL, '2023-05-17 19:54:20', '2023-05-17 19:54:20'),
	(5, 5, 2, 45000, 90000, 4, NULL, '2023-05-23 01:40:01', '2023-05-23 01:40:01'),
	(6, 5, 2, 28000, 56000, 4, NULL, '2023-05-23 01:40:01', '2023-05-23 01:40:01');
/*!40000 ALTER TABLE `transaction_details` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.users: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `name`, `sex`, `phone`, `address`, `avatar`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `is_active`) VALUES
	(1, 'admin', 1, '081515144983', 'Sumber Sari, Jember, Jawa Timur', '646902d7583fewomen in the workplace 2022_standard_1536x1536.jpg', 'admin@mail.com', NULL, '$2y$10$MHMa85b.hM8VPSnwKw.BzOrLk5fJD6mJDmgD4aE1yIDAb5kMrRX5i', 'admin', NULL, '2023-05-15 15:39:51', '2023-05-20 17:32:43', 1),
	(3, 'sani', 1, '081515144983', 'Sumber Sari, Jember, Jawa Timur', '6464cf05a3040women in the workplace 2022_standard_1536x1536.jpg', 'sani@mail.com', NULL, '$2y$10$92lkeYH/IsPeIbUvIUf9beyU/zzIOftD/rl4FS00VdUutDnMEHysC', 'user', NULL, '2023-05-17 12:56:38', '2023-05-17 12:56:38', 1),
	(4, 'Fiki', 1, '081515144982', 'Sumber Sari, Jember, Jawa Timur', '646bb2c42096530soccer-ronaldo-1-76fd-mediumSquareAt3X.jpg', 'fiki@gmail.com', NULL, '$2y$10$yy99l9H74zN0BFGUFweU4uveHVmtulsdNBlrQO286YakCeysS.mx6', 'user', NULL, '2023-05-22 18:21:20', '2023-05-23 01:49:22', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
