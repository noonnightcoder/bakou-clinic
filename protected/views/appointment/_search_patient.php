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
            
            <div class="form-group"><label class="col-sm-3 control-label" for="date_report"><?php echo Yii::t('app','Date'); ?></label>
                <div class="col-md-5">
                    <?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
                    'attribute' => 'date_report',
                    'model' => $model,
                    'pluginOptions' => array(
                            'format' => 'yyyy-mm-dd',
                        )
                    ));
                    ?>
                    <!--<span class="input-group-addon col-sm-3"><i class="ace-icon fa fa-calendar"></i></span>-->
                </div>  
            </div>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->