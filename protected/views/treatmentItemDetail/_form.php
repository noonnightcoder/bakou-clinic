<?php
/* @var $this TreatmentItemDetailController */
/* @var $model TreatmentItemDetail */
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

            <?php //echo $form->textFieldControlGroup($model,'t_group_id',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'treatment_item',array('span'=>5,'maxlength'=>100)); ?>

            <?php echo $form->textFieldControlGroup($model,'unit_price',array('span'=>5,'maxlength'=>15)); ?>

            <?php echo $form->textFieldControlGroup($model,'caption',array('span'=>5,'maxlength'=>30)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array(
           'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
           //'size'=>TbHtml::BUTTON_SIZE_SMALL,
       )); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->