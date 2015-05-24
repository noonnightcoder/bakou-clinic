<?php

/**
 * This is the model class for table "lab_analyzed_detail".
 *
 * The followings are the available columns in table 'lab_analyzed_detail':
 * @property integer $id
 * @property integer $lab_analized_id
 * @property integer $itemtest_id
 * @property double $val
 * @property string $unit_price
 */
class LabAnalyzedDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lab_analyzed_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lab_analized_id, itemtest_id', 'required'),
			array('lab_analized_id, itemtest_id', 'numerical', 'integerOnly'=>true),
			array('val', 'numerical'),
			array('unit_price', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, lab_analized_id, itemtest_id, val, unit_price', 'safe', 'on'=>'search'),
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
			'lab_analized_id' => 'Lab Analized',
			'itemtest_id' => 'Itemtest',
			'val' => 'Val',
			'unit_price' => 'Unit Price',
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
		$criteria->compare('lab_analized_id',$this->lab_analized_id);
		$criteria->compare('itemtest_id',$this->itemtest_id);
		$criteria->compare('val',$this->val);
		$criteria->compare('unit_price',$this->unit_price,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LabAnalyzedDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function get_lab_analized($visit_id)
        {
            $sql="SELECT t3.id blood_id,t2.id lab_analyzed_id,t3.treatment_item,t3.caption
                FROM lab_analyzed_detail t1
                INNER JOIN lab_analized t2 ON t1.lab_analized_id=t2.id
                INNER JOIN treatment_item_detail t3 ON t1.itemtest_id=t3.id
                where t2.visit_id=:visit_id";
            
            $cmd=Yii::app()->db->createCommand($sql);
            $cmd->bindParam(':visit_id', $visit_id, PDO::PARAM_INT);
            
            return $cmd->queryall();
        }
}
