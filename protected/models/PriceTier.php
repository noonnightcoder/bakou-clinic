<?php

/**
 * This is the model class for table "price_tier".
 *
 * The followings are the available columns in table 'price_tier':
 * @property integer $id
 * @property string $tier_name
 * @property string $modified_date
 * @property string $status
 */
class PriceTier extends CActiveRecord
{
        const _price_tier_active = '1'; 
        const _price_tier_inactive = '0';
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'price_tier';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tier_name', 'required'),
                        array('tier_name', 'unique'),
			array('status', 'length', 'max'=>1),
			array('tier_name', 'length', 'max'=>30),
			array('modified_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tier_name, modified_date, status', 'safe', 'on'=>'search'),
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
			'tier_name' => Yii::t('app','Tier Name'),
			'modified_date' => 'Modified Date',
			'status' => Yii::t('app','Status'),
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
		$criteria->compare('tier_name',$this->tier_name,true);
		//$criteria->compare('modified_date',$this->modified_date,true);
		//$criteria->compare('status',$this->deleted);
                
                //$criteria->addSearchCondition('status',$this::_price_tier_active);
                
                //$criteria->condition="deleted=:deleted";
                //$criteria->params = array(':deleted' => $this::_price_tier_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PriceTier the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function deletePriceTeir($id)
        {
            PriceTier::model()->updateByPk((int)$id,array('status'=>$this::_price_tier_inactive));
        }
        
        public function undodeletePriceTeir($id)
        {
            PriceTier::model()->updateByPk((int)$id,array('status'=>$this::_price_tier_active));
        }
        
        protected function getPriceTierInfo()
        {
            return $this->tier_name;
        }
        
        public function getPriceTier()
        {
            $model = PriceTier::model()->findAll(array('order'=>'id','condition'=>'status=:active_status','params'=>array(':active_status'=>$this::_price_tier_active)));
            $list  = CHtml::listData($model , 'id', 'PriceTierInfo');
            return $list;
        }
        
        public function getListPriceTier()
        {
            $sql="SELECT id tier_id,tier_name,null price FROM `price_tier` WHERE status=:active_status ORDER BY id"; 
            $result=Yii::app()->db->createCommand($sql)->queryAll(true,array(':active_status'=>$this::_price_tier_active));
            return $result;
        }
        
        public function getListPriceTierUpdate($item_id)
        {
            $sql="SELECT pt.id tier_id,pt.tier_name,price 
                  FROM price_tier pt LEFT JOIN item_price_tier ipt ON ipt.`price_tier_id`=pt.id 
                            AND ipt.`item_id`=:item_id
                  WHERE pt.status=:status
                  ORDER BY pt.id"; 
            
            $result=Yii::app()->db->createCommand($sql)->queryAll(true,array(':item_id' =>(int)$item_id,':status'=>$this::_price_tier_active));
            return $result;
        }
        
        public function checkExists() {
            return PriceTier::model()->count('status=:active_status',array(':active_status'=>$this::_price_tier_active));
        }
        
       
}
