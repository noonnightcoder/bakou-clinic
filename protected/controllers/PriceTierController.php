<?php

class PriceTierController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin','delete','undodelete'),
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

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new PriceTier;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (Yii::app()->user->checkAccess('item.create')) {
            if (isset($_POST['PriceTier'])) {
                $model->attributes = $_POST['PriceTier'];
                if ($model->validate()) {
                    $transaction = $model->dbConnection->beginTransaction();
                    try {
                        $model->modified_date=date('Y-m-d H:i:s');
                        if ($model->save()) {
                            $transaction->commit();
                            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                            echo CJSON::encode(array(
                                'status' => 'success',
                                'div' => "<div class=alert alert-info fade in> Successfully added ! </div>",
                            ));
                            Yii::app()->end();
                        }
                    } catch (Exception $e) {
                        $transaction->rollback();
                        print_r($e);
                    }
                }
            }

            if (Yii::app()->request->isAjaxRequest) {
                $cs = Yii::app()->clientScript;
                $cs->scriptMap = array(
                    'jquery.js' => false,
                    'bootstrap.js' => false,
                    'jquery.min.js' => false,
                    'bootstrap.notify.js' => false,
                    'bootstrap.bootbox.min.js' => false,
                );
                echo CJSON::encode(array(
                    'status' => 'render',
                    'div' => $this->renderPartial('_form', array('model' => $model), true, true),
                ));
                Yii::app()->end();
            } else {
                $this->render('update', array('model' => $model));
            }    
        } else {
            throw new CHttpException(403, 'You are not authorized to perform this action');
        }    
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (Yii::app()->user->checkAccess('item.update')) {
            if (isset($_POST['PriceTier'])) {
                $model->attributes = $_POST['PriceTier'];
                if ($model->validate()) {
                    $transaction = $model->dbConnection->beginTransaction();
                    try {
                        $model->modified_date=date('Y-m-d H:i:s');
                        if ($model->save()) {
                            $transaction->commit();
                            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                            echo CJSON::encode(array(
                                'status' => 'success',
                                'div' => "<div class=alert alert-info fade in> Successfully updated ! </div>",
                            ));
                            Yii::app()->end();
                        }
                    } catch (Exception $e) {
                        $transaction->rollback();
                        print_r($e);
                    }
                }
            }

            if (Yii::app()->request->isAjaxRequest) {
                $cs = Yii::app()->clientScript;
                $cs->scriptMap = array(
                    'jquery.js' => false,
                    'bootstrap.js' => false,
                    'jquery.min.js' => false,
                    'bootstrap.notify.js' => false,
                    'bootstrap.bootbox.min.js' => false,
                );
                echo CJSON::encode(array(
                    'status' => 'render',
                    'div' => $this->renderPartial('_form', array('model' => $model), true, true),
                ));
                Yii::app()->end();
            } else {
                $this->render('update', array('model' => $model));
            }    
        } else {
            throw new CHttpException(403, 'You are not authorized to perform this action');
        }  
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->user->checkAccess('item.delete')) { 
            if (Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
                PriceTier::model()->deletePriceTeir($id);

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if (!isset($_GET['ajax'])) {
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }
            } else {
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            }
        } else {
            throw new CHttpException(403, 'You are not authorized to perform this action');
        }
    }
    
    public function actionUndoDelete($id)
    {
        if (Yii::app()->user->checkAccess('item.delete')) { 
            if (Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
                PriceTier::model()->undodeletePriceTeir($id);

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if (!isset($_GET['ajax'])) {
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }
            } else {
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            }
        } else {
            throw new CHttpException(403, 'You are not authorized to perform this action');
        } 
            
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('PriceTier');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new PriceTier('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['PriceTier'])) {
            $model->attributes = $_GET['PriceTier'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PriceTier the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = PriceTier::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param PriceTier $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'price-tier-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
