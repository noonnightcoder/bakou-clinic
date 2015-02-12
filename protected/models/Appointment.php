<?php

/**
 * This is the model class for table "appointment".
 *
 * The followings are the available columns in table 'appointment':
 * @property integer $id
 * @property string $appointment_date
 * @property string $end_date
 * @property string $start_time
 * @property string $end_time
 * @property string $title
 * @property integer $patient_id
 * @property integer $user_id
 * @property string $status
 * @property integer $visit_id
 *
 * The followings are the available model relations:
 * @property AppointmentLog[] $appointmentLogs
 */
class Appointment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'appointment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('appointment_date, title, patient_id, user_id, status', 'required'),
			array('patient_id, user_id, visit_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>150),
			array('status', 'length', 'max'=>255),
			array('end_date, start_time, end_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, appointment_date, end_date, start_time, end_time, title, patient_id, user_id, status, visit_id', 'safe', 'on'=>'search'),
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
			'appointmentLogs' => array(self::HAS_MANY, 'AppointmentLog', 'appointment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'appointment_date' => 'Appointment Date',
			'end_date' => 'End Date',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'title' => 'Title',
			'patient_id' => 'Patient',
			//'user_id' => 'User',
			//'status' => 'Status',
			//'visit_id' => 'Visit',
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
		$criteria->compare('appointment_date',$this->appointment_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('visit_id',$this->visit_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Appointment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function m_get_patient($name = '')
        {
            $sql="SELECT id,fullname,display_id,phone_number,display_name 
                    FROM v_search_patient 
                    WHERE fullname LIKE :patient_name 
                    or display_id LIKE :patient_name";
            
            $patient_name = '%' . $name . '%';
            
            return Yii::app()->db->createCommand($sql)->queryAll(true, array(':patient_name' => $patient_name,));
        }
        
        public function RetreivePatient($patient_id)
        {
            $sql="SELECT phone_number,display_name 
                    FROM v_search_patient
                    where id=:patient_id";
            
            $cmd=Yii::app()->db->createCommand($sql);
            $cmd->bindParam(':patient_id', $patient_id, PDO::PARAM_INT);
            return $cmd->queryRow();
            
            //return Yii::app()->db->createCommand($sql)->queryAll(true, array(':patient_id' => $patient_id,));
        }
}
