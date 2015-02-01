/*
SQLyog Ultimate v8.82 
MySQL - 5.5.35-0ubuntu0.12.04.2 : Database - bakou_pos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bakou_pos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `bakou_pos`;

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

insert  into `AuthAssignment`(`itemname`,`userid`,`bizrule`,`data`) values ('client.create','2',NULL,NULL),('client.create','3',NULL,NULL),('client.delete','2',NULL,NULL),('client.delete','3',NULL,NULL),('client.index','2',NULL,NULL),('client.index','3',NULL,NULL),('client.update','2',NULL,NULL),('client.update','3',NULL,NULL),('employee.create','2',NULL,NULL),('employee.create','3',NULL,NULL),('employee.delete','2',NULL,NULL),('employee.delete','3',NULL,NULL),('employee.index','2',NULL,NULL),('employee.index','3',NULL,NULL),('employee.update','2',NULL,NULL),('employee.update','3',NULL,NULL),('item.create','2',NULL,NULL),('item.create','3',NULL,NULL),('item.delete','2',NULL,NULL),('item.delete','3',NULL,NULL),('item.index','2',NULL,NULL),('item.index','3',NULL,NULL),('item.update','2',NULL,NULL),('item.update','3',NULL,NULL),('payment.index','3',NULL,NULL),('receiving.edit','2',NULL,NULL),('report.index','2',NULL,NULL),('report.index','3',NULL,NULL),('sale.discount','2',NULL,NULL),('sale.discount','3',NULL,NULL),('sale.edit','2',NULL,NULL),('sale.edit','3',NULL,NULL),('sale.editprice','2',NULL,NULL),('sale.editprice','3',NULL,NULL),('store.update','2',NULL,NULL),('store.update','3',NULL,NULL),('supplier.create','2',NULL,NULL),('supplier.create','3',NULL,NULL),('supplier.delete','2',NULL,NULL),('supplier.delete','3',NULL,NULL),('supplier.index','2',NULL,NULL),('supplier.index','3',NULL,NULL),('supplier.update','2',NULL,NULL),('supplier.update','3',NULL,NULL),('transaction.adjustin','3',NULL,NULL),('transaction.adjustout','3',NULL,NULL),('transaction.count','3',NULL,NULL),('transaction.receive','3',NULL,NULL),('transaction.return','3',NULL,NULL),('transaction.transfer','3',NULL,NULL);

/*Table structure for table `AuthItem` */

DROP TABLE IF EXISTS `AuthItem`;

CREATE TABLE `AuthItem` (
  `name` varchar(64) CHARACTER SET latin1 NOT NULL,
  `type` int(11) NOT NULL,
  `description` text CHARACTER SET latin1,
  `bizrule` text CHARACTER SET latin1,
  `data` text CHARACTER SET latin1,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `AuthItem` */

insert  into `AuthItem`(`name`,`type`,`description`,`bizrule`,`data`) values ('client.create',0,'Create Client',NULL,'N;'),('client.delete',0,'Delete Client',NULL,'N;'),('client.index',0,'List Client',NULL,'N;'),('client.update',0,'Update Client',NULL,'N;'),('employee.create',0,'Create Employee',NULL,NULL),('employee.delete',0,'Delete Employee',NULL,NULL),('employee.index',0,'List Employee',NULL,NULL),('employee.update',0,'Update Employee',NULL,NULL),('item.create',0,'Create Item',NULL,NULL),('item.delete',0,'Delete Item',NULL,NULL),('item.index',0,'List Item',NULL,NULL),('item.update',0,'Update Item',NULL,NULL),('itemAdmin',1,'Administer Item',NULL,'N;'),('payment.index',0,'Invoice Payment (Debt)',NULL,NULL),('receiving.edit',0,'Process Purchase orders',NULL,'N;'),('report.index',0,'View and generate reports',NULL,'N;'),('sale.discount',0,'Sale Give Discount',NULL,'N;'),('sale.edit',0,'Edit Sale',NULL,'N;'),('sale.editprice',0,'Edit Sale Price',NULL,'N;'),('store.update',0,'Change the store\'s configuration',NULL,'N;'),('supplier.create',0,'Create Supplier',NULL,NULL),('supplier.delete',0,'Delete Supplier',NULL,NULL),('supplier.index',0,'List Supplier',NULL,NULL),('supplier.update',0,'Update Supplier',NULL,NULL),('transaction.adjustin',0,'Adjustment In',NULL,NULL),('transaction.adjustout',0,'Adjustment Out',NULL,NULL),('transaction.count',0,'Physical Count',NULL,NULL),('transaction.receive',0,'Receive from Supplier',NULL,NULL),('transaction.return',0,'Return to Supplier',NULL,NULL),('transaction.transfer',0,'Transfer to (Another Branch)',NULL,NULL);

/*Table structure for table `AuthItemChild` */

DROP TABLE IF EXISTS `AuthItemChild`;

CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) CHARACTER SET latin1 NOT NULL,
  `child` varchar(64) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `AuthItemChild` */

/*Table structure for table `account` */

DROP TABLE IF EXISTS `account`;

CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `balance` decimal(15,4) DEFAULT '0.0000',
  `date_created` datetime DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`),
  KEY `FK_account_client_id` (`client_id`),
  CONSTRAINT `FK_account_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `account` */

/*Table structure for table `app_config` */

DROP TABLE IF EXISTS `app_config`;

