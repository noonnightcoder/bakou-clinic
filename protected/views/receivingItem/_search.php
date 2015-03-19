<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox',array(
        'title'         =>  Yii::t('app',$trans_header),
        'headerIcon'    => 'ace-icon fa fa-cloud-download',
        'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
        'headerButtons' => array(
            TbHtml::buttonGroup(
                array(
                    array('label' => Yii::t('app','New Item'),'url' =>Yii::app()->createUrl('Item/createImage',array('grid_cart'=>'R')),'icon'=>'glyphicon-plus white'),
                ),array('color'=>TbHtml::BUTTON_COLOR_SUCCESS,'size'=>TbHtml::BUTTON_SIZE_SMALL)
            ),
        )
));
?>
<div id="itemlookup">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
            'action'=>Yii::app()->createUrl('receivingItem/add'),
            'method'=>'post',
            'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
            'id'=>'add_item_form',
    )); ?> 

        <?php 
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'model'=>$model,
                'attribute'=>'item_id',
                'source'=>$this->createUrl('request/suggestItem'),
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
                        $("#ReceivingItem_item_id").val(ui.item.id);
                        $("#add_item_form").ajaxSubmit({target: "#register_container", beforeSubmit: receivingsBeforeSubmit, success: itemScannedSuccess});
                    }',
                ),
            ));
        ?>

        <?php /* echo TbHtml::linkButton('',array(
            'color'=>TbHtml::BUTTON_COLOR_INFO,
            'size'=>TbHtml::BUTTON_SIZE_SMALL,
            'icon'=>'glyphicon-hand-up white',
            'url'=>$this->createUrl('Item/SelectItemRecv/'),
            'class'=>'update-dialog-open-link',
            'data-update-dialog-title' => Yii::t('app','Select Items'),
        )); */?>

    <?php $this->endWidget(); ?>
</div>

<?php $this->endWidget(); ?>

<?php Yii::app()->clientScript->registerScript('setFocus', '$("#ReceivingItem_item_id").focus();'); ?>
 
<?php 
    Yii::app()->clientScript->registerScript( 'deleteItem', "
        jQuery( function($){
            $('div#grid_cart').on('click','a.delete-item',function(e) {
                e.preventDefault();
                var url=$(this).attr('href');
                $.ajax({url:url,
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                            $('#register_container').html(data);
                          }
                    });
                });
        });
      ");
 ?>  

<script>
    
var submitting = false;  

$(document).ready(function()
{   
    //Here just in case the loader doesn't go away for some reason
    $('.waiting').hide();
    
    // ajaxForm to ensure is submitting as Ajax even user press enter key
    $('#add_item_form').ajaxForm({target: "#register_container", beforeSubmit: receivingsBeforeSubmit, success: itemScannedSuccess});
    
    $('.line_item_form').ajaxForm({target: "#register_container", beforeSubmit: receivingsBeforeSubmit }); 
    
    $('#cart_contents').on('change','input.input-grid',function(e) {
        e.preventDefault();
        $(this.form).ajaxSubmit({target: "#register_container", beforeSubmit: receivingsBeforeSubmit });
    });
        
    $('#cancel_cart').on('click','#cancel_receiving_button',function(e) {
      e.preventDefault();
      if (confirm("<?php echo Yii::t('app','Are you sure you want to clear this receiving? All items will cleared.'); ?>")){
            $('#cancel_recv_form').ajaxSubmit({target: "#register_container", beforeSubmit: receivingsBeforeSubmit});
        } 
    });   
    
    $('#supplier_cart').on('click','a.detach-supplier', function(e) {
        e.preventDefault();
        $('#supplier_selected_form').ajaxSubmit({target: "#register_container", beforeSubmit: receivingsBeforeSubmit});
    });
});

function receivingsBeforeSubmit(formData, jqForm, options)
{
    if (submitting)
    {
        return false;
    }
    submitting = true;
    $('.waiting').show();
}   

function itemScannedSuccess(responseText, statusText, xhr, $form)
{
    setTimeout(function(){$('#ReceivingItem_item_id').focus();}, 10);
} 

</script>