<?php

/**
 * This is the model class for table "treatment_item_detail".
 *
 * The followings are the available columns in table 'treatment_item_detail':
 * @property integer $id
 * @property integer $t_group_id
 * @property string $treatment_item
 * @property string $unit_price
 *
 * The followings are the available model relations:
 * @property TreatmentGroup $tGroup
 */
class TreatmentItemDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'treatment_item_detail';
	}
        
        public $hematology;
        public $immuno_hematology;
        public $immunology;
        public $hormones;
        public $coagulation;
        public $serology;
        public $micro_biology;
        public $blood_biochemistry;
        public $urology;
        public $bacteriology;

        /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('t_group_id, treatment_item', 'required'),
			array('t_group_id', 'numerical', 'integerOnly'=>true),
			array('treatment_item', 'length', 'max'=>100),
			array('unit_price', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, t_group_id, treatment_item, unit_price', 'safe', 'on'=>'search'),
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
			'tGroup' => array(self::BELONGS_TO, 'TreatmentGroup', 't_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			't_group_id' => 'T Group',
			'treatment_item' => 'Lab Item',
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
		$criteria->compare('t_group_id',$this->t_group_id);
		$criteria->compare('treatment_item',$this->treatment_item,true);
		$criteria->compare('unit_price',$this->unit_price,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TreatmentItemDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getTestlist($match='')
        {
            //$match = addcslashes($match, '%_'); // escape LIKE's special characters
            
            $q = new CDbCriteria( array(
                'condition' => "t_group_id = :match",         // no quotes around :match
                'params'    => array(':match' => "$match"),
                //'order'     => "sort_order",
            ) );
            
            $model = TreatmentItemDetail::model()->findAll($q);
            $list    = CHtml::listData($model , 'id','treatment_item');
            return $list;
        }
}
