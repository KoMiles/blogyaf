-- MySQL dump 10.13  Distrib 5.5.20, for Win32 (x86)
--
-- Host: localhost    Database: blogyaf
-- ------------------------------------------------------
-- Server version	5.5.20-log

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
-- Table structure for table `em_attachment`
--

DROP TABLE IF EXISTS `em_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `em_attachment` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blogid` int(10) unsigned NOT NULL DEFAULT '0',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `filesize` int(10) NOT NULL DEFAULT '0',
  `filepath` varchar(255) NOT NULL DEFAULT '',
  `addtime` bigint(20) NOT NULL DEFAULT '0',
  `width` int(10) NOT NULL DEFAULT '0',
  `height` int(10) NOT NULL DEFAULT '0',
  `mimetype` varchar(40) NOT NULL DEFAULT '',
  `thumfor` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`),
  KEY `blogid` (`blogid`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `em_blog`
--

DROP TABLE IF EXISTS `em_blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `em_blog` (
  `gid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `date` bigint(20) NOT NULL,
  `content` longtext NOT NULL,
  `excerpt` longtext NOT NULL,
  `alias` varchar(200) NOT NULL DEFAULT '',
  `author` int(10) NOT NULL DEFAULT '1',
  `sortid` int(10) NOT NULL DEFAULT '-1',
  `type` varchar(20) NOT NULL DEFAULT 'blog',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `comnum` int(10) unsigned NOT NULL DEFAULT '0',
  `attnum` int(10) unsigned NOT NULL DEFAULT '0',
  `top` enum('n','y') NOT NULL DEFAULT 'n',
  `sortop` enum('n','y') NOT NULL DEFAULT 'n',
  `hide` enum('n','y') NOT NULL DEFAULT 'n',
  `checked` enum('n','y') NOT NULL DEFAULT 'y',
  `allow_remark` enum('n','y') NOT NULL DEFAULT 'y',
  `password` varchar(255) NOT NULL DEFAULT '',
  `template` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`gid`),
  KEY `date` (`date`),
  KEY `author` (`author`),
  KEY `sortid` (`sortid`),
  KEY `type` (`type`),
  KEY `views` (`views`),
  KEY `comnum` (`comnum`),
  KEY `hide` (`hide`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `em_comment`
--

DROP TABLE IF EXISTS `em_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `em_comment` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gid` int(10) unsigned NOT NULL DEFAULT '0',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `date` bigint(20) NOT NULL,
  `poster` varchar(20) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `mail` varchar(60) NOT NULL DEFAULT '',
  `url` varchar(75) NOT NULL DEFAULT '',
  `ip` varchar(128) NOT NULL DEFAULT '',
  `hide` enum('n','y') NOT NULL DEFAULT 'n',
  PRIMARY KEY (`cid`),
  KEY `gid` (`gid`),
  KEY `date` (`date`),
  KEY `hide` (`hide`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `em_link`
--

DROP TABLE IF EXISTS `em_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `em_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sitename` varchar(30) NOT NULL DEFAULT '',
  `siteurl` varchar(75) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `hide` enum('n','y') NOT NULL DEFAULT 'n',
  `taxis` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `em_navi`
--

DROP TABLE IF EXISTS `em_navi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `em_navi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `naviname` varchar(30) NOT NULL DEFAULT '',
  `url` varchar(75) NOT NULL DEFAULT '',
  `newtab` enum('n','y') NOT NULL DEFAULT 'n',
  `hide` enum('n','y') NOT NULL DEFAULT 'n',
  `taxis` int(10) unsigned NOT NULL DEFAULT '0',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `isdefault` enum('n','y') NOT NULL DEFAULT 'n',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `type_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `em_options`
--

DROP TABLE IF EXISTS `em_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `em_options` (
  `option_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) NOT NULL,
  `option_value` longtext NOT NULL,
  PRIMARY KEY (`option_id`),
  KEY `option_name` (`option_name`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `em_reply`
--

DROP TABLE IF EXISTS `em_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `em_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(10) unsigned NOT NULL DEFAULT '0',
  `date` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `hide` enum('n','y') NOT NULL DEFAULT 'n',
  `ip` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `gid` (`tid`),
  KEY `hide` (`hide`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `em_sort`
--

DROP TABLE IF EXISTS `em_sort`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `em_sort` (
  `sid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sortname` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(200) NOT NULL DEFAULT '',
  `taxis` int(10) unsigned NOT NULL DEFAULT '0',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `template` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `em_tag`
--

DROP TABLE IF EXISTS `em_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `em_tag` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tagname` varchar(60) NOT NULL DEFAULT '',
  `gid` text NOT NULL,
  PRIMARY KEY (`tid`),
  KEY `tagname` (`tagname`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `em_twitter`
--

DROP TABLE IF EXISTS `em_twitter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `em_twitter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `img` varchar(200) DEFAULT NULL,
  `author` int(10) NOT NULL DEFAULT '1',
  `date` bigint(20) NOT NULL,
  `replynum` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `author` (`author`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `em_user`
--

DROP TABLE IF EXISTS `em_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `em_user` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL DEFAULT '',
  `nickname` varchar(20) NOT NULL DEFAULT '',
  `role` varchar(60) NOT NULL DEFAULT '',
  `ischeck` enum('n','y') NOT NULL DEFAULT 'n',
  `photo` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-14 22:10:05
