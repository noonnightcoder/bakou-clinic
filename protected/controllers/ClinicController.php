<?php

class ClinicController extends Controller
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
				'actions'=>array('create','update','admin','ClinicInfo'),
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
		$model=new Clinic;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Clinic'])) {
			$model->attributes=$_POST['Clinic'];
			if ($model->save()) {
				$this->redirect(array('ClinicInfo','id'=>$model->id));
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
                $dataProvider=new CActiveDataProvider('Clinic');
		if (isset($_POST['Clinic'])) {
			$model->attributes=$_POST['Clinic'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id,'dataProvider'=>$dataProvider));
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
            $settings = Yii::app()->settings;

            $model = new SettingsForm();

            if (isset($_POST['SettingsForm'])) {
                $model->setAttributes($_POST['SettingsForm']);
                $settings->deleteCache();
                foreach ($model->attributes as $category => $values) {
                    $settings->set($category, $values);
                }
                Yii::app()->user->setFlash('success', '<strong>Well done!</strong> Site settings were updated..');
                $this->refresh();
            }

            foreach ($model->attributes as $category => $values) {
                $cat = $model->$category;
                foreach ($values as $key => $val) {
                    $cat[$key] = $settings->get($category, $key);
                }
                $model->$category = $cat;
            }

            $this->render('index', array('model' => $model));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Clinic('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Clinic'])) {
			$model->attributes=$_GET['Clinic'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Clinic the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Clinic::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Clinic $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='clinic-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionClinicInfo()
        {
            $model = new Clinic;
            $setting = new Settings;
            //$id=2;
            $model = Clinic::model()->find();

            if (!empty($model->id))
            {
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Clinic'])) {
			$model->attributes=$_POST['Clinic'];
			if ($model->save()) {
				//$this->redirect(array('view','id'=>$model->id));
                            Yii::app()->user->setFlash('success', '<strong>Consultation!</strong> successfully saved.');    
			}
		}
                
                if (isset($_POST['Settings'])) {
                    $setting->attributes=$_POST['Settings'];
                    $xchange_rate = $_POST['Settings']['value'] !=null ? $_POST['Settings']['value'] : 4000;
                    Settings::model()->updateByPk(1,array('value'=>$xchange_rate));
                    Yii::app()->session['exchange_rate']=$xchange_rate;
                    Yii::app()->user->setFlash('success', '<strong>Consultation!</strong> successfully saved.');
                }
                
                //$this->actionUpdate($model->id);
                $model=$this->loadModel($model->id);

		$this->render('index',array(
			'model'=>$model,'setting'=>$setting
		));
            }else{
                $this->actionCreate();
                Yii::app()->user->setFlash('success', '<strong>Consultation!</strong> successfully saved.');
                /*$model = new Clinic;
                $this->render('admin',array(
			'model'=>$model,
		));*/
            }            
        }
}