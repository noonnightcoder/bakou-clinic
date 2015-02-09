<?php

/**
 * This is the model class for table "contact".
 *
 * The followings are the available columns in table 'contact':
 * @property integer $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $display_name
 * @property string $phone_number
 * @property string $email
 * @property string $contact_image
 * @property string $type
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property string $country
 *
 * The followings are the available model relations:
 * @property ContactDetail[] $contactDetails
 * @property Patient[] $patients
 */
class Contact extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('last_name, display_name, phone_number, email, type, address_line_1, address_line_2, city, state, postal_code, country', 'required'),
			array('first_name, middle_name, last_name, type, city, state, postal_code, country', 'length', 'max'=>50),
			array('display_name, contact_image', 'length', 'max'=>255),
			array('phone_number', 'length', 'max'=>15),
			array('email, address_line_1, address_line_2', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, first_name, middle_name, last_name, display_name, phone_number, email, contact_image, type, address_line_1, address_line_2, city, state, postal_code, country', 'safe', 'on'=>'search'),
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
			'contactDetails' => array(self::HAS_MANY, 'ContactDetail', 'contact_id'),
			'patients' => array(self::HAS_MANY, 'Patient', 'contact_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'middle_name' => 'Middle Name',
			'last_name' => 'Last Name',
			'display_name' => 'Display Name',
			'phone_number' => 'Phone Number',
			'email' => 'Email',
			'contact_image' => 'Contact Image',
			'type' => 'Type',
			'address_line_1' => 'Address Line 1',
			'address_line_2' => 'Address Line 2',
			'city' => 'City',
			'state' => 'State',
			'postal_code' => 'Postal Code',
			'country' => 'Country',
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
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('display_name',$this->display_name,true);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('contact_image',$this->contact_image,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('address_line_1',$this->address_line_1,true);
		$criteria->compare('address_line_2',$this->address_line_2,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('postal_code',$this->postal_code,true);
		$criteria->compare('country',$this->country,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function create_display_patient_id($id,$last_name)
        {
            //$sql="CALL Create_patient_id(:myid, :my_last_name)";
            $myid= Yii::app()->db->createCommand("SELECT Create_patient_id($id,'$last_name')");
            return $myid->queryScalar();
        }
}
