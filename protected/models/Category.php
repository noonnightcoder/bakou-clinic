<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property string $name
 * @property string $created_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property Item[] $items
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
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
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
                        array('name', 'unique'),
			array('name', 'length', 'max'=>50),
			array('created_date, modified_date', 'safe'),
                        array('created_date', 'default', 'value' => date('Y-m-d'), 'setOnEmpty' => true, 'on' => 'insert'),
                        array('created_date,modified_date','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'update'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, created_date, modified_date', 'safe', 'on'=>'search'),
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
			'items' => array(self::HAS_MANY, 'Item', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => Yii::t('app','Name'), //'Name',
			'created_date' => Yii::t('app','Created Date'), //'Created Date',
			'modified_date' => Yii::t('app','Modified Date'), //'Modified Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		//$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		//$criteria->compare('created_date',$this->created_date,true);
		//$criteria->compare('modified_date',$this->modified_date,true);
                
                $criteria->order = 'name';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        protected function getCategoryInfo()
        {
            return $this->name;
            
        }
        
        public function getCategory()
        {
            $model = Category::model()->findAll();
            $list  = CHtml::listData($model , 'id', 'CategoryInfo');
            return $list;
        }
        
        // Get Item Category for select 2 -- cannot finding the style of normal select and button next to it
        public static function getCategory2($name = '') {

            // Recommended: Secure Way to Write SQL in Yii 
            $sql = "SELECT id ,name AS text 
                    FROM category 
                    WHERE (name LIKE :name)";
 
            $name = '%' . $name . '%';
            return Yii::app()->db->createCommand($sql)->queryAll(true, array(':name' => $name));
       
        }
        
        public function saveCategory($category_name)
        {
            $category_id=null;
            $exists = Category::model()->exists('id=:category_id',array(':category_id'=> (int) $category_name ));
            if (!$exists) {
                $category= new Category;
                $category->name=$category_name;
                $category->save();
                $category_id=$category->id;
            }

            return $category_id;
        }
}