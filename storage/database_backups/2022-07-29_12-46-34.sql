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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bills`
--

LOCK TABLES `bills` WRITE;
/*!40000 ALTER TABLE `bills` DISABLE KEYS */;
INSERT INTO `bills` VALUES (1,'default',0,'default',1,1001,1,1,'2021-10-17 21:00:00','2021-10-17 21:00:00'),(2,'goods',2721,'293.5 $ * 9.27 TL',125,1002,1,1,'2021-10-17 21:00:00','2021-10-17 21:00:00'),(3,'goods',2500,'-',55,1234,2,2,'2022-06-08 09:45:33','2022-06-08 09:45:33'),(4,'goods',5000,'fasdf',100,100234554,6,3,'2022-06-15 13:10:47','2022-06-15 13:10:47'),(5,'goods',2000,'as',100,12354,3,1,'2022-06-15 14:19:25','2022-06-15 14:20:03'),(6,'goods',1000,'d',10,31484756,4,4,'2022-06-24 11:19:06','2022-06-24 11:19:06'),(7,'goods',9800,'desc',100,195948,3,5,'2022-06-30 06:43:35','2022-06-30 06:43:35'),(8,'goods',4500,'desc',100,951,2,6,'2022-06-30 06:44:14','2022-06-30 06:44:14');
/*!40000 ALTER TABLE `bills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brand_seller`
--

DROP TABLE IF EXISTS `brand_seller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brand_seller` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` bigint(20) unsigned NOT NULL,
  `seller_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brand_seller_brand_id_foreign` (`brand_id`),
  KEY `brand_seller_seller_id_foreign` (`seller_id`),
  CONSTRAINT `brand_seller_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `brand_seller_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand_seller`
--

LOCK TABLES `brand_seller` WRITE;
/*!40000 ALTER TABLE `brand_seller` DISABLE KEYS */;
INSERT INTO `brand_seller` VALUES (1,1,1,NULL,NULL),(2,1,2,NULL,NULL),(3,1,3,NULL,NULL),(4,1,4,NULL,NULL),(5,1,5,NULL,NULL),(6,1,6,NULL,NULL),(7,1,7,NULL,NULL),(8,1,8,NULL,NULL),(9,2,2,NULL,NULL),(10,2,8,NULL,NULL),(11,2,6,NULL,NULL),(12,2,7,NULL,NULL),(13,3,2,NULL,NULL),(14,3,3,NULL,NULL),(15,3,8,NULL,NULL),(16,3,6,NULL,NULL),(17,3,7,NULL,NULL),(18,4,2,NULL,NULL),(19,4,8,NULL,NULL),(20,5,2,NULL,NULL),(21,5,8,NULL,NULL),(22,6,2,NULL,NULL),(23,6,8,NULL,NULL),(24,7,2,NULL,NULL),(25,7,8,NULL,NULL),(26,7,7,NULL,NULL),(27,7,6,NULL,NULL),(28,8,8,NULL,NULL),(29,8,7,NULL,NULL),(30,8,6,NULL,NULL),(31,8,3,NULL,NULL),(32,9,8,NULL,NULL),(33,9,7,NULL,NULL),(34,9,6,NULL,NULL),(35,9,3,NULL,NULL),(36,9,2,NULL,NULL),(37,10,4,NULL,NULL),(38,11,8,NULL,NULL),(39,11,6,NULL,NULL),(40,11,7,NULL,NULL),(41,12,8,NULL,NULL),(42,12,6,NULL,NULL),(43,12,7,NULL,NULL),(44,13,8,NULL,NULL),(45,13,6,NULL,NULL),(46,13,7,NULL,NULL),(47,13,2,NULL,NULL),(48,14,8,NULL,NULL),(49,14,2,NULL,NULL),(50,14,5,NULL,NULL);
/*!40000 ALTER TABLE `brand_seller` ENABLE KEYS */;
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Other','Other','2022-06-04 13:10:53','2022-06-04 13:10:53'),(2,'Platoon','Screens, General Accessories','2022-06-04 13:10:53','2022-06-04 13:10:53'),(3,'Jopus','Screens, General Accessories','2022-06-04 13:10:53','2022-06-04 13:10:53'),(4,'Syrox','Headphones Bluetooth Headphones, Cables, Chargers, Screens, Airpods','2022-06-04 13:10:53','2022-06-04 13:10:53'),(5,'Mabko','Cables, Headphones, Bluetooth Headphones, Screens, Airpods, Chargers','2022-06-04 13:10:53','2022-06-04 13:10:53'),(6,'Joylink','Cables, Chargers','2022-06-04 13:10:53','2022-06-04 13:10:53'),(7,'Veno','Bluetooth Headphones, iPhone\'s Headphones','2022-06-04 13:10:53','2022-06-04 13:10:53'),(8,'Simex','Screens, General Accessories','2022-06-04 13:10:53','2022-06-04 13:10:53'),(9,'Mytell','Screens, General Accessories','2022-06-04 13:10:53','2022-06-04 13:10:53'),(10,'Soffany','Chargers, Cables, Covers, Screens, General Accessories','2022-06-04 13:10:53','2022-06-04 13:10:53'),(11,'TGB','Cables, Earphones, General Accessories','2022-06-04 13:10:53','2022-06-04 13:10:53'),(12,'Phixi','Cables, Chargers, General Accessories','2022-06-04 13:10:53','2022-06-04 13:10:53'),(13,'i12','Bluetooth Airpods','2022-06-04 13:10:53','2022-06-04 13:10:53'),(14,'Kensa','Bluetooth Airpods, Chargers, Cables, Screens, Memory Cards, Flash Memory, Speakers ..etc','2022-06-04 13:10:53','2022-06-04 13:10:53');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
INSERT INTO `carts` VALUES (1,'2022-06-04 13:10:53','2022-06-04 13:10:53');
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'default','default',NULL,NULL),(2,'Chargers','chargers',NULL,NULL),(3,'Screens','screens',NULL,NULL),(4,'Micro Cables','micro-cables',NULL,NULL),(5,'Type-C Cables','type-c-cables',NULL,NULL),(6,'Lighting Cables','lighting-cables',NULL,NULL),(7,'Bluetooth Headphones','bluetooth-headphones',NULL,NULL),(8,'Airpods','airpods',NULL,NULL),(9,'Earphones','earphones',NULL,NULL),(10,'Bluetooth Speakers','bluetooth-speakers',NULL,NULL),(11,'Flash Drive','flash-drive',NULL,NULL),(12,'Memory Card','memory-card',NULL,NULL),(13,'Convertors','convertors',NULL,NULL),(14,'Aux Cables','aux-cables',NULL,NULL),(15,'Screens','screens',NULL,NULL),(16,'Nano Screens','nano-screens',NULL,NULL),(17,'Chargers','chargers',NULL,NULL),(18,'Charger Adapters','charger-adapters',NULL,NULL),(19,'Phones Holders','phones-holders',NULL,NULL),(20,'Headphones','headphones',NULL,NULL),(21,'Gamers Stuffs','gamers-stuffs',NULL,NULL),(22,'Power Banks','power-banks',NULL,NULL),(23,'Mouse','mouse',NULL,NULL),(24,'Youtubers Stuffs','youtubers-stuffs',NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contributions`
--

