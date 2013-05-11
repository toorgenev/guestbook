DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `homepage` varchar(100) DEFAULT NULL,
  `text` text,
  `date` int(11) unsigned NOT NULL,
  `photo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `name` (`user`),
  KEY `createtime` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

LOCK TABLES `posts` WRITE;
INSERT INTO `posts` VALUES (1,'Mike','aaa@bbb.ya','Homepage.my','It works!!!!',1368269289,'im_518e21e9483dc1_01070460.jpg'),(2,'Nick','bbb@ccc.ru',NULL,'Hereut!!!',1368269396,NULL),(3,'Lena','jerry@byte.by','website.by','Nice',1368269442,NULL),(4,'Sten','yere@baby.com',NULL,'Amazing!!!',1368269693,'im_518e237cdbd182_28928799.jpg'),(5,'Sara','sara@sara.com','sara.com','It\'s bad ((',1368269748,NULL),(6,'Bill','den@game.com',NULL,'Great Work!!!',1368269794,'im_518e23e2af6654_81385635.jpg');
UNLOCK TABLES;
