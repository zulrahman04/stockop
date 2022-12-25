/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.7.24 : Database - db_so
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_so` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `db_so`;

/*Table structure for table `accs_mstr` */

DROP TABLE IF EXISTS `accs_mstr`;

CREATE TABLE `accs_mstr` (
  `accs_role` varchar(20) NOT NULL,
  `accs_menu` tinyint(4) NOT NULL,
  `accs_tf` tinyint(4) NOT NULL DEFAULT '0',
  `accs_ishome` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`accs_role`,`accs_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `accs_mstr` */

insert  into `accs_mstr`(`accs_role`,`accs_menu`,`accs_tf`,`accs_ishome`) values 
('ADMIN',2,0,NULL),
('ADMIN',3,1,NULL),
('ADMIN',12,1,NULL),
('ADMIN',14,0,NULL),
('ADMIN',15,1,NULL),
('ADMIN',16,0,NULL),
('ADMIN',17,1,NULL),
('ADMIN',22,1,NULL),
('ADMIN',23,1,NULL),
('ADMIN',24,1,NULL),
('ADMIN',25,1,NULL),
('CREW',2,0,NULL),
('CREW',3,0,NULL),
('CREW',12,0,NULL),
('CREW',14,0,NULL),
('CREW',16,0,NULL),
('CREW',17,0,NULL),
('CREW',22,0,NULL),
('CREW',23,0,NULL),
('CREW',24,0,NULL),
('CREW',25,0,NULL),
('DEV',2,1,NULL),
('DEV',3,1,NULL),
('DEV',12,1,NULL),
('DEV',14,1,NULL),
('DEV',15,1,NULL),
('DEV',16,1,NULL),
('DEV',17,1,NULL),
('DEV',22,1,NULL),
('DEV',23,1,NULL),
('DEV',24,1,NULL),
('DEV',25,1,NULL);

/*Table structure for table `accs_toko` */

DROP TABLE IF EXISTS `accs_toko`;

CREATE TABLE `accs_toko` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_toko` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `accs_toko` */

insert  into `accs_toko`(`id`,`id_user`,`id_toko`) values 
(1,1,1),
(2,1,2),
(3,2,1),
(6,3,1),
(8,2,5);

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ci_sessions` */

/*Table structure for table `mnu_mstr` */

DROP TABLE IF EXISTS `mnu_mstr`;

