<?php
$this->breadcrumbs=array(
	Yii::t('app','Patient')=>array('contact/admin'),
	Yii::t('app','Index'),
);


?>
<div id="patient_his_container">
 <?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
            'title' => Yii::t('app','Patient History'),
            'headerIcon' => 'ace-icon fa fa-credit-card',
            'headerButtons' => array(
                    TbHtml::linkButton(Yii::t( 'app', 'Back to Contact' ),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                            'size'=>TbHtml::BUTTON_SIZE_SMALL,
                            'icon'=>'ace-icon fa fa-undo white',
                            'url'=>$this->createUrl('contact/admin'),
                    )),
                ),
            'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
)); ?>    
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'patient-history-form',
            'enableAjaxValidation'=>false,
            'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
            //'action' => $this->createUrl('savepayment'),
    )); ?>
        <?php echo $form->textFieldControlGroup($patient,'fullname',array('class'=>'span2','disabled'=>'disabled')); ?>
        <?php echo $form->textFieldControlGroup($patient,'dob',array('class'=>'span2','disabled'=>'disabled')); ?>
        <?php echo $form->textFieldControlGroup($patient,'sex',array('class'=>'span2','disabled'=>'disabled')); ?>
        <?php echo $form->textFieldControlGroup($patient,'address_line_1',array('class'=>'span2','disabled'=>'disabled')); ?>
    <?php $this->endWidget(); ?>
    
    <?php $this->renderPartial('_visited', array('visit'=>$visit,'patient_id'=>$patient_id),false,true); ?> 

<?php $this->endWidget(); ?>    
</div>