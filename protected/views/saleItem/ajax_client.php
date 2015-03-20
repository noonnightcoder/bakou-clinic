<?php 
    if(isset($customer)) 
    {
        $this->widget('yiiwheels.widgets.box.WhBox', array(
               'title' => Yii::t('app','Select Customer (Optional)'), //'Select Customer (Optional)',
               'headerIcon' => 'ace-icon fa fa-users',
               'content' => $this->renderPartial('_client_selected',array('model'=>$model,'customer'=>$customer,'customer_mobile_no'=>$customer_mobile_no),true)
         ));
    }else 
    { 
        $this->widget('yiiwheels.widgets.box.WhBox', array(
               'title' => Yii::t('app','Select Customer (Optional)'),
               'headerIcon' => 'ace-icon fa fa-users',
               'content' => $this->renderPartial('_client',array('model'=>$model),true)
         ));
    }
?>
