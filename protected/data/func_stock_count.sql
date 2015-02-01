DELIMITER $$

USE `bakou_pos_hmart`$$

DROP FUNCTION IF EXISTS `func_stock_count`$$

CREATE DEFINER=`sys`@`%` FUNCTION `func_stock_count`(i_interval SMALLINT(6)) RETURNS SMALLINT(6)
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
	
	RETURN p_return_id;    
    
    END$$

DELIMITER ;