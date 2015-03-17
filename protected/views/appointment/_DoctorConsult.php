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
                'id'=>'add_treatment',
        )); ?>

    <!--<p class="help-block">Fields with <span class="required">*</span> are required.</p>--->           
                
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
    <!--<div class="form-group"><label class="col-sm-3 control-label" for="treatment">Treatment</label> 
    <div class="col-md-5">
        <?php 
            /*$this->widget('yiiwheels.widgets.multiselect.WhMultiSelect', 
                    array(
                        'model'=> $treatment,
                        'attribute'=> 'id',
                        //'name'=>'Treatment[id][][]',
                        'data' => CHtml::listData(Treatment::model()->findAll(), 'id','treatment'),
                        'pluginOptions' => array(
                            //'width' => '100%'
                            //'span' => 5
                        )
                    )
                );*/
        ?>
    </div>
    </div>--->
    <div class="form-group"><label class="col-sm-3 control-label" for="treatment"></label> 
    <div class="col-md-5">
    <?php $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
        'title' => 'Select Treatment',
        'headerIcon' => 'icon-user',
        'headerButtons' => array(
            $this->renderpartial('_select_treatment',array('treatment'=>$treatment,'treatment_items'=>$treatment_items,),true)
        ),
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
                            'url' => '#',
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
                echo Yii::t('app', 'There are no items in the cart');
            }
        ?>    
        </div>
    <?php $this->endWidget(); ?>  
    </div> 
    </div>
    <div class="col-sm-12">
    <div class="form-actions">
         <?php echo TbHtml::submitButton($visit->isNewRecord ? Yii::t('app','Submit Treatment') : Yii::t('app','Save'),array(
           'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
           //'size'=>TbHtml::BUTTON_SIZE_SMALL,
       )); ?>        
    </div>  
    </div>    
<?php $this->endWidget(); ?>
