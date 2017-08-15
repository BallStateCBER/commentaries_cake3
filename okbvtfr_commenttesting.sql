CREATE DATABASE  IF NOT EXISTS `okbvtfr_commenttesting` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `okbvtfr_commenttesting`;
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
INSERT INTO `users` VALUES (8,'Michael Hicks','cberdirector@bsu.edu','Michael J. Hicks, PhD, is the director of the Center for Business and Economic Research and the George and Frances Ball distinguished professor of economics in the Miller College of Business at Ball State University. Hicks earned doctoral and master’s degrees in economics from the University of Tennessee and a bachelor’s degree in economics from Virginia Military Institute. He has authored two books and more than 60 scholarly works focusing on state and local public policy, including tax and expenditure policy and the impact of Wal-Mart on local economies.','m','e2466717fb7d0a9ceeb4c61721faa107a9874b3e',1,1,1,'mike.jpg',0,NULL,'2010-04-27 12:45:23','2010-04-27 12:45:23'),(74,'Erica Dee Fox','edfox@bsu.edu','','f','$2y$10$XiWHiux3SBSTGp3D5MWNLOzZNoW4fySI7uLQwvFwXpQJR76mTMi6y',1,1,0,'',0,0,NULL,'2017-08-10 15:21:23');
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

-- Dump completed on 2017-08-10 11:36:54
