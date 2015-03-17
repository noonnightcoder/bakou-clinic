<?php
/* @var $this ItemController */
/* @var $model Item */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('\TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'name',array('span'=>5,'maxlength'=>50)); ?>

                    <?php echo $form->textFieldControlGroup($model,'item_number',array('span'=>5,'maxlength'=>255)); ?>

                    <?php echo $form->textFieldControlGroup($model,'category_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'supplier_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'cost_price',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'unit_price',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'quantity',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'reorder_level',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'location',array('span'=>5,'maxlength'=>20)); ?>

                    <?php echo $form->textFieldControlGroup($model,'allow_alt_description',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'is_serialized',array('span'=>5)); ?>

                    <?php echo $form->textAreaControlGroup($model,'description',array('rows'=>6,'span'=>8)); ?>

                    <?php echo $form->textFieldControlGroup($model,'status',array('span'=>5,'maxlength'=>1)); ?>

                    <?php echo $form->textFieldControlGroup($model,'created_date',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'modified_date',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'is_expire',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->