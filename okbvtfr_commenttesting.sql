-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: okbvtfr_commenttesting
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `acos`
--

DROP TABLE IF EXISTS `acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acos`
--

LOCK TABLES `acos` WRITE;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
INSERT INTO `acos` VALUES (189,NULL,'',NULL,'controllers',1,156),(190,189,'',NULL,'Commentaries',2,39),(191,190,'',NULL,'index',3,4),(192,190,'',NULL,'rss',5,6),(193,190,'',NULL,'view',7,8),(194,190,'',NULL,'add',9,10),(195,190,'',NULL,'edit',11,12),(196,190,'',NULL,'delete',13,14),(197,190,'',NULL,'tagged',15,16),(198,190,'',NULL,'tags',17,18),(199,190,'',NULL,'autopublish',19,20),(200,190,'',NULL,'drafts',21,22),(201,190,'',NULL,'publish',23,24),(202,190,'',NULL,'export',25,26),(203,190,'',NULL,'browse',27,28),(204,190,'',NULL,'generate_slugs',29,30),(205,190,'',NULL,'newsmedia_index',31,32),(206,190,'',NULL,'renderMessage',33,34),(207,189,'',NULL,'Groups',40,53),(208,207,'',NULL,'index',41,42),(209,207,'',NULL,'view',43,44),(210,207,'',NULL,'add',45,46),(211,207,'',NULL,'edit',47,48),(212,207,'',NULL,'delete',49,50),(213,207,'',NULL,'renderMessage',51,52),(214,189,'',NULL,'Pages',54,61),(215,214,'',NULL,'display',55,56),(216,214,'',NULL,'home',57,58),(217,214,'',NULL,'renderMessage',59,60),(218,189,'',NULL,'Tags',62,95),(219,218,'',NULL,'index',63,64),(220,218,'',NULL,'view',65,66),(221,218,'',NULL,'delete',67,68),(222,218,'',NULL,'manage',69,70),(223,218,'',NULL,'getnodes',71,72),(224,218,'',NULL,'recover',73,74),(225,218,'',NULL,'auto_complete',75,76),(226,218,'',NULL,'reorder',77,78),(227,218,'',NULL,'reparent',79,80),(228,218,'',NULL,'get_name',81,82),(229,218,'',NULL,'remove',83,84),(230,218,'',NULL,'merge',85,86),(231,218,'',NULL,'remove_broken_associations',87,88),(232,218,'',NULL,'edit',89,90),(233,218,'',NULL,'add',91,92),(234,218,'',NULL,'renderMessage',93,94),(235,189,'',NULL,'Users',96,127),(236,235,'',NULL,'index',97,98),(237,235,'',NULL,'view',99,100),(238,235,'',NULL,'add',101,102),(239,235,'',NULL,'edit',103,104),(240,235,'',NULL,'delete',105,106),(241,235,'',NULL,'login',107,108),(242,235,'',NULL,'logout',109,110),(243,235,'',NULL,'my_account',111,112),(244,235,'',NULL,'newsmedia_my_account',113,114),(245,235,'',NULL,'add_newsmedia',115,116),(246,235,'',NULL,'renderMessage',117,118),(247,189,'',NULL,'AclManager',128,145),(248,247,'',NULL,'Acl',129,144),(249,248,'',NULL,'drop',130,131),(250,248,'',NULL,'drop_perms',132,133),(251,248,'',NULL,'index',134,135),(252,248,'',NULL,'permissions',136,137),(253,248,'',NULL,'update_acos',138,139),(254,248,'',NULL,'update_aros',140,141),(255,248,'',NULL,'renderMessage',142,143),(256,189,'',NULL,'DebugKit',146,155),(257,256,'',NULL,'ToolbarAccess',147,154),(258,257,'',NULL,'history_state',148,149),(259,257,'',NULL,'sql_explain',150,151),(260,257,'',NULL,'renderMessage',152,153),(268,190,'',NULL,'send_timed_alert',37,38),(269,235,'',NULL,'admin_index',121,122),(270,235,'',NULL,'forgot_password',123,124),(271,235,'',NULL,'reset_password',125,126);
/*!40000 ALTER TABLE `acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros`
--

DROP TABLE IF EXISTS `aros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros`
--

LOCK TABLES `aros` WRITE;
/*!40000 ALTER TABLE `aros` DISABLE KEYS */;
INSERT INTO `aros` VALUES (90,NULL,'Group',1,'',1,16),(91,NULL,'Group',2,'',17,32),(92,NULL,'Group',3,'',33,34),(93,90,'User',7,'',2,3),(94,90,'User',8,'',4,5),(95,90,'User',12,'',6,7),(96,90,'User',13,'',8,9),(97,91,'User',14,'',18,19),(98,91,'User',15,'',20,21),(99,91,'User',28,'',22,23),(100,90,'User',18,'',10,11),(101,90,'User',19,'',12,13),(102,90,'User',20,'',14,15),(103,91,'User',29,'',24,25),(104,91,'User',30,'',26,27),(105,91,'User',31,'',28,29),(106,91,'User',33,'',30,31),(107,NULL,'Group',1,'',35,50),(108,NULL,'Group',2,'',51,66),(109,NULL,'Group',3,'',67,128),(110,107,'User',7,'',36,37),(111,107,'User',8,'',38,39),(112,107,'User',12,'',40,41),(113,107,'User',13,'',42,43),(114,108,'User',14,'',52,53),(115,108,'User',15,'',54,55),(116,108,'User',28,'',56,57),(117,107,'User',18,'',44,45),(118,107,'User',19,'',46,47),(119,107,'User',20,'',48,49),(120,108,'User',29,'',58,59),(121,108,'User',30,'',60,61),(122,108,'User',31,'',62,63),(123,108,'User',33,'',64,65),(124,109,'User',34,'',68,69),(125,109,'User',35,'',70,71),(126,109,'User',36,'',72,73),(127,109,'User',37,'',74,75),(128,109,'User',38,'',76,77),(129,109,'User',39,'',78,79),(130,109,'User',40,'',80,81),(131,109,'User',41,'',82,83),(132,109,'User',42,'',84,85),(133,109,'User',43,'',86,87),(134,109,'User',44,'',88,89),(135,109,'User',45,'',90,91),(136,109,'User',46,'',92,93),(137,109,'User',47,'',94,95),(138,109,'User',48,'',96,97),(139,109,'User',49,'',98,99),(140,109,'User',50,'',100,101),(141,109,'User',51,'',102,103),(142,109,'User',52,'',104,105),(143,109,'User',53,'',106,107),(144,109,'User',54,'',108,109),(145,109,'User',55,'',110,111),(146,109,'User',56,'',112,113),(147,109,'User',57,'',114,115),(148,109,'User',58,'',116,117),(149,109,'User',59,'',118,119),(150,109,'User',60,'',120,121),(151,109,'User',61,'',122,123),(152,109,'User',62,'',124,125),(153,109,'User',63,'',126,127);
/*!40000 ALTER TABLE `aros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros_acos`
--

DROP TABLE IF EXISTS `aros_acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros_acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) unsigned NOT NULL,
  `aco_id` int(10) unsigned NOT NULL,
  `_create` char(2) NOT NULL DEFAULT '0',
  `_read` char(2) NOT NULL DEFAULT '0',
  `_update` char(2) NOT NULL DEFAULT '0',
  `_delete` char(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros_acos`
--

LOCK TABLES `aros_acos` WRITE;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
INSERT INTO `aros_acos` VALUES (11,90,189,'1','1','1','1'),(12,91,189,'0','0','0','0'),(13,92,189,'0','0','0','0'),(14,90,190,'0','0','0','0'),(15,91,190,'1','1','1','1'),(16,92,190,'0','0','0','0'),(17,90,191,'0','0','0','0'),(18,91,191,'0','0','0','0'),(19,92,191,'0','0','0','0'),(20,90,192,'0','0','0','0'),(21,91,192,'0','0','0','0'),(22,92,192,'0','0','0','0'),(23,90,193,'0','0','0','0'),(24,91,193,'0','0','0','0'),(25,92,193,'0','0','0','0'),(26,90,194,'0','0','0','0'),(27,91,194,'0','0','0','0'),(28,92,194,'0','0','0','0'),(29,90,195,'0','0','0','0'),(30,91,195,'0','0','0','0'),(31,92,195,'0','0','0','0'),(32,90,196,'0','0','0','0'),(33,91,196,'0','0','0','0'),(34,92,196,'0','0','0','0'),(35,90,197,'0','0','0','0'),(36,91,197,'0','0','0','0'),(37,92,197,'0','0','0','0'),(38,90,198,'0','0','0','0'),(39,91,198,'0','0','0','0'),(40,92,198,'0','0','0','0'),(41,90,199,'0','0','0','0'),(42,91,199,'0','0','0','0'),(43,92,199,'0','0','0','0'),(44,90,200,'0','0','0','0'),(45,91,200,'0','0','0','0'),(46,92,200,'0','0','0','0'),(47,90,201,'0','0','0','0'),(48,91,201,'0','0','0','0'),(49,92,201,'0','0','0','0'),(50,90,202,'0','0','0','0'),(51,91,202,'0','0','0','0'),(52,92,202,'0','0','0','0'),(53,90,203,'0','0','0','0'),(54,91,203,'0','0','0','0'),(55,92,203,'0','0','0','0'),(56,90,204,'0','0','0','0'),(57,91,204,'0','0','0','0'),(58,92,204,'0','0','0','0'),(59,90,205,'0','0','0','0'),(60,91,205,'0','0','0','0'),(61,92,205,'0','0','0','0'),(62,90,206,'0','0','0','0'),(63,91,206,'0','0','0','0'),(64,92,206,'0','0','0','0'),(65,90,207,'0','0','0','0'),(66,91,207,'0','0','0','0'),(67,92,207,'0','0','0','0'),(68,90,208,'0','0','0','0'),(69,91,208,'0','0','0','0'),(70,92,208,'0','0','0','0'),(71,90,209,'0','0','0','0'),(72,91,209,'0','0','0','0'),(73,92,209,'0','0','0','0'),(74,90,210,'0','0','0','0'),(75,91,210,'0','0','0','0'),(76,92,210,'0','0','0','0'),(77,90,211,'0','0','0','0'),(78,91,211,'0','0','0','0'),(79,92,211,'0','0','0','0'),(80,90,212,'0','0','0','0'),(81,91,212,'0','0','0','0'),(82,92,212,'0','0','0','0'),(83,90,213,'0','0','0','0'),(84,91,213,'0','0','0','0'),(85,92,213,'0','0','0','0'),(86,90,214,'0','0','0','0'),(87,91,214,'0','0','0','0'),(88,92,214,'0','0','0','0'),(89,90,215,'0','0','0','0'),(90,91,215,'0','0','0','0'),(91,92,215,'0','0','0','0'),(92,90,216,'0','0','0','0'),(93,91,216,'0','0','0','0'),(94,92,216,'0','0','0','0'),(95,90,217,'0','0','0','0'),(96,91,217,'0','0','0','0'),(97,92,217,'0','0','0','0'),(98,90,218,'0','0','0','0'),(99,91,218,'1','1','1','1'),(100,92,218,'0','0','0','0'),(101,90,219,'0','0','0','0'),(102,91,219,'0','0','0','0'),(103,92,219,'0','0','0','0'),(104,90,220,'0','0','0','0'),(105,91,220,'0','0','0','0'),(106,92,220,'0','0','0','0'),(107,90,221,'0','0','0','0'),(108,91,221,'0','0','0','0'),(109,92,221,'0','0','0','0'),(110,90,222,'0','0','0','0'),(111,91,222,'0','0','0','0'),(112,92,222,'0','0','0','0'),(113,90,223,'0','0','0','0'),(114,91,223,'0','0','0','0'),(115,92,223,'0','0','0','0'),(116,90,224,'0','0','0','0'),(117,91,224,'0','0','0','0'),(118,92,224,'0','0','0','0'),(119,90,225,'0','0','0','0'),(120,91,225,'0','0','0','0'),(121,92,225,'0','0','0','0'),(122,90,226,'0','0','0','0'),(123,91,226,'0','0','0','0'),(124,92,226,'0','0','0','0'),(125,90,227,'0','0','0','0'),(126,91,227,'0','0','0','0'),(127,92,227,'0','0','0','0'),(128,90,228,'0','0','0','0'),(129,91,228,'0','0','0','0'),(130,92,228,'0','0','0','0'),(131,90,229,'0','0','0','0'),(132,91,229,'0','0','0','0'),(133,92,229,'0','0','0','0'),(134,90,230,'0','0','0','0'),(135,91,230,'0','0','0','0'),(136,92,230,'0','0','0','0'),(137,90,231,'0','0','0','0'),(138,91,231,'0','0','0','0'),(139,92,231,'0','0','0','0'),(140,90,232,'0','0','0','0'),(141,91,232,'0','0','0','0'),(142,92,232,'0','0','0','0'),(143,90,233,'0','0','0','0'),(144,91,233,'0','0','0','0'),(145,92,233,'0','0','0','0'),(146,90,234,'0','0','0','0'),(147,91,234,'0','0','0','0'),(148,92,234,'0','0','0','0'),(149,90,235,'0','0','0','0'),(150,91,235,'0','0','0','0'),(151,92,235,'0','0','0','0'),(152,90,236,'0','0','0','0'),(153,91,236,'0','0','0','0'),(154,92,236,'0','0','0','0'),(155,90,237,'0','0','0','0'),(156,91,237,'0','0','0','0'),(157,92,237,'0','0','0','0'),(158,90,238,'0','0','0','0'),(159,91,238,'0','0','0','0'),(160,92,238,'0','0','0','0'),(161,90,239,'0','0','0','0'),(162,91,239,'0','0','0','0'),(163,92,239,'0','0','0','0'),(164,90,240,'0','0','0','0'),(165,91,240,'0','0','0','0'),(166,92,240,'0','0','0','0'),(167,90,241,'0','0','0','0'),(168,91,241,'0','0','0','0'),(169,92,241,'0','0','0','0'),(170,90,242,'1','1','1','1'),(171,91,242,'1','1','1','1'),(172,92,242,'1','1','1','1'),(173,90,243,'1','1','1','1'),(174,91,243,'1','1','1','1'),(175,92,243,'-1','-1','-1','-1'),(176,90,244,'0','0','0','0'),(177,91,244,'1','1','1','1'),(178,92,244,'1','1','1','1'),(179,90,245,'0','0','0','0'),(180,91,245,'1','1','1','1'),(181,92,245,'1','1','1','1'),(182,90,246,'0','0','0','0'),(183,91,246,'0','0','0','0'),(184,92,246,'0','0','0','0'),(185,90,247,'0','0','0','0'),(186,91,247,'0','0','0','0'),(187,92,247,'0','0','0','0'),(188,90,248,'0','0','0','0'),(189,91,248,'0','0','0','0'),(190,92,248,'0','0','0','0'),(191,90,249,'0','0','0','0'),(192,91,249,'0','0','0','0'),(193,92,249,'0','0','0','0'),(194,90,250,'0','0','0','0'),(195,91,250,'0','0','0','0'),(196,92,250,'0','0','0','0'),(197,90,251,'0','0','0','0'),(198,91,251,'0','0','0','0'),(199,92,251,'0','0','0','0'),(200,90,252,'0','0','0','0'),(201,91,252,'0','0','0','0'),(202,92,252,'0','0','0','0'),(203,90,253,'0','0','0','0'),(204,91,253,'0','0','0','0'),(205,92,253,'0','0','0','0'),(206,90,254,'0','0','0','0'),(207,91,254,'0','0','0','0'),(208,92,254,'0','0','0','0'),(209,90,255,'0','0','0','0'),(210,91,255,'0','0','0','0'),(211,92,255,'0','0','0','0'),(212,90,256,'0','0','0','0'),(213,91,256,'0','0','0','0'),(214,92,256,'0','0','0','0'),(215,90,257,'0','0','0','0'),(216,91,257,'0','0','0','0'),(217,92,257,'0','0','0','0'),(218,90,258,'0','0','0','0'),(219,91,258,'0','0','0','0'),(220,92,258,'0','0','0','0'),(221,90,259,'0','0','0','0'),(222,91,259,'0','0','0','0'),(223,92,259,'0','0','0','0'),(224,90,260,'0','0','0','0'),(225,91,260,'0','0','0','0'),(226,92,260,'0','0','0','0');
/*!40000 ALTER TABLE `aros_acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentaries`
--

DROP TABLE IF EXISTS `commentaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commentaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `summary` varchar(1000) NOT NULL,
  `body` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `delay_publishing` tinyint(1) NOT NULL DEFAULT '0',
  `published_date` datetime DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=891 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaries`
--

LOCK TABLES `commentaries` WRITE;
/*!40000 ALTER TABLE `commentaries` DISABLE KEYS */;
INSERT INTO `commentaries` VALUES (890,'Some Disinformation About the Trump Tax Plan','It’s untrue this tax plan is that it can pay for itself.','<p>Last week, the Trump Administration presented the outlines of a serious tax reform plan. Nearly every American will approve of some portion of the proposal. As a sketch, the plan calls for a family minimum income threshold of $50,000 for taxes, fewer and lower marginal tax rates, and efforts to simplify and reduce taxes on business. It would also eliminate the estate or &lsquo;death tax.&rsquo; As with any presidential proposal, there are many details to work through, which will keep congress and lobby groups busy for months or years.</p>\r\n\r\n<p>Thera are also good reasons to be concerned about elements of the plan. Perhaps we need all American families to participate in the income tax, and maybe we need a more progressive income tax. Still, it is a serious start of comprehensive tax reform. But, instead of parsing what I think is good or bad with the initial plan, I think it is better to take down the two biggest pieces of intellectual chicanery surrounding this proposal. One comes from its proponents, the other from its opponents.</p>\r\n\r\n<p>The first big piece of un-truthiness regarding this tax plan is that it can pay for itself. While that might not even be a good standard by which to judge a tax plan, Mr. Trump&rsquo;s supporters argued almost immediately that this plan will generate enough economic growth to replace the lost tax revenues from the rate cut. It simply will not.</p>\r\n\r\n<p>The basis of this claim comes from the theoretically unassailable Laffer Curve. In the 1970s, Art Laffer famously presented a diagram in which tax rate cuts could conceivably lead to higher tax revenues if they were accompanied by high economic growth. He was (and is) right of course; at very high marginal tax rates, a rate reduction could generate higher tax revenues as economic growth is unleashed. Moreover, it is also true that tax cuts will, all things held constant, cause the economy to expand. However, at current tax rates, we should expect an income tax cut to modestly spur growth and to return only 25 to 40 percent of the lost revenue.</p>\r\n\r\n<p>Proponents of this tax plan are knowingly disingenuous when they make the claim that the tax cuts will pay for themselves. However, opponents are equally misleading when claiming this is primarily a tax cut for the rich.</p>\r\n\r\n<p>Reducing the marginal tax rate on incomes is, in this plan, an&nbsp;across-the-board cut with the highest share of savings going to the lowest income households. By extending the minimum tax threshold to $50,000, this plan will cut taxes for tens of millions of low-income families. In fact, the corporate tax cuts represent the largest single tax cut most low- and middle-income folks will ever receive. Here is why.</p>\r\n\r\n<p>The US taxes corporations very heavily without regard to who owns them. As it turns out, this matters a great deal. Individual households own about a third of corporate shares, but more than half are owned by pension funds of some type. By taxing a corporation, we tax earnings of a retired teacher and a multi-millionaire CEO&rsquo;s stock options the same, without regard to their actual income. This absurdity is preserved solely due to the widespread ignorance of the anti-corporatist crowd. The Trump plan to cut corporate taxes will reduce the tax burden more proportionately on low- and middle-income households than on the rich.</p>\r\n\r\n<p>I have not made my mind up on what parts of the Trump tax plan I would like to see enacted, and what parts need changing. However, I do resolve to ignore the ignorant or intentionally misleading arguments that this tax plan will pay for itself or is a giveaway to the rich. For good or ill, it is neither.&nbsp;</p>\r\n',8,1,0,'2017-05-14 00:00:00','some-disinformation-about-the-trump-tax-plan','2017-05-11 08:58:17','2017-05-14 00:00:01');
/*!40000 ALTER TABLE `commentaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentaries_tags`
--

DROP TABLE IF EXISTS `commentaries_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commentaries_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentary_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1942 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaries_tags`
--

LOCK TABLES `commentaries_tags` WRITE;
/*!40000 ALTER TABLE `commentaries_tags` DISABLE KEYS */;
INSERT INTO `commentaries_tags` VALUES (1884,890,212),(1885,890,173),(1886,890,81),(1887,890,55);
/*!40000 ALTER TABLE `commentaries_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Administrators','2012-05-16 16:57:46','2012-05-16 16:57:46'),(2,'Commentary authors','2012-05-16 16:57:54','2012-05-16 16:57:54'),(3,'Newsmedia','2014-02-05 21:00:16','2014-02-05 21:00:16');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `selectable` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=905 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (55,'taxes',NULL,1,2,1,'2010-06-02 10:51:55','2013-03-19 19:38:54'),(81,'federal government',NULL,3,4,1,'2010-07-19 10:10:24','2014-03-24 10:36:15'),(173,'budget and spending',NULL,5,6,1,'2013-03-19 19:36:09','2014-03-24 12:10:05'),(212,'donald trump administration',NULL,7,8,1,'2016-11-09 18:06:02','2016-11-09 18:06:02'),(213,'unlisted',0,188,188,1,NULL,NULL),(214,'delete',0,188,188,1,NULL,NULL);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `bio` text NOT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `password` varchar(64) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `group_id` int(11) DEFAULT NULL,
  `author` tinyint(1) NOT NULL DEFAULT '0',
  `picture` varchar(100) NOT NULL DEFAULT '',
  `nm_email_alerts` tinyint(1) NOT NULL DEFAULT '0',
  `last_alert_article_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (7,'Graham Watson','gtwatson@bsu.edu','Aliquam tempus ultrices metus, ac consequat ipsum vulputate vel. Suspendisse potenti. Phasellus ipsum quam, mollis in auctor pulvinar, ornare nec sem. Morbi aliquet, dui sit amet convallis porta, erat nulla luctus augue, eget condimentum massa tellus vel dui. Donec quis elit quis velit consequat feugiat vitae sit amet mi. Ut sed tellus non ipsum elementum congue! Phasellus elit lacus, ultrices et ultricies nec, rutrum non tellus. Vivamus dapibus pellentesque tortor ut faucibus. Nullam a sagittis dolor. Nam tellus nibh, venenatis at varius quis, accumsan eget nulla. Pellentesque venenatis interdum erat, id hendrerit lacus elementum vitae.','m','b65037b75683a3325f516165b526d7a9ea2339ac',1,1,0,'graham.jpg',1,NULL,'2010-04-23 17:16:42','2014-03-14 17:53:12'),(8,'Michael Hicks','cberdirector@bsu.edu','Michael J. Hicks, PhD, is the director of the Center for Business and Economic Research and the George and Frances Ball distinguished professor of economics in the Miller College of Business at Ball State University. Hicks earned doctoral and master’s degrees in economics from the University of Tennessee and a bachelor’s degree in economics from Virginia Military Institute. He has authored two books and more than 60 scholarly works focusing on state and local public policy, including tax and expenditure policy and the impact of Wal-Mart on local economies.','m','e2466717fb7d0a9ceeb4c61721faa107a9874b3e',1,1,1,'mike.jpg',0,NULL,'2010-04-27 12:45:23','2010-04-27 12:45:23'),(12,'Victoria Meldrum','vrmeldrum@bsu.edu','','f','2d06e61618c1aef1ccee5f05d4fbb2ec729c0a88',1,1,0,'',0,NULL,'2010-05-25 15:43:38','2014-02-19 09:47:39'),(15,'Pat Barkey','pat.barkey@business.umt.edu','Patrick Barkey is director of the University of Montana Bureau of Business and Economic Research. He has been involved with economic forecasting and health care policy research for over twenty-four years, both in the private and public sector. He served previously as Director of the Bureau of Business Research (now the Center for Business and Economic Research</a>) at Ball State University, overseeing and participating in a wide variety of projects in labor market research and state and regional economic policy issues. He attended the University of Michigan, receiving a B.A. (\'79) and Ph.D. (\'86) in economics.','m','',1,2,0,'pat.jpg',0,NULL,NULL,'2012-06-28 22:00:36'),(18,'Srikant Devaraj','sdevaraj@bsu.edu','','m','bd40a8dc93aff85abd4697f7596ba1e0b8b03291',1,1,0,'',0,NULL,'2010-07-20 15:43:47','2016-10-03 17:04:44'),(20,'Lisa Goodpaster','lgoodpaster@bsu.edu','<p>Lisa Goodpaster is secretary to the Center for Business and Economic  Research at Ball State University.&nbsp; She orchestrates the quarterly Ball  State Business Forecasting Roundtable and the annual Indiana Economic  Outlook luncheon.</p>','f','e2466717fb7d0a9ceeb4c61721faa107a9874b3e',1,1,0,'',0,NULL,'2012-03-13 11:47:30','2012-03-13 11:47:30'),(30,'CBER Staff','cber@bsu.edu','','m','1fbe17ab087391a2927c9e6f5277d2a19cea8d02',1,2,0,'',0,NULL,'2012-07-13 18:33:58','2012-07-13 18:33:58'),(68,'David Penticuff','dpenticuff@chronicle-tribune.com','','m','8318821cc3d5f5cbc34d9ca39a5efcd3ad2de0cf',1,3,0,'',0,NULL,'2015-04-02 11:38:40','2015-04-02 11:38:40'),(72,'Kevin Burkett','kevin.burkett@pharostribune.com','',NULL,'442fea68ba3ae84e6b5ea56f2c54b9fcbc67b2b8',1,3,0,'',1,889,'2016-10-03 17:02:45','2017-05-03 14:00:06'),(65,'Test Newsmedia 2','newsmedia2@phantomwatson.com','',NULL,'32c25f88de212f9c0cdd0d5ca534edd7f336575d',1,3,0,'',1,889,'2014-04-09 16:40:17','2017-05-03 14:00:10'),(40,'CBER BallState','ballstatecber@gmail.com','',NULL,'faa4419ee6121eb472015af4a175799ea1efeae8',1,3,0,'',1,889,'2014-02-19 09:51:06','2017-05-03 14:00:13'),(41,'HB Media Group','deps@hbmediagroup.com','',NULL,'bdf703458277d792a68907fdf7008fb7b619a9ae',1,3,0,'',1,889,'2014-02-19 15:02:29','2017-05-03 14:00:17'),(42,'Dagney Faulk','dgfaulk@bsu.edu','',NULL,'9251b1e8d24be8d801bb8865776a9d0c2d36c677',1,3,0,'',1,889,'2014-02-19 15:03:10','2017-05-03 14:00:21'),(43,'Bob Caylor','bcaylor@news-sentinel.com','',NULL,'e3fddf614c69fb9e0959ef03f79582e7e8c58104',1,3,0,'',1,889,'2014-02-19 15:04:32','2017-05-03 14:05:10'),(44,'News-Sentinel','nsbusiness@news-sentinel.com','',NULL,'40028d6973b1da12bcf1eb6e51974324f609de41',1,3,0,'',1,889,'2014-02-19 15:05:22','2017-05-03 14:05:26'),(45,'Hartford City News Times','newstimes@comcast.net','',NULL,'4f4c34d6fd4d9a151271904bea9eb6824f9940e6',1,3,0,'',1,889,'2014-02-19 15:09:15','2017-05-03 14:05:30'),(46,'Cynthia Payne','ntcindypayne@comcast.net','',NULL,'e9bced698028c5d223be17d11a29a98d0fbcd891',1,3,0,'',1,889,'2014-02-19 15:12:25','2017-05-03 14:05:34'),(47,'Greg Andrews','gandrews@ibj.com','',NULL,'3c6180ec383a85dfbe398d0e999763b7a8ec2123',1,3,0,'',1,889,'2014-02-19 15:13:29','2017-05-03 14:05:38'),(48,'Jeff Newman','jnewman@ibj.com','',NULL,'8a7a3e727c7a30d6ee15726ddd02ed671b366ce7',1,3,0,'',1,889,'2014-02-19 15:16:02','2017-05-03 14:10:06'),(51,'Jeff Kovaleski','jeff.kovaleski@kokomotribune.com','',NULL,'33988a1c7513f558e9d058f69d8839a0794b41be',1,3,0,'',1,889,'2014-02-19 15:18:55','2017-05-03 14:10:07'),(52,'Marc Ransford','00meransford@bsu.edu','',NULL,'86b8a72e3805edc63cf6881dc6ef27015d9ddcbb',1,3,0,'',1,889,'2014-02-19 15:19:34','2017-05-03 14:10:10'),(53,'South Bend Tribune','biznews@sbtinfo.com','',NULL,'c75a388a05d98aae942afe8db8fb463eb2840d67',1,3,0,'',1,889,'2014-02-19 15:20:19','2017-05-03 14:10:14'),(54,'Joni Gibley','jgibley@sbtinfo.com','',NULL,'5e1d368b29165d4902213ccc2bdf836951f86333',1,3,0,'',1,889,'2014-02-19 15:23:40','2017-05-03 14:10:18'),(55,'Tammy Estep','testep@bsu.edu','',NULL,'13f6bfa633ea39fa839566dc3a992d289040989c',1,3,0,'',1,889,'2014-02-19 15:24:56','2017-05-03 14:15:06'),(56,'Keith Roysdon','kroysdon@muncie.gannett.com','',NULL,'486a579621d00491dacbae4f4c52a56f8e8e29dc',1,3,0,'',1,889,'2014-02-19 15:26:15','2017-05-03 14:15:07'),(57,'Muncie Star Press Business','business@muncie.gannett.com','',NULL,'19dd522ecea3a5d78a3eaaf0ea50227ca3139693',1,3,0,'',1,889,'2014-02-19 15:27:08','2017-05-03 14:15:08'),(58,'Muncie Star Press','news@muncie.gannett.com','',NULL,'8c6c4bd2fbde6281a7a5108c95206d51cdbbb64d',1,3,0,'',1,889,'2014-02-19 15:27:51','2017-05-03 14:15:12'),(59,'Winchester News-Gazette','ngeditor@comcast.net','',NULL,'af67cdd67bfd99e2c9987b9e90c80b97fa7f8eea',1,3,0,'',1,889,'2014-02-19 15:29:19','2017-05-03 14:15:16'),(60,'Winchester News-Gazette Comp','ngcomp@comcast.net','',NULL,'acd819c757a06a03f2fbab97c16d8aea569ec805',1,3,0,'',1,889,'2014-02-19 15:31:02','2017-05-03 14:20:07'),(70,'Abdul-Hakim Shabazz (Indy Politics)','attyabdul@gmail.com','',NULL,'b2bfda2515dddf772e0ffee1d8b99aef63683e30',1,3,0,'',1,889,'2016-04-06 10:43:25','2017-05-03 14:20:12'),(64,'Test Newsmedia','test_newsmedia@phantomwatson.com','',NULL,'fe134b7e59621b604190b9308a827dc42953f497',1,3,0,'',1,889,'2014-04-09 16:30:28','2017-05-03 14:20:17'),(63,'Tim Swarens','tim.swarens@indystar.com','',NULL,'741d11c1f6ad6e2e10dfd3909ba5b181e9c4e87e',1,3,0,'',1,889,'2014-03-13 11:09:51','2017-05-03 14:20:17'),(67,'Howey Politics Indiana - Brian Howey','bhowey2@gmail.com','',NULL,'fcff1831d7471eb7d7f6bd72840b9b5f06d33e09',1,3,0,'',1,889,'2014-07-23 11:24:10','2017-05-03 14:20:21'),(69,'Misty Knisely','misty.knisely@pharostribune.com','',NULL,'a871266d7f73d918f5624c606780df9d93fbb360',1,3,0,'',0,860,'2015-07-21 11:29:23','2016-10-12 14:44:32'),(73,'Pharos Tribune','ptnews@pharostribune.com','',NULL,'c0ee3a6b5bc996b5b4ea2a3aa0e89fbd720d610c',1,3,0,'',1,889,'2016-10-03 17:03:17','2017-05-03 14:25:08'),(74,'Erica Dee Fox','edfox@bsu.edu','','f','$2y$10$XiWHiux3SBSTGp3D5MWNLOzZNoW4fySI7uLQwvFwXpQJR76mTMi6y',1,1,0,'',0,0,NULL,'2017-08-10 15:21:23');
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

-- Dump completed on 2017-08-10 11:22:31
