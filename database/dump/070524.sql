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

-- Membuang data untuk tabel posparts.categories: ~6 rows (lebih kurang)
REPLACE INTO `categories` (`id`, `logo`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, '662fbed8e56f3_715f6c194126171.65f74f860db32.png', 'Oli Motor', '2024-04-29 08:42:42', '2024-04-29 08:15:02', '2024-04-29 08:42:42'),
	(2, NULL, 'Ban', NULL, '2024-04-29 08:15:02', '2024-04-29 08:15:02'),
	(3, NULL, 'Aki', '2024-04-29 08:27:12', '2024-04-29 08:15:02', '2024-04-29 08:27:12'),
	(4, '662fbfec7ff2d_279d01162954295.63ddc98c149b1.jpg', 'Contoh', '2024-04-29 08:42:39', '2024-04-29 08:42:36', '2024-04-29 08:42:39'),
	(5, NULL, 'Oli', '2024-05-01 19:04:33', '2024-04-29 08:42:47', '2024-05-01 19:04:33'),
	(6, NULL, 'Minyak', NULL, '2024-04-29 08:42:55', '2024-04-29 08:42:55'),
	(7, NULL, 'Aki', NULL, '2024-04-29 08:42:59', '2024-04-29 08:42:59'),
	(8, NULL, 'Oli Motor', NULL, '2024-05-01 19:01:32', '2024-05-01 19:01:32');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.migrations: ~0 rows (lebih kurang)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_04_28_223830_create_permission_tables', 1),
	(6, '2024_04_29_144504_add_phone_users', 1),
	(7, '2024_04_29_145406_create_categories_table', 2),
	(8, '2024_05_04_093547_create_payment_options', 3),
	(10, '2024_05_06_124807_create_stores_table', 4),
	(11, '2024_05_06_230322_add_soft_delete_users', 5);

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

-- Membuang data untuk tabel posparts.model_has_roles: ~10 rows (lebih kurang)
REPLACE INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
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
	(3, 'App\\Models\\User', '9bfb9136-df00-4099-8eb5-4b8a3fdbc88e');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.payment_options: ~1 rows (lebih kurang)
REPLACE INTO `payment_options` (`id`, `name`, `description`, `status`, `admin_fee`, `duration`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(2, 'Tunai', 'Pembayaran tunai', '1', 10, NULL, NULL, '2024-05-06 16:43:59', '2024-05-06 16:43:59');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.permissions: ~24 rows (lebih kurang)
REPLACE INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
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
	(24, 'delete_store', 'web', NULL, NULL);

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
REPLACE INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
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

-- Membuang data untuk tabel posparts.role_has_permissions: ~0 rows (lebih kurang)
REPLACE INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
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
	(24, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.stores: ~4 rows (lebih kurang)
REPLACE INTO `stores` (`id`, `name`, `slug`, `user_id`, `address`, `phone`, `logo`, `status`, `created_at`, `updated_at`) VALUES
	(2, 'Toko Update', 'toko-update', '9bfb3eb6-1147-4f36-8f0a-45d5c6a73f0b', 'Sumber Sari, Jember, Jawa Timur', '081515144981', 'cjTND9fsMq.png', 1, '2024-05-06 15:18:32', '2024-05-06 15:59:38'),
	(3, 'Gillian Alston', 'gillian-alston', '9bfb3ef6-fc26-4892-923a-f89ef800c66f', 'Temporibus commodi e', '+1 (972) 619-5638', NULL, 1, '2024-05-06 15:19:14', '2024-05-06 16:00:49'),
	(4, 'Serena Jordan', 'serena-jordan', '9bfb40d6-a8dd-456d-ad7c-e4b1ac6cd489', 'Non eos nostrum aliq', '+1 (805) 332-2363', NULL, 0, '2024-05-06 15:24:29', '2024-05-06 16:16:51'),
	(5, 'Austin Richardson', 'austin-richardson', '9bfb4109-e9b3-4b9e-b271-079b6f633910', 'Placeat veritatis m', '+1 (649) 155-9994', NULL, 0, '2024-05-06 15:25:02', '2024-05-06 15:25:02');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel posparts.users: ~6 rows (lebih kurang)
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `store_name`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	('9bec89f4-56d2-4b84-a857-d785c1dfd015', 'Admin', 'admin@moto.com', NULL, '$2y$10$4VQU7UeiJlIkCHBwcplPVuDFN0LvD2tfXdGJLal8mrskmKP7TK0zS', NULL, NULL, NULL, '2024-04-29 07:51:30', '2024-04-29 07:51:30', NULL),
	('9bec89f4-b991-49fe-8326-c5b162bac9fc', 'Buyer', 'buyer@moto.com', NULL, '$2y$10$DBDyxUsf1gcnLb3hQ9XuyeuF0D4kXjBmHyHoqTa0Xi076wgAkUisq', NULL, NULL, NULL, '2024-04-29 07:51:31', '2024-04-29 07:51:31', NULL),
	('9bfb3eb6-1147-4f36-8f0a-45d5c6a73f0b', 'Moh Ibnu Abdurrohman Sutio', 'ibnu@mail.com', NULL, '$2y$10$.5ja5/8Q.vMKzNU/CN6Qnu7ZBYUsDx5.LF46f4MNpQFBDG4zDGpu2', NULL, NULL, NULL, '2024-05-06 15:18:32', '2024-05-06 16:00:43', NULL),
	('9bfb3ef6-fc26-4892-923a-f89ef800c66f', 'Gillian Alston', 'ruvop@mailinator.com', NULL, '$2y$10$ykI5gUGUOakmfm7GseQgr.DM69B0x1FLfEMY98O/GG4Vv7PhFV9ly', NULL, NULL, NULL, '2024-05-06 15:19:14', '2024-05-06 15:19:14', NULL),
	('9bfb40d6-a8dd-456d-ad7c-e4b1ac6cd489', 'Serena Jordan', 'rewigi@mailinator.com', NULL, '$2y$10$OVCsNkizz1v3ISi0FPpl3.BSNsdj8B8IWURajUMSueGxqFg/FNcAC', NULL, NULL, NULL, '2024-05-06 15:24:29', '2024-05-06 16:16:51', '2024-05-06 16:16:51'),
	('9bfb4109-e9b3-4b9e-b271-079b6f633910', 'Austin Richardson', 'xodym@mailinator.com', NULL, '$2y$10$BGb7vIwKepkrKR7eUl9VjOiUa/2oNOwoRExYNzaoXwysRUzr/rh2u', NULL, NULL, NULL, '2024-05-06 15:25:02', '2024-05-06 15:25:02', NULL),
	('9bfb9136-df00-4099-8eb5-4b8a3fdbc88e', 'Icin', 'icin@mail.com', NULL, '$2y$10$3qjW3vqXlt0miA0IX5tbdOK1fwPoOC5fnsz0LyoxVQljWp1hRY5Fy', NULL, NULL, NULL, '2024-05-06 19:09:13', '2024-05-06 19:09:13', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
