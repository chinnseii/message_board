# Host: localhost  (Version: 5.7.26)
# Date: 2020-11-01 02:35:58
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "message"
#

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '留言ID，主键，自增',
  `message_content` varchar(300) COLLATE utf8_unicode_ci NOT NULL COMMENT '留言内容',
  `create_time` datetime NOT NULL COMMENT '留言时间',
  `id` int(11) NOT NULL COMMENT '留言用户id',
  `message_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '留言用户',
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "message"
#

INSERT INTO `message` VALUES (16,'アメリカ\r\n        -----------------------------------------------from(35.42191,139.5543719)','2020-11-01 01:13:37',7,'Aさん'),(17,'日本\r\n        -----------------------------------------------from(35.421945699999995,139.5543548)','2020-11-01 01:24:11',8,'Bさん'),(18,'中国\r\n        -----------------------------------------------from(35.421932,139.55438039999999)','2020-11-01 01:26:02',9,'Cさん'),(19,'韓国','2020-11-01 01:26:41',10,'Dさん'),(20,'イギリス','2020-11-01 01:27:55',11,'Eさん'),(21,'日本','2020-11-01 01:29:05',12,'Fさん'),(22,'中国\r\n        -----------------------------------------------from(35.4219146,139.5544022)','2020-11-01 01:29:45',13,'Gさん'),(23,'666','2020-11-01 01:32:14',14,'666'),(24,'abc','2020-11-01 01:33:09',15,'abc');

#
# Structure for table "reply"
#

DROP TABLE IF EXISTS `reply`;
CREATE TABLE `reply` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '回复id，主键，自增',
  `reply_content` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT '回复内容',
  `message_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '留言的用户',
  `create_time` datetime NOT NULL COMMENT '回复时间',
  `message_id` int(11) NOT NULL COMMENT '评论id',
  `id` int(11) NOT NULL COMMENT '回复用户id',
  `reply_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '回复的用户',
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "reply"
#

INSERT INTO `reply` VALUES (5,'hello','Aさん','2020-11-01 01:24:34',16,8,'Bさん'),(6,'hello','Dさん','2020-11-01 01:28:11',19,11,'Eさん'),(7,'hello　日本','Fさん','2020-11-01 01:30:05',21,13,'Gさん'),(8,'666','Gさん','2020-11-01 01:32:22',22,14,'666');

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID，主键，自增',
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名，字符串',
  `userpass` varchar(35) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户密码',
  `create_time` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户创建时间',
  `imgpath` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '头像',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "user"
#

INSERT INTO `user` VALUES (7,'Aさん','202cb962ac59075b964b07152d234b70','1604164281','16041642811017.jpg'),(8,'Bさん','202cb962ac59075b964b07152d234b70','1604164511','16041645112972.jpg'),(9,'Cさん','202cb962ac59075b964b07152d234b70','1604164671','16041646711177.jpg'),(10,'Dさん','202cb962ac59075b964b07152d234b70','1604164706','16041647062743.jpg'),(11,'Eさん','202cb962ac59075b964b07152d234b70','1604164854','16041648542388.jpg'),(12,'Fさん','202cb962ac59075b964b07152d234b70','1604164929','16041649297795.jpg'),(13,'Gさん','202cb962ac59075b964b07152d234b70','1604164951','16041649512738.jpg'),(14,'666','fae0b27c451c728867a567e8c1bb4e53','1604164986','16041649865703.jpg'),(15,'abc','900150983cd24fb0d6963f7d28e17f72','1604165005','16041650054831.jpg');
