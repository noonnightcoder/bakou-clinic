<?php

/**
 * This is the model class for table "lab_analized".
 *
 * The followings are the available columns in table 'lab_analized':
 * @property integer $id
 * @property string $date_created
 * @property integer $visit_id
 * @property string $last_update
 * @property string $updated_by
 * @property string $status
 */
class LabAnalized extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lab_analized';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('visit_id', 'required'),
			array('visit_id', 'numerical', 'integerOnly'=>true),
			array('updated_by', 'length', 'max'=>10),
			array('status', 'length', 'max'=>2),
			array('date_created, last_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, date_created, visit_id, last_update, updated_by, status', 'safe', 'on'=>'search'),
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
			'date_created' => 'Date Created',
			'visit_id' => 'Visit',
			'last_update' => 'Last Update',
			'updated_by' => 'Updated By',
			'status' => 'Status',
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
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LabAnalized the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function showLabResult($visit_id)
        {
            $sql="
                SELECT t3.id ,t2.visit_id,t3.`treatment_item` lab_item_name,val result,caption 
                FROM lab_analyzed_detail t1
                INNER JOIN lab_analized t2 ON t1.lab_analized_id=t2.id
                INNER JOIN treatment_item_detail t3 ON t1.itemtest_id=t3.id
                where t2.visit_id=$visit_id
            ";
            
            return new CSqlDataProvider($sql,array(
                'sort' => array(
                        'attributes' => array(
                            'lab_item_id'
                        )
                    ),
            ));
        }
}