LOCK TABLES `contributions` WRITE;
/*!40000 ALTER TABLE `contributions` DISABLE KEYS */;
INSERT INTO `contributions` VALUES (1,998000,'This is the description','2021-10-13','2022-10-13',100,0,NULL,1,'2021-10-12 21:00:00','2022-06-15 14:19:25'),(2,2500,'Products','2022-01-01','2023-01-01',50,0,NULL,2,'2022-06-06 08:15:31','2022-06-08 09:50:03'),(3,0,'Profits will be divided by 2, omar and ahmad.','2022-01-06','2022-01-12',50,0,NULL,3,'2022-06-15 13:09:55','2022-06-15 13:10:47'),(4,3000,'.','2022-01-01','2023-01-01',40,0,NULL,2,'2022-06-24 10:56:19','2022-06-24 11:19:06'),(5,200,'desc','2021-01-01','2023-01-01',50,0,NULL,4,'2022-06-30 06:42:34','2022-06-30 06:43:35'),(6,500,'desc','2021-01-01','2022-01-01',50,0,NULL,4,'2022-06-30 06:42:53','2022-06-30 06:44:14');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contributors`
--

LOCK TABLES `contributors` WRITE;
/*!40000 ALTER TABLE `contributors` DISABLE KEYS */;
INSERT INTO `contributors` VALUES (1,'Owner','000000000','Owner',NULL,'2022-06-15 13:27:05'),(2,'Attar','-','1- 2500 \n\n2- 3000','2022-06-05 11:51:19','2022-07-05 07:59:52'),(3,'Attar + Omar','-','n','2022-06-06 08:16:23','2022-06-06 08:16:23'),(4,'Omar','5353402539','this contributor is just for testing with two contributions first one is 10k and second one is 5k','2022-06-30 06:42:00','2022-06-30 06:42:00');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debtors`
--

