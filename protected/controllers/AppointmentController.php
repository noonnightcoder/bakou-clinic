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
				'actions'=>array('index','view','suggestItem'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(
                                    'create','update','admin','GetPatient','RetreivePatient',
                                    'WaitingQueue','Consultation','DoctorConsult','AppointmentDash',
                                    'AddTreatment','DeleteTreatment','SelectMedicine',
                                    'Addmedicine','GetMedicine','DeleteMedicine',
                                    'GetTreatment','InitTreatment','EditMedicine'
                                    ),
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
        
        public function actions()
	{
		return array(
			'suggestItem'=>array(
				'class'=>'ext.actions.XSuggestAction',
				'modelName'=>'Item',
				'methodName'=>'suggest',
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
		$model=new Appointment;
                $patient = new Patient;
                $contact = new Contact;
                $user = new RbacUser;
                $app_log= new AppointmentLog;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
                //$doctor= Appointment::model()->get_combo_doctor();  
                
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
                        $model->patient_id=$_POST['Patient']['patient_id'];
                        $model->user_id=$_POST['RbacUser']['id'];
                        $model->status='Waiting';
                        $model->visit_id=0;
			if ($model->save()) {
                                $app_log->appointment_id=$model->id;
                                $app_log->change_date_time=date('Y-m-d H:i:s');
                                $app_log->start_time=$_POST['Appointment']['start_time'];
                                $app_log->status='Waiting';
                                //$app_log->user_id=Yii::app()->user->getId();
                                $app_log->user_id=$_POST['RbacUser']['id'];
                                $app_log->save();
                                $transaction->commit();
				//$this->redirect(array('create','id'=>$model->id));
                                $this->redirect(Yii::app()->user->returnUrl);
                        }                        
                    }catch (Exception $e){
                        $transaction->rollback();
                        echo $e->getMessage();
                    }
		}                
                if(isset($_GET['doctor_id']))
                {
                    $user = RbacUser::model()->findByPk($_GET['doctor_id']);
                }
                
		$this->render('create',array(
			'model'=>$model,'patient'=>$patient,'contact'=>$contact,'user'=>$user
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
        
        public function actionGetMedicine()
        {
            if (isset($_GET['term'])) {
                $term = trim($_GET['term']);
                $ret['results'] = Item::model()->m_get_medicine($term); //PHP Example · ivaynberg/select2  http://bit.ly/10FNaXD got stuck serveral hoursss :|
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
            if(isset($_GET['appoint_id']) && isset($_GET['patient_id']) && isset($_GET['doctor_id']))
            {
                //echo $_GET['appoint_id'];
                $patient_id=$_GET['patient_id'];
                $doctor_id=$_GET['doctor_id'];
                $num = Appointment::model()->CheckApptStatus($_GET['appoint_id'], $_GET['patient_id'], $_GET['doctor_id']);
                if ($num==0)
                {
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
                        $model->appointment_visit($_GET['appoint_id'],$visit->visit_id);
                        $this->redirect(array('DoctorConsult','visit_id'=>$visit->visit_id,'patient_id'=>$patient_id,'doctor_id'=>$doctor_id));
                    } 
                }else{
                   $visit = Appointment::model()->findByPk($_GET['appoint_id']); 
                   $this->redirect(array('DoctorConsult','visit_id'=>$visit->visit_id,'patient_id'=>$patient_id,'doctor_id'=>$doctor_id));
                }  
                
                $this->render('DocdorQueue',array(
                    'model'=>$model,'patient_id'=>$patient_id,'doctor_id'=>$doctor_id
                ));
            }
        }
        
        public function actionDoctorConsult()
        {
            if(isset($_GET['visit_id']) and isset($_GET['patient_id']) and isset($_GET['doctor_id']))
            {
                $userid = Yii::app()->user->getId();            
                if($userid!=$_GET['doctor_id'])
                {
                    throw new CHttpException(400, 'Invalid Doctor. Please do not repeat this request again.');
                }

                $model = new Appointment;
                $patient = new Patient;
                //$employee = new Employee;
                $visit = new Visit;
                $treatment = new Treatment;
                $sale = new Sale;
                $medicine = new Item;
                
                if(isset($_POST['Treatment']) || isset($_POST['Visit']))
                {   
                        $num = Appointment::model()->ValidateConsult($_GET['visit_id'],$_GET['patient_id'],$_GET['doctor_id']);            
                
                        if($num>0)
                        {
                            $sale->client_id = $_GET['patient_id'];
                            $sale->employee_id = $_GET['doctor_id'];
                            $sale->sale_time = date('Y-m-d');
                            $sale->status=0;
                            if($sale->save())
                            {
                                //$this->treatment_check($_POST['Treatment'],$sale->id);
                                $this->redirect(Yii::app()->user->returnUrl);
                            }
                            //Yii::app()->user->returnUrl;
                            Yii::app()->user->setFlash('success', '<strong>Well done!</strong> successfully saved.');
                        }else{
                            Yii::app()->user->setFlash('error', '<strong>Oh snap!</strong> Change a few things up and try submitting again.');
                        }
                }else{

                }

                $employee_id = RbacUser::model()->findByPk($_GET['doctor_id']);
                //$employee= Employee::model()->findByPk($employee_id->employee_id);
                $employee = Employee::model()->get_doctorName($employee_id->employee_id);

                if ($employee===null) {
                        throw new CHttpException(404,'The requested page does not exist.');
                }
                $data['model']=$model;
                $data['visit']=$visit;
                $data['employee']=$employee;
                $data['treatment']=$treatment;
                $data['patient']=$patient;
                $data['treatment_items']=$treatment->get_all_treatment(); 
                $data['medicine']=$medicine;
                $data['treatment_selected_items']=Yii::app()->treatmentCart->getCart(); 
                $data['medicine_selected_items'] = Yii::app()->treatmentCart->getMedicine();

                $this->render('create_consult',$data);
            }else{
                throw new CHttpException(404,'The requested page does not exist.');
            }
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
        
        public function actionAppointmentDash()
        {
            $model = new Appointment;
            //$doctors= array('name'=>'Tep Phally');
            $doctors = $model->get_combo_doctor();
            $appointment = $model->get_appointment();
            $this->render('Appointment_dashboard',array('doctors'=>$doctors,'appointment'=>$appointment));
        }
        
        public function actionAddTreatment()
        {
            $treatment = new Treatment;
            //$treatment_selected_items = array();
            if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest )
            {
                Yii::app()->treatmentCart->addItem($_POST['treatment_id']);                
                $treatment_selected_items=Yii::app()->treatmentCart->getCart();
                
                if (Yii::app()->request->isAjaxRequest) {
                    $cs = Yii::app()->clientScript;
                    $cs->scriptMap = array(
                        'jquery.js' => false,
                        'bootstrap.js' => false,
                        'jquery.min.js' => false,
                        'bootstrap.min.js' => false,
                        'bootstrap.notify.js' => false,
                        'bootstrap.bootbox.min.js' => false,
                    );
                }
                echo CJSON::encode(array(
                    'status' => 'success',
                    'div_treatment_form' => $this->renderPartial('_ajax_treatment', array('treatment_selected_items' => $treatment_selected_items,'treatment'=>$treatment), true, true),
                ));
                
                Yii::app()->end();
            } else {
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            }
        }
        
        public function actionDeleteTreatment($treatment_id)
        {
            $treatment = new Treatment;
            
            if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
                Yii::app()->treatmentCart->deleteItem($treatment_id);
                $treatment_selected_items=Yii::app()->treatmentCart->getCart();
                
                if (Yii::app()->request->isAjaxRequest) {
                    $cs = Yii::app()->clientScript;
                    $cs->scriptMap = array(
                        'jquery.js' => false,
                        'bootstrap.js' => false,
                        'jquery.min.js' => false,
                        'bootstrap.min.js' => false,
                        'bootstrap.notify.js' => false,
                        'bootstrap.bootbox.min.js' => false,
                    );
                }
                echo CJSON::encode(array(
                    'status' => 'success',
                    'div_treatment_form' => $this->renderPartial('_ajax_treatment', array('treatment_selected_items' => $treatment_selected_items,'treatment'=>$treatment), true, true),
                ));
                
                Yii::app()->end();
            } else {
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            }
        }
        
        public function actionAddmedicine()
        {
            $medicine = new Item;
            
            if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {                
                Yii::app()->treatmentCart->addMedicine($_POST['medicine_id']);                
                //$medicine_selected_items=Yii::app()->treatmentCart->getMedicine();
                $data['medicine']=$medicine;
                $data['medicine_selected_items'] = Yii::app()->treatmentCart->getMedicine();
                Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false; 
                Yii::app()->clientScript->scriptMap['box.css'] = false; 
                
                
                if (Yii::app()->request->isAjaxRequest) {
                    $cs = Yii::app()->clientScript;
                    $cs->scriptMap = array(
                        'jquery.js' => false,
                        'bootstrap.js' => false,
                        'jquery.min.js' => false,
                        'bootstrap.min.js' => false,
                        'bootstrap.notify.js' => false,
                        'bootstrap.bootbox.min.js' => false,
                    );
                }
                echo CJSON::encode(array(
                    'status' => 'success',
                    'div_medicine_form' => $this->renderPartial('_select_medicine', $data, true, true),
                ));
                
                Yii::app()->end();
            } else {
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            }
        }
        
        public function actionDeleteMedicine($medicine_id)
        {
            $treatment = new Treatment;
            
            if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
                Yii::app()->treatmentCart->deleteMedicine($medicine_id);
                $data['medicine_selected_items']=Yii::app()->treatmentCart->getMedicine();
                
                if (Yii::app()->request->isAjaxRequest) {
                    $cs = Yii::app()->clientScript;
                    $cs->scriptMap = array(
                        'jquery.js' => false,
                        'bootstrap.js' => false,
                        'jquery.min.js' => false,
                        'bootstrap.min.js' => false,
                        'bootstrap.notify.js' => false,
                        'bootstrap.bootbox.min.js' => false,
                    );
                }
                echo CJSON::encode(array(
                    'status' => 'success',
                    'div_medicine_form' => $this->renderPartial('_select_medicine', $data, true, true),
                ));
                
                Yii::app()->end();
            } else {
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            }
        }
        
        public function actionGetTreatment() { 
            if (isset($_GET['term'])) {
                 $term = trim($_GET['term']);
                 $ret['results'] = Treatment::getTreatment($term); //PHP Example · ivaynberg/select2  http://bit.ly/10FNaXD got stuck serveral hoursss :|
                 echo CJSON::encode($ret);
                 Yii::app()->end();

            }
        }
        
        public function actionInitTreatment() 
        {
            $model = Treatment::model()->find('id=:treatment_id',array(':treatment_id'=>(int)$_GET['id']));
            if($model!==null) {
                echo CJSON::encode(array('id'=>$model->id,'text'=>$model->treatment));
            }
        }
        
        public function actionEditMedicine()
        {
            $medicine = new Item;
            if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
                $data= array();
                $model = new Item;
                $medicine_id = isset($_POST['Item']['id']) ? $_POST['Item']['id'] : null;
                $quantity = isset($_POST['Item']['quantity']) ? $_POST['Item']['quantity'] : null;
                $price =isset($_POST['Item']['unit_price']) ? $_POST['Item']['unit_price'] : null;
                
                $model->quantity=$quantity;
                $model->unit_price=$price;

                if ($model->validate()) {
                    Yii::app()->treatmentCart->editMedicine($medicine_id, $quantity, $price);
                } else {
                    $error=CActiveForm::validate($model);
                    $errors = explode(":", $error);
                    //$data['warning']=  str_replace("}","",$errors[1]);
                    $data['warning'] = Yii::t('app','Input data type is invalid');
                }
                
                $data['medicine']=$medicine;
                $data['medicine_selected_items'] = Yii::app()->treatmentCart->getMedicine();
                
                if (Yii::app()->request->isAjaxRequest) {
                    $cs = Yii::app()->clientScript;
                    $cs->scriptMap = array(
                        'jquery.js' => false,
                        'bootstrap.js' => false,
                        'jquery.min.js' => false,
                        'bootstrap.min.js' => false,
                        'bootstrap.notify.js' => false,
                        'bootstrap.bootbox.min.js' => false,
                    );
                }
                echo CJSON::encode(array(
                    'status' => 'success',
                    'div_medicine_form' => $this->renderPartial('_select_medicine', $data, true, true),
                ));
                
                Yii::app()->end();
            } else {
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            }

        }
}