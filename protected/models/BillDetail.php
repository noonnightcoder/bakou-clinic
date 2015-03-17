<?php

/**
 * This is the model class for table "bill_detail".
 *
 * The followings are the available columns in table 'bill_detail':
 * @property integer $bill_detail_id
 * @property integer $bill_id
 * @property integer $treatment_id
 * @property string $amount
 * @property integer $quantity
 * @property string $mrp
 * @property string $type
 *
 * The followings are the available model relations:
 * @property Bill $bill
 */
class BillDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bill_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bill_id, treatment_id, amount, quantity', 'required'),
			array('bill_id, treatment_id, quantity', 'numerical', 'integerOnly'=>true),
			array('amount, mrp', 'length', 'max'=>10),
			array('type', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('bill_detail_id, bill_id, treatment_id, amount, quantity, mrp, type', 'safe', 'on'=>'search'),
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
			'bill' => array(self::BELONGS_TO, 'Bill', 'bill_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'bill_detail_id' => 'Bill Detail',
			'bill_id' => 'Bill',
			'treatment_id' => 'Treatment',
			'amount' => 'Amount',
			'quantity' => 'Quantity',
			'mrp' => 'Mrp',
			'type' => 'Type',
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

		$criteria->compare('bill_detail_id',$this->bill_detail_id);
		$criteria->compare('bill_id',$this->bill_id);
		$criteria->compare('treatment_id',$this->treatment_id);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('mrp',$this->mrp,true);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BillDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
