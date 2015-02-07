/*
SQLyog Ultimate v8.82 
MySQL - 5.5.41-0ubuntu0.14.04.1 : Database - bakou_clinic
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bakou_clinic` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `bakou_clinic`;

/*Table structure for table `AuthAssignment` */

DROP TABLE IF EXISTS `AuthAssignment`;

CREATE TABLE `AuthAssignment` (
  `itemname` varchar(64) CHARACTER SET latin1 NOT NULL,
  `userid` varchar(64) CHARACTER SET latin1 NOT NULL,
  `bizrule` text CHARACTER SET latin1,
  `data` text CHARACTER SET latin1,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `FK_AuthAssignment` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `AuthAssignment` */

insert  into `AuthAssignment`(`itemname`,`userid`,`bizrule`,`data`) values ('client.create','3',NULL,NULL),('client.create','4',NULL,NULL),('client.delete','3',NULL,NULL),('client.index','3',NULL,NULL),('client.index','4',NULL,NULL),('client.update','3',NULL,NULL),('client.update','4',NULL,NULL),('clinic.index','3',NULL,NULL),('employee.create','3',NULL,NULL),('employee.delete','3',NULL,NULL),('employee.index','3',NULL,NULL),('employee.index','4',NULL,NULL),('employee.update','3',NULL,NULL),('invoice.delete','3',NULL,NULL),('invoice.index','3',NULL,NULL),('invoice.index','4',NULL,NULL),('invoice.print','3',NULL,NULL),('invoice.print','4',NULL,NULL),('item.create','3',NULL,NULL),('item.create','4',NULL,NULL),('item.delete','3',NULL,NULL),('item.delete','4',NULL,NULL),('item.index','3',NULL,NULL),('item.index','4',NULL,NULL),('item.update','3',NULL,NULL),('item.update','4',NULL,NULL),('payment.index','3',NULL,NULL),('report.index','3',NULL,NULL),('report.index','4',NULL,NULL),('sale.discount','3',NULL,NULL),('sale.discount','4',NULL,NULL),('sale.edit','3',NULL,NULL),('sale.edit','4',NULL,NULL),('sale.editprice','3',NULL,NULL),('store.update','3',NULL,NULL),('supplier.create','3',NULL,NULL),('supplier.delete','3',NULL,NULL),('supplier.delete','4',NULL,NULL),('supplier.index','3',NULL,NULL),('supplier.index','4',NULL,NULL),('supplier.update','3',NULL,NULL),('supplier.update','4',NULL,NULL),('transaction.adjustin','3',NULL,NULL),('transaction.adjustout','3',NULL,NULL),('transaction.count','3',NULL,NULL),('transaction.receive','3',NULL,NULL),('transaction.receive','4',NULL,NULL),('transaction.return','3',NULL,NULL),('transaction.return','4',NULL,NULL),('transaction.transfer','3',NULL,NULL),('treatment.create','3',NULL,NULL),('treatment.delete','3',NULL,NULL),('treatment.index','3',NULL,NULL),('treatment.update','3',NULL,NULL);

/*Table structure for table `AuthItem` */

DROP TABLE IF EXISTS `AuthItem`;

CREATE TABLE `AuthItem` (
  `name` varchar(64) CHARACTER SET latin1 NOT NULL,
  `type` int(11) NOT NULL,
  `description` text CHARACTER SET latin1,
  `bizrule` text CHARACTER SET latin1,
  `data` text CHARACTER SET latin1,
  `sort_order` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `AuthItem` */

insert  into `AuthItem`(`name`,`type`,`description`,`bizrule`,`data`,`sort_order`) values ('client.create',0,'Create',NULL,'N;',2),('client.delete',0,'Delete',NULL,'N;',4),('client.index',0,'View',NULL,'N;',1),('client.update',0,'Update',NULL,'N;',3),('clinic.create',0,'Create clinic',NULL,NULL,5),('clinic.delete',0,'Delete Clinic',NULL,NULL,4),('clinic.index',0,'For Clinic menu',NULL,NULL,1),('clinic.update',0,'Update clinic',NULL,NULL,2),('employee.create',0,'Create',NULL,NULL,3),('employee.delete',0,'Delete',NULL,NULL,4),('employee.index',0,'View',NULL,NULL,1),('employee.update',0,'Update',NULL,NULL,3),('invoice.delete',0,'Cancel',NULL,'N;',4),('invoice.index',0,'View',NULL,'N;',1),('invoice.print',0,'Re-print',NULL,'N;',2),('invoice.update',0,'Edit',NULL,'N;',3),('item.create',0,'Create',NULL,NULL,2),('item.delete',0,'Delete',NULL,NULL,4),('item.index',0,'View',NULL,NULL,1),('item.update',0,'Update',NULL,NULL,3),('itemAdmin',1,'Administer Item',NULL,'N;',NULL),('payment.index',0,'Invoice Payment (Debt)',NULL,NULL,NULL),('receiving.edit',0,'Process Purchase orders',NULL,'N;',NULL),('report.index',0,'View and generate reports',NULL,'N;',NULL),('sale.discount',0,'Discount',NULL,'N;',NULL),('sale.edit',0,'Normal Sale',NULL,'N;',NULL),('sale.editprice',0,'Edit Price',NULL,'N;',NULL),('setting.exchangerate',0,'Exchange Rate',NULL,NULL,NULL),('setting.receipt',0,'Receipt Setting',NULL,NULL,NULL),('setting.sale',0,'Sale Setting',NULL,NULL,NULL),('setting.site',0,'Shop Setting',NULL,NULL,NULL),('setting.system',0,'System Setting',NULL,NULL,NULL),('store.update',0,'Change the store\'s configuration',NULL,'N;',NULL),('supplier.create',0,'Create',NULL,NULL,2),('supplier.delete',0,'Delete',NULL,NULL,4),('supplier.index',0,'View',NULL,NULL,2),('supplier.update',0,'Update',NULL,NULL,3),('transaction.adjustin',0,'Adjustment In',NULL,NULL,3),('transaction.adjustout',0,'Adjustment Out',NULL,NULL,4),('transaction.count',0,'Physical Count',NULL,NULL,5),('transaction.receive',0,'Receive from Supplier',NULL,NULL,1),('transaction.return',0,'Return to Supplier',NULL,NULL,2),('transaction.transfer',0,'Transfer to (Another Branch)',NULL,NULL,6),('treatment.create',0,'Create treatment',NULL,NULL,NULL),('treatment.delete',0,'Delete Treatment',NULL,NULL,NULL),('treatment.index',0,'View all general of treatment report',NULL,NULL,NULL),('treatment.update',0,'Update treatment',NULL,NULL,NULL);

/*Table structure for table `AuthItemChild` */

DROP TABLE IF EXISTS `AuthItemChild`;

CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) CHARACTER SET latin1 NOT NULL,
  `child` varchar(64) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `AuthItemChild` */

/*Table structure for table `appointment` */

DROP TABLE IF EXISTS `appointment`;

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_date` datetime NOT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `visit_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `appointment` */

/*Table structure for table `appointment_log` */

DROP TABLE IF EXISTS `appointment_log`;

CREATE TABLE `appointment_log` (
  `appointment_id` int(11) NOT NULL,
  `change_date_time` datetime NOT NULL,
  `start_time` time NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `old_status` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `FK_appointment_log` (`appointment_id`),
  CONSTRAINT `FK_appointment_log` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `appointment_log` */

/*Table structure for table `clinic` */

DROP TABLE IF EXISTS `clinic`;

CREATE TABLE `clinic` (
  `id` int(11) NOT NULL,
  `start_time` varchar(10) NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `time_interval` decimal(11,2) NOT NULL DEFAULT '0.50',
  `clinic_name` varchar(50) DEFAULT NULL,
  `tag_line` varchar(100) DEFAULT NULL,
  `clinic_address` varchar(500) DEFAULT NULL,
  `landline` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `next_followup_days` int(11) NOT NULL DEFAULT '15',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `clinic` */

/*Table structure for table `contact` */

DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contact_image` varchar(255) NOT NULL DEFAULT 'images/Profile.png',
  `type` varchar(50) NOT NULL,
  `address_line_1` varchar(150) NOT NULL,
  `address_line_2` varchar(150) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `postal_code` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `contact` */

insert  into `contact`(`id`,`first_name`,`middle_name`,`last_name`,`display_name`,`phone_number`,`email`,`contact_image`,`type`,`address_line_1`,`address_line_2`,`city`,`state`,`postal_code`,`country`) values (1,'Sopheap','','Tep','Tsopheap','123456','sopheap@gmail.com','images/Profile.png','Normal','Phnom Penh','7 Makara, Veal Vong','Phnom Penh','Cambodia','855','Cambodia'),(2,'Sok','','Lux','Slux','121212','lux@gmail.com','images/Profile.png','normal','BMC','Serey Sophorn','Serey Sophorn','Cambodia','855','Cambodia');

/*Table structure for table `contact_detail` */

DROP TABLE IF EXISTS `contact_detail`;

CREATE TABLE `contact_detail` (
  `contact_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `detail` varchar(150) NOT NULL,
  PRIMARY KEY (`contact_detail_id`),
  KEY `FK_contact_details` (`contact_id`),
  CONSTRAINT `FK_contact_detail_con_id` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `contact_detail` */

/*Table structure for table `employee` */

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `mobile_no` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `adddress1` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `address2` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `country_code` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `notes` text CHARACTER SET utf8,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `employee` */

insert  into `employee`(`id`,`first_name`,`last_name`,`mobile_no`,`adddress1`,`address2`,`city_id`,`country_code`,`email`,`notes`,`status`) values (1,'Owner','System','012345678','','',NULL,'','','',NULL),(2,'Super','Super','012800800','super addresss1','super address',NULL,'','','',NULL),(3,'Phally','Tep','','','',NULL,'','','Testing','1'),(4,'Larry','King','','','',NULL,'','','Testing','1'),(5,'dalin','chan','','','',NULL,'','','Testing','1');

/*Table structure for table `employee_image` */

DROP TABLE IF EXISTS `employee_image`;

CREATE TABLE `employee_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `photo` blob NOT NULL,
  `thumbnail` blob,
  `filename` varchar(30) CHARACTER SET latin1 NOT NULL,
  `filetype` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `path` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `width` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `height` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_employee_image_emp_id` (`employee_id`),
  CONSTRAINT `FK_employee_image` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `employee_image` */

/*Table structure for table `item` */

DROP TABLE IF EXISTS `item`;

CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `item_number` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `cost_price` double(15,4) DEFAULT NULL,
  `unit_price` double(15,4) DEFAULT NULL,
  `quantity` double(15,2) NOT NULL,
  `reorder_level` double(15,2) DEFAULT NULL,
  `location` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `allow_alt_description` tinyint(1) DEFAULT NULL,
  `is_serialized` tinyint(1) DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_expire` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_number` (`item_number`),
  KEY `FK_item_category_id` (`category_id`),
  KEY `FK_item_supplier_id` (`supplier_id`),
  CONSTRAINT `FK_item` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `item` */

/*Table structure for table `paint_img` */

DROP TABLE IF EXISTS `paint_img`;

CREATE TABLE `paint_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `img_name` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_patimg_patient` (`patient_id`),
  CONSTRAINT `FK_patimg_patient` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `paint_img` */

/*Table structure for table `patient` */

DROP TABLE IF EXISTS `patient`;

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `patient_since` date NOT NULL,
  `display_id` varchar(12) NOT NULL,
  `followup_date` date NOT NULL,
  `reference_by` varchar(255) NOT NULL,
  PRIMARY KEY (`patient_id`),
  KEY `FK_patient_contact` (`contact_id`),
  CONSTRAINT `FK_patient_con_id` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `patient` */

/*Table structure for table `rbac_user` */

DROP TABLE IF EXISTS `rbac_user`;

CREATE TABLE `rbac_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(60) CHARACTER SET utf8 NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `user_password` varchar(128) CHARACTER SET utf8 NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `date_entered` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_indx` (`user_name`),
  KEY `FK_rbac_user_group_id` (`group_id`),
  KEY `FK_rbac_user_employee_id` (`employee_id`),
  CONSTRAINT `FK_rbac_user_emp_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rbac_user` */

insert  into `rbac_user`(`id`,`user_name`,`group_id`,`employee_id`,`user_password`,`deleted`,`status`,`date_entered`,`modified_date`,`created_by`) values (2,'admin',NULL,1,'$2a$08$6Bpd5qGSPhB5dehzcrje4eYbfeTmxKI6WI8AgnamWSJyC4nAYNES6',0,1,NULL,'2014-02-15 11:31:55',NULL),(3,'super',NULL,2,'$2a$08$J7IBftBeORzk4j8mY0nk0OBykvV3iXA1DEMOhvHMhewy.93gVWPCm',0,1,'2013-10-10 09:44:04','2015-01-18 14:36:20',NULL),(4,'TPhally',NULL,3,'$2a$08$gPREeyEuB0Y6AEqQycfkaeLmrNHdD3eBAXQq7844FPXfsPdGkmgVS',0,1,'2015-02-05 22:38:35','2015-02-05 22:38:35',NULL),(5,'Klarry',NULL,4,'$2a$08$xBKbhK0vvkhL7dcgRKxmC.6KTiSFUG0vHfzLM8XUduLzrOYvDRxUy',0,1,'2015-02-05 22:39:19','2015-02-05 22:39:19',NULL),(6,'dalin',NULL,5,'$2a$08$wlxoIaAqd3pR2c9JHvet1.6Jf65pf1E1qTc9vC5q.fykskQOhd5Oi',0,1,'2015-02-05 22:40:43','2015-02-05 22:40:43',NULL);

/*Table structure for table `sale` */

DROP TABLE IF EXISTS `sale`;

CREATE TABLE `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_time` datetime NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `sub_total` decimal(15,4) DEFAULT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `remark` text CHARACTER SET utf8,
  `discount_amount` decimal(15,2) DEFAULT '0.00',
  `discount_type` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_sale_emp_id` (`employee_id`),
  KEY `FK_sale_client_id` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2304 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sale` */

/*Table structure for table `sale_item` */

DROP TABLE IF EXISTS `sale_item`;

CREATE TABLE `sale_item` (
  `sale_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8,
  `line` int(11) DEFAULT NULL,
  `quantity` double(15,2) DEFAULT NULL,
  `cost_price` double(15,4) DEFAULT NULL,
  `unit_price` double(15,4) DEFAULT NULL,
  `price` double(15,4) DEFAULT NULL,
  `discount_amount` double(15,2) DEFAULT NULL,
  `discount_type` varchar(2) CHARACTER SET utf8 DEFAULT '%',
  PRIMARY KEY (`sale_id`,`item_id`),
  KEY `FK_sale_item_item_id` (`item_id`),
  CONSTRAINT `FK_sale_item_sale_id` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sale_item` */

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`expire`,`data`) values ('96ob498toh4hkro7uplmrb2os2',1423324561,'5c3bfa0e12ef638fa6ebdf5fb49ff1cf__isAdmin|b:0;employeeid|s:1:\"2\";userid|s:1:\"3\";emp_fullname|s:11:\"Super Super\";unique_id|s:13:\"54d621c81f5c7\";5c3bfa0e12ef638fa6ebdf5fb49ff1cf__id|s:1:\"3\";5c3bfa0e12ef638fa6ebdf5fb49ff1cf__name|s:5:\"super\";5c3bfa0e12ef638fa6ebdf5fb49ff1cf__states|a:0:{}gii__returnUrl|s:32:\"/awesome/kh-clinic/index.php/gii\";gii__id|s:5:\"yiier\";gii__name|s:5:\"yiier\";gii__states|a:0:{}');

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) NOT NULL DEFAULT 'system',
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_key` (`category`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `settings` */

/*Table structure for table `tbl_audit_logs` */

DROP TABLE IF EXISTS `tbl_audit_logs`;

CREATE TABLE `tbl_audit_logs` (
  `unique_id` varbinary(30) DEFAULT NULL,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `ipaddress` varchar(50) CHARACTER SET latin1 NOT NULL,
  `logtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `controller` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `action` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `details` text COLLATE utf8mb4_unicode_ci,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_audit_logs` */

insert  into `tbl_audit_logs`(`unique_id`,`username`,`ipaddress`,`logtime`,`controller`,`action`,`details`,`employee_id`) values ('','Guest','192.168.10.1','2015-01-22 18:55:10','site','error','',0),('','Guest','192.168.10.1','2015-01-22 18:55:38','site','index','',0),('','Guest','192.168.10.1','2015-01-22 18:55:41','site','index','',0),('','Guest','192.168.10.1','2015-01-22 18:55:42','site','index','',0),('','Guest','192.168.10.1','2015-01-22 18:55:43','site','index','',0),('','Guest','192.168.10.1','2015-01-23 11:09:27','site','index','',0),('','Guest','192.168.10.1','2015-01-23 11:35:57','site','index','',0),('','Guest','192.168.10.1','2015-01-23 11:36:24','site','error','',0),('','Guest','192.168.10.1','2015-01-23 11:36:54','site','index','',0),('','Guest','192.168.10.1','2015-01-23 11:37:41','site','index','',0),('','Guest','192.168.10.1','2015-01-23 11:37:44','site','index','',0),('','Guest','192.168.10.1','2015-01-23 11:37:48','site','error','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:38:34','site','error','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:39:34','site','error','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:39:36','site','error','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:39:37','site','error','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:39:38','site','error','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:40:24','site','error','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:40:58','site','error','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:41:58','site','error','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:42:06','site','error','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:42:08','site','error','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:43:47','site','error','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:44:29','dashboard','view','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:45:23','dashboard','view','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:45:26','site','about','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:45:29','dashboard','view','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:45:32','site','error','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:46:08','employee','admin','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:46:36','employee','admin','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:46:38','employee','admin','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:46:42','employee','update','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:46:51','employee','admin','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:46:55','employee','update','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:47:11','employee','admin','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:47:18','employee','update','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:47:26','employee','admin','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:47:28','employee','admin','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 11:47:34','dashboard','view','',1),('54c1d0496cbb6','admin','192.168.10.1','2015-01-23 12:17:36','dashboard','view','',1),('','Guest','192.168.10.1','2015-01-23 12:17:39','site','index','',0),('','Guest','192.168.10.1','2015-01-23 12:17:42','site','index','',0),('','Guest','192.168.10.1','2015-01-23 12:17:45','site','index','',0),('54c1d97e38714','admin','192.168.10.1','2015-01-23 12:17:50','dashboard','view','',1),('54c1d97e38714','admin','192.168.10.1','2015-01-23 12:17:55','employee','admin','',1),('54c1d97e38714','admin','192.168.10.1','2015-01-23 12:20:17','employee','create','',1),('54c1d97e38714','admin','192.168.10.1','2015-01-23 12:20:22','employee','admin','',1),('54c1d97e38714','admin','192.168.10.1','2015-01-23 12:20:25','employee','admin','',1),('54c1d97e38714','admin','192.168.10.1','2015-01-23 12:20:26','employee','create','',1),('54c1d97e38714','admin','192.168.10.1','2015-01-23 12:20:28','employee','admin','',1),('','Guest','192.168.10.1','2015-01-23 12:55:21','site','index','',0),('','Guest','192.168.10.1','2015-01-24 15:35:01','site','index','',0),('','Guest','192.168.10.1','2015-01-24 15:35:09','site','index','',0),('54c35941672ba','admin','192.168.10.1','2015-01-24 15:35:13','dashboard','view','',1),('54c35941672ba','admin','192.168.10.1','2015-01-24 15:35:17','site','error','',1),('54c35941672ba','admin','192.168.10.1','2015-01-24 15:35:19','employee','admin','',1),('54c35941672ba','admin','192.168.10.1','2015-01-24 15:35:37','employee','create','',1),('','Guest','192.168.10.1','2015-01-24 15:45:27','site','index','',0),('','Guest','192.168.10.1','2015-01-24 16:36:49','site','index','',0),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:37:10','dashboard','view','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:40:47','dashboard','view','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:40:56','treatment','index','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:41:22','site','error','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:41:48','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:42:05','treatment','create','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:42:21','treatment','view','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:42:39','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:43:39','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:43:51','employee','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:44:36','employee','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:44:39','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:44:51','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:45:12','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:45:14','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:45:47','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:46:28','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:46:37','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:46:38','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:46:41','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:46:55','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:47:15','treatment','index','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:47:18','site','error','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:47:20','treatment','index','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:47:22','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:47:35','treatment','index','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:47:42','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:47:45','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:47:46','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:48:07','treatment','create','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:49:53','site','error','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:50:06','treatment','create','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:50:20','treatment','create','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:51:19','employee','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:51:21','employee','create','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:51:28','site','error','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:51:34','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:51:36','treatment','create','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:51:41','treatment','create','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:51:57','treatment','create','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:51:58','treatment','create','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:52:05','site','error','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:52:08','employee','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:52:15','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:52:17','treatment','create','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:52:58','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:53:01','treatment','update','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:53:14','treatment','view','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:53:20','treatment','index','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:53:26','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:53:48','treatment','update','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:53:50','site','error','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:54:33','treatment','update','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:54:34','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:55:25','treatment','update','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:55:26','site','error','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:55:56','treatment','update','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:55:58','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:56:14','treatment','update','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:56:15','treatment','admin','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:56:35','treatment','create','',2),('54c367c67b8cb','super','192.168.10.1','2015-01-24 16:56:36','treatment','admin','',2),('','Guest','192.168.10.1','2015-01-24 16:57:36','site','index','',0),('','Guest','192.168.10.1','2015-02-05 15:35:49','site','index','',0),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:36:34','dashboard','view','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:36:49','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:36:56','employee','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:37:00','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:37:44','employee','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:38:39','employee','view','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:38:44','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:38:53','employee','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:39:30','employee','view','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:40:04','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:40:11','employee','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:40:50','employee','view','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:40:53','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:46:46','contact','index','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:47:42','contact','index','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:47:54','contact','index','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:49:42','dashboard','view','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:49:49','employee','index','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:50:02','contact','index','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:50:13','site','error','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:50:42','site','error','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 15:52:43','site','error','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:00:26','contact','index','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:00:49','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:04:06','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:04:11','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:05:13','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:06:23','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:06:33','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:07:03','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:09:25','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:09:56','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:09:59','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:10:05','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:11:27','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:13:49','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:14:33','site','error','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:15:11','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:15:45','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:17:48','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:17:48','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:17:48','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:17:49','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:17:56','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:17:56','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:17:56','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:17:57','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:17:59','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:00','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:00','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:00','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:00','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:03','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:03','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:03','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:03','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:03','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:06','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:06','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:06','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:06','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:06','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:08','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:08','employee','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:18:14','employee','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:21:54','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:22:11','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:23:16','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:25:06','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:25:20','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:25:24','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:25:26','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:28:00','employee','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:28:02','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:30:38','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:31:02','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:32:36','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:33:01','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:36:28','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:37:33','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:38:27','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:40:05','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:40:53','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:41:11','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:41:39','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:42:07','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:42:10','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:42:27','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:42:41','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:43:55','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:44:13','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:44:49','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:44:50','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:46:24','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:46:29','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:46:30','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:46:32','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:46:38','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:47:00','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:48:01','contact','view','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:48:17','contact','index','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:48:22','contact','view','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:49:44','contact','index','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:49:48','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:50:21','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:51:13','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:51:16','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 16:52:06','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 17:07:29','contact','create','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 17:09:17','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 17:09:23','contact','view','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 17:09:26','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 17:09:30','site','error','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 17:09:35','contact','admin','',2),('54d38e00cc7b0','super','192.168.10.1','2015-02-05 17:09:43','contact','create','',2),('','Guest','192.168.10.1','2015-02-07 14:31:26','site','index','',0),('54d621c81f5c7','super','192.168.10.1','2015-02-07 14:31:37','dashboard','view','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 14:31:48','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 14:41:37','site','error','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 14:41:42','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 14:41:45','employee','create','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 14:44:19','employee','create','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 14:46:24','employee','create','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 14:51:55','employee','create','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 14:52:34','employee','create','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 14:54:32','employee','create','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 14:55:44','employee','create','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 14:55:49','site','error','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 14:55:54','site','error','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 14:55:57','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 14:55:58','site','error','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:00:31','site','error','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:00:34','site','error','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:00:43','site','error','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:00:46','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:00:48','site','error','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:00:55','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:00:56','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:01:01','site','error','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:01:03','site','error','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:02:14','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:02:21','employee','create','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:03:01','dashboard','view','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:03:05','site','error','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:03:10','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:03:11','site','error','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:09:19','clinic','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:09:23','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:09:25','clinic','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:09:29','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:09:32','clinic','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:09:36','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:10:15','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:10:16','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:10:17','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:11:11','clinic','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:11:17','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:13:15','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:13:16','clinic','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:13:20','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:14:21','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:14:24','clinic','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:14:29','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:18:45','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:20:57','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:21:07','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:22:41','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:22:49','clinic','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:22:51','clinic','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:22:53','clinic','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:22:59','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:23:02','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:23:05','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:23:25','employee','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:23:37','site','error','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:24:51','site','error','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:26:32','clinic','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:28:01','clinic','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:28:22','clinic','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:28:50','site','error','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:29:57','site','error','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:30:03','contact','index','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:30:22','contact','index','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:30:24','contact','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:30:28','contact','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:30:33','contact','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:30:41','contact','admin','',2),('54d621c81f5c7','super','192.168.10.1','2015-02-07 15:32:01','contact','create','',2);

/*Table structure for table `treatment` */

DROP TABLE IF EXISTS `treatment`;

CREATE TABLE `treatment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `treatment` varchar(80) DEFAULT NULL,
  `price` float(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `treatment` (`treatment`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `treatment` */

insert  into `treatment`(`id`,`treatment`,`price`) values (1,'Echo-XRay',100.00);

/*Table structure for table `user_log` */

DROP TABLE IF EXISTS `user_log`;

CREATE TABLE `user_log` (
  `unique_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sessoin_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime DEFAULT NULL,
  `last_action` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`unique_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_log` */

insert  into `user_log`(`unique_id`,`sessoin_id`,`user_id`,`employee_id`,`login_time`,`logout_time`,`last_action`,`status`,`modified_date`,`modified_by`) values ('54c1d0496cbb6','g4l7trsmmj91ks7c18uq1f8u22',2,1,'2015-01-23 11:38:33','2015-01-23 12:17:39','2015-01-23 12:17:36',0,'2015-01-23 12:17:39','admin'),('54c1d97e38714','5kcn9efuk2jnvc5nkqff2v7b55',2,1,'2015-01-23 12:17:50','2015-01-23 12:55:21','2015-01-23 12:20:28',0,'2015-01-23 12:55:21','admin'),('54c35941672ba','9n3qlikl9eb117tl8nks5u9qb6',2,1,'2015-01-24 15:35:13','2015-01-24 15:45:27','2015-01-24 15:35:37',0,'2015-01-24 15:45:27','admin'),('54c367c67b8cb','976kd2tgbobhksb1879395al16',3,2,'2015-01-24 16:37:10','2015-01-24 16:57:36','2015-01-24 16:56:36',0,'2015-01-24 16:57:36','super'),('54d38e00cc7b0','201vjfm7s1fnam0tcdsj4gkfj3',3,2,'2015-02-05 22:36:32',NULL,'2015-02-05 17:09:43',1,'2015-02-05 15:36:32','super'),('54d621c81f5c7','ee2kkico0ao1n7abg5g8r7f450',3,2,'2015-02-07 21:31:36',NULL,'2015-02-07 15:32:01',1,'2015-02-07 14:31:36','super');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
