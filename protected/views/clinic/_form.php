<?php
/* @var $this ClinicController */
/* @var $model Clinic */
/* @var $form TbActiveForm */
?>

<div class="form">

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), 
            'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
        ),
)); ?>
    
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                'id'=>'employee-form',
                'enableAjaxValidation'=>false,
                'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        )); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php //echo $form->errorSummary($model); ?>

            <?php //echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

            <?php //echo $form->textFieldControlGroup($model,'start_time',array('span'=>5,'maxlength'=>10)); ?>

            <?php //echo $form->textFieldControlGroup($model,'end_time',array('span'=>5,'maxlength'=>10)); ?>

            <?php //echo $form->textFieldControlGroup($model,'time_interval',array('span'=>5,'maxlength'=>11)); ?>

            <?php echo $form->textFieldControlGroup($model,'clinic_name',array('span'=>5,'maxlength'=>50)); ?>

            <?php //echo $form->textFieldControlGroup($model,'tag_line',array('span'=>5,'maxlength'=>100)); ?>

            <?php echo $form->textFieldControlGroup($model,'clinic_address',array('span'=>5,'maxlength'=>500)); ?>

            <?php //echo $form->textFieldControlGroup($model,'landline',array('span'=>5,'maxlength'=>50)); ?>

            <?php echo $form->textFieldControlGroup($model,'mobile',array('span'=>5,'maxlength'=>50)); ?>

            <?php echo $form->textFieldControlGroup($model,'email',array('span'=>5,'maxlength'=>50)); ?>

            <?php //echo $form->textFieldControlGroup($model,'next_followup_days',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array(
           'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
           //'size'=>TbHtml::BUTTON_SIZE_SMALL,
       )); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->