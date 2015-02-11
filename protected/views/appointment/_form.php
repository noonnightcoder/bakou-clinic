<?php
/* @var $this AppointmentController */
/* @var $model Appointment */
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

            <?php //echo $form->textFieldControlGroup($model,'appointment_date',array('span'=>5)); ?>
            <div class="form-group"><label class="col-sm-3 control-label" for="Patient">Patient</label> 
            <div class="col-md-5"><?php 
            $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                'asDropDownList' => false,
                'model'=> $patient, 
                'attribute'=>'display_id',
                'pluginOptions' => array(
                        'placeholder' => Yii::t('app','patient.appointment'),
                        'multiple'=>false,
                        'width' => '100%',
                        //'tokenSeparators' => array(',', ' '),
                        'allowClear'=>true,
                        'minimumInputLength'=>1,
                        'ajax' => array(
                            'url' => Yii::app()->createUrl('appointment/get_patient/'), 
                            'dataType' => 'json',
                            'cache'=>true,
                            'data' => 'js:function(term,page) {
                                        return {
                                            term: term, 
                                            page_limit: 10,
                                            quietMillis: 100, //How long the user has to pause their typing before sending the next request
                                            apikey: "e5mnmyr86jzb9dhae3ksgd73" // Please create your own key!
                                        };
                                    }',
                            'results' => 'js:function(data,page){
                                var remote = $(this);
                                arr=data.results;                        
                                return { results: data.results };
                             }',
                        ),
                        'initSelection' => 'js:function (element, callback) {
                               var id=$(element).val();
                               console.log(id);
                        }',
                        //'htmlOptions'=>array('id'=>'search_item_id'),
                )));
            ?></div></div>

            <?php //echo $form->textFieldControlGroup($model,'end_date',array('span'=>5)); ?>
    
            <?php echo $form->textFieldControlGroup($contact,'display_name',array('span'=>5,'maxlength'=>50)); ?>
    
            <?php echo $form->textFieldControlGroup($contact,'phone_number',array('span'=>5,'maxlength'=>15)); ?>
    
            <?php echo $form->textFieldControlGroup($model,'title',array('span'=>5,'maxlength'=>150)); ?>

            <?php //echo $form->textFieldControlGroup($model,'start_time',array('span'=>5)); ?>

            <?php //echo $form->textFieldControlGroup($model,'end_time',array('span'=>5)); ?>
    
            <div class="form-group"><label class="col-sm-3 control-label" for="start_time">Start Time</label> 
            <div class="col-md-5"><?php $this->widget(
                    'yiiwheels.widgets.timepicker.WhTimePicker',
                    array(
                        'model'=> $model,
                        'attribute'=> 'start_time',
                        //'name' => 'Start Time',
                    )
                );?></div></div>

            
            <div class="form-group"><label class="col-sm-3 control-label" for="end_time">End Time</label> 
            <div class="col-md-5"><?php $this->widget(
                    'yiiwheels.widgets.timepicker.WhTimePicker',
                    array(
                        'model'=> $model,
                        'attribute'=> 'end_time',
                    )
                );?></div></div>    
    
            <?php //echo $form->textFieldControlGroup($model,'patient_id',array('span'=>5)); ?>

            <?php //echo $form->textFieldControlGroup($model,'user_id',array('span'=>5)); ?>

            <?php //echo $form->textFieldControlGroup($model,'status',array('span'=>5,'maxlength'=>255)); ?>

            <?php //echo $form->textFieldControlGroup($model,'visit_id',array('span'=>5)); ?>

        <div class="form-actions">
         <?php echo TbHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array(
           'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
           //'size'=>TbHtml::BUTTON_SIZE_SMALL,
       )); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->