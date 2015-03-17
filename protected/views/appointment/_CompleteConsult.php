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
                //'id'=>'doctor_consult',
                //'action'=>Yii::app()->createUrl('appointment/DoctorConsult'),
                'enableAjaxValidation'=>false,
                'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
                'id'=>'add_item_form',
        )); ?>
    
        <?php if(Yii::app()->user->hasFlash('error')):?>
            <?php $this->widget('bootstrap.widgets.TbAlert'); ?>
        <?php endif; ?>
    
        <!--<p class="help-block">Fields with <span class="required">*</span> are required.</p>--->
        <div class="col-sm-6">         
            
            <!-- 
            <div class="form-group"><label class="col-sm-3 control-label" for="first_name">Doctor</label> 
                <?php //echo $form->textField($employee,'doctor_name',array('disabled'=>true,'span'=>6,'maxlength'=>50)); ?>
            </div>    
            -->
            <?php //echo $form->textFieldControlGroup($visit,'type',array('disabled'=>true,'span'=>5,'maxlength'=>50)); ?>
            <!--
            <div class="form-group"><label class="col-sm-3 control-label" for="followup_date">Follow Up Date</label> 
                <div class="col-md-6">
                    <?php /*$this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
                            //'name' => 'datepickertest',
                            'model'=> $patient,
                            'attribute'=> 'followup_date',
                            'pluginOptions' => array(
                                'format' => 'yyyy-mm-dd',
                                'placeholder'=> 'yyyy-mm-dd'
                            )
                        ));
                     * 
                     */
                    ?>
                    <span class="add-on"><icon class="icon-calendar"></icon></span>
                </div>
            </div>  
            -->
            <?php //echo $form->textareaControlGroup($visit,'assessment',array('span'=>6,'row' => 1,'maxlength'=>50)); ?> 
            
            <?php echo $form->textAreaControlGroup($visit,'sympton',array('rows'=>1 , 'cols'=>10, 'class'=>'span2')); ?>
            
            <?php echo $form->textAreaControlGroup($visit,'assessment',array('rows'=>1 , 'cols'=>10, 'class'=>'span2')); ?>
        </div>
    
        <div class="col-sm-6">
            <!--<h4 class="header blue bolder smaller"><i class="ace-icon fa fa-key blue"></i><?php echo Yii::t('app','Treatment Result') ?></h4>--->

            <?php echo $form->textAreaControlGroup($visit,'observation',array('rows'=>1 , 'cols'=>10, 'class'=>'span2')); ?>
            <?php echo $form->textAreaControlGroup($visit,'plan',array('rows'=>1 , 'cols'=>10, 'class'=>'span2')); ?>
        </div>
    
    
    <div class="col-sm-12">
        <?php $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
            'title' => Yii::t('app','Treatment'),
            'headerIcon' => 'ace-icon fa fa-medkit',
            'headerButtons' => array(
                $this->renderpartial('_select_treatment',array('treatment'=>$treatment,'treatment_items'=>$treatment_items,'form'=>$form),true)            
            ),
            'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
            //'content' => $this->renderPartial('_form_treatment'),
        ));?> 
            <div class="grid-view" id="treatment_form">                
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="display:none">ID</th>
                            <th>Treatment</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="treatment_contents">
                        <?php //$treatment_selected_items =array(); ?>
                        <?php foreach ($treatment_selected_items as $id => $item): ?>
                        <?php $item_id=$item['id']; ?>
                        <tr>
                            <!--<td style="display:none"> 
                                <?php //echo $item['id']; ?><br/>                        
                            </td>-->
                            <td style="display:none">
                                <?php echo $form->textField($treatment, "id", array('value' => $item['id'], 'class' => 'input-small numeric input-grid', 'id' => "id_$item_id")); ?>    
                            <td> 
                                <?php echo $item['treatment']; ?><br/>                        
                            </td>
                            <td><?php echo $form->textField($treatment, "price", array('value' => $item['price'], 'class' => 'input-small numeric input-grid', 'id' => "price_$item_id", 'placeholder' => 'Price', 'data-id' => "$item_id", 'maxlength' => 50, 'onkeypress' => 'return isNumberKey(event)')); ?></td>
                            <td><?php
                                echo TbHtml::linkButton('', array(
                                    'color'=>TbHtml::BUTTON_COLOR_DANGER,
                                    'size' => TbHtml::BUTTON_SIZE_MINI,
                                    'icon' => 'glyphicon glyphicon-trash ',
                                    //'url' => array('DeleteTreatment', 'treatment_id' => $item_id),
                                    //'label'=>'delete',
                                    'class' => 'delete-item',
                                    'title' =>  'Remove',
                                    'ajax'=>array(
                                        'type'=>'post',
                                        'dataType'=>'json',
                                        'beforeSend'=>"function() { $('.waiting').show(); }",
                                        'complete'=>"function() { $('.waiting').hide(); }",
                                        'url'=>Yii::app()->createUrl('appointment/DeleteTreatment',array('treatment_id'=>$item_id)),
                                        'success'=>'function (data) {
                                            if(data.status=="success")
                                            {
                                                $("#treatment_form").html(data.div_treatment_form);
                                            }
                                        }'
                                    )
                                ));
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>   
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
                <div id="register_container">
                    <?php $this->renderPartial('_select_medicine', array('medicine_selected_items'=>$medicine_selected_items,'medicine'=>$medicine), false); ?>
                </div>
            <?php $this->endWidget(); ?> 
    </div>
    
    <div class="col-sm-12">
        <div class="form-actions">
             <?php echo TbHtml::submitButton($visit->isNewRecord ? Yii::t('app','Save') : Yii::t('app','Save'),array(
               'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
               //'size'=>TbHtml::BUTTON_SIZE_SMALL,
           )); ?>
            <?php 
            echo TbHtml::linkButton('Completed Consult',array(
               'buttonType'=>'button',
               'type'=>'primary',
               'color' => TbHtml::BUTTON_COLOR_SUCCESS,
               'ajax'=>array(
                   'type'=>'post',
                   'dataType'=>'json',
                   //'beforeSend'=>"function() { $('.waiting').show(); }",
                   //'complete'=>"function() { $('.waiting').hide(); }",
                   'url'=>'#',
                   'success'=>'function (data) {                    
                    }'
                )
            ));
            ?>
        </div>  
    </div>

        
 <?php $this->endWidget(); ?>
    
