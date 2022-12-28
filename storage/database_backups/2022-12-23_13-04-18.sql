-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: karman.dev
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attributes`
--

DROP TABLE IF EXISTS `attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attributes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The field name',
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The field value',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The field type: price, color, size',
  `additional` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'additional attributes will be a json key:value data.',
  `order` int NOT NULL COMMENT 'not always will be needed',
  `attributeable_id` bigint unsigned NOT NULL,
  `attributeable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attributes`
--

LOCK TABLES `attributes` WRITE;
/*!40000 ALTER TABLE `attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bills`
--

DROP TABLE IF EXISTS `bills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bills` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'goods',
  `amount` int NOT NULL COMMENT 'The cost of the bill',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'make clear which currency did meant in amount field',
  `quantity` int NOT NULL COMMENT 'The total of items',
  `serial` int NOT NULL COMMENT 'Bill Serial Number',
  `seller_id` bigint unsigned NOT NULL,
  `contribution_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bills_serial_unique` (`serial`),
  KEY `bills_seller_id_foreign` (`seller_id`),
  KEY `bills_contribution_id_foreign` (`contribution_id`),
  CONSTRAINT `bills_contribution_id_foreign` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`),
  CONSTRAINT `bills_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bills`
--

LOCK TABLES `bills` WRITE;
/*!40000 ALTER TABLE `bills` DISABLE KEYS */;
INSERT INTO `bills` VALUES (1,'default',0,'Products that can be sold without any costs like: invoice and others',10000,1001,1,1,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(2,'stocktaking',100000000,'All products at the stock in the time of starting the website.',10000,1002,1,1,'2022-12-13 12:23:03','2022-12-13 12:23:03');
/*!40000 ALTER TABLE `bills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brand_seller`
--

DROP TABLE IF EXISTS `brand_seller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brand_seller` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` bigint unsigned NOT NULL,
  `seller_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brand_seller_brand_id_foreign` (`brand_id`),
  KEY `brand_seller_seller_id_foreign` (`seller_id`),
  CONSTRAINT `brand_seller_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `brand_seller_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand_seller`
--

LOCK TABLES `brand_seller` WRITE;
/*!40000 ALTER TABLE `brand_seller` DISABLE KEYS */;
INSERT INTO `brand_seller` VALUES (1,1,1,NULL,NULL),(2,1,2,NULL,NULL),(3,1,3,NULL,NULL),(4,1,4,NULL,NULL),(5,1,5,NULL,NULL),(6,1,6,NULL,NULL),(7,1,7,NULL,NULL),(8,1,8,NULL,NULL),(9,1,10,NULL,NULL),(10,2,10,NULL,NULL),(11,2,2,NULL,NULL),(12,2,8,NULL,NULL),(13,2,6,NULL,NULL),(14,2,7,NULL,NULL),(15,2,1,NULL,NULL),(16,3,2,NULL,NULL),(17,3,3,NULL,NULL),(18,3,8,NULL,NULL),(19,3,6,NULL,NULL),(20,3,7,NULL,NULL),(21,3,1,NULL,NULL),(22,4,2,NULL,NULL),(23,4,8,NULL,NULL),(24,4,1,NULL,NULL),(25,5,2,NULL,NULL),(26,5,8,NULL,NULL),(27,5,1,NULL,NULL),(28,6,2,NULL,NULL),(29,6,8,NULL,NULL),(30,6,1,NULL,NULL),(31,7,2,NULL,NULL),(32,7,8,NULL,NULL),(33,7,7,NULL,NULL),(34,7,6,NULL,NULL),(35,7,1,NULL,NULL),(36,8,8,NULL,NULL),(37,8,7,NULL,NULL),(38,8,6,NULL,NULL),(39,8,3,NULL,NULL),(40,8,1,NULL,NULL),(41,9,8,NULL,NULL),(42,9,7,NULL,NULL),(43,9,6,NULL,NULL),(44,9,3,NULL,NULL),(45,9,2,NULL,NULL),(46,9,1,NULL,NULL),(47,10,4,NULL,NULL),(48,10,1,NULL,NULL),(49,11,8,NULL,NULL),(50,11,6,NULL,NULL),(51,11,7,NULL,NULL),(52,11,1,NULL,NULL),(53,12,8,NULL,NULL),(54,12,6,NULL,NULL),(55,12,7,NULL,NULL),(56,12,1,NULL,NULL),(57,13,10,NULL,NULL),(58,13,8,NULL,NULL),(59,13,6,NULL,NULL),(60,13,7,NULL,NULL),(61,13,2,NULL,NULL),(62,13,1,NULL,NULL),(63,14,8,NULL,NULL),(64,14,2,NULL,NULL),(65,14,5,NULL,NULL),(66,14,1,NULL,NULL),(67,15,8,NULL,NULL),(68,15,2,NULL,NULL),(69,15,10,NULL,NULL),(70,15,7,NULL,NULL),(71,15,6,NULL,NULL),(72,15,1,NULL,NULL),(73,16,10,NULL,NULL),(74,16,1,NULL,NULL),(75,20,10,NULL,NULL),(76,20,1,NULL,NULL),(77,17,9,NULL,NULL),(78,17,1,NULL,NULL),(79,18,9,NULL,NULL),(80,18,1,NULL,NULL),(81,19,9,NULL,NULL),(82,19,1,NULL,NULL);
/*!40000 ALTER TABLE `brand_seller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Other','Other','2022-12-13 12:23:02','2022-12-13 12:23:02'),(2,'Platoon','Screens, General Accessories','2022-12-13 12:23:02','2022-12-13 12:23:02'),(3,'Jopus','Screens, General Accessories','2022-12-13 12:23:02','2022-12-13 12:23:02'),(4,'Syrox','Headphones Bluetooth Headphones, Cables, Chargers, Screens, Airpods','2022-12-13 12:23:02','2022-12-13 12:23:02'),(5,'Mabko','Cables, Headphones, Bluetooth Headphones, Screens, Airpods, Chargers','2022-12-13 12:23:02','2022-12-13 12:23:02'),(6,'Joylink','Cables, Chargers','2022-12-13 12:23:02','2022-12-13 12:23:02'),(7,'Veno','Bluetooth Headphones, iPhone\'s Headphones','2022-12-13 12:23:02','2022-12-13 12:23:02'),(8,'Simex','Screens, General Accessories','2022-12-13 12:23:02','2022-12-13 12:23:02'),(9,'Mytell','Screens, General Accessories','2022-12-13 12:23:02','2022-12-13 12:23:02'),(10,'Soffany','Chargers, Cables, Covers, Screens, General Accessories','2022-12-13 12:23:02','2022-12-13 12:23:02'),(11,'TGB','Cables, Earphones, General Accessories','2022-12-13 12:23:02','2022-12-13 12:23:02'),(12,'Phixi','Cables, Chargers, General Accessories','2022-12-13 12:23:02','2022-12-13 12:23:02'),(13,'i12','Bluetooth Airpods','2022-12-13 12:23:02','2022-12-13 12:23:02'),(14,'Kensa','Bluetooth Airpods, Chargers, Cables, Screens, Memory Cards, Flash Memory, Speakers ..etc','2022-12-13 12:23:02','2022-12-13 12:23:02'),(15,'Torima','Bluetooth Headphones, Chargers, Cables ..etc','2022-12-13 12:23:02','2022-12-13 12:23:02'),(16,'Sprange','Bluetooth Airpods, Cables ..etc','2022-12-13 12:23:02','2022-12-13 12:23:02'),(17,'Orchid','Perfume, Perfume Glasses, Perfume Accessories','2022-12-13 12:23:02','2022-12-13 12:23:02'),(18,'Orchid','Perfumes','2022-12-13 12:23:02','2022-12-13 12:23:02'),(19,'Toptanci Gifts','Gift boxes, Bags ...','2022-12-13 12:23:02','2022-12-13 12:23:02'),(20,'Concord','Bluetooth Airpods, Cables, tiktok lightining, Chargers, Speakers, Flash Memories, SD Cards ..etc','2022-12-13 12:23:02','2022-12-13 12:23:02');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_product`
--

DROP TABLE IF EXISTS `cart_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart_product` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `amount` int NOT NULL,
  `net_price` int NOT NULL,
  `saletype` int NOT NULL,
  `net_cost` int NOT NULL,
  `cart_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `cart_product_cart_id_foreign` (`cart_id`),
  KEY `cart_product_product_id_foreign` (`product_id`),
  CONSTRAINT `cart_product_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cart_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_product`
--

LOCK TABLES `cart_product` WRITE;
/*!40000 ALTER TABLE `cart_product` DISABLE KEYS */;
INSERT INTO `cart_product` VALUES (2,1,39999,4,222,1,1,'2022-12-13 12:30:42','2022-12-17 13:21:01','Description');
/*!40000 ALTER TABLE `cart_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
INSERT INTO `carts` VALUES (1,'2022-12-13 12:23:04','2022-12-13 12:23:04');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: not active, 1: Active',
  `category_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_category_id_foreign` (`category_id`),
  CONSTRAINT `categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Electronic','electronic',1,NULL,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(2,'Men','men',1,NULL,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(3,'Women','women',1,NULL,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(4,'Childrens','childrens',1,NULL,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(5,'Small Home Appliances','small-home-appliances',1,1,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(6,'Phones','phones',1,1,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(7,'Computer & Tablet','computer-tablet',1,1,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(8,'TV & Soundbar','tv-soundbar',1,1,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(9,'Clothes','clothes',1,2,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(10,'Shoe','shoe',1,2,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(11,'Personal care','personal-care',1,2,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(12,'Underwear','underwear',1,2,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(13,'Clothes','clothes',1,3,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(14,'Shoe','shoe',1,2,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(15,'Underwear','underwear',1,2,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(16,'Cosmetic','cosmetic',1,2,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(17,'Baby','baby',1,4,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(18,'Girls','girls',1,4,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(19,'Boys','boys',1,4,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(101,'Other','other',1,NULL,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(102,'Ironing Machine','ironing-machine',1,5,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(103,'Coffee Machine','coffee-machine',1,5,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(104,'Phone Cover & Case','phone-cover-case',1,6,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(105,'Phone Charger','phone-charger',1,6,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(106,'Phone Powerbank','phone-powerbank',1,6,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(107,'Earphone & Headset','earphone-headset',1,6,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(108,'Car Accessories','car-accessories',1,6,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(109,'Memory Card and Flash Memory','memory-card-and-flash-memory',1,6,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(110,'Other Items','other-items',1,6,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(111,'Tablet','tablet',1,7,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(112,'Monitor','monitor',1,7,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(113,'Computer Components','computer-components',1,7,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(114,'Network & Modems','network-modems',1,7,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(115,'TV','tv',1,8,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(116,'Speaker','speaker',1,8,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(117,'T-short','t-short',1,9,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(118,'Short','short',1,9,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(119,'Shirt','shirt',1,9,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(120,'Tracksuit','tracksuit',1,9,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(121,'Pants','pants',1,9,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(122,'Jacket','jacket',1,9,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(123,'Waistcoat','waistcoat',1,9,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(124,'Jumper','jumper',1,9,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(125,'SweatShirt','sweatshirt',1,9,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(126,'Sport Shoe','sport-shoe',1,10,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(127,'Clasic','clasic',1,10,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(128,'Winter Shoes','winter-shoes',1,10,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(129,'Perfume','perfume',1,11,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(130,'Boxer','boxer',1,12,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(131,'Sock','sock',1,12,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(132,'Pyjamas','pyjamas',1,12,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(133,'T-short','t-short',1,13,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(134,'Dress','dress',1,13,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(135,'Shirt','shirt',1,13,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(136,'Pants','pants',1,13,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(137,'Coats','coats',1,13,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(138,'Blouse','blouse',1,13,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(139,'Sport Shoe','sport-shoe',1,14,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(140,'Snow Boot','snow-boot',1,14,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(141,'Clasic','clasic',1,14,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(142,'Heeled shoes','heeled-shoes',1,14,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(143,'Sandals','sandals',1,14,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(144,'Slipper','slipper',1,14,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(145,'Sneaker','sneaker',1,14,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(146,'Nighty','nighty',1,15,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(147,'Sock','sock',1,15,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(148,'Pyjamas','pyjamas',1,15,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(149,'Bra','bra',1,15,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(150,'Fancy Clothing','fancy-clothing',1,15,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(151,'Perfume','perfume',1,16,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(152,'Eye make-up','eye-make-up',1,16,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(153,'Skin care','skin-care',1,16,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(154,'Hair care','hair-care',1,16,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(155,'Make-up','make-up',1,16,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(156,'Sexual Health','sexual-health',1,16,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(157,'Body Care','body-care',1,16,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(158,'Shower Gels & Creams','shower-gels-creams',1,16,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(159,'Lipstick','lipstick',1,16,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(160,'Suntan cream','suntan-cream',1,16,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(161,'Mop','mop',1,5,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(162,'Baby Sets','baby-sets',1,17,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(163,'Shoe','shoe',1,17,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(164,'Newborn Outfits','newborn-outfits',1,17,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(165,'Diaper','diaper',1,17,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(166,'Wet Wipes','wet-wipes',1,17,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(167,'Dress','dress',1,18,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(168,'Sweatshirt','sweatshirt',1,18,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(169,'Sport Shoe','sport-shoe',1,18,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(170,'Tracksuit','tracksuit',1,18,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(171,'Underwear & Pajamas','underwear-pajamas',1,18,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(172,'T-Shirt & Athlete','t-shirt-athlete',1,18,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(173,'Shorts','shorts',1,18,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(174,'Coats','coats',1,18,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(175,'Sweatshirt','sweatshirt',1,19,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(176,'Sport Shoe','sport-shoe',1,19,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(177,'Tracksuit','tracksuit',1,19,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(178,'Underwear & Pajamas','underwear-pajamas',1,19,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(179,'T-Shirt & Athlete','t-shirt-athlete',1,19,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(180,'Shorts','shorts',1,19,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(181,'Coats','coats',1,19,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(182,'Shirt','shirt',1,19,'2022-12-13 12:23:03','2022-12-13 12:23:03');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contributions`
--

DROP TABLE IF EXISTS `contributions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contributions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `amount` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deposit_date` date NOT NULL DEFAULT '2022-12-13',
  `due_date` date NOT NULL,
  `profits_percent` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0: working, 1: returned',
  `returned_date` date DEFAULT NULL,
  `contributor_id` bigint unsigned NOT NULL,
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
INSERT INTO `contributions` VALUES (1,100000000,'This one is for stocktaking so first will create bill.products and get the total cost and then edit this contribution amount and then edit the bill amount and then create the products in the database','2021-10-13','2022-10-13',100,0,NULL,1,'2021-10-12 21:00:00','2021-10-12 21:00:00'),(2,50000000,'Normal Contribution','2021-10-13','2022-10-13',100,0,NULL,1,'2021-10-12 21:00:00','2021-10-12 21:00:00');
/*!40000 ALTER TABLE `contributions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contributors`
--

DROP TABLE IF EXISTS `contributors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contributors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
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
INSERT INTO `contributors` VALUES (1,'Owner','5353402539','Owner',NULL,NULL),(2,'Contributor X','5353402539','Standart Contributor.',NULL,NULL);
/*!40000 ALTER TABLE `contributors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `debtors`
--

DROP TABLE IF EXISTS `debtors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `debtors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `debts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cost` int NOT NULL,
  `price` int NOT NULL,
  `amount` int NOT NULL,
  `is_paid` int NOT NULL DEFAULT '0',
  `due` date NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `debtor_id` bigint unsigned NOT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expenses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'store' COMMENT 'Shopping, Store, Loses',
  `description` text COLLATE utf8mb4_unicode_ci,
  `amount` int NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `bill_id` bigint unsigned DEFAULT NULL COMMENT 'used when type is store',
  `sale_id` bigint unsigned DEFAULT NULL COMMENT 'used when type is loses',
  `contribution_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_user_id_foreign` (`user_id`),
  KEY `expenses_bill_id_foreign` (`bill_id`),
  KEY `expenses_sale_id_foreign` (`sale_id`),
  KEY `expenses_contribution_id_foreign` (`contribution_id`),
  CONSTRAINT `expenses_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`),
  CONSTRAINT `expenses_contribution_id_foreign` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`),
  CONSTRAINT `expenses_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`),
  CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (1,'shopping',NULL,0,1,1,NULL,1,NULL,NULL),(2,'shopping',NULL,100000000,1,2,NULL,1,NULL,NULL);
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageable_id` bigint unsigned NOT NULL,
  `order` bigint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,'http://karman.dev/assets/images/categories/other.jpg','other','jpg','App\\Models\\Category',101,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(2,'http://karman.dev/assets/images/categories/electronic.jpg','electronic','jpg','App\\Models\\Category',1,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(3,'http://karman.dev/assets/images/categories/small-home-appliances.jpg','small-home-appliances','jpg','App\\Models\\Category',5,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(4,'http://karman.dev/assets/images/categories/phones.jpg','phones','jpg','App\\Models\\Category',6,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(5,'http://karman.dev/assets/images/categories/computer-tablet.jpg','computer-tablet','jpg','App\\Models\\Category',7,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(6,'http://karman.dev/assets/images/categories/tv-soundbar.jpg','tv-soundbar','jpg','App\\Models\\Category',8,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(7,'http://karman.dev/assets/images/categories/men.jpg','men','jpg','App\\Models\\Category',2,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(8,'http://karman.dev/assets/images/categories/clothes.jpg','clothes','jpg','App\\Models\\Category',9,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(9,'http://karman.dev/assets/images/categories/shoe.jpg','shoe','jpg','App\\Models\\Category',10,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(10,'http://karman.dev/assets/images/categories/personal-care.jpg','personal-care','jpg','App\\Models\\Category',11,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(11,'http://karman.dev/assets/images/categories/underwear.jpg','underwear','jpg','App\\Models\\Category',12,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(12,'http://karman.dev/assets/images/categories/women.jpg','women','jpg','App\\Models\\Category',3,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(13,'http://karman.dev/assets/images/categories/clothes.jpg','clothes','jpg','App\\Models\\Category',13,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(14,'http://karman.dev/assets/images/categories/shoe.jpg','shoe','jpg','App\\Models\\Category',14,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(15,'http://karman.dev/assets/images/categories/underwear.jpg','underwear','jpg','App\\Models\\Category',15,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(16,'http://karman.dev/assets/images/categories/cosmetic.jpg','cosmetic','jpg','App\\Models\\Category',16,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(17,'http://karman.dev/assets/images/categories/childrens.jpg','childrens','jpg','App\\Models\\Category',4,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(18,'http://karman.dev/assets/images/categories/baby.jpg','baby','jpg','App\\Models\\Category',17,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(19,'http://karman.dev/assets/images/categories/girls.jpg','girls','jpg','App\\Models\\Category',18,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(20,'http://karman.dev/assets/images/categories/boys.jpg','boys','jpg','App\\Models\\Category',19,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(21,'http://karman.dev/assets/images/categories/ironing-machine.jpg','ironing-machine','jpg','App\\Models\\Category',102,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(22,'http://karman.dev/assets/images/categories/coffee-machine.jpg','coffee-machine','jpg','App\\Models\\Category',103,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(23,'http://karman.dev/assets/images/categories/phone-cover-case.jpg','phone-cover-case','jpg','App\\Models\\Category',104,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(24,'http://karman.dev/assets/images/categories/phone-charger.jpg','phone-charger','jpg','App\\Models\\Category',105,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(25,'http://karman.dev/assets/images/categories/phone-powerbank.jpg','phone-powerbank','jpg','App\\Models\\Category',106,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(26,'http://karman.dev/assets/images/categories/earphone-headset.jpg','earphone-headset','jpg','App\\Models\\Category',107,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(27,'http://karman.dev/assets/images/categories/car-accessories.jpg','car-accessories','jpg','App\\Models\\Category',108,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(28,'http://karman.dev/assets/images/categories/memory-card-and-flash-memory.jpg','memory-card-and-flash-memory','jpg','App\\Models\\Category',109,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(29,'http://karman.dev/assets/images/categories/other-items.jpg','other-items','jpg','App\\Models\\Category',110,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(30,'http://karman.dev/assets/images/categories/tablet.jpg','tablet','jpg','App\\Models\\Category',111,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(31,'http://karman.dev/assets/images/categories/monitor.jpg','monitor','jpg','App\\Models\\Category',112,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(32,'http://karman.dev/assets/images/categories/computer-components.jpg','computer-components','jpg','App\\Models\\Category',113,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(33,'http://karman.dev/assets/images/categories/network-modems.jpg','network-modems','jpg','App\\Models\\Category',114,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(34,'http://karman.dev/assets/images/categories/tv.jpg','tv','jpg','App\\Models\\Category',115,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(35,'http://karman.dev/assets/images/categories/speaker.jpg','speaker','jpg','App\\Models\\Category',116,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(36,'http://karman.dev/assets/images/categories/t-short.jpg','t-short','jpg','App\\Models\\Category',117,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(37,'http://karman.dev/assets/images/categories/short.jpg','short','jpg','App\\Models\\Category',118,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(38,'http://karman.dev/assets/images/categories/shirt.jpg','shirt','jpg','App\\Models\\Category',119,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(39,'http://karman.dev/assets/images/categories/tracksuit.jpg','tracksuit','jpg','App\\Models\\Category',120,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(40,'http://karman.dev/assets/images/categories/pants.jpg','pants','jpg','App\\Models\\Category',121,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(41,'http://karman.dev/assets/images/categories/jacket.jpg','jacket','jpg','App\\Models\\Category',122,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(42,'http://karman.dev/assets/images/categories/waistcoat.jpg','waistcoat','jpg','App\\Models\\Category',123,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(43,'http://karman.dev/assets/images/categories/jumper.jpg','jumper','jpg','App\\Models\\Category',124,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(44,'http://karman.dev/assets/images/categories/sweatshirt.jpg','sweatshirt','jpg','App\\Models\\Category',125,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(45,'http://karman.dev/assets/images/categories/sport-shoe.jpg','sport-shoe','jpg','App\\Models\\Category',126,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(46,'http://karman.dev/assets/images/categories/clasic.jpg','clasic','jpg','App\\Models\\Category',127,0,'2022-12-13 12:23:02','2022-12-13 12:23:02'),(47,'http://karman.dev/assets/images/categories/winter-shoes.jpg','winter-shoes','jpg','App\\Models\\Category',128,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(48,'http://karman.dev/assets/images/categories/perfume.jpg','perfume','jpg','App\\Models\\Category',129,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(49,'http://karman.dev/assets/images/categories/boxer.jpg','boxer','jpg','App\\Models\\Category',130,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(50,'http://karman.dev/assets/images/categories/sock.jpg','sock','jpg','App\\Models\\Category',131,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(51,'http://karman.dev/assets/images/categories/pyjamas.jpg','pyjamas','jpg','App\\Models\\Category',132,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(52,'http://karman.dev/assets/images/categories/t-short.jpg','t-short','jpg','App\\Models\\Category',133,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(53,'http://karman.dev/assets/images/categories/dress.jpg','dress','jpg','App\\Models\\Category',134,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(54,'http://karman.dev/assets/images/categories/shirt.jpg','shirt','jpg','App\\Models\\Category',135,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(55,'http://karman.dev/assets/images/categories/pants.jpg','pants','jpg','App\\Models\\Category',136,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(56,'http://karman.dev/assets/images/categories/coats.jpg','coats','jpg','App\\Models\\Category',137,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(57,'http://karman.dev/assets/images/categories/blouse.jpg','blouse','jpg','App\\Models\\Category',138,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(58,'http://karman.dev/assets/images/categories/sport-shoe.jpg','sport-shoe','jpg','App\\Models\\Category',139,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(59,'http://karman.dev/assets/images/categories/snow-boot.jpg','snow-boot','jpg','App\\Models\\Category',140,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(60,'http://karman.dev/assets/images/categories/clasic.jpg','clasic','jpg','App\\Models\\Category',141,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(61,'http://karman.dev/assets/images/categories/heeled-shoes.jpg','heeled-shoes','jpg','App\\Models\\Category',142,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(62,'http://karman.dev/assets/images/categories/sandals.jpg','sandals','jpg','App\\Models\\Category',143,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(63,'http://karman.dev/assets/images/categories/slipper.jpg','slipper','jpg','App\\Models\\Category',144,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(64,'http://karman.dev/assets/images/categories/sneaker.jpg','sneaker','jpg','App\\Models\\Category',145,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(65,'http://karman.dev/assets/images/categories/nighty.jpg','nighty','jpg','App\\Models\\Category',146,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(66,'http://karman.dev/assets/images/categories/sock.jpg','sock','jpg','App\\Models\\Category',147,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(67,'http://karman.dev/assets/images/categories/pyjamas.jpg','pyjamas','jpg','App\\Models\\Category',148,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(68,'http://karman.dev/assets/images/categories/bra.jpg','bra','jpg','App\\Models\\Category',149,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(69,'http://karman.dev/assets/images/categories/fancy-clothing.jpg','fancy-clothing','jpg','App\\Models\\Category',150,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(70,'http://karman.dev/assets/images/categories/perfume.jpg','perfume','jpg','App\\Models\\Category',151,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(71,'http://karman.dev/assets/images/categories/eye-make-up.jpg','eye-make-up','jpg','App\\Models\\Category',152,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(72,'http://karman.dev/assets/images/categories/skin-care.jpg','skin-care','jpg','App\\Models\\Category',153,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(73,'http://karman.dev/assets/images/categories/hair-care.jpg','hair-care','jpg','App\\Models\\Category',154,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(74,'http://karman.dev/assets/images/categories/make-up.jpg','make-up','jpg','App\\Models\\Category',155,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(75,'http://karman.dev/assets/images/categories/sexual-health.jpg','sexual-health','jpg','App\\Models\\Category',156,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(76,'http://karman.dev/assets/images/categories/body-care.jpg','body-care','jpg','App\\Models\\Category',157,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(77,'http://karman.dev/assets/images/categories/shower-gels-creams.jpg','shower-gels-creams','jpg','App\\Models\\Category',158,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(78,'http://karman.dev/assets/images/categories/lipstick.jpg','lipstick','jpg','App\\Models\\Category',159,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(79,'http://karman.dev/assets/images/categories/suntan-cream.jpg','suntan-cream','jpg','App\\Models\\Category',160,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(80,'http://karman.dev/assets/images/categories/mop.jpg','mop','jpg','App\\Models\\Category',161,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(81,'http://karman.dev/assets/images/categories/baby-sets.jpg','baby-sets','jpg','App\\Models\\Category',162,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(82,'http://karman.dev/assets/images/categories/shoe.jpg','shoe','jpg','App\\Models\\Category',163,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(83,'http://karman.dev/assets/images/categories/newborn-outfits.jpg','newborn-outfits','jpg','App\\Models\\Category',164,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(84,'http://karman.dev/assets/images/categories/diaper.jpg','diaper','jpg','App\\Models\\Category',165,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(85,'http://karman.dev/assets/images/categories/wet-wipes.jpg','wet-wipes','jpg','App\\Models\\Category',166,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(86,'http://karman.dev/assets/images/categories/dress.jpg','dress','jpg','App\\Models\\Category',167,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(87,'http://karman.dev/assets/images/categories/sweatshirt.jpg','sweatshirt','jpg','App\\Models\\Category',168,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(88,'http://karman.dev/assets/images/categories/sport-shoe.jpg','sport-shoe','jpg','App\\Models\\Category',169,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(89,'http://karman.dev/assets/images/categories/tracksuit.jpg','tracksuit','jpg','App\\Models\\Category',170,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(90,'http://karman.dev/assets/images/categories/underwear-pajamas.jpg','underwear-pajamas','jpg','App\\Models\\Category',171,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(91,'http://karman.dev/assets/images/categories/t-shirt-athlete.jpg','t-shirt-athlete','jpg','App\\Models\\Category',172,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(92,'http://karman.dev/assets/images/categories/shorts.jpg','shorts','jpg','App\\Models\\Category',173,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(93,'http://karman.dev/assets/images/categories/coats.jpg','coats','jpg','App\\Models\\Category',174,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(94,'http://karman.dev/assets/images/categories/sweatshirt.jpg','sweatshirt','jpg','App\\Models\\Category',175,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(95,'http://karman.dev/assets/images/categories/sport-shoe.jpg','sport-shoe','jpg','App\\Models\\Category',176,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(96,'http://karman.dev/assets/images/categories/tracksuit.jpg','tracksuit','jpg','App\\Models\\Category',177,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(97,'http://karman.dev/assets/images/categories/underwear-pajamas.jpg','underwear-pajamas','jpg','App\\Models\\Category',178,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(98,'http://karman.dev/assets/images/categories/t-shirt-athlete.jpg','t-shirt-athlete','jpg','App\\Models\\Category',179,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(99,'http://karman.dev/assets/images/categories/shorts.jpg','shorts','jpg','App\\Models\\Category',180,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(100,'http://karman.dev/assets/images/categories/coats.jpg','coats','jpg','App\\Models\\Category',181,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(101,'http://karman.dev/assets/images/categories/shirt.jpg','shirt','jpg','App\\Models\\Category',182,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(102,'http://karman.dev/assets/images/products/km-364/km-364_0.jpg','kensa-km-364-bluetooth-speaker','jpg','App\\Models\\Product',1,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(103,'http://karman.dev/assets/images/products/km-375/km-375_0.jpg','kensa-km-375-bluetooth-speaker','jpg','App\\Models\\Product',2,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(104,'http://karman.dev/assets/images/products/km-290/km-290_0.jpg','kensa-km-290-bluetooth-speaker','jpg','App\\Models\\Product',3,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(105,'http://karman.dev/assets/images/products/km-258/km-258_0.jpg','kensa-km-258-bluetooth-speaker','jpg','App\\Models\\Product',4,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(106,'http://karman.dev/assets/images/products/km-258/km-258_1.jpg','kensa-km-258-bluetooth-speaker','jpg','App\\Models\\Product',4,1,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(107,'http://karman.dev/assets/images/products/ko-120/ko-120_0.jpg','kensa-ko-120-gaming-headset','jpg','App\\Models\\Product',5,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(108,'http://karman.dev/assets/images/products/ko-130/ko-130_0.jpg','kensa-ko-130-gaming-headset','jpg','App\\Models\\Product',6,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(109,'http://karman.dev/assets/images/products/a-27/a-27_0.jpg','kensa-a-27-aux-audio-cable','jpg','App\\Models\\Product',7,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(110,'http://karman.dev/assets/images/products/js-80/js-80_0.jpg','jopus-ritmo-headphones-js-80','jpg','App\\Models\\Product',8,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(111,'http://karman.dev/assets/images/products/js-80/js-80_1.jpg','jopus-ritmo-headphones-js-80','jpg','App\\Models\\Product',8,1,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(112,'http://karman.dev/assets/images/products/js-80/js-80_2.jpg','jopus-ritmo-headphones-js-80','jpg','App\\Models\\Product',8,2,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(113,'http://karman.dev/assets/images/products/js-80/js-80_3.jpg','jopus-ritmo-headphones-js-80','jpg','App\\Models\\Product',8,3,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(114,'http://karman.dev/assets/images/products/js-80/js-80_4.jpg','jopus-ritmo-headphones-js-80','jpg','App\\Models\\Product',8,4,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(115,'http://karman.dev/assets/images/products/o-22/o-22_0.jpg','kensa-o-22-metal-body-type-c-otg','jpg','App\\Models\\Product',9,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(116,'http://karman.dev/assets/images/products/kts-1175/kts-1175_0.jpg','kts-1175-bluetooth-speaker','jpg','App\\Models\\Product',10,0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(117,'http://karman.dev/assets/images/products/kts-1175/kts-1175_1.jpg','kts-1175-bluetooth-speaker','jpg','App\\Models\\Product',10,1,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(118,'http://karman.dev/assets/images/products/kts-1175/kts-1175_2.jpg','kts-1175-bluetooth-speaker','jpg','App\\Models\\Product',10,2,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(119,'http://karman.dev/assets/images/products/kts-1175/kts-1175_3.jpg','kts-1175-bluetooth-speaker','jpg','App\\Models\\Product',10,3,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(120,'http://karman.dev/assets/images/slider/markalar.jpg','markalar','jpg','App\\Models\\Slider',1,0,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(121,'http://karman.dev/assets/images/slidercontent/kensa.jpg','kensa','jpg','App\\Models\\Slidercontent',1,0,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(122,'http://karman.dev/assets/images/slidercontent/sm_kensa.jpg','sm_kensa','jpg','App\\Models\\Slidercontent',1,0,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(123,'http://karman.dev/assets/images/slidercontent/syrox.jpg','syrox','jpg','App\\Models\\Slidercontent',2,0,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(124,'http://karman.dev/assets/images/slidercontent/sm_syrox.jpg','sm_syrox','jpg','App\\Models\\Slidercontent',2,0,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(125,'http://karman.dev/assets/images/slidercontent/simex.jpg','simex','jpg','App\\Models\\Slidercontent',3,0,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(126,'http://karman.dev/assets/images/slidercontent/sm_simex.jpg','sm_simex','jpg','App\\Models\\Slidercontent',3,0,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(127,'http://karman.dev/assets/images/slidercontent/concord.jpg','concord','jpg','App\\Models\\Slidercontent',4,0,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(128,'http://karman.dev/assets/images/slidercontent/sm_concord.jpg','sm_concord','jpg','App\\Models\\Slidercontent',4,0,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(129,'http://karman.dev/assets/images/slider/bugune_ozel.jpg','bugune_ozel','jpg','App\\Models\\Slider',2,0,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(130,'http://karman.dev/assets/images/slidercontent/kampanya_1.jpg','kampanya_1','jpg','App\\Models\\Slidercontent',5,0,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(131,'http://karman.dev/assets/images/slidercontent/sm_kampanya_1.jpg','sm_kampanya_1','jpg','App\\Models\\Slidercontent',5,0,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(132,'http://karman.dev/assets/images/slidercontent/kampanya_2.jpg','kampanya_2','jpg','App\\Models\\Slidercontent',6,0,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(133,'http://karman.dev/assets/images/slidercontent/sm_kampanya_2.jpg','sm_kampanya_2','jpg','App\\Models\\Slidercontent',6,0,'2022-12-13 12:23:04','2022-12-13 12:23:04');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incomes`
--

DROP TABLE IF EXISTS `incomes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `incomes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Cost, Profit',
  `amount` int NOT NULL,
  `sale_id` bigint unsigned NOT NULL,
  `contribution_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incomes_sale_id_foreign` (`sale_id`),
  KEY `incomes_contribution_id_foreign` (`contribution_id`),
  KEY `incomes_user_id_foreign` (`user_id`),
  CONSTRAINT `incomes_contribution_id_foreign` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`),
  CONSTRAINT `incomes_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
  CONSTRAINT `incomes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incomes`
--

LOCK TABLES `incomes` WRITE;
/*!40000 ALTER TABLE `incomes` DISABLE KEYS */;
/*!40000 ALTER TABLE `incomes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2020_05_21_100000_create_teams_table',1),(7,'2020_05_21_200000_create_team_user_table',1),(8,'2020_05_21_300000_create_team_invitations_table',1),(9,'2021_08_00_124401_create_carts_table',1),(10,'2021_08_10_173028_create_categories_table',1),(11,'2021_08_20_152842_create_sessions_table',1),(12,'2021_08_25_134856_create_contributors_table',1),(13,'2021_08_25_135119_create_contributions_table',1),(14,'2021_08_25_171711_create_sellers_table',1),(15,'2021_08_26_171711_create_bills_table',1),(16,'2021_08_26_171711_create_brands_table',1),(17,'2021_08_27_171711_create_products_table',1),(18,'2021_09_02_074818_create_cart_product_table',1),(19,'2021_09_06_121149_create_debtors_table',1),(20,'2021_09_06_121159_create_debts_table',1),(21,'2021_09_24_161455_create_sales_counters_table',1),(22,'2021_09_28_144001_create_saletypes_table',1),(23,'2021_09_28_144002_create_sales_table',1),(24,'2021_09_28_144003_create_expenses_table',1),(25,'2021_10_04_100234_create_incomes_table',1),(26,'2021_11_11_154722_create_products_containers_table',1),(27,'2021_12_03_145811_add_description_to_cart_product',1),(28,'2022_06_04_143731_create_brand_seller_table',1),(29,'2022_07_15_130025_create_products_databases_table',1),(30,'2022_10_04_174632_create_images_table',1),(31,'2022_10_04_184144_create_sliders_table',1),(32,'2022_10_04_184216_create_slidercontents_table',1),(33,'2022_10_07_112910_create_attributes_table',1),(34,'2022_10_08_115754_create_productsections_table',1),(35,'2022_10_08_135117_create_product_productsection_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
-- Table structure for table `product_productsection`
--

DROP TABLE IF EXISTS `product_productsection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_productsection` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `productsection_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_productsection_productsection_id_foreign` (`productsection_id`),
  KEY `product_productsection_product_id_foreign` (`product_id`),
  CONSTRAINT `product_productsection_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_productsection_productsection_id_foreign` FOREIGN KEY (`productsection_id`) REFERENCES `productsections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_productsection`
--

LOCK TABLES `product_productsection` WRITE;
/*!40000 ALTER TABLE `product_productsection` DISABLE KEYS */;
INSERT INTO `product_productsection` VALUES (1,1,1,NULL,NULL),(2,1,2,NULL,NULL),(3,1,3,NULL,NULL),(4,1,4,NULL,NULL),(5,1,5,NULL,NULL),(6,1,6,NULL,NULL),(7,2,1,NULL,NULL),(8,2,2,NULL,NULL),(9,2,3,NULL,NULL),(10,2,4,NULL,NULL),(11,2,5,NULL,NULL),(12,2,6,NULL,NULL),(13,3,1,NULL,NULL),(14,3,2,NULL,NULL),(15,3,3,NULL,NULL),(16,3,4,NULL,NULL),(17,3,5,NULL,NULL),(18,3,6,NULL,NULL);
/*!40000 ALTER TABLE `product_productsection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `serial` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Product Code ex: KH-K17',
  `amount` int NOT NULL COMMENT 'Amount in the stock.',
  `price` int NOT NULL COMMENT 'Selling Price.',
  `cost` int NOT NULL COMMENT 'The price of the product when you bought it.',
  `description` json DEFAULT NULL COMMENT 'array of Line Number => Description data structure.',
  `extra_attributes` json DEFAULT NULL,
  `bill_id` bigint unsigned NOT NULL,
  `brand_id` bigint unsigned NOT NULL,
  `seller_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `contribution_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_bill_id_foreign` (`bill_id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  KEY `products_seller_id_foreign` (`seller_id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_contribution_id_foreign` (`contribution_id`),
  KEY `products_user_id_foreign` (`user_id`),
  CONSTRAINT `products_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `products_contribution_id_foreign` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`),
  CONSTRAINT `products_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`),
  CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,8681749637980,'Kensa KM-364 Bluetooth Speaker','kensa-km-364-bluetooth-speaker','KM-364',0,39999,222,'{\"1\": \"This product will be sent by Talebetti\", \"2\": \"Compatible with all smart devices.\", \"3\": \"Warranty Period 24 months.\", \"4\": \"Bluetooth / Flash Memory / Memory Card\", \"5\": \"Ultra Bass Balance\", \"6\": \"Working Distance: ~10 meters\", \"7\": \"Options for use with aux audio cable, USB memory and memory card\", \"8\": \"Volume and music control keys\", \"9\": \"Ultra-powerful and impressive wireless audio experience\", \"10\": \"Eye-catching adjustable colorful LED lights\"}',NULL,1,11,1,1,1,1,'2022-12-13 12:23:03','2022-12-13 12:30:42'),(2,8681749638307,'Kensa KM-375 Bluetooth Speaker','kensa-km-375-bluetooth-speaker','KM-375',1,49999,222,'{\"1\": \"This product will be sent by Talebetti\", \"2\": \"Compatible with all smart devices.\", \"3\": \"Warranty Period 24 months.\", \"4\": \"Bluetooth / Flash Memory / Memory Card\", \"5\": \"Ultra Bass Balance\", \"6\": \"Working Distance: ~10 meters\", \"7\": \"Options for use with aux audio cable, USB memory and memory card\", \"8\": \"Volume and music control keys\", \"9\": \"Ultra-powerful and impressive wireless audio experience\"}','{\"color\": [{\"name\": \"Red\", \"image\": \"http://karman.dev/assets/images/products/km-375/km-375_0.jpg\", \"order\": 0, \"value\": \"red\", \"is_active\": 1}, {\"name\": \"Blue\", \"image\": \"http://karman.dev/assets/images/products/km-375/km-375_1.jpg\", \"order\": 1, \"value\": \"blue\", \"is_active\": 1}, {\"name\": \"White\", \"image\": \"http://karman.dev/assets/images/products/km-375/km-375_2.jpg\", \"order\": 2, \"value\": \"white\", \"is_active\": 1}]}',1,14,1,1,1,1,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(3,8681749637430,'Kensa KM-290 Bluetooth Speaker','kensa-km-290-bluetooth-speaker','KM-290',1,29999,222,'{\"1\": \"This product will be sent by Talebetti\", \"2\": \"Compatible with all smart devices.\", \"3\": \"Warranty Period 24 months.\", \"4\": \"Bluetooth / Flash Memory / Memory Card\", \"5\": \"Ultra Bass Balance\", \"6\": \"Working Distance: ~10 meters\", \"7\": \"Options for use with aux audio cable, USB memory and memory card\", \"8\": \"Volume and music control keys\", \"9\": \"Ultra-powerful and impressive wireless audio experience\"}',NULL,1,14,1,1,1,1,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(4,8681749633753,'Kensa KM-258 Bluetooth Speaker','kensa-km-258-bluetooth-speaker','KM-258',1,59999,222,'{\"1\": \"This product will be sent by Talebetti\\\"\", \"2\": \"Compatible with all smart devices.\\\"\", \"3\": \"Warranty Period 24 months.\\\"\", \"4\": \"Bluetooth / Flash Memory / Memory Card\\\"\", \"5\": \"Ultra Bass Balance\\\"\", \"6\": \"Working Distance: ~10 meters\\\"\", \"7\": \"Options for use with aux audio cable, USB memory and memory card\\\"\", \"8\": \"Volume and music control keys\\\"\", \"9\": \"Ultra-powerful and impressive wireless audio experience\\\"\", \"10\": \"Eye-catching adjustable colorful LED lights\"}','{\"color\": [{\"name\": \"Red\", \"image\": \"http://karman.dev/assets/images/products/km-258/km-258_0.jpg\", \"order\": 0, \"value\": \"red\", \"is_active\": 1}, {\"name\": \"Blue\", \"image\": \"http://karman.dev/assets/images/products/km-258/km-258_1.jpg\", \"order\": 1, \"value\": \"blue\", \"is_active\": 1}]}',1,14,1,1,1,1,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(5,8681749634477,'Kensa KO-120 Gaming Headset','kensa-ko-120-gaming-headset','KO-120',1,44999,222,'{\"1\": \"This product will be sent by Talebetti\", \"2\": \"On-Ear Headphones with Microphone\", \"3\": \"Warranty Period 24 months.\", \"4\": \"Call & Talk & Listen to Music\", \"5\": \"3.5MM Jack Input\", \"6\": \"Ultra Bass Balance\", \"7\": \"Compatible with all Jack input devices.\", \"8\": \"Easily portable with its foldable design\", \"9\": \"Enjoy your games with Extra Bass\", \"10\": \"Eye-catching colorful LED lights\"}',NULL,1,14,1,1,1,1,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(6,8681749635665,'Kensa KO-130 Gaming Headset','kensa-ko-130-gaming-headset','KO-130',1,34999,222,'{\"1\": \"This product will be sent by Talebetti\", \"2\": \"On-Ear Headphones with Microphone\", \"3\": \"Warranty Period 24 months.\", \"4\": \"Call & Talk & Listen to Music\", \"5\": \"3.5MM Jack Input\", \"6\": \"Ultra Bass Balance\", \"7\": \"Compatible with all Jack input devices.\", \"8\": \"Easily portable with its foldable design\", \"9\": \"Enjoy your games with Extra Bass\"}',NULL,1,14,1,1,1,1,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(7,8681749635665,'Kensa A-27 Aux Audio Cable','kensa-a-27-aux-audio-cable','A-27',1,31999,222,'{\"1\": \"This product will be sent by Talebetti\", \"2\": \"1.2m, 3.5mm Jack Cable\", \"3\": \"Warranty Period 24 months.\", \"4\": \"Music Audio Cable\", \"5\": \"3.5MM Jack Input\", \"6\": \"Speaking with Microphone\", \"7\": \"Compatible with all Jack input devices.\"}',NULL,1,14,1,1,1,1,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(8,8681749635665,'JOPUS Ritmo - Headphones JS-80','jopus-ritmo-headphones-js-80','js-80',1,39999,222,'{\"1\": \"This product will be sent by Talebetti\", \"2\": \"Wired headset\", \"3\": \"Extendable Headset\", \"4\": \"3.5MM Jack Input\", \"5\": \"Speaking with Microphone\", \"6\": \"Compatible with all Jack input devices.\"}','{\"color\": [{\"name\": \"Red\", \"image\": \"http://karman.dev/assets/images/products/js-80/js-80_0.jpg\", \"order\": 0, \"value\": \"red\", \"is_active\": 1}, {\"name\": \"Blue\", \"image\": \"http://karman.dev/assets/images/products/js-80/js-80_1.jpg\", \"order\": 1, \"value\": \"blue\", \"is_active\": 1}, {\"name\": \"White\", \"image\": \"http://karman.dev/assets/images/products/js-80/js-80_2.jpg\", \"order\": 2, \"value\": \"white\", \"is_active\": 1}, {\"name\": \"Black\", \"image\": \"http://karman.dev/assets/images/products/js-80/js-80_3.jpg\", \"order\": 3, \"value\": \"black\", \"is_active\": 1}, {\"name\": \"Green\", \"image\": \"http://karman.dev/assets/images/products/js-80/js-80_4.jpg\", \"order\": 4, \"value\": \"green\", \"is_active\": 1}, {\"name\": \"Pink\", \"image\": \"http://karman.dev/assets/images/products/js-80/js-80_5.jpg\", \"order\": 5, \"value\": \"pink\", \"is_active\": 1}]}',1,14,1,1,1,1,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(9,8681749635665,'Kensa O-22 Metal Body Type-C OTG','kensa-o-22-metal-body-type-c-otg','o-22',1,39999,222,'{\"1\": \"This product will be sent by Talebetti\", \"2\": \"Connection Type is Type-C\"}',NULL,1,12,1,1,1,1,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(10,8681749635665,'KTS-1175 Bluetooth Speaker','kts-1175-bluetooth-speaker','kts-1175',1,39999,222,'{\"1\": \"This product will be sent by Talebetti\", \"2\": \"8 inch bluetooth speaker.\", \"3\": \"Remote control and microphone\", \"4\": \"Wireless Transmission Range: up to 10 meters.\", \"5\": \"Output: 10W + 10W\", \"6\": \"Eye-catching colorful LED lights\"}',NULL,1,14,1,1,1,1,'2022-12-13 12:23:03','2022-12-13 12:23:03');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_containers`
--

DROP TABLE IF EXISTS `products_containers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products_containers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `container` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_created` int NOT NULL COMMENT '1 Products in Container Has been created in stock.',
  `bill_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_containers_bill_id_foreign` (`bill_id`),
  CONSTRAINT `products_containers_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_containers`
--

LOCK TABLES `products_containers` WRITE;
/*!40000 ALTER TABLE `products_containers` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_containers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_databases`
--

DROP TABLE IF EXISTS `products_databases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products_databases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `serial` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` json DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Product Code ex: KH-K17',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_databases_brand_id_foreign` (`brand_id`),
  KEY `products_databases_category_id_foreign` (`category_id`),
  CONSTRAINT `products_databases_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  CONSTRAINT `products_databases_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_databases`
--

LOCK TABLES `products_databases` WRITE;
/*!40000 ALTER TABLE `products_databases` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_databases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productsections`
--

DROP TABLE IF EXISTS `productsections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productsections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productsections`
--

LOCK TABLES `productsections` WRITE;
/*!40000 ALTER TABLE `productsections` DISABLE KEYS */;
INSERT INTO `productsections` VALUES (1,'On Sale',0,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(2,'Latest Products',1,'2022-12-13 12:23:03','2022-12-13 12:23:03'),(3,'Discounted products',2,'2022-12-13 12:23:03','2022-12-13 12:23:03');
/*!40000 ALTER TABLE `productsections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `net_price` int NOT NULL,
  `cost` int NOT NULL,
  `amount` int NOT NULL,
  `total` int NOT NULL,
  `profit` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'retail' COMMENT 'Wholesale|Retail|Units|Invoice|Other',
  `is_debt` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `saletype_id` bigint unsigned NOT NULL,
  `contribution_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_user_id_foreign` (`user_id`),
  KEY `sales_product_id_foreign` (`product_id`),
  KEY `sales_saletype_id_foreign` (`saletype_id`),
  KEY `sales_contribution_id_foreign` (`contribution_id`),
  CONSTRAINT `sales_contribution_id_foreign` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`),
  CONSTRAINT `sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `sales_saletype_id_foreign` FOREIGN KEY (`saletype_id`) REFERENCES `saletypes` (`id`),
  CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_counters`
--

DROP TABLE IF EXISTS `sales_counters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales_counters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `counter` int NOT NULL DEFAULT '1',
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_counters_product_id_foreign` (`product_id`),
  CONSTRAINT `sales_counters_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_counters`
--

LOCK TABLES `sales_counters` WRITE;
/*!40000 ALTER TABLE `sales_counters` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_counters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saletypes`
--

DROP TABLE IF EXISTS `saletypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `saletypes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Default' COMMENT 'Wholesale, Retail = Default, Invoice, Units',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saletypes`
--

LOCK TABLES `saletypes` WRITE;
/*!40000 ALTER TABLE `saletypes` DISABLE KEYS */;
INSERT INTO `saletypes` VALUES (1,'Default','Default Sale type is the retail selling',NULL,NULL),(2,'Wholesale','Wholesale type',NULL,NULL),(3,'Invoice','Invoice type: Internet, Electric, Water Bills ..etc',NULL,NULL),(4,'Units','Units type: Internet, Minutes, Apps cash, Google Play',NULL,NULL);
/*!40000 ALTER TABLE `saletypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sellers`
--

DROP TABLE IF EXISTS `sellers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sellers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sellers`
--

LOCK TABLES `sellers` WRITE;
/*!40000 ALTER TABLE `sellers` DISABLE KEYS */;
INSERT INTO `sellers` VALUES (1,'Default','00','-','2022-12-13 12:23:01','2022-12-13 12:23:01'),(2,'El-Khatib','5376014222','Semsitebrizi Mahallesi, Hatuniye Sk. No:9, 42030 Karatay/Konya','2022-12-13 12:23:01','2022-12-13 12:23:01'),(3,'Simex','03323526707','Semsitebrizi Mahallesi, Akif Pasa Sk., 42030 Karatay/Konya','2022-12-13 12:23:01','2022-12-13 12:23:01'),(4,'Soffany','5327272788','Tahtakale Mahallesi, Findikcilar Sk Pirhan, No:13, 34116 Fatih/Istanbul','2022-12-13 12:23:02','2022-12-13 12:23:02'),(5,'Kensa','5323412272','Demirtas Mh, Cemil Birsel Cd. No:13/A. Fatih Istanbul','2022-12-13 12:23:02','2022-12-13 12:23:02'),(6,'Toptanci 1','-','-','2022-12-13 12:23:02','2022-12-13 12:23:02'),(7,'Toptanci 2','-','-','2022-12-13 12:23:02','2022-12-13 12:23:02'),(8,'Ahmad Attrah','5524756466','Backbag Seller','2022-12-13 12:23:02','2022-12-13 12:23:02'),(9,'Orchid','5523138657','Zafer','2022-12-13 12:23:02','2022-12-13 12:23:02'),(10,'Concord','5321526442','Semsitebrizi Mah. Osmanbey Sk. No:5/C Karatay-Konya','2022-12-13 12:23:02','2022-12-13 12:23:02');
/*!40000 ALTER TABLE `sellers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
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
INSERT INTO `sessions` VALUES ('nNDWfZnAHfV7vMGrk47tCJQI0D4rW40zHEcsz4YH',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiejd6VTBhMXdyNWJLcExpUjhxZjRUcEFVYlhRZDhPRThJSENXQWdWaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9rYXJtYW4uZGV2L2JhY2tlbmQvcHJvZHVjdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkUlouM252cERlNXJqVXVtaUFkN3lNLjc3cmgvaDFUbFdMb1BiRmpwd2tPN3NacGZVQzFxclMiO30=',1671560799),('nyklhKD21iZ9GbR68pbMEya2uVfZ0foLAkDAKp51',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36','YToyOntzOjY6Il90b2tlbiI7czo0MDoiZmtRUU0zQlVLak5vYmZNTjRaZERDU1R5MjB1b3ZpQk9QUmFtQlh6UyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1671634006);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slidercontents`
--

DROP TABLE IF EXISTS `slidercontents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slidercontents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sm_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL,
  `slider_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slidercontents_slider_id_foreign` (`slider_id`),
  CONSTRAINT `slidercontents_slider_id_foreign` FOREIGN KEY (`slider_id`) REFERENCES `sliders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slidercontents`
--

LOCK TABLES `slidercontents` WRITE;
/*!40000 ALTER TABLE `slidercontents` DISABLE KEYS */;
INSERT INTO `slidercontents` VALUES (1,'Kensa Products','20% net discount in cart','#','kensa','sm_kensa',0,1,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(2,'Syrox Products','20% net discount in cart','#','syrox','sm_syrox',1,1,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(3,'Simex Products','20% net discount in cart','#','simex','sm_simex',2,1,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(4,'Concord Products','20% net discount in cart','#','concord','sm_concord',3,1,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(5,'Practical Kitchen Products','Affordable prices','#','kampanya_1','sm_kampanya_1',0,1,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(6,'Most Popular Pet Shop products','50 TL discount for 450 TL','#','kampanya_2','sm_kampanya_2',0,1,'2022-12-13 12:23:04','2022-12-13 12:23:04');
/*!40000 ALTER TABLE `slidercontents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Image name',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: off, 1: on',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES (1,'Markalar','markalar',1,0,'2022-12-13 12:23:04','2022-12-13 12:23:04'),(2,'Bugüne Özel','bugune_ozel',1,1,'2022-12-13 12:23:04','2022-12-13 12:23:04');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_invitations`
--

DROP TABLE IF EXISTS `team_invitations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team_invitations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint unsigned NOT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` int NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'non-editable and will be created automatically',
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
INSERT INTO `users` VALUES (1,'Admin',1,'admin@gmail.com',NULL,'2022-12-13 12:23:01','$2y$10$RZ.3nvpDe5rjUumiAd7yM.77rh/h1TlWLoPbFjpwkO7sZpfUC1qrS',NULL,NULL,NULL,NULL,NULL,'2022-12-13 12:23:01','2022-12-13 12:23:01'),(2,'User01',0,'user01@gmail.com',NULL,'2022-12-13 12:23:01','$2y$10$nEhln6vBoCJFkxEKYorf4uFaWDneUdUuS3nTkXLWcpgqgR8lQA54y',NULL,NULL,NULL,NULL,NULL,'2022-12-13 12:23:01','2022-12-13 12:23:01');
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

-- Dump completed on 2022-12-23 16:04:22
