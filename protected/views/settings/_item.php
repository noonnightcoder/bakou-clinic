<?php foreach ($values as $key => $val): ?>
    <div class="form-group"> 
        <?php echo CHtml::label($model->getAttributesLabels($key), $key, array('class'=>'col-sm-3 control-label no-padding-right')); ?>
        <div class="col-sm-9">
        <?php 
            if($key === 'itemExpireDate' ){
                echo CHtml::checkBox(get_class($model) . '[' . $category . '][' . $key . ']', $val); 
                echo '<span class="lbl"></span>'; 
            } else if ($key === 'itemNumberPerPage') {
                echo CHtml::dropDownList(get_class($model) . '[' . $category . '][' . $key . ']',$val,  Item::itemAlias('number_per_page'));
               
            } 
        ?>
        <?php echo CHtml::error($model, $category); ?>
        </div>    
    </div>
<?php endforeach; ?>
