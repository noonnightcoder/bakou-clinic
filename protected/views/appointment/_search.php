<?php
/* @var $this AppointmentController */
/* @var $model Appointment */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('\TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>
                    <?php echo $form->textFieldControlGroup($model,'patient_name',array('span'=>5)); ?>
                    <?php //echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'appointment_date',array('span'=>5)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'end_date',array('span'=>5)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'start_time',array('span'=>5)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'end_time',array('span'=>5)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'title',array('span'=>5,'maxlength'=>150)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'patient_id',array('span'=>5)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'user_id',array('span'=>5)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'status',array('span'=>5,'maxlength'=>255)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'visit_id',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->