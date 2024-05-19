-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk posparts
DROP DATABASE IF EXISTS `posparts`;
CREATE DATABASE IF NOT EXISTS `posparts` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `posparts`;

-- membuang struktur untuk table posparts.carts
DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_merk_id` bigint unsigned NOT NULL,
  `qty` int NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `discount_price` decimal(15,2) DEFAULT '0.00',
  `total_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  KEY `carts_product_id_foreign` (`product_id`),
  KEY `carts_product_merk_id_foreign` (`product_merk_id`),
  CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_product_merk_id_foreign` FOREIGN KEY (`product_merk_id`) REFERENCES `product_merks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.carts: ~0 rows (lebih kurang)

-- membuang struktur untuk table posparts.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `logo` longtext COLLATE utf8mb4_unicode_ci,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.categories: ~8 rows (lebih kurang)
INSERT INTO `categories` (`id`, `logo`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, '662fbed8e56f3_715f6c194126171.65f74f860db32.png', 'Oli Motor', '2024-04-29 08:42:42', '2024-04-29 08:15:02', '2024-04-29 08:42:42'),
	(2, NULL, 'Ban', NULL, '2024-04-29 08:15:02', '2024-04-29 08:15:02'),
	(3, NULL, 'Aki', '2024-04-29 08:27:12', '2024-04-29 08:15:02', '2024-04-29 08:27:12'),
	(4, '662fbfec7ff2d_279d01162954295.63ddc98c149b1.jpg', 'Contoh', '2024-04-29 08:42:39', '2024-04-29 08:42:36', '2024-04-29 08:42:39'),
	(5, NULL, 'Oli', '2024-05-01 19:04:33', '2024-04-29 08:42:47', '2024-05-01 19:04:33'),
	(6, NULL, 'Minyak', NULL, '2024-04-29 08:42:55', '2024-04-29 08:42:55'),
	(7, NULL, 'Aki', NULL, '2024-04-29 08:42:59', '2024-04-29 08:42:59'),
	(8, NULL, 'Oli Motor', NULL, '2024-05-01 19:01:32', '2024-05-01 19:01:32');

-- membuang struktur untuk table posparts.destination_orders
DROP TABLE IF EXISTS `destination_orders`;
CREATE TABLE IF NOT EXISTS `destination_orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `district` text COLLATE utf8mb4_unicode_ci,
  `regency` text COLLATE utf8mb4_unicode_ci,
  `province` text COLLATE utf8mb4_unicode_ci,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plus_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `destination_orders_user_id_foreign` (`user_id`),
  CONSTRAINT `destination_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.destination_orders: ~1 rows (lebih kurang)
INSERT INTO `destination_orders` (`id`, `user_id`, `address`, `latitude`, `longitude`, `is_default`, `is_active`, `created_at`, `updated_at`, `district`, `regency`, `province`, `postal_code`, `plus_code`) VALUES
	(3, '9c04a4ad-9cd9-4447-ba7f-7e61c28350ef', 'Sumber Sari, Jember, Jawa Timur', '7.7922', '113.3125', 0, 1, '2024-05-19 06:26:17', '2024-05-19 06:26:17', 'Sumber Sari', 'Kab. Jember', 'Jawa Timur', '68121', NULL);

-- membuang struktur untuk table posparts.discounts
DROP TABLE IF EXISTS `discounts`;
CREATE TABLE IF NOT EXISTS `discounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `logo` longtext COLLATE utf8mb4_unicode_ci,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `type` enum('1','2') COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `discounts_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.discounts: ~1 rows (lebih kurang)
INSERT INTO `discounts` (`id`, `logo`, `name`, `code`, `discount`, `is_active`, `start_date`, `end_date`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '6644b0ba51a4b.png', 'DISKON 5.5', 'ABIABI', 10, 1, '2022-08-22 17:00:00', '2020-07-01 17:00:00', '1', '2024-05-15 05:55:22', '2024-05-19 06:10:18', '2024-05-19 06:10:18');

-- membuang struktur untuk table posparts.discount_stores
DROP TABLE IF EXISTS `discount_stores`;
CREATE TABLE IF NOT EXISTS `discount_stores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `discount_id` bigint unsigned NOT NULL,
  `store_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_stores_discount_id_foreign` (`discount_id`),
  KEY `discount_stores_store_id_foreign` (`store_id`),
  CONSTRAINT `discount_stores_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`),
  CONSTRAINT `discount_stores_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.discount_stores: ~0 rows (lebih kurang)

-- membuang struktur untuk table posparts.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.failed_jobs: ~0 rows (lebih kurang)

-- membuang struktur untuk table posparts.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.migrations: ~45 rows (lebih kurang)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_04_28_223830_create_permission_tables', 1),
	(6, '2024_04_29_144504_add_phone_users', 1),
	(7, '2024_04_29_145406_create_categories_table', 2),
	(8, '2024_05_04_093547_create_payment_options', 3),
	(10, '2024_05_06_124807_create_stores_table', 4),
	(11, '2024_05_06_230322_add_soft_delete_users', 5),
	(13, '2024_05_07_045054_create_products_table', 6),
	(14, '2024_05_07_094429_add_type_products', 7),
	(15, '2024_05_07_101715_remove_unique__s_k_u_column_products', 8),
	(16, '2024_05_07_125233_add_merk_column_products', 9),
	(20, '2024_05_07_130234_create_request_products_table', 10),
	(22, '2024_05_07_155719_create_product_stock_history_table', 11),
	(23, '2024_05_11_042709_create_product_categories_table', 12),
	(24, '2024_05_11_043358_add_product_categories_products', 13),
	(25, '2024_05_11_053633_add_product_category_request_products', 14),
	(26, '2024_05_11_061739_create_product_images_table', 15),
	(27, '2024_05_11_075325_create_product_merks_table', 16),
	(28, '2024_05_11_131429_add_cards_information_users', 16),
	(29, '2024_05_11_134023_add_addtional_information_users', 17),
	(30, '2024_05_11_141017_change_nik_type_users', 18),
	(31, '2024_05_12_174018_add_image_product_category', 19),
	(32, '2024_05_14_223525_add_product_category_id_product_merks', 20),
	(33, '2024_05_14_223755_add_product_merk_id_products', 21),
	(34, '2024_05_14_224317_add_product_merk_id_request_products', 22),
	(35, '2024_05_13_155842_create_table_discounts', 23),
	(36, '2024_05_15_125353_change_type_nullable_discounts', 24),
	(37, '2024_05_15_143204_create_carts_table', 25),
	(38, '2024_05_16_145316_create_transactions_table', 26),
	(39, '2024_05_16_153658_create_destination_orders_table', 27),
	(41, '2024_05_16_164332_create_transaction_details_table', 28),
	(42, '2024_05_19_042902_remove_product_id_transaction_detail', 29),
	(43, '2024_05_19_044750_remove_price_transaction_details', 30),
	(44, '2024_05_19_045148_add_destination_order_id_transaction_detail', 31),
	(45, '2024_05_17_225536_cretae_discounts_store_tabel', 32),
	(46, '2024_05_19_052311_add_transaction_code_transaction_detail', 33),
	(47, '2024_05_19_061313_remove_transaction_id_transaction_details', 34),
	(48, '2024_05_19_125530_add_some_columns_transaction_detail', 35),
	(49, '2024_05_19_050952_create_table_wallet', 36),
	(50, '2024_05_19_131925_add_some_column_destination_orders', 37),
	(51, '2024_05_19_134143_add_discount_price_carts', 38),
	(52, '2024_05_19_141158_add_profile_fill_users', 39);

