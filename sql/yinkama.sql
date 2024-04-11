-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: localhost    Database: yinkama
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.27-MariaDB

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
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_04_04_161506_tbl_roles',1),(5,'2024_04_04_161612_tbl_lugares',1),(6,'2024_04_04_161619_tbl_gimcana',1),(7,'2024_04_04_161622_tbl_grupos',1),(8,'2024_04_04_161632_tbl_tipo',1),(9,'2024_04_04_161640_tbl_usuario',1),(10,'2024_04_04_161643_tbl_gimcana_lugares',1),(11,'2024_04_04_161645_tbl_tipo_lugares',1),(12,'2024_04_04_161650_tbl_etiquetas',1),(13,'2024_04_04_161653_tbl_grupos_user',1),(14,'2024_04_04_161658_tbl_check',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('CFcd9gOelQqIsevSfPvIXyMO3LD2REiqBVTrvp3B',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 Edg/123.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMWVBeDlOZUd6NjJqSWV4RDBRMnp5SU1SUWNJN2RSaFNtc0Z4Nm9CSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1712851047),('HgR8fMKtPnJ50QqrdLY7QDd6P4kjud74GDnAzogW',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36','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',1712851066),('hZ5eqfHwfavJ43UUpmqkZDPjA4QFVulAA99W5xcn',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmNSQXBFTjlKeWZZTUQ2U0YyTG5ZQkU5dzJpV0NlTk9hVWpXaGJYWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jbGllbnRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1712851013),('VqJdQhW0pHM7r5EkMzN0C2qQ9aVb1nT5h2UEb3Ro',NULL,'127.0.0.1','Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMXRuNlc2ZUM0aGxucXhKRkRnOW5DMXJvZHp6TVNGeU13d2ExUE5NWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jbGllbnRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c3VhcmlvIjtPOjIzOiJBcHBcTW9kZWxzXHRibF91c3VhcmlvcyI6MzA6e3M6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6MTE6InRibF91c3VhcmlvIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjI6ImlkIjtzOjEwOiIAKgBrZXlUeXBlIjtzOjM6ImludCI7czoxMjoiaW5jcmVtZW50aW5nIjtiOjE7czo3OiIAKgB3aXRoIjthOjA6e31zOjEyOiIAKgB3aXRoQ291bnQiO2E6MDp7fXM6MTk6InByZXZlbnRzTGF6eUxvYWRpbmciO2I6MDtzOjEwOiIAKgBwZXJQYWdlIjtpOjE1O3M6NjoiZXhpc3RzIjtiOjE7czoxODoid2FzUmVjZW50bHlDcmVhdGVkIjtiOjA7czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6Nzp7czo3OiJpZF91c2VyIjtpOjE7czoxMToibm9tYnJlX3VzZXIiO3M6NDoiTHVjYSI7czoxMToiY29ycmVvX3VzZXIiO3M6MTQ6Imx1Y2FAZ21haWwuY29tIjtzOjg6InB3ZF91c2VyIjtzOjYwOiIkMnkkMTIkR3hpMXR3eW1FWXJPdTVLTHFwcFdndTNJd2VyWWhYSnY3WVc0NFFkVjhJN1ZadzNaWDVZZUsiO3M6MTI6ImxhdGl0dWRfdXNlciI7TjtzOjEzOiJsb25naXR1ZF91c2VyIjtOO3M6OToiaWRfcm9sX2ZrIjtpOjE7fXM6MTE6IgAqAG9yaWdpbmFsIjthOjc6e3M6NzoiaWRfdXNlciI7aToxO3M6MTE6Im5vbWJyZV91c2VyIjtzOjQ6Ikx1Y2EiO3M6MTE6ImNvcnJlb191c2VyIjtzOjE0OiJsdWNhQGdtYWlsLmNvbSI7czo4OiJwd2RfdXNlciI7czo2MDoiJDJ5JDEyJEd4aTF0d3ltRVlyT3U1S0xxcHBXZ3UzSXdlclloWEp2N1lXNDRRZFY4STdWWnczWlg1WWVLIjtzOjEyOiJsYXRpdHVkX3VzZXIiO047czoxMzoibG9uZ2l0dWRfdXNlciI7TjtzOjk6ImlkX3JvbF9mayI7aToxO31zOjEwOiIAKgBjaGFuZ2VzIjthOjA6e31zOjg6IgAqAGNhc3RzIjthOjA6e31zOjE3OiIAKgBjbGFzc0Nhc3RDYWNoZSI7YTowOnt9czoyMToiACoAYXR0cmlidXRlQ2FzdENhY2hlIjthOjA6e31zOjEzOiIAKgBkYXRlRm9ybWF0IjtOO3M6MTA6IgAqAGFwcGVuZHMiO2E6MDp7fXM6MTk6IgAqAGRpc3BhdGNoZXNFdmVudHMiO2E6MDp7fXM6MTQ6IgAqAG9ic2VydmFibGVzIjthOjA6e31zOjEyOiIAKgByZWxhdGlvbnMiO2E6MDp7fXM6MTA6IgAqAHRvdWNoZXMiO2E6MDp7fXM6MTA6InRpbWVzdGFtcHMiO2I6MTtzOjEzOiJ1c2VzVW5pcXVlSWRzIjtiOjA7czo5OiIAKgBoaWRkZW4iO2E6MDp7fXM6MTA6IgAqAHZpc2libGUiO2E6MDp7fXM6MTE6IgAqAGZpbGxhYmxlIjthOjA6e31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO319czo3OiJpZF91c2VyIjtpOjE7czozOiJyb2wiO2k6MTt9',1712855998);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_check`
--

DROP TABLE IF EXISTS `tbl_check`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_check` (
  `id_check` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_gim-lug_fk` bigint(20) unsigned NOT NULL,
  `id_grupo_tabla` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id_check`),
  KEY `tbl_check_id_gim_lug_fk_foreign` (`id_gim-lug_fk`),
  KEY `tbl_check_id_grupo_tabla_foreign` (`id_grupo_tabla`),
  CONSTRAINT `tbl_check_id_gim_lug_fk_foreign` FOREIGN KEY (`id_gim-lug_fk`) REFERENCES `tbl_gimcana-lugares` (`id_gim-lug`) ON DELETE CASCADE,
  CONSTRAINT `tbl_check_id_grupo_tabla_foreign` FOREIGN KEY (`id_grupo_tabla`) REFERENCES `tbl_grupos_user` (`id_grupo_tabla`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_check`
--

LOCK TABLES `tbl_check` WRITE;
/*!40000 ALTER TABLE `tbl_check` DISABLE KEYS */;
INSERT INTO `tbl_check` VALUES (1,1,1),(2,1,1),(3,1,2),(4,1,2);
/*!40000 ALTER TABLE `tbl_check` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_etiquetas`
--

DROP TABLE IF EXISTS `tbl_etiquetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_etiquetas` (
  `id_fav` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user_fk` bigint(20) unsigned NOT NULL,
  `id_lug_fk` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id_fav`),
  KEY `tbl_etiquetas_id_user_fk_foreign` (`id_user_fk`),
  KEY `tbl_etiquetas_id_lug_fk_foreign` (`id_lug_fk`),
  CONSTRAINT `tbl_etiquetas_id_lug_fk_foreign` FOREIGN KEY (`id_lug_fk`) REFERENCES `tbl_lugares` (`id_lug`) ON DELETE CASCADE,
  CONSTRAINT `tbl_etiquetas_id_user_fk_foreign` FOREIGN KEY (`id_user_fk`) REFERENCES `tbl_usuario` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_etiquetas`
--

LOCK TABLES `tbl_etiquetas` WRITE;
/*!40000 ALTER TABLE `tbl_etiquetas` DISABLE KEYS */;
INSERT INTO `tbl_etiquetas` VALUES (2,2,1),(3,3,1),(4,4,1),(6,2,2),(14,1,2),(16,1,1),(17,1,5),(18,1,6);
/*!40000 ALTER TABLE `tbl_etiquetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_gimcana`
--

DROP TABLE IF EXISTS `tbl_gimcana`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_gimcana` (
  `id_gim` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_gim` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_gim`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_gimcana`
--

LOCK TABLES `tbl_gimcana` WRITE;
/*!40000 ALTER TABLE `tbl_gimcana` DISABLE KEYS */;
INSERT INTO `tbl_gimcana` VALUES (1,'La ruta del dinero'),(2,'En busca del tesoro'),(3,'Buscando a Mane'),(4,'Sobre el agua');
/*!40000 ALTER TABLE `tbl_gimcana` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_gimcana-lugares`
--

DROP TABLE IF EXISTS `tbl_gimcana-lugares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_gimcana-lugares` (
  `id_gim-lug` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_gim_fk` bigint(20) unsigned NOT NULL,
  `id_lug_fk` bigint(20) unsigned NOT NULL,
  `pista_gim-lug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_gim-lug`),
  KEY `tbl_gimcana_lugares_id_gim_fk_foreign` (`id_gim_fk`),
  KEY `tbl_gimcana_lugares_id_lug_fk_foreign` (`id_lug_fk`),
  CONSTRAINT `tbl_gimcana_lugares_id_gim_fk_foreign` FOREIGN KEY (`id_gim_fk`) REFERENCES `tbl_gimcana` (`id_gim`) ON DELETE CASCADE,
  CONSTRAINT `tbl_gimcana_lugares_id_lug_fk_foreign` FOREIGN KEY (`id_lug_fk`) REFERENCES `tbl_lugares` (`id_lug`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_gimcana-lugares`
--

LOCK TABLES `tbl_gimcana-lugares` WRITE;
/*!40000 ALTER TABLE `tbl_gimcana-lugares` DISABLE KEYS */;
INSERT INTO `tbl_gimcana-lugares` VALUES (1,1,1,'Dirígete a la sala de arte moderno y busca una pintura con un reloj derretido en ella. Allí encontrarás la primera pista que te llevará al siguiente punto de encuentro.'),(2,1,1,'Sigue el sendero marcado por las flechas amarillas. Cuando llegues al árbol más alto del bosque, busca entre sus raíces el siguiente mensaje oculto que te guiará hacia la siguiente parada.'),(3,1,1,'Ve al monumento principal de la ciudad y busca una placa conmemorativa con las coordenadas X, Y. Allí encontrarás una pista que te llevará al siguiente lugar.'),(4,1,1,'Sumérgete en la zona marcada por boyas rojas y busca un cofre enterrado a 5 metros de profundidad. Dentro encontrarás una pista que te conducirá al siguiente desafío.');
/*!40000 ALTER TABLE `tbl_gimcana-lugares` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_grupos`
--

DROP TABLE IF EXISTS `tbl_grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_grupos` (
  `id_gru` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_gru` varchar(255) DEFAULT NULL,
  `ind_gim` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_gru`),
  KEY `tbl_grupos_ind_gim_foreign` (`ind_gim`),
  CONSTRAINT `tbl_grupos_ind_gim_foreign` FOREIGN KEY (`ind_gim`) REFERENCES `tbl_gimcana` (`id_gim`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_grupos`
--

LOCK TABLES `tbl_grupos` WRITE;
/*!40000 ALTER TABLE `tbl_grupos` DISABLE KEYS */;
INSERT INTO `tbl_grupos` VALUES (1,'Millogangsters',1),(2,'Los Bebesitos',1),(3,'Magics',2),(4,'Los Manes',2);
/*!40000 ALTER TABLE `tbl_grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_grupos_user`
--

DROP TABLE IF EXISTS `tbl_grupos_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_grupos_user` (
  `id_grupo_tabla` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_grupo` bigint(20) unsigned DEFAULT NULL,
  `id_user` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_grupo_tabla`),
  KEY `tbl_grupos_user_id_user_foreign` (`id_user`),
  KEY `tbl_grupos_user_id_grupo_foreign` (`id_grupo`),
  CONSTRAINT `tbl_grupos_user_id_grupo_foreign` FOREIGN KEY (`id_grupo`) REFERENCES `tbl_grupos` (`id_gru`) ON DELETE CASCADE,
  CONSTRAINT `tbl_grupos_user_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `tbl_usuario` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_grupos_user`
--

LOCK TABLES `tbl_grupos_user` WRITE;
/*!40000 ALTER TABLE `tbl_grupos_user` DISABLE KEYS */;
INSERT INTO `tbl_grupos_user` VALUES (1,1,1),(2,2,2),(3,3,3),(4,4,4);
/*!40000 ALTER TABLE `tbl_grupos_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_lugares`
--

DROP TABLE IF EXISTS `tbl_lugares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_lugares` (
  `id_lug` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_lug` varchar(255) DEFAULT NULL,
  `tipo_lug` int(11) DEFAULT NULL,
  `barrio_lug` varchar(255) DEFAULT NULL,
  `latitud_lug` varchar(255) DEFAULT NULL,
  `longitud_lug` varchar(255) DEFAULT NULL,
  `desc_lug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_lug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lugares`
--

LOCK TABLES `tbl_lugares` WRITE;
/*!40000 ALTER TABLE `tbl_lugares` DISABLE KEYS */;
INSERT INTO `tbl_lugares` VALUES (1,'Barcelona',1,'Nou Barris','41.39563908249548','2.157296801147742','El  mejor museo de Barcelona con unos cuadros bonitos.'),(2,'Barcelona',2,'El Born','41.406416238763036','2.1743924748125343','Aqui nos encontramos en una playa con un agua muy cristalina'),(3,'Barcelona',3,'El Raval','41.395471212759546','2.1446376001765852','En este Bar se encuentran las bravas más buenas.'),(4,'Barcelona',4,'Gràcia','41.40277027405965','2.1319204997441905','Los pisos de aqui son muy altos.'),(5,'Barcelona',5,'Port Vell','41.39655528359603','2.1619791007662146','Este parque esta muy variado tirolinas, colchonetas....'),(6,'Barcelona',4,'Barceloneta','41.382677811538706','2.1302826915074853','Este paseo es uno de los más largos donde se encuentra mucha gente.');
/*!40000 ALTER TABLE `tbl_lugares` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_roles` (
  `id_rol` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_roles`
--

LOCK TABLES `tbl_roles` WRITE;
/*!40000 ALTER TABLE `tbl_roles` DISABLE KEYS */;
INSERT INTO `tbl_roles` VALUES (1,'Administrador'),(2,'Cliente');
/*!40000 ALTER TABLE `tbl_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo`
--

DROP TABLE IF EXISTS `tbl_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipo` (
  `id_tipo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo`
--

LOCK TABLES `tbl_tipo` WRITE;
/*!40000 ALTER TABLE `tbl_tipo` DISABLE KEYS */;
INSERT INTO `tbl_tipo` VALUES (1,'Museo'),(2,'Playa'),(3,'Bar'),(4,'Edificio'),(5,'Paseo'),(6,'Parque'),(7,'Restaurante'),(8,'Cafetería'),(9,'Centro comercial'),(10,'Teatro');
/*!40000 ALTER TABLE `tbl_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo-lugares`
--

DROP TABLE IF EXISTS `tbl_tipo-lugares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipo-lugares` (
  `id_tipo-lug` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_tipo_fk` bigint(20) unsigned NOT NULL,
  `id_lug_fk` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id_tipo-lug`),
  KEY `tbl_tipo_lugares_id_tipo_fk_foreign` (`id_tipo_fk`),
  KEY `tbl_tipo_lugares_id_lug_fk_foreign` (`id_lug_fk`),
  CONSTRAINT `tbl_tipo_lugares_id_lug_fk_foreign` FOREIGN KEY (`id_lug_fk`) REFERENCES `tbl_lugares` (`id_lug`) ON DELETE CASCADE,
  CONSTRAINT `tbl_tipo_lugares_id_tipo_fk_foreign` FOREIGN KEY (`id_tipo_fk`) REFERENCES `tbl_tipo` (`id_tipo`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo-lugares`
--

LOCK TABLES `tbl_tipo-lugares` WRITE;
/*!40000 ALTER TABLE `tbl_tipo-lugares` DISABLE KEYS */;
INSERT INTO `tbl_tipo-lugares` VALUES (1,1,1),(2,2,1),(3,3,1),(4,4,1);
/*!40000 ALTER TABLE `tbl_tipo-lugares` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuario` (
  `id_user` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_user` varchar(255) DEFAULT NULL,
  `correo_user` varchar(255) DEFAULT NULL,
  `pwd_user` varchar(255) DEFAULT NULL,
  `latitud_user` varchar(255) DEFAULT NULL,
  `longitud_user` varchar(255) DEFAULT NULL,
  `id_rol_fk` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `tbl_usuario_id_rol_fk_foreign` (`id_rol_fk`),
  CONSTRAINT `tbl_usuario_id_rol_fk_foreign` FOREIGN KEY (`id_rol_fk`) REFERENCES `tbl_roles` (`id_rol`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (1,'Luca','luca@gmail.com','$2y$12$Gxi1twymEYrOu5KLqppWgu3IwerYhXJv7YW44QdV8I7VZw3ZX5YeK',NULL,NULL,1),(2,'Ian','ian@gmail.com','$2y$12$zEIgn48MxVtkJUXLnPxo4.ihRZUX2hNOc6TgDhRxu47NbxuEfGqUm',NULL,NULL,2),(3,'Mane','mane@gmail.com','$2y$12$sCWd9OtY03qHASVISLv.H.DsGbCNK.xIo1vuoQhK8AB40FAOy/09m',NULL,NULL,2),(4,'Alberto','alberto@gmail.com','$2y$12$26NNvOKgJxLhHN3ticgtS.birI8GYqcvFtZ9JSgnT1MrAVJzk9qiK',NULL,NULL,2);
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-11 19:48:15
