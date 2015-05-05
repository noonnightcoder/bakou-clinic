<?php

class ContactController extends Controller
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
				'actions'=>array('create','update','admin','Upload','Delete','PatientHistory','visitDetail'),
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
        
        public function exception_error_handler($errno, $errstr, $errfile, $errline ) {
            throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
        }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
            if(!Yii::app()->user->checkAccess("contact.view"))
            {
                throw new CHttpException(400,'You are not authorized to perform this action.');
            }else{
                $data['visit'] = new Visit;
                $data['patient_id'] = $id;
                $patient = VSearchPatient::model()->find("patient_id=:patient_id",array(':patient_id'=>$id));
                //$patient->unsetAttributes();
                $data['patient'] = $patient;
                $this->render('view', $data,false,true);
            }
	}

    public function actionPatientHistory($id)
    {
        if (!Yii::app()->user->checkAccess("contact.view")) {
            throw new CHttpException(400, 'You are not authorized to perform this action.');
        } else {

            $cs = Yii::app()->clientScript;
            $cs->scriptMap = array(
                'jquery.js' => false,
                'bootstrap.js' => false,
                'jquery.ba-bbq.min.js' => false,
                'jquery.yiigridview.js' => false,
                'bootstrap.min.js' => false,
                'jquery.min.js' => false,
                'bootstrap.notify.js' => false,
                'bootstrap.bootbox.min.js' => false,
            );

            Yii::app()->clientScript->scriptMap['*.js'] = false;

            $data['visit'] = new Visit;
            $data['patient_id'] = $id;
            $patient = VSearchPatient::model()->find("patient_id=:patient_id", array(':patient_id' => $id));
            //$patient->unsetAttributes();
            $data['patient'] = $patient;

            echo CJSON::encode(array(
                'status' => 'render',
                'div' => $this->renderPartial('_patient_his_popup', $data, true, true),
            ));

            //$this->renderPartial('view', $data,false,true);
        }
    }

        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($status = 'N',$doctor_id='')
	{
		$model=new Contact;
        $patient = new Patient;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Contact'])) {
                    $model->attributes=$_POST['Contact']; 
                    //$patient->attributes=$_POST['Patient'];
                    $transaction=$model->dbConnection->beginTransaction();
                    try{
                        set_error_handler(array(&$this, "exception_error_handler")); 

                        $model->image=CUploadedFile::getInstance($model,'image');

                        $rnd = rand(0,9999);                             

                        $path=Yii::app()->basePath.'/ximages/'.$model->first_name.'_'.$rnd;

                        //$image_name=$path.'/'.$model->image;

                        $model->image_path = $path;
                        $model->image_name = $model->image;                        
                        $image_name=$path.'/'.$model->image;

                        if( !is_dir( $path ) ) 
                        {
                             mkdir( $path , 0777, true);
                        }

                        //if ($model->image!=null) {
                        if ($model->save())
                        {
                            $display_id=$model->create_display_patient_id($model->id, $model->first_name);
                            $patient->display_id=$display_id;
                            $patient->contact_id=$model->id;
                            $patient->patient_since=date("Y-m-d");
                            $patient->followup_date=date("Y-m-d");
                            $patient->reference_by='Lux'; //will add this field on interface
                            $patient->save();
                            if ($model->image!=null) {
                                $model->image->saveAs($image_name);
                            }
                            
                            $transaction->commit();
                            if($status=='Y')
                            {
                                $this->redirect(array('appointment/create','doctor_id'=>$doctor_id,'patient_id'=>$patient->patient_id));
                            }else{
                                $this->redirect(array('admin'));
                            }                            
                        }
                        //}
                    }  catch (Exception $e){
                        $transaction->rollback();
                        echo $e->getMessage();
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
            
                //$model = new VSearchPatient;
                
                //$model = contact::model()->findbyPk($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Contact'])) {
			$model->attributes=$_POST['Contact'];
                        $model->image=CUploadedFile::getInstance($model,'image');
                        
                        if($model->image!=null){
                            $model->image_name = $model->image;
                            $image_name= $model->image_path.'/'.$model->image;
                        }
                        
			if ($model->save()) {
                                if($model->image!=null){
                                    $model->image->saveAs($image_name);
                                }
				$this->redirect(array('update','id'=>$model->id));
			}
		}
                //die();
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
			//$this->loadModel($id)->delete();
            Contact::model()->deleteContact($id);

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
		/*$dataProvider=new CActiveDataProvider('Contact');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
            throw new CHttpException(400,'Invalid page request.');
            //echo $patient_id; die();            
	}

	/**
	 * Manages all models.
	 */
    public function actionAdmin()
    {
        $model = new VSearchPatient('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['VSearchPatient'])) {
            $model->attributes = $_GET['VSearchPatient'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Contact the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Contact::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Contact $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='contact-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionUpload()
    {
        $contact_id = 1;
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT']) &&
            (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
        ) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }

        $data = array();

        $model = new Contact('upload');
        //$model=new HrEmpphoto;
        $model->attributes = $_POST['contact_image'];
        $model->contact_image = CUploadedFile::getInstance($model, 'contact_image');
        $model->contact_image;

        if ($model->contact_image !== null && $model->validate(array('contact_image'))) {
            $rnd = rand(0, 9999);
            $path = Yii::app()->basePath . '/../ximages/' . strtolower(get_class($model)) . '/' . $contact_id;
            $filename = "{$rnd}_{$model->contact_image}";  // random number + file name
            $name = $path . '/' . $filename;

            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            //$model->photo->saveAs(
            //Yii::getPathOfAlias('frontend.www.files').'/'.$model->photo->name);
            //$model->photo = file_get_contents($model->picture->tempName);
            $model->thumnailphoto = file_get_contents($model->contact_image->tempName); //saving original photo uploaded
            $model->filename = $model->contact_image->name;
            $model->filetype = $model->contact_image->type;
            $model->size = $model->contact_image->size;
            $model->id = (int)$contact_id;

            $model->picture->saveAs($name);

            // resizing image using image extension
            $image = Yii::app()->image->load($name);
            $image->resize(300, 200)->quality(130)->sharpen(90);
            $image->save();

            $model->photo = file_get_contents($name);

            // save picture name
            if ($model->save()) {
                // return data to the fileuploader
                $data[] = array(
                    'name' => $model->contact_image->name,
                    'type' => $model->contact_image->type,
                    'size' => $model->contact_image->size,
                    // we need to return the place where our image has been saved
                    //'url' => $model->getImageUrl(), // Should we add a helper method?
                    // we need to provide a thumbnail url to display on the list
                    // after upload. Again, the helper method now getting thumbnail.
                    //'thumbnail_url' => $model->getImageUrl(HrEmpphoto::IMG_THUMBNAIL),
                    // we need to include the action that is going to delete the picture
                    // if we want to after loading
                    'delete_url' => $this->createUrl('delete',
                        array('id' => $model->id, 'method' => 'uploader')),
                    'delete_type' => 'POST'
                );
            } else {
                $data[] = array('error' => 'Unable to save model after saving picture');
            }
        } else {
            if ($model->hasErrors('contact_image')) {
                $data[] = array('error', $model->getErrors('contact_image'));
            } else {
                throw new CHttpException(500, "Could not upload file " . CHtml::errorSummary($model));
            }
        }
        // JQuery File Upload expects JSON data
        echo json_encode($data);
    }
    
    public function actionvisitDetail($visit_id,$patient_id)
    {
        $model = new Appointment;  
        $treatment = new Treatment;
        $medicine = new Item;
        $data['treatment_selected_items']=$treatment->get_tbl_treatment($visit_id);
        $data['patient'] = VSearchPatient::model()->find("patient_id=:patient_id",array(':patient_id' => $patient_id));
        $rst = VAppointmentState::model()->find("visit_id=:visit_id",array(':visit_id'=>$_GET['visit_id']));
        $data['patient_name'] = $rst->patient_name;
        $data['model'] = new Appointment('showPrescription');
        $data['visit_id'] = $visit_id;
        $this->render('visited_detail',$data);
    }
}