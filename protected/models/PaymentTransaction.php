<?php

/**
 * This is the model class for table "payment_transaction".
 *
 * The followings are the available columns in table 'payment_transaction':
 * @property integer $transaction_id
 * @property integer $bill_id
 * @property integer $patient_id
 * @property integer $visit_id
 * @property string $amount
 * @property string $payment_type
 */
class PaymentTransaction extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment_transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id, visit_id, amount, payment_type', 'required'),
			array('bill_id, patient_id, visit_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'length', 'max'=>11),
			array('payment_type', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('transaction_id, bill_id, patient_id, visit_id, amount, payment_type', 'safe', 'on'=>'search'),
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
			'transaction_id' => 'Transaction',
			'bill_id' => 'Bill',
			'patient_id' => 'Patient',
			'visit_id' => 'Visit',
			'amount' => 'Amount',
			'payment_type' => 'Payment Type',
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

		$criteria->compare('transaction_id',$this->transaction_id);
		$criteria->compare('bill_id',$this->bill_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('visit_id',$this->visit_id);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('payment_type',$this->payment_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentTransaction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
