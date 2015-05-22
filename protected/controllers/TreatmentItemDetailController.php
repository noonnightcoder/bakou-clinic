<?php

class TreatmentItemDetailController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','LabAnalyzed'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TreatmentItemDetail;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['TreatmentItemDetail'])) {
			$model->attributes=$_POST['TreatmentItemDetail'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['TreatmentItemDetail'])) {
			$model->attributes=$_POST['TreatmentItemDetail'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TreatmentItemDetail');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TreatmentItemDetail('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['TreatmentItemDetail'])) {
			$model->attributes=$_GET['TreatmentItemDetail'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TreatmentItemDetail the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TreatmentItemDetail::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TreatmentItemDetail $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='treatment-item-detail-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionLabAnalyzed($visit_id)
        {
            
            $lab_test = new LabAnalized;
            $lab_selected = new LabAnalyzedDetail;
            $userid = Yii::app()->user->getId();
            if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest )
            { 
                //echo "Here we are!";
                $transaction=$lab_selected->dbConnection->beginTransaction();
                try{
                    $chk_selected = LabAnalized::model()->find(array(
                        'condition' => 'visit_id=:visit_id',
                        'params' => array(':visit_id'=>$visit_id))
                    );
                    
                    if(!empty($chk_selected))
                    {
                        LabAnalyzedDetail::model()->deleteAll(
                            array('condition'=>'lab_analized_id=:lab_analized_id',
                            'params'=>array(':lab_analized_id'=>$chk_selected->id))
                        );
                        
                        $lab_id = $chk_selected->id;
                    }else{
                        $lab_test->date_created = date('Y-m-d');
                        $lab_test->visit_id = $visit_id;
                        $lab_test->last_update = date('Y-m-d');
                        $lab_test->updated_by = $userid;
                        $lab_test->status=0;
                        $lab_test->save();
                        $lab_id = $lab_test->id;
                    }   
   
                    $lab_items = array('hematology', 'immuno_hematology', 'immunology', 
                                                'hormones', 'coagulation', 'serology', 
                                                'micro_biology', 'blood_biochemistry', 'urology', 
                                                'bacteriology');
                   // print_r($_POST);
                    foreach ($lab_items as $lab_item) {
                        if (!empty($_POST['TreatmentItemDetail'][$lab_item])) {
                            foreach ($_POST['TreatmentItemDetail'][$lab_item] as $itemId) { 
                                $lab_selected = new LabAnalyzedDetail;
                                //$check_price = TreatmentItemDetail::model()->findByPk($itemId);
                                $lab_selected->lab_analized_id = $lab_id;
                                $lab_selected->itemtest_id = $itemId;
                                $lab_selected->unit_price = $check_price->unit_price;
                                //$lab_selected->isNewRecord = true;
                                if (!$lab_selected->save()) {
                                    $transaction->rollback();
                                    print_r($lab_selected->errors);
                                }
                                //print_r($check_price);
                                //print_r($_POST['TreatmentItemDetail'][$lab_item]);
                            }
                        }
                        //print_r($_POST['TreatmentItemDetail'][$lab_item]);
                    } 
                    $transaction->commit();
                }  catch (Exception $e){
                    $transaction->rollback();
                    print_r($lab_selected->errors);
                }                
            }
        }
}