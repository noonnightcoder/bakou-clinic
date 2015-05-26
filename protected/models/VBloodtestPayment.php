<?php

/**
 * This is the model class for table "v_bloodtest_payment".
 *
 * The followings are the available columns in table 'v_bloodtest_payment':
 * @property integer $id
 * @property string $lab_item_name
 * @property string $unit_price
 * @property integer $visit_id
 * @property string $exchange_rate
 */
class VBloodtestPayment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_bloodtest_payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lab_item_name, visit_id', 'required'),
			array('id, visit_id', 'numerical', 'integerOnly'=>true),
			array('lab_item_name', 'length', 'max'=>100),
			array('unit_price, exchange_rate', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, lab_item_name, unit_price, visit_id, exchange_rate', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'lab_item_name' => 'Lab Item Name',
			'unit_price' => 'Unit Price',
			'visit_id' => 'Visit',
			'exchange_rate' => 'Exchange Rate',
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
		$criteria->compare('lab_item_name',$this->lab_item_name,true);
		$criteria->compare('unit_price',$this->unit_price,true);
		$criteria->compare('visit_id',$this->visit_id);
		$criteria->compare('exchange_rate',$this->exchange_rate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VBloodtestPayment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
