<?php
$this->breadcrumbs=array(
	Yii::t('app','Patient')=>array('contact/admin'),
	Yii::t('app','History'),
);


?>
<div id="patient_his_container">
 <?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
            'title' => Yii::t('app','Patient') . ' : ' . ucwords($patient->fullname),
            'headerIcon' => 'ace-icon fa fa-user',
            'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
)); ?>    
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'patient-history-form',
            'enableAjaxValidation'=>false,
            'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
            //'action' => $this->createUrl('savepayment'),
    )); ?>
        <?php echo $form->textFieldControlGroup($patient,'display_id',array('class'=>'span2','disabled'=>'disabled','label'=>'Patient ID')); ?>
        <?php echo $form->textFieldControlGroup($patient,'dob',array('class'=>'span2','disabled'=>'disabled')); ?>
        <?php echo $form->textFieldControlGroup($patient,'sex',array('class'=>'span2','disabled'=>'disabled')); ?>
        <?php echo $form->textFieldControlGroup($patient,'address_line_1',array('class'=>'span2','disabled'=>'disabled')); ?>
    <?php $this->endWidget(); ?>
    
    <?php $this->widget('bootstrap.widgets.TbTabs', array(
        'type'=>'tabs',
        'placement'=>'above', // 'above', 'right', 'below' or 'left'
        'tabs'=>array(
            array('label'=>Yii::t('app','Visited History'),'id'=>'tab_1', 'content'=>$this->renderPartial('_visited', array('visit'=>$visit,'patient_id'=>$patient_id),true),'active'=>true),
            //array('label'=>Yii::t('app','Invoice History'),'id'=>'tab_2', 'content'=>$this->renderPartial('_invoice_his', array('model'=>$model,'client_id'=>$client_id,'balance'=>$balance),true)),
            //array('label'=>Yii::t('app','Payment History'),'id'=>'tab_3', 'content'=>$this->renderPartial('_sale_payment', array('model'=>$model,'client_id'=>$client_id,'balance'=>$balance),true)),            
        ),
        //'events'=>array('shown'=>'js:loadContent')
    )); ?>        

<?php $this->endWidget(); ?>    
</div>