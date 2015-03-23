<?php

/**
 * This is the model class for table "v_appointment_state".
 *
 * The followings are the available columns in table 'v_appointment_state':
 * @property integer $app_id
 * @property integer $patient_id
 * @property integer $user_id
 * @property integer $visit_id
 * @property string $patient_name
 * @property string $display_id
 * @property string $appointment_date
 * @property string $title
 * @property string $status
 */
class VAppointmentState extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_appointment_state';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, patient_name, display_id, appointment_date, title, status', 'required'),
			array('app_id, patient_id, user_id, visit_id', 'numerical', 'integerOnly'=>true),
			array('display_id', 'length', 'max'=>12),
			array('title', 'length', 'max'=>150),
			array('status', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('app_id, patient_id, user_id, visit_id, patient_name, display_id, appointment_date, title, status', 'safe', 'on'=>'search'),
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
			'app_id' => 'App',
			'patient_id' => 'Patient',
			'user_id' => 'User',
			'visit_id' => 'Visit',
			'patient_name' => 'Patient Name',
			'display_id' => 'Display',
			'appointment_date' => 'Appointment Date',
			'title' => 'Title',
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

		$criteria->compare('app_id',$this->app_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('visit_id',$this->visit_id);
		$criteria->compare('patient_name',$this->patient_name,true);
		$criteria->compare('display_id',$this->display_id,true);
		$criteria->compare('appointment_date',$this->appointment_date,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VAppointmentState the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
