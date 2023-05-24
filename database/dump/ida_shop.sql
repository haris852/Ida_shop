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
	(1, 'STORE-001', 'Ida\'s Shop', 'Jl. Raya Kedung Halang No. 1', '081515144981', 'idashop@mail.com', '08:00:00', '16:00:00', 5000, 1, '2023-05-16 03:43:06', '2023-05-16 09:26:24');
/*!40000 ALTER TABLE `configuration_store` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.failed_jobs: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.messages: ~7 rows (lebih kurang)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT IGNORE INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
	(93, 4, 1, 'halo mas apakah pesanan saya terkirim?', 1, '2023-05-23 01:56:57', '2023-05-23 01:57:15'),
	(94, 1, 4, 'sudah mas', 0, '2023-05-23 01:57:06', '2023-05-23 01:57:06'),
	(95, 4, 1, 'terimakasih mas', 1, '2023-05-23 01:57:13', '2023-05-23 01:57:15'),
	(96, 2, 1, 'TRX-2023-0001 invoice nomer ini sudah dikirim?', 1, '2023-05-23 05:01:12', '2023-05-23 05:06:36'),
	(97, 1, 2, 'sudah mas, silahkan dilihat detail transaksinya', 0, '2023-05-23 05:02:10', '2023-05-23 05:02:10'),
	(98, 3, 1, 'ayam dada utuhnya ada mas?', 1, '2023-05-23 05:05:27', '2023-05-23 05:06:37'),
	(99, 1, 3, 'ada mas silahkan di cekout ya', 0, '2023-05-23 05:05:57', '2023-05-23 05:05:57');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.migrations: ~20 rows (lebih kurang)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_05_15_021015_create_products_table', 1),
	(6, '2023_05_15_024221_add_image_column_products', 1),
	(7, '2023_05_15_153409_change_category_products', 1),
	(8, '2023_05_16_033917_create_confguration_store_table', 1),
	(9, '2023_05_16_045704_add_unit_column_products', 1),
	(10, '2023_05_17_141406_create_transactions_table', 1),
	(11, '2023_05_17_142604_create_transaction_details_table', 1),
	(12, '2023_05_17_143101_create_reviews_table', 1),
	(13, '2023_05_17_200024_add_is_confirmed_column_transaction', 1),
	(14, '2023_05_17_201526_update_status_transactions_column', 1),
	(15, '2023_05_20_154244_add_proof_of_receipt_column_transactions', 1),
	(16, '2023_05_21_151841_remove_product_id_column_reviews', 1),
	(17, '2023_05_22_175936_create_messages_table', 1),
	(18, '2023_05_23_014501_add_is_active_users', 1),
	(19, '2023_05_22_175936_create_messages_table', 9),
	(20, '2023_05_23_014501_add_is_active_users', 10);
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
	(1, 'meat', 'Ayam Utuh', '6466d5a875ae8Daging ayam utuh.jpg', 500, 'gr', 'Ini adalah ayam', 88, 45000, 1, 1, 1, '2023-05-15 15:41:49', '2023-05-23 04:58:12'),
	(2, 'seafood', 'Dada Ayam', '646254479b989daging dada-ayam.jpeg', 1, 'kg', 'dada ayam ini bagus', 497, 28000, 1, 1, 1, '2023-05-15 15:48:23', '2023-05-23 01:41:29');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.reviews: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT IGNORE INTO `reviews` (`id`, `transaction_id`, `rating`, `review`, `user_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 1, 5, 'admin fast respon', 2, 2, NULL, '2023-05-23 04:58:25', '2023-05-23 04:58:25');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.transactions: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT IGNORE INTO `transactions` (`id`, `transaction_code`, `receiver_name`, `receiver_phone`, `receiver_address`, `note`, `proof_of_payment`, `status`, `proof_of_receipt`, `is_confirmed`, `user_id`, `payment_method`, `total_price`, `shipping_price`, `total_payment`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'TRX-2023-0001', 'Sani', '084395798', 'Sumber Sari, Jember, Jawa Timur', 'Taruh didepan aja mas', '646c47c22686e-1683016814_WhatsApp Image 2023-05-01 at 07.10.18.jpeg', 'success', NULL, 0, 2, 1, 95000, 5000, 90000, 2, 1, '2023-05-23 04:57:11', '2023-05-23 04:58:12');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.transaction_details: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `transaction_details` DISABLE KEYS */;
INSERT IGNORE INTO `transaction_details` (`id`, `transaction_id`, `product_id`, `qty`, `price`, `total_price`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 2, 45000, 90000, 2, NULL, '2023-05-23 04:57:11', '2023-05-23 04:57:11');
/*!40000 ALTER TABLE `transaction_details` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.users: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `name`, `sex`, `phone`, `address`, `avatar`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `is_active`) VALUES
	(1, 'admin', 1, NULL, NULL, NULL, 'admin@mail.com', NULL, '$2y$10$YSpWs/FAepbNdZB8UnNeEe9ZkUMwDP0PwGcRObEn1eZ0EuR1CZAC6', 'admin', NULL, '2023-05-23 04:54:45', '2023-05-23 04:54:45', 1),
	(2, 'Ibnu', 1, '081515144981', 'Sumber Sari, Jember, Jawa Timur', '646d53b1e6350ccoS9xfa_400x400.jpg', 'ibnu@mail.com', NULL, '$2y$10$psWmrS.4BLYJ.rZbSc7ek.xhlwPyhZkA88JXCGifM8A.CsHnNU15a', 'user', NULL, '2023-05-23 04:55:57', '2023-05-24 08:58:08', 1),
	(3, 'Faqih Darmawan', 1, '081515144981', 'Sumber Sari, Jember, Jawa Timur', '646c4970ec77d30soccer-ronaldo-1-76fd-mediumSquareAt3X.jpg', 'faqih@mail.com', NULL, '$2y$10$vzT0773UWWwMGYJIOuwe/uNmplvTClxdMjRYX67J2SIkOcpSMmEuO', 'user', NULL, '2023-05-23 05:04:49', '2023-05-24 09:07:26', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
