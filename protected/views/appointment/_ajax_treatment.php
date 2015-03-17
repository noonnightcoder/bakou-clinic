<?php /*$form=$this->beginWidget('\TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
));*/ ?>
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
                <?php //echo $form->textField($treatment, "id", array('value' => $item['id'], 'class' => 'input-small numeric input-grid', 'id' => "id_$item_id")); ?> 
                <input value="<?php echo $item['id']; ?>" class="input-small numeric input-grid form-control" id="id_<?php echo $item_id; ?>" name="Treatment[id]" type="text" />
            <td> 
                <?php echo $item['treatment']; ?><br/>                        
            </td>
            <td>
                <?php //echo $form->textField($treatment, "price", array('value' => $item['price'], 'class' => 'input-small numeric input-grid', 'id' => "price_$item_id", 'placeholder' => 'Price', 'data-id' => "$item_id", 'maxlength' => 50, 'onkeypress' => 'return isNumberKey(event)')); ?>
                <input value="<?php echo $item['price']; ?>" class="input-small numeric input-grid form-control" id="price_<?php echo $item_id; ?>" placeholder="Price" data-id="2" maxlength="50" onkeypress="return isNumberKey(event)" name="Treatment[price]" type="text" />
            </td>
            <td><?php
                        echo TbHtml::linkButton('', array(
                            'color'=>TbHtml::BUTTON_COLOR_DANGER,
                            'size' => TbHtml::BUTTON_SIZE_MINI,
                            'icon' => 'glyphicon glyphicon-trash ',
                            'url' => array('DeleteTreatment', 'treatment_id' => $item_id),
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
    if (empty($treatment_selected_items)) {
        echo Yii::t('app', 'There are no treatment in the cart');
    }
?> 
<?php //$this->endWidget(); ?> 
<?php
Yii::app()->clientScript->registerScript( 'deleteTreatment',"
        $('div#treatment_form').on('click','a.delete-item',function(e) {
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
                    $('#treatment_form').html(data.div_treatment_form);
                }
            }
        });
    });
");
?>