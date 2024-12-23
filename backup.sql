-- MySQL dump 10.13  Distrib 5.7.24, for Win64 (x86_64)
--
-- Host: localhost    Database: kiamall
-- ------------------------------------------------------
-- Server version	5.7.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--
DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
 `key` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `value` MEDIUMTEXT COLLATE utf8mb4_unicode_ci NOT NULL,
 `expiration` INT(11) NOT NULL, PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--
LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('19363d62d4f6b57f0fff0981528a4d13','i:1;',1732184768),('19363d62d4f6b57f0fff0981528a4d13:timer','i:1732184768;',1732184768),('spatie.permission.cache','a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:21:{i:0;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"manage users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:12:\"manage roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:18:\"manage permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:3;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:12:\" VIEW members\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:3:{s:1:\"a\";i:10;s:1:\"b\";s:23:\"assigntorole permission\";s:1:\"c\";s:3:\"web\";}i:5;a:3:{s:1:\"a\";i:11;s:1:\"b\";s:23:\"assigntouser permission\";s:1:\"c\";s:3:\"web\";}i:6;a:3:{s:1:\"a\";i:12;s:1:\"b\";s:26:\"viewpermissions permission\";s:1:\"c\";s:3:\"web\";}i:7;a:3:{s:1:\"a\";i:13;s:1:\"b\";s:30:\"viewuserpermissions permission\";s:1:\"c\";s:3:\"web\";}i:8;a:3:{s:1:\"a\";i:14;s:1:\"b\";s:31:\"removeuserpermission permission\";s:1:\"c\";s:3:\"web\";}i:9;a:3:{s:1:\"a\";i:15;s:1:\"b\";s:34:\"viewuserswithpermission permission\";s:1:\"c\";s:3:\"web\";}i:10;a:3:{s:1:\"a\";i:16;s:1:\"b\";s:35:\"removepermissionfromuser permission\";s:1:\"c\";s:3:\"web\";}i:11;a:3:{s:1:\"a\";i:17;s:1:\"b\";s:11:\"
CREATE role\";s:1:\"c\";s:3:\"web\";}i:12;a:3:{s:1:\"a\";i:18;s:1:\"b\";s:22:\"assignpermissions role\";s:1:\"c\";s:3:\"web\";}i:13;a:3:{s:1:\"a\";i:19;s:1:\"b\";s:28:\"handleassignpermissions role\";s:1:\"c\";s:3:\"web\";}i:14;a:3:{s:1:\"a\";i:20;s:1:\"b\";s:20:\"viewpermissions role\";s:1:\"c\";s:3:\"web\";}i:15;a:3:{s:1:\"a\";i:21;s:1:\"b\";s:25:\"assignroletouserview role\";s:1:\"c\";s:3:\"web\";}i:16;a:3:{s:1:\"a\";i:22;s:1:\"b\";s:21:\"assignroletouser role\";s:1:\"c\";s:3:\"web\";}i:17;a:3:{s:1:\"a\";i:23;s:1:\"b\";s:29:\"removepermissionfromrole role\";s:1:\"c\";s:3:\"web\";}i:18;a:3:{s:1:\"a\";i:24;s:1:\"b\";s:11:\"
CREATE user\";s:1:\"c\";s:3:\"web\";}i:19;a:3:{s:1:\"a\";i:25;s:1:\"b\";s:9:\"edit user\";s:1:\"c\";s:3:\"web\";}i:20;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:20:\"onlyviewmembers user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:8:\"employee\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:5:\"staff\";s:1:\"c\";s:3:\"web\";}}}',1732245710);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */; UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--
DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
 `key` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `owner` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `expiration` INT(11) NOT NULL, PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--
LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */; UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
 `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `uuid` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `connection` TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
 `queue` TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
 `payload` LONGTEXT COLLATE utf8mb4_unicode_ci NOT NULL,
 `exception` LONGTEXT COLLATE utf8mb4_unicode_ci NOT NULL,
 `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`), UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--
LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */; UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--
DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
 `id` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `total_jobs` INT(11) NOT NULL,
 `pending_jobs` INT(11) NOT NULL,
 `failed_jobs` INT(11) NOT NULL,
 `failed_job_ids` LONGTEXT COLLATE utf8mb4_unicode_ci NOT NULL,
 `options` MEDIUMTEXT COLLATE utf8mb4_unicode_ci,
 `cancelled_at` INT(11) DEFAULT NULL,
 `created_at` INT(11) NOT NULL,
 `finished_at` INT(11) DEFAULT NULL, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--
LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */; UNLOCK TABLES;

--
-- Table structure for table `jobs`
--
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
 `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `queue` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `payload` LONGTEXT COLLATE utf8mb4_unicode_ci NOT NULL,
 `attempts` TINYINT(3) UNSIGNED NOT NULL,
 `reserved_at` INT(10) UNSIGNED DEFAULT NULL,
 `available_at` INT(10) UNSIGNED NOT NULL,
 `created_at` INT(10) UNSIGNED NOT NULL, PRIMARY KEY (`id`), KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--
LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */; UNLOCK TABLES;

--
-- Table structure for table `migrations`
--
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
 `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
 `migration` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `batch` INT(11) NOT NULL, PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--
LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_11_19_155947_add_two_factor_columns_to_users_table',1),(5,'2024_11_19_160852_create_permission_tables',1),(6,'2024_11_19_160909_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */; UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--
DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
 `permission_id` BIGINT(20) UNSIGNED NOT NULL,
 `model_type` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `model_id` BIGINT(20) UNSIGNED NOT NULL, PRIMARY KEY (`permission_id`,`model_id`,`model_type`), KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`), CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON
DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--
LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
INSERT INTO `model_has_permissions` VALUES (8,'App\\Models\\User',4),(26,'App\\Models\\User',7);
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */; UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--
DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
 `role_id` BIGINT(20) UNSIGNED NOT NULL,
 `model_type` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `model_id` BIGINT(20) UNSIGNED NOT NULL, PRIMARY KEY (`role_id`,`model_id`,`model_type`), KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`), CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON
DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--
LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',4),(5,'App\\Models\\User',7);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */; UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
 `email` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `token` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `created_at` TIMESTAMP NULL DEFAULT NULL, PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--
LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */; UNLOCK TABLES;

--
-- Table structure for table `permissions`
--
DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
 `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `guard_name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `created_at` TIMESTAMP NULL DEFAULT NULL,
 `updated_at` TIMESTAMP NULL DEFAULT NULL, PRIMARY KEY (`id`), UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--
LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (4,'manage users','web','2024-11-19 15:41:59','2024-11-19 15:41:59'),(5,'manage roles','web','2024-11-19 15:41:59','2024-11-19 15:41:59'),(6,'manage permissions','web','2024-11-19 15:41:59','2024-11-19 15:41:59'),(8,'view members','web','2024-11-20 10:53:30','2024-11-20 11:37:11'),(10,'assigntorole permission','web','2024-11-20 12:20:31','2024-11-20 12:20:31'),(11,'assigntouser permission','web','2024-11-20 12:20:31','2024-11-20 12:20:31'),(12,'viewpermissions permission','web','2024-11-20 12:20:31','2024-11-20 12:20:31'),(13,'viewuserpermissions permission','web','2024-11-20 12:20:31','2024-11-20 12:20:31'),(14,'removeuserpermission permission','web','2024-11-20 12:20:31','2024-11-20 12:20:31'),(15,'viewuserswithpermission permission','web','2024-11-20 12:20:31','2024-11-20 12:20:31'),(16,'removepermissionfromuser permission','web','2024-11-20 12:20:31','2024-11-20 12:20:31'),(17,'create role','web','2024-11-20 12:20:31','2024-11-20 12:20:31'),(18,'assignpermissions role','web','2024-11-20 12:20:31','2024-11-20 12:20:31'),(19,'handleassignpermissions role','web','2024-11-20 12:20:31','2024-11-20 12:20:31'),(20,'viewpermissions role','web','2024-11-20 12:20:31','2024-11-20 12:20:31'),(21,'assignroletouserview role','web','2024-11-20 12:20:31','2024-11-20 12:20:31'),(22,'assignroletouser role','web','2024-11-20 12:20:31','2024-11-20 12:20:31'),(23,'removepermissionfromrole role','web','2024-11-20 12:20:31','2024-11-20 12:20:31'),(24,'create user','web','2024-11-20 12:20:31','2024-11-20 12:20:31'),(25,'edit user','web','2024-11-20 12:20:31','2024-11-20 12:20:31'),(26,'onlyviewmembers user','web','2024-11-20 12:20:31','2024-11-20 12:20:31');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */; UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
 `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `tokenable_type` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `tokenable_id` BIGINT(20) UNSIGNED NOT NULL,
 `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `token` VARCHAR(64) COLLATE utf8mb4_unicode_ci NOT NULL,
 `abilities` TEXT COLLATE utf8mb4_unicode_ci,
 `last_used_at` TIMESTAMP NULL DEFAULT NULL,
 `expires_at` TIMESTAMP NULL DEFAULT NULL,
 `created_at` TIMESTAMP NULL DEFAULT NULL,
 `updated_at` TIMESTAMP NULL DEFAULT NULL, PRIMARY KEY (`id`), UNIQUE KEY `personal_access_tokens_token_unique` (`token`), KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--
LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */; UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--
DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
 `permission_id` BIGINT(20) UNSIGNED NOT NULL,
 `role_id` BIGINT(20) UNSIGNED NOT NULL, PRIMARY KEY (`permission_id`,`role_id`), KEY `role_has_permissions_role_id_foreign` (`role_id`), CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON
DELETE CASCADE, CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON
DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--
LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (4,1),(5,1),(6,1),(8,1),(26,1),(5,2),(6,3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */; UNLOCK TABLES;

--
-- Table structure for table `roles`
--
DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
 `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `guard_name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `created_at` TIMESTAMP NULL DEFAULT NULL,
 `updated_at` TIMESTAMP NULL DEFAULT NULL, PRIMARY KEY (`id`), UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--
LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','web','2024-11-19 12:47:52','2024-11-19 12:47:52'),(2,'employee','web','2024-11-19 12:47:52','2024-11-19 12:47:52'),(3,'staff','web','2024-11-19 12:47:52','2024-11-19 12:47:52'),(4,'partner','web','2024-11-19 12:47:52','2024-11-19 12:47:52'),(5,'member','web','2024-11-19 12:47:52','2024-11-19 12:47:52');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */; UNLOCK TABLES;

--
-- Table structure for table `sessions`
--
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
 `id` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `user_id` BIGINT(20) UNSIGNED DEFAULT NULL,
 `ip_address` VARCHAR(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `user_agent` TEXT COLLATE utf8mb4_unicode_ci,
 `payload` LONGTEXT COLLATE utf8mb4_unicode_ci NOT NULL,
 `last_activity` INT(11) NOT NULL, PRIMARY KEY (`id`), KEY `sessions_user_id_index` (`user_id`), KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--
LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('q5FzXtDrCYMVhB7eda7ecFlRWcLJ8BtNGyT2fZ2S',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM3JKSUJyUjNWVmFJSEFxNUQzOWlWalUzcm85N0RraUxaVFhPS3BiViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9raWFtYWxsLmNvbS9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=',1732184710);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */; UNLOCK TABLES;

--
-- Table structure for table `users`
--
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
 `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `email` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
 `password` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `two_factor_secret` TEXT COLLATE utf8mb4_unicode_ci,
 `two_factor_recovery_codes` TEXT COLLATE utf8mb4_unicode_ci,
 `two_factor_confirmed_at` TIMESTAMP NULL DEFAULT NULL,
 `remember_token` VARCHAR(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `current_team_id` BIGINT(20) UNSIGNED DEFAULT NULL,
 `profile_photo_path` VARCHAR(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `created_at` TIMESTAMP NULL DEFAULT NULL,
 `updated_at` TIMESTAMP NULL DEFAULT NULL, PRIMARY KEY (`id`), UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'Admin','admin@kia-mall.com', NULL,'$2y$12$A/sxac357lRYCKSp1rJqRuErGswruSUb6uxRJWMJLy06w5791EBua', NULL, NULL, NULL, NULL, NULL, NULL,'2024-11-19 13:37:01','2024-11-19 13:37:01'),(7,'test','info@kia-mall.com', NULL,'$2y$12$rlSjGgjVJP7ZFonr32LoduBMOBJvK2j8WRC33fMzBrWIuKohf6COy', NULL, NULL, NULL, NULL, NULL, NULL,'2024-11-19 14:24:39','2024-11-19 14:24:39');
/*!40000 ALTER TABLE `users` ENABLE KEYS */; UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-21 16:10:05
