-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Bulan Mei 2023 pada 13.54
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ida_shop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `configuration_store`
--

CREATE TABLE `configuration_store` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `open_at` time NOT NULL,
  `close_at` time NOT NULL,
  `shipping_cost` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `configuration_store`
--

INSERT INTO `configuration_store` (`id`, `code`, `name`, `address`, `phone`, `email`, `open_at`, `close_at`, `shipping_cost`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'STORE-001', 'Ida Shop', 'Jl. Raya Kedung Halang No. 1', '081234567890', 'idashop@mail.com', '06:00:00', '23:00:00', 10000, 1, '2023-05-24 06:50:27', '2023-05-24 16:09:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(93, 4, 1, 'halo mas apakah pesanan saya terkirim?', 1, '2023-05-22 18:56:57', '2023-05-24 15:17:59'),
(94, 1, 4, 'sudah mas', 0, '2023-05-22 18:57:06', '2023-05-22 18:57:06'),
(95, 4, 1, 'terimakasih mas', 1, '2023-05-22 18:57:13', '2023-05-24 15:17:59'),
(96, 2, 1, 'TRX-2023-0001 invoice nomer ini sudah dikirim?', 1, '2023-05-22 22:01:12', '2023-05-24 08:29:47'),
(97, 1, 2, 'sudah mas, silahkan dilihat detail transaksinya', 0, '2023-05-22 22:02:10', '2023-05-22 22:02:10'),
(98, 3, 1, 'ayam dada utuhnya ada mas?', 1, '2023-05-22 22:05:27', '2023-05-24 08:29:49'),
(99, 1, 3, 'ada mas silahkan di cekout ya', 0, '2023-05-22 22:05:57', '2023-05-22 22:05:57'),
(100, 4, 1, 'assalamualaikum', 1, '2023-05-24 08:25:47', '2023-05-24 15:17:59'),
(101, 1, 4, 'waalaikumsalam, wr wb', 0, '2023-05-24 08:27:09', '2023-05-24 08:27:09'),
(102, 4, 1, 'mau tanya mas, ikan lele masih ada stoknya?', 1, '2023-05-24 08:27:38', '2023-05-24 15:17:59'),
(103, 1, 4, 'iya kak stok ikan lele masih banyak', 0, '2023-05-24 08:27:58', '2023-05-24 08:27:58'),
(104, 1, 4, 'mau pesan berapa ya kak?', 0, '2023-05-24 08:28:17', '2023-05-24 08:28:17'),
(105, 4, 1, 'pesan 1 kg kak', 1, '2023-05-24 08:28:35', '2023-05-24 15:17:59'),
(106, 1, 4, 'baik kak silahkan pesan di menu, segera saya proses', 0, '2023-05-24 08:29:10', '2023-05-24 08:29:10'),
(107, 4, 1, 'terima kasih', 1, '2023-05-24 08:30:09', '2023-05-24 15:17:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` enum('meat','seafood') NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` longtext DEFAULT NULL,
  `weight` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `category`, `name`, `image`, `weight`, `unit`, `description`, `stock`, `price`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'meat', 'Daging Ayam Utuh', '64705c9b5c7eeDaging ayam utuh.png', 900, 'gr', NULL, 80, 45500, 1, 1, 1, '2023-05-15 08:41:49', '2023-05-26 07:15:39'),
(2, 'meat', 'Dada Ayam fresh', '64701170409e3dada ayam.png', 500, 'gr', NULL, 8, 28000, 1, 1, 1, '2023-05-15 08:48:23', '2023-05-26 01:54:56'),
(3, 'meat', 'Paha Ayam utuh', '6470118e28162Paha ayam utuh.png', 500, 'gr', NULL, 5, 27000, 1, 1, 1, '2023-05-24 06:59:58', '2023-05-26 01:55:26'),
(4, 'meat', 'Sayap Ayam fresh', '646db6197a007sayap ayam1.png', 500, 'gr', 'Ayam banyak mengandung vitamin B6, yang diperlukan tubuh untuk memetabolisme karbohidrat, lemak dan protein, memproduksi sel darah merah, serta memperkuat sistem kekebalan tubuh.', 10, 24500, 0, 1, 1, '2023-05-24 07:00:41', '2023-05-24 07:01:21'),
(5, 'meat', 'Sayap Ayam fresh', '64705d4ad777esayap ayam.png', 500, 'gr', NULL, 5, 24500, 1, 1, 1, '2023-05-24 07:01:56', '2023-05-26 07:18:34'),
(6, 'meat', 'Daging Sapi fresh', '64705dda8bab7Desain tanpa judul (2).png', 500, 'gr', NULL, 5, 55000, 1, 1, 1, '2023-05-24 07:03:18', '2023-05-26 07:20:58'),
(7, 'meat', 'Daging Kambing fresh', '64705cdb9f08eDesain tanpa judul.png', 1, 'kg', NULL, 5, 150000, 1, 1, 1, '2023-05-24 07:05:11', '2023-05-26 07:16:43'),
(8, 'seafood', 'Ikan Belanak fresh', '646db77a0997dIkan Belanak2.jpg', 500, 'gr', 'Selain kaya akan proteinnya, kandungan ikan belanak juga mampu meningkatkan kecerdasan otak serta konsentrasi anak. Selain itu, ikan belanak juga sangat berkhasiat untuk mencegah terjadinya penurunan daya ingat atau pikun.', 5, 28500, 1, 1, 1, '2023-05-24 07:06:34', '2023-05-24 16:02:46'),
(9, 'seafood', 'Ikan Bandeng fresh', '646db7d13d560Ikan Bandeng.png', 500, 'gr', 'Ikan bandeng merupakan salah satu makanan yang kaya akan zat besi. 100g bandeng mengandung 2 mg zat besi yang membantu dalam produksi sel darah dan mempercepat proses penyembuhan luka. Selain itu, konsumsi bandeng kaya zat besi mencegah anemia', 2, 27000, 1, 1, 1, '2023-05-24 07:08:01', '2023-05-24 16:02:46'),
(10, 'seafood', 'Ikan Cakalang fresh', '646db84ad4eb1ikan cakalang.png', 1, 'kg', 'Ikan cakalang mengandung protein lengkap dan kaya asam lemak omega 3. Tak hanya itu, ikan ini juga berkhasiat menurunkan kadar gula darah dan menjaga kesehatan jantung.', 5, 42500, 1, 1, NULL, '2023-05-24 07:10:02', '2023-05-24 07:10:02'),
(11, 'seafood', 'Ikan Gurame fresh', '646db8a6be9dfIkan gurame.png', 1, 'kg', 'Manfaat ikan gurame tidak hanya menyasar tubuh bagian dalam saja. Ternyata, ikan ini juga mampu menjaga kesehatan kulit. Lagi-lagi, efek ini berasal dari proteinnya. Nah, kandungan protein dan vitamin E pada gurami disinyalir mampu meregenerasi kulit, sehingga kulit tetap halus dan sehat.', 5, 40000, 1, 1, NULL, '2023-05-24 07:11:34', '2023-05-24 07:11:34'),
(12, 'seafood', 'Ikan Tongkol fresh', '646db8f703e49ikan tongkol.png', 1, 'kg', 'Ikan ini juga mengandung zat besi dan vitamin B1 dalam jumlah yang baik. Karena tongkol termasuk dalam kategori “ikan berminyak”, mereka adalah salah satu sumber omega-3 terbaik yang merupakan lemak baik untuk menjaga kesehatan jantung dan otak.', 5, 45000, 1, 1, NULL, '2023-05-24 07:12:55', '2023-05-24 07:12:55'),
(13, 'seafood', 'Ikan Kembung fresh', '646db94f789abIkan Kembung.png', 1, 'kg', 'Kandungan ikan kembung terdapat asam lemak omega-3 yang ada pada ikan kembung berfungsi sebagai agen antiperadangan.', 5, 50000, 1, 1, NULL, '2023-05-24 07:14:23', '2023-05-24 07:14:23'),
(14, 'seafood', 'Ikan Tuna fresh', '646db9ac4ad95Ikan Tuna.png', 1, 'kg', 'Ikan tuna dapat mengkontrol gula darah. Hal ini karena ikan tuna bebas dari karbohidrat dan memberikan nutrisi yang bermanfaat untuk manajemen diabetes. Selain itu, ikan ini juga tinggi omega-3, terutama jenis tuna albacore.', 5, 70000, 1, 1, NULL, '2023-05-24 07:15:56', '2023-05-24 07:15:56'),
(15, 'seafood', 'Kakap merah fresh', '646dba0e01a42Kakap merah.png', 1, 'kg', 'Selain mengandung vitamin A, ikan kakap merah juga mengandung kalsium, vitamin D dan vitamin E. Kalsium dan vitamin D berguna untuk menjaga kepadatan tulang, sehingga tulang tidak mudah keropos. Sementara itu vitamin E berguna untuk pembentukan sel darah merah.', 5, 74500, 1, 1, NULL, '2023-05-24 07:17:34', '2023-05-24 07:17:34'),
(16, 'seafood', 'Ikan Lele dumbo', '646dba56b4149Lele-Dumbo.jpeg', 1, 'kg', 'Ikan lele mengandung protein di dalamnya. Dengan mengonsumsi ikan lele, kamu bisa memenuhi 18 gram protein setiap harinya yang setara dengan 26 persen kebutuhan harian.', 5, 32000, 1, 1, NULL, '2023-05-24 07:18:46', '2023-05-24 07:18:46'),
(17, 'seafood', 'Nila merah fresh', '646dbaa50648aNila-Merah.jpeg', 1, 'kg', 'Ikan nila memiliki kandungan asam lemak omega 3. Nutrisi ini bisa membantu menjaga kadar kolesterol tubuh.', 5, 35000, 1, 1, NULL, '2023-05-24 07:20:05', '2023-05-24 07:20:05'),
(18, 'seafood', 'Cumi-cumi fresh', '646dbae202829Cumi-cumi.png', 1, 'kg', 'Selain mengandung lemak baik, cumi-cumi juga diketahui mengandung kalium yang tinggi. Mineral ini berguna untuk membantu menurunkan tekanan darah.', 5, 64000, 1, 1, NULL, '2023-05-24 07:21:06', '2023-05-24 07:21:06'),
(19, 'seafood', 'Kepiting laut fresh', '646dbb37bda4bkepiting fresh.png', 1, 'kg', 'Tidak hanya tinggi protein, kepiting juga kaya akan kalsium. Kalsium merupakan mineral yang dapat membantu menjaga masa tulang dan mencegah osteoporosis. Selain baik untuk tulang, tercukupinya kebutuhan kalisum juga akan membantu sel saraf, jantung, dan otot, agar tetap bisa berfungsi dengan baik.', 5, 65000, 1, 1, NULL, '2023-05-24 07:22:31', '2023-05-24 07:22:31'),
(20, 'seafood', 'Udang laut ukuran sedang', '646dbb83d9244Udang-putih.jpeg', 500, 'gr', 'Udang kaya akan beberapa vitamin dan mineral, dan merupakan sumber protein yang baik. Konsumsi udang dapat meningkatkan kesehatan jantung dan otak karena kandungan asam lemak omega-3 dan antioksidan astaxanthin', 10, 38000, 1, 1, NULL, '2023-05-24 07:23:47', '2023-05-24 07:23:47'),
(21, 'seafood', 'Kerang dara fresh', '646dbc42729ackerang dra.jpg', 1, 'kg', 'Manfaat Kerang bagi kesehatan adalah mengatasi anemia, menjaga kesehatan jantung, membentuk dan merawat otot, membantu menjaga sistem imun.', 5, 30000, 1, 1, NULL, '2023-05-24 07:26:58', '2023-05-24 07:26:58'),
(22, 'meat', 'Ceker Ayam fresh', '64705ec7f23d1ceker ayam.png', 1, 'kg', NULL, 10, 20000, 1, 1, NULL, '2023-05-26 07:24:56', '2023-05-26 07:24:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `review` longtext NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `reviews`
--

INSERT INTO `reviews` (`id`, `transaction_id`, `rating`, `review`, `user_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'Admin sangat amanah dan fast respon', 3, 3, NULL, '2023-05-24 07:47:36', '2023-05-24 07:47:36'),
(2, 2, 2, 'Pesanan diantar sangat lama', 3, 3, NULL, '2023-05-24 07:49:49', '2023-05-24 07:49:49'),
(3, 5, 5, 'good', 3, 3, NULL, '2023-05-24 16:03:03', '2023-05-24 16:03:03'),
(4, 6, 1, 'bad', 3, 3, NULL, '2023-05-24 16:03:18', '2023-05-24 16:03:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_code` varchar(255) NOT NULL,
  `receiver_name` varchar(255) NOT NULL,
  `receiver_phone` varchar(255) NOT NULL,
  `receiver_address` text NOT NULL,
  `note` longtext DEFAULT NULL,
  `proof_of_payment` longtext DEFAULT NULL,
  `status` enum('pending','paid','confirmed','delivered','failed','success') NOT NULL DEFAULT 'pending',
  `proof_of_receipt` longtext DEFAULT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `shipping_price` int(11) NOT NULL,
  `total_payment` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_code`, `receiver_name`, `receiver_phone`, `receiver_address`, `note`, `proof_of_payment`, `status`, `proof_of_receipt`, `is_confirmed`, `user_id`, `payment_method`, `total_price`, `shipping_price`, `total_payment`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'TRX-2023-0001', 'Fafa', '082164537280', 'Dusun Paogadung RT 3/RW 3', 'Taru saja di depan teras', '646dbe973db40-bukti dana.png', 'success', NULL, 0, 3, 1, 123000, 10000, 113000, 3, 1, '2023-05-24 07:33:09', '2023-05-24 07:43:00'),
(2, 'TRX-2023-0002', 'Faqih', '085615123910', 'Dusun paogadung', 'taru saja di pagar', NULL, 'success', '646dc1662786d-bukti dana.png', 0, 3, 2, 213500, 10000, 203500, 3, 1, '2023-05-24 07:34:20', '2023-05-24 07:48:54'),
(3, 'TRX-2023-0003', 'darma', '01828921872', 'Panarukan', 'cantol di pagar mas', NULL, 'failed', NULL, 0, 3, 2, 175000, 10000, 165000, 3, 1, '2023-05-24 08:10:23', '2023-05-24 08:10:56'),
(4, 'TRX-2023-0004', 'Caca', '01239821732', 'Panrukan', 'lempar saja', '646dc88befeb2-bukti dana.png', 'failed', NULL, 0, 4, 1, 132500, 10000, 122500, 4, 1, '2023-05-24 08:18:20', '2023-05-24 08:19:40'),
(5, 'TRX-2023-0005', 'faqih', '0123826196', 'sumberkolak', 'lempar ke dalam', NULL, 'success', '646e343cc64ac-bukti dana.png', 0, 3, 2, 267500, 10000, 257500, 3, 1, '2023-05-24 15:57:25', '2023-05-24 15:58:53'),
(6, 'TRX-2023-0006', 'faqih', '081273821', 'panarukan', 'taru di meja', '646e34f36408f-bukti dana.png', 'success', NULL, 0, 3, 1, 540500, 10000, 530500, 3, 1, '2023-05-24 16:00:54', '2023-05-24 16:02:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `product_id`, `qty`, `price`, `total_price`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 28000, 56000, 3, NULL, '2023-05-24 07:33:10', '2023-05-24 07:33:10'),
(2, 1, 8, 2, 28500, 57000, 3, NULL, '2023-05-24 07:33:10', '2023-05-24 07:33:10'),
(3, 2, 5, 5, 24500, 122500, 3, NULL, '2023-05-24 07:34:20', '2023-05-24 07:34:20'),
(4, 2, 9, 3, 27000, 81000, 3, NULL, '2023-05-24 07:34:20', '2023-05-24 07:34:20'),
(5, 3, 6, 3, 55000, 165000, 3, NULL, '2023-05-24 08:10:23', '2023-05-24 08:10:23'),
(6, 4, 5, 5, 24500, 122500, 4, NULL, '2023-05-24 08:18:20', '2023-05-24 08:18:20'),
(7, 5, 3, 5, 27000, 135000, 3, NULL, '2023-05-24 15:57:25', '2023-05-24 15:57:25'),
(8, 5, 5, 5, 24500, 122500, 3, NULL, '2023-05-24 15:57:25', '2023-05-24 15:57:25'),
(9, 6, 1, 8, 45500, 364000, 3, NULL, '2023-05-24 16:00:54', '2023-05-24 16:00:54'),
(10, 6, 8, 3, 28500, 85500, 3, NULL, '2023-05-24 16:00:54', '2023-05-24 16:00:54'),
(11, 6, 9, 3, 27000, 81000, 3, NULL, '2023-05-24 16:00:54', '2023-05-24 16:00:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sex` int(11) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `sex`, `phone`, `address`, `avatar`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Ibu ida', 1, '08123891287', 'Mastrip POBOX 164 Jember', '646dc923a5b26foto 11.jpeg', 'admin@mail.com', NULL, '$2y$10$.cdDUItGUkSoM5VzDx5/8eMA/Na5WWxugPUWOuPrsBoRDvM8F2iaG', 'admin', NULL, '2023-05-24 06:49:55', '2023-05-25 08:53:03', 1),
(2, 'Ibnu', 1, '081515144981', 'Sumber Sari, Jember, Jawa Timur', '646dc57dde86fLogo-Polije-Politeknik-Negeri-Jember-Original.png', 'ibnu@mail.com', NULL, '$2y$10$psWmrS.4BLYJ.rZbSc7ek.xhlwPyhZkA88JXCGifM8A.CsHnNU15a', 'user', NULL, '2023-05-22 21:55:57', '2023-05-24 08:07:33', 1),
(3, 'Haris Faqih Darmawan', 1, '081515144981', 'Sumber Sari, Jember, Jawa Timur', '646dbc7b3b157foto 11.jpeg', 'faqihboy60@gmail.com', NULL, '$2y$10$VvK0DLVz3opf1yFCyqLjyu50WV7U/rMOYxkq922LM7d7ERgxCL.oK', 'user', NULL, '2023-05-22 22:04:49', '2023-05-24 15:56:14', 1),
(4, 'Priesca Ayu', 2, '08521819823', 'Panarukan', '646dc7b32b973IMG_20220209_080201.jpg', 'ayuca@mail.com', NULL, '$2y$10$VvADcMFrmqvEPGh70RaIkeI5WCb0Dd4xhclHaZmGfBJq/scXuxhIy', 'user', NULL, '2023-05-24 08:15:14', '2023-05-24 08:26:14', 1),
(5, 'ida shop', 2, '081218387190', 'Jl Wringin Anom', '646f21415a7e6IMG_20220209_080201.jpg', 'adminn@mail.com', NULL, '$2y$10$0pVct6tsd.ZxP0iKlTEhDuUhVcXsH8xKyyP4axqEqmlIeNu4ujPZW', 'user', NULL, '2023-05-25 08:50:10', '2023-05-25 08:50:10', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `configuration_store`
--
ALTER TABLE `configuration_store`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `configuration_store_code_unique` (`code`),
  ADD UNIQUE KEY `configuration_store_name_unique` (`name`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_created_by_foreign` (`created_by`),
  ADD KEY `products_updated_by_foreign` (`updated_by`);

--
-- Indeks untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_transaction_id_foreign` (`transaction_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_created_by_foreign` (`created_by`),
  ADD KEY `reviews_updated_by_foreign` (`updated_by`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_created_by_foreign` (`created_by`),
  ADD KEY `transactions_updated_by_foreign` (`updated_by`);

--
-- Indeks untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_details_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_details_product_id_foreign` (`product_id`),
  ADD KEY `transaction_details_created_by_foreign` (`created_by`),
  ADD KEY `transaction_details_updated_by_foreign` (`updated_by`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `configuration_store`
--
ALTER TABLE `configuration_store`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `products_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_details_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_details_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
