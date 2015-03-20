<?php

/**
 * This is the model class for table "sale_item".
 *
 * The followings are the available columns in table 'sale_item':
 * @property integer $id
 * @property integer $sale_id
 * @property integer $item_id
 * @property string $description
 * @property integer $line
 * @property double $quantity
 * @property double $cost_price
 * @property double $unit_price
 * @property double $price
 * @property double $discount_amount
 * @property integer $discount_type
 *
 * The followings are the available model relations:
 * @property Item $item
 * @property Sale $sale
 */
class SaleItem extends CActiveRecord
{
        public $client_id;
        public $payment_type;
        public $comment;
        public $payment_amount;
        public $alt_payment_amount;
        public $name;
        public $discount;
        public $sub_total;
        public $total_discount;
        public $tier_id;
        //public $total_discount;
    
        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SaleItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sale_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('sale_id, item_id, unit_price, quantity', 'required'),
                        //array('quantity', 'required'),
			array('sale_id, item_id, line', 'numerical', 'integerOnly'=>true),
			array('quantity, cost_price, unit_price, price, discount_amount, discount,total_discount', 'numerical'),
			array('description, discount_type', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sale_id, item_id, description, line, quantity, cost_price, unit_price, price, discount_amount, discount_type, total_discount', 'safe', 'on'=>'search'),
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
			'item' => array(self::BELONGS_TO, 'Item', 'item_id'),
			'sale' => array(self::BELONGS_TO, 'Sale', 'sale_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sale_id' => Yii::t('app','model.saleitem.sale_id'), //'Sale',
			'item_id' => Yii::t('app','model.saleitem.item_id'), //'Item',
			'description' => Yii::t('app','model.saleitem.description'), //'Description',
			'line' => Yii::t('app','model.saleitem.line'), //'Line',
			'quantity' => 'Quantity', //'Quantity',
			'cost_price' => Yii::t('app','model.saleitem.cost_price'), //'Cost Price',
			'unit_price' => Yii::t('app','model.saleitem.unit_price'), // 'Unit Price',
			'price' => 'Price', // Yii::t('app','model.saleitem.price'), //
			'discount_amount' => Yii::t('app','model.saleitem.discount_amount'), // 'Discount Amount',
			'discount_type' => Yii::t('app','model.saleitem.discount_type'),//'Discount Type',
                        'name' => Yii::t('app','model.saleitem.name'),
                        'payment_type' => Yii::t('app','model.saleitem.paymentype'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($sale_id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('sale_id',$this->sale_id);
		//$criteria->compare('item_id',$this->item_id);
		//$criteria->compare('description',$this->description,true);
		//$criteria->compare('line',$this->line);
		//$criteria->compare('quantity',$this->quantity);
		//$criteria->compare('cost_price',$this->cost_price);
		//$criteria->compare('unit_price',$this->unit_price);
		//$criteria->compare('price',$this->price);
		//$criteria->compare('discount_amount',$this->discount_amount);
		//$criteria->compare('discount_type',$this->discount_type);
                
                $criteria->condition="sale_id=:sale_id";
                $criteria->params = array(':sale_id' => $sale_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getSaleItem($sale_id)
        {
            $model = SaleItem::model()->findAll('sale_id=:saleId',array(':saleId'=>$sale_id));
            return $model;
        }        
        
              
        public function dataArray($items=array())
        {
            
          $dataProvider = new CArrayDataProvider(
                        $items, array(
                        'sort'=>array(
                          'attributes'=>array('name', 'id', 'quantity'),
                          //'defaultOrder'=>array('active' => true, 'name' => false),
                        ),
                        'pagination'=>array(
                          'pageSize'=>100,
                          ),        
            ));
          
            return $dataProvider;

        }         
          
}