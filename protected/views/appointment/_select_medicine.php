<?php
    $treatment_amount = Yii::app()->treatmentCart->getCart();
    $total_amount = 0;
    foreach ($treatment_amount as $val)
    {
        $total_amount +=$val['price']*Yii::app()->session['exchange_rate'];
    }
    
    $medicine_amount = Yii::app()->treatmentCart->getMedicine();
    
    foreach ($medicine_amount as $val)
    {
        $total_amount +=$val['price']*$val['quantity']*Yii::app()->session['exchange_rate'];
    }   

    $bloodtest_fee = VBloodtestPayment::model()->findall("visit_id=:visit_id",array(':visit_id'=>$visit_id));
    
    foreach ($bloodtest_fee as $val)
    {
        $total_amount +=$val['unit_price']*$val['exchange_rate'];
    } 
?>
<?php //print_r($medicine_selected_items); die(); ?>
<table class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="display:none">ID</th>
            <th>Medicine</th>
            <th>Dosage</th>
            <th>Consuming Time</th>
            <th>Duration</th>
            <!--<th>Frequency</th>-->
            <th>Instruction</th>
            <th>Comment</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="medicine_contents">
        <?php //print_r($medicine_selected_items); ?>        
        <?php foreach ($medicine_selected_items as $id => $item): ?>
        <?php $item_id=$item['id']; ?>
        <tr>
            <!--<td style="display:none"> 
                <?php //echo $item['id']; ?><br/>                        
            </td>-->
            <td style="display:none">
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                        'method'=>'post',
                        'action' => Yii::app()->createUrl('appointment/EditMedicine?medicine_id='.$item_id.'&visit_id='.$visit_id),
                        'htmlOptions'=>array('class'=>'line_item_form'),
                    ));
                ?>
                <?php echo $form->textField($medicine, "id", array('value' => $item['id'], 'class' => 'input-small input-grid', 'id' => "id_$item_id", 'placeholder' => 'Price', 'maxlength' => 10)); ?>
                <?php $this->endWidget(); ?>    
            </td>    
            <td> 
                <?php echo $item['name']; ?><br/>                        
            </td>            
            <td>
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                        'method'=>'post',
                        'action' => Yii::app()->createUrl('appointment/EditMedicine?medicine_id='.$item_id.'&visit_id='.$visit_id),
                        'htmlOptions'=>array('class'=>'line_item_form'),
                    ));
                ?>
                <?php echo $form->textField($medicine, "dosage", array('value' => $item['dosage'],'class' => 'input-small numeric input-grid', 'id' => "dosage_$item_id", 'placeholder' => 'Dosage', 'data-id' => "$item_id", 'maxlength' => 50,)); ?>
                <?php $this->endWidget(); ?>  
            </td>
            
            <td>                
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                        'method'=>'post',
                        'action' => Yii::app()->createUrl('appointment/EditMedicine?medicine_id='.$item_id.'&visit_id='.$visit_id),
                        'htmlOptions'=>array('class'=>'line_item_form'),
                    ));
                ?>                  
                <?php $medicine->consuming_time_id = $item['consuming_time_id']?>
                <?php echo $form->dropDownList($medicine,'consuming_time_id',
                         CHtml::listData(ConsumingTime::model()->findall(), 'id', 'consuming_time'),array('class' => 'input-small numeric input-grid','style'=>"width:150px;")); ?>
                <?php $this->endWidget(); ?> 
            </td>
            
            <td>
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                        'method'=>'post',
                        'action' => Yii::app()->createUrl('appointment/EditMedicine?medicine_id='.$item_id.'&visit_id='.$visit_id),
                        'htmlOptions'=>array('class'=>'line_item_form'),
                    ));
                ?>                
                <?php $medicine->duration = $item['duration']?>
                <?php echo $form->dropDownList($medicine,'duration',
                         CHtml::listData(UsageDuration::model()->findall(), 'id', 'duration'),array('class' => 'input-small numeric input-grid')); ?>
                <?php $this->endWidget(); ?>  
            </td>
            
            <!--<td>
                <?php /*$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                        'method'=>'post',
                        'action' => Yii::app()->createUrl('appointment/EditMedicine?medicine_id='.$item_id),
                        'htmlOptions'=>array('class'=>'line_item_form'),
                    ));*/
                ?>
                <?php //echo $form->textField($medicine, "frequency", array('value' => $item['frequency'],'class' => 'input-small numeric input-grid', 'id' => "frequency_$item_id", 'placeholder' => 'frequency', 'data-id' => "$item_id", 'maxlength' => 50, 'style'=>"width:50px;")); ?>
                <?php //$this->endWidget(); ?>  
            </td>-->   
            <td>
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                        'method'=>'post',
                        'action' => Yii::app()->createUrl('appointment/EditMedicine?medicine_id='.$item_id.'&visit_id='.$visit_id),
                        'htmlOptions'=>array('class'=>'line_item_form'),
                    ));
                ?>
                <?php $medicine->instruction_id = $item['instruction_id']?>
                <?php echo $form->dropDownList($medicine,'instruction_id',
                         CHtml::listData(Instruction::model()->findall(), 'id', 'description_khmer'),array('class' => 'input-small numeric input-grid','style'=>"width:200px;")); ?>
                <?php $this->endWidget(); ?>  
            </td>
            <td>
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                        'method'=>'post',
                        'action' => Yii::app()->createUrl('appointment/EditMedicine?medicine_id='.$item_id.'&visit_id='.$visit_id),
                        'htmlOptions'=>array('class'=>'line_item_form'),
                    ));
                ?>
                <?php //$item['comment']='dfdfd'; ?>
                <?php echo $form->textField($medicine, "comment", array('value' => $item['comment'], 'class' => 'input-small numeric input-grid','id' => "comment_$item_id", 'placeholder' => 'comment', 'data-id' => "$item_id", 'maxlength' => 200,'style'=>"width:100px;")); ?>
                <?php $this->endWidget(); ?>  
            </td>
            
            <td>
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                        'method'=>'post',
                        'action' => Yii::app()->createUrl('appointment/EditMedicine?medicine_id='.$item_id.'&visit_id='.$visit_id),
                        'htmlOptions'=>array('class'=>'line_item_form'),
                    ));
                ?>
                <?php echo $form->textField($medicine, "unit_price", array('value' => $item['price'], 'class' => 'input-small numeric input-grid', 'id' => "price_$item_id", 'placeholder' => 'Price', 'data-id' => "$item_id", 'maxlength' => 50, )); ?>
                <?php $this->endWidget(); ?>  
            </td> 
            <td>
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                        'method'=>'post',
                        'action' => Yii::app()->createUrl('appointment/EditMedicine?medicine_id='.$item_id.'&visit_id='.$visit_id),
                        'htmlOptions'=>array('class'=>'line_item_form'),
                    ));
                ?>
                <?php echo $form->textField($medicine, "quantity", array('value' => $item['quantity'], 'class' => 'input-small numeric input-grid', 'id' => "quantity_$item_id", 'placeholder' => 'Price', 'data-id' => "$item_id", 'maxlength' => 50,)); ?>
                <?php $this->endWidget(); ?>
            </td>
            <td> 
                <?php echo $item['price']*$item['quantity']; ?><br/>                        
            </td>
            <td><?php
                        echo TbHtml::linkButton('', array(
                            'color'=>TbHtml::BUTTON_COLOR_WARNING,
                            'size' => TbHtml::BUTTON_SIZE_MINI,
                            'icon' => 'ace-icon fa fa-eraser',
                            'url' => array('DeleteMedicine', 'medicine_id' => $item_id,'visit_id'=>$visit_id),
                            //'label'=>'delete',
                            'class' => 'delete-item',
                            'title' =>  'Remove',                            
                        ));
                        ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
    if (empty($medicine_selected_items)) {
        echo Yii::t('app', 'There are no medicine select');
    }
