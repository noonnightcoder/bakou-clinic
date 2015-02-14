<?php

/**
 * This is the model class for table "clinic".
 *
 * The followings are the available columns in table 'clinic':
 * @property integer $id
 * @property string $start_time
 * @property string $end_time
 * @property string $time_interval
 * @property string $clinic_name
 * @property string $tag_line
 * @property string $clinic_address
 * @property string $landline
 * @property string $mobile
 * @property string $email
 * @property integer $next_followup_days
 */
class Clinic extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'clinic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('clinic_name, clinic_address, mobile', 'required'),
			array('next_followup_days', 'numerical', 'integerOnly'=>true),
			array('start_time, end_time', 'length', 'max'=>10),
			array('time_interval', 'length', 'max'=>11),
			array('clinic_name, landline, mobile, email', 'length', 'max'=>50),
			array('tag_line', 'length', 'max'=>100),
			array('clinic_address', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, start_time, end_time, time_interval, clinic_name, tag_line, clinic_address, landline, mobile, email, next_followup_days', 'safe', 'on'=>'search'),
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
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'time_interval' => 'Time Interval',
			'clinic_name' => 'Clinic Name',
			'tag_line' => 'Tag Line',
			'clinic_address' => 'Clinic Address',
			'landline' => 'Landline',
			'mobile' => 'Mobile',
			'email' => 'Email',
			'next_followup_days' => 'Next Followup Days',
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
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('time_interval',$this->time_interval,true);
		$criteria->compare('clinic_name',$this->clinic_name,true);
		$criteria->compare('tag_line',$this->tag_line,true);
		$criteria->compare('clinic_address',$this->clinic_address,true);
		$criteria->compare('landline',$this->landline,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('next_followup_days',$this->next_followup_days);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Clinic the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
