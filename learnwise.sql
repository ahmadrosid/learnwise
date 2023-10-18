-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: localhost    Database: learnwise
-- ------------------------------------------------------
-- Server version	8.0.34

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Psychology','psychology','2023-10-17 23:42:40','2023-10-17 23:42:40'),(2,'Art','art','2023-10-17 23:42:40','2023-10-17 23:42:40'),(3,'Business','business','2023-10-17 23:42:40','2023-10-17 23:42:40'),(4,'Photography','photography','2023-10-17 23:42:40','2023-10-17 23:42:40'),(5,'Computer Science','computer-science','2023-10-17 23:42:40','2023-10-17 23:42:40'),(6,'Programming','programming','2023-10-17 23:42:40','2023-10-17 23:42:40'),(7,'Food and Beverages','food-and beverages','2023-10-17 23:42:40','2023-10-17 23:42:40');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapters`
--

DROP TABLE IF EXISTS `chapters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chapters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `is_free` tinyint(1) NOT NULL DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `position` int DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapters`
--

LOCK TABLES `chapters` WRITE;
/*!40000 ALTER TABLE `chapters` DISABLE KEYS */;
INSERT INTO `chapters` VALUES (1,'The Art of Painting','Explore the techniques and history of various painting styles.','2023-10-18 06:42:40',NULL,2,1,1,1,'chapter1_video.mp4'),(2,'Effective Marketing Strategies','Learn how to create successful marketing campaigns and reach your target audience.','2023-10-18 06:42:40',NULL,3,1,1,1,'chapter1_video.mp4'),(3,'Modern Art Movements','Discover modern art movements and their impact on contemporary art.','2023-10-18 06:42:40',NULL,2,0,1,2,'chapter2_video.mp4'),(4,'Financial Planning for Businesses','Master financial planning and management in the corporate world.','2023-10-18 06:42:40',NULL,3,1,1,2,'chapter2_video.mp4'),(5,'Introduction | Is programming for me?','In this chapter you find out what it takes to be a software developer which further gives you quite a clear idea whether you believe you are the person for the job.','2023-10-18 06:42:40',NULL,4,1,1,1,'chapter6_video.mp4'),(6,'Yes! I am the person for the job! What\'s next?','This chapter will provide you with fundamental of software development in general, tools that you need and many more','2023-10-18 06:42:40',NULL,4,3,1,2,'chapter7_video.mp4'),(7,'Where do you get that?','We dive deeper into the core of the universe by exploring the ...','2023-10-18 06:42:40',NULL,4,1,1,3,'3'),(8,'Exploring the Basics','An Introduction to Psychology and Human Behavior','2023-10-18 06:42:40',NULL,1,1,0,1,'chapter1_video.mp4'),(9,'The Mind Unveiled','A Beginner\'s Guide to Understanding Human Behavior','2023-10-18 06:42:40',NULL,1,0,0,2,'chapter1_video.mp4'),(10,'Psychology 101','A Primer on the Fundamentals of Human Behavior','2023-10-18 06:42:40',NULL,1,0,0,3,'chapter1_video.mp4'),(11,'Nature vs. Nurture','The Role of Genetics and Environment in Human Behavior','2023-10-18 06:42:40',NULL,1,0,0,4,'chapter1_video.mp4'),(12,'The Psychology of Emotions','How Feelings Shape Human Behavior','2023-10-18 06:42:40',NULL,1,0,0,5,'chapter1_video.mp4'),(13,'Cognitive Processes','Unraveling the Mysteries of Human Thinking and Decision-Making','2023-10-18 06:42:40',NULL,1,0,0,6,'chapter1_video.mp4'),(14,'Applied Psychology','Practical Insights into Understanding and Influencing Human Behavior','2023-10-18 06:42:40',NULL,1,0,0,7,'chapter1_video.mp4');
/*!40000 ALTER TABLE `chapters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `category_id` int NOT NULL DEFAULT '1',
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `price` int NOT NULL DEFAULT '0',
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_slug_unique` (`slug`),
  KEY `courses_user_id_foreign` (`user_id`),
  CONSTRAINT `courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'Introduction to Psychology','Explore the human mind and behavior in this introductory psychology course.','2023-10-17 23:42:40','2023-10-17 23:42:40',1,1,1,50,'https://images.unsplash.com/photo-1528642474498-1af0c17fd8c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80','introduction-to-psychology'),(2,'Art Appreciation and Techniques','Discover the world of art, from appreciation to hands-on techniques.','2023-10-17 23:42:40','2023-10-17 23:42:40',2,2,1,60,'https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1pYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80','art-appreciation-and-techniques'),(3,'Business Strategies for Success','Learn essential business strategies and tactics to achieve success in the corporate world.','2023-10-17 23:42:40','2023-10-17 23:42:40',3,3,1,40,'https://images.unsplash.com/photo-1578574577315-3fbeb0cecdc2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1172&q=80','business-strategies-for-success'),(4,'Web Developments| Where to start?','This course is intended for you who ask: Is computer programming for me?','2023-10-17 23:42:40','2023-10-17 23:42:40',1,6,0,11,'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80','web-developments-where-to-start'),(5,'Absolute Beginner Guide to Calligraphy and Beautiful Handwriting','Begin your enchanting journey into the world of calligraphy and the art of beautiful handwriting. This course is tailored for absolute beginners, offering step-by-step guidance in mastering the graceful strokes of calligraphy and the techniques behind creating stunning, artistic handwriting. Join us and unveil the secrets to crafting exquisite letters and elegant script.','2023-10-17 23:42:40','2023-10-17 23:42:40',3,2,0,5,'https://images.unsplash.com/photo-1564630322990-4a9e93d13946?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1160&q=80','absolute-beginner-guide-to-calligraphy-and-beautiful-handwriting'),(6,'Understanding Color','Embark on a colorful journey into the realm of art and emotion. Explore the captivating world of color, its role in conveying emotions, and its profound impact on artistic expression. Join us and gain a deeper understanding of how color influences our perceptions and the beauty it brings to the canvas of life.','2023-10-17 23:42:40','2023-10-17 23:42:40',4,2,0,7,'https://images.unsplash.com/photo-1502691876148-a84978e59af8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80','understanding-color'),(7,'34 Indonesian recipes that you can try at home','In this course you will watch video and cook along with me and enjoy your favorite Indonesian cuisine.','2023-10-17 23:42:40','2023-10-17 23:42:40',3,7,0,8,'https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80','34-indonesian-recipes-that-you-can-try-at-home'),(8,'Photography - Become a pro shooter in 20 hours','This course will give you all you need to start taking beautiful pictures even with using your smartphone camera. Besides you\'ll also learn how to make it a lot nicer in photo editors softwares such as photoshop and gimp.','2023-10-17 23:42:40','2023-10-17 23:42:40',5,4,0,4,'https://images.unsplash.com/photo-1542038784456-1ea8e935640e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80','photography-become-a-pro-shooter-in-20-hours'),(9,'Making Soto - One of the most iconic indonesian cuisine.','Indonesian is rich, and soto is one of those. Here we have Soto Banjar, Soto Betawi, Soto Madura and many more.','2023-10-17 23:42:40','2023-10-17 23:42:40',5,7,0,6,'https://images.unsplash.com/photo-1572656306390-40a9fc3899f7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80','making-soto-one-of-the-most-iconic-indonesian-cuisine.'),(10,'Learn Python Programming Language to Automate your daily tasks.','Master Python for daily task automation. Unleash the potential of Python to streamline your everyday activities. Join us and automate your life','2023-10-17 23:42:40','2023-10-17 23:42:40',3,5,0,0,'https://images.unsplash.com/photo-1628853210688-acf6bfeb5daf?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80','learn-python-programming-language-to-automate-your-daily-tasks.'),(11,'Understanding kids','Explore the world of child psychology and self-development. Gain valuable insights into understanding and nurturing the minds of children. Join us on this journey of discovery and growth.','2023-10-17 23:42:40','2023-10-17 23:42:40',3,1,0,7,'https://plus.unsplash.com/premium_photo-1686836995180-06df3b20884e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80','understanding-kids'),(12,'How to sell anything?','Unlock the art of selling and grow your business exponentially. Discover the secrets of effective sales techniques, persuasion, and closing deals. Join us and learn how to confidently sell anything to anyone, driving your success to new heights.','2023-10-17 23:42:40','2023-10-17 23:42:40',3,3,0,6,'https://images.unsplash.com/photo-1556742212-5b321f3c261b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80','how-to-sell-anything'),(13,'Understanding Women','Delve into the complexities and insights of understanding women. Explore the nuances of relationships, communication, and personal growth. Join us on this path of self-discovery and building meaningful connections.','2023-10-17 23:42:40','2023-10-17 23:42:40',3,1,0,7,'https://images.unsplash.com/photo-1590650046871-92c887180603?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80','understanding-women'),(14,'Understanding Men','Gain valuable insights into the world of men and masculinity. Explore their perspectives, behaviors, and personal development. Join us on a journey of understanding and connection.','2023-10-17 23:42:40','2023-10-17 23:42:40',4,1,0,9,'https://images.unsplash.com/photo-1490578474895-699cd4e2cf59?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1171&q=80','understanding-men');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (243,'2014_10_12_000000_create_users_table',1),(244,'2014_10_12_100000_create_password_reset_tokens_table',1),(245,'2019_08_19_000000_create_failed_jobs_table',1),(246,'2019_12_14_000001_create_personal_access_tokens_table',1),(247,'2023_10_16_130455_create_categories_table',1),(248,'2023_10_16_130511_create_courses_table',1),(249,'2023_10_16_130525_create_chapters_table',1),(250,'2023_10_16_130552_create_purchases_table',1),(251,'2023_10_16_130605_create_progresses_table',1),(252,'2023_10_17_095353_add_slug_to_courses_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
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
  `expires_at` timestamp NULL DEFAULT NULL,
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
-- Table structure for table `progresses`
--

DROP TABLE IF EXISTS `progresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `progresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `chapter_id` bigint unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `progresses_user_id_foreign` (`user_id`),
  KEY `progresses_course_id_foreign` (`course_id`),
  KEY `progresses_chapter_id_foreign` (`chapter_id`),
  CONSTRAINT `progresses_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`),
  CONSTRAINT `progresses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `progresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progresses`
--

LOCK TABLES `progresses` WRITE;
/*!40000 ALTER TABLE `progresses` DISABLE KEYS */;
INSERT INTO `progresses` VALUES (1,2,1,8,'2023-10-18 06:42:40',NULL),(2,2,1,9,'2023-10-18 06:42:40',NULL),(3,2,1,10,'2023-10-18 06:42:40',NULL);
/*!40000 ALTER TABLE `progresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `purchases_user_id_foreign` (`user_id`),
  KEY `purchases_course_id_foreign` (`course_id`),
  CONSTRAINT `purchases_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
INSERT INTO `purchases` VALUES (1,2,1,'2023-10-18 06:42:40');
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
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
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John Doe','johndoe@mail.com',NULL,'$2b$12$ma3bfhM9/ucsyMJbMII2GOKIVHvnXh4b.l62cTsf5ta8jFC2coSaK',NULL,'student','2023-10-17 23:42:40','2023-10-17 23:42:40'),(2,'Alice Smith','alicesmith@mail.com',NULL,'$2b$12$ma3bfhM9/ucsyMJbMII2GOKIVHvnXh4b.l62cTsf5ta8jFC2coSaK',NULL,'student','2023-10-17 23:42:40','2023-10-17 23:42:40'),(3,'David Brown','davidbrown@mail.com',NULL,'$2b$12$ma3bfhM9/ucsyMJbMII2GOKIVHvnXh4b.l62cTsf5ta8jFC2coSaK',NULL,'student','2023-10-17 23:42:40','2023-10-17 23:42:40'),(4,'Emily Johnson','emilyjohnson@mail.com',NULL,'$2b$12$ma3bfhM9/ucsyMJbMII2GOKIVHvnXh4b.l62cTsf5ta8jFC2coSaK',NULL,'student','2023-10-17 23:42:40','2023-10-17 23:42:40'),(5,'Michael Davis','michaeldavis@mail.com',NULL,'$2b$12$ma3bfhM9/ucsyMJbMII2GOKIVHvnXh4b.l62cTsf5ta8jFC2coSaK',NULL,'student','2023-10-17 23:42:40','2023-10-17 23:42:40');
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

-- Dump completed on 2023-10-18 14:40:42
