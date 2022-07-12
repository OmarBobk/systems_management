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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bills`
--

LOCK TABLES `bills` WRITE;
/*!40000 ALTER TABLE `bills` DISABLE KEYS */;
INSERT INTO `bills` VALUES (1,'default',0,'default',1,1001,1,1,'2021-10-17 21:00:00','2021-10-17 21:00:00'),(10,'goods',1344,'1360.5 TL',169,10011001,6,1,'2022-03-22 07:00:31','2022-03-26 06:19:50'),(11,'goods',5677,'381.8 *  14.81 = 5654',105,10111011,5,1,'2022-03-24 07:47:01','2022-03-26 13:43:50'),(12,'goods',288,'288 TL',41,10121012,6,1,'2022-03-26 09:22:00','2022-03-26 09:22:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Default','Default',1,NULL,NULL),(2,'Syrox','Headphones Bluetooth Headphones, Cables, Chargers, Screens, Airpods',2,NULL,NULL),(3,'Mabko','Cables, Headphones, Bluetooth Headphones, Screens, Airpods, Chargers',2,NULL,NULL),(4,'Joinlink','Cables, Chargers',2,NULL,NULL),(5,'Veno','Bluetooth Headphones, iPhone\'s Headphones',2,NULL,NULL),(6,'Other','Other',1,NULL,NULL),(7,'Jopus','Screens, General Accessories',3,NULL,NULL),(8,'Simex','Screens, General Accessories',3,NULL,NULL),(9,'Mytell','Screens, General Accessories',3,NULL,NULL),(10,'Soffany','Chargers, Cables, Covers, Screens, General Accessories',4,NULL,NULL),(11,'Platoon','Screens, General Accessories',2,NULL,NULL),(12,'Other','Other',3,NULL,NULL),(13,'Other','Other',3,NULL,NULL),(21,'Jopus','Screens, General Accessories',2,NULL,NULL),(22,'Kensa','Telefon Aksesuarlari',5,'2021-11-26 14:12:22','2021-11-26 14:12:22'),(23,'Kensa','Headphones Bluetooth Headphones, Cables, Chargers, Screens, Airpods',2,'2021-12-01 10:11:49','2021-12-01 10:11:49'),(24,'TGB','None',6,'2022-03-22 06:53:12','2022-03-22 06:53:12'),(25,'Other','None',6,'2022-03-22 06:56:05','2022-03-22 06:56:05');
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
) ENGINE=InnoDB AUTO_INCREMENT=329 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
INSERT INTO `contributions` VALUES (1,-7860,'This is the description','2021-10-13','2022-10-13',100,0,NULL,1,'2021-10-12 21:00:00','2022-03-26 09:22:00'),(2,5000,'This is the description','2021-10-13','2022-10-13',20,0,'2021-12-03',2,'2021-10-12 21:00:00','2021-12-04 09:43:23');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (8,'shopping','This Expense has been created Automatically After the new Bill.\n            ',1337,1,10,1,'2022-03-22 07:00:31','2022-03-22 07:00:31'),(9,'shopping','This Expense has been created Automatically After the new Bill.\n            ',5655,1,11,1,'2022-03-24 07:47:01','2022-03-24 07:47:01'),(10,'shopping','This Expense has been created Automatically After the new Bill.\n            ',288,1,12,1,'2022-03-26 09:22:00','2022-03-26 09:22:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=567 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incomes`
--

