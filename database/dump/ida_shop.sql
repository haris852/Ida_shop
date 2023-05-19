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

-- Membuang data untuk tabel ida_shop.migrations: ~11 rows (lebih kurang)
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
	(17, '2023_05_17_201526_update_status_transactions_column', 7);
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
	(1, 'meat', 'Ayam Utuh', '646252f16fb0cDaging ayam utuh.jpg', 500, 'gr', 'Dada ayam tanpa kulit dan tanpa tulang di jual per 1kg. Harga yg tercantum adalah harga 1kg/kemasan  Ayam yang kami jual secara online adalah Fresh frozen Fresh frozen adalah ayam atau daging segar (FRESH) BERKUALITAS yang sengaja kami bekukan untuk menjaga kualitas produk tetap higenis dan baik.  Kami menganjurkan produk yang telah di beli langsung di masukan kedalam freezer atau dimasak agar kualitas tetap terjaga', 100, 45000, 1, 1, 1, '2023-05-15 15:41:49', '2023-05-16 05:01:58'),
	(2, 'meat', 'Dada Ayam', '646254479b989daging dada-ayam.jpeg', 1, 'kg', 'Dada ayam tanpa kulit dan tanpa tulang di jual per 1kg. Harga yg tercantum adalah harga 1kg/kemasan  Ayam yang kami jual secara online adalah Fresh frozen Fresh frozen adalah ayam atau daging segar (FRESH) BERKUALITAS yang sengaja kami bekukan untuk menjaga kualitas produk tetap higenis dan baik.  Kami menganjurkan produk yang telah di beli langsung di masukan kedalam freezer atau dimasak agar kualitas tetap terjaga', 500, 28000, 1, 1, 1, '2023-05-15 15:48:23', '2023-05-16 05:02:06');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.reviews: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.transactions: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT IGNORE INTO `transactions` (`id`, `transaction_code`, `receiver_name`, `receiver_phone`, `receiver_address`, `note`, `proof_of_payment`, `status`, `is_confirmed`, `user_id`, `payment_method`, `total_price`, `shipping_price`, `total_payment`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(2, 'TRX-2023-0001', 'Ibnu', '081515144981', 'Sumber Sari, Jember, Jawa Timur', 'coba', '646538915b03e-Screenshot_16.jpg', 'paid', 0, 3, 1, 73000, 5000, 73000, 3, 3, '2023-05-17 15:59:19', '2023-05-17 20:26:57'),
	(4, 'TRX-2023-0002', 'Ibnu', '08438537', 'Sumber Sari, Jember, Jawa Timur', NULL, NULL, 'pending', 0, 3, 2, 315000, 5000, 315000, 3, NULL, '2023-05-17 19:54:20', '2023-05-17 19:54:20');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.transaction_details: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `transaction_details` DISABLE KEYS */;
INSERT IGNORE INTO `transaction_details` (`id`, `transaction_id`, `product_id`, `qty`, `price`, `total_price`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 1, 45000, 45000, 3, NULL, '2023-05-17 15:59:19', '2023-05-17 15:59:19'),
	(2, 2, 2, 1, 28000, 28000, 3, NULL, '2023-05-17 15:59:19', '2023-05-17 15:59:19'),
	(4, 4, 1, 7, 45000, 315000, 3, NULL, '2023-05-17 19:54:20', '2023-05-17 19:54:20');
/*!40000 ALTER TABLE `transaction_details` ENABLE KEYS */;

-- Membuang data untuk tabel ida_shop.users: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `name`, `sex`, `phone`, `address`, `avatar`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 1, NULL, NULL, NULL, 'admin@mail.com', NULL, '$2y$10$iAOYtTh9EDR/H9Nz6rtCPupH2OIYjnT7bIYv3VL9BUvaNr71V7/..', 'admin', NULL, '2023-05-15 15:39:51', '2023-05-15 15:39:51'),
	(3, 'sani', 1, '081515144983', 'Sumber Sari, Jember, Jawa Timur', '6464cf05a3040women in the workplace 2022_standard_1536x1536.jpg', 'sani@mail.com', NULL, '$2y$10$92lkeYH/IsPeIbUvIUf9beyU/zzIOftD/rl4FS00VdUutDnMEHysC', 'user', NULL, '2023-05-17 12:56:38', '2023-05-17 12:56:38');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
