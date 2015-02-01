
START TRANSACTION;

-- Update stock level back
UPDATE item t1
        INNER JOIN sale_item t2 
             ON t1.id = t2.item_id
SET t1.quantity = t1.`quantity`+t2.`quantity`
WHERE t2.sale_id = p_sale_id

-- update sale status to be deactivated
UPDATE sale SET STATUS='0' WHERE  sale_id=p_sale_id;

DELETE FROM sale_payment WHERE sale_id=p_id


COMMIT;
