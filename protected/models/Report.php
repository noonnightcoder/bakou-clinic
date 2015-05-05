<?php

/**
 * This is the model class for table "sale".
 *
 * The followings are the available columns in table 'sale':
 * @property integer $id
 * @property string $sale_time
 * @property integer $customer_id
 * @property integer $employee_id
 * @property double $sub_total
 * @property string $payment_type
 * @property string $status
 * @property string $remark
 *
 * The followings are the available model relations:
 * @property SaleItem[] $saleItems
 */
class Report extends CFormModel
{

    public $search;
    public $amount;
    public $quantity;
    public $from_date;
    public $to_date;
    public $sale_id;
    public $receive_id;
    public $employee_id;
    
    private $item_active = '1';
    private $active_status = '1';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Sale the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('sale_time', 'required'),
            array('client_id, employee_id', 'numerical', 'integerOnly' => true),
            array('sub_total', 'numerical'),
            array('status', 'length', 'max' => 25),
            array('payment_type', 'length', 'max' => 255),
            array('sale_time', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => true, 'on' => 'insert'),
            array('remark, sale_time', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, sale_time, client_id, employee_id, sub_total, payment_type,status, remark', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'date' => Yii::t('app', 'date'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'supplier' => array(self::BELONGS_TO, 'Supplier', 'supplier_id'),
        );
    }

    public function saleDailyProfit()
    {
        
        $sql ="SELECT date_report,sub_total,profit,format((profit/sub_total)*100,2) margin
              FROM (
                SELECT DATE_FORMAT(s.`sale_time`,'%d-%m-%Y') date_report,
                  SUM(s.sub_total) sub_total,SUM(sm.profit) profit
                FROM v_sale s , v_sale_item_sum sm
                WHERE s.id=sm.sale_id 
                AND s.sale_time>=STR_TO_DATE(:from_date,'%d-%m-%Y') 
                AND s.sale_time<=DATE_ADD(STR_TO_DATE(:to_date,'%d-%m-%Y'),INTERVAL 1 DAY)
                AND s.status=:status
                GROUP BY DATE_FORMAT(s.`sale_time`,'%d-%m-%Y')
             ) as t";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll(true, array(':from_date' => $this->from_date, ':to_date' => $this->to_date,':status'=>Yii::app()->params['_active_status']));

        $dataProvider = new CArrayDataProvider($rawData, array(
            //'id'=>'saleinvoice',
            'keyField' => 'date_report',
            'sort' => array(
                'attributes' => array(
                    'sale_time',
                ),
            ),
            'pagination' => false,
        ));

        return $dataProvider; // Return as array object
    }

    public function saleDailyProfitTotals()
    {
        $sub_total = 0;
        $total = 0;
        $profit = 0;
        
        $sql ="SELECT SUM(s.sub_total) sub_total,SUM(s.sub_total-s.discount_amount) total,SUM(sm.profit) profit
               FROM v_sale s , v_sale_item_sum sm
               WHERE s.id=sm.sale_id 
               AND s.sale_time>=STR_TO_DATE(:from_date,'%d-%m-%Y') 
               AND s.sale_time<=DATE_ADD(STR_TO_DATE(:to_date,'%d-%m-%Y'),INTERVAL 1 DAY)
               AND s.status=:status";
    
        $result = Yii::app()->db->createCommand($sql)->queryAll(true, array(':from_date' => $this->from_date, ':to_date' => $this->to_date,':status'=>Yii::app()->params['_active_status']));

         foreach ($result as $record) {
            $sub_total = $record['sub_total'];
            $total = $record['total'];
            $profit = $record['profit'];
        }

        return array($sub_total,$total,$profit);
    }


    public function payment()
    {

        $sql = "SELECT payment_type,COUNT(*) quantity,SUM(payment_amount) amount
                FROM sale_payment	
                WHERE sale_id IN (SELECT id FROM sale  WHERE sale_time>=str_to_date(:from_date,'%d-%m-%Y')
                AND sale_time<=date_add(str_to_date(:to_date,'%d-%m-%Y'),INTERVAL 1 DAY))
                GROUP BY payment_type";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll(true, array(':from_date' => $this->from_date, ':to_date' => $this->to_date));

        $dataProvider = new CArrayDataProvider($rawData, array(
            //'id'=>'saleinvoice',
            'keyField' => 'payment_type',
            'sort' => array(
                'attributes' => array(
                    'sale_time',
                ),
            ),
            'pagination' => false,
        ));

        return $dataProvider; // Return as array object
    }


    public function paymentTotalQty()
    {
        $sql = "SELECT COUNT(*) qty
                  FROM sale_payment	
                  WHERE sale_id IN (SELECT id FROM sale  WHERE sale_time>=str_to_date(:from_date,'%d-%m-%Y')
                  AND sale_time<=date_add(str_to_date(:to_date,'%d-%m-%Y'),INTERVAL 1 DAY))
                  ";

        $result = Yii::app()->db->createCommand($sql)->queryAll(true, array(':from_date' => $this->from_date, ':to_date' => $this->to_date));

        foreach ($result as $record) {
            $qty = $record['qty'];
        }

        return $qty;
    }

    public function topProduct()
    {

        $sql = "SELECT  @ROW := @ROW + 1 AS rank,item_name,qty,amount
                FROM (
                SELECT (SELECT NAME FROM item i WHERE i.id=si.item_id) item_name,sum(si.quantity) qty,SUM(price*quantity) amount
                FROM sale_item si INNER JOIN sale s ON s.id=si.sale_id 
                     AND sale_time>=str_to_date(:from_date,'%d-%m-%Y') 
                     AND sale_time<=date_add(str_to_date(:to_date,'%d-%m-%Y'),INTERVAL 1 DAY)
                     AND IFNULL(s.status,'1')='1'
                GROUP BY item_name
                ORDER BY qty DESC LIMIT 5
                ) t1, (SELECT @ROW := 0) r";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll(true, array(':from_date' => $this->from_date, ':to_date' => $this->to_date));

        $dataProvider = new CArrayDataProvider($rawData, array(
            'keyField' => 'rank',
            'sort' => array(
                'attributes' => array(
                    'sale_time',
                ),
            ),
            'pagination' => false,
        ));

        return $dataProvider; // Return as array object
    }


    public function stockCount($interval)
    {
 
        if ($interval=='all') {
            $sql="SELECT id,`name`,quantity 
                  FROM item
                  WHERE status=:status";
            $rawData = Yii::app()->db->createCommand($sql)->queryAll(true,array(':status'=>$this->item_active));
        } else {
            $sql ="SELECT id,`name`,quantity
                   FROM item
                   WHERE count_interval=:interval
                   AND status=:status";
            
            $sql="SELECT i.id,i.`name`,i.quantity,null actual_qty,
                    date_format(ic.modified_date,'%d-%m-%Y') modified_date,
                    date_format(ic.next_count_date,'%d-%m-%Y') next_count_date,
                    upper(concat_ws(' - ',last_name,first_name)) employee
                  FROM item i,item_count_schedule ic,employee e 
                  WHERE i.id=ic.item_id 
                  AND i.status=:status 
                  AND e.id=ic.employee_id
                  AND ic.count_interval=:interval
                  -- AND DATE(ic.next_count_date) = CURRENT_DATE()";
            
            $rawData = Yii::app()->db->createCommand($sql)->queryAll(true,array(':interval'=>$interval,':status'=>$this->item_active));
        }
        
        $dataProvider = new CArrayDataProvider($rawData, array(
            'keyField' => 'id',
            'sort' => array(
                'attributes' => array(
                    'quantity',
                ),
            ),
            'pagination' => false,
        ));

        return $dataProvider; // Return as array object
    }
   
    public function itemExpiry($filter)
    {

        $sql = "SELECT receiving_id,received,name,quantity,month_expire,n_month_expire
                  FROM (
                    SELECT ie.`receiving_id`,
                            (SELECT receive_time FROM receiving r WHERE r.id=ie.receiving_id) received,
                            i.`name`,
                            i.`quantity`,
                            ie.`expire_date`,EXTRACT(YEAR_MONTH  FROM ie.expire_date) month_expire,
                            PERIOD_DIFF(EXTRACT(YEAR_MONTH  FROM ie.expire_date),EXTRACT(YEAR_MONTH FROM CURRENT_DATE())) n_month_expire
                     FROM `item_expire` ie  INNER JOIN item i ON ie.`item_id`=i.`id`
                     where ie.expire_date>='2013-01-01'
                    ) AS t1
                 WHERE n_month_expire<=:month_to_expire
                 ORDER BY name";
        
          $sql = "SELECT name,quantity,expire_date,n_month_expire
                  FROM (
                    SELECT i.`name`,
                            i.`quantity`,
                            DATE_FORMAT(ie.`expire_date`,'%d-%m-%Y') expire_date,
                            PERIOD_DIFF(EXTRACT(YEAR_MONTH  FROM ie.expire_date),EXTRACT(YEAR_MONTH FROM CURRENT_DATE())) n_month_expire
                     FROM `item_expire` ie  INNER JOIN item i ON ie.`item_id`=i.`id`
                    ) AS t1
                 WHERE n_month_expire<=:month_to_expire
                 ORDER BY name";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll(true, array(':month_to_expire' => $filter));

        $dataProvider = new CArrayDataProvider($rawData, array(
            'keyField' => 'name',
            'sort' => array(
                'attributes' => array(
                    'name',
                ),
            ),
            'pagination' => false,
        ));

        return $dataProvider; // Return as array object
    }

    public function itemExpiryCount($moth_to_expire)
    {
        $sql = "SELECT count(*) nitem,ifnull(sum(quantity),0) qty
                  FROM (
                    SELECT ie.`receiving_id`,
                            (SELECT receive_time FROM receiving r WHERE r.id=ie.receiving_id) received,
                            i.`name`,
                            i.`quantity`,
                            ie.`expire_date`,EXTRACT(YEAR_MONTH  FROM ie.expire_date) month_expire,
                            PERIOD_DIFF(EXTRACT(YEAR_MONTH  FROM ie.expire_date),EXTRACT(YEAR_MONTH FROM CURRENT_DATE())) n_month_expire
                     FROM `item_expire` ie  INNER JOIN item i ON ie.`item_id`=i.`id`
                    ) AS t1
                 WHERE n_month_expire=:month_to_expire";
        //GROUP BY month_expire,n_month_expire";

        $result = Yii::app()->db->createCommand($sql)->queryAll(true, array(':month_to_expire' => $moth_to_expire));

        foreach ($result as $record) {
            $result = array($record['nitem'], $record['qty']);
        }

        return $result;
    }
    
    public function dashtopProduct()
    {

        $sql = "SELECT  @ROW := @ROW + 1 AS rank,item_name,qty,amount
                FROM (
                SELECT (SELECT NAME FROM item i WHERE i.id=si.item_id) item_name,SUM(si.quantity) qty,SUM(price*quantity) amount
                FROM sale_item si INNER JOIN sale s ON s.id=si.sale_id 
                     AND sale_time between DATE_FORMAT(NOW() ,'%Y') AND NOW()
                     AND IFNULL(s.status,'1')='1'
                GROUP BY item_name
                ORDER BY qty DESC LIMIT 10
                ) t1, (SELECT @ROW := 0) r";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll(true);

        $dataProvider = new CArrayDataProvider($rawData, array(
            'keyField' => 'rank',
            'sort' => array(
                'attributes' => array(
                    'sale_time',
                ),
            ),
            'pagination' => false,
        ));

        return $dataProvider; // Return as array object
    }

    public function dashtopProductbyAmount()
    {

        $sql = "SELECT  @ROW := @ROW + 1 AS rank,item_name,qty,amount
                FROM (
                SELECT (SELECT NAME FROM item i WHERE i.id=si.item_id) item_name,SUM(si.quantity) qty,SUM(price*quantity) amount
                FROM sale_item si INNER JOIN sale s ON s.id=si.sale_id 
                     AND sale_time between DATE_FORMAT(NOW() ,'%Y') AND NOW()
                     AND IFNULL(s.status,'1')='1'
                GROUP BY item_name
                ORDER BY amount DESC LIMIT 10
                ) t1, (SELECT @ROW := 0) r";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll(true);

        $dataProvider = new CArrayDataProvider($rawData, array(
            'keyField' => 'rank',
            'sort' => array(
                'attributes' => array(
                    'sale_time',
                ),
            ),
            'pagination' => false,
        ));

        return $dataProvider; // Return as array object
    }

    public function dbBestCustomer()
    {

        $sql = "SELECT  @ROW := @ROW + 1 AS rank,customer_name,amount amount
                FROM (
                    SELECT CONCAT(c.first_name,' ',last_name) customer_name,SUM(s.sub_total) amount
                    FROM sale s ,`client` c
                    WHERE s.client_id = c.id
                    AND s.status=:status
                    GROUP BY customer_name
                    ORDER BY amount DESC LIMIT 10
                     ) t1, (SELECT @ROW := 0) r";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll(true,array('status'=>$this->active_status));

        $dataProvider = new CArrayDataProvider($rawData, array(
            'keyField' => 'rank',
           /* 'sort' => array(
                'attributes' => array(
                    'customer_name',
                ),
            ),*/
            'pagination' => false,
        ));

        return $dataProvider; // Return as array object
    }

    public function itemAsset()
    {
        $sql = "SELECT SUM(quantity) total_qty,SUM(cost_price*quantity) total_amount
                  FROM item
                  WHERE quantity>0
                  and status=:status";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll(true,array(":status"=>$this->item_active));

        $dataProvider = new CArrayDataProvider($rawData, array(
            'keyField' => 'total_qty',
            'pagination' => false,
        ));

        return $dataProvider; // Return as array object
    }


    /*
     * Completed Appointment Chart
     */
    public function dbDailyVisitChart()
    {
        $sql = "SELECT date_format(s.sale_time,'%d/%m%y') date,sum(quantity) quantity,
                   SUM(case when si.discount_type='%' then (quantity*price-(quantity*price*si.discount_amount)/100) 
                                else (quantity*price)-si.discount_amount
                    end) amount
                   FROM sale s INNER JOIN sale_item si ON si.sale_id=s.id 
                   WHERE ( s.sale_time between DATE_FORMAT(NOW() ,'%Y-%m-01') and NOW() )
                   AND IFNULL(s.status,'1')='1'
                   GROUP BY date_format(s.sale_time,'%d/%m/%y')
                   ORDER BY 1";

        $sql="SELECT DATE(appointment_date) appointment_date,COUNT(*) nvisit
                FROM `appointment`
                WHERE appointment_date BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()
                AND STATUS='Complete'
                GROUP BY DATE(appointment_date)";

        return Yii::app()->db->createCommand($sql)->queryAll(true);
    }

    public function saleItemSummary()
    {
        $sql="SELECT sm.item_id,MIN(DATE_FORMAT(s.sale_time,'%d-%m-%Y')) from_date, MAX(DATE_FORMAT(s.sale_time,'%d-%m-%Y')) to_date,
		      SUM(sm.quantity) quantity,SUM(sm.price*quantity) sub_total,sum((sm.price-sm.cost_price) * sm.quantity) profit
              FROM v_sale s , sale_item sm
              WHERE s.id=sm.sale_id
              AND s.sale_time>=str_to_date(:from_date,'%d-%m-%Y')  
              AND s.sale_time<date_add(str_to_date(:to_date,'%d-%m-%Y'),INTERVAL 1 DAY) 
              AND s.status=:status
              GROUP BY sm.item_id";
        
        $sql="SELECT i.name item_name,CONCAT_WS(' - ', from_date, to_date) date_report,sub_total,t1.quantity,profit
            FROM (
            SELECT sm.item_id,MIN(DATE_FORMAT(s.sale_time,'%d-%m-%Y')) from_date, MAX(DATE_FORMAT(s.sale_time,'%d-%m-%Y')) to_date,
                  SUM(sm.quantity) quantity,SUM(sm.price*quantity) sub_total,sum((sm.price-sm.cost_price) * sm.quantity) profit
            FROM v_sale s , sale_item sm
            WHERE s.id=sm.sale_id
            AND s.sale_time>=str_to_date(:from_date,'%d-%m-%Y')  
            AND s.sale_time<date_add(str_to_date(:to_date,'%d-%m-%Y'),INTERVAL 1 DAY) 
            AND s.status=:status
            GROUP BY sm.item_id
            ) t1 JOIN item i ON i.id=t1.item_id";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll(true, array(':from_date' => $this->from_date, ':to_date' => $this->to_date,':status'=>Yii::app()->params['sale_complete_status']));

        $dataProvider = new CArrayDataProvider($rawData, array(
            //'id'=>'saleinvoice',
            'keyField' => 'item_name',
            'sort' => array(
                'attributes' => array(
                    'date_report',
                ),
            ),
            'pagination' => false,
        ));

        return $dataProvider; // Return as array object
    }
    
    public function userLogSummary()
    {  
        $sql="SELECT ul.`employee_id`,
                UCASE(CONCAT(e.`first_name`,' ',e.`last_name`)) fullname,
                DATE_FORMAT(`login_time`,'%d-%m-%Y') date_log,
                COUNT(*) nlog
            FROM `user_log` ul , employee e
            WHERE ul.`employee_id`=e.`id`
            AND ul.login_time>=str_to_date(:from_date,'%d-%m-%Y')  
            AND ul.login_time<date_add(str_to_date(:to_date,'%d-%m-%Y'),INTERVAL 1 DAY)
            GROUP BY ul.`employee_id`,CONCAT(e.`first_name`,' ',e.`last_name`),DATE_FORMAT(`login_time`,'%d-%m-%Y')";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll(true, array(':from_date' => $this->from_date, ':to_date' => $this->to_date));

        $dataProvider = new CArrayDataProvider($rawData, array(
            //'id'=>'saleinvoice',
            'keyField' => 'employee_id',
            'sort' => array(
                'attributes' => array(
                    'date_log',
                ),
            ),
            'pagination' => false,
        ));

        return $dataProvider; // Return as array object
    }

    public function totalSale2D()
    {
        $sql = "SELECT IFNULL(SUM(sub_total),0) sale_amount
                FROM sale
                WHERE sale_time>=CURDATE()
                AND `status`=:status";

        $result = Yii::app()->db->createCommand($sql)->queryAll(true, array(':status' => $this->item_active));

        foreach ($result as $record) {
            $result = $record['sale_amount'];
        }

        return $result;
    }

    public function totalSale2Y()
    {
        $sql = "SELECT IFNULL(SUM(sub_total),0) sale_amount
                FROM sale
                WHERE YEAR(sale_time) = YEAR(CURDATE())
                AND `status`=:status";

        $result = Yii::app()->db->createCommand($sql)->queryAll(true, array(':status' => $this->item_active));

        foreach ($result as $record) {
            $result = $record['sale_amount'];
        }

        return $result;
    }

    public function dbcountPatient()
    {
        $sql = "SELECT count(*) nCount
                FROM `patient`
                WHERE `status`=:status";

        $result = Yii::app()->db->createCommand($sql)->queryAll(true,array(':status' => $this->active_status));

        foreach ($result as $record) {
            $result = $record['nCount'];
        }

        return $result;
    }

    public function dbcountPatientReg2D()
    {
        $sql = "SELECT count(*) nCount
                FROM `patient`
                WHERE `status`=:status
                AND DATE(created_at)=DATE(NOW())";

        $result = Yii::app()->db->createCommand($sql)->queryAll(true, array(':status' => $this->active_status));

        foreach ($result as $record) {
            $result = $record['nCount'];
        }

        return $result;
    }

    public function outofStock()
    {
        $sql = "SELECT count(*) nCount
                FROM `item`
                WHERE quantity=0
                AND `status`=:status";

        $result = Yii::app()->db->createCommand($sql)->queryAll(true, array(':status' => $this->active_status));

        foreach ($result as $record) {
            $result = $record['nCount'];
        }

        return $result;
    }

    public function negativeStock()
    {
        $sql = "SELECT count(*) nCount
                FROM `item`
                WHERE quantity<0
                AND `status`=:status";

        $result = Yii::app()->db->createCommand($sql)->queryAll(true, array(':status' => $this->active_status));

        foreach ($result as $record) {
            $result = $record['nCount'];
        }

        return $result;
    }

}