LOCK TABLES `debtors` WRITE;
/*!40000 ALTER TABLE `debtors` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debts`
--

LOCK TABLES `debts` WRITE;
/*!40000 ALTER TABLE `debts` DISABLE KEYS */;
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
  KEY `expenses_bill_id_foreign` (`bill_id`),
  KEY `expenses_contribution_id_foreign` (`contribution_id`),
  CONSTRAINT `expenses_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`),
  CONSTRAINT `expenses_contribution_id_foreign` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`),
  CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (1,'shopping','This Expense has been created Automatically After the new Bill.\n            ',2500,1,3,2,'2022-06-08 09:45:33','2022-06-08 09:45:33'),(2,'shopping','This Expense has been created Automatically After the new Bill.\n            ',5000,1,4,3,'2022-06-15 13:10:47','2022-06-15 13:10:47'),(3,'shopping','This Expense has been created Automatically After the new Bill.\n            ',2000,1,5,1,'2022-06-15 14:19:25','2022-06-15 14:19:25'),(4,'shopping','This Expense has been created Automatically After the new Bill.\n            ',1000,1,6,4,'2022-06-24 11:19:06','2022-06-24 11:19:06'),(5,'loses','not working',100,1,3,2,'2022-06-29 10:25:34','2022-06-29 10:25:34'),(6,'shopping','This Expense has been created Automatically After the new Bill.\n            ',9800,1,7,5,'2022-06-30 06:43:35','2022-06-30 06:43:35'),(7,'shopping','This Expense has been created Automatically After the new Bill.\n            ',4500,1,8,6,'2022-06-30 06:44:14','2022-06-30 06:44:14');
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incomes`
--

