<?php

/**
 * This is the model class for table "v_prescription_detail".
 *
 * The followings are the available columns in table 'v_prescription_detail':
 * @property integer $prescription_id
 * @property integer $visit_id
 * @property double $dosage
 * @property integer $frequency
 * @property string $duration
 * @property string $description
 * @property string $remarks
 */
class VPrescriptionDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_prescription_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('duration', 'required'),
			array('prescription_id, visit_id, frequency', 'numerical', 'integerOnly'=>true),
			array('dosage', 'numerical'),
			array('duration', 'length', 'max'=>10),
			array('description', 'length', 'max'=>500),
			array('remarks', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('prescription_id, visit_id, dosage, frequency, duration, description, remarks', 'safe', 'on'=>'search'),
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
			'prescription_id' => 'Prescription',
			'visit_id' => 'Visit',
			'dosage' => 'Dosage',
			'frequency' => 'Frequency',
			'duration' => 'Duration',
			'description' => 'Description',
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

		$criteria->compare('prescription_id',$this->prescription_id);
		$criteria->compare('visit_id',$this->visit_id);
		$criteria->compare('dosage',$this->dosage);
		$criteria->compare('frequency',$this->frequency);
		$criteria->compare('duration',$this->duration,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('remarks',$this->remarks,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VPrescriptionDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
