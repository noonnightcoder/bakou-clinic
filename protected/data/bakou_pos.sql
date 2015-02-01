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

insert  into `item`(`id`,`name`,`item_number`,`category_id`,`supplier_id`,`cost_price`,`unit_price`,`quantity`,`reorder_level`,`location`,`allow_alt_description`,`is_serialized`,`description`,`deleted`,`created_date`,`modified_date`) values (1,'Banana Summer (Imported Cambodia)',NULL,NULL,NULL,1.1000,1.2000,-10.00,99.00,'',NULL,NULL,'A good fruit for healthy life !\r\n',0,'2014-05-06 23:40:11','2014-05-26 23:00:44'),(2,'Apple Spring (From USA)',NULL,2,NULL,1.0000,2.0000,-10.00,NULL,'',NULL,NULL,'',0,'2014-05-11 07:16:28','2014-05-29 13:38:26'),(3,'Pineapple',NULL,NULL,NULL,1.0000,2.0000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-11 10:03:40','2014-05-18 06:46:01'),(5,'Mango',NULL,2,NULL,1.1000,1.2000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-18 06:46:36','2014-05-19 15:16:19'),(6,'Orange',NULL,NULL,NULL,1.5000,2.1000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-18 06:46:50','2014-05-18 06:46:50'),(7,'Lechee',NULL,NULL,NULL,1.0000,2.0000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-18 06:47:35','2014-05-18 06:47:35'),(8,'Lagon',NULL,NULL,NULL,1.0000,2.0000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-18 06:48:04','2014-05-18 06:48:04'),(9,'Durian',NULL,NULL,NULL,2.0000,3.0000,-2.00,NULL,'',NULL,NULL,'',0,'2014-05-18 06:48:55','2014-05-26 13:30:01'),(10,'Lemon',NULL,NULL,NULL,1.2000,1.3000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-18 06:50:30','2014-05-18 06:50:30'),(11,'grape',NULL,NULL,NULL,2.3000,2.4000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-18 06:50:47','2014-05-18 06:50:47'),(12,'á…áŸá€',NULL,NULL,NULL,1.0000,2.0000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-19 22:00:48','2014-05-19 22:00:48'),(14,'zebar',NULL,NULL,NULL,1.0000,1.1000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-20 16:28:54','2014-05-20 16:28:54'),(15,'Jackfruits',NULL,NULL,NULL,1.0000,2.0000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-20 19:15:09','2014-05-20 19:15:09'),(16,'Cherries',NULL,NULL,NULL,1.1000,1.2000,-5.00,NULL,'',NULL,NULL,'',0,'2014-05-20 19:16:34','2014-05-26 23:00:44'),(17,'Jujubes',NULL,NULL,NULL,1.2000,1.3000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-20 19:21:03','2014-05-20 19:21:03'),(18,'toddy palm',NULL,NULL,NULL,1.2000,1.3000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-20 19:25:21','2014-05-20 19:25:21'),(19,'rambutan',NULL,NULL,NULL,1.0000,1.2000,0.00,NULL,'',NULL,NULL,'',0,'2014-05-20 19:27:07','2014-05-20 19:27:07');

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

