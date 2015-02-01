/*
SQLyog Ultimate v8.82 
MySQL - 5.5.40-0ubuntu0.14.04.1 : Database - bakou_pos_hmart
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
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

/*Table structure for table `AuthItemChild` */

DROP TABLE IF EXISTS `AuthItemChild`;

CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) CHARACTER SET latin1 NOT NULL,
  `child` varchar(64) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `account` */

DROP TABLE IF EXISTS `account`;

CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `current_balance` decimal(15,4) DEFAULT '0.0000',
  `status` varchar(1) DEFAULT '1',
  `date_created` datetime DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`),
  KEY `FK_account_client_id` (`client_id`),
  CONSTRAINT `FK_account` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `account_receivable` */

DROP TABLE IF EXISTS `account_receivable`;

CREATE TABLE `account_receivable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `trans_amount` decimal(15,4) DEFAULT NULL,
  `trans_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_datetime` datetime DEFAULT NULL,
  `trans_status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `note` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `FK_transactions_account_id` (`account_id`),
  KEY `FK_transactions_employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `account_receivable_supplier` */

DROP TABLE IF EXISTS `account_receivable_supplier`;

CREATE TABLE `account_receivable_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `trans_amount` decimal(15,4) DEFAULT NULL,
  `trans_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_datetime` datetime DEFAULT NULL,
  `trans_status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `note` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `account_supplier` */

DROP TABLE IF EXISTS `account_supplier`;

CREATE TABLE `account_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `current_balance` decimal(15,4) DEFAULT '0.0000',
  `status` varchar(1) DEFAULT '1',
  `date_created` datetime DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`),
  KEY `FK_account_supplier_supplier_id` (`supplier_id`),
  CONSTRAINT `FK_account_supplier_supplier_id` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `cash_register_balance` */

DROP TABLE IF EXISTS `cash_register_balance`;

CREATE TABLE `cash_register_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `begin_cash` double(15,2) DEFAULT NULL,
  `sale_cash` double(15,2) DEFAULT NULL,
  `sale_credit_card` double(15,2) DEFAULT NULL,
  `sale_on_credit` double(15,2) DEFAULT NULL,
  `cash_received` double(15,2) DEFAULT NULL,
  `cash_total` double(15,2) DEFAULT NULL,
  `counted_total` double(15,2) DEFAULT NULL,
  `over_short` double(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `currency_type` */

DROP TABLE IF EXISTS `currency_type`;

CREATE TABLE `currency_type` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `currency_id` char(3) CHARACTER SET utf8 NOT NULL,
  `currency_name` varchar(70) CHARACTER SET utf8 NOT NULL,
  `currency_symbol` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  KEY `FK_employee_image_emp_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `exchange_rate` */

DROP TABLE IF EXISTS `exchange_rate`;

