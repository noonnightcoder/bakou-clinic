<?php

class AppointmentController extends Controller
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
				'actions'=>array('create','update','admin','GetPatient','RetreivePatient','WaitingQueue','Consultation','DoctorConsult'),
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
		$model=new Appointment;
                $patient = new Patient;
                $contact = new Contact;
                $user = new RbacUser;
                $app_log= new AppointmentLog;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
                $doctor= Appointment::model()->get_combo_doctor();  
                
		if (isset($_POST['Appointment'])) {
                    $transaction=$model->dbConnection->beginTransaction();
                    try{
                        set_error_handler(array(&$this, "exception_error_handler")); 
			//$model->attributes=$_POST['Appointment'];
                        $model->appointment_date=date('Y-m-d H:i:s');
                        $model->end_date=date('Y-m-d');
                        $model->start_time=$_POST['Appointment']['start_time'];
                        $model->end_time=$_POST['Appointment']['end_time'];
                        $model->title=$_POST['Appointment']['title'];
                        $model->patient_id=$_POST['Patient']['display_id'];
                        $model->user_id=$_POST['RbacUser']['user_name'];
                        $model->status='Waiting';
                        $model->visit_id=0;
			if ($model->save()) {
                                $app_log->appointment_id=$model->id;
                                $app_log->change_date_time=date('Y-m-d H:i:s');
                                $app_log->start_time=$_POST['Appointment']['start_time'];
                                $app_log->status='Waiting';
                                //$app_log->user_id=Yii::app()->user->getId();
                                $app_log->user_id=$_POST['RbacUser']['user_name'];
                                $app_log->save();
                                $transaction->commit();
				$this->redirect(array('create','id'=>$model->id));
                        }                        
                    }catch (Exception $e){
                        $transaction->rollback();
                        echo $e->getMessage();
                    }
		}                
                
		$this->render('create',array(
			'model'=>$model,'patient'=>$patient,'contact'=>$contact,'user'=>$user,'doctor'=>$doctor
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

		if (isset($_POST['Appointment'])) {
			$model->attributes=$_POST['Appointment'];
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
		$dataProvider=new CActiveDataProvider('Appointment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Appointment('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Appointment'])) {
			$model->attributes=$_GET['Appointment'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Appointment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Appointment::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Appointment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='appointment-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function ActionGetPatient()
        {
            if (isset($_GET['term'])) {
                $term = trim($_GET['term']);
                $ret['results'] = Appointment::model()->m_get_patient($term); //PHP Example · ivaynberg/select2  http://bit.ly/10FNaXD got stuck serveral hoursss :|
                echo CJSON::encode($ret);
                Yii::app()->end();
            }
        }
        
        public function ActionRetreivePatient()
        {
            if (isset($_POST['patient_id'])) {
                $patient_info=Appointment::model()->RetreivePatient($_POST['patient_id']);
                $data['div_fullname']=$patient_info['display_name'];
                $data['div_msisdn']=$patient_info['phone_number'];
                $data['status']='success';
                echo CJSON::encode($data);
            }
        }
        
        public function actionWaitingQueue()
        {
            $model = new Appointment('get_doctor_queue');
            //return $model->get_doctor_queue();
            $this->render('DoctorQueue',array(
                'model'=>$model,
            ));
        }
        
        protected function gridLeaveStatusColumn($data,$row)
        {
            switch ($data['status']) {
                case 'Waiting': 
                    $status=$this->renderPartial('_appointment_state',array('status'=>'Waiting'),false,true);
                    //$status='At Immediate Supervisor';
                    break;                
                default:
                    $status=$this->renderPartial('_appointment_state',array('status'=>'Consultant'),false,true);
                    //$status='At Next Level Manager';
            }

            return $status;
        }
        
        public function actionConsultation()
        {
            $model = new Appointment;   
            $visit = new Visit;
            if(isset($_GET['appoint_id']))
            {
                //echo $_GET['appoint_id'];
                $patient_id=$_GET['patient_id'];
                $doctor_id=$_GET['doctor_id'];
                
                $model->appointment_consult($_GET['appoint_id']);
                $visit->patient_id=$patient_id;
                $visit->userid=$doctor_id;
                $visit->type="New Visit";
                $visit->visit_date=date('Y-m-d');
                if($visit->save())
                {
                    /*$this->render('DoctorConsult',array(
                        'model'=>$model,'patient_id'=>$patient_id,'doctor_id'=>$doctor_id,'visit_id'=>$visit->visit_id
                    ));*/
                    
                    $this->redirect(array('DoctorConsult','visit_id'=>$visit->visit_id,'patient_id'=>$patient_id,'doctor_id'=>$doctor_id));
                }                 
                $this->render('DocdorQueue',array(
                    'model'=>$model,'patient_id'=>$patient_id,'doctor_id'=>$doctor_id
                ));
            }
        }
        
        public function actionDoctorConsult()
        {
            $model = new Appointment;
            $patient = new Patient;
            //$employee = new Employee;
            $visit = new Visit;
            $load_treatment = new Treatment;
            $saleItem = new SaleItem;
            $sale = new Sale;
            //$my_treat = array();
            if(isset($_POST['Treatment']))
            {              
                $sale->client_id = $_GET['patient_id'];
                $sale->employee_id = $_GET['doctor_id'];
                $sale->sale_time = date('Y-m-d');
                $sale->status=0;
                if($sale->save())
                {
                    $this->treatment_check($_POST['Treatment'],$sale->id);
                }
            }
            
            $employee= Employee::model()->findByPk($_GET['doctor_id']);
            //print_r($treatment);
            if ($employee===null) {
                    throw new CHttpException(404,'The requested page does not exist.');
            }
            $id=1;
            $treatment=$load_treatment->load_treatment($id);
            //print_r($treatment);
            $this->render('create_consult',array('model'=>$model,'visit'=>$visit,'employee'=>$employee,'treatment'=>$treatment,'patient'=>$patient));
            
        }
        
        protected function treatment_check($treatment,$id)
        {
            $saleItem = new SaleItem;
            $saleItem->sale_id = $id;
            foreach ($treatment as $key => $value)
            {
                foreach ($value as $val)
                {
                    $treatment = Treatment::model()->findByPk($val);
                    $saleItem->item_id = $val;
                    $saleItem->price = $treatment->price;
                    $saleItem->isNewRecord = true; //http://bit.ly/1EY9rCW
                    $saleItem->save();
                }                           
            }
        } 
}