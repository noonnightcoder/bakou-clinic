<?php

/**
 * This is the model class for table "visit".
 *
 * The followings are the available columns in table 'visit':
 * @property integer $visit_id
 * @property integer $patient_id
 * @property integer $userid
 * @property string $notes
 * @property string $type
 * @property string $visit_date
 * @property string $visit_time
 * @property string $sympton
 * @property string $observation
 * @property string $assessment
 * @property string $plan
 */
class Visit extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'visit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id, userid, visit_date', 'required'),
            array('sympton','diagnosis_validate'),
			array('patient_id, userid', 'numerical', 'integerOnly'=>true),
			array('type, visit_time', 'length', 'max'=>50),
			array('visit_date', 'length', 'max'=>60),
			array('sympton, observation, assessment, plan', 'length', 'max'=>200),
			array('notes', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('visit_id, patient_id, userid, notes, type, visit_date, visit_time, sympton, observation, assessment, plan', 'safe', 'on'=>'search'),
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
			'visit_id' => 'Visit',
			'patient_id' => 'Patient',
			'userid' => 'Userid',
			'notes' => 'Notes',
			'type' => 'Type',
			'visit_date' => 'Visit Date',
			'visit_time' => 'Visit Time',
			'sympton' => 'Symptom',
			'observation' => 'Past History',
			'assessment' => 'Investigation',
			'plan' => 'Diagnosis',
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

		$criteria->compare('visit_id',$this->visit_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('visit_date',$this->visit_date,true);
		$criteria->compare('visit_time',$this->visit_time,true);
		$criteria->compare('sympton',$this->sympton,true);
		$criteria->compare('observation',$this->observation,true);
		$criteria->compare('assessment',$this->assessment,true);
		$criteria->compare('plan',$this->plan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Visit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function showPatientHis($patient_id)
    {
        $sql = "select @rownum:=@rownum+1 id,patient_id,visit_id,visit_date,display_id,sympton,observation,assessment,plan
            from (    
                SELECT t1.patient_id,t1.visit_id,visit_date,t2.display_id,sympton,observation,assessment,plan 
                FROM visit t1
                INNER JOIN patient t2 ON t1.patient_id = t2.patient_id
                inner join appointment t3 on t1.visit_id = t3.visit_id and t3.status='Complete'
                WHERE t1.patient_id=$patient_id
                ORDER BY visit_date DESC
            )mm,(SELECT @rownum:=0) r";

        $rawData = Yii::app()->db->createCommand($sql);
        $rawData->bindParam(':patient_id', $patient_id, PDO::PARAM_INT);

        return new CSqlDataProvider($sql, array(
            'sort' => array(
                'attributes' => array(
                    'visit_date'
                )
            ),
        ));
    }
        
        public function diagnosis_validate($attribute,$params)
        {
            if(isset($_POST['Save_consult']) || isset($_POST['Completed_consult']))
            {
                if($this->sympton=='')
                {
                    $this->addError('sympton','Sympton cannot be blank');
                }

                /*if($this->observation=='')
                {
                    $this->addError('observation','Observation cannot be blank');
                }

                if($this->assessment=='')
                {
                    $this->addError('assessment','Past History cannot be blank');
                }

                if($this->plan=='')
                {
                    $this->addError('plan','Diagnosis cannot be blank');
                }*/
            }            
        }
}
