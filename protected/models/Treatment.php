<?php

/**
 * This is the model class for table "treatment".
 *
 * The followings are the available columns in table 'treatment':
 * @property integer $id
 * @property string $treatment
 * @property double $price
 */
class Treatment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'treatment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('price', 'numerical'),
			array('treatment', 'length', 'max'=>80),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, treatment, price', 'safe', 'on'=>'search'),
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
			'treatment' => 'Treatment',
			'price' => 'Price',
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
		$criteria->compare('treatment',$this->treatment,true);
		$criteria->compare('price',$this->price);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Treatment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /*public function load_treatment($id)
        {
            //$id=15;
            //$mytreat = SaleItem::model()->find('id=:id', array(':id'=>$id));
            $criteria = new CDbCriteria();
            $criteria->addInCondition('id', array(1,2));
            //$criteria->addCondition('id in (1,2)');
            //$criteria->params = array(':id'=>$id);
            //$criteria->condition = 'id in (1,2)';
            return Treatment::model()->findAllByAttributes(array('id' => array(1,2)));
        }*/
        
        public function get_selected_treatment($id)
        {
            $sql="SELECT id,treatment,price FROM treatment where id=$id";
            
            $cmd=Yii::app()->db->createCommand($sql);
            //$cmd->bindParam(':patient_id', $patient_id, PDO::PARAM_INT);
            return $cmd->queryAll();
            //return new CSqlDataProvider($cmd->query());
            //$model=Treatment::model()->findall();
            //return $dataProvider=new CArrayDataProvider($model, array('id'=>'id'));
        }
        
        public function get_all_treatment()
        {
            $sql="SELECT id,treatment FROM treatment";
            $cmd=Yii::app()->db->createCommand($sql);            
            $array= $cmd->queryAll();
            
            $result = array(); 
            foreach ($array as $key => $value) { 
                $result+=array($value['id']=>$value['treatment']);
            }
            $tr=array(''=>'');
            $tr+=$result;
            return $tr;
        }
        
        public function suggest($keyword,$limit=20)
	{
		$models=$this->findAll(array(
			'condition'=>'treatment LIKE :keyword',
			'order'=>'treatment',
			'limit'=>$limit,
			'params'=>array(':keyword'=>"%$keyword%")
		));
		$suggest=array();
		foreach($models as $model) {
			$suggest[] = array(
				'label'=>$model->treatment.' - '.$model->price,  // label for dropdown list
				'value'=>$model->treatment,  // value for input field
				'id'=>$model->id,       // return values from autocomplete
				'price'=>$model->price,
			);
		}
		return $suggest;
	}
        
        public static function getTreatment($name = '') {

            // Recommended: Secure Way to Write SQL in Yii 
            $sql = "SELECT id ,treatment AS text 
                    FROM treatment 
                    WHERE (treatment LIKE :name)";
 
            $name = '%' . $name . '%';
            return Yii::app()->db->createCommand($sql)->queryAll(true, array(':name' => $name));
       
        }
}
