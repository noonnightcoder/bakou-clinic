<?php

class ReceivingItemController extends Controller
{
    //public $layout='//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('RemoveSupplier','SetComment', 'DeleteItem', 'Add', 'EditItem', 'EditItemPrice', 'Index', 'IndexPara', 'AddPayment', 'CancelRecv', 'CompleteRecv', 'Complete', 'SuspendSale', 'DeletePayment', 'SelectSupplier', 'AddSupplier', 'Receipt', 'SetRecvMode', 'EditReceiving'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionIndex($trans_mode = 'receive') 
    {  
        Yii::app()->receivingCart->setMode($trans_mode);
        
        /* To check on performance issue here */
        if ( Yii::app()->user->checkAccess('transaction.receive') && Yii::app()->receivingCart->getMode()=='receive' )  {
            $this->reload(); 
        } else if (Yii::app()->user->checkAccess('transaction.return') && Yii::app()->receivingCart->getMode()=='return') {
            $this->reload(); 
        } elseif (Yii::app()->user->checkAccess('transaction.adjustin') && Yii::app()->receivingCart->getMode()=='adjustment_in') {
            $this->reload(); 
        } elseif (Yii::app()->user->checkAccess('transaction.adjustout') && Yii::app()->receivingCart->getMode()=='adjustment_out') {
            $this->reload();    
        } elseif (Yii::app()->user->checkAccess('transaction.count') && Yii::app()->receivingCart->getMode()=='physical_count') {
            $this->reload(); 
        }  else {
            throw new CHttpException(403, 'You are not authorized to perform this action');
        }
    }

    public function actionAdd()
    {   
        //$data=array();
        $item_id = $_POST['ReceivingItem']['item_id'];
        if (Yii::app()->user->checkAccess('transaction.receive') && Yii::app()->receivingCart->getMode()=='receive') {    
            $data['warning']=$this->addItemtoCart($item_id);
        } else if (Yii::app()->user->checkAccess('transaction.return') && Yii::app()->receivingCart->getMode()=='return') {
           $data['warning']=$this->addItemtoCart($item_id);
        } else if (Yii::app()->user->checkAccess('transaction.adjustin') && Yii::app()->receivingCart->getMode()=='adjustment_in') {
           $data['warning']=$this->addItemtoCart($item_id);  
        } else if (Yii::app()->user->checkAccess('transaction.adjustout') && Yii::app()->receivingCart->getMode()=='adjustment_out') {
           $data['warning']=$this->addItemtoCart($item_id);   
        } else if (Yii::app()->user->checkAccess('transaction.count') && Yii::app()->receivingCart->getMode()=='physical_count') {
            $data['warning']=$this->addItemtoCart($item_id);     
        } else {
            throw new CHttpException(403, 'You are not authorized to perform this action');
        }
         
        $this->reload($data);
    }
    
    protected function addItemtoCart($item_id)
    {
        $msg=null;
        if (!Yii::app()->receivingCart->addItem($item_id)) {
            $msg = 'Unable to add item to receiving';
        } 
        return $msg;
    }

    public function actionIndexPara($item_id)
    {
        if (Yii::app()->user->checkAccess('transaction.receive') && Yii::app()->receivingCart->getMode()=='receive') {
            //$recv_mode = Yii::app()->receivingCart->getMode();
            //$quantity = $recv_mode=="receive" ? 1:1; // Change as immongo we will place minus or plus when saving to database
            Yii::app()->receivingCart->addItem($item_id);
            $this->reload($item_id);
        } else if (Yii::app()->user->checkAccess('transaction.return') && Yii::app()->receivingCart->getMode()=='return') {
            Yii::app()->receivingCart->addItem($item_id);
            $this->reload($item_id);
        } else if (Yii::app()->user->checkAccess('transaction.adjustin') && Yii::app()->receivingCart->getMode()=='adjustment_in') {
            Yii::app()->receivingCart->addItem($item_id);
            $this->reload($item_id);
        } else if (Yii::app()->user->checkAccess('transaction.adjustout') && Yii::app()->receivingCart->getMode()=='adjustment_out') {
            Yii::app()->receivingCart->addItem($item_id);
            $this->reload($item_id);  
        } else if (Yii::app()->user->checkAccess('transaction.count') && Yii::app()->receivingCart->getMode()=='physical_count') { 
            Yii::app()->receivingCart->addItem($item_id);
            $this->reload($item_id);
        } else {
            throw new CHttpException(403, 'You are not authorized to perform this action');
        }    
    }

