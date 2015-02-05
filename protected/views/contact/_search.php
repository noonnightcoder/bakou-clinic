<?php
/* @var $this ContactController */
/* @var $model Contact */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'first_name',array('class'=>'span4','maxlength'=>50,'placeholder'=>Yii::t('app','Type Name or ID'))); ?>

                    <?php //echo $form->textFieldControlGroup($model,'first_name',array('span'=>5,'maxlength'=>50)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'middle_name',array('span'=>5,'maxlength'=>50)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'last_name',array('span'=>5,'maxlength'=>50)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'display_name',array('span'=>5,'maxlength'=>255)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'phone_number',array('span'=>5,'maxlength'=>15)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'email',array('span'=>5,'maxlength'=>150)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'contact_image',array('span'=>5,'maxlength'=>255)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'type',array('span'=>5,'maxlength'=>50)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'address_line_1',array('span'=>5,'maxlength'=>150)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'address_line_2',array('span'=>5,'maxlength'=>150)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'city',array('span'=>5,'maxlength'=>50)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'state',array('span'=>5,'maxlength'=>50)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'postal_code',array('span'=>5,'maxlength'=>50)); ?>

                    <?php //echo $form->textFieldControlGroup($model,'country',array('span'=>5,'maxlength'=>50)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->