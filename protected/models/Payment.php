<?php

/**
 * This is the model class for table "payment".
 *
 * The followings are the available columns in table 'payment':
 * @property integer $payment_id
 * @property integer $bill_id
 * @property string $pay_date
 * @property string $pay_mode
 * @property string $amount
 * @property string $cheque_no
 */
class Payment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bill_id, pay_date, pay_mode, amount', 'required'),
			array('bill_id', 'numerical', 'integerOnly'=>true),
			array('pay_mode, cheque_no', 'length', 'max'=>50),
			array('amount', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('payment_id, bill_id, pay_date, pay_mode, amount, cheque_no', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'payment_id' => 'Payment',
			'bill_id' => 'Bill',
			'pay_date' => 'Pay Date',
			'pay_mode' => 'Pay Mode',
			'amount' => 'Amount',
			'cheque_no' => 'Cheque No',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('payment_id',$this->payment_id);
		$criteria->compare('bill_id',$this->bill_id);
		$criteria->compare('pay_date',$this->pay_date,true);
		$criteria->compare('pay_mode',$this->pay_mode,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('cheque_no',$this->cheque_no,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Payment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /*public function addPayment($visit_id)
        {
            return Yii::app()->db->createCommand("CALL add_payment(:visit_id)")
                      ->queryAll(true,array(':visit_id' => $visit_id));
        }*/
        
        public function CompleteSale($visit_id)
        {
            //$sql="CALL Create_patient_id(:myid, :my_last_name)";
            $myid= Yii::app()->db->createCommand("SELECT add_payment($visit_id)");
            return $myid->queryScalar();
        }
        
        /*public function DeletePayment()
        {
            
        }*/
}
