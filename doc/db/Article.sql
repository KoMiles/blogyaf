-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: komo
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.04.1

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
-- Table structure for table `Article`
--

DROP TABLE IF EXISTS `Article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Article` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `author` varchar(60) DEFAULT NULL COMMENT '文章作者',
  `title` varchar(255) DEFAULT NULL COMMENT '文章标题',
  `content` text COMMENT '文章内容',
  `status` enum('normal','delete') NOT NULL DEFAULT 'normal' COMMENT '文章状态',
  `create_ts` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_ts` int(10) NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Article`
--

LOCK TABLES `Article` WRITE;
/*!40000 ALTER TABLE `Article` DISABLE KEYS */;
INSERT INTO `Article` VALUES (1,'author1','title1','content1','normal',1432261200,1432261260),(4,'author2','title2','content2','normal',1432261200,1432261260),(5,'author2','title2','content2','normal',1432261200,1432261260),(6,'author2','title2','content2','normal',1432261200,1432261260),(7,'author2','title2','content2','normal',1432261200,1432261260),(8,'author2','title2','content2','normal',1432261200,1432261260),(9,'author2','title2','content2','normal',1432261200,1432261260),(10,'author2','title2','content2','normal',1432261200,1432261260),(11,'author2','title2','content2','normal',1432261200,1432261260),(12,'author2','title2','content2','normal',1432261200,1432261260),(13,'author2','title2','content2','normal',1432261200,1432261260),(14,'author2','title2','content2','normal',1432261200,1432261260),(15,'author2','title2','content2','normal',1432261200,1432261260),(16,'author2','title2','content2','normal',1432261200,1432261260),(17,'author1','title1','content1','normal',1432261200,1432261260),(18,'author1','title1','content1','normal',1432261200,1432261260),(19,'author1','title1','content1','normal',1432261200,1432261260),(20,'author1','title1','content1','normal',1432261200,1432261260),(21,'author1','title1','content1','normal',1432261200,1432261260),(22,'author2','title2','content2','normal',1432261200,1432261260),(23,'author2','title2','content2','normal',1432261200,1432261260),(24,'author1','title1','content1','normal',1432261200,1432261260),(25,'author1','title1','content1','normal',1432261200,1432261260),(26,'author1','title1','content1','normal',1432261200,1432261260),(27,'author1','title1','content1','normal',1432261200,1432261260),(28,'author1','title1','content1','normal',1432261200,1432261260),(29,'author1','title1','content1','normal',1432261200,1432261260),(30,'author1','title1','content1','normal',1432261200,1432261260),(31,'author2','title2','content2','normal',1432261200,1432261260),(32,'author2','title2','content2','normal',1432261200,1432261260),(33,'author2','title2','content2','normal',1432261200,1432261260),(34,'author1','title1','content1','normal',1432261200,1432261260),(41,'你好啊','b','在w3school，你可以找到你所需要的所有的网站建设教程。','normal',1433934273,1433934273),(42,'我好','你好','大家号阿訇。','normal',1433993520,1433993520),(43,'我好','你好','大家号阿訇。啊啊','normal',1433993602,1433993602);
/*!40000 ALTER TABLE `Article` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-11 19:28:16