CREATE TABLE `mnu_mstr` (
  `mnu_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `mnu_name` varchar(80) NOT NULL,
  `mnu_uri` varchar(150) NOT NULL,
  `mnu_parent` tinyint(4) NOT NULL DEFAULT '0',
  `mnu_childyn` varchar(1) NOT NULL DEFAULT 'N',
  `mnu_icon` varchar(40) NOT NULL,
  `mnu_sort` tinyint(4) NOT NULL DEFAULT '1',
  `mnu_status` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`mnu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `mnu_mstr` */

insert  into `mnu_mstr`(`mnu_id`,`mnu_name`,`mnu_uri`,`mnu_parent`,`mnu_childyn`,`mnu_icon`,`mnu_sort`,`mnu_status`) values 
(2,'Menu','mnumstr',16,'N','',1,'A'),
(3,'Dashboard','dashboard',0,'N','fas fa-tachometer-alt',1,'A'),
(12,'User','user',17,'N','',99,'A'),
(14,'Akses Menu Role','rolemstr',16,'N','',5,'A'),
(16,'System','#',0,'Y','fa fa-fw fa-cogs',99,'A'),
(17,'Master','#',0,'Y','fa fa-fw fa-database',3,'A'),
(22,'Produk','produk',17,'N','',1,'A'),
(23,'History SO','histso',0,'N','fa fa-fw fa-bookmark',2,'A'),
(24,'Toko','toko',17,'N','',3,'A'),
(25,'Akses Toko','Accs_toko',0,'N','fa fa-th',2,'A');

/*Table structure for table `produk_detail` */

DROP TABLE IF EXISTS `produk_detail`;

CREATE TABLE `produk_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) DEFAULT NULL,
  `id_toko` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `expire` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `produk_detail` */

insert  into `produk_detail`(`id`,`id_produk`,`id_toko`,`qty`,`expire`) values 
(2,15,1,5,'2024-12-08'),
(3,15,1,9,'2023-10-31'),
(5,21,1,3,'2022-11-23'),
(6,2,1,0,NULL),
(7,2,1,5,'2022-11-24'),
(8,2,1,0,NULL),
(9,1,1,7,'2022-11-18'),
(10,3,1,5,'2024-09-21'),
(11,3,2,5,'2027-05-23');

/*Table structure for table `produk_jns` */

DROP TABLE IF EXISTS `produk_jns`;

CREATE TABLE `produk_jns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `produk_jns` */

/*Table structure for table `rol_mstr` */

DROP TABLE IF EXISTS `rol_mstr`;

CREATE TABLE `rol_mstr` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `rol_code` varchar(5) NOT NULL,
  `rol_name` varchar(50) NOT NULL,
  `rol_status` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rol_code` (`rol_code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `rol_mstr` */

insert  into `rol_mstr`(`id`,`rol_code`,`rol_name`,`rol_status`) values 
(1,'DEV','developer','A'),
(2,'ADMIN','administrator','A'),
(4,'CREW','crew','A');

/*Table structure for table `toko` */

DROP TABLE IF EXISTS `toko`;

CREATE TABLE `toko` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `toko` */

insert  into `toko`(`id`,`nama`,`alamat`) values 
(1,'galaxy','galaxy bekasi'),
(2,'bekasi',NULL),
(5,'margonda','depok2');

/*Table structure for table `tr_hist` */

DROP TABLE IF EXISTS `tr_hist`;

CREATE TABLE `tr_hist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `id_toko` int(11) DEFAULT NULL,
  `toko` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `expire` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `tr_hist` */

insert  into `tr_hist`(`id`,`id_produk`,`nama_produk`,`id_toko`,`toko`,`qty`,`expire`,`keterangan`,`create_by`,`create_date`) values 
(1,15,'CERMIN KOTAK NO.B18',1,'galaxy',5,'2024-12-08','Barang Masuk','administrator','2022-11-08 19:46:55'),
(2,15,'CERMIN KOTAK NO.B18',1,'galaxy',7,'2023-10-31','Barang Masuk','administrator','2022-11-08 19:48:06'),
(3,15,'CERMIN KOTAK NO.B18',1,'galaxy',2,'2023-10-31','Barang Masuk','administrator','2022-11-08 19:49:38'),
(4,21,'SISIR KARAKTER 2PCS',1,'galaxy',-5,'2022-11-11','Barang Keluar','administrator','2022-11-09 21:14:31'),
(5,21,'SISIR KARAKTER 2PCS',1,'galaxy',-5,'2022-11-23','Barang Keluar','administrator','2022-11-09 21:17:17'),
(6,21,'SISIR KARAKTER 2PCS',1,'galaxy',2,'2022-11-23','Barang Masuk','administrator','2022-11-09 21:25:31'),
(7,21,'SISIR KARAKTER 2PCS',1,'galaxy',-3,'2022-11-23','Barang Keluar','administrator','2022-11-09 21:26:09'),
(8,21,'SISIR KARAKTER 2PCS',1,'galaxy',-1,'0000-00-00','Barang Keluar','administrator','2022-11-09 22:37:20'),
(9,21,'SISIR KARAKTER 2PCS',1,'galaxy',-2,'2022-11-23','Barang Keluar','administrator','2022-11-09 22:39:41'),
(10,21,'SISIR KARAKTER 2PCS',1,'galaxy',6,'2022-11-23','Barang Masuk','administrator','2022-11-09 22:40:21'),
(11,21,'SISIR KARAKTER 2PCS',1,'galaxy',-5,'2022-11-23','Barang Keluar','administrator','2022-11-09 22:42:20'),
(12,21,'SISIR KARAKTER 2PCS',1,'galaxy',-1,'0000-00-00','Barang Keluar','administrator','2022-11-09 22:43:24'),
(13,2,'AISH ACNE SERUM 15ML',1,'galaxy',0,NULL,'Barang Keluar','developer','2022-11-21 18:45:22'),
(14,2,'AISH ACNE SERUM 15ML',1,'galaxy',5,'2022-11-24','Barang Masuk','developer','2022-11-21 18:45:48'),
(15,2,'AISH ACNE SERUM 15ML',1,'galaxy',0,NULL,'Barang Keluar','developer','2022-11-21 18:49:45'),
(16,1,'ACONE MO PETAL MASK 20GR',1,'galaxy',7,'2022-11-18','Barang Masuk','developer','2022-11-21 18:54:28'),
(17,3,'AISH BRIGHTENING SERUM 15ML',1,'galaxy',5,'2024-09-21','Barang Masuk','developer','2022-11-21 19:24:39'),
(18,3,'AISH BRIGHTENING SERUM 15ML',2,'bekasi',5,'2027-05-23','Barang Masuk','developer','2022-11-21 20:31:38');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`nama`,`role`,`status`,`created_by`,`created_date`,`update_by`,`update_date`) values 
(1,'dev','e00cf25ad42683b3df678c61f42c6bda','developer','DEV','A',NULL,'2022-11-06 09:30:54',NULL,'2022-11-19 11:48:54'),
(2,'admin','e10adc3949ba59abbe56e057f20f883e','administrator','ADMIN','A','admin','2022-11-07 18:53:00','admin','2022-11-19 11:48:50');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
