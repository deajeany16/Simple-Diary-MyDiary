/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.21-MariaDB : Database - diary
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`diary` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `diary`;

/*Table structure for table `diary` */

DROP TABLE IF EXISTS `diary`;

CREATE TABLE `diary` (
  `id_diary` int(11) NOT NULL AUTO_INCREMENT,
  `story` varchar(1000) DEFAULT NULL,
  `thanks` varchar(1000) DEFAULT NULL,
  `motivasi` varchar(1000) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `id_mood_fk` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_diary`),
  KEY `id_user` (`id_user`),
  KEY `id_mood` (`id_mood_fk`),
  CONSTRAINT `diary_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  CONSTRAINT `diary_ibfk_4` FOREIGN KEY (`id_mood_fk`) REFERENCES `mood` (`id_mood`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `diary` */

insert  into `diary`(`id_diary`,`story`,`thanks`,`motivasi`,`date`,`id_mood_fk`,`id_user`) values 
(3,'happy happy happy','i am happy','yiww','2023-05-26',2,2),
(5,'happy happy happy','i am happy','yiww','2023-05-26',2,2),
(6,'happy happy happy','i am happy','yiww','2023-05-26',2,1);

/*Table structure for table `mood` */

DROP TABLE IF EXISTS `mood`;

CREATE TABLE `mood` (
  `id_mood` int(11) NOT NULL AUTO_INCREMENT,
  `mood` varchar(50) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_mood`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `mood` */

insert  into `mood`(`id_mood`,`mood`,`message`) values 
(1,'Happy','Great! Keep Smiling'),
(2,'Normal','Dont forget to drink a glass of water'),
(3,'Angry','Take a breath and take a shower'),
(4,'Sad','How About Listen To Music Right Now?'),
(5,'Sick','Dont forget to eat something'),
(6,'Tired','Lay on your bed first'),
(7,'Nervous','Everythings gonna be alright'),
(8,'Energetic','Keep Going bby!'),
(9,'Bored','Wanna go outside?');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id_user`,`username`,`password`) values 
(1,'Admin','Admin123'),
(2,'heyaa','heyaa7');

/* Procedure structure for procedure `insert_diary` */

/*!50003 DROP PROCEDURE IF EXISTS  `insert_diary` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_diary`(story VARCHAR(800), thanks VARCHAR(800), motivasi VARCHAR(300), id_mood INT(11), id_user INT(11))
BEGIN
		INSERT INTO diary(date, story, thanks, motivasi, id_mood, id_user)
		VALUES(CURDATE(), story, thanks, motivasi, id_mood, id_user);
	END */$$
DELIMITER ;

/* Procedure structure for procedure `update_diary` */

/*!50003 DROP PROCEDURE IF EXISTS  `update_diary` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `update_diary`(id_diary int(11), story varchar(500), thanks varchar(500), motivasi varchar(500), id_mood_fk INT(11))
BEGIN
		update diary SET story = story, thanks = thanks, motivasi = motivasi, id_mood_fk = id_mood_fk 
		WHERE id_diary = id_diary;
	END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