LOCK TABLES `incomes` WRITE;
/*!40000 ALTER TABLE `incomes` DISABLE KEYS */;
INSERT INTO `incomes` VALUES (1,'cost',0,2,1,1,'2022-06-08 09:49:06','2022-06-08 09:49:15'),(2,'profit',55,2,1,1,'2022-06-08 09:49:06','2022-06-08 09:49:15'),(3,'cost',0,3,1,1,'2022-06-08 09:50:38','2022-06-08 09:50:46'),(4,'profit',60,3,1,1,'2022-06-08 09:50:38','2022-06-08 09:50:46'),(5,'cost',50,4,2,1,'2022-06-08 09:59:14','2022-06-08 09:59:27'),(6,'profit',25,4,2,1,'2022-06-08 09:59:14','2022-06-08 09:59:27'),(7,'profit',25,4,1,1,'2022-06-08 09:59:14','2022-06-08 09:59:27'),(8,'cost',20,5,2,1,'2022-06-08 10:03:07','2022-06-08 10:03:20'),(9,'profit',40,5,2,1,'2022-06-08 10:03:07','2022-06-08 10:03:20'),(10,'profit',40,5,1,1,'2022-06-08 10:03:07','2022-06-08 10:03:20'),(11,'cost',20,6,2,1,'2022-06-08 10:04:16','2022-06-08 10:04:22'),(12,'profit',30,6,2,1,'2022-06-08 10:04:16','2022-06-08 10:04:22'),(13,'profit',30,6,1,1,'2022-06-08 10:04:16','2022-06-08 10:04:22'),(14,'cost',20,7,2,1,'2022-06-08 12:22:01','2022-06-08 12:22:14'),(15,'profit',0,7,2,1,'2022-06-08 12:22:01','2022-06-08 12:22:14'),(16,'profit',0,7,1,1,'2022-06-08 12:22:01','2022-06-08 12:22:14'),(17,'cost',50,8,3,1,'2022-06-15 13:15:53','2022-06-15 13:15:53'),(18,'profit',50,8,3,1,'2022-06-15 13:15:53','2022-06-15 13:15:53'),(19,'profit',50,8,1,1,'2022-06-15 13:15:53','2022-06-15 13:15:53'),(20,'cost',50,9,3,1,'2022-06-15 13:15:51','2022-06-15 13:15:51'),(21,'profit',50,9,3,1,'2022-06-15 13:15:51','2022-06-15 13:15:51'),(22,'profit',50,9,1,1,'2022-06-15 13:15:51','2022-06-15 13:15:51'),(23,'cost',20,10,1,1,'2022-06-15 14:21:23','2022-06-15 14:21:23'),(24,'profit',100,10,1,1,'2022-06-15 14:21:23','2022-06-15 14:21:23'),(25,'cost',100,11,4,1,'2022-06-24 11:20:13','2022-06-24 11:20:13'),(26,'profit',97,11,4,1,'2022-06-24 11:20:13','2022-06-24 11:20:13'),(27,'profit',145,11,1,1,'2022-06-24 11:20:13','2022-06-24 11:20:13'),(28,'cost',100,12,4,1,'2022-06-24 11:20:08','2022-06-24 11:20:08'),(29,'profit',97,12,4,1,'2022-06-24 11:20:08','2022-06-24 11:20:08'),(30,'profit',145,12,1,1,'2022-06-24 11:20:08','2022-06-24 11:20:08'),(31,'cost',98,13,5,1,'2022-06-30 06:47:27','2022-06-30 06:48:34'),(32,'profit',26,13,5,1,'2022-06-30 06:47:27','2022-06-30 06:48:34'),(33,'profit',26,13,1,1,'2022-06-30 06:47:27','2022-06-30 06:48:34'),(34,'cost',98,14,5,1,'2022-06-30 06:48:26','2022-06-30 06:48:26'),(35,'profit',51,14,5,1,'2022-06-30 06:48:26','2022-06-30 06:48:26'),(36,'profit',51,14,1,1,'2022-06-30 06:48:26','2022-06-30 06:48:26'),(37,'cost',45,15,6,1,'2022-06-30 06:47:57','2022-06-30 06:48:19'),(38,'profit',10,15,6,1,'2022-06-30 06:47:57','2022-06-30 06:48:19'),(39,'profit',10,15,1,1,'2022-06-30 06:47:57','2022-06-30 06:48:19'),(40,'cost',45,16,6,1,'2022-06-30 06:48:10','2022-06-30 06:48:10'),(41,'profit',13,16,6,1,'2022-06-30 06:48:10','2022-06-30 06:48:10'),(42,'profit',13,16,1,1,'2022-06-30 06:48:10','2022-06-30 06:48:10');
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
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2020_05_21_100000_create_teams_table',1),(7,'2020_05_21_200000_create_team_user_table',1),(8,'2020_05_21_300000_create_team_invitations_table',1),(9,'2021_08_00_124401_create_carts_table',1),(10,'2021_08_10_173028_create_categories_table',1),(11,'2021_08_20_152842_create_sessions_table',1),(12,'2021_08_25_134856_create_contributors_table',1),(13,'2021_08_25_135119_create_contributions_table',1),(14,'2021_08_25_171711_create_sellers_table',1),(15,'2021_08_26_171711_create_bills_table',1),(16,'2021_08_26_171711_create_brands_table',1),(17,'2021_08_27_171711_create_products_table',1),(18,'2021_09_02_074818_create_cart_product_table',1),(19,'2021_09_06_121149_create_debtors_table',1),(20,'2021_09_06_121159_create_debts_table',1),(21,'2021_09_24_161455_create_sales_counters_table',1),(22,'2021_09_28_144003_create_expenses_table',1),(23,'2021_10_03_101241_create_sales_table',1),(24,'2021_10_04_100234_create_incomes_table',1),(25,'2021_11_11_154722_create_products_containers_table',1),(26,'2021_12_03_112902_add_description_to_sales',1),(27,'2021_12_03_145811_add_description_to_cart_product',1),(28,'2022_06_04_143731_create_brand_seller_table',1);
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
  KEY `products_bill_id_foreign` (`bill_id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_contribution_id_foreign` (`contribution_id`),
  KEY `products_user_id_foreign` (`user_id`),
  CONSTRAINT `products_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `products_contribution_id_foreign` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`),
  CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,0,'Other',NULL,'****',95,0,20,'other',1,1,1,2,1,'2022-06-04 13:10:53','2022-06-08 12:22:17'),(2,12342132,'product','asd','ads',98,150,50,'product',4,11,2,3,1,'2022-06-15 13:14:10','2022-06-15 13:16:31'),(3,123321,'pro','daaf','asq',99,120,20,'pro',5,8,1,1,1,'2022-06-15 14:20:58','2022-06-15 14:21:28'),(4,12334123,'daf','dfs','213s',8,342,100,'daf',6,1,1,4,1,'2022-06-24 11:19:40','2022-06-30 06:48:08'),(5,1234546,'fads','sad','fsa32',98,200,98,'fads',7,8,2,5,1,'2022-06-30 06:45:42','2022-06-30 06:48:40'),(6,1234121,'fwe','safa','21d',98,70,45,'fwe',8,3,3,6,1,'2022-06-30 06:46:31','2022-06-30 06:48:40');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_containers`
--

LOCK TABLES `products_containers` WRITE;
/*!40000 ALTER TABLE `products_containers` DISABLE KEYS */;
INSERT INTO `products_containers` VALUES (1,'{}',0,3,'2022-06-08 09:45:33','2022-06-08 09:45:33'),(2,'{\"2\":{\"id\":2,\"name\":\"product\",\"description\":\"asd\",\"code\":\"ads\",\"amount\":\"100\",\"cost\":\"50\",\"price\":\"150\",\"serial\":\"12342132\",\"category_id\":\"2\",\"brand_id\":\"11\",\"user_id\":1,\"slug\":\"product\",\"created_at\":\"2022-06-15T16:13:47.783651Z\",\"updated_at\":\"2022-06-15T16:13:47.783702Z\"}}',1,4,'2022-06-15 13:10:47','2022-06-15 13:14:10'),(3,'{\"3\":{\"id\":3,\"name\":\"pro\",\"description\":\"daaf\",\"code\":\"asq\",\"amount\":\"100\",\"cost\":\"20\",\"price\":\"120\",\"serial\":\"123321\",\"category_id\":\"1\",\"brand_id\":\"8\",\"user_id\":1,\"slug\":\"pro\",\"created_at\":\"2022-06-15T17:20:49.498932Z\",\"updated_at\":\"2022-06-15T17:20:49.498980Z\"}}',1,5,'2022-06-15 14:19:25','2022-06-15 14:20:58'),(4,'{\"4\":{\"id\":4,\"name\":\"daf\",\"description\":\"dfs\",\"code\":\"213s\",\"amount\":\"10\",\"cost\":\"100\",\"price\":\"342\",\"serial\":\"12334123\",\"category_id\":\"1\",\"brand_id\":\"1\",\"user_id\":1,\"slug\":\"daf\",\"created_at\":\"2022-06-24T14:19:33.448372Z\",\"updated_at\":\"2022-06-24T14:19:33.448409Z\"}}',1,6,'2022-06-24 11:19:06','2022-06-24 11:19:40'),(5,'{\"5\":{\"id\":5,\"name\":\"fads\",\"description\":\"sad\",\"code\":\"fsa32\",\"amount\":\"100\",\"cost\":\"98\",\"price\":\"200\",\"serial\":\"1234546\",\"category_id\":\"2\",\"brand_id\":\"8\",\"user_id\":1,\"slug\":\"fads\",\"created_at\":\"2022-06-30T09:45:31.380721Z\",\"updated_at\":\"2022-06-30T09:45:31.380764Z\"}}',1,7,'2022-06-30 06:43:35','2022-06-30 06:45:42'),(6,'{\"6\":{\"id\":6,\"name\":\"fwe\",\"description\":\"safa\",\"code\":\"21d\",\"amount\":\"100\",\"cost\":\"45\",\"price\":\"70\",\"serial\":\"1234121\",\"category_id\":\"3\",\"brand_id\":\"3\",\"user_id\":1,\"slug\":\"fwe\",\"created_at\":\"2022-06-30T09:46:08.404821Z\",\"updated_at\":\"2022-06-30T09:46:08.404902Z\"}}',1,8,'2022-06-30 06:44:14','2022-06-30 06:46:31');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (2,55,0,1,55,55,1,1,1,'2022-06-08 09:49:06','2022-06-08 09:49:15','Description'),(3,60,0,1,60,60,1,1,1,'2022-06-08 09:50:38','2022-06-08 09:50:46','Description'),(4,100,50,1,100,50,1,1,2,'2022-06-08 09:59:14','2022-06-08 09:59:27','Description'),(5,100,20,1,100,80,1,1,2,'2022-06-08 10:03:07','2022-06-08 10:03:20','Description'),(6,80,20,1,80,60,1,1,2,'2022-06-08 10:04:16','2022-06-08 10:04:22','Description'),(7,20,20,1,20,0,1,1,2,'2022-06-08 12:22:01','2022-06-08 12:22:14','Description'),(8,150,50,1,150,100,1,2,3,'2022-06-15 13:15:53','2022-06-15 13:15:53','Description'),(9,150,50,1,150,100,1,2,3,'2022-06-15 13:15:51','2022-06-15 13:15:51','Description'),(10,120,20,1,120,100,1,3,1,'2022-06-15 14:21:23','2022-06-15 14:21:23','Description'),(11,342,100,1,342,242,1,4,4,'2022-06-24 11:20:13','2022-06-24 11:20:13','Description'),(12,342,100,1,342,242,1,4,4,'2022-06-24 11:20:08','2022-06-24 11:20:08','Description'),(13,150,98,1,150,52,1,5,5,'2022-06-30 06:47:27','2022-06-30 06:48:34','Description'),(14,200,98,1,200,102,1,5,5,'2022-06-30 06:48:26','2022-06-30 06:48:26','Description'),(15,65,45,1,65,20,1,6,6,'2022-06-30 06:47:57','2022-06-30 06:48:19','Description'),(16,70,45,1,70,25,1,6,6,'2022-06-30 06:48:10','2022-06-30 06:48:10','Description');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_counters`
--