CREATE TABLE `app_config` (
  `key` varchar(255) CHARACTER SET utf8 NOT NULL,
  `value` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `app_config` */

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `category` */

insert  into `category`(`id`,`name`,`created_date`,`modified_date`) values (1,'Drink','2014-05-19 00:00:00',NULL),(2,'Fruit','2014-05-19 00:00:00',NULL),(3,'Alcahol','2014-05-19 00:00:00',NULL),(4,'Groccery','2014-05-19 00:00:00',NULL),(5,'Meat','2014-05-19 00:00:00',NULL);

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `mobile_no` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `address1` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `address2` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `country_code` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `notes` text CHARACTER SET utf8,
  `status` varchar(1) CHARACTER SET utf8 DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `client` */

insert  into `client`(`id`,`first_name`,`last_name`,`mobile_no`,`address1`,`address2`,`city_id`,`country_code`,`email`,`notes`,`status`) values (1,'lux','sok','02398393','','',NULL,NULL,NULL,'','0'),(2,'Jhone','Doe','0123456789','','',NULL,NULL,NULL,'','1');

/*Table structure for table `currency_type` */

DROP TABLE IF EXISTS `currency_type`;

CREATE TABLE `currency_type` (
  `code` int(11) NOT NULL DEFAULT '0',
  `currency_id` char(3) NOT NULL DEFAULT '',
  `currency_name` varchar(70) NOT NULL DEFAULT '',
  PRIMARY KEY (`currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `currency_type` */

insert  into `currency_type`(`code`,`currency_id`,`currency_name`) values (76,'KHR','Kampuchea Riel'),(142,'THB','Thai Baht'),(151,'USD','United States Dollar');

/*Table structure for table `debt_collector` */

DROP TABLE IF EXISTS `debt_collector`;

CREATE TABLE `debt_collector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `adddress1` varchar(60) DEFAULT NULL,
  `address2` varchar(60) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `country_code` varchar(2) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `debt_collector` */

/*Table structure for table `debter_client_ref` */

DROP TABLE IF EXISTS `debter_client_ref`;

CREATE TABLE `debter_client_ref` (
  `debter_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`debter_id`,`client_id`),
  KEY `FK_debter_client_ref_client_id` (`client_id`),
  CONSTRAINT `FK_debter_client_ref_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_debter_client_ref_debter_id` FOREIGN KEY (`debter_id`) REFERENCES `debt_collector` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `debter_client_ref` */

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `employee` */

insert  into `employee`(`id`,`first_name`,`last_name`,`mobile_no`,`adddress1`,`address2`,`city_id`,`country_code`,`email`,`notes`) values (37,'Owner','System','012999068','','',NULL,'','',''),(38,'super','pos','012878878','super addresss','super address2',NULL,'','','');

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
  CONSTRAINT `FK_employee_image_emp_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `employee_image` */

/*Table structure for table `exchange_rate` */

DROP TABLE IF EXISTS `exchange_rate`;

CREATE TABLE `exchange_rate` (
  `base_currency` varchar(3) NOT NULL,
  `to_currency` varchar(3) NOT NULL,
  `base_cur_val` double(15,2) NOT NULL,
  `to_cur_val` double(15,2) NOT NULL,
  PRIMARY KEY (`base_currency`,`to_currency`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `exchange_rate` */

/*Table structure for table `inventory` */

DROP TABLE IF EXISTS `inventory`;

CREATE TABLE `inventory` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_items` int(11) NOT NULL DEFAULT '0',
  `trans_user` int(11) NOT NULL,
  `trans_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trans_comment` text CHARACTER SET utf8 NOT NULL,
  `trans_inventory` double(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`trans_id`),
  KEY `FK_inventory_item_id` (`trans_items`),
  CONSTRAINT `FK_inventory_item_id` FOREIGN KEY (`trans_items`) REFERENCES `item` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `inventory` */

insert  into `inventory`(`trans_id`,`trans_items`,`trans_user`,`trans_date`,`trans_comment`,`trans_inventory`) values (1,1,38,'2014-05-07 09:58:26','POS 1',-1.00),(2,1,38,'2014-05-10 15:44:19','POS 2',-1.00),(3,1,38,'2014-05-10 15:47:46','POS 3',-1.00),(4,1,38,'2014-05-10 15:51:11','POS 4',-1.00),(5,1,38,'2014-05-10 16:24:17','POS 5',-1.00),(6,1,38,'2014-05-10 16:24:52','POS 6',-1.00),(7,2,38,'2014-05-11 09:17:06','POS 7',-1.00),(8,1,38,'2014-05-11 09:17:06','POS 7',-1.00),(9,2,38,'2014-05-26 11:38:23','POS 8',-1.00),(10,9,38,'2014-05-26 11:38:23','POS 8',-1.00),(11,2,38,'2014-05-26 12:18:57','POS 9',-1.00),(12,1,38,'2014-05-26 12:18:57','POS 9',-1.00),(13,2,38,'2014-05-26 13:19:28','POS 10',-1.00),(14,1,38,'2014-05-26 13:19:28','POS 10',-1.00),(15,2,38,'2014-05-26 13:19:35','POS 11',-1.00),(16,1,38,'2014-05-26 13:19:35','POS 11',-1.00),(17,2,38,'2014-05-26 13:20:20','POS 12',-1.00),(18,1,38,'2014-05-26 13:20:20','POS 12',-1.00),(19,16,38,'2014-05-26 13:20:20','POS 12',-1.00),(20,2,38,'2014-05-26 13:22:07','POS 13',-1.00),(21,1,38,'2014-05-26 13:22:07','POS 13',-1.00),(22,2,38,'2014-05-26 13:30:01','POS 14',-1.00),(23,1,38,'2014-05-26 13:30:01','POS 14',-1.00),(24,9,38,'2014-05-26 13:30:01','POS 14',-1.00),(25,2,38,'2014-05-26 21:17:53','POS 15',-1.00),(26,1,38,'2014-05-26 21:17:53','POS 15',-1.00),(27,16,38,'2014-05-26 21:17:53','POS 15',-1.00),(28,2,38,'2014-05-26 21:18:40','POS 16',-1.00),(29,1,38,'2014-05-26 21:18:40','POS 16',-1.00),(30,16,38,'2014-05-26 21:18:40','POS 16',-1.00),(31,2,38,'2014-05-26 21:20:15','POS 17',-1.00),(32,1,38,'2014-05-26 21:20:15','POS 17',-1.00),(33,16,38,'2014-05-26 21:20:15','POS 17',-1.00),(34,2,38,'2014-05-26 21:22:53','POS 18',-1.00),(35,2,38,'2014-05-26 23:00:44','POS 19',-1.00),(36,1,38,'2014-05-26 23:00:44','POS 19',-1.00),(37,16,38,'2014-05-26 23:00:44','POS 19',-1.00),(38,2,38,'2014-05-29 13:38:26','Receive from Supplier 4',2.00);

/*Table structure for table `invoice` */

DROP TABLE IF EXISTS `invoice`;

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `invoice_number` varchar(50) CHARACTER SET utf8 NOT NULL,
  `date_issued` date DEFAULT NULL,
  `amount` decimal(15,3) DEFAULT NULL,
  `work_description` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `payment_term` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `taxt1_rate` decimal(6,2) DEFAULT NULL,
  `tax1_desc` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `tax2_rate` decimal(6,2) DEFAULT NULL,
  `tax2_desc` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `note` text CHARACTER SET utf8,
  `day_payment_due` int(11) DEFAULT NULL,
  `flag` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_invoice_client_id` (`client_id`),
  CONSTRAINT `FK_invoice_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `invoice` */

/*Table structure for table `invoice_item` */

DROP TABLE IF EXISTS `invoice_item`;

CREATE TABLE `invoice_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `amount` decimal(10,3) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `work_description` text,
  `discount` decimal(10,3) DEFAULT NULL,
  `discount_desc` varchar(400) DEFAULT NULL,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_invoice_item_invoice_id` (`invoice_id`),
  CONSTRAINT `FK_invoice_item_invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `invoice_item` */

/*Table structure for table `invoice_payment` */

DROP TABLE IF EXISTS `invoice_payment`;

CREATE TABLE `invoice_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `date_paid` date DEFAULT NULL,
  `amount_paid` decimal(10,3) NOT NULL,
  `give_away` decimal(10,3) DEFAULT NULL,
  `note` text,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_invoice_payment_invoice_id` (`invoice_id`),
  CONSTRAINT `FK_invoice_payment_invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `invoice_payment` */

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
  `deleted` tinyint(1) DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_category_id` (`category_id`),
  KEY `FK_item_supplier_id` (`supplier_id`),
  CONSTRAINT `FK_item_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_item_supplier_id` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `item` */

insert  into `item`(`id`,`name`,`item_number`,`category_id`,`supplier_id`,`cost_price`,`unit_price`,`quantity`,`reorder_level`,`location`,`allow_alt_description`,`is_serialized`,`description`,`deleted`,`created_date`,`modified_date`) values (1,'Banana Summer (Imported Cambodia)',NULL,NULL,NULL,1.1000,1.2000,-10.00,99.00,'',NULL,NULL,'A good fruit for healthy life !\r\n',0,'2014-05-06 23:40:11','2014-05-26 23:00:44'),(2,'Apple Spring (From USA)',NULL,2,NULL,1.0000,2.0000,-10.00,NULL,'',NULL,NULL,'',0,'2014-05-11 07:16:28','2014-05-29 13:38:26'),(3,'Pineapple',NULL,NULL,NULL,1.0000,2.0000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-11 10:03:40','2014-05-18 06:46:01'),(5,'Mango',NULL,2,NULL,1.1000,1.2000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-18 06:46:36','2014-05-19 15:16:19'),(6,'Orange',NULL,NULL,NULL,1.5000,2.1000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-18 06:46:50','2014-05-18 06:46:50'),(7,'Lechee',NULL,NULL,NULL,1.0000,2.0000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-18 06:47:35','2014-05-18 06:47:35'),(8,'Lagon',NULL,NULL,NULL,1.0000,2.0000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-18 06:48:04','2014-05-18 06:48:04'),(9,'Durian',NULL,NULL,NULL,2.0000,3.0000,-2.00,NULL,'',NULL,NULL,'',0,'2014-05-18 06:48:55','2014-05-26 13:30:01'),(10,'Lemon',NULL,NULL,NULL,1.2000,1.3000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-18 06:50:30','2014-05-18 06:50:30'),(11,'grape',NULL,NULL,NULL,2.3000,2.4000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-18 06:50:47','2014-05-18 06:50:47'),(12,'ចេក',NULL,NULL,NULL,1.0000,2.0000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-19 22:00:48','2014-05-19 22:00:48'),(14,'zebar',NULL,NULL,NULL,1.0000,1.1000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-20 16:28:54','2014-05-20 16:28:54'),(15,'Jackfruits',NULL,NULL,NULL,1.0000,2.0000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-20 19:15:09','2014-05-20 19:15:09'),(16,'Cherries',NULL,NULL,NULL,1.1000,1.2000,-5.00,NULL,'',NULL,NULL,'',0,'2014-05-20 19:16:34','2014-05-26 23:00:44'),(17,'Jujubes',NULL,NULL,NULL,1.2000,1.3000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-20 19:21:03','2014-05-20 19:21:03'),(18,'toddy palm',NULL,NULL,NULL,1.2000,1.3000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-20 19:25:21','2014-05-20 19:25:21'),(19,'rambutan',NULL,NULL,NULL,1.0000,1.2000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-20 19:27:07','2014-05-20 19:27:07');

/*Table structure for table `item_expire` */

DROP TABLE IF EXISTS `item_expire`;

CREATE TABLE `item_expire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `receiving_id` int(11) NOT NULL,
  `mfd_date` date DEFAULT NULL,
  `expire_date` date NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`item_id`,`receiving_id`),
  KEY `FK_item_expire_item_id` (`item_id`),
  KEY `FK_item_expire_emp_id` (`employee_id`),
  KEY `FK_item_expire_rcv_id` (`receiving_id`),
  CONSTRAINT `FK_item_expire_emp_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_item_expire_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_item_expire_rcv_id` FOREIGN KEY (`receiving_id`) REFERENCES `receiving` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `item_expire` */

/*Table structure for table `item_image` */

DROP TABLE IF EXISTS `item_image`;

CREATE TABLE `item_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `photo` blob NOT NULL,
  `thumbnail` blob,
  `filename` varchar(30) CHARACTER SET latin1 NOT NULL,
  `filetype` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `path` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `width` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `height` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_image_item_id` (`item_id`),
  CONSTRAINT `FK_item_image_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `item_image` */

insert  into `item_image`(`id`,`item_id`,`photo`,`thumbnail`,`filename`,`filetype`,`path`,`size`,`width`,`height`) values (1,5,'����\0JFIF\0\0\0\0\0\0��\0�\0		\n\n	\r\r\r \"\" $(4,$&1\'-=-157:::#+?D?8C49:7\n\n\n\r\r\Z\Z7%%77777777777777777777777777777777777777777777777777��\0\0f\0�\0��\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0��\0;\0	\0\0\0\0\0\0\0!1AQaBq���\"#2Rb���$4CSTr����\0\Z\0\0\0\0\0\0\0\0\0\0\0\0��\0/\0	\0\0\0\0\0\0\0!1AQ2\"���BRaq������\0\0\0?\0�\0�\0@\0 \0�\0@\0 \0�\0@\0 ��Y`�J�5e��8�5M����ဲJ��.�����S����n������J�~��4}\nۼ�;�\\;�to&�Yf�.�0,�7��Q$S;9���R�V����4�Q�Qqxhz��@\0 \0�\rs���u	�0Y��ԲR��{�A���N���ٝ=�;��[�9=٦J�\\�V9]�h�\"��	U;�h�\"	*��eѤ��W����E2��}I[i�l�[&B��`o�-q�ľ��d�9\"��\'���E[N��,�-Ռg\r����	�d����hKTr|��N/�*�@\0 ���mp��Sa�i�y��^%�T��Q��\0�da�U7��\'S���V�Q�L�a�V�����,�Jy���N�&�\n_�G��$S�/�JUZi���*��V�f����J�S3�j�f�7�A]8�-��[���ⵏĤj�#\Z���/Bү������S��t��A�Q��R�T�h<9z{vZUh9�����;}�lh+JA\0 n�TIMh��,�ӀG,�Yo*8Qm��<��|�W�8�{j�\\�29��Iœ6U[���P�q6@S.�&�I.�%DJSK�_\\�ک�����j�5d-Qd�P�I3����a.�UN����V7��\0�K\ra�/(�[��߃�-\r�\Z�\0�-]S5�A��?>�д��_�|��z��n[(�j�a\0���M�rђq�d���D������e�vA;��/��F���8�tf����AU��{*��w�K��U��铲�*�e2Q9#���l>\\���T�BB�%����j���g��r�L��WE�\"~��Z�!��_�F��[@\0!zV��t�>W���[_��Z�$�����&p�yg���xЎ�pNs�h�����*�v��.����7�Muw��jbI4�����r뼷�ơۚ�y���_\r[�I��ߤ������B�o�)�M���\Z<Z}�ǆX�|���U!��L	��K���T�~ǫi�O/��wQ|c���Rϯǥ�E�F�6�Ncr��k��\ZSĮwr� ���\nJ�5\"���[�E�3\0ʾ-�\"��U�$���U�g�|�F�W��!ww\'�[l�L���Z!������Ԭ��|d\r�qi�Gp�8F�\\e�\'Nn����x��Ծ��t��ݬu�:���\'����\0���MH�ǂvTd�*o���>r�����S9<�{�9�	��lh���wJ�q�\"	���\'�;�\ZF7��Ȗ�!��?]�H���ʿOKIo�cZ��`�ǂ�oRU&�[O[�Y<�Y�8��#؋+�h%]���Yf���dǉ�ZcL��]c��66��]��7��9�_���B�=ϳ�n%Z{�:y�w�C.p��v;*�Q�h8Me3M�ˣ/��8�TKIPik���ӍG�_}��A���\0��gp�[.W�G���F��`v��]���̝�k�d`a���N�k��w��I�J�M��M��K�@dY��W��ݳ��G/�[I���0۵�j$�^�b_��ݾ���\rf=_��Vl��j���;q���Z�Rջ��nn1��N���E@B�j��Bc�f�\0+���*\\�и�A��.K���MU0�#%��#��y��S���h�Q��t��8^p�xn�����V��?оT�K���V\'@x�uP���_�\\�\ZF��P�3��9�56E*��0�$����Q��V(�.wVƝ1t����Ɩ�vU��H!�ⷤOQ�i��U�xQ>ӷiZ!NO�Bu����ѳt��}S�+�7����\n	o#ϭw)m���@�\07\0��\0��X@1�_)o�ss��{+kÌ��E��Z��hު�5rj�sR�����c��<�	�\r�58���)�u���\Zݚچ�Τ?�\'�K�R|lw���\0��\0A~M�I���_�h{9���&=�-�O�,�teJ=\Z��W+�E�6>|~�S���@[)��xx�D����;KݪhK��Y[U��w��{v�����w�G;�-C���H1�0�.�I�4�� �\Ziف�r�GF��E�0L)$��l�4H��\0�\0@!ހM���4��#!�4����2\ZSH�iM(d4���.�����B�<�@�\0 \0�\0@\0 \0�\0@\0 ��','����\0JFIF\0\0`\0`\0\0��\0;CREATOR: gd-jpeg v1.0 (using IJG JPEG v80), quality = 95\n��\0C\0			\n\n\n\n\n\n	\n\n\n��\0C\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n��\0\0r\0�\"\0��\0\0\0\0\0\0\0\0\0\0\0	\n��\0�\0\0\0}\0!1AQa\"q2���#B��R��$3br�	\n\Z%&\'()*456789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz���������������������������������������������������������������������������\0\0\0\0\0\0\0\0	\n��\0�\0\0w\0!1AQaq\"2�B����	#3R�br�\n$4�%�\Z&\'()*56789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz��������������������������������������������������������������������������\0\0\0?\0��9�����󠑚S��8=h�&�ҐQ@j1�Ҍ��h�\0)z�{���sӚ\08<\Z\\z�nȧ���K�{N�_�\\�}�s��P�Aά�Wv�Tc)�E\\�\0���OR������ݫ\n��E�\0�)����q�a�gV��\\�(e��݇�zW@�8�+Ǯ~>�Q9�\"Ǹ�4��js-���t5�7�+m6�Gz�|ݫ���=��8�k����o�:�^�Hud|�]ƅ�\r��4��5�e2I���{�L�.�/��O��g��ʳ\n�zN+�O����@���R]�9#��ǎ��ri�~������1�\"� u���JE\0!�dR� �\0���={�s��l7�\"*��s�?\Z�_��_<!$�V��^\\BH�a��~���θ�&��?��+*q�w��[�ө�*U+K�\n��6w��kY���h�ė��G*��|u�g_��f4#�C��o����\\y�Y���̜}+��\"��M:yM7/�?��#ud���}W�o���B����qz�ŵl������O������?4�����\0�\\9�k�����#��T�~���}�Sø-9mC��o��H�~�O>��j_)qrܟ�W�˭��X�Y����,y����s����?F˸w\re��j�� ]��r��}���.G��>�.��&8�/�:)1�G�}�E�fuZRg��)��Қ>����ә�.��Q�_�a��Z����r����t5�g�|G��;�g�̄u��k�<o���:��j�$y���������\'�s���SZ��i�g�O��r��\0V/x�d��8�+�a�x?xt�_KApd�H9R������-��t�\0x��/�HaY�Ʉ��������~i�7��{yt�\n��}}��_�pv{_1�,>&W�V��_������넱����	�6�\'�]����nA����߻6ܒpT� �\0O֭y���?��(8�qރ�@Q��6�^\0�}���T!�Ԫ���z�v�C��(�Z��W�����8�����6I�T��S��}�]�����~��Z�R-W��MO�Q�%ŵ̧��%9ۚ����d���%�<`濊x���#�^���\'�EGK[�W~��F_W���=�_���];��^a(f`����^9o�%���#�z֭��V�\r�q�_S)J:#����7=~�[,��Z��63�}s^_a�kI+)��iA�Eo���^\'-k��~C�L�_��H�:z�5\rUd��&?\Z�Ǌ`h���sT/�J�&�Ď�5��˭3�<���M��5�c����ŷ�c`��sV���T��F;^����(�����L���]u�p����mB(��pr=k�>&H���C`��^\"�s ��㞕�>!2\\M�l�_��a\Zj,�:X�ք>h��Mh�^To:$����\'��W�7������Ok&���<5�>E���Gkw\r��[�R;c�~gCm,m�g��O��ֽ����;���K�	7�kuΙq+}˄@�C�W�`�U0U}�)8��5�\0�~:�%���$����t�����\'���\0�_����\'�-���9��xAu�\'�h��v��c��9��@ ^M�$^�\Z����9t-2��(�Xb�5�	\n8\\v=k�GA�J��\"¼&[*����6����vK��\n�\\\\�Y�H�1���E�����{��d�$g��;p q\\Oſ�w�\r�8<W���\'���A?�\\���%�]�R8�����p�b���+{9I]];>�?�����:���Ú\'���O�Q�#nU��x�;����d�mW��̫Q|lѮ���#��yԼP�Z�\06?�O$�c�&|S�\0 ���?f��t�����:(#�G�_x��&���ڧ����}�lON?�~��׾������v��\n�\Z`�]�s��x�7�\'�ōS-���O�џ(��F=>f<W�_�ɣ���2�\\Z���G}�g��Ί�J2�����U�|O��\"��Ɍ��M;_�\0-�x�k����O���k{�KH�OV�?�a]�\0�=>$�#�4�?h:�W��>���6�S=>KV5��g��g���Lm�z�t�]��O��f���\0�>>+[H|�.ЏQ~i��!����Ii��\0<.+��i��^��9<=�JOc�l���>bi�Z䪤`A����;�\\,Oތv��Y�f�\0��&����\0�5���$]�\0C�l�2�S�Nk�<[W��p�a�Eq> >�P��־�־x�)7����Mq�$�)�\".�\r��>�[��0��Ҋ>���\\����|��\r.I�0y�]SA1q8�k��o�+�dj�D֥؄��+���9���H6����˱�*��>�8Ԃi�y�h�઀=�*��O�(�	#`���Һ(��G)�^qگXxt�ɶ8��������U`���WT�?a?���?��\0uk��[�$1�9!�̊��~c�\0��_�ty<w㇂e��kx7��Ŏ?��8��~��<������?��W���������x�;���\0̍[J�ִ�4�J�͆x�e�A�`��3_|T�v��4x�\0��ۆ��܌��ķ�7�3�0�>������|-��7~�e���}�EL4��~�ד�|���I,-ZkXT_%߻��Q��p�G\"�~�^������n��Zw��II�{#���}z֚x�̐~�E㢽yg��|E���R|\'�Y�f?����J���8�+CF񵆯i�}�R�U���}������.�N��3W��������ЯF5�(KU%��WU����K� ���?� ��D��ɮ\Z-[�\0�6՘�.�3_*�c�����}��n��\\ƚu�7e�`A�W3��/�z��@7���j��$�ğ�F:$tm��`��:�����O֏�?\'��Q����X��C&�&3��~Z]h�NӞ�W7>�	?����k&M�J�VoI?���t�x�M��lJ��|Sm����W?xu��W1{�,qm��\'�xg�S�K/�\n\\���u�ؚ8#S��7���T�l�6�͵��7�_K�_vx�/�~=��\'�t[���~h�4�|���<~U�%�����v-�\0	�v0|?׼E-�s!��̗3��v9&�o|ӌ�=͹�;��EW�yp�HQ��%~�?W�slO��k���7�_�����w,\r\Z19+��\0���.��<1_��u#P��%�\0���\0�����e�\0U�\0�W��W�#&���\0�gc�2�k\r>E�vA?��+��#u��ϲ?8������|��[��z�o�M���Yxj��m�n��obU���ֽ�t1�b��E~���O\rF4��%�����W�b���&�\'v�z␨��9�R�\'�[�1�/ᯄ>(�xk�:$wV��R�,�A���<���\0�_����]�j�Q̏�l��9S*Xt�zW�\\�y`���Ww�ɸ� S�v�^&y��?���))���<Ϩ��,�8r|�isS{�Z��\0��G�.����â��M�H�G\n������1�]݇�-��k-B9cn��\r}}���7����s�\0�k�B��}�-�ht�3��|S���\'�Z��x��$���N,�u���������G,?;���i,�^�I5��?d��ׇ3T�G,<�I{ѿ�W��V�M��(Ye^}j�~$��U>ٯ�n�_�X�@��\\��[�y��~V�T\Z���\0�P-����y�]X�_�f>q�\n�K俺��n}$19d�x�)IyT�����}\"|@��_�__U�\0���g����Oك�<Ƚ7�U�3�ߴǊ?q���.F��6n��W�O�~8�Q%���eW3�𱼪��O�l���%S�j��~ �Y#�u�G\n*�ۘW7�������y�ρ��4n6O�V�I�\0����)��?�].7�;v�}�I��m�**�z�5��1|k�aը���*���\\�>���	]<��H����o��j�����Ks3��8����A�O:��U��,���t~�\0�$�gK��߉�����?�~�þK�)��	��&���/C�\\i�u9�;��c�/hݺyrddo\0ӟ¾���?d߈�\0���k��<��L���8����_A�+�\0�j�8�ys�ķ��G�_����ï���mWN��E�%~�d�����2��M�ZV�K�gcǑ������_q�~�?�������q����j�0�G�I�ߍ{��v�*�Q�]�Q\0�+\'K���\0k728�&A�;kE�+��b�_���0ty)F���?)��8����&��\0���ڀ=)\n?\n�8�\'�0y�POlRI��\0���\0Q�8��[==�@g�y[����/�����U��b9�s��PTt��J��XԤ�2�7\r�q�:&�� ���N��=\0�=�8�xZ�x\nor�i����B���(�˷�|��\0�Ei����}B�*�[/��H�cY�q�%G�\0�\'��ێkh�20�ތ0U�l\'U�	�6���G��@��	�[���B�>Ԃ�%�]�r0χm���@�\'%3�1[�Ty�1��Ra�G\'Kvf�@�XQ�Py�]%T�Ԃ�E*�Ncޮ*�B�Q�٥�h�i��)sE\0��jA���E\02x����(T\r�)?����E\0�J�P\0�3Br��E\0��\n\Z�(\0�������\0�4/\\�E\0:�(���','9839_mango.jpg','image/jpeg','/../ximages/item/5',2506,NULL,NULL),(2,2,'����\0JFIF\0\0\0d\0d\0\0��\0Ducky\0\0\0\0\0P\0\0��\0Adobe\0d�\0\0\0��\0�\0		\n\n				\r	\r��\0�D\0��\0�\0\0\0\0\0\0\0\0\0\0\0	\n\0\0\0\0\0\0\0\0\0\0\0\0	\0!1AQ\"aq2����B#��R��3�br$�C���4%	S�c�&\'\0\0\0!1AQaq�\"𑡱��2�B#�Rbr�3$��\0\0\0?\0����P\n@(\0��P\n@(\0��P\n@a�\"�%�8���3Y[�����|P2�\r�A�J��}��Y���ok�s��\'�?Wҕ��:n.��+���pq���_E-�Y3���엽�����5$p�����f�r�!,�@�������p������/\r����&���I,p>d<��2(v���5��^���J:�d���������RG�W�|tqk$��*���2��j*������X\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@k^��>�=�����ǟ+��ןwJ��l��]k���\\\\O#S����|�Í��,xNk�����I��rP�����*��>t#���e�Z�U�cj梽\\�ZV���ePY�UQvc�\0UmeU-�Xr?z>�q�d�����I`�C+�]�^5�\0����l�����r_���;�����\0v~�nY���3���3�����SB/׭y�����O�\0o�<�y�5��e`���7*U8|6��1i�|o��\0�e��r,�Ǥ~�r���\n�\r�~�=�����=��ȿ��Ήb:zd�7������Q��I{�\0#����+�͗���}���Ƚ����F�D$r7����5~?��&K��:�W��;1yL-��\0���[�q>Dܗ I*�Q`KEr7\0M�j)���[\Z���9Z�`��W\r/�V�|�ގ\n�`�e�)�!��216�f�WM����VW�O��/��V�Se�O�bbq��d�pceGJ�\\Ͳv`.F��tҵ���֏���0�\0>�B�6nvKN��չ_���h���=�k�l{��+���7]��s˷��\0g�j������i�<o��<H�J[l���H,��|+�/��d{�j�G&o�.�\0�P���_��\0���|�c��+e!�v�@ђ\r�2���O#ʇU���~ps[�\"�4�����V_9��32��h4�\r3��^��Hj\Z<[���kg�����{)b����E!��&R��E��wiz�Ľ\n�������q���r��7?\'�ϰ�\\ىi]\0fn¶D���.�m�S�NtE�:H�`���#�o~�\rI�[�\Z�/��pٙ�	��	T!���$�n�W�D�$/�-�9���s���.[?��̗��<����c]Mo\\ij�\0{sy5��;/��\0u}�����ȇ%�B�2D�:��n��qd�\'8�^��?�̓��������~�2�x��Oڲ�O��/\'�ތ)m�Vۏ�*�1��ET:�{z}�������T��m���Ӈ��s�|�0{��Ɠ+�e�KK�m�V$5�\n�/)ɣ����f��|ђ����03�y<<l�)D��q� �zj�LYk����ϥ�zު��2]h\\P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0�P���ۂom�-�y�~���8>cqԒ4���܉U���\"����y�ۘ_t��bI���22��KL`1���B�2����?._\Z��)~|�.~\Zn����_�?}�q��g��!˱�X�3\r��h�m��e��([W��l��\0�rZ����<�=��p����o�\0��L����ј�h�H\n/��W�d���m��\'����#m��i9^�Ia8�bÉ���RFC����S�ѪSVy��*�kk��\\Y\r���!�����-kX���v�խ�x֬�k��e���S�Y�r�X�U���u�Mrg�;R+)��Ҟ泝~{�ټ�^dG�\n�$$jWK�^��;}M=���Fq��ۉ�Ɇ�n�cۡ����U\"�~_�af.vL|�Orn�\'xK�|\r��V�4�-��/�먳��/Q\Z9�9p;_mؒ4���%A.d��ŋ5��q�XIa��o؏�F�e��n�;��l�q��\'Ҍ\0]���m�����=��~K\Z(�j\":3	\n�W��&�i�al��S�|ϸV9�\0Q��?�ECv��\0҉{��+V���Η��\Z�<�����S1#l���+�DT{h�생�m����Y0�#��0U��gB�̧�,�ڧ{K�w⦑TSt``�\rǾ^4X��ґ+)��nj�<�tV���<1���gL4�[�UM���X���98����0�p��\ZI\"4�]t��j\'=N����UK�,}��>,rb�����nR�B���躊�pg�Zܾ��Ǜ#`c����R}&�$)��5\Z�>�����t�)b�c�)�}F��E\n��D�9Uᖮ��N�x̒��_t��+����Z�/m}�t�7��;�lN�\\����S&F�䣋d<l;��y9qF�8Nc����~[/��W�����,<������C�k�q�}U�Q�X�UYwRK���P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\n�G��i�\'�p�&\\&-��}/؁�|\rgl4���Sk��^=2��ŨU�(\n��KxZ�5ڢ;\Z�+����1gbO�\0��\"֮�7n�������U�:���K4!��,�}̡V)O��?�x܏e�7?�82���J���N�潇.&C����Ý�Q����7)�x�����G��_�G��뉽��c;C�fq͹W!\r��H5��^s�ں.��5�\0`J��q�Xb�7�\"���^�\n���j��Cq�cS���b#a�S���[���m\\��ق�d��?���s+&�̿�d*F�?WNՃ�e���H�pY<���BѶT3����V�\n֙uzV���ol�\'/\nw�\n��QD�����H#Cn����[�d�|n&�\n,�O;&1���`R��\0��tVҎٵ��ŕ���L�[��~��X�EY�{QĚ�1�>v4���@��b	T��-ֳ�S��SB��0�!��\Z3�g3J����\Z�{U�j`�g����~o�	��䁆D�|�N@]���w\0޴�eK�qd���K�w�=���W����+h�%�R$,��Ⱥ\"Z��X�;�%��Y�i׾���䰹��n?�AXl.7���u:�ֳ���Ln��>�o}�\\���.$�~l,P	Y�{iڴ�=7_����f~>\ń�&��!E�\0.mWU��w=�h~G\'���X�L̊�\"�-s����Ǖ\'5myн9�\0��Ñ.oV�|Us�\r���b/�Q���Z�p�/2>A��qз.r��\0��l��\"��Pr��iRi��	2\'oMӔ��\rX۵�:�Է�oв�|x1�rY�!�;�jt�bt6���M���l���H������+2�ǉ,����x*�Ev�u����u�=ǹ�y��JcNWH=�_X}���P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0�¡��Z�}J\\�m�<��o�;�c��BƱ��Ǔ�U?��~����#Q��O���29��\"ަ<̤��\n��ḷ�\0d{�G5�V\'ѵ������34�g?$����²�\0�(V��?/��Vֶk��Ǔ�_��_�i�}�����^��Ih�G�s~�oR��k���g?ZZ��_�Ǔ�rkҩ���Qs?n��Ĥ��>��\r� ��q\0�T4%�[�ڼ����|��^ϛ�8rb�?��5�_���Pq/>74���/�8�}l7c�������W�Zl{u�OA��!=��y|����8M\"������	Hԛ\\�߇6ߖ�\0y�~\Z��֤��\'\\�~D!>���\Z������]T��G\'�Ӧ�SW��}���%����¸i\0���v�O�_kfY���E�����IBr���9.&ČZ��b.m�����\"\'�k����ybx⑥0A��]ɱ���ziz�w̱�Ɠ)\"�.>j�\\v;�I�`�m4:[[�>D���_�-�=�>_\'���c��xx�HZKܮ���§=;�N�j�t]M߀���Ș�cYb)C#ʠ��ά��WbQ�X���3�Ɏ\\�K������bG���%�n�{\ZҴ�n�u,�v&*c�a#K���*\r�|�@�������/\n���\\u����섏.l|,1,��O*i$��\r/zǍF�X)ZW��1��Il�v���-pk��[>�q�� �#�A�)\0��Kv��=S\'��r���y4\"?�aF�-kt����]N����sܟ�G�8���0f�P$�-�h��@��5������#��\n�9i�ʓ�\0C�U���\n@(\0��P\n@h_r>�{c�g��}������6��)�L��%$\\��X�ΰ�ٛ`�l�UG��x��Y9x18V��p0y(��H!}��(>]M�u6��d�rSj�WXMק�Q��q�e����������\'��(�X�fC#;vts��U��g��Fj�Ui�o��į3�c��M\'���a{s���x�彻���`3��hZ�$_�uV����s1r���]\Z~�5��|�u���@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@k���=��8���psg]S%�Q*��@��Ypc��ꟽ�x829���z:��?d�����A�c~�/W�s�������^W+���X���\0�/��ߑ���1�o�����:^#!���[�x�P�`d#ONBi�:W�rx��7u�ٞn5�����y���?���\'a�Y�ǚ?Q��@��\Z�|����k8^+�֝MW3/ޙY�.�#�\'��4���FA:؀ac�t<����_��8�,��UR@ϋ��ߏ��i��8�?�9O�I$ލq��]5�jV��rZ�iz�n���G!�?hs	�ɴm�.&v�H��m�[�-X_II�o��&ݨ��+��x�kՏ��k�q�6�7��5���F�Qn�6�[m��i����A���Dv���(6�WK\n�y��qѨEVD\\���B`c3 ����.M�J�Vp�W�1�D^r�<\\>.�5�2HHC\"}[M�\0ګ��eSw{*���r�����b�i�n�aצ���f[���D�|���>/��I�y2\':ɸ]����K]�i\\����昮�2)C�1��v��Q\\�[�Z��t�w���\\�8XX�Y�YL�%��R�\0�{+��ƾW	���5��6���\0a{��/\n�f#z�Y�rȱv��W�}/�\\5�}׎���c���f�[����P\n@(\0�:�\0�g��j}���w�}ݝ�\\Q�<�d�~��N�~���nO*�z��ݛ����}�?������_v��A�W��ƞH=���p�b�|���2h���ƭ�ۯ�vG�S�N=R�^��g��$x��Y#1�T���G%��\0���I:�\Z�X�vrz��׳��}����\0c�I����V8��\"y�h�PN���V�ӧ�Rܺ����?{m?h}��w�<�\r�,�nC7���\0p�xY������RN�@Qo���q]���};���_��.[������\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0�?���O���E�+fx�uh�j��Yf�L��t�1͂�TYE���?7+-�����I��_\'*X�,}	\Zj��܏�8��;5�z�̿�jb�y�ޟb�����I20H��8n�¢�]V�#��.W��F)n^�����z�\04����0�>���>7�͊����>�E��ԁ�X{W����Jg��C�����Ǖx\\Xy�*�O%�H�#�\0��6��P����ܶ���1�\0�s\Z����\0�\\,8}���|��B�w!�uA�6ℵ�K�?��Z�K�t,_�=�e��w\r�C��0\\�H8�ɒ4ǆh�7hV���\0L�Q�ֺ��\\o������Cѝ���-,yH��l���uoI�]_n�\0�Z��N��SV��JCzYhh����\'�x�.����%΋q�ɠMM�mt��ȓ�rr1[�+�p�VQ����UV�N훘��W���9+[{��c;����ǈpe��X$(l����w�}mT��������_�zSٿ`��V�t��Q\'��[�U�q��ʽ�/�z<�=����#&D��U����8^3��L+11��Tj�ŏRkڦ:�ET#��j`��\"Үn(\0��P\n@(�������e8��_&<�y�yx�\\b��\"����=\0�_6�~U��?s����!�}O����3�_t��G��\'#$��yx�\Z0�<h�#�#����=�x�/����>�,|jE�y;��������!�fȨ!ǋyb��Uk�\n�p�o媓�6Eg�\'���\0��vn3�?t�ol��O���>t��mV����7�W�^:����>o\"�������s��ٿj�}���\".7\r5Ȝ\0f������A�V��.��k;9z�� P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0�> �A�\rRi��ۯc{��Nkڼvt�%�U�߯�k\Z�LTȢ�Oޤ�����#�/�g�>ee<sf�R9%DN�F��d��\0�37��d�\0l{��\'6OW����|�G�{��s��t��/�`�Dؒ&�D�d[��^N���\0�#�Y~��8�x̋�?v�o�󏼿ms����r~җ/o�/nLi���ʼ>_��V=RV^�۩���e��^�\0��\\�=��6>4<�g\'���ȱ�X]v��܁�����ɍ�M4sێڅ���>����\\�9�d��<|�F81A4\0o@	&���W�\0�ɍ\'j�d]��poX>��y�w�����[a�C��/�N6fA���1�䍥���׷��K�j�\0c�?��*����_����$y�{�t7��ϵΥa[Y����>\'�*׻�>���|\\e��o�{�ޮ���P\n@(\0������\'������Rwރ�a�}@�� �=��S�|��W/�ZC��wp�o5���?>�����?/�d�\\�g5�.ru�Ł�����(M<��z�y81n��R�s�7,UUP���\0o߶�?��rȾ��l>\'tOq{�&�67+�����\Z\\��k^�*������7��=:����?����\0�7�7�늊?mp����T���!\ZI�+�-�/�S�&�w*�������˖�\\���NU\n\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0�4�w�}�?�y�\0hq\\�E��ό���\0�`oƢխ��Oޓ��k�1]˯��n���4�{�<ܟf��W�eg�S#ͅ#X��U\'��<+��x%W�UЧ��u��3��W!�[���\\�o��/�N6ddc;���h&WB\0�^�:��w��p��O��f��n�^����������������L�&a<�K4̶�X����\r-b4���\\�Ib��_���S���e@Y�*��M�{�h��Y����\Zm��`�7�^t��{�V�c�V��|<�?��\Z~�O��qa?�1���\"��\0�VV�b]��~�~�5I�\0r�i�%�$���!?�Eg�\0a��t/�\\�����W�=������.?���\0�O�~������_yk�#�\\ꎼ�\"��Z&�B�e���L��w�N�_ye��R[�\0��t\'����\0�j��c���\0���\0�X�x~��H}ۆY��5���}�[������?����oC��s_���DU�+�\0r0���W��^cr�^g�\0��X�_fG�\0��Z,�}\Z��{`�O�V��q߸./�7�g�I�K�㰧�G�b��D�N��\0BQ�\n���>��G�~_��vpxO3�e���\r����?;�|��^��ˏ�L�R-�6��n�s.�\\�+��q�r��������[~Ͽe�������^i���یL��ǻ����>|^?}��h�m���½�<j���;/_�<>_5�����}����\0����{W��g�x<~��Rm�Áug?\\���;�ՙ��okI�����*�P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@c�X�R�J� ���G�jK�)6j�����ĳ&�0au��J��K�o5}M��]r�\0�ߵ\\>�\':�n�Ǐ~��G�]�4\\[����޷�(�����\Z6&�|�v��j�-�4��\0����Y��g=B����ߐ[�o��?��E���߁�|�\0pi�\0p���3�Y��W.ӏ��M��\"%^����|�-,�2��i��������!�X���홳����>�7�bm���5���.\r|�#�Z_OU��|���=��߹^����?�9,�ȅ[.,��K[l�A#kt#��G\"�t}}O����j����O2�?q�i�i{K�\0ܳ1�H��_ӳ>�.=56���?r�H��Inn�f���\\f����l5�mp��=�� dG+�6��c����\0���\\h7�����%���\n�A\0�$��o[��Oή��%��\n��~����N1�\Zw�BX����,\nL���\rKDo�o/�fř�os��`1 퍜\0�\'N�5{�]lp���Ҥ��}���g��r�8�{d~�\nʹ���������{\\|׶4�E,��y��2ln�&(�����\0��z|j�0͛uu\"����/��\"����\"��q��\"�����	�$\\�Yh�8y���Dj�}����rQf����;��F�7; ��[m�WSn�v��N65֬�������g���_�x�׸�f���\"^k�U�{j ���\n�SX�i����Y��������8oq7�d��>��Ņ����(�*����sS^m�]N~_�[)u��o���y��4�3=��������W��Eyt}t<������;K+2%�\"<�_U�\'��REtV���ږ����V*(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\nY��}��hZ~���UE�9d�� �ʳ�Z�N��k�GA�/mC����3�Öo�fC>�̎\0��Y�K��W�t.,)�:C��\0�o�9�Ɵ���4�E�C,�[X���Q㽺��5�<k��)�����,�r9��N�c�aK\"��f?��Ӫ:���}ŗ,��gO��ic|9���P�4�V�e�z�W̿4I2beobB�f���EꮍuF�ɝ+���4�6<�p��nH���j�\r��<�!˙$yѦd��Vӡ X�U^#Z�\rQ}��C0�#\"VhΒ$��u��ю��;S���>��^��f�p�����7��l�z��u�k%uG���}̟�2G���n����P���$�J���u�¾n��y6���>k�ŷ\Z��=��/`��2�Z�3xe*7:��X�_E��\\��^\'�|�Iw]N�㸾3~:I�\"Ӄ�M{Y�`<�ʺ-�U��u-֥��ؙ\\�.ϔ#W��6�n���mG���|�\"���{���\"��e���+�)�V5��̸\\7ܵ�>�n���̋k��7��G5�[V����\0���q��(�p�ł����\\���%\'��k��/k��:���Omɉ����BYX�N��GO����OG���m�>?�����\0������+�2� G\n4U:���|�k~���V�l�L�������F�^#����|.���,8��W y����ָ�[�W����Mǡ�>���;����	����ٓ��x��r��a@�^@fݷyQs���UEx|{e��}�미x�7�~���7��G���>6$6%�?�W$\\�K�r^���n�RΛ���\'?�(M�c@5��U7��[�D^�~�a��p������0\Zx���T�Vprx�_˹؞�����|�����+J,���L���k|R��<N_�:_Ҿ����FC��~7\0��R4���F��u�[e�[~L���3�w�\0[�L܇�Q��ˣJ�	\Z\\}-(5gʲ]Q\\_֕޲���h�~�=�I�^$M}UVB>�0��\'#�z����]e�/����9�5��*���������\0�t��\\h�,���حi2�r���3��`(�9=E�\0��}�l�W�����qP5�����\0����]N,��q?����\'��|�U���;6�Y\0o�[��[כ�37�|��,�N}ñq9tǙƐ��\0o�\0ͪ�\0\Zޜ�>�?#�r0���a�Q���D�$l.��G���M>���ӆs� P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\rOݞ��߲�_?��c�ERc�����\0J����&Z��k�\r�t<m�O��%��6�XqX\'�2���Cܐ\0#@O�Z�;_�C��zӮ��g;�,<��sXpg��\'.Q��ǿ��B�6��x��}�^>l�*��y/�0�̭�͑����b�k+r�h�O����B�\0p?ڣf�\'\ZE��h���jh5��o.���w�{�_�7J��Oܭ�����!��|�M�b�[��\0(�����r���{�?�ቾ�����b4�F�M�*߹U���Fz�����58����lhpr�k�K�F��\0V�t#�g�\0��\'���\0Y���?���u��d2����s��\0Ud�F��j������\0!wGC�\0��([������&02>��o9�i!*�#��ֿ��7d�����\0�����q�:��~�{�d���a�eLwc�����<ۤ���^�y��z���=�\0��\Z���^�K�����*r\"��^\nf��̑����nG�^�>j���������Y�9~���ۜ�\Z0�������ϓ�U�q���)��Qj�F,<��m���x��N������Y��n������|g+\r���;�����;W/�l.7&�=���x��*��v�|���63�q�/��>9\0�BHһ���})NbV��i~���\\�1%���Qx����.g:�A��xꓯs?��շ�������.lEgLЋ�x)���L/u�1�ȗ�\0m$�#6�\"�A���<,�q�\r73��/�^S!�L�2� �S]�FӥW\"��N�xU1�]:��7�@��X�(��ڻP�k�릷�\'/ovk�������r���3>��j,t���dl�t���:X��@6ܱ�@:�k��\0�K�8��X\\WV��\\�nu�\0�9���|F\n���U1�M��ذ#�t�m��Z<�?W�\0o�\0jxO���;H���9�Y=�̐�7.*����\0���92k���_N�ϸ��U�L\"f�d�\0���!�TKu�\0\n���=�%4�s��x.O�;��G�0�)�0I����ZS}t�%��R͗������&��9otN�q��\r4/&�\Z�\0!]5ǎ�T����3�qX��ٺ��3�������\'�q�#I��y@��8\Z�N��y�i��_[�rYٝ=����ܛ0����8�j~w�,����*�D.�|�(��nK��,N�9fǇpAv�\0�ȷ�Az�� �_)��=��EĿpy,��#51B�6����*�Y�����}�Y�^M�\r�Tf��:��}>b�ݲ��m�k\\����BY��ț%\'�ŕ�2w�H,O��\n��/��@=������lS��6�[w��\Z��3��б���\0$��q�?U��n-m(���W��݌�>D���06�6vt��m�*�>N����y���T\0��|Џ����}�d/�w\\{^�ŗ]3�<�����ez�G�����}��\\������~舄�Ţv\Z\\����qsmW�*�i�G��L+~���눥�x�hdYb��T!����ץ[+)G�ڮ�S%I�P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0����_����	�/o����.���ΰ�����}q�;�ۏ�;��=�5�G�g�߾��r<��u�����H���98���FL�و�\0Hҹ����|����x�����\'����W�?3<Jg���	�\Z?�������o�&��ɽެ�^/��E)O�j�.d����\"Y���ʕ���ԅf���al��=�9w;K��$�$�craI��5�^~~E�#���ڶ�39��ޡ`�\\5��?\Z�^�}w��h��=¨�\"zh�n���X�;는��9A��3�C,R4��(\Z���|K�E2%ؗ/;��6z��*��Aa������<Gv���6o�#ˉH�88��Ɓ4^�}7{h�Oce�\'��0��e��7abʊ\r�\Z���J��\rV\\M4ٻ�~���S2>.H�l^�I�\Z9��{�NI�d���v>3z�>_��o�\\9Z��)=~%��d~�U�Y�Q��5�\r׺\\_�m+�&�G+5z۩�����e�\"	�ʓD�M�f:\0��Ұ�yVύN�%��r=�4؜�N_�\Z	��v�彃���V�0rn��n�M�_q��ź2r��>f\nAR:�\r��SG.O�\'c��߼��\\[y���%�3���<��5}ͯ�Iļu��l����~��������m�K�O�w��+�=��tжl|ƾh����f}��y�U!������X)������T�-�\0�Կ�sj�p���5�n>d�.V9T�ǧ�E[��t�5���9_R�������v\'��\'�2H5�S�U\Z\Z���\Z&����bS����#�o�B̑����9���<��`�<��`Е(��5��wb��5L�\\�,���ۿ��ɹ�~����ng�`G|&.d-����.d�H.�/N�\\��Ok�c�[�O���<�I!�X8xH����%�H���z�x��L�Ym%[:;\'ܼ�2g��	]<��t�D]b��z莾���ȻL�p.(����k��p�������+i5���udn�2se�>T�g���Yи]�<ݼ�`�ܙ��ؔB/�\0\rz�խq�a�c��s����R�E�\'���4�0u�@�\r��ibkeǳ�qۙ�8����y���<\\ܢ�$�e��4�Ī�Y�a�#�j��OG�ʬZÏX�Ȫ��{�+��\\�s�ܱ�fS��v�C�������J��OK���²�y���3�ՙ�@�Pd6t�&����%F���[t(y� 2͉>9���%�P\r����;v�PE�B�[��(�&L98�&.����leE:��A���:�z߮GHy��X�>�K�r;�$г���Sr-�2����k`Tik�\0�A?OB���b����ca�լ��Pt4)l{�3���}G�\\i2r�.o�����?֎�d{��m�C�x�x�I�>V{_�?�?������n���>�P,�u\"׹�tb����\n�~j��?R=����d<��^<��Hܗ�½Lyku���\0#�|�dl�����P\n@(\0��P\n@(\0��P\n@(\0��P\n@(~��\0u��l�2���E�2�+������;����ק���}F�W_��\0�W����|m�E�z/��=ďu}���\\	�f�����\'\r�t�]{ڹ���mtG�p�\"�ݓVt�3��ϐ}E-�FbIo~u����8���o��1�s���r[+1�H�`��P�ƠhT\0\0�+Zס݇��-I���Lλ�\rUA���G{��͏�HU��u��6�؏�z�x��n\'c�q~o�E���yS)l�P�YDL,��X*�[�I=*��y~g=x�R�L�VVG$y�C�k`���@��6\0b�\0��2ybb*H]���Sj��F�\n���n�;�?�m��9ns�׻�����xk,�9�J��Y��q`����OK\n���\\7��ُ�Je�(m�]�;��\\dr�H�V\n2������s[�\n�3��g�嗞��!!A�][Q�ʋ��^ճ��9�+��<,%���]#X�Dvc�g�)��ֶ�F��s�\n�=����\0�s6;����2�>$2�4������;�3Wfk�>[�s��\0$�Z�����-$���d�|��A���U-��`k� /K�v�>��r<ƛ��v��{N��o^���?�ፗ�f0\\y3�e�iT�,�3k��[�Eq�v�qS�\'gT�XP�k|������ŕ��-�ZCs�1`t�]+[`^����w4��?�l|x��e��?Hk�\0B��m�\r����C�����y����q�K���F�>:�4nZ�ͱF�:\\�\0\Z���y�w��ס������>N�Fra-$�!teu�践͏QY�1�)��ԣ�����؊�\0�z�\"�p�O��V����l�?����B�3O�\0G<j�]��0;J�w��V]}<��~��ŀ*��뼲܂X0�����K�Y�\Z���\nl�y���C��9�d��0����.\rźW=���`����C�y|��xS��D=,Q<��Q�q�����㳵g���T�����睗*-�Sc��V\'�E�X�+\\�Ў����9�\0�Ƶ�z{�c����+�����S�v\"��\0S]�ފ��?� j+L|Gg��>{��n����}�3���?m�ea���s2䐯P	�te�A�I��R�ў\'�f�5){?n�}}����H��o�ybƁwƂKyIq��Z�~�\Z�ǃoS漷�\\��\0}�lqc)����-�&��@�k;Һ6��x�j<��Ϸ��v����1�i1�}���(\roƭ�|�j��睽�����t9)��_���4��XY2Ƀ��`�K�=zh5�zU9�}���y���m�J~�����q��ܘbLi�bl�J?�z����6�؛u+�k�^L�O��ʹ���2y\'ݼ�N�z��7��L��\0|�r;t�;�����D�\0vʊGt`�It��\0V��5���ДC�̮��H��E*�@�B>50D%د|�$�VV��!�a��a�\"�#�4��ذdd��&d  L�S����:���%&�&fLl�$��+m]���#��ZZ��Sl���tY8��9.��EH���;���U���������w7ş�n�63�ȝ��z�Û_i�>g�&����o~��q8t�x��2�\0g`獼G��ƽ|Y����\\�%������\n���P\n@(\0��P\n@(\0��P\n@(\0��P\n@y�Y����\'�<�h�=��BɁ`H�?�8�\0U�Q��+��r��\0��^���#��-�m�����\0��x���>[�Y�|�3�4�:W�\\������ŉmM�{��/v�WD~�����]ϫ4�\0������Q�Q#�I.�я���v�	���o߶�\n���4y��1#i���E��7���~}��[\r�I&Vc�r���#PH$yF��[�Z�i���J�L<�dn�3��-�q؟�J�;䰍�8Wr��i�.z��k�t��\rw&�s&l�%ƒ7�9f�TI�F#fCk.t��7�A�Zi�3����nDTrY6�t�k�*v�MT���y���;��c���P�v�n��,\Z�/����WQ�ce�,%���C4���X�m����[5-���\\6(.RhBܖ��R	 ����	��ɤ#�x\0�~+;��;^-�u����p]m�S]���ʫ=��\'398�J��q@�d`\Z�S���k����T|�2����j~�{o`&Z�x��ߔX�&�\r��jM�ֽKC�/)�����}\r����ͼ����]\n�jy7�ڄL\n�6�9�-֤�Y]��@E�xEĈSy ���Z�:�-W��ŗ��>�(�8cu�Č�m���۱6񪺝��X�Od�D��)h��.m�k^�\ro�\'�R�_�~�tM�E6_�L��U���\0~U;^J�ĸ*����9�\0nƚ9l��\r�%����ugF/#i�k�Qs_`>�r�Ƽ�\r2�\Zr@?�/k_��x�s~?��Q��R*����h�X�f+�C!-ż�k���5_���\0�o\Z��߷�jD�\0n�$�趿C؞��ˎ�|��rX�1~�{o+&?�WP��M��\0����:�o+���&�1\Z��Y�_��n�I\"�AV�5S��ξw�x� $�����O�^UfE�`��7�\0�G�t5ViW+�A�;\Z%g����PA:��0*��V+=FRd{��/\Zc���p���;���ۧz���:i��\r����;�����`�qs��cA;���\r�*\r��A��5�u�|���<O�ծ�$�����ry�pgr����1A�������Sb��t��ͳ��Lj����<ɦF261��\n�H���n��\0*ɝ��(�2%|�L{�~�ېߪ�{U-_C���?���ʑs8h�É�[��ޮ���]/r/QG����k/�$j]G�m�e~Ċ�,R`ȕ�6����\0�lo�\05FV�� <`̾Y\\/˭X�xu.8�����)���Z���8�~ۭaQ�R�\0JQe�r��^\\s��$D���z�Ƨ���Xg���~��lrx3�sB�2��o+ث���V;�ἧ���Q�?q�����~�pQr�l�2�U�a�P��?�c^���>��\\��ׇӱ�չ�(\0��P\n@(\0��P\n@(\0��P\n@(\0�:s�g��#��3y�ɢnQ���9VYuڷ�N����}*����z;�nVH���t��������7�䕹H���ND�U\rq[�Z�ݴ�Ϳy������U\Zht��}�������9��i�ؽ5	\Z�\0���\r��\0Qj�[+�*Ih��XF0�=��Vc���[2XݚE��n�ϑ�\"�yqaFVieR���7�-�Mcf{<\\{t�iy|��e��b&ޙ:�_��[TV���ŵ�^%�G+ �C��}t��խ��;Y�??֌<Ot.�b�j�]E�}MR�Y��S!��b�����A.W��R�\"�uՒ��|���I�<vFW%�B�l@o���UR�r�(甌�[zn$�mb\Z�|{։W*e��gg$M,�$1J$��I�^�u�w����KX�>f���| ٙ3�<�]�q��Ԍ�Eۭ�*�sw�:mlUi�O���ǔ����\0iVP����Xx�����eWn�p���fc��0���(ITu:����E,y|�v�^��_k8�q�D����\Z㛋���N����cZI�[;M��G釳�\\Q��aľ��$U���;�\0\r��Wm-��sp��ٛ�܃ėC�܋_����8��7�\'9�󿐋���׭Mlg�\n���)��Q֯\';�(r���Ć#����u{��/��°��eN�n?�Z�Ӟޟ��rz��Ĩ�ͩ�۶��s��j�r G�z��\"�S/]|,�/en�{����RF�{u�&f֧UHm��\Z[��dմ|��\n�7X)�O��J���y���\r�l��{��J�e�&g�J����U&q�Ccm\n����%T����*eL�F��؞��©k�Sz`w֫CG�4�~fD�D��q.�vl���ֲ����xX�����g������\'�2�I�:C�����\nK�D1��2�I�К�ɑ��>��x�^�\Z�֏���MMk���?0���s$��������x	#��P@(��m�g����dS=�C�pn��Q�[����+�t<u���������}(���B~�3]ABO�]�K^�X[J�>}�����^\Zظ�:��~��_=��grJ��I��\0E�t�m�c�kj�q���EJ��K�܄�\0#�:����I�S��K\'��2�OS{����]/k��$���)�ؓ.A\\�D�,��@�ۮ��Ҫ�IvVp��H�c*����7���Qj�L�y,����=���{c��s�h�}�6�a����s.:�$���#�2�[Qq�Ƭ��>F����~M��f�}T�p�ǹg̶���n�`�|kJ����������O?Ɠ�e�.����lw:�^�������|o��-\Zh���9�7ܼ7�����P��򩾌5S�T�G�zԺ��~o��]��QqW3�P\n@(\0��P\n@(\0��P\n@(\0�G;��{����I�0�.Q~�n���\'J�f����U]����c�ߑ�����H3�n�(�CtvRG��\0$}�Z�ܹ^KK?R�2�li���C*B\Z.��:���V}��v����o��ܯ7,�d����@\0N��v�:��6\Z\n���$��kЋ�7�2� kl?M������Ǘ,���<�ʋ�4{�˓dQ�ԝ�\n�~�������J785Iՠ�щD����7j�ǥL0l������7\"��drM��6DK$P���V6w(�[�n�k��mN��U���)��{��l�<�����[�Չ��kZWj/w&\\�\"�-ȹ�΀�x�\0*�J��Ѕ6XS�$	e�6u \\��M�Ւ9��Y�d8���$��G�L�BJ�iY\nM\Z��5��Zĩ4\"�Q�M��C���MϏ��\0��ܕ�E�1��m��;�V��X,�%V(�V6�iZwS.���~�\'�u�i��ޤ���NJ�A	+t��<`\0����;NJ�T��L�����Ѯŉ��}����u�t�rZ�~���Λg��1�Dˏ �!ЀU�i�M��E�=���Gc�.������=��sb*�E��*$��v�`m��]U��9�Y�7�9����R~�/pj�r�E�7$۔DC������\n�f6ƻ����4��C�`~Tl�a�\"��/��?���[�W�E���I�ί�U]L瞏�-1�R�2�\ro-�v=���\'���C/�Ѳ`����\"N�s����\r/���P����MǸ���xu_օ\nm��롿������Sԭ8/o������Ѥ\"�TI�SbM7\\����Q\\��Ns\Z<��1��y�u�y\0� !p	/m\r���V�XF\\^���3Y�������O���4YlTD7�on�,��l��J���~\n��[>�=W��l�c%�����1E��u?+]6ȑ�b�ݷ��s��Ð��RD���C}��\\��.Ƿ��׳M�?_��oy���,�Ƅc��\nz��0Hȑvݮ	c�\0�K�r}W���-R��sO����{��y�K�&!	�5�X+,J��������߸�,��i�r<E8������O���\'�~�����΃������ۙ��2����{C��q���f�}\'��MU������}�P`�ӗ������q�bEv7iC�����}��:��H>��Y������:{ߙ��w)���x�\\p˗�3�eE4;A�6���o�f�OU���~%~��\Zi(���Q����#�(�6��(��������ֵd:D�v��!�(�;�pڃ��V�8����|Yq�c�2A\"���#2�.����ZȚ�T[�\'+�9�M����V��k���Z�-\".Nd�Ȭ�`	-{�v���aB�C�l.H���;܌%�xk��a\n��2�3�L��n?7㥕ג�=�R���ܯ{2�[�.j)�ٹRț��;�$�|Y�,�?\Z�W#���6+�%N�=~����i5��ʙ	$��1��.E��BEOsf	��\0���.L�(���F�o�L��\\�*�����}�8yP}��&f�i���F�)�@o����\'�������a�;��(�_�?Vk�>P\n@(\0��P\n@(\0��P\n@(\0��t����\0��o��_\'��r�r��\\>1�k\n��9�v$�Q�L+�����\0\Z���������|n��Rݿ?O��Gϙ��,�\ZI����]v�{W��������k>���Y[��iPzQ\r$O� �b4���B����m����̑Ht�WEӭ��v��S���S�*,����ÞLt�@��7*eRA��0$_Z����4ڕӡH�l��q�X�� ���ջ��ZT�M�1]<��;^���Il�+\\�N�nw�E�7�ݫt�B�2hGS+}Kr��\0ks�­.L�Z\n��f{��΄���N��S/�f��y6���Ћ�o~�\n�nK���(7X�s�A�75;Iye�g#)�8�1G��i/��\rH�Q֫g�oC`�,+M(>���\n��W _���&�2�U\'��\"�c�eH$��U��+$�G]{V�G��ʔ���a����ď+ՂUv�)b$�S�h���|��}>5�K�S�<�-�m}������a�ar|�c6L�=�c�Wx� �m����\"����\"OVy��k�դ����{�+&A��\Z2�+OP	(X2��h$�\0\n�IG���j8q��u3�p��v��C���p+9F�������TYk�,���\r�\'��Q��ď!�B��9��X&���򣖾:�*���t�82`�X��Dd!}R΢K<\ZE�-~]{���f7���D���f�|� ��.װ��Y�]N�����#�8ϻ�Peff�������\0�t+���J�����[%R���9�{;\'/6`�U�㢁	�e�oO�s�\0�RH���t�޽��x�\nI/V�e��z���~3;��1W�Ghee�.\Zϻ��m�&���u�F�[��%wv����/Е�ϺX�>ٛ`/#n��\n�D��S�q��^�l�)���v�o��t���E^~d6^`�4���\r�#r}0X�������z�ao�mT�i��E��ܦ#<Ì���4��;���m���^�$(�NK�����LUN�ؾ���O1b}���flց�����I#P�{�}Moְ��Go��%���2o%���I�9X��e�bV�Y�.\0�]j�\0RLi��M#����q�S����<�gM�\"���љY�8��\nG{�4�V��כ�<�M����:����d͉��$X�!�ȑƦ6e�\0���v\Z������M=~�ҋ����3�T����F/%�\"Dp�T��7Cکt����M��h���b��?p��p����G5ʂ�r�{zI�=F�=/�^��1*(G,5ۍ*��z�U������&vQ��w����MNl�}\rZYe��xЎ��ֆyn�v�h��$u���v׽��Ѫ��O��Elpv\\Z?|�{֓W���f(%����h��\0��G��n�[\r��-��������1�gd�0��q$\r{���z8�YEs{0=m��q�7�� �X\r���oP��1J�^��5�����X���dHT\r�؋i��\Z�g5�;(fǁ5�X���{|�Y��Ƨ�~�{�\'\0��(c�p�z\02)��B4�j��џ;�g�I�i�̓����1�)縝�^��n�Tye���_�z�x9������3�3�|\\����B�q�\n@(\0��P\n@(\0��P\n@(\0���_�~�\0���Wr�2�g���Cc��V��\0�̆� ��\n��gTӲ��/��z\\#�ս�����~	}�����ޙ���0#�c�ck����(�5����������b��<�}|�$����$�4ӵg\'�a��J����K��k+��ֳ���^>�$�э�&B6\0���EV�Y���S���n\0�H������u��CW�:x�oS`���f,��Ua�P�h�ЋՎ��h+���맩�e:�?Ѐ�w6>5d����Ϲ���[V:�t5�Ty��K2~�Zu*�I������ӑ�m2�3m	#I��J��K��ߐ5W�Z͙Ek�m�u�멣�\nd΀�f��M�\0$��Z�#�BT9��H�I(��5���Z�b�m/S�����XY��\\�4yFQ�[�2��(-����ȜhzX֚3t��7��|��^���x�6E��#���_�),�n|~UL��]L��tīg�����$p�+^(r�n.$]��7m+��1ʵ��޳r���Y��2\nI���dBv�(�~ָ\r{��V��6���2c��1bHy1��,l�t#@Z�X���!�Q�efzX�����\\�.���c��<���Es`�VBZ�hI$i�F�9>.�&k�������)��o\0�y�HY��,ɡ�G�km̡A�ޥ�܎,>1���/�_����\0q��!����0�6�W%�!k5܈���C]v�{5YefW�i7xZα������{�\\|w�#�8r�Q��췐���)`j�Wr�coVOi�d���R�]�=ݽ�ή����L��x�?W��pMŘ�\n|��ce���N��pq)�{�E����:s+ܲ�eϋ����Y rm�{�K�~�nz�ub�=�x��r�_���\0k�>��1p�K�c�OK�̔w,M�\0����v��@�����֖��Vӈ����_yg�%ȖW�yr�dO&woL��ԝ�U�]	=�Zԭ�ɃE)%�����չ�w/��-��ؼ�$UV��kl1�`C󣼚��ū���:{�XFYsQf�,4)�e\n�I\"!\'�UJ�������7]���jt�;�S����DD����S\Z;�w��K�\n��޲jOw:������s�=���8���,�z�a�h�%%d.bWVQk\0H�jʒO\'�����e�㖱B���NL�3�R�������A$��Z �m�N��5\\��/��B�nU\Z����b�Y��+-I��l��Y#�R\0g7��H��w��R1��Qc7J��D����ۥ����Դg�u1�k<H$�j[�F����v?:�E�Wج�2��e[\0�q��О�֩|����a�X��ź\\�j�9�ɴ�|>\')����f�K�S�ɂp���0\0��k^��a���Ԫ���u_�B�c3\n��ǯ�Bp�])�Avfݯ}>}�WM�8nͣ��_/����^&t�bsp�~O\Z��\Z�uY�.>=\rWjܛZ��et�Ժ�^B=B�P�i�2��_����̼�I����N�̒�0�uBJ0e����Y4�3�v(٘F`˸yn-����eݣ#c.�OfQ�\0:�Nk���Ŝ��C\0�m�Z�p��o�K�,J�����^��#�߲?������瘽��\0�_/���љ�=6��H�Y>��ON�������o7��\0\'Ij�G�  n���\'\'�Gڐ(\0��P\n@(\0��P\n@(\0�����L>��9�BOK�Ǔ\'%�5,m�6���ʪY|X�K*������}�Ǟ,�OZ�rp�\0�{�V7;����\0D+`�s^\'\"�b��Ͻ�Ӳ�w�˜ʊFy\"\0z��SRm}	?\Z�nO��q�Y��4J���H�F,A��x�vz��$\\q�<�y�_�|�pgM��o+,j�B�摴\Z�r��f��s��a����:�\09�Ͻ�`5\"��܎��+e�/B�Y�V/�VS���Xu���h��Z�>d��y&\\!�8�bY��w6��=?��o�e�Y����zyQ�V�����_i��E��E���uh8sY��P��u7>{3�4�|^?\"n;\'�EH��6��Ρ���*�s�ck�\Z���iw�����]d��f���(�����&�Qӵt�|���Y���]Ń��[���kQcZ��Npϸ2���H��\0Q�ҋ�^V�Ӄ<k�	<j�m�r	��~C�Sf��a��èH�Հ:�BG��{nL��C��9}��\r��AzF,	�:ޥ�CLo��e���\\o茙$���\"F	��1�R�N�k�ɞ�R�m��[7�y�/��0�Lf��7\nU�#h�ڤ��u=�\0LmYFjY\'{>��\'E9��Hgg���Gid 1R�p���V����nX9�L�uc`��\'��ʷ��r�v�]ČAqr��z罣�����\ZV6�g�k������6>4��;`��ypr1�c�O+I(ζ7��\0�V��C,�\n���9�Jq�F��\0~?1����x�VcE�aCǪ�=5!C>��\0A=S�N��~���U(�����_ii������O��϶~C6dBn�$��o����u�o܍�?pC���ɇ�g3M�,�0\0z�lIk\r��b���OvD�8�~�C��fȍ��cO��#K���W\"5�ka�[Zɶ������N4_i~�f@��ͅ��f\'�19�C��ӎ��am��1�6��M/Y���I��ƫv��T�)����,�rE.�g�T\r���4�bz���֭�������\0�G���x��C^,�`,t\'�_��:�P�u^���+\ZH�M�+��#�q�`�H6\0�t�uh�r#�����+.��L��4� �&�]��g{�����\Z��b�!������$�	_��V��(��pqrs�̇\Z	2� ��\"������q��U�Kҵ�Sd��H�0#\'tb�m���^�s��U��Y�ic6�\r��؍,5�ZU�hWf�F�cB�B6����jڣ���J�\Z��F�De1ȡ�\\�_Cږr�����$�Fہu�#�C��|���6�VC3BY=M�\0�~5)\Z[�\"��]�-���Z�q+E���Qn�H&�>ɐ%M�h��k]J��+�\n��`�H^�&�~���IL��	�X�����&Ude�����=kTy�rn|D�~�k����Z��-N��g2i�6�CfF?�ŀ`_��5\rJ���XG���d��~�����)�:���X��s˸���*�{�\0q,�;ק�nǱ���߆���3����گ��\rz�(\0��P\n@(\0��P\n@(\0���_����nbp�?���������2|\Z@��W/*п��4�\0�ۿE��\0C�G�G1?/Ⱦ1���fb�\"<<pLz�%�Ƽ,����;��U{+�ǹ�NW%���ms�w5T���\rVi��jP;��ʢ��%61�LAB�>�Dh;t7���5S��x!�B;�d�1QrE��mjҨ�˒\n�\\%�`my4\'��}o�Z�+�ڙ�X�-�&�ɫ5���G]s��ҧ�s�Rv��\0:�T>�{�؁�)F\'Vc�޵�8�9]1�Ӹv\05*��SYG�l�?���\n��l�n��>\'Zųז�2�dEa`����t<���o�_R{��W���2Խ�Dx����q���Y����*uV#�7�8��Lœ$��\Z�-��~��1�0G�#��]�B��č@���;\"i��TY�͚���0\n�]u�};�ʂ����w�������6q<,�ș`tccu�m�k_Sj�ɵ1��t2s~�?&\\�̙�A!\"|w	G�]���t��UM�RP�o��d�A�^!U���@��w=�r���:����oy^	��0��s�bK\"巨�@�#�\r�ej����T�&����Tu�+>FL�������.���v�A~�\\�*j��Z��+\"�1q����X�sD�R꾨\r\'[�´�9�7�?o�e91G$XR.��9\ZC/�bUV0Tic�=~t����$��{�&D2d��R=��z��X���iU.��У��SlX\Ze�[<��>eV�X�a��jaO�ܒ�����Cs���OAD��B�!�mR��\r|jU[���kr�0�0�E�v�����顫��2�r�c1�Ft*���\r�(\Z_�W�VL�t�u�39p�zl[B<-��\Z>����w�|���*��P�w�\0:�f�i��C��õ�����P�ԽJN�zR�k�Qu@�hkkq��d�rٽ�r�<��bȚ���\\�n9���,|�q�\\�t2F� b\r�U6 �QP�OԄB�9)3^\\�Bzӱi\n*��76U\0�-Zn�q�KC^p�,�)P��^�d�NF�C�R�ﷵ͵��N���G`���Y���t��N_+������\n4�+ћ�V\"�G��j�S�Y8��RN�T���*��reJ��#�\0�7��:����=�i��hMoE����E�A��A���^�YO�cڥ�Z�K�31��3�*����c�\"7�;Un�P���W��	�Z��s��p�7}��~5�֢z�����q2V@I��0�-O#�����\0�����`����fnb\'	�,c��̹تg��ё]Oƶ�[fu��~����|E~.�֮~��\n�υ\0��P\n@(\0��P\n@(\0��P$��sfS�3ȱő��cì�?3^g%�q��}7��7����x{�NS���%1���6	��U��՟��ǲ�A�:�#�*�_j���:�>ud�:(��xE�l�<��0wM4i�:�\r�>-j�$Ƈ�Ŧʶ�����~����v׽M#nNT��hWb�r$$h�o�\Zֈ�/wmN\nF<�B�7����f��R��;���F�*u�܋i��$tcɩ�W�:���-�hzգ��㼳/�6vl�s�eH]�(U��`>U�49yv�#<V��?�ʱ��t�j�6�\0q��y�x�c�8�8�u�W��mP�ĝ�H�J���n_�j���չ}�@jC��v���av��\'E\"����pR���\n�v7������7ܙ�ܟ�ۼ{g,9��)F��m��O�u5ɟ�\\-Os�=���8ӱֹ�ہv٧�_N�WU^R�b�BHSDn�E�;���t��8��A1V(I��J�n�R���Bu$x�ZgN+�ԛ,�+���P��@����U[:jՖ��2�[�s�f��烈*�f�ƚ��9�$�ۉ{N��_�[iS����1��j_`,����u����G�f��LPHCo�5�Y�\Z)$0���Z�Ͱ�S�L�O\0x�OV۝��Y���m�Q�uV]J���c�Y|�IH�H��}ia�)��\Z��/�ڋxՌ�����r���`p�i����8�;m�1���K�x�.K�՝���7{tD>W~3%��߉0�\\ �o��Ϊm�Z�;ʓ<����Ъ9���i������-����V����2�\'6l�U����q;~��V���<�A����Es��a��I�fcmы��t��UӒռ3$�`�6\nl���u�٤l�\"�o6�{�x���5	�V�E�-�j\r��E]ٲOB��#hQ�E�~]���[�� 2^;����\0\n��92>�k�M�.~5��9lf��#j������\0��-\\\n�Ny�SaK&>T\'#�s@�Q՗B�C\Z��S&U+��	\\�S����8��0Ȼ�5���\0:�;~��1�������S-udA���j�9����؎�ºCϻ1�Zᯭ�T�u2�d���eft���ʑ��ޒ1q���[p/`5�h�\'%�^�:\\۩��ғ�����<���gU�������s3�~���/؟p����\Z8>W&f�D�	A?$T�MWTx��,��-ѦV�nl<����8�?<�$प�\Z�)m�O���%,��2mX���P\n@(\0��P\n@(\0���#��y�E,~@^��D�,����{����LL^^#��\r����$X|�׏ȴU�����V��~������S����_��y��}\r\r�!���)ѯ���i\Z\n�9c�F2E���:�r,��YY��)i\Z<J����m@=�r-�_\Z�{��y٘a�\Z�Ƥ�zT�<�J�w�M�-r\0���MIjSI1�\0,��M�M�����\\o��׵��$���z�/��=gע��\r�m)�yo,�#�.u�-oΫD�і��|��\n�ܪn	�[��Pr_;��q�P4:��J��+��f�/�Un���ơ�N��f^@��]��M��|�3�%U2$3y�ŷ���ý�Z�nFYf�f`�yI�ެ�3��*I��c���ۅ�h4?:2�����ř����oXݝ��$���_���73���M���pa:O������V��\0Օݫ���jmڥN��XgX�m]ۯgl:�^��p2�rc\\���Y�6�R�Y�����q؛��,�*ꄈ�0T0���6?z������R�#�nW�Ɵ!�N96+2\0�$��P	:�N�T��*�YQ�\0�YgY��YA�\r� ��j�ᗭ�>���F�y\n\\�&��#[����9E���)\"�9Kw�#��+�Mk�Hf,�Q�K��ӻ��JZ��ԒN����S��/&��QB��/�A��|�+jU�y��㑛��*A�t֫i�1�؟M@$����UA߆�βho��$��I6W2DQ����Y���6�^O��qq����K��6p[D����TVM�n�Rv��D��;�H�� ���N<�G��%7\'�\Z 륵�kU������̫$`&�\0[��Ύ颲�Ftb���Vq,�Q�����m�)��B-P�4�}����6K<�4��w<�K1>$�Me3^Tg��֦%���&�@+mm�]ES���D7f[��ڷ®�\'%��L�=[�kXxޭ�ӍoZ�r�1�P��R,F��z֬��8���;H�]m�={Uԕ�\r�A��+o��VVԾ\Z3�\r�H����Б�U�nB��XϪ���[�ƮQ��\'s�CXt��b����fؑM\Z\"I�k2�=-�\0*��r���k��{���������_W?��Ӌ�S�`���]��8�����`�\\�z=ONWi�@(\0��P\n@(\0��P\n@(\ns�7��s\rɋ���r-��Yf�ڳl�t���0y(r0Y�ٙY�ٷ��b�oὍx����~��1�~ĿS�+��˗���8�ӹ�Q�\r-\\����r��A�@�cqVL��N�<(T\0�B���:��F�ڥ�,��;����\0�C֠粂����5ԛ[�SVH��E�4��f�\n?bȤy����GK��F�I��gY<��c�wj�N[#�9�\0�ƥ���~{V�;��ѣ\\Ƒ�M���hP��SmQ��R}�M��k^�\Z^��:�d��m��H�|�gR��##�ǲ5���_��7��U�#eJI*���а�\0*��,�#� P��\\\r��뮺�Zɲ��=G��OOW�൥�C=�zt�{�oC�Z��Z���\'�\'��E�E�V6��Y �G��Xm��Z�&[��G�w�C�M��Ζ�_�[bZ\\��\"��^�\0KZ�¡�(�99����\r��a��YOslr��7����\'-���u�\ZM�ؐ�l\0�ݗs�\Z���Ϗ `B�:)�Z�����ض3����P��l��~�m+W&wȦ��C]�����-SU/S�V�2PT�\'���	���-�cJ�f	���O\n�Rh��ϿmXD�B���\0X\rl\0��z��S�2���Y�u\n4����������\rl+)�S�̃)[amo����:��{��N2ng�8��Y��o���>����\Z�*U=�˫��s�WI9�0Ab�/M���[t�{N� ImT9���V�X�\0�6�]+7}\r�bh���ŗ6Y�4�荍�Q��ŬT[\r|�Ukv���\n)ʩn���\0�_���j�l�7��u���_3$F�m���tR͢BI��5�^�i-�^��j�s��I�Q�\\��X��L�7�uQ�e͝�.VNC�<�^Y��ٛRX��֕_q��up��;\"���3�%�:�Gj5�\\�E��6o5�a��\"Qo��nc����&�3&{Lq�K��H¨�vj%^�6H�D	G��Oo[�U�\0�� @A�R4��p�+&�^T(]�4�#$�5���5��xY֧���\0��-���x�FY�6Rg�BOҏ�k|��´d�}u>7�&-)���^��P\n@(\0��P\n@(\0��P\nC�������gR�Ē���&���W�s�W�V}���/��(A澲H���+������z�����ː��{�\0�rE��~Ζ���FVeaJ�d��#.�4	=��DP�F���V{�����jO�o������B�`4���k�Y�R�*2�I2C��b�Io�[�{U�1���r�r��sm������z�M�B�|���[Z���ƫZ�!��I���:��5x1L�}Ԋ!��t�$D�H��j#\\\r�ѤUM��m�_��bN��(8ܳ+[���V�����Boa�PmI4�|*l:��L����E� �\Z\n�Ўk\\�[��[��\\��V���{?����\0�|����wL9��X�FH����M������J�:Ψ�[mg^��d\0�o��ں1��*9%�[m��B�Pek�^�E�#���v6��j���Hίp\\9f7�=��`Q�=G������h���&9#\Z���Z��L��d��\0��߸8>?ۼW%&/�ȓrꑱf�XvRˡ=\rr��[4ްw�;�Y�k��dd��5#��n~`[J�ѓ$��j���-o�kem+�\\�e���p����Z�Nl��--����\0���Z�Dy�$��{2�*�ik��I*�L���]opl-�Y5\'N$�%$ ��K�gdvcqmK�T�t���lgH�c�B����؍��O��?T��ۼ�ʨ�N|�I�[߰�g5��HY���ƫ\Z�b��3	q��ML�V��� {�k�WSC>	q#�g�l��x�:���[�� ���VZ���3�%�,I����jxy��*�Y�=�s�v�X�tP�N㶵��dz|w�2q���h2��\Zt\0<�G[���\0�5�Z\ZJNQ۵��Ԥc��p�F���Ƶ�1wh���F\\:�RRlu�w�Z�J2��fH�PF�{�ʩs�6���!մ��-�ҭ]N>NGVcI��ѕ2n%Ƥ!s�ۮ��^��o���~+���QRI1gIR9Д7\n��J��v��ɷco�s5�[���Y�����u?R��\Z���}��x�m��<^r<z��4!�M,jp��W�����7���y^����P\n@(\0��P\n@(\0��P\n�>�g���Z:�+3��Bu�u�ɴ#������C����q�3�d)!��ro�x\0-^-�?R��iᜦe�d{��ݯ��|��]Z+��޸��oDJJ�.Ak��t���YF�zM\'X\'�(V�h$(�\0�/C4�>��e�k��;�������K������Q%�s��!g*%��]4�����ǑE�Ix�E:-�6�ӯʅ ����4�HH/yqc�ʥ���=�3*cF��u\0�o؛|oV�5㿙�$�N����m��j� ���$��?I�\Z��]��ufK�cKٞװ�l(����Q\'��7nw!V�E���;Z殪d�2$���X�^�Z�#(�z�c`:���Mih/�y)���7&N23&��o�����@��jf5:�Z��}JGk�\"��q�s43�h�-�r�n�k�:\Z݊�I|�\'���O��S�L��^�h��Ua�EU]���,n-j����g��ݤ(��Z��z#v&�#[_�U�Bqj��6p\nX܊����Д!#ʲ�7Э��U��]JG�!V�F��,n*����ϲ̺X�����P�NK�]%ɽ��,*�������V6��M:֛S0�2+��Z��v���?7\'�����><��n��u\Z��[6�R8�$�t�F�iX�r�[���Y����bsrlu6�B3����I$q�3#�d;Uo�����KS����6%M���pj\Z\'$u8.�H�oB(�i�\"��z����1ި����ʣS�v��S��m�^c��*�8^=\n��C�+zX��re��\0F�7��Mx�ډ�Y���NVD�3��˻\0,<Ēl�j��F������l�����e�L�#��x�aj]�ò�$�*�p�4�ܩe1����u)A�j�e��1%g0�>��$�G��7X��/u=�S��[&���\n��E#q@���8�zɇ\Z uԋ�H��V�3�XRl0�ɇ������T���X�+����ޮ�kk.��?����I���@t�<���v����P;�$Ȯcp�(y��?A?����>��s�a���ŇO� TWL�~�ў���.�ߚ?|��?>�P\n@(\0��P\n@(\0��Pi��fbrY+&��\nt��ڽ���}����\0�����I���8d�\n��Wo7ap+�v�~������h�ө���M�+]���\'(�x�ݤ�U�����ֱg��ތ�C��&H�\'�z�ޥ���Z�iT�3#2��+���H����Κ��\"T�LeM�&C~�u�\n�g%�,�<���Pʫ�ͮ�:-�~5c�^���:���Go�D��q_2��Ġ-���jދB1dԣU���z�,��c��N���R��D�M���d���ĂUȿj�Z\rkM��!������{�ָd��ab-sUL�b��MQ��q���VҒ9fA����v%�	�\\���h�r[Qs~���ާ\n�����83_;\Z�Y�d���H�����^���ٷ�������L��FtƊň]N�H�kYSW�=�:��8G��//#;L,�w)4)�їFV�Z�%I��jWFT�������Cr̴F��*:�]�e�mn���R�Z�\0,�E��z��I���9�RU�j��G��L#�qn�T+#(��bJ���XT��VN\"��k[�=蔢����\n����D��\n@�5�Z:AӇ9�ݜ�Vnd��o��X���`|*�+hzU���;ԣ�Y��1\'�DjU=u$�;[Ѝ�B(uv�K�7��������ԧ��k5����<ܸ�����L�9�Y�����W3�r`@�Oz��	���gx�I�بu$0� ��i���,�cf�;��|�u��G.l��\n��\n���n�?\Z}9&��p�7�{\\\\X՝ZFY%���ade�(��#���։�%�	w.1���H�@ �H�w\r:Փ��>F�,1���b�\0��^����v�4�eC��\0�a� � \nV2Ż\rN�$�QTrr:I��n4����J��ED����!ea�o�K�J{��[�\0�_�~�W�|��P\n@(\0��P\n@(\0������!�����T�+�\0��W��^�W�Z��}�\0��s�Y!���tD����	#�	\"��kc�U��4�(sSm�R>���8�k�5�V��BӖ����8���\\�DH߫vE$t*Ċ�Vo�؛�%���\n�@�+bZ�\'�&�L�F�\'�\"J�Rb���$\ru���K>?^T�;G�Ǘ!L�%�!���RA�^�I�jk�N�!�6����Z��^�.e����2�,��H=-�\rVGd�C��)L�s\0�����A_Vˡ~>6�f�����yc�6R��,\'�H�\Z3W�=A����K[r���b��Q���[n#Jڌ�tD�v���}�*�:�R�.�\Z����ƶ�Í�,|�l� \\���IK�+(��mcX�X��}��ߞ�ݼ�_6�f?�I\ZG��m��� �j����\\4t�7&V�qSdɤmP�-Ȱ$�u�0�]��ő�p4=MY=H��+��aڷ��M�����*�K���}@�SP�K��H���F�Π���&\0�Ck�\r?��d�^���\0pr|%����m��b��2��A�W>LK\"�և�[S%v�hɞ��%�nC\'��r�\0Y���g�R�*��[Aj�q�V+�.:*ע5�Uؖ��QVZ�0ݹ�E�7\\kVZ�\'i\0�[�\0\ZBhʹI�5mS�s��Vn{8�6��x��<ѩ�$�����p������֨M7�u7����k�7�b����/{U�h�ˏ���ӬQ�4or�K����7mn��j�N�V�\'�i�I\'l�?Xң��*VC��:����`��)BE�-}j:��R1F.@_\n��Q�U���=�T;�}��7U�N53���4��^�G�I�H���Z����NH�IV�h&�s�����|j(FK�a���:� [�V�f�+?	��eŐm��X��S��$�J�2�>�X�2�P	=���j�,M^+!ܬhv��\"�v���\nY��3I�ȗ*\ZT=�@�#O��Z9my8E�N������f����Ι�c��\"������$��-���ų\'й�qy���8Ց���LO��c}���*��[|j�)��տj7.��)����E����۱I7�s�g&g��pxl�K(��oM��@\r�|O�J��ɒ�r���nW&g�o>�rX�*̚��?�+�8�6��=��?�������\nbdd��\000�*�ld����\'�w����X��@(\0��P\n@(\0��P\n@(���r����$h��HeTm��^K���TW��?�����K�g�~}ٖLyr� H���T��c���y��\0�{O�8�|�c�|�Z�Im|I�j����8Fid����\0ְ�}nk��Sm�}uIIS�#X������kI�%���:�oۨ�T���,cϒ-���k�gj�xm��WI&��R�ԝ��\0�W����즉5P=E���EZ�JdĚ4i�26�\0���Vݍ1Г�yV�ֽrں���e,�{�t��jj�9�����c~���JfhE�t��ta������|j��]�i\r���no��]-;Y��[q�\'������)�\\G���c�ska��i&� Û����)��9RIScfi�Vi�{�Ј<�v�5Цd|c��[���El����Vz���a���(����V�S7D	*,N��v�,2���}���d�j^���$�q#�ύcdml���_�����b��������K���h�1���%$�a�lS}4��eE,�뎻�Р���&x\n�;�n��X��u�#&)�t#�,��o�Q�-[�\"CgHa0��\"v�;`�^׶��w�=H� -u��F��M����,��?����G�DM��@:ڡzY$Wup�YI���_\Z�A羳��1��[�\Z����[#suf\0��5/�S�I�*I�Ҿ���Ec8D�w[N��d�7�Q���Q��6�[P��Ő-�ؚ5�b��B��,YB�>��P����IxT�ġ��!$�؋֘����bH�9�,Oj����>���Hێ�c\"��,m߭�kN�$ř�ޅQM��-sӧOʯk��k$�ڗF����B<GK��U99��Q�X��~��tr�Еn�=!\"X�;|��Փ9�6N3\0�\'�u�U���K��n�*L�\'Gü�ߥ����F�qo)�o����@<+���j�pݹ����X�dոgl{c�x�y#V(��-�Sk�m���Gg\'�~����aeLV0Ӥ���R��ߩ���d��טG�?o<��4�7��6���a�Mt�ͨ����^C$`�}���@�q@(\0��P\n@(\0��P\n@(��ޖd}��!P��s}g\0O�\"��^G�ZU�_�:�r��_���}�ȏ\'�|�B��9#����$�;�~��>%v�:C���>���~��z���u�6�&�Qe$Q��5\'�z����,�HՐ�\0yGC�]k+��̤Z ���+�M��_�K�����Tl�Z��#�c�h:i��^��*F�����k\\��uz��`���Hw�e�	7��Ү��l˲ͳP��\Zk�k\'��Zmf\'@����~�:�S����\0\r��_\Z��hlY�v.���ŗ��	�/���1�	#]+9���k�~��#�C�\r�9�id3m��6��Y��\'?\\/��#��߰���ciwh��|j��n�dRv�����[סT�>Ƨst\"��Vl�Vٰ�\'�6D\\W��ɍ�4X�<����� b{�浒z��%*�8��h�3p/n���ջJ1�M�����t\0Ρ��Ub�\Z-��\n�m����!�G];��3G�\0^�G��i֦�b�L���|rv;C#\r�*�)]-�H�\r��z���f|^P��g\'�����)�|�̑kmJ�u�S<�ߤ��m�3˱\"1oI4U��`;T2�T��*4?�Tש�i���	o`���V��)oVr$�n�5�j��4v8�%\r�C\rkoʮe}Q��s������u9]}f�ck��(��Q�zl�0:Wƣ��Q�&x��:��hgE2x���i���\\�/�kH4�}O=��ll*^��q�ڌ�Hc�Wj�t&��]��#=�3\n���+?��1�:!m��mǩ�ќ��>������V�[��4���3��A�bq1	.�y�n�M/}-T�R�f�!�I�F��� *�^՛�ښ�ѐ�-{n\'���zֈ�͡m��\'w��.4�W06�ćWv\"w�襉�I׶��R�N��3Bá.�\"�\0��\0�]jrdi2��r1䉢��f#VP��\n�6��O\n�I3{��L�#m̨�X�����*����\"�5;�\\�\Zx�-V�����ﰰPqr7��\0�mru�B;��E��ʻ�{���ư�4D�q����@ДQ��]8�̏��V�\0��Z=�]�ϊ@(\0��P\n@(\0��P\n@(9~�pW�c��,ظR�\0���/�/�[>���㟍z����ʶ~o�K��߽�E��W��C?n��(:�����4DfH�@5,��rO�׭zu�3�۩\r\"�|�)�l��VX�6em�	.Օ��uU�U2n#!6�G�n�N��\\�ԽM���&���\\��\n�c\\X�r)�c\\���t�\\jvB�������\0Oj�ژR�[eN�����DqD��Agm�1�n՟s�#K�Z��f�|kz���K�h�<W&9$�95�S���[�r#[�D���/cz�.F��&�oV�:�k�(ަ�\ZZ��>?-kJ�e�C��?�V�Mͼ{�6fInppx:t�Y���E�GR��kZ�<�i����5�r;TY�pa�~�YR��\0��N���9rV�6��b�~@xU��Ւ��j5�=��.\0�+�Tp�-��}��^k��ϙ��q2�q_ϰ3,oԡ7����|�U��U�3U+k#F�NK��#]ٻ��=nj{:�w��p���<��,�c@�5YJ����G±���Җ�i[\Z4��]�`(	�|=�U��[2��wD�����Z��=)���z��\"���Z��7�ٝ�T��@�˵f֤o�}��;	o)��t4�-�J�X���~�5���#3\0��/�5d�����6�ݣk�.�9#��3G2��v���6��l�+BO�V;Р]M��Z���\0��x2(V��=#�2X݋ikXU�m�jT�y��nH�aס��R���g����76b\"�Z�#�¢ҋ��b��f�\"�Rz�Yϋ,x���8�*��2z�\\�K6�[AR��o�B�&t��H���k[{ef�����a�U���F�<m�լ�1��عȸ���8�Y����d(YK���-~�|S\Z���:-z�p!�5R��� ��j��8�Tl)\Z�n�^�6H-�I���oyM\0f�O����A���`�׵�7��Z#�&���0���2��75����\\{xV���\\CٝзO���*���u��>A��m��k�:�8�mM�\n5+���n���Ѣ��\Z�/��2�P1����E�\0ګ��`���.L�P7��0�\0S��IǗ���\0b�z�qD�a@/�Q�A�J�C��8���+��,9yeM�2F	��}���F��N��������P\n@(\0��P\n@(\0��Pa���^oퟻ����t�־�\r���M�l�O��xyx�45����������]T�.�{_�Ex�P~��V�y�\\9$Ɛ�n�6�@S�zr���,Qc��e��G&F$�X��~��XKCէHE�q�X<h�R��Q��\Z�f��_r<�N|X��d�ˋA��oh��/�����XrtZ�-\nȔ������ܝu�ɂ���Wi;��Wws��T����rs]���܃�^�n��BS���F��kVZ��]��$��n\r�\0���B�\\��&�;�vgOKF��.�㸞+9r39,Q>f%��A���I��+����Z#����Z#���#(#i�=���mG&�vD\0Y�-���F@�Qa`E�F�P^42�!��ebE��N��J�A��ޅ�&B�K\"��k���zxRׂ)�I��z�@�\Z�2H$��}{�t��5��c�o(hü��M�H�\Z������S�6!�%�ɰN+\r����\0\n�پ|8�]�q�j�G[���x���u+�}\\�	�h��_�<��\nh���P�\Z%u��p#UKZ�ks��jH���LƆ|%�1���V9wle��Y�կE=ifZ�V�R��eJD�&u�C|jV�f����Y�B.Ը\"�����\0:���I+�1̡d&ۃ)\0���\0UU�V���%�HTO\"+��kmA���j�,��j��L�H��_�j����OS�8�M����ǯ��_:��%1\"�(��$�����:>5M�el�3׊(�9	(����\0n/�E�i�K�L���TȆ5d�ߵ��\r���G�un�s�E�>��k�T(�wm�#F���I��X#I�ʲHI\"���*�/�����iQ�P�t����uWT�i�8�);Mmw��U]Q7�����X�K��<~*�Wc��=��ac��:�\r�u���j�����&:+�M�H��\0��z�q��?��F-��aV�sZ��ѥ�@Kt���I�2l�]�:mʠ���9�y�\\0N�=EJ!�@�\"���zƢ�+6�z���Q+�(��ݥH�ܛ�֨�2nx��1�h����O��#�\"�m��F�$-�:G�X�j�L,ni�#v�ʺ�7�Z��* �=��&C$�&ȿQ�����Z������ی_W׽�TE�\"���+������j�7��y�,d�QE�\0���G��6;:�8E\0��P\n@(\0��P\n@(\0�7���+���uޒbJ<F�qY�SF�pZ2U�O���/\r�;D��H��L�wy!���7�B:W�j�?Y�y��?�s�y+�G��(�d2*m{�#�����=���I��4����ҡ�-�\'�R�CԦ�F���OȾZ���Ǔ\"R��1�Ԟ�x~U��q���ڍ+#��f�M�[POj�z��p�Kc�YƧ���¥2�IV�Um�kHC{��kZ+&���+�C4��P/�N�-*ˡ�LId�/�Z�{߭���:I �beEM�:�t��ZHH�)��+y���E��w�6I����t���Ё�5*$�[��f�ݦ��[޶��G&�f�0��N���u��5��FY)� |\0�Z��i#d���<H- �)mí�����6N��o)`4M4\0^�k\Z��X�P������ҡ\\�ؐ����ݖ�R:x\\��+|\Z\Z����J�ŏ�i�K\\X�t�v+��!�F;1DU+c��魻�53(��ŁǍ��#�!&�y��A��0��w��*��e�\0{�\0\ZX~t�S3��H�)\n���c������j��C\\�3�-W�gQ�.A&�z�侰Ht���̥���@�V����i\"�^=�}�݀ ����t ��OK�2�ʎx�s30(�3 �����{U`�f�t�S��B��\0�E,����VL��v�|\\DL��1�s���F�w�V�b�S��y��\0�vX�hk�t5\r��E�l\"dW�z30\Z\\�\\�\0�\r�g�X`E��^�A?\n���2Xc�o�v��C��\r�.&ꒅTt=v�\0uSq��$�ܷ��X�lFG���lt�CdKe�b�f,�>5i���~�i���[$f���6{�$�t�`<;\Z�cj�V*�@I;t���\0�jӡ�>����.�<��L{J���UL�I�cƆ\ZV�e�1!uV�\0(�sS&[5Џ���$��� \0��:jM��SS;�Z��IrO��`kH��v��[%$KoK�CЃ�B{�*�PV�$���LH���,׹$�\Z�̛l���0d7[���J�q宦��q��0�\n\\�M����F6�jop�nYԶԎ@��,<t��R��۽��,� e��m$UŎ�5ќ��6{[�fb�AB��n��������^��8���\rmҼ�7�\0S��KC�y�r|\r´9E\0��P\n@(\0��P\n@(\0�)�A4D\\J�������Ó�k�Q�����	��f{�G����R�\\��~��sn��~m���x�cc	I2��gik_Q��U�c���\rr�Y�bFd�F�*��=������|oYeg}z\".O>�aH��+�K̄�a�����5��G���d2$��p��{њnH�.:+%���w)��>\Z�d�\r��9C����11/��)/�\rM�·�J�����f�8�3��B���t\00V:1[�U��`���r�	\'�������\n|� �I�Jе�bd*�ʹ6\\�/H������$m����\rO�׭Kz|{&]`��1Q3�\r����ӽ�f{ԡ�q8��O�4p=h���p�m�5�/S��F�-1q\"@��u-k�����c���[.��m�6�$ݚ��:������Ss b4g\'��Z������dǓ%c�J@i\0�װ6�X�鳦��R>7:8�����b��d[I@>�\0��pu��Vw��,�ni�AWM\"������X�on��]I{A<q�������_�qWVf[L	��˺��{[�W��n�c��M���宵2C3@��;*��]-FW����xSq�*�J���+��Ƴrt֫�����q\"�y\r�6����gj�C�{P�\n;/ԑI\'c��Ly˼l�꣯�+_�5c�!�`��Hلj���s{�E��\0*6oE%�P�`Q��[_��5�alk��(vb|��/��ʤ��K���*f��!H�J�\nM�z�tV�A\\(r�$�g��v>��ߵoq��\r�&����S�Tf>]�nm�S%j�e&1H�!�,�@��[^�t��m�	�ǆR��R|/ۥ$��\".9�mX��l,~:��)0́���]�bJ�+`���Pٶ�j�r��R:�xT�lǑ.VJ���b�R�ѱ�\0�	�@jJZeP�ظ�A�#82�J%������\'C�B����7� ���T��tҭVs�M�W�m�6Ӷ��g#�S�۔뷶���\'Y/��X��i&&�O�@��t\Z۽CdV��$je\Z�\0�\Z��u����lX��_����?\n&e�EM�ʡ`�:�����ޮr.��\0�L�]�а��M�����aVZ�9�G�>ݏFh�0Y&�Ƃ-��\r��\Z諃��߉�?���~/[d*�]��|�g7e�X�P\n@(\0��P\n@(\0��P\n@(�ݟ�D���D�޶?�v&��y|�D�a����~QrQ�ɋ�:�qF�n\n�OSu��m<+���JѪ�T��t�\'#D�!��܈,UH�e+�����w*9.?*L�\0e�ci#�b�\rN��h��OMN��p�|���!�\"�5�\0Ul�#IɅ�$�ђ�����p;T=M(�!p�T�G_���T4t�)�Y2�1�\'�c�cn����`��z�j���W�V�Wm�����f�Ҭ��42!XAV[� ���u55re�]I��k��H[o�c���׭�Y�F;�-#ß���\'�������x�w��xP�ѓ�t��ڥ)\'���,V���\"�� 5�����[#̶�����v\0�B��VG-�-#ΎȬ�m�A��KT�;���ӗ�$�~1%V���Ȏ�䡸���\0\Z�x���:N� �E������é�v�ت��$�P6h��n�-x�I��l�M�p��v7��w�U���R���5���*�}�e\"�o�m:�����-���j�ɍ��h��Q}lM\\��Ef\ZZ��M(�Z\\�Ď�uϕ\r��Egvvc�$�S�l&H�*��� ����:�)i���k����eP�Mm��^��kb���zDZ(���ca���U&N�����T��٢��`��k���\Z�rsYOb�j7�q�m� άV���]�<�u\0���N���v\n�����Y^�q��\\�2��{|���а\Z���za���s�رr�6��ݵ`E�j����+�M���\'��emY�F\"ȧŬt4-\'Ԋ��]UG���Ј1C�0�{��\n�2K����?*\"����*�Ɨ��j���jL�A\"�\Z���C�D��!U$ߠ֥&cv��4,�,��f�He\0M��Z�t8�ɰc#��l}5�#Z�ԟΣ�Tћ|OQ��Ap�	%��Z�4���e�N���ȣK��2s\\ڸE�֔�@�Ѥ{kp.u�����sg�_���\'q�1,�?�˩��P*͑Z�N���X�����o�T�X��*jyٴg�~�`�o+�T]�����q�6��t����Cڬߡ��*�\Z�^��M���\n@(\0��P\n@(\0��P\n@(���#�����^I`���� ��&���x�ζ�4�ˈ}��C�F�c�κ� �I�Z�}��-���G9��|l�qT�!`�F���/Ԟ�\n�%`����m:��2}A&+[#�����R-Ѝ-޹l�sD֧\\r�_���ü��\0I:�z�Q�&�7\Z��\n��k\rE���\Z� �Mo\'\r˸���{\0x[�h��rjDLR��l���qn��z\ZZgC츹_�س�;��Q(��&)8��]�\r��������OR���20�G�R�#��rlH�қ��n����M�,��$Ɵ���T� ����M��2���^�L�1s���}n��ƕ�^FYg%�,X�_/MM��]OC$��7X��i�t�­%\Z���7)Q��֧q���\\�*�߫�W�k+x�\"t�7��c����sƀ.�\0����6�l�I�%��,\rשSDɩ\nmy]����U��B��Iє�\Z|��f7�)eR�ߠ��[#��&㷚ͺ��5֥��ЕR���~�4vc�FS������UUu6��1#�0[�6a�4cW�%��\0܁}�\0.�D��4D�r�b�\Z��\\iV�+{hb\r����\0���\0��x9�H�5�����x|��BR>O�IA��\0W[|��]C3G�褑���U�FF��r�[Aޅ�Z>�\\���\0��),���#�.��b���RZ�4%YО��Ŵ��GS�0�y����=�P�PrX�J�[)>RKԦQ�3��$�\Z�Ƥ�S\"@%*�������M��!Ɏ�d�.Tj[�ЕSk�6�(2�4̫��n�^��\0ʴ�ɗC4Qnee���ή�kU�[4��*� �v�Ru��d���D�X�B�v[w��قrl��Lws��\rB3�R߅�D���BlbN�sm�~�W��%t;\Z78���&	�������Ck���9��휽�����$��B��Փ��-e6~�}�����nT�m�\r�kv�Aa��;Wf%6G�y<���ݞ����\0��P\n@(\0��P\n@(\0��P\Z_���彭��xׂ�1�G�/X�����nE=�̿p��\0�9�� ��i�r~�s}�ױ�y���/�(�i�⌎<N��*�67��Yf�z\\G�A�Y6dͦݷ�G@/s�q��1hiS↑�M�w�t�Th����w�*�&�ufج\n���;u�W���4��&eFr�K�*_��n�h`��c��\r�Bv܃�oFj��/�3)�@�wңj-��c��f�Q�dCp���50Z�ڎra��0lM���TmE�����\r���2m�:�+��>M��ͮ����Z��Rq�<����Z�\Z��ܴ,\"�۹K( i����n������U��\0�/B�A�(�7,l4�����(��%��U]K�.�Md\0�Vmz�_��T72�.�W$\\Z�3�U���p�\0!��:x*��9���#!_j�V�%����~�)j3Z͋d�5$����Y�g��#�q}�iW9Y)VX���m`G�C7�h�I7\"�zT)f5Q������U]L�uk)��5�j�:\Z�#�[�&��k|?�]�8&r��\Z��v2Qc%\Z(\0Ё��f��) ��qӥ�QZ�qcU;���a���Ҫͨ�y�$.Ф�Ͱ��w)�\Z\\ۥ�&�h��X�ǚ�\0�Kf{\\\\��q6<�)T���\Z�-��]4�<�,\0go��j�C�e�*,��iB���XucU%=9q��J�N2\"�Ci��kw���s&���(���v�	 ��,I{�lzT�DI�\0N���\n��6��b�q�AW���=�\"B�g%��\0�����B9���2zNK�\rT���1I+��y��c0��H�(sr:�x�0����򫳍i��	�&:%�6���-l>��l���&S3\"��h:��ש��p��e���Bf�D���k򫸃���F������ �$i�W��T����y���h~�}�����*0,aG�\0PK�b���Vύ�Y:W�v�t�H��P\n@(\0��P\n@(\0��P\n�����n.�)W �\Z��A)Ó���o�׍�3��\"��gRH&�Xi^U��p3o_�\\�)�\\i�1��\0HS���^���{����tqG��ˡ�wHGQ��?\Z�u��eM&u*�#��kv�����#쐿��\n\r�\'S�^²=%�)��\\��d�ĨM�~&��-�2�)�mIS��a�*4t#�r\Z��I�lhٵ*`Ȁ�Lʅ���M��2rե�(e������ά�lj��d8���c��-�VM���p�\0����\0o�u2O�gؒ�FJ�_�~�CzJ9-�q�qr&�gU6V?�r�YVښ��n�\nY�����\r���[I����F�����:2թf�@��pm�g�\r�=L�zv$��ɵ����\n�\0�_�H=\Z��v�Ŧ\"�p-u=o�Dnf7�M��H>5)wf4�#ؐ�\0��IM�b���4ѵ[�(�\'��L2�>�)!����ޥ9?(7�H:�5!2�$�\"]�F1�%Xص�\0�;��t�E^T�r��pIcc�j$M쑅}5�2<�_M:U��2��ǎHUP��\n��	\0�N���m�����5�j+Vn� �A�jQ6F/Q�����~?�L;L��]�_��]������v�pV��F��Q\0r���.z��Cf!�@<�\r�*L�������\Z����* �=�]؝�w[A֤�[e�Xs�E�D%u��z�f��*�i5����U�{8#;G&���v�X�z\n�9�����\n�����Q��t]<M_q���ɸ�4�_�jUȾ�5%�Đͦ��Z�C�&��\"*������U�K\"�V\\h���32F4�Z�\0�U6M$m�\n�R�B@��[u�WGmtf��\'������B�Ж��ǭh��ў��#���o�4 :�i���7i���{�9�����&\"�q�B��q��\'�w�P���_}�mW9�\0��P\n@(\0��P\n@(\0��P\n��zx#�����J�\Z�l�Wz�=�\0���^vǗ;�2�+��$�e��,k���p����sG\"���Ef�˼N\0�#��\0���5����N����ܦ��]\n�.<+�g��\Zn�.���}\n�|k.��E�@��猕V�G���ӱj��EfT�3�تX�n��*KV�(��R0�F�ʊS�Q��On��<6̖LX�3�fe$<ͫ[�Q�M�UWR�h}*,�|��y���_Q���[��}\n����ߠܫo3\n�:n����`If׵��2�pϷ=-���_�R\r]��ȭb؋ko����R�x�Vp�\\\r�M��u678�Ȟ��TP�\0	kkkv�b��ְ�>�f��4���\Z�U�����F�EcK#8$��)>t�]��&�k�7Ы��`7(�a������\0Τ��d(P��	Z�tS��Y�6V��z;����R���o��\0�Y36c� ��S��Y��v;F�c�Nƪh��U喕|�}0u^����ҧ&g\'0���#B\0=mR��6K�1 m�?��j\r5d�U��uKy�t?\n���pY�Ѧ.��0\'2���ҡ�@b�\rKt=+C������_��hJ��%Ē�(�\0�o=D�$as�v��nmjQK80D��������1�%8\n�.ͩ$�\r;�\'c��$����I��e�<�D|�P��Y�6O�]��:�?�Sf�]����F�>P\0v=@�[V�3|�e�#.��m�\0>kR�![I/r�-bA���f���}�����h���Xa*���\Z4�oam;^��K�m���PX)�rz�{��[�fƉ^X�b�me\Z��	�N��:�Ǚ(���;AsVG[��-&8�m�ȑ�[��\0�*�3�x��C�<z:�1�Uv�?��V4|�;$K�=t\0Ph\0��|�>�\n@(\0��P\n@(\0��P\n@(\0�������<��tp:�aX欣������w�xA�6|Q�\0b���C�$��y�����6Yk����af�ȶ�-%��D���s��}��0�����\\�7����q�GK�ְh���n�Y�#c�4bD-�����[�`��R۫�Ȣ4�X`-P�.롭�T��C:��w\r��v/�L��J�g����Sb\r�~4L٣��!��ν��ƥ�!89Hn��շ\0�B&ڐ����bHrlA���1�!���7DF$�yl-+5��n�	�xʍ�.�p?��U�1�I�Tn�ǵ��Vm5�a�tE����KkP����h�e��I�=>uf�ƕ�NbDBMڃ`:��5��#�)pmS0�z�vl��G�[�4+&XV&a�nUb���u����R^��.Ő�R�v3u�k�:�^��6�*�O�����=\rIC��K*�Ȩػh�����YdOJi`޲*��\"j�F��԰��ˌf�Ep��H]�pChH���4l�j��E�����QW�l��W4 �j��_CZI�j$Y`�.D��Vk�\\��ҍ��Di`�����l>�I,�d�0ޜj6�����Rh�UspdǑ⑑�\Z]��\0�F��BгR��#r�Xh;��>~5s��S��\0��zD\0	\"���f�z�i���6I_�3��t�����S�%ԫ�2�*�mP�¬�2�]1(�Ё���3��	��h.tn�����!k�n�]�RG�k9%(�P�;�\rakTF�աS�NC\"�GE��򭖈㻖Ya����P�h	:�Mk6oK(-!�H��n`O[�e\0Ҥd�HB�徍�J��w/q��x�oȟH��	���ԑ�L��X�@�p�����?�&S{ᱣ�Lyr?�!��E�\07�FWm���ŗ����#��0^�n*���Q�`p��<K�����=Hy<���&��<NVT��_��/����b��\0(\n-�\0�uي��%�sMU}N箓��P\n@(\0��P\n@(\0��P\n@(��\\�,�Xnܤ���EV�Q�+m�g�>�����m�F���6�^u֧�p�4G�9�㹉e\0�r,����������Q���(�Q�YcĜ���I�\r��?�\rc٣�r�l�\'Tr�k�<�$̌A����f����_��g�p[�������g���D\0���pa\r+0+8$m���ƨκ��I$��&������U)�jJ�� ts�S9쥜b(��X��ks�	�3\"8`\nc�&]��MEȹ\Z�׵T��WI2z@{�(�j��\"ׄB��9n���Y�Ѷ���7.�I���P�Z�3r`t�B��.����\0�V �ʆby�J]��bXX�Kh)R9�9�\0�q�4��/��۵_��ǥ�<�6���܃�$[kx|mV�\'��tu\r� \0/�A)�]��y��A��B�}���ݖ��=�R@��%����.��m�x�L����7�i}m���J�F9f �t�E�Q\"���:���n~�\0�S�	�D.�Q�Um�c����dcM��Su����t�U3K��b�u�u�&��W(Rڍ~V4Ddn2D�Wb���zt�Ʈrj��+���&�[�<�@aq��jK��0c���*���\0�:iP�j䞝O���.H�4�r�O�|M�Ҩ�[��Q��>>_�\n���I����hU�g����1��r/��/��VRs�$We�A�͈?�Z��ڔF0�m�M��n�\Z���Դ�g��WԱ&�����u3�K$kdb���[��t���0\Z�$ �^������s�!�%h�,LjM�����e{i��cFayٔ4eWi>f�{�V+�ܱ-�T����ά�˚�����4�#�RV^���,	�V�Z�o#.������O��o\\%�����u��kS��oOS�;��x�L6�v�I(=w0�v�P����#�hl��(\0��P\n@(\0��P\n@(\0��P\n@y_���\\X�B|~��\0*��Xg�x̲�{�e�r��T\'���O\Z�G� �K)mQ��V]�3��ďz���1�?θ�>�V�֜ʔǖ5k�����>����-R�Z��P�P�$1��\remN�Oi��~�����C��T������r�ކ�Q�ͼ[@Z�6��V���,��:�i!�mu����H���$m����Oz�f�R�R�PGw�\\jz�qڮ��Z�b,UChA\'�؞�#t�[{��o�Q�\"$���9�R]�,`\\z����G�����M��BD�\"\\\r!Y�8VV*	=J(7,5���}MQ}�r�?o��SR�,р0\r~�oS>�D�V���mn���/�ъ�L��A\'F��\r��ѩ�Ln�mI��`*Y2|j���E�]j0����j����p��$��ӰwХe�,�����=�꩓e�)�0TYm�}�t9Ù$pO�\0	/ԥA�m�$h~F��Z����������hM�:�ɺ0@�~�WBFNJ���#n�ł�۩�BБ\0m\"���u��GԒH�I��%��B/�De��1��I�n�KJ{�ԟƭ\'=*a4�s���:|j$�Rz��\0��\\>�.b�,!l=u�UMɥ�:`����]:���g�������Dag,�,��f������Z�fWPp]��]A�T��a���L���X�f`�E9��Ȓ6Tk�kjG~�Q=E��rd4������ֺ*q�e�wլA�:\r*�©�e�èc7�M�Ӡ��K68�te�-������F���F��T���k�*��������8y\"�Ieܕ�\"����Ө�Q�r�K�{��ߵ��ir6de}(�?+WN:O���w#��=f\0�@:\n�>xP\n@(\0��P\n@(\0��P\n@(\0��P[�7��W�*�ʕ��.�\\��s��a��Oz�3L?Y^�_9x|.7��¼����>&D��ў{�qFKdcث�!P��k��O����u5���;h����cmo�edi���m��&�۹�\0\Z�G^7(�&�dm�H\'[�O�F��=�I�xU�OToFm7!�EV���򈃇����Z�5�fV�H�TV\r���6��ə�3��4�8�mP���%Gs��v�T.�\n�b��o�u\0��j�-c�Pz�AeC{(c��$�$��2���wX����ʐW�Y$6�0����#�,�KC�/��v�OP�T��C����*�ڪ	;C�Ѝ�Oj��l���E��B}C�\"�&��02���\ro��T��M�B��H���{�\rd�_%��sqqS���2Ig|�� �9>_P��t�	�g�<�����\Z2�ہ���5H̪�Y�$_�D�JI�K��4����\0	;{��?\n�^�25�bUM�-�ԟʴ}�6H8ٲb�+ԏlC���b��)����6�KԤ�G�V��iR�PU�#��XY��a��Z�rem�8K�Ѫ�H�t��-�5[8/E\nY��Ú^�J������V/j+�\n���Ԟ�>��L�T��a�<R:2��������=mP�5Ft�i�g�TC#`4\ZYA�O��z�w�tUm��i���j��3,L�X%�:��\nڙ�lhR됢w}�1}�N��Z����(w��-ck�z������P���������9��C离J(	}�^�mZ��6�xRF�������N��F�4�����P��X�^�rY��������C\0{���j��;3�xC763��Sp�*�Rp�m�3�~��9>s�?�XH�����n�7�*�U�|�\0#2��?E>��k�ƿ\"�f�;q�,D)����f%��.e��;�8�\0��P\n@(\0��P\n@(\0��P\n@(Q���3&]��_��S\"�oǾۣ�����/9B$OZ!���6�*�쏭��R<��-0��˄��� �r��,��c�xY~�a�GS��	2q[)u���]5�a�w=�M��Ω�!T��)F:��b-��k=��dҊ�	�7����\0?\n�uQ�r�,I��!c6YOac巅��3��&R�,��~�n���6�h����\'�[��+DafRK$���vu��®rn���1\"��Xm�X�_:��;*\\y��ʐVE�acpG�Bɹ&C�h�)�	\06&�Y��j���><�z��r�Zdm*mb)[ɍYJ!�Yl�sc�\0*���2ƶ7\0�Q�\Z�^��P&��@~uT����(�����ަ���sܾ��g.	��۰�C4��z{�W��\r�,T����Q!k���8m��IA��`��$�Ѡ[P@7�?Ҫl���d)&��n��j2���S4J���h���T��U\Z7M\":��6-�� �d��2a���C�{P�zhW� cgZ�x����_r���*�	\0�mS&� ���b�����A�=i6�l<�tdez�,#��Q�a����Pѥ\\#<K����;�����~5X,�p�F-p|�֥	���X�fm�M���+$��9�Lw�\Z%�7���K�����]1�ʯ1E\rר�z֕Ry�rR)\n#	#V!\\f u�h��B2B�Ψ�4��mA}Oa��\'q�#�o�M� ����~zU���Rch��9�I�!\\(���n�ҵNN{B*���ڋq���\0�Z`�jK�1R<U�n�#E$n��q��\Z��]RF��ȸ֘D��m�;oc��z�56�/�*�?Sk�\0*�9�=5��ۛfh��HH���O¶�S����{��ߵ1���=��H?�d��|v�~5�Z�|�\'4پ���&4xx����X��X�G��W]T(<�sm�*J�@(\0��P\n@(\0��P\n@(\0��P\n\0EŏCր���o2\ZE_�\0gf�4������z�`�y^�\0����7�`7�}L}4[�zh}G��mȧ�����bE�{��}9�=7c�s8�>�t��Γ�0�rL���k�&�\0;W;����+SMPѴ��$���Z�����Y�F�_���e6 ���é����RL�b*�VS{��W���+�*�5�,l>:Z�(�YTT�+io��|*�{,H{ȅ�\0��?\Z��v�WK�M�L��|j�=�3�X���>��V�ߏ�H%��F����ؓ����G�t�X��;�цG���%ջ�K+[�\Z� �t\Zl��$$��A:Ԙ$�%\0I6;F�?\Z�l�2l$�����h�[�b;dak�4�F�Y&Xbȕc� cǨ30$�PMQ�jf����T`�X_[�Q���$`-{��|u��B�~���\Zt_�M��RO�#��#]�h?�\nm��$ƒ&�~�:�����V\0\r����u)��d��^\'�%u����m���\'_ʢ�U�+\\�%H\0ۧ�J-h�La�}���X�Ԕv,�C�LRMiPZ=�u:�w\\X[�Q���C�\n�r����50Cpa�E�\\e�V���jI�+ʷ:��j�k&Y3I�	!l.��\r�^��������d<\r�tg�Qï�F����KC?%�	��]���F�lt�B5��H��C�̖`���\\�o{�6���C��A���7��>:u�u�F�d�z�;��m�Cn�7�Ҧ\n��$��uac�\Z�\n�ͨ7X�2��ͪ��xԜs�����S<1�X\\=��sڦ�Y��ȫS�n�5���!�.k��\0[kvҺ�>O��+=����T��,Gd�Kn=F\0�TZ��>k���w]ly�P\n@(\0��P\n@(\0��P\n@(\0��P\n���q\'7�l��{�\\̠\\����V�����m�<g�n9&�6h����O��%ԣ�x�6�y�����f�qYm���c�;���Ӊ>�+r��:?�Ď�L��b�����Z�u=�w��:Ǘ�8R8	r��>z�UmY;��\Z���^�ԁmo�f�b˸��0f��F���Q&��e{�P7)f���ҢM�2�1�\0IГ�]3�� �=6e�p:��3\n|�ܼٲ�F�mޔa#`��Ӡ�Ƥ���D{h7�kj���\r��(q���:�gul��\"�����>?\ZT��%�X�k�z��d�\n��@{iIF�F�&C!���Q�O�6%4RG�p�mɯ^�Y�wXG̉%��c�%k\0\0�@����I�hZ�oV�m�������Rb��{�=���;~t&�2d2�>��d���_����[�2�\Z<�����جR�\n�\06\0�~N�Z��)�2�w,R���P	�n�\n��\0�GT�$��ȷ_ΤV�˯��1���rs�-�������K.��DP��ƥ\"�i��r)���i}:�X�t#�-����ά��3�d6���Zǰ���u�Iy�D;I��V��%}�e���M,;T�e��X\"C-��4S�[v�|5����1e�F@���-��~��L.���e./��T�M�:�f5%β���j ��q���P�`�$[��V�K=�?�M��á\'��V�s4S�eIQ���|*d��b���oRg1��\0�[ߵCe���F�����?��<����o��d6a�j�k�_Ƭr�Ó�����,��-�4\r*�p��[cG��ɤ���m�\'����ZL�Q�����k�\Z�|�3.����8�m6G��>,�Ӎhx\\�����P\n@(\0��P\n@(\0��P\n@(\0��P\n�����\Z9T�����jTVӔx�߼���H�͡o�x��t>�q5��>�����Q�~��G�q���}x\0\Z�[:���=�.x���y���2�4�\"��z�p����Y>����:C����\0R!�Bu\'���$�)в1�\'}Dl\r�4��w�PSݙ�J��b��l/a\n����Gq��YF��\Z�{�Ŕ�2ƥzI�ʡM�N�u:�5tgd��VS�s��L�9�Y�)b�4Lr\Z�R�P��Q!Bw�Kn\0��o�_��%d�pW�ޠƕ��2	ģiծu�\n�5W�pT�.Ό�����^��IR�4�^��p����	뻦�*�\Z��D%XX���Fv�3+6L�d��8��O�z��Y]m�R����k�O��*�ak��;����\0>�c7i8�UG����omu�e���k�G�`F��<>h�=-�_w�~��4z9�cXX��H�X��j�Z�1�)�7�~��/P\Z\'�\0�N��\0��4i[���3<L$M�#-�F�F�u�(��iD�����w�`<|*!�_rH��դb��o��\0U�^�H����a��}I�\n̝��r��+����y�E�XP�}�ᶋ�����;X��e]�A�~52e�2�b&;�J��#n\Z�Z��dZ�j��¯��u\"J�\0m}ww��;M2f.v:	W+�Xȅ���nӭAz�ԉ�o�.�n|/WFГ�⬎�J�����4l�O	�8pCK� �WhV�[��R���Ay�	�;\rm���Pek��^���VDa��hC\r��/ZUI����=}������%埒}��Ք}Lj�O��r?�>��#��q;��cn���?%�ԗc�d����P�E�E��\n�<�}��P\n@(\0��P\n@(\0��P\n@(\0��P\n����jk�l������\nz0?�Ms��z>;;����JJ%��o��:�W*z��Q�W1�)��:�ݜ,y\n���C\"�ю���C�\0\ZW.Zw=�%�S�����!�F@Ն�nu�{\Z�g�`Ț:ǘ�\'ӑ!0Ψ�2����:�,�C\r��ѧI\"��Z�	ď��B�3���F�������vT�n���Xw�Z��H��ý�\n�g=��a�AӪ�\r{Tɞ�D��*nE�J�A���mBlmv�6pb���YƇAp*El�e6D���뷦������:\\�֠�\",v��\Z����PU3�ĺ�ʛ�v� ~_�R�ug��Lo�H�A\Z�)e�X�	\'�HF�r.E�ƦBSԊ���m��������ڏ��m[·ho��j���\Z%���b�\r��|j��w f��\"V6d��-k��X��$�WxV4���@�vbN��iXH/���\"�*H)ko\Z����W��҆v���p]��z��v�S�\'dG�C���A�X]��P�z�\n�^ג#�+涞 �C;0���H�\'����5��\0t�A0d�R��}�΄Z�`��}�޿��\0*����I䙙�>�f.:���VFnĜL�E\\��z2�e\rk�^�?\Z2d������۵$�G�\r�	�6:�ѝ�����@0S\'m�P?\Z�jf�g@���V���E颯B@�����o!c��!m�\'˷�X��M�)�,z������\Z���r{��� ��`�<K��H���o�[c��s��=��.�ș�\'�F�������s]tG���·�>�q�\"��(Ul!�\'�\Z�~5�Dxܛv;B�9\0��P\n@(\0��P\n@(\0��P\n@(\0��P��<���U��Q��X�5*	��\\�ßr��\'��0V_NMѰ��ڊ��Xg��3,�:�;r�Da�\Ze+(Te��u�ۆ�m��}{|���Y��m\'z�po�qd�K��I�����R������\0:���ÕI��㿫�HN���u�����)��H��S��oڨ�\'U3A�e�\'q�9�5��WAv�|�`�����O���U)�O�K�颢���wv�\0i�\ZoL��\'ؑ�Gcmą�z[�E%[P`�\Z�U�]�j����t���A���������rG�*���#�D������@ًX����n��\rLΤɴ4�H�q�:\Z�FȈ�@IĈ��\0*?#C7S�\"ʥ�$��\0� ��96z��B6voQeWR��1��m6�5f���E���:��^�0e{=ŋdDѤB%��M���J�Eh1��c��W[�ޣ��Q������,��[���q\Zu��MCF�c)DȹP}X�F��t��b\0v�,�[��h0n$gX�e!u����Z�#t��&�O�J�u�ʄ�I�!Qud.�BV�\Z>yϘ��7:^����e1�)�\\o�w�*��K���K=;ޮܙ��G\ZG�����_r6��\r~\r\ZT���Ѩ\\p�>��\Z�,ڂ��wK5۹��q�r}R�HI�aZ���,�@\Z߷�41v�����@әv����n$��ށг�ބ�\'���RP�86Y�ܙ���vmO���T�I�k�=����P�0�;6��{~=MucG����f�w�.,w��m_�D�X|�6�WJP|�K�rz���w���P?�6����y�-�͖�c1@(\0��P\n@(\0��P\n@(\0��P\n@(\0��꯺~�Nc��|Q���8�ԇ��s�s����[k<k����`d)X\'����?��j������k����/�;#��D����c��Y䤣���u����=�ƾO�(Y��s$�Q�Q~�J᲍��eY5�tO)�c�VY]��\0ٻ�/C���\Z(�L���Wb��\0\Zʡ�\n�ݠ[B�)Sbz҆�ҵ!$�}�\n�����_\Z�!�0M�=Vb�:�����L�����}���_�5b�NL���%���\Z[��\r�d��H]C�)as�[N��֢H�HP�׺� hlzۨ�\"�!e?��Y�Qm�6�hƶ&�<6܊������U`޶Mh`y#�i$1�3�YB �Ҡ�l��zG��M���T7겈��x�\0�+��y�\\_���L�Z�J4f)������\\�,��$*� `��\0<�Ch�3G��d+yH[����o���#Bљ\0oQ������j���G\n��ɸ܄�63��!����z����L����u�t�PK�h��H�D�P����\0��ߠ�W2:��_�us�\0���:YH�Z������2��������)^S��^�\0	�/R���H��Y>La!�\"�M��`\'�j�k$��V����H�OB\\M*<���%�3\\h���jϡU`��v�mA=�ڪ�grW���X���f� ���Q�+B��d@������ֈ�B\\*i�Ҥ宅�66��N�Tv�t��A�VIQZ�\\1\0�\Z��T�f���O�3B����c�rkJ#��^=���۱���z����-fo��+�O��e�z��|B��k��v>�Бҷ��y9����c��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(�X�h�E\r�U����Д��<5�g�Rq|Ŀ�%$V2�06����:��]���gW����f�1�,R�.\\�Ɉ�U�[�_2/�<V�%��m�rr�r��:�&�X�?��ɖ�����h������&x2T��X�����Ƹ��џ[�ʮ��׹��Mʋ�%k;w�]ED��3Zi@#F.Ia {ۡ>/W����ܤ��BGZ�Gu$�q��e|��$=����ik=�~��~5\r#U����N�=[���XvmM��SX�w%���o��R�2�fNPC�3K�(Hy�(7�>\Z�\n��|�[\Z��_��R��]�J^��\rhs>�Id��ve��\r{��i\ZU��$,v鰀w_��Th֧Ɲ�\0\r�\Zڢ\r�\"ϑ4�^i���T$������U��YW6_�͸\r�Xp|\r֬�sXJ�\Zw`���G�D%%�Y���m΢?�\r��ʝLڂNFl�ƁĐ�ݶ�M�Bm㥪��Tعy��6ܽ�k\Z�`��X�f�Xq�cJ��\nubmz�3\Z�BƉ�0�!�K���~.�g�fČ�G�:��*R2��0���M���|�Xh���\n��7�M���]A��ۺ�iQI&9ve>���؞��E\\o+�[i�I�[#h̪���o��Ԃ$�ʹ��Ʀ\ṉŏ�ݶX�*�ܻ\0\Z���UcRw�ye}�B��P/�򫕵�6kk_��\nnO�����#�\"H�\\��u]]���jLbK�-Ԑ�ut�M(CF剄\'�|Pek�X�(`t\0��Ռ��Z}���S��������V6��lh�<�nݏq�|W�|1��\0`���\Z�\0�oƻ*�){�rzw�R�LW[K���=��#�h��o\"�h�6�����P\n@(\0��P\n@(\0��P\n@(\0��P\n@(ԟw���������x2C*�l?��/\'�]OO�r��H}�|��/�Hf�q�ȴ7>_PWɻ\Z��}O�ˆ��)��m������sy�+�v \\��I��޻�����d�Z�W�FvW��%4��m6��x�\\Y)�{O��rvYZ�;���O5����͎ģUT|��i���j�Q���W�T�-���\0�A�$�T�V�܇ʷ��jQ���\"�yAk�\0lt�[[Q���#)ܤ-*���,J��F㭨n�0ƹ\rs� \ZK)*����׫&V!����0��U�/	��I�I\nt���Z�NԈK3\\��/�#�Z7ђ��H��M\"kr��\Z���Ͽ���+���p�E��&0<>��:��2��*���E��F��\n�6��7��+�p\r��Z�\Z\0.ڒAH�1��	�NFIw>�!P7��Oo���\'w\'����� a�S�M���Ϋ��r��E��/rnm�\0*���2b�5�%��0]�*0�j׫�9^Vg\r�\r�$�/�[u�KnҚ�V�I�_*e�b��&ª[F3!��}���Aa��hhZ ���N��6?\Z�F��噏������?\n�R	�,����5�=\Z�z�dH��s_Q\Z���ֶG5��x����\"Ie!Q��\r�@��S��#���Iz�<mRU�гQ8�Xdɣ��M�j<nMD�Z��~�c���A���xsZCtR۵��{��G����n�+�Z4UX�ȁ��<���Sr��T&�+h˧@|*R��gr{W��@Xq�S����H׻���y�V~�}��z��8y3�m���������<�k4�H�7\0s��eC�H�K���R>�|�n�+#�u��@\n\0���4�@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@qtY�pe=��jIN\n}���|��$DD�^\"�nJ_�ʼ���s�<G1_�:�-� R�&��H����skF�N���1�6l�9��䶁\\��In��mL3��G�k�v�Q��\0���xgl�%��PC�����re�3��r%)�y�3���<��,zzVz�[z�� Ɠt��y�@���2b�� ���:�yѕ\n��(ЋhH���l����\07id;mz���K�3#\n)�9�?ԡI�yw��u:��(�z����6V\"����M2gF�8��\"x��T����z�H�Y���o@A�z���z���]�ƺ��2�p�1��h�ѹQ.Ӷ�R�P٭T̎<y�h��\n�V�-���Ѓ�W�v���w\\+�N�mo�L�K&a89M��a�Ġ�i�Yu 7sU�Mj��J.X۾�i�BD9olly2�mBF�sn��R���R�#A�Q���¬�b�Bn:I��#�S��vB	��׽X��K(�F�@ӧ�Yz�fʏ\'тYHL�G��u \\ڡ3[t*�;�v�.��:�\0\n��i+X�]ځk�Oʥ1dH�̌���\Z����<�W1���~����EY��\0����U���ό�7mI���e��m���~���m�,��m�Sm���K�J�B�Cz��j�0D7�F�.�&3cǼj16^��)�h����9��b�(Avץ�����`�Ƨ�\Z/G�Xو\n��M�UM[H����aI�;&�Ƌ	б:�\Z|5=�o��|ߔ���u=��\n8�Kz�jH����`��Wr����zG��p�\\@�Y�PX[�^´�cS�ϓs6�����P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0����n��>&|I	�Ɛ��aұ͏z:x��+��Orps��3B񘜦`A���u��a�WC�p�Yc�:W�<<9иڦ<��2v��$v��VQ�p�:�w�tncq�ύ�	�K;�>S��\Z�~�ܭ��ξ��#�+\'#Ƿ��Z�T���{���=�>M!�s��p�����=*.�,\rc��t�AC��3�m,k����G�ƦK�$r�Fe�:���W�bblGU�AQ!�$��ܩ�I�zI�d�L��*8,\Z��j�,����L-�.�	cki�C������}����K����>�b�&:X�L���i�m���Q��d���Rz|mSwg�\'p��\"��Z��+#�i�0RȖ��\\(&�cҫ��������p]��eS&ʟ�������4f�\'��G���(\nF��$Z�>�rC�%Q�^�\0¦��4j2\"�̲;�^�`P%���Ң\n�]L�;\"�Ñ�b�;����\\|4�*�V e#B�J�����&���A��H����F`�)�\rZLmR�!��\0W��\0U�~5c8&r�9�*�J,i{G��k�DԘ})q��F�u�\rʋ�o��I؅]�d�F��uQ~�\Z��*�@Q+���T�d\0��\r���֬������e��T\r�yA��O�׽L��`��Ϗ�f�D��&���:~4R��\'	�ÂLg,b�\nv�X�U�co�KH쯶�؟��#\"�G��p�?񩪓���b��1��\r�ba�f�/�5��a����\0�z��XG�r���m���s��m����\0j�^�Yd���ZUng��ɷ�]N��<P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(����T͉�h=IB2��\0�)\Z���͚��K��u{[<?�^3��(�e��vQ���}>So=k������}J�]Q�ϹP/��L_��7�ҭ��x\Z徎�\'�����i��e��E��$����7��S�ƥ\Z?\'��L��kwn��+8�z�-��gI��7�\0�n�\'mQ��s��Zth�Qb\n>���*�u*�-Np��iU�!2F��\n�M��u:�P]�M3ӹXnU���|5�RF�3ș��6D�\'[��V\"��eSu&��*Њ4�FQ��\0�clvp��k^��O��j�$�ZU�S�E�������R�A���ZA��g�	�;|}{~R�R��� \"#ȤF��u߹\Z�jʨ��U<n�}I��A���1kS<���HVU{���n�������Y.X_Q��4�lrDK1*��-��\n�4H���(�20�����I0���Cȗ�b��X���BR9�BؖOV9�\\�p��O��)^�-�?Q����|ǵ]�Z�rV�4�$`)]�����RL1�,��*��Q\"��[��h�[&|B/f���H�9q�0�Wp\0���<���_]jd���F4�$Lr�)I���m�]�k�F��L�o��r�ړ1evp�I�c&���w��k7񡍔��36��A��\\�mڥ)2��ڱ�Z\\��i�i�,w�{ص��:�yR=����i�bA�$��˻���Ƌ�{u?�|��k��|��<���~��l��N��D��m�o�+���D|�#2��=3��,cc�\"�	k�]	B�ȳm�3T�(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0�)�L���ōCRM\\9<��c��Lr�V9��J�Cч��\0�y���M���4~}���͝2x���\0�n1`9�0����K�xW����~Z���/�<��O�p�=0U��S��v��>�M\'�r���hE�����Gc��E&�.���\Z�u-qsӶ����G��\nJLƑ�1�A ��E_]ΌuL��1g_[!�Cq���c��q���H��U�\"h�����X\\��U쭺���V4����	{�t=|Gƥ�̶U�2��x㐺�bA�2���A���\\��ZO�\n���zP��,�Ȩ�s�2ua���P�,�Zm�k�\0ݘ��&���$Ԑ5���`�2���ҸΖh��v��[�}-~�+v���6��@|j�v��ϥ�5c�0\"��T�M�/j�e^\"&RD����\"9H۸_BV����%Q�U8��Ѱ(\Z��:��N2�<XK�\Z���\"�����z��d�K�.1ȘK$d�n��K!!u�H�56�N4_�+��Zb= v��6��T�6�b~�ȗ68Ĳ�r �,h-�<�H:���\Z�j�{_���՚2�1MIb$\ru���+>�2z�v\\n���i�N$aɄN�=m��gj5�4����aQ���fY�_W��{m�6)\0h	��\r\Zm6t�M�-8�;&<��q[���jU�K��-��a�\Z��th�13�C�2��S%�����j�H㴛Ϸ�(��g��L�\0��=Ƭ�|��W�Oher��9�\ZY��=UQf�B7S�5cڬy���S��H�Y��\'/2�(��T�,�MuAߧ�]��|�;���}����11�q��ŉa�!d�zWbI-\n�vr�5%E\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n��<??�M�0P��#�|�z�.=��o���ZO�/�>͛3+��`�9�j_Ԍ�Uc�^*��u�d�ٟu��&���<1�ۏ�1�`�KHۘa�K�=P;�\n�a�a��+|��i�u���5C���>�D��G&�\'/\Z�������ҡ8=�9+j�T�ޜ�*$&�6+k�koά�iV����Ĩ;\r�:v��j+J��IX�\ZKud��ՕA���_�K�T����*c�gŅ�1�U��@��1���_�N��޵����\"Ó4,�\n�F����ί�FwĬ�3��M���w�I(�7.|v3A3D�g���,E�\Z|*͜�ĭ����7Տ�|�;x�%���������R�#i��kw:�ւ�Ms��8Qd��H�ɐ��f�(�MOZ�J��\nH��,m�Ҁ�>�Cpn��OJY�u�ᓋ&<�	�����#^�n��Q�MI��Ï��f�ՆB2T7�m�u��OR66���%�h�Gi��$�]u$[[�2��3�ɇ& H�4���Z�U�kv�U<z�]�Lm��b��F<��\\/�*�A�y�Ǥ��鐡d;��ëk���F��̘���1c�Xc	x��#��$ܞ�+ٍ��X�Ev�z�-p5�U��T�tPp}��v��	w���6\0k���Ƀ��XP��4�hnDs�H��V��$��d�>>*��/W��M�q澺D�L.�X�df#K\0\0���Z��q_)�\\�,M@��h w�An�uG���՟j~������ĖHr�S0E,X�e�S�\"��Tճ��W����.��h����C�c�m�:�?U���WV>;�c�y�U�mS�=1q�\ZE,q��j\0\0�]iA�ެ�R@��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(�q����nx�H9Hba�+tq�\0���{x\Z�χz��������q��kr|�@}v�7ab�hw?���*���%]&��i�|,��C��\\#m����+����}\'�\ZX�^W��0eEp�1����*��x��_q����$8(�å���\rV5=�Y�~���,��#��1�7\n�Xi�kVi����ϱ�z�ǋ��1o%!f�ڻA{jj�����0M����>Y�q&��em�̤\0l\n��fUgݪ�G��ޥ�;GN���Κ�t$��Ը	��SU��y�-c��TX�� =A:�k��UP�&R�6��\rZԎq�X��ίrI*��Z���]� ���F�Zԯ�q`�\Z8�38蛍�&�>5k\",�R�+\"�o���7�¦�0`|�E]�u�ק�E�\'h̓$ǖ�#K\n<��(f(,M�ޫЄ��3���i��|�iRUN�-#�͐ҹbnO�A{�ҭ��J48ds�Nb	\Z㐡!6fV$���j���,���2U�U�$;���\n�ui��R�(�Q�eL�2�1H��eR�`��=�:���UT��ll��ƀ�ʪ�ӓ��$D�����U��ϴ�T#���?\n��Z��S�4��r}P�H��t]��`:U�_�����X�]�H6V�U��|�h`|�P�/k�\r�>5�A��PX����I:��WӀ�K�lm�Xk�JgF�鿲����_7���8����<X��(�y$`\0΍���*&��S��nퟷ�qb���EW75@;X��������X�����sy��oa�u��(\0��P\n@(\0��P\n@(\0��P\n@(\0��P\n@(\0���@q2(�@q3��1���է��>��\ZnJ5Sb���i�>�qs�+ǅ�HɅ�H��G�9<�~u�����S��A����X���{o���8�q���2��]��</�Ҽ�J>�ͭ�YGO���)%h�8yH�tk|GC�UaX���_+Ѝ���|�1�ϑZV�-mu�\0��U��u��_���.9��͋��\"�.��W���TIש��?/K��U�&�%� ����\0�Z��W�VY��gƒM�.4/�z�E�:����{\Z��u4�D�\Z�w��ԩ=Mh�4n{�W���Ը�E&�i�3$H^X��t6��2�����KИտ��*X���\Ziz�)�L3gzR��Xc��*���t�n�ڧi;O�g���H�Pe��c�6\0(\'��U���G�*�|����\0T��G8F)9���|�a2��F׉}��v<����\0Һj5�[jE+�3�ba��ae�#\\[di��<$7�]�m�|�8�Wz��H���\0�\rݯ{��&��yL��\0q��,P�ȏ#ik^�PڛX\n��g�U�L���9Yb�Ԗ���T�m��\"@�w9-%�$��O-���\0\Z�ԝɾ�u�Ȇwx�i$}9/rSkk����M�Sz��ɚ27��@lt:�����:���w���wSzKg?I%��=kDr�,-����9�*$��mou����T}=�-�H�7��G��~Ue���������P�A���	j/����^����-Oܿ�7�8�</��Ƕoz�������\0��>�۠�[a�s?=����WC��p8�v��POc]Rx���l9�\"e �jAp��/с�ƀ���7z(Ȍ��2S���\0��P\n@(\0��P\n@(\0��P\n@(\0���Hh8_�!ɗj�^D-��$����i@A~g��Ԑ@��+��$�+��]}K�$m ��PHo��I�Rd��fwYG{�6[i����!�f�ƢIZ�W�������#��\n��0�$��X��>\\*��;�C���/�����l��8���}.gK�W�\09������>�����?pcsl�Q��4e�B�5\Z\Z�i��x9��Hr��3�*H�6:�������:Z����JB����\0�LC��d��l�;0���ѽ����K6$�(ԍ��:�,-�����Y�� �EP$9wKZ����z���ڦ}2��&mb-�8#�Qj��w�L�����¶�I���\Z�\\��G����]l¦�E/N�,�c#$@��6K�¹bcD�t��Z�u�k�0��B�X��E���n�k��h�)��BU\n��l����:�wjse�^�{�����C��ϋʄti#�P}i�m�;��\rO0�۔)$b�\\\ZC9�yV`�\0r\r�kjZBO���iU��$D�����Z\\��H<�XY������\0綺�\"���e:�B�zs�����F$��sr~uiF���Lc-dtY\\�>wu�6��)ɕ�SԈ��G{�?\Zڮ�Nr�s�r8�9N��6$�7��Ao�]3�\n�L����2�	bHڣ��:o7�*�����q��/-���Ə��0�*\nF�P�=�j����Fٴ]~�q�y�{�^RH��5�Z�<F�ݜ����Y�0��\'�L��p�~��܊d:��Z�b\"���ӑ�\r%� Փ\"$ް��#���\Z6l~cx\Z�t\"�y�Z�ZE�M��I>9�u�$z}��P\n@(\0��P\n@(\0��P\n@(\0�>�Y�ҳP��v}mz�\nY�F��V��xޠ�S̒ܒhYA[*I16�T�h���߱�d��#+a�t�%��Z�7ր��T۴�TSO�E�4?N��5nWݘk�$k,N�6���{�2Rg�>�}��-���˟ۭ�sv�Szc��a��7J�X�9q�g�����O)��d��!��,a�ăU�zx|���:\'���;�̲q��_P���U]N��\n۹����r���\"�)��*�E-�k�\'cs<�R�g���@4$�Y���ug�4k����6]Ѳ�˔��Y��\\���q�׭b�C>�����Z�dI\\\'�m:��_Aס���N���9�Q a�m�v�P�b�<� Vd��;.�U�����ҵ}�<�M��s�-���ǁ�}&r�)�1�T����\0:}e(����冾��9o�8�ec���WX����N@�Vֽ�?Ư�NW�Y58a��b4Ǩ�CU^kO4�H�w#�J����J�\0Y�ge<��r#A�c�[u�~����s\r�k|�>�u� �$�Pa�\Z,%��Z>���\r�֥ae-�}�8�s2�j�nzV�����}M߅�vfIV��X����´T��/�T�wG����p�����w�T��g��+���\0npYH��F��^�sI�/maf�a%mm��QVzې�7S��*BZ���䰌������*����r@[��z�����ǟ�F�Gj�fnxPLv�SB�͋��V*lа�Z ZF�T�%��h��P\n@(\0��P\n@(\0��P\n@(\0��/@`t��h�_\nC��A���-Q�����J� ���o��(\n��9�\0TAd�i��E�#Bt(�0gT�؊�ɚ�T�crc�F���\\v\Zs�]*�\Z/+��۱:��B�]�b�8m57�U��I���o��{�U\"��}��}�q��	4���o��S�z�i�m\"bo��?�jD��_��fb-�-V��b�#�\"5���ҦB�z�*g�N�2�`�bE�s�ӣe&O�{�ލ�V�Q�|�U��r��g.��zZ?��h���(��Y���H@��Z�/�Z��o�5�,��Ckڬ�3|����|�l1\Z��Ԓ�,�0}���A�]u�L���0>�歯�z�mS����q�\0orF��Rð�\0�7�6����Kk�\\[�:TJ&���q}��3!�������D,Ď߅F�V<�KVjG��:���~EMF���1��q�O�^�RE%yߩq��w��c�ʇ_�ԔQ�l�N���(�ɐ���_�aM�^k��~�=����<���\n6d�}N���\0n^�g��!���;�����l3^�\n����w7	�)1�Fv�-D�����c���­��s���aG\0P\"��j`����0�h��T�]�ˍ�F�y/�$���D��0Aa\"��*A1#���xP���\0��P\n@(\0��P\n@(\0��P\n@(�۽���@aoO^�v٭��?�$g�u�!��Moj�IW7�𪂛\'�7�(J�^��\0i���Ae&�����m�W�;��\0�u�6��$й/�b����\\����K��\0R��֨о����\0in6����\0�A&���\0kX���\0��R��\0l�v��j�\n��k�_\nC������[�*Hԉ/��c{߿N�*C\"?��c{[�(V��\0ٟ��Z','����\0JFIF\0\0`\0`\0\0��\0;CREATOR: gd-jpeg v1.0 (using IJG JPEG v80), quality = 95\n��\0C\0			\n\n\n\n\n\n	\n\n\n��\0C\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n��\0\0�\0�\"\0��\0\0\0\0\0\0\0\0\0\0\0	\n��\0�\0\0\0}\0!1AQa\"q2���#B��R��$3br�	\n\Z%&\'()*456789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz���������������������������������������������������������������������������\0\0\0\0\0\0\0\0	\n��\0�\0\0w\0!1AQaq\"2�B����	#3R�br�\n$4�%�\Z&\'()*56789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz��������������������������������������������������������������������������\0\0\0?\0���?Z@��c���я�O�@c��К����C�_<F�E�c-��<WP	I\r+�U��L�k��\0�P�&�WR�g��H-cto$�f �E^�$`=x��J+�=A�o�>��5�i����ʌ�K��ׁ�`3��_V�r��~k�����a3J��\n��%�ٟ$��\n߯��T�GԾ\n�X1�W��j�,j�W\0�����q��\0�W�x&��ox#IB�C4�$�ped�=�t�{ό?��_�߉.���[��6���2��r$H ���5��I�\0����i����in�����0����=Fr�Rq���U�Ÿ*/��s_�\r��=O�̩�u\n-¥��\0+�O�����}��^1�t�T�[I��L�Ki!=�)!N0	��z���o_��-N�|Fҧ�kt��]OH�\r��VdU8�S�|�s��\'�渱�Ϣ]�2!��W�`I���ݸ�r�8o��+մ�;\Z�)�5Ky�E����fZ�ʪ��:�޼zY�&�K}bW]9��z�#C��Zk����\0�}���\n*�7�^���Xi�^�����`�|�8S�<m�#���\'�f��#�eu �B+�����>&�h���Jc�i�.�Y��\'F�������kkx�-���=�@@}�IWV�u��F��Ѹo�b0�x�V��j����?���h�?Z1���������O����S������&��Bd���l�8$G\Z�d����	5�JQ�\\�쏦�e9(�]���?Z9��ֿ%��H?�_�R�ڢ}g��ioᏃ�m�\0�G�<Uc�2����!ϕ�3a�`�\\��h�j�������5�[ ���\nF����UKd�I��k\n5�Y�u�Ѿ��щ¼5��������Z�?Z9��֌�:1�����zs�����h��\'��΀zs�����h��\'��΀=Mz�9���Z\08�4q�h�֎}h\0���\Z���iRj:��\r��K�Y�e�=K1�Z���\nW�\0B�3�\0��7\'�u_j�;h>\Z��� �6R ���@����g�K�����D��q�hmt�r��qÅ�$�Tgj��<\0݋7S��,6I;�#���3�#i�����?N��/�O����4�ߋ�0�λ`��}8j#��:����?����\0�>C�����|]��Ǝ�M3[�4�:k�(�$��\\h���U#$��?\n��s|Q���3ƚ�1֌����犚��ߌ�{�y<!�;;}iD�.a���e`� �U����p{W�c3\\`�*a��]F��u_\'s��G�U\\;���ҺW�R�)���;�b<{���7� �I�?Z��!��-�����[�\"�	�E ���GU`=�K���Z��e�=���)l���}�eNG�Ҿ��?d��P�k�c�x�4�.\"6�$6b�=ĸ-	P0��	���>���|\"�g�����V��5u��Yd�2�T~q��[�q^�*���N\\�|��_�s����.S�Nt%87�rm��(ٯ$�=gƟ�S�_\n|;������*�\0�\Z忈淶���D�C�����F~���$�\0��~���\0m���?��E��?xG��Ʒq�t��#u`VY@����$߷��E��~��Í_��9�ׅ,n��gNOJ�]�n�1�!wm��X����{���5ɧ�����h�%��x~�V�6ֱB�`�����c���K�m&��j�\0בՆ�\\��iԔcJ�Ms)Z�oyJ��mn��h/�%�g�τ~:𾓢��i\r��j��Ea\n�,b\"F\0\0�l�ڏ�p�v���bp7k1\0OԶ+�f����mx��pj.���1홌\Zk�\nn�\\�p0}H5��c��ٷ�W?�i�\'�R��e��(9���<sڻj��t`�(i�t��e��g���cy��%���?��FZ�<3�O�xk�VZ�\'��7k*�jH��z��\\��߿�x�-[��k&��(�F}� �~|W�w�����?�WP��%�Aj�i�\'�U4�r}�G���Y@¤��)�Z��ү.Y�?���\\�!��������K�[�\0Z��z�8�4�w�dz���^���q�h���ϭ��ϡ�����t����J7�~�\0��μ�������\"|��O�h4{6kK �{˓�P��1�dץn��+�?�%���/|R��~��Ji^a$���q$����?|L��<v\'���D}��sha����\0\n�������i�����Mk��mu�u��$Q\06Ƈ��OU�5\n���I�N|�U��i$��z�x�4|r;�s��ߧ՟%������x��Y�����{}k��r59AP����w��W�>z��?�x�e4R�)$��v��>$�H�sO��g�8�?�z��ω6���t-J���iW����`2O8���^pd]@@�W����$�=Gֺ=�g�|\"SI���-.|Ȭ݈X�#�z\0N��))$���/��/]6��G��7�k���t��k���mo�ȉ $+rO<�J��k���aa���k�z�K+H7\\�N�gg��N�����O��Z!�f�֡�މ���)�fnG9��\0��w��������oJ�L��W5��P�0���?��U�Μym���+Y�2X�k���k]w����_ۻ��ڬu;SC��eQ�&�=O8��O�\0�b?d�������bɨ�	M��	±U.Ä݌���~\rZ��:�����gor��C!�e\0�NCs�8�\'���&�����]u�m\\C|�[B#�;�>�R_z�Y�/�ݱ߀�c �Y�jr��\'���z������$��[����4K�r���@ݵ��Ǳ��3�H||�/���Ǌ��R;ٵ+�r��`<.Fv��g��j�|I�ur�7�۝vǰ�[>���ڹ-_Zh��v�5�0U��Z���k�w�?K�8g�xWㅤ���׽��S�����$\rd�{mQ����n*\rǺ��55m7R��H�6C�f�9���������Ends����������w���r®�\0�;�w���T���^cS�r�\'�����\0\r�\0��7�}�t|���$�7�k9�������rs�<yPOue=��Dy�C���G�\0���u��\'���� ��x{TI�a�a��l~I��B$��=�g�Y��6��?i�/��������7�7	���{`\Z��*��e�����2\ny.r�EZ�K��>������Ύ}�I�{��p���^��b���|�Ԙ_�0��4�Ȳ���\\m�6v���_�৞?����^��Z��y�R��[!rqǷ9�k�f�������tC�]\n�P?݅���������x�㖱y5�K���9gG(�xY�r��g�����*�!�����\0C9�-Mز-���ܟ�x?μ��;Co����)4[׌e�G���]^�{d�����O=={�\0����Ͷ���4���R�Q3�����<��z�!�g���U�-(���Ck�aC2�n��<Tڔ�ܓũjSH�^\'��<��E�\'�r_J���k5�i��*�y��h�fT�$@\'�͵�T�k���{��G�O�:�\\�n�����\Z��[>HI��!O�<�t�5��j�s�I$ڜj�J�U���ps������+\"8n������[K���9V���C���s�A\\IϷJ���l��.��>w�&��+�n4�r���������S4���UI_�x��SN���Z�LmK*�k�a��=3�=:\Z�,>J��`@�ׁ�d�l���\"�om7u��ί�qƖ�&D\n]X��\'�z�5iN��I[�u;��\n�;z��Q���h�ݴ�\0jy&kĒ7���\'j��D��o��ע�y��f[4���T篭2im���[_�# ��89��\0Zu��w������w���\0�w�H��\0!�ʺ�ѓ<V7�A)��\0\'��oUv�&�\0/~H�d.?\Z�����5?�?�M?����3Iw�h�h�;���s�o�BH����U�7W��l��t�.��r6J�����+�U�\0�(�3վ��Z\'����4\Z�&��U�$�^�Z�j���?���k�a.�K�w>�������0��4a�k�??�џ��y�s�(3�\Z<~\"���~e�Ӧ�e��� �g�<G�o�zՆ�j�v5Y��7�b���Ø1�_�����!��?k��x}_O\Z����w��Q�u�\0k�ב���F������xW��\r����IME��V�\0ɏ�Y�\0�4�1�c���J6��� `�o��\\�ex$e�Cpgb����\n\0�z�r=9�����tMV��v�Y��U$��߽q�>��Ba�U#y2#\'h>���1���������;Z���vi�$SF@p�(<������Lt?�i���Y��ݕB���^�iਮ�	���1�[܃�v��h,����\"`�!PF_��}�)F�,omM�8x��	i������n���w�*�Vm�Н�q�s���3�P�xB�	e���d�H|�[��<g�澁��:}͢H!c6	�z�N���YM0ӯaR�#����Kک���t��o&xE敫�jVY��F�q$u�`?U�4c*�\0�9�\r�\Z�s���R��l�;\0^�Z�7�t��1��M��d~���B�/y9jx���b�Z3!\0���v�����\0��,�jVP}����7̧cν;K����\"�\r<$�����2\n�&�,��P�ʨ��R�N�r��PV9\r����`��|�c�^�\0�\\�֞$�dӢ,�H�H�rz��Γ�[�/\\�f\n���>�խ�M����wye��=+����>_3��>[���3�B9�_�YAn̯r�,�IU`@���W�P�^\r���\Z1��C+��N忨��O��G�\\����h���$�#�\'��X�\0�_�����<#�h��^�������y���b���/֗=*m�\0H���tg��^}�\n�O����g��2}����?�W���VO����A����֥bm�$���pI�\0wo�_t��W�~��#���#S��$���W<c1�5͋��h4{\\?�xޕK�{?��������8u\'���^8س#(ݎ�����.��ޖ����L>e��o����\0i��iz��]��;.H��I�rs�_<x���aFO���_4�>S��*�N3�9a��F#�hK(��a���ϽZ��#k�璨�H�j/�I�D0N��B����?8�P�C����K�{����d�f[c�C�����V򖛟7��^\rOo<��,�v(�p1N��c9bzg��j�gL��h�f^Y�Go\r��v�NA*Y�\"F�B�\0m�}�+U`X���@�/�[�zR^D�!�@͂\n>z�*�4�eJ;�`k�!k�*�`�qKk ���ib2�@-�\0뫏��J�G\n��ø �p{�o֒��l�[ڢ�F���>���ǖ�-iT�.��Z�ݳ���L������:s�ޣ+1y��6玟��\0Z���6(��g y�����<=u��V���3�2D�.	9��m�̱1|���O���\"��i�mV�͋J�zeN�*�ןƿ\\;c��w�	s�*?�?ω���\\�d.�;\0�8�5�O�}>������(�?�3i8�#��\0�Fޣ\'ڌ�j�>p1F(����������\0�Wմ�]cL�үc��-���F\rX�����������i���/�(��{��Yh��,bP�K	�PP�=����ZSZN�F��A�������~\r�k�_��4Q��Mcjg�D���I�>���/�\'����O\ZL��vg�}�)S���z{��fxOgQ�ўq*��B��_��\0�c�F���$k���w?Zk�Gr�(vg\0m���r�y�yfܻ���=���Amey|�FA�f�oJ�mj~���ێ̐�Fd�K�@�~�ZX�X�!<2���;ҹ�nQ&x��z�e����\'�2@\';���O��QJ��F�krJ�l.#ϸ�}�\0Ư>����\"I�X�F=+�I�U.`P_�1���O�Ub��7���z��Ȩ�Β]H��G\n�ێ���Un��̔���K�[�=�*MDZp��;U�*� ��X�-�=�zt�c���O���(��kU�u��g������_n�4~���e��ŃO2)v��Azd��k���mJ�����g���^+���	%�5E��	�k��!e��Ve���?�8�\0f�|%z�v?4���Yl�~��G���巄�/c��TU[[uC�`���y�<Q����с����ѥd?6���b��Ό�΁�Q����Q���\0.�Q����Q���\0P�W�t��r���ݸ���١�kd�u�W����9��s��~	�N�b��H�7��b�z��8�d�c�����y��<[|~�U}�i֪u�{w6@L����29��:�<mmI�s�k6y^c\'h6����\0�����q��nx$Y����䌃ߑY����6�ê����׫~����j:������� ���!�q���<L�(�n�ƅ�X}ь�+�mf�?��|=,�\Z�䟣7��|�0�FNpx=��K�@��Xbw���1�rzU����,#jlRĤ��\'�UMGU��H��Rѝ��\'�\\���9��e��I�=\n)}\r����>�Ls���*;�Ēv�I��nrx���-݅����\Z�Fq��2rs�b��j�4r7�n�<¤6O~:�>��i=�\n�\Z��菝��ћ,�V�\0������@��g��^}�cMַ���px�?��\0�O��4߅�I�\rOU�X��\0x�=.I=2zWE:rl���AԪ얯^���O�ٲ��Ř��C�����;�bOrx��_��������I�H��CN�8��1���x���\0�\0�?d?\0�/�o �<K0�����f~����־���{�L;������Y�s|m�?r:/?1pނ�7����\0j������Qpނ�7����\0j����s���\0n�ҌJ\0L�\0�U����*\"�`zTW*�r���\0q���j�q��I�J�5�\0��.Ӄ�cL���ڌ0���T�TW\r�]>��p�0���\n�r�f�?8?��\0�o�i�n�&i~4Ox������Y����Ƽ��\0ld��y��O��iφ�4��׼\Z��E+�h1��7?x�N}�\Z��>9�<��y�M�pz���W�_�7�ֻ�v�dryͪ�y�p�e;���Y/��$Tp��Kk�o�[�GW��am�M�M^d��e+���Ծ&��慴;��������?�R�<-�7��1��\\/���9n3/�t��}�6#���K	K��r�w��MFJ7�o�����\'�p�-/@����ٌ���M&��|F�����K�.TIo����X�|9�z.�hݿ��\0^�Ꮔ�\n�؍�\0�/Np?�h�7�Jo\rO��c�w����?\r<;?��j�e��K#7.����~���ό��_��<k�x&yu�J!�f]��\'-y���7�\0t�F�\r��Ai4Ok��q0a��n��J��Ꮔ�)co\Z�xcO�\00\"��q�\nڝ(�c����9��:X���t����:|j���&�+1Q�x6��kZ��A���9�.�egʴ�݌\n׉Tc\n�ܓ���9X���4��\0n�ҌJb?�џ��p=(�����','1134_apple.jpg','image/jpeg','/../ximages/item/2',65830,NULL,NULL);

/*Table structure for table `item_price` */

DROP TABLE IF EXISTS `item_price`;

CREATE TABLE `item_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `old_price` double(15,4) DEFAULT NULL,
  `new_price` double(15,4) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_price_item_id` (`item_id`),
  KEY `FK_item_price_emp_id` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `item_price` */

insert  into `item_price`(`id`,`item_id`,`employee_id`,`old_price`,`new_price`,`modified_date`) values (1,2,38,3.0000,2.0000,'2014-05-21 13:16:40');

/*Table structure for table `item_price_tier` */

DROP TABLE IF EXISTS `item_price_tier`;

CREATE TABLE `item_price_tier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `price_tier_id` int(11) NOT NULL,
  `price` double(15,4) DEFAULT NULL,
  PRIMARY KEY (`id`,`item_id`,`price_tier_id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_item_price_tier_item_id` (`item_id`),
  KEY `FK_item_price_tier_id` (`price_tier_id`),
  CONSTRAINT `FK_item_price_tier_id` FOREIGN KEY (`price_tier_id`) REFERENCES `price_tier` (`id`),
  CONSTRAINT `FK_item_price_tier_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `item_price_tier` */

insert  into `item_price_tier`(`id`,`item_id`,`price_tier_id`,`price`) values (5,1,4,1.1000),(6,1,5,1.2000),(7,1,6,1.3000),(8,2,4,1.1100),(9,2,6,1.3300);

/*Table structure for table `item_sub_unit` */

DROP TABLE IF EXISTS `item_sub_unit`;

CREATE TABLE `item_sub_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `item_sub_unit` */

/*Table structure for table `item_unit` */

DROP TABLE IF EXISTS `item_unit`;

CREATE TABLE `item_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `item_unit` */

insert  into `item_unit`(`id`,`unit_name`) values (1,'បន្ទះ'),(2,'ប្រអប់'),(3,'ដប'),(4,'កំបុង');

/*Table structure for table `item_unit_quantity` */

DROP TABLE IF EXISTS `item_unit_quantity`;

CREATE TABLE `item_unit_quantity` (
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `quantity` double(15,2) NOT NULL,
  `cost_price` double(15,2) DEFAULT NULL,
  `unit_price` double(15,2) DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `FK_item_unit_quantity_unit_id` (`unit_id`),
  CONSTRAINT `FK_item_unit_quantity_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_item_unit_quantity_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `item_unit` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `item_unit_quantity` */

/*Table structure for table `price_tier` */

DROP TABLE IF EXISTS `price_tier`;

CREATE TABLE `price_tier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tier_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `price_tier` */

insert  into `price_tier`(`id`,`tier_name`,`modified_date`,`deleted`) values (4,'Corporate','2014-05-21 12:42:36',0),(5,'Organization','2014-05-21 13:07:45',0),(6,'Speical Price','2014-05-21 13:08:06',0);

/*Table structure for table `rbac_group` */

DROP TABLE IF EXISTS `rbac_group`;

CREATE TABLE `rbac_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `note` varchar(250) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `rbac_group` */

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
  CONSTRAINT `FK_rbac_user_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_rbac_user_group_id` FOREIGN KEY (`group_id`) REFERENCES `rbac_group` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rbac_user` */

insert  into `rbac_user`(`id`,`user_name`,`group_id`,`employee_id`,`user_password`,`deleted`,`status`,`date_entered`,`modified_date`,`created_by`) values (2,'admin',NULL,37,'$2a$08$6Bpd5qGSPhB5dehzcrje4eYbfeTmxKI6WI8AgnamWSJyC4nAYNES6',0,1,NULL,'2014-02-15 11:31:55',NULL),(3,'super',NULL,38,'$2a$08$/BW7UO.1LsTvZc5kfMtcyeFYbod45/8vM7ECJ6cYfnp8FFQ81NBlG',0,1,'2013-10-10 09:44:04','2014-05-06 16:35:34',NULL);

/*Table structure for table `receiving` */

DROP TABLE IF EXISTS `receiving`;

CREATE TABLE `receiving` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receive_time` datetime NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `sub_total` double(15,4) DEFAULT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `remark` text CHARACTER SET utf8,
  PRIMARY KEY (`id`),
  KEY `FK_sale_emp_id` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `receiving` */

insert  into `receiving`(`id`,`receive_time`,`supplier_id`,`employee_id`,`sub_total`,`payment_type`,`status`,`remark`) values (1,'2014-05-01 15:03:36',NULL,38,10.0000,'','Receive from Supplier',NULL),(2,'2014-05-02 21:03:02',NULL,38,1120.0000,'','Receive from Supplier',NULL),(3,'2014-05-03 02:58:50',NULL,38,100.0000,'','Receive from Supplier',NULL),(4,'2014-05-29 06:38:26',NULL,38,2.0000,'','Receive from Supplier',NULL);

/*Table structure for table `receiving_item` */

DROP TABLE IF EXISTS `receiving_item`;

CREATE TABLE `receiving_item` (
  `receive_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8,
  `line` int(11) DEFAULT NULL,
  `quantity` double(15,2) DEFAULT NULL,
  `cost_price` double(15,4) DEFAULT NULL,
  `unit_price` double(15,4) DEFAULT NULL,
  `price` double(15,4) DEFAULT NULL,
  `discount_amount` double(15,2) DEFAULT NULL,
  `discount_type` varchar(2) CHARACTER SET utf8 DEFAULT '%',
  PRIMARY KEY (`receive_id`,`item_id`),
  KEY `FK_sale_item_item_id` (`item_id`),
  CONSTRAINT `FK_receiving_item_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_receiving_item_receive_id` FOREIGN KEY (`receive_id`) REFERENCES `receiving` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `receiving_item` */

insert  into `receiving_item`(`receive_id`,`item_id`,`description`,`line`,`quantity`,`cost_price`,`unit_price`,`price`,`discount_amount`,`discount_type`) values (4,2,NULL,2,2.00,1.0000,2.0000,1.0000,0.00,'%');

/*Table structure for table `sale` */

DROP TABLE IF EXISTS `sale`;

CREATE TABLE `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_time` datetime NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `sub_total` double(15,4) DEFAULT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `remark` text CHARACTER SET utf8,
  PRIMARY KEY (`id`),
  KEY `FK_sale_emp_id` (`employee_id`),
  KEY `FK_sale_client_id` (`client_id`),
  CONSTRAINT `FK_sale_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_sale_emp_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sale` */

insert  into `sale`(`id`,`sale_time`,`client_id`,`employee_id`,`sub_total`,`payment_type`,`status`,`remark`) values (1,'2014-05-07 09:58:25',NULL,38,1.2000,'Cash: 1.20<br />','1',NULL),(2,'2014-05-10 15:44:19',NULL,38,1.2000,'Cash: 1.20<br />','1',NULL),(3,'2014-05-10 15:47:46',NULL,38,1.2000,'Cash: 1.20<br />','1',NULL),(4,'2014-05-10 15:51:10',NULL,38,1.2000,'Cash: 1.20<br />','1',NULL),(5,'2014-05-10 16:24:17',NULL,38,1.2000,'Cash: 1.20<br />','1',NULL),(6,'2014-05-10 16:24:52',NULL,38,1.2000,'Cash: 0<br />','1',NULL),(7,'2014-05-11 09:17:06',NULL,38,4.2000,'Cash: 4.20<br />','1',NULL),(8,'2014-05-26 11:38:23',NULL,38,5.0000,'Cash: 5.00<br />','1',NULL),(9,'2014-05-26 12:18:57',NULL,38,3.2000,'Cash: 3.20<br />','1',NULL),(10,'2014-05-26 13:19:27',NULL,38,3.2000,'Cash: 3.20<br />','1',NULL),(11,'2014-05-26 13:19:35',NULL,38,3.2000,'Cash: 3.20<br />','1',NULL),(12,'2014-05-26 13:20:20',NULL,38,4.4000,'Cash: 4.40<br />','1',NULL),(13,'2014-05-26 13:22:07',NULL,38,3.2000,'Cash: 3.20<br />','1',NULL),(14,'2014-05-26 13:30:01',NULL,38,6.2000,'Cash: 6.20<br />','1',NULL),(15,'2014-05-26 21:17:52',NULL,38,4.4000,'Cash: 4.40<br />','1',NULL),(16,'2014-05-26 21:18:40',NULL,38,4.4000,'Cash: 4.40<br />','1',NULL),(17,'2014-05-26 21:20:15',NULL,38,4.4000,'Cash: 4.40<br />','1',NULL),(18,'2014-05-26 21:22:53',2,38,2.0000,'Cash: 2.00<br />','1',NULL),(19,'2014-05-26 23:00:44',NULL,38,4.4000,'Cash: 4.40<br />','1',NULL);

/*Table structure for table `sale_amount` */

DROP TABLE IF EXISTS `sale_amount`;

CREATE TABLE `sale_amount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `sub_total` decimal(15,4) DEFAULT NULL,
  `tax_total` decimal(15,4) DEFAULT NULL,
  `total` decimal(15,4) DEFAULT NULL,
  `paid` decimal(15,4) DEFAULT NULL,
  `balance` decimal(15,4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `FK_sale_amount_salie_id` (`sale_id`),
  CONSTRAINT `FK_sale_amount_sale_id` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `sale_amount` */

insert  into `sale_amount`(`id`,`sale_id`,`sub_total`,`tax_total`,`total`,`paid`,`balance`) values (1,6,'1.2000',NULL,'1.2000','1.0000','0.2000');

/*Table structure for table `sale_client_cookie` */

DROP TABLE IF EXISTS `sale_client_cookie`;

CREATE TABLE `sale_client_cookie` (
  `client_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `description` text,
  `quantity` double(15,2) NOT NULL,
  `cost_price` double(15,4) DEFAULT NULL,
  `unit_price` double(15,4) DEFAULT NULL,
  `price` double(15,4) DEFAULT NULL,
  `discount_amount` decimal(15,2) DEFAULT NULL,
  `discount_type` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`client_id`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sale_client_cookie` */

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
  CONSTRAINT `FK_sale_item_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_sale_item_sale_id` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sale_item` */

insert  into `sale_item`(`sale_id`,`item_id`,`description`,`line`,`quantity`,`cost_price`,`unit_price`,`price`,`discount_amount`,`discount_type`) values (1,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(2,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(3,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(4,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(5,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(6,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(7,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(7,2,NULL,2,1.00,1.0000,3.0000,3.0000,0.00,'%'),(8,2,NULL,2,1.00,1.0000,2.0000,2.0000,0.00,'%'),(8,9,NULL,9,1.00,2.0000,3.0000,3.0000,0.00,'%'),(9,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(9,2,NULL,2,1.00,1.0000,2.0000,2.0000,0.00,'%'),(10,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(10,2,NULL,2,1.00,1.0000,2.0000,2.0000,0.00,'%'),(11,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(11,2,NULL,2,1.00,1.0000,2.0000,2.0000,0.00,'%'),(12,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(12,2,NULL,2,1.00,1.0000,2.0000,2.0000,0.00,'%'),(12,16,NULL,16,1.00,1.1000,1.2000,1.2000,0.00,'%'),(13,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(13,2,NULL,2,1.00,1.0000,2.0000,2.0000,0.00,'%'),(14,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(14,2,NULL,2,1.00,1.0000,2.0000,2.0000,0.00,'%'),(14,9,NULL,9,1.00,2.0000,3.0000,3.0000,0.00,'%'),(15,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(15,2,NULL,2,1.00,1.0000,2.0000,2.0000,0.00,'%'),(15,16,NULL,16,1.00,1.1000,1.2000,1.2000,0.00,'%'),(16,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(16,2,NULL,2,1.00,1.0000,2.0000,2.0000,0.00,'%'),(16,16,NULL,16,1.00,1.1000,1.2000,1.2000,0.00,'%'),(17,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(17,2,NULL,2,1.00,1.0000,2.0000,2.0000,0.00,'%'),(17,16,NULL,16,1.00,1.1000,1.2000,1.2000,0.00,'%'),(18,2,NULL,2,1.00,1.0000,2.0000,2.0000,0.00,'%'),(19,1,NULL,1,1.00,1.1000,1.2000,1.2000,0.00,'%'),(19,2,NULL,2,1.00,1.0000,2.0000,2.0000,0.00,'%'),(19,16,NULL,16,1.00,1.1000,1.2000,1.2000,0.00,'%');

/*Table structure for table `sale_payment` */

DROP TABLE IF EXISTS `sale_payment`;

CREATE TABLE `sale_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `payment_type` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `payment_amount` double NOT NULL,
  `give_away` double DEFAULT NULL,
  `date_paid` datetime DEFAULT NULL,
  `note` text CHARACTER SET utf8,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_sale_payment_sale_id` (`sale_id`),
  CONSTRAINT `FK_sale_payment_sale_id` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sale_payment` */

insert  into `sale_payment`(`id`,`sale_id`,`payment_type`,`payment_amount`,`give_away`,`date_paid`,`note`,`modified_date`) values (1,1,'Cash',1.2,NULL,'2014-05-07 09:58:25',NULL,'2014-05-07 02:58:25'),(2,2,'Cash',1.2,NULL,'2014-05-10 15:44:19',NULL,'2014-05-10 08:44:19'),(3,3,'Cash',1.2,NULL,'2014-05-10 15:47:46',NULL,'2014-05-10 08:47:46'),(4,4,'Cash',1.2,NULL,'2014-05-10 15:51:10',NULL,'2014-05-10 08:51:11'),(5,5,'Cash',1.2,NULL,'2014-05-10 16:24:17',NULL,'2014-05-10 09:24:17'),(6,6,'Cash',1,NULL,'2014-05-10 16:27:22','','2014-05-10 09:27:27'),(7,7,'Cash',4.2,NULL,'2014-05-11 09:17:06',NULL,'2014-05-11 02:17:06'),(8,8,'Cash',5,NULL,'2014-05-26 11:38:23',NULL,'2014-05-26 04:38:23'),(9,9,'Cash',3.2,NULL,'2014-05-26 12:18:57',NULL,'2014-05-26 05:18:57'),(10,10,'Cash',3.2,NULL,'2014-05-26 13:19:27',NULL,'2014-05-26 06:19:28'),(11,11,'Cash',3.2,NULL,'2014-05-26 13:19:35',NULL,'2014-05-26 06:19:35'),(12,12,'Cash',4.4,NULL,'2014-05-26 13:20:20',NULL,'2014-05-26 06:20:20'),(13,13,'Cash',3.2,NULL,'2014-05-26 13:22:07',NULL,'2014-05-26 06:22:07'),(14,14,'Cash',6.2,NULL,'2014-05-26 13:30:01',NULL,'2014-05-26 06:30:01'),(15,15,'Cash',4.4,NULL,'2014-05-26 21:17:52',NULL,'2014-05-26 14:17:52'),(16,16,'Cash',4.4,NULL,'2014-05-26 21:18:40',NULL,'2014-05-26 14:18:40'),(17,17,'Cash',4.4,NULL,'2014-05-26 21:20:15',NULL,'2014-05-26 14:20:15'),(18,18,'Cash',2,NULL,'2014-05-26 21:22:53',NULL,'2014-05-26 14:22:53'),(19,19,'Cash',4.4,NULL,'2014-05-26 23:00:44',NULL,'2014-05-26 16:00:44');

/*Table structure for table `sale_payment_header` */

DROP TABLE IF EXISTS `sale_payment_header`;

CREATE TABLE `sale_payment_header` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(15,2) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `date_paid` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_sale_payment_receipt_emp_id` (`employee_id`),
  CONSTRAINT `FK_sale_payment_receipt_emp_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sale_payment_header` */

/*Table structure for table `sale_suspended` */

DROP TABLE IF EXISTS `sale_suspended`;

CREATE TABLE `sale_suspended` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_time` datetime NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `sub_total` double(15,4) DEFAULT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `remark` text CHARACTER SET utf8,
  PRIMARY KEY (`id`),
  KEY `FK_sale_suspended_client_id` (`client_id`),
  KEY `FK_sale_suspended_emp_Id` (`employee_id`),
  CONSTRAINT `FK_sale_suspended_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  CONSTRAINT `FK_sale_suspended_emp_Id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sale_suspended` */

/*Table structure for table `sale_suspended_item` */

DROP TABLE IF EXISTS `sale_suspended_item`;

CREATE TABLE `sale_suspended_item` (
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
  KEY `FK_sale_suspended_item_sale_id` (`sale_id`),
  KEY `FK_sale_suspended_item_item_id` (`item_id`),
  CONSTRAINT `FK_sale_suspended_item_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_sale_suspended_item_sale_id` FOREIGN KEY (`sale_id`) REFERENCES `sale_suspended` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sale_suspended_item` */

/*Table structure for table `sale_suspended_payment` */

DROP TABLE IF EXISTS `sale_suspended_payment`;

CREATE TABLE `sale_suspended_payment` (
  `sale_id` int(11) NOT NULL,
  `payment_type` varchar(40) CHARACTER SET utf8 NOT NULL,
  `payment_amount` double NOT NULL,
  PRIMARY KEY (`sale_id`,`payment_type`),
  CONSTRAINT `FK_sale_suspended_payment` FOREIGN KEY (`sale_id`) REFERENCES `sale_suspended` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sale_suspended_payment` */

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT 'system',
  `key` varchar(255) CHARACTER SET utf8 NOT NULL,
  `value` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_key` (`category`,`key`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings` */

insert  into `settings`(`id`,`category`,`key`,`value`) values (32,'exchange_rate','USD2KHR','s:4:\"4000\";'),(33,'site','companyName','s:18:\"Pharmacy Veal Sbov\";'),(34,'site','companyAddress','s:36:\"#112, Street No 1, Sangkat Veal Sbov\";'),(35,'site','companyPhone','s:11:\"85512777007\";'),(36,'site','currencySymbol','s:3:\"USD\";'),(37,'site','email','s:14:\"yoyo@gmail.com\";'),(38,'site','returnPolicy','s:93:\"ទំនិញដែលទិញហើយមិនអាចដូរវិញបានទេ\";'),(39,'system','language','s:2:\"en\";'),(40,'system','decimalPlace','s:1:\"2\";'),(41,'sale','saleCookie','s:1:\"0\";'),(42,'sale','receiptPrint','s:1:\"1\";'),(43,'sale','receiptPrintDraftSale','s:0:\"\";'),(44,'sale','touchScreen','s:0:\"\";'),(45,'sale','discount','s:0:\"\";'),(46,'receipt','printcompanyLogo','s:1:\"1\";'),(47,'receipt','printcompanyName','s:1:\"1\";'),(48,'receipt','printcompanyAddress','s:1:\"1\";'),(49,'receipt','printcompanyPhone','s:1:\"1\";'),(50,'receipt','printtransactionTime','s:1:\"1\";'),(51,'receipt','printSignature','s:1:\"1\";'),(52,'site','companyAddress1','s:18:\"Khan Mean Chey, PP\";'),(53,'receipt','printcompanyAddress1','s:1:\"1\";');

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(60) CHARACTER SET utf8 NOT NULL,
  `first_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `mobile_no` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `address1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `country_code` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `notes` text CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `supplier` */

insert  into `supplier`(`id`,`company_name`,`first_name`,`last_name`,`mobile_no`,`address1`,`address2`,`city_id`,`country_code`,`email`,`notes`) values (1,'Supplier Sample','Sample','Supplier','012777888','','',NULL,NULL,NULL,'');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
