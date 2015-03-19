<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'supplier_selected_form',
	 'action'=>Yii::app()->createUrl('receivingItem/removeSupplier/'),
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>
        
        <?php //echo TbHtml::labelTb($supplier . ' - ' . $supplier_mobile_no, array('color' => TbHtml::LABEL_COLOR_INFO)); ?>

         <div class="clear">
            <ul class="list-unstyled">
                <li>
                    <strong>
                        <?php echo ucwords($supplier->first_name . ' ' . $supplier->last_name) . ' - ' . $supplier->company_name; ?>
                    </strong>
                </li>
            </ul>
        </div>

        <?php echo TbHtml::linkButton(Yii::t( 'app', 'Edit' ),array(
            'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
            'size'=>TbHtml::BUTTON_SIZE_MINI,
            'icon'=>'glyphicon-edit white',
            'class'=>'btn btn-sm edit-supplier',
            'url'=>Yii::app()->createUrl("supplier/Update/",array("id"=>$supplier->id,'recv_mode'=>'Y','trans_mode'=>$trans_mode)),
        )); ?>

        <?php echo TbHtml::linkButton(Yii::t( 'app', 'Remove' ),array(
            'color'=>TbHtml::BUTTON_COLOR_WARNING,
            'size'=>TbHtml::BUTTON_SIZE_MINI,
            'icon'=>'glyphicon-remove white',
            'class'=>'btn btn-sm detach-supplier',
        )); ?>
          
<?php $this->endWidget(); ?>