?> 
<script>
    var submitting = false;
    var url = $(this).attr('href');
    $(document).ready(function()
    {
        $('.waiting').hide();
        
        $('.line_item_form').ajaxForm({target: "#select_medicine_form", beforeSubmit: salesBeforeSubmit});
        
        $('#medicine_contents').on('change','.input-grid',function(e) {
            e.preventDefault();
            $(this.form).ajaxSubmit({url: url,target: "#select_medicine_form", beforeSubmit: salesBeforeSubmit });
        });
    });
    
    /*$(document).ready(function()
    {
        $('.line_item_form').ajaxForm({target: "#register_container", beforeSubmit: salesBeforeSubmit});
        
        $('#medicine_contents').on('change','input.input-grid',function(e) {
            e.preventDefault();
            $(this.form).ajaxSubmit({target: "#register_container", beforeSubmit: salesBeforeSubmit });
        });
    });*/
    
    function salesBeforeSubmit(formData, jqForm, options)
    {
        if (submitting)
        {
            return false;
        }
        submitting = true;
        $('.waiting').show();
    }
    /*$(document).ready(function()
    {
        $('#medicine_contents').on('change','input.input-grid',function(e) {
            e.preventDefault();
            $(this.form).ajaxSubmit({target: "#register_container", beforeSubmit: salesBeforeSubmit });
        });
    });*/
    
</script>
<script>    
    $(document).ready(function() {
        $('#show-payment-modal').on('shown.bs.modal', function() {
            $('#Appointment_total_amount').val('<?php echo number_format((float)@$total_amount, 4, '.', ''); ?>');
        });
        
        $('#show-payment-modal').on('shown.bs.modal', function() {
            $('#Appointment_actual_amount').val('<?php echo number_format((float)@$total_amount, 4, '.', ''); ?>');
        });
    
        $('#show-payment-modal').on('hidden.bs.modal', function(e) {
            $('#show-payment-modal').val('');
        });
    });
</script>