-- membuang struktur untuk table posparts.model_has_permissions
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.model_has_permissions: ~0 rows (lebih kurang)

-- membuang struktur untuk table posparts.model_has_roles
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.model_has_roles: ~17 rows (lebih kurang)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', '9bec89f4-56d2-4b84-a857-d785c1dfd015'),
	(2, 'App\\Models\\User', '9bec89f4-9738-4029-806f-a6ac2d23e571'),
	(3, 'App\\Models\\User', '9bec89f4-b991-49fe-8326-c5b162bac9fc'),
	(2, 'App\\Models\\User', '9bfb3e08-aa04-4477-a2ff-0facc6639e60'),
	(2, 'App\\Models\\User', '9bfb3e40-cb06-452e-993d-46f9f8224a12'),
	(2, 'App\\Models\\User', '9bfb3e7e-b0ef-418a-b9e8-ac957320332b'),
	(2, 'App\\Models\\User', '9bfb3eb6-1147-4f36-8f0a-45d5c6a73f0b'),
	(2, 'App\\Models\\User', '9bfb3ef6-fc26-4892-923a-f89ef800c66f'),
	(2, 'App\\Models\\User', '9bfb40d6-a8dd-456d-ad7c-e4b1ac6cd489'),
	(2, 'App\\Models\\User', '9bfb4109-e9b3-4b9e-b271-079b6f633910'),
	(3, 'App\\Models\\User', '9bfb9136-df00-4099-8eb5-4b8a3fdbc88e'),
	(1, 'App\\Models\\User', '9c03cf8f-f3cc-4fd0-a226-35df7556fcc7'),
	(2, 'App\\Models\\User', '9c03cf90-1ff5-42a9-9240-d9a344c82fc2'),
	(3, 'App\\Models\\User', '9c03cf90-46f3-4a38-9808-6d8077e80c4e'),
	(2, 'App\\Models\\User', '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec'),
	(3, 'App\\Models\\User', '9c04a4ad-9cd9-4447-ba7f-7e61c28350ef'),
	(2, 'App\\Models\\User', '9c149d7f-c031-4c2b-8869-2a62afbd5d5f');

-- membuang struktur untuk table posparts.password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.password_reset_tokens: ~0 rows (lebih kurang)

-- membuang struktur untuk table posparts.payment_options
DROP TABLE IF EXISTS `payment_options`;
CREATE TABLE IF NOT EXISTS `payment_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `admin_fee` int DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.payment_options: ~3 rows (lebih kurang)
INSERT INTO `payment_options` (`id`, `name`, `description`, `status`, `admin_fee`, `duration`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(2, 'COD (Cash On Delivery)', 'Pembayaran dilokasi', '1', 10, NULL, NULL, '2024-05-06 16:43:59', '2024-05-06 16:43:59'),
	(3, 'Transfer Bank', 'Transfer ke nomer rekening tertera', '1', 10, NULL, NULL, '2024-05-16 09:42:28', '2024-05-16 09:42:28'),
	(4, 'Paylater', 'pembayaran cicilan', '1', 10, NULL, NULL, '2024-05-16 09:42:43', '2024-05-16 09:42:43');

-- membuang struktur untuk table posparts.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.permissions: ~25 rows (lebih kurang)
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'create_user', 'web', NULL, NULL),
	(2, 'read_user', 'web', NULL, NULL),
	(3, 'update_user', 'web', NULL, NULL),
	(4, 'delete_user', 'web', NULL, NULL),
	(5, 'create_role', 'web', NULL, NULL),
	(6, 'read_role', 'web', NULL, NULL),
	(7, 'update_role', 'web', NULL, NULL),
	(8, 'delete_role', 'web', NULL, NULL),
	(9, 'create_permission', 'web', NULL, NULL),
	(10, 'read_permission', 'web', NULL, NULL),
	(11, 'update_permission', 'web', NULL, NULL),
	(12, 'delete_permission', 'web', NULL, NULL),
	(13, 'create_category', 'web', NULL, NULL),
	(14, 'read_category', 'web', NULL, NULL),
	(15, 'update_category', 'web', NULL, NULL),
	(16, 'delete_category', 'web', NULL, NULL),
	(17, 'create_payment_option', 'web', NULL, NULL),
	(18, 'read_payment_option', 'web', NULL, NULL),
	(19, 'update_payment_option', 'web', NULL, NULL),
	(20, 'delete_payment_option', 'web', NULL, NULL),
	(21, 'create_store', 'web', NULL, NULL),
	(22, 'read_store', 'web', NULL, NULL),
	(23, 'update_store', 'web', NULL, NULL),
	(24, 'delete_store', 'web', NULL, NULL),
	(25, 'request-product', 'web', '2024-05-07 06:47:05', '2024-05-07 06:47:05');

-- membuang struktur untuk table posparts.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.personal_access_tokens: ~0 rows (lebih kurang)

-- membuang struktur untuk table posparts.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` bigint unsigned NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SKU` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SKU_seller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `machine_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SAE` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_category_id` bigint unsigned NOT NULL,
  `product_merk_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_store_id_foreign` (`store_id`),
  KEY `products_user_id_foreign` (`user_id`),
  KEY `products_product_category_id_foreign` (`product_category_id`),
  KEY `products_product_merk_id_foreign` (`product_merk_id`),
  CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`),
  CONSTRAINT `products_product_merk_id_foreign` FOREIGN KEY (`product_merk_id`) REFERENCES `product_merks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.products: ~63 rows (lebih kurang)
