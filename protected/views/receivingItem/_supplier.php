<?php $this->widget( 'ext.modaldlg.EModalDlg' ); ?> 
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'supplier_form',
        'method'=>'post',
	'action' => Yii::app()->createUrl('receivingItem/selectSupplier/'),
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>
        
        <?php 
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'model'=>$model,
                    'attribute'=>'supplier_id',
                    'source'=>$this->createUrl('request/suggestSupplier'), 
                    'htmlOptions'=>array(
                        'size'=>'40'
                    ),
                    'options'=>array(
                        'showAnim'=>'fold',
                        'minLength'=>'1',
                        'delay' => 10,
                        'autoFocus'=> false,
                        'select'=>'js:function(event, ui) {
                            event.preventDefault();
                            $("#ReceivingItem_supplier_id").val(ui.item.id);
                            $("#supplier_form").ajaxSubmit({target: "#register_container", beforeSubmit: receivingsBeforeSubmit});
                        }',
                    ),
                ));
        ?>  

       <?php echo TbHtml::linkButton(Yii::t( 'app', 'New' ),array(
            'color'=>TbHtml::BUTTON_COLOR_INFO,
            'size'=>TbHtml::BUTTON_SIZE_SMALL,
            'icon'=>'glyphicon-plus white',
            'url'=>$this->createUrl('Supplier/Create/',array('recv_mode'=>'Y','trans_mode'=>$trans_mode)),
        )); ?>

        <div id="comment_content">
            <?php //echo $form->textFieldControlGroup($model,'comment',array('rows'=>1, 'cols'=>10,'class'=>'span1','maxlength'=>250,'id'=>'comment_id')); ?>
        </div>
             
<?php $this->endWidget(); ?>

