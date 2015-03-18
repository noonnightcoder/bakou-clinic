<?php

/**
 * This is the model class for table "prescription".
 *
 * The followings are the available columns in table 'prescription':
 * @property integer $id
 * @property string $date_created
 * @property integer $visit_id
 * @property string $last_update
 * @property string $updated_by
 *
 * The followings are the available model relations:
 * @property PrescriptionDetail[] $prescriptionDetails
 */
class Prescription extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'prescription';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('visit_id', 'numerical', 'integerOnly'=>true),
			array('updated_by', 'length', 'max'=>40),
			array('date_created, last_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, date_created, visit_id, last_update, updated_by', 'safe', 'on'=>'search'),
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
			'prescriptionDetails' => array(self::HAS_MANY, 'PrescriptionDetail', 'prescription_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date_created' => 'Date Created',
			'visit_id' => 'Visit',
			'last_update' => 'Last Update',
			'updated_by' => 'Updated By',
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
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('visit_id',$this->visit_id);
		$criteria->compare('last_update',$this->last_update,true);
		$criteria->compare('updated_by',$this->updated_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Prescription the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function saveMedicine($prescription_id = null,$medicine_id = null,$quantity = null,$price = null)
        {
            $cmd = Yii::app()->db->createCommand("CALL pro_save_medicine(:prescription_id, :medicine_id,:quantity,:price)");
            $cmd->bindParam(":prescription_id", $prescription_id);
            $cmd->bindParam(":medicine_id", $medicine_id);
            $cmd->bindParam(":quantity", $quantity);
            $cmd->bindParam(":price", $price);
            //$cmd->queryAll(array(':bill_id' => $bill_id, ':treatment_id' => $treatment_id,':price'=>$price));
            $cmd->execute();
            return false;
            //$sql="CALL pro_save_treatment(:bill_id, :treatment_id,:price)";
            //return Yii::app()->db->createCommand($sql)->queryAll(true, array(':bill_id' =>(int) $bill_id, ':treatment_id' => (int)$treatment_id,':price'=>$price));

        }
}
