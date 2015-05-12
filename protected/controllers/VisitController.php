<?php

class VisitController extends Controller
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
				'actions'=>array('create','update','Revisit'),
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
		$model=new Visit;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Visit'])) {
			$model->attributes=$_POST['Visit'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->visit_id));
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

		if (isset($_POST['Visit'])) {
			$model->attributes=$_POST['Visit'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->visit_id));
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
		$dataProvider=new CActiveDataProvider('Visit');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Visit('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Visit'])) {
			$model->attributes=$_GET['Visit'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Visit the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Visit::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Visit $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='visit-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionRevisit($visit_id,$patient_id,$doctor_id)
        {   
            if($visit_id!=null && $patient_id!=null && $doctor_id!=null)
            {
                $model = new Visit;
                $userid = Yii::app()->user->getId();

                if($userid!=$_GET['doctor_id'])
                {
                    throw new CHttpException(400, 'Invalid Doctor. Please login to the right doctor.');
                }
            
                $app_status = Appointment::model()->find('visit_id=:visit_id and status="Consultation"', array(':visit_id'=>$visit_id));
                if(!empty($app_status))
                {
                    //echo "In consultant mode";
                    $transaction=$model->dbConnection->beginTransaction();
                    try{
                        Visit::model()->save_revisit($visit_id,$patient_id,$doctor_id);
                        $transaction->commit();
                        Yii::app()->user->setFlash('success', '<strong>Successful Saved! </strong>');
                    }catch (Exception $e){
                        $transaction->rollback();
                        Yii::app()->user->setFlash('success', '<strong>Process was rollback! </strong>Please contact administrator.');
                        //echo $e->getMessage();
                    }                   
                }else{
                    Yii::app()->user->setFlash('success', '<strong>Oop!</strong> You are not in the consultation mode.');
                }
            }else{
                Yii::app()->user->setFlash('success', '<strong>Oop!</strong> Wrong link!.');
            }            
        }
}