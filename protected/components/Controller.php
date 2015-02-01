<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
        public $logMessage = NULL;
        
        public $writeLog = true;
        
        function init()
        {
            parent::init();
            if (Yii::app()->settings->get('system', 'language')) {
                Yii::app()->language = Yii::app()->settings->get('system', 'language'); //or some more code;
            } else {
                Yii::app()->language='en';
            }    
        }
       
        protected function afterAction($action)
        {   
            if($this->writeLog)
            {
                $sql1 = 'INSERT INTO tbl_audit_logs(unique_id,employee_id,username,ipaddress,logtime,controller,action,details) 
                         VALUES (\''.Yii::app()->session['unique_id'].'\',\''.Yii::app()->session['employeeid'].'\',\''.Yii::app()->user->name.'\',\''.$_SERVER['REMOTE_ADDR'].'\',\''.date("Y-m-d H:i:s").'\',\''.$this->getId().'\',\''.$this->getAction()->getId().'\',\''.$this->logMessage.'\')';
                $command1 = Yii::app()->db->createCommand($sql1);
                $command1->execute();
                
                $trans_date=date('Y-m-d H:i:s');
                $unique_id=Yii::app()->session['unique_id'];
                
                $sql = "UPDATE user_log
                        SET last_action=:cur_datetime
                        WHERE unique_id=:unique_id";
                
                $command = Yii::app()->db->createCommand($sql);
                $command->bindParam(":cur_datetime",$trans_date);
                $command->bindParam(":unique_id",$unique_id);
                $command->execute();
            }
        }
}