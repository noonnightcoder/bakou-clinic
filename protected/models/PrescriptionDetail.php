<?php

/**
 * This is the model class for table "prescription_detail".
 *
 * The followings are the available columns in table 'prescription_detail':
 * @property integer $id
 * @property integer $prescription_id
 * @property integer $item_id
 * @property double $dosage
 * @property string $duration
 * @property integer $frequency
 * @property integer $instruction_id
 * @property string $quantity
 * @property string $unit_price
 * @property string $remarks
 *
 * The followings are the available model relations:
 * @property Prescription $prescription
 */
class PrescriptionDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'prescription_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id, quantity, unit_price', 'required'),
			array('prescription_id, item_id, frequency, instruction_id', 'numerical', 'integerOnly'=>true),
			array('dosage', 'numerical'),
			array('duration', 'length', 'max'=>10),
			array('quantity, unit_price', 'length', 'max'=>15),
			array('remarks', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, prescription_id, item_id, dosage, duration, frequency, instruction_id, quantity, unit_price, remarks', 'safe', 'on'=>'search'),
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
			'prescription' => array(self::BELONGS_TO, 'Prescription', 'prescription_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'prescription_id' => 'Prescription',
			'item_id' => 'Item',
			'dosage' => 'Dosage',
			'duration' => 'Duration',
			'frequency' => 'Frequency',
			'instruction_id' => 'Instruction',
			'quantity' => 'Quantity',
			'unit_price' => 'Unit Price',
			'remarks' => 'Remarks',
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
		$criteria->compare('prescription_id',$this->prescription_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('dosage',$this->dosage);
		$criteria->compare('duration',$this->duration,true);
		$criteria->compare('frequency',$this->frequency);
		$criteria->compare('instruction_id',$this->instruction_id);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('unit_price',$this->unit_price,true);
		$criteria->compare('remarks',$this->remarks,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PrescriptionDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
