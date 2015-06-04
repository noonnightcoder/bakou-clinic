<?php

/**
 * This is the model class for table "appointment".
 *
 * The followings are the available columns in table 'appointment':
 * @property integer $id
 * @property string $appointment_date
 * @property string $end_date
 * @property string $start_time
 * @property string $end_time
 * @property string $title
 * @property integer $patient_id
 * @property integer $user_id
 * @property string $status
 * @property integer $visit_id
 *
 * The followings are the available model relations:
 * @property AppointmentLog[] $appointmentLogs
 */
class Appointment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    
        public $patient_name;
        public $date_report;
        public $total_amount;
        public $actual_amount;


        public function tableName()
	{
		return 'appointment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(                        
			array('appointment_date,title, user_id, status', 'required'),      
                        array('actual_amount','amount_validate'),
			array('patient_id, user_id, visit_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>150),
			array('status', 'length', 'max'=>255),
                        array('patient_id','patient_validate','required'),                        
			array('end_date, start_time, end_time,date_report,actual_amount', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, appointment_date, end_date, start_time, end_time, title, patient_id, user_id, status, visit_id,date_report', 'safe', 'on'=>'search'),
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
			'appointmentLogs' => array(self::HAS_MANY, 'AppointmentLog', 'appointment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'appointment_date' => 'Appointment Date',
			'end_date' => 'End Date',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'title' => 'Title',
			'patient_id' => 'Patient',
            'patient_name' => 'Patient Name'
			//'user_id' => 'User',
			//'status' => 'Status',
			//'visit_id' => 'Visit',
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
		$criteria->compare('appointment_date',$this->appointment_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('visit_id',$this->visit_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Appointment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function m_get_patient($name = '')
    {
        $sql = "SELECT patient_id id,fullname,display_id,phone_number,display_name
                FROM v_search_patient
                WHERE fullname LIKE :patient_name
                    or display_id LIKE :patient_name";

        $patient_name = '%' . $name . '%';

        return Yii::app()->db->createCommand($sql)->queryAll(true, array(':patient_name' => $patient_name,));
    }
        
        public function RetreivePatient($patient_id)
        {
            $sql="SELECT phone_number,display_name 
                    FROM v_search_patient
                    where patient_id=:patient_id";
            
            $cmd=Yii::app()->db->createCommand($sql);
            $cmd->bindParam(':patient_id', $patient_id, PDO::PARAM_INT);
            return $cmd->queryRow();
            
            //return Yii::app()->db->createCommand($sql)->queryAll(true, array(':patient_id' => $patient_id,));
        }
        
        public function get_combo_doctor($id = null)
        {
            if($id==null){$cond='';}else{ $cond='and t1.id='.$id;}
            $doctor = array();
            $sql="SELECT t1.id,CONCAT(t2.last_name,' ',t2.first_name) fullname 
                FROM rbac_user t1
                INNER JOIN employee t2 ON t1.employee_id=t2.id
                WHERE t1.group_id in (2,1)
                $cond";
            
            $command=Yii::app()->db->createCommand($sql);
            foreach($command->queryAll() as $row)
            {
                $doctor+=array($row['id']=>$row['fullname']);
            }
            
            $rst=array();
            
            $rst+=$doctor;
            return $rst;
        }
        
        public function get_doctor_queue()
        {
            if(isset($_GET['Appointment']))
            {
                //-----***Check condition of query***----//
                $search = $_GET['Appointment']['patient_name'];
                $cond=" and (lower(patient_name) like '%".  $search ."%' or lower(display_id) like  '%".  $search ."%')";
            }else{
                $cond="";
                
            }
            
            $userid=Yii::app()->user->getId();
            $sql="SELECT @rownum:=@rownum+1 id,app_id,patient_id,doctor_id,patient_name,
                    display_id,appointment_date,title,status
                    from(select app_id,patient_id,user_id doctor_id,patient_name,display_id,appointment_date,title,status
                        FROM v_appointment_state 
                        WHERE appointment_date>=DATE_SUB(CURDATE(), INTERVAL 0 DAY)
                        and appointment_date<DATE_ADD(CURDATE(), INTERVAL 1 DAY)
                        and user_id=$userid
                        and status not in ('Complete','Cancel')  
                        $cond
                        ORDER BY appointment_date
                    )cl,(SELECT @rownum:=0) r";
            //echo $sql;
            //$rawData = Yii::app()->db->createCommand($sql);
            //$rawData->bindParam(':userid', $userid, PDO::PARAM_INT);
            return new CSqlDataProvider($sql,array(
                'sort' => array(
                        'attributes' => array(
                            'id','display_id','patient_name'
                        )
                    ),
            ));
        }
        
        public function appointment_consult($app_id)
        {
            Appointment::model()->updateByPk($app_id,array('status'=>'Consultation'));
            //AppointmentLog::model()->updateByPk($app_id,array('status'=>'Consultation'));
        }
        
        public function appointment_visit($app_id,$visit_id)
        {
            Appointment::model()->updateByPk($app_id,array('visit_id'=>$visit_id));   
        }

        public function get_appointment()
        {
            $sql="SELECT appointment_id,doc_id,user_id,status,fullname, 
                @row_number:=CASE WHEN @user_id=user_id THEN @row_number+1 ELSE 1 END AS id
                ,@user_id:=user_id AS user_id
                FROM (
                SELECT t1.id appointment_id,t1.user_id doc_id,t1.user_id,status,
                    case
                        when t2.last_name is not null then CONCAT(t2.last_name,' ',t2.first_name) 
                        else t2.first_name
                    end fullname
                                FROM appointment t1
                                INNER JOIN v_patient t2 ON t1.patient_id=t2.patient_id
                                WHERE appointment_date>=DATE_SUB(CURDATE(), INTERVAL 0 DAY)
                                AND appointment_date<DATE_ADD(CURDATE(), INTERVAL 1 DAY)
                                and t1.status in ('Waiting','Consultation')
                                ORDER BY t1.user_id,appointment_date
                )cr, (SELECT @row_number:=0,@user_id:='') AS t ";
            
            $command=Yii::app()->db->createCommand($sql);
            return $command->queryall();
        }
        
        public function ValidateConsult($visit_id,$patient_id,$doctor_id)
        {
            $sql = "select count(*) from visit where visit_id=:visit_id and patient_id=:patient_id and userid=:doctor_id";
            $cmd=Yii::app()->db->createCommand($sql);
            $cmd->bindParam(':visit_id', $visit_id, PDO::PARAM_INT);
            $cmd->bindParam(':patient_id', $patient_id, PDO::PARAM_INT);
            $cmd->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            
            return $cmd->queryScalar();
        }
        
        public function CheckApptStatus($appt_id,$patient_id,$doctor_id)
        {
            $sql = "select count(*) from appointment 
                    where id=:appt_id 
                    and patient_id=:patient_id 
                    and user_id=:doctor_id
                    and status<>'Completed'
                    and visit_id>0";
            
            $cmd=Yii::app()->db->createCommand($sql);
            $cmd->bindParam(':appt_id', $appt_id, PDO::PARAM_INT);
            $cmd->bindParam(':patient_id', $patient_id, PDO::PARAM_INT);
            $cmd->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
            
            return $cmd->queryScalar();
        }       
        
        public function updateCompleteAppt($visit_id,$user_id,$patient_id = 0,$actual_amount = 0)
        {
            $xchange_rate = Yii::app()->session['exchange_rate'];
            $cmd = Yii::app()->db->createCommand("CALL pro_completed_consult(:visit_id, :user_id,:patient_id,:actual_amount,:exchange_rate)");
            $cmd->bindParam(":visit_id", $visit_id);
            $cmd->bindParam(":user_id", $user_id);
            $cmd->bindParam(":patient_id", $patient_id);
            $cmd->bindParam(":actual_amount", $actual_amount);
            $cmd->bindParam(":exchange_rate", $xchange_rate);
            $cmd->execute();
            return true;
        }
        
        public function showBillDetail($visit_id)
        {
            $sql="select @rownum:=@rownum+1 id,patient_id,visit_id,fullname,
                visit_date,item,dosage,consuming_time,duration,instruction,comment,quantity,quantity*unit_price unit_price,flag info
                from(SELECT t3.patient_id,t2.visit_id,
                case
                        when last_name is not null then CONCAT(last_name,' ',first_name) 
                        else first_name
                end fullname,t2.visit_date,t1.item,
                dosage,consuming_time,duration,instruction,t1.quantity,t1.comment,t1.unit_price,t1.flag
                FROM (
                        SELECT medicine_id id,medicine_name item,
                        dosage,consuming_time,duration,instruction,visit_id,quantity,unit_price,remarks comment,'medicine' flag 
                        FROM v_medicine_payment where visit_id=$visit_id
                        /*UNION ALL
                        SELECT id,treatment,null dosage,null consuming_time,null duration,
                        null instruction,visit_id,1 quantity,amount,null comment,'treatment' flag
                        FROM v_bill_payment where visit_id=$visit_id*/
                )t1 INNER JOIN visit t2
                ON t1.visit_id=t2.visit_id
                INNER JOIN patient t3 ON t2.patient_id=t3.patient_id
                INNER JOIN contact t4 ON t3.contact_id=t4.id                
                ORDER BY visit_id,flag
                )lv,(SELECT @rownum:=0) r";
            
            //$cmd = Yii::app()->db->createCommand($sql);
            //$cmd->bindParam(":visit_id", $visit_id);
            return new CSqlDataProvider($sql,array(
                'sort' => array(
                        'attributes' => array(
                            'patient_id','visit_id','fullname'
                        )
                    ),
            ));
        }
        
        public function showPrescriptionDetail($visit_id)
        {
            $sql="select @rownum:=@rownum+1 id,patient_id,visit_id,fullname,
                visit_date,item,dosage,consuming_time,duration,instruction,quantity,quantity*unit_price unit_price,flag info
                from(SELECT t3.patient_id,t2.visit_id,
                case
                        when last_name is not null then CONCAT(last_name,' ',first_name) 
                        else first_name
                end fullname,t2.visit_date,t1.item,
                dosage,consuming_time,duration,instruction,t1.quantity,t1.unit_price,t1.flag
                FROM (
                        SELECT medicine_id id,medicine_name item,
                        dosage,consuming_time,duration,instruction,visit_id,quantity,unit_price*exchange_rate unit_price,'medicine' flag 
                        FROM v_medicine_payment where visit_id=$visit_id
                        UNION ALL
                        SELECT id,treatment,null dosage,null consuming_time,null duration,
                        null instruction,visit_id,1 quantity,amount*exchange_rate amount,'treatment' flag
                        FROM v_bill_payment where visit_id=$visit_id
                        UNION ALL
                        SELECT id,lab_item_name,null dosage,null consuming_time,null duration,
                        null instruction,visit_id,1 quantity,unit_price*exchange_rate unit_price,'bloodtest' flag
                        FROM v_bloodtest_payment where visit_id=$visit_id
                )t1 INNER JOIN visit t2
                ON t1.visit_id=t2.visit_id
                INNER JOIN patient t3 ON t2.patient_id=t3.patient_id
                INNER JOIN contact t4 ON t3.contact_id=t4.id
                ORDER BY visit_id,flag
                )lv,(SELECT @rownum:=0) r";
            
            //$cmd = Yii::app()->db->createCommand($sql);
            //$cmd->bindParam(":visit_id", $visit_id);
            return new CSqlDataProvider($sql,array(
                'sort' => array(
                        'attributes' => array(
                            'patient_id','visit_id','fullname'
                        )
                    ),
            ));
        }
        
        public function chk_completed_bill()
        {
            
        }

        public function showBill()
        {
            if(isset($_GET['Appointment']))
            {
                //-----***Check condition of query***----//
                $search = $_GET['Appointment']['patient_name'];
                $cond=" and (lower(patient_name) like '%".  $search ."%' or lower(display_id) like  '%".  $search ."%')";
            
                if (isset($_GET['Appointment']['date_report'])) {
                    $date_report = $_GET['Appointment']['date_report'];
                    $cond1 =" and appointment_date>=DATE_SUB('$date_report', INTERVAL 0 DAY)
                              and appointment_date<DATE_ADD('$date_report', INTERVAL 1 DAY)";
                } else {
                    $cond1 =" and appointment_date>=DATE_SUB(CURDATE(), INTERVAL 0 DAY)
                              and appointment_date<DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
                }
        
            }else{
                $cond="";                
                $cond1 =" and appointment_date>=DATE_SUB(CURDATE(), INTERVAL 0 DAY)
                              and appointment_date<DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
            }
            
            $sql="select @rownum:=@rownum+1 id,appointment_id,patient_id,doctor_id,visit_id,
                patient_name,display_id,appointment_date,title,status
                from(
                SELECT app_id appointment_id,patient_id,user_id doctor_id,visit_id,
                patient_name,display_id,appointment_date,title,status
                FROM v_appointment_state
                WHERE visit_id IN (SELECT visit_id FROM bill WHERE STATUS in (0,1))
                and STATUS='Complete'
                $cond1 $cond
            )lv,(SELECT @rownum:=0) r";
            
            return new CSqlDataProvider($sql,array(
                'sort' => array(
                        'attributes' => array(
                            'appointment_id','patient_id','visit_id'
                        )
                    ),
            ));
        }
        
        public function countBill($visit_id)
        {
            $sql="select count(*) 
                from (
                    SELECT medicine_id id,medicine_name item,visit_id,quantity,unit_price,'medicine' flag 
                    FROM v_medicine_payment where visit_id= $visit_id
                    UNION ALL
                    SELECT id,treatment,visit_id,1 quantity,amount,'treatment' flag
                    FROM v_bill_payment where visit_id=$visit_id
                )bl";
            
            $cmd=Yii::app()->db->createCommand($sql);
            
            return $cmd->queryScalar();
        }
        
        public function sumBill($visit_id)
        {
            //$xchange_rate = Yii::app()->session['exchange_rate'];
            $sql="select sum(amount)
                from (
                    SELECT medicine_id id,medicine_name item,visit_id,quantity,quantity*unit_price*exchange_rate amount,'medicine' flag 
                    FROM v_medicine_payment where visit_id= $visit_id
                    UNION ALL
                    SELECT id,treatment,visit_id,1 quantity,amount*exchange_rate,'treatment' flag
                    FROM v_bill_payment where visit_id=$visit_id
                    UNION ALL
                    SELECT id,lab_item_name,visit_id,1 quantity,IFNULL(unit_price,0)*exchange_rate unit_price,'bloodtest' flag
                    FROM v_bloodtest_payment where visit_id=$visit_id
                )bl";
            
            $cmd=Yii::app()->db->createCommand($sql);
            
            return $cmd->queryScalar();
        }
        
        public function generateInvoice($visit_id)
        {
            $sql="select fullname,visit_date,item name,quantity,unit_price price,exchange_rate,0 discount,dosage,duration,consuming_time,instruction,remarks comment
                from(SELECT t3.patient_id,t2.visit_id,
                case
                        when last_name is not null then CONCAT(last_name,' ',first_name) 
                        else first_name
                end fullname,t2.visit_date,t1.item,t1.quantity,t1.unit_price,t1.exchange_rate,
                t1.dosage,t1.duration,t1.consuming_time,t1.instruction,t1.remarks,t1.flag
                FROM (
                        SELECT medicine_id id,medicine_name item,visit_id,quantity,unit_price,exchange_rate,
                        dosage,duration,consuming_time,instruction,remarks,'medicine' flag 
                        FROM v_medicine_payment where visit_id=$visit_id
                        UNION ALL
                        SELECT id,treatment,visit_id,1 quantity,amount,exchange_rate,
                        null dosage,null duration,null frequency,null instruction,null remarks,'treatment' flag
                        FROM v_bill_payment where visit_id=$visit_id
                        UNION ALL
                        SELECT id,lab_item_name,visit_id,1 quantity,unit_price,exchange_rate,
                        null dosage,null doration,null frequency,null instruction,null remarks,'bloodtest' flag
                        from v_bloodtest_payment where visit_id=$visit_id
                )t1 INNER JOIN visit t2
                ON t1.visit_id=t2.visit_id
                INNER JOIN patient t3 ON t2.patient_id=t3.patient_id
                INNER JOIN contact t4 ON t3.contact_id=t4.id
                )dl";
            
            $command=Yii::app()->db->createCommand($sql);
            return $command->queryAll();
        }
        
        public function chk_user_inqueue($patient_id)
        {
            $sql="SELECT COUNT(*) FROM appointment  
            WHERE appointment_date>=DATE_SUB(CURDATE(), INTERVAL 0 DAY)
            and appointment_date<DATE_ADD(CURDATE(), INTERVAL 1 DAY)    
            AND patient_id=:patient_id 
            AND STATUS NOT IN ('Complete','Cancel')";  
            
            $cmd=Yii::app()->db->createCommand($sql);
            $cmd->bindParam(':patient_id', $patient_id, PDO::PARAM_INT);
            
            return $cmd->queryScalar();
        }
        
        public function showConsultDrug()
        {
            if(isset($_GET['Appointment']))
            {
                //-----***Check condition of query***----//
                $search = $_GET['Appointment']['patient_name'];
                $cond=" and (lower(patient_name) like '%".  $search ."%' or lower(display_id) like  '%".  $search ."%')";
            
                if (isset($_GET['Appointment']['date_report'])) {
                    $date_report = $_GET['Appointment']['date_report'];
                    $cond1 =" appointment_date>=DATE_SUB('$date_report', INTERVAL 0 DAY)
                              and appointment_date<DATE_ADD('$date_report', INTERVAL 1 DAY)";
                } else {
                    $cond1 =" and appointment_date>=DATE_SUB(CURDATE(), INTERVAL 0 DAY)
                              and appointment_date<DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
                }
        
            }else{
                //$cond="";
                $cond=" and visit_id not in (select visit_id from transaction_log where transaction_name='Pharmacy')";
                $cond1 =" appointment_date>=DATE_SUB(CURDATE(), INTERVAL 0 DAY)
                              and appointment_date<DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
            }
            
            $sql="select @rownum:=@rownum+1 id,appointment_id,patient_id,doctor_id,visit_id,
                patient_name,display_id,appointment_date,title,status
                from(
                SELECT app_id appointment_id,patient_id,user_id doctor_id,visit_id,
                patient_name,display_id,appointment_date,title,status
                FROM v_appointment_state
                WHERE $cond1 $cond  
                and visit_id IN (SELECT visit_id FROM bill WHERE STATUS ='2')    
                and status='Complete'    
            )lv,(SELECT @rownum:=0) r   
            order by visit_id desc";
            
            return new CSqlDataProvider($sql,array(
                'sort' => array(
                        'attributes' => array(
                            'appointment_id','patient_id','visit_id'
                        )
                    ),
            ));
        }
        
        public function get_patient_queue()
        {
            if(isset($_GET['Appointment']))
            {
                //-----***Check condition of query***----//
                $search = $_GET['Appointment']['patient_name'];
                $cond=" and (lower(patient_name) like '%".  $search ."%' or lower(display_id) like  '%".  $search ."%')";
            }else{
                $cond=" and visit_id not in (select visit_id from transaction_log)";
                //$cond="";
                
            }
            
            $userid=Yii::app()->user->getId();
            $sql="SELECT @rownum:=@rownum+1 id,app_id,patient_id,doctor_id,patient_name,
                    display_id,appointment_date,title,status
                    from(select app_id,patient_id,user_id doctor_id,patient_name,display_id,appointment_date,title,status
                        FROM v_appointment_state 
                        WHERE appointment_date>=DATE_SUB(CURDATE(), INTERVAL 0 DAY)
                        and appointment_date<DATE_ADD(CURDATE(), INTERVAL 1 DAY)
                        and user_id=$userid  
                        and status in ('Waiting','Consultation','Complete')
                        $cond
                        ORDER BY appointment_date
                    )cl,(SELECT @rownum:=0) r";
            //echo $sql;
            //$rawData = Yii::app()->db->createCommand($sql);
            //$rawData->bindParam(':userid', $userid, PDO::PARAM_INT);
            return new CSqlDataProvider($sql,array(
                'sort' => array(
                        'attributes' => array(
                            'id','display_id','patient_name'
                        )
                    ),
            ));
        }
        
        public function patient_validate($attribute,$params)
        {
            //echo $this->patient_id;
            if($this->patient_id=='')
            {
                $this->addError('patient_id','Please select the patient');
            }
        }
        
        public function amount_validate($attribute,$params)
        {
            if(isset($_POST['Completed_consult']))
            {
                if($this->actual_amount=='')
                {
                    $this->addError('actual_amount','Actual Amount cannot be blank');
                    //Yii::app()->end();
                }elseif (!is_numeric((float)$this->actual_amount)) 
                {
                    $this->addError('actual_amount','Actual Amount Only Numeric');
                }/*elseif($this->actual_amount > $_POST['Appointment']['total_amount'])
                {
                    $this->addError('actual_amount','Actual Amount cannot bigger than Total amount');
                }*/
            }
        }
        
        public function get_actual_amount($visit_id)
        {
            $sql="select actual_amount from bill_tmp where visit_id= :visit_id and status=0";
            
            $cmd=Yii::app()->db->createCommand($sql);
            $cmd->bindParam(":visit_id", $visit_id);            
            return $cmd->queryScalar();
        }
}