    public function actionDeleteItem($item_id)
    {
        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
            Yii::app()->receivingCart->deleteItem($item_id);
            $this->reload();
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        } 
    }

    public function actionEditItem($item_id)
    {
        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {

            $data= array();
            $model = new ReceivingItem;
            
            $quantity = isset($_POST['ReceivingItem']['quantity']) ? $_POST['ReceivingItem']['quantity'] : null;
            $unit_price =isset($_POST['ReceivingItem']['unit_price']) ? $_POST['ReceivingItem']['unit_price'] : null;
            $cost_price =isset($_POST['ReceivingItem']['cost_price']) ? $_POST['ReceivingItem']['cost_price'] : null;
            $discount =isset($_POST['ReceivingItem']['discount']) ? $_POST['ReceivingItem']['discount'] : null;
            $expire_date =isset($_POST['ReceivingItem']['expire_date']) ? $_POST['ReceivingItem']['expire_date'] : null;
            $description = 'test';
            
            $model->quantity = $quantity;
            $model->unit_price = $unit_price;
            $model->cost_price = $cost_price;
            $model->discount = $discount;
            $model->expire_date = $expire_date;
            
            if ($model->validate()) {
                Yii::app()->receivingCart->editItem($item_id, $quantity, $discount, $cost_price, $unit_price, $description, $expire_date);
            } else {
                $error=CActiveForm::validate($model);
                $errors = explode(":", $error);
                $data['warning']=  str_replace("}","",$errors[1]);
                $data['warning'] = Yii::t('app','Input data type is invalid');
            }     
            $this->reload($data);
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionAddPayment()
    {
        if (Yii::app()->request->isPostRequest) {
            if (Yii::app()->request->isAjaxRequest) {
                $payment_id = $_POST['payment_id'];
                $payment_amount = $_POST['payment_amount'];
                //$this->addPaymentToCart($payment_id, $payment_amount);
                Yii::app()->receivingCart->addPayment($payment_id, $payment_amount);
                $this->reload();
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }    
    }

    public function actionDeletePayment($payment_id)
    {
        if (Yii::app()->request->isPostRequest) {
            Yii::app()->receivingCart->deletePayment($payment_id);
            $this->reload();
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionSelectSupplier()
    {        
         if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
            $supplier_id = $_POST['ReceivingItem']['supplier_id'];
            Yii::app()->receivingCart->setSupplier($supplier_id);
            $this->reload();
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionRemoveSupplier()
    {
        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
            Yii::app()->receivingCart->removeSupplier();
            $this->reload();
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionSetComment()
    {
        Yii::app()->receivingCart->setComment($_POST['comment']);
        echo CJSON::encode(array(
            'status' => 'success',
            'div' => "<div class=alert alert-info fade in>Successfully saved ! </div>",
        ));
    }

    public function actionSetRecvMode()
    {
        Yii::app()->receivingCart->setMode($_POST['recv_mode']);
        echo CJSON::encode(array(
            'status' => 'success',
            'div' => "<div class=alert alert-info fade in>Successfully saved ! </div>",
        ));
    }

    private function reload($data=array())
    {
        $this->layout = '//layouts/column_sale';
        
        $model = new ReceivingItem;
        $data['model'] = $model;
       
        $data=$this->sessionInfo($data);
        
        //echo $data['trans_header']; die();
        
        //$data['n_item_expire']=ItemExpir::model()->count('item_id=:item_id and quantity>0',array('item_id'=>(int)$item_id));
        
        $model->comment = $data['comment'];
        
        if ($data['supplier_id'] != null) {
            $supplier = Supplier::model()->findbyPk($data['supplier_id']);
            $data['supplier'] = $supplier;
            //$data['company_name'] = $supplier->company_name;
            //$data['full_name'] = $supplier->first_name . ' ' . $supplier->last_name;
            //$data['mobile_no'] = $supplier->mobile_no;
        }
           
        if (Yii::app()->request->isAjaxRequest) {
            $cs = Yii::app()->clientScript;
            $cs->scriptMap = array(
                'jquery.js' => false,
                'bootstrap.js' => false,
                'jquery.min.js' => false,
                'bootstrap.notify.js' => false,
                'bootstrap.bootbox.min.js' => false,
                'bootstrap.min.js' => false,
                'jquery-ui.min.js' => false,
                //'jquery.mask.js' => false,
                'EModalDlg.js'=>false,
            );

            Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false; 
            Yii::app()->clientScript->scriptMap['box.css'] = false; 
            $this->renderPartial('admin', $data, false, true);
        } else {
            $this->render('admin', $data);
        }
    }

    public function actionCancelRecv()
    {
        if (Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest) {
            Yii::app()->receivingCart->clearAll();
            $this->reload();
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionCompleteRecv()
    {
        $data=$this->sessionInfo();

        //Save transaction to db
        $data['receiving_id'] = Receiving::model()->saveRevc($data['items'], $data['payments'], $data['supplier_id'], $data['employee_id'], $data['sub_total'], $data['comment'],$data['trans_mode']);
      
        if (empty($data['items'])) {
            $this->redirect(array('receivingItem/index'));
        }
        
        if (substr($data['receiving_id'],0,2) == '-1') {
            $data['error_message'] = $data['sale_id'];
        } else {
            $trans_mode = Yii::app()->receivingCart->getMode();
            Yii::app()->receivingCart->clearAll();
            $this->redirect(array('receivingItem/index','trans_mode'=>$data['trans_mode']));
        }
    }

    public function actionSuspendRecv()
    {
        $data['items'] = Yii::app()->receivingCart->getCart();
        $data['payments'] = Yii::app()->receivingCart->getPayments();
        $data['sub_total'] = Yii::app()->receivingCart->getSubTotal();
        $data['total'] = Yii::app()->receivingCart->getTotal();
        $data['supplier_id'] = Yii::app()->receivingCart->getSupplier();
        $data['comment'] = Yii::app()->receivingCart->getComment();
        $data['employee_id'] = Yii::app()->session['employeeid'];
        $data['transaction_time'] = date('m/d/Y h:i:s a');
        $data['employee'] = ucwords(Yii::app()->session['emp_fullname']);

        //Save transaction to db
        $data['sale_id'] = 'POS ' . SaleSuspended::model()->saveSale($data['items'], $data['payments'], $data['supplier_id'], $data['employee_id'], $data['sub_total'], $data['comment']);

        if ($data['sale_id'] == 'POS -1') {
            echo CJSON::encode(array(
                'status' => 'failed',
                'message' => '<div class="alert in alert-block fade alert-error">Transaction Failed.. !<a class="close" data-dismiss="alert" href="#">&times;</a></div>',
            ));
        } else {
            Yii::app()->receivingCart->clearAll();
            $this->reload();
        }
    }

    public function actionUnsuspendRecv($sale_id)
    {
        Yii::app()->receivingCart->clearAll();
        Yii::app()->receivingCart->copyEntireSuspendSale($sale_id);
        SaleSuspended::model()->deleteSale($sale_id);
        //$this->reload();
        $this->redirect('index');

    }

    public function actionEditReceiving($receiving_id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            Yii::app()->receivingCart->clearAll();
            Yii::app()->receivingCart->copyEntireReceiving($receiving_id);
            Receiving::model()->deleteReceiving($receiving_id);
            //$this->reload();
            $this->redirect('index');
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
        
    }
    
    protected function sessionInfo($data=array()) 
    {
        $data['trans_mode'] = Yii::app()->receivingCart->getMode();
        $data['trans_header'] = Receiving::model()->transactionHeader();
        $data['status'] = 'success';
        $data['items'] = Yii::app()->receivingCart->getCart();
        $data['payments'] = Yii::app()->receivingCart->getPayments();
        $data['payment_total'] = Yii::app()->receivingCart->getPaymentsTotal();
        $data['count_item'] = Yii::app()->receivingCart->getQuantityTotal();
        $data['count_payment'] = count(Yii::app()->receivingCart->getPayments());
        $data['sub_total']=Yii::app()->receivingCart->getSubTotal();
        $data['total'] = Yii::app()->receivingCart->getTotal();
        $data['amount_due'] = Yii::app()->receivingCart->getAmountDue();
        $data['comment'] = Yii::app()->receivingCart->getComment();
        $data['supplier_id'] = Yii::app()->receivingCart->getSupplier();
        $data['employee_id'] = Yii::app()->session['employeeid'];
        
        if (Yii::app()->settings->get('item', 'itemExpireDate') == '1') {
            $data['expiredate_class']='';
        } else {
            $data['expiredate_class']='hidden';
        } 
        
      
        return $data;
    }

}