LOCK TABLES `incomes` WRITE;
/*!40000 ALTER TABLE `incomes` DISABLE KEYS */;
INSERT INTO `incomes` VALUES (55,'cost',155,2,1,1,'2022-02-16 08:28:13','2022-02-16 08:28:13'),(56,'profit',35,2,1,1,'2022-02-16 08:28:13','2022-02-16 08:28:13'),(57,'cost',18,3,1,1,'2022-02-16 08:35:25','2022-02-16 08:35:25'),(58,'profit',22,3,1,1,'2022-02-16 08:35:25','2022-02-16 08:35:25'),(59,'cost',25,4,1,1,'2022-02-16 08:35:25','2022-02-16 08:35:25'),(60,'profit',25,4,1,1,'2022-02-16 08:35:25','2022-02-16 08:35:25'),(61,'cost',148,5,1,1,'2022-02-16 08:35:25','2022-02-16 08:35:25'),(62,'profit',62,5,1,1,'2022-02-16 08:35:25','2022-02-16 08:35:25'),(63,'cost',13,6,1,1,'2022-02-16 08:35:26','2022-02-16 08:35:26'),(64,'profit',17,6,1,1,'2022-02-16 08:35:26','2022-02-16 08:35:26'),(65,'cost',48,7,1,1,'2022-02-16 08:35:26','2022-02-16 08:35:26'),(66,'profit',27,7,1,1,'2022-02-16 08:35:26','2022-02-16 08:35:26'),(67,'cost',0,8,1,1,'2022-02-16 08:41:57','2022-02-16 08:41:57'),(68,'profit',47,8,1,1,'2022-02-16 08:41:57','2022-02-16 08:41:57'),(69,'cost',0,9,1,1,'2022-02-16 08:41:58','2022-02-16 08:41:58'),(70,'profit',47,9,1,1,'2022-02-16 08:41:58','2022-02-16 08:41:58'),(77,'cost',0,13,1,1,'2022-02-17 10:31:37','2022-02-17 10:31:37'),(78,'profit',4,13,1,1,'2022-02-17 10:31:37','2022-02-17 10:31:37'),(79,'cost',6,14,1,1,'2022-02-17 10:31:37','2022-02-17 10:31:37'),(80,'profit',9,14,1,1,'2022-02-17 10:31:37','2022-02-17 10:31:37'),(81,'cost',10,15,1,1,'2022-02-17 10:31:38','2022-02-17 10:31:38'),(82,'profit',10,15,1,1,'2022-02-17 10:31:38','2022-02-17 10:31:38'),(83,'cost',0,16,1,1,'2022-02-17 11:12:32','2022-02-17 11:12:32'),(84,'profit',40,16,1,1,'2022-02-17 11:12:32','2022-02-17 11:12:32'),(85,'cost',0,17,1,1,'2022-02-17 11:18:37','2022-02-17 11:18:37'),(86,'profit',10,17,1,1,'2022-02-17 11:18:37','2022-02-17 11:18:37'),(91,'cost',52,20,1,1,'2022-02-17 15:31:54','2022-02-17 15:31:54'),(92,'profit',3,20,1,1,'2022-02-17 15:31:54','2022-02-17 15:31:54'),(93,'cost',2,21,1,1,'2022-02-18 06:37:14','2022-02-18 06:37:14'),(94,'profit',8,21,1,1,'2022-02-18 06:37:14','2022-02-18 06:37:14'),(95,'cost',2,22,1,1,'2022-02-18 06:37:14','2022-02-18 06:37:14'),(96,'profit',8,22,1,1,'2022-02-18 06:37:14','2022-02-18 06:37:14'),(97,'cost',135,23,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(98,'profit',5,23,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(99,'cost',71,24,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(100,'profit',4,24,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(101,'cost',39,25,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(102,'profit',11,25,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(103,'cost',11,26,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(104,'profit',14,26,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(105,'cost',1232,27,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(106,'profit',8,27,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(107,'cost',7,28,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(108,'profit',8,28,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(109,'cost',320,29,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(110,'profit',10,29,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(111,'cost',5,30,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(112,'profit',5,30,1,1,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(113,'cost',0,31,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(114,'profit',50,31,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(115,'cost',0,32,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(116,'profit',15,32,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(117,'cost',26,33,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(118,'profit',19,33,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(119,'cost',142,34,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(120,'profit',18,34,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(121,'cost',40,35,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(122,'profit',10,35,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(123,'cost',62,36,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(124,'profit',3,36,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03'),(125,'cost',148,37,1,1,'2022-02-20 15:40:36','2022-02-20 15:40:36'),(126,'profit',42,37,1,1,'2022-02-20 15:40:36','2022-02-20 15:40:36'),(127,'cost',54,38,1,1,'2022-02-20 15:40:36','2022-02-20 15:40:36'),(128,'profit',11,38,1,1,'2022-02-20 15:40:36','2022-02-20 15:40:36'),(129,'cost',77,39,1,1,'2022-02-20 15:40:36','2022-02-20 15:40:36'),(130,'profit',8,39,1,1,'2022-02-20 15:40:36','2022-02-20 15:40:36'),(131,'cost',156,40,1,1,'2022-02-22 08:06:41','2022-02-22 08:06:41'),(132,'profit',34,40,1,1,'2022-02-22 08:06:41','2022-02-22 08:06:41'),(133,'cost',156,41,1,1,'2022-02-22 08:06:41','2022-02-22 08:06:41'),(134,'profit',34,41,1,1,'2022-02-22 08:06:41','2022-02-22 08:06:41'),(135,'cost',108,42,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(136,'profit',32,42,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(139,'cost',71,44,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(140,'profit',9,44,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(141,'cost',234,45,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(142,'profit',6,45,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(143,'cost',0,46,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(144,'profit',5,46,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(145,'cost',13,47,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(146,'profit',12,47,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(147,'cost',12,48,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(148,'profit',3,48,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(149,'cost',14,49,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(150,'profit',2,49,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(151,'cost',23,50,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(152,'profit',7,50,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(153,'cost',36,51,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(154,'profit',8,51,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(155,'cost',22,52,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(156,'profit',8,52,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(157,'cost',26,53,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(158,'profit',4,53,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(159,'cost',37,54,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(160,'profit',8,54,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(161,'cost',14,55,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(162,'profit',2,55,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(163,'cost',248,56,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(164,'profit',32,56,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(165,'cost',88,57,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(166,'profit',12,57,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(167,'cost',81,58,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(168,'profit',19,58,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(169,'cost',88,59,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(170,'profit',12,59,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(171,'cost',40,60,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(172,'profit',10,60,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(173,'cost',0,61,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(174,'profit',10,61,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(175,'cost',57,62,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(176,'profit',8,62,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(177,'cost',138,63,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(178,'profit',12,63,1,1,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(183,'cost',0,64,1,1,'2022-02-24 09:11:52','2022-02-24 09:12:14'),(184,'profit',10,64,1,1,'2022-02-24 09:11:52','2022-02-24 09:12:14'),(185,'cost',4,65,1,1,'2022-03-01 08:06:32','2022-03-01 08:06:54'),(186,'profit',11,65,1,1,'2022-03-01 08:06:32','2022-03-01 08:06:54'),(187,'cost',56,66,1,1,'2022-03-01 08:05:30','2022-03-01 08:05:58'),(188,'profit',9,66,1,1,'2022-03-01 08:05:30','2022-03-01 08:05:58'),(189,'cost',51,67,1,1,'2022-02-28 12:48:39','2022-02-28 12:49:08'),(190,'profit',4,67,1,1,'2022-02-28 12:48:39','2022-02-28 12:49:08'),(191,'cost',16,68,1,1,'2022-02-28 07:46:28','2022-02-28 07:46:41'),(192,'profit',0,68,1,1,'2022-02-28 07:46:28','2022-02-28 07:46:41'),(193,'cost',30,69,1,1,'2022-02-28 07:44:16','2022-02-28 07:44:30'),(194,'profit',0,69,1,1,'2022-02-28 07:44:16','2022-02-28 07:44:30'),(195,'cost',5,70,1,1,'2022-02-28 07:16:47','2022-02-28 07:16:53'),(196,'profit',10,70,1,1,'2022-02-28 07:16:47','2022-02-28 07:16:53'),(197,'cost',5,71,1,1,'2022-02-28 07:13:53','2022-02-28 07:14:17'),(198,'profit',10,71,1,1,'2022-02-28 07:13:53','2022-02-28 07:14:17'),(199,'cost',60,72,1,1,'2022-02-28 06:54:34','2022-02-28 07:00:57'),(200,'profit',40,72,1,1,'2022-02-28 06:54:34','2022-02-28 07:00:57'),(201,'cost',42,73,1,1,'2022-02-28 06:54:33','2022-02-28 06:55:44'),(202,'profit',8,73,1,1,'2022-02-28 06:54:33','2022-02-28 06:55:44'),(203,'cost',34,74,1,1,'2022-02-28 06:54:31','2022-02-28 06:54:59'),(204,'profit',6,74,1,1,'2022-02-28 06:54:31','2022-02-28 06:54:59'),(205,'cost',91,75,1,1,'2022-03-01 14:43:42','2022-03-01 14:44:03'),(206,'profit',9,75,1,1,'2022-03-01 14:43:42','2022-03-01 14:44:03'),(207,'cost',6,76,1,1,'2022-03-01 13:35:01','2022-03-01 13:35:08'),(208,'profit',9,76,1,1,'2022-03-01 13:35:01','2022-03-01 13:35:08'),(209,'cost',61,77,1,1,'2022-03-01 13:33:12','2022-03-01 13:34:46'),(210,'profit',9,77,1,1,'2022-03-01 13:33:12','2022-03-01 13:34:46'),(211,'cost',51,78,1,1,'2022-03-01 13:33:13','2022-03-01 13:34:24'),(212,'profit',9,78,1,1,'2022-03-01 13:33:13','2022-03-01 13:34:24'),(213,'cost',48,79,1,1,'2022-03-01 13:33:11','2022-03-01 13:33:55'),(214,'profit',12,79,1,1,'2022-03-01 13:33:11','2022-03-01 13:33:55'),(215,'cost',0,80,1,1,'2022-03-01 13:33:11','2022-03-01 13:33:11'),(216,'profit',0,80,1,1,'2022-03-01 13:33:11','2022-03-01 13:33:11'),(217,'cost',11,81,1,1,'2022-03-01 11:11:17','2022-03-01 11:11:45'),(218,'profit',9,81,1,1,'2022-03-01 11:11:17','2022-03-01 11:11:45'),(219,'cost',435,82,1,1,'2022-03-01 09:52:16','2022-03-01 09:52:53'),(220,'profit',5,82,1,1,'2022-03-01 09:52:16','2022-03-01 09:52:53'),(221,'cost',61,83,1,1,'2022-03-01 09:38:25','2022-03-01 09:39:08'),(222,'profit',9,83,1,1,'2022-03-01 09:38:25','2022-03-01 09:39:08'),(223,'cost',51,84,1,1,'2022-03-01 09:38:15','2022-03-01 09:38:46'),(224,'profit',4,84,1,1,'2022-03-01 09:38:15','2022-03-01 09:38:46'),(225,'cost',4,85,1,1,'2022-03-02 14:23:47','2022-03-02 14:26:07'),(226,'profit',6,85,1,1,'2022-03-02 14:23:47','2022-03-02 14:26:07'),(227,'cost',60,86,1,1,'2022-03-02 14:23:48','2022-03-02 14:25:26'),(228,'profit',10,86,1,1,'2022-03-02 14:23:48','2022-03-02 14:25:26'),(229,'cost',60,87,1,1,'2022-03-02 14:23:49','2022-03-02 14:24:53'),(230,'profit',10,87,1,1,'2022-03-02 14:23:49','2022-03-02 14:24:53'),(231,'cost',65,88,1,1,'2022-03-02 14:23:46','2022-03-02 14:24:26'),(232,'profit',10,88,1,1,'2022-03-02 14:23:46','2022-03-02 14:24:26'),(233,'cost',50,89,1,1,'2022-03-04 14:33:56','2022-03-04 14:34:24'),(234,'profit',10,89,1,1,'2022-03-04 14:33:56','2022-03-04 14:34:24'),(235,'cost',55,90,1,1,'2022-03-04 12:51:23','2022-03-04 12:53:01'),(236,'profit',5,90,1,1,'2022-03-04 12:51:23','2022-03-04 12:53:01'),(237,'cost',73,91,1,1,'2022-03-04 12:51:28','2022-03-04 12:52:02'),(238,'profit',12,91,1,1,'2022-03-04 12:51:28','2022-03-04 12:52:02'),(239,'cost',27,92,1,1,'2022-03-04 12:19:31','2022-03-04 12:19:39'),(240,'profit',18,92,1,1,'2022-03-04 12:19:31','2022-03-04 12:19:39'),(241,'cost',13,93,1,1,'2022-03-04 11:49:50','2022-03-04 11:49:56'),(242,'profit',22,93,1,1,'2022-03-04 11:49:50','2022-03-04 11:49:56'),(243,'cost',25,94,1,1,'2022-03-04 11:09:02','2022-03-04 11:09:07'),(244,'profit',15,94,1,1,'2022-03-04 11:09:02','2022-03-04 11:09:07'),(245,'cost',0,95,1,1,'2022-03-04 08:34:49','2022-03-04 08:35:08'),(246,'profit',3,95,1,1,'2022-03-04 08:34:49','2022-03-04 08:35:08'),(247,'cost',5,96,1,1,'2022-03-03 14:03:08','2022-03-03 14:03:23'),(248,'profit',15,96,1,1,'2022-03-03 14:03:08','2022-03-03 14:03:23'),(249,'cost',11,97,1,1,'2022-03-03 13:00:47','2022-03-03 13:00:47'),(250,'profit',19,97,1,1,'2022-03-03 13:00:47','2022-03-03 13:00:47'),(251,'cost',4,98,1,1,'2022-03-06 15:09:55','2022-03-06 15:09:55'),(252,'profit',6,98,1,1,'2022-03-06 15:09:55','2022-03-06 15:09:55'),(253,'cost',5,99,1,1,'2022-03-06 15:08:57','2022-03-06 15:09:02'),(254,'profit',10,99,1,1,'2022-03-06 15:08:57','2022-03-06 15:09:02'),(255,'cost',50,100,1,1,'2022-03-06 14:24:11','2022-03-06 14:25:03'),(256,'profit',5,100,1,1,'2022-03-06 14:24:11','2022-03-06 14:25:03'),(257,'cost',60,101,1,1,'2022-03-06 14:24:05','2022-03-06 14:24:33'),(258,'profit',10,101,1,1,'2022-03-06 14:24:05','2022-03-06 14:24:33'),(261,'cost',46,103,1,1,'2022-03-06 14:18:43','2022-03-06 14:21:13'),(262,'profit',4,103,1,1,'2022-03-06 14:18:43','2022-03-06 14:21:13'),(263,'cost',46,104,1,1,'2022-03-06 14:18:45','2022-03-06 14:20:51'),(264,'profit',4,104,1,1,'2022-03-06 14:18:45','2022-03-06 14:20:51'),(265,'cost',60,105,1,1,'2022-03-06 14:18:47','2022-03-06 14:20:21'),(266,'profit',10,105,1,1,'2022-03-06 14:18:47','2022-03-06 14:20:21'),(267,'cost',56,106,1,1,'2022-03-06 14:18:48','2022-03-06 14:19:55'),(268,'profit',9,106,1,1,'2022-03-06 14:18:48','2022-03-06 14:19:55'),(269,'cost',60,107,1,1,'2022-03-06 14:18:49','2022-03-06 14:19:32'),(270,'profit',10,107,1,1,'2022-03-06 14:18:49','2022-03-06 14:19:32'),(271,'cost',45,108,1,1,'2022-03-06 10:05:07','2022-03-06 10:05:29'),(272,'profit',10,108,1,1,'2022-03-06 10:05:07','2022-03-06 10:05:29'),(273,'cost',9,109,1,1,'2022-03-06 07:52:15','2022-03-06 07:52:50'),(274,'profit',11,109,1,1,'2022-03-06 07:52:15','2022-03-06 07:52:50'),(275,'cost',50,110,1,1,'2022-03-06 06:30:04','2022-03-06 06:31:07'),(276,'profit',10,110,1,1,'2022-03-06 06:30:04','2022-03-06 06:31:07'),(277,'cost',60,111,1,1,'2022-03-06 06:30:02','2022-03-06 06:30:33'),(278,'profit',10,111,1,1,'2022-03-06 06:30:02','2022-03-06 06:30:33'),(279,'cost',145,112,1,1,'2022-03-06 05:46:30','2022-03-06 05:47:53'),(280,'profit',15,112,1,1,'2022-03-06 05:46:30','2022-03-06 05:47:53'),(281,'cost',150,113,1,1,'2022-03-06 05:46:43','2022-03-06 05:47:46'),(282,'profit',8,113,1,1,'2022-03-06 05:46:43','2022-03-06 05:47:46'),(283,'cost',138,114,1,1,'2022-03-06 05:46:38','2022-03-06 05:47:36'),(284,'profit',7,114,1,1,'2022-03-06 05:46:38','2022-03-06 05:47:36'),(285,'cost',135,115,1,1,'2022-03-06 05:44:44','2022-03-06 05:46:23'),(286,'profit',7,115,1,1,'2022-03-06 05:44:44','2022-03-06 05:46:23'),(287,'cost',53,116,1,1,'2022-03-06 05:39:25','2022-03-06 05:39:48'),(288,'profit',7,116,1,1,'2022-03-06 05:39:25','2022-03-06 05:39:48'),(289,'cost',98,117,1,1,'2022-03-05 10:22:33','2022-03-05 10:22:33'),(290,'profit',2,117,1,1,'2022-03-05 10:22:33','2022-03-05 10:22:33'),(291,'cost',4,118,1,1,'2022-03-07 13:02:24','2022-03-07 13:02:53'),(292,'profit',11,118,1,1,'2022-03-07 13:02:24','2022-03-07 13:02:53'),(293,'cost',60,119,1,1,'2022-03-07 09:02:51','2022-03-07 09:03:25'),(294,'profit',5,119,1,1,'2022-03-07 09:02:51','2022-03-07 09:03:25'),(295,'cost',0,120,1,1,'2022-03-07 06:52:46','2022-03-07 06:53:04'),(296,'profit',3,120,1,1,'2022-03-07 06:52:46','2022-03-07 06:53:04'),(297,'cost',60,121,1,1,'2022-03-08 13:08:05','2022-03-08 13:08:25'),(298,'profit',10,121,1,1,'2022-03-08 13:08:05','2022-03-08 13:08:25'),(299,'cost',100,122,1,1,'2022-03-08 13:07:06','2022-03-08 13:07:06'),(300,'profit',0,122,1,1,'2022-03-08 13:07:06','2022-03-08 13:07:06'),(301,'cost',117,123,1,1,'2022-03-08 13:06:50','2022-03-08 13:06:54'),(302,'profit',13,123,1,1,'2022-03-08 13:06:50','2022-03-08 13:06:54'),(303,'cost',158,124,1,1,'2022-03-08 13:06:36','2022-03-08 13:06:44'),(304,'profit',12,124,1,1,'2022-03-08 13:06:36','2022-03-08 13:06:44'),(305,'cost',81,125,1,1,'2022-03-08 13:06:22','2022-03-08 13:06:27'),(306,'profit',19,125,1,1,'2022-03-08 13:06:22','2022-03-08 13:06:27'),(307,'cost',70,126,1,1,'2022-03-08 13:06:05','2022-03-08 13:06:12'),(308,'profit',5,126,1,1,'2022-03-08 13:06:05','2022-03-08 13:06:12'),(309,'cost',70,127,1,1,'2022-03-08 10:32:34','2022-03-08 10:32:34'),(310,'profit',55,127,1,1,'2022-03-08 10:32:34','2022-03-08 10:32:34'),(311,'cost',61,128,1,1,'2022-03-08 10:31:29','2022-03-08 10:32:15'),(312,'profit',4,128,1,1,'2022-03-08 10:31:29','2022-03-08 10:32:15'),(313,'cost',65,129,1,1,'2022-03-08 10:31:31','2022-03-08 10:31:50'),(314,'profit',10,129,1,1,'2022-03-08 10:31:31','2022-03-08 10:31:50'),(315,'cost',80,130,1,1,'2022-03-10 06:44:30','2022-03-10 06:44:54'),(316,'profit',5,130,1,1,'2022-03-10 06:44:30','2022-03-10 06:44:54'),(317,'cost',50,131,1,1,'2022-03-09 14:00:02','2022-03-09 14:00:17'),(318,'profit',10,131,1,1,'2022-03-09 14:00:02','2022-03-09 14:00:17'),(319,'cost',220,132,1,1,'2022-03-09 13:59:14','2022-03-09 13:59:36'),(320,'profit',15,132,1,1,'2022-03-09 13:59:14','2022-03-09 13:59:36'),(321,'cost',60,133,1,1,'2022-03-10 12:59:51','2022-03-10 13:00:57'),(322,'profit',10,133,1,1,'2022-03-10 12:59:51','2022-03-10 13:00:57'),(323,'cost',13,134,1,1,'2022-03-10 13:00:13','2022-03-10 13:00:17'),(324,'profit',12,134,1,1,'2022-03-10 13:00:13','2022-03-10 13:00:17'),(325,'cost',77,135,1,1,'2022-03-13 08:04:31','2022-03-13 08:05:02'),(326,'profit',8,135,1,1,'2022-03-13 08:04:31','2022-03-13 08:05:02'),(327,'cost',0,136,1,1,'2022-03-12 15:37:42','2022-03-12 15:37:58'),(328,'profit',9,136,1,1,'2022-03-12 15:37:42','2022-03-12 15:37:58'),(329,'cost',0,137,1,1,'2022-03-12 14:26:12','2022-03-12 14:26:58'),(330,'profit',20,137,1,1,'2022-03-12 14:26:12','2022-03-12 14:26:58'),(331,'cost',0,138,1,1,'2022-03-12 14:26:12','2022-03-12 14:26:27'),(332,'profit',9,138,1,1,'2022-03-12 14:26:12','2022-03-12 14:26:27'),(333,'cost',0,139,1,1,'2022-03-12 10:00:41','2022-03-12 14:26:07'),(334,'profit',6,139,1,1,'2022-03-12 10:00:41','2022-03-12 14:26:07'),(335,'cost',117,140,1,1,'2022-03-12 10:15:12','2022-03-12 10:15:19'),(336,'profit',68,140,1,1,'2022-03-12 10:15:12','2022-03-12 10:15:19'),(337,'cost',23,141,1,1,'2022-03-12 10:00:49','2022-03-12 10:00:55'),(338,'profit',27,141,1,1,'2022-03-12 10:00:49','2022-03-12 10:00:55'),(339,'cost',5,142,1,1,'2022-03-13 11:18:43','2022-03-13 11:19:05'),(340,'profit',15,142,1,1,'2022-03-13 11:18:43','2022-03-13 11:19:05'),(341,'cost',13,143,1,1,'2022-03-13 10:57:18','2022-03-13 10:57:25'),(342,'profit',17,143,1,1,'2022-03-13 10:57:18','2022-03-13 10:57:25'),(343,'cost',45,144,1,1,'2022-03-13 09:11:56','2022-03-13 09:13:32'),(344,'profit',15,144,1,1,'2022-03-13 09:11:56','2022-03-13 09:13:32'),(345,'cost',158,145,1,1,'2022-03-13 08:47:50','2022-03-13 09:11:28'),(346,'profit',12,145,1,1,'2022-03-13 08:47:50','2022-03-13 09:11:28'),(347,'cost',6,146,1,1,'2022-03-13 08:44:18','2022-03-13 09:11:22'),(348,'profit',14,146,1,1,'2022-03-13 08:44:18','2022-03-13 09:11:22'),(349,'cost',67,147,1,1,'2022-03-13 08:37:46','2022-03-13 09:11:16'),(350,'profit',83,147,1,1,'2022-03-13 08:37:46','2022-03-13 09:11:16'),(351,'cost',65,148,1,1,'2022-03-14 14:21:57','2022-03-14 14:22:13'),(352,'profit',10,148,1,1,'2022-03-14 14:21:57','2022-03-14 14:22:13'),(353,'cost',146,149,1,1,'2022-03-14 13:03:46','2022-03-14 13:04:38'),(354,'profit',9,149,1,1,'2022-03-14 13:03:46','2022-03-14 13:04:38'),(355,'cost',0,150,1,1,'2022-03-14 13:03:47','2022-03-14 13:04:03'),(356,'profit',10,150,1,1,'2022-03-14 13:03:47','2022-03-14 13:04:03'),(357,'cost',296,151,1,1,'2022-03-14 07:12:10','2022-03-14 07:12:31'),(358,'profit',9,151,1,1,'2022-03-14 07:12:10','2022-03-14 07:12:31'),(359,'cost',0,152,1,1,'2022-03-14 07:11:30','2022-03-14 07:11:54'),(360,'profit',3,152,1,1,'2022-03-14 07:11:30','2022-03-14 07:11:54'),(361,'cost',0,153,1,1,'2022-03-15 15:20:27','2022-03-15 15:22:01'),(362,'profit',100,153,1,1,'2022-03-15 15:20:27','2022-03-15 15:22:01'),(363,'cost',74,154,1,1,'2022-03-15 15:20:29','2022-03-15 15:21:24'),(364,'profit',11,154,1,1,'2022-03-15 15:20:29','2022-03-15 15:21:24'),(365,'cost',30,155,1,1,'2022-03-15 15:20:26','2022-03-15 15:20:57'),(366,'profit',10,155,1,1,'2022-03-15 15:20:26','2022-03-15 15:20:57'),(367,'cost',160,156,1,1,'2022-03-15 10:32:41','2022-03-15 10:33:21'),(368,'profit',0,156,1,1,'2022-03-15 10:32:41','2022-03-15 10:33:21'),(369,'cost',10,157,1,1,'2022-03-15 10:33:05','2022-03-15 10:33:16'),(370,'profit',0,157,1,1,'2022-03-15 10:33:05','2022-03-15 10:33:16'),(371,'cost',56,158,1,1,'2022-03-15 07:59:28','2022-03-15 07:59:37'),(372,'profit',29,158,1,1,'2022-03-15 07:59:28','2022-03-15 07:59:37'),(373,'cost',230,159,1,1,'2022-03-16 13:13:24','2022-03-16 13:14:33'),(374,'profit',15,159,1,1,'2022-03-16 13:13:24','2022-03-16 13:14:33'),(375,'cost',30,160,1,1,'2022-03-16 13:13:23','2022-03-16 13:14:03'),(376,'profit',10,160,1,1,'2022-03-16 13:13:23','2022-03-16 13:14:03'),(377,'cost',18,161,1,1,'2022-03-16 08:30:48','2022-03-16 08:31:16'),(378,'profit',17,161,1,1,'2022-03-16 08:30:48','2022-03-16 08:31:16'),(379,'cost',48,162,1,1,'2022-03-16 08:29:04','2022-03-16 08:30:56'),(380,'profit',22,162,1,1,'2022-03-16 08:29:04','2022-03-16 08:30:56'),(381,'cost',74,163,1,1,'2022-03-16 06:16:32','2022-03-16 06:16:59'),(382,'profit',11,163,1,1,'2022-03-16 06:16:32','2022-03-16 06:16:59'),(383,'cost',74,164,1,1,'2022-03-18 10:43:52','2022-03-18 10:44:45'),(384,'profit',11,164,1,1,'2022-03-18 10:43:52','2022-03-18 10:44:45'),(385,'cost',40,165,1,1,'2022-03-18 10:43:50','2022-03-18 10:44:17'),(386,'profit',10,165,1,1,'2022-03-18 10:43:50','2022-03-18 10:44:17'),(387,'cost',74,166,1,1,'2022-03-17 11:07:22','2022-03-17 11:08:02'),(388,'profit',11,166,1,1,'2022-03-17 11:07:22','2022-03-17 11:08:02'),(389,'cost',14,167,1,1,'2022-03-17 10:02:28','2022-03-17 10:02:48'),(390,'profit',6,167,1,1,'2022-03-17 10:02:28','2022-03-17 10:02:48'),(391,'cost',145,168,1,1,'2022-03-18 13:04:59','2022-03-19 07:28:56'),(392,'profit',38,168,1,1,'2022-03-18 13:04:59','2022-03-19 07:28:56'),(393,'cost',138,169,1,1,'2022-03-18 13:05:14','2022-03-19 07:28:46'),(394,'profit',33,169,1,1,'2022-03-18 13:05:14','2022-03-19 07:28:46'),(395,'cost',13,170,1,1,'2022-03-18 13:38:52','2022-03-18 13:39:00'),(396,'profit',22,170,1,1,'2022-03-18 13:38:52','2022-03-18 13:39:00'),(397,'cost',131,171,1,1,'2022-03-18 13:05:20','2022-03-18 13:06:15'),(398,'profit',7,171,1,1,'2022-03-18 13:05:20','2022-03-18 13:06:15'),(399,'cost',138,172,1,1,'2022-03-18 13:05:34','2022-03-18 13:05:59'),(400,'profit',8,172,1,1,'2022-03-18 13:05:34','2022-03-18 13:05:59'),(401,'cost',74,173,1,1,'2022-03-18 10:48:21','2022-03-18 10:49:06'),(402,'profit',11,173,1,1,'2022-03-18 10:48:21','2022-03-18 10:49:06'),(403,'cost',29,174,1,1,'2022-03-18 10:47:20','2022-03-18 10:48:16'),(404,'profit',11,174,1,1,'2022-03-18 10:47:20','2022-03-18 10:48:16'),(405,'cost',48,175,1,1,'2022-03-18 10:47:18','2022-03-18 10:47:40'),(406,'profit',7,175,1,1,'2022-03-18 10:47:18','2022-03-18 10:47:40'),(407,'cost',151,176,1,1,'2022-03-19 13:41:38','2022-03-19 13:41:46'),(408,'profit',69,176,1,1,'2022-03-19 13:41:38','2022-03-19 13:41:46'),(409,'cost',20,177,1,1,'2022-03-19 13:41:20','2022-03-19 13:41:25'),(410,'profit',10,177,1,1,'2022-03-19 13:41:20','2022-03-19 13:41:25'),(413,'cost',151,179,1,1,'2022-03-19 13:26:49','2022-03-19 13:30:44'),(414,'profit',24,179,1,1,'2022-03-19 13:26:49','2022-03-19 13:30:44'),(415,'cost',74,180,1,1,'2022-03-19 13:20:10','2022-03-19 13:20:37'),(416,'profit',11,180,1,1,'2022-03-19 13:20:10','2022-03-19 13:20:37'),(417,'cost',7,181,1,1,'2022-03-19 13:18:41','2022-03-19 13:18:49'),(418,'profit',13,181,1,1,'2022-03-19 13:18:41','2022-03-19 13:18:49'),(419,'cost',293,182,1,1,'2022-03-19 11:47:39','2022-03-19 11:48:51'),(420,'profit',12,182,1,1,'2022-03-19 11:47:39','2022-03-19 11:48:51'),(421,'cost',0,183,1,1,'2022-03-19 09:09:28','2022-03-19 09:10:12'),(422,'profit',10,183,1,1,'2022-03-19 09:09:28','2022-03-19 09:10:12'),(423,'cost',6,184,1,1,'2022-03-19 09:09:43','2022-03-19 09:09:51'),(424,'profit',14,184,1,1,'2022-03-19 09:09:43','2022-03-19 09:09:51'),(425,'cost',0,185,1,1,'2022-03-19 07:51:47','2022-03-19 07:52:03'),(426,'profit',3,185,1,1,'2022-03-19 07:51:47','2022-03-19 07:52:03'),(427,'cost',151,186,1,1,'2022-03-20 13:53:38','2022-03-20 13:53:43'),(428,'profit',69,186,1,1,'2022-03-20 13:53:38','2022-03-20 13:53:43'),(429,'cost',0,187,1,1,'2022-03-20 12:22:55','2022-03-20 12:23:08'),(430,'profit',10,187,1,1,'2022-03-20 12:22:55','2022-03-20 12:23:08'),(431,'cost',0,188,1,1,'2022-03-20 10:29:40','2022-03-20 10:30:01'),(432,'profit',10,188,1,1,'2022-03-20 10:29:40','2022-03-20 10:30:01'),(433,'cost',12,189,1,1,'2022-03-20 09:52:49','2022-03-20 09:53:06'),(434,'profit',1,189,1,1,'2022-03-20 09:52:49','2022-03-20 09:53:06'),(435,'cost',40,190,1,1,'2022-03-20 09:51:57','2022-03-20 09:52:39'),(436,'profit',6,190,1,1,'2022-03-20 09:51:57','2022-03-20 09:52:39'),(437,'cost',131,191,1,1,'2022-03-20 09:50:19','2022-03-20 09:52:33'),(438,'profit',7,191,1,1,'2022-03-20 09:50:19','2022-03-20 09:52:33'),(439,'cost',0,192,1,1,'2022-03-20 09:49:43','2022-03-20 09:49:57'),(440,'profit',5,192,1,1,'2022-03-20 09:49:43','2022-03-20 09:49:57'),(441,'cost',26,193,1,1,'2022-03-20 08:26:04','2022-03-20 08:28:04'),(442,'profit',4,193,1,1,'2022-03-20 08:26:04','2022-03-20 08:28:04'),(443,'cost',15,194,1,1,'2022-03-20 08:26:14','2022-03-20 08:27:58'),(444,'profit',1,194,1,1,'2022-03-20 08:26:14','2022-03-20 08:27:58'),(445,'cost',0,195,1,1,'2022-03-20 08:25:22','2022-03-20 08:25:40'),(446,'profit',5,195,1,1,'2022-03-20 08:25:22','2022-03-20 08:25:40'),(447,'cost',0,196,1,1,'2022-03-21 11:09:17','2022-03-23 09:19:52'),(448,'profit',10,196,1,1,'2022-03-21 11:09:17','2022-03-23 09:19:52'),(449,'cost',9,197,1,1,'2022-03-22 15:11:01','2022-03-22 15:11:01'),(450,'profit',11,197,1,1,'2022-03-22 15:11:01','2022-03-22 15:11:01'),(451,'cost',31,198,1,1,'2022-03-22 15:10:43','2022-03-22 15:10:49'),(452,'profit',14,198,1,1,'2022-03-22 15:10:43','2022-03-22 15:10:49'),(453,'cost',11,199,1,1,'2022-03-22 09:39:41','2022-03-22 09:40:04'),(454,'profit',24,199,1,1,'2022-03-22 09:39:41','2022-03-22 09:40:04'),(455,'cost',0,200,1,1,'2022-03-22 06:04:42','2022-03-22 06:05:41'),(456,'profit',4,200,1,1,'2022-03-22 06:04:42','2022-03-22 06:05:41'),(457,'cost',0,201,1,1,'2022-03-22 06:04:39','2022-03-22 06:05:26'),(458,'profit',4,201,1,1,'2022-03-22 06:04:39','2022-03-22 06:05:26'),(459,'cost',0,202,1,1,'2022-03-21 11:09:15','2022-03-21 11:10:27'),(460,'profit',2,202,1,1,'2022-03-21 11:09:15','2022-03-21 11:10:27'),(461,'cost',0,203,1,1,'2022-03-21 11:09:16','2022-03-21 11:10:08'),(462,'profit',3,203,1,1,'2022-03-21 11:09:16','2022-03-21 11:10:08'),(463,'cost',0,204,1,1,'2022-03-21 10:07:19','2022-03-21 10:07:35'),(464,'profit',14,204,1,1,'2022-03-21 10:07:19','2022-03-21 10:07:35'),(465,'cost',0,205,1,1,'2022-03-21 08:19:53','2022-03-21 08:20:11'),(466,'profit',15,205,1,1,'2022-03-21 08:19:53','2022-03-21 08:20:11'),(467,'cost',0,206,1,1,'2022-03-21 06:27:04','2022-03-21 06:27:44'),(468,'profit',12,206,1,1,'2022-03-21 06:27:04','2022-03-21 06:27:44'),(469,'cost',0,207,1,1,'2022-03-21 06:27:02','2022-03-21 06:27:32'),(470,'profit',12,207,1,1,'2022-03-21 06:27:02','2022-03-21 06:27:32'),(471,'cost',0,208,1,1,'2022-03-21 06:26:20','2022-03-21 06:26:52'),(472,'profit',14,208,1,1,'2022-03-21 06:26:20','2022-03-21 06:26:52'),(473,'cost',0,209,1,1,'2022-03-25 08:20:31','2022-03-25 08:20:57'),(474,'profit',7,209,1,1,'2022-03-25 08:20:31','2022-03-25 08:20:57'),(475,'cost',0,210,1,1,'2022-03-24 13:42:27','2022-03-24 13:42:49'),(476,'profit',12,210,1,1,'2022-03-24 13:42:27','2022-03-24 13:42:49'),(477,'cost',0,211,1,1,'2022-03-24 08:21:11','2022-03-24 08:21:24'),(478,'profit',9,211,1,1,'2022-03-24 08:21:11','2022-03-24 08:21:24'),(479,'cost',0,212,1,1,'2022-03-24 07:31:21','2022-03-24 07:32:53'),(480,'profit',12,212,1,1,'2022-03-24 07:31:21','2022-03-24 07:32:53'),(481,'cost',0,213,1,1,'2022-03-23 14:44:54','2022-03-23 14:45:13'),(482,'profit',12,213,1,1,'2022-03-23 14:44:54','2022-03-23 14:45:13'),(483,'cost',0,214,1,1,'2022-03-23 14:43:14','2022-03-23 14:44:25'),(484,'profit',10,214,1,1,'2022-03-23 14:43:14','2022-03-23 14:44:25'),(485,'cost',0,215,1,1,'2022-03-23 14:44:04','2022-03-23 14:44:19'),(486,'profit',9,215,1,1,'2022-03-23 14:44:04','2022-03-23 14:44:19'),(487,'cost',0,216,1,1,'2022-03-23 10:11:23','2022-03-23 10:11:49'),(488,'profit',12,216,1,1,'2022-03-23 10:11:23','2022-03-23 10:11:49'),(489,'cost',16,217,1,1,'2022-03-26 06:42:24','2022-03-26 06:43:01'),(490,'profit',4,217,1,1,'2022-03-26 06:42:24','2022-03-26 06:43:01'),(491,'cost',40,218,1,1,'2022-03-26 06:40:01','2022-03-26 06:40:19'),(492,'profit',8,218,1,1,'2022-03-26 06:40:01','2022-03-26 06:40:19'),(493,'cost',10,219,1,1,'2022-03-26 06:38:03','2022-03-26 06:38:14'),(494,'profit',5,219,1,1,'2022-03-26 06:38:03','2022-03-26 06:38:14'),(495,'cost',0,220,1,1,'2022-03-26 06:37:24','2022-03-26 06:37:50'),(496,'profit',5,220,1,1,'2022-03-26 06:37:24','2022-03-26 06:37:50'),(497,'cost',16,221,1,1,'2022-03-26 06:36:43','2022-03-26 06:37:11'),(498,'profit',2,221,1,1,'2022-03-26 06:36:43','2022-03-26 06:37:11'),(499,'cost',19,222,1,1,'2022-03-25 09:23:50','2022-03-25 09:23:58'),(500,'profit',16,222,1,1,'2022-03-25 09:23:50','2022-03-25 09:23:58'),(501,'cost',6,223,1,1,'2022-03-29 10:43:36','2022-03-30 15:16:29'),(502,'profit',5,223,1,1,'2022-03-29 10:43:36','2022-03-30 15:16:29'),(503,'cost',8,224,1,1,'2022-03-29 10:43:35','2022-03-30 15:16:25'),(504,'profit',3,224,1,1,'2022-03-29 10:43:35','2022-03-30 15:16:25'),(505,'cost',0,225,1,1,'2022-03-30 12:02:46','2022-03-30 12:02:56'),(506,'profit',0,225,1,1,'2022-03-30 12:02:46','2022-03-30 12:02:56'),(507,'cost',158,226,1,1,'2022-03-30 08:26:44','2022-03-30 08:27:24'),(508,'profit',17,226,1,1,'2022-03-30 08:26:44','2022-03-30 08:27:24'),(509,'cost',489,227,1,1,'2022-03-30 08:26:59','2022-03-30 08:27:13'),(510,'profit',51,227,1,1,'2022-03-30 08:26:59','2022-03-30 08:27:13'),(511,'cost',510,228,1,1,'2022-03-30 08:22:55','2022-03-30 08:23:21'),(512,'profit',30,228,1,1,'2022-03-30 08:22:55','2022-03-30 08:23:21'),(513,'cost',252,229,1,1,'2022-03-30 08:22:25','2022-03-30 08:22:43'),(514,'profit',28,229,1,1,'2022-03-30 08:22:25','2022-03-30 08:22:43'),(515,'cost',66,230,1,1,'2022-03-30 08:21:45','2022-03-30 08:22:15'),(516,'profit',9,230,1,1,'2022-03-30 08:21:45','2022-03-30 08:22:15'),(517,'cost',4,231,1,1,'2022-03-29 11:40:43','2022-03-29 11:40:43'),(518,'profit',11,231,1,1,'2022-03-29 11:40:43','2022-03-29 11:40:43'),(519,'cost',48,232,1,1,'2022-03-29 10:40:48','2022-03-29 10:43:14'),(520,'profit',0,232,1,1,'2022-03-29 10:40:48','2022-03-29 10:43:14'),(521,'cost',45,233,1,1,'2022-03-29 10:42:34','2022-03-29 10:43:02'),(522,'profit',20,233,1,1,'2022-03-29 10:42:34','2022-03-29 10:43:02'),(523,'cost',52,234,1,1,'2022-03-29 10:42:09','2022-03-29 10:42:24'),(524,'profit',20,234,1,1,'2022-03-29 10:42:09','2022-03-29 10:42:24'),(525,'cost',60,235,1,1,'2022-03-29 10:41:40','2022-03-29 10:42:00'),(526,'profit',0,235,1,1,'2022-03-29 10:41:40','2022-03-29 10:42:00'),(527,'cost',15,236,1,1,'2022-03-29 10:41:19','2022-03-29 10:41:34'),(528,'profit',3,236,1,1,'2022-03-29 10:41:19','2022-03-29 10:41:34'),(529,'cost',13,237,1,1,'2022-03-29 10:40:21','2022-03-29 10:40:39'),(530,'profit',5,237,1,1,'2022-03-29 10:40:21','2022-03-29 10:40:39'),(531,'cost',33,238,1,1,'2022-03-29 10:39:49','2022-03-29 10:40:08'),(532,'profit',4,238,1,1,'2022-03-29 10:39:49','2022-03-29 10:40:08'),(533,'cost',20,239,1,1,'2022-03-29 10:39:21','2022-03-29 10:39:36'),(534,'profit',7,239,1,1,'2022-03-29 10:39:21','2022-03-29 10:39:36'),(535,'cost',75,240,1,1,'2022-03-27 08:13:34','2022-03-27 08:13:42'),(536,'profit',100,240,1,1,'2022-03-27 08:13:34','2022-03-27 08:13:42'),(537,'cost',0,241,1,1,'2022-03-27 08:12:44','2022-03-27 08:13:14'),(538,'profit',9,241,1,1,'2022-03-27 08:12:44','2022-03-27 08:13:14'),(539,'cost',0,242,1,1,'2022-03-26 14:10:41','2022-03-26 14:11:09'),(540,'profit',10,242,1,1,'2022-03-26 14:10:41','2022-03-26 14:11:09'),(541,'cost',0,243,1,1,'2022-03-26 13:05:49','2022-03-26 13:08:51'),(542,'profit',0,243,1,1,'2022-03-26 13:05:49','2022-03-26 13:08:51'),(543,'cost',0,244,1,1,'2022-03-26 13:05:50','2022-03-26 13:07:53'),(544,'profit',0,244,1,1,'2022-03-26 13:05:50','2022-03-26 13:07:53'),(545,'cost',0,245,1,1,'2022-03-26 13:05:51','2022-03-26 13:07:08'),(546,'profit',7,245,1,1,'2022-03-26 13:05:51','2022-03-26 13:07:08'),(547,'cost',0,246,1,1,'2022-03-26 13:05:52','2022-03-26 13:06:45'),(548,'profit',8,246,1,1,'2022-03-26 13:05:52','2022-03-26 13:06:45'),(549,'cost',0,247,1,1,'2022-03-26 13:05:48','2022-03-26 13:06:28'),(550,'profit',9,247,1,1,'2022-03-26 13:05:48','2022-03-26 13:06:28'),(551,'cost',25,248,1,1,'2022-03-26 13:05:33','2022-03-26 13:05:33'),(552,'profit',15,248,1,1,'2022-03-26 13:05:33','2022-03-26 13:05:33'),(553,'cost',15,249,1,1,'2022-03-26 08:33:50','2022-03-26 08:34:02'),(554,'profit',3,249,1,1,'2022-03-26 08:33:50','2022-03-26 08:34:02'),(555,'cost',7,250,1,1,'2022-03-26 08:33:09','2022-03-26 08:33:37'),(556,'profit',2,250,1,1,'2022-03-26 08:33:09','2022-03-26 08:33:37'),(557,'cost',7,251,1,1,'2022-03-26 08:33:14','2022-03-26 08:33:29'),(558,'profit',2,251,1,1,'2022-03-26 08:33:14','2022-03-26 08:33:29'),(559,'cost',24,252,1,1,'2022-03-26 08:32:13','2022-03-26 08:32:39'),(560,'profit',6,252,1,1,'2022-03-26 08:32:13','2022-03-26 08:32:39'),(561,'cost',27,253,1,1,'2022-03-26 08:31:48','2022-03-26 08:32:08'),(562,'profit',12,253,1,1,'2022-03-26 08:31:48','2022-03-26 08:32:08'),(563,'cost',33,254,1,1,'2022-03-26 08:30:44','2022-03-26 08:30:54'),(564,'profit',4,254,1,1,'2022-03-26 08:30:44','2022-03-26 08:30:54'),(565,'cost',24,255,1,1,'2022-03-26 08:27:42','2022-03-26 08:28:01'),(566,'profit',3,255,1,1,'2022-03-26 08:27:42','2022-03-26 08:28:01');
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
) ENGINE=InnoDB AUTO_INCREMENT=1328 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,0,'Other',NULL,'****',839,0,0,'other',1,6,1,1,1,'2021-11-26 12:53:56','2022-03-31 10:46:48'),(1001,10011001,'Product 1001','desc','TGB',6,100,9,'product-1001',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-31 10:46:48'),(1002,10021002,'Product 1002','desc','AKG',7,100,11,'product-1002',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-20 08:58:48'),(1003,10031003,'Product 1003','desc','AKG',8,100,19,'product-1003',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-26 06:43:15'),(1004,10041004,'Product 1004','desc','J5',7,100,6,'product-1004',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-31 10:46:48'),(1006,10061006,'Product 1006','desc','S10',1,100,13,'product-1006',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-14 14:21:51'),(1007,10071007,'Product 1007','desc','KB-890',1,100,45,'product-1007',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1008,10081008,'Product 1008','desc','GP-6757',1,100,20,'product-1008',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1009,10091009,'Product 1009','desc','AURIS-PINK',3,100,18,'product-1009',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1010,10101010,'Product 1010','desc','K16',0,100,48,'product-1010',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-17 09:44:05'),(1011,10111011,'Product 1011','desc','K15',0,100,31,'product-1011',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-23 09:20:04'),(1012,10121012,'Product 1012','desc','PL-3050',4,100,6,'product-1012',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1013,10131013,'Product 1013','desc','K-203',3,100,10,'product-1013',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1014,10141014,'Product 1014','desc','KH-H35',0,100,23,'product-1014',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-13 08:05:07'),(1015,10151015,'Product 1015','desc','K-170',2,100,17,'product-1015',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1016,10161016,'Product 1016','desc','K-221',1,100,20,'product-1016',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1017,10171017,'Product 1017','desc','KH-420',1,100,11,'product-1017',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1018,10181018,'Product 1018','desc','REALME',1,100,13,'product-1018',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-14 07:11:25'),(1019,10191019,'Product 1019','desc','KH-HB22',2,225,160,'product-1019',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-28 07:12:36'),(1020,10201020,'Product 1020','desc','EXTRA-PASS',4,100,40,'product-1020',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1021,10211021,'Product 1021','desc','KM-306',1,100,89,'product-1021',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1022,10221022,'Product 1022','desc','KM-296',0,100,75,'product-1022',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-31 10:46:48'),(1023,10231023,'Product 1023','desc','KM-293',0,100,67,'product-1023',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-14 07:11:25'),(1024,10241024,'Product 1024','desc','KM-295',1,100,67,'product-1024',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1025,10251025,'Product 1025','desc','K-253',1,100,73,'product-1025',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1026,10261026,'Product 1026','desc','KBS-1301',2,100,39,'product-1026',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1027,10271027,'Product 1027','desc','MH-32BT',1,100,105,'product-1027',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1028,10281028,'Product 1028','desc','KTS-1106',1,100,114,'product-1028',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1029,10291029,'Product 1029','desc','KB-940',2,100,148,'product-1029',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1030,10301030,'Product 1030','desc','KB-958',2,100,94,'product-1030',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-20 15:31:45'),(1031,10311031,'Product 1031','desc','KH-HB19',3,100,42,'product-1031',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1032,10321032,'Product 1032','desc','B-516',2,100,91,'product-1032',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1033,10331033,'Product 1033','desc','KB-300',1,100,89,'product-1033',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1034,10341034,'Product 1034','desc','IP-70',5,100,31,'product-1034',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1035,10351035,'Product 1035','desc','KH-228',2,100,31,'product-1035',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1036,10361036,'Product 1036','desc','K-171',2,100,16,'product-1036',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1037,10371037,'Product 1037','desc','SYX-IP',3,100,13,'product-1037',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-19 07:29:01'),(1038,10381038,'Product 1038','desc','SELFI-LED',2,100,25,'product-1038',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1039,10391039,'Product 1039','desc','KH-10',3,100,39,'product-1039',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1040,10401040,'Product 1040','desc','KH-08',5,100,37,'product-1040',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-24 06:20:47'),(1041,10411041,'Product 1041','desc','KO-115',1,100,67,'product-1041',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1042,10421042,'Product 1042','desc','KO-130',1,100,75,'product-1042',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1043,10431043,'Product 1043','desc','KO-135',1,100,100,'product-1043',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1044,10441044,'Product 1044','desc','KO-120',1,100,123,'product-1044',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1045,10451045,'Product 1045','desc','LKC-29',1,100,27,'product-1045',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-05 10:22:17'),(1046,10461046,'Product 1046','desc','KH-JC7',1,100,16,'product-1046',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1047,10471047,'Product 1047','desc','KH-JC10',1,100,24,'product-1047',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1048,10481048,'Product 1048','desc','PL-9123',1,100,15,'product-1048',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1049,10491049,'Product 1049','desc','Keyboard-arabic',2,100,5,'product-1049',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-06 15:10:19'),(1050,10501050,'Product 1050','desc','UC-620',2,100,6,'product-1050',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1051,10511051,'Product 1051','desc','MY-TELL',1,100,6,'product-1051',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1052,10521052,'Product 1052','desc','KC-55',0,100,13,'product-1052',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-05 10:22:17'),(1053,10531053,'Product 1053','desc','KH-C24',0,100,13,'product-1053',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-12 07:22:38'),(1054,10541054,'Product 1054','desc','KH-C75',0,100,11,'product-1054',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-23 09:20:04'),(1055,10551055,'Product 1055','desc','KH-C46',2,100,15,'product-1055',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1056,10561056,'Product 1056','desc','KH-C57',2,100,9,'product-1056',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1057,10571057,'Product 1057','desc','SM-20',0,100,10,'product-1057',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-26 06:43:15'),(1058,10581058,'Product 1058','desc','IP-20',2,100,10,'product-1058',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1059,10591059,'Product 1059','desc','TP-20',2,100,10,'product-1059',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1060,10601060,'Product 1060','desc','SM-30',0,100,10,'product-1060',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-17 10:31:38'),(1061,10611061,'Product 1061','desc','KC-50',1,100,12,'product-1061',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1062,10621062,'Product 1062','desc','KH-11',2,100,12,'product-1062',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1063,10631063,'Product 1063','desc','OTG-64',0,100,56,'product-1063',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-16 06:16:27'),(1064,10641064,'Product 1064','desc','OTG-16',1,100,39,'product-1064',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1065,10651065,'Product 1065','desc','OTG-32',1,100,42,'product-1065',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1066,10661066,'Product 1066','desc','SYX-MC128',1,175,143,'product-1066',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-22 12:07:54'),(1067,10671067,'Product 1067','desc','SYX-MC16',1,70,30,'product-1067',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-22 12:08:11'),(1068,10681068,'Product 1068','desc','K-SD64',1,95,55,'product-1068',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-22 12:08:33'),(1069,10691069,'Product 1069','desc','SYX-MC32',1,75,37,'product-1069',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-22 12:08:17'),(1070,10701070,'Product 1070','desc','PUBG-TOOL',3,20,7,'product-1070',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-01 08:07:03'),(1071,10711071,'Product 1071','desc','YUZUK',45,100,3,'product-1071',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1072,10721072,'Product 1072','desc','KAPAK',146,100,9,'product-1072',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1073,10731073,'Product 1073','desc','KH-HB18',0,100,98,'product-1073',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-06 15:10:19'),(1074,10741074,'Product 1074','desc','E-S32',1,100,100,'product-1074',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1075,10751075,'Product 1075','desc','J02K',1,100,10,'product-1075',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1076,10761076,'Product 1076','desc','J13K',1,100,10,'product-1076',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1077,10771077,'Product 1077','desc','JH-010',1,100,50,'product-1077',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1078,10781078,'Product 1078','desc','KT-302',1,100,31,'product-1078',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1079,10791079,'Product 1079','desc','JO-LM01',1,100,30,'product-1079',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1080,10801080,'Product 1080','desc','KH-J41',0,100,25,'product-1080',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 08:35:26'),(1081,10811081,'Product 1081','desc','QC-50',4,100,33,'product-1081',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-31 10:46:48'),(1082,10821082,'Product 1082','desc','Q32',1,100,34,'product-1082',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1083,10831083,'Product 1083','desc','J28',1,100,16,'product-1083',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1084,10841084,'Product 1084','desc','S23',1,100,35,'product-1084',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1085,10851085,'Product 1085','desc','PB-10',1,100,90,'product-1085',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1086,10861086,'Product 1086','desc','CHARGER-KNIFE',1,100,50,'product-1086',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1087,10871087,'Product 1087','desc','KB-980',1,100,131,'product-1087',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-19 07:29:01'),(1088,10881088,'Product 1088','desc','KB-985',3,100,108,'product-1088',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-22 15:19:56'),(1089,10891089,'Product 1089','desc','KH-HB21',0,100,100,'product-1089',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-09 07:02:39'),(1090,10901090,'Product 1090','desc','KB-950',0,225,151,'product-1090',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-21 06:26:13'),(1091,10911091,'Product 1091','desc','KB-955',1,225,158,'product-1091',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-31 10:46:48'),(1092,10921092,'Product 1092','desc','PWATCHX',1,100,125,'product-1092',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1093,10931093,'Product 1093','desc','KB-928',1,100,134,'product-1093',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1094,10941094,'Product 1094','desc','KB-995',0,100,135,'product-1094',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-06 15:10:19'),(1095,10951095,'Product 1095','desc','KB-835',2,200,124,'product-1095',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-24 06:20:47'),(1096,10961096,'Product 1096','desc','POWER-CABLE',3,100,25,'product-1096',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1097,10971097,'Product 1097','desc','OTG-5',6,100,5,'product-1097',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1098,10981098,'Product 1098','desc','KH-CT11',3,100,6,'product-1098',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1099,10991099,'Product 1099','desc','TC-MICRO',2,100,7,'product-1099',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1100,11001100,'Product 1100','desc','USB-TC',1,100,10,'product-1100',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-16 06:16:27'),(1101,11011101,'Product 1101','desc','LIGHT-HUB',2,100,15,'product-1101',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1102,11021102,'Product 1102','desc','BATTAREY',3,100,30,'product-1102',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1103,11031103,'Product 1103','desc','NOTE4-BT',1,100,75,'product-1103',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1104,11041104,'Product 1104','desc','METAL-YUZUK',6,100,6,'product-1104',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-17 10:31:38'),(1106,11061106,'Product 1106','desc','J40',1,100,15,'product-1106',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1107,11071107,'Product 1107','desc','KH-J40',1,100,25,'product-1107',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1108,11081108,'Product 1108','desc','ST-201',1,100,25,'product-1108',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1109,11091109,'Product 1109','desc','KH-CH80',1,100,12,'product-1109',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1110,11101110,'Product 1110','desc','H10',1,100,11,'product-1110',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1111,11111111,'Product 1111','desc','SIM-ADAPTAR',10,100,5,'product-1111',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1112,11121112,'Product 1112','desc','CB3',2,100,48,'product-1112',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1113,11131113,'Product 1113','desc','CB-30',0,100,12,'product-1113',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-21 06:26:13'),(1114,11141114,'Product 1114','desc','TP-612',1,100,12,'product-1114',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1115,11151115,'Product 1115','desc','A-25',2,100,19,'product-1115',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1116,11161116,'Product 1116','desc','PLX-070',2,100,12,'product-1116',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1117,11171117,'Product 1117','desc','AUX-ARAC',1,100,22,'product-1117',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1118,11181118,'Product 1118','desc','C84',3,100,4,'product-1118',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1119,11191119,'Product 1119','desc','AUX-LIGHT',1,100,25,'product-1119',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-05 10:22:17'),(1120,11201120,'Product 1120','desc','AUX-TC',3,100,10,'product-1120',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1121,11211121,'Product 1121','desc','DK-151',0,100,5,'product-1121',1,6,1,1,1,'2022-02-16 11:10:00','2022-03-14 07:11:25'),(1122,11221122,'Product 1122','desc','C83',3,100,6,'product-1122',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1123,11231123,'Product 1123','desc','C78',3,100,5,'product-1123',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-16 11:10:00'),(1124,11241124,'Product 1124','desc','PC-35',4,40,16,'product-1124',1,6,1,1,1,'2022-02-16 11:10:00','2022-02-22 13:12:07'),(1125,11251125,'Product  1125','desc','LKL-04',4,40,14,'product-1125',1,1,1,1,1,'2022-02-16 08:47:43','2022-02-24 06:20:47'),(1126,11261126,'Product 1126','desc','veno-micro',0,25,7,'product-1126',1,1,1,1,1,'2022-02-16 08:48:23','2022-03-31 10:46:48'),(1127,11271127,'Product 1127','desc','w11',2,30,9,'product-1127',1,1,1,1,1,'2022-02-16 08:49:02','2022-02-16 08:49:02'),(1128,11281128,'Product 1128','desc\n','i12',0,125,70,'product-1128',1,1,1,1,1,'2022-02-16 08:49:40','2022-03-09 07:02:39'),(1129,11291129,'Product 1129','desc','sam-orj',4,30,11,'product-1129',1,1,1,1,1,'2022-02-16 08:50:14','2022-03-05 10:22:17'),(1130,11301130,'Product 1130','desc','torima-bts',2,50,26,'product-1130',1,1,1,1,1,'2022-02-16 08:51:08','2022-03-31 10:46:48'),(1131,11311131,'Product 1131','11311131','kb-948',3,150,88,'product-1131',1,1,1,1,1,'2022-02-20 15:36:21','2022-02-24 06:20:47'),(1132,11321132,'Product 1132','11321132','kb-740',2,200,131,'product-1132',1,1,1,1,1,'2022-02-20 15:37:37','2022-03-21 06:26:13'),(1133,11331133,'Product 1133','a','KB-830',1,200,138,'product-1133',1,1,1,1,1,'2022-02-22 08:52:05','2022-02-22 08:52:05'),(1134,11341134,'Product 1134','asf','KB-970',1,225,165,'product-1134',1,1,1,1,1,'2022-02-22 08:55:37','2022-02-22 08:55:37'),(1135,11351135,'Product 1135','afds','KB-810',0,225,138,'product-1135',1,1,1,1,1,'2022-02-22 08:56:52','2022-03-19 07:29:01'),(1136,11361136,'Product 1136','fa','KB-825',0,200,138,'product-1136',1,1,1,1,1,'2022-02-22 09:10:18','2022-03-19 07:29:01'),(1137,11371137,'Product 1137','DESC\n','KB-895',0,200,117,'product-1137',1,1,1,1,1,'2022-02-22 09:14:38','2022-03-13 08:05:07'),(1138,11381138,'Product 1138','desc','KB-992',0,225,145,'product-1138',1,1,1,1,1,'2022-02-22 09:48:42','2022-03-19 07:29:01'),(1139,11391139,'Product 1139','desc','KM-325',0,225,138,'product-1139',1,1,1,1,1,'2022-02-22 10:15:23','2022-02-24 06:20:47'),(1140,11401140,'Product 1140','desc','KM-290',1,200,110,'product-1140',1,1,1,1,1,'2022-02-22 10:16:05','2022-02-22 10:16:05'),(1141,11411141,'Product 1141','desc','KN-60',2,40,20,'product-1141',1,1,1,1,1,'2022-02-22 10:18:53','2022-03-31 10:46:48'),(1142,11421142,'Product 1142','desc','PW-200-BASLIK',1,100,44,'product-1142',1,1,1,1,1,'2022-02-22 10:43:56','2022-02-22 10:43:56'),(1143,11431143,'Product 1143','DESC','PW-200-LIGHTNING',1,125,63,'product-1143',1,1,1,1,1,'2022-02-22 10:47:19','2022-02-22 10:47:19'),(1144,11441144,'Product  1144','desc','KM-04',1,55,27,'product-1144',1,1,1,1,1,'2022-02-22 12:09:21','2022-02-22 12:09:21'),(1145,11451145,'Product 1145','desc','M-40',1,50,24,'product-1145',1,1,1,1,1,'2022-02-22 12:10:02','2022-02-22 12:10:02'),(1146,11461146,'Product 1146','desc','M-42',1,60,30,'product-1146',1,1,1,1,1,'2022-02-22 12:10:35','2022-02-22 12:10:35'),(1147,11471147,'Product 1147','desc','T-74',1,60,28,'product-1147',1,1,1,1,1,'2022-02-22 12:25:13','2022-02-22 12:25:13'),(1148,11481148,'Product 1148','desc','T-41',1,60,30,'product-1148',1,1,1,1,1,'2022-02-22 12:25:43','2022-02-22 12:25:43'),(1149,11491149,'Product 1149','desc','T-53',1,60,31,'product-1149',1,1,1,1,1,'2022-02-22 12:26:13','2022-02-22 12:26:13'),(1150,11501150,'Product 1150','desc','T-45',1,80,40,'product-1150',1,1,1,1,1,'2022-02-22 12:26:50','2022-02-22 12:26:50'),(1151,11511151,'Product 1151','desc','KB-918',1,150,81,'product-1151',1,1,1,1,1,'2022-02-22 12:45:05','2022-03-09 07:02:39'),(1152,11521152,'Product 1152','desc','KB-990',2,150,88,'product-1152',1,1,1,1,1,'2022-02-22 12:46:18','2022-02-24 06:20:47'),(1153,11531153,'Product 1153','desc','KB-620',1,200,101,'product-1153',1,1,1,1,1,'2022-02-22 13:14:24','2022-02-22 13:14:24'),(1154,11541154,'Product 1154','desc','KB-640',1,200,101,'product-1154',1,1,1,1,1,'2022-02-22 13:15:19','2022-02-22 13:15:19'),(1155,11551155,'Product 1155','desc','PUBG-FINGER',2,25,9,'product-1155',1,1,1,1,1,'2022-02-28 07:16:00','2022-02-28 07:16:00'),(1156,11561156,'Product 1156','desc','ADDAPTOR-FIS',4,10,4,'product-1156',1,1,1,1,1,'2022-02-28 07:16:38','2022-03-06 15:10:19'),(1157,11571157,'Product  1157','desc','SYX-MX10',1,200,148,'product-1157',1,1,1,1,1,'2022-02-28 07:35:00','2022-02-28 07:35:00'),(1158,11581158,'Product 1158','desc','PRO4',0,250,150,'product-1158',1,1,1,1,1,'2022-02-28 07:36:06','2022-03-06 15:10:19'),(1159,11591159,'Product 1159','DESC','LKB-04',1,200,125,'product-1159',1,1,1,1,1,'2022-02-28 07:37:44','2022-02-28 07:37:44'),(1160,11601160,'Product 1160','DESC','LKL-01',5,35,15,'product-1160',1,1,1,1,1,'2022-02-28 07:38:38','2022-03-31 10:46:48'),(1161,11611161,'Product 1161','DESC','TGB-017',2,20,8,'product-1161',1,1,1,1,1,'2022-02-28 07:46:17','2022-03-31 10:46:48'),(1162,11621162,'Product 1162','DESC','AC-2',0,40,25,'product-1162',1,1,1,1,1,'2022-02-28 07:47:23','2022-03-31 10:46:48'),(1163,11631163,'Product 1163','desc','K1-29',1,45,20,'product-1163',1,1,1,1,1,'2022-02-28 07:48:03','2022-02-28 07:48:03'),(1164,11641164,'Product 1164','desc','J2355',5,35,18,'product-1164',1,1,1,1,1,'2022-03-08 13:11:14','2022-03-17 09:44:05'),(1165,11651165,'Product 1165','desc','x587',1,35,18,'product-1165',1,1,1,1,1,'2022-03-08 13:11:39','2022-03-08 13:11:39'),(1166,11661166,'Product 1166','desc','PRO3',2,225,130,'product-1166',1,1,1,1,1,'2022-03-08 13:12:28','2022-03-14 07:13:13'),(1167,11671167,'Product 1167','desc','wireless-sport',2,75,37,'product-1167',1,1,1,1,1,'2022-03-09 07:17:32','2022-03-09 07:17:32'),(1168,11681168,'Product 1168','desc','redmi-note9',5,15,4,'product-1168',1,1,1,1,1,'2022-03-09 12:40:58','2022-03-09 12:40:58'),(1169,11691169,'Product 1169','desc\n','redmi-note9-pro',5,15,4,'product-1169',1,1,1,1,1,'2022-03-09 12:41:52','2022-03-09 12:41:52'),(1170,11701170,'Product 1170','desc','sam-a21s',6,15,4,'product-1170',1,1,1,1,1,'2022-03-09 15:58:18','2022-03-09 13:22:45'),(1171,11711171,'Product 1171','desc','sam-a12',5,15,4,'product-1171',1,1,1,1,1,'2022-03-09 15:58:18','2022-03-09 15:58:18'),(1172,11721172,'Product 1172','desc','sam-a50',5,15,4,'product-1172',1,1,1,1,1,'2022-03-09 15:58:18','2022-03-09 15:58:18'),(1173,11731173,'Product 1173','desc','poco-x3',5,15,4,'product-1173',1,1,1,1,1,'2022-03-09 15:58:18','2022-03-09 15:58:18'),(1174,11741174,'Product 1174','desc','redmi-9t',5,15,4,'product-1174',1,1,1,1,1,'2022-03-09 15:58:18','2022-03-09 15:58:18'),(1175,11751175,'Product 1175','desc','redmi-9',7,15,4,'product-1175',1,1,1,1,1,'2022-03-09 15:58:18','2022-03-10 11:15:07'),(1176,11761176,'Product 1176','desc','redmi-note8',5,15,4,'product-1176',1,1,1,1,1,'2022-03-09 15:58:18','2022-03-09 15:58:18'),(1177,11771177,'Product 1177','desc','redmi-note8-pro',5,15,4,'product-1177',1,1,1,1,1,'2022-03-09 15:58:18','2022-03-09 15:58:18'),(1178,11781178,'Product 1178','desc','nano-redmi-note8-pro',2,25,6,'product-1178',1,1,1,1,1,'2022-03-09 15:58:18','2022-03-09 15:58:18'),(1179,11791179,'Product 1179','desc','nano-sam-a21s',2,25,6,'product-1179',1,1,1,1,1,'2022-03-09 15:58:18','2022-03-09 15:58:18'),(1180,11801180,'Product 1180','desc','JU-101',0,225,160,'product-1180',1,1,1,1,1,'2022-03-09 15:58:18','2022-03-16 06:16:27'),(1181,11811181,'Product 1181','desc','SBK-01',3,200,100,'product-1181',1,1,1,1,1,'2022-03-09 15:58:18','2022-03-09 15:58:18'),(1182,11821182,'Product 1182','desc','S059',1,25,12,'product-1182',1,1,1,1,1,'2022-03-09 16:24:27','2022-03-09 16:24:27'),(1183,11831183,'Product 1183','desc','MPB-56',5,15,52,'product-1183',1,1,1,1,1,'2022-03-09 16:24:27','2022-03-12 12:04:41'),(1184,11841184,'Product 1184','desc','redmi-note10',5,15,4,'product-1184',1,1,1,1,1,'2022-03-09 16:24:27','2022-03-09 16:24:27'),(1185,11851185,'Product 1185','desc','sam-a7-2018',6,15,4,'product-1185',1,1,1,1,1,'2022-03-09 16:24:27','2022-03-09 16:24:27'),(1186,11861186,'Product 1186','Desc','GM-EP',3,25,13,'product-1186',1,6,1,1,1,'2022-03-12 07:42:07','2022-03-21 06:26:13'),(1187,11871187,'Product 1187','desc','X593',1,30,18,'product-1187',1,1,1,1,1,'2022-03-14 07:14:16','2022-03-14 07:14:16'),(1188,11881188,'Product 1188','desc','CB410M',5,30,10,'product-1188',1,1,1,1,1,'2022-03-14 07:14:58','2022-03-14 07:14:58'),(1189,11891189,'Product 1189','desc','SCREEN-J3-2017',2,10,3,'product-1189',1,6,1,1,1,'2022-03-14 10:41:11','2022-03-14 10:41:11'),(1190,11901190,'Product 1190','desc','SCREEN-J8-2018',2,15,3,'product-1190',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1191,11911191,'Product 1191','desc','SCREEN-J600',1,15,3,'product-1191',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1192,11921192,'Product 1192','desc','SCREEN-MI9T',1,35,7,'product-1192',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1193,11931193,'Product 1193','desc','SCREEN-NOTE8-PRO-9D',1,30,7,'product-1193',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1194,11941194,'Product 1194','desc','SCREEN-NOTE9-9D',1,30,7,'product-1194',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1195,11951195,'Product 1195','desc','SCREEN-REDMI8-9D',5,30,7,'product-1195',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1196,11961196,'Product 1196','desc','SCREEN-NOTE10-PRO',2,15,4,'product-1196',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1197,11971197,'Product 1197','desc','SCREEN-IPH-6',3,15,4,'product-1197',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1198,11981198,'Product 1198','desc','SCREEN-IPH-7',4,15,4,'product-1198',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1199,11991199,'Product 1199','desc','SCREEN-IPH-6PLUS',4,15,4,'product-1199',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1200,12001200,'Product 1200','desc','SCREEN-NANO-MATE20LITE',2,35,7,'product-1200',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1201,12011201,'Product 1201','desc','SCREEN-NANO-MATE10',1,35,7,'product-1201',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1202,12021202,'Product 1202','desc','SCREEN-NANO-Y7-2019',1,35,7,'product-1202',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1203,12031203,'Product 1203','desc','SCREEN-NANO-Y7-2018',1,35,7,'product-1203',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1204,12041204,'Product 1204','desc','SCREEN-NANO-Y9-2018',2,35,7,'product-1204',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1206,12061206,'Product 1206','desc','SCREEN-NANO-Y6-2019',2,35,7,'product-1206',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1207,12071207,'Product 1207','desc','SCREEN-Y6-2018',1,15,4,'product-1207',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1208,12081208,'Product 1208','desc','SCREEN-Y7-2018',0,15,4,'product-1208',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-31 10:46:48'),(1209,12091209,'Product 1209','desc','SCREEN-HONO8C',1,15,4,'product-1209',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1210,12101210,'Product 1210','desc','SCREEN-MATE8',2,15,4,'product-1210',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1211,12111211,'Product 1211','desc','SCREEN-MATE10LITE',2,15,4,'product-1211',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1212,12121212,'Product 1212','desc','SCREEN-MATE20LITE',1,15,4,'product-1212',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1213,12131213,'Product 1213','desc','SCREEN-P20LITE',1,15,4,'product-1213',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1214,12141214,'Product 1214','desc','SCREEN-P30LITE',1,15,4,'product-1214',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1215,12151215,'Product 1215','desc','SCREEN-P9',1,15,4,'product-1215',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1216,12161216,'Product 1216','desc','SCREEN-NANO-M105',1,35,7,'product-1216',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1217,12171217,'Product 1217','desc','SCREEN-NANO-20',1,35,7,'product-1217',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1218,12181218,'Product 1218','desc','SCREEN-NANO-P-SMART-2019',1,35,7,'product-1218',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1219,12191219,'Product 1219','desc','SCREEN-NANO-P30-LITE',1,35,7,'product-1219',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1220,12201220,'Product 1220','desc','SCREEN-S5-MINI',4,10,4,'product-1220',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1221,12211221,'Product 1221','desc','SCREEN-S7582',1,10,3,'product-1221',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1222,12221222,'Product 1222','desc','SCREEN-SAM-S7',1,10,3,'product-1222',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1223,12231223,'Product 1223','desc','SCREEN-SAM-S4',1,10,3,'product-1223',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1224,12241224,'Product 1224','desc','SCREEN-SAM-S4-MINI',1,10,3,'product-1224',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1225,12251225,'Product 1225','desc','SCREEN-SAM-S3-MINI',1,10,3,'product-1225',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1226,12261226,'Product 1226','desc','SCREEN-SAM-NOTE8',1,10,3,'product-1226',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1227,12271227,'Product 1227','desc','SCREEN-SAM-NOTE2',2,10,3,'product-1227',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1228,12281228,'Product 1228','desc','SCREEN-SAM-NOTE3-NEO',3,10,3,'product-1228',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1229,12291229,'Product 1229','desc','SCREEN-SAM-NOTE3',2,10,3,'product-1229',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1230,12301230,'Product 1230','desc','SCREEN-SAM-NOTE4',2,10,3,'product-1230',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1231,12311231,'Product 1231','desc','SCREEN-SAM-NOTE5',1,10,3,'product-1231',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1232,12321232,'Product 1232','desc','SCREEN-SAM-C8',1,10,3,'product-1232',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1233,12331233,'Product 1233','desc','SCREEN-E7',1,10,3,'product-1233',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1234,12341234,'Product 1234','desc','SCREEN-C5PRO-C5010',1,10,3,'product-1234',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1235,12351235,'Product 1235','desc','SCREEN-SAM-WIN',2,10,3,'product-1235',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1236,12361236,'Product 1236','desc','SCREEN-NOVA-3I',2,35,7,'product-1236',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1237,12371237,'Product 1237','DESC','SCREEN-SAM-A51',4,15,4,'product-1237',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1238,12381238,'Product 1238','desc','SCREEN-SAM-A52',3,15,4,'product-1238',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1239,12391239,'Product 1239','desc','SCREEN-SAM-A7-2017',2,25,5,'product-1239',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1240,12401240,'Product 1240','desc','SCREEN-SAM-A7',1,15,3,'product-1240',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1241,12411241,'Product 1241','desc','SCREEN-SAM-A5',1,15,4,'product-1241',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1242,12421242,'Product 1242','desc','SCREEN-SAM-A5-2017',1,15,4,'product-1242',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1243,12431243,'Product 1243','DESC','SCREEN-SAM-A5-2016',2,15,4,'product-1243',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1244,12441244,'Product 1244','desc','SCREEN-SAM-A30-S',2,15,4,'product-1244',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1245,12451245,'Product 1245','desc','SCREEN-SAM-A31',2,15,4,'product-1245',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1246,12461246,'Product 1246','desc','SCREEN-SAM-A31-9D',2,30,7,'product-1246',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1247,12471247,'Product 1247','desc','SCREEN-SAM-A3-2017',1,15,4,'product-1247',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1248,12481248,'Product 1248','desc','SCREEN-SAM-A3',3,15,4,'product-1248',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1249,12491249,'Product 1249','desc','SCREEN-SAM-A205-9D',1,30,7,'product-1249',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1250,12501250,'Product 1250','desc','SCREEN-SAM-A2-CORE',1,15,3,'product-1250',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1251,12511251,'Product 1251','desc','SCREEN-NANO-A2-A260',3,35,7,'product-1251',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1252,12521252,'Product 1252','desc','SCREEN-SAM-A105',2,15,4,'product-1252',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1253,12531253,'Product 1253','desc','SCREEN-SAM-A105-9D',1,30,7,'product-1253',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1254,12541254,'Product 1254','desc','SCREEN-SAM-A60-9D',1,30,7,'product-1254',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1255,12551255,'Product 1255','desc','SCREEN-NANO-A60',2,35,7,'product-1255',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1256,12561256,'Product 1256','desc','SCREEN-SAM-A60',2,15,4,'product-1256',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1257,12571257,'Product 1257','desc','SCREEN-SAM-A600',3,15,4,'product-1257',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1258,12581258,'Product 1258','desc','SCREEN-SAM-A6PLUS',5,20,5,'product-1258',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1259,12591259,'Product 1259','desc','SCREEN-GRAND2-7102',5,10,3,'product-1259',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1260,12601260,'Product 1260','desc','SCREEN-GRAND-NEO',2,10,3,'product-1260',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1261,12611261,'Product 1261','desc','SCREEN-G350',2,10,3,'product-1261',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1262,12621262,'Product 1262','desc','SCREEN-G360',2,10,3,'product-1262',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1263,12631263,'Product 1263','desc','SCREEN-SAM-A72',4,15,4,'product-1263',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1264,12641264,'Product 1264','desc','SCREEN-SAM-A70',5,15,4,'product-1264',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1265,12651265,'Product 1265','desc','SCREEN-SAM-A71',1,15,4,'product-1265',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1266,12661266,'Product 1266','desc','SCREEN-NANO-A70',2,35,7,'product-1266',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1267,12671267,'Product 1267','desc','SCREEN-SAM-A9',2,15,3,'product-1267',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1268,12681268,'Product 1268','desc','SCREEN-SAM-A8PLUS-2018',3,15,3,'product-1268',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1269,12691269,'Product 1269','desc','SCREEN-SAM-A8PLUS',2,20,5,'product-1269',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1270,12701270,'Product 1270','desc','SCREEN-NANO-A80',4,35,7,'product-1270',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1271,12711271,'Product 1271','desc','SCREEN-SAM-J7',5,15,4,'product-1271',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1272,12721272,'Product 1272','desc','SCREEN-SAM-J7-PRIME',5,15,4,'product-1272',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1273,12731273,'Product 1273','desc','SCREEN-SAM-J7PRO',3,15,4,'product-1273',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1274,12741274,'Product 1274','desc','SCREEN-NANO-J4',2,35,10,'product-1274',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1275,12751275,'Product 1275','desc','SCREEN-SAM-J5-2017',1,10,3,'product-1275',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1276,12761276,'Product 1276','desc','SCREEN-SAM-J5-2016',6,10,3,'product-1276',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1277,12771277,'Product 1277','desc','SCREEN-J320-J5-J2',5,10,3,'product-1277',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1278,12781278,'Product 1278','desc','SCREEN-J2',1,10,3,'product-1278',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1279,12791279,'Product 1279','desc','SCREEN-J2CORE',2,10,3,'product-1279',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1280,12801280,'Product 1280','desc','SCREEN-J250',4,10,3,'product-1280',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1281,12811281,'Product 1281','desc','SCREEN-J106-1MINI',2,15,3,'product-1281',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1282,12821282,'Product 1282','desc','SCREEN-J1-2016',2,15,3,'product-1282',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1283,12831283,'Product 1283','desc','SCREEN-J1-100',2,15,3,'product-1283',1,6,1,1,1,'2022-03-14 10:34:56','2022-03-14 10:34:56'),(1284,12841284,'Product 1284','Desc','torima-bts',6,50,26,'product-1284',10,25,1,1,1,'2022-03-22 10:37:13','2022-03-22 10:39:26'),(1285,12851285,'Product 1285','desc','KH-H20',5,25,13,'product-1285',10,25,1,1,1,'2022-03-22 10:37:13','2022-03-22 10:37:13'),(1286,12861286,'Product 1286','desc','CB410T',5,30,10,'product-1286',10,25,1,1,1,'2022-03-22 10:37:13','2022-03-22 10:37:13'),(1287,12871287,'Product 1287','desc','AE-38',0,20,8,'product-1287',10,25,1,1,1,'2022-03-22 10:37:13','2022-03-31 10:46:48'),(1288,12881288,'Product 1288','desc','J5',100,15,5,'product-1288',10,25,1,1,1,'2022-03-22 10:37:13','2022-03-22 10:37:13'),(1289,12891289,'Product 1289','desc','K1-32',4,45,19,'product-1289',10,25,1,1,1,'2022-03-22 10:37:13','2022-03-22 10:37:13'),(1290,12901290,'Product 1290','desc','TGB',7,20,9,'product-1290',10,24,1,1,1,'2022-03-22 10:37:13','2022-03-23 09:20:04'),(1291,12911291,'Product 1291','desc','J2355',5,40,17,'product-1291',10,25,1,1,1,'2022-03-22 10:37:13','2022-03-22 10:37:13'),(1292,12921292,'Product 1292','desc','XF-01',0,10,8,'product-1292',10,25,1,1,1,'2022-03-22 10:37:13','2022-03-31 10:46:48'),(1293,12931293,'Product 1293','micro','veno-micro',4,15,7,'product-1293',10,25,1,1,1,'2022-03-22 10:37:13','2022-03-31 10:46:48'),(1294,12941294,'Product 1294','desc','ASPOR-TC',10,30,7,'product-1294',10,25,1,1,1,'2022-03-22 10:37:13','2022-03-22 10:37:13'),(1295,12951295,'Product 1295','desc','TGB-017',10,20,7,'product-1295',10,25,1,1,1,'2022-03-22 10:37:13','2022-03-22 10:37:13'),(1296,12961296,'Product 1296','DESC','LED-MUSIC',1,125,85,'product-1296',10,25,1,1,1,'2022-03-22 10:37:13','2022-03-22 10:37:13'),(1297,12971297,'Product 1297','Micro Cable','TGB-015',19,20,6,'product-1297',12,24,4,1,1,'2022-03-26 09:25:25','2022-03-31 10:46:48'),(1298,12981298,'Product 1298','Micro Cable','XF-01',3,15,8,'product-1298',12,25,4,1,1,'2022-03-26 09:25:25','2022-03-31 10:46:48'),(1299,12991299,'Product 1299','desc','AE-38',12,25,8,'product-1299',12,25,9,1,1,'2022-03-26 09:25:25','2022-03-26 09:25:25'),(1300,13001300,'Product 1300','4 GB Flash ','KF-04',1,1000,33,'product-1300',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1301,13011301,'Product 1301','Type-c OTG','O-22',5,1000,9,'product-1301',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1302,13021302,'Product 1302','BTS','KB-980',2,1000,119,'product-1302',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1303,13031303,'Product 1303','bts','KB-950',0,1000,163,'product-1303',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-31 10:46:48'),(1304,13041304,'Product 1304','Desc','KB-955',0,1000,170,'product-1304',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-31 10:46:48'),(1305,13051305,'Product 1305','desc','KB-810',3,1000,148,'product-1305',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1306,13061306,'Product 1306','desc','KB-825',3,1000,148,'product-1306',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1307,13071307,'Product 1307','desc','KB-992',3,1000,156,'product-1307',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1308,13081308,'Product 1308','desc','KB-995',2,1000,148,'product-1308',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1309,13091309,'Product 1309','desc','KB-895',1,1000,126,'product-1309',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-31 10:46:48'),(1310,13101310,'Product 1310','desc','KB-915',2,1000,148,'product-1310',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1311,13111311,'Product 1311','desc','KB-855',2,1000,148,'product-1311',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1312,13121312,'Product 1312','descc','KB-815',2,1000,148,'product-1312',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1313,13131313,'Product 1313','desc','KN-60',10,1000,21,'product-1313',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1314,13141314,'Product 1314','desc','QC-50',8,1000,33,'product-1314',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1315,13151315,'Product 1315','desc','KN-60-PD',2,1000,30,'product-1315',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1316,13161316,'Product 1316','desc','KC-55',5,1000,17,'product-1316',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1317,13171317,'Product 1317','desc','KC-50',5,1000,17,'product-1317',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1318,13181318,'Product 1318','desc','DK-150',5,1000,6,'product-1318',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1319,13191319,'Product 1319','desc','DK-152',5,1000,7,'product-1319',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1320,13201320,'Product 1320','desc','KC-182',5,1000,22,'product-1320',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1321,13211321,'Product 1321','desc','KC-180',2,1000,22,'product-1321',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-31 10:46:48'),(1322,13221322,'Product 1322','desc','SM-30',4,1000,13,'product-1322',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-31 10:46:48'),(1323,13231323,'Product 1323','desc','TP-30',5,1000,13,'product-1323',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1324,13241324,'Product 1324','desc','A-10',5,1000,7,'product-1324',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1325,13251325,'Product 1325','desc','A-28',2,1000,15,'product-1325',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1326,13261326,'Product 1326','desc','A-27',2,1000,11,'product-1326',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-26 13:47:42'),(1327,13271327,'Product 1327','desc','KB-985',2,1000,119,'product-1327',11,22,1,1,1,'2022-03-26 13:47:42','2022-03-30 08:34:21');
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_containers`
--

LOCK TABLES `products_containers` WRITE;
/*!40000 ALTER TABLE `products_containers` DISABLE KEYS */;
INSERT INTO `products_containers` VALUES (25,'{\"1284\":{\"id\":1284,\"name\":\"Product 1284\",\"description\":\"Desc\",\"code\":\"torima-bts\",\"amount\":\"6\",\"cost\":\"26\",\"price\":\"50\",\"serial\":\"12841284\",\"category_id\":\"1\",\"brand_id\":\"25\",\"user_id\":1,\"slug\":\"product-1284\",\"created_at\":\"2022-03-22T11:13:24.120336Z\",\"updated_at\":\"2022-03-22T11:13:24.120375Z\"},\"1285\":{\"id\":1285,\"name\":\"Product 1285\",\"description\":\"desc\",\"code\":\"KH-H20\",\"amount\":\"5\",\"cost\":\"13\",\"price\":\"25\",\"serial\":\"12851285\",\"category_id\":\"1\",\"brand_id\":\"25\",\"user_id\":1,\"slug\":\"product-1285\",\"created_at\":\"2022-03-22T11:14:24.338932Z\",\"updated_at\":\"2022-03-22T11:14:24.338969Z\"},\"1286\":{\"id\":1286,\"name\":\"Product 1286\",\"description\":\"desc\",\"code\":\"CB410T\",\"amount\":\"5\",\"cost\":\"10\",\"price\":\"30\",\"serial\":\"12861286\",\"category_id\":\"1\",\"brand_id\":\"25\",\"user_id\":1,\"slug\":\"product-1286\",\"created_at\":\"2022-03-22T11:15:04.566543Z\",\"updated_at\":\"2022-03-22T11:15:04.566561Z\"},\"1287\":{\"id\":1287,\"name\":\"Product 1287\",\"description\":\"desc\",\"code\":\"AE-38\",\"amount\":\"5\",\"cost\":\"8\",\"price\":\"20\",\"serial\":\"12871287\",\"category_id\":\"1\",\"brand_id\":\"25\",\"user_id\":1,\"slug\":\"product-1287\",\"created_at\":\"2022-03-22T11:16:00.499551Z\",\"updated_at\":\"2022-03-22T11:16:00.499573Z\"},\"1288\":{\"id\":1288,\"name\":\"Product 1288\",\"description\":\"desc\",\"code\":\"J5\",\"amount\":\"100\",\"cost\":\"5\",\"price\":\"15\",\"serial\":\"12881288\",\"category_id\":\"1\",\"brand_id\":\"25\",\"user_id\":1,\"slug\":\"product-1288\",\"created_at\":\"2022-03-22T11:16:30.675484Z\",\"updated_at\":\"2022-03-22T11:16:30.675503Z\"},\"1289\":{\"id\":1289,\"name\":\"Product 1289\",\"description\":\"desc\",\"code\":\"K1-32\",\"amount\":\"4\",\"cost\":\"19\",\"price\":\"45\",\"serial\":\"12891289\",\"category_id\":\"1\",\"brand_id\":\"25\",\"user_id\":1,\"slug\":\"product-1289\",\"created_at\":\"2022-03-22T11:17:53.624575Z\",\"updated_at\":\"2022-03-22T11:17:53.624592Z\"},\"1290\":{\"id\":1290,\"name\":\"Product 1290\",\"description\":\"desc\",\"code\":\"TGB\",\"amount\":\"8\",\"cost\":\"9\",\"price\":\"20\",\"serial\":\"12901290\",\"category_id\":\"1\",\"brand_id\":\"24\",\"user_id\":1,\"slug\":\"product-1290\",\"created_at\":\"2022-03-22T11:18:25.842784Z\",\"updated_at\":\"2022-03-22T11:18:25.842817Z\"},\"1291\":{\"id\":1291,\"name\":\"Product 1291\",\"description\":\"desc\",\"code\":\"J2355\",\"amount\":\"5\",\"cost\":\"17\",\"price\":\"40\",\"serial\":\"12911291\",\"category_id\":\"1\",\"brand_id\":\"25\",\"user_id\":1,\"slug\":\"product-1291\",\"created_at\":\"2022-03-22T11:18:56.407241Z\",\"updated_at\":\"2022-03-22T11:18:56.407259Z\"},\"1292\":{\"id\":1292,\"name\":\"Product 1292\",\"description\":\"desc\",\"code\":\"XF-01\",\"amount\":\"5\",\"cost\":\"8\",\"price\":\"10\",\"serial\":\"12921292\",\"category_id\":\"1\",\"brand_id\":\"25\",\"user_id\":1,\"slug\":\"product-1292\",\"created_at\":\"2022-03-22T13:28:56.037103Z\",\"updated_at\":\"2022-03-22T13:28:56.037120Z\"},\"1293\":{\"id\":1293,\"name\":\"Product 1293\",\"description\":\"micro\",\"code\":\"veno-micro\",\"amount\":\"5\",\"cost\":\"7\",\"price\":\"15\",\"serial\":\"12931293\",\"category_id\":\"1\",\"brand_id\":\"25\",\"user_id\":1,\"slug\":\"product-1293\",\"created_at\":\"2022-03-22T13:29:30.457053Z\",\"updated_at\":\"2022-03-22T13:29:30.457071Z\"},\"1294\":{\"id\":1294,\"name\":\"Product 1294\",\"description\":\"desc\",\"code\":\"ASPOR-TC\",\"amount\":\"10\",\"cost\":\"7\",\"price\":\"30\",\"serial\":\"12941294\",\"category_id\":\"1\",\"brand_id\":\"25\",\"user_id\":1,\"slug\":\"product-1294\",\"created_at\":\"2022-03-22T13:30:07.837148Z\",\"updated_at\":\"2022-03-22T13:30:07.837175Z\"},\"1295\":{\"id\":1295,\"name\":\"Product 1295\",\"description\":\"desc\",\"code\":\"TGB-017\",\"amount\":\"10\",\"cost\":\"7\",\"price\":\"20\",\"serial\":\"12951295\",\"category_id\":\"1\",\"brand_id\":\"25\",\"user_id\":1,\"slug\":\"product-1295\",\"created_at\":\"2022-03-22T13:32:32.649197Z\",\"updated_at\":\"2022-03-22T13:32:32.649214Z\"},\"1296\":{\"id\":1296,\"name\":\"Product 1296\",\"description\":\"DESC\",\"code\":\"LED-MUSIC\",\"amount\":\"1\",\"cost\":\"85\",\"price\":\"125\",\"serial\":\"12961296\",\"category_id\":\"1\",\"brand_id\":\"25\",\"user_id\":1,\"slug\":\"product-1296\",\"created_at\":\"2022-03-22T13:33:10.252103Z\",\"updated_at\":\"2022-03-22T13:33:10.252120Z\"}}',1,10,'2022-03-22 07:00:31','2022-03-22 10:37:13'),(26,'{\"1300\":{\"id\":1300,\"name\":\"Product 1300\",\"description\":\"4 GB Flash \",\"code\":\"KF-04\",\"amount\":\"1\",\"cost\":\"33\",\"price\":1000,\"serial\":\"13001300\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1300\",\"created_at\":\"2022-03-26T13:13:50.507189Z\",\"updated_at\":\"2022-03-26T13:13:50.507208Z\"},\"1301\":{\"id\":1301,\"name\":\"Product 1301\",\"description\":\"Type-c OTG\",\"code\":\"O-22\",\"amount\":\"5\",\"cost\":\"9\",\"price\":1000,\"serial\":\"13011301\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1301\",\"created_at\":\"2022-03-26T13:15:08.082194Z\",\"updated_at\":\"2022-03-26T13:15:08.082227Z\"},\"1302\":{\"id\":1302,\"name\":\"Product 1302\",\"description\":\"BTS\",\"code\":\"KB-980\",\"amount\":\"2\",\"cost\":\"119\",\"price\":1000,\"serial\":\"13021302\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1302\",\"created_at\":\"2022-03-26T13:16:02.498678Z\",\"updated_at\":\"2022-03-26T13:16:02.498695Z\"},\"1303\":{\"id\":1303,\"name\":\"Product 1303\",\"description\":\"bts\",\"code\":\"KB-950\",\"amount\":\"3\",\"cost\":\"163\",\"price\":1000,\"serial\":\"13031303\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1303\",\"created_at\":\"2022-03-26T13:16:47.356146Z\",\"updated_at\":\"2022-03-26T13:16:47.356182Z\"},\"1304\":{\"id\":1304,\"name\":\"Product 1304\",\"description\":\"Desc\",\"code\":\"KB-955\",\"amount\":\"3\",\"cost\":\"170\",\"price\":1000,\"serial\":\"13041304\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1304\",\"created_at\":\"2022-03-26T13:17:50.497812Z\",\"updated_at\":\"2022-03-26T13:17:50.497828Z\"},\"1305\":{\"id\":1305,\"name\":\"Product 1305\",\"description\":\"desc\",\"code\":\"KB-810\",\"amount\":\"3\",\"cost\":\"148\",\"price\":1000,\"serial\":\"13051305\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1305\",\"created_at\":\"2022-03-26T13:18:23.200707Z\",\"updated_at\":\"2022-03-26T13:18:23.200726Z\"},\"1306\":{\"id\":1306,\"name\":\"Product 1306\",\"description\":\"desc\",\"code\":\"KB-825\",\"amount\":\"3\",\"cost\":\"148\",\"price\":1000,\"serial\":\"13061306\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1306\",\"created_at\":\"2022-03-26T13:18:55.374311Z\",\"updated_at\":\"2022-03-26T13:18:55.374341Z\"},\"1307\":{\"id\":1307,\"name\":\"Product 1307\",\"description\":\"desc\",\"code\":\"KB-992\",\"amount\":\"3\",\"cost\":\"156\",\"price\":1000,\"serial\":\"13071307\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1307\",\"created_at\":\"2022-03-26T13:19:53.119839Z\",\"updated_at\":\"2022-03-26T13:19:53.119855Z\"},\"1308\":{\"id\":1308,\"name\":\"Product 1308\",\"description\":\"desc\",\"code\":\"KB-995\",\"amount\":\"2\",\"cost\":\"148\",\"price\":1000,\"serial\":\"13081308\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1308\",\"created_at\":\"2022-03-26T13:20:24.854271Z\",\"updated_at\":\"2022-03-26T13:20:24.854291Z\"},\"1309\":{\"id\":1309,\"name\":\"Product 1309\",\"description\":\"desc\",\"code\":\"KB-895\",\"amount\":\"3\",\"cost\":\"126\",\"price\":1000,\"serial\":\"13091309\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1309\",\"created_at\":\"2022-03-26T13:21:05.217684Z\",\"updated_at\":\"2022-03-26T13:21:05.217703Z\"},\"1310\":{\"id\":1310,\"name\":\"Product 1310\",\"description\":\"desc\",\"code\":\"KB-915\",\"amount\":\"2\",\"cost\":\"148\",\"price\":1000,\"serial\":\"13101310\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1310\",\"created_at\":\"2022-03-26T13:21:35.692582Z\",\"updated_at\":\"2022-03-26T13:21:35.692601Z\"},\"1311\":{\"id\":1311,\"name\":\"Product 1311\",\"description\":\"desc\",\"code\":\"KB-855\",\"amount\":\"2\",\"cost\":\"148\",\"price\":1000,\"serial\":\"13111311\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1311\",\"created_at\":\"2022-03-26T13:22:07.708208Z\",\"updated_at\":\"2022-03-26T13:22:07.708225Z\"},\"1312\":{\"id\":1312,\"name\":\"Product 1312\",\"description\":\"descc\",\"code\":\"KB-815\",\"amount\":\"2\",\"cost\":\"148\",\"price\":1000,\"serial\":\"13121312\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1312\",\"created_at\":\"2022-03-26T13:22:34.693086Z\",\"updated_at\":\"2022-03-26T13:22:34.693111Z\"},\"1313\":{\"id\":1313,\"name\":\"Product 1313\",\"description\":\"desc\",\"code\":\"KN-60\",\"amount\":\"10\",\"cost\":\"21\",\"price\":1000,\"serial\":\"13131313\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1313\",\"created_at\":\"2022-03-26T13:23:32.381399Z\",\"updated_at\":\"2022-03-26T13:23:32.381418Z\"},\"1314\":{\"id\":1314,\"name\":\"Product 1314\",\"description\":\"desc\",\"code\":\"QC-50\",\"amount\":\"8\",\"cost\":\"33\",\"price\":1000,\"serial\":\"13141314\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1314\",\"created_at\":\"2022-03-26T13:24:29.347030Z\",\"updated_at\":\"2022-03-26T13:24:29.347046Z\"},\"1315\":{\"id\":1315,\"name\":\"Product 1315\",\"description\":\"desc\",\"code\":\"KN-60-PD\",\"amount\":\"2\",\"cost\":\"30\",\"price\":1000,\"serial\":\"13151315\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1315\",\"created_at\":\"2022-03-26T13:33:42.127170Z\",\"updated_at\":\"2022-03-26T13:33:42.127187Z\"},\"1316\":{\"id\":1316,\"name\":\"Product 1316\",\"description\":\"desc\",\"code\":\"KC-55\",\"amount\":\"5\",\"cost\":\"17\",\"price\":1000,\"serial\":\"13161316\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1316\",\"created_at\":\"2022-03-26T13:34:49.821468Z\",\"updated_at\":\"2022-03-26T13:34:49.821493Z\"},\"1317\":{\"id\":1317,\"name\":\"Product 1317\",\"description\":\"desc\",\"code\":\"KC-50\",\"amount\":\"5\",\"cost\":\"17\",\"price\":1000,\"serial\":\"13171317\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1317\",\"created_at\":\"2022-03-26T13:35:54.422553Z\",\"updated_at\":\"2022-03-26T13:35:54.422586Z\"},\"1318\":{\"id\":1318,\"name\":\"Product 1318\",\"description\":\"desc\",\"code\":\"DK-150\",\"amount\":\"5\",\"cost\":\"6\",\"price\":1000,\"serial\":\"13181318\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1318\",\"created_at\":\"2022-03-26T13:39:08.812964Z\",\"updated_at\":\"2022-03-26T13:39:08.812982Z\"},\"1319\":{\"id\":1319,\"name\":\"Product 1319\",\"description\":\"desc\",\"code\":\"DK-152\",\"amount\":\"5\",\"cost\":\"7\",\"price\":1000,\"serial\":\"13191319\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1319\",\"created_at\":\"2022-03-26T13:39:52.581982Z\",\"updated_at\":\"2022-03-26T13:39:52.582000Z\"},\"1320\":{\"id\":1320,\"name\":\"Product 1320\",\"description\":\"desc\",\"code\":\"KC-182\",\"amount\":\"5\",\"cost\":\"22\",\"price\":1000,\"serial\":\"13201320\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1320\",\"created_at\":\"2022-03-26T13:40:30.112354Z\",\"updated_at\":\"2022-03-26T13:40:30.112385Z\"},\"1321\":{\"id\":1321,\"name\":\"Product 1321\",\"description\":\"desc\",\"code\":\"KC-180\",\"amount\":\"5\",\"cost\":\"22\",\"price\":1000,\"serial\":\"13211321\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1321\",\"created_at\":\"2022-03-26T13:41:57.865006Z\",\"updated_at\":\"2022-03-26T13:41:57.865071Z\"},\"1322\":{\"id\":1322,\"name\":\"Product 1322\",\"description\":\"desc\",\"code\":\"SM-30\",\"amount\":\"5\",\"cost\":\"13\",\"price\":1000,\"serial\":\"13221322\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1322\",\"created_at\":\"2022-03-26T13:42:39.492340Z\",\"updated_at\":\"2022-03-26T13:42:39.492356Z\"},\"1323\":{\"id\":1323,\"name\":\"Product 1323\",\"description\":\"desc\",\"code\":\"TP-30\",\"amount\":\"5\",\"cost\":\"13\",\"price\":1000,\"serial\":\"13231323\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1323\",\"created_at\":\"2022-03-26T13:43:31.740855Z\",\"updated_at\":\"2022-03-26T13:43:31.740873Z\"},\"1324\":{\"id\":1324,\"name\":\"Product 1324\",\"description\":\"desc\",\"code\":\"A-10\",\"amount\":\"5\",\"cost\":\"7\",\"price\":1000,\"serial\":\"13241324\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1324\",\"created_at\":\"2022-03-26T13:44:52.811042Z\",\"updated_at\":\"2022-03-26T13:44:52.811059Z\"},\"1325\":{\"id\":1325,\"name\":\"Product 1325\",\"description\":\"desc\",\"code\":\"A-28\",\"amount\":\"2\",\"cost\":\"15\",\"price\":1000,\"serial\":\"13251325\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1325\",\"created_at\":\"2022-03-26T13:46:14.535905Z\",\"updated_at\":\"2022-03-26T13:46:14.535925Z\"},\"1326\":{\"id\":1326,\"name\":\"Product 1326\",\"description\":\"desc\",\"code\":\"A-27\",\"amount\":\"2\",\"cost\":\"11\",\"price\":1000,\"serial\":\"13261326\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1326\",\"created_at\":\"2022-03-26T13:46:53.752101Z\",\"updated_at\":\"2022-03-26T13:46:53.752138Z\"},\"1327\":{\"id\":1327,\"name\":\"Product 1327\",\"description\":\"desc\",\"code\":\"KB-985\",\"amount\":\"2\",\"cost\":\"119\",\"price\":1000,\"serial\":\"13271327\",\"category_id\":\"1\",\"brand_id\":\"22\",\"user_id\":1,\"slug\":\"product-1327\",\"created_at\":\"2022-03-26T13:47:41.224836Z\",\"updated_at\":\"2022-03-26T13:47:41.224854Z\"}}',1,11,'2022-03-24 07:47:01','2022-03-30 08:33:46'),(27,'{\"1297\":{\"id\":1297,\"name\":\"Product 1297\",\"description\":\"Micro Cable\",\"code\":\"TGB-015\",\"amount\":\"20\",\"cost\":\"6\",\"price\":\"20\",\"serial\":\"12971297\",\"category_id\":\"4\",\"brand_id\":\"24\",\"user_id\":1,\"slug\":\"product-1297\",\"created_at\":\"2022-03-26T12:22:55.375304Z\",\"updated_at\":\"2022-03-26T12:22:55.375343Z\"},\"1298\":{\"id\":1298,\"name\":\"Product 1298\",\"description\":\"Micro Cable\",\"code\":\"XF-01\",\"amount\":\"9\",\"cost\":\"8\",\"price\":\"15\",\"serial\":\"12981298\",\"category_id\":\"4\",\"brand_id\":\"25\",\"user_id\":1,\"slug\":\"product-1298\",\"created_at\":\"2022-03-26T12:24:07.362387Z\",\"updated_at\":\"2022-03-26T12:24:07.362421Z\"},\"1299\":{\"id\":1299,\"name\":\"Product 1299\",\"description\":\"desc\",\"code\":\"AE-38\",\"amount\":\"12\",\"cost\":\"8\",\"price\":\"25\",\"serial\":\"12991299\",\"category_id\":\"9\",\"brand_id\":\"25\",\"user_id\":1,\"slug\":\"product-1299\",\"created_at\":\"2022-03-26T12:24:47.318813Z\",\"updated_at\":\"2022-03-26T12:24:47.318846Z\"}}',1,12,'2022-03-26 09:22:00','2022-03-26 09:25:25');
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
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (2,190,155,1,190,35,1,1091,1,'2022-02-12 21:00:00','2022-02-17 11:08:08','Description'),(3,20,9,2,40,22,1,1001,1,'2022-02-12 21:00:00','2022-02-17 11:08:08','Description'),(4,50,25,1,50,25,1,1080,1,'2022-02-12 21:00:00','2022-02-17 11:08:08','Description'),(5,210,148,1,210,62,1,1090,1,'2022-02-12 21:00:00','2022-02-17 11:08:08','Description'),(6,30,13,1,30,17,1,1037,1,'2022-02-12 21:00:00','2022-02-17 11:08:08','Description'),(7,75,48,1,75,27,1,1010,1,'2022-02-12 21:00:00','2022-02-17 11:08:08','Description'),(8,48,0,1,48,48,1,1,1,'2022-02-12 21:00:00','2022-02-17 11:08:08','14-02-2022\nkontor\n'),(9,47,0,1,47,47,1,1,1,'2022-02-12 21:00:00','2022-02-17 11:08:08','14-02-2022\nkontor\n'),(13,5,0,1,5,5,1,1,1,'2022-02-15 21:00:00','2022-02-17 11:09:59','Fatura'),(14,15,6,1,15,9,1,1104,1,'2022-02-15 21:00:00','2022-02-17 11:09:59','Description'),(15,20,10,1,20,10,1,1060,1,'2022-02-15 21:00:00','2022-02-17 11:09:59','Description'),(16,40,0,1,40,40,1,1,1,'2022-02-15 21:00:00','2022-02-17 11:13:12','Laptop Battary Replacment'),(17,10,0,1,10,10,1,1,1,'2022-02-15 21:00:00','2022-02-17 11:18:50','bluetooth reparement'),(20,55,52,1,55,3,1,1,1,'2022-02-17 15:31:54','2022-02-17 15:31:54','kontor: 	531 235 13 53'),(21,10,2,1,10,8,1,1,1,'2022-02-17 06:37:14','2022-02-17 06:37:14','Phone Screen \nModel: Nova 3i'),(22,85,75,1,85,10,1,1,1,'2022-02-17 06:37:14','2022-02-17 06:37:14','Freefire: 795 d, ID: 1894967809'),(23,140,135,1,140,5,1,1,1,'2022-02-18 08:58:48','2022-02-18 08:58:48','538 207 34 96 , Mutlu Firsat 21 GB, Kontor + 50 TL'),(24,75,71,1,75,4,1,1,1,'2022-02-18 08:58:48','2022-02-18 08:58:48','538 778 14 29, Net 12 GB pos, kontor'),(25,50,39,1,50,11,1,1,1,'2022-02-18 08:58:48','2022-02-18 08:58:48','	552 830 91 95, BAL 2GB	'),(26,25,11,1,25,14,1,1002,1,'2022-02-18 08:58:48','2022-02-18 08:58:48','Description'),(27,1240,1232,1,1240,8,1,1,1,'2022-02-18 08:58:48','2022-02-18 08:58:48','Fatura ID: 91'),(28,15,7,1,15,8,1,1126,1,'2022-02-18 08:58:48','2022-02-18 08:58:48','Description'),(29,330,320,1,330,10,1,1,1,'2022-02-18 08:58:48','2022-02-18 08:58:48','538 422 61 85,  Mutlu Mega 70GB✅✅'),(30,10,5,1,10,5,1,1,1,'2022-02-18 08:58:48','2022-02-18 08:58:48','Old debt abu gamal 15  whatsapp number'),(31,50,0,1,50,50,1,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03','Helping With getting money'),(32,15,0,1,15,15,1,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03','reparing headphone'),(33,45,26,1,45,19,1,1130,1,'2022-02-20 14:07:03','2022-02-20 14:07:03','Description'),(34,80,71,2,160,18,1,1,1,'2022-02-20 14:07:03','2022-02-20 14:07:03','likee 240 di'),(35,50,40,1,50,10,1,1,1,'2022-02-19 14:07:03','2022-02-19 14:07:03','Replace new Sim'),(36,65,62,1,65,3,1,1,1,'2022-02-19 14:07:03','2022-02-19 14:07:03','5356596426 Mutlu 7 GB✅✅'),(37,190,148,1,190,42,1,1090,1,'2022-02-20 15:40:36','2022-02-20 15:40:36','Description'),(38,65,54,1,65,11,1,1,1,'2022-02-20 15:40:36','2022-02-20 15:40:36','Selfy Sosyal X Large	\n\n5528651214'),(39,85,77,1,85,8,1,1,1,'2022-02-20 15:40:36','2022-02-20 15:40:36','Mutlu Firsat 12 GB	 \n 5312678253 + 14 TL'),(40,190,156,1,190,34,1,1019,1,'2022-02-21 08:06:41','2022-02-21 08:06:41','Description'),(41,190,156,1,190,34,1,1019,1,'2022-02-21 08:06:41','2022-02-21 08:06:41','Description'),(42,140,108,1,140,32,1,1088,1,'2022-02-22 15:19:56','2022-02-22 15:19:56','Description'),(44,80,71,1,80,9,1,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56','GNC NET 16GB pos\n5395924470'),(45,240,234,1,240,6,1,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56','Fatur Koski / 245778\n1- 87,00₺\nVADE\n02/03/2022\n2- 81,84₺\nVADE\n31/01/2022\n3- 65,68₺\nVADE\n28/12/2021'),(46,5,0,1,5,5,1,1,1,'2022-02-22 15:19:56','2022-02-22 15:19:56','HES Kodu'),(47,25,13,1,25,12,1,1053,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(48,15,12,1,15,3,1,1113,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Toptan'),(49,16,14,1,16,2,1,1125,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Toptan'),(50,30,23,1,30,7,1,1014,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Toptan'),(51,11,9,4,44,8,1,1001,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Toptan'),(52,15,11,2,30,8,1,1054,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Toptan'),(53,15,13,2,30,4,1,1053,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Toptan'),(54,45,37,1,45,8,1,1040,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Toptan'),(55,8,7,2,16,2,1,1126,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Toptan'),(56,140,124,2,280,32,1,1095,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Toptan'),(57,100,88,1,100,12,1,1152,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Toptan'),(58,100,81,1,100,19,1,1151,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Toptan'),(59,100,88,1,100,12,1,1131,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Toptan'),(60,25,20,2,50,10,1,1141,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Toptan'),(61,10,0,1,10,10,1,1,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Router Reparement\n'),(62,65,57,1,65,8,1,1,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','GNC Mutlu 8 GB\n5386517081'),(63,150,138,1,150,12,1,1139,1,'2022-02-23 06:20:47','2022-02-23 06:20:47','Description'),(64,10,0,1,10,10,1,1,1,'2022-02-24 09:11:52','2022-02-24 09:12:14','Create Google Account'),(65,15,4,1,15,11,1,1,1,'2022-03-01 08:06:32','2022-03-01 08:06:54','A10 Screen'),(66,65,56,1,65,9,1,1,1,'2022-03-01 08:05:30','2022-03-01 08:05:58','kontor 	Mutlu Firsat 9 GB	Ahmad omer	5314522287'),(67,55,51,1,55,4,1,1,1,'2022-02-28 12:48:39','2022-02-28 12:49:08','Kontor 	50 TL	Ahmad omer	5422688879'),(68,8,8,2,16,0,1,1161,1,'2022-02-28 07:46:28','2022-02-28 07:46:41','Description'),(69,15,15,2,30,0,1,1160,1,'2022-02-28 07:44:16','2022-02-28 07:44:30','Description'),(70,15,5,1,15,10,1,1049,1,'2022-02-28 07:16:47','2022-02-28 07:16:53','Description'),(71,15,5,1,15,10,1,1070,1,'2022-02-28 07:13:53','2022-02-28 07:14:17','Date is between 24/02 and 27/02\n'),(72,20,12,5,100,40,1,1,1,'2022-02-28 06:54:34','2022-02-28 07:00:57','84341	LİKEE 36 ELMAS	5353402539\n0537672639w'),(73,50,42,1,50,8,1,1,1,'2022-02-28 06:54:33','2022-02-28 06:55:44','Kontor	Super 10GB	Ahmad omer	5396719604'),(74,40,34,1,40,6,1,1,1,'2022-02-28 06:54:31','2022-02-28 06:54:59','Kontor Ahlan Yeni 4 GB Indirimsiz Paketi	Ahmad omer	5550889973'),(75,100,91,1,100,9,1,1,1,'2022-03-01 14:43:42','2022-03-01 14:44:03','Kontor 	Net 21 GB pos ✅✅	Ahmad omer	5392374965'),(76,15,6,1,15,9,1,1004,1,'2022-03-01 13:35:01','2022-03-01 13:35:08','Description'),(77,70,61,1,70,9,1,1,1,'2022-03-01 13:33:12','2022-03-01 13:34:46','kontor Net 8 GB pos ✅✅	Ahmad omer	5376133364'),(78,60,51,1,60,9,1,1,1,'2022-03-01 13:33:13','2022-03-01 13:34:24','kontor	50 TL	Ahmad omer	5392374965'),(79,60,48,1,60,12,1,1,1,'2022-03-01 13:33:11','2022-03-01 13:33:55','kontor 	RAKIPSIZ 12GB.	Ahmad omer	5013775390	48,00'),(80,0,0,1,0,0,1,1,1,'2022-03-01 13:33:11','2022-03-01 13:33:11','Description'),(81,20,11,1,20,9,1,1,1,'2022-03-01 11:11:17','2022-03-01 11:11:45','	84776	LİKEE 36 ELMAS	5353402539\n0537672639w'),(82,440,435,1,440,5,1,1,1,'2022-03-01 09:52:16','2022-03-01 09:52:53','Enerya 030001087231'),(83,70,61,1,70,9,1,1,1,'2022-03-01 09:38:25','2022-03-01 09:39:08','Kontor Mutlu Firsat 12 GB	Ahmad omer	5378794450'),(84,55,51,1,55,4,1,1,1,'2022-03-01 09:38:15','2022-03-01 09:38:46','Kontor 	50 TL	Ahmad omer	5378794450'),(85,10,4,1,10,6,1,1,1,'2022-03-02 14:23:47','2022-03-02 14:26:07','Note 9 Pro'),(86,70,60,1,70,10,1,1,1,'2022-03-02 14:23:48','2022-03-02 14:25:26','kontor 	Mutlu Firsat 12 GB	عمر كرمان++شمس	5352959369'),(87,70,60,1,70,10,1,1,1,'2022-03-02 14:23:49','2022-03-02 14:24:53','kontor	Mutlu Firsat 12 GB	عمر كرمان++شمس	5398300514'),(88,75,65,1,75,10,1,1,1,'2022-03-02 14:23:46','2022-03-02 14:24:26','kontor GNC Mutlu 12 GB	عمر كرمان++شمس	5393197957'),(89,60,50,1,60,10,1,1,1,'2022-03-04 14:33:56','2022-03-04 14:34:24','Kontor NC Mutlu 5 GB	عمر كرمان++شمس	5367918805'),(90,60,55,1,60,5,1,1,1,'2022-03-04 12:51:23','2022-03-04 12:53:01','kontor 	GNC Mutlu 8 GB	عمر كرمان++شمس	5377490740'),(91,85,73,1,85,12,1,1,1,'2022-03-04 12:51:28','2022-03-04 12:52:02','kontor \n85549	LİKEE 240 ELMAS	5353402539\n340944185'),(92,45,27,1,45,18,1,1045,1,'2022-03-04 12:19:31','2022-03-04 12:19:39','Description'),(93,35,13,1,35,22,1,1052,1,'2022-03-04 11:49:50','2022-03-04 11:49:56','Description'),(94,40,25,1,40,15,1,1119,1,'2022-03-04 11:09:02','2022-03-04 11:09:07','Description'),(95,3,0,1,3,3,1,1,1,'2022-03-04 08:34:49','2022-03-04 08:35:08','Fatura Elektrik / 1037079'),(96,20,5,1,20,15,1,1121,1,'2022-03-03 14:03:08','2022-03-03 14:03:23','Description'),(97,30,11,1,30,19,1,1129,1,'2022-03-03 13:00:47','2022-03-03 13:00:47','Description'),(98,10,4,1,10,6,1,1156,1,'2022-03-06 15:09:55','2022-03-06 15:09:55','Description'),(99,15,5,1,15,10,1,1049,1,'2022-03-06 15:08:57','2022-03-06 15:09:02','Description'),(100,55,50,1,55,5,1,1,1,'2022-03-06 14:24:11','2022-03-06 14:25:03','kontor 50 TL	Ahmad omer	5346645007'),(101,70,60,1,70,10,1,1,1,'2022-03-06 14:24:05','2022-03-06 14:24:33','kontor 	Mutlu Firsat 12 GB	عمر كرمان++شمس	5346645007'),(103,50,46,1,50,4,1,1,1,'2022-03-06 14:18:43','2022-03-06 14:21:13','Kontor Ahlan Yeni 8 GB Indirimsiz Paketi	عمر كرمان++شمس	5528953988'),(104,50,46,1,50,4,1,1,1,'2022-03-06 14:18:45','2022-03-06 14:20:51','kontor Ahlan Yeni 8 GB Indirimsiz Paketi	عمر كرمان++شمس	5364634620'),(105,70,60,1,70,10,1,1,1,'2022-03-06 14:18:47','2022-03-06 14:20:21','Kontor ALO DUNYA 1 SAAT	عمر كرمان++شمس	5350311124	60,00'),(106,65,56,1,65,9,1,1,1,'2022-03-06 14:18:48','2022-03-06 14:19:55','Kontor FIRSAT YENİ 8GB	عمر كرمان++شمس	5399831042'),(107,70,60,1,70,10,1,1,1,'2022-03-06 14:18:49','2022-03-06 14:19:32','Kontor Mutlu 7 GB	عمر كرمان++شمس	5380857995'),(108,55,45,1,55,10,1,1,1,'2022-03-06 10:05:07','2022-03-06 10:05:29','kontor KOLAY PAKET 5 GB 500DK 250sms	عمر كرمان++شمس	5441440439'),(109,20,9,1,20,11,1,1,1,'2022-03-06 07:52:15','2022-03-06 07:52:50','Kapak note 9 '),(110,60,50,1,60,10,1,1,1,'2022-03-06 06:30:04','2022-03-06 06:31:07','Kontor	Mutlu 7 GB	TURKCELL	5350311124'),(111,70,60,1,70,10,1,1,1,'2022-03-06 06:30:02','2022-03-06 06:30:33','Kontor 	Mutlu Firsat 12 GB	عمر كرمان++شمس	5350311124'),(112,150,145,1,150,5,1,1138,1,'2022-03-06 05:46:30','2022-03-06 05:47:53','Toptan'),(113,158,150,1,158,8,1,1158,1,'2022-03-06 05:46:43','2022-03-06 05:47:46','Toptan'),(114,145,138,1,145,7,1,1135,1,'2022-03-06 05:46:38','2022-03-06 05:47:36','Toptan'),(115,142,135,1,142,7,1,1094,1,'2022-03-06 05:44:44','2022-03-06 05:46:23','Toptan'),(116,60,53,1,60,7,1,1,1,'2022-03-06 05:39:25','2022-03-06 05:39:48','kontor Süper 15GB	Ahmad omer	5528204767'),(117,100,98,1,100,2,1,1073,1,'2022-03-05 10:22:33','2022-03-05 10:22:33','Toptan'),(118,15,4,1,15,11,1,1,1,'2022-03-07 13:02:24','2022-03-07 13:02:53','Note 9s screen'),(119,65,60,1,65,5,1,1,1,'2022-03-07 09:02:51','2022-03-07 09:03:25','Kontor 	Mutlu Firsat 12 GB	عمر كرمان++شمس	5312351353\n'),(120,3,0,1,3,3,1,1,1,'2022-03-07 06:52:46','2022-03-07 06:53:04','Fatura Elektrik / 1037079'),(121,70,60,1,70,10,1,1,1,'2022-03-08 13:08:05','2022-03-08 13:08:25','Kontor 	Mutlu Firsat 12 GB	عمر كرمان++شمس	5358192000'),(122,100,100,1,100,0,1,1089,1,'2022-03-08 13:07:06','2022-03-08 13:07:06','Toptan'),(123,130,117,1,130,13,1,1137,1,'2022-03-08 13:06:50','2022-03-08 13:06:54','Toptan'),(124,170,158,1,170,12,1,1091,1,'2022-03-08 13:06:36','2022-03-08 13:06:44','Toptan'),(125,100,81,1,100,19,1,1151,1,'2022-03-08 13:06:22','2022-03-08 13:06:27','Toptan'),(126,75,70,1,75,5,1,1128,1,'2022-03-08 13:06:05','2022-03-08 13:06:12','Toptan'),(127,125,70,1,125,55,1,1128,1,'2022-03-08 10:32:34','2022-03-08 10:32:34','Description'),(128,65,61,1,65,4,1,1,1,'2022-03-08 10:31:29','2022-03-08 10:32:15','Kontor Mutlu Firsat 12 GB	Ahmad omer	5395660635'),(129,75,65,1,75,10,1,1,1,'2022-03-08 10:31:31','2022-03-08 10:31:50','Kontor 	Mutlu Firsat 13 GB	عمر كرمان++شمس	5365456132'),(130,85,80,1,85,5,1,1,1,'2022-03-10 06:44:30','2022-03-10 06:44:54','kontor 	Mutlu Firsat 19 GB	عمر كرمان++شمس	5353424520'),(131,60,50,1,60,10,1,1,1,'2022-03-09 14:00:02','2022-03-09 14:00:17','55	Google Play Kart 50TL	5353402539'),(132,235,220,1,235,15,1,1,1,'2022-03-09 13:59:14','2022-03-09 13:59:36','kontor Mutlu Mega 35 GB	عمر كرمان++شمس	5397333490\n'),(133,70,60,1,70,10,1,1,1,'2022-03-10 12:59:51','2022-03-10 13:00:57','kontor 	Mutlu Firsat 12 GB	عمر كرمان++شمس	5525013933'),(134,25,13,1,25,12,1,1053,1,'2022-03-10 13:00:13','2022-03-10 13:00:17','Description'),(135,85,77,1,85,8,1,1,1,'2022-03-13 08:04:31','2022-03-13 08:05:02','kontor 	88713	LİKEE 240 ELMAS	5353402539\n0537672639w'),(136,9,0,1,9,9,1,1,1,'2022-03-12 15:37:42','2022-03-12 15:37:58','Fatura 100	\n1100\n3\n2022-03-12 21:24:18'),(137,20,0,1,20,20,1,1,1,'2022-03-12 14:26:12','2022-03-12 14:26:58','Fatura 97	\n1097\n8\n2022-03-10 19:55:33'),(138,9,0,1,9,9,1,1,1,'2022-03-12 14:26:12','2022-03-12 14:26:27','Fatura 98	\n1098\n3\n2022-03-12 14:57:19'),(139,6,0,1,6,6,1,1,1,'2022-03-12 10:00:41','2022-03-12 14:26:07','Fatura 99	\n1099\n2\n2022-03-12 17:32:59'),(140,185,117,1,185,68,1,1137,1,'2022-03-12 10:15:12','2022-03-12 10:15:19','Description'),(141,50,23,1,50,27,1,1014,1,'2022-03-12 10:00:49','2022-03-12 10:00:55','Description'),(142,20,5,1,20,15,1,1121,1,'2022-03-13 11:18:43','2022-03-13 11:19:05','Description'),(143,30,13,1,30,17,1,1018,1,'2022-03-13 10:57:18','2022-03-13 10:57:25','Description'),(144,60,45,1,60,15,1,1,1,'2022-03-13 09:11:56','2022-03-13 09:13:32','Kontor ALO DÜNYA 30 DAKİKA	عمر كرمان++شمس	5363084012'),(145,170,158,1,170,12,1,1091,1,'2022-03-13 08:47:50','2022-03-13 09:11:28','Description'),(146,20,6,1,20,14,1,1004,1,'2022-03-13 08:44:18','2022-03-13 09:11:22','Description'),(147,150,67,1,150,83,1,1023,1,'2022-03-13 08:37:46','2022-03-13 09:11:16','Description'),(148,75,65,1,75,10,1,1,1,'2022-03-14 14:21:57','2022-03-14 14:22:13','kontor Mutlu Firsat 13 GB	عمر كرمان++شمس	5384307712'),(149,155,146,1,155,9,1,1,1,'2022-03-14 13:03:46','2022-03-14 13:04:38','kontor 89378	AHLAN 5000 COİNS	5383811126\n4903840'),(150,10,0,1,10,10,1,1,1,'2022-03-14 13:03:47','2022-03-14 13:04:03','Router Password'),(151,305,296,1,305,9,1,1,1,'2022-03-14 07:12:10','2022-03-14 07:12:31','kontor 89191	AHLAN 10000 COİNS	5383811126\n4903840'),(152,3,0,1,3,3,1,1,1,'2022-03-14 07:11:30','2022-03-14 07:11:54','Fatura 104	\n1101\n5\n2022-03-14 13:09:42'),(153,100,0,1,100,100,1,1,1,'2022-03-15 15:20:27','2022-03-15 15:22:01','binance'),(154,85,74,1,85,11,1,1,1,'2022-03-15 15:20:29','2022-03-15 15:21:24','kontor 89782	AHLAN 2500 COİNS	5353402539\n4928582'),(155,40,30,1,40,10,1,1,1,'2022-03-15 15:20:26','2022-03-15 15:20:57','kontor 	89781	AHLAN 1000 COİNS	5383811126\n4903840'),(156,160,160,1,160,0,1,1180,1,'2022-03-15 10:32:41','2022-03-15 10:33:21','Description'),(157,10,10,1,10,0,1,1100,1,'2022-03-15 10:33:05','2022-03-15 10:33:16','Description'),(158,85,56,1,85,29,1,1063,1,'2022-03-15 07:59:28','2022-03-15 07:59:37','Description'),(159,245,230,1,245,15,1,1,1,'2022-03-16 13:13:24','2022-03-16 13:14:33','kontor 90117	AHLAN 7500 COİNS	5353402539\n4870800'),(160,40,30,1,40,10,1,1,1,'2022-03-16 13:13:23','2022-03-16 13:14:03','kontor 90119	AHLAN 1000 COİNS	5353402539\n4928582'),(161,35,18,1,35,17,1,1164,1,'2022-03-16 08:30:48','2022-03-16 08:31:16','Description'),(162,70,48,1,70,22,1,1010,1,'2022-03-16 08:29:04','2022-03-16 08:30:56','Description'),(163,85,74,1,85,11,1,1,1,'2022-03-16 06:16:32','2022-03-16 06:16:59','Kontor 89912	AHLAN 2500 COİNS	5353402539\n4903840\n'),(164,85,74,1,85,11,1,1,1,'2022-03-18 10:43:52','2022-03-18 10:44:45','kontor 	90481	AHLAN 2500 COİNS	5353402539\n4903840'),(165,50,40,1,50,10,1,1,1,'2022-03-18 10:43:50','2022-03-18 10:44:17','kontor 	90461	LİKEE 116ELMAS	5353402539\n0537672639w'),(166,85,74,1,85,11,1,1,1,'2022-03-17 11:07:22','2022-03-17 11:08:02','kontor 	90407	AHLAN 2500 COİNS	5353402539\n4903840'),(167,20,14,1,20,6,1,1,1,'2022-03-17 10:02:28','2022-03-17 10:02:48','kontor 	14.00 TL	عمر كرمان++شمس	5345044002\n'),(168,158,145,1,158,13,1,1138,1,'2022-03-18 13:04:59','2022-03-19 07:28:56','Toptan'),(169,149,138,1,149,11,1,1136,1,'2022-03-18 13:05:14','2022-03-19 07:28:46','Toptan'),(170,35,13,1,35,22,1,1037,1,'2022-03-18 13:38:52','2022-03-18 13:39:00','Description'),(171,138,131,1,138,7,1,1087,1,'2022-03-18 13:05:20','2022-03-18 13:06:15','Toptan'),(172,146,138,1,146,8,1,1135,1,'2022-03-18 13:05:34','2022-03-18 13:05:59','Toptan'),(173,85,74,1,85,11,1,1,1,'2022-03-18 10:48:21','2022-03-18 10:49:06','kontor 	90668	AHLAN 2500 COİNS	5353402539\n4903840'),(174,40,29,1,40,11,1,1,1,'2022-03-18 10:47:20','2022-03-18 10:48:16','kontor 	90644	AHLAN 1000 COİNS	5353402539\n4903840'),(175,55,48,1,55,7,1,1,1,'2022-03-18 10:47:18','2022-03-18 10:47:40','kontor 	Dünya 1 Saat	Ahmad omer	5431349571'),(176,220,151,1,220,69,1,1090,1,'2022-03-19 13:41:38','2022-03-19 13:41:46','Description'),(177,30,20,1,30,10,1,1141,1,'2022-03-19 13:41:20','2022-03-19 13:41:25','Description'),(179,175,151,1,175,24,1,1090,1,'2022-03-19 13:26:49','2022-03-19 13:30:44','Toptan'),(180,85,74,1,85,11,1,1,1,'2022-03-19 13:20:10','2022-03-19 13:20:37','kontor 	91219	AHLAN 2500 COİNS	5353402539\n4928582'),(181,20,7,1,20,13,1,1126,1,'2022-03-19 13:18:41','2022-03-19 13:18:49','Description'),(182,305,293,1,305,12,1,1,1,'2022-03-19 11:47:39','2022-03-19 11:48:51','kontor 91119	AHLAN 10000 COİNS	5353402539\n4903840'),(183,10,0,1,10,10,1,1,1,'2022-03-19 09:09:28','2022-03-19 09:10:12','Phone repearing'),(184,20,6,1,20,14,1,1004,1,'2022-03-19 09:09:43','2022-03-19 09:09:51','Description'),(185,3,0,1,3,3,1,1,1,'2022-03-19 07:51:47','2022-03-19 07:52:03','fatura 168	\nTurktelekom / 7029738374\n114\n1\n2022-03-19 13:50:36'),(186,220,151,1,220,69,1,1090,1,'2022-03-20 13:53:38','2022-03-20 13:53:43','Description'),(187,10,0,1,10,10,1,1,1,'2022-03-20 12:22:55','2022-03-20 12:23:08','kontor Mutlu Mega 70GB✅✅	Ahmad omer	5393197957'),(188,10,0,1,10,10,1,1,1,'2022-03-20 10:29:40','2022-03-20 10:30:01','Kontor 	Mutlu Firsat 21 GB	عمر كرمان++شمس	5355477780'),(189,15,12,1,15,3,1,1113,1,'2022-03-20 09:52:49','2022-03-20 09:53:06','Yasser Toptan\n'),(190,25,20,2,50,10,1,1141,1,'2022-03-20 09:51:57','2022-03-20 09:52:39','Yasser Toptan'),(191,145,131,1,145,14,1,1132,1,'2022-03-20 09:50:19','2022-03-20 09:52:33','Yasser Toptan\n'),(192,5,0,1,5,5,1,1,1,'2022-03-20 09:49:43','2022-03-20 09:49:57','Kontor 	Mutlu Firsat 12 GB	عمر كرمان++شمس	5387328672'),(193,17,13,2,34,8,1,1186,1,'2022-03-20 08:26:04','2022-03-20 08:28:04','Yasser Toptan\n'),(194,17,15,1,17,2,1,1160,1,'2022-03-20 08:26:14','2022-03-20 08:27:58','Yasser Toptan'),(195,5,0,1,5,5,1,1,1,'2022-03-20 08:25:22','2022-03-20 08:25:40','Kontor 	اسبوعية Hızlı 10 GB	Ahmad omer	5528384964'),(196,10,0,1,10,10,1,1,1,'2022-03-21 11:09:17','2022-03-23 09:19:52','kontor Mutlu Firsat 13 GB	عمر كرمان++شمس	 5365047398'),(197,20,9,1,20,11,1,1290,1,'2022-03-22 15:11:01','2022-03-22 15:11:01','Description'),(198,45,31,1,45,14,1,1011,1,'2022-03-22 15:10:43','2022-03-22 15:10:49','Description'),(199,35,11,1,35,24,1,1054,1,'2022-03-22 09:39:41','2022-03-22 09:40:04','Description'),(200,4,0,1,4,4,1,1,1,'2022-03-22 06:04:42','2022-03-22 06:05:41','kontor 92063	Google Play Kart 25TL	5353402539'),(201,4,0,1,4,4,1,1,1,'2022-03-22 06:04:39','2022-03-22 06:05:26','kontor 	92061	Google Play Kart 100TL	5353402539'),(202,2,0,1,2,2,1,1,1,'2022-03-21 11:09:15','2022-03-21 11:10:27','kontor 	14.00 TL	عمر كرمان++شمس	5342557544'),(203,3,0,1,3,3,1,1,1,'2022-03-21 11:09:16','2022-03-21 11:10:08','kontor 	14.00 TL	عمر كرمان++شمس	5342557544'),(204,14,0,1,14,14,1,1,1,'2022-03-21 10:07:19','2022-03-21 10:07:35','kontor 91834	AHLAN 5000 COİNS	5353402539\n4903840'),(205,15,0,1,15,15,1,1,1,'2022-03-21 08:19:53','2022-03-21 08:20:11','kontor 91790	AHLAN 25000 COİNS	5353402539\n4903840'),(206,12,0,1,12,12,1,1,1,'2022-03-21 06:27:04','2022-03-21 06:27:44','kontor 	91750	AHLAN 10000 COİNS	5353402539\n4903840'),(207,12,0,1,12,12,1,1,1,'2022-03-21 06:27:02','2022-03-21 06:27:32','kontor 91744	AHLAN 10000 COİNS	5353402539\n4903840'),(208,14,0,1,14,14,1,1,1,'2022-03-21 06:26:20','2022-03-21 06:26:52','kontor 91740	AHLAN 5000 COİNS	5353402539\n4903840'),(209,7,0,1,7,7,1,1,1,'2022-03-25 08:20:31','2022-03-25 08:20:57','kontor 	92999	AHLAN 10000 COİNS	5353402539\n4903840 293'),(210,12,0,1,12,12,1,1,1,'2022-03-24 13:42:27','2022-03-24 13:42:49','kontor 92924	AHLAN 10000 COİNS	5353402539\n4903840 | 293\n'),(211,9,0,1,9,9,1,1,1,'2022-03-24 08:21:11','2022-03-24 08:21:24','kontor 	92823	PUBG Mobile 325 UC	\n51011482957 61'),(212,12,0,1,12,12,1,1,1,'2022-03-24 07:31:21','2022-03-24 07:32:53','kontor 92795	AHLAN 10000 COİNS	5353402539\n4903840 | 293'),(213,12,0,1,12,12,1,1,1,'2022-03-23 14:44:54','2022-03-23 14:45:13','kontor 581	AHLAN 10000 COİNS	5353402539\n4903840'),(214,10,0,1,10,10,1,1,1,'2022-03-23 14:43:14','2022-03-23 14:44:25','kontor BAL 8GB	Ahmad omer	5013775390	55,00'),(215,9,0,1,9,9,1,1,1,'2022-03-23 14:44:04','2022-03-23 14:44:19','kontor Mutlu Firsat 15 GB	Ahmad omer	5317477017	71,50'),(216,12,0,1,12,12,1,1,1,'2022-03-23 10:11:23','2022-03-23 10:11:49','Kontor\n	92439	AHLAN 10000 COİNS	5353402539\n4903840'),(217,10,8,2,20,4,1,1287,1,'2022-03-26 06:42:24','2022-03-26 06:43:01','Yasser Toptan'),(218,24,20,2,48,8,1,1141,1,'2022-03-26 06:40:01','2022-03-26 06:40:19','Yasser Toptan'),(219,15,10,1,15,5,1,1057,1,'2022-03-26 06:38:03','2022-03-26 06:38:14','Yasser Toptan'),(220,5,0,1,5,5,1,1,1,'2022-03-26 06:37:24','2022-03-26 06:37:50','Kontor From the bank cart  95\n'),(221,9,8,2,18,2,1,1292,1,'2022-03-26 06:36:43','2022-03-26 06:37:11','Yasser Toptan'),(222,35,19,1,35,16,1,1003,1,'2022-03-25 09:23:50','2022-03-25 09:23:58','Description'),(223,11,6,1,11,5,1,1297,1,'2022-03-29 10:43:36','2022-03-30 15:16:29','Yasser Toptan'),(224,11,8,1,11,3,1,1161,1,'2022-03-29 10:43:35','2022-03-30 15:16:25','Yasser Toptan'),(225,0,0,1,0,0,1,1,1,'2022-03-30 12:02:46','2022-03-30 12:02:56','kontor 	Mutlu Firsat 12 GB	Ahmad omer	5352959369'),(226,175,158,1,175,17,1,1091,1,'2022-03-30 08:26:44','2022-03-30 08:27:24','Ahmad hammadeh'),(227,180,163,3,540,51,1,1303,1,'2022-03-30 08:26:59','2022-03-30 08:27:13','Attarh Toptan'),(228,180,170,3,540,30,1,1304,1,'2022-03-30 08:22:55','2022-03-30 08:23:21','Attarh Toptan'),(229,140,126,2,280,28,1,1309,1,'2022-03-30 08:22:25','2022-03-30 08:22:43','Attarh Toptan'),(230,25,22,3,75,9,1,1321,1,'2022-03-30 08:21:45','2022-03-30 08:22:15','Attarh Toptan'),(231,15,4,1,15,11,1,1208,1,'2022-03-29 11:40:43','2022-03-29 11:40:43','Description'),(232,8,8,6,48,0,1,1298,1,'2022-03-29 10:40:48','2022-03-29 10:43:14','Yasser Toptan'),(233,13,9,5,65,20,1,1001,1,'2022-03-29 10:42:34','2022-03-29 10:43:02','Yasser Toptan'),(234,36,26,2,72,20,1,1130,1,'2022-03-29 10:42:09','2022-03-29 10:42:24','Yasser Toptan'),(235,6,6,10,60,0,1,1004,1,'2022-03-29 10:41:40','2022-03-29 10:42:00','Yasser Toptan'),(236,18,15,1,18,3,1,1160,1,'2022-03-29 10:41:19','2022-03-29 10:41:34','Yasser Toptan'),(237,18,13,1,18,5,1,1322,1,'2022-03-29 10:40:21','2022-03-29 10:40:39','Yasser Toptan'),(238,37,33,1,37,4,1,1081,1,'2022-03-29 10:39:49','2022-03-29 10:40:08','Yasser Toptan'),(239,27,20,1,27,7,1,1141,1,'2022-03-29 10:39:21','2022-03-29 10:39:36','Yasser Toptan'),(240,175,75,1,175,100,1,1022,1,'2022-03-27 08:13:34','2022-03-27 08:13:42','Description'),(241,9,0,1,9,9,1,1,1,'2022-03-27 08:12:44','2022-03-27 08:13:14','kontor 93902	Google Play Kart 100TL	5353402539'),(242,10,0,1,10,10,1,1,1,'2022-03-26 14:10:41','2022-03-26 14:11:09','Google Account Password Changing\n'),(243,0,0,1,0,0,1,1,1,'2022-03-26 13:05:49','2022-03-26 13:08:51','kontor 93527	LİKEE 470ELMAS	5353402539\n0537672639w | 144.30'),(244,0,0,1,0,0,1,1,1,'2022-03-26 13:05:50','2022-03-26 13:07:53','kontor 93526	LİKEE 240 ELMAS	5353402539\n0537672639w\n|  74,00'),(245,7,0,1,7,7,1,1,1,'2022-03-26 13:05:51','2022-03-26 13:07:08','kontor 	GNC Mutlu 12 GB	Ahmad omer	5318719250	78,00'),(246,8,0,1,8,8,1,1,1,'2022-03-26 13:05:52','2022-03-26 13:06:45','kontor 	Mutlu Firsat 12 GB	Ahmad omer	5357491392	61,50'),(247,9,0,1,9,9,1,1,1,'2022-03-26 13:05:48','2022-03-26 13:06:28','kontor 	Mutlu Firsat 7 GB	Ahmad omer	5315250843	51,50'),(248,40,25,1,40,15,1,1162,1,'2022-03-26 13:05:33','2022-03-26 13:05:33','Description'),(249,18,15,1,18,3,1,1160,1,'2022-03-26 08:33:50','2022-03-26 08:34:02','Yasser Toptan'),(250,9,7,1,9,2,1,1126,1,'2022-03-26 08:33:09','2022-03-26 08:33:37','Yasser Toptan'),(251,9,7,1,9,2,1,1293,1,'2022-03-26 08:33:14','2022-03-26 08:33:29','Yasser Toptan'),(252,10,8,3,30,6,1,1287,1,'2022-03-26 08:32:13','2022-03-26 08:32:39','Yasser Toptan'),(253,13,9,3,39,12,1,1001,1,'2022-03-26 08:31:48','2022-03-26 08:32:08','Yasser Toptan'),(254,37,33,1,37,4,1,1081,1,'2022-03-26 08:30:44','2022-03-26 08:30:54','Yasser Toptan'),(255,9,8,3,27,3,1,1292,1,'2022-03-26 08:27:42','2022-03-26 08:28:01','Yasser Toptan');
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
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_counters`
--

LOCK TABLES `sales_counters` WRITE;
/*!40000 ALTER TABLE `sales_counters` DISABLE KEYS */;
INSERT INTO `sales_counters` VALUES (19,4,1091,'2022-02-16 08:28:13','2022-03-31 10:46:47'),(20,14,1001,'2022-02-16 08:35:25','2022-03-31 10:46:48'),(21,1,1080,'2022-02-16 08:35:25','2022-02-16 08:35:25'),(22,6,1090,'2022-02-16 08:35:25','2022-03-21 06:26:13'),(23,2,1037,'2022-02-16 08:35:26','2022-03-19 07:29:01'),(24,2,1010,'2022-02-16 08:35:26','2022-03-17 09:44:05'),(25,160,1,'2022-02-16 08:41:58','2022-03-31 10:46:48'),(26,1,1104,'2022-02-17 10:31:37','2022-02-17 10:31:37'),(27,1,1060,'2022-02-17 10:31:38','2022-02-17 10:31:38'),(28,1,1002,'2022-02-20 08:58:48','2022-02-20 08:58:48'),(29,6,1126,'2022-02-20 08:58:48','2022-03-31 10:46:48'),(30,3,1130,'2022-02-20 14:07:03','2022-03-31 10:46:47'),(31,2,1019,'2022-02-22 08:06:41','2022-02-22 08:06:41'),(32,1,1088,'2022-02-22 15:19:56','2022-02-22 15:19:56'),(33,4,1053,'2022-02-24 06:20:47','2022-03-12 07:22:38'),(34,2,1113,'2022-02-24 06:20:47','2022-03-21 06:26:13'),(35,1,1125,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(36,2,1014,'2022-02-24 06:20:47','2022-03-13 08:05:07'),(37,3,1054,'2022-02-24 06:20:47','2022-03-23 09:20:04'),(38,1,1040,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(39,2,1095,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(40,1,1152,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(41,2,1151,'2022-02-24 06:20:47','2022-03-09 07:02:39'),(42,1,1131,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(43,8,1141,'2022-02-24 06:20:47','2022-03-31 10:46:48'),(44,1,1139,'2022-02-24 06:20:47','2022-02-24 06:20:47'),(45,3,1161,'2022-03-01 08:07:03','2022-03-31 10:46:47'),(46,5,1160,'2022-03-01 08:07:03','2022-03-31 10:46:48'),(47,2,1049,'2022-03-01 08:07:03','2022-03-06 15:10:18'),(48,1,1070,'2022-03-01 08:07:03','2022-03-01 08:07:03'),(49,13,1004,'2022-03-02 07:50:18','2022-03-31 10:46:47'),(50,1,1045,'2022-03-05 10:22:17','2022-03-05 10:22:17'),(51,1,1052,'2022-03-05 10:22:17','2022-03-05 10:22:17'),(52,1,1119,'2022-03-05 10:22:17','2022-03-05 10:22:17'),(53,2,1121,'2022-03-05 10:22:17','2022-03-14 07:11:25'),(54,1,1129,'2022-03-05 10:22:17','2022-03-05 10:22:17'),(55,1,1156,'2022-03-06 15:10:18','2022-03-06 15:10:18'),(56,2,1138,'2022-03-06 15:10:19','2022-03-19 07:29:01'),(57,1,1158,'2022-03-06 15:10:19','2022-03-06 15:10:19'),(58,2,1135,'2022-03-06 15:10:19','2022-03-19 07:29:01'),(59,1,1094,'2022-03-06 15:10:19','2022-03-06 15:10:19'),(60,1,1073,'2022-03-06 15:10:19','2022-03-06 15:10:19'),(61,1,1089,'2022-03-09 07:02:39','2022-03-09 07:02:39'),(62,2,1137,'2022-03-09 07:02:39','2022-03-13 08:05:07'),(63,2,1128,'2022-03-09 07:02:39','2022-03-09 07:02:39'),(64,1,1018,'2022-03-14 07:11:25','2022-03-14 07:11:25'),(65,1,1023,'2022-03-14 07:11:25','2022-03-14 07:11:25'),(66,1,1180,'2022-03-16 06:16:27','2022-03-16 06:16:27'),(67,1,1100,'2022-03-16 06:16:27','2022-03-16 06:16:27'),(68,1,1063,'2022-03-16 06:16:27','2022-03-16 06:16:27'),(69,1,1164,'2022-03-17 09:44:05','2022-03-17 09:44:05'),(70,1,1136,'2022-03-19 07:29:01','2022-03-19 07:29:01'),(71,1,1087,'2022-03-19 07:29:01','2022-03-19 07:29:01'),(72,1,1132,'2022-03-21 06:26:13','2022-03-21 06:26:13'),(73,2,1186,'2022-03-21 06:26:13','2022-03-21 06:26:13'),(74,1,1290,'2022-03-23 09:20:04','2022-03-23 09:20:04'),(75,1,1011,'2022-03-23 09:20:04','2022-03-23 09:20:04'),(76,5,1287,'2022-03-26 06:43:15','2022-03-31 10:46:48'),(77,1,1057,'2022-03-26 06:43:15','2022-03-26 06:43:15'),(78,5,1292,'2022-03-26 06:43:15','2022-03-31 10:46:48'),(79,1,1003,'2022-03-26 06:43:15','2022-03-26 06:43:15'),(80,1,1297,'2022-03-31 10:46:47','2022-03-31 10:46:47'),(81,3,1303,'2022-03-31 10:46:47','2022-03-31 10:46:47'),(82,3,1304,'2022-03-31 10:46:47','2022-03-31 10:46:47'),(83,2,1309,'2022-03-31 10:46:47','2022-03-31 10:46:47'),(84,3,1321,'2022-03-31 10:46:47','2022-03-31 10:46:47'),(85,1,1208,'2022-03-31 10:46:47','2022-03-31 10:46:47'),(86,6,1298,'2022-03-31 10:46:47','2022-03-31 10:46:47'),(87,1,1322,'2022-03-31 10:46:48','2022-03-31 10:46:48'),(88,2,1081,'2022-03-31 10:46:48','2022-03-31 10:46:48'),(89,1,1022,'2022-03-31 10:46:48','2022-03-31 10:46:48'),(90,1,1162,'2022-03-31 10:46:48','2022-03-31 10:46:48'),(91,1,1293,'2022-03-31 10:46:48','2022-03-31 10:46:48');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sellers`
--

LOCK TABLES `sellers` WRITE;
/*!40000 ALTER TABLE `sellers` DISABLE KEYS */;
INSERT INTO `sellers` VALUES (1,'Default','00','-',NULL,NULL),(2,'El-Khatib','5376014222','Semsitebrizi Mahallesi, Hatuniye Sk. No:9, 42030 Karatay/Konya',NULL,NULL),(3,'Simex','03323526707','Semsitebrizi Mahallesi, Akif Pasa Sk., 42030 Karatay/Konya',NULL,NULL),(4,'Soffany','5327272788','Tahtakale Mahallesi, Findikcilar Sk Pirhan, No:13, 34116 Fatih/Istanbul',NULL,NULL),(5,'Kensa','5323412272','Demirtas Mh, Cemil Birsel Cd. No:13/A. Fatih Istanbul','2021-11-26 14:07:23','2021-11-26 14:07:23'),(6,'Ahmad Attrah','5524756466','Backbag Seller','2022-03-22 06:46:31','2022-03-22 06:58:46');
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
INSERT INTO `sessions` VALUES ('2RbPUcvT0Zzi4YDm50J3ceNTv1ASMEp2du60KXjl',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoialJwZGRWWmU1MDBXNGwyaFRQdmtTY21kOFVIdHZSdXhhcmNKSHJHbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly9ib2JrLnRlc3QvdGVzdGluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1653934572),('BEdVXboIEEucQHKAfOjbo3BPE3iwc7juBlRpOO8p',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiOW8xaFFEUFlFNWVZY2hGTjdZQWdHejhteDNMZ2t1Yk5LdGVkQVg0bCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI0OiJodHRwOi8vYm9iay50ZXN0L3Rlc3RpbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkUXBYRVguUVU0dk5PRklkNkJlU1dLLk9zM0hqQmNtSThyaVVTRDF2OTFwZ05RU0U5cm9HcVMiO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJFFwWEVYLlFVNHZOT0ZJZDZCZVNXSy5PczNIakJjbUk4cmlVU0QxdjkxcGdOUVNFOXJvR3FTIjt9',1654273543),('lFtv24Yvo5Y6ShkSlvNZB7Py0awe5p25qZm5fGx6',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNG94dUdWNDdoVFAzZThNNGNuNmE0bFp1bnZZVk1tSjRTM2ZLTE9GdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYm9iay50ZXN0L3Rlc3RpbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjE3OiJodHRwczovL2JvYmsudGVzdCI7fX0=',1653936117),('lwx0uchH0jDjKhSNHoxwJjK7mPceaoXJsNqM1nno',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN0l5b2ZRNTFTS1dZa1c0NWdVd3ZteWFPMzVLOTNXVWR5cFRJVjlIUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly9ib2JrLnRlc3QvdGVzdGluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1653927479),('MDGQyZkzlWItAnhbvacpR4pElV3WT739rp6KNFfB',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicEJjdlJGcTlIQUpxbzBOREh2UEgwZWh2eG1qenRFbmt2bllnYVdUViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYm9iay50ZXN0L3Rlc3RpbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1654275683),('NbSqh1rdSunXyc7NqfM11jJBI6wtW9ILeoyYXZYx',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicGkzemNqUTZhM253NmNwamcwbVV5QUswd3RUbWpLdEQ3ZXF1REJybCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly9ib2JrLnRlc3QvdGVzdGluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1653933992),('Ngqdh2NpN5Ol2tTiGSerc4GDq4HKlDDU4AdrQUF8',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiRktPOWtXdEhhaFd2V05RWXExSUJ5ZjNuTm1NYk9Vc3pVYzFLT25JcCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI0OiJodHRwOi8vYm9iay50ZXN0L2Nhc2hpZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkUXBYRVguUVU0dk5PRklkNkJlU1dLLk9zM0hqQmNtSThyaVVTRDF2OTFwZ05RU0U5cm9HcVMiO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJFFwWEVYLlFVNHZOT0ZJZDZCZVNXSy5PczNIakJjbUk4cmlVU0QxdjkxcGdOUVNFOXJvR3FTIjt9',1654348545),('vfqyo8yz7XfrcKAGwbbbwvwKpsdnFQLbgILJ5f9b',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR0dBeFZVeENVNExneWZLU3NjNU5vOHdYbUhSalJYSTA4UUJGSGpHTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYm9iay50ZXN0L3Rlc3RpbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1653934016),('VNISg0Zq6VhK7QTb9ROe29U4f9dYtyl7Ni3d15cz',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidGoxN2l0SW1USkFNVW5PZ2hpZWo5MzZxeXg2R2tsRUYzczQzOWxDSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly9ib2JrLnRlc3QvdGVzdGluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1653927172);
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

-- Dump completed on 2022-06-04 16:16:33
