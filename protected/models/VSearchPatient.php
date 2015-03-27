<?php

/**
 * This is the model class for table "v_search_patient".
 *
 * The followings are the available columns in table 'v_search_patient':
 * @property integer $patient_id
 * @property integer $contact_id
 * @property string $fullname
 * @property string $dob
 * @property string $sex
 * @property string $display_id
 * @property string $phone_number
 * @property string $display_name
 * @property string $address_line_1
 */
class VSearchPatient extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_search_patient';
	}
        
        public $search;

        /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fullname, display_id', 'required'),
			array('patient_id, contact_id', 'numerical', 'integerOnly'=>true),
			array('sex', 'length', 'max'=>20),
			array('display_id', 'length', 'max'=>12),
			array('phone_number', 'length', 'max'=>30),
			array('display_name', 'length', 'max'=>100),
			array('address_line_1', 'length', 'max'=>300),
			array('dob', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('search,patient_id, contact_id, fullname, dob, sex, display_id, phone_number, display_name, address_line_1', 'safe', 'on'=>'search'),
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
			'patient_id' => 'Patient',
			'contact_id' => 'Contact',
			'fullname' => 'Fullname',
			'dob' => 'Date Of Birth',
			'sex' => 'Sex',
			'display_id' => 'Display',
			'phone_number' => 'Phone Number',
			'display_name' => 'Display Name',
			'address_line_1' => 'Address',
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

		if ($this->search) {
                
                    $criteria->condition="(fullname like :search or display_id like :search or display_name like :search)";
                    $criteria->params = array(
                                ':search' => '%' . $this->search . '%',
                                ':search' => '%' . $this->search . '%',
                                ':search' => '%' . $this->search . '%',
                    );
                }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VSearchPatient the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
