<?php

class SaleItemController extends Controller
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
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('Add','RemoveCustomer', 'SetComment', 'DeleteItem', 'AddItem', 'EditItem', 'EditItemPrice', 'Index', 'IndexPara', 'AddPayment', 'CancelSale', 'CompleteSale', 'Complete', 'SuspendSale', 'DeletePayment', 'SelectCustomer', 'AddCustomer', 'Receipt', 'UnsuspendSale', 'EditSale', 'Receipt', 'Suspend', 'ListSuspendedSale', 'SetPriceTier','SetTotalDiscount','DeleteSale'),
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
    
    public function actionIndex() 
    {
        if (Yii::app()->user->checkAccess('sale.edit') || Yii::app()->user->checkAccess('sale.discount') || Yii::app()->user->checkAccess('sale.editprice')) {
            $this->reload();
        } else {
            throw new CHttpException(403, 'You are not authorized to perform this action');
        }
    }

    public function actionAdd()
    {
       
        $data=array();
        $item_id = $_POST['SaleItem']['item_id'];

        if (!Yii::app()->shoppingCart->addItem($item_id)) {
            $data['warning'] = 'Unable to add item to sale';
        }

        if (Yii::app()->shoppingCart->outofStock($item_id)) {
            $data['warning'] = 'Warning, Desired Quantity is Insufficient. You can still process the sale, but check your inventory!';
        }

        $this->reload($data);
      
    }

    public function actionIndexPara($item_id)
    {
        if (Yii::app()->user->checkAccess('sale.edit')) {

            Yii::app()->shoppingCart->addItem($item_id);

            $this->reload($item_id);
        } else {
            throw new CHttpException(403, 'You are not authorized to perform this action');
        }
    }

    public function actionDeleteItem($item_id)
    {
        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
            Yii::app()->shoppingCart->deleteItem($item_id);
            $this->reload();
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionEditItem($item_id)
    {
        
        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
            $data= array();
            $model = new SaleItem;
            $quantity = isset($_POST['SaleItem']['quantity']) ? $_POST['SaleItem']['quantity'] : null;
            $price =isset($_POST['SaleItem']['price']) ? $_POST['SaleItem']['price'] : null;
            $discount =isset($_POST['SaleItem']['discount']) ? $_POST['SaleItem']['discount'] : null;
            $description = 'test';

            $model->quantity=$quantity;
            $model->price=$price;
            $model->discount=$discount;
            
            if ($model->validate()) {
                Yii::app()->shoppingCart->editItem($item_id, $quantity, $discount, $price, $description);
            } else {
                $error=CActiveForm::validate($model);
                $errors = explode(":", $error);
                //$data['warning']=  str_replace("}","",$errors[1]);
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
                $data= array();
                $alt_payment_amount_to_base=0; // KHR amount convert to base currency USD here
                $payment_amount = trim($_POST['payment_amount']) == "" ? 0 : $_POST['payment_amount'];
                $alt_payment_amount = trim($_POST['alt_payment_amount']) == "" ? 0 : $_POST['alt_payment_amount'];
                
                if (trim($_POST['alt_payment_amount']) !== "") {
                    // round two decimal place down 1.268 or 1.264 will round to 1.26
                    $alt_payment_amount_to_base =  floor($alt_payment_amount / Yii::app()->settings->get('exchange_rate', 'USD2KHR')*100)/100; 
                }
                
                if ( "" == trim($_POST['payment_amount']) && "" == trim($_POST['alt_payment_amount']) ) {
                    $data['warning']=Yii::t('app',"Please enter value in payment amount");
                } else {
                    $payment_id = $_POST['payment_id'];
                    $payment_amount_total = $payment_amount + $alt_payment_amount_to_base;
                    $payment_note = Yii::app()->settings->get('site', 'currencySymbol') . $payment_amount . ';' . '៛' . $alt_payment_amount . ';' . Yii::app()->settings->get('site', 'currencySymbol') . $payment_amount_total . ';' . Yii::app()->settings->get('exchange_rate', 'USD2KHR');
                    Yii::app()->shoppingCart->setPaymentNote($payment_note);
                    Yii::app()->shoppingCart->addPayment($payment_id, $payment_amount_total);
                }
                $this->reload($data);
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }    
    }

    public function actionDeletePayment($payment_id)
    {
        if (Yii::app()->request->isPostRequest) {
            Yii::app()->shoppingCart->deletePayment($payment_id);
            $this->reload();
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionSelectCustomer()
    {
        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
            $client_id = $_POST['SaleItem']['client_id'];
            Yii::app()->shoppingCart->setCustomer($client_id);
            $this->reload();
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionRemoveCustomer()
    {
        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
            Yii::app()->shoppingCart->removeCustomer();
            $this->reload();
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionSetComment()
    {
        Yii::app()->shoppingCart->setComment($_POST['comment']);
        echo CJSON::encode(array(
            'status' => 'success',
            'div' => "<div class=alert alert-info fade in>Successfully saved ! </div>",
        ));
    }
    
    public function actionSetTotalDiscount()
    {
        if (Yii::app()->request->isPostRequest) {
            $data= array();
            $model = new SaleItem;
            $total_discount =$_POST['SaleItem']['total_discount'];
            $model->total_discount=$total_discount;

            if ($model->validate()) {
                Yii::app()->shoppingCart->setTotalDiscount($total_discount);
            } else {
                $error=CActiveForm::validate($model);
                $errors = explode(":", $error);
                $data['warning']=  str_replace("}","",$errors[1]);
            }

            $this->reload($data);
        }
    }

    public function actionSetPriceTier()
    {
        $price_tier_id = $_POST['price_tier_id'];
        Yii::app()->shoppingCart->setPriceTier($price_tier_id);
        Yii::app()->shoppingCart->f5ItemPriceTier();
        $this->reload();
    }

    private function reload($data=array())
    {
        $this->layout = '//layouts/column_sale';
   
        $model = new SaleItem;
        $data['model'] = $model;
        $data['status'] = 'success';
        
        $data=$this->sessionInfo($data);
       
        $model->comment = $data['comment'];
        $model->total_discount= $data['total_discount'];
        
        /*
        $customer = $this->customerInfo($data['customer_id']);
        $data['cust_fullname'] = $customer !== null ? $customer->first_name . ' ' . $customer->last_name : '';
        $data['cust_mobile'] = $customer !== null ? $customer->mobile_no : '';
         * 
        */
        
        if (Yii::app()->request->isAjaxRequest) {
            
            //Yii::app()->clientScript->scriptMap['*.js'] = false; 
            $cs = Yii::app()->clientScript;
            $cs->scriptMap = array(
                'jquery.js' => false,
                'bootstrap.js' => false,
                'jquery.min.js' => false,
                'bootstrap.notify.js' => false,
                'bootstrap.bootbox.min.js' => false,
                'bootstrap.min.js' => false,
                'jquery-ui.min.js' => false,
                //'EModalDlg.js'=>false,
            );
            
            Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false; 
            Yii::app()->clientScript->scriptMap['box.css'] = false; 
            $this->renderPartial('admin', $data, false, true);
            
        } elseif (Yii::app()->settings->get('sale', 'touchScreen') == '1') {
            $this->render('touchscreen/admin_touchscreen', $data);
        } else {
            $this->render('admin', $data);
        }
    }

    public function actionCancelSale()
    {
        if (Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest) {
            Yii::app()->shoppingCart->clearAll();
            $this->reload();
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionCompleteSale()
    {
       
        $this->layout = '//layouts/column_receipt';

        $data=$this->sessionInfo();

        //Save transaction to db
        $data['sale_id'] = Sale::model()->saveSale($data['session_sale_id'], $data['items'], $data['payments'], $data['payment_received'], $data['customer_id'], $data['employee_id'], $data['sub_total'], $data['comment'], Yii::app()->params['sale_complete_status'], $data['total_discount']);


        $customer = $this->customerInfo($data['customer_id']);
        $data['cust_fullname'] = $customer !== null ? $customer->first_name . ' ' . $customer->last_name : 'General';
        //$data['cust_mobile'] = $customer !== null ? $customer->mobile_no : '';

        if (empty($data['items'])) {
            $this->redirect(array('saleItem/index'));
        }
        
        if ( $data['amount_change'] > 0 && $customer==null)  {
            $data['warning'] = Yii::t('app','Plz, Select Customer');
            $this->reload($data);
        } elseif (substr($data['sale_id'],0,2) == '-1') {
             $data['warning'] = $data['sale_id'];     
        } else {
            $this->render('_receipt', $data);
            Yii::app()->shoppingCart->clearAll();
        }
       
    }

    public function actionSuspendSale()
    {
       if (Yii::app()->request->isAjaxRequest) {
            $data=$this->sessionInfo();

            //Save transaction to db
            $data['sale_id'] = 'POS ' . Sale::model()->saveSale($data['session_sale_id'], $data['items'], $data['payments'], $data['payment_received'], $data['customer_id'], $data['employee_id'], $data['sub_total'], $data['comment'], Yii::app()->params['sale_suspend_status'],$data['total_discount']);

            $customer = $this->customerInfo($data['customer_id']);
            $data['cust_fullname'] = $customer !== null ? $customer->first_name . ' ' . $customer->last_name : 'General';

            if ($data['sale_id'] == 'POS -1') {
                echo "NOK";
                Yii::app()->end();
            } else if (Yii::app()->settings->get('sale', 'receiptPrintDraftSale') == '1') {
                $this->layout = '//layouts/column_receipt';
                $this->render('_receipt_suspend', $data);
                Yii::app()->shoppingCart->clearAll();
            } else {
                Yii::app()->shoppingCart->clearAll();
            }
        
            $this->reload();
       } else {
           throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
       }
    }

    public function actionUnsuspendSale($sale_id)
    {
        Yii::app()->shoppingCart->clearAll();
        Yii::app()->shoppingCart->copyEntireSuspendSale($sale_id);
        //Sale::model()->saveUnsuspendSale($sale_id); // Roll back stock cut to original stock
        $this->redirect('index');
        exit;
    }

    public function actionEditSale($sale_id)
    {
        if (Yii::app()->user->checkAccess('invoice.print')) {
            //if(Yii::app()->request->isPostRequest)
            //{
                Yii::app()->shoppingCart->clearAll();
                Yii::app()->shoppingCart->copyEntireSale($sale_id);
                Yii::app()->session->close(); // preventing session clearing due to page redirecting..
                $this->redirect('index');
            //}
        } else {
            throw new CHttpException(403, 'You are not authorized to perform this action');
        }
    }

    public function actionReceipt($sale_id)
    {
        if (Yii::app()->user->checkAccess('invoice.print')) {
           
            $this->layout = '//layouts/column_receipt';

            Yii::app()->shoppingCart->clearAll();
            Yii::app()->shoppingCart->copyEntireSale($sale_id);

            $data=$this->sessionInfo();
            
            $data['sale_id'] = $sale_id;

            $customer = $this->customerInfo($data['customer_id']);
            $data['customer'] = $customer !== null ? $customer->first_name . ' ' . $customer->last_name : '';
         
            if (count($data['items']) == 0) {
                $data['error_message'] = 'Sale Transaction Failed';
            }
            
            $this->render('_receipt', $data);
            Yii::app()->shoppingCart->clearAll();
        } else {
            throw new CHttpException(403, 'You are not authorized to perform this action');
        }
        
    }

    /* 
     * List all of Suspened Sale (Query from [Sale] model where status='2')
     */
    public function actionListSuspendedSale()
    {
        $model = new Sale;
        $this->render('sale_suspended', array('model' => $model));
    }
    
    public function actionDeleteSale($sale_id)
    {
        $result_id=Sale::model()->deleteSale($sale_id, 'Cancel Suspended Sale', Yii::app()->shoppingCart->getEmployee());
        
        if ($result_id === -1)
        {
           Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'<strong>Oh snap!</strong> Change a few things up and try submitting again.');
        } else {
            Yii::app()->shoppingCart->clearAll();
            Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'<strong>Well done!</strong> Invoice Id ' . $sale_id . 'have been deleted successfully!' );
            $this->redirect('ListSuspendedSale');
        }
        
    }
    
    protected function sessionInfo($data=array()) 
    {
        //$data=array();
        $data['items'] = Yii::app()->shoppingCart->getCart();
        $data['count_item'] = Yii::app()->shoppingCart->getQuantityTotal();
        $data['payments'] = Yii::app()->shoppingCart->getPayments();
        $data['count_payment'] = count(Yii::app()->shoppingCart->getPayments());
        $data['payment_received'] = Yii::app()->shoppingCart->getPaymentsTotal();
        $data['sub_total'] = Yii::app()->shoppingCart->getSubTotal();
        $data['total'] = Yii::app()->shoppingCart->getTotal();
        $data['qtytotal'] = Yii::app()->shoppingCart->getQuantityTotal();
        $data['amount_change'] = Yii::app()->shoppingCart->getAmountDue();
        $data['customer_id'] = Yii::app()->shoppingCart->getCustomer();
        $data['comment'] = Yii::app()->shoppingCart->getComment();
        $data['employee_id'] = Yii::app()->session['employeeid'];
        $data['transaction_date'] = date('d/m/Y');
        $data['transaction_time'] = date('h:i:s');
        $data['session_sale_id'] = Yii::app()->shoppingCart->getSaleId();
        $data['employee'] = ucwords(Yii::app()->session['emp_fullname']);
        $data['total_discount'] = Yii::app()->shoppingCart->getTotalDiscount();
        
        $data['disable_editprice'] = Yii::app()->user->checkAccess('sale.editprice') ? false : true;
        $data['disable_discount'] = Yii::app()->user->checkAccess('sale.discount') ? false : true;
        $data['colspan'] = Yii::app()->settings->get('sale','discount')=='hidden' ? '2' : '3';
        
        $data['discount_amount'] = $data['sub_total'] * $data['total_discount']/100;
        
        
        /** Rounding a numbere to a nearest 10 or 100 (Floor : round down, Ceil : round up , Round : standard round 
         *  Ref: http://stackoverflow.com/questions/1619265/how-to-round-up-a-number-to-nearest-10
         *    ** http://stackoverflow.com/questions/6619377/how-to-get-whole-and-decimal-part-of-a-number
         *  Method : using Round method here 
        */
        $data['usd_2_khr'] = Yii::app()->settings->get('exchange_rate', 'USD2KHR');
        $data['total_khr'] = $data['total'] * $data['usd_2_khr']; 
        $data['amount_change_khr'] =  $data['amount_change'] * $data['usd_2_khr'];
        
        /*
         * Total is to round up [Ceil] - Company In
         * Amount_Change suppose to round done [Floor] but usualy this value is minus so using [Ceil] instead
        */
        $data['total_khr_round'] = ceil($data['total_khr']/100)*100; 
        $data['amount_change_khr_round'] =  ceil($data['amount_change_khr']/100)*100;

        $data['amount_change_whole'] = ceil($data['amount_change']);  // floor(1.25)=1
        $data['amount_change_fraction_khr'] = ceil( (( $data['amount_change'] -  $data['amount_change_whole'] ) * $data['usd_2_khr'])/100 ) * 100;
               
        // Customer Account Info
        $account = $this->custAccountInfo($data['customer_id']);
        $data['cust_fullname'] = $account !== null ? $account->name : '';
        $data['acc_balance'] = $account !== null ? $account->current_balance : '';
        
        return $data;
    }
    
    protected function customerInfo($customer_id)
    {
        $model=null;
        if ($customer_id != null) {
            $model = Client::model()->findbyPk($customer_id);
        }
        return $model;
    }
    
    protected function custAccountInfo($customer_id)
    {
        $model=null;
        if ($customer_id != null) {
            $model = Account::model()->getAccountInfo($customer_id);
        }
        
        return $model;
    }
    
    

}
