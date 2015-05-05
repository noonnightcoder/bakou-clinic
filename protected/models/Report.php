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

    public function dbQueue()
    {
        $sql = "SELECT COUNT(*) nCount
                FROM `appointment`
                WHERE DATE(appointment_date)=DATE(NOW())
                AND `status`=:status";

        $result = Yii::app()->db->createCommand($sql)->queryAll(true, array(':status' => 'Waiting'));

        foreach ($result as $record) {
            $result = $record['nCount'];
        }

        return $result;
    }

    public function dbTopVisitPatient()
    {
        $sql="SELECT  @ROW := @ROW + 1 AS rank,patient_name,nvisit
            FROM (
                SELECT CONCAT(c.first_name,' ',c.last_name) patient_name,COUNT(*) nvisit
                FROM appointment a , patient p , contact c
                WHERE a.patient_id = p.patient_id
                AND p.contact_id = c.id
                AND a.status=:status
                GROUP BY patient_name
                ORDER BY nvisit DESC LIMIT 10
                ) t1, (SELECT @ROW := 0) r ";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll(true,array('status'=>'Complete'));

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

    /*
     * Completed Appointment Chart
     */
    public function dbDailyVisitChart()
    {

        $sql="SELECT DATE(appointment_date) appointment_date,COUNT(*) nvisit
                FROM `appointment`
                WHERE date(appointment_date) BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()
                AND `status`='Complete'
                GROUP BY DATE(appointment_date)
                ORDER BY 1";

        return Yii::app()->db->createCommand($sql)->queryAll(true);
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
