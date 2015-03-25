<?php
/* @var $this ContactController */
/* @var $model Contact */
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
                'htmlOptions'=> array('enctype'=>'multipart/form-data',)
        )); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <div class="col-sm-6">
            <h4 class="header blue"><i class="ace-icon fa fa-info-circle blue"></i><?php echo Yii::t('app','Patient Basic Information') ?></h4>
                
    <?php //echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'first_name',array('class'=>'span7','maxlength'=>40,'data-required'=>'true')); ?>

            <?php //echo $form->textFieldControlGroup($model,'middle_name',array('class'=>'span7','maxlength'=>40,'data-required'=>'true')); ?>

            <?php echo $form->textFieldControlGroup($model,'last_name',array('class'=>'span7','maxlength'=>40,'data-required'=>'true')); ?>

            <?php echo $form->textFieldControlGroup($model,'display_name',array('class'=>'span7','maxlength'=>40,'data-required'=>'true')); ?>
            
            <div class="form-group"><label class="col-sm-3 control-label" for="dob"><?php echo Yii::t('app','Date Of Birth'); ?></label>
                <div class="col-md-9">
                    <?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
                    'attribute' => 'dob',
                    'model' => $model,
                    'pluginOptions' => array(
                            'format' => 'yyyy-mm-dd',
                        )
                    ));
                    ?>
                    <!--<span class="input-group-addon col-sm-3"><i class="ace-icon fa fa-calendar"></i></span>-->
                </div>  
            </div>
            
            <?php echo $form->dropDownListControlGroup($model,'sex',array('Female'=>'Female','Male'=>'Male'), array('class'=>'span7')) ?>

            <?php echo $form->textFieldControlGroup($model,'phone_number',array('class'=>'span7','maxlength'=>40,'data-required'=>'true')); ?>

            <?php //echo $form->textFieldControlGroup($model,'email',array('class'=>'span7','maxlength'=>40,'data-required'=>'true')); ?>

            <?php //echo $form->textFieldControlGroup($model,'type',array('class'=>'span7','maxlength'=>40,'data-required'=>'true')); ?>

            <?php //echo $form->dropDownListControlGroup($model,'type',array('Home'=>'Home','Office'=>'Office'), array('class'=>'span7')) ?>     
                
            <?php echo $form->textFieldControlGroup($model,'address_line_1',array('class'=>'span7','maxlength'=>40,'data-required'=>'true')); ?>

            <?php //echo $form->textFieldControlGroup($model,'address_line_2',array('class'=>'span7','maxlength'=>40,'data-required'=>'true')); ?>

            <?php //echo $form->textFieldControlGroup($model,'city',array('class'=>'span7','maxlength'=>40,'data-required'=>'true')); ?>

            <?php //echo $form->textFieldControlGroup($model,'state',array('class'=>'span7','maxlength'=>40,'data-required'=>'true')); ?>

            <?php //echo $form->textFieldControlGroup($model,'postal_code',array('class'=>'span7','maxlength'=>40,'data-required'=>'true')); ?>

            <?php //echo $form->textFieldControlGroup($model,'country',array('class'=>'span7','maxlength'=>40,'data-required'=>'true')); ?>
                
            <?php //echo $form->dropDownListControlGroup($model,'country',array('Cambodia'=>'Cambodia','Thailland'=>'Thailland'), array('class'=>'span7')) ?> 
    </div>
    <div class="col-sm-6">
        <h4 class="header blue bolder smaller"><i class="ace-icon fa fa-key blue"></i><?php echo Yii::t('app','Patient Image') ?></h4>
        <?php echo $form->textFieldControlGroup($model,'image_path',array('disabled'=>true,'class'=>'span7','maxlength'=>200,'data-required'=>'true')); ?>
        <?php echo $form->textFieldControlGroup($model,'image_name',array('disabled'=>true,'class'=>'span7','maxlength'=>200,'data-required'=>'true')); ?>
        
        <?php
            echo CHtml::activeFileField($model, 'image');
        ?>
    </div>
    <div class="col-sm-6">
    <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array(
           'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
           //'size'=>TbHtml::BUTTON_SIZE_SMALL,
       )); ?>
    </div>
    </div>            
    <?php $this->endWidget(); ?>

</div><!-- form -->