insert  into `item_image`(`id`,`item_id`,`photo`,`thumbnail`,`filename`,`filetype`,`path`,`size`,`width`,`height`) values (1,5,'ÿØÿà\0JFIF\0\0\0\0\0\0ÿÛ\0„\0		\n\n	\r\r\r \"\" $(4,$&1\'-=-157:::#+?D?8C49:7\n\n\n\r\r\Z\Z7%%77777777777777777777777777777777777777777777777777ÿÀ\0\0f\0\0ÿÄ\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0ÿÄ\0;\0	\0\0\0\0\0\0\0!1AQaBq‘¡\"#2Rb’Áá$4CSTr“±ÿÄ\0\Z\0\0\0\0\0\0\0\0\0\0\0\0ÿÄ\0/\0	\0\0\0\0\0\0\0!1AQ2\"‘áBRaq¡±ÁÑÿÚ\0\0\0?\0÷\0€\0@\0 \0€\0@\0 \0€\0@\0 ÆÒY`ŠJ–5eå8ñ¹5M²¬•Øá€²Jıø.»îäõS½Ÿ²ån½›”ƒùŠJî~Éı4}\nÛ¼­;Ë\\;…to&œYfÌ.İ0,î7…¦Q$S;9¯æŒR²VÆàæ¥4ÖQ’QqxhzéÀ@\0 \0€\rsÚÁ—u	Î0Y“ÁÔ²Rå{šAî¼ÚİNÚ‘¤Ù=Ô;Ì[¨9=Ù¦J’\\àV9]¶h\"»ë	U;†h\"	*Šê¸eÑ¤Š“W­¬ËãE2œ—}I[iÔl½[&Bëì`o-qÄ¾¹dÚ9\"«ú\'åâŞE[N´¡,£-ÕŒg\rÑèÔÓ	ád­ÈÁä½hKTr|¼ã¢N/Á*‘@\0 €À¹mp½ÑSaÎiÁyáê^%çTĞôQüÿ\0ádaå˜U7‰¥\'SÊğêV«QæL¹aİVç—ê—ù,‹Jy•è±âNê&¨\n_¹G˜¢$SŠ/ŒJUZi¢ø£*¥ÜVêf˜˜·óJÙS3éjæ‚f¾7A]8ñ-™ì[´­‹âµÄ¤j‹#\Z€ãù/BÒ¯î³åúµ¢ƒS‡ât¢óAûQ¶ÑRÃTæ—h<9z{vZUh9èÎç—ôõ;}Ìlh+JA\0 nĞTIMh©’,ëÓ€G,óYo*8QmŠË<ÀÖ|ïœWË8ä{j\\Ğ29³‚IÅ“6U[‰¦‚P«q6@S.å&ÈI.å%DJSKÅ_\\ŒÚ©€ÊÙÔÌjÉ5d-Qd²Pæ¦I3£¦›ã–a.ÑUNàöàãV7ìÿ\0ŠK\ra˜/(Ê[Äôßƒû-\rª\Zÿ\0™-]S5ºAåÊ?>ëĞ´£Ç_–|İíz²Ÿn[(jÖa\0€÷ÀM²rÑ’qÕd½†ºD£Éåôšœe¥vA;ÙÌ/•F™—8çtf¤ŒàAUë¬{*ÕwœKÕ÷U¸šé“²§*·e2Q9#Š†“l>\\…ÕôTšBB¶%‰™Õjø²ÄgÊÒr®L±èWE’\"~¸ÜZå!Éí_÷F×Ù[@\0!zV“Ìtú>W«ĞÑ[_³®ZÏ$‚¦©”å&pó€yg¢¦½xĞ©pNsàh®„ù½Ë*êvïÉ.ÄÅŸ7¹MuwäçjbI4ÆèÜá¥ãrë¼·’Æ¡Ûšğy½ÒË_\r[İI‘¹ß¤ıÆõàÜB“oµ)ò‘MöªÙ\Z<Z}‹Ç†X“|¢«ìU!ßÃL	û…K¸üTÆ~Ç«ißO/úÊwQ|cÂßRÏ¯Ç¥¥EÔF˜6–Ncr´kŒ\ZSÄ®wrš –›©\nJ¡5\"ŒğÍ[—Eä£3\0Ê¾-—\"±ÆUğ$ÃÃÔUèƒg¢|²FÕWïú!ww\'ô[lşLğúÛZ!ø˜½çŠõÔ¬¬¦|d\rÄqiäGp¡8F¤\\eÃ\'Nnœ”‘Èx³ÒÔ¾–«tÑôİ¬uâ:…Œí\'·Åğÿ\0ÑíÇMH©Ç‚vTd¬*oÙ‘µ>r¤ªÏÙÍS9<×{²9¡	â•ÍlhõÂæ¶wJ§q\"	¸Îé\'¡;²\ZF7ì„îÈ–Ü!ş›?]ïHïİìÊ¿OKIošcZôá™`úÇ‚ÑoRU&¢[O[’Y<âY‰8Êö#Ø‹+Àh%]”’YfõºÒdÇ‰îZcLóë]cƒÕ66ÒÛ]´¸7œë9ã_™õ¯B…=Ï³ç¯n%Z{ø:yŒwËC.pßƒv;*«Q…h8Me3MµË£/äù8çTKIPikÛáÊÓG_}ÒçAê†ñÿ\0´”gpİ[.W’GÃû¦F¨ä`v¼ó]ÉÌµÌÀkÂd`a“ºæNàk¤îºwÎÒIÀJ’M¼ÙMşºK@dYø¼Wï«İ³¶íG/–[I¨îÊ0Ûµ¸j$ö^„b_ßÇİ¾ÜÖé\rf=_™êVlíöjÅâ–Ï;qàŸôZéRÕ»àònn1ö®NÈ°óE@Bëj¦ºBc©fÿ\0+Ç¨Ê*\\—Ğ¸©Aæã.K¥¤“MU0û#%¾®#Ş‰yÑáSî†ÌöhİQ¯¶t²”8^pçxnèíËç«ØV¥ã?Ğ¾TåK›V\'@xœuPÒÎà_¸\\Ã\ZF™‡P‰3¸ê€9…56E*»¤0™$Œ­­§QìŠåV(ç.wVÆ1tÏëÛÙÆ–ïvU©¾H!Òâ·¤OQ½i´ÔU¸xQ>Ó·iZ!NO„Bu£–ÎæÑ³tôø}SÙ+‡7‡¯ªÛ\n	o#Ï­w)m‰º@ \07\0“ä\0€®X@1Â_)o­ss»—{+kÃŒÔôEÇÎZàïhŞªœ5rj£sR—Á³•›cîÑ<š	¢\rä58†­)ò‘¹uüâŸö\ZİšÚ†Î¤?å\'è±K¤R|lwëèÿ\0üÿ\0A~MíIşÃñ•_ìh{9õôü&=›-´Oİ,ôŒteJ=\ZŸ–W+ßEÈ6>|~ùS¬óÆ@[)ôËxxÉD®›äÈ;KİªhKİ×Y[U¼ÉwÚà{vÊŞ¹ô¹w±G;ò-C²–ÈH1Ò0Ô.ªIó4éè ƒ\ZiÙÓr±GFüšE–0L)$ŠÛl˜4Hàä\0€\0@!Ş€Mšä4…Í#!¥4Œ†”Ò2\ZSHÈiM(d4Ü‰ .€ÑÙÈBÃ<×@¨\0 \0€\0@\0 \0€\0@\0 ÿÙ','ÿØÿà\0JFIF\0\0`\0`\0\0ÿş\0;CREATOR: gd-jpeg v1.0 (using IJG JPEG v80), quality = 95\nÿÛ\0C\0			\n\n\n\n\n\n	\n\n\nÿÛ\0C\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nÿÀ\0\0r\0 \"\0ÿÄ\0\0\0\0\0\0\0\0\0\0\0	\nÿÄ\0µ\0\0\0}\0!1AQa\"q2‘¡#B±ÁRÑğ$3br‚	\n\Z%&\'()*456789:CDEFGHIJSTUVWXYZcdefghijstuvwxyzƒ„…†‡ˆ‰Š’“”•–—˜™š¢£¤¥¦§¨©ª²³´µ¶·¸¹ºÂÃÄÅÆÇÈÉÊÒÓÔÕÖ×ØÙÚáâãäåæçèéêñòóôõö÷øùúÿÄ\0\0\0\0\0\0\0\0	\nÿÄ\0µ\0\0w\0!1AQaq\"2B‘¡±Á	#3RğbrÑ\n$4á%ñ\Z&\'()*56789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz‚ƒ„…†‡ˆ‰Š’“”•–—˜™š¢£¤¥¦§¨©ª²³´µ¶·¸¹ºÂÃÄÅÆÇÈÉÊÒÓÔÕÖ×ØÙÚâãäåæçèéêòóôõö÷øùúÿÚ\0\0\0?\0ıú9ïüèã×ó ‘šSô 8=hÏ&—ÒQ@j1ƒÒŒœıhæ€\0)zâ{ñøĞsÓš\08<\Z\\zÔnÈ§ñøÕKÍ{N´_Ş\\®}s×ÅPÃAÎ¬”WvìTc)»E\\¾\0¤Â‡ğ®ORø—§ÚäÇİ«\nûãEä\0ù)¯Äq§aågVïÉ\\ô(eúëİ‡ŞzW@¤8ì+Ç®~>ëQ9Ú\"Ç¸ü4–©js-¬Ôt57È+m6¾Gzá|İ«¨§ó=£Š8ÆkÊô¿ÚoÃ:^ÊHud|]Æ…ãŸ\rø–4¸Ò5Èe2IƒôÅ{˜Lß.Ç/ÜÔOÊögŠÊ³\n½zN+¿O¼Üãó@õö¨R]î9#ØÔÇÕéri‡~”´úÒĞ1§\"— u‡üñJE\0!´dRã¥ éŠ\0ô„•={ÔsÜÇl7Ë\"*És€?\Zó_şÔ_<!$–Vúš^\\BH‘aûª~½ëÄÎ¸‡&áì?¶Ì+*qéw«ô[¿Ó©¥*U+K–\nç¤É6wí®kYøƒ háÄ—ÙG*¯š|uûg_êé¦f4#…CŠóoöƒñ©\\yÁY‰İûÌœ}+ğ\"ñïM:yM7/ï?Ñö#ud½¤¬}Wâoö¢B¶“”…qz÷Åµlî¼İøŠù¶O‰ÚÅùËß?4ÓâËÙÿ\0Ö\\9ükğŒïÄî#Ìê¹T“~¯òì}öSÃ¸-9mCÙõoŠ‘H¥~ÒO>µÏj_)qrÜŸïW›Ë­ÊèXËYº–¸Â,y£µò«‹s™Ôßñ?FË¸w\re¡ÜjŸ’ ]î›ó®róã}­³’.G¾æ¯>ñ.´ï&8¯/ñ±:)1ÎG½}¦EŸfuZRgŞåœ)¬Òš>ƒ—ö‚Ó™ğ.‘×QÚ_ûa¨éZ´–òÄr˜Áút5ñg‹|G«Ù;ÉgªÌ„uÚİkÈ<oñËÇ:¥´jÏ$yû¤Ÿñ¯Ùò¼Ã¨ó\'¯sê£áîSZ¶iôgîOì—ûréÿ\0V/xÊdø8+µa‰x?xtí_KApdÆH9R§¨¯ç÷ö-ı¹tÿ\0xîŞ/ÙHaY‘É„ñø×îìïñ—Ã~iş7ğµÉ{ytä®\n²€}}Çë_°pv{_1§,>&WœV«_©ü±â÷‡ë„±ë…¦Õ	»6¾\'²]¯ÛÈônAö¥ª‘ß»6Ü’pTç ÿ\0OÖ­y¾â÷?ê(8ÅqŞƒï@Q¼Æ6À^\0ü}©ç¯øT!ÙÔªŒœúzæ“v¿Cäø(íZşÖWá†µ·–8„º”¨ä6IùTÀæ¾S›â}æ¦]æ¹ÎşåÎ~¹ïZğR-Wğ¿ÆMOÅQÏ%ÅµÌ§çÁ%9Ûšùª×âd‘·•%à<`æ¿Šxç‰â#¯^¼¯Ë\'ºEGK[åW~§¹F_W¦’õ=ê_ÎÃÌ];¥ƒ^a(f`À™é^9oñ%„»Ç#’zÖ­‡ÄVØ\rÖqÔ_S)J:#ÑÁâ¥í7=~Û[,×ŸZ¿µ63¸}s^_aãkI+)üÅiAãEoºçë‘^\'-k¡ú~C«Lô_í´òHÜ:z³5\rUdŒ‘&?\ZåÇŠ`hïûsT/¼J¢&ÚÄØ5æÓË­3ö<¦šäM¢çˆ5¥cÈçŒæ¼óÅ·Èc`sVõß‰T·˜F;^âß€’(ŒúšûL“éÉ]up…™ãmB(„™pr=kÁ>&H·×ûC`â½Æ^\"’s “œã•æ>!2\\M–l“_­åµa\Zj,ú:X†Ö„>h­üMh·^To:$’îÆÕ\'“ùWé7À¯ÛóÅğOk&Î¿ˆ<5â>EµîŠGkw\rá[—R;c½~gCm,mæg•åO¡Ö½»Á¿¼;ñáøKñ	7ËkuÎ™q+}Ë„@ğCùWÒ`±U0U}­)8ÊÚ5ÿ\0ù~:È%ÄÙÂ$¤¯ğ½ŸÏtüÏÕïø\'·Äÿ\0Û_ö·ø¹\'í-ãéí´9¬ì´xAu¼\'•hÉÚväŞc¨Æ9¯¼@ ^Mû$^é\ZŸì÷á9t-2ÒÎ(´Xbû5§	\n8\\v=kÖGAŸJı¿\"Â¼&[*¤¥ï6İõ–ºvKÈş\nâ\\\\ñYÅHº1¤©¾E­š½Û{İ÷d$gŸ¥;p q\\OÅ¿ˆwß\r¼8<WšÊ\'ôìåA?é\\ı—í%¢]å¬R8“†µãñp×b£‡Í+{9I]];>š?ĞãÂå†:µÃÃš\'ª—éOáQË#nU±x¯;‹ãö–dÚmWƒ×Ì«Q|lÑ®³ã#ª½yÔ¼PàZÿ\06?‰O$Íc½&|Sÿ\0 µŸÁ?f¿Ötï´èúŠ:(#€Gç_xãá&—©ùÚ§‚µ‡Í}ÉlON?•~¤ş×¾ğÏíá­­vúŒ\nè\Z`Å]®s´xâ¾7ø\'‡ÅS- ø÷O–ÑŸ(—ƒF=>f<Wó_ÓÉ£ŸÖÌ2Ì\\Z¨î×G}ÏgƒÅÎŠ…J2·ÊèøßUÑ|O¢Ì\"¼ÉŒÌŠM;_º\0-xkìËÏØOâÅÈk{½KH™OV·?a]ÿ\0Á=>$Í#Æ4í?h:ŞWÊÇ>¤£Ë6½S=>KV5şgÍÚg‹õùLmŸzèt¿]‘óOŸ£f½€ÿ\0Á>>+[H|­.ĞQ~i£ö!ø¯¦—Ii±ÿ\0<.+’¾i—Í^çè9<=ƒJOcÏlµ©™>bi·Zäª¤`AŠô»Ù;â\\,OŞŒvòóšY¿fÿ\0ÆÌ&ğ•æåÿ\0¦5ÁõÌ$]ÿ\0Cõl»2ÁS‚Nkğ<[W¸¸pÒa°Eq> >àPœƒÖ¾†Ö¾x¦)7„ïƒãîˆMqŞ$ø)âˆ\".Ş\r¿Æ>ó[šô0™ÒŠ>«™á\\•¦¾ô|Ùâ\r.IÃ0yæ¹]SA1q8èkÙüoá+¯djºDÖ¥Ø„óâ+»™¯9ñ¶ñH6•ô¯·Ë±Õ*¤â´>Ï8Ô‚iİy‹hàª€=ı*œÚO—(‘	#`ÈëÔÒº(¦G)Ç^qÚ¯XxtŞÉ¶8™¾è©¯¹ÁÎU`¹êWTõ?a?à†õ?‰ÿ\0uk÷†[$1©9!ŸÌŠûà~cÿ\0Á¿_ïty<wã‡‚e·kx7´’Å?ïŠı8Àãµ~íÂ“©<Š“úı×?‚üW¥…£ÇØÈáíËx½;¸¦ÿ\0Ì[J¶Ö´ù4ÍJÓÍ†x™eŠA•`Üü3_|Tğv»û4xÿ\0şûÛ†ğÅÜŒÚôÄ·7°3²0¹>•÷±¸Œ|-ñÂ7~ñe˜–Ã}EL4ıà~¼×“Ç|”ñŞI,-ZkXT_%ß»‹ÚQê™áp·G\"Ç~ù^Œôšëê¼×n§ÉZwŠ®IIĞ{#§Ü}zÖšx«Ì~úEã¢½ygÄß|Eı“üR|\'ã›Yµf?Ùúš¾J§¿Ó8ü+CFñµ†¯iî›}ÄR®Uãíì}ëüòâîâ.ÌNÑû3Wå’ò£³ò±ûªÂĞ¯F5èµ(KU%ªğWU¹êø Â˜K– õù©?á ‘ÎDÙõÉ®\Z-[Ì\0‰6Õ˜õ.ï3_*ñµc‰ıæÙğ}Çûnãø\\Æšu‰7e§`AàW3¬î/z—û@7ïÙÇjÏëµ$¯ÄŸ©F:$tm­Ü`üÕ:Ë‡õ¬íOÖí?\'ŸëQõê¿ÌËX®‡C&¹&3öŒ~Z]hòNÓäW7>²	?éöªók&MÅJÇVoI?¼Ú¦t²xŠM² lJÎÔ|Sm¼ĞáW?xuéÜW1{¯,qmìü\'µxgíSûK/Ã\n\\é•®uÛØš8#Sş¤7şêåT³lÓ6ÉÍµ×ñ7†_K™_vxü/ã¼~=ø¿\'‡t[ÌÙø~hË4à|íÀç<~Uó%öª÷‡çv-¼\0	Åv0|?×¼E-î¯s!áÌ—3Ÿãv9&»o|ÓŒÉ=Í¹¹;şó¦EWäyp˜HQİÅ%~ï«?WÊslO€…kò®úœ7Ã_†º÷Š®w,\r\Z19+éÿ\0‚Ÿ³.Ÿ¨<1_éíu#Pª§%‰\0©­ÿ\0…Ÿ¢¶³eÆ\0U\0ûWèìWû#&†–ÿ\0ügcå2¨k\r>EçvA?¸ê+õ#uæ¡ßÏ²?8ã¿¥‡ÃÉÂ|«¢[·äzìoğMıŸ¾YxjÂÁmîn‡ÚobUèïƒŒûÇÖ½Œt1ˆbÁ©E~½‡¡O\rF4©«%±ü£ŒÅWÇb§ˆ­&å\'vØzâ¨çä¥9úRÏ\'ë[ç1ñ/á¯„>(è“xkÆ:$wV’¡RÍ,™AÇò¯…ş<şÀÿ\0¾_Üø×à]ÃjúQÌ¦ÂlŠ¹9S*XtåzWè\\²y`‘ ªWwŒÉ¸é S÷vó^&yÃù?àå†Ì))Á÷ı<Ï¨áŞ,Î8r|¸isS{ÂZÅÿ\0“óGå.‰ñêÆÃ¢øÓM“H¾G\nğÌ»ıàú1ï]İ‡Œ-®ík-B9cnŒ®\r}}ñûà7Á¯‹úsÿ\0ÂkğBêö}¤-îhtÎ3‡ã|Sñ«öñ¯€\'—Zø xòŞ$ı’çN,„uûùù¾•ü³ÅßG,?;©’×i,µ^—I5óæ?dÊø×‡3T•G,<ßI{Ñ¿“W•½V›M¯‰(Ye^}jÔ~$„®U>Ù¯šnü_ûXø@ı‡\\øâ[Ìy±ø~VıT\Zÿ\0­P-ßìËãyÖ]Xñ_ˆf>q®\n£Kä¿ºïøn}$19dãxâ)IyT‡ääü¬}\"|@À«_ûî ›__Uÿ\0¾ëçgøéñ­øOÙƒâ<È½7øUİ3Åß´ÇŠ?q¡şÌ.Fì×6nŸÌW“OÂ~8©Q%„ŸÜeW3Éğ±¼ªÇïOòl÷ŸÅ%SñjÇÕ~ ØY#Íu¨G\n*’Û˜W7áÙëö¹ñâyÚÏ¯´4n6OÍV¼Iÿ\0¦øÍñ)¶ë?õ].7å’;v…}îIôãm**”zó5¸ğ1|k•aÕ¨´üÏ*øÅû\\è>ôÏ	]<÷®H¤¹¯oµëjòêúİÛKs3å™Û8öÕöğAé’O:ëãUãç–,ŒŸ¥t~ÿ\0‚$øgK”›ß‰ºÁêâ?~ßÃ¾K‡)şâ	Éï&îßù/CÂ\\i€u9¥;¿ëcä/hİºyrddo\0ÓŸÂ¾”ı?dßˆÿ\0¤„økÁÓ<æûL±˜à8Ç›ëé_Aü+ÿ\0‚jü8øysÅÄ·÷ÄGï_•ôŸÃ¯†¾ÒmWN·ñEì%~ädÀúô¯Ó2®©M§ZVòKõgcÇ‘…°ËŞîõ_qÍ~Ï?°÷„¾Ã½ãqö¥éj‡0ÀG÷Iûß{õ¼vñ*ùQ„]¡Q\0ì+\'Kğ˜Óâ\0k728ß&A­;kE·+ûÖb¼_¡àğ”0ty)FËóõ?)Çæ8¼Ïêâ&äÿ\0éÙñ“Ú€=)\n?\në8„\'š0yäPOlRIû´\0¸öŒ\0Q’8¦[==±@gy[åêŠ¡/… ¹¸ûUÒïb9ÜsšÙPTtüéJ±ïXÔ¤ê2ã7\rŒqá:&­„ ë©N™€=\0­=§8ÍxZæx\nori½ÌÁ¦B¼Àü(şË·Î|”ÿ\0¾Eií´İ}B˜*²[/¡ÙHşcY¦qÔ%Gÿ\0Ì\'øÛkhÆ20£ŞŒ0UÇl\'U³	ü6²¨GĞÒ@ÖÆ	ì[¨­æBÇ>Ô‚ş%ë]‚r0Ï‡mØ ã¥@·\'%31[Tyæ1íÅRaåG\'KvfÙ@ÖXQ÷Py­]%T§Ô‚¥E* NcŞ®*ÈBçœQÙ¥ühüi€„)sE\0ª§jAÊóéE\02x¡€ÈâŠ(T\r½)?‹üúÑE\0ÇJ¥P\0½3Br¼ÑE\0÷¿\n\ZŠ(\0ïøÑéô¢Š\0İ4/\\ÑE\0:Š( ÿÙ','9839_mango.jpg','image/jpeg','/../ximages/item/5',2506,NULL,NULL),(2,2,'ÿØÿà\0JFIF\0\0\0d\0d\0\0ÿì\0Ducky\0\0\0\0\0P\0\0ÿî\0Adobe\0dÀ\0\0\0ÿÛ\0„\0		\n\n				\r	\rÿÀ\0ôD\0ÿÄ\0¶\0\0\0\0\0\0\0\0\0\0\0	\n\0\0\0\0\0\0\0\0\0\0\0\0	\0!1AQ\"aq2‘¡±B#ÁÑRğá3ñbr$‚C’¢²4%	Sâc£&\'\0\0\0!1AQaq\"ğ‘¡±ÁÑ2áB#ñRbrÂ3$ÿÚ\0\0\0?\0ıü €P\n@(\0 €P\n@(\0 €P\n@a“\"¬%8ï ÜÀ3Y[‘¿ÊÉ|P2‚\r¬A¿Jº²}úƒYç½çíokÜsüî\'â?WÒ•üû:n.Öü+“‘äpqŞÛÛ_E-şY3ãÇüì—½šï÷ƒí5$pñŞöâä–fÛrÌ!,Ç@«²æ¹éæø–pïô×âÔ§/\rô­êş&şÙØI,p>d< ¡2(v¥–÷5Ûş^öï¬úJ:’dãÄë³Ç°º£°RGÀW¾|tqk$ı­*²°¤2„j*õ²²”åíX\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@k^ğ÷>³=µËûŸÇŸ+‡‡×ŸwJÂál Û]k“Ë\\\\O#S§½Á–|ÕÃŞİ,xNk÷ÍñI™ÇrP¬ø³¡¸*Âö>t#±­ñe®Z«UÊcjæ¢½\\¦ZV†§ÆePYˆUQvc \0UmeU-ÂXr?z>×q†dÉ÷§Òã±I`†C+†]²^5ÿ\0°ğëülìı‰şĞr_‚º;¯¼éøÿ\0v~ÒnY¸æà3—±ô3„‘ÊŒSB/×­yßı’éë‹Oÿ\0oô<Ûyü5¶Øe`ıÎå7*U8|6áÃ1i»|oÒÿ\0…e‹Ïr,åªÇ¤~²rÛûß\nª\r¼~å=´¯ú=°¡È¿®óÎ‰b:zd‹7Æö­­ı™Q­ÕI{ÿ\0#«ş÷Ÿ+ûÍ—‚ıÃ}®ç¹¸È½ÁñÉéFùD$r7‚µÈş5~?öÎ&KºÙ:¯WÓğ;1yL-÷ÿ\0ØÏî[Úq>DÜ— I*ÚQ`KEr7\0M¼j)ı§ó[\Z£„á9Zû`ŒW\r/·VÉ|‡Ş\n¨`ã±eä£)»!ïé216ÛfäWMüçÍòVW·OÜÃ/šÅV•Se¾OŞbbqÒædópceGJ¼\\Í²v`.F ’tÒµ¿ãÖ®èş0ÿ\0>‡Bò˜6nvKN©Õ¹_¸§…h½½±=Œkël{·ü+‹şï7]µüsË·öÿ\0gâj¼¿îäÚiø<oöŒ<HöJ[l»¥êH,¢à|+›/“äd{§jôG&oì.ÿ\0ãP¾ó¨ù_Üÿ\0¿øì|¼cŸ+e!vÇ@Ñ’\rØ2ÚÄ×O#Ê‡U‘Ã÷~ps[û\"ª4û‰—îV_9ÇÌ32æÉh4ù\r3ßÃ^µÉHj\Z<[óòİkg÷•ÜÜş{)bÂãùE!‚â&RïÅEÖêwizºÄ½\nÓÉæè®ş÷¡qÉûÚr¨›7?\'•Ï°\\Ù‰i]\0fnÂ¶Däåß.¶m¿S”NtE†:HÉ`¤í#o~õ\rIš[º\Z/ÉpÙ™ù	²ù	T!ÙÂôí$énÀWÅDÜ$/›-»9÷›¢s÷ç.[?ÎÌ—ù<©šÉÑc]Mo\\ijÿ\0{sy5µ›;/Úÿ\0u}ËìÁ»šÈ‡%•B¹2Dì:’nşºqd¶\'8Û^íÎ?–Íƒ¥´öëùéÅ~ê2¢xøîOÚ²ò¹OÓ/\'ˆŞŒ)mÖVÛú*õ1ùET:«{z}ş¿ìâşÏT¢õmú®ŸÓ‡ıÅs¸|Œ0{¯€Æ“+ÓeŸKKÈmæV$5¿\n¾/)É£ùâËîf˜±|Ñ’°½‡¬03±y<<lü)Dø™q‰ •zjúLYk’ªÕèÏ¥ÇzŞªÕÕ2]h\\P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 PıŞä±Û‚om¼-y‹~­•¶8>cqÔ’4¯œóÜ‰UÂ—µû\"ÓÄéêyÇÛ˜_tşØbI•íø22ı¼KL`1´ğºßBñŸ2µº•¯?._\Z»é)~|×.~\Zn’ëøÎ_ß?}åqêÜgµ±!Ë±õX»3\r¢íhßm¾«eó»([WÃ÷lôÿ\0îrZ²©©Ğ<×=îßpüŒŒşoÿ\0ŞÌL«ú–ôÑ˜Ûh‰H\n/¦ÛW…d®Şémõ—\'•—•›#mÙêi9^×Ia8bÃ‰”úÙRFC»¨½ÏSøÑªSVyöÃ*’kk€Ü\\Y\rú¨å!¶ôÎûı-kXƒÜÖvåÕ­…xÖ¬êkÜç¸eÂâ¼SåYÕrŞX‰Uƒú˜u¹Mrgä;R+)’ªÒæ³~{ÂÙ¼^dG‰\nŞ$$jWK›^ÕÅ;}M=ìÇêFq–ÊÛ‰ÆÉ†ànñcÛ¡¸©ÒÚU\"¦~_Ëaf.vL|«OrnÔ\'xK«|\rºVØ4²-¹·/©ë¨³•Ò/Q\Z9Ş9p;_mØ’4½ëé%A.d¥ÏÅ‹5±ò²qÁXIaıoØ…Fİe˜İnê;‘÷l™q£»\'ÒŒ\0]½ºÕm™äÉØÒ=Åî~K\Z(j\":3	\nÙW·&©ièal«SÏ|Ï¸V9ÿ\0Q•™?§ECvŞÿ\0Ò‰{›Õ+VÙçæÎ—Ìú\Zä<ğÁäãâS1#l‡şæ+†DT{h«ìƒæ‹m“»ø¤Y0Ö#0U‚ægBÛÌ§©,ëÚ§{KØwâ¦‘TSt``ò\rÇ¾^4XÖÒ‘+)˜ünj«<¢tV†ÑÙ<1Çç¢ñgL4À[õUM•û”Xñ§ÜÛ98‘‘ğñ0ğp±\ZI\"4“]tŞıj\'=N¬¶­ôUKó,}§ƒ>,rbÈş´˜ÃnRÌB£©ÒèºŠ²pgZÜ¾İã§Ç›#`c„›„ÙR}&×$)ëğ®š5\Z·>¿‡™tŸ)bÈcÖ)ä}F–çE\nåáDÛ9Uá–®êòNùxÌ’¢È_t ¡+­¯ñ­’Zõ/m}‡tû7î÷;ílN\\µ—†S&Fä£‹d<l;ÖØy9qFË8Nc·Äõø~[/ª½W¡îü¸¹,<øèæÁñé‘Càkìqß}U½Q÷Xî²UYwRK«—€P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\nG‚â¹i±\'äpÓ&\\&-Í}/ØÔ|\rgl4µ•Sk¡^=2ÆîÅ¨U°(\n‚ÛKxZ´5Ú¢;\ZŸ+ì”ÜíŠ1gbO­\0Ü÷\"Ö®ş7nª°áÉãñÛU£:¿˜ûK4!çã½,ó}Ì¡V)Oçå?xÜe®7?ƒ82øûÑJù½İNšæ½‡.&Cş¯ÈÃÁQ¹ƒ¸Ü7)µxœ’æ«GŸ“_ËGíĞë‰½—Èc;CÑfqÍ¹W!\rÇÀH5Óã^sâÚº.†íª5ÿ\0`J±Îq¢Xb7ê\"•Œƒ^…\n‹õíjÊÜCqßcSŸÚ’b#aSÍ‰÷[¾›¬m\\¶ÂÙ‚Ãd Ó?ÚùÜs+&ÌÌ¿Úd*Fñ©?WNÕƒÇeÑí²ìHšpY<¸’BÑ¶T3ÆÖÓÔVñ\nÖ™uzV‡©Úolş\'/\nwÈ\n¨™QD×ŞĞàêH#Cn•íâÉ[Òd¶|n&½\n,îO;&1†™¥`R—Õ\0ìµtVÒÙµÊÅ•©éÆLÒ[ôë~—êXüEYû{QÄš·1>v4ëÉ±@£Ób	T°ê-Ö³S­ËSBÁà0ñ!‹Ÿ\Z3™g3J¦Ğ¥À\Z’{Uj`gı¡ÉÃ~oÜ	…íä†D†|¾N@]ö¡ó³w\0Ş´­eKèqd®ëí¤Kîw´=ÁÊûW’á’+hİ%ÎR$,„ŞÈº\"ZöëXŞ;‡%±§YŸi×¾ïàä°¹án?‘AXl.7Éõ»u:“Ö³«–Ln¬º>Ço}•Âƒ\\ÃÍå.$˜~l,P	YŠ{iÚ´¥=7_äàôŞf~>\nÍ&¨Ì!EÔ\0.mWU©èw=¤h~G\'Ÿ”ÙXĞLÌŠÍ\"¡-sõ¿ó¬íÇ•\'5myĞ½9ÿ\0­ÅÃ‘.oVÆ|Usµ\rş—Ûb/áQåêZÖp™/2>A£ˆqĞ·.rÆÿ\0¿lñ¸ô\"ÉöPrƒ‹iRi²Ò	2\'oMÓ”‘\rXÛµë:ÓÔ·ÒoĞ²ã|x1İrYÔ!;´jt¹bt6§¸—M¾ÓÓl½İîHùŞ‚‹‘—+2âÇ‰,€Ãé¯Ôx*‚Evğ­u–ª­úuÒ=Ç¹ãyÙÖJcNWH=_X}¨ €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 Â¡…˜ZÒ}J\\ßmğ<Îo‹;®c¿üBÆ±ÉÇÇ“ùU?Ï~õªü¿#QÎûOìÜç29°å\"Ş¦<Ì¤ø·\nâÉá¸·ÿ\0d{›G5üV\'ÑµñıÍ”û‹34Üg?$ı¯ÔÂ²ÿ\0æ(Vãğ¯?/õ¼VÖ¶kî±Ç“Ä_ı¶_ûiÎ}„÷Ô—Œ^—ÚIhÖGÆs~¤oR·ükÌÏıg?ZZ¯ï_¹Ç“ÆrkÒ©ûŸïQs?n½ÙÄ¤ÃÜ>Ïä\rİ ‡õq\0İT4%[øÚ¼œŞ•‰|øÛ^Ï›ò8rbµ?şÊ5ï_©¢ñPq/>74Äå/÷8½}l7c«¢èş›¢ÚWZl{uOA…Ö!=íèy|§Âåå8M\"—•™ÅÂ	HÔ›\\Õß‡6ß–ÿ\0y~\Z»ĞÖ¤ã\'\\Ì~D!>Œ®Í\Z•½ºº‹‘]T²·G\'œÓ¦SW÷µ}Á‘ˆ%ÄÁÈÌÂ¸i\0ôÂüvßO_kfY°ŞËE¡×ÑàŒIBr‘Åú9.&ÄŒZıµb.mğªÙÁÌñº\"\'í¿kãñüŒybxâ‘¥0AˆË]É±‘ÈÕziz•wÌ±àÆ“)\"ö.>j¬\\v;æI•`Öm4:[[>D¤Éà_í-ó=¿>_\'‹Åác±ãxxHZKÜ®ş‚ÇÂ§=Í¾ÇNøj©t]Mß€ÅÄÃÈ˜ácYb)C#Ê »µÎ¬ÇÀWbQÑX®¤Ş3“É\\ŞKô¸øŠ¾bG–ÃÈ%‰në{\ZÒ´ïn§u,¬v&*càa#K“Èä*\rÎ|@…ÀÖÆö­/\nºÉ×\\uæ·íìì„.l|,1,³O*i$±ò‹\r/zÇF—X)ZW´ò1ö’IlìvÛ¹ê-pk¥Ñ[>áqØù Í#ìAõ)\0±ÓKvµë=S\'ŒŒró±ÁĞy4\"?úaF–-ktğ¬áœö³]Nëı¸âsÜŸÜGä8ƒƒâ0f™P$“-£hÉú@½¾5İâ°ÙçİÙ#Ôğ\nù9iÇÊ“ÿ\0CßUôçŞ\n@(\0 €P\n@h_r>ä{cígµ³}×î¬Á…Œ6ãã)¶LÇéŠ%$\\ŸáXçÎ°ÕÙ›`Ãl¶UG‡÷xşçY9x18V‰ùp0y(áÏH!}Œ³(>]Mìu6ğ¯’ædårSjûWXM×§µQÇâqğ¤eô–¥ö÷÷¥öç\'ä(’Xñ¢fC#;vtsğëUñşg‘…Fj»Uiëo¿¿Ä¯3Âc»œM\'éÛıa{sÜü»xÔå½»ÉÁÊ`3˜ÚhZû$_©uVÁ¯«âs1r«»é£]\Z~5Ÿ|Ûu¾®£@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@kœ¯´=¯Î8—•àpsg]S%áQ*ÛÂ@ÀÖYpcËüêŸ½™x829µúôz:çİ?d½«ÌñÓAÇc~‡/W‡s±Œ·½Èá^W+ÁàËX¢Úÿ\0—/‹®ß‘¹ö1÷o¶ıßö÷:^#!¢ÈÃ[´x¹P‰`d#ONBiğ:WÆrx¹ø7uŸÙn5©ò´œ“y¤öê?Êßé\'aúYİÇš?QÓ@Âß\ZŒ|ªÙüËk8^+ãÖMW3/Ş™YÍ.¼#ò\'Öı4«„FA:Ø€ac­t<ø•¡Û_Ãï8ò,öşUR@Ï‹ÆßîÏiåñ8å–?÷9O¢I$Şq®]5ªjV«ØrZ©iz´nşÃöG!å¹?hs	—É´mú.&våHµŒmÔ[ı-X_IIêoÆâ&İ¨åšñ+…–xkÕ‘Çkåqæ6‰7Øè 5‰µÍFìQn¦6¬[mº›iÂçÀğAˆø’Dv ™Ã(6ìWK\nèy™­qÑ¨EVD\\ÇªB`c3 ŠµÅî.MëJæVp™Wõ1¿D^rĞ<\\>.’5ù2HHC\"}[Mõ\0Ú«šóeSw{*ûÈórœ¢Âãbƒi²na×¦—®•f[ü†´Dü|œ‘‹>/¤’I‰y2\':É¸]€½¿åK]¤i\\­”¸ñæ˜®²2)C¾1ºÄvÚQ\\ê[ÔZ­£töwÛşİ\\Œ8XX™YÑYL¹%ˆ…Rÿ\0×{+»Æ¾W	ââß5öÕ6ÏĞÿ\0a{ö/\nœf#zùY³rÈ±vÀÙWµ}/\\5„}×ñõâc­õfñ[ˆ €P\n@(\0 :ÿ\0îgÜÏj}§ö®w»}İú\\Q·<ÓdÌ~ˆ¢Nå~ƒ©®nO*œzî·İİ›ñø×Ï}µ?¿Üïî£Ü_v¹®AùWÆH=½íÕpğbÀ|¥‹«2hñü«Æ­ïÛ¯÷vGÒSN=R¯^ìñg¹³$x°–Y#1íTÅÃòG%Åÿ\0¸ÇÌI:Ÿ\ZíX”vrz×ì×³¾à}Ç÷íÿ\0cğI€ñ˜óV8±É\"yòh§PN‚ª¸VËÓ§àRÜºàÖÏ÷?{m?h}ÃöwÚ<¯\rî,ünC7—Ïÿ\0p–xYä”ÈÈÌÎŞRNĞ@Qo‰®q]¡Îè};ûû_ç.[«ˆ…£ë¼ó…\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 ?í¾ÜøOÍàE›+fxËuhÜj§åYfÁLÕÛtš1Í‚™TYE÷§í?7+-óı•î¤ÇIûÜ_\'*X«,}	\ZjµóÜë8¯®;5ìz£Ì¿ŒjbàyßŞŸb½ıí¸§Ëæ¸I20HÚù8n³Â¢ş]Vì·#¡¼.WõşF)n^Í§—›…zÿ\04×å÷0¹>âáç’>7”ÍŠ¡¦âç>¤E†‡Ôî¤X{Wˆğß¥Jgâ¾ÏCŞõÇÄÆÇ•x\\Xyá*¾O%çH£#ÿ\0¸6ÉÓP¤ŠœÜÜ¶®×ø1ÿ\0´s\Z—×ßÿ\0÷\\,8}Ñìü|“‚Bw!’uA£6â„µÇKÕ?ÏËZê“KŞt,_ä=»eú›w\r÷Cíï0\\ãH8ÌÉ’4Ç†hÄ7hVÆïÿ\0L–QğÖºğù\\où¨üŒòñCÑ­Æñ-,yHœ®lãåÆuoIö]_n–\0›Zö¯N®–SVœûJCzYhhòÀå\'äx.ú£ÇÄ%Î‹qÉ MMïmt†ùÈ“ìrr1[¢+°pòVQë¿ÓÉUVÙNí›˜¿ÀW¢®’9+[{‘¹c;òÅÁ‹Çˆpe•ŒX$(l í²ÌÌw‘}mT«µÜÇÀíÆæ_êzSÙ¿`²²V¯t¸ÜQ\'©Š[ÕUë·q½¿Ê½î/Šz<=ˆ÷øŞ#&DşUø¡â8^3‚ÃL+11ÓúTjÇÅRkÚ¦:ÑET#è¸üj`®Ú\"Ò®n(\0 €P\n@(Šûİ÷óÙße8œŞ_&<Şy yxŞ\\b•æ\"şšŞ×=\0®_6¸~U­½?s»‡Á¿!é¥}Oç¯ïÏî3ß_t¹¾G™÷\'#$©Éyx®\Z0Â<h’#Š#¢©äõ=Íx›/šû¯«>¯,|jEòy;æ½ßËÁ‰Çá¿!ÈfÈ¨!Ç‹ybÆÁUkø\nõpáoåª“‡6Egë\'íóÿ\0á±îvn3İ?tçolñÌOö©Ô>t©´mVˆéûî7øW¡^:ªùŸÁ>o\"˜×Äı—ûsöËÙ¿jø}»ìŞ\".7\r5Èœ\0fû¼¯ÔüAØV³¤.‡›k;9z³¨ P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 > €Aê\rRi¼çÛ¯c{‘NkÚ¼vtò% U”ß¯÷k\Z¦LTÈ¢õOŞ¤æ¿œºë÷#î/ÚgÛ>ee<sfğR9%DN³F·ëd”ÿ\0æ¯37„âdÿ\0l{Ÿï\'6OWÑıú|÷Gì{›‹síÏtáóˆ/é`çDØ’&ûD¨d[üí^Nê˜Úÿ\0#÷Y~«ö8òxÌ‹¤?vŸo¼ó¼¿msı£Òr~Ò—/o›/nLiĞÍãÊ¼>_õV=RV^ÏÛ©ÁŸ‰eüÓ^ÿ\0Üé\\™=ÏÂ6>4<®g\'íèâ³È±€X]v±òÜ¡¯›ÏÄÉÃM4sÛÚ…ĞìØ>õÌÓñ\\—9Ãdçó<|†F81A4\0o@	&úØãWÿ\0°É\'j·d]ñšpoX>şãyşw†öş[aòC…/¢N6fA±™÷1Šä¥…­Ğ×·Âå¾Kùjÿ\0c›?ÖÊ*ı‡é¿Û_³ŞÛö$yÉ{‚t7”ÏµÎ¥a[Y¥…ëô>\'¿*×»õ>Çø|\\eºÊoù{Ş®³Ø€P\n@(\0 €óßÏÜ\'öƒ†ÍÇãRwŞƒ²aá}@« §=ºùS«|µ®W/é§ZC·äwpøo5“¶•?>úıóÇ÷?/Ïdò\\†g5î.ruÊÅ˜¨Œ¿§(M<·Ñz…y81n»»Rßsé7,UUP Òÿ\0oß¶º?¹rÈ¾ÚÇl>\'tOq{§&ã67+¿úœ®«\Z\\úk^Ö*²—¢õı7—ä=:ÛÓ÷ô?¡¿Ûÿ\0í7í7íëŠŠ?mpéËû¢T“÷—!\ZI™+¢-…/ÑSñ&»w*¨¦‹ñø³ÂË–Ù\\İÏäNU\n\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 4wí·°}Í?êyÿ\0hq\\¦EîÓÏŒ…Øÿ\0æ`oÆ¢Õ­¿’OŞ“üÎkñ1]Ë¯éùnûû4û{î<ÜŸf«ûWŸegÆS#Í…#XÙ–U\'º<+Çæx%Wê¿UĞ§ø»u«ø3òîW!÷[öùî\\ßoû‡/ÛN6ddc;ˆ²¡h&WB\0±^Ÿ:ø¾w‚äpíò¸Oº˜fªËn‹^èı”ı¦ıÕö‡¿şÛğĞğ¹ÆLè£&a<òK4Ì¶õX¶ô½˜\r-b4¯­ğ\\œIb¶_úšS¡êÆe@YØ*¬M…{í¤h””YŞêö×\ZmÏ`ã7ú^t¿å{ÖVäc¯VŒ|<Ù?ø\Z~ŞO¶üqa?º1œ§Ô\"Üÿ\0ÈVVçb]Îì~™~”5Iÿ\0rŸi %ß$»!?âEgÿ\0aÚt/ë\\×şÕ÷‘W÷=ö•˜¨åò.?şÇÿ\0ÕOû~Œºş¯Íí_ykî#í\\ê¼ó\"¾ªZ&şBõeÏÆıL¯ıw™Nµ_yeßµR[ÿ\0öÜt\'³¤€ÿ\0újßçcö˜ÿ\0Ñòÿ\0øXßx~Úå°H}Û†Yº¼5¢æâ}Ê[ÂòëşÇø?¾½•oCÜÜs_¥òıDU×+ÿ\0r0·äW­Ü^cr¼^gÿ\0±òX¹_fGÿ\0ô“Z,Ô}\ZûÎ{`ÉOåV¾œqß¸./í7ÅgáIï®Käã°§•GébµDˆN¦ÿ\0BQø\nâæó>šÙGó~_ëèvpxO3İeò¯Äü\rûÃ÷£?;–|‚ó^ğæË›L¯R-6¹nãs.„\\ü+Íãq›rÙïŞõª„£Ø[~Ï¿eşııÅòéî^i¦öÇÛŒLüÇ»äÄù÷>|^?}ƒ›hÏm«ŞæÂ½ì<j¥ºİ;/_ô<>_5Õí¦¯¿³ı}‡ô‹öÿ\0íï³ş×{WŒög±x<~ÛÜRmÇÃug?\\²¹ó;¹Õ™ÍokIå÷ìİ* P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@c’X¡RóJ‘ êîÁGæjK©)6jœ—¿½™Ä³&¹0auúJ˜KÖo5}M¾Ç]rÿ\0¸ßµ\\>ñ\':ÙnšÇ~¿‰GÈ]“4\\[³«¹¯Ş·Û(‘Éç‘ş‘\Z6&³|›v¯âj¸-÷4‡ÿ\0ø€ı½YÚûg=Bô‘§ß[Öo—‘?â¾óEãçıßÓ|ÿ\0piÿ\0pÈÍö3í¼YüW.ÓÕàM§÷\"%^Œ·±–|Ï-,”2õñi¾§†şÑûï•û!îX¸íÉí™³£“÷>†7ÆbmªÀ5úê.\r|·#ğZ_OUùœ|°¹=Ùïß¹^äÍâ§å?İ9,äÈ…[.,›ÂK[lA#kt#±¯G\"Ùt}}O¤ğğäj—„ıİO2Ü?qùi“i{Kÿ\0Ü³1ıHÔ×_Ó³>û.=56Îí¿Ü?råH²æInn‹f‡´\\fÙØùÜl5èmpşŞ=Şù dG+ê6ÍcñÛğ«ÿ\0ŠÂó\\h7õı¸û“%±ñä\n°A\0$µ›o[’½OÎ®¸§%¼ş\nêˆñ~ÚıÂÑN1²\ZwŸBX­¾©«,\nLòùœ\rKDoÛo/ÇfÅ™îosËÄ`1 íœ\0¶\'N5{ñ«]lpÛÑÏÒ¤³¬}ÉÄûgŠçrğ8ß{d~“\nÊ¹®ÇûÒÖÈÕ„{\\|×¶4ïE,§á¸yûŸ2lnÜ&(˜¯®åÔ\0º÷z|jë0Í›uu\"óşæ÷/Úé\"“æò\"¾¢q²Ç\"«´±¨	€$\\ÖYhè´8y™°ªDjÏ}ÓûÇrQfû³Ÿ;åF‹7; ´™[mÕWSnƒv–éN65Ö¬ùŒÍî…Ğë´gıÑ÷_Üx¼×¸°f‡ÚØ\"^k‘UÒ{j ¨º\nôSXêiÃñöåY¾ˆş¾Üşç8oq7µdöÎ>ÂâÅ…ƒÇŠ(”*ÓÛásS^m—]N~_õ[)u±éoıìûyî‹4¸3=¿±˜¾‘¿†íWø×Eyt}t<ş“‹ı³î;K+2%Ÿ\"<˜_U–\'§ñREtVÊİæÚ–«† ÏV*(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\nY÷¼}¯íhZ~›ÄãUEı9d¡ù »Ê³¶Z×Næ”ÅkôGAóŸº/mC’ØÖá3½Ã–o²fC>Ì\0·ãYıKÙÅWŞt.,)³:Cİÿ\0¸o¹9ÑÆŸö¾4‡E‚C,ã[X²ëùQã½ºÛî5®<k´)ÍıÊ÷÷,»r9ÜşNÍcéaK\"ƒñf?ã¾ÅÓª:—œç}Å—,±«gO”­ic|9é×P¶4úVôeëzWÌ¿4I2beobBÉfŒ±üEê®uFŠÉ+ÏÃË4Ï6<¹p±ÜnHäj›\r‘Ô<¿!Ë™$yÑ¦dÓõVÓ¡ X‹U^#ZÚ\rQ}ëÊC0ƒ#\"VhÎ’$·Ìu›¡ÑĞô;SÛşã>áÅ^•‘fÂpÅÀÜ¿¨7ˆ®lüzå®Öu¼k%uG¯şÊ}ÌŸÛ2Gö»ßn™¾ŞÍPÚæ$ŒJçéÜu·Â¾nÛøy6Ûøö>k—Å·\Zêõ=Ûí/`ñÉ2ÏZ¦3xe*7:‘¸Xø_EÆÏ\\ˆú^\'’|ŒIw]Nòã¸¾3~:I½\"ÓƒéM{Y¯`<¿Êº-‘U©îu-Ö¥£±Ø™\\.Ï”#W€è6ínµ­²mG|¹\"³‡Æ{§ä\"Á›eÊÚß+Õ)ÈV5äøÌ¸\\7Üµ‹>¤nª¤Ì‹k‹ô7«îG5°[V™ûÿ\0ÉÉÇqùï(çpŠÅ‚ÍÔë\\ü¼š%\'µık‹õ/kµª:£íÙOmÉ‰“ÌûƒBYX¼N–ÑGO§ªªOGÌóî®±ãm•>?°şßğÿ\0¸²âÇã¸Ş+²2¤ G\n4U:±°¦|‹k~‡–VÒlüLûÃ÷û¿îF–^#‚ÀÉÈ|.õ•‚,8ë¾W y¤¡ëÖ¸ë[ßWÜçäçMÇ¡Ó>Õö—;÷Ãîç	öóÛŞÙ“…àx©·rìa@»^@fİ·yQs©®¹UEx|{e²ü}Çë¯¸xş7Ú~ÙÁö7³°GÂñğ¦>6$6%Ú?ªW$\\³K­r^îÌûn´RÎ›š¸×\'?’(M‹c@5ü»U7Áè[·D^ğ~ãa²ñp«ş—ş£Í0\ZxØÛøTıVprxô_Ë¹ØÚûÏïÌ|˜ñı»‘+J,©…LÇæük|RÏå<N_‰:_Ò¾Şû×÷FCûŠ~7\0ïäR4˜ŠFÀşuÙ[e¯[~Lù¬Ş3‰wÿ\0[÷LÜ‡î·Qñ™ùË£J¹	\Z\\}-(5gÊ²]Q\\_Ö•Ş²—ÛØh“~ê=å”IÇ^$M}UVB>·0¬Ÿ\'#îz”ş±Æ]e•/û•÷Ó9·5…é*Šºø¦¨óäÿ\0ät¯ë\\hş,î›ßØ­i2°röÂ3»å`(¹9=Eÿ\0«ñ}âlüWîû–«ÊqP5ÀÚÿ\0†¬¹—]N,¿Õq?âÙÚÜ\'î§Ú|‰UÌÄı;6–Y\0oÁ[¯ç[×›ê37õ|•ş,îNî§²}Ã±q9tÇ™Æäÿ\0oÿ\0Íªÿ\0\ZŞœª>º?#Är0õ¬¯aØQÉ¨²Dë$l.®¤GÀŠèM>‡šêÓ†s© P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\rOİööß²°_?ŸäcÄERc‚àÈöÿ\0JßøšË&ZÓŞk\r²t<mïOÜç%ÌÉ6µXqX\'Ê2¢şæCÜ\0#@OşZÍ;_¯C¶œzÓ®¬óg;ïœ,<ã“ÎsXpgËæ\'.Q‘šÇ¿öîBş6¦üxô}‡^>lİ*àÒy/¸0ÁÌ­ªÍ‘¹ÁÓúbâk+ráhOƒµ¿‘Bÿ\0p?Ú£fŸ\'\ZE‹¬h³äÜjh5ù×o.±÷Ÿwî{¼_ê7J¿OÜ­ÈûíËÁ!Æã|›M½bÂ[€\0(ü«ÍÉçr·òè{Ø?¢á‰¾¿Ü»b4ÌF„M°*ß¹U‹ó™×Fz˜¿õ÷ñ58¿¾à”lhpråk‰KãFÊÿ\0VĞt#µgÿ\0Éé\'§ÿ\0Yø÷Õ?¼„¿u¸éd2òÕöşsÍÿ\0UdÇF²‹jÂæ×üè¼ÿ\0!wGCÿ\0Õü([Êû‰öÏ&02>Ôûo9”i!*ö#Ó¿Ö¿ı‡7d¾ãÏÏÿ\0¬øø¶qì:ã‘á~Ê{¤d‰şÔaãeLwc¿›“ˆ<Û¤éØ^¥y¼÷zªıÇ=ÿ\0õ÷\ZºÖö^ıKöíö¿*r\"æù^\nfšÑÌ‘“­¿¸nGã^–>jºù–§‹Êş¶ğYı9~ó³íçÛœ§\Z0 ûßÆÏ“ˆUáq¨³Å)ĞÛQjF,<Ším£Áæx¼ÖN¶ÇøûY‹înğ‹Áû£Ü|g+\r‡ÉÃ;î‘²È€;W/‡l.7&»=ƒÅòx™·*éèv¬|ìóã63Úq/©>9\0¹BHÒ»íº­ã})NbV©èi~ê÷ö\\‡1%”…ÇQxº«“.g:ŸAÀñxê“¯s?¶ıÕ·‰‰ãõ¢úŒ.lEgLĞ‹óx)äÔìL/uÆ1ãÈ—ÿ\0m$ê#6—\"êA®Šæ<,¼qÖ\r73’—/œ^S!ÖL’2Ë õS]ÖFÓ¥W\"ÜæN¬xU1í]:›ş7¸@ÁX(†ÅÚ»PÜk¥ë¦·Ò\'/ovk©ùû£ıÁrŞïä3>ßûj,töŸµdltæÎ:X¼¡@6Ü±·@:kÿ\0ó¸˜Kñ8óæX\\WVÏÏ\\nuÿ\0î9óò¸|F\ní‚îU1ÄMæÕØ°#µtÕm©ÃZ<—?Wÿ\0oÿ\0jxO²Úı;H¼½9´Y=ÇÌİ7.*±şˆÿ\0‰ÔÖ92kÕğø_N‡Ï¸şñU’L\"fõdÿ\0ö¼â!ÏTKuÿ\0\nåµåÂ=ş%4İs£±x.O–;³³G0Ÿ)ı0I×é¿ZS}tŸ%ñRÍ—àıŸÆÀ&åó9otNƒqÁÃ\r4/&é\Zÿ\0!]5ÇT³Ääó3çqXªûÙºÉ÷3“áø¨ÓÚÜ\'Àqò–…#IÃäy@¹8\ZèN†¶yœi¡Á_[ŞrYÙ=ËûÓİÜ›0ÊæÄ´8Ôj~w¬,ìûÆ*ôD.Ü|ß(˜¼nKçæ,Nâ9fÇ‡pAvÿ\0¬È··AzÂÙ ô_)¹½=ÍşEÄ¿py,ş“#51BŒ6ÉÔ©ü*ßY‡âû”ò}ÈY¾^MŒ\råTfŒ€:‚ë}>b¡İ²õámèk\\—ºø®BYŸŒÈ›%\'ÑÅ•÷2w²H,OÂõ\nÆË/›©@=ÍÌã’ØùÓlS´£6‡[w½¿\Z¾é3·³Ğ±Â÷ÿ\0$²“qö?U‡Ôn-m(™“ãW±ØİŒ®>D›–06Ş6vtÓúm¡*ç>N¾¢ûyûŒ÷T\0ãğ|Ğ‘»È}Ğd/±w\\{^·Å—]3ç<‡„Æõ½ez÷G°¾Óşí}§ï\\¥öïºñßÚ~èˆ„–Å¢v\Z\\ÀââºqsmW·*iòGúÖL+~º¿‰ëˆ¥ŠxÒhdYbT!•îĞ×¥[+)GËÚ®®S%I€P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €ò§ß_Ü×öÎ	ø/oíçıç.è¡Á‚Î°¸ë¼ô¸ï}qß;»Ûï;øü=ß5ôGägÜß¾Òär<§ÜuıÓÏÈÆHı£ƒ98˜úİFLÀÙˆÿ\0HÒ¹­–˜º|Öü£âx¼™¢Úş\'½Ë÷Wî?3<JgöÇ›	“\Z?Ó…”ÆÖËoê&¸ïÉ½Ş¬ú^/†ÅE)Oâjü.d˜¹¬›\"YòÈÊ•‹È÷Ô…f¹ô½al´=Œ9w;Kİ“$¡$’craIµì5î^~~Eº#ÛáøÚ¶œ39ØîŞ¡`„\\5ôü?\Zó^æ}w‰µhŠ™=Â¨€\"zhÄní ëæ©X›;ëŠ”Õõ9AÎã3¢C,R4»‹(\ZÜÖä|KÅE2%Ø—/;Œ6zåœØ*ª•Aaş›‹·ª<Gv»µ‚6o¹#Ë‰H†88ìòÆ4^­}7{hñOce‘\'û’0³ñeôå’7abÊŠ\rÈ\Z×¿…JÀı\rV\\M4Ù»ğ~÷ÈáS2>.H†l^†I“\Z9äÛ{ŸNIŒd‹êº×v>3zô>_±oÖ\\9Z´¾)=~%‡Îd~¢U‚Y²QÍÆ5÷\r×º\\_·m+·&ºG+5zÛ©µÂşãäe‚\"	äÊ“D‰M€f:\0ÆÕÒ°¶yVÏNè%òør=·4ØœöN_•\Z	¡Åv¾å½ƒ§¡éVú0rnÁ™nªMø_q½ëÅº2r®Ö>f\nAR:ê\rÈíSG.O‡\'c³øß¼¼¦\\[yØ’Œ%¥3ÆØè<äş5}Í¯™IÄ¼uñ¿ølëî¡Ù~ÙûÑìü¸ó¨ÅmæK€OúwŞß+×=±ÒtĞ¶l|Æ¾h··¡»f}Âáy¸U!å±ÑÕñÁºX)½˜‹‹ÛáTú-ÿ\0¹Ô¿Òsj²pæà–5ın>d.V9TÇ§ÔE[èİtƒ5ÌÄÜ9_RıÅç¹ŞÙœœv\'îø\'ê2H5’SÀU\Z\Z·ÓË\Z&ÙÇÉåbS±¯‰ù#îoşBÌ‘ø÷ö·9Ææá<ŒÑ`ñ™<Œ†`Ğ•(†Á5¹½wbâÚ5Lù\\,ÔÉé¯Û¿ÚìÉ¹‰~äıÁöngÈ`G|&.d-óåíÛ.d‘H.º/Nõ\\µ½OkÆcª[OûËÜ<‘I!–X8xH—¨·”%¬HÀ“ãzäxÓşLúYm%[:;\'Ü¼ì¹2gä…Ú	]<šºt¯D]bäåzè¾äıíÈ»L˜p.(ş¢¢“kÚçpüª®ìïÇã+i5¯÷¿udn•2se>T´gÄ¶ŠYĞ¸]‹<İ¼Ü`âŒÜ™†Ø”B/æ\0\rzÚÕ­q¶a•cÇÖsöÓßRãE“\'ó4Å0uÚ@ó\r–·ibkeÇ³ìqÛ™…8•øí¸y©Çò<\\Ü¢’$ãeÍı4æÄªíY„a‰# j‡ÇOG×Ê¬ZÃXŸÈªÍû{÷+„Â\\¾sÚÜ±â¡fS‘úvC¨½ƒ®ğJÉğî–ŠOK›Á‘Â²Ÿy¬âÂ3˜Õ™·@öPd6t°&êÃüë%FºË[t(y¨ 2Í‰>9ÄÊÆ%İP\r­ĞÜì;vÛPEê¯BÔ[”§(ƒ&L98‹&.ìŒÄ‘™leE:Ö×A¤±:½zß®GHyÄXİ>–K›r;õ$Ğ³ÄÓÑSr-‹2´³õk`Tikÿ\0…A?OBÇÜóbÉÑÌÈcaµÕ¬ÈÃPt4)l{”3½¸ß}Gî\\i2rı.o¡¸òÌ?Ö¶d{µ½m¹Cêx™x¿I½>V{_ì?î»?Û‡÷­—ÅnÚøÒ>öP,Äu\"×¹­tbÊñ½“ó\n™~jõõ?R=¯îÎŞd<¯^<ª•HÜ—ìÂ½Lyku¡ùÿ\0#|Ûdl•©€ €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(~îÿ\0uøŸlñ2½ì®E¼2£+ÍóÙÇ¡;Øş©×§•Éä}FéW_Éÿ\0üWêş¹ã|m²Eì¦z/Õû=Äu}Øæ¹Í\\	ä„f–™îÅò\'\r×t‡]{Ú¹¯ÈÓmtGÛpü\"«İ“Vtö3æÎÏ}E-ºFbIo~uÎí¡ô˜8ªš´oœ¯1ÉsŸ«är[+1ãH`ØãP‘Æ hT\0\0¬+Z×¡İ‡¤-I“ÇÊLÎ»œ\rUA¬îÏG{…ĞÍÎHU£u©Ô6òØŸzæx¤ún\'cêq~oáEŒ¸îyS)lPÊYDL,ˆ±X*Û[’I=*¸ëy~g=xùR¾L‚VVG$y·C«k` Õö@„õ6\0b\0åá—2ybb*H]Á‹†SjíÚFî¿\nˆ‰nÑ;½?òm¼±9nsÚ×»¤ÈÃÄãxk,¹9™J’ÌYÇöq`ú˜®àOK\nÆ÷¥\\7¯¡Ù“Je®(mÛ]Š;Ùş\\dr›HÛV\n2úŒºù›¯s[Ó\nê3æÖgÃå—ıÛ!!Aˆ][Q­Ê‹öù^Õ³Åì9ï–+©Û<,%äŠÌô]#X®Dvc¨gú)óñÖ¶ÇFÑàsù\nÖ=ö÷íÿ\0îs6;ı±™›2¶>$2Œ4ºîÛÈÊ;«3Wfk£>[Ésï‡ÿ\0$½Z“ŞşÌû-$Ãœãd†|õˆAˆU-¸¼`k  /Kë­vı>ÇÅr<Æ›èúvõû{NÃæ¿o^Âåó?ıá—Êf0\\y3òešiT,’3kØØ[¥EqÒv¤qSû\'gT—XP¿k|‡íØĞúÅÅ•Œ‘-ƒZCsÔ1`t×]+[`^ƒö¼®w4ÍÜ?µl|x²e˜•?Hkÿ\0BìÔmê\rª–ÀCı‘ÙêyÏÜ¶ïqâKÍÈØFë>:‘4nZêÍ±Fà:\\ÿ\0\Zç¿÷ğyüwï××¡ÖÓı’÷>NìFra-$’!teu–è·µÍQY®1¶)†ÕÔ£Ë÷çìó´ØŠ’\0Éz’\"‘pÖOŸVúáúØlË?ÖıÌáB´3O‘\0G<jê]ô0;J›wª¼V]}<¨Ä~èıÅ€*åúë¼²Ü‚X0½±¶§KÔYİ\Zãñ¸Ò\nl¿yû÷”C©9ôd´‚0Ä·º.\rÅºW=•™ì`âàÇèCåy|ûšxS—òD=,Q<¬ÅQ£q°ğüª”ã³µgÁŠ±T—¸…öç—*-ØSc½½V\'ÊEÔX‹+\\õĞ—­¾‹9ÿ\0ËÆµ”z{ÛcıùïÎ+ƒñ¡ÀÃS³v\"Âÿ\0S]ÄŞŠÈö?ê j+L|GgÔò¹>{Änñ«öş“}û3öÇî?mâeaåÅÆs2ä¯P	Œte•A‘I²×RáµÑ\'ûf5){?n‡}}³ûƒíHÜòœo×ybÆwÆ‚KyIq¹ÂZË~ß\ZèÇƒoSæ¼·Ÿ\\‡ÿ\0}îlqc)ãñüÀ-Â&ª£@Ëk;Òº6Áó«™xêj<çÙÏ·üàvÍö§‘1½i1Ó}úî(\roÆ­ø|¶j¹ıç½ãö¿ƒöt9)íî_œöÎ4ëê¬XY2Éƒêé`ğK¾=zh5ÉzU9}‡Ğñy·Ï•mïJ~ş§ç—İÈq¸ìÜ˜bLi³bl®J?ÒzŠà“6ôØ›u+Ôk×^LO²ñÍ´±é2y\'İ¼ƒNñz™©7¦LƒÊ\0|­r;t®;£éøãDÿ\0vÊŠGt`ÊItÙÿ\0V¦ö5”Ğ”C¤Ì®ÒH—ÔE*ê@ÓB>50D%Ø¯|Ã$†VV‘ˆ!­a éañ¨\"É#–4ˆùØ°ddşŸ&d  L·S¶àõ°:Õá¹%&Ñ&fLl™$¥+m]Áˆ±#êğ¨ZZŠËSlÄ÷¦tY8óÍ9.¢âEH±ëñ«;œ·âU¦ ÷—íó÷Éûw7ÅŸ·nÑ63éÈô¿zèÃ›_iñ>gÃ&š²ßo~âğq8täx¹•2£\0g`ç¼GŠÆ½|Y•ıçç\\¾%¸ö‡ÓÔì\nØä€P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@y÷Yû‘Àû\'í<œhò=íËBÉ`H¬?ë8ÿ\0UµQø+Ìçršÿ\0^ïÓı#Ûñ-òmºËåüÿ\0ĞşxıÙî>[ÜYù|Ï3“4‡:W\\‰™Œ“»Å‰mMï{÷¯/v›WD~¥ÂñÕÁ]Ï«4ÿ\0¸º¨şì„QùQ#ĞI.¦Ñ‹¤ŞvÚ	•¸€oß¶Ÿ\n¥Œ4yˆÈ1#i¥¸–EşÚ7ô©î~}«Ï[\rÎI&Vc™r™ú›#PH$yF ›[ÄZ§iìáÇJÂL<±dnÜ3ƒ´-íqØŸ•Jª;ä°’8Wr‚—iˆ.zİïk‹tÒÕ\rw&”s&lˆ%Æ’7†9f†TIäF#fCk.t½À7ªAÓZi©3®º´nDTrY6“t·kè*v—MT³“Üy‘;ßûcŒôŞP»v“nºÔ,\ZË/—“²»WQÆceæ,%±¤áC4¬…ÑXÍmƒ®Ÿá[5-æç©Ø\\6(.RhBÜ–…ÛR	 ‚À£•	ÉÏÉ¤#ºx\0ü~+;¨ß;^-×uµˆİßp]m§S]ÙóüÊ«=éö\'398óJç´Áq@İd`\ZÖS´­kõ¶µÕT|ï2Ëøµ¤j~Å{o`&Z†x±ãß”X“&å\r½‹jMôÖ½KCò/)‘¬­Õõ}\rú£ÌÍ¼ë²ıë]\n©jy7ÌÚ„L\n„6š9ì-Ö¤ÆY]—Š@E†xEÄˆSy ôµØZŞ:Õ-WØèÅ—¬·>ø(²8cuôÄŒŞm ©ĞÛ±6ñªº´æX¢OdÀDªé¶)hÊÆ.mËk^Õ\roä\'§R¾_µ~×tMÇE6_ÕL„ÈU†¦À\0~U;^JíÄ¸*¹µÜĞ9ÿ\0nÆš9lŒ¦\r©%·ˆ¨ugF/#i‰kâQs_`>Şr°Æ¼\r2È\Zr@?Ô/k_©¨x×s~?äQüR*ÓöÑíhåXàf+æC!-Å¼¤kùŞş5_ñ‘Óÿ\0Úo\Z—¸ß·¯jDÿ\0n¤$’è¶¿CØªË|ŸÙrXŞ1~Ó{o+&?÷WPÆÛM‡”\0ĞÕ¢:Şo+÷—íœ&1\ZÊâY£_¥ŸnÒI\"çAV®5S‡“Î¾w©xÑ $ƒ·¥ô¿O^UfE”`Û£7ÿ\0ÊGàt5ViW+ÚA“;\Z%g•ÂÉPA:×0*»V+=FRd{£Š/\Zcò±“p¶ñÖ;îë¡ĞÛ§zÍå¬õ:iÁÉ\rº¿ü;ûÓïèñ`æqs¤ğcA;ñ²‘å\r°*\r AÖı5úu®|·ƒë<OÙÕ®®$ü÷¯»ry¯pgrÑääò1Aë™ğ¥‹ÇÛêSbƒ»tçÚÍ³ôœLj°—´ê<É¦F261Ÿ\nèHÚããn¢ÿ\0*É¸è¾(Ö2%|ÀL{â~‚Ûßªè{U-_CÔâå?œÊ‘s8håÃ‰£[àÈŞ®ÒÌÀ]/r/QG¦¤æÆk/“$j]GÒmæe~ÄŠ´,R`È•‚6ÖõÕÿ\0Ôloÿ\05FVÂÌ <`Ì¾Y\\/Ë­Xçxu.8¢œ¬§õ)ÈZ•¶£8Û~Û­aQ·Rÿ\0JQeÆrùü^\\sÀí$D±·™zÔÆ§Éã§Xg»¾À~ãùlrx3®sBñ2¬Şo+Ø«¡À×V;³á¼§‹­ÓQ£?q¾ÚıÈá~äpQrœlÈ2£UØa®PŒ?ò·c^¦ÛÔ>§ç\\Ş¸×‡Ó±ØÕ¹Æ(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 :sïgİŞ#í´3y¼É¢nQâö¬9VYuÚ·üN•ÉÊä}*ÂêşÒz;ƒnVHíÜştşäıÌå¾áûË7İä•¹H¤ËıND²U\rq[³ZÆİ´¯Í¿yúïñÔÁ‹U\Zht·¼}ÉÈû£Êä9„–iØ½5	\Z¢\0¨¨€\rªª\0Qj®[+£*IhˆØXF0³=ÒÃVcÓåñ­[2XİšEìØn˜Ï‘“\"ÅyqaFVieR»‘€7’-àMcf{<\\{tîiy|‹äe´âb&Ş™:¤_ ·[TV§»ÇÅµğ^%ÉG+ ÃC‘á}t¶€Õ­Ğë®;YÁ??ÖŒ<Ot.ãb¹jõ]E‡}MRªYĞé³S!Îb‡ú¥âÅA.Wá¯åRÔ\"ØuÕ’äÏ|›¼ÓI—<vFW%”B€l@oĞé ÕURùrí(ç”Œ[zn$‚mb\Zı|{Ö‰W*eçÆgg$M,­$1J$·Iå^Ãuúw¥­¸íKXí>fâ¸¸Œ| Ù™3î<‹]„q ¶ÔŒÙEÛ­î*çswì:mlUi¿O¶¦İÇ”‰áŞÿ\0iVPÖÜïåXxî­ƒÇäeWn¸pœÇÈfcŒÄ0Şìƒı(ITu:‘¡ù×E,y|œv­^ÓÙ_k8œqÈDŠ‹—•\Zã›‹—ŞâNŸ–•ècZIğ[;MÕöGé‡³ù\\QÂàaÄ¾˜†$U¸¶à;Ü\0\rúÜWm-¤šsp·‘Ù›„ÜƒÄ—CêÜ‹_µºÕÛ8«…7©\'9æó¿‹ é×­Mlg—\n®ˆ³)¿›QÖ¯\';£(rÜäÉÄ†#’–ïu{½Ô/—§Â°¾÷eNçn?¥Z¶ÓŞŸåÌrzˆÈÄ¨âÍ©ĞÛ¶•ºs¡Éjír G‡z™Ÿ\"ÇS/]|,‚/enÉ{‰‘²íRFÂ{u«&fÖ§UHm¬Ò\Z[¾´dÕ´|õ•\n£7X)îO‡J‰Õ½yıÀÙ\r®l é{§J‰eö&gÜJ«¶àşU&q¬Ccm\nö×å­%T®›‘‡*eL‚FóšØ—ÒÂ©kÇSz`wÖ«CG÷4Ü~fDÊDİ†q.ÍvlêÒÖÖ²½´ĞôxX­İîøgû“÷ƒ‘ã°\'2ãI‡:C›ˆä˜ãÄ\nK°D1ú²2‡I°ĞšæÉ‘Ä÷>—Æxš^Û\Z”Ö¾ïÆMMkìïÜ?0ÉîÉs$åãÇÇÀ—ƒ©x	#éP@(ÊÛm»gš÷¬±dS=ÏCËpn—ÑQ²[í£èßã+Òt<uû®û¼£Éáò}(øøèB~³3]ABO]İK^ÀX[JÃ>}ÖĞúßë^\ZØ¸ß:ëú~‘ç_=ÎægrJìÀIÿ\0E®tÛm×cĞkjÃqõÔâEJÌşKÖÜ„Ë\0#®:ÈÚØIÓSĞÔK\'´¦2³OS{†¯ôÛ]/kŸ…$Ùà‡)ØØ“.A\\†D™,¬Ê@»Û®¢×ÒªâIvVpû¹H‘c*…û¼×7×üªQjãL£y,˜½ˆ=¡{cĞùsïh¥}Ñ6ãaŞãó©Üs.:’$Îø’#£2İ[QqÜÆ¬ã>F¦ı„Ü~MÜîf¸}T¤päÇ¹gÌ¶ñäÆn¯`À|kJ³ÀæñĞïÛî‘öO?Æ“–eÅ.±Ï·–lw:¯^¿ÈÖô»«”|o•ñ‹-\Zhıáà9Ş7Ü¼7Îñ“ÇòP¬Øò©¾Œ5SàTèGzÔºº”~o›±]ÖİQqW3€P\n@(\0 €P\n@(\0 €P\n@(\0 G;Ìâ{‰ÎåóIô0£.Q~§nŠ‹ñ\'J­îª›f˜±¼–U]Ïçã÷c÷ß‘û“îÌÜH3œnÆ(ãCtvRG—ÿ\0$}ZùÜ¹^KK?Rğ¾2¼liµ©âC*B\Z.¡æ:Úç¿ùV}¨£v÷ŞØâ¸oÒòÜ¯7,²dÇ§Äà@\0NÆá¤vèˆ:©6\Z\n¥îÔ$ÕkĞ‹“7«2… kl?Mûüê êÁÇ—,ÄØù<¹Ê‹ä4{çË“dQ©Ô·\n‹~¦²ö³İÃÇJ785IÕ “Ñ‰Dáïôö7jêÇ¥L0lŞÛ÷ı©Ÿ7\"¸drMØğ6DK$P´«é™V6w(¸[ƒn½k³‘mN‹ñUª“é)éù{Šålì‘<‘§Ìö[·Õ‰èîkZWj/w&\\‰\"‰-È¹ôÎ€Üxÿ\0*JîÛĞ…6XS²$	eÚ6u \\ßâMûÕ’9šYd8ëÄÍ$˜óG™L©BJëiY\nM\ZÑ5ÖûZÄ©4\"µQ²MšÕCôü½MÏä×\0«µÜ•ÒEè1òëmÇâ;ÖV¬X,’%V(²V6ËiZwS.Àˆ®~–\'Äu¥i²äŞ¤¹Ë÷NJ†A	+t¸<`\0è±¶µ;NJÑTŸíLÜå˜À¸êÑ®Å‰£”}Âìå‰ò€uştŠrZ–~”ı­Î›g¶°1òDË Ÿ!Ğ€UÊi·M¥™E´=µ¹¯Gcó.µ½šë§Ûó=İísb*çE‰ƒ*$ùvé `m©ï]U±ñ9°Yô7ø9ˆä¶éÉR~‚/pjÒr¼EÎ7$Û”DC÷°¸µÀø\n²f6Æ»’çå¡4Â”ÑCş`~TlŠaÕ\"”ò¹/‹?—Ìó[ÈWàEïøÖI¶Î¯¥U]Lç¤-1RÂ2Ş\ro-÷v=´«îƒ\'ÇßÛC/½Ñ²`Çúˆí\"Nësµ–ÇÀ\r/­ÏáP²‹øéMÇ¸“îxu_Ö…\nmè¸ë¡¿‰°ëùÑåSÔ­8/oñøñıàÑ¤\"©TIâSbM7\\‚ıñéQ\\¬¾Ns\Z<÷»1øüyÉu’y\0¶ !p	/m\rÁ·áV¾XF\\^½Úì¿3Y‹î¾íÄö´O¼¸«4YlTD7Àonì,Ïçl¿ÉJÑØî~\nöã[>º=W¸ìlÎc%‰¦Ëô·1E¸»u?+]6È‘ãbâİ·êşsî‡ÇÃƒ‘RD¨âèC}°é\\Öä.Ç·Çğ×³MÖ?_æoyıõ–,ìÆ„cåÍ\nz‘£0HÈ‘vİ®	c®\0ñ®Kçr}WÀÕÑ-Rı¿sOÄûÃÊ{ÏØyñK—&!	‘5–X+,J±‚Á•€½öß¸¦,õišr<E8œª´¦¯îO³×í\'—~àıÑÅÈÎƒ‹‹‘‚ÆÇÛ™Š¤2–ô“û{Cí¡í§q¡¬²fì}\'ñMUŞ—§Şõö}ÇP`ıÓ—ŠÂÏô²êq±bEv7iC•ú¯¸¿}×ì:šå¶H>—‡Y®½š¿»ö:{ß™œÖw)•Èòx¹\\pË—õ3áeE4;A±6…ìÊo•fÛOU©ô¼~%~’­\Zi(”ÓüQÑü•‚#Á(6ïî(²ŸêÚ÷¸¾¤Öµd:Dév¬‘!’(ö;pÚƒßåV˜8­¡ó—|Yq˜cÃ2A\"ÉèÌ#2‚.ÂàëßZÈšŞT[“\'+õ9†MÌû”ùVöĞk®ƒ¯Z¹-\".NdòÈ¬ò‡`	-{Ûv§ñ£aBèC¡l.H¹¸½;ÜŒ%×xk±Ùa\nÚÉ2ß3˜Lî‹n?7ã¥•×’=™R¤¶şÜ¯{2©[.j)òÙ¹RÈ›İ;Ü$Ü|Yé,“?\ZìW#ôåÊ6+¸%N¶=~»˜Ğói5•ÜÊ™	$ˆ±1–¼.E‡BEOsf	Õÿ\0´ıÁ.LÕ(»¼¬FíoLÁó\\®*Ôı¤ı”}ş8yP}¾÷&fÜiÁâŞFƒ)‡@oôËüë£\'éÛØúşçÀañ;«õ(µ_Š?VkÙ>P\n@(\0 €P\n@(\0 €P\n@(\0 €tÔĞ›ÿ\0¼ï¾oÂû_\'…árÌròæ\\>1£k\n‚™9šv$úQıL+Èççİÿ\0\Zï×İş¿‘õß×|nüŸRİ¿?OÜüGÏ™ƒÏ,ê\ZI´‡­Ó]vü{WœÏÑøø÷¸ìk>‚´¨Y[¹ùiPzQ\r$OŸ ¬b4şØÚBÚúÖmøğ”óÌ‘HtáWEÓ­ÇüvªÛSÔââS©*,™¸ü”ÃLtË@™æ7*eRAØÀ0$_ZÉëÔö4Ú•Ó¡HòlŸ×q±X­õ êøøÕ»˜ÔZT’Mò1]<¡¼;^úÔÑIl¹+\\…NÒnw€EÉ7Öİ«tB·2hGS+}Kr¨·\0ks¯Â­.LÍZ\n‡Ëf{µÙÎ„—°N‚©S/¨f£y6°¾ÅĞ‹o~¿\nÕnKˆ§Ì(7X†s¡Ağ75;IyeÁg#)ò8í1G¤Íi/©¼\rH·QÖ«g”oC`‹,+M(>´À€\n¨°W _Äôª&2ÕU\'·ß\"¨c“eH$”¨U´+$€G]{VµG‡ËÊ”ÛûaîÄÆÂÄ+Õ‚UvŠ)b$„Sæh™”€|à›}>5ÓKÇSâ<–-Öm}½§ øßâaºar|òc6Lâ=îcŠWx ¡m»…€°\"öñµêë\"OVyk­Õ¤ÂøáÄ{ë+&A‘§\Z2ƒ+OP	(X2®£h$ÿ\0\né®IGŸ…j8qöûu3ñŸp¢†vôùC“²úp+9FêÎßÇòíTYkğ,×ñÖ\r³\'î—QçäÄ!³BûÔ9¾ŒX&ÑÚæ®ò£–¾:ö*ûËÌtÅ82`ç¤XÓÜDd!}Rî£¿Î¢K<\ZE«-~]{ûßøf7£ŸD²¿öf|· ƒı.×°µ­Yäº]NşÙ×íù#¤8Ï»¹Peff¨¤ºù‘Ë\0Ût+ ¯ßJåú¯©ï¿[%Rë‰ûˆ9{;\'/6`¦UÇã¢	õeoOÔsÜ\0¾RH…òÛt¤Ş½²xå‹\nI/Vßeñ…öz¬Şş~3;ô­1Wä£Ghee¼.\ZÏ»ÎÃmµ&æ÷½uıFœ[ñË%wv«ëëø/Ğ•îÏºX™>Ù›`/#nâû\n‚DæSßq¿À^¯lß)ÍÃñv®o·Üt·¾ñE^~d6^`Å4Šáö\rÊ#r}0XŞÊµ›¡ÄózŸaoİmTôiïöEÜïÜ¦#<ÃŒÌôãˆ4¹;ªí¹½Ôm½‰³^ş$(®NK±§ş­LUNËØ¾ßøıO1b}ëæßflÖü²ª¹I#Pé{‘}MoÖ°úGoù%¯İú2o%ïé³ÚI—9X¡ˆebVóYÒ.\0ê]jÿ\0RLiãëM#×ãùq¾S†ÏÈ³<ÑgM­\"¦øüÑ™Y½8öî¹\nG{4¨V‡¡×›Ç<´M¯·³«:×İÜòdÍ‰“$X¯!³È‘Æ¦6eÕ\0Ê v\ZÔÉÓÅãíM=~ŞÒ‹‹åùæ3¶T¸¼¦®F/%…\"DpèTƒå7CÚ©t¬£±ÛM©Ähú¯·bÓİ?p¹ßp‡›Ü†G5Ê‚órÛ{zIÒ=Fà=/×^õ•1*(G,5Û*×ÑzU•’÷‘—Î&vQ°ùw‹ú×MNlù}\rZYe¶õxĞ‚¢Ö†ynïv¦hÀŞ$uºŸ¨v×½ª›ÑªÆâO³¬Elpv\\Z?|ï{Ö“WĞÊÔf(%´«êßhéÿ\0šİGÀÖnÒ[\rÜÃ-‘“‘™˜1ìgd–0ÆÃq$\r{ÔÖÒz8ÓYEs{0=m¶§qæ7®§ åX\r¶ò‘¯ó©oP¬Ó1Jº^¤5­¨äçÏXù‘ŒdHT\rÄØ‹i®Ÿ\Z²g5²;(fÇ5ÕX¥ˆì{|ªYåò±Æ§£~ß{Û\'\0ñù(cçpÄz\02)¦ã©B4¿jŠÃÑŸ;ÌÂšgôIûiûÍƒ÷ŸíÆ1ë)ç¸¸^áÇnõTye·„€_çzõx9÷ÕÑõ¯â»3ò¿3À|\\ÚªıB×qä\n@(\0 €P\n@(\0 €P\n@(\0 €é_»~ÿ\0ÃöîWr2®gû—Cc‡ÇVÀÿ\0üÌ†ò ùŸ\näägTÓ²ëú/äz\\#ÈÕ½°½ş¾ä~	}ïû“÷Ş™üœó0#càckéÁ–(ÂÊ5øšñ¶ìú³ôŸb¢¢<å˜}|£$’­÷÷$ê4Óµg\'Õa¢¥Jí÷‘ÄK¹¤k+ƒ°Ö³½»ü^>÷$ıÑ—&B6\0¦öüEVYêÛÔSªÄÒn\0‡HÁ‚İîuµÏCW²:xëoS`ƒıf,¹ÎUaÃP¤h¾Ğ‹Õ„›h+¡êÒë§©¬e:—?Ğ€Üw6>5d¡òÏ¹‡˜[V:t5ÑTyù²K2~±Zu*ÄIµº¦•®Ó‘æm2ä3m	#I½‹JÆÛKƒ¦ß5W¡ZÍ™Ek—müu¬ë©£Ç\ndÎ€”f…–M\0$×ZÙ#—BT9™õHÕI(÷Ğ5­ÛùZ­b¸m/S°ı£ÍñXY¸ù\\¶4yFQç…[Ó2¨±(-¨øšçÈœhzXÖš3t÷‡7Æó|Òò^ŞãÛx›6E‡‹#º€ _Í),Ôn|~UL²ş]L³ætÄ«g¹ú¸×î$pÃ+^(rƒn.$]ˆ°7m+²º1Êµ­ĞŞ³r±°ğYøÀ2\nIº×ôdBv„(£~Ö¸\r{íëV”Ï6¸ìí2cû×1bHy1“Å,lt#@ZìXê›†!‡Q¥efzX¸«±ØŞ\\Ş.«ääc‚‡<…æEs`·VBZàhI$i¥FŒ9>.™&k§»ìÍê»Ü)Ùo\0ÅyÔHYƒƒ,É¡°G£kmÌ¡AÔŞ¥äÜ,>1ÑÂè¾/ğ_³ñÿ\0q§ä!ÂãÓú0¼6ãW%Ò!k5Üˆö²C]vë{5YefWñi7xZÎ±¯çûÁÆ{ª\\|w#›8rÎQşßì·¨­)`jİWrécoVOiçdáê¶ÒRÒ]½=İ½°Î®ç½ÍÊÚL¬æx?W¨’pMÅ˜Å\n|ŒÍceéÔÖNìôpq)Ù{ßEø¿‚õ:s+Ü²âeÏ‹˜˜¹Y rmÛ{±K’~nzßubÛ=ÌxªÒrÚ_Ûÿ\0kğ>àä1p°KÉcâOKúÌ”w,Mÿ\0«Ë…­v»ú@²éÔóòÖ–³İVÓˆôŸ×ò_yg¸%È–W†yr²dO&woL˜ÑÔU˜]	=ºZÔ­ˆÉƒE)%Ù§³íÔÕ¹w/éù-óÑØ¼Œ$UVÛkl1ó`Có£¼šãáÅ«öíñ:{İXFYsQf,4)Še\n²I\"!\'öUJ³ñ½õ¬ô˜ñ7]½ëûjt×;îS‘™“ŠDDÌ¥ÄÇS\Z;êw¹ÜK¹\n»­Ş²jOw:ª§ø¿·Şsã=¯Íò8ù°á,¼zÈaŠhÈ%%d.bWVQk\0HîjÊ’O\'“Š‹®¿eÔã–±B‰ú°NLĞ3¬R®¾­®º€ÅA$­Z ó­mÏN‹ï5\\—Å/ò¬’BnU\Z€ºííbÕYÔô+-I¢–lœ†Y#R\0g7·úH½ºw°­R1»Qc7J¬åD ´¨Û¥ÍÅÏùÔ´g¾u1¶k<H$¸j[‚FÛµºØv?:ªE–WØ¬Í2¥¥e[\0ÉqÓåĞºÖ©|‹²°±aêXí½˜Åº\\üj–9÷É´ñ|>\')ËñòfåKS‹É‚p‹û0\0‰k^¹a¦ªÔª˜ºu_¡Bçc3\n¶¢Ç¯…BpÊ])”Avfİ¯}>}íWM¹8nÍ£ƒ÷_/ÄàòÜ^&tĞbspŒ~O\ZÑÏ\Z°uY‚.>=\rWjÜ›Z£³et•Ôº¹^Â‚B=BİP›iñ­2ËË_ˆËâñ¸Ì¼I¡åàıN‘Ì’Ş0ÅuBJ0eèÀ…Y4ú3ğºv(Ù˜F`Ë¸yn-ğªƒ‘eİ£#c.ŒOfQÿ\0:½Nk­¬´ÅœÊC\0ämïZ´pç¼èoüK,J°¦š•^Œñ³#ßß²?½ö¿î·‰Êç˜½±ï\0œ_/í£ÈÃÑ™¼=6ïàH¨Y>ÖON¿ş¯¯İÔùo7Àÿ\0\'IjµGô  n ×Ñ\'\'æGÚ(\0 €P\n@(\0 €P\n@(\0 €®åùL>‹ä9BOKÇ“\'%ü5,mñ6°ªŞÊªY|XŞK*®¬ü§ıÆ}ÈÇ,¼OZòrpÿ\0½{¦V7;ÊìÄÆ\0D+`ïs^\'\"í¿b×âÏ½ñÓ²÷wòËœÊŠFy\"\0zÌÅSRm}	?\ZånO±ãqİY¦ä4J²ÀHƒF,A»¤xÖvz¥ë$\\q™<¶y_|¿pgMÈo+,jÊBƒæ‘´\Zräßf£§sè±âµaü±ªõ:ÿ\09ËÏ½È`5\"öÚÜµ½+eÉ/BY¦V/í£•VS¦ëÄXu¶‡¥h«¡Zò>d‹Ùy&\\!ı8bYûw6ãç=?¤o…e²YéãËÍzyQãVÔİñİóµ_iÑõEÒèEÛêşuh8sY˜ıPªëu7>{3•4‹|^?\"n;\'’EHğñ6¬¬Î¡‹±Ğ*“sñµck†\Z¨’šiw¶ƒ¸©Ç]dæäf”ÑÎ(†Ó¹¼È&ÃQÓµtÄ|¾„¨YŠŞ–]ÅƒëÓ[ØéĞkQcZ½½NpÏ¸2²ÆÛHêÿ\0QëÒ‹Ñ^VÅÓƒ<k´	<jmãr	©Ù~C·SfÁça€¤Ã¨HÍÕ€:’BG¤{nLÌC”9}ÛÖ\rÍıAzF,	Ü:Ş¥×CLoÕçeòù¸\\oèŒ™$ËÊ\"F	Ûê1ÚRİNÒkÉ§RªmÓØ[7µyî/“ä0á•Lfô›7\nU—#h¸Ú¤¤Íu=ÿ\0LmYFjY\'{>«ô\'E9ÈHggšÎåGid 1R§pÍ×åV²ƒ›ÖnX9ıLßuc`Éƒ\'¥™Ê·¦—rÁvÂ]ÄŒAqr‹§zç½£¾¿‰è×\ZV6şgÑkøöûËû•6>4œ†;`¨–ypr1Şc¾O+I(Î¶7€ğ\0ëV¥ŸC,Ü\nÚÎÉ9ÑJqğF¹ÿ\0~?1ÈäóòxüVcEéaCÇªÀ=5!C>Šÿ\0A=SÌN¦´~¬ÅñU(¨”®ó¯Û_ii˜ÙóO‹ÊÏ¶~C6dBnàª$½í®­oŒ£šôuˆoÜÂ?pCÄğÙÉ‡g3M•,É0\0zlIk\rºşb¥œßOvDìº8Ï~äCÃÈfÈ§ŸcO±¯#K¹·ÃW\"5˜ka´[ZÉ¶‘èãâÖ÷N4_i~¿f@÷„Í…Æâf\'¸19ìC§äÓõÊam‰É1¹6Ô§M/YÖêÏIĞëÆ«vÖÇTœ)›Ûè,ïrE.ğ“œg¸T\rıÖÚ4¹bzÒúÖ­˜©µı‘¯ÿ\0¸GŒş¬xÛòC^,¦`,t\'Ô_¨’:ëP¨u^òº›ß÷+\ZHŒM‘+­#¬q»`ÌH6\0„t¨uhç¶r#Ëñù²Ç+.ìÏL¼ó4í İ& ]¯»g{éğ¤¸«î÷\Z‘ÉbÓ!ôü…™£÷$è	_VÈô(¦©pqrsâÌ‡\Z	2² ŒÍ\"¡½¢‡Ìçq±úU‘KÒµêSd¬…H–0#\'tbÀm®£¯^µs–éU‘¡Y¢ic6Œ\rÀ“Ø,5¨ZU¹hWf‘FğcBÕB6Ÿ¯üjÚ£“ıJè³\Z‘¶FâDe1È¡”\\Ü_CÚ–r¤àú¡$åFÛu«#«C™‘|¶üë6VC3BY=M¶\0ê~5)\Z[©\"®ë–]Ä-‹·ãZ¤q+EÖ×QnõH&×>É%M„h¿…k]Jåä+Ö\nıÖ`ÊH^–&´~ÃÌßILêÈ	œXŞıªèÓ&Ude…®èÔ°=kTy÷rn|DÇ~¯kõ¹øÕZƒƒ-NÚàg2i‹6ŞCfF?šÅ€`_ˆ¸5\rJƒËÍXGôûdû~åı¡öÇ)™:ËÎñXéÆsË¸õñÔ*È{ÿ\0q,ß;×§ã²nÇ±õ®Ÿß†Ÿòß3Åú‡ÆÚ¯Ôô\rz”(\0 €P\n@(\0 €P\n@(\0 €è_¿œßnbpÍ?éğòæœ»«ú‚2|\Z@·ùW/*Ğ¿Öñ4ÿ\0‘Û¿Eñÿ\0CñGïG1?/È¾1­÷¶fbı\"<<pLzö%ÏÆ¼,–Ìı;U{+§Ç¹åNW%…ŠmsØw5T¤ö½\rVi÷¼jP;üÊ¢Úü%61äLAB‘>œDh;t7¾½ë5SÙÉx!ÎB;€dÚ1QrE‰ümjÒ¨äË’\nü\\%È`my4\'¨é}oÓZ»+Ú™¹X–-&àÉ«5î·¶ š¢G]s¶àÒ§ŸsíRv©ò\0:øT>§{ÉØ‘)F\'VcáŞµª8¹9]1ÊÓ¸v\05*‹¿SYG©ló?¢‘í\nŠ¡lºnÖ÷>\'ZÅ³×–«2ÊdEa`¿ô®št<ì¶ÖoÕ_R{½W’”‰2Ô½—DxÊí¿ş£q­–„YãïşØ*uV#°7­8ì™ÊLÅ“$‚Û\Zé-Ç~¢Ô1ˆ0G›#£ì]şB®¬Ä@…ûÔ;\"ißTYñÍšòÇš0\nˆ]ué};ÔÊ‚öÄÓèw·¹ùø¸üœ6q<,‚È™`tccumÛk_Sjç´Éµ1Öé«t2s~ì—?&\\ÌÌ™’A!\"|w	Gõ]–ÂútùÕUM•RP‘oƒî™d‹A›^!UÁš¡@ôÁw=r”®:¦Ûü¬oy^	øè°0¦s»bK\"å·¨ä@À#â\rej®±©ÕT·&Ûøı¿Tu+>FL²Âø¯”ò.¤‹vßA~¤\\ü*j í¶Zµ£+\"å1q¶Àé”øXò´sDÉRê¾¨\r\'[ÛÂ´™9¶7é?oe91G$XR.‘9\ZC/§bUV0Tic©=~t‚–Ææ$ÁÊ{¯&D2d‰¦R=€ÚzİüX‹ôùiU.¸«Ğ£“ÜSlX\ZeÅ[<¾>eVÑXéaêüjaOøÜ’óù¼©ğ¿Cs˜‘–OAD…ÖB¶!·mRÃÄ\r|jU[’“–kr™0¤0ÍE•vàÙíıÅé¡«Á•2îr‰c1äFt*€°Ü\rØ(\Z_ıWùVLï™®¤tÊu39p¤zl[B<-­¿\Z>…±¾Æw“|¿û‰*ŒPÔwÿ\0:ªfíi ıCÂõÃµ”¡½ëPôÔ½JNÈzR‡k°Qu@ÇhkkqŞõdŒrÙ½³r­<î÷bÈš¿ø\\Ôn9·®†,|ùq¥\\…t2Fë b\rÃU6 ßQPìOÔ„Bå9)3^\\‰BzÓ±i\n* ¹76U\0à-Zn„qæºKC^pÒ,’)PÕ‡^–d¥NFßCŒRµï·µÍµ¬îN¬°G`íøéY³ÒÇtËìN_+Îã¡Ãä\n4ñº+Ñ›¡V\"êGÀÕj£SµY8’’RNİT›…ì*ÊĞreJº¢#¹\0’7­:œ·¾„=çi·õhMoE¡ÂîÌEÇAøŠA“¹‘^ìºYOÕcÚ¥èZ®Kğ31ğñ¹3*àåÈñcæ\"7’;Un—PÂããW¦½	ÉZÕèsÂÊpÂ7}ƒà~5¬Ö¢z£íìùq2V@Iµ‚0ğª-O#’‘ú—ÿ\0ğñû©È`ıÚÌöfnb\'	ï,cƒŸÌ¹Øªg…”Ñ‘]OÆ¶ã[fuèÔ~¨øßì|E~.õÖ®~ÏÜ\n÷Ï…\0 €P\n@(\0 €P\n@(\0 €P$ıÎsfS¦3È±Å‘ïôcÃ¬Ì?3^g%îqö„}7…Ç7§æÏÄx{‚NSÜÜ×%1Äâá 6	òªşUäõÕŸ¦àÇ²‰A™:Ë#í*Ì_j©½ì:>ud´:(¥ŸxEÃlå<”†0wM4iê:€\r¬>-jÇ$Æ‡±Å¦Ê¶ºöœ†~«‚İ÷v×½M#nNT‘ÎhWb r$$h·o¡\ZÖˆó/wmN\nF<åB•7¶à£¡f¸ïR·•;”•ÖF¸*uĞÜ‹iĞÔ$tcÉ©×WÙ:°±Ÿ-úhzÕ£¹èã¼³/6vlÙs”eH]‚(UºØ`>U¥49yvÕ#<V»©?ŸÊ±²–tñj’6ÿ\0qû¡yøx¸cá8î8œuÆWÂˆÆómPÌÄÌH¿JË¹¹n_Üj­ô“Õ¹}Í@jC©Óv¦»•av¼¹\'E\"ÄÊû÷pRúµ\nòv7²ı‘‘îş7Ü™ØÜŸÆÛ¼{g,9²ß)FëÇmÂİOÀu5ÉŸ“\\-Osò=©¦÷8Ó±Ö¹ŒÛvÙ§Ä_NàWU^R†bıBHSDnûE¢;€Ğèt«ô8ìÔA1V(IôJÛnÇRºƒÓBu$xÕZgN+ªÔ›,ñ+úÉõP†±@Ö×éùU[:jÕ–‡ä2…[sæf¹°ï¦Ÿ*£f•Æš’Í9ı$˜Û‰{N·€_ê[iSÔÊõ‹1İõj_`,¨ƒ îuÓñ«ÁŸG¡fòãLPHCoŠ5³YÀ\Z)$0¸ÖäZªÍ°îŸS†LğO\0xÖOVÛœY‚Ø“m…QuV]J„•äc½Y|ÛIH¨H´™}ia)•Ø\Z×Ü/¶Ú‹xÕŒ¥—İârıÁÌ`pøi™™Òú8‰;mŒ1šİÏK‹x×.KíÕîô¦7{tD>W~3%ñåß‰0ß\\ €oºÎÎªmÓZ¾;Ê“<ØêÖåĞª9­¬¢i¶¨ºØíó-ĞŞÕÕV ñóÕ2¿\'6l™U¥”²åq;~Ÿ•VîÃò³<ŞAô¹ÓâEsÉêa¼­IÍfcmÑ‹´ˆt¹øUÓ’Õ¼3$Ù`í6\nlÕÓäuªÙ¤ló\"Èo6á{ßxú¾5	šVğEš-j\rÖıE]Ù²OB¹÷#hQıE‰~]ºÁÃ[ë©Ë 2^;‚ùÿ\0\n³©92>…kİMì.~5”Ã9lf‹ç#j“¼€¬İ\0¢³-\\\nÊNyØSaK&>T\'#Ìs@êQÕ—B¬C\ZÑêS&U+¡†	\\ãSÜöªÉ8®‘0È»5¶Şÿ\0:£;~¢‰1³«¡ÒÇÃãS-udA—é±jœ9–„½ºØƒÂºCÏ»1ÈZá¯­ºT½u2³dô€µeft®„—Ê‘ñÈŞ’1qÎİÄ[p/`5­hô\'%“^Ò:\\Û©ğñ­Ò“ÉÁØü<íéŞgUş´ªªÃĞòs3º~ÓûÛ/ØŸpı‘îü\Z8>W&fêD”	A?$TÛMWTxüš,´µ-Ñ¦Vœnl<ŸƒÈã8“?<ˆ$à¤ªø\Z÷)mÕOÔü§%,êû2mX  €P\n@(\0 €P\n@(\0 €á#ˆãyéE,~@^¡¸D¥,ü·ıË{ƒô¯îLL^^#–\rÖÓÕÍ$X|”×È´U¿öŞëV¾®~ãñ÷“‘¢SÎ÷Üò_­Íyçè}\r\r¤!¤˜°)Ñ¯¥½i\Z\nõ9cÈF2Eçş…:r,×éYY¾¿)i\Z<J ½‚ m@=ïr-¯_\Zæ{yÙ˜añ\Z“Æ¤çzT…<™J»w©MÅ-r\0ĞßæMIjSI1ò\0,„€M—Mü¨ˆú›\\oŸ¤×µ¯¨$õ´êz¸/ò”Ê=g×¢÷ê\rªm)¢yo,‘#¤.uì-oÎ«D™Ñ–û†|‚Ò\n°Üªn	·[ÖÕPr_;±‡qõP4:ÓJ–õ+«èfÎ/¿Unà‡Æ¡êNµêf^@ª…]ú•M®|š3³%U2$3yïµÅ·®–·Ã½ëZ­nFYfÉf`ÀyIÔŞ¬Ú3«“*I°Æc‘„ŠÛ…ºh4?:2à‘½úÈÅ™ÛãâoXİøÔ$ãÛ_Ÿ…Í73ÊÉÆM†Ópa:O’¦ş”¤€Vúÿ\0Õ•İ«¤êßjmÚ¥N¾ãXgXËm]Û¯gl:Û^•ªp2Ãrc\\ èæY¨6ˆRßYˆ¶–«¦qØ›êã,*ê„ˆÚ0T0×Ì¨6?z­œšâÊ×Rã#˜nWÆŸ!¤N96+2\0©$ª…P	:NµT»*ıYQÿ\0·YgY©ôYAê\r‰ Øëj„á—­Ó>»…õFä“y\n\\¨&ÂÖ#[Š¤¸9E”ø¶)\"Ş9Kw¸#üë+ÖMk›Hf,şQ²K´ÌÓ»‘êJZì×Ô’N¤“ÜÑSĞÏ/&ª»QBÏä/¸Aåä|¼+jU¤y²˜ã‘›Ì÷*AútÖ«iî1İØŸM@$Ÿôô½UAß†ÈÎ²ho§€$ŸåI6W2DQˆÒçãY¶™¶6¬^OÆòqq˜œ³âK”í6p[Dî··ôïTVMènòRv§©Dà–;¤HË† õü­N<²G™½%7\'Ô\Z ë¥µëkU´öœ–´Ì«$`&ÿ\0[ü»Îé¢²ìFtbÚôøVq,‹Q™ ”ÂÃmÃ)ºÛB-P´4Ç}¨ù›•6K<Ù4ÒÊw<®K1>$Me3^TgêíÖ¦%µ£™&@+mm×]ES¹ØõD7f[ŞæÚ·Â®«\'%îêL‰=[©kXxŞ­¶ÓoZr¢1ÈPÜ¡R,FºƒzÖ¬óù8öØã;H¾]m©={UÔ•®\rëA›„+oúøVVÔ¾\Z3ñº\råH‰ÚöĞ‘ØUènBÚÎXÏªßòë[ÔÆ®Q¿ñ\'s«CXt±şbäòªÒfØ‘M\Z\"I£k2=-ÿ\0*Ğñrõ“úkı{àûóöùö÷‘š_W?ŒãÓ‹äSû`Ÿš]ÜÎ8ôĞüûÍ`ú\\›z=ONWiäŠ@(\0 €P\n@(\0 €P\n@(\nsç7€ås\rÉ‹ö…ër-§çYf¶Ú³lİtÇÜ0y(r0YÙ™Y™Ù·î¸Áboá½xÙõ¯â~‰á1íº~Ä¿Só+šœË—”ââ8ÛÓ¹·Qõ\r-\\¨ûÔÓr÷¤Aı@ë cqVLéÃNå¶<(T\0ÌB­Üö:è¾FÎÚ¥¶,–â;»‘\0¿CÖ ç²‚œÎáı5Ô›[ç§SVHÊöE·4øğf¡\n?bÈ¤y¼„°ÚGKš«FÔI¢ñ‡gY<’›c×wjµN[#®9ÿ\0íÆ¥Á¾¡~{Vµ;±æÑ£\\Æ‘¢MÀ‚²hP÷ëSmQ¾ìR}–Mê±k^Ş\Z^÷¥:ädİömêİHø|êgR˜á##ÎÇ²5ŒµÊ_Íñ7©’Uõ#eJI*¦ñÇĞ°ÿ\0*«“,¹#Å PãÓ\\\r¦æë®ºËZÉ²”´=GÜÒOOW­àµ¥½C=Ôzt£{‰oCäZµí¯Z–¤®\'©\'ÔÚEîEûV6ĞíY ŸG–×Xm½÷ZÕ&[ü˜GÅw±C±MöÎ–¿_•[bZ\\–ô\"¬…^ÿ\0KZÃÂ¡¨(²99ÂÌÆå\r¥ÏaøëYOslrËî7‰ÎåÇ\'-à¥u\ZM¨Øªl\0¬İ—s»\ZÄÙÁÏ `B…:)»Z÷ªîÔÒØ¶3ëÎÌÂP†ëlø~‘m+W&wÈ¦²ÌC]üÌ÷Şİ-SU/S¹V„2PT¹\'Óè¼	®Š-ä–cJ•f	ÜŞÇO\nµRhÍØÏ¿mXDŒB®òä\0X\rl\0éázÆïS£2ÆîÎYäu\n4¬›“³œ™’ÂäØ\rl+)×S©Ìƒ)[amoüª£ê:—‘{”N2ngÊ8™äY¦ãoı–‘>—·ˆñ\ZÔ*U=İË«ÕÛsêWI9’0Abñ/Mªñµ[t‘{N¤ ImT9ë­êİV¦Xƒ\0ö6¿]+7}\r±bh³ÅÆÅ—6Y³4ØèŒQ˜ÎÅ¬T[\r|ÚUkvúºû\n)Ê©n¶ëÿ\0_©çæj¥l“7÷u«Áç_3$Fçmú‚ê²tRÍ¢BI¦Ö5Û^Äi-¿^„êjòsåêI‚Q£\\‚¤X…LË7ÅuQËeÍ“.VNCÏ<ì^YœİÙ›RX¤Ö•_qÏËup‘÷;\"²°â3•%û:ÜGj5©\\ìE™½6o5ïa¥\"Qo¶Ænc’Èåó&ä3&{Lq¤K¢…HÂ¨Ğvj%^‡6HˆD	GĞùOo[ÕUï\0®Ò @AÙR4¹êpò+&áˆ^T(]4ú#$5¾€è5«¦xYÖ§íßÿ\0Ãİ-‘ìßxûFY‹6RgãBOÒäk|ÉÑÂ´dµ}u>7û&-)ú™^¡ò‚€P\n@(\0 €P\n@(\0 €P\nCû‹”¸¾ÛÉgRêÄ’£¾Õ&°Îâ§W³sñWïV}Ÿ‘Ë/¸¦(Aæ¾²HóÈæ+ÆÌÔ¥øŒz¯·°üíË™¥{ÿ\0ÕrEúê~Î–‡ÓÛFVeaJ¼d¼“#.ó4	=ÇıDPÅF·½˜V{õƒÒÁ·jO©o€ñÁ‚‹µB¬`4–×ákë­YêRÖ*2¤I2C¤­b»Ioõ[à{U’1µ´ƒr¹r¶¹sm£ËÓüêÆzñMéBÁ|¬¢Ã[Zö±×Æ«Zù!“åI¸Î÷:Üô5x1L×}ÔŠ!ãçtÜ$D‘Hññj#\\\r¶Ñ¤UM§mú_üªbNíÉ(8Ü³+[¦„ÕV…¿““˜Boa¯PmI4Ú|*l:ñ¢L«®†E °\Z\nÖĞk\\ã[­Û[ëã\\¬×V†áÈ{?™Àöÿ\0î|˜ı§—wL9£‘X«FH´Š·ØMÔõ¬J»:Î¨ê[mg^èÔd\0•o¨éÚº1³›*9%—[méò­ŸB”Pek…^·E«#£±œv6¾—j£öHÎ¯p\\9f7¹=À­`Qè=G¾àÆàÕh¶æÙ&9#\ZÇüZ²³LìÇdÿ\0÷ß¸8>?Û¼W%&/ÊÈ“rê‘±fŒXvRË¡=\rräÃ[4Ş°wã®;ÙY©k¡¬dd‰Ù5#ÌÌn~`[J¹Ñ“$ËjÆÖÜ-oükem+Ö\\‘eµÓpĞÚßZNl¶--‰±Ü‰\0ŸøëZıDyî$âÏ{2Ü*‹ikæÀI*½L°¡]opl-ãY5\'N$”%$ ±·K…gdvcqmK¼TÄtçÉlgH‹c…Bş¤Ø·ñ¨O¹è?TŠ§Û¼Ê¨¢N|IÇ[ß°¨g5½†HYµ»ßÆ«\Z›b»ˆ3	q­üMLšVú– {¨kÖWSC>	q#ÇgÙl¨½xÊ:·”±[¤í ©ĞëVZùï¹3»%î,I¾¿ˆ­jxy®Ú*ËYÉ=ësËv‹XştP±Nã¶µ—dz|w¹2q§ÁÉh2à“\Zt\0<©G[‹‹†\0ê5©Z\ZJNQÛµì¿Ô¤c’ÒpÜF—øßÆµª1whøËêF\\:–RRluøwéZÕJ2³ÜfHÈPF{†Ê©s£6”ò¥!Õ´¹ê-áÒ­]N>NGVcI¬Ñ•2n%Æ¤!sØÛ®¿•^†ĞoŞÎÏ~+‘ÂäQRI1gIR9Ğ”7\nÃÃJ‹×v‡É·coãs5€[¾‹ĞYƒğ«£Æäu?R¿ş\Zœ›â}ËåxÅm±ò<^r<zëé4!¿M,jp¸äWâ¿æüıâ7èÑûy^áğ‚€P\n@(\0 €P\n@(\0 €P\n§>ôgşÛZ:©+3ÇBuşuËÉ´#ÑñÔİ¸üCû¯œ“qÓ3©d)!™¯roĞx\0-^-õ?RàÓiáœ¦eÈd{€Şİ¯©¤|§³]Z+æËŞ¸Ø÷oDJJÄ.AkØÜtéßáYF²zM\'X\'Í(V“h$(è\0ş/C4´>ÁÇeòk“•;¸ø„ù²éäK„ÛÄô©İQ%¯sªÅ!g*%ú—]4µ€øÕÑÇ‘EšIxÖE:-ô6±Ó¯Ê… „“4’HH/yqc§Ê¥† ×=×3*cF­µu\0oØ›|oVª5ã¿™š$ÎNØÍü m¾jÎ é»Ôæ$ëï?Iğ\Z®Ó]Í£ufKÈcKÙ×°îl(«©¯ÔQ\'ÈÙ7nw!VçE½Èè;Zæ®ªdò2$ÅİÔXí^§ZÏ#(ÒzŸc`:›õ¬Mih/Şy)¸åâ›7&N23&‘ÚoõˆÉÚ½@ª¬jf5:ÖZõ}JGkõ\"µÆqä¿s43•hİ-¹rÜnÔk¨:\ZİŠŞI|§\'‘ÈæO›˜SõL¾š^€h¢ÀUa¶EU]Öà,n-j”‘‹†g•Îİ¤(ĞÛZ–Éz#v&Ö#[_åU·BqjÉÂ6p\nXÜŠç“ĞØÚĞ”!#Ê²‡7Ğ­õøUö¦]JGÃ!VÚF·î,n*ÁªÈÏ²ÌºX“ ­áPìNKÉ]%É½Ğ,*ÉÉÁ—©‹ÓV6¥M:Ö›S0‰2+¦„ZÂÕvÉÛÎ?7\'§“‚´ğ><¤€n£u\Zˆ¬[6ÅR8Ú$Õt›FµiX’r°[ÚÕYÓõÓèbsrlu6½B3½¤•‡I$q™3#õd;Uo¥Øö©¶KSäèˆ¸6%MÁ·pj\Z\'$u8.ºH¨oB(‘i¨\"çÌzğªíÔõ1Ş¨˜ÊÎÊ£SÔv¿…S›“mÎ^c²*™8^=\n‰ÑCü+zXñ¹ÒreÊ\0F–7¢İMx÷Ú‰™Y™’¶NVD™3°æ•Ë»\0,<Ä’l¨jî»‹F–ñ®‘ƒ³l´ÀãòùeƒL™#‰æxãaj]ÚÃ²¨$ü*õpõ4…Ü©e1’·éşu)AÏjíeŸš1%g0Å>èäŒ$é½G¨¥7XÛÌ/u=S¹Ñ[& ¬É\nÆä±E#q@ğ­è´8¹zÉ‡\Z uÔ‹êHíãV‰3ÁXRl0ÎÉ‡‘ˆ¬¿§šT•†ĞX²+ú¨éŞ®ªkk.¥×?¶§¦ŠIµ¯·@t©<¼÷–vŒĞÎP;£$È®cpî(y™õ?A?şÆ¾œ>€èsàaÒÅñ™Å‡Oé TWL´~ßÑ™¬ñ.½ßš?|«İ?>€P\n@(\0 €P\n@(\0 €PiıÎfbrY+&É×\nt†ÆÚ½–¼î}¶Ô÷ÿ\0¯ãú™ê»Iøƒ÷8dÁ\nÀÉWo7ap+Ëv–~£‡ÓÇùùh™Ó©½ÌÅM¿+]²Ê\'(©xªİ¤õU´¾„éğÖ±g ºŞŒÒC‘&H–\'ŒzÖŞ¥ş›øZæ¨iT’3#2´‘+Œ€HàØô½ÎšÚÔ\"T÷LeM‰&C~Úuù\nºg%ë,‡<‘º„PÊ«õÍ®Š:-º~5c§^¤Èï:îÄüGo…Dµ”qîœ¿_2ÅöÄ -úájŞ‹B1dÔ£UùµÜzÕ,Ñêc¦íNã¶ÚR¨®DæM ªÕdŒÙÎÄ‚UÈ¿j‹Z\rkMÈú!ÜİÜô®{ÜÖ¸dˆ¸ab-sUL›bƒæMQˆËqÒßøVÒ’9fA¶ä‹ÔÑv%½	º\\¢â¶hµr[Qs~¦Œ¥Ş§\nè§¥ê¡Ê83_;\ZÌYèd…‹’H³¥†šÔ^ÅøòÙ·ûå¹ìÏöîLüæFtÆŠÅˆ]NĞH®kYSW¢=š:ã®ë8GÌÎ//#;L,üw)4)Ñ—FV¥Z™%I«¢jWFT±ºƒ¡½ÍCrÌ´F»‰*:õ]eœmn¶¿áRŠZ§\0,»E›§z²¼I’¤¸9˜RU¬j®ãGÇÒL#ËqnúT+#(ƒábJ¨éĞXTîìVN\"æşk[¨=è”¢½ÎÈù\n„¤«»D¸å\n@Ş5ËZ:AÓ‡9‘İœÜVndŞöo¡ñXƒ ·`|*°+hzUšÄî;Ô£¡YÁÀ1\'­DjU=u$ä¶;[ĞÑB(uvÜK€7‚À‚¤µ¡Ô§–Şk5¸«Õ÷<Ü¸¤Şİ…LË9ÕYÀ–éáW3îr`@¸Oz¾İ	¶„˜gx˜IÏØ¨u$0± ØÓi¢¾†,…cfê;°Ô|¾u¶ÙG.l»\nÈ\n‹Ûên¶?\Z}9&·”p–7Ù{\\\\XÕZFY%›„òade³(ÇÅ#ÖµíÖ‰ö%µ	w.1¸ÈçHÙ@ °Hí¦„w\r:Õ““‹>F‹,1êÅ‡b£\0Şş^›ªÇîv–4ÒeCê\0ğaÀ € \nV2Å»\rNæ$“QTrr:IîØn4©÷çÛJ¢ñED›À°Ü!eaøo©KşJ{ÏË[ÿ\0ó_Ü~ıW¶| €P\n@(\0 €P\n@(\0 €ñ÷îï!ÓÚ§µ–TŒ+å¦\0ƒùW“ä^©WıZ“š}ÿ\0‘øsïY!Ïä±ÆtDô˜›Ş	#à	\"¼ÊkcõU‰ı4Ï(sSmÌR>—‘·8ókş5èVºÇBÓ–ÇÅãù8¡ÀË\\ØDHß«vE$t*ÄŠâVo©Ø›µ%£—ë\n”@¶+bZ÷\'¹&›LF´\'É\"JÖRbùÚ×$\ruüê°½K>?^TÍ;GÇÇ—!L„%Ò!¸…×RAª^ÛIÑjkò«‰N÷!®6…ÖÇøZõ½^‡.eó¥–2ì,†ÊH=-©\rVGdãC¬ù)L™s\0‚Ìêå»ùA_VË¡~>6ÚfÏÄÃí¦àycŸ6Róë,\'†HĞ\Z3WÕ=Aµ­ø×K[r‡Ğb­“QÜÕç[n#JÚŒ®tDÙvßÖõ}Ç*Ç:™RÊ.á\ZÂÖÔèÆ¶¢Ã,|¼l© \\˜±æIKí+(ÖìmcXÙX’²}ßèİ¼ö_6¼f?¹I\ZGƒm‘ˆÔ ×jÜéÖÕ\\4t¬7&V¥qSdÉ¤mPº-È°$şuÓ0]‹±Å‘¯p4=MY=HµÎ+©¿aÚ·’•M¶–íÔè*®Kí“ƒĞ}@ÛSP™K­ìHòØêF¿Î ÂÍô&\0ÑCk‹\r?‘ªdë^Ïíÿ\0pr|%ÊğùmÈb¶è2´üAÄW>LK\"ÚÖ‡§[S%vÙhÉã÷%înC\'œærÿ\0YÉæ½òg°RÄ*€ [Aj­qªV+Ñ.:*×¢5°UØ–º÷QVZõ0İ¹ŸEÔ7\\kVZÌ\'i\0ë§[ÿ\0\ZBhÍ´I5mSËs­úVn{8ñ§ª6ööxàÇ<Ñ©ã$áúáÖâp»¶•¾îšŞÖ¨M7¶u7šÎÎğk…7„b……Ÿâ/{U’háËĞâøÓ¬Qä4orèK´ª¶Â7mnö¿j´N¦VÇ\'Üi I\'l¨?XÒ£‹—*VCÑî:ÛÀÕê`–¤)BEî-}j:²¹R1F.@_\n†ŠQ“Uô±°=¯T;«}€7UN53úªª4½Ç^•GÕI·HÔÜÜZ¦¨ÅÚNHîIVèµh&—søî…úÜ|j(FK¤aŠìÁ:î [çVªf±+?	ğòeÅm¶Xš×Sáå$×Jª2¼>„X 2°P	=¾µ¥jŒ,M^+!Ü¬hv†±\"äv½ªî\nYªõ3IÃÈ—*\ZT=Å@ñ#O™¥Z9my8EÅN±ÆÎ‰ÉİféøÕäÎ™‘cşÏ\"Æû¶–Ëå$ø‚-øŠ†Å³\'Ğ¹ãqy„âó8Õ‘ ÄäLOŸ°c}Ñîğ*Æö[|j­)²Õ¿j7.ƒ)²¤· E•´ˆÛ±I7ësğ¢g&g¹™pxlK(˜£oM÷@\rú|OJ²±É’§rı½önW&gÅo>ÔrX¨*ÌšèÌ?…+«8¹6ŠË=ëû?öÏı¿ûƒã°\nbdd‰Ê\000Ñ*×ld§¼ùï\'—wÌı¢¯Xø@(\0 €P\n@(\0 €P\n@(âÏŞrı©íì¢$h›HeTm¢Á^Kµú€TWå?•²ş¡®K¯gì~}Ù–LyrË Hå¢’T’‹c®·µyØÿ\0”{O×8ñ|ècÓ|ˆZÌIm|IïjôéĞÅ8FidÜØäõ\0Ö°ï}nk•×Smú}uIISÔ#XßÆÖğªÁÏkIÅ%ØÛÁ:ùoÛ¨ùTª˜å³,cÏ’-®„ë¡kë­gjxmòêWI&ö—RßÔµÿ\0ƒW®†Öçì¦‰5P=EµõĞEZªJdÄš4i26·\0›ºVİ1Ğ“šyVÂÖ½rÚº®še,í{ètü¼jj´9òİÚÇéc~šŠ†JfhEît¬¬taÔåôÒÇü|jª²]Ûi\r˜¿Öno µ]-;YÙê[qø\'’ËÅÁ…’)²\\G‘¶ cÓskañ«İi&ª Ã›ø™â»)“Š9RIScfiÔViÉ{ôĞˆ<Àvñ5Ğ¦d|c¸Û[­ñ©ElÀÔøÖVz–ª”a²‹ó(ş—©VÓS7D	*,N£­vƒ,2¶ÛË}¾†Õd”j^™Éå$Ûq#¥Ïcdml¬Ëß_¦ªêú›b¼›µ½±Ÿî¾Kı·h—1‘¤‰%$ÛaµlS}4¬íeE,é½ë»­Ğ ÏÀ“&x\n¶;´n†×X©Úu¢#&)Õt#‰,½ŞoQË-[º\"CgHa0ú\"vÑ;`Ä^×¶—¡w™=H -u¸¸F¿…MŸ¡•¯,æó?¤°»³GÊDMÔê@:Ú¡zY$WupÀYI¶ãÓ_\ZÑAç¾³ØÃ1°ó[ \ZŠ•¡[#suf\0‹ı5/ÚSıIë*I§Ò¾“¸î®Ec8Dúw[N‚«d“7­Qãğ¹QÜÕ6É[PÀ¨Å-úØš5èbªçBâÓ,YBë>ÑèPÁõÜIxT­Ä¡•Ò!$²Ø‹Ö˜ëÜæÎbHØ9Ü,Oj½«©>º’¿HÛòc\"À‚,mß­ªkNã$Å™‰Ş…QMÁ±-sÓ§OÊ¯kÁÍk$¤Ú—FÈîÏ°B<GKƒ­U99²ÚQ‚XïªÅ~­ÕtrÛĞ•nª=!\"Xô;|‡øÕ“9ìš6N3\0É\'¯uU¶­®K¢nı*L›\'GÃ¼Ìß¥Û«¥ÑFñqo)íoÒÃ¥ê@<+¼©„j‡pİ¹¾›ÚîXÕdÕ¸gl{c‰xy#V(ŸÛ-©Sk‹mºÔGg\'£~ÔğÒâaeLV0Ó¤’›ÙRÆÚß©­±­dñù×˜G»?o<»œ4±7–­6—¾ÑaüMtªÍ¨ı¿¡ó^C$`½}¨ı¯@ùq@(\0 €P\n@(\0 €P\n@(ãïŞ–d}®ƒ!P¿ès}g\0O¥\"Ÿç^G•ZUú_ı:Éršõ_©üó}íÈ\'Ş|¶B¡9#ĞÚæ$¯;·~óö>%vàª:C‡Œ>’ë§~Ÿz•Ôåu‚6é&ÅQe$QÒİ5\'¿zÂê®Ø,ıHÕî\0yGC¯]k+×ÌÌ¤Z ˆÔ+’Mê‹_êK»ıëãTl²ZÛÏ#c×h:iğ¦ä^¸™*F™Ôµ•¯k\\‘şuz•µ`ÕìòHw±eè	7¶·Ò®Ü‡lË²Í³P£ \Zkük\'©×Zmf\'@ÖÒ×Û~–:“S¡•é©ğ\0\r¬Ï_\Z¥ÍhlY˜v.‘‹ÉÅ—‘›	“/•±œ1	#]+9—Ğë¤k¤~¦½#ìCİ\r¾9­id3mÁµ6ú…Y–ë\'?\\/Òö#ÀÕß°Ÿ¬ªciwh·ø|j›³nèdRv‘Ğßêé[×¡Tô>Æ§st\"÷ïVl…VÙ°ñœ\'Í6D\\W“ÈÉÏ4Xñ<®¦¬ä b{šæµ’z¿%*·8’ŠhÚ3p/n§ñøÕ»J1ËM§‘…ÛÌt\0Î¡¹îUb–\Z-ºí·‹\n‚mŒ …!®G];Ò‰3Gÿ\0^–GÂàiÖ¦İb£L·ÅÌ|rv;C#\r©*³)]-ÕHê\r«èz´ºˆf|^Pñùg\'ô¸¼ä)ú|¸Ì‘kmJİu§S<÷ß¤•™më3Ë±\"1oI4U¹è`;T2¹TÕˆ*4?ùT×©ÍiªĞú	o`ïßãV²‚)oVr$ƒnŒ5Újµ™4v8¸%\rìC\rkoÊ®e}QÄís°„½‰µªu9]}fºck“à(ÜúQĞzl¤0:WÆ£¾Q§&xå±ê:Š‡hgE2xéÖi¶û\\/•kH4Ş}O=Ëêªll*^¦ªqşÚŒ¦HcõWj•t&äÛ]¦#=Í3\nñÈä+?¢ä1ó:!m “mÇ©ğ«Ñœ¼‹>¨ç‰Æ¬ŒVŞ[›ª4©µ’3­ÜA°bq1	.Çy±nßM/}-TÜRÖfÉ!IâFÙŒ’ *Ã^Õ›°Úš‚Ñ›-{n\'Æ÷ëzÖˆâÍ¡mŠ¡\'wõ’.4ïW06ìÄ‡Wv\"wÛè¥‰ÜI×¶”èRÊN‰Ğ3BÃ¡.—\"ÿ\0•ÿ\0•]jrdi2ëŠär1ä‰¢Şf#VPÖŞ\nô6ÖÇO\n‹I3{ÇãL‚#mÌ¨ºX¤İú›ü*¾¦û\"Š5;¥\\í\Zx’-Vƒ‚öÔôï°°Pqr7£ä–\0èmru¿B;ø×E‡‰Ê»Ü{ÇöùÆ°÷4Dİq¸éÂù@Ğ”Q¯ç]8—ÌòVÿ\0ûZ=Ÿ]‡ÏŠ@(\0 €P\n@(\0 €P\n@(9~êpWöcİò,Ø¸R¸\0Øôñ¯/Ë/ø[>“ú¥ãŸz³ù£÷Ê¶~oëK”Áß½£EñùW—C?n½¶(:£–ªÈã½4DfHá@5,ãÉrO‰×­zuÑ3‰Û©\r\"›|¼)—lØîVXµ6em®	.Õ•¡êuU«U2n#!6ùG×n£N–ï\\¹Ô½M—á&ããÇ\\˜“\näc\\X´r)µc\\šÁÑt\\jvB±·™’¢À\0OjÒÚ˜R²[eNÆâãúDqDæAgmí1ïnÕŸs¡#KäZÑÀfø|kzØÍÖKhñ<W&9$å95ãSäà—[‰r#[¬D’¶Ş/czÇ.F”¥&ÕoVÕ:êk¹(Ş¦Å\ZZÑí>?-kJšeêC–Ò?¦VÅMÍ¼{ş6fInppx:tñ¬¦Y­°´E’GR×ÚkZê<—iÁÆöÔ5r;TYÜpa¸~µYRˆò\0§N†¯ğ9rVñ6–İb¤~@xUŠãÕ’À³j5«=ÌÈ.\0õ+şTpô-¸Û}µî^kÚòÏ™ÂÎq2³q_Ï°3,oÔ¡7±Ğö®|ØUºU­3U+k#FùNK¹İ#]Ù»·=nj{:«w·µp¢äî<Ìé,üc@æ5YJØ¶âíGÂ±ÊïşÒ–Åi[\Z4¬¢]Ÿ`(	ú|=ûU”¶[2ĞÃwD°Üö½ïZ½‡=)©˜ÙzÖ\"ÄõùZ¡Ë7ÑÙŸT¶í@ÀËµfÖ¤o–}¶Ö;	o)¾İt4Ú-ÔJºX·”õ~¶5¥®ô#3\0€è/ş5d¡œ÷Éú6ºİ£k.Õ9#¨Ç3G2íŒívŸÈ6¬êl©+BOé§V;Ğ ]M´íZ’©ÿ\0ı´x2(V¼Š=#ª2Xİ‹ikXU™mjTÅy›•nHía×¡¬ãR”¦ægÌÁ—ı76b\"ÄZö#¨Â¢Ò‹Û­b•fÛ\"¸Rz–YÏ‹,x¿¤Ä8­*™Ô2z²\\ŞK6Ü[AR¬ÍoB½&t¹ÚHµ¿k[{ef›‰åİa™U’âÌFª<mÜÕ¬ä½1îÔØ¹È¸¬ü8ßYğ‚¡ˆd(YKæ¾Í-~•|S\Zœœ‹:-zŸp!’5RòîÀ –øj›©8ÖTl)\ZÙn¶^¶6H-¾IûòÄoyM\0f…O•Šê·ñªA¾ô‘`¢×µ7ÃçZ#‹&¬Åú0øÒç2ª75ÍöØ\\{xV¨ÆÆ\\CÙĞ·O¶ü*çìÑu>Aˆm¬÷k¨:²8ïmMã\n5+¿®¶nççùÑ¢•É\Z/£€2ÉP1ÀŒ‹Eÿ\0Ú«®ê`™ÆÉ.L¢P7“¢0ÿ\0S£¥IÇ—©ìÿ\0bâzØqDÌa@/§Q¯A¯Jê§CÀå8±úö+Šı,9yeMÎ2F	Ô‘}ºô×F©óNò’ö‡®£Ç€P\n@(\0 €P\n@(\0 €Pa÷—‰^oíŸ»øæ„ütâÖ¾»\r«MølOÃçxyxî»45¾öö©ÅÏä°öôÕ]T€.¯{_äEx´P~ÔùV²y¶\\9$ÆúnÛ6@S¥zrŒ©’,Qcú²eÈò±’G&F$’X±ë~µ†XKCÕ§HE¬qÈX<hÛRËÓQŞŞ\Z×føª_r<¶N|X‘åd´Ë‹Aˆ®ohÖä/…ô¬«XrtZ©-\nÈ”ÀÍôŞà‹Üu«É‚¤¥•Wi;¬®WwsÓøTÁÚÁ¯rs]Š©òÜƒ¯^•nˆ·BS²¸ÅFÒùkVZ—®]¬Î$Ê’n\rÿ\0™«ŞBÒ\\›±&î;ÖvgOKFïî.ã¸+9r39,Q>f%ÔúA’ÅIëÜ+’¹¬ÓZ#¦Ù“Z#­ç‹Í#(#i±=µ®ÌmG&‘vD\0Y¬-ŞÕçF@·Qa`E®F”P^42¬!ö ebEíÓNº·JİAÌìŞ…Ş&B…K\"±Ük¦»®zxR×‚)ÔIÁäzŸ@\ZÂ2H$›é}{tªÊ5³‚cğo(hÃ¼†ÂM¬Hï©\Z©»¸µ£S–6!Ç%®É°N+\r×îÃÿ\0\n­Ù¾|8Ì]—qj›G[ëØÜxš£èu+¤}\\˜	’h™Ÿ_í<ƒ«\nhÃÉèPÊ\Z%u‰¥p#UKZúks¡üjH†ÛêLÆ†|%š1Š¦V9wle’ßY¿Õ¯E=ifZ´VîRäâeJD¦&uÁC|jV¤fƒìòùYìB.Ô¸\"ÚÚÄëÿ\0:–ŠÑI+Ö1Ì¡d&Ûƒ)\0¢çÿ\0UU£V‰œ·%âHTO\"+ˆÉkmA¾âj£,–äjï²LåHºÛ_—jºÔæËOSä8êMÛÈÊèÇ¯¾_:µ©%1\"Ñ(’Ê$‘À¹¹ò½:>5M§el‘3×Š(’9	( « Ü\0n/ãE¡iK‰L‰åÉTÈ†5dÇßµäõ\rÅÚG”un»s¡Eê>ı±k‚T(×wmŸ#Fä”ö²I»ÈX#I²Ê²HI\"İ¿ò«*¨/õñÊşiQ¢PÀtéÒ×şuWTÂi³8à¥);Mmw×ùU]Q7º‚ËÛûXäKğÚ<~*ÒWcÙ=‹Âac›¦:\r·uñïüj­”úŒ‘&:+ŸMŸHèÿ\0Õzèqòó?éöF-º›aVÜsZ‰Ñ¥‘@Kt°øÕI¢2lØ]¶:mÊ µ–¤9Øy”\\0NŸ=EJ!´@ä\"êzÆ¢Ñ+6¸z²¶ùQ+Œ(ş–İ¥HĞÜ›‹Ö¨ó¯2nx³´1±h¼¡ØO‰«#ƒ\"†m¸²Fû$-µ:GàXüjİL,ni»#vó¢‚Êº7×Z¡Ó* Ø=‰‰&C$“&È¿QåÜƒÃñ©Z³‹àö÷ÛŒ_W×½ÀTEä›\"öğ¹ì+«óÜË£¿jñ7·ºy·,düQEÿ\0‰®ÌGËó­6;:µ8E\0 €P\n@(\0 €P\n@(\0 7¸±×+‚åàuŞ’bJ<FÓqYæSFpZ2UûOçßï§/\rî;D‹éH³ãL¥wy!”²•7ÓB:W‡jÃ?Yñyş¦?·sÃy+úG’Å(ád2*m{ô#áØÖÉÊ=šÑÙI©®4­öÒ¡³-ˆ\'á¥RïCÔ¦•FİÀğOÈ¾ZÆ¥ÅÇ“\"R«ı1µÔ€x~Uçäq©·ÔÚ+#ş¨fM·[POj½zÖÒpKcé‚YÆ§¹ÓÃÂ¥2éIVæUmÏkHC{“økZ+&Œãæ+²C4…äP/ NŸ-*Ë¡¨LId³/”ZÅ{ß­ª› :I ÆbeEMì:ètùÑZHHû)åÜ+y¶¿…E‡wÁ6IÀªt¬éîĞ‘5*$ı[¹õfÀİ¦÷¿[Ş¶ÆåG&“fÌ0áÙN§áøu«½5¾FY)ş |\0¿Z‚–i#dÂöÚ<H- ó)mÃ­õ¦óÑö6N«’o)`4M4\0^«k\ZâÆX¿P¾£‚öğÒ¡\\ÒØÈÄşŞİ–¿R:x\\›Š+|\Z\Zü¸’ÊJÚÅœi§K\\Xüt©v+Š!ãF;1DU+c¥é­»ş53(£ÅÇƒ„#«!&Úyô½A¤²0âäwşè*ëå‡e·\0{è\0\ZX~t’S3ÍÃH‘)\n¾šc–¹½üj¦ËC\\“3í’-WègQâ.A&şz™ä¾°Htş†ÍÌ¥º‡ú@èªVö¦âÕi\"¦^=}Ñİ€ ¬…‚Øt ‹èOKš2ÕÊx¼s30(¤3 »³–ğí{U`Õf’tüSìõB–ÿ\0¥E,—îˆéVLÆïv…|\\DLÛ£1ò“s­õÜF€wéVÜb¾SŠñy\0ËvXßhk©t5\r£¥E‘l\"dWz30\Z\\\\ÿ\0•\r„g»X`EÆõ^İA?\n¬‡2XcãoÇv¥®C \rŠ.&ê’…Tt=ví\0uSq­ê$ÉÜ·ÆÃX÷lFGµÂƒ¦ltµCdKeƒb»f,¨>5iøñ¬£Ë~¤i¯ñğ¡[$f“¡Š6{Æ$Õt°`<;\Z”cjèV*Ş@I;t¶‚ÿ\0ğjÓ¡Œ>åòãá.’<ëë³L{JÚå¯ĞUL—IìcÆ†\ZV’eÇ1!uVî°\0(·sS&[5Ğ–ĞÍ$Œ \0ˆä:jMºëSS;¨Z•åIrO˜`kH““v¤ˆ[%$KoKîCĞƒÓB{ü*õPVù$°àğLH¨ŠÈ,×¹$ş\Z¹Ì›lİà„0d7[‘¹‡J”qå®¦áÇqû’0È\n\\èM­Ğô©F6¬jopànYÔ¶Ô@¾·,<t©ÚR×ĞÛ½¨‚,È e½Ôm$UÅ•5Ñœ™ú6{[ífbÊAB‡ânÂöü««ó¼Û£^ÅÇ8şÛÃ\rmÒ¼²7ÿ\0SŸğ®¼KCæyr|\rÂ´9E\0 €P\n@(\0 €P\n@(\0 )ãA4D\\JŒ„ê¨²•ÕÃ“ñk÷Qí¦ÃÊÊÉ	¸âf{G¨–×æR¼\\Õî~àsnÓØ~mû£…x²cc	I2Š´gik_QğñªUŸc…Á÷\rr¿YêbFd”F*“º=ü èÖè|oYeg}z\".O>äaHø¹+£KÌ„¡aåññÌõ5­—GĞë¥Ád2$ª“p–ı{ÑšnH.:+%‘w)íñ>\ZÕdß\r¥œ9C‹·±Ã11/ê”)/Ü\rMÅÎ‡­J±ª¦º™fá™8Ø3å‰ã‚BÉÎ×t\00V:1[ëUú`‰¬Çr«	\'‘¡†õ‰¥\n|º »Ië§JĞµºbd*¥Ê¹6\\½/Hƒ–öÚÌŒ$m»ö¤\rOá×­Kz|{&]`áã1Q3‚\rÒ×ÒúÓ½ëf{Ô¡Êq8ğçOÇ4p=høÏpÊm¨5­/S•Fë-1q\"@»Øu-k Öàécñ­¤ó[.ğ±àmÛ6ì$İšúü:ƒàÚğñÑSs b4g\'±øZ¡—®¥àÃdÇ“%c´J@i\0ò‚×°6ïXÚé³¦Š½R>7:8ø³°äãbÌıd[I@>‰\0€Ëpu×ùVw®è,ğniÌAWM\"°‘……®ÀXüonŸ…]I{A<qàş†ûÁÔ_·qWVf[L	†²Ëºà¨ë{[áW“Ÿn²cŸÓM®¦Ãå®µ2C3@Šº;*±ê]-FW¡òäxSqâ*Jä«íé+¨ÓÆ³rtÖ«¬•ïÇîq\" y\rƒ6€ö«¦gjÏCØ{PÙ\n;/Ô‘I\'c‚LyË¼l®ê£¯Ä+_ñ5cš!˜`ãå¸HÙ„jÂè÷s{èE€ÿ\0*6oE%ÌPÏ`QüÀ[_ùş5Ğalk±ò(vb|Âß/«§Ê¤ÅêK‹ÓÅ*fşò!HÚJ÷\nMíz†tVºA\\(rò$—géãv>Š–ßµoqæÔ\r”&Ú¤ãáSäTf>]ånmáS%jÙe&1HÑ!Ñ,ì@ı¶[^t¨“m®	©Ç†R–ÓR|/Û¥$§Ó\".9mX‚™l,~:—ª)0Í’Œ’]–bJ•+`×÷ï¥PÙ¶ˆjá—r‘ÓR:ÜxT”lÇ‘.VJÃ“™bÅR˜Ñ±ÿ\0¦	Ü@jJZeP Ø¸ÕA«#82ÎJ%ôÔø÷¤õ\'CêBİ£ªô7ñ¨ ”ğî¹Tµ»tÒ­VsäM˜WŞm·6Ó¶•ªg#¤SâÛ”ë·¶•¤£\'Y/ø¼X±ãi&&ûO¤@¿˜t\ZÛ½CdV¥æ$je\Zÿ\0À\Z±Ëu©¹ñïlXè_×ğĞè?\n&e•EM±Ê¡`Ä:º¥Ô ùŞ®r.†ÿ\0íL]ÎĞ°¬Mˆ¹½ôïaVZœ9ôGµ>İFhı0Y&ÉÆ‚-©ò\rßÄ\Zè«ƒÀä­ß‰ú?ÃÃú~/[d*å]Ôè|¦g7e•XÈP\n@(\0 €P\n@(\0 €P\n@(ÎİŸµDÑûD†Ş¶?ëv&ƒµy|šDŸaı‘§Ü~QrQåÉ‹‹:ıqFân\nîOSuô÷m<+Š§èJÑªîTğütñ\'#D‘!ÈÜˆ,UH¸e+¥µ½ê¹Ìw*9.?*L¹\0e‰ci#Çb›\rNëé®hÔìOMN¼äp×|’Â€»”!°\"äŸ5ÿ\0UlË#IÉ…Ò$›Ñ’ûº½ép;T=M(á!pÎTİG_ÆíĞT4t×)ÂY21\'c¸cnºú–±`½·zµj»’òWâVŒWmÛÁ‡À“féÒ¬Ü42!XAV[– ‹ÒÀu55re—]Iø˜k˜¢H[o£cµ´ë×­…YèF;í-#ÃŸœŞë\'ÓÖı…ëšÈöxÙw¥ƒxPÈÑ“õtíáÚ¥)\'“–ö,V‘·Ø\"¶— 5‚º“ã[#Ì¶º–ø±Åv\0ÇB×íVG-›-#ÎÈ¬Äm¥A×åKT¶;¥ÔØÓ—ä$Á~1%VÀ‘ƒÈ¢ä¡¸ÔÚÿ\0\Zåxõ“³:Näµ ´E˜¬«õÛÃ©­v‰Øª·ó$ÔP6hš³n-xÜIñ²ıléMòpÀŒv7½şwñ¬UœÃèRÎÍ5¡¯¶*‡}«e\"ìo¥m:ñ‘¤ÅØÕÚ-¨ üjÉÉ¨‘hÀ°Q}lM\\ÆìEf\ZZ×ÓM(ÑZ\\´ÄÊuÏ•\rúüEgvvcé$ŞSl&H¥*å“Ô· ‹‘¦à:Õ)iºº”k‹ˆ²ÉeP§Mmãñ­^ˆÅkbë‡zDZ(„š—ca§ú˜U&N°Šü¬T€®Ù¢÷`ñ¶àkô±ø\ZºrsYOb‹j7›qÓmô Î¬Vµƒ‰]î<Êu\0ØşèNã¤£v\nƒ¦£À•Y^ÏqÁ»\\«2«{|ª¦ÕĞ°\ZééèzaÓÂ…İÙs„Ø±r…6ôˆ®íİµ`E¼j¬»–´+äMÎÌ×\'ñ¬emYÈF\"È§Å¬t4-\'ÔŠş¨]UG”üÄĞˆ1C³0¹{åé¥\n÷2K–à½¼?*\"–©¢*ÛÆ—şj´™ªjLÅA\"ı\Z­ÅÇCóª³D¤û!U$ß Ö¥&cv³4,°,§«fıHe\0M¿‡Zİt8îÉ°c#”¬l}5İ#ZàÔŸÎ£¹TÑ›|OQÃ¢ApÎ	%ÚıZş4«ÁƒeæN÷ÖÃÈ£KÕ2s\\Ú¸EÖ”È@ôÑ¤{kp.uüêÈâÍsgÉ_ïãú\'q1,?ÒË©·şP*Í‘ZÍNÏö´X ôî¨âÉo©TXƒâ*jyÙ´g»~Õ`¦o+íŒT]êùÁÈë¤qõ6øµt®ÈùÎCÚ¬ß¡ú *…\Zå^‰òMÉö„\n@(\0 €P\n@(\0 €P\n@(çÜ·#äøˆ²‚^I`Ÿ®ô ù×&¿‘ìxœÎ¶÷4ÏËˆ}™‹C“Fóc«Îº‚ €IÅZè}ıù-èûšG9ìÜ|løqTÍ!`åF‚úê/Ô¤\nÃ%`ô¸œ§m:â2}A&+[#¬ØÄø†R-Ğ-Ş¹lsDÖ§\\rÜ_¤²¦Ã¼û\0I:z•Q&‡7\Zìî\n¡Ük\rEºş\ZÔ ıMo\'\rË¸êÇË{\0x[­h‘•rjDLR¦ÎlÖÔéqn–ğ¨z\ZZgCì¸¹_ÓØ³è½;“áQ(˜…&)8ùä]û\rö±½ô°ü”ORõÕñ20¢GÇR²#rlHëÒ›¥n’ •ÇMŸ,‘Á$ÆŸıÕúTõ Üö¨²MÅò2üâÁ^¢L1sÆú‹}n·ÏÆ•©^FYg%Å,Xâ_/MMü]OC$˜Ì7XÆÀiÔtÓÂ­%\Z¤°7)Q­­Ö§q“¤ê\\ã*Äß«ıW°k+xœ\"t‘7¦¶cÔõª¶sÆ€.û\0·µÚÖ6©l¥I‰%˜°,\r×©SDÉ©\nmy]…šàãU’ğB—™IÑ”ş\Z|ªõf7«)eR¤ß è£Ë[#ÎË&ã·šÍºç¹è5Ö¥™ãĞ•RçÔú~ª4vc»FSäÚúÜßùUUu6µô1#í”0[í6añ«4cW©%™ˆ\0Ü}ÿ\0.ÕD÷4DŸrÛbî\ZäØ\\iVª+{hb\r¼°µ”\0Ëóÿ\0µx9÷H†5½Ûú˜x|­ãBR>OİIA¸ÿ\0W[|¨Š]C3GÚè¤‘ÜõşU•FF†Örš[AŞ…İZ>£\\ğĞÿ\0–”),•#Ê.âËb¶¿åRZˆ4%YĞ†İÅ´¨“GSä0•y‘‡•°=ïPÂPrXÂJ×[)>RKÔ¦Qè3¸$ö\ZßÆ¤¯S\"@%*åó½º˜¡Mô±!ÉÈdÛ.Tj[ËĞ•SkÑ6Ò(2Ø4Ì«ãån^Äÿ\0Ê´©É—C4Qnee×â‡Î®kU²[4¨²*» ‘v¸Ru¾µdŒìÚDŒXÉB›v[wøÕÙ‚rløÊLws˜ì\rB3¿Rß…DÏ¸ıBlbNsm¥~ãW““%t;\Z78üœÒ&	¥§ú­€·CkÒÈÅ9¤“íœ½³ãà¤³É$ÅÈBúùÕ“ƒƒ-e6~—}†öô±òœnT±m\r¤kv’Aa×à;Wf%6GÊy<‘ÑİÀ®ãæ…\0 €P\n@(\0 €P\n@(\0 €P\Z_¿ø¦å½­ÉÃx×‚ş1êGâ/Xç¬ÔêáßnE=ÏÌ¿pğÿ\0í9ù£ çÔiâr~µs}­×±µy½÷˜/õ(·iÍâŒ<N è–*Ö67ñëYfèz\\GóAçY6dÍ¦İ·ÚG@/s¥q³é1hiSâ†‘½M¥wètïThí¥äëşwŒ*º&ÜufØ¬\n®‡ú;uªW©Ôêš4Œî&eFrªK›*_±èn•h`¨Œc¹\rãBvÜƒüoFjá/Ù3)×@ûwÒ£j-µ´c—f‰QdCp Øø50ZµÚraÆÆ0lMˆøøTmE÷³âÂê\r‚››2m°:˜+¹ö>M‹êÍ®„õé×Z•¡Rq‰<€ê×ÀZß\Z’´Ü´,\"ÄÛ¹K( i½ª²n¨û™·ÜU‰´\0ü/B­A(â7,l4Ú¸ğ©˜’(”«%ÒúU]K×.°Md\0—VmzÜ_ñíT72Â.×W$\\Zú3¥U—¢’pò£\0!ú®:x*¦ê§9ŒŸİ#!_jÂVÀ%¾­×ë~Ô)j3ZÍ‹dŒ5$ö¾•½Yçg¦¤#ƒq}ÚiW9Y)VXüÃÊm`G…C7¢hâI7\"ızT)f5Q¾áîÕñğ¡U]Lò§uk)µ¬5ëj¢:\Zõ#¹[°&àék|?]ö8&r¶Û\ZúÜv2Qc%\Z(\0Ğáñ¨f‰Š) ”ÕqÓ¥ªQZ’qcU;¾—a ğéÒªÍ¨‰yĞ$.Ğ¤±Í°êÆw)¸\Z\\Û¥ê&Ãh«†XµÇšÿ\0Kf{\\\\–Áq6<†)T‹£Õ\Zš-±©]4Í<à,\0goˆèjĞC²e†*,’¨iB‡ò“ÔXucU%=9qÀ“JN2\"ŠCiÀ°kw±ÖÕs&§©ö(¡ô¥vÉ	 ¶È,I{lzTÓDIï\0N®íğ½\n·‰6•îbÃq·AWª“—=Ú\"B¦g%†ÿ\0áŞ×ş¬B9¥Î2zNK€\rT²¨Ë1I+ş›y†ãc0ˆîH­(sr:œxó0¶ãÜôò«³i©±	&:%Â–ê6½¨-l>ÛÄl¬øÉ&S3\"ƒÜh:ö«×©ÇÈp¹eˆúÛBfD§º kò«¸ƒ‰¶Fı±öâóä Æ$iŒW–ÖTØ©ª–y¼¬»h~«}±â¢ÅÀŸ*0,aGÿ\0PKşb»ğ×VÏòY:WâvtH €P\n@(\0 €P\n@(\0 €P\n„‘¬±¼n.’)W ‹\Z†¥A)Ã“óÛîo·×ä3±ı\"‰ígRH&ÚXi^UëÛp3o_Ï\\Œ)è\\i¤1»ÿ\0HS¦ëø^²¾ª{¥¤ètqG‘’Ë¡wHGQ­®?\Zâuƒè±eM&u*…#ó¯Ókvª³³šš#ì¿”—\n\rÀ\'S´^Â²=%ª)àÅ\\ˆÈdŞÄ¨Mú~&´“-­2¸)ÀmIS×åaü*4t#œr\Z®İIülhÙµ*`È€úLÊ…ºù¼M»Ñ2rÕ¥¡(e‘µ¶§Î¬ÎljÖêd8¯µˆc¥º-­VMş™ñpå\0¤­ö³\0oşu2OÓgØ’ÒFJ‹_Î~ë¥CzJ9-¹qàqr&ñ†gU6V?ÓríYVÚšªÛnª\nY¬¾¥Íü\r€øë[IÎêÌĞF·µË²ş:2Õ©f¸@Á­pmñ½gõ\r×=LÃzv$†µÉµê®ÆõÅ\n¶\0…_¥H=\Z‰’vÁÅ¦\"è­p-u=oó¢Dnf7šM‚èH>5)wf4Û#ØÖ\0•ğ«IM²bšÒÚ4Ñµ[(«\'¡†L2Ì>›)!¾¡ÓçŞ¥9?(7üH:ş5!2Ë$‹\"]ÑF1À%XØµÿ\0Ò;š©tõE^T‹r‡¥pIccáj$Mì‘…}5Ò2<Ä_M:UŒ”2Ê—ÇHUPŒ…\nîÊ	\0èN¢£©mÁ€õÛê5èj+Vnš ¿AüjQ6F/Q‰Öû¼½~?L;L¡]î_†µ]¦»äûŞÊv‘pV§¡FäâQ\0rÎ¸ê.zŠ”Cf!›@<ı\rü*LŒ’²˜–×\Z¤Ÿà* Ñ=Š]Ø…w[AÖ¤Æ[e¤Xs´EöD%u°¿z«fí‘ö*±i5ºÜéÜU{8#;G&†ÃÊv›Xz\n²9®ä´ÂÇÆ\nş¤‚‘±QÖät]<M_q’©É¸Ú4·_çjUÈ¾‚5%–ÄÍ¦–íZ×C‹&¥Æ\"*æ¸èÃãÜUK\"şV\\h±™¯32F4ØZÿ\0áU6M$mœ\n¾RäB@÷[u÷WGmtf÷í®\'ÔÊÇÇëˆÙBƒĞ–Ôî¿Ç­hÖÑ÷û#íÈÖo×4 :¼iÚ÷Ú7iùŠß{Ÿ9ÎÊú¡Ü&\"áqĞBªãqÒ×\'½wãP‘å_}ÙmW9Å\0 €P\n@(\0 €P\n@(\0 €P\nÍßzx#œèÒåĞJÖ\ZùlùWzÃ=ÿ\0—±á^vÇ—;2Å+¶¤$–eĞè,k‰£ìp¾ŒéßsG\"åãåEfÅË¼N\0¸#£ÿ\0¤Ø×5ëöø·N½ÑÔÜ¦‰¦]\n®.<+gå\ZnÈ.Š¥Š}\nº|k.‡¥E¡@ûñçŒ•VØGöíåÓ±j²¶EfTË3¹ØªXÛn–ü*KVÆ(‡¨R0†F–ÊŠSáQÔèOn¤¬<6Ì–LX”3ìfe$<Í«[¥QèMòUWR®h}*,å|¢Õy’‘å_QüÚ[ğğ©}\nÒòÌòß Ü«o3\n¢:nˆŠˆ`If×µ­ñ«2”pÏ·=-·‹£_•R\r]¤ÊÈ­bØ‹koêÕêRıxŞVpÊ\\\rá­MÌğ­u678ÑÈ’TP·\0	kkkv½bÙèÖ°µ>æf¬ó4’Â\ZÛU†–°ª¤F•EcK#8$…²)>tŒ]&ÑkØ7Ğ«­ª`7(ãaµ‹ÂÚÿ\0Î¤Î‰d(P³	ZÒtS¹¢Y´6V½®z;Š”ÊßR‚æÍoÀÿ\0Y36c« ÙÔS¸…Y®Áv;F–cÓNÆªhÖÔUå–•|¡}0u^—ÖúŠÒ§&g\'0âêö#B\0=mRÌñ6K1 m°?Ãäj\r5dœU»‚uKy®t?\n¥ŒpYòÑ¦.ğÆ0\'2õ÷×Ò¡ç¹@bÜ\rKt=+CšÖÖ‹¹ú_¥úhJ‚Õ%Ä’Ë(ÿ\0§o=D›$asÕvÁnmjQK80DÌà’¤ª¸ğ©1™%8\n½.Í©$\r;\'c±$¯ÆıÍI†èeì<ÎD|ØP²¤Y„6O”]¶ô:€?Sf²]º¿™õF³>P\0v=@é[Vš3|Æeİ#.õ³mº\0>kRÔ![I/r€-bAëòªªÉfàÈÏ}½¾‚ıh‘•¬Xa*¼éÛ\Z4oam;^¬KÉm€µ£PX)írz{ÕÎ[£fÆ‰^XÌbÌme\Z‚İ	üN´:çÇ™(şÒ;AsVG[Ïí-&8ãmäÈ‘¿[¹ü\0­*3‘x“ôCì¿<z:ê“1şUv¸?’×V4|·;$Kô=t\0Ph\0°Ü|Ã>Ğ\n@(\0 €P\n@(\0 €P\n@(\0 ‡÷‹‘â<ñïtp:íaXæ¬£»‘Òççw¼xA‹6|Q¡\0b±½ÉCå$Ÿ…y¶®Œû6YkĞèëåafãÈ¶›-%ÓÂD±ù­sÙÍ}Ì÷0­™ìÑ×\\¦7¨¿¨ÛqİGK©Ö°hõñßn‡YÉ#cç³4bD-¨µø[­`ÑìRÛ«½È¢4ÎX`-P´.ë¡­˜T£C:µƒw\rô©v/L­ÈJìg‰ßÕSb\rû~4LÙ£ªÉ!äî½Î½úßÆ¥©!89Hn…•Õ·\0ñµB&Ú¡ÎïbHrlAøŠ»1¥!“¦7DF$›yl-+5¡Õn„	ãxÊÀ.áp?—øUÓ1I€Tn·Çµ»ÜVm5‚a‡tE”ÚäÛKkP¦–ªh‰eîèI°=>ufäÆ•ÚNbDBMÚƒ`:ŞŞ5œî#É)pmS0íz´vløİGË[÷4+&XV&aênUb»öÛu»ÚıíR^¨å.ÅìRè¬v3u·k€:‚^ˆ‡6æ*ûOöÒ÷=\rIC˜ˆK*ªÈ¨Ø»h¢ıô¨ŠYdOJi`Ş²*¶Ñ\"j¬F—ÀÔ°ªàËŒf‚Ep‚ÛH]ËpChH¾ô4lµj½E¸¿ˆïQW©l•”W4 ‹jÆà_CZIÉj$Y`á.D‹”Vk\\„ßÒ’Di`½Åöl>åI,êd0Şœj6–°·ÌÛRhËUspdÇ‘â‘‘¤\Z]áÿ\0ÒFŸ•BĞ³RŠÉ#rªXh;ü>~5s’ËSìÿ\0¨ÀzD\0	\"İÇó¨f•z–i›éß6I_Õ3ÛÎtµğÒõS¡%Ô«š2‹*±mPÂ¬µ2Ë]1(×Ğ¥Ïò«3ª	Œ§h.tn¿Ô¶ˆƒ!kÜnú]ó­RGk9%(×PÖ;ƒ\rakTF¥Õ¡SNC\"ŞGE› ò­–ˆã»–Ya‘ÆÏŸPÏh	:ÛMk6oK(-!€H“Êî‹°n`O[‘e\0Ò¤d±HB‘å¾ßJĞçw/q¥xÊoÈŸHšö	®¤Ô‘¥Lµ‹X–@€p©­µ½ì?µ&S{á±£Lyr?é!»¬E®\07©FWm­ÅÁÅ—şƒ­æ#·À0^İn*ÈâÉQè`p²É<K–‘£ôâ=Hy<¢Ú—&¶ª<NVTÒ_´Ü/è±çÉ×bßÿ\0(\n-ò\0şuÙŠºŸ%äsMU}Nç®“Ç€P\n@(\0 €P\n@(\0 €P\n@(‘Æ\\¬,ˆXnÜ¤¨øEVêQ¦+m²g…>åñƒ–•ÊmFÚìŞ6í^uÖ§Ùp¯4G“9ìã¹‰e\0ˆr,³ØèÊ£ø×«µŸQÇÉõ(½Q×YcÄœ¶“µI—\rúô?â\rcÙ£Õrİl¾\'Tr˜k²<Ô$ÌŒAèÀ‚fëÜôñ_±§gÃp[¶»¿Îõ´g¡‹æD\0Ğşpa\r+0+8$m¶¶·Æ¨ÎºÕé©I$Îë&õúúßşU)—jJ¹ã tsñ­S9ì¥œb(®êXßÀksñ£	Á3\"8`\nc&] —MEÈ¹\Z×µT¼èWI2z@{‹(·j”µ\"×„B·9n€ëğµY™Ñ¶ÌèÛ7.ÂI¾ÍPèZñ3r`t™B¤‘.á¸ÀŞÿ\0V ¼Ê†byƒJ]ş§bXXßKh)R9É9™\0qâ4ğªô/ØåÛµ_ë¿Ç¥ƒ<ç6ˆßÖÜƒÔ$[kx|mV‚\'ÔÅtu\r± \0/­A)ú]ˆ»y…ôA×çB¶}ˆŠ¶İ–¸¹=¯R@±˜%Áş•È.ƒËmºxÔLçëùÀ7Ği}mò©êJ²F9f €tÓEøQ\"—ÉØ:‚›Ôn~Œ\0¯S	ıD.èQ€Um¾c ¾‡ò©dcM˜¦Su²¨¶ tµU3K£b§uüu£&¤‡W(RÚ~V4Ddn2DîWbŞæáztë§Æ®rjÙÃ+Ÿå‡&²[Ì<¬@aqÒıjK¥İ0c†ˆä‡*Şíÿ\0Ê:iPÑjäO¹òÇ.H4´rÆOú|M»Ò¨®[´ŒQÆí>>_¿\n’µÕI†¤ÖhUêg‡¦‰ç1ìïr/©ì/¯áVRsİ$WeäAµÍˆ?åZ£šÚ”F0ÖmûMÅÁnŸ\Z´˜ìÔ´Ãg¦—WÔ±&äª©—u3äK$kdbÅÈÀ[®•t¤¥œ0\Z‘$ º^øÔÁâs›!%há,LjMöÀæ¬e{i×ÇcFayÙ”4eWi>fÜ{õV+ĞÜ±-åT²‘©èÎ¬‘ËšğÎŞö®4‰#RV^§¦â,	ùV•Zo#.‡°şÏğê³OšÑo\\%İ—Üıüu®ŒkSæ¹×oOSô;Úüxã¸L6ívŒI(=w0½vâP½çÊò¯¿#öhl¡Î(\0 €P\n@(\0 €P\n@(\0 €P\n@y_ïıÉ\\XŞB|~¥ÿ\0*àÍXgÔxÌ²{“eær¸ùT\'êáıO\ZŞG£ ®K)mQ‚î´V]œ3¢ıÄzÄ¸1ğ?Î¸í£>V©ÖœÊ”Ç–5k¬¥À¹>ª–-R“ZÌÉPé‚Pô$1¹ü\remNìOi¬´~“§ËıC±ïTƒ²·’ÀréŞ†’QÈÍ¼[@Z÷6×ÄV¨æİ,ˆñ»:²i!ïmu¤’‘šH‰„…$m¸ÛóîOzªf–RˆRÆPGwÔ\\jzéqÚ®œ™Z°b,UChA\'áØ”#tÈ[{æéoåQ«\"$¤˜æ9ÈR]À,`\\z×ÒŞGÔÔâÌÊMí¸ë¥BD»\"\\\r!Y’8VV*	=J(7,5ü©´}MQ}örº?oÃãSR¹,Ñ€0\r~oS>£DüV¾âímnüûÕ/¡ÑŠÒL‘•A\'Fş¢\r´¬Ñ©ñLn–mI½`*Y2|j…½‘E—]j0‰±°ëj´™·èpÁ$­ÈÓ°wĞ¥e³,‘€é¼¹°=…ê©“e©)¢0TYm¤}è˜t9Ã™$pOŒ\0	/Ô¥AÕm¨$h~F¥±Z©ö‘¤‰‰½µ¥hMõ:ÄÉº0@ê~ WBFNJÎîá#nÈÅ‚éÛ©©BĞ‘\0m\"“¯Ìu«¨GÔ’H¦I•™%ˆî‰‹©B/ò¢De´¨1ÊæIŒnÎKJ{“ÔŸÆ­\'=*a4’s²âÖ:|j$ÕRz—ÿ\0¦Á\\>«.bØ,!l=uíUMÉ¥ë:`‹Äô]:ÕÌ‡gØöØöéñïDag,,ˆf½®íÔŸ‡Z²fWPp]Š’]AîT¿Óa¥‡L”ªîXáf`âE9“ÖÈ’6TkÛkjG~úQ=E«İrd4£Ëõ–øëÖº*qæeŸwÕ¬Aî:\r*ÌÂ©³eïÃ¨c7™Mï Ó ¡ŒK68—teº-šõ¨€òF†ıÃFÙ§TÜ›kü*èãÌÒÔô·´8y\"ÄIeÜ••\"ÒæİíÓ¨µQâr²K„{ïìßµ‰©ir6de}( ?+WN:OÄùw#«ô=f\0Ã@:\nì>xP\n@(\0 €P\n@(\0 €P\n@(\0 €P[÷7ŒıWë*İÊ•×ó.«\\Ù×sÕñ¹aÁàOzñ3L?Y^_9x|.7ƒÓÂ¼û§Ôû>&D×Ñ{çqFKdcØ«¡!P‹›k’ÊO¢ãäÚu5Œğ¤Ñ;hĞôcmoediœ‚Œm»€&ÚÛ¹ÿ\0\Z£G^7(×&dmîH\'[OşFª=¤IáxU©OToFm7!èEVŠ´úòˆƒ‡µïÒÚZş5¢fVÇHæTV\r®Ûı6Öô‚É™ó3£’48‚mP¤¨±%GsøÕv²T.å\n¸bÈ°o¤u\0üjŒ-c”Pz¥AeC{(c¥ş$Ğ$2İÇÖwX‡€éò¨’ÊWÌY$6ë0°¯ «#›,¦KCê/˜ÛvOPµT™×C¡ş›½*¬Úª	;CìĞ½Oj„Íl¤ñ’E˜íB}Cş\"­&’É02­­Ô\ro¯áT±ÓMB¬¤H¸Öç·{Õ\rdà­_%ésqqS®ãë2Ig|¶µ ‹9>_P Üt¢	”gı<‘ª‰†à\Z2ÂÛş¥ñ¡5HÌªY€$_á¥D–JI­KŒÒ4ëêŞÂ\0	;{İ?\n‚^…25åbUMÑ-ãÔŸÊ´}ò6H8Ù²bŸ+ÔlCûÜb×Ğ)Ôş”›6“KÔ¤˜G…Vñë¥iR·PUÏ#€ XY¾£añéZ¤rem–8K’Ñª«Hìtê¹ì-©5[8/E\nY“Ãš^òJ¤£ôøƒñ¨V/j+­\nó¢ìÔ—>õ«L”T‚ÌaÉ<R:2¤À˜œ‹±±±=mPÙ5FtÇi gİTC#`4\ZYAêO€¢z“w¤tUm–úi¯½jçô3,LåX%:¯ü\nÚ™ÊlhRë¢w}¢1}ÃN·ĞZ…  ‹(wŞò±-ckÀz±…à‡‘ŒP«ïÙş ´ùö­9ìßCç¦»J(	}Û^mZÔå»6ŒxRF¨¯«ºÀ×N÷½F²4‚÷’îPÈàXÈ^¬rY›§±»ÈéÆC\0{Úç§áj±ƒ;3ÙxC763´…Spæ*ÕRpòmµ3Ø~Åà²9>s™?öXH±Á¾Òìnò7È*èU–|ÿ\0#2¥«?E>ŞñkÆ¿\"ËfÍ;qî,D) üú×f%Üù.eåí;¶8…\0 €P\n@(\0 €P\n@(\0 €P\n@(QÎáŒî3&]‚–_À•S\"”oÇ¾Û£Ãşøâß/9B$OZ!ş­º6Ÿ*óì­âŞR<ï-0²ãË„Ú”Å ér±®,•ÛcêxY~¥aõGSû›	2q[)uİ ]5µa•w=M¶ÚÎ©ä!TÆı)F:Ób-®½k=Š½dÒŠÈ	Ú7ª“©ÿ\0?\n†uQ¦r“,I‰!c6YOacå·…õª3¢©&Rå¢,¿Ò~¯n–©©6²hª™˜©\'©[ƒà+DafRK$’Á‰vuíÒÂ®rnµ™Â1\"¥XmóXı_:§¹;*\\y·ÙÊVE¾acpGåBÉ¹&CÈhĞ)õ	\06&úY½Új¤á›Ç><’z±¼r«Zdm*mb)[ÉYJ!¢YlÍscÿ\0*¹È2Æ¶7\0ìQõ\Z†^„¿P&Á@~uT¤ÂÓ(òÚæú‘Ş¦¾¦°sÜ¾åg.	µ¶Û°ñ½C4«ğz{šWõ·\rˆ,TÔëùQ!kÁÀ³8m¢àIA­ª`¢¹$ÆÑ [P@7¸?Òªlœ£„d)&÷·n‡åj2ˆœÙS4J»šñh ’ÁTëøU\Z7M\":’ì6-Ğë¥ ²d¬¸2a£êCİ{P‘zhWÃ cgZúxö­_rÄÎñ±*Ì	\0›mS&Ù ÆìïbÚĞõÓğ¤A·=i6l<ÄtdezË,#™àQ‰aÔ÷ÓãPÑ¥\\#<Kú†•¤;™ô½ôî~5X,¬p˜F-p|òÖ¥	“è•æXãfm£M­ÚŞ+$œÌ9âLw•\Z%™7ÂÄıKâêÉµç¡]1ÊÊ¯1E\r×¨îzÖ•RyùrR)\n#	#V!\\f u¨hŠßB2BóÎ¨‘4®ÄmA}Oa¦´\'qÃ#¡oîM‰ –ÛÔ~zU“‚·Rch¡ı9šIã!\\(€›Èn ÒµNN{B*ï™ÚÚ‹qÒúÿ\0…Z`çjKè1R<UŸná#E$n¸ëqÖß\Z‰’]RFÉÇÈ¸Ö˜D³mé¹;ocÖÕzœ56/ä*–?Skÿ\0*²9ò¸=5öÛÛ›fhÈõHH€ÔõOÂ¶ÇSÄææì{»íßµ1ğğ£Ÿ=ƒäH?¥d¿”|v‹~5ÕZè|·\'4Ù¾Èö–&4xx¸ø°¨X±ãXÑG‚‹W]T(<Ûsm’*JŠ@(\0 €P\n@(\0 €P\n@(\0 €P\n\0EÅCÖ€óÜïo2\ZE_ÿ\0gf•4ú¡ù‡ázâ½`úy^ÿ\0Ìñç¿ø7“`7 }L}4[×zh}GämÈ§¹ÑÑãåbEú{‡…}9£=7cóµs8²>‡t¶½Î“ç0ŒrLˆ¬¶kí&ÿ\0;W;©îáÍ+SMPÑ´‰é$ÆÒZ÷ù­»ÕYÙF™_‘†Åe6 ¸ïÒÃ©øÕµ¬RLªb*¶VS{ôáW‚›Û+˜*5Ü,l>:ZÕ(YTTÅ+io¾€|*Æ{,H{È…\0õ÷?\Zƒ£väWKºMŞL¤|jÇ=´3á»X‹€Ê>¯VÈß“H%¼¦F´¼ÜØ“ó¬àëÜG”tĞXôü;ÕÑ†G•†–%Õ»¥K+[€\Z÷ ‹t\Zl‹$$úA:Ô˜$“%\0I6;F·?\Z†lŒ2l$í¶Ÿòèh™[èb;dak°4«F†Y&XbÈ•c“ cÇ¨30$˜PMQ£jf“ŒÛÓT`ÄX_[ÕQµ‘$`-{ßÊ|uëñ£B®~º¦Õ\Zt_åM¦ŸRO#§§#]h?À\nmõ$Æ’&§~æ:µÀ¡°‰V\0\r«Ôöşu)•µd³‚^\'õ%u’ÃôÁm´øî\'_Ê¢ÌU¹+\\¦%H\0Û§•J-h’La¥}–¸XøÔ”v,”C‹LRMiPZ=‹u:êw\\X[çQ“…CÊ\n‡r„—50CpaŠE»\\eíVƒ›ëjIŸ+Ê·:›ëjµk&Y3I	!l.çÊ\r‡^ššÑ¶Ôáòâd<\r·tgÌQÃ¯àF†ªú–KC?%“	õ±]¡ÜFÊlt×B5¸©H®äCÈÌ–`¬ì³\\’o{õ6ùÕëCçìAŞÛä7Ğı>:uşu¢Fòd‹z ;–ìm»Cn÷7ëÒ¦\n»$ª¬uacş\ZÒ\nŞÍ¨7Xƒ2¥îÍª…øxÔœs©ÛŞĞáS<1X\\=µësÚ¦ªYÍÊÈ«SÚn¸5Ÿ‡!¾.kçÿ\0[kvÒºèµ>O›š+=Ùî¶ÜT¬—,GdÃKn=F\0úTZºèµ>k“—Şw]lyâ€P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n¯¾âq\'7‡lÈÓ{á\\Ì \\˜ÕùV«Üîàå‹mõ<gîn9&ƒ6hÛÛúOÈ×%Ô£éxÙ6´y¯öïéfäqYmú­²c;ëĞ×Ó‰>›+r«ô:?šÄ„L¶°bÈÌÂúôZæu=ìwšÊ:Ç—Ç8R8	r¦ê>zøUmY;ñò\ZÛÏê^öÔmo­fëbË¸¥œ0f²FÇáQ&õ¢e{©P7)fó£òÒ¢M–2é¾1¸\0IĞ“­]3¸Ó Â=6eİp:¯ğ«3\n|§Ü¼Ù²¤FÊmŞ”a#` «Ó ·Æ¤ÆÎÂD{h7økj†¤×\r¡“(q óö:gul™÷\"À®û¯Ô>?\ZTŒ¤%XÜk¯z¹Šd‹\nàî¿@{iIFF‰&C!³ƒ£QºO§6%4RGæp·mÉ¯^ÕY“wXGÌ‰%”ÉcÜ%k\0\0Å@¸°·ò«IÍhZ¯oVûm»½À«£–õRbõ˜{•=šà;~t&š2d2£>É¤d‹¤_¸ªÁÕ[’2Ÿ\Z<‚˜’¼ğØ¬R¸\nÿ\06\0›~NøZ‘½)á…2w,Rµö±P	ënô\nêÄ\0æGT±$°½È·_Î¤VÒË¯öù1ñáÈrsÜ-˜åñ¸¬ÙÑK.¤DP¿Æ¥\"·i¡“r)½­Ôi}:ÔXšt#Ë-¦İ—ãÎ¬Œò3êd6àËõZÇ°üêÆuêIy×D;IÍVé%}Ãe¬¶×M,;T¤e’ÄX\"C-İı4S«[v€|5­çÙË1e¼F@˜êÁ-©¿~•¥L.Ùôìe./áĞT•M¢:Ìf5%Î²îììj òq»¢¼P¸`·$[ÇáV©K=û?¶MË¦Ã¡\'¸øV’s4SÈeIQ—êİ|*d¦Óbã¸éæoRg1¢èª\0¿[ßµCeö›–FÁ…šÆç¡?ñò¨“<†éÃáoõ²d6a·j‹kØ_Æ¬rªÃ“ÑŞÇâÖ,¤„-š4\r*ëp¾¿[cGÎÉ¤ãûmÄ\'€üŒêZL–Qê×Ñâk¯\Zî|Ÿ3.çµÏö‡8Îm6G÷§>,ÕÓhx\\‹î·¸Ùêæ€P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n±¤ÑÉŠ\Z9T«©î±¨jTVÓ”xãß¼ğÔĞHÍ¡oéx˜ùt>µq5µÃ>““êÒQÑ~åáG¨qÇşç}x\0\Z•[:Âôô=.xëÑèy¯ŞÜ2É4“\"„§zép’¯ñ®‹Y>§…•í‰:C—Â•¬¯ÿ\0R!¶Bu\'ãøÕ$õ)Ğ²1š\'}Dl\rì4¬ìwáPSİ™J³úbîİl/a\n¤˜íµêGqéÈYF«\Z¤{¤Å”ë2Æ¥zI³Ê¡M®N¤u:õ5tgdŠ‰VS©s‰½L9‚YÛ)b‘4Lr\ZîR¤P­‘Q!Bw‰Kn\0º€o§_–•%dÌpW¹Ş Æ•õ³2	Ä£iÕ®uø\nˆ5W”pT•.ÎŒÈ¦Ò‘¯^—µIRÀ4œ^’”p¶•™®	ë»¦Ÿ*¬\ZÖĞD%XX¯ˆ£Fv¹3+6LÀd™Ë8ú›Oğ·z°Y]m„R´¸…kO˜ü*Ğak³€;óèÿ\0>Õc7i8ÈUGöØŞÛomu¨e¨ÑËk•GÛ`F§ä<>hÔ=-»_w•~•ş4z9òcXX¨HX÷ñ·j–Z1Ø)ò–7Ó~¦Ö/P\Z\'‹\0¨N‡ÿ\0¤Ô4i[’‚3<L$MÄ#-ÏFğª¹F•u±(¬ÒiD¨†ÌÑèw±`<|*!¶_rH­Õ¤b§Èo¶ÿ\0U»^´Hä½äç—a®Ñ}I¡\nÌ‘úrÊĞ+‚ãÎƒy¼E”XP™}Èá¶‹¹ˆµ¿ğ©ƒ;Xçïe]ÅAê~52e£2åb&;ØJ“³#n\ZşZŠ™dZŠj«ã·Â¯¸çu\"JÁ\0m}ww­§;M2f.v:	W+õXÈ…·±únÓ­AzôÔ‰êo».Šn|/WFĞ“Çâ¬²J›Š°Ÿó4lÒO	’8pCK¶ ÙWhVî[ãR‘²Ay…	º;\rm¨»éPekÉÙ^ØÁıVDa“ûhC\rÖê/ZUIÃÈÈê´=}ößÛ¼Øï%åŸ’}ÌíÕ”}Ljé¥O™çr?Ü>Îá#Ìä°q;ãã°cn…–×?%ÕÔ—cæ²d„ÙéåPªE•E€ø\nè<–} €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\nªşêûjkƒl±ùğÁ—ê\nz0?ùMsç¬êz>;;¥£ÔñJJ%ôŞoıÖ:ÛW*zÓQÔW1ô)¯ƒ:Ëİœ,y\nùÇêC\"’ÑªÆÇCÿ\0\ZW.Zw=®%­SÊşêãß!ÊF@Õ†nuê{\ZägÔ`Èš:Ç˜\'Ó‘!0Î¨©2¶ ì½:Õ,C\rŸÀÑ§I\"œ€Zı	Äñ¬ÏB3¿¨F€èÄ÷·ñª´vTÀnŒ×›Xw·Z”ÃH‚ë¼Ã½É\n²g=ñêa‘AÓª›\r{TÉÖD‘Õ*nEªJªA¤ŒmBlmvñ¡6pb‹ÊÎYÆ‡Ap*El‘e6DòÀ‹ë·¦†éü Úİ:\\Ö ´\",v¾ \Z‹ôÓáPU3ì¸ÄºÊ›ív± ~_áR‰ugƒûLo»HìA\ZÔ)eÆXÉ	\'¬HFÃr.E¿Æ¦BSÔŠØÁ—mÕıÀ§¡¤”Ú‰åm[Î‡hoŸjÑ§—\Z%‹¶äbÖ\rµè|j©´w f‘Ú\"V6d›Ê-kõé­X¦å$WxV4Şïå@‹vbN–èiXH/ªŒÉ\"•*H)ko\Z‚ò™œåîW­µÒ†vĞùp]ˆÜzºvëS¶\'dG¼C¥™¤A¹X]·ÛP»z\n„^×’#é+æ¶ “C;0™ŒH‹\'«§œØ5½É\0tëA0dŞRÄë}·Î„ZÉ`‘–}ñ¨Ş¿Õÿ\0*±ÌÙÊIä™™‰>©f.:·éVFnÄœL¿E\\‡z2–e\rkø^ö?\Z2d†Á‹ô²“Ûµ$«GŒ\rİ	¸6:ÕÑ¡Æ¦’Ñ@0S\'mÇP?\Z´jfÚg@òµÊøVˆç¼ğEé¢¯B@òõ·©o!c‡!mÖ\'Ë·­XÂÎM«)Ÿ,zª‘²ªªÃ\ZíüÇr{š‚Î ïß`ğ­“<K´’Hßñïoá[c©âsóÂ=çì.ôÈ™’\'œFÀ–¶ÑĞãs]tGÈòòÎ‡®>İq¡\"Ÿ(Ul!Ç\'¸\Z³~5ÑDxÜ›v;B´9\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P¦†<ˆ¥‚UİÊQÔ÷XÔ5*	­\\£ÃŸrı³\'Ìä0V_NMÑ°èèÚŠóíXgÔñ3,”:ß;rñDa›\Ze+(Teñ«u¡Û†ûmÑç}{|§ª¯Y®’m\'z“poá­qd¬KÁäIæ¾ˆ—àúR’øò¡ÿ\0:Á£ŞÃ•IÖóã¿«¼HNÑĞüuª³¾º)¥’H·†S»êoÚ¨ë\'U3Ae“\'q9Ä5”ùWAvø|ê`½¯ÜàåœOú“şU)–O’Ké¢¢˜æŠâwv–\0iñ¤\ZoLÀè\'Ø‘ìGcmÄ…æz[ãE%[P`›\ZU‘]ò£“jËˆĞØtµÍüA«¿À€©´‹­ÇrGó©*à”·#ûD€£¨íñë@Ù‹XŞÃúnßõ\rLÎ¤É´4…HéqĞ:\Z¦FÈˆ‰@IÄˆš‰\0*?#C7SÍ\"Ê¥ˆ$Öÿ\0 ”Ú96zÉ‡B6voQeWR¬ä1¹‰m6ş5fŠ¬’E…ßÔ:Ø„^õ0e{=Å‹dDÑ¤B%»’MïøÛJƒEh1ãÌc¾ÒW[®Ş£ãøQ–¥¤ÓÅ,¤Ç[®››q\Zu¾MCFõc)DÈ¹P}XîF¢ätâ¡şb\0vÜ,¤[¹Õh0n$gXıe!u°†ëüZˆ#t˜&îOÔJu¿Ê„²Iõ!Qud.¿BV…\Z>yÏ˜‹õ7:^¤ÉÉñe1Ø)Ô\\oøw¢*ÙÁKÈìÎK=;Ş®Ü™¢ÈG\ZGúŠîàïŒ_r6Öà\r~\r\ZTÊòÄÑ¨\\p¥>§ë\Zˆ,Ú‚½ßwK5Û¹­¨qår}R HI·aZ£•¸,±@\Zß·ñ41vÜËÈñÔ@Ó™v²§¥¸n$÷áŞĞ³ÆŞ„ì°\'úÀéRPŞ86Yå‰Ü™§”†vmOÎçÀTÕI†kÂ=‘ö¯€PÑ0ˆ;6†Ğ{~=MucGÊùÒÏfğw§.,w‘åm_ıDèX|É6øWJP|æKîrz¯…Áw‰Š™P?õ6¦¶ª„y™-ºÍ–µc1@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €ê¯º~ØNc‰ı|QîÉÂ8·Ô‡üsç§sÑñùö[k<k‹‡Éä`d)X\'¿‹ë¡?çğ®j¹Ğú©®äkşîà—/;#¿¥DÚäù¢cááYä¤£«‡Èu¼ı½ç‘=ÛÆ¾O(Y°¦s$İQQ~ÃJá²­ãeY5îtO)Šc’VY]¾•\0Ù»Ö/CÛÀÔ\Z(ÒLÊÒåWb–ê\0\ZÊ¡µ\n˜İ [BÅ)SbzÒ†ÊÒµ!$—}ª\nõÜ¤ã_\Z˜!õ0M¨=VbÈ:ü·Óò¨L»¦š•ß}´µÏ_5b•NL¬…È%Îş–\Z[üê\r•dÈĞH]C«)as¸[N ëÖ¢HØHPê×ºı hlzÛ¨«\"™!e?ÜÜY‰Qm¾6ğ©hÆ¶&å€<6ÜŠñ©±Ü §øU`Ş¶Mh`y#ši$1¢3’YB ùÒ ¥lú›zGÆìMúë§ùT7ê²ˆŸ¡xÿ\0ê+ÆÄy·\\_ÀL™Z†J4f)ãø÷«³î\\¯,Êò¸$*  `¢À\0<ØCh¤3G†d+yH[½ºôğ¡o¦º£#BÑ™\0oQˆõ‚åºİj„½ÂG\n´¬É¸Ü„ğ63Çê!€Òêz¯ğ¨‚ÛıLŒìâàuütíPK²hÍéH¤DåP ½÷\0·òß ¤W2:ÃÑ_Ôusÿ\0¹€Ê:YHÓZ–‡ÕÉ°„2 ·•æÚù¬)^S÷^ä…\0	ü/R‘®H•½Y>La!ˆ\"”M½‹`\'âjî†k$÷¨V±Öö½H¶OB\\M*<ˆ…½%ß3\\h·°êjÏ¡U`¬ìvëmA=ïÚª‘grW¢ĞšXÙÆäfñ ÷«¤Q±+BÒí¢d@ªƒÖÔÜÔÖˆç¿B\\*i¡Ò¤å®…æ66ğ¤êN€Tv“tâğA‚VIQZÛ\\1\0•\Z±øT¤fìÜöO™3B°¦ûÙc·rkJ#Îæ^=ïöÓÛ±âÁ´z…²±ì-foÄè+¯Oçe–z‡Ø|BæòkÃv>ÜĞ‘Ò·ª–y9¯¶¾ó½«cÏ€P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(X’häŠE\rŠUÔ÷¡©Ğ”áÊ<5÷gÚRq|Ä¿¦%$V2ã06İÜ¿:óï]®«àgW¦¦›Âf§1ƒ,Rª.\\ÛÉˆ÷UÑ[ğ©_2/•<Vö%ïßmÆrr±rãÇ:ù&áX?¦µÉ–šï“¢hñ÷¹¸œ&x2T…éX›ù´‡ÃÆ¸¬šÑŸ[ÆÊ®“©×¹¸²MÊ‹¾%k;w¿]EDÛû3Zi@#F.Ia {Û¡>/W§™ÕäÜ¤©“BGZ“Gu$øq±Ûe|§“$=äÃÚ²ik=ï~ ‹~5\r#U•½¸NÈ=[şËXvmMŞ×SXÕw%´ïão»RÔ2¾fNPC“3Kè(Hy¶(7Ú>\ZÒ\nÖğ|Ú[\ZŞä_üêRÕå]èJ^Çü\rhs>¤Id“ÉveÙĞ\r{ôğ¨i\ZU¾Ç$,vé°€w_ÃãThÖ§Æ£\0\r÷\ZÚ¢\rÚ\"Ï‘4¬^iŒ¬¾T$“ ÒÚßøU ÊYW6_¤Í¸\r×Xp|\rÖ¬ŠsXJ¶\Zw`§­üGD%%ÜYòÆÀmÎ¢?õ\r§·ÊLÚ‚NFlíÆÄ†İ¶şMÇBmã¥ªÉ¹TØ¹y‚†6Ü½¿k\Z–`íèXÄfÈXq‘cJ¼–\nubmz©3\Z‰BÆ‰¶0­!œKë×À~.Ùg’fÄŒîGÒ:ßà*R2µÚ0ãÆóM°¶İ|ìXh§­»\n¥7’M†ı®]A·šÛºØiQI&9Â‰ve>‹ëäØ¶©E\\o+«[ióIë[#hÌªÄÚë¯oÃÆÔ‚$¤Í´ãÛÆ¦\nÌ±ÅÖİ¶Xã*¥Ü»\0\ZØßÀUcRw½ye}†Bè‚ÊP/Øò«•µ™6kk_ú\nnO©±àñç#Ó\"HÕ\\—u]]ÄôüjLbKÉ-Ô©utÓM(CFå‰„\'’|PekîX‹(`t\0÷øÕŒîÏZ}ªöøSÑÁêä¸ã¯ô£·V6ğ½ëlhğ<nİqğ|Wû|1áÆ\0`±£‰\Zÿ\0åoÆ»*¡){ïrzwÚRñœLW[K“ıÇ=íı#ò­h»o\"óhô6ª¹€ €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(ÔŸw½æöì¹™üx2C*l?È×/\'©]OOÆr¾H}à¼|ÜŞ/Hf…qçÈ´7>_PWÉ»\ZäÇ}O¬Ë†·Ç)ÊêmœæàáåÇsyÑ+Œv \\‘ÕIğğ«Ş»‘ÇÇÈñdöZ÷W·FvWÈÄ%4ÃÉm6•ëx\\Y)¹{O©ârvYZ½;¯ÔòO5“ÆæÍÄ£UT|«™i¡ôÔjêQ¡çïWÚTı-­Íÿ\0•A­$„T°V°Ü‡Ê·ÓàjQµé¡Î\"×yAkÿ\0ltù[[Q“ˆú#)Ü¤-*„Şá,JªıFã­¨nÒ0Æ¹\rsçŠ \ZK)*ÒäØÚ×«&V!™ö…ó0¹µU¹/	œ¶IéI\nt±·ã§Z”NÔˆK3\\›€/¨#çZ7Ñ’¡šHƒÌM\"kr­¡\ZøÔ”Ï¿§Áı+¾éÆp“Eºú&0<>«Ô:Á½2ëì*˜‚öE¸îF—ø\n©6¼²7£“+¬p\rÌÊZ×\Z\0.Ú’AHĞ1°°	šNFIw>’!P7öŞOo©ƒ\'w\'ØàÁÊÊ a½SÊMÏô“Î«ŠÚrÚ’Eˆ›/rnmÿ\0*š¢™2bš5õ%•˜0]±*0új×«í9^VgÂŸ\ræ\r™$†/ê[uÇKnÒš—V”I_*ebÖş&Âª[F3!šÉ}¶ĞİAaÖÄhhZ ¤²N—±6?\ZºF±òå™¢ÒÄé©?\n”R	©,‘‚¤’5°=\ZªzÃdH›€s_Q\Z„ÛğÖ¶G5¦xöº˜Ä\"Ie!QŒ\rû@ÒïSÆÉ#ÆÑí‘Izê<mRUëĞ³Q8ìªXdÉ£•±M„j<nMD¡Zîê~“cÖİğ«A¬ÉxsZCtRÛµ–ı{ÔÁG•²ûÔn—+ÓZ4UX½È±×<§ÖìSrí¨şT&Ş+hË§@|*R’–gr{Wı@XqáS‘’õH×»ªéyí·V~}£özñø8y3Åmˆ»èÇüë«Œò<—k4Hû7\0s¼°eCúH³Kş­§R>‹|«n®+#úuç¢@\n\0Àğ­Ï4û@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@qtY£pe=Á¨jIN\n}ìöñ|Ü¦$DDÎ^\"ºnJ_§Ê¼¼ÔÙsì<G1_£:ê- Rï&İğH¨ªŞÕskFíNªæò1×6lĞ9Šãä¶\\èÑInş°mL3ÖÃG¶kÕvıQæÿ\0¹Ôxglì%õ PC®†ÃÄ•re¬3ßàr%)êy×3ÒÛÚ<˜®,zzVzå[z¢¹ Æ“túy‚@ÑÉÔ2b§° ÷¨ˆ:©yÑ•\nÊ(Ğ‹hHñ¤Ólˆïé\07id;mz¹“–K‡3#\n)½9š?Ô¡IĞyw¥úu:÷¨(µz˜£•Á6V\"ßòªÁ¢M2gF†8¢\"x¯ºT¾ç¿úz²H‹Y¢¸ßo@Aëz¾ˆçz˜¥×]½ÆºŸ2ØpÛ1‹×hÛÑ¹Q.Ó¶ãRéPÙ­TÌ<y hû¬\nÊVî-§•¯Ğƒ­W©vœ•Ìw\\+N»mo•LÁK&a89MâaÄ ›iÚYu 7sUÜMjˆò½ŒJ.XÛ¾•i·BD9olly2¤mBF‘snƒãR™ßR¿#A¸Q‰±¿Â¬®bè—Bn:I‰#¤SùÊvB	¢×½X¡ŒK(¹FÚ@Ó§ÕYz¶fÊ\'Ñ‚YHLÄGæäu \\Ú¡3[t*;Ìv .Æı:ÿ\0\n¶ã›i+X]Úk¯OÊ¥1dHÇÌŒÄøí\Zù˜ö®<ëW1“ï¨Ë~úöéò©EYŒ¹\0‘õÃùU¤ÎÈÏŒ×7mIÔ÷¨e©¡m–øÒ~œÁ¼mˆ,»­mãSm½ªªK½JåBî¤µÇCz¹Ïj–0D7‚F….Õ&3cÇ¼j16^âõ)•hÜğğ±Î9ÉÏb€(Av×¥©‚ªÎ`ŸÆ§ê\Z/GÓXÙˆ\nö¿MÄUM[HöŸÙïaI˜;&ñ³Æ‹	Ğ±:í\Z|5=…oŠ’|ß”åíÑu=¯\n8ÌKz§jHéô¢‘`«øWrĞù«–zGÙÜp¼\\@ YæPX[é^Â´¥cSÏÏ“s6ú¹€ €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 ¯îßnÁî>&|I	”Æ‹íaÒ±Íz:x¹Ş+ÉâOrpsğ“ä3Bñ˜œ¦`AôµôuÓéaùWCêpäYcğ:WŞ<<9Ğ¸Ú¦<«²2v›ı$v¸ÔVQíp²:¿wätncq±Ï™	ËK;É>S¡ø\Zç~ÓÜ­œ£Î¾áã#—+\'#Ç·û±ZåT£ä{ŠÁ¨=>M!s‘«pò°ĞßÂô=*.è…,\rc¯t×AC¦‰3äm,kµÈêGÏÆ¦Kı$ršFe¹:¨µWébblGU×AQ!ã$µÜ©³IézIÊdÈL—“*8,\ZóÛj,½õ«­L-‰.Æ	ckiãCÒ…Ü„“é}§é÷·KÔÁš«>äbá&:XäL»­³iúm¥ïãQÔÒd¦ôãRz|mSwgÉ\'p›\"ÇZ†Š+#ÆiË0RÈ–ÜÀ\\(&×cÒ«‰²Ÿˆ…¬ép]š·eS&ÊŸ÷œµúØö«4fõ\'áæGúŒ‰(\nFÙÀ$Zö>ˆrC›%Qì½^ÿ\0Â¦ª³4j2\"ÇÌ²;³^§`P%šëÒ¢\n¹]Lç;\"²Ã‘²b¦;©³¶Û\\|4«*”V e#BËJ’´Š­º&½‹‡A¨ïH‚ÖÕÔF`à«)Ô\rZLmRÇ!Š³\0W¸ÿ\0U»~5c8&rÔ9Å*±J,i{Gèók¥DÔ˜})qÕ“FâuŞ\rÊ‹ôoğ¤êIØ…]ÑdF€ÒuQ~¶\Zéğ©*Ô@Q+ª¸•TÙd\0À\rºõÖ¬‘•Ÿ¡‚Îe‰ãT\r²yAÖıO‰×½Lêí›`äãÏéf‘D«¨&ÍÒö:~4R£\'	äÃ‚Lg,bõ\nvXùUÉco…KHì¯¶şØŸ”å#\"ÆGØƒpİ?ñ©ª“‡——bÔı1öŸ\rÇbaãf/•5¾–aª¯Äÿ\0ÇzïÇXGÃr²¼·m€ûsíÕmåòÓÿ\0jŒ^ÃYdñøZUng™ÉÉ·å]Nó­Ï<P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(¤û‰íTÍ‰¹h=IB2Íÿ\0î)\Z©ø÷ÍšÏK…Èu{[<?î^3ı§(áe¼vQşÄÄ}>So=k…®ÇÙñò}Jî]QåÏ¹P/ÈËL_ÙÉ7ßÒ­¦ x\Zå¾ô\'¾²ŠÎi°³eéE¥$ˆ€ö7ëşSÖÆ¥\Z?\'€Lñßkwn¼+8†z˜-ØÔgI™‘7ÿ\0©nµ\'mQüœsûZth¤Qb\n>Œ¤õ*’u*«-NpşšiUò!2F¦ï\n¹MËá¹u:£P]×M3Ó¹XnU¯©ê|5¢RFÉ3È™¾6Dì›\'[¦×V\"ÆÖeSu&ßÔ*ĞŠ4µFQœÉ\0Äclvpì¶Ïk^ö¿OÏjë$ŸZU SŒEõø›÷¨’¯RÃA¨½ïZA…´gÉ	‘;|}{~R–R¤Á” \"#È¤F»Ûuß¹\ZüjÊ¨ÇŞU<nì©}I±×AøÔí1kS<…±½HVU{®nà÷ªÁª¬”Y.X_Q­¾4lrDK1*ªê-ÔÒ\nª4H‘ı(ã20µ† ¤üI0ˆÒÄCÈ—íbİXàéBR9äBØ–OV9Ñ\\Ûp…ìOˆî)^¥-©?Qö±º‚|Çµ]™Z©rVç¾4­$`)]àÚÜµRL1å,¨ù*Á¦Q\"½Ù[¡ìh™[&|B/fïÖÔHš9qå0ÌWp\0¬®<ÀªÜ_]jd¤ÑñF4‹$LrË)Iƒmæ]€kéF‹­LÒoğğ«¤rŞÚ“1evpÜIşc&äÜøw²—k7ñ¡”¿ë36‰ÛAºú\\ümÚ¥)2µ Ú±ğZ\\Á‡i¦iÃ,wÛ{Øµˆ«:•yR=Éö—ÚiÁbA¶$›‘Ë»œ‘ªÆ‹õ{u?Ô|£½k°|ï‘ä<ãÚ~Åölüã£N¾Dí¡’ımñoà+ª©ÛD|Ç#2Çï=3,ccÆ\"‚	kĞ]	BƒÈ³mË3T(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 )áLˆÑÅCRM\\9<­÷cÙÉLrÆV9üÑJ½CÑ‡…ÿ\0yù±ŸMâù4~}ûûŒÍ2xìÑÿ\0ïn1`9Ù0©ÖÃıKÜxWõëÔû~Z¦šş/ğ<ÇÎOÖp¥=0UÔõSÜøv¬›>“M\'‘r®¤hEíÒöÖÕGcÓÃE&“.åÈÙ\Z‘u-qsÓ¶ŸÌÔõG¦©\nJLÆ‘‰1ÆA ’ıE_]ÎŒuL1g_[! CqêíİcÛËq¥ê×HÕÑU›\"hÕ÷°‘ûX\\ÚÕUì­ºòáôV4Š²¢Ë	{¨t=|GÆ¥¤Ì¶UÌ2Ê xãº¸bAŒ2íñ½Aª´Î\\”†ZOŸ\nññâzP¨Ç,ÑÈ¨¾s¨2ua¦—éP«,æµZmêkÿ\0İ˜•†&‘ÈÜ$Ô5­š„`õ2áÁŠÒ¸Î–hâÄv“ê[È}-~´+vÒĞÂ6îê@|j¦v¬˜Ï¥º5cé£0\"ÅTM®/j˜e^\"&RD²º‰±\"9HÛ¸_BVæ×ğªÃ%QÁU8ÆÑ°(\Z¸ñ:—­N2å<XK\ZÆ«¼\"î¹úºÛázš©dºK’.1È˜K$d‘n™—K!!uüH«56¤N4_ +¯êZb= vËı6¿ãT‚6êb~è È—68Ä²úrÂ É,h-ıÂš<ê²H:ûÂ\ZÌjÄ{_­ºÕš2½1MIb$\ruğ·ó½é+>·2zìv\\n¶ÔÚiôN$aÉ„Nä¡=mñ¨Úgj5Ğ4×Ö÷ğaQ´¢«fYù_WĞÅ{m6)\0h	¾¤\r\Zm6t”M²-8²;&<ÆÃq[å‘¡jUKâ¹-á†ÖaÔ\ZĞæthİ13äšC™2™´S%†–öµ‡j²Hã´›Ï·Ó(ÃÈgÃ—L\0°±=Æ¬|ŒôWÛOher³ñ9Ã\ZYÎ=UQf–B7Sä5cÚ¬yüŒûSÔıHûYö¿\'/2ù(Äòº¾TŠ,¶MuAß§ã]èì|;˜ªá}½§«±11ğqãÅÅ‰a‚!dzWbI-\nÖvrÉ5%E\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\nÜ<??ÇM…0Pì£#€|îzÏ.=ëÚoÇÌñZOÎ/»>Í›3+–Ä`ğ9ıj_ÔŒõUcı^*İşuädÇÙŸuÀæ&•ªô<1÷Û1å`ŒKHÛ˜aúK=P;õ\nä½aŸaÀæ+|¬éiåu“ù•5Cğğ¬Ú>‡DœšG&û\'/\Z”Œ¶£¸ñïÒ¡8=Ì9+jêT´Şœ’*$&â6+kkoÎ¬ìiVŠÉÔÚÄ¨;\r¬:vÀ‹j+JÜêIXŠ\ZKudŒ¶Õ•A±ÛÔ_½K¼T‚ÏÌñ*cÚgÅ…æ1†UşÜ@³Ø1°ÖÃ_…NäÊŞµª—ßõ\"Ã“4, \nFƒ¯†ŸÎ¯£FwÄ¬‹3˜ÜM¦Úşw¨I(‘7.|v3A3Dåg‰Š±,EÁ\Z|*Íœ¶Ä­¡ä¡7Õ˜|ê;xÜ%•”°Àùë×øR°#i»›kw:ÒÖ‚ßMs±¢8QdÄÀH¬É¬şfî¬(°MOZµJíÖ\nHÒË,mÈÒ€±>·CpnºOJY”uÔá“‹&<‚	ÎÉ•šõ#^Ön×ùQªMI‘¡Ã£Èf™Õ†B2T7ò„mÇuÀîOR66ú±š%håGiˆ$¨]u$[[Š2¶Ç3œÉ‡& Hö4›÷·ZßU¯kv½U<zÉ]’Lmé¶×bªŞF<Âà\\/â*ÁA‚y±Ç¤±Çé¡d;‰ÜÃ«kÒş¬FŞçÌ˜¦ô•1cÆXc	x¯ç#«±$Üõ+Ùš¤XâEvÜz¬-p5¹UïØTÀtPp}ò˜åv‘Ğ	w­‚…6\0k¨ÚòªÉƒ£«XP¬Ï4æhnDsÚHµîVæÕ$ö–d€>>*ÆÒ/W½¯M²qæ¾ºDğL.ä™X™df#K\0\0ÒÚßZ¾Æq_)Ø\\,M@”“h w·An•uGÜó²äƒÕŸj~ÕóŞò›ŒÄÄ–HråS0E,X§e·S­\"“ÌTÕ³öíWíóŒö.ÜÌhòâÂC¹cîmÎ:–?UºøØWV>;ëcäy¾UämSï=1qÃ\ZE,qÆ¤j\0\0€]iAâ¶Ş¬çR@ €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(×qıƒ‡ïnxÄH9Hba‹+tqÿ\0òÛà{x\ZçÏ‡z•ÔïàóøŸ‘q¸ßkr|„@}v7ab„hw?üÃñ¯*ÈûÎ%]&ºiç¸|, ùCÀŞ\\#mËßËâ+šØÚè}\'\ZXê^Wæ«Å0eEpĞ1°Šª*£èxÜÅ_q×‰ÉÃ$8(ÂÃ¥¶\rV5=¬Yë~Œ­ƒ,Éí#¢–1¨7\n½XiØkVi£®¶ÚÏ±æz±Ç‹ú§1o%!fşÚ»A{jj­Øßêë0MÏñ²œ…ˆ>Y¢q&ğŞemêÌ¤\0l\nÕëfUgİªîG’Ş¥€;GNöùÖÎš½t$œÏÔ¸	¢êSU¯Êy÷-cÊÇTX–Ë =A:ükÔêUPÁ&RÆ6ş¢\rZÔqòXñãÎ¯rI*®ÉZû’Ç]¶ ÷ĞÔF¥ZÔ¯ıq`ìŠ\Z8À38è›&Ö>5k\",ŒRò+\"ªo¸µô7×Â¦¦0`|¥E]äuğ×§…E“\'hÌ“$Ç–ƒ#K\n< Ø(f(,MíŞ«Ğ„Š™3…ô”i­»|iRUNó-#¤ÍÒ¹bnO—A{õÒ­·°J48dsÑNb	\Zã¡!6fV$“©ïj•£,Š“2U§U$;¤‰\nàuiÇçRé(ÁQ´eLù2Œ1H‘¦eR¬`Üõ=¿:…­UT¤ll»Æ€¯ÊªêÓ“˜Ú$DØÄÃëäU¤´Ï´¸T#­¹?\n”™Z¦Sç4Œ®r}P–Hœét]÷é`:U•_¡ª‡ØåXÚ]ìH6VùU’Ö|Úh`|¯Pù/kè\rõ>5¬AæäPXàÅ¤’I:¤ŠWÓ€‚K’lmØXk­JgF‘é¿²şÌÌ÷_7ÇñØ8——<Xø(¹y$`\0Îå*&ÏèSíÚníŸ·ğqb†ù¯EW75@;X‹²¡ğ¹Ô÷®¼X¶êúŸŸsy¶ÏoaÜu¹Â(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 Ëã@q2(ë@q3  1œ”ÏÕ§ˆ >ÈÅ\ZnJ5Sbå¿¿iñ>ãqsòœ+Ç…î¼HÉ…ÛHòÕGı9<ƒ~uÅÈÁ»æ¯S×ñ¾Aà¶ÛÈüX÷ßÍ{o•ÍÇ8³qœ…2¸ù]¬»</áÒ¼ëJ>ãÍ­×YGOåû¾)%hù8yHëtk|GCøUaXõ±æ²_+Ğ›Îğ|®1ÇÏ‘ZV‹-muÿ\0ÕãU¶èuáç_“­¹.9±ØÍ‹³\"’.†êWÇòíTI×©ôÜ?/KèÍUò™&Û%â Şç øÿ\0áZÁíW‘VYşªgÆ’Më.4/ézŠEÉ:ƒ´ù¬{\ZŠÕu4®DÙ\Z¤w»¨Ô©=Mhµ4n{“W˜ôÆÔ¸×E&êiµ3$H^XŸ©t6¹½2° ùşéKĞ˜Õ¿½æ*X¨¸¸\Ziz˜)¶L3gzR¿¦XcµÌ*ú¶ÂtØnùÚ§i;O³g¤±Â‚Hâ‰PeÌí¸c¡6\0(\' ¨U‡©—G«*|‰¨Òÿ\0TëG8F)9¥÷Ü|êa2¶ºF×‰}‘Ùv<—½–ÿ\0Òºj5ï­[jE+•3çba¤±ae¯#\\[diñö<$7ô]˜mÔ|«8îWz¶¯Höšÿ\0ê\rİ¯{‘ş&®œyL‘ÿ\0q¶Ë,PîŒÈ#ik^ŞPÚ›X\nÒgõU‚L‹“9YbõÔ–¾–ùTÉmÉÓ\"@Çw9-%Á$öÛO-¯ºÿ\0\Z«ÔÉ¾¦ušÈ†wx€i$}9/rSkk µÏåMÂSz‘¦Éš27ÉÔ@lt:ƒøÕÌò:®‡¹wËú”wSzKg?I%¯ =kDrß,-ø¼ÁŠ9£*$õÂmou¸ĞéÔT}=Ç-ï¸H¸7›èG˜ü~Ue‰úœ¯ÏÁú¹ÙP¤A¥•ä	j/¹€ß^•‡Ìåª-OÜ¿Ú7°8µ</¸½Ç¶ozò‘‘òñğ¸úÿ\0ûŒ>£Û ï[aÅs?=òœ÷ÛWCßøp8Év¨ËPOc]RxÆá‰îl9€\"e üjApœ¬/Ñ¿Æ€’¹±7z(ÈŒ÷ 2SĞĞè\0 €P\n@(\0 €P\n@(\0 €P\n@(\0 €øHh8_ó !É—j¾^D-õ¨$¯“—£i@A~g¯šÔ@—+Õê$˜+ä÷]}K$m Ëî–PHo‘¢IÚRdû®fwYG{Ô6[i®äû‹!ïfÓÆ¢IZ÷Wí·¾éâ¿û”#˜\nâó0€$èßXù×>\\*şó³Í¾§CòÇï/íßŞŞĞl‰ò8÷Íã®}.gKÄWÿ\09Ûø×°ºõ>‰æ©á?pcslæQâÚ4eèBè5\Z\Z½i¡ôx9øîHrü3ïƒ*HÈ6:“ùŠ³®†ï:Z¢ßİÑJBò˜à›ÿ\0ûLC¡ñdïñ±ªlô;0ù»âÑ½ˆ³ğòK6$Ë(Ô¾ô:Š,-ïÎÒıY˜æ² ŠEP$9wKZşØêzÔçÖÚ¦}2¹‰&mb-´8#·Qj”™wÉLæ²ÉéÁşÂ¶ÂIŞ×İ\Z½\\‘şG´Ù×]lÂ¦ÕE/N§,c#$@óå6K¢Â¹bcDòªtµºZŠuÍk¢0ÃÊB¢Xç–E²ÄnÍkÖğ¢hŸ)¹†BU\n²Æl§¥ïğ:Õwjseò^…{òÌúÛäC‘ùÏ‹Ê„ti#õP}i»mş;ä£ò\rO0èÛ”)$bú\\\ZC9òyV`ÿ\0r\r×kjZBOšıºiUƒä$DŒÄô©Z\\øèH<“XY¬ëüèíÿ\0ç¶º™\"äÁÀe:B¹zsŸ©›ıÆF$—¹sr~uiF«šıLc-dtY\\Ç>wu¾6Òõ)É•ùSÔˆü‚G{±?\ZÚ®§Nr¯s‚r8æ9N€6$°7¹¿Ao]3û\nôL»ãÃå2‘	bHÚ£¹ğ­:o7É*®§«şÎq¸¼/-ÎçÆ™‰0¡*\nFãPÖ=Çj„ˆòFÙ´]~ğqùyÄ{²^RH±Ü5åZî<F™İœ»òåØYØ0µÉ\'­L§pğ~íÊÜŠd:ÚÇZ•b\"ÕâıÓ‘å\r%ş Õ“\"$Ş°½Å#Ø©’\Z6l~cx\Zşt\"ˆyÛZZE–MèI>9÷u $z} €P\n@(\0 €P\n@(\0 €P\n@(\0 >”YĞÒ³P’¢v}mz†\nYšF¨VËêxŞ ”SÌ’Ü’hYA[*I16øTªh‰¸Ôß±¡dÊé#+aØt%òÜZŞ7Ö€¨TÛ´øTSOÉE4?N¾ 5nWİ˜kÅ$k,N–6ƒàƒ{Ô2RgŠ>ğ}²û-îôÈËŸÛ­ÂsvüSzcİãaü«7JX¹9qôgæï¿şÌ¶O)öödœŒ!Ñ,aŞÄƒUÚzx|­×ò:\'ö‡;ˆÌ²q“‹_P„ôùU]Nßû\nÛ¹­ËÆò¸§râäÇ\"Ÿ)Ãü*ÕE-Ík£\'cs<ÌRªgñòç@4$©YäÖşug4kÇóüŒ6]Ñ²ÂË”¡ñY‘œ\\ãÉåqğ×­bñC>«‹ıŠ·Z¸dI\\\'èm:øÖ_A×¡è×ÈN©²9ÈQ a°mĞvéPëb™<‹ Vdİé;.ğU¶“ª Òµ}<M®äs›-ÅÕÍÇ«}&r¿)í1¶T¤éøÿ\0:}e(¾´†å†¾§Ğ9oæ8™ec´—çWX™çåó¬›N@¡VÖ½î?Æ¯ôNWæY58a¿éb4Ç¨ØCU^kO4½HÙw#JäâËİJÿ\0Y¼ge<ª·r#A“c·[uÕ~”Ÿs\ròk|Å>‘uä ú$ÈPaø\Z,%¿ìZ>œƒı\róÖ¥ae-å}¦8ñs2ŸjÆnzV‹çäçî}Mß…övfIVÃX±µÏÂÂ´Tƒ“/“TèwG·ı›úp…™…¬ÄwøTÁãgåÛ+Ôîÿ\0npYHñìFÜü^sIè/mafÄa%mmµªQVzÛæ7S¥ì*BZÛÂãä°ŒÄ÷¸°©*ÎÕâñr@[¡íz’ÍûÇŸÊFâGj±fnxPLvîSB†Í‹úV*lĞ°·Z ZF„T‰%®h”€P\n@(\0 €P\n@(\0 €P\n@(\0 Â/@`tĞüh_\nC“ÔA“ú-Q•ÒñÄßJˆ ®›oô(\nœ9õ\0TAdÊi¸ÙEì¿#Bt(³0gTƒØŠ‚ÉšæTƒcrc­F¤šæ\\v\ZsÛ]*¤\Z/+ëé´Û±:ßãBÉ]Ìbä8m57½UšIÍğ“äoº“{éU\"¬ä}™¿}àqÖã½	4¬ï·ñ¸oı¯Sáz‰iÙm\"boŠ·?ùjDš¶_ÚÅfb-»-V’³b#í\"5ÉÄöÒ¦BÉzô*gûNà2˜`íbEŠsòÓ£e&OÚ{ìŞàVõQ½|¾UÔ×rşÏg.â€zZ?ùÓh·–»(¦ûY™¬²H@¿”Z­/ÈZÄûo–5ı,„ßCkÚ¬’3|–ûŸÛ|ğl1\ZÍÚÔ’,–0}°ÎíˆA¿]u¨LÍØÙ0>Úæ­¯zèmS¸£±¼qÿ\0orFÛÆRÃ°ÿ\0•7¹6¤öâÖKk¸\\[â:TJ&®ÈëŸq}§—3!¥ÀããÃÖÄD,Äß…F‡V<öKVjGìÇ:ÀˆÑ~EMF†ßä1ØßqÌO“^ÖRE%yß©q‰ûw÷î¥±¦cÖÊ‡_ÆÔ”QälìNöéî(‹ÉŞäú_ãaMÅ^kÅÁ~Ş=Ëı½¼<§âÀ\n6dÛ}Náàÿ\0n^á“g«„!ùˆ ;—€ıºòl3^—\n¤ÔÀÜw7	ö)1öFvê-D†ãµøŸµc…´·Â­´‡s±¸ßaG\0P\"°îj`¬›¦µ0£høØTÁ]ÆËÀF€y/ó©‚$º‡‹D¶•0Aa\"¥¬*A1#µ¨ÀxP¶Ğ¨\0 €P\n@(\0 €P\n@(\0 €P\n@(ğÛ½Œíï@aoO^”vÙ­‰½?ó¡$gôu !ÉúMoj†IW7è¿ğª‚›\'ô7ü(J“^Éÿ\0iÖö½Ae&±™şÅßmşW;“ÿ\0·uõ6ş¨$Ğ¹/ûbÆû»Õ\\¤ĞùûKÍÿ\0R÷ÖÖ¨Ğ¾¦™ÿ\0in6õ·ôÿ\0A&¯•ÿ\0kXÛÔÿ\0òÔRÍÿ\0lüvöİj’\nÙí«kÓ_\nC“şÕİñø[ü*HÔ‰/ı£c{ß¿Nµ*C\"?ı¡c{[ğ©(Väÿ\0ÙŸıËZ','ÿØÿà\0JFIF\0\0`\0`\0\0ÿş\0;CREATOR: gd-jpeg v1.0 (using IJG JPEG v80), quality = 95\nÿÛ\0C\0			\n\n\n\n\n\n	\n\n\nÿÛ\0C\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nÿÀ\0\0Š\0 \"\0ÿÄ\0\0\0\0\0\0\0\0\0\0\0	\nÿÄ\0µ\0\0\0}\0!1AQa\"q2‘¡#B±ÁRÑğ$3br‚	\n\Z%&\'()*456789:CDEFGHIJSTUVWXYZcdefghijstuvwxyzƒ„…†‡ˆ‰Š’“”•–—˜™š¢£¤¥¦§¨©ª²³´µ¶·¸¹ºÂÃÄÅÆÇÈÉÊÒÓÔÕÖ×ØÙÚáâãäåæçèéêñòóôõö÷øùúÿÄ\0\0\0\0\0\0\0\0	\nÿÄ\0µ\0\0w\0!1AQaq\"2B‘¡±Á	#3RğbrÑ\n$4á%ñ\Z&\'()*56789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz‚ƒ„…†‡ˆ‰Š’“”•–—˜™š¢£¤¥¦§¨©ª²³´µ¶·¸¹ºÂÃÄÅÆÇÈÉÊÒÓÔÕÖ×ØÙÚâãäåæçèéêòóôõö÷øùúÿÚ\0\0\0?\0ıûç§?Z@ş´cı“ùÑöOç@c¯şĞšçƒô›ıCÄ_<FşEä©c-º<WP	I\r+‚U—¯Lkç¿ÿ\0ÁPş&øWR“gÀûH-cto$f ä…E^Ç$`=x¯´J+È=A®oÄ>ø±5ïiÓïÎçÊŒàKƒú×˜`3ªÑ_VÅrúÅ~kü¾óÈÆa3J±µ\nü¿%ùÙŸ$øş\nß¯ø¯TGÔ¾\nÛX1‚W’èjí,jÊW\0€¯»qïŒŒÿ\0ğW¯x&Îîox#IBÀC4—$’pedÈ=Ètç­{ÏŒ?à_³ß‰.¿´ô[ıè6ä’Æà2ƒÎr$H œ€Ã5óíIÿ\0îñïƒÚiüàÛßin»¡¸ÑÉ0°ä‹æ=Fr¹RqÂ×ÎU§Å¸*/ÛÔs_Í\r“ü=OšÌ©ñu\n-Â¥ıÿ\0+OüöŠñ‹}¨ê^1Ót‹T¾[IÚÛLˆKi!=·)!N0	©ç¥z¿ƒ¿o_ÚÖ-Nª|FÒ§³kt¸´]OH\rÂíVdU8ïSÏ|›sğ³á\'†æ¸±ñ¼Ï¢]Ç2!ÓõW€`I¹÷¸İ¸«rª8o˜+Õ´Û;\Zí)­5KyåE¶º·•fZà°ÊªîÚ:çŞ¼zY–&¥K}bW]9şzŸ#CÄ×ZkÎïòÿ\0€}›ğş\n*Ş7ñ„^ø©¤XiÑ^ŠÚòÅ·`‰|Ç8S×<mÇ#©â•\'‰f‰Ã#¨eu ‚B+óßöı‘>&üh¾¶ÖJcøiå.¬Y„“\'F÷‰äÆ¯¯Ğkkx­-£µ‚=©@@}şIWV‹uİ×F÷ğÑ¸ošb0òx½Vœ²jÍß’î?œıhç§?Z1şÉüëøëñßáOìÙğÇSø¿ñ›ÅöÚ&ƒ¥Bd¹»¸l–8$G\Zd‘±€Š	5íJQ„\\¤ì¦Œe9(Å]³°ç§?Z9éÏÖ¿%şÁH?àª_ğR¿Ú¢}göøioáƒšmÿ\0ÙG‰<Uc‹2‘±Şï!Ï•ò3aŠ`\\ş¯h±jĞèöëÓÃ5ò[ ¼šÙ\nFòíÙ’UKd€IÀîk\n5åY¿u¥Ñ¾¿©Ñ‰Â¼5”¤œº¥ºõèZç§?Z9éÏÖŒ²:1şÉüë åzsõ£œıhÇû\'ó£ìŸÎ€zsõ£œıhÇû\'ó£ìŸÎ€=Mzš9õ£ŸZ\08õ4qêhçÖ}h\0ãÔÔ\Z–¥¦iRj:¾¡\r­¼KºYîeˆ=K1ÀZùŸş\nWÿ\0Bø3ÿ\0êğ7\'‘u_jğ;h>\Z…²ì£ Ï6R Ü…Î@Æ—ñ‡ãgüKö©øñâD×üqâhmt×rÑéqÃ…ƒ$áTgj¸<\0İ‹7Sçâ³,6I;¿#êøƒ3Î#iá©û¯«Ñ?Nçî/ÇOÚÛöÓ4é´ß‹Ş0ğÎ»`†´}8j#ğÂ:÷õ¯Î?Ûö·ÿ\0‚>C¦êÑüÔ|]ğ÷Æ¦M3[Ò4‡:kÜ(Ê$öÒ\\h‰àíU#$Œô?\nÉûs|Q¾Ôû3Æš„1ÖŒ€íÏçŠšÇãßŒü{ây<!â;;}iDû.a¼¸e`Ø ÈU·ƒªp{WËc3\\`ù*a¹»]FëÍu_\'sõŠGŒU\\;­ŠÄÒºW³R)úåû;Áb<{ñÃá7‡ øIû?Zëş!Å-µó¸°Û[Ü\"æ	¸E ôÆGU`=Kı à Z‡ïeø=ğÚÇ)lÚıÁ}¤eNG¯Ò¾ı?dÚÃPøkñcöxğ¯4™.\"6ğ$6bš=Ä¸-	P0ÊÒ	çåã>£©Ã|\"Ôg¸ñ¯À›İVâæ5uáÍYd2£T~qŒğ[Œq^¥*øøÓN\\Í|¶ó·_øsÀ¡ÂÙ.SÂNt%87«rmú§(Ù¯$ö=gÆŸğSï_\n|;®øÛâÀÃ*ÿ\0Û\Zå¿ˆæ·¶ŒªÑDóCû×ŞÁ¸F~¿ı¢$ÿ\0‚¯~ÒÖÿ\0m•×ô?ÙçE¾š?xGÃ×Æ·q„tƒ#u`VY@Üî¥€¿$ß·ûEşÒ~ğ×Ã_Áş9ğ×…,nüıgNOJò]¹n²1!wmßÆX’’Ïö{ı¦ş5É§øà¿ìå¨Øhº%šÛx~ÓV²6Ö±Bœ`£¥±“–cŸ©åK‹m&›òjÿ\0×‘Õ†á\\š­iÔ”cJšMs)ZúoyJÊİmnÛ­h/Ù%¼gáÏ„~:ğ¾“¢èöi\r®“jÑÙEa\nŒ,b\"F\0\0ÅlŸÚöp‹vøáá•bp7k1\0OÔ¶+ófÏşçûmx×Ãpj.øÃá½1í™Œ\Zk\nnì\\ğp0}H5ñí…cãßÙ·ÆW?üiñ\'ûRòÎeó…”ã(9ëËú<sÚ»jãñt`¥(iıt¹åeœg©ÑÃcy¤º%üšÉ?ÃæFZŠ<3â‹O·xkÄVZ„\'¤Ö7k*şjH«üzšş\\¾şß¿¾xš-[Àõk&…±(²F}Á ä~|Wëwüßş§à?ÚWPµø%ûAj°i\'‘U4½r}‘G¨“ÀY@Â¤Ÿí)ôZÓšÒ¯.Y«?Àó¸—Ã\\Û! ñŸµ‚ŞÊÒKÓ[ÿ\0Z£üzš8õ4Šw«dzÒóë^©ù¸qêhãÔÑÏ­úĞÏ¡üèçĞşt›‡÷¿J7ï~”\0¼úÎ¼Óö¹ı¦¼û\"|ñÇO¸h4{6kK ø{Ë“ÄP¯»1Ød×¥nŞı+ñ?ş%ı­õ/|R‡ö~²ÔJi^a$öñÎq$ä¹—¡?|Lö®<v\'ê´–ïD}ä²ÏshaşÎòÿ\0\nßïØüöı©iˆ¿µ—ÆMkãÆmu®uûã$Q\06Æ‡……OUŠ5\nªœIêN|³UÔµi$»Ÿzùx†4|r;äsƒ×ß§ÕŸ%İè†ÖÎÏÉxÎÙYÉå‹“˜{}kˆñ¦½r59AP­ŒàwÆĞWÅ>z²»?´x•e4RÖ)$–Évù—>$€HšsO÷Üg°8ü?•z§ÂÏ‰6ŞšÙt-J¬ª†iW¥²Ù`2O8Éíé^pd]@@øWòÁ±$¨=GÖº=âgˆ|\"SI•§‘-.|È¬İˆX¤#°z\0N•¬))$Ñëâ³/İÎ/]6óìGŸ°7íkğ³Âßt¯ÛköÖímoçÈ‰ $+rO<ŸJ÷íkö°øaa§ÏâkzÊK+H7\\ºN¼ggĞã§N½ëù”ğOí¬Z!ÖfñÖ¡¥Ş‰‡îìœ)ÈfnG9ÙÀ\0œûwú§íåãÃÑøoJñL—¶W5Ì×P0è£ïÆ?ã½U™Îœym±ø†+ÂŠY†2Xk¬Úk]wÔş…ô_Û»à½Ú¬u;SC™¤eQ¼&í™=O8úæ¸Oÿ\0Áb?dŸ‡¾µ¹¸ñbÉ¨ß	M®	Â±U.Ã„İŒàóÍ~\rZşß:®‹¥®gorÖşC!™e\0‰NCsÎ8ô\'‘œ&—ö…×õ]uµm\\C|ş[B#¹;Ö>ùR_zÎY¶/—İ±ß€ğc ©Yıjr¶é\'«õòz®¿´·üµ$×ô[ğ›ı4K”r„€¬@İµ†ÖÇ±äƒù3ûH||ñ/Ä‰ÚÇŠõ½R;Ùµ+ærĞç`<.Fvààg°Çjâ|Iãur÷7îÛvÇ°Æ[>Üó×Ú¹-_Zhï£¸Óäv’5¾0UêZóêâkÖw›?KË8g‡xWã…¤®í®î×½‹Sñº»˜ì­$\rd¾{mQœñØÏn*\rÇº—‡55m7R¸‚H’6C÷fÜ9û Œ¨÷ãíÌñEnds÷”ƒœœşõ™w¬¼ò¬rÂ®Ğ\0Î;œw÷¬©T›–Ç^cSèrÍ\'Æçô«ÿ\0\rÿ\0‚7í}ğt|ø­¯$¾7ğµk9¦›÷š•‚ársË<yPOue=š¿DyÇCù×òGÿ\0áı­u¯Ù\'öšğ¿Æ ÊÒx{TIîa‚aş“l~I¡ÏB$‰™=·gµY¾ñ6‹ã?iŞ/ğåúÜéú­„7–7	ÊË¨{`\Zúì·*ÔÜeºüãß2\ny.rçEZK´»>«õûËüúÎ}çI¸{ô£pş÷é^‘ğbüşÔ|şÔ˜_îš0¿İ4õÈ²²šò\\mŠ6vúšş_¿à§?¾ø‰û^ø³Z–ãy“RÜû[!rqÇ·9ükúfø­¨áˆõtC›]\nîP?İ…Ïô¯äÏöšñÃxƒã–±y5ÃK²²’9gG(•xYËrå‚ógëŞàı¦*¾!­Šûîÿ\0C9¯-MØ²-”ˆåÜŸ¼x?Î¼×â;Co¯‹¨—)4[×Œe²Gô®Â]^Ò{d¢€º¶O=={ÿ\0õ«„ñ­Í¶¯¯Ü4·ÖÙRİQ3¹éœñÁ<óĞzñ!“gíôªU-(õş¿CkÉaC2³nşñ<TÚ”úÜ“Å©jSHò^\'š³<›šEÉ\'®r_J¯§Ák5ÄiªÏ*ÛyƒÏh€fTÏ$@\'¨ÍµÀTŸk‹¬{ã¨ıGçO:©\\în£õÔÓ\ZüĞ[>HIŒÍ!OŸ<×t÷5¥§j¯s¥I$ÚœjÑJ¾U©Œîps–ÀúñĞ×+\"8n©äÖÁ¼Ñ[Kµ†Ê9VçæûC¼€«sò•A\\IÏ·JŠ¶Œlì.¤«>w±&©â+Ãn4ÁrÂûü­Çˆäã±àS4ù¥ØUI_“xóŒSNŒÂüZêLmK*±k…aò°È=3‚=:\Z§,>JŒÜ`@Û×Ådæœl–¦î¦\"om7u¶æ­Î¯äqÆ–¢&D\n]XÇ\'zğ¨5iN‘¹I[Îu;¶\n;zóÅQ³¼šh‚İ´œ\0jy&kÄ’7Œ°–\'jÁûDÒèoõ˜×¢åyìÈf[4©ÎTç¯­2im¦¹[_•# ıÒ89úÿ\0Zu…w¨ÍµŠ³³w·Âÿ\0êw†H÷È\0!ŸÊºèÑ“<V7ÙA)éÿ\0\'Ã£oUvÅ&ÿ\0/~Hàd.?\Zş«à‹¿5?Š?ğM?…ú¦¯3Iw¥hòhÓ;œ’¶sÉoşBHëùšøUğ7W½×l¬ìtâ.ÕÓr6Jãœã–Î+úUÿ\0‚(ü3Õ¾şÁZ\'‚µ¶İ4\Zæ£&åèUç$í^öZœjéØü?Äú”káa.ªKòw>´ùı¨ùı©0¿İ4aºkİ??íÑŸöéyôsè(3Æ\Z<~\"ğ–©áù~e¾Ó¦·eõ…­ ´g‚<GáoŒzÕ†½jËv5Y…È7—bñáŠşÃ˜1_ÏÇüãö!¿Ğ?kÏë°x}_O\Z“Ë§ä‘w©ÇQËuÿ\0kØ×‘šÅÅF¢ì×ëú¬xW™Ç\rŒ¯†›IMEı×Vÿ\0ÉÍYÿ\0³4ö1¸cˆÀJ6•¯ `öoÏË\\Ëex$eCpgbÎÍò”À\n\0ìzór=9õ¿‰¿ïtMVáä±vóY™ÚU$’Çß½q·>¸’BaÒU#y2#\'h>şÕó1ªúŸĞôİªû;Zµ»Óvië$SF@pñ(<²ƒ‚ØÉÇLt?Šiñ¬Yììİ•B‘ç^‹ià¨®Ò	¢²Œ1[ÜƒÍvŞ´h,şÉŠÅ\"`Ç!PF_”‚}ı)F¯,omM±8xÏ£	iÓîØñÄğn§ºéwš*™VmÛĞåq÷s¸ü3ïPßxBæ	e¼·²dˆH|˜[’¡<g¸æ¾‡Â:}Í¢H!c6	—zŒNüÕ£YM0Ó¯aR¿#Ëç×ëKÚ©»Ót¬¥o&xEæ•«ÍjVYüÆFƒq$u§`?Uí4c*ÿ\0§9Œ\r¤\Z÷sàÍíRŞîl©;\0^¿Z«7…tùá1‹¤MÃåd~´“‡B¥/y9jxÌšòbšZ3!\0ª¤vÁ®›Ãÿ\0õÁ,³jVP}™•¶£7Ì§cÎ½;Kğ…¼\"Î\r<$¤¯–±®2\n½&“,À¡P±Ê¨ÀÍR’Nèr²ƒPV9\rÂé„É`›‚|ÎcÇ^ÿ\0­\\ğÖ$ÕdÓ¢,¢HÃHÁrzšèÎ“ä[™/\\°f\n«¿’>Õ­áMÒåòí¾wyeû£=+¦‹»»>_3„•>[Éû3øB9¼_¡YAnÌ¯r­,’IU`@õ¯èWöPğ¤^\røáİ\Z1´›C+ñüNå¿¨¯ÃOØûG—\\ø•áëhíüÃ$¨#ˆ\'ÌÎX‚\0ú_¿¾ÑäĞ<#¦h’€^ÒÂœú² şy¯ Ëb®Ùø/Ö—=*mÿ\0HÓÏûtgıº^}ú\nõOÎÏûÔgıê2}¨Éö ?ïWÂßğVOƒö“İAãô¶ıÖ¥bm¯$ÛÑĞpIÿ\0woå_täûW’~Úß#ø…ğ#Sµë$¶‹ç¦W<c1ô5Í‹§íh4{\\?ŒxŞ•Ké{?ŸüùîøÍğú8u\'·½^8Ø³#(İ‡ñçô¯.¸ğŞ–»¢Œ¬L>eœŸo©¯¨ÿ\0iİizÌğ]Úì;.H”€Iîrsï_<x–È³aFO¸í_4á>Sú÷*©N3ò9a¤ØF#¸hK(“•aŒàôÏ½Z´Ó#kÁç’¨ÈHÇj/¥I®D0N’‚BŒ”ê?8‚PøCóÙõÅKæ{¬ıâød‚f[cÎCÏıª”öVò–›Ÿ7øˆ^\rOo<¢ä,Áv(ùp1Nİc9bzgŒÖjğgLıhêf^YËGo\r¶çv™NA*YŸ\"FòBÀ\0mê}ı+U`X¸@Í/È[¾zR^D–!–@Í‚\n>zı*ã4ÌeJÍ¾†`k‰!k×*ä`şqKk  ib2Á@-ÿ\0ë«¥ºJĞG\n¦ôÃ¸ äp{ŸoÖ’êÓl²[Ú¢áF‡Ê>£ŒÕÇ–ç-iTŒ.ŠÒZİİ³˜‹¬LÜ¹õ®«Á:sİŞ£+1y†Ğ6çŸ‡ÿ\0Z¸½·6(ĞÅg y™·µêß<=uªëVÖÖÀ3Ï2D¿.	9Šï¥m“Ì±1|ş§èOüÏà\"øÉiâmVÛÍ‹JƒzeNÕ*¿×ŸÆ¿\\;cšùwş	sğ*?†?Ï‰®íÊ\\êd.¸;\0ş8ñ5õOµ}>Ÿ³¢¼Ïæ(Ì?´3i8½#¢ÿ\0½FŞ£\'ÚŒŸjë>p1F(ÀşùüèÀşùüè\0ÅWÕ´Û]cL¸Ò¯cİÄ-€ªF\rXÀşùüèÀşùüèÜi´îÈ/ø(ìã{áíYhìØ,bPªK	ÃPP‚=«óÃÆZSZNöF¬ŒAÏ€ïŠıùı¿~\rÙkÚ_’Ø4QÇöMcjg÷Dü’÷IÁ>˜¯Æ/Û\'à•÷ÃO\ZLŠÈvg¶}¿)SÈÁüz{×ÉfxOgQÉÑq*Åá£B¬µ_¦ÿ\0×cæ½FÇìÏ$kÈ•×w?ZkŞGr‹(vg\0mçş•röy‹yfÜ»ìÎĞ=ûõAmey|ÕFAŒfçŸoJómj~¦§ÊÛÌºFd’K•@à~µZX«X³!<2Œ•ü;Ò¹ùnQ&xÈzÖeİÅÄ\'†2@\';¹õíO•ßQJ®ÒFªkrJël.#Ï¸ì}ÿ\0Æ¯>¤±Û–\"IXòF=+šIU.`P_•1°ÈOÁUb¸˜7ãğ©öz—õÈ¨êÎ’]HÉåG\nìÛœçŸëUnõ«Ì”•¶³K’[ğ=«*MDZpº®;U±*Ü ÛÆXî-è=ëztßcÊÅãOµ°û(õkUæuòÃgİÆìö¯á_nÁ4~Ïñâe•åÅƒO2)vÛÆAzdäîkå‡¾mJê’­¸Äg“Àà^+ö«ş	%û5Eà	Ùk×ö!eı¦Veçı…?8ÿ\0f½|%z©v?4ãçêYlš~ô´GÛŞğå·„ü/cáÛTU[[uC´`˜şy­<QıóùÑıóù×Ñ¥d?6äîÃbŒïŸÎŒïŸÎĞQ†ô™íQ‘şÕ\0.ĞQ†ô™íQ‘şÕ\0PñW†tÏør÷ÂÚİ¸’ÒşÙ¡kdÄuÔWåíóû9ßøsÃ×~	ñ¥£NÖbØêHŸ7‘’b”zíã8ädcú»‘şÕyí‹û<[|~øU}¦iÖªu‹{w6@Lƒ˜óî29õê:<mmIÛsè¸k6y^c\'h6¯äûÿ\0Ÿüù­ñ¦ƒqáÍnx$Y¬‰îºäŒƒß‘Y¨Öèæ6…Ãª“Ëƒø×«~ÕñÃÏj:±§ºµã£˜ ƒ‚¬!‡qøôæ¼<L­(…nÃÆ…X}ÑŒİ+ämfÓ?°ò|=,Ç\Z´äŸ£7Æ|Š0ŞFNpx=¸¬K«@²îXbwİò«®â1ÎrzUÛÙßÛ,#jlRÄ¤™ç·\'ùUMGU³HÅâRÑ™“\'‡\\˜­9Œ«eõ©IÆ=\n)}\r¼’¿ˆ>éLs‘Ÿò*;«Ä’v¾IÁ‘nrxúš§-İ…´ İÏ\ZÆFq¼2rsøbªÜjú4r7ÙnÃ<Â¤6O~:Á>•¤i=Î\nØ\Zñ‰¹¥èÊÍÑ›, Vÿ\0‡¬©©™@şg·á^}²cMÖ·¡Á¸pxë?±ÿ\0ÃOşĞ4ß…ôIµ\rOU¹Xí¡ÿ\0x–=.I=2zWE:rlùÌÎAÔªì–¯^‡ÕğOŸÙ²çãÅ˜æÆC¦éë·®;ÏbOrxõë_»Ÿ¾ÇğçÁúI·H§‘CNˆ8€1ì õÍxÏìÿ\0ÿ\0Ğ?d?\0Û/‰o Õ<K0ŞÜÅî¡”»f~ñ÷íÛÖ¾“È{ØL;£½Ùü÷ÅYìs|m©?r:/?1pŞ‚Œ7 ¤Èÿ\0jŒö«°ùQpŞ‚Œ7 ¤Èÿ\0jŒö¨sşİÿ\0n—ÒŒJ\0Lÿ\0·U¯ïÚÍ*\"­`zTW*¤r£§¥\0qÚïÄjËq·ÓIÇJã5ÿ\0Ş.ÓƒìcL•éÚŒ0²¶èTıTW\rã]>Áâpö0‘ñ\n—ráfõ?8?à¦ÿ\0²o‚iÙnş&i~4OxÇÊù¯ííYíïˆéçÆ¼îÿ\0ldú‚y¯ÅOŒ¿iÏ†4¼²×¼\ZºêE+ªh1·—7?xªN}Ô\Zş>9èº<–ÒyšM³pzÀ§úWÈ_ü7áÖ»“vdryÍª…y•pôe;µ©öY/çÙ$TpµšKkëoø[ŠGWø…amæMáM^d¤´e+õášÃÔ¾&ø›æ…´;ÀÀ½õúñ¬ø?ÂRó<-§7ûÖ1Ÿé\\/Š¼à9n3/‚t†ä}í6#ÛıÚK	K¡õrñw‰¥MFJ7ïoĞü·²ñ\'Äp›-/@¸•œÙŒŒ÷ÆM&©¨|FğÜË¹áK¨.TIo€ÃÔâ¿Xş|9øz.hİ¿æÿ\0^Ûá„Ÿ\nµØÿ\0Ã/Np?×h°7óJo\rOÌócâwº—”Ó?\r<;?Äïj©eá¯ßK#7.€¾ùÅ~›Á´ÏŒŸ³_‰î<k¡x&yuíJ!ê­f]­à\'-yû»7§\0tÎF¾\rüøAi4Okğ«Ãq0aƒ‡n§ôJú¯á„¼)co\ZÙxcO„\00\"²qù\nÚ(ÇcÂÎøÃ9Îé:X‰û¯tº˜¿¾:|jññ&‹+1Q–x6š÷kZİüA¯¬¶9Í.‰egÊ´‰İŒ\n×‰Tc\n•Ü“±ñí¦9X‘’Ø4¹ÿ\0n—ÒŒJb?íÑŸöép=(Àô ÿÙ','1134_apple.jpg','image/jpeg','/../ximages/item/2',65830,NULL,NULL);

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

