-- MariaDB dump 10.19  Distrib 10.4.19-MariaDB, for Linux (x86_64)
--
-- Host: bobk.test    Database: bobk.test
-- ------------------------------------------------------
-- Server version	10.4.19-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bills`
--

DROP TABLE IF EXISTS `bills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bills` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'goods',
  `amount` int(11) NOT NULL COMMENT 'The cost of the bill',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'make clear which currency did meant in amount field',
  `quantity` int(11) NOT NULL COMMENT 'The total of items',
  `serial` int(11) NOT NULL COMMENT 'Bill Serial Number',
  `seller_id` bigint(20) unsigned NOT NULL,
  `contribution_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bills_serial_unique` (`serial`),
  KEY `bills_seller_id_foreign` (`seller_id`),
  KEY `bills_contribution_id_foreign` (`contribution_id`),
  CONSTRAINT `bills_contribution_id_foreign` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`),
  CONSTRAINT `bills_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bills`
--

LOCK TABLES `bills` WRITE;
/*!40000 ALTER TABLE `bills` DISABLE KEYS */;
INSERT INTO `bills` VALUES (1,'default',0,'default',1,1001,1,1,'2021-10-17 21:00:00','2021-10-17 21:00:00');
/*!40000 ALTER TABLE `bills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brands_seller_id_foreign` (`seller_id`),
  CONSTRAINT `brands_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Default','Default',1,NULL,NULL),(2,'Syrox','Headphones Bluetooth Headphones, Cables, Chargers, Screens, Airpods',2,NULL,NULL),(3,'Mabko','Cables, Headphones, Bluetooth Headphones, Screens, Airpods, Chargers',2,NULL,NULL),(4,'Joinlink','Cables, Chargers',2,NULL,NULL),(5,'Veno','Bluetooth Headphones, iPhone\'s Headphones',2,NULL,NULL),(6,'Other','Other',1,NULL,NULL),(7,'Jopus','Screens, General Accessories',3,NULL,NULL),(8,'Simex','Screens, General Accessories',3,NULL,NULL),(9,'Mytell','Screens, General Accessories',3,NULL,NULL),(10,'Soffany','Chargers, Cables, Covers, Screens, General Accessories',4,NULL,NULL),(11,'Platoon','Screens, General Accessories',2,NULL,NULL),(12,'Other','Other',3,NULL,NULL),(13,'Other','Other',3,NULL,NULL),(21,'Jopus','Screens, General Accessories',2,NULL,NULL),(22,'Kensa','Telefon Aksesuarlari',5,'2021-11-26 14:12:22','2021-11-26 14:12:22'),(23,'Kensa','Headphones Bluetooth Headphones, Cables, Chargers, Screens, Airpods',2,'2021-12-01 10:11:49','2021-12-01 10:11:49');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_product`
--

DROP TABLE IF EXISTS `cart_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_product` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `net_price` int(11) NOT NULL,
  `net_cost` int(11) NOT NULL,
  `cart_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT ' ',
  PRIMARY KEY (`id`),
  KEY `cart_product_cart_id_foreign` (`cart_id`),
  KEY `cart_product_product_id_foreign` (`product_id`),
  CONSTRAINT `cart_product_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cart_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_product`
--

LOCK TABLES `cart_product` WRITE;
/*!40000 ALTER TABLE `cart_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,'2021-11-26 12:53:56','2021-11-26 12:53:56');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'default','default',NULL,NULL),(2,'Chargers','chargers',NULL,NULL),(3,'Screens','screens',NULL,NULL),(4,'Micro Cables','micro-cables',NULL,NULL),(5,'Type-C Cables','type-c-cables',NULL,NULL),(6,'Lighting Cables','lighting-cables',NULL,NULL),(7,'Bluetooth Headphones','bluetooth-headphones',NULL,NULL),(8,'Airpods','airpods',NULL,NULL),(9,'Earphones','earphones',NULL,NULL),(10,'Bluetooth Speakers','bluetooth-speakers',NULL,NULL),(11,'Flash Drive','flash-drive',NULL,NULL),(12,'Memory Card','memory-card',NULL,NULL),(13,'Convertors','convertors',NULL,NULL),(14,'Aux Cables','aux-cables',NULL,NULL),(15,'Screens','screens',NULL,NULL),(16,'Nano Screens','nano-screens',NULL,NULL),(17,'Chargers','chargers',NULL,NULL),(18,'Charger Adapters','charger-adapters',NULL,NULL),(19,'Phones Holders','phones-holders',NULL,NULL),(20,'Headphones','headphones',NULL,NULL),(21,'Gamers Stuffs','gamers-stuffs',NULL,NULL),(22,'Power Banks','power-banks',NULL,NULL),(23,'Mouse','mouse',NULL,NULL),(24,'Youtubers Stuffs','youtubers-stuffs',NULL,NULL),(25,'SD Card','sd-card','2021-11-27 10:33:38','2021-11-27 10:33:38'),(26,'Flash Memory','flash-memory','2021-11-27 10:33:49','2021-11-27 10:33:49');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contributions`
--

DROP TABLE IF EXISTS `contributions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contributions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `deposit_date` date NOT NULL DEFAULT current_timestamp(),
  `due_date` date NOT NULL,
  `profits_percent` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: working, 1: returned',
  `returned_date` date DEFAULT NULL,
  `contributor_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contributions_contributor_id_foreign` (`contributor_id`),
  CONSTRAINT `contributions_contributor_id_foreign` FOREIGN KEY (`contributor_id`) REFERENCES `contributors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contributions`
--

LOCK TABLES `contributions` WRITE;
/*!40000 ALTER TABLE `contributions` DISABLE KEYS */;
INSERT INTO `contributions` VALUES (1,-580,'This is the description','2021-10-13','2022-10-13',100,0,NULL,1,'2021-10-12 21:00:00','2022-01-19 10:38:48'),(2,5000,'This is the description','2021-10-13','2022-10-13',20,0,'2021-12-03',2,'2021-10-12 21:00:00','2021-12-04 09:43:23');
/*!40000 ALTER TABLE `contributions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contributors`
--

DROP TABLE IF EXISTS `contributors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contributors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contributors`
--

LOCK TABLES `contributors` WRITE;
/*!40000 ALTER TABLE `contributors` DISABLE KEYS */;
INSERT INTO `contributors` VALUES (1,'Ahmad Omar Karman','5353402539','Owner',NULL,NULL),(2,'Yusuf Karman','5353402539','Contributor in Goods.',NULL,NULL);
/*!40000 ALTER TABLE `contributors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `debtors`
--

DROP TABLE IF EXISTS `debtors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `debtors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `debtors_user_id_foreign` (`user_id`),
  CONSTRAINT `debtors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debtors`
--

LOCK TABLES `debtors` WRITE;
/*!40000 ALTER TABLE `debtors` DISABLE KEYS */;
INSERT INTO `debtors` VALUES (9,'Ahmad Hammadeh','537 336 66 15',1,'2022-02-18 10:16:04','2022-02-18 10:16:04');
/*!40000 ALTER TABLE `debtors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `debts`
--

DROP TABLE IF EXISTS `debts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `debts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `is_paid` int(11) NOT NULL DEFAULT 0,
  `due` date NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `debtor_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `debts_product_id_foreign` (`product_id`),
  KEY `debts_debtor_id_foreign` (`debtor_id`),
  CONSTRAINT `debts_debtor_id_foreign` FOREIGN KEY (`debtor_id`) REFERENCES `debtors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `debts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debts`
--

LOCK TABLES `debts` WRITE;
/*!40000 ALTER TABLE `debts` DISABLE KEYS */;
INSERT INTO `debts` VALUES (3,'Remain','old account',1295,1295,1,0,'2024-06-10',1,9,'2022-02-18 10:17:17','2022-02-18 10:17:17'),(4,'Remain','538 207 34 96	   Mutlu Firsat 21 GB	 Kontor + 50 TL',40,40,1,0,'2024-10-22',1,9,'2022-02-18 10:18:15','2022-02-18 10:18:22'),(5,'Kontor','538 778 14 29	  Net 12 GB pos ✅✅',75,75,1,0,'2022-03-08',1,9,'2022-02-18 10:19:02','2022-02-18 10:19:02');
/*!40000 ALTER TABLE `debts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'store' COMMENT 'Shopping, Store, Loses',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `bill_id` bigint(20) unsigned NOT NULL,
  `contribution_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_user_id_foreign` (`user_id`),
  KEY `expenses_contribution_id_foreign` (`contribution_id`),
  KEY `expenses_bill_id_foreign` (`bill_id`),
  CONSTRAINT `expenses_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `expenses_contribution_id_foreign` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`),
  CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incomes`
--

DROP TABLE IF EXISTS `incomes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `incomes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Cost, Profit',
  `amount` int(11) NOT NULL,
  `sale_id` bigint(20) unsigned NOT NULL,
  `contribution_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incomes_sale_id_foreign` (`sale_id`),
  KEY `incomes_contribution_id_foreign` (`contribution_id`),
  KEY `incomes_user_id_foreign` (`user_id`),
  CONSTRAINT `incomes_contribution_id_foreign` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`),
  CONSTRAINT `incomes_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
  CONSTRAINT `incomes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=315 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incomes`
--

LOCK TABLES `incomes` WRITE;
/*!40000 ALTER TABLE `incomes` DISABLE KEYS */;
INSERT INTO `incomes` VALUES (55,'cost',155,2,1,1,'2022-02-16 08:28:13','2022-02-16 08:28:13'),(56,'profit',35,2,1,1,'2022-02-16 08:28:13','2022-02-16 08:28:13'),(57,'cost',18,3,1,1,'2022-02-16 08:35:25','2022-02-16 08:35:25'),(58,'profit',22,3,1,1,'2022-02-16 08:35:25','2022-02-16 08:35:25'),(59,'cost',25,4,1,1,'2022-02-16 08:35:25','2022-02-16 08:35:25'),(60,'profit',25,4,1,1,'2022-02-16 08:35:25','2022-02-16 08:35:25'),(61,'cost',148,5,1,1,'2022-02-16 08:35:25','2022-02-16 08:35:25'),(62,'profit',62,5,1,1,'2022-02-16 08:35:25','2022-02-16 08:35:25'),(63,'cost',13,6,1,1,'2022-02-16 08:35:26','2022-02-16 08:35:26'),(64,'profit',17,6,1,1,'2022-02-16 08:35:26','2022-02-16 08:35:26'),(65,'cost',48,7,1,1,'2022-02-16 08:35:26','2022-02-16 08:35:26'),(66,'profit',27,7,1,1,'2022-02-16 08:35:26','2022-02-16 08:35:26'),(67,'cost',0,8,1,1,'2022-02-16 08:41:57','2022-02-16 08:41:57'),(68,'profit',47,8,1,1,'2022-02-16 08:41:57','2022-02-16 08:41:57'),(69,'cost',0,9,1,1,'2022-02-16 08:41:58','2022-02-16 08:41:58'),(70,'profit',47,9,1,1,'2022-02-16 08:41:58','2022-02-16 08:41:58'),(77,'cost',0,13,1,1,'2022-02-17 10:31:37','2022-02-17 10:31:37'),(78,'profit',4,13,1,1,'2022-02-17 10:31:37','2022-02-17 10:31:37'),(79,'cost',6,14,1,1,'2022-02-17 10:31:37','2022-02-17 10:31:37'),(80,'profit',9,14,1,1,'2022-02-17 10:31:37','2022-02-17 10:31:37'),(81,'cost',10,15,1,1,'2022-02-17 10:31:38','2022-02-17 10:31:38'),(82,'profit',10,15,1,1,'2022-02-17 10:31:38','2022-02-17 10:31:38'),(83,'cost',0,16,1,1,'2022-02-17 11:12:32','2022-02-17 11:12:32'),(84,'profit',40,16,1,1,'2022-02-17 11:12:32','2022-02-17 11:12:32'),(85,'cost',0,17,1,1,'2022-02-17 11:18:37','2022-02-17 11:18:37'),(86,'profit',10,17,1,1,'2022-02-17 11:18:37','2022-02-17 11:18:37'),(91,'cost',52,20,1,1,'2022-02-17 15:31:54','2022-02-17 15:31:54'),(92,'profit',3,20,1,1,'2022-02-17 15:31:54','2022-02-17 15:31:54'),(93,'cost',2,21,1,1,'2022-02-18 06:37:14','2022-02-18 06:37:14'),(94,'profit',8,21,1,1,'2022-02-18 06:37:14','2022-02-18 06:37:14'),(95,'cost',2,22,1,1,'2022-02-18 06:37:14','2022-02-18 06:37:14'),(96,'profit',8,22,1,1,'2022-02-18 06:37:14','2022-02-18 06:37:14'),(97,'cost',135,23,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(98,'profit',5,23,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(99,'cost',71,24,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(100,'profit',4,24,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(101,'cost',39,25,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(102,'profit',11,25,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(103,'cost',11,26,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(104,'profit',14,26,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(105,'cost',1232,27,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(106,'profit',8,27,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(107,'cost',7,28,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(108,'profit',8,28,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(109,'cost',320,29,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(110,'profit',10,29,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(111,'cost',5,30,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(112,'profit',5,30,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(113,'cost',0,31,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(114,'profit',50,31,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(115,'cost',0,32,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(116,'profit',15,32,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(117,'cost',26,33,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(118,'profit',19,33,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(119,'cost',142,34,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(120,'profit',18,34,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(121,'cost',40,35,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(122,'profit',10,35,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(123,'cost',62,36,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(124,'profit',3,36,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(125,'cost',148,37,1,1,'2022-02-20 15:40:36','2022-02-20 15:40:36'),(126,'profit',42,37,1,1,'2022-02-20 15:40:36','2022-02-20 15:40:36'),(127,'cost',54,38,1,1,'2022-02-20 15:40:36','2022-02-20 15:40:36'),(128,'profit',11,38,1,1,'2022-02-20 15:40:36','2022-02-20 15:40:36'),(129,'cost',77,39,1,1,'2022-02-20 15:40:36','2022-02-20 15:40:36'),(130,'profit',8,39,1,1,'2022-02-20 15:40:36','2022-02-20 15:40:36'),(131,'cost',156,40,1,1,'2022-02-22 08:06:41','2022-02-22 08:06:41'),(132,'profit',34,40,1,1,'2022-02-22 08:06:41','2022-02-22 08:06:41'),(133,'cost',156,41,1,1,'2022-02-22 08:06:41','2022-02-22 08:06:41'),(134,'profit',34,41,1,1,'2022-02-22 08:06:41','2022-02-22 08:06:41'),(135,'cost',108,42,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(136,'profit',32,42,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(139,'cost',71,44,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(140,'profit',9,44,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(141,'cost',234,45,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(142,'profit',6,45,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(143,'cost',0,46,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(144,'profit',5,46,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(145,'cost',13,47,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(146,'profit',12,47,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(147,'cost',12,48,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(148,'profit',3,48,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(149,'cost',14,49,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(150,'profit',2,49,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(151,'cost',23,50,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(152,'profit',7,50,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(153,'cost',36,51,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(154,'profit',8,51,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(155,'cost',22,52,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(156,'profit',8,52,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(157,'cost',26,53,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(158,'profit',4,53,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(159,'cost',37,54,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(160,'profit',8,54,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(161,'cost',14,55,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(162,'profit',2,55,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(163,'cost',248,56,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(164,'profit',32,56,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(165,'cost',88,57,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(166,'profit',12,57,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(167,'cost',81,58,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(168,'profit',19,58,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(169,'cost',88,59,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(170,'profit',12,59,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(171,'cost',40,60,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(172,'profit',10,60,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(173,'cost',0,61,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(174,'profit',10,61,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(175,'cost',57,62,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(176,'profit',8,62,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(177,'cost',138,63,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(178,'profit',12,63,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(183,'cost',0,64,1,1,'2022-02-24 09:11:52','2022-02-24 09:12:14'),(184,'profit',10,64,1,1,'2022-02-24 09:11:52','2022-02-24 09:12:14'),(185,'cost',4,65,1,1,'2022-03-01 08:06:32','2022-03-01 08:06:54'),(186,'profit',11,65,1,1,'2022-03-01 08:06:32','2022-03-01 08:06:54'),(187,'cost',56,66,1,1,'2022-03-01 08:05:30','2022-03-01 08:05:58'),(188,'profit',9,66,1,1,'2022-03-01 08:05:30','2022-03-01 08:05:58'),(189,'cost',51,67,1,1,'2022-02-28 12:48:39','2022-02-28 12:49:08'),(190,'profit',4,67,1,1,'2022-02-28 12:48:39','2022-02-28 12:49:08'),(191,'cost',16,68,1,1,'2022-02-28 07:46:28','2022-02-28 07:46:41'),(192,'profit',0,68,1,1,'2022-02-28 07:46:28','2022-02-28 07:46:41'),(193,'cost',30,69,1,1,'2022-02-28 07:44:16','2022-02-28 07:44:30'),(194,'profit',0,69,1,1,'2022-02-28 07:44:16','2022-02-28 07:44:30'),(195,'cost',5,70,1,1,'2022-02-28 07:16:47','2022-02-28 07:16:53'),(196,'profit',10,70,1,1,'2022-02-28 07:16:47','2022-02-28 07:16:53'),(197,'cost',5,71,1,1,'2022-02-28 07:13:53','2022-02-28 07:14:17'),(198,'profit',10,71,1,1,'2022-02-28 07:13:53','2022-02-28 07:14:17'),(199,'cost',60,72,1,1,'2022-02-28 06:54:34','2022-02-28 07:00:57'),(200,'profit',40,72,1,1,'2022-02-28 06:54:34','2022-02-28 07:00:57'),(201,'cost',42,73,1,1,'2022-02-28 06:54:33','2022-02-28 06:55:44'),(202,'profit',8,73,1,1,'2022-02-28 06:54:33','2022-02-28 06:55:44'),(203,'cost',34,74,1,1,'2022-02-28 06:54:31','2022-02-28 06:54:59'),(204,'profit',6,74,1,1,'2022-02-28 06:54:31','2022-02-28 06:54:59'),(205,'cost',91,75,1,1,'2022-03-01 14:43:42','2022-03-01 14:44:03'),(206,'profit',9,75,1,1,'2022-03-01 14:43:42','2022-03-01 14:44:03'),(207,'cost',6,76,1,1,'2022-03-01 13:35:01','2022-03-01 13:35:08'),(208,'profit',9,76,1,1,'2022-03-01 13:35:01','2022-03-01 13:35:08'),(209,'cost',61,77,1,1,'2022-03-01 13:33:12','2022-03-01 13:34:46'),(210,'profit',9,77,1,1,'2022-03-01 13:33:12','2022-03-01 13:34:46'),(211,'cost',51,78,1,1,'2022-03-01 13:33:13','2022-03-01 13:34:24'),(212,'profit',9,78,1,1,'2022-03-01 13:33:13','2022-03-01 13:34:24'),(213,'cost',48,79,1,1,'2022-03-01 13:33:11','2022-03-01 13:33:55'),(214,'profit',12,79,1,1,'2022-03-01 13:33:11','2022-03-01 13:33:55'),(215,'cost',0,80,1,1,'2022-03-01 13:33:11','2022-03-01 13:33:11'),(216,'profit',0,80,1,1,'2022-03-01 13:33:11','2022-03-01 13:33:11'),(217,'cost',11,81,1,1,'2022-03-01 11:11:17','2022-03-01 11:11:45'),(218,'profit',9,81,1,1,'2022-03-01 11:11:17','2022-03-01 11:11:45'),(219,'cost',435,82,1,1,'2022-03-01 09:52:16','2022-03-01 09:52:53'),(220,'profit',5,82,1,1,'2022-03-01 09:52:16','2022-03-01 09:52:53'),(221,'cost',61,83,1,1,'2022-03-01 09:38:25','2022-03-01 09:39:08'),(222,'profit',9,83,1,1,'2022-03-01 09:38:25','2022-03-01 09:39:08'),(223,'cost',51,84,1,1,'2022-03-01 09:38:15','2022-03-01 09:38:46'),(224,'profit',4,84,1,1,'2022-03-01 09:38:15','2022-03-01 09:38:46'),(225,'cost',4,85,1,1,'2022-03-02 14:23:47','2022-03-02 14:26:07'),(226,'profit',6,85,1,1,'2022-03-02 14:23:47','2022-03-02 14:26:07'),(227,'cost',60,86,1,1,'2022-03-02 14:23:48','2022-03-02 14:25:26'),(228,'profit',10,86,1,1,'2022-03-02 14:23:48','2022-03-02 14:25:26'),(229,'cost',60,87,1,1,'2022-03-02 14:23:49','2022-03-02 14:24:53'),(230,'profit',10,87,1,1,'2022-03-02 14:23:49','2022-03-02 14:24:53'),(231,'cost',65,88,1,1,'2022-03-02 14:23:46','2022-03-02 14:24:26'),(232,'profit',10,88,1,1,'2022-03-02 14:23:46','2022-03-02 14:24:26'),(233,'cost',50,89,1,1,'2022-03-04 14:33:56','2022-03-04 14:34:24'),(234,'profit',10,89,1,1,'2022-03-04 14:33:56','2022-03-04 14:34:24'),(235,'cost',55,90,1,1,'2022-03-04 12:51:23','2022-03-04 12:53:01'),(236,'profit',5,90,1,1,'2022-03-04 12:51:23','2022-03-04 12:53:01'),(237,'cost',73,91,1,1,'2022-03-04 12:51:28','2022-03-04 12:52:02'),(238,'profit',12,91,1,1,'2022-03-04 12:51:28','2022-03-04 12:52:02'),(239,'cost',27,92,1,1,'2022-03-04 12:19:31','2022-03-04 12:19:39'),(240,'profit',18,92,1,1,'2022-03-04 12:19:31','2022-03-04 12:19:39'),(241,'cost',13,93,1,1,'2022-03-04 11:49:50','2022-03-04 11:49:56'),(242,'profit',22,93,1,1,'2022-03-04 11:49:50','2022-03-04 11:49:56'),(243,'cost',25,94,1,1,'2022-03-04 11:09:02','2022-03-04 11:09:07'),(244,'profit',15,94,1,1,'2022-03-04 11:09:02','2022-03-04 11:09:07'),(245,'cost',0,95,1,1,'2022-03-04 08:34:49','2022-03-04 08:35:08'),(246,'profit',3,95,1,1,'2022-03-04 08:34:49','2022-03-04 08:35:08'),(247,'cost',5,96,1,1,'2022-03-03 14:03:08','2022-03-03 14:03:23'),(248,'profit',15,96,1,1,'2022-03-03 14:03:08','2022-03-03 14:03:23'),(249,'cost',11,97,1,1,'2022-03-03 13:00:47','2022-03-03 13:00:47'),(250,'profit',19,97,1,1,'2022-03-03 13:00:47','2022-03-03 13:00:47'),(251,'cost',4,98,1,1,'2022-03-06 15:09:55','2022-03-06 15:09:55'),(252,'profit',6,98,1,1,'2022-03-06 15:09:55','2022-03-06 15:09:55'),(253,'cost',5,99,1,1,'2022-03-06 15:08:57','2022-03-06 15:09:02'),(254,'profit',10,99,1,1,'2022-03-06 15:08:57','2022-03-06 15:09:02'),(255,'cost',50,100,1,1,'2022-03-06 14:24:11','2022-03-06 14:25:03'),(256,'profit',5,100,1,1,'2022-03-06 14:24:11','2022-03-06 14:25:03'),(257,'cost',60,101,1,1,'2022-03-06 14:24:05','2022-03-06 14:24:33'),(258,'profit',10,101,1,1,'2022-03-06 14:24:05','2022-03-06 14:24:33'),(261,'cost',46,103,1,1,'2022-03-06 14:18:43','2022-03-06 14:21:13'),(262,'profit',4,103,1,1,'2022-03-06 14:18:43','2022-03-06 14:21:13'),(263,'cost',46,104,1,1,'2022-03-06 14:18:45','2022-03-06 14:20:51'),(264,'profit',4,104,1,1,'2022-03-06 14:18:45','2022-03-06 14:20:51'),(265,'cost',60,105,1,1,'2022-03-06 14:18:47','2022-03-06 14:20:21'),(266,'profit',10,105,1,1,'2022-03-06 14:18:47','2022-03-06 14:20:21'),(267,'cost',56,106,1,1,'2022-03-06 14:18:48','2022-03-06 14:19:55'),(268,'profit',9,106,1,1,'2022-03-06 14:18:48','2022-03-06 14:19:55'),(269,'cost',60,107,1,1,'2022-03-06 14:18:49','2022-03-06 14:19:32'),(270,'profit',10,107,1,1,'2022-03-06 14:18:49','2022-03-06 14:19:32'),(271,'cost',45,108,1,1,'2022-03-06 10:05:07','2022-03-06 10:05:29'),(272,'profit',10,108,1,1,'2022-03-06 10:05:07','2022-03-06 10:05:29'),(273,'cost',9,109,1,1,'2022-03-06 07:52:15','2022-03-06 07:52:50'),(274,'profit',11,109,1,1,'2022-03-06 07:52:15','2022-03-06 07:52:50'),(275,'cost',50,110,1,1,'2022-03-06 06:30:04','2022-03-06 06:31:07'),(276,'profit',10,110,1,1,'2022-03-06 06:30:04','2022-03-06 06:31:07'),(277,'cost',60,111,1,1,'2022-03-06 06:30:02','2022-03-06 06:30:33'),(278,'profit',10,111,1,1,'2022-03-06 06:30:02','2022-03-06 06:30:33'),(279,'cost',145,112,1,1,'2022-03-06 05:46:30','2022-03-06 05:47:53'),(280,'profit',15,112,1,1,'2022-03-06 05:46:30','2022-03-06 05:47:53'),(281,'cost',150,113,1,1,'2022-03-06 05:46:43','2022-03-06 05:47:46'),(282,'profit',8,113,1,1,'2022-03-06 05:46:43','2022-03-06 05:47:46'),(283,'cost',138,114,1,1,'2022-03-06 05:46:38','2022-03-06 05:47:36'),(284,'profit',7,114,1,1,'2022-03-06 05:46:38','2022-03-06 05:47:36'),(285,'cost',135,115,1,1,'2022-03-06 05:44:44','2022-03-06 05:46:23'),(286,'profit',7,115,1,1,'2022-03-06 05:44:44','2022-03-06 05:46:23'),(287,'cost',53,116,1,1,'2022-03-06 05:39:25','2022-03-06 05:39:48'),(288,'profit',7,116,1,1,'2022-03-06 05:39:25','2022-03-06 05:39:48'),(289,'cost',98,117,1,1,'2022-03-05 10:22:33','2022-03-05 10:22:33'),(290,'profit',2,117,1,1,'2022-03-05 10:22:33','2022-03-05 10:22:33'),(291,'cost',4,118,1,1,'2022-03-07 13:02:24','2022-03-07 13:02:53'),(292,'profit',11,118,1,1,'2022-03-07 13:02:24','2022-03-07 13:02:53'),(293,'cost',60,119,1,1,'2022-03-07 09:02:51','2022-03-07 09:03:25'),(294,'profit',5,119,1,1,'2022-03-07 09:02:51','2022-03-07 09:03:25'),(295,'cost',0,120,1,1,'2022-03-07 06:52:46','2022-03-07 06:53:04'),(296,'profit',3,120,1,1,'2022-03-07 06:52:46','2022-03-07 06:53:04'),(297,'cost',60,121,1,1,'2022-03-08 13:08:05','2022-03-08 13:08:25'),(298,'profit',10,121,1,1,'2022-03-08 13:08:05','2022-03-08 13:08:25'),(299,'cost',100,122,1,1,'2022-03-08 13:07:06','2022-03-08 13:07:06'),(300,'profit',0,122,1,1,'2022-03-08 13:07:06','2022-03-08 13:07:06'),(301,'cost',117,123,1,1,'2022-03-08 13:06:50','2022-03-08 13:06:54'),(302,'profit',13,123,1,1,'2022-03-08 13:06:50','2022-03-08 13:06:54'),(303,'cost',158,124,1,1,'2022-03-08 13:06:36','2022-03-08 13:06:44'),(304,'profit',12,124,1,1,'2022-03-08 13:06:36','2022-03-08 13:06:44'),(305,'cost',81,125,1,1,'2022-03-08 13:06:22','2022-03-08 13:06:27'),(306,'profit',19,125,1,1,'2022-03-08 13:06:22','2022-03-08 13:06:27'),(307,'cost',70,126,1,1,'2022-03-08 13:06:05','2022-03-08 13:06:12'),(308,'profit',5,126,1,1,'2022-03-08 13:06:05','2022-03-08 13:06:12'),(309,'cost',70,127,1,1,'2022-03-08 10:32:34','2022-03-08 10:32:34'),(310,'profit',55,127,1,1,'2022-03-08 10:32:34','2022-03-08 10:32:34'),(311,'cost',61,128,1,1,'2022-03-08 10:31:29','2022-03-08 10:32:15'),(312,'profit',4,128,1,1,'2022-03-08 10:31:29','2022-03-08 10:32:15'),(313,'cost',65,129,1,1,'2022-03-08 10:31:31','2022-03-08 10:31:50'),(314,'profit',10,129,1,1,'2022-03-08 10:31:31','2022-03-08 10:31:50');
/*!40000 ALTER TABLE `incomes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2020_05_21_100000_create_teams_table',1),(7,'2020_05_21_200000_create_team_user_table',1),(8,'2020_05_21_300000_create_team_invitations_table',1),(9,'2021_08_00_124401_create_carts_table',1),(10,'2021_08_10_173028_create_categories_table',1),(11,'2021_08_20_152842_create_sessions_table',1),(12,'2021_08_25_134856_create_contributors_table',1),(13,'2021_08_25_135119_create_contributions_table',1),(14,'2021_08_25_171711_create_sellers_table',1),(15,'2021_08_26_171711_create_bills_table',1),(16,'2021_08_26_171711_create_brands_table',1),(17,'2021_08_27_171711_create_products_table',1),(19,'2021_09_06_121149_create_debtors_table',1),(20,'2021_09_06_121159_create_debts_table',1),(21,'2021_09_24_161455_create_sales_counters_table',1),(22,'2021_09_28_144003_create_expenses_table',1),(23,'2021_10_03_101241_create_sales_table',1),(24,'2021_10_04_100234_create_incomes_table',1),(25,'2021_11_11_154722_create_products_containers_table',1),(26,'2021_09_02_074818_create_cart_product_table',2),(27,'2021_12_03_112902_add_description_to_sales',3),(28,'2021_12_03_145811_add_description_to_cart_product',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `serial` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Product Code ex: KH-K17',
  `amount` int(11) NOT NULL COMMENT 'Amount in the stock.',
  `price` int(11) NOT NULL COMMENT 'Selling Price.',
  `cost` int(11) NOT NULL COMMENT 'The price of the product when you bought it.',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill_id` bigint(20) unsigned NOT NULL,
  `brand_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `contribution_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_serial_unique` (`serial`),
  KEY `products_brand_id_foreign` (`brand_id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_contribution_id_foreign` (`contribution_id`),
  KEY `products_user_id_foreign` (`user_id`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `products_contribution_id_foreign` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`),
  CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1168 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,0,'Other',NULL,'****',902,0,0,'other',1,6,1,1,1,'2021-11-26 12:53:56','2022-03-09 07:02:39'),(1001,10011001,'Product 1001','desc','TGB',14,100,9,'product-1001',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-02 10:02:51'),(1002,10021002,'Product 1002','desc','AKG',7,100,11,'product-1002',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-20 08:58:48'),(1003,10031003,'Product 1003','desc','AKG',9,100,19,'product-1003',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1004,10041004,'Product 1004','desc','J5',19,100,6,'product-1004',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-02 07:50:18'),(1006,10061006,'Product 1006','desc','S10',1,100,13,'product-1006',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-08 13:07:52'),(1007,10071007,'Product 1007','desc','KB-890',1,100,45,'product-1007',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1008,10081008,'Product 1008','desc','GP-6757',1,100,20,'product-1008',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1009,10091009,'Product 1009','desc','AURIS-PINK',3,100,18,'product-1009',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1010,10101010,'Product 1010','desc','K16',1,100,48,'product-1010',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 08:35:26'),(1011,10111011,'Product 1011','desc','K15',1,100,31,'product-1011',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 08:42:17'),(1012,10121012,'Product 1012','desc','PL-3050',4,100,6,'product-1012',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1013,10131013,'Product 1013','desc','K-203',3,100,10,'product-1013',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1014,10141014,'Product 1014','desc','KH-H35',1,100,23,'product-1014',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-24 06:20:47'),(1015,10151015,'Product 1015','desc','K-170',2,100,17,'product-1015',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1016,10161016,'Product 1016','desc','K-221',1,100,20,'product-1016',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1017,10171017,'Product 1017','desc','KH-420',1,100,11,'product-1017',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1018,10181018,'Product 1018','desc','REALME',2,100,13,'product-1018',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1019,10191019,'Product 1019','desc','KH-HB22',2,225,160,'product-1019',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-28 07:12:36'),(1020,10201020,'Product 1020','desc','EXTRA-PASS',4,100,40,'product-1020',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1021,10211021,'Product 1021','desc','KM-306',1,100,89,'product-1021',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1022,10221022,'Product 1022','desc','KM-296',1,100,75,'product-1022',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1023,10231023,'Product 1023','desc','KM-293',1,100,67,'product-1023',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1024,10241024,'Product 1024','desc','KM-295',1,100,67,'product-1024',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1025,10251025,'Product 1025','desc','K-253',1,100,73,'product-1025',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1026,10261026,'Product 1026','desc','KBS-1301',2,100,39,'product-1026',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1027,10271027,'Product 1027','desc','MH-32BT',1,100,105,'product-1027',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1028,10281028,'Product 1028','desc','KTS-1106',1,100,114,'product-1028',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1029,10291029,'Product 1029','desc','KB-940',2,100,148,'product-1029',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1030,10301030,'Product 1030','desc','KB-958',2,100,94,'product-1030',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-20 15:31:45'),(1031,10311031,'Product 1031','desc','KH-HB19',3,100,42,'product-1031',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1032,10321032,'Product 1032','desc','B-516',2,100,91,'product-1032',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1033,10331033,'Product 1033','desc','KB-300',1,100,89,'product-1033',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1034,10341034,'Product 1034','desc','IP-70',5,100,31,'product-1034',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1035,10351035,'Product 1035','desc','KH-228',2,100,31,'product-1035',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1036,10361036,'Product 1036','desc','K-171',2,100,16,'product-1036',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1037,10371037,'Product 1037','desc','SYX-IP',4,100,13,'product-1037',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 08:35:26'),(1038,10381038,'Product 1038','desc','SELFI-LED',2,100,25,'product-1038',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1039,10391039,'Product 1039','desc','KH-10',3,100,39,'product-1039',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1040,10401040,'Product 1040','desc','KH-08',5,100,37,'product-1040',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-24 06:20:47'),(1041,10411041,'Product 1041','desc','KO-115',1,100,67,'product-1041',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1042,10421042,'Product 1042','desc','KO-130',1,100,75,'product-1042',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1043,10431043,'Product 1043','desc','KO-135',1,100,100,'product-1043',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1044,10441044,'Product 1044','desc','KO-120',1,100,123,'product-1044',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1045,10451045,'Product 1045','desc','LKC-29',1,100,27,'product-1045',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-05 10:22:17'),(1046,10461046,'Product 1046','desc','KH-JC7',1,100,16,'product-1046',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1047,10471047,'Product 1047','desc','KH-JC10',1,100,24,'product-1047',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1048,10481048,'Product 1048','desc','PL-9123',1,100,15,'product-1048',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1049,10491049,'Product 1049','desc','Keyboard-arabic',2,100,5,'product-1049',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-06 15:10:19'),(1050,10501050,'Product 1050','desc','UC-620',2,100,6,'product-1050',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1051,10511051,'Product 1051','desc','MY-TELL',1,100,6,'product-1051',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1052,10521052,'Product 1052','desc','KC-55',0,100,13,'product-1052',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-05 10:22:17'),(1053,10531053,'Product 1053','desc','KH-C24',1,100,13,'product-1053',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-24 06:20:47'),(1054,10541054,'Product 1054','desc','KH-C75',1,100,11,'product-1054',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-24 06:20:47'),(1055,10551055,'Product 1055','desc','KH-C46',2,100,15,'product-1055',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1056,10561056,'Product 1056','desc','KH-C57',2,100,9,'product-1056',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1057,10571057,'Product 1057','desc','SM-20',1,100,10,'product-1057',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1058,10581058,'Product 1058','desc','IP-20',2,100,10,'product-1058',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1059,10591059,'Product 1059','desc','TP-20',2,100,10,'product-1059',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1060,10601060,'Product 1060','desc','SM-30',0,100,10,'product-1060',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-17 10:31:38'),(1061,10611061,'Product 1061','desc','KC-50',1,100,12,'product-1061',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1062,10621062,'Product 1062','desc','KH-11',2,100,12,'product-1062',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1063,10631063,'Product 1063','desc','OTG-64',1,100,56,'product-1063',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1064,10641064,'Product 1064','desc','OTG-16',1,100,39,'product-1064',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1065,10651065,'Product 1065','desc','OTG-32',1,100,42,'product-1065',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1066,10661066,'Product 1066','desc','SYX-MC128',1,175,143,'product-1066',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-22 12:07:54'),(1067,10671067,'Product 1067','desc','SYX-MC16',1,70,30,'product-1067',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-22 12:08:11'),(1068,10681068,'Product 1068','desc','K-SD64',1,95,55,'product-1068',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-22 12:08:33'),(1069,10691069,'Product 1069','desc','SYX-MC32',1,75,37,'product-1069',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-22 12:08:17'),(1070,10701070,'Product 1070','desc','PUBG-TOOL',3,20,7,'product-1070',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-01 08:07:03'),(1071,10711071,'Product 1071','desc','YUZUK',45,100,3,'product-1071',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1072,10721072,'Product 1072','desc','KAPAK',146,100,9,'product-1072',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1073,10731073,'Product 1073','desc','KH-HB18',0,100,98,'product-1073',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-06 15:10:19'),(1074,10741074,'Product 1074','desc','E-S32',1,100,100,'product-1074',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1075,10751075,'Product 1075','desc','J02K',1,100,10,'product-1075',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1076,10761076,'Product 1076','desc','J13K',1,100,10,'product-1076',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1077,10771077,'Product 1077','desc','JH-010',1,100,50,'product-1077',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1078,10781078,'Product 1078','desc','KT-302',1,100,31,'product-1078',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1079,10791079,'Product 1079','desc','JO-LM01',1,100,30,'product-1079',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1080,10801080,'Product 1080','desc','KH-J41',0,100,25,'product-1080',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 08:35:26'),(1081,10811081,'Product 1081','desc','QC-50',6,100,22,'product-1081',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-04 15:33:54'),(1082,10821082,'Product 1082','desc','Q32',1,100,34,'product-1082',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1083,10831083,'Product 1083','desc','J28',1,100,16,'product-1083',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1084,10841084,'Product 1084','desc','S23',1,100,35,'product-1084',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1085,10851085,'Product 1085','desc','PB-10',1,100,90,'product-1085',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1086,10861086,'Product 1086','desc','CHARGER-KNIFE',1,100,50,'product-1086',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1087,10871087,'Product 1087','desc','KB-980',2,100,131,'product-1087',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1088,10881088,'Product 1088','desc','KB-985',3,100,108,'product-1088',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-22 15:19:56'),(1089,10891089,'Product 1089','desc','KH-HB21',0,100,100,'product-1089',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-09 07:02:39'),(1090,10901090,'Product 1090','desc','KB-950',3,225,151,'product-1090',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-22 08:48:54'),(1091,10911091,'Product 1091','desc','KB-955',3,225,158,'product-1091',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-09 07:02:39'),(1092,10921092,'Product 1092','desc','PWATCHX',1,100,125,'product-1092',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1093,10931093,'Product 1093','desc','KB-928',1,100,134,'product-1093',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1094,10941094,'Product 1094','desc','KB-995',0,100,135,'product-1094',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-06 15:10:19'),(1095,10951095,'Product 1095','desc','KB-835',2,200,124,'product-1095',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-24 06:20:47'),(1096,10961096,'Product 1096','desc','POWER-CABLE',3,100,25,'product-1096',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1097,10971097,'Product 1097','desc','OTG-5',6,100,5,'product-1097',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1098,10981098,'Product 1098','desc','KH-CT11',3,100,6,'product-1098',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1099,10991099,'Product 1099','desc','TC-MICRO',2,100,7,'product-1099',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1100,11001100,'Product 1100','desc','USB-TC',2,100,10,'product-1100',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1101,11011101,'Product 1101','desc','LIGHT-HUB',2,100,15,'product-1101',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1102,11021102,'Product 1102','desc','BATTAREY',3,100,30,'product-1102',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1103,11031103,'Product 1103','desc','NOTE4-BT',1,100,75,'product-1103',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1104,11041104,'Product 1104','desc','METAL-YUZUK',6,100,6,'product-1104',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-17 10:31:38'),(1106,11061106,'Product 1106','desc','J40',1,100,15,'product-1106',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1107,11071107,'Product 1107','desc','KH-J40',1,100,25,'product-1107',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1108,11081108,'Product 1108','desc','ST-201',1,100,25,'product-1108',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1109,11091109,'Product 1109','desc','KH-CH80',1,100,12,'product-1109',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1110,11101110,'Product 1110','desc','H10',1,100,11,'product-1110',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1111,11111111,'Product 1111','desc','SIM-ADAPTAR',10,100,5,'product-1111',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1112,11121112,'Product 1112','desc','CB3',2,100,48,'product-1112',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1113,11131113,'Product 1113','desc','CB-30',1,100,12,'product-1113',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-24 06:20:47'),(1114,11141114,'Product 1114','desc','TP-612',1,100,12,'product-1114',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1115,11151115,'Product 1115','desc','A-25',2,100,19,'product-1115',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1116,11161116,'Product 1116','desc','PLX-070',2,100,12,'product-1116',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1117,11171117,'Product 1117','desc','AUX-ARAC',1,100,22,'product-1117',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1118,11181118,'Product 1118','desc','C84',3,100,4,'product-1118',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1119,11191119,'Product 1119','desc','AUX-LIGHT',1,100,25,'product-1119',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-05 10:22:17'),(1120,11201120,'Product 1120','desc','AUX-TC',3,100,10,'product-1120',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1121,11211121,'Product 1121','desc','DK-151',1,100,5,'product-1121',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-05 10:22:17'),(1122,11221122,'Product 1122','desc','C83',3,100,6,'product-1122',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1123,11231123,'Product 1123','desc','C78',3,100,5,'product-1123',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1124,11241124,'Product 1124','desc','PC-35',4,40,16,'product-1124',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-22 13:12:07'),(1125,11251125,'Product  1125','desc','LKL-04',4,40,14,'product-1125',1,1,1,1,1,'2022-02-16 08:47:43','2022-02-24 06:20:47'),(1126,11261126,'Product 1126','desc','veno-micro',1,25,7,'product-1126',1,1,1,1,1,'2022-02-16 08:48:23','2022-02-24 06:20:47'),(1127,11271127,'Product 1127','desc','w11',2,30,9,'product-1127',1,1,1,1,1,'2022-02-16 08:49:02','2022-02-16 08:49:02'),(1128,11281128,'Product 1128','desc\n','i12',0,125,70,'product-1128',1,1,1,1,1,'2022-02-16 08:49:40','2022-03-09 07:02:39'),(1129,11291129,'Product 1129','desc','sam-orj',4,30,11,'product-1129',1,1,1,1,1,'2022-02-16 08:50:14','2022-03-05 10:22:17'),(1130,11301130,'Product 1130','desc','torima-bts',3,50,26,'product-1130',1,1,1,1,1,'2022-02-16 08:51:08','2022-02-20 14:07:03'),(1131,11311131,'Product 1131','11311131','kb-948',3,150,88,'product-1131',1,1,1,1,1,'2022-02-20 15:36:21','2022-02-24 06:20:47'),(1132,11321132,'Product 1132','11321132','kb-740',3,200,131,'product-1132',1,1,1,1,1,'2022-02-20 15:37:37','2022-02-22 08:49:26'),(1133,11331133,'Product 1133','a','KB-830',1,200,138,'product-1133',1,1,1,1,1,'2022-02-22 08:52:05','2022-02-22 08:52:05'),(1134,11341134,'Product 1134','asf','KB-970',1,225,165,'product-1134',1,1,1,1,1,'2022-02-22 08:55:37','2022-02-22 08:55:37'),(1135,11351135,'Product 1135','afds','KB-810',1,225,138,'product-1135',1,1,1,1,1,'2022-02-22 08:56:52','2022-03-06 15:10:19'),(1136,11361136,'Product 1136','fa','KB-825',1,200,138,'product-1136',1,1,1,1,1,'2022-02-22 09:10:18','2022-02-22 09:10:18'),(1137,11371137,'Product 1137','DESC\n','KB-895',1,200,117,'product-1137',1,1,1,1,1,'2022-02-22 09:14:38','2022-03-09 07:02:39'),(1138,11381138,'Product 1138','desc','KB-992',1,225,145,'product-1138',1,1,1,1,1,'2022-02-22 09:48:42','2022-03-06 15:10:19'),(1139,11391139,'Product 1139','desc','KM-325',0,225,138,'product-1139',1,1,1,1,1,'2022-02-22 10:15:23','2022-02-24 06:20:47'),(1140,11401140,'Product 1140','desc','KM-290',1,200,110,'product-1140',1,1,1,1,1,'2022-02-22 10:16:05','2022-02-22 10:16:05'),(1141,11411141,'Product 1141','desc','KN-60',8,40,20,'product-1141',1,1,1,1,1,'2022-02-22 10:18:53','2022-02-24 06:20:47'),(1142,11421142,'Product 1142','desc','PW-200-BASLIK',1,100,44,'product-1142',1,1,1,1,1,'2022-02-22 10:43:56','2022-02-22 10:43:56'),(1143,11431143,'Product 1143','DESC','PW-200-LIGHTNING',1,125,63,'product-1143',1,1,1,1,1,'2022-02-22 10:47:19','2022-02-22 10:47:19'),(1144,11441144,'Product  1144','desc','KM-04',1,55,27,'product-1144',1,1,1,1,1,'2022-02-22 12:09:21','2022-02-22 12:09:21'),(1145,11451145,'Product 1145','desc','M-40',1,50,24,'product-1145',1,1,1,1,1,'2022-02-22 12:10:02','2022-02-22 12:10:02'),(1146,11461146,'Product 1146','desc','M-42',1,60,30,'product-1146',1,1,1,1,1,'2022-02-22 12:10:35','2022-02-22 12:10:35'),(1147,11471147,'Product 1147','desc','T-74',1,60,28,'product-1147',1,1,1,1,1,'2022-02-22 12:25:13','2022-02-22 12:25:13'),(1148,11481148,'Product 1148','desc','T-41',1,60,30,'product-1148',1,1,1,1,1,'2022-02-22 12:25:43','2022-02-22 12:25:43'),(1149,11491149,'Product 1149','desc','T-53',1,60,31,'product-1149',1,1,1,1,1,'2022-02-22 12:26:13','2022-02-22 12:26:13'),(1150,11501150,'Product 1150','desc','T-45',1,80,40,'product-1150',1,1,1,1,1,'2022-02-22 12:26:50','2022-02-22 12:26:50'),(1151,11511151,'Product 1151','desc','KB-918',1,150,81,'product-1151',1,1,1,1,1,'2022-02-22 12:45:05','2022-03-09 07:02:39'),(1152,11521152,'Product 1152','desc','KB-990',2,150,88,'product-1152',1,1,1,1,1,'2022-02-22 12:46:18','2022-02-24 06:20:47'),(1153,11531153,'Product 1153','desc','KB-620',1,200,101,'product-1153',1,1,1,1,1,'2022-02-22 13:14:24','2022-02-22 13:14:24'),(1154,11541154,'Product 1154','desc','KB-640',1,200,101,'product-1154',1,1,1,1,1,'2022-02-22 13:15:19','2022-02-22 13:15:19'),(1155,11551155,'Product 1155','desc','PUBG-FINGER',2,25,9,'product-1155',1,1,1,1,1,'2022-02-28 07:16:00','2022-02-28 07:16:00'),(1156,11561156,'Product 1156','desc','ADDAPTOR-FIS',4,10,4,'product-1156',1,1,1,1,1,'2022-02-28 07:16:38','2022-03-06 15:10:19'),(1157,11571157,'Product  1157','desc','SYX-MX10',1,200,148,'product-1157',1,1,1,1,1,'2022-02-28 07:35:00','2022-02-28 07:35:00'),(1158,11581158,'Product 1158','desc','PRO4',0,250,150,'product-1158',1,1,1,1,1,'2022-02-28 07:36:06','2022-03-06 15:10:19'),(1159,11591159,'Product 1159','DESC','LKB-04',1,200,125,'product-1159',1,1,1,1,1,'2022-02-28 07:37:44','2022-02-28 07:37:44'),(1160,11601160,'Product 1160','DESC','LKL-01',8,35,15,'product-1160',1,1,1,1,1,'2022-02-28 07:38:38','2022-03-01 08:07:03'),(1161,11611161,'Product 1161','DESC','TGB-017',3,20,8,'product-1161',1,1,1,1,1,'2022-02-28 07:46:17','2022-03-01 08:07:03'),(1162,11621162,'Product 1162','DESC','AC-2',1,40,25,'product-1162',1,1,1,1,1,'2022-02-28 07:47:23','2022-02-28 07:47:23'),(1163,11631163,'Product 1163','desc','K1-29',1,45,20,'product-1163',1,1,1,1,1,'2022-02-28 07:48:03','2022-02-28 07:48:03'),(1164,11641164,'Product 1164','desc','J2355',6,35,18,'product-1164',1,1,1,1,1,'2022-03-08 13:11:14','2022-03-08 13:11:14'),(1165,11651165,'Product 1165','desc','x587',1,35,18,'product-1165',1,1,1,1,1,'2022-03-08 13:11:39','2022-03-08 13:11:39'),(1166,11661166,'Product 1166','desc','PRO3',1,225,130,'product-1166',1,1,1,1,1,'2022-03-08 13:12:28','2022-03-08 13:12:28'),(1167,11671167,'Product 1167','desc','wireless-sport',2,75,37,'product-1167',1,1,1,1,1,'2022-03-09 07:17:32','2022-03-09 07:17:32');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_containers`
--

DROP TABLE IF EXISTS `products_containers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_containers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `container` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_created` int(11) NOT NULL COMMENT '1 Products in Container Has been created in stock.',
  `bill_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_containers_bill_id_foreign` (`bill_id`),
  CONSTRAINT `products_containers_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_containers`
--

LOCK TABLES `products_containers` WRITE;
/*!40000 ALTER TABLE `products_containers` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_containers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `net_price` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `contribution_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT ' ',
  PRIMARY KEY (`id`),
  KEY `sales_user_id_foreign` (`user_id`),
  KEY `sales_product_id_foreign` (`product_id`),
  KEY `sales_contribution_id_foreign` (`contribution_id`),
  CONSTRAINT `sales_contribution_id_foreign` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (2,190,155,1,190,35,1,1091,1,'2022-02-12 21:00:00','2022-02-17 11:08:08','Description'),(3,20,9,2,40,22,1,1001,1,'2022-02-12 21:00:00','2022-02-17 11:08:08','Description'),(4,50,25,1,50,25,1,1080,1,'2022-02-12 21:00:00','2022-02-17 11:08:08','Description'),(5,210,148,1,210,62,1,1090,1,'2022-02-12 21:00:00','2022-02-17 11:08:08','Description'),(6,30,13,1,30,17,1,1037,1,'2022-02-12 21:00:00','2022-02-17 11:08:08','Description'),(7,75,48,1,75,27,1,1010,1,'2022-02-12 21:00:00','2022-02-17 11:08:08','Description'),(8,48,0,1,48,48,1,1,1,'2022-02-12 21:00:00','2022-02-17 11:08:08','14-02-2022\nkontor\n'),(9,47,0,1,47,47,1,1,1,'2022-02-12 21:00:00','2022-02-17 11:08:08','14-02-2022\nkontor\n'),(13,5,0,1,5,5,1,1,1,'2022-02-15 21:00:00','2022-02-17 11:09:59','Fatura'),(14,15,6,1,15,9,1,1104,1,'2022-02-15 21:00:00','2022-02-17 11:09:59','Description'),(15,20,10,1,20,10,1,1060,1,'2022-02-15 21:00:00','2022-02-17 11:09:59','Description'),(16,40,0,1,40,40,1,1,1,'2022-02-15 21:00:00','2022-02-17 11:13:12','Laptop Battary Replacment'),(17,10,0,1,10,10,1,1,1,'2022-02-15 21:00:00','2022-02-17 11:18:50','bluetooth reparement'),(20,55,52,1,55,3,1,1,1,'2022-02-17 15:31:54','2022-02-17 15:31:54','kontor: 	531 235 13 53'),(21,10,2,1,10,8,1,1,1,'2022-02-17 06:37:14','2022-02-17 06:37:14','Phone Screen \nModel: Nova 3i'),(22,85,75,1,85,10,1,1,1,'2022-02-17 06:37:14','2022-02-17 06:37:14','Freefire: 795 d, ID: 1894967809'),(23,140,135,1,140,5,1,1,1,'2022-02-18 08:58:48','2022-02-18 08:58:48','538 207 34 96 , Mutlu Firsat 21 GB, Kontor + 50 TL'),(24,75,71,1,75,4,1,1,1,'2022-02-18 08:58:48','2022-02-18 08:58:48','538 778 14 29, Net 12 GB pos, kontor'),(25,50,39,1,50,11,1,1,1,'2022-02-18 08:58:48','2022-02-18 08:58:48','	552 830 91 95, BAL 2GB	'),(26,25,11,1,25,14,1,1002,1,'2022-02-18 08:58:48','2022-02-18 08:58:48','Description'),(27,1240,1232,1,1240,8,1,1,1,'2022-02-18 08:58:48','2022-02-18 08:58:48','Fatura ID: 91'),(28,15,7,1,15,8,1,1126,1,'2022-02-18 08:58:48','2022-02-18 08:58:48','Description'),(29,330,320,1,330,10,1,1,1,'2022-02-18 08:58:48','2022-02-18 08:58:48','538 422 61 85,  Mutlu Mega 70GB✅✅'),(30,10,5,1,10,5,1,1,1,'2022-02-18 08:58:48','2022-02-18 08:58:48','Old debt abu gamal 15  whatsapp number'),(31,50,0,1,50,50,1,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03','Helping With getting money'),(32,15,0,1,15,15,1,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03','reparing headphone'),(33,45,26,1,45,19,1,1130,1,'2022-02-20 14:07:03','2022-02-20 14:07:03','Description'),(34,80,71,2,160,18,1,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03','likee 240 di'),(35,50,40,1,50,10,1,1,1,'2022-02-19 14:07:03','2022-02-19 14:07:03','Replace new Sim'),(36,65,62,1,65,3,1,1,1,'2022-02-19 14:07:03','2022-02-19 14:07:03','5356596426 Mutlu 7 GB✅✅'),(37,190,148,1,190,42,1,1090,1,'2022-02-20 15:40:36','2022-02-20 15:40:36','Description'),(38,65,54,1,65,11,1,1,1,'2022-02-20 15:40:36','2022-02-20 15:40:36','Selfy Sosyal X Large	\n\n5528651214'),(39,85,77,1,85,8,1,1,1,'2022-02-20 15:40:36','2022-02-20 15:40:36','Mutlu Firsat 12 GB	 \n 5312678253 + 14 TL'),(40,190,156,1,190,34,1,1019,1,'2022-02-21 08:06:41','2022-02-21 08:06:41','Description'),(41,190,156,1,190,34,1,1019,1,'2022-02-21 08:06:41','2022-02-21 08:06:41','Description'),(42,140,108,1,140,32,1,1088,1,'2022-02-22 15:19:56','2022-02-22 15:19:56','Description'),(44,80,71,1,80,9,1,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56','GNC NET 16GB pos\n5395924470'),(45,240,234,1,240,6,1,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56','Fatur Koski / 245778\n1- 87,00₺\nVADE\n02/03/2022\n2- 81,84₺\nVADE\n31/01/2022\n3- 65,68₺\nVADE\n28/12/2021'),(46,5,0,1,5,5,1,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56','HES Kodu'),(47,25,13,1,25,12,1,1053,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(48,15,12,1,15,3,1,1113,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(49,16,14,1,16,2,1,1125,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(50,30,23,1,30,7,1,1014,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(51,11,9,4,44,8,1,1001,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(52,15,11,2,30,8,1,1054,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(53,15,13,2,30,4,1,1053,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(54,45,37,1,45,8,1,1040,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(55,8,7,2,16,2,1,1126,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(56,140,124,2,280,32,1,1095,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(57,100,88,1,100,12,1,1152,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(58,100,81,1,100,19,1,1151,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(59,100,88,1,100,12,1,1131,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(60,25,20,2,50,10,1,1141,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(61,10,0,1,10,10,1,1,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Router Reparement\n'),(62,65,57,1,65,8,1,1,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','GNC Mutlu 8 GB\n5386517081'),(63,150,138,1,150,12,1,1139,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(64,10,0,1,10,10,1,1,1,'2022-02-24 09:11:52','2022-02-24 09:12:14','Create Google Account'),(65,15,4,1,15,11,1,1,1,'2022-03-01 08:06:32','2022-03-01 08:06:54','A10 Screen'),(66,65,56,1,65,9,1,1,1,'2022-03-01 08:05:30','2022-03-01 08:05:58','kontor 	Mutlu Firsat 9 GB	Ahmad omer	5314522287'),(67,55,51,1,55,4,1,1,1,'2022-02-28 12:48:39','2022-02-28 12:49:08','Kontor 	50 TL	Ahmad omer	5422688879'),(68,8,8,2,16,0,1,1161,1,'2022-02-28 07:46:28','2022-02-28 07:46:41','Description'),(69,15,15,2,30,0,1,1160,1,'2022-02-28 07:44:16','2022-02-28 07:44:30','Description'),(70,15,5,1,15,10,1,1049,1,'2022-02-28 07:16:47','2022-02-28 07:16:53','Description'),(71,15,5,1,15,10,1,1070,1,'2022-02-28 07:13:53','2022-02-28 07:14:17','Date is between 24/02 and 27/02\n'),(72,20,12,5,100,40,1,1,1,'2022-02-28 06:54:34','2022-02-28 07:00:57','84341	LİKEE 36 ELMAS	5353402539\n0537672639w'),(73,50,42,1,50,8,1,1,1,'2022-02-28 06:54:33','2022-02-28 06:55:44','Kontor	Super 10GB	Ahmad omer	5396719604'),(74,40,34,1,40,6,1,1,1,'2022-02-28 06:54:31','2022-02-28 06:54:59','Kontor Ahlan Yeni 4 GB Indirimsiz Paketi	Ahmad omer	5550889973'),(75,100,91,1,100,9,1,1,1,'2022-03-01 14:43:42','2022-03-01 14:44:03','Kontor 	Net 21 GB pos ✅✅	Ahmad omer	5392374965'),(76,15,6,1,15,9,1,1004,1,'2022-03-01 13:35:01','2022-03-01 13:35:08','Description'),(77,70,61,1,70,9,1,1,1,'2022-03-01 13:33:12','2022-03-01 13:34:46','kontor Net 8 GB pos ✅✅	Ahmad omer	5376133364'),(78,60,51,1,60,9,1,1,1,'2022-03-01 13:33:13','2022-03-01 13:34:24','kontor	50 TL	Ahmad omer	5392374965'),(79,60,48,1,60,12,1,1,1,'2022-03-01 13:33:11','2022-03-01 13:33:55','kontor 	RAKIPSIZ 12GB.	Ahmad omer	5013775390	48,00'),(80,0,0,1,0,0,1,1,1,'2022-03-01 13:33:11','2022-03-01 13:33:11','Description'),(81,20,11,1,20,9,1,1,1,'2022-03-01 11:11:17','2022-03-01 11:11:45','	84776	LİKEE 36 ELMAS	5353402539\n0537672639w'),(82,440,435,1,440,5,1,1,1,'2022-03-01 09:52:16','2022-03-01 09:52:53','Enerya 030001087231'),(83,70,61,1,70,9,1,1,1,'2022-03-01 09:38:25','2022-03-01 09:39:08','Kontor Mutlu Firsat 12 GB	Ahmad omer	5378794450'),(84,55,51,1,55,4,1,1,1,'2022-03-01 09:38:15','2022-03-01 09:38:46','Kontor 	50 TL	Ahmad omer	5378794450'),(85,10,4,1,10,6,1,1,1,'2022-03-02 14:23:47','2022-03-02 14:26:07','Note 9 Pro'),(86,70,60,1,70,10,1,1,1,'2022-03-02 14:23:48','2022-03-02 14:25:26','kontor 	Mutlu Firsat 12 GB	عمر كرمان++شمس	5352959369'),(87,70,60,1,70,10,1,1,1,'2022-03-02 14:23:49','2022-03-02 14:24:53','kontor	Mutlu Firsat 12 GB	عمر كرمان++شمس	5398300514'),(88,75,65,1,75,10,1,1,1,'2022-03-02 14:23:46','2022-03-02 14:24:26','kontor GNC Mutlu 12 GB	عمر كرمان++شمس	5393197957'),(89,60,50,1,60,10,1,1,1,'2022-03-04 14:33:56','2022-03-04 14:34:24','Kontor NC Mutlu 5 GB	عمر كرمان++شمس	5367918805'),(90,60,55,1,60,5,1,1,1,'2022-03-04 12:51:23','2022-03-04 12:53:01','kontor 	GNC Mutlu 8 GB	عمر كرمان++شمس	5377490740'),(91,85,73,1,85,12,1,1,1,'2022-03-04 12:51:28','2022-03-04 12:52:02','kontor \n85549	LİKEE 240 ELMAS	5353402539\n340944185'),(92,45,27,1,45,18,1,1045,1,'2022-03-04 12:19:31','2022-03-04 12:19:39','Description'),(93,35,13,1,35,22,1,1052,1,'2022-03-04 11:49:50','2022-03-04 11:49:56','Description'),(94,40,25,1,40,15,1,1119,1,'2022-03-04 11:09:02','2022-03-04 11:09:07','Description'),(95,3,0,1,3,3,1,1,1,'2022-03-04 08:34:49','2022-03-04 08:35:08','Fatura Elektrik / 1037079'),(96,20,5,1,20,15,1,1121,1,'2022-03-03 14:03:08','2022-03-03 14:03:23','Description'),(97,30,11,1,30,19,1,1129,1,'2022-03-03 13:00:47','2022-03-03 13:00:47','Description'),(98,10,4,1,10,6,1,1156,1,'2022-03-06 15:09:55','2022-03-06 15:09:55','Description'),(99,15,5,1,15,10,1,1049,1,'2022-03-06 15:08:57','2022-03-06 15:09:02','Description'),(100,55,50,1,55,5,1,1,1,'2022-03-06 14:24:11','2022-03-06 14:25:03','kontor 50 TL	Ahmad omer	5346645007'),(101,70,60,1,70,10,1,1,1,'2022-03-06 14:24:05','2022-03-06 14:24:33','kontor 	Mutlu Firsat 12 GB	عمر كرمان++شمس	5346645007'),(103,50,46,1,50,4,1,1,1,'2022-03-06 14:18:43','2022-03-06 14:21:13','Kontor Ahlan Yeni 8 GB Indirimsiz Paketi	عمر كرمان++شمس	5528953988'),(104,50,46,1,50,4,1,1,1,'2022-03-06 14:18:45','2022-03-06 14:20:51','kontor Ahlan Yeni 8 GB Indirimsiz Paketi	عمر كرمان++شمس	5364634620'),(105,70,60,1,70,10,1,1,1,'2022-03-06 14:18:47','2022-03-06 14:20:21','Kontor ALO DUNYA 1 SAAT	عمر كرمان++شمس	5350311124	60,00'),(106,65,56,1,65,9,1,1,1,'2022-03-06 14:18:48','2022-03-06 14:19:55','Kontor FIRSAT YENİ 8GB	عمر كرمان++شمس	5399831042'),(107,70,60,1,70,10,1,1,1,'2022-03-06 14:18:49','2022-03-06 14:19:32','Kontor Mutlu 7 GB	عمر كرمان++شمس	5380857995'),(108,55,45,1,55,10,1,1,1,'2022-03-06 10:05:07','2022-03-06 10:05:29','kontor KOLAY PAKET 5 GB 500DK 250sms	عمر كرمان++شمس	5441440439'),(109,20,9,1,20,11,1,1,1,'2022-03-06 07:52:15','2022-03-06 07:52:50','Kapak note 9 '),(110,60,50,1,60,10,1,1,1,'2022-03-06 06:30:04','2022-03-06 06:31:07','Kontor	Mutlu 7 GB	TURKCELL	5350311124'),(111,70,60,1,70,10,1,1,1,'2022-03-06 06:30:02','2022-03-06 06:30:33','Kontor 	Mutlu Firsat 12 GB	عمر كرمان++شمس	5350311124'),(112,160,145,1,160,15,1,1138,1,'2022-03-06 05:46:30','2022-03-06 05:47:53','Toptan'),(113,158,150,1,158,8,1,1158,1,'2022-03-06 05:46:43','2022-03-06 05:47:46','Toptan'),(114,145,138,1,145,7,1,1135,1,'2022-03-06 05:46:38','2022-03-06 05:47:36','Toptan'),(115,142,135,1,142,7,1,1094,1,'2022-03-06 05:44:44','2022-03-06 05:46:23','Toptan'),(116,60,53,1,60,7,1,1,1,'2022-03-06 05:39:25','2022-03-06 05:39:48','kontor Süper 15GB	Ahmad omer	5528204767'),(117,100,98,1,100,2,1,1073,1,'2022-03-05 10:22:33','2022-03-05 10:22:33','Description'),(118,15,4,1,15,11,1,1,1,'2022-03-07 13:02:24','2022-03-07 13:02:53','Note 9s screen'),(119,65,60,1,65,5,1,1,1,'2022-03-07 09:02:51','2022-03-07 09:03:25','Kontor 	Mutlu Firsat 12 GB	عمر كرمان++شمس	5312351353\n'),(120,3,0,1,3,3,1,1,1,'2022-03-07 06:52:46','2022-03-07 06:53:04','Fatura Elektrik / 1037079'),(121,70,60,1,70,10,1,1,1,'2022-03-08 13:08:05','2022-03-08 13:08:25','Kontor 	Mutlu Firsat 12 GB	عمر كرمان++شمس	5358192000'),(122,100,100,1,100,0,1,1089,1,'2022-03-08 13:07:06','2022-03-08 13:07:06','Description'),(123,130,117,1,130,13,1,1137,1,'2022-03-08 13:06:50','2022-03-08 13:06:54','Description'),(124,170,158,1,170,12,1,1091,1,'2022-03-08 13:06:36','2022-03-08 13:06:44','Description'),(125,100,81,1,100,19,1,1151,1,'2022-03-08 13:06:22','2022-03-08 13:06:27','Description'),(126,75,70,1,75,5,1,1128,1,'2022-03-08 13:06:05','2022-03-08 13:06:12','Description'),(127,125,70,1,125,55,1,1128,1,'2022-03-08 10:32:34','2022-03-08 10:32:34','Description'),(128,65,61,1,65,4,1,1,1,'2022-03-08 10:31:29','2022-03-08 10:32:15','Kontor Mutlu Firsat 12 GB	Ahmad omer	5395660635'),(129,75,65,1,75,10,1,1,1,'2022-03-08 10:31:31','2022-03-08 10:31:50','Kontor 	Mutlu Firsat 13 GB	عمر كرمان++شمس	5365456132');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_counters`
--

DROP TABLE IF EXISTS `sales_counters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_counters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `counter` int(11) NOT NULL DEFAULT 1,
  `product_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_counters_product_id_foreign` (`product_id`),
  CONSTRAINT `sales_counters_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_counters`
--

LOCK TABLES `sales_counters` WRITE;
/*!40000 ALTER TABLE `sales_counters` DISABLE KEYS */;
INSERT INTO `sales_counters` VALUES (19,2,1091,'2022-02-16 08:28:13','2022-03-09 07:02:39'),(20,6,1001,'2022-02-16 08:35:25','2022-02-24 06:20:47'),(21,1,1080,'2022-02-16 08:35:25','2022-02-16 08:35:25'),(22,2,1090,'2022-02-16 08:35:25','2022-02-20 15:40:36'),(23,1,1037,'2022-02-16 08:35:26','2022-02-16 08:35:26'),(24,1,1010,'2022-02-16 08:35:26','2022-02-16 08:35:26'),(25,97,1,'2022-02-16 08:41:58','2022-03-09 07:02:39'),(26,1,1104,'2022-02-17 10:31:37','2022-02-17 10:31:37'),(27,1,1060,'2022-02-17 10:31:38','2022-02-17 10:31:38'),(28,1,1002,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(29,4,1126,'2022-02-20 08:58:48','2022-02-24 06:20:47'),(30,1,1130,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(31,2,1019,'2022-02-22 08:06:41','2022-02-22 08:06:41'),(32,1,1088,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(33,3,1053,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(34,1,1113,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(35,1,1125,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(36,1,1014,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(37,2,1054,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(38,1,1040,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(39,2,1095,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(40,1,1152,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(41,2,1151,'2022-02-24 06:20:47','2022-03-09 07:02:39'),(42,1,1131,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(43,2,1141,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(44,1,1139,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(45,2,1161,'2022-03-01 08:07:03','2022-03-01 08:07:03'),(46,2,1160,'2022-03-01 08:07:03','2022-03-01 08:07:03'),(47,2,1049,'2022-03-01 08:07:03','2022-03-06 15:10:18'),(48,1,1070,'2022-03-01 08:07:03','2022-03-01 08:07:03'),(49,1,1004,'2022-03-02 07:50:18','2022-03-02 07:50:18'),(50,1,1045,'2022-03-05 10:22:17','2022-03-05 10:22:17'),(51,1,1052,'2022-03-05 10:22:17','2022-03-05 10:22:17'),(52,1,1119,'2022-03-05 10:22:17','2022-03-05 10:22:17'),(53,1,1121,'2022-03-05 10:22:17','2022-03-05 10:22:17'),(54,1,1129,'2022-03-05 10:22:17','2022-03-05 10:22:17'),(55,1,1156,'2022-03-06 15:10:18','2022-03-06 15:10:18'),(56,1,1138,'2022-03-06 15:10:19','2022-03-06 15:10:19'),(57,1,1158,'2022-03-06 15:10:19','2022-03-06 15:10:19'),(58,1,1135,'2022-03-06 15:10:19','2022-03-06 15:10:19'),(59,1,1094,'2022-03-06 15:10:19','2022-03-06 15:10:19'),(60,1,1073,'2022-03-06 15:10:19','2022-03-06 15:10:19'),(61,1,1089,'2022-03-09 07:02:39','2022-03-09 07:02:39'),(62,1,1137,'2022-03-09 07:02:39','2022-03-09 07:02:39'),(63,2,1128,'2022-03-09 07:02:39','2022-03-09 07:02:39');
/*!40000 ALTER TABLE `sales_counters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sellers`
--

DROP TABLE IF EXISTS `sellers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sellers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sellers`
--

LOCK TABLES `sellers` WRITE;
/*!40000 ALTER TABLE `sellers` DISABLE KEYS */;
INSERT INTO `sellers` VALUES (1,'Default','00','-',NULL,NULL),(2,'El-Khatib','5376014222','Semsitebrizi Mahallesi, Hatuniye Sk. No:9, 42030 Karatay/Konya',NULL,NULL),(3,'Simex','03323526707','Semsitebrizi Mahallesi, Akif Pasa Sk., 42030 Karatay/Konya',NULL,NULL),(4,'Soffany','5327272788','Tahtakale Mahallesi, Findikcilar Sk Pirhan, No:13, 34116 Fatih/Istanbul',NULL,NULL),(5,'Kensa','5323412272','Demirtas Mh, Cemil Birsel Cd. No:13/A. Fatih Istanbul','2021-11-26 14:07:23','2021-11-26 14:07:23');
/*!40000 ALTER TABLE `sellers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('JPJxGYxfTGH8SR7WBvZXs390L2DFcKteaUMez1Tb',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiMVVhaTcyeHNEWGVRdkpyaFd6WFBydXNGbVUyNHA3VlA5aVBCMHdXbyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI1OiJodHRwOi8vYm9iay50ZXN0L3Byb2R1Y3RzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJFFwWEVYLlFVNHZOT0ZJZDZCZVNXSy5PczNIakJjbUk4cmlVU0QxdjkxcGdOUVNFOXJvR3FTIjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRRcFhFWC5RVTR2Tk9GSWQ2QmVTV0suT3MzSGpCY21JOHJpVVNEMXY5MXBnTlFTRTlyb0dxUyI7fQ==',1646821057);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_invitations`
--

DROP TABLE IF EXISTS `team_invitations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_invitations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint(20) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `team_invitations_team_id_email_unique` (`team_id`,`email`),
  CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_invitations`
--

LOCK TABLES `team_invitations` WRITE;
/*!40000 ALTER TABLE `team_invitations` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_invitations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_user`
--

DROP TABLE IF EXISTS `team_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_user`
--

LOCK TABLES `team_user` WRITE;
/*!40000 ALTER TABLE `team_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teams_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin',1,'admin@gmail.com',NULL,'2021-11-26 12:53:56','$2y$10$QpXEX.QU4vNOFId6BeSWK.Os3HjBcmI8riUSD1v91pgNQSE9roGqS',NULL,NULL,NULL,NULL,NULL,'2021-11-26 12:53:56','2021-11-26 12:53:56'),(2,'User01',0,'user01@gmail.com',NULL,'2021-11-26 12:53:56','$2y$10$duYKDT13Ie9Gs3hgxaN5I.QZp8GCxMCcJCcmTdsk/F3PNm5pjnmy2',NULL,NULL,NULL,NULL,NULL,'2021-11-26 12:53:56','2021-11-26 12:53:56');
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

-- Dump completed on 2022-03-09 13:17:59