LOCK TABLES `sales_counters` WRITE;
/*!40000 ALTER TABLE `sales_counters` DISABLE KEYS */;
INSERT INTO `sales_counters` VALUES (1,6,1,'2022-06-08 09:49:37','2022-06-08 12:22:16'),(2,2,2,'2022-06-15 13:16:31','2022-06-15 13:16:31'),(3,1,3,'2022-06-15 14:21:28','2022-06-15 14:21:28'),(4,2,4,'2022-06-24 11:20:18','2022-06-24 11:20:18'),(5,2,5,'2022-06-30 06:48:39','2022-06-30 06:48:39'),(6,2,6,'2022-06-30 06:48:40','2022-06-30 06:48:40');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sellers`
--

LOCK TABLES `sellers` WRITE;
/*!40000 ALTER TABLE `sellers` DISABLE KEYS */;
INSERT INTO `sellers` VALUES (1,'Default','-','-','2022-06-04 13:10:53','2022-06-05 10:20:31'),(2,'El-Khatib','5376014222','Semsitebrizi Mahallesi, Hatuniye Sk. No:9, 42030 Karatay/Konya','2022-06-04 13:10:53','2022-06-04 13:10:53'),(3,'Simex','03323526707','Semsitebrizi Mahallesi, Akif Pasa Sk., 42030 Karatay/Konya','2022-06-04 13:10:53','2022-06-04 13:10:53'),(4,'Soffany','5327272788','Tahtakale Mahallesi, Findikcilar Sk Pirhan, No:13, 34116 Fatih/Istanbul','2022-06-04 13:10:53','2022-06-04 13:10:53'),(5,'Kensa','5323412272','Demirtas Mh, Cemil Birsel Cd. No:13/A. Fatih Istanbul','2022-06-04 13:10:53','2022-06-04 13:10:53'),(6,'Toptanci 1','-','-','2022-06-04 13:10:53','2022-06-04 13:10:53'),(7,'Toptanci 2','-','-','2022-06-04 13:10:53','2022-06-04 13:10:53'),(8,'Ahmad Attrah','5524756466','Backbag Seller','2022-06-04 13:10:53','2022-06-04 13:10:53');
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
INSERT INTO `sessions` VALUES ('KFsC3k5SyLosqnrSfwEcVzRV38uXbe6GRr55OExo',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiSU9FaHJ3TmFtYk9NTjdOOXJ1ZEx0TUVya2dxenVqSk5BQ1QwNnlmViI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI1OiJodHRwOi8vYm9iay50ZXN0L3Byb2R1Y3RzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJHd6aEdxQWNqYXRkR0NjUU9BZ05jNHVCMG5QNmwyczBuOXRMLjlaRWlsSkx5Ui5kZHRHUzJXIjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCR3emhHcUFjamF0ZEdDY1FPQWdOYzR1QjBuUDZsMnMwbjl0TC45WkVpbEpMeVIuZGR0R1MyVyI7fQ==',1657634331);
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
INSERT INTO `users` VALUES (1,'Admin',1,'admin@gmail.com',NULL,'2022-06-04 13:10:52','$2y$10$wzhGqAcjatdGCcQOAgNc4uB0nP6l2s0n9tL.9ZEilJLyR.ddtGS2W',NULL,NULL,NULL,NULL,NULL,'2022-06-04 13:10:52','2022-06-04 13:10:52'),(2,'User01',0,'user01@gmail.com',NULL,'2022-06-04 13:10:52','$2y$10$BUPBC5JpPKWY5I9NmdhPsuKyTPe2wdLAMEeMYB8JfAoNNnIScjrEy',NULL,NULL,NULL,NULL,NULL,'2022-06-04 13:10:52','2022-06-04 13:10:52');
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

-- Dump completed on 2022-07-29 15:46:34
