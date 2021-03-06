<div class="form">

    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block' => true, // display a larger alert block?
        'fade' => true, // use transitions?
        'closeText' => '&times;', // close link text - if set to false, no close link is displayed
        'alerts' => array( // configurations per alert type
            'success' => array('block' => true, 'fade' => true, 'closeText' => '&times;'),
            'error' => array('block' => true, 'fade' => true, 'closeText' => '&times;'),
        ),
    )); ?>

    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'appointment-form',
        'enableAjaxValidation' => false,
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    )); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php //echo $form->textFieldControlGroup($model,'appointment_date',array('span'=>5)); ?>
    <?php if(isset($_GET['patient_id'])) {$patient->patient_id = $_GET['patient_id'];}?>
    <div class="form-group"><label class="col-sm-3 control-label" for="Patient">Patient *</label>
        <?php //$patient->patient_id=12; ?>
        <div class="col-md-5">
            <?php $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                'asDropDownList' => false,
                'model' => $patient,
                'attribute' => 'patient_id',
                'pluginOptions' => array(
                    'placeholder' => Yii::t('app', 'Select Patient'),
                    'multiple' => false,
                    'width' => '100%',
                    //'tokenSeparators' => array(',', ' '),
                    'allowClear' => true,
                    'minimumInputLength' => 1,
                    'ajax' => array(
                        'url' => Yii::app()->createUrl('appointment/GetPatient/'),
                        'dataType' => 'json',
                        'cache' => true,
                        'data' => 'js:function(term,page) {
                                        return {
                                            term: term, 
                                            page_limit: 10,
                                            quietMillis: 100,
                                            apikey: "e5mnmyr86jzb9dhae3ksgd73" // Please create your own key!
                                        };
                                    }',
                        'results' => 'js:function(data){
                                arr=data.results;
                                var myResults = [];
                                $.each(arr, function (index, item) {
                                    myResults.push({
                                        id: item.id,
                                        text: item.fullname + " " + item.display_id
                                    });
                                });
                                return {
                                    results: myResults
                                };
                             }',
                    ),
                    'initSelection'=>'js:function(element,callback) {
                        //http://bit.ly/1QcVhCm
                        var id=$(element).val(); // read #selector value
                            if ( id !== "" ) {
                             $.ajax("'.Yii::app()->createUrl('contact/SearchPatient').'", {
                               data: { id: id },
                               dataType: "json"
                            }).done(function(data,textStatus, jqXHR) { callback(data[0]); });
                        }
                    }',
                    //'htmlOptions'=>array('id'=>'search_item_id'),
                )
            ));
            ?>
            <strong><?php echo $form->error($model, 'patient_id'); ?></strong></div>
    </div>

    <?php //echo $form->textFieldControlGroup($model,'end_date',array('span'=>5)); ?>

    <?php //echo $form->textFieldControlGroup($contact,'display_name',array('disabled'=>true,'span'=>5,'maxlength'=>50)); ?>

    <?php //echo $form->textFieldControlGroup($contact,'phone_number',array('disabled'=>true,'span'=>5,'maxlength'=>15)); ?>

    <div class="form-group"><label class="col-sm-3 control-label" for="user_name">Doctor</label>

        <div class="col-md-5"><?php echo $form->dropDownList($user, 'id',
                //@$doctor,
                Appointment::model()->get_combo_doctor(), array()) ?> </div>
    </div>

    <?php echo $form->textFieldControlGroup($model, 'title', array('span' => 5, 'maxlength' => 150)); ?>

    <?php echo $form->textField($model, 'start_time', array('span' => 5, 'style' => 'display:none')); ?>

    <?php echo $form->textField($model, 'end_time', array('span' => 5, 'style' => 'display:none')); ?>


    <?php //echo $form->textFieldControlGroup($model,'patient_id',array('span'=>5)); ?>

    <?php //echo $form->textFieldControlGroup($model,'user_id',array('span'=>5)); ?>

    <?php //echo $form->textFieldControlGroup($model,'status',array('span'=>5,'maxlength'=>255)); ?>

    <?php //echo $form->textFieldControlGroup($model,'visit_id',array('span'=>5)); ?>

    <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            //'size'=>TbHtml::BUTTON_SIZE_SMALL,
        )); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<?php
Yii::app()->clientScript->registerScript('searchPatient', "
    jQuery( function($){
        $('#Patient_patient_id').on('change', function(e) {
            e.preventDefault();
            var remote = $('#Patient_patient_id');
            var patient_id=remote.val();
            var fullname= $('#Contact_display_name');
            var msisdn = $('#Contact_phone_number');
            $.ajax({url: 'RetreivePatient',
                dataType : 'json',
                data : {patient_id : patient_id},
                type : 'post',
                beforeSend: function() { $('.waiting').show(); },
                complete: function() { $('.waiting').hide(); },
                success : function(data) {
                    if (data.status==='success')
                    {
                        fullname.val(data.div_fullname);
                        msisdn.val(data.div_msisdn);
                    }
                    else 
                    {
                       console.log(data.message);
                    }
                }
            });
        });
    });
");
?>