</div>    
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
            success : function(data) {
                if(data.status=='success')
                {
                    $('#treatment_form').html(data.div_treatment_form);
                     //location.reload();
                }    
            }
        });
    });
"); 
?>

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
            success : function(data) {
                if(data.status=='success')
                {
                    $('#register_container').html(data.div_medicine_form);
                     //location.reload();
                }    
            }
        });
    });
"); 
?>

<?php
Yii::app()->clientScript->registerScript( 'deleteMedicine',"
        $('div#register_container').on('click','a.delete-item',function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url:url,
            dataType:'json',
            type:'post',    
            //beforeSend:function() { $('#loading').addClass('waiting'); },
            //complete:function() { $('#loading').removeClass('waiting'); },
            success:function(data) {
                if(data.status=='success')
                {
                    $('#register_container').html(data.div_medicine_form);
                }
            }
        });
    });
");
?>

<?php
$url = Yii::app()->createUrl('appointment/EditMedicine/');
Yii::app()->clientScript->registerScript( 'update_med_quatity',"
        $('tbody#medicine_contents').on('change','input.input-grid',function(e) {
        e.preventDefault();
        price=$('#Item_unit_price').val();
        var url = $(this).attr('href');
        $.ajax({
            url:'$url',
            dataType:'json',
            type:'post',  
            data : {price:treatment_id},
            //beforeSend:function() { $('#loading').addClass('waiting'); },
            //complete:function() { $('#loading').removeClass('waiting'); },
            success:function(data) {
                if(data.status=='success')
                {
                    $('#register_container').html(data.div_medicine_form);
                }
            }
        });
    });
");
?>
