<?php

/**
 * This is the model class for table "inventory".
 *
 * The followings are the available columns in table 'inventory':
 * @property integer $trans_id
 * @property integer $trans_items
 * @property integer $trans_user
 * @property string $trans_date
 * @property string $trans_comment
 * @property double $trans_inventory
 * @property double $trans_qty
 * @property double $qty_b4_trans
 * @property double $qty_af_trans
 */
class Inventory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'inventory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('trans_items, trans_user, trans_date, trans_comment', 'required'),
			array('trans_items, trans_user', 'numerical', 'integerOnly'=>true),
			array('trans_inventory, trans_qty, qty_b4_trans, qty_af_trans', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('trans_id, trans_items, trans_user, trans_date, trans_comment, trans_inventory, trans_qty, qty_b4_trans, qty_af_trans', 'safe', 'on'=>'search'),
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
			'transItems' => array(self::BELONGS_TO, 'Item', 'trans_items'),
                        'employee' => array(self::BELONGS_TO, 'Employee', 'trans_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'trans_id' => 'Trans',
			'trans_items' => 'Trans Items',
			'trans_user' => 'Trans User',
			'trans_date' => 'Trans Date',
			'trans_comment' => 'Trans Comment',
			'trans_inventory' => 'Trans Inventory',
			'trans_qty' => 'Trans Qty',
			'qty_b4_trans' => 'Qty B4 Trans',
                        'qty_af_trans' => 'Qty After Trans',
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
	public function search($item_id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('trans_id',$this->trans_id);
		$criteria->compare('trans_items',$this->trans_items);
		$criteria->compare('trans_user',$this->trans_user);
		$criteria->compare('trans_date',$this->trans_date,true);
		$criteria->compare('trans_comment',$this->trans_comment,true);
		$criteria->compare('trans_inventory',$this->trans_inventory);
		$criteria->compare('trans_qty',$this->trans_qty);
		$criteria->compare('qty_b4_trans',$this->qty_b4_trans);
                $criteria->compare('qty_af_trans',$this->qty_af_trans);
                
                $criteria->condition="trans_items=:trans_items";
                $criteria->params = array(':trans_items' => $item_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array( 'defaultOrder'=>'trans_date desc')
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Inventory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
