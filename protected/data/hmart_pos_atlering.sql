ALTER TABLE item ADD count_interval SMALLINT((6);

ALTER inventory
ADD COLUMN `trans_qty` DOUBLE(15,2),
ADD COLUMN `qty_b4_trans` DOUBLE(15,2),
ADD COLUMN `qty_af_trans` DOUBLE(15,2);

CREATE TABLE `item_count_schedule` (
  `item_id` INT(11) NOT NULL,
  `name` VARCHAR(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` DOUBLE(15,2) DEFAULT NULL,
  `first_count_date` DATETIME DEFAULT NULL,
  `next_count_date` DATETIME DEFAULT NULL,
  `count_interval` SMALLINT(6) NULL,
  `modified_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_id` INT(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_id` (`item_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `item_count_schedule_dt` (
  `id` INT(11) NOT NULL DEFAULT '0',
  `item_id` INT(11) NOT NULL,
  `name` VARCHAR(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` DOUBLE(15,2) DEFAULT NULL,
  `first_count_date` DATETIME DEFAULT NULL,
  `next_count_date` DATETIME DEFAULT NULL,
  `count_interval` SMALLINT(6) DEFAULT NULL,
  `modified_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_id` INT(11) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;