<?php //print_r($medicine_selected_items); die(); ?>
<table class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="display:none">ID</th>
            <th>Medicine Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="medicine_contents">
        <?php //$treatment_selected_items =array(); ?>
        <?php foreach ($medicine_selected_items as $id => $item): ?>
        <?php $item_id=$item['id']; ?>
        <tr>
            <!--<td style="display:none"> 
                <?php //echo $item['id']; ?><br/>                        
            </td>-->
            <td style="display:none">
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                        'method'=>'post',
                        //'action' => Yii::app()->createUrl('appointment/EditMedicine/'),
                        'htmlOptions'=>array('class'=>'line_item_form'),
                    ));
                ?>
                <!--<input value="<?php //echo $item['id']; ?>" class="input-small numeric input-grid form-control" id="id_<?php //echo $item_id; ?>" name="item[id]" type="text" />-->
                <?php echo $form->textField($medicine, "id", array('value' => $item['id'], 'class' => 'input-small input-grid', 'id' => "id_$item_id", 'placeholder' => 'Price', 'maxlength' => 10)); ?>
                <?php $this->endWidget(); ?>    
            </td>    
            <td> 
                <?php echo $item['name']; ?><br/>                        
            </td>
            <td>
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                        'method'=>'post',
                        //'action' => Yii::app()->createUrl('appointment/EditMedicine/'),
                        'htmlOptions'=>array('class'=>'line_item_form'),
                    ));
                ?>
                <?php echo $form->textField($medicine, "unit_price", array('value' => $item['price'], 'class' => 'input-small numeric input-grid', 'id' => "price_$item_id", 'placeholder' => 'Price', 'data-id' => "$item_id", 'maxlength' => 50, )); ?>
                <!--<input value="<?php //echo $item['price']; ?>" class="input-small numeric input-grid form-control" id="price_<?php //echo $item_id; ?>" placeholder="Price" data-id="2" maxlength="50" onkeypress="return isNumberKey(event)" name="item[price]" type="text" />-->
                <?php $this->endWidget(); ?>  
            </td>
            <td>
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                        'method'=>'post',
                        //'action' => Yii::app()->createUrl('appointment/EditMedicine/'),
                        'htmlOptions'=>array('class'=>'line_item_form'),
                    ));
                ?>
                <?php echo $form->textField($medicine, "quantity", array('value' => $item['quantity'], 'class' => 'input-small numeric input-grid', 'id' => "quantity_$item_id", 'placeholder' => 'Price', 'data-id' => "$item_id", 'maxlength' => 50, )); ?>
                <!--<input value="<?php //echo $item['quantity']; ?>" class="input-small numeric input-grid form-control" id="price_<?php //echo $item_id; ?>" placeholder="Price" data-id="2" maxlength="50" onkeypress="return isNumberKey(event)" name="item[quatity]" type="text" />--->
                <?php $this->endWidget(); ?>
            </td>
            <td><?php
                        echo TbHtml::linkButton('', array(
                            'color'=>TbHtml::BUTTON_COLOR_DANGER,
                            'size' => TbHtml::BUTTON_SIZE_MINI,
                            'icon' => 'glyphicon glyphicon-trash ',
                            'url' => array('DeleteMedicine', 'medicine_id' => $item_id),
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