INSERT INTO `products` (`id`, `store_id`, `user_id`, `SKU`, `SKU_seller`, `name`, `type`, `machine_name`, `SAE`, `manufacturer`, `merk`, `stock`, `size`, `unit`, `price`, `discount`, `created_at`, `updated_at`, `product_category_id`, `product_merk_id`) VALUES
	('0a9eb793-be80-45ee-8f46-79cad4267db0', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1201', '', 'IRC BAN MOTOR 120/70-17 RX 01 TUBELESS', 'RX', '-', '-', '-', NULL, 0, '120/70-17', 'PCS', 347625.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('0c00e2b7-cba3-4733-b073-27be5deed5a4', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'MAI-1101', '', 'IRC BAN MOTOR 110/70-17 RX-02 TUBELESS', 'RX-02', '-', '-', '-', NULL, 9, '110/70-17', 'PCS', 334125.00, 10.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('0d252ee5-8771-41a4-9203-e0bf8baff664', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1101', '', 'IRC BAN MOTOR 110/70-17 RX-01 TUBELESS', 'RX-01', '-', '-', '-', NULL, 34, '110/70-17', 'PCS', 329400.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('1b87f81c-9682-4f9b-b627-54193599f26d', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1104', '', 'IRC BAN MOTOR 110/70-17 EXATO NR 88 TUBELESS', 'EXATO', '-', '-', '-', NULL, 15, '110/70-17', 'PCS', 329400.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('1d58e518-b6a6-45fa-9a83-8022c6b241e5', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAF-1102', '', 'IRC BAN MOTOR 110/80-14 SCT 005 TUBELESS', 'SCT', '-', '-', '-', NULL, 33, '110/80-14', 'PCS', 255150.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('1e2fc2e0-2aa1-4ef0-b0c0-fbf0e3969643', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAF-1402', '', 'IRC BAN MOTOR 140/70-14 SCT 005 R TUBELESS', 'SCT', '-', '-', '-', NULL, 85, '140/70-14', 'PCS', 344250.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('1fea8b05-62b1-4dcf-9ea9-8882b5e650b8', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1104 TH21-22 SUB 30 - KE', '', 'IRC BAN MOTOR 110/70-17 EXATO NR 88 TUBELESS TAHUN PRODUKSI 2021-2022  SURABAYA 30% - KUDU ENTEK', 'EXATO', '-', '-', '-', NULL, 0, '110/70-17', 'PCS', 251700.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('22213dc2-518b-4915-be15-74c241de8aa1', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAF-1007', '', 'IRC BAN MOTOR 100/70-14 NR 82 BAN LUAR', 'NR', '-', '-', '-', NULL, 0, '100/70-14', 'PCS', 174675.00, 0.00, '2024-05-15 06:24:38', '2024-05-15 06:24:38', 1, 3),
	('2321e666-0bc4-42d5-ba5b-2d5d661b4dc0', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IBD-1102', '', 'IRC BAN MOTOR 110/90-12 MB 67 TL TUBELESS', 'MB', '-', '-', '-', NULL, 108, '110/90-12', 'PCS', 228150.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('271395e3-779f-4e76-b11e-5cc14ec19dcf', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1202', '', 'IRC BAN MOTOR 120/70-17 NF 67 TUBELESS', 'NF', '-', '-', '-', NULL, 9, '120/70-17', 'PCS', 347625.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('27be7f75-66c0-4c70-b735-a5ba956ca1e0', 7, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', 'EVA GL-4 SAE 140 1 L (DUS)', '', 'EVALUBE GL-4 SAE 140 1 L (DUS)', 'GL-4', '-', '-', '-', NULL, 5, 'L(DUS)', 'DUS', 968100.00, 0.00, '2024-05-19 06:04:37', '2024-05-19 06:04:37', 2, 5),
	('282d48eb-ef5e-43b6-8479-ff2f4b6112de', 7, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', 'EVA DEO TRANZ SAE 40 5 L (DUS)', '', 'EVALUBE DEO TRANZ SAE 40 5 L (DUS)', 'DEO', '-', '-', '-', NULL, 5, '5L', 'DUS', 674960.00, 0.00, '2024-05-19 06:04:37', '2024-05-19 06:04:37', 2, 5),
	('35ee49ab-a672-4349-aadf-1b329ad63bae', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'MAI-1401', '', 'IRC BAN MOTOR 140/70-17 RX 02 TUBELESS', 'RX', '-', '-', '-', NULL, 4, '140/70-17', 'PCS', 482625.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('3a04c3ad-ab70-45ef-876f-795115248fb5', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1003', '', 'IRC BAN MOTOR 100/80-17 RX 01 TUBELESS', 'RX', '-', '-', '-', NULL, 0, '100/80-17', 'PCS', 282150.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('3ecc1e12-e2b2-4ee8-b540-8df3c55b4559', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAF-1010', '', 'IRC BAN MOTOR 100/80-14 SCT-006 TUBELESS', 'SCT-006', '-', '-', '-', NULL, 185, '100/80-14', 'PCS', 230850.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('44cd4268-3927-43cc-926e-cfe441d96c3c', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAF-1002', '', 'IRC BAN MOTOR 100/70-14 NR 84 BAN LUAR', 'NR', '-', '-', '-', NULL, 0, '100/70-14', 'PCS', 164400.00, 0.00, '2024-05-15 06:24:38', '2024-05-15 06:24:38', 1, 3),
	('45d13c84-16b2-4d83-9882-c75c847db46c', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1307', '', 'IRC BAN MOTOR 130/70-17 EXATO NR 88 TUBELESS', 'EXATO', '-', '-', '-', NULL, 0, '130/70-17', 'PCS', 432000.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('4e0d99df-8f14-44dc-912f-268d87537701', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAE-1101', '', 'IRC BAN MOTOR 110/70-13 SS 570 TUBELESS', 'SS', '-', '-', '-', NULL, 136, '110/70-13', 'PCS', 230850.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('52a614e3-b1ce-43b5-a4f6-39db5e841ae2', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'ICI1401 TH21-22 SUB 30 - KE', '', 'IRC BAN MOTOR 140/70-17 FASTI 1 TUBELESS TAHUN PRODUKSI 2021-2022 SURABAYA 30% - KUDU ENTEK', 'FASTI', '-', '-', '-', NULL, 0, '140/70-17', 'PCS', 433100.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('5399cb11-765b-4d1a-b7fd-0a9e58522de4', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1304', '', 'IRC BAN MOTOR 130/70-17 RX-01 TUBELESS', 'RX-01', '-', '-', '-', NULL, 50, '130/70-17', 'PCS', 432000.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('555d7528-fb59-4d1d-9357-5b1ec5c39ffc', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAE-1301', '', 'IRC BAN MOTOR 130/70-13 SS 560 R TUBELESS', 'SS', '-', '-', '-', NULL, 223, '130/70-13', 'PCS', 286875.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('5773eea0-c3e6-4129-bebb-21ea07f372f9', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1203', '', 'IRC BAN MOTOR 120/70-17 EXATO NR 88 TUBELESS', 'EXATO', '-', '-', '-', NULL, 0, '120/70-17', 'PCS', 347625.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('57a4c5b3-e2e7-464d-a6f7-2319a0819cdd', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAF-1104', '', 'IRC BAN MOTOR 110/70-14 SCT 006 TUBELESS', 'SCT', '-', '-', '-', NULL, 24, '110/70-14', 'PCS', 249750.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('5950a84b-bd12-4cf1-a623-e4463b988ff3', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1009', '', 'IRC BAN MOTOR 100/80-17 EXATO NR 88 TUBELESS', 'EXATO', '-', '-', '-', NULL, 0, '100/80-17', 'PCS', 282150.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('67d2ab47-bd66-4b6e-86f4-fee55e40b87a', 7, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', 'EVA GEAR OIL 120 ML (DUS)', '', 'EVALUBE SCOOTIC GEAR OIL 120ML (DUS)', '(DUS)', '-', '-', '-', NULL, 4, '120ML', 'DUS', 123624.00, 0.00, '2024-05-19 06:04:37', '2024-05-19 06:04:37', 2, 5),
	('6888c63d-f89e-4111-abfb-122e6436b2a5', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1011', '', 'IRC BAN MOTOR 100/80-17 RX-01 BAN LUAR', 'RX-01', '-', '-', '-', NULL, 0, '100/80-17', 'PCS', 229475.00, 0.00, '2024-05-15 06:24:38', '2024-05-15 06:24:38', 1, 3),
	('7a802f2a-fa60-4d3e-bd08-a647f063ce23', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'MAI-1601', '', 'IRC BAN MOTOR 160/70-17 RX 02 TUBELESS', 'RX', '-', '-', '-', NULL, 5, '160/70-17', 'PCS', 563625.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('83f706c9-e342-4943-8de7-0accc64e6f1b', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAF-1006', '', 'IRC BAN MOTOR 100/80-14 REBORN NR 87 TUBELESS', 'REBORN', '-', '-', '-', NULL, 0, '100/80-14', 'PCS', 230850.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('8808b163-88c4-48ea-a14e-7a5a373fe0b8', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1501', '', 'IRC BAN MOTOR 150/60-17 EXATO NR 88 TUBELESS', 'EXATO', '-', '-', '-', NULL, 0, '150/60-17', 'PCS', 496125.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('89871c42-f636-4fd6-8940-ec61a0535920', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IBD-1103', '', 'IRC BAN MOTOR 110/90-12 NR 83 TUBELESS', 'NR', '-', '-', '-', NULL, 52, '110/90-12', 'PCS', 228150.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('8c105c2a-fd7e-4d44-8599-303054db3dc9', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IBD-1001', '', 'IRC BAN MOTOR 100/90-12 MB 86 TUBELESS', 'MB', '-', '-', '-', NULL, 119, '100/90-12', 'PCS', 190350.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('8c212883-c6b9-4cb1-89a2-512ffddb2a5d', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1004', '', 'IRC BAN MOTOR 100/70-17 NR 82 BAN LUAR', 'NR', '-', '-', '-', NULL, 18, '100/70-17', 'PCS', 232900.00, 0.00, '2024-05-15 06:24:38', '2024-05-15 06:24:38', 1, 3),
	('8d1485bb-7af6-4f8d-9a82-1055749afb45', 7, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', 'EVA 2T (DUS)', '', 'EVALUBE OLI 2T 0.7 L (DUS)', '-', '-', '-', '-', NULL, 499, 'L', 'DUS', 438600.00, 0.00, '2024-05-19 06:04:37', '2024-05-19 06:04:37', 2, 5),
	('91fb5af5-fee2-46fa-850e-33144e6b03f1', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAE-1201', '', 'IRC BAN MOTOR 120/70-13 EXATO NR 88 TUBELESS', 'EXATO', '-', '-', '-', NULL, 0, '120/70-13', 'PCS', 266625.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('93bb23ca-2630-43bb-82a1-6e587dfef116', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'MAI-1101 TH21-22 SUB 30 - KE', '', 'IRC BAN MOTOR 110/70-17 RX-02 TUBELESS TAHUN PRODUKSI 2021-2022 SURABAYA 30% - KUDU ENTEK', 'RX-02', '-', '-', '-', NULL, 0, '110/70-17', 'PCS', 255300.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('96d0bbaa-ec91-4a68-be34-c11915802d82', 7, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', 'EVA GL-4 SAE 90 1 L (DUS)', '', 'EVALUBE GL-4 SAE 90 1 L (DUS)', 'GL-4', '-', '-', '-', NULL, 10, 'L(DUS)', 'DUS', 846300.00, 0.00, '2024-05-19 06:04:37', '2024-05-19 06:04:37', 2, 5),
	('96e33e85-b715-43a0-9935-3b409087e167', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'MAI-1301', '', 'IRC BAN MOTOR 130/70-17 RX 02 TUBELESS', 'RX', '-', '-', '-', NULL, 10, '130/70-17', 'PCS', 445500.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('999f50fd-6680-468d-a7f5-d8dc43b9e601', 7, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', 'EVA SCTCMX 20W50 0.8 L (DUS)', '', 'EVALUBE OLI MOTOR SCOOTIC MX JASO MB 20W50 0.8 L (DUS)', '-', '-', '-', '-', NULL, 30, 'JASOMB', 'DUS', 354960.00, 0.00, '2024-05-19 06:04:37', '2024-05-19 06:04:37', 2, 5),
	('9e47349e-51ba-4468-a806-5408412963f5', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAF-1012', '', 'IRC BAN MOTOR 100/80-14 GP 5 TUBELESS', 'GP', '-', '-', '-', NULL, 0, '100/80-14', 'PCS', 230850.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('a0683412-ecc0-4956-acd0-63e0c6ce8adb', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAJ-1004', '', 'IRC BAN MOTOR 100/100-18 IX-09W BAN LUAR', 'IX-09W', '-', '-', '-', NULL, 0, '100/100-18', 'PCS', 624750.00, 0.00, '2024-05-15 06:24:38', '2024-05-15 06:24:38', 1, 3),
	('a1e0f976-e8b4-4c42-8dff-a9913d2f0247', 7, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', 'EVA SUPER TRANSCO SAE 15W40 5 L (DUS)', '', 'EVALUBE SUPER TRANSCO SAE 15W40 5 L (DUS)', 'SUPER', '-', '-', '-', NULL, 2, '5L', 'DUS', 939840.00, 0.00, '2024-05-19 06:04:37', '2024-05-19 06:04:37', 2, 5),
	('a7d50fed-0974-4722-84c3-2a91a45e94b4', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'MAI-1501', '', 'IRC BAN MOTOR 150/70-17 RX 02 TUBELESS', 'RX', '-', '-', '-', NULL, 4, '150/70-17', 'PCS', 519750.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('b04b480d-ede5-4911-9823-6377a99acb01', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAE-1401', '', 'IRC BAN MOTOR 140/70-13 EXATO NR 88 TUBELESS', 'EXATO', '-', '-', '-', NULL, 0, '140/70-13', 'PCS', 361125.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('b4f6ffcd-b57a-4ae3-ac4a-5857cee555da', 7, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', 'EVA MTC SCTC HX 10W30 0.8 L (DUS)', '', 'EVALUBE OLI MOTOR MATIC SCOOTIC HX SAE 10W-30 0.8 L (DUS)', '-', '-', '-', '-', NULL, 25, 'HXSAE', 'DUS', 425952.00, 0.00, '2024-05-19 06:04:37', '2024-05-19 06:04:37', 2, 5),
	('b5e8c7e3-00e4-4de3-a7b6-557716ea3f95', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1401', '', 'IRC BAN MOTOR 140/70-17 RX 01 R TUBELESS', 'RX', '-', '-', '-', NULL, 45, '140/70-17', 'PCS', 460350.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('b669d632-1f26-4586-b9c0-28f8c9524c5e', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAF-1014', '', 'IRC BAN MOTOR 100/80-14 EXATO NR 88 TUBELESS', 'EXATO', '-', '-', '-', NULL, 33, '100/80-14', 'PCS', 230850.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('bf0d1c4a-dfd1-485a-a064-6b0d232f124d', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1501 TH21-22 SUB 30 - KE', '', 'IRC BAN MOTOR 150/60-17 EXATO NR 88 TUBELESS TAHUN PRODUKSI 2021-2022 SURABAYA 30% - KUDU ENTEK', 'EXATO', '-', '-', '-', NULL, 0, '150/60-17', 'PCS', 379000.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('c439ad18-cd6a-4c9e-83c5-c99f62616593', 7, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', 'EVA MTC SCTC YX 20W40 0.8 L (DUS)', '', 'EVALUBE OLI MOTOR MATIC SCOOTIC YX KUNING 20W-40 0.8 L (DUS)', '-', '-', '-', '-', NULL, 25, 'YXKUNING', 'DUS', 402696.00, 0.00, '2024-05-19 06:04:37', '2024-05-19 06:04:37', 2, 5),
	('c6370735-c3ca-45ab-922a-ed512f02e664', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAF-1202', '', 'IRC BAN MOTOR 120/70-14 SCT 007 TUBELESS', 'SCT', '-', '-', '-', NULL, 209, '120/70-14', 'PCS', 276750.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('cbb80dd3-ed65-46a0-8eca-464ff72ea61a', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'MAI-1201', '', 'IRC BAN MOTOR 120/70-17 RX 02 TUBELESS', 'RX', '-', '-', '-', NULL, 0, '120/70-17', 'PCS', 357750.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('d23c13f8-a742-4b14-8422-3ebc09e5b6d3', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAE-1304', '', 'IRC BAN MOTOR 130/70-13 EXATO NR 88 TUBELESS', 'EXATO', '-', '-', '-', NULL, 0, '130/70-13', 'PCS', 286875.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('dc014420-1d95-4703-a628-0d300a0b3a5c', 7, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', 'EVA 2T PRO(DUS)', '', 'EVALUBE OLI 2T PRO 0.7 L (DUS)', '-', '-', '-', '-', NULL, 0, 'L(DUS)', 'DUS', 558960.00, 0.00, '2024-05-19 06:04:37', '2024-05-19 06:04:37', 2, 5),
	('e4b5b685-1d0c-4ed3-b4b0-3455ce264adf', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1005', '', 'IRC BAN MOTOR 100/80-17 NR 85 TUBELESS', 'NR', '-', '-', '-', NULL, 0, '100/80-17', 'PCS', 282150.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('e87c9bb2-b52e-43ad-8e91-8018f93250de', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1207', '', 'IRC BAN MOTOR 120/70-17 NR 83 TUBELESS', 'NR', '-', '-', '-', NULL, 19, '120/70-17', 'PCS', 347625.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('ed84892c-618f-4f84-bc62-475de49a6cda', 7, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', 'EVA 4T PRO (DUS)', '', 'EVALUBE OLI 4T PRO 10W30 SL 0.8 (DUS)', '-', '-', '-', '-', NULL, 10, 'SL0.8', 'DUS', 419832.00, 0.00, '2024-05-19 06:04:37', '2024-05-19 06:04:37', 2, 5),
	('f16d4b98-7fe3-4f5d-96c7-4fd69d601cd5', 7, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', 'EVA 4T (DUS)', '', 'EVALUBE OLI 4T RUNNER 20W40 0.8 L (DUS)', '-', '-', '-', '-', NULL, 400, '0.8L', 'DUS', 538560.00, 0.00, '2024-05-19 06:04:37', '2024-05-19 06:04:37', 2, 5),
	('f20e4896-0ecf-40fc-8a06-5a7d98b5d521', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAF-1013', '', 'IRC BAN MOTOR 100/80-14 NR 95 TUBELESS', 'NR', '-', '-', '-', NULL, 15, '100/80-14', 'PCS', 230850.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('f5b49bed-7a43-4d0b-98b7-9911147c821a', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1004 TH21-22 SUB 30 - KE', '', 'IRC BAN MOTOR 100/70-17 NR 82 BAN LUAR TAHUN PRODUKSI 2021-2022 SURABAYA 30% - KUDU ENTEK', 'NR', '-', '-', '-', NULL, 0, '100/70-17', 'PCS', 171500.00, 0.00, '2024-05-15 06:24:38', '2024-05-15 06:24:38', 1, 3),
	('f7e546b7-cf30-45e7-a3f3-69cc85c16750', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAE-1102', '', 'IRC BAN MOTOR 110/70-13 EXATO NR 88 TUBELESS', 'EXATO', '-', '-', '-', NULL, 0, '110/70-13', 'PCS', 230850.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('f9c0300d-d214-44a2-9d41-aad131a75155', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAE-1303', '', 'IRC BAN MOTOR 130/70-13 SCT 007 TUBELESS', 'SCT', '-', '-', '-', NULL, 33, '130/70-13', 'PCS', 286875.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('fb111125-54e8-4e86-9a40-7e68187d4847', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAF-1011', '', 'IRC BAN MOTOR 100/90-14 SCT 004 TUBELESS', 'SCT', '-', '-', '-', NULL, 35, '100/90-14', 'PCS', 246375.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('fd2cf358-309c-4679-bab4-31420c4ddf04', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1205', '', 'IRC BAN MOTOR 120/70-17 RX-01 BAN LUAR', 'RX-01', '-', '-', '-', NULL, 0, '120/70-17', 'PCS', 286330.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4),
	('fdf584db-135d-40a2-9caa-3e5707f7a49d', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'IAI-1001', '', 'IRC BAN MOTOR 100/90-17 NR 25 TUBELESS', 'NR', '-', '-', '-', NULL, 46, '100/90-17', 'PCS', 282150.00, 0.00, '2024-05-15 06:30:14', '2024-05-15 06:30:14', 1, 4);

-- membuang struktur untuk table posparts.product_categories
DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.product_categories: ~5 rows (lebih kurang)
INSERT INTO `product_categories` (`id`, `name`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Ban Motor', '664101537ab1a.png', 1, NULL, '2024-05-12 10:50:11'),
	(2, 'Oli Motor', '664101647957c.png', 1, NULL, '2024-05-12 10:50:28'),
	(3, 'Oli Transmisi Dan Oli Samping', '6641018cf0f5b.png', 1, NULL, '2024-05-12 10:51:08'),
	(4, 'Bodyparts Motor', '66410196b2e77.png', 1, NULL, '2024-05-12 10:51:18'),
	(5, 'Aki Motor', '6641019cd1468.png', 1, NULL, '2024-05-12 10:51:24');

-- membuang struktur untuk table posparts.product_merks
DROP TABLE IF EXISTS `product_merks`;
CREATE TABLE IF NOT EXISTS `product_merks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_category_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_merks_store_id_foreign` (`store_id`),
  KEY `product_merks_product_category_id_foreign` (`product_category_id`),
  CONSTRAINT `product_merks_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_merks_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.product_merks: ~3 rows (lebih kurang)
INSERT INTO `product_merks` (`id`, `store_id`, `name`, `image`, `is_active`, `created_at`, `updated_at`, `product_category_id`) VALUES
	(3, 6, 'IRC Ban Luar', '1715778349_PP-MT-BL-IRC.jpeg', 1, '2024-05-15 06:05:49', '2024-05-15 06:07:29', 1),
	(4, 6, 'IRC Tubeless', '1715778699_Icon_Ban Motor_256px.png', 1, '2024-05-15 06:11:39', '2024-05-15 06:11:39', 1),
	(5, 7, 'Evalube', '1716123831_Icon_Oli Motor_256px.png', 1, '2024-05-19 06:03:51', '2024-05-19 06:03:51', 2);

-- membuang struktur untuk table posparts.product_stock_histories
DROP TABLE IF EXISTS `product_stock_histories`;
CREATE TABLE IF NOT EXISTS `product_stock_histories` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` bigint unsigned NOT NULL,
  `in_stock` int NOT NULL DEFAULT '0',
  `out_stock` int NOT NULL DEFAULT '0',
  `final_stock` int NOT NULL DEFAULT '0',
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_stock_histories_product_id_foreign` (`product_id`),
  KEY `product_stock_histories_store_id_foreign` (`store_id`),
  KEY `product_stock_histories_created_by_foreign` (`created_by`),
  CONSTRAINT `product_stock_histories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_stock_histories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_stock_histories_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.product_stock_histories: ~63 rows (lebih kurang)
INSERT INTO `product_stock_histories` (`id`, `product_id`, `store_id`, `in_stock`, `out_stock`, `final_stock`, `created_by`, `created_at`, `updated_at`) VALUES
	('04ba8c57-e523-4947-912d-c5918597d213', 'b5e8c7e3-00e4-4de3-a7b6-557716ea3f95', 6, 45, 0, 45, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('0dc65fad-5e49-4491-9c52-b595e3aca300', 'c439ad18-cd6a-4c9e-83c5-c99f62616593', 7, 25, 0, 25, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', '2024-05-19 06:04:37', '2024-05-19 06:04:37'),
	('0ed67994-4fa1-4968-bf0d-d8442458445d', '271395e3-779f-4e76-b11e-5cc14ec19dcf', 6, 9, 0, 9, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('0f99b484-0ef1-46f2-9d07-80c0f7fcc67d', 'b4f6ffcd-b57a-4ae3-ac4a-5857cee555da', 7, 25, 0, 25, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', '2024-05-19 06:04:37', '2024-05-19 06:04:37'),
	('15b4deb3-f87c-42da-b7f4-ca45effea51e', '57a4c5b3-e2e7-464d-a6f7-2319a0819cdd', 6, 24, 0, 24, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('164eb0e1-9b6a-4caa-8d44-2a89a0a9ef05', '9e47349e-51ba-4468-a806-5408412963f5', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('17feb622-5f2b-4336-b691-843b4113fd61', '8c105c2a-fd7e-4d44-8599-303054db3dc9', 6, 119, 0, 119, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('1971ed79-e91a-4088-9609-872ce1429d0b', '5773eea0-c3e6-4129-bebb-21ea07f372f9', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('1d10abc0-17c1-44a8-912d-a9ad8dada03b', 'cbb80dd3-ed65-46a0-8eca-464ff72ea61a', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('1d4d62aa-5e4b-4dce-a662-bc9c7db442d9', '555d7528-fb59-4d1d-9357-5b1ec5c39ffc', 6, 223, 0, 223, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('1ddd86e4-023b-4934-bd33-03c8831960a4', 'e4b5b685-1d0c-4ed3-b4b0-3455ce264adf', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('1ec1af1a-0105-433b-916f-6ed13e056d14', 'a7d50fed-0974-4722-84c3-2a91a45e94b4', 6, 4, 0, 4, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('2026eb24-4705-4529-95b2-fbf8d8150d7e', '8d1485bb-7af6-4f8d-9a82-1055749afb45', 7, 499, 0, 499, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', '2024-05-19 06:04:37', '2024-05-19 06:04:37'),
	('2501885d-4d12-47d4-8e72-a5c933190d57', 'e87c9bb2-b52e-43ad-8e91-8018f93250de', 6, 19, 0, 19, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('27140f53-c0ea-4989-8c39-f67dfc450780', '282d48eb-ef5e-43b6-8479-ff2f4b6112de', 7, 5, 0, 5, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', '2024-05-19 06:04:37', '2024-05-19 06:04:37'),
	('2918da8b-1956-41e2-83c9-b379efa32f82', 'ed84892c-618f-4f84-bc62-475de49a6cda', 7, 10, 0, 10, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', '2024-05-19 06:04:37', '2024-05-19 06:04:37'),
	('31a10764-8351-4251-8514-8ffdc46c9c93', '93bb23ca-2630-43bb-82a1-6e587dfef116', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('327dc8ca-63fe-4d10-83a3-1c57ce794313', 'a1e0f976-e8b4-4c42-8dff-a9913d2f0247', 7, 2, 0, 2, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', '2024-05-19 06:04:37', '2024-05-19 06:04:37'),
	('377e2f2f-b450-4c51-bcc8-58319b4a290a', '89871c42-f636-4fd6-8940-ec61a0535920', 6, 52, 0, 52, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('3ec3e15e-7b8c-45d9-87a2-8c6b0f28c592', '0c00e2b7-cba3-4733-b073-27be5deed5a4', 6, 9, 0, 9, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('49b0df23-1ca3-4ec7-a77c-bf1edad20ef1', '1d58e518-b6a6-45fa-9a83-8022c6b241e5', 6, 33, 0, 33, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('4c6a35cb-161f-4846-a6dc-3b748d80be83', '83f706c9-e342-4943-8de7-0accc64e6f1b', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('4cff681f-d83e-434e-855e-bf7124dedc9e', 'a0683412-ecc0-4956-acd0-63e0c6ce8adb', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:24:38', '2024-05-15 06:24:38'),
	('4da0c70d-ad31-4613-9e46-833feb7a380c', '27be7f75-66c0-4c70-b735-a5ba956ca1e0', 7, 5, 0, 5, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', '2024-05-19 06:04:37', '2024-05-19 06:04:37'),
	('4dc498f4-4f9c-4faf-8c51-27b6759fc600', '91fb5af5-fee2-46fa-850e-33144e6b03f1', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('4f6d6776-07c7-4657-b8f8-a9e2ec00e896', '22213dc2-518b-4915-be15-74c241de8aa1', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:24:38', '2024-05-15 06:24:38'),
	('560b8409-fb10-4fe9-8f05-55a42d804fb1', '0d252ee5-8771-41a4-9203-e0bf8baff664', 6, 34, 0, 34, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('6a292db9-1d0a-4adc-9117-67e7d7835af5', 'f20e4896-0ecf-40fc-8a06-5a7d98b5d521', 6, 15, 0, 15, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('72374255-225d-4ed8-b16e-405329782297', 'd23c13f8-a742-4b14-8422-3ebc09e5b6d3', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('78634ac9-455b-46ac-8db8-b727025d966d', '0a9eb793-be80-45ee-8f46-79cad4267db0', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('7bd7a174-8dd4-48c8-87d9-9d5be2049463', '7a802f2a-fa60-4d3e-bd08-a647f063ce23', 6, 5, 0, 5, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('836a78f8-98b5-405c-a63b-ba1b940a3f7a', '8808b163-88c4-48ea-a14e-7a5a373fe0b8', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('83c0a346-cf36-4505-af58-bc6038ade601', '52a614e3-b1ce-43b5-a4f6-39db5e841ae2', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('877cbb05-dba2-4540-953c-5af3e02e62c6', '2321e666-0bc4-42d5-ba5b-2d5d661b4dc0', 6, 108, 0, 108, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('87a539df-03be-4b09-9ad3-d4203a51f2c3', '4e0d99df-8f14-44dc-912f-268d87537701', 6, 136, 0, 136, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('8eaa4d8a-a149-4aab-aa38-ed2f73d34725', '1fea8b05-62b1-4dcf-9ea9-8882b5e650b8', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('8edf401d-b0ed-4660-9d1d-a0b9037c8457', 'bf0d1c4a-dfd1-485a-a064-6b0d232f124d', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('9557b90a-cfe9-47d0-8274-091d109bcadb', '6888c63d-f89e-4111-abfb-122e6436b2a5', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:24:38', '2024-05-15 06:24:38'),
	('9938b48e-0514-45f9-86db-e60bc3adc667', '5399cb11-765b-4d1a-b7fd-0a9e58522de4', 6, 50, 0, 50, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('99cfac7c-6e8b-465c-a18f-854b95964236', 'dc014420-1d95-4703-a628-0d300a0b3a5c', 7, 0, 0, 0, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', '2024-05-19 06:04:37', '2024-05-19 06:04:37'),
	('a25a94e5-124f-4d8d-9602-791b297a79dd', '999f50fd-6680-468d-a7f5-d8dc43b9e601', 7, 30, 0, 30, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', '2024-05-19 06:04:37', '2024-05-19 06:04:37'),
	('a3554d4a-7d26-4464-b7a5-fa3300905687', '8c212883-c6b9-4cb1-89a2-512ffddb2a5d', 6, 18, 0, 18, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:24:38', '2024-05-15 06:24:38'),
	('a54ae595-2131-4eaf-8483-f2fabc2b2831', '96d0bbaa-ec91-4a68-be34-c11915802d82', 7, 10, 0, 10, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', '2024-05-19 06:04:37', '2024-05-19 06:04:37'),
	('aa5dfbfd-5bca-4eef-9d27-fb8dc8b65a58', '44cd4268-3927-43cc-926e-cfe441d96c3c', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:24:38', '2024-05-15 06:24:38'),
	('b3b7f37c-90e4-41a6-8274-b6f97701eec0', '5950a84b-bd12-4cf1-a623-e4463b988ff3', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('b96e9c2a-3735-4d8f-9c09-429570149e15', '3ecc1e12-e2b2-4ee8-b540-8df3c55b4559', 6, 185, 0, 185, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('be98a4b5-b749-4ea7-9012-2a4614954bda', '35ee49ab-a672-4349-aadf-1b329ad63bae', 6, 4, 0, 4, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('c34bf6a5-baa7-46d4-8572-aeefab2be088', 'f5b49bed-7a43-4d0b-98b7-9911147c821a', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:24:38', '2024-05-15 06:24:38'),
	('c73290d1-4c9a-4042-936f-cfcd5c4376df', '1b87f81c-9682-4f9b-b627-54193599f26d', 6, 15, 0, 15, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('c7b65973-a0b8-4c25-8c31-be3349961537', 'c6370735-c3ca-45ab-922a-ed512f02e664', 6, 209, 0, 209, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('cac24ea3-0302-4b00-9f9a-fa334b617a51', '1e2fc2e0-2aa1-4ef0-b0c0-fbf0e3969643', 6, 85, 0, 85, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('ccc1c5ae-f7b3-4a28-abfb-1487b8822b39', 'fdf584db-135d-40a2-9caa-3e5707f7a49d', 6, 46, 0, 46, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('d580d578-3d72-40ca-ae3c-2983098db37f', 'fb111125-54e8-4e86-9a40-7e68187d4847', 6, 35, 0, 35, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('d930541e-3f4f-4694-918a-e5897d30b96d', 'f7e546b7-cf30-45e7-a3f3-69cc85c16750', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('da490216-d74f-49ba-8f2b-a6be7ead5c8e', '67d2ab47-bd66-4b6e-86f4-fee55e40b87a', 7, 4, 0, 4, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', '2024-05-19 06:04:37', '2024-05-19 06:04:37'),
	('defa6e21-7f5f-4921-90d1-d93e5d517084', 'b04b480d-ede5-4911-9823-6377a99acb01', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('dfc7f28e-2a47-43d1-a96a-b0b0c30fbbad', 'b669d632-1f26-4586-b9c0-28f8c9524c5e', 6, 33, 0, 33, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('ea13e32e-1af5-4934-a750-98151bab897e', '3a04c3ad-ab70-45ef-876f-795115248fb5', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('ea994113-fb9f-4d49-8f1e-c31d36e6e52d', 'f16d4b98-7fe3-4f5d-96c7-4fd69d601cd5', 7, 400, 0, 400, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', '2024-05-19 06:04:37', '2024-05-19 06:04:37'),
	('f5642c25-6f3f-46ea-bd16-6fb236f25d1f', 'f9c0300d-d214-44a2-9d41-aad131a75155', 6, 33, 0, 33, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('f6bf0ef5-418a-43ab-a79f-3b6490d8ed81', '45d13c84-16b2-4d83-9882-c75c847db46c', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('f9335b96-eb6d-4a93-b6cb-d4f0e451918f', '96e33e85-b715-43a0-9935-3b409087e167', 6, 10, 0, 10, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14'),
	('fbf0225b-bd88-41f9-9eb7-54f2628d0718', 'fd2cf358-309c-4679-bab4-31420c4ddf04', 6, 0, 0, 0, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', '2024-05-15 06:30:14', '2024-05-15 06:30:14');

-- membuang struktur untuk table posparts.request_products
DROP TABLE IF EXISTS `request_products`;
CREATE TABLE IF NOT EXISTS `request_products` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` bigint unsigned NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('menunggu','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback` text COLLATE utf8mb4_unicode_ci,
  `reviewed_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_category_id` bigint unsigned NOT NULL,
  `product_merk_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `request_products_store_id_foreign` (`store_id`),
  KEY `request_products_user_id_foreign` (`user_id`),
  KEY `request_products_reviewed_by_foreign` (`reviewed_by`),
  KEY `request_products_product_category_id_foreign` (`product_category_id`),
  KEY `request_products_product_merk_id_foreign` (`product_merk_id`),
  CONSTRAINT `request_products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `request_products_product_merk_id_foreign` FOREIGN KEY (`product_merk_id`) REFERENCES `product_merks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `request_products_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `request_products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `request_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.request_products: ~3 rows (lebih kurang)
INSERT INTO `request_products` (`id`, `store_id`, `user_id`, `file`, `status`, `feedback`, `reviewed_by`, `created_at`, `updated_at`, `product_category_id`, `product_merk_id`) VALUES
	('2783fc34-5428-4cbd-9dae-1180ed50f58c', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'PR-20240515132050.csv', 'diterima', 'file bagus', '9c03cf8f-f3cc-4fd0-a226-35df7556fcc7', '2024-05-15 06:20:50', '2024-05-15 06:24:38', 1, 3),
	('d4be63b3-d925-428c-b576-6c56580ec99d', 7, '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', 'PR-20240519130404.csv', 'diterima', 'tes import oli', '9c03cf8f-f3cc-4fd0-a226-35df7556fcc7', '2024-05-19 06:04:04', '2024-05-19 06:04:37', 2, 5),
	('d66dd835-1ef5-4b0f-a61f-b07101664ac7', 6, '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'PR-20240515132950.csv', 'diterima', 'bagus gais', '9c03cf8f-f3cc-4fd0-a226-35df7556fcc7', '2024-05-15 06:29:51', '2024-05-15 06:30:14', 1, 4);

-- membuang struktur untuk table posparts.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.roles: ~3 rows (lebih kurang)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'web', NULL, NULL),
	(2, 'seller', 'web', NULL, NULL),
	(3, 'buyer', 'web', NULL, NULL);

-- membuang struktur untuk table posparts.role_has_permissions
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.role_has_permissions: ~26 rows (lebih kurang)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(25, 2);

-- membuang struktur untuk table posparts.stores
DROP TABLE IF EXISTS `stores`;
CREATE TABLE IF NOT EXISTS `stores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stores_slug_unique` (`slug`),
  KEY `stores_user_id_foreign` (`user_id`),
  CONSTRAINT `stores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.stores: ~2 rows (lebih kurang)
INSERT INTO `stores` (`id`, `name`, `slug`, `user_id`, `address`, `phone`, `logo`, `status`, `created_at`, `updated_at`) VALUES
	(6, 'Toko Ibnu', 'toko-ibnu', '9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'Sumber Sari, Jember, Jawa Timur', '081515144982', 'VpZBio5RAG.png', 1, '2024-05-10 21:36:56', '2024-05-11 06:14:00'),
	(7, 'Toko Torik Ini', 'toko-torik-ini', '9c149d7f-c031-4c2b-8869-2a62afbd5d5f', 'Sumber Sari, Jember, Jawa Timur', '0832897345', NULL, 1, '2024-05-19 05:59:16', '2024-05-19 07:25:20');

-- membuang struktur untuk table posparts.transactions
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` bigint unsigned NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_qty` int DEFAULT NULL,
  `rejected_qty` int DEFAULT NULL,
  `approved_qty` int DEFAULT NULL,
  `discount_price` decimal(15,2) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `total_price` decimal(15,2) DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_user_id_foreign` (`user_id`),
  KEY `transactions_store_id_foreign` (`store_id`),
  KEY `transactions_product_id_foreign` (`product_id`),
  CONSTRAINT `transactions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transactions_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.transactions: ~5 rows (lebih kurang)
INSERT INTO `transactions` (`id`, `transaction_code`, `user_id`, `store_id`, `product_id`, `requested_qty`, `rejected_qty`, `approved_qty`, `discount_price`, `price`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
	(41, 'TRX1716127544-6', '9c04a4ad-9cd9-4447-ba7f-7e61c28350ef', 6, '0c00e2b7-cba3-4733-b073-27be5deed5a4', 2, NULL, NULL, 10.00, 334125.00, 668250.00, 'pending', '2024-05-19 07:05:44', '2024-05-19 07:05:44'),
	(42, 'TRX1716127544-6', '9c04a4ad-9cd9-4447-ba7f-7e61c28350ef', 6, '0d252ee5-8771-41a4-9203-e0bf8baff664', 2, NULL, NULL, 0.00, 329400.00, 658800.00, 'pending', '2024-05-19 07:05:44', '2024-05-19 07:05:44'),
	(43, 'TRX1716127544-7', '9c04a4ad-9cd9-4447-ba7f-7e61c28350ef', 7, '282d48eb-ef5e-43b6-8479-ff2f4b6112de', 3, NULL, NULL, 0.00, 674960.00, 2024880.00, 'pending', '2024-05-19 07:05:44', '2024-05-19 07:05:44'),
	(44, 'TRX1716127544-7', '9c04a4ad-9cd9-4447-ba7f-7e61c28350ef', 7, '67d2ab47-bd66-4b6e-86f4-fee55e40b87a', 3, NULL, NULL, 0.00, 123624.00, 370872.00, 'pending', '2024-05-19 07:05:44', '2024-05-19 07:05:44'),
	(45, 'TRX1716127544-7', '9c04a4ad-9cd9-4447-ba7f-7e61c28350ef', 7, '999f50fd-6680-468d-a7f5-d8dc43b9e601', 2, NULL, NULL, 0.00, 354960.00, 709920.00, 'pending', '2024-05-19 07:05:44', '2024-05-19 07:05:44');

-- membuang struktur untuk table posparts.transaction_details
DROP TABLE IF EXISTS `transaction_details`;
CREATE TABLE IF NOT EXISTS `transaction_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint unsigned NOT NULL,
  `transaction_code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_order_id` bigint unsigned DEFAULT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `admin_fee` decimal(15,2) NOT NULL,
  `status` enum('waiting_payment','user_confirm','admin_confirm','admin_reject','user_reject','process_by_merchant','shipping','done','waiting_confirmation') COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_date` date DEFAULT NULL,
  `payment_option_id` bigint unsigned NOT NULL,
  `payment_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirm_date` date DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  `receive_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_details_user_id_foreign` (`user_id`),
  KEY `transaction_details_payment_option_id_foreign` (`payment_option_id`),
  KEY `transaction_details_destination_order_id_foreign` (`destination_order_id`),
  KEY `transaction_details_store_id_foreign` (`store_id`),
  CONSTRAINT `transaction_details_destination_order_id_foreign` FOREIGN KEY (`destination_order_id`) REFERENCES `destination_orders` (`id`) ON DELETE SET NULL,
  CONSTRAINT `transaction_details_payment_option_id_foreign` FOREIGN KEY (`payment_option_id`) REFERENCES `payment_options` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaction_details_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaction_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.transaction_details: ~2 rows (lebih kurang)
INSERT INTO `transaction_details` (`id`, `store_id`, `transaction_code`, `destination_order_id`, `user_id`, `qty`, `total_price`, `admin_fee`, `status`, `shipping_date`, `payment_option_id`, `payment_proof`, `confirm_date`, `receive_date`, `receive_proof`, `receive_by`, `created_at`, `updated_at`) VALUES
	(11, 6, 'TRX1716127544-6', 3, '9c04a4ad-9cd9-4447-ba7f-7e61c28350ef', 4, 1327050.00, 132705.00, 'process_by_merchant', NULL, 2, NULL, NULL, NULL, NULL, NULL, '2024-05-19 07:05:44', '2024-05-19 07:05:44'),
	(12, 7, 'TRX1716127544-7', 3, '9c04a4ad-9cd9-4447-ba7f-7e61c28350ef', 8, 3105672.00, 310567.20, 'process_by_merchant', NULL, 2, NULL, NULL, NULL, NULL, NULL, '2024-05-19 07:05:44', '2024-05-19 07:05:44');

-- membuang struktur untuk table posparts.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `card_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_filled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.users: ~6 rows (lebih kurang)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `store_name`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `card_number`, `bank_name`, `owner_name`, `province`, `regency`, `district`, `zip_code`, `address`, `nik`, `profile_filled`) VALUES
	('9c03cf8f-f3cc-4fd0-a226-35df7556fcc7', 'Admin', 'admin@moto.com', NULL, '$2y$10$OvuTTNTNvxYuAxwer7JZD.NItWykYZKU.zbFUl/zz5AW94DqqVSbC', NULL, NULL, NULL, '2024-05-10 21:30:11', '2024-05-10 21:30:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('9c03cf90-1ff5-42a9-9240-d9a344c82fc2', 'Seller', 'seller@moto.com', NULL, '$2y$10$OTxiGrC7KZCjeE9FcToANOahpGzCie/1M3mRCglSgNYmoFlLfOMci', NULL, NULL, NULL, '2024-05-10 21:30:11', '2024-05-10 21:30:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('9c03cf90-46f3-4a38-9808-6d8077e80c4e', 'Buyer', 'buyer@moto.com', NULL, '$2y$10$hZQ450e1ctC/5ieAPCo6FuEaspHHLR0dxzREblaIJrT0Pxt4GG6J.', NULL, NULL, NULL, '2024-05-10 21:30:11', '2024-05-10 21:30:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('9c03d1fa-42d5-4ed1-ac69-c136e2a741ec', 'Moh Ibnu Abdurrohman Sutio', 'ibnu@mail.com', NULL, '$2y$10$MOmJuvTYLt08mI8iKjkcwO3qts.1p3za7.UW3Sbt7S2Xw/8/Rk2t6', '081515144981', 'Toko Ibnu', NULL, '2024-05-10 21:36:56', '2024-05-11 07:10:49', NULL, '348953945', 'BCA', 'Ibnu', 'Jawa Timur', 'Kab. Jember', 'Sumber Sari', '68121', 'Sumber Sari, Jember, Jawa Timur', '3513182204020001', NULL),
	('9c04a4ad-9cd9-4447-ba7f-7e61c28350ef', 'Icin', 'icin@mail.com', NULL, '$2y$10$YDuVUk1JUVmP9qSAR6p38uqcXkXjXxzHdvY9xD/LOTGRbPJ2uzWqS', '081515144981', NULL, NULL, '2024-05-11 07:26:06', '2024-05-15 06:32:08', NULL, NULL, NULL, NULL, 'Jawa Timur', 'Kab. Jember', 'Sumber Sari', '68121', 'Sumber Sari, Jember, Jawa Timur', '3513182204020001', NULL),
	('9c149d7f-c031-4c2b-8869-2a62afbd5d5f', 'Torik Azis', 'torik@mail.com', NULL, '$2y$10$3uuS3lHo/4bnAtFvZkT7I.zhwXK0jvdvX7dypIKyVUKzvxfzwWXI6', '081515144981', NULL, NULL, '2024-05-19 05:59:16', '2024-05-19 07:24:32', NULL, '49893575934', 'BRI', 'Torik', 'Jawa Timur', 'Kab. Jember', 'Sumber Sari', '68121', 'Sumber Sari, Jember, Jawa Timur', '3513182204020001', NULL);

-- membuang struktur untuk table posparts.wallets
DROP TABLE IF EXISTS `wallets`;
CREATE TABLE IF NOT EXISTS `wallets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `balance` int DEFAULT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wallets_user_id_foreign` (`user_id`),
  CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.wallets: ~0 rows (lebih kurang)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
