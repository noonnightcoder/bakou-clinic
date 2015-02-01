SELECT
    CASE 
	WHEN paid=0 THEN 'not yet paid'
	WHEN (amount-paid)=0 THEN 'fully paid'
	ELSE 'paid some'
    END STATUS,
    sale_id,sale_time,client_id,employee_id,amount,(amount-paid) amount_to_paid,paid
FROM (
SELECT s.id sale_id,DATE_FORMAT(s.sale_time,'%d-%m-%Y %H:%i') sale_time,s.employee_id,CONCAT_WS(' ',first_name,last_name) client_id,
	IFNULL(s.`sub_total`,0) amount,IFNULL(sa.`paid`,0) paid
FROM sale s LEFT JOIN (SELECT sale_id,SUM(payment_amount) paid FROM sale_payment GROUP BY sale_id) sa ON sa.`sale_id`=s.`id`
		LEFT JOIN `client` c ON c.`id`=s.`client_id`
) AS inv	
	
WHERE s.status IS NULL 

SELECT *
FROM sale_payment

SELECT * FROM CLIENT

SELECT *
FROM sale

SELECT (SELECT NAME FROM item i WHERE i.id=t.item_id) item_name,
	CONCAT_WS(' - ', from_date, to_date) date_report,
	quantity,amount
FROM (
SELECT si.item_id,MIN(DATE_FORMAT(s.sale_time,'%d-%m-%Y')) from_date, MAX(DATE_FORMAT(s.sale_time,'%d-%m-%Y')) to_date,SUM(si.quantity) quantity,SUM(price*quantity) amount
FROM sale s INNER JOIN sale_item si WHERE s.id=si.sale_id
GROUP BY si.item_id
) AS t


SELECT (SELECT NAME FROM item i WHERE i.id=t.item_id) item_name,
    CONCAT_WS(' - ', from_date, to_date) date_report,
    quantity,amount
FROM (
	SELECT si.item_id,MIN(DATE_FORMAT(s.sale_time,'%d-%m-%Y')) from_date, MAX(DATE_FORMAT(s.sale_time,'%d-%m-%Y')) to_date,SUM(si.quantity) quantity,SUM(price*quantity) amount
	FROM sale s INNER JOIN sale_item si ON si.sale_id=s.id
	WHERE s.sale_time>=STR_TO_DATE('04-05-2014','%d-%m-%Y')  
	AND s.sale_time<STR_TO_DATE('05-05-2014','%d-%m-%Y')  
	AND s.status='1'
	GROUP BY si.item_id
) AS t

WHERE STATUS='1'

SELECT *
FROM sale_item

SELECT (SELECT NAME FROM item i WHERE i.id=si.item_id) item_name,COUNT(*) qty,SUM(price*quantity) amount
FROM sale_item si INNER JOIN sale s ON s.id=si.sale_id 
GROUP BY item_name