insert  into `item_unit`(`id`,`unit_name`) values (1,'á”á“áŸ’á‘áŸ‡'),(2,'á”áŸ’ášá¢á”áŸ‹'),(3,'áŠá”'),(4,'á€áŸ†á”á»á„');

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

insert  into `settings`(`id`,`category`,`key`,`value`) values (32,'exchange_rate','USD2KHR','s:4:\"4000\";'),(33,'site','companyName','s:18:\"Pharmacy Veal Sbov\";'),(34,'site','companyAddress','s:36:\"#112, Street No 1, Sangkat Veal Sbov\";'),(35,'site','companyPhone','s:11:\"85512777007\";'),(36,'site','currencySymbol','s:3:\"USD\";'),(37,'site','email','s:14:\"yoyo@gmail.com\";'),(38,'site','returnPolicy','s:93:\"á‘áŸ†á“á·á‰áŠáŸ‚á›á‘á·á‰á á¾á™á˜á·á“á¢á¶á…áŠá¼ášáœá·á‰á”á¶á“á‘áŸ\";'),(39,'system','language','s:2:\"en\";'),(40,'system','decimalPlace','s:1:\"2\";'),(41,'sale','saleCookie','s:1:\"0\";'),(42,'sale','receiptPrint','s:1:\"1\";'),(43,'sale','receiptPrintDraftSale','s:0:\"\";'),(44,'sale','touchScreen','s:0:\"\";'),(45,'sale','discount','s:0:\"\";'),(46,'receipt','printcompanyLogo','s:1:\"1\";'),(47,'receipt','printcompanyName','s:1:\"1\";'),(48,'receipt','printcompanyAddress','s:1:\"1\";'),(49,'receipt','printcompanyPhone','s:1:\"1\";'),(50,'receipt','printtransactionTime','s:1:\"1\";'),(51,'receipt','printSignature','s:1:\"1\";'),(52,'site','companyAddress1','s:18:\"Khan Mean Chey, PP\";'),(53,'receipt','printcompanyAddress1','s:1:\"1\";');

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
