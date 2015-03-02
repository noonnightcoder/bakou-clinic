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
                'id'=>'doctor_consult',
                'enableAjaxValidation'=>false,
                'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        )); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>
    <div class="form-group"><label class="col-sm-3 control-label" for="first_name">Doctor</label> 
        <?php echo $form->textField($employee,'first_name',array('disabled'=>true,'span'=>5,'maxlength'=>50)); ?>
    </div>    
    <?php //echo $form->textFieldControlGroup($visit,'type',array('disabled'=>true,'span'=>5,'maxlength'=>50)); ?>
    <div class="form-group"><label class="col-sm-3 control-label" for="followup_date">Follow Up Date</label> 
        <div class="col-md-5">
            <?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
                    //'name' => 'datepickertest',
                    'model'=> $patient,
                    'attribute'=> 'followup_date',
                    'pluginOptions' => array(
                        'format' => 'yyyy-mm-dd',
                        'placeholder'=> 'yyyy-mm-dd'
                    )
                ));
            ?>
            <span class="add-on"><icon class="icon-calendar"></icon></span>
        </div>
    </div> 
    <div class="form-group"><label class="col-sm-3 control-label" for="treatment">Treatment</label> 
        <div class="col-md-5">
            <?php 
                $this->widget('yiiwheels.widgets.multiselect.WhMultiSelect', 
                        array(
                            'model'=> $treatment,
                            'attribute'=> 'treatment',
                            'data' => CHtml::listData(Treatment::model()->findAll(), 'id','treatment'),
                            /*'pluginOptions' => array(
                                //'width' => '100%'
                                //'span' => 5
                            )*/
                        )
                    );
            ?>
        </div>
    </div>
    <?php //echo $form->textFieldControlGroup($visit,'notes',array('span'=>5,'maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($visit,'sympton',array('span'=>5,'maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($visit,'observation',array('span'=>5,'maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($visit,'assessment',array('span'=>5,'maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($visit,'plan',array('span'=>5,'maxlength'=>50)); ?>
    <?php //echo $form->dropDownListControlGroup($treatment,'treatment',CHtml::listData(Treatment::model()->findAll(array('order' => 'id')), 'id', 'treatment'), array('span' => 5)) ?>  
    <!--<div class="form-group"><label class="col-sm-3 control-label" for="treatment">Treatment</label> 
        <div class="col-md-5">
                <?php
                    /*$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                        //'asDropDownList' => false,
                        'model'=> $treatment,
                        'attribute'=> 'treatment',
                        'data' => CHtml::listData(Treatment::model()->findAll(array('order' => 'id')), 'id', 'treatment'),
                        //'value' => $treatment->treatment,
                        'pluginOptions' => array(     
                        //'tags' => true,  
                        //'multiple' => true,
                        'placeholder' => 'Select Treatment',
                        'width' => '100%',
                        //'tokenSeparators' => array(',', ' ')
                    )));*/
                ?>
                <?php
                    /*$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                    'asDropDownList' => false,
                    //'name' => 'select2test',
                    'model'=> $treatment,
                    'attribute'=> 'treatment',    
                    'pluginOptions' => array(
                    'tags' => array('2amigos','consulting', 'group', 'rocks'),
                    //'tags' => CHtml::listData(Treatment::model()->findAll(), 'id','treatment'),
                    'placeholder' => 'Select Treatment',
                    'width' => '100%',
                    //'tokenSeparators' => array(',', ' ')
                    )));*/                    
                ?>
        </div>
    </div>-->
    <div class="form-actions">
         <?php echo TbHtml::submitButton($visit->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array(
           'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
           //'size'=>TbHtml::BUTTON_SIZE_SMALL,
       )); ?>
    </div>
<?php $this->endWidget(); ?>
