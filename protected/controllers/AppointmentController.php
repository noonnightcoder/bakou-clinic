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
                                'create','Delete','update','admin','GetPatient','RetreivePatient',
                                'WaitingQueue','Consultation','DoctorConsult','AppointmentDash',
                                'AddTreatment','DeleteTreatment','SelectMedicine',
                                'Addmedicine','GetMedicine','DeleteMedicine',
                                'GetTreatment','InitTreatment','EditMedicine',
                                'EditTreatment','completedConsult','CancelAppointment',
                                'Prescription','prescriptionDetail','AddPayment',
                                'CompleteSale','DeletePayment','Labocheck',
                                'LaboPreview','LaboView','Pharmacy','PharmacyDetail',
                                'ActualAmount','InitMedicine','Emptytreatment','Emptypayment','AjaxWaitingQueue','AjaxAppointmentDash'
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

            if(!Yii::app()->user->checkAccess('appointment.create'))
            {
                throw new CHttpException(400,'You are not authorized to perform this action.');
            }
            
            if (isset($_POST['Appointment'])) {
                
                $chk=Appointment::model()->chk_user_inqueue($_POST['Patient']['patient_id']);
                if($chk==0)
                {
                   $transaction=$model->dbConnection->beginTransaction();
                    try{
                        //set_error_handler(array(&$this, "exception_error_handler")); 
                        //$model->attributes=$_POST['Appointment'];
                        $model->attributes=$_POST['Appointment'];
                        $model->appointment_date=date('Y-m-d H:i:s');
                        $model->end_date=date('Y-m-d');
                        $model->start_time=$_POST['Appointment']['start_time'];
                        $model->end_time=$_POST['Appointment']['end_time'];
                        $model->title=$_POST['Appointment']['title'];
                        $model->patient_id=$_POST['Patient']['patient_id'];
                        $model->user_id=$_POST['RbacUser']['id'];
                        $model->status='Waiting';
                        $model->visit_id=0;
                        $model->actual_amount=0;
                        
                        if ($model->save()) {
                                $app_log->appointment_id=$model->id;
                                $app_log->change_date_time=date('Y-m-d H:i:s');
                                $app_log->start_time=$_POST['Appointment']['start_time'];
                                $app_log->status='Waiting';
                                //$app_log->user_id=Yii::app()->user->getId();
                                $app_log->user_id=$_POST['RbacUser']['id'];
                                $app_log->save();
                                $transaction->commit();
                                $this->redirect(array('appointment/appointmentdash'));
                                //$this->redirect(Yii::app()->user->returnUrl);
                        }else{
                        }                        
                    }catch (Exception $e){
                        $transaction->rollback();
                        echo $e->getMessage();
                    } 
                }else{
                    Yii::app()->user->setFlash('success', '<strong>Ooop!</strong> This patient already in queue.');
                }                
            }                
            if(isset($_GET['doctor_id']))
            {
                $user = RbacUser::model()->findByPk($_GET['doctor_id']);
            }
            
            /*if (isset($_GET['patient_id'])) {
            $term = trim($_GET['patient_id']);
            $ret['results'] = Appointment::model()->m_get_patient($term); //PHP Example · ivaynberg/select2  http://bit.ly/10FNaXD got stuck serveral hoursss :|
                echo CJSON::encode($ret);
                Yii::app()->end();
            }*/
            
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
            if(!Yii::app()->user->checkAccess('appointment.delete'))
            {
                throw new CHttpException(400,'You are not authorized to perform this action.');
            }
            
            if (Yii::app()->request->isPostRequest) {
                    // we only allow deletion via POST request
                    $this->loadModel($id)->delete();

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if (!isset($_GET['ajax'])) {
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                    }
            } else {
                    throw new CHttpException(400,'Invalid request. Please do not repeat this request again');
            }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
            /*$dataProvider=new CActiveDataProvider('Appointment');
            $this->render('index',array(
                    'dataProvider'=>$dataProvider,
            ));*/
        throw new CHttpException(400,'Invalid page request.');
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

    public function actionAjaxWaitingQueue()
    {
        $model = new Appointment('get_doctor_queue');
        //return $model->get_doctor_queue();
        $this->renderPartial('_ajax_DoctorQueue',array(
            'model'=>$model,
        ));
    }

    protected function gridLeaveStatusColumn($data,$row)
    {
        /*switch ($data['status']) {
            case 'Waiting': 
                $status=$this->renderPartial('_appointment_state',array('status'=>'Waiting'),false,true);
                //$status='At Immediate Supervisor';
                break;                
            default:
                $status=$this->renderPartial('_appointment_state',array('status'=>'Consultant'),false,true);
                //$status='At Next Level Manager';
        }*/
        //$status=$this->renderPartial('_appointment_state',array('status'=>$data['status']),false,true);
        if($data['status']=='Waiting'){ 
            echo TbHtml::labelTb('Waiting',array('color' => TbHtml::LABEL_COLOR_WARNING));  
        }elseif ($data['status']=='Complete') {
            echo TbHtml::labelTb('Complete',array('color' => TbHtml::LABEL_COLOR_SUCCESS));  
        }elseif ($data['status']=='Cancel') {
            echo TbHtml::labelTb('Cancel',array('color' => TbHtml::BUTTON_COLOR_INVERSE));  
        }else{
           echo TbHtml::labelTb('Consultant');
        }
        //return $status;
    }

    public function actionConsultation()
    {
        $model = new Appointment;  
        $app_log = new AppointmentLog;
        $visit = new Visit;
        
        if(!Yii::app()->user->checkAccess('consultation.create'))
        {
            throw new CHttpException(400,'You are not authorized to perform this action.');
        } 
        
        if(isset($_GET['appoint_id']) && isset($_GET['patient_id']) && isset($_GET['doctor_id']))
        {
            //----***Check if appointment already exist***----//
            $patient_id=$_GET['patient_id'];
            $doctor_id=$_GET['doctor_id'];
            $num = Appointment::model()->CheckApptStatus($_GET['appoint_id'], $_GET['patient_id'], $_GET['doctor_id']);
            if ($num==0)
            {
                $model->appointment_consult($_GET['appoint_id']); //update appointment status

                $app_log->appointment_id=$_GET['appoint_id'];
                $app_log->change_date_time = date('Y-m-d h:i:s');
                $app_log->status = 'Consultation';
                $app_log->user_id = $_GET['doctor_id'];
                if($app_log->validate()){$app_log->save();}                    

                $visit->patient_id=$patient_id;
                $visit->userid=$doctor_id;
                $visit->type="New Visit";
                $visit->visit_date=date('Y-m-d');
                //$visit->sympton = 'NA';
                //$visit->observation='NA';
                //$visit->assessment='NA';
                //$visit->plan='NA';
                if($visit->validate())
                {
                   if($visit->save())
                    {
                        $model->appointment_visit($_GET['appoint_id'],$visit->visit_id);
                        $this->redirect(array('DoctorConsult','visit_id'=>$visit->visit_id,'patient_id'=>$patient_id,'doctor_id'=>$doctor_id));
                    }  
                }                    
            }else{
               $visit = Appointment::model()->findByPk($_GET['appoint_id']); 
               $this->redirect(array('DoctorConsult','visit_id'=>$visit->visit_id,'patient_id'=>$patient_id,'doctor_id'=>$doctor_id));
            }  

            $this->render('DoctorQueue',array(
                'model'=>$model,'patient_id'=>$patient_id,'doctor_id'=>$doctor_id
            ));
        }
    }

    public function actionDoctorConsult()
    {
        $model = new Appointment;
        $patient = new Patient;
        $visit = Visit::model()->findByPk($_GET['visit_id']);
        $treatment = new Treatment;
        $bill = new Bill;
        $prescription = new Prescription;
        $medicine = new Item;
        $lab_items = new TreatmentItemDetail;

        if(!Yii::app()->user->checkAccess('consultation.create'))
        {
            throw new CHttpException(400,'You are not authorized to perform this action.');
        }

        if(isset($_POST['ajax']) && $_POST['ajax']==='add_item_form')
        {
            if(isset($_POST['Completed_consult']))
            {
                //$model->attributes=$_POST['Appointment'];
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }else{
                echo CActiveForm::validate($visit);
                Yii::app()->end();
            }
        }

        if(isset($_GET['visit_id']) && isset($_GET['patient_id']) && isset($_GET['doctor_id']))
        {
            $userid = Yii::app()->user->getId();

            if($userid!=$_GET['doctor_id'])
            {
                throw new CHttpException(400, 'Invalid Doctor. Please login to the right doctor.');
            }

            $treatment_selected = Yii::app()->treatmentCart->getCart();
            $medicine_selected = Yii::app()->treatmentCart->getMedicine();

            //$patient = VSearchPatient::model()->find("patient_id=:patient_id",array(':patient_id' => $_GET['patient_id']));

            //---****Loop treatment into session****---//
            if(empty($treatment_selected))
            {
                $tbl_treatment = $treatment->get_tbl_treatment($_GET['visit_id']);
                foreach ($tbl_treatment as $value) {
                    Yii::app()->treatmentCart->addItem($value['id'],$value['amount']);
                }
            }
            //---****Loop medicine into session****---//
            /*if(empty($medicine_selected))
            {*/
            $tbl_medicine = $medicine->get_tbl_medicine($_GET['visit_id']);
            foreach ($tbl_medicine as $value) {
                Yii::app()->treatmentCart->addMedicine($value['id'],$value['unit_price'],$value['quantity'],
                                        $value['dosage'],$value['duration_id'],$value['frequency'],
                                        $value['instruction_id'],$value['comment'],
                                        $value['consuming_time_id']);
            }
            //}

            if(isset($_POST['Treatment']) || isset($_POST['Visit']))
            {
                $num = Appointment::model()->ValidateConsult($_GET['visit_id'],$_GET['patient_id'],$_GET['doctor_id']);

                if($num>0)
                {
                    $transaction=$model->dbConnection->beginTransaction();
                    try{
                        //-----***check whether the current visit already insert to bill yet***----//
                        $chk_bill = Bill::model()->find(array(
                                    'condition' => 'patient_id=:patient_id and visit_id=:visit_id and status=0',
                                    'params' => array(':patient_id'=>$_GET['patient_id'],':visit_id'=>$_GET['visit_id']))
                                );

                        if(!empty($chk_bill))
                        {
                            //----***Delete if bill already exists***----// 
                            if(!empty($treatment_selected))
                            {
                                BillDetail::model()->deleteAll(
                                    array('condition'=>'bill_id=:bill_id',
                                    'params'=>array(':bill_id'=>$chk_bill->bill_id))
                                );
                            }

                            foreach ($treatment_selected as $key => $value) {
                                $treatment->saveTreatment($chk_bill->bill_id,$value['id'],$value['price']);
                            }

                        }else{
                            $bill->bill_date = date('Y-m-d');
                            $bill->patient_id = $_GET['patient_id'];
                            $bill->visit_id = $_GET['visit_id'];
                            $bill->status = '0';
                            if($bill->validate()) $bill->save();

                            foreach ($treatment_selected as $key => $value) {
                                    $treatment->saveTreatment($bill->bill_id,$value['id'],$value['price']);
                            }
                        }
                        //-----****Loop from Medicine session****-----//
                        $chk_medicine = Prescription::model()->find(array(
                                    'condition' => 'visit_id=:visit_id',
                                    'params' => array(':visit_id'=>$_GET['visit_id']))
                                );

                        if(!empty($chk_medicine))
                        {
                            //---***Delete if Prescription already exists***---// 
                            /*if(!empty($medicine_selected))
                            {*/
                            PrescriptionDetail::model()->deleteAll(
                                array('condition'=>'prescription_id=:prescription_id',
                                'params'=>array(':prescription_id'=>$chk_medicine->id))
                            );
                            //}

                            foreach ($medicine_selected as $key => $value) {
                                $prescription->saveMedicine($chk_medicine->id,$value['id'],$value['quantity'],$value['price'],$value['dosage'],$value['duration'],$value['frequency'],$value['instruction_id'],$value['comment'],$value['consuming_time_id']);
                            }
                        }else{
                            $prescription->date_created = date('Y-m-d');
                            $prescription->visit_id = $_GET['visit_id'];
                            $prescription->last_update = date('Y-m-d');
                            $prescription->updated_by = $userid;

                            if($prescription->validate()) $prescription->save();

                            foreach ($medicine_selected as $key => $value) {
                                    $prescription->saveMedicine($prescription->id,$value['id'],$value['quantity'],$value['price'],$value['dosage'],$value['duration'],$value['frequency'],$value['instruction_id'],$value['comment'],$value['consuming_time_id']);
                            }
                        }
                        //----***Update Visit table****----//
                        Visit::model()->updateByPk($_GET['visit_id'],array(
                                        'sympton'=>$_POST['Visit']['sympton'],
                                        'observation'=>$_POST['Visit']['observation'],
                                        'assessment'=>$_POST['Visit']['assessment'],
                                        'plan'=>$_POST['Visit']['plan'],
                                    )
                                );
                        /*if(!empty($_POST['Visit']['sympton']) || !empty($_POST['Visit']['observation']) || !empty($_POST['Visit']['assessment']) ||!empty($_POST['Visit']['plan']))
                        {*/
                        if(isset($_POST['Completed_consult']))
                        {
                            if(!empty($treatment_selected) || !empty($medicine_selected))
                            {
                                //if($model->validate())
                                //{
                                    $actual_amount = $_POST['Appointment']['actual_amount'];
                                    //echo $actual_amount; die();
                                    $this->actioncompletedConsult($_GET['visit_id'],$_GET['patient_id'],$actual_amount);
                                //}
                            }else{
                                Yii::app()->user->setFlash('success', '<strong>Ooop!</strong> Please select treatment or medicine!.');
                            }
                        }else{
                            Yii::app()->user->setFlash('success', '<strong>Consultation!</strong> successfully saved.');
                        }
                        /*}else{
                            Yii::app()->user->setFlash('success', '<strong>Ooop!</strong> Please insert the Sympton, Observation....');
                            //$transaction->rollback();
                        }*/
                        $transaction->commit();
                        Yii::app()->treatmentCart->clearAll();
                        //echo json_encode(array('redirect'=>$this->createUrl('appointment/waitingqueue')));
                        $this->redirect(array('appointment/waitingqueue'));
                        //exit;
                    }catch (Exception $e){
                        $transaction->rollback();
                        Yii::app()->user->setFlash('error', '<strong>Process was rollback! </strong>Please contact administrator.');
                        echo $e->getMessage();
                    }
                }else{
                    Yii::app()->user->setFlash('error', '<strong>Oh snap!</strong> Change a few things up and try submitting again.');
                }
            }

            $employee_id = RbacUser::model()->findByPk($_GET['doctor_id']);
            //$employee= Employee::model()->findByPk($employee_id->employee_id);
            $employee = Employee::model()->get_doctorName($employee_id->employee_id);

            if ($employee===null) {
                throw new CHttpException(404,'The requested page does not exist.');
            }

            $rst = VAppointmentState::model()->find("visit_id=:visit_id", array(':visit_id' => $_GET['visit_id']));
            $data['patient_name'] = $rst->patient_name;
            //$data['actual_form'] = new ActualAmountForm();
            $data['chk_bill_saved'] = Bill::model()->find("visit_id=:visit_id", array(':visit_id' => $_GET['visit_id']));
            $data['model'] = $model;
            $data['visit'] = $visit;
            $data['employee'] = $employee;
            $data['treatment'] = $treatment;
            $data['patient'] = $patient;
            $data['treatment_items'] = $treatment->get_all_treatment();
            $data['medicine'] = $medicine;
            $data['visit_id'] = $_GET['visit_id'];
            $data['treatment_selected_items'] = Yii::app()->treatmentCart->getCart();
            $data['medicine_selected_items'] = Yii::app()->treatmentCart->getMedicine();
            

            $model->actual_amount = $model->sumBill($data['visit_id']);
            
            $chk_lab_detail = LabAnalized::model()->find("visit_id=:visit_id",array(':visit_id'=>$_GET['visit_id']));
            if(!empty($chk_lab_detail))
            {
                //echo $chk_lab_detail->id; die();
                //print_r($chk_lab_detail); die();
                $criteria = new CDbCriteria;
                $criteria->condition = 'lab_analized_id=:myid';
                $criteria->select = 'itemtest_id';
                $criteria->params = array(':myid' => $chk_lab_detail->id);
                $lab_selected = LabAnalyzedDetail::model()->findall($criteria);
                //print_r($lab_selected); die();
                $lab_item_detail = array();
                foreach ($lab_selected as $lab_item) {
                    $lab_item_detail[] = $lab_item->itemtest_id;
                }

                $lab_items->hematology = $lab_item_detail;
                $lab_items->immuno_hematology = $lab_item_detail;
                $lab_items->immunology = $lab_item_detail;
                $lab_items->hormones = $lab_item_detail;
                $lab_items->coagulation = $lab_item_detail;
                $lab_items->serology = $lab_item_detail;
                $lab_items->micro_biology = $lab_item_detail;
                $lab_items->blood_biochemistry = $lab_item_detail;
                $lab_items->urology = $lab_item_detail;
                $lab_items->bacteriology = $lab_item_detail;
            }
            $data['lab_items']=$lab_items;
            $this->render('consultation_form',$data);

        }else{
            throw new CHttpException(404,'The requested page does not exist.');
        }
    }
    
    public function actionLabocheck()
    {
        if(!Yii::app()->user->checkAccess('consultation.view'))
        {
            throw new CHttpException(400,'You are not authorized to perform this action.');
        }else{
            $model = new Appointment('get_patient_queue');
            $this->render('labocheck',array(
                'model'=>$model,
            ));
        }
    }
    
    public function actionLaboPreview()
    {
        $patient_id=$_GET['patient_id'];
        $doctor_id=$_GET['doctor_id'];
        
        if(!Yii::app()->user->checkAccess('consultation.view'))
        {
            throw new CHttpException(400,'You are not authorized to perform this action.');
        }else{
            $visit = Appointment::model()->findByPk($_GET['appoint_id']); 
            $this->redirect(array('LaboView','visit_id'=>$visit->visit_id,'patient_id'=>$patient_id,'doctor_id'=>$doctor_id));
        }    
    }
    
    public function actionLaboView()
    {
        $model = new Appointment;  
        $treatment = new Treatment;
        $medicine = new Item;
        $tran_log = new TransactionLog;
        //$patient = new Patient;

        if(!Yii::app()->user->checkAccess('consultation.view'))
        {
            throw new CHttpException(400,'You are not authorized to perform this action.');
        }
        
        if(isset($_GET['visit_id']) && isset($_GET['patient_id']) && isset($_GET['doctor_id']))
        {      
            $employee_id = RbacUser::model()->findByPk($_GET['doctor_id']);
            $employee = Employee::model()->get_doctorName($employee_id->employee_id);
            $data['treatment']=$treatment;
            $patient = VSearchPatient::model()->find("patient_id=:patient_id",array(':patient_id' => $_GET['patient_id']));
            
            $data['treatment_selected_items']=$treatment->get_tbl_treatment($_GET['visit_id']);
            $data['medicine_selected_items']=$medicine->get_tbl_medicine($_GET['visit_id']);
            $data['model']=$model;
            $data['visit']=  Visit::model()->findByPk($_GET['visit_id']);
            $data['employee']=$employee;
            $data['treatment']=$treatment;
            $data['patient']=$patient;
            $data['treatment_items']=$treatment->get_all_treatment(); 
            $data['medicine']=$medicine;
            $data['visit_id'] = $_GET['visit_id'];
            $rst = VAppointmentState::model()->find("visit_id=:visit_id",array(':visit_id'=>$_GET['visit_id']));
            $data['lab_selected'] = LabAnalyzedDetail::model()->get_lab_analized($_GET['visit_id']);
            $data['patient_name'] = $rst->patient_name;
            
            //print_r($data['lab_selected']);
            $my_value="";
            $lab_items_s=array();
            if(isset($_POST['lab_items_f']) || isset($_POST['lab_items_s']))
            {
                $lab_items_s = $_POST['lab_items_s'];
                $lab_items_name = $_POST['lab_items_name'];
                $blood_item_id = $_POST['blood_item_id'];
                foreach ($_POST['lab_items_f'] as $key =>$val)
                {                    
                    if($key==4)
                    {
                        $my_value =  '"'.$lab_items_name[$key].'": '.$val.' "Rh": '.$lab_items_s[$key];
                    }elseif($key==16 || $key==17){
                        $my_value =  '"'.$lab_items_name[$key].' mm": '.$val.' "sec": '.$lab_items_s[$key];
                    }elseif($key==19){
                        $my_value =  '"'.$lab_items_name[$key].' IgG": '.$val.' "IgM": '.$lab_items_s[$key];
                    }elseif($key==29){
                        $my_value =  '"'.$lab_items_name[$key].' To": '.$val.' "TH": '.$lab_items_s[$key];
                    }elseif($key==44){
                        $my_value =  '"'.$lab_items_name[$key].' SGOT(ASAT)": '.$val.' "SGPT(ALAT)": '.$lab_items_s[$key];
                    }else{
                        $my_value='"'.$lab_items_name[$key].'": '.$val;
                    }                    
                    LabAnalyzedDetail::model()->updateByPk($blood_item_id[$key],array('val'=>$my_value));
                }
                //echo $my_value;
                //print_r($lab_items_s);
                $tran_log->visit_id = $_GET['visit_id'];
                $tran_log->created_date = date('Y-m-d h:i:s');
                $tran_log->transaction_name = 'Lab';
                if($tran_log->validate()) $tran_log->save ();
                $this->redirect(array('appointment/labocheck'));
            }
            
            $this->render('labo_view',$data);
        }else{
            throw new CHttpException(404,'The requested page does not exist.');
        }    
    }

    /*protected function treatment_check($treatment,$id)
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
    }*/

    public function actionAppointmentDash()
    {
        $model = new Appointment;
        //$doctors= array('name'=>'Tep Phally');
        $doctors = $model->get_combo_doctor();
        $appointment = $model->get_appointment();
        $this->render('Appointment_dashboard',array('doctors'=>$doctors,'appointment'=>$appointment));
    }

    public function actionAjaxAppointmentDash()
    {
        $model = new Appointment;
        //$doctors= array('name'=>'Tep Phally');
        $doctors = $model->get_combo_doctor();
        $appointment = $model->get_appointment();
        $this->renderPartial('_ajax_Appointment_dashboard',array('doctors'=>$doctors,'appointment'=>$appointment));
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
            Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false; 
            Yii::app()->clientScript->scriptMap['box.css'] = false;
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
            Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false; 
            Yii::app()->clientScript->scriptMap['box.css'] = false;
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
            $data['medicine']=$medicine;
            $data['medicine_selected_items'] = Yii::app()->treatmentCart->getMedicine();
            //print_r($data['medicine_selected_items']); die();
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
            Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false; 
            Yii::app()->clientScript->scriptMap['box.css'] = false; 
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
        $medicine = new Item;

        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
            Yii::app()->treatmentCart->deleteMedicine($medicine_id);
            $data['medicine_selected_items']=Yii::app()->treatmentCart->getMedicine();
             $data['medicine']=  $medicine; 

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
            Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false; 
            Yii::app()->clientScript->scriptMap['box.css'] = false; 
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
    
    public function actionInitMedicine() 
    {
        echo CJSON::encode(array('id'=>'','text'=>''));
    }

    public function actionEditMedicine($medicine_id)
    {            
        $medicine = new Item;

        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
            $data= array();
            $quantity = isset($_POST['Item']['quantity']) ? $_POST['Item']['quantity'] : null;
            $price =isset($_POST['Item']['unit_price']) ? $_POST['Item']['unit_price'] : null;
            $dosage =isset($_POST['Item']['dosage']) ? $_POST['Item']['dosage'] : null;
            $duration =isset($_POST['Item']['duration']) ? $_POST['Item']['duration'] : null;
            $frequency =isset($_POST['Item']['frequency']) ? $_POST['Item']['frequency'] : null;
            $instruction_id =isset($_POST['Item']['instruction_id']) ? $_POST['Item']['instruction_id'] : null;
            $comment =isset($_POST['Item']['comment']) ? $_POST['Item']['comment'] : null;
            $consuming_time_id = isset($_POST['Item']['consuming_time_id']) ? $_POST['Item']['consuming_time_id'] : null;
            //echo $consuming_time_id;
            Yii::app()->treatmentCart->editMedicine($medicine_id, $quantity, $price,$dosage,$duration,$frequency,$instruction_id,$comment,$consuming_time_id);

            $data['medicine']=$medicine;
            $data['medicine_selected_items'] = Yii::app()->treatmentCart->getMedicine();
            $cs = Yii::app()->clientScript;
            $cs->scriptMap = array(
                'jquery.js' => false,
                'bootstrap.js' => false,
                'jquery.min.js' => false,
                'bootstrap.min.js' => false,
                'bootstrap.notify.js' => false,
                'bootstrap.bootbox.min.js' => false,
            );

            Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false; 
            Yii::app()->clientScript->scriptMap['box.css'] = false; 

            $this->renderPartial('_select_medicine', $data,false,true);            
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionEditTreatment($treatment_id)
    {
        $treatment = new Treatment;

        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
            $data= array();
            $price =isset($_POST['Treatment']['price']) ? $_POST['Treatment']['price'] : null;

            Yii::app()->treatmentCart->editTreatment($treatment_id, $price);

            $data['treatment']=$treatment;
            $data['treatment_selected_items'] = Yii::app()->treatmentCart->getCart();

            $cs = Yii::app()->clientScript;
            $cs->scriptMap = array(
                'jquery.js' => false,
                'bootstrap.js' => false,
                'jquery.min.js' => false,
                'bootstrap.min.js' => false,
                'bootstrap.notify.js' => false,
                'bootstrap.bootbox.min.js' => false,
            );

            Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false; 
            Yii::app()->clientScript->scriptMap['box.css'] = false; 

            $this->renderPartial('_ajax_treatment', $data,false,true);
            /*echo CJSON::encode(array(
                'status' => 'success',
                'div_medicine_form' => $this->renderPartial('_select_medicine', $data, true, true),
            ));

            Yii::app()->end();*/
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }
    
    protected function actioncompletedConsult($visit_id,$patient_id = 0,$actual_amount = 0)
    {
        if(!Yii::app()->user->checkAccess('consultation.create'))
        {
            throw new CHttpException(400,'You are not authorized to perform this action.');
        }else{
            $user_id = Yii::app()->user->getId();
            Appointment::model()->updateCompleteAppt($visit_id,$user_id,$patient_id,$actual_amount); 
            Yii::app()->treatmentCart->clearAll();
        }
    }
    
    public function actionCancelAppointment($appoint_id,$doctor_id='',$patient_id='')
    {
        $user_id = Yii::app()->user->getId();
        
        if(!Yii::app()->user->checkAccess('appointment.delete'))
        {
            throw new CHttpException(400,'You are not authorized to perform this action.');
        }
        
        $chk_group = RbacUser::model()->find("employee_id=:employee_id",array(':employee_id'=>$user_id));
        
        $chk_appt = Appointment::model()->findByPk($appoint_id);

        if($chk_group->group_id!=2 && $chk_appt->status!='Waiting')
        {
            Yii::app()->user->setFlash('success', '<strong>Ooop! </strong>Appointment was already processed!');
        }else{
            $model = new AppointmentLog;
            $transaction=$model->dbConnection->beginTransaction();
            try{

                Appointment::model()->updateByPk($appoint_id,array('status'=>'Cancel'));
                $model->appointment_id = $appoint_id;
                $model->change_date_time = date('Y-m-d h:i:s');
                $model->status = 'Cancel';
                $model->user_id = $user_id;
                $model->save();
                $transaction->commit();                        
                //$this->redirect(Yii::app()->user->returnUrl);
            }catch (Exception $e){
                $transaction->rollback(); 
                Yii::app()->user->setFlash('error', '<strong>Process was rollback! </strong>Please contact administrator.');
                echo $e->getMessage();
            }
        }
    }

    public function actionPrescription()
    {
        $model = new Appointment('showBill');
        
        if (isset($_GET['date_report'])) {
            $model->attributes = $_GET['Appointment'];
            $date_report = $_GET['Appointment']['date_report'];
        } else {
            $date_report = date('Y-m-d');
        }
        
        $model->date_report = $date_report;
        
        $this->render('prescription',array(
            'model'=>$model,'date_report'=>$date_report
        ));
    }
    
    public function actionprescriptionDetail($visit_id)
    {  
        //Yii::app()->treatmentCart->emptyPayment();
        $model = new Appointment;
        $rst = VAppointmentState::model()->find("visit_id=:visit_id",array(':visit_id'=>$visit_id));
        $data['patient_name'] = $rst->patient_name;
        $data['model'] = new Appointment('showBillDetail');
        $data['count_item'] = $model->countBill($visit_id);
        $data['amount'] = $model->sumBill($visit_id);
        $data['actual_amount'] = $model->get_actual_amount($visit_id);
        $data['visit_id'] = $visit_id;
        //$data['patient_name'] = $data['model']->patient_name;
        $data['payments'] =Yii::app()->treatmentCart->getPayments();
        
        //---***find bill was added yet***---//
        $count_payment=0;
        if(!empty($data['payments'])){$count_payment=1;}
        if($data['count_item']>0)
        {
            $data['count_payment'] = $count_payment;
            $this->render('prescriptionDetail',$data);
        }else{
            Yii::app()->user->setFlash('error', '<strong>There are no item! </strong>Please contact administrator.');
            $this->render('prescription',array(
                'model'=>$model,
            ));
        }
    }
    
    public function actionPharmacy()
    {
        $model = new Appointment('showConsultDrug');
        
        if (isset($_GET['date_report'])) {
            $model->attributes = $_GET['date_report'];
            $date_report = $_GET['Appointment']['date_report'];
        } else {
            $date_report = date('Y-m-d');
        }
        
        $model->date_report = $date_report;
        $data['date_report'] = $date_report;
        
        //return $model->get_doctor_queue();
        $this->render('pharmacy',array(
            'model'=>$model,$data
        ));
    }
    
    public function actionPharmacyDetail($visit_id)
    {  
        $model = new Appointment;
        $data['model'] = new Appointment('showPrescription');
        $data['visit_id'] = $visit_id;
        $rst = VAppointmentState::model()->find("visit_id=:visit_id",array(':visit_id'=>$visit_id));
        $data['patient_name'] = $rst->patient_name;
        $this->render('PharmacyDetail',$data);
    }
    
    /*public function actionCompleteSale($visit_id)
    {
        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) 
        {

        }else{
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }*/

    public function actionAddPayment($visit_id)
    {
        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) 
        {
            $payment = new Payment;
            $model = new Appointment('showBillDetail');
            $data['model'] = $model;
            $data['payment'] =$payment;
            $data['count_item'] = $model->countBill($visit_id);
            $data['amount'] = $model->sumBill($visit_id);  
            $data['actual_amount'] = $model->get_actual_amount($visit_id);
            $rst = VAppointmentState::model()->find("visit_id=:visit_id",array(':visit_id'=>$visit_id));
            $data['patient_name'] = $rst->patient_name;
            $data['visit_id'] = $visit_id;
            Yii::app()->treatmentCart->addPayment($visit_id,$data['actual_amount']);
            $data['payments'] = Yii::app()->treatmentCart->getPayments();
                
            $count_payment=0;
            if(!empty($data['payments'])){$count_payment=1;}
        
            if($data['count_item']>0)
            { 
                //$data['count_payment'] = Payment::model()->addPayment($visit_id);
                //----***set Payment into session from request***----//
                
                $data['count_payment'] = $count_payment;

                $cs = Yii::app()->clientScript;
                $cs->scriptMap = array(
                    'jquery.js' => false,
                    'bootstrap.js' => false,
                    'jquery.min.js' => false,
                    'bootstrap.min.js' => false,
                    'bootstrap.notify.js' => false,
                    'bootstrap.bootbox.min.js' => false,
                );

                Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false; 
                Yii::app()->clientScript->scriptMap['box.css'] = false; 

                $this->renderPartial('prescriptionDetail',$data,false, true);
            }
        }else{
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }
    
    public function actionDeletePayment($visit_id)
    {
        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) 
        {
            $payment = new Payment;
            $model = new Appointment('showBillDetail');
            $data['model'] = $model;
            $data['payment'] =$payment;
            $data['count_item'] = $model->countBill($visit_id);
            $data['amount'] = $model->sumBill($visit_id); 
            $data['actual_amount'] = $model->get_actual_amount($visit_id); 
            $data['visit_id'] = $visit_id;
            $rst = VAppointmentState::model()->find("visit_id=:visit_id",array(':visit_id'=>$visit_id));
            $data['patient_name'] = $rst->patient_name;
            $count_payment=0;
            if(!empty($data['payments'])){$count_payment=1;}
                
            if($data['count_item']>0)
            { 
                Yii::app()->treatmentCart->deletePayment($visit_id);
                $data['payments'] =Yii::app()->treatmentCart->getPayments();
                
                $data['count_payment'] = $count_payment;

                $cs = Yii::app()->clientScript;
                $cs->scriptMap = array(
                    'jquery.js' => false,
                    'bootstrap.js' => false,
                    'jquery.min.js' => false,
                    'bootstrap.min.js' => false,
                    'bootstrap.notify.js' => false,
                    'bootstrap.bootbox.min.js' => false,
                );

                Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false; 
                Yii::app()->clientScript->scriptMap['box.css'] = false; 

                $this->renderPartial('prescriptionDetail',$data,false, true);
            }    
        }
    }
    
    public function actionCompleteSale($visit_id)
    {
        
        $this->layout = '//layouts/column_receipt';
        
        $sale_id = Payment::model()->CompleteSale($visit_id);

        $clinic_info = Clinic::model()->find();
        $employee_id = RbacUser::model()->findByPk(Yii::app()->user->getId());
        $employee = Employee::model()->get_doctorName($employee_id->employee_id);

        $cust_info=Appointment::model()->generateInvoice($visit_id); 
        $patient_id = Appointment::model()->find("visit_id=:visit_id",array(':visit_id'=>$visit_id));
        $rs = VSearchPatient::model()->find("patient_id=:patient_id",array(':patient_id'=>$patient_id->patient_id));
        
        //$data['pres_detail'] = VPrescriptionDetail::model()->find("visit_id=:visit_id",array(':visit_id'=>$visit_id));
        //$pres_detail = PrescriptionDetail::model()->find("prescription_id=:prescription_id",array(':prescription_id'=>$prescription_id));

        $data['cust_fullname'] =  $rs->fullname;
        //$data['cust_fullname'] =  'Hello';
        $data['employee'] = $employee->doctor_name;
        $data['cust_info'] = $cust_info;
        $data['sale_id'] = $sale_id;
        $data['discount'] = 0;
        
        $data['clinic_name']=$clinic_info->clinic_name;
        $data['clinic_address']= $clinic_info->clinic_address;
        $data['clinic_mobile'] = $clinic_info->mobile;
        
        $data['colspan'] = Yii::app()->settings->get('sale','discount')=='hidden' ? '2' : '3';
        $subtotal = 0;
        foreach ($cust_info as $id => $item) 
        {
            $subtotal+=round($item['price'] * $item['quantity'] - $item['price'] * $item['quantity'] * $item['discount'] / 100, 2, PHP_ROUND_HALF_DOWN);
        }
        $data['sub_total'] = $subtotal;
        $data['total_discount'] = 0;
        $data['discount_amount']=0;
        $total=0;
        foreach ($cust_info as $id => $item) 
        {
            $total+=round($item['price'] * $item['quantity'] - $item['price'] * $item['quantity'] * $item['discount'] / 100, 2, PHP_ROUND_HALF_DOWN);
        }
        $data['total']=$total - $total*$data['discount_amount']/100;
        $data['actual_amount'] = Appointment::model()->get_actual_amount($visit_id);
        //$data['total_khr_round']=($total - $total*$data['discount_amount']/100)*4000;
        $data['amount_change']=0;
        $data['amount_change_khr_round']=0;
        
        Yii::app()->treatmentCart->clearAll();
        $this->render('_receipt', $data);
    }
    
    public function actionActualAmount($visit_id,$patient_id,$doctor_id)
    {
        $data['count_item']=1;
        $data['visit_id']=$visit_id;
        $data['count_amount'] = 0;
        $data['model'] = new Payment;
        $data['patient_id'] = $patient_id;
        $data['doctor_id'] = $doctor_id;
        
        if(isset($_POST['Payment']))
        {       
            //print_r($_POST);
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            echo CJSON::encode(array(
               'status'=>'success',
               'div'=>"<div class=alert alert-info fade in>Successfully added ! </div>",
               ));
            Yii::app()->end();
        }
        
        if(Yii::app()->request->isAjaxRequest)
        {
            $cs=Yii::app()->clientScript;
            $cs->scriptMap=array(
                'jquery.js'=>false,
                'bootstrap.js'=>false,
                'jquery.min.js'=>false,
                'bootstrap.notify.js'=>false,
                'bootstrap.bootbox.min.js'=>false,
            );
            echo CJSON::encode(array(
                        'status' => 'render',
                        'div' => $this->renderPartial('_add_payment', $data, true, true),
                    ));

            Yii::app()->end();
        }
    }
    
    public function actionEmptytreatment()
    {
        Yii::app()->treatmentCart->clearAll();
    }
    
    public function actionEmptypayment()
    {
        Yii::app()->treatmentCart->emptyPayment();
    }
}