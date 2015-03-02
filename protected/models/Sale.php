<?php

/**
 * This is the model class for table "sale".
 *
 * The followings are the available columns in table 'sale':
 * @property integer $id
 * @property string $sale_time
 * @property integer $client_id
 * @property integer $employee_id
 * @property string $sub_total
 * @property string $payment_type
 * @property string $status
 * @property string $remark
 * @property string $discount_amount
 * @property string $discount_type
 *
 * The followings are the available model relations:
 * @property SaleItem[] $saleItems
 */
class Sale extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sale';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sale_time', 'required'),
			array('client_id, employee_id', 'numerical', 'integerOnly'=>true),
			array('sub_total, discount_amount', 'length', 'max'=>15),
			array('payment_type', 'length', 'max'=>255),
			array('status', 'length', 'max'=>20),
			array('discount_type', 'length', 'max'=>2),
			array('remark', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sale_time, client_id, employee_id, sub_total, payment_type, status, remark, discount_amount, discount_type', 'safe', 'on'=>'search'),
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
			'saleItems' => array(self::HAS_MANY, 'SaleItem', 'sale_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sale_time' => 'Sale Time',
			'client_id' => 'Client',
			'employee_id' => 'Employee',
			'sub_total' => 'Sub Total',
			'payment_type' => 'Payment Type',
			'status' => 'Status',
			'remark' => 'Remark',
			'discount_amount' => 'Discount Amount',
			'discount_type' => 'Discount Type',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('sale_time',$this->sale_time,true);
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('employee_id',$this->employee_id);
		$criteria->compare('sub_total',$this->sub_total,true);
		$criteria->compare('payment_type',$this->payment_type,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('discount_amount',$this->discount_amount,true);
		$criteria->compare('discount_type',$this->discount_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sale the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
