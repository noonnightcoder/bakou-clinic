<?php

/**
 * This is the model class for table "patient".
 *
 * The followings are the available columns in table 'patient':
 * @property integer $patient_id
 * @property integer $contact_id
 * @property string $patient_since
 * @property string $display_id
 * @property string $followup_date
 * @property string $reference_by
 *
 * The followings are the available model relations:
 * @property PaintImg[] $paintImgs
 * @property Contact $contact
 */
class Patient extends CActiveRecord
{
	public $patient_id;

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'patient';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contact_id, patient_since, followup_date, reference_by', 'required'),
			array('contact_id', 'numerical', 'integerOnly'=>true),
			array('display_id', 'length', 'max'=>12),
			array('reference_by', 'length', 'max'=>255),
            array('created_at,updated_at', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
            array('updated_at', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => false, 'on' => 'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('patient_id, contact_id, patient_since, display_id, followup_date, reference_by', 'safe', 'on'=>'search'),
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
			'paintImgs' => array(self::HAS_MANY, 'PaintImg', 'patient_id'),
			'contact' => array(self::BELONGS_TO, 'Contact', 'contact_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'patient_id' => 'Patient',
			'contact_id' => 'Contact',
			'patient_since' => 'Patient Since',
			'display_id' => 'Display',
			'followup_date' => 'Followup Date',
			'reference_by' => 'Reference By',
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

		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('contact_id',$this->contact_id);
		$criteria->compare('patient_since',$this->patient_since,true);
		$criteria->compare('display_id',$this->display_id,true);
		$criteria->compare('followup_date',$this->followup_date,true);
		$criteria->compare('reference_by',$this->reference_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Patient the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
