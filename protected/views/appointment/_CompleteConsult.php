<div class="register_container">
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
        //'id'=>'doctor_consult',
        //'action'=>Yii::app()->createUrl('appointment/DoctorConsult'),
        'enableAjaxValidation'=>false,
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        'id'=>'add_item_form',
)); ?>

    <?php if(Yii::app()->user->hasFlash('error')):?>
        <?php $this->widget('bootstrap.widgets.TbAlert'); ?>
    <?php endif; ?>
    <div class="col-sm-6"> 

        <?php echo $form->textAreaControlGroup($visit,'sympton',array('rows'=>1 , 'cols'=>10, 'class'=>'span2')); ?>

        <?php echo $form->textAreaControlGroup($visit,'assessment',array('rows'=>1 , 'cols'=>10, 'class'=>'span2')); ?>
    </div>

    <div class="col-sm-6">
        <!--<h4 class="header blue bolder smaller"><i class="ace-icon fa fa-key blue"></i><?php //echo Yii::t('app','Treatment Result') ?></h4>--->

        <?php echo $form->textAreaControlGroup($visit,'observation',array('rows'=>1 , 'cols'=>10, 'class'=>'span2')); ?>
        <?php echo $form->textAreaControlGroup($visit,'plan',array('rows'=>1 , 'cols'=>10, 'class'=>'span2')); ?>
    </div>

    <div class="col-sm-12">
        <?php $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
            'title' => Yii::t('app','Treatment'),
            'headerIcon' => 'ace-icon fa fa-medkit',
            'headerButtons' => array(
                $this->renderpartial('_select_treatment',array('treatment'=>$treatment,'treatment_items'=>$treatment_items),true)            
            ),
            'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
            //'content' => $this->renderPartial('_form_treatment'),
        ));?> 
            <div class="grid-view" id="select_treatment_form">                
                <?php $this->renderPartial('_ajax_treatment', array('treatment_selected_items' => $treatment_selected_items,'treatment'=>$treatment), false) ?> 
            </div>
        <?php $this->endWidget(); ?> 
    </div>  

    <div class="col-sm-12" id="medicine_form">
        <?php $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
                'title' => 'Medicine',
                'headerIcon' => 'ace-icon fa fa-medkit',
                    'headerButtons' => array(
                    $this->renderpartial('_Medicine',array('medicine'=>$medicine),true)
                ),
                'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
                //'content' => $this->renderPartial('_form', array('model'=>$model,'model_search'=>$model_search,'leave_detail_wrapper'=>$leave_detail_wrapper,'employee_id'=>$employee_id), true),
            ));?> 
                <div id="select_medicine_form">
                    <?php $this->renderPartial('_select_medicine', array('medicine_selected_items'=>$medicine_selected_items,'medicine'=>$medicine,), false); ?>
                </div>
        <?php $this->endWidget(); ?> 
    </div>

    <div class="col-sm-12">
        <div class="form-actions" id="form-actions">
             <?php echo TbHtml::submitButton($visit->isNewRecord ? Yii::t('app','Save') : Yii::t('app','Save'),array(
               'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
               'name'=>'Save_consult' 
               //'size'=>TbHtml::BUTTON_SIZE_SMALL,
           )); ?>
            <?php 
            /*echo TbHtml::linkButton('Hold Consultation',array(
               'buttonType'=>'button',
               'type'=>'primary',
               'color' => TbHtml::BUTTON_COLOR_DANGER,
               'ajax'=>array(
                   'type'=>'post',
                   'dataType'=>'json',
                   //'beforeSend'=>"function() { $('.waiting').show(); }",
                   //'complete'=>"function() { $('.waiting').hide(); }",
                   'url'=>'#',
                   'success'=>'function (data) {                    
                    }'
                )
            ));*/
            ?>
            <?php if(!empty($chk_bill_saved)) { ?>
            <?php 
            /*echo TbHtml::linkButton('Completed Consultation',array(
               'buttonType'=>'button',
               'type'=>'primary',
               'color' => TbHtml::BUTTON_COLOR_SUCCESS,
               'url' => array('completedConsult', 'visit_id' => $visit_id),
               //'url' => '#',
                'class' => 'completed-consult',
                //'title' =>  'Remove', 
            ));*/
            echo TbHtml::submitButton($visit->isNewRecord ? Yii::t('app','Completed Consultation') : Yii::t('app','Completed Consultation'),array(
               'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
               'name'=>'Completed_consult' 
               //'size'=>TbHtml::BUTTON_SIZE_SMALL,
           ));
            ?>
            <?php } ?>
        </div>  
    </div>


<?php $this->endWidget(); ?>
    
</div>  


<?php 
$url=Yii::app()->createUrl('Appointment/Addmedicine/');        
Yii::app()->clientScript->registerScript( 'update_medicine',"
    $('#Item_id').on('change',function(e) {
        medicine_id=$('#Item_id').val();
        $.ajax({
            url:'$url', 
            dataType : 'json',    
            type : 'post',
            data : {medicine_id:medicine_id},
            beforeSend: function() { $('.waiting').show(); },
            complete: function() { $('.waiting').hide(); },
            success : function(data) {
                if(data.status=='success')
                {
                    $('#select_medicine_form').html(data.div_medicine_form);
                     //location.reload();
                }    
            }
        });
    });
"); 
?>

<?php
Yii::app()->clientScript->registerScript( 'deleteMedicine',"
        $('div#select_medicine_form').on('click','a.delete-item',function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url:url,
            dataType:'json',
            type:'post',    
            beforeSend: function() { $('.waiting').show(); },
            complete: function() { $('.waiting').hide(); },
            success:function(data) {
                if(data.status=='success')
                {
                    $('#select_medicine_form').html(data.div_medicine_form);
                }
            }
        });
    });
");
?>

<?php
Yii::app()->clientScript->registerScript( 'deleteTreatment',"
        $('div#select_treatment_form').on('click','a.delete-treatment',function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url:url,
            dataType:'json',
            type:'post',    
            beforeSend: function() { $('.waiting').show(); },
            complete: function() { $('.waiting').hide(); },
            success:function(data) {
                if(data.status=='success')
                {
                    //$('#select_medicine_form').html(data.div_medicine_form);
                    $('#select_treatment_form').html(data.div_treatment_form);
                }
            }
        });
    });
");
?>

<?php
$url=Yii::app()->createUrl('Appointment/Addtreatment/');        
Yii::app()->clientScript->registerScript( 'update_treament',"
    $('#Treatment_id').on('change',function(e) {
        treatment_id=$('#Treatment_id').val();
        //alert(treatment_id);
        $.ajax({
            url:'$url', 
            dataType : 'json',    
            type : 'post',
            data : {treatment_id:treatment_id},
            beforeSend: function() { $('.waiting').show(); },
            complete: function() { $('.waiting').hide(); },
            success : function(data) {
                if(data.status=='success')
                {
                    $('#select_treatment_form').html(data.div_treatment_form);
                     //location.reload();
                }    
            }
        });
    });
");  
?>

<?php
$red_url = Yii::app()->createUrl('Appointment/waitingqueue/');  
Yii::app()->clientScript->registerScript( 'completedConsult',"
        $('div#form-actions').on('click','a.completed-consult',function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url:url,
            dataType:'json',
            type:'post',    
            beforeSend: function() { $('.waiting').show(); },
            complete: function() { $('.waiting').hide(); },
            success:function(data) {
                if(data.status=='success')
                {
                    //$('#select_medicine_form').html(data.div_medicine_form);
                    window.location.href = '$red_url';
                }
            }
        });
    });
");
?>