CREATE TABLE `exchange_rate` (
  `base_currency` varchar(3) NOT NULL,
  `to_currency` varchar(3) NOT NULL,
  `base_cur_val` double(15,2) NOT NULL,
  `to_cur_val` double(15,2) NOT NULL,
  PRIMARY KEY (`base_currency`,`to_currency`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `inventory` */

DROP TABLE IF EXISTS `inventory`;

CREATE TABLE `inventory` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_items` int(11) NOT NULL,
  `trans_user` int(11) NOT NULL,
  `trans_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trans_comment` text CHARACTER SET utf8 NOT NULL,
  `trans_inventory` double(15,2) NOT NULL DEFAULT '0.00',
  `trans_qty` double(15,2) DEFAULT '0.00',
  `qty_b4_trans` double(15,2) DEFAULT '0.00',
  `qty_af_trans` double(15,2) DEFAULT '0.00',
  PRIMARY KEY (`trans_id`),
  KEY `FK_inventory_item_id` (`trans_items`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `count_interval` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_category_id` (`category_id`),
  KEY `FK_item_supplier_id` (`supplier_id`),
  CONSTRAINT `FK_item` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `item_count_schedule` */

DROP TABLE IF EXISTS `item_count_schedule`;

CREATE TABLE `item_count_schedule` (
  `item_id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` double(15,2) DEFAULT NULL,
  `first_count_date` datetime DEFAULT NULL,
  `next_count_date` datetime DEFAULT NULL,
  `count_interval` smallint(6) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `item_count_schedule_dt` */

DROP TABLE IF EXISTS `item_count_schedule_dt`;

CREATE TABLE `item_count_schedule_dt` (
  `item_id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` double(15,2) DEFAULT NULL,
  `first_count_date` datetime DEFAULT NULL,
  `next_count_date` datetime DEFAULT NULL,
  `count_interval` smallint(6) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_id` int(11) DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `item_expire` */

DROP TABLE IF EXISTS `item_expire`;

CREATE TABLE `item_expire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `mfd_date` date DEFAULT NULL,
  `expire_date` date NOT NULL,
  `quantity` decimal(15,2) DEFAULT '0.00',
  PRIMARY KEY (`id`,`item_id`,`expire_date`),
  UNIQUE KEY `item_expire` (`item_id`,`expire_date`),
  KEY `FK_item_expire_item_id` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `item_expire_dt` */

DROP TABLE IF EXISTS `item_expire_dt`;

CREATE TABLE `item_expire_dt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_expire_id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `trans_qty` decimal(15,2) NOT NULL,
  `trans_comment` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_expire_dt` (`item_expire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  KEY `FK_item_image_item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `item_price_promo` */

DROP TABLE IF EXISTS `item_price_promo`;

CREATE TABLE `item_price_promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `unit_price` double(15,4) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_id_udx` (`item_id`),
  CONSTRAINT `FK_item_price_promo_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `item_price_promo_dt` */

DROP TABLE IF EXISTS `item_price_promo_dt`;

CREATE TABLE `item_price_promo_dt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_price_promo_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit_price` double(15,4) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `item_price_tier` */

DROP TABLE IF EXISTS `item_price_tier`;

CREATE TABLE `item_price_tier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `price_tier_id` int(11) NOT NULL,
  `price` double(15,4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`item_id`,`price_tier_id`),
  KEY `FK_item_price_tier_item_id` (`item_id`),
  KEY `FK_item_price_tier_id` (`price_tier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `price_tier` */

DROP TABLE IF EXISTS `price_tier`;

CREATE TABLE `price_tier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tier_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `discount_amount` decimal(15,4) DEFAULT NULL,
  `discount_type` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_sale_emp_id` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  KEY `FK_sale_item_item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

/*Table structure for table `sale_item_log` */

DROP TABLE IF EXISTS `sale_item_log`;

CREATE TABLE `sale_item_log` (
  `sale_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8,
  `line` int(11) DEFAULT NULL,
  `quantity` double(15,2) DEFAULT NULL,
  `cost_price` double(15,4) DEFAULT NULL,
  `unit_price` double(15,4) DEFAULT NULL,
  `price` double(15,4) DEFAULT NULL,
  `discount_amount` double(15,2) DEFAULT NULL,
  `discount_type` varchar(2) CHARACTER SET utf8 DEFAULT '%'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  KEY `FK_sale_payment_sale_id` (`sale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  KEY `FK_sale_suspended_emp_Id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  KEY `FK_sale_suspended_item_item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `sale_suspended_payment` */

DROP TABLE IF EXISTS `sale_suspended_payment`;

CREATE TABLE `sale_suspended_payment` (
  `sale_id` int(11) NOT NULL,
  `payment_type` varchar(40) CHARACTER SET utf8 NOT NULL,
  `payment_amount` double NOT NULL,
  PRIMARY KEY (`sale_id`,`payment_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT 'system',
  `key` varchar(255) CHARACTER SET utf8 NOT NULL,
  `value` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_key` (`category`,`key`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tbl_audit_logs` */

DROP TABLE IF EXISTS `tbl_audit_logs`;

CREATE TABLE `tbl_audit_logs` (
  `unique_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `ipaddress` varchar(50) CHARACTER SET latin1 NOT NULL,
  `logtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `controller` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `action` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `details` text COLLATE utf8mb4_unicode_ci,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `trans_amount` decimal(15,4) DEFAULT NULL,
  `trans_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_datetime` datetime DEFAULT NULL,
  `trans_status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `note` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `FK_transactions_account_id` (`account_id`),
  KEY `FK_transactions_employee_id` (`employee_id`),
  CONSTRAINT `FK_transactions_account_id` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  CONSTRAINT `FK_transactions_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

/* Function  structure for function  `func_cu_item_schedule` */

/*!50003 DROP FUNCTION IF EXISTS `func_cu_item_schedule` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`sys`@`%` FUNCTION `func_cu_item_schedule`(i_item_id INT(11)) RETURNS smallint(6)
BEGIN    
    
    DECLARE p_trans_datetime DATETIME;
    DECLARE p_return_id SMALLINT(6);
    
    SET p_trans_datetime = NOW();
    SET p_return_id=1;
	
	INSERT INTO item_count_schedule(item_id,`name`,quantity,first_count_date,next_count_date,count_interval,employee_id)	
	SELECT item_id,`name`,quantity,first_count_date,next_count_date,count_interval,employee_id
	FROM (
		SELECT item_id,`name`,quantity,first_count_date,
		       DATE_ADD(next_count_date,INTERVAL count_interval DAY) next_count_date,
		       employee_id,count_interval
		FROM (
		SELECT i.id item_id,i.`name`,i.quantity,i.count_interval,`status`,
		       CASE WHEN ic.first_count_date IS NULL THEN p_trans_datetime
			    ELSE ic.first_count_date
		       END first_count_date,
		       p_trans_datetime next_count_date,
		       2 employee_id
		FROM item i LEFT JOIN item_count_schedule ic
			ON ic.item_id=i.`id`
	        WHERE i.id=i_item_id
		    ) AS t2
		WHERE `status`='1'
	) AS t1
	ON DUPLICATE KEY UPDATE quantity=t1.quantity,
		next_count_date=t1.next_count_date,
		count_interval=t1.count_interval,
		employee_id=t1.employee_id,
		modified_date=p_trans_datetime;
	
	INSERT INTO item_count_schedule_dt(item_id,`name`,quantity,first_count_date,next_count_date,count_interval,employee_id,remarks)	
	SELECT item_id,`name`,quantity,first_count_date,next_count_date,count_interval,employee_id,'CU ITEM' remarks
	FROM (
		SELECT item_id,`name`,quantity,first_count_date,
		       DATE_ADD(next_count_date,INTERVAL count_interval DAY) next_count_date,
		       employee_id,count_interval
		FROM (
		SELECT i.id item_id,i.`name`,i.quantity,i.count_interval,`status`,
		       CASE WHEN ic.first_count_date IS NULL THEN p_trans_datetime
			    ELSE ic.first_count_date
		       END first_count_date,
		       p_trans_datetime next_count_date,
		       38 employee_id
		FROM item i LEFT JOIN item_count_schedule ic
			ON ic.item_id=i.`id`
	        WHERE i.id=i_item_id		
		    ) AS t2
		WHERE `status`='1'
	) AS t1;
	
	RETURN p_return_id;    
    
    END */$$
DELIMITER ;

/* Function  structure for function  `func_stock_count` */

/*!50003 DROP FUNCTION IF EXISTS `func_stock_count` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`sys`@`%` FUNCTION `func_stock_count`(i_interval smallint(6)) RETURNS smallint(6)
BEGIN    
    
    declare p_trans_datetime DATETIME;
    DECLARE p_return_id smallint(6);
    
    set p_trans_datetime = now();
    set p_return_id=1;
	
	INSERT INTO item_count_schedule(item_id,`name`,quantity,first_count_date,next_count_date,count_interval,employee_id)	
	SELECT item_id,`name`,quantity,first_count_date,next_count_date,count_interval,employee_id
	FROM (
		SELECT item_id,`name`,quantity,first_count_date,
		       DATE_ADD(next_count_date,INTERVAL count_interval DAY) next_count_date,
		       employee_id,count_interval
		FROM (
		SELECT i.id item_id,i.`name`,i.quantity,i.count_interval,`status`,
		       CASE WHEN ic.first_count_date IS NULL THEN p_trans_datetime
			    ELSE ic.first_count_date
		       END first_count_date,
		       p_trans_datetime next_count_date,
		       2 employee_id
		FROM item i LEFT JOIN item_count_schedule ic
			ON ic.item_id=i.`id`
		    ) AS t2
		WHERE `status`='1'
		AND count_interval=i_interval
	) AS t1
	ON DUPLICATE KEY UPDATE quantity=t1.quantity,
		next_count_date=t1.next_count_date,
		employee_id=t1.employee_id,
		modified_date=p_trans_datetime;
	
	INSERT INTO item_count_schedule_dt(item_id,`name`,quantity,first_count_date,next_count_date,count_interval,employee_id)	
	SELECT item_id,`name`,quantity,first_count_date,next_count_date,count_interval,employee_id
	FROM (
		SELECT item_id,`name`,quantity,first_count_date,
		       DATE_ADD(next_count_date,INTERVAL count_interval DAY) next_count_date,
		       employee_id,count_interval
		FROM (
		SELECT i.id item_id,i.`name`,i.quantity,i.count_interval,`status`,
		       CASE WHEN ic.first_count_date IS NULL THEN p_trans_datetime
			    ELSE ic.first_count_date
		       END first_count_date,
		       p_trans_datetime next_count_date,
		       38 employee_id
		FROM item i LEFT JOIN item_count_schedule ic
			ON ic.item_id=i.`id`
		    ) AS t2
		WHERE `status`='1'
		AND count_interval=i_interval
	) AS t1;
	
	return p_return_id;    
    
    END */$$
DELIMITER ;

/*Table structure for table `v_receiving` */

DROP TABLE IF EXISTS `v_receiving`;

/*!50001 DROP VIEW IF EXISTS `v_receiving` */;
/*!50001 DROP TABLE IF EXISTS `v_receiving` */;

/*!50001 CREATE TABLE  `v_receiving`(
 `id` int(11) ,
 `receive_time` datetime ,
 `supplier_id` int(11) ,
 `employee_id` int(11) ,
 `sub_total` double(15,4) ,
 `status` varchar(30) ,
 `remark` text ,
 `discount_amount` double(25,8) 
)*/;

/*Table structure for table `v_receiving_item_sum` */

DROP TABLE IF EXISTS `v_receiving_item_sum`;

/*!50001 DROP VIEW IF EXISTS `v_receiving_item_sum` */;
/*!50001 DROP TABLE IF EXISTS `v_receiving_item_sum` */;

/*!50001 CREATE TABLE  `v_receiving_item_sum`(
 `receive_id` int(11) ,
 `quantity` double(19,2) ,
 `cost_price` double(21,4) ,
 `unit_price` double(21,4) ,
 `price` double(21,4) ,
 `profit` double(21,4) 
)*/;

/*Table structure for table `v_sale` */

DROP TABLE IF EXISTS `v_sale`;

/*!50001 DROP VIEW IF EXISTS `v_sale` */;
/*!50001 DROP TABLE IF EXISTS `v_sale` */;

/*!50001 CREATE TABLE  `v_sale`(
 `id` int(11) ,
 `sale_time` datetime ,
 `client_id` int(11) ,
 `employee_id` int(11) ,
 `sub_total` decimal(15,4) ,
 `status` varchar(20) ,
 `status_f` varchar(20) ,
 `remark` text ,
 `discount_amount` decimal(34,10) 
)*/;

/*Table structure for table `v_sale_item_sum` */

DROP TABLE IF EXISTS `v_sale_item_sum`;

/*!50001 DROP VIEW IF EXISTS `v_sale_item_sum` */;
/*!50001 DROP TABLE IF EXISTS `v_sale_item_sum` */;

/*!50001 CREATE TABLE  `v_sale_item_sum`(
 `sale_id` int(11) ,
 `quantity` double(19,2) ,
 `cost_price` double(21,4) ,
 `unit_price` double(21,4) ,
 `price` double(21,4) ,
 `profit` double(21,4) 
)*/;

/*Table structure for table `v_sale_summary` */

DROP TABLE IF EXISTS `v_sale_summary`;

/*!50001 DROP VIEW IF EXISTS `v_sale_summary` */;
/*!50001 DROP TABLE IF EXISTS `v_sale_summary` */;

/*!50001 CREATE TABLE  `v_sale_summary`(
 `sale_id` int(11) ,
 `quantity` double(19,2) ,
 `cost_price` double(21,4) ,
 `unit_price` double(21,4) ,
 `price` double(21,4) ,
 `sum((price-cost_price)*quantity)` double(21,4) 
)*/;

/*View structure for view v_receiving */

/*!50001 DROP TABLE IF EXISTS `v_receiving` */;
/*!50001 DROP VIEW IF EXISTS `v_receiving` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`sys`@`%` SQL SECURITY DEFINER VIEW `v_receiving` AS select `receiving`.`id` AS `id`,`receiving`.`receive_time` AS `receive_time`,`receiving`.`supplier_id` AS `supplier_id`,`receiving`.`employee_id` AS `employee_id`,`receiving`.`sub_total` AS `sub_total`,`receiving`.`status` AS `status`,`receiving`.`remark` AS `remark`,(case when (`receiving`.`discount_type` = '%') then ((`receiving`.`sub_total` * ifnull(`receiving`.`discount_amount`,0)) - ((`receiving`.`sub_total` * ifnull(`receiving`.`discount_amount`,0)) / 100)) else ifnull(`receiving`.`discount_amount`,0) end) AS `discount_amount` from `receiving` */;

/*View structure for view v_receiving_item_sum */

/*!50001 DROP TABLE IF EXISTS `v_receiving_item_sum` */;
/*!50001 DROP VIEW IF EXISTS `v_receiving_item_sum` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`sys`@`%` SQL SECURITY DEFINER VIEW `v_receiving_item_sum` AS select `receiving_item`.`receive_id` AS `receive_id`,sum(`receiving_item`.`quantity`) AS `quantity`,sum(`receiving_item`.`cost_price`) AS `cost_price`,sum(`receiving_item`.`unit_price`) AS `unit_price`,sum(`receiving_item`.`price`) AS `price`,sum(((`receiving_item`.`price` - `receiving_item`.`cost_price`) * `receiving_item`.`quantity`)) AS `profit` from `receiving_item` group by `receiving_item`.`receive_id` */;

/*View structure for view v_sale */

/*!50001 DROP TABLE IF EXISTS `v_sale` */;
/*!50001 DROP VIEW IF EXISTS `v_sale` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`sys`@`%` SQL SECURITY DEFINER VIEW `v_sale` AS select `sale`.`id` AS `id`,`sale`.`sale_time` AS `sale_time`,`sale`.`client_id` AS `client_id`,`sale`.`employee_id` AS `employee_id`,`sale`.`sub_total` AS `sub_total`,`sale`.`status` AS `status`,(case when (`sale`.`status` = '1') then 'Completed' when (`sale`.`status` = '2') then 'Suspended' when (`sale`.`status` = '0') then 'Canceled' else `sale`.`status` end) AS `status_f`,`sale`.`remark` AS `remark`,(case when (`sale`.`discount_type` = '%') then ((`sale`.`sub_total` * ifnull(`sale`.`discount_amount`,0)) / 100) else ifnull(`sale`.`discount_amount`,0) end) AS `discount_amount` from `sale` */;

/*View structure for view v_sale_item_sum */

/*!50001 DROP TABLE IF EXISTS `v_sale_item_sum` */;
/*!50001 DROP VIEW IF EXISTS `v_sale_item_sum` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`sys`@`%` SQL SECURITY DEFINER VIEW `v_sale_item_sum` AS select `sale_item`.`sale_id` AS `sale_id`,sum(`sale_item`.`quantity`) AS `quantity`,sum(`sale_item`.`cost_price`) AS `cost_price`,sum(`sale_item`.`unit_price`) AS `unit_price`,sum(`sale_item`.`price`) AS `price`,sum(((`sale_item`.`price` - `sale_item`.`cost_price`) * `sale_item`.`quantity`)) AS `profit` from `sale_item` group by `sale_item`.`sale_id` */;

/*View structure for view v_sale_summary */

/*!50001 DROP TABLE IF EXISTS `v_sale_summary` */;
/*!50001 DROP VIEW IF EXISTS `v_sale_summary` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`sys`@`%` SQL SECURITY DEFINER VIEW `v_sale_summary` AS select `sale_item`.`sale_id` AS `sale_id`,sum(`sale_item`.`quantity`) AS `quantity`,sum(`sale_item`.`cost_price`) AS `cost_price`,sum(`sale_item`.`unit_price`) AS `unit_price`,sum(`sale_item`.`price`) AS `price`,sum(((`sale_item`.`price` - `sale_item`.`cost_price`) * `sale_item`.`quantity`)) AS `sum((price-cost_price)*quantity)` from `sale_item` group by `sale_item`.`sale_id` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
