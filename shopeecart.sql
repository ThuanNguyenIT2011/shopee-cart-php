-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: shoppycart
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Nguyen','Thuan','nvt@gmail.com','20112002');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (4,'Mobiles'),(5,'Cameras'),(10,'Books');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderitems`
--

DROP TABLE IF EXISTS `orderitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orderitems` (
  `id` int NOT NULL AUTO_INCREMENT,
  `orderid` int DEFAULT NULL,
  `productid` int DEFAULT NULL,
  `quant` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderitems`
--

LOCK TABLES `orderitems` WRITE;
/*!40000 ALTER TABLE `orderitems` DISABLE KEYS */;
INSERT INTO `orderitems` VALUES (1,6,8,2,3900),(2,6,6,2,40400),(3,7,5,1,27898),(4,7,7,1,4499),(5,7,8,1,3900),(6,8,11,1,28980),(7,9,11,1,28980),(8,9,5,1,27898),(9,9,9,1,399),(10,10,11,1,28980),(11,10,6,10,40400),(12,10,7,100,4499),(13,12,5,1,27898),(14,12,8,1,3900),(15,13,11,1,28980),(16,14,7,1,4499),(17,14,12,1,12),(18,14,8,1,3900),(19,14,11,1,28980),(20,15,5,1,27898),(21,15,6,1,40400),(22,15,7,1,4499),(23,15,8,1,3900),(24,16,8,1000,3900),(25,17,5,1,27898),(26,18,8,10,3900),(27,19,8,112,3900),(28,20,7,1,4499),(29,20,6,1435,40400);
/*!40000 ALTER TABLE `orderitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int DEFAULT NULL,
  `totalprice` int DEFAULT NULL,
  `paymentnode` varchar(255) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `orderstatus` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (6,7,88600,'code','2023-01-29 12:36:43','Cancelled'),(7,7,36297,'code','2023-01-29 12:50:53',''),(8,7,28980,'code','2023-01-29 12:55:04',''),(9,10,57277,'paypal','2023-01-29 12:56:15',''),(10,7,882880,'code','2023-01-29 17:23:06',''),(12,7,31798,'code','2023-01-29 18:32:43','Order Placed'),(13,7,28980,'code','2023-01-29 18:39:49','Cancelled'),(14,6,37391,'code','2023-01-30 07:57:36',''),(15,6,76697,'code','2023-01-30 08:02:46',''),(16,7,3900000,'code','2023-01-30 09:25:02','Cancelled'),(17,6,27898,'code','2023-02-01 15:32:09','Order Placed'),(18,6,39000,'cheque','2023-02-01 15:46:28','Cancelled'),(19,7,436800,'code','2023-02-01 17:29:05',''),(20,8,57978499,'code','2023-02-01 17:30:13','Cancelled');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordertracking`
--

DROP TABLE IF EXISTS `ordertracking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ordertracking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `orderid` int DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordertracking`
--

LOCK TABLES `ordertracking` WRITE;
/*!40000 ALTER TABLE `ordertracking` DISABLE KEYS */;
INSERT INTO `ordertracking` VALUES (1,6,NULL,'Cancelled','hahah'),(2,13,NULL,'Cancelled','jkjkhjkhjk'),(3,12,NULL,'status','asd'),(4,12,NULL,'Cancelled','khong thich'),(5,12,NULL,'status',''),(6,16,NULL,'status','fuck'),(7,17,NULL,'status','ok'),(8,18,NULL,'status','ok'),(9,18,NULL,'status','cancelled'),(10,20,NULL,'status','No');
/*!40000 ALTER TABLE `ordertracking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `catid` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (5,'Zhiyun Weebill S [Official] 3-Axis Gimbal Stabilizer for DSLR Cameras',5,27898,'uploads/cam2.jpg','【Compact Size as A4 Paper】 Ergonomically designed Sling mode to save effort and provide'),(6,'Canon EOS Rebel T7 DSLR Camera with 18-55mm Lens | Built-in Wi-Fi | 24.1 MP CMOS Sensor | DIGIC 4+ Image',5,40400,'uploads/cam1.jpg','24.1 Megapixel CMOS (APS-C) sensor with is 100–6400 (H: 12800)'),(7,'Clean Code: A Handbook of Agile Software Craftsmanship',10,4499,'uploads/book1.jpg','Even bad code can function. But if code isn’t clean, it can bring a development organization to its knees. Every year, countless hours and significant resources are lost because of poorly written code. But it doesn’t have to be that way.'),(8,'OtterBox COMMUTER SERIES for iPhone 14 Pro (ONLY) - BLACK',4,3900,'uploads/iphone1.jpg','DROP+ 3X as many drops as military standard (MIL-STD-810G 516.6) works with wireless and MagSafe charging pads (no magnets in case)'),(9,'Gounod: Roméo et Juliette (Highlights)',10,399,'uploads/book2.jpg','Even those who have never read or seen Romeo and Juliet recognize the star-crossed lovers\' names as symbols of forbidden romance.'),(10,'Minolta 20 Mega Pixels WiFiDigital Camera with 35x Optical',5,183,'uploads/cam3.jpg','20 Mega Pixels still image resolution with 1080p HD video resolution'),(11,'TracFone BLU View 2 (2022) 4G LTE, 32GB, Sim Card Included, Black - Prepaid Smartphone',4,28980,'uploads/iphone2.jpg','The all new BLU View 2 smartphone pushes the limit to the edge with a gorgeous 5.5”'),(12,'Atomic Habits: An Easy & Proven Way to Build Good Habits & Break Bad Ones',10,12,'uploads/book3.jpg','The #1 New York Times bestseller. Over 4 million copies sold! <br/>\r\nThe #2 New York Times bestseller. Over 4 million copies sold!');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `review` text,
  `timestamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,5,7,'Good','2002-11-20 12:00:00'),(8,7,6,'good','2023-02-01 15:43:21'),(9,7,6,'ok','2023-02-01 15:43:37');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6,'nvt@gmail.com','$2y$10$xEtk9RuZvomHwnN/6fSFGOKo8jAgoALoD/Ow5rk.5Uly4EJivefGC',NULL),(7,'nvt1@gmail.com','$2y$10$mnIfRaA8ATOxM28xIM5HDeMId1SOJQ/yFa6C4YkHGTaZrhAnvQkiW',NULL),(8,'nvt2@gmail.com','$2y$10$aH45PF2X29q9DzD6.1H15OV/a/GpONuMfQXolzMz/PJm7XvQCZFkK',NULL),(10,'nguyenvanthuan20112002@gmail.com','$2y$10$Fgi0GUmtgtfLAK7r57d30uTGuueE4iWtEMuiI/IkTcMiD.zR5Rkfm',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usersmeta`
--

DROP TABLE IF EXISTS `usersmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usersmeta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersmeta`
--

LOCK TABLES `usersmeta` WRITE;
/*!40000 ALTER TABLE `usersmeta` DISABLE KEYS */;
INSERT INTO `usersmeta` VALUES (3,7,'Nguyen','Thuan','PTIT','HCM','Quan 9','HCM','BD','113','12345678','hh'),(4,8,'ThuanIT','Beo','ThuanIT','BinhThuan','','1','DZ','3','112','2'),(5,10,'Thuan','Beo','PTITER','HAHA','HAHA','1','','3','113','2'),(6,6,'Nguyen Van','Thuan','ThuanIT','BinhThuan','Tanh Linh','1','BS','3','123','2');
/*!40000 ALTER TABLE `usersmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wishlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlist`
--

LOCK TABLES `wishlist` WRITE;
/*!40000 ALTER TABLE `wishlist` DISABLE KEYS */;
INSERT INTO `wishlist` VALUES (8,10,7,'2023-02-01 17:20:54'),(9,12,7,'2023-02-01 17:27:34');
/*!40000 ALTER TABLE `wishlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-02  0:02:30
