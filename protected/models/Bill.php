<?php

/**
 * This is the model class for table "bill".
 *
 * The followings are the available columns in table 'bill':
 * @property integer $bill_id
 * @property string $bill_date
 * @property integer $patient_id
 * @property integer $visit_id
 * @property string $total_amount
 * @property string $due_amount
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property BillDetail[] $billDetails
 */
class Bill extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bill';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bill_date, patient_id, visit_id, status', 'required'),
			array('patient_id, visit_id, status', 'numerical', 'integerOnly'=>true),
			array('total_amount', 'length', 'max'=>10),
			array('due_amount', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('bill_id, bill_date, patient_id, visit_id, total_amount, due_amount, status', 'safe', 'on'=>'search'),
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
			'billDetails' => array(self::HAS_MANY, 'BillDetail', 'bill_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'bill_id' => 'Bill',
			'bill_date' => 'Bill Date',
			'patient_id' => 'Patient',
			'visit_id' => 'Visit',
			'total_amount' => 'Total Amount',
			'due_amount' => 'Due Amount',
			'status' => 'Status',
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

		$criteria->compare('bill_id',$this->bill_id);
		$criteria->compare('bill_date',$this->bill_date,true);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('visit_id',$this->visit_id);
		$criteria->compare('total_amount',$this->total_amount,true);
		$criteria->compare('due_amount',$this->due_amount,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Bill the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
