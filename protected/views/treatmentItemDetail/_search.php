<?php
/* @var $this TreatmentItemDetailController */
/* @var $model TreatmentItemDetail */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('\TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'t_group_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'treatment_item',array('span'=>5,'maxlength'=>100)); ?>

                    <?php echo $form->textFieldControlGroup($model,'unit_price',array('span'=>5,'maxlength'=>15)); ?>

                    <?php echo $form->textFieldControlGroup($model,'caption',array('span'=>5,'maxlength'=>30)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->