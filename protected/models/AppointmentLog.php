<?php

/**
 * This is the model class for table "appointment_log".
 *
 * The followings are the available columns in table 'appointment_log':
 * @property integer $appointment_id
 * @property string $change_date_time
 * @property string $start_time
 * @property string $from_time
 * @property string $to_time
 * @property string $old_status
 * @property string $status
 * @property string $name
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Appointment $appointment
 */
class AppointmentLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'appointment_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('appointment_id, change_date_time, start_time, from_time, to_time, old_status, status, name, user_id', 'required'),
			array('appointment_id, user_id', 'numerical', 'integerOnly'=>true),
			array('old_status, status, name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('appointment_id, change_date_time, start_time, from_time, to_time, old_status, status, name, user_id', 'safe', 'on'=>'search'),
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
			'appointment' => array(self::BELONGS_TO, 'Appointment', 'appointment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'appointment_id' => 'Appointment',
			'change_date_time' => 'Change Date Time',
			'start_time' => 'Start Time',
			'from_time' => 'From Time',
			'to_time' => 'To Time',
			'old_status' => 'Old Status',
			'status' => 'Status',
			'name' => 'Name',
			'user_id' => 'User',
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

		$criteria->compare('appointment_id',$this->appointment_id);
		$criteria->compare('change_date_time',$this->change_date_time,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('from_time',$this->from_time,true);
		$criteria->compare('to_time',$this->to_time,true);
		$criteria->compare('old_status',$this->old_status,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AppointmentLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
