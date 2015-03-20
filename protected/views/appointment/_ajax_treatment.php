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
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                        'method'=>'post',
                        //'action' => Yii::app()->createUrl('appointment/EditTreatment?Treatment_id='.$item_id),
                        'htmlOptions'=>array('class'=>'line_treatment_form'),
                    ));
                ?>
                <?php echo $form->textField($treatment, "id", array('value' => $item['id'], 'class' => 'input-small numeric input-grid', 'id' => "id_$item_id")); ?>    
                <?php $this->endWidget(); ?>
            </td>
            <td> 
                <?php echo $item['treatment']; ?><br/>                        
            </td>
            <td>
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                        'method'=>'post',
                        'action' => Yii::app()->createUrl('appointment/EditTreatment?treatment_id='.$item_id),
                        'htmlOptions'=>array('class'=>'line_treatment_form'),
                    ));
                ?>
                <?php echo $form->textField($treatment, "price", array('value' => $item['price'], 'class' => 'input-small numeric input-grid', 'id' => "price_$item_id", 'placeholder' => 'Price', 'data-id' => "$item_id", 'maxlength' => 50,)); ?>
                <?php $this->endWidget(); ?>
            </td>
            <td>
                <?php
                    echo TbHtml::linkButton('', array(
                        'color'=>TbHtml::BUTTON_COLOR_DANGER,
                        'size' => TbHtml::BUTTON_SIZE_MINI,
                        'icon' => 'glyphicon glyphicon-trash ',
                        'url' => array('DeleteTreatment', 'treatment_id' => $item_id),
                        //'label'=>'delete',
                        'class' => 'delete-treatment',
                        'title' =>  'Remove',                            
                    ));
                ?>
                <?php
                /*echo TbHtml::linkButton('', array(
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
                ));*/
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>  
<?php
    if (empty($treatment_selected_items)) {
        echo Yii::t('app', 'There are no treatment select');
    }
?> 

<script>
    var submitting = false;
    var url = $(this).attr('href');
    $(document).ready(function()
    {
        $('.waiting').hide();
        
        $('.line_treatment_form').ajaxForm({target: "#select_treatment_form", beforeSubmit: treatmentBeforeSubmit});
        
        $('#treatment_contents').on('change','input.input-grid',function(e) {
            e.preventDefault();
            $(this.form).ajaxSubmit({url: url,target: "#select_treatment_form", beforeSubmit: treatmentBeforeSubmit });
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
    
    function treatmentBeforeSubmit(formData, jqForm, options)
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
