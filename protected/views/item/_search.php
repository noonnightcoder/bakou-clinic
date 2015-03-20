<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>

	<?php //echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span4','maxlength'=>50,'placeholder'=>Yii::t('app','Type Item Name or Code'))); ?>

	<?php //echo $form->textFieldControlGroup($model,'item_number',array('class'=>'span4','maxlength'=>255)); ?>

        <?php //echo $form->textFieldControlGroup($model,'location',array('class'=>'span4','maxlength'=>255)); ?>

        <?php //echo $form->textFieldControlGroup($model,'description',array('class'=>'span4','maxlength'=>255)); ?>

	<div class="form-actions">
                <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
	</div>

<?php $this->endWidget(); ?>
