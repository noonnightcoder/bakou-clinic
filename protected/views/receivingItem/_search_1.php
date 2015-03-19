<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox',array(
        'title'         =>  Yii::t('app',$trans_header),
        'headerIcon'    => 'ace-icon fa fa-cloud-download',
        'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
        'headerButtons' => array(
            TbHtml::buttonGroup(
                array(
                    array('label' => Yii::t('app','New Item'),'url' =>Yii::app()->createUrl('Item/createImage',array('grid_cart'=>'R')),'icon'=>'glyphicon-plus white'),
                    //array('label'=>' '),
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
                    $("#add_item_form").ajaxSubmit({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: itemScannedSuccess});
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


<?php 
    Yii::app()->clientScript->registerScript( 'removeSupplier', "
        jQuery( function($){
            $('#supplier_cart').on('click','a.detach-customer', function(e) {
                e.preventDefault();
                var supplierCart=$('#supplier_cart');
                $.ajax({url: 'RemoveSupplier',
                        dataType : 'json',
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                                if (data.status==='success')
                                {
                                    //supplierCart.html(data.div_suppliercart);
                                    location.reload(true); 
                                }
                                else 
                                {
                                   console.log(data.message);
                                }
                          }
                    });
                });
        });
      ");
 ?> 

<?php 
    Yii::app()->clientScript->registerScript( 'cancelRecv', "
        jQuery( function($){
            $('#task_cart').on('click','a.cancel-recv',function(e) {
                e.preventDefault();
                if (!confirm('Are you sure you want to clear this transaction? All items will cleared.'))
                {
                  return false;
                }
                var url=$(this).attr('href');
                var gridCart=$('#grid_cart');
                var message=$('.message');
                var supplierCart=$('#supplier_cart');
                $.ajax({url:url,
                        dataType : 'json',
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                                if (data.status==='success')
                                {
                                    message.hide();
                                    gridCart.html(data.div_gridcart);
                                    $('#task_cart').html(data.div_taskcart);
                                }
                                else 
                                {
                                   console.log(data.div);
                                }
                          }
                    });
                });
        });
      ");
 ?>  
 <?php 
    Yii::app()->clientScript->registerScript( 'setComment', "
        jQuery( function($){
            $('#comment_content').on('change','#comment_id',function(e) {
                e.preventDefault();
                var comment=$(this).val();
                $.ajax({
                        url: 'SetComment',
                        dataType : 'json',
                        data : {comment : comment},
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                                if (data.status==='success')
                                {
                                    console.log('comment saved');
                                    
                                }    
                                else
                                {
                                    alert('someting wrong');
                                    return false;
                                }
                       }
                 });
            });
        });
      "); 
 ?> 

<?php 
    Yii::app()->clientScript->registerScript( 'completeRecv', "
        jQuery( function($){
            $('#task_cart').on('click','a.complete-recv',function(e) {
                e.preventDefault();
                if (!confirm('Are you sure you want to submit this transaction? This cannot be undone.'))
                {
                  return false;
                }
                var url=$(this).attr('href');
                var message=$('.message');
                $.ajax({url:url,
                        dataType : 'json',
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {                    
                            if (data.status==='success')
                            {
                                window.location.href=data.div_receipt;
                            }
                            else if (data.status ==='failed')
                            {
                                message.slideToggle();
                                message.html(data.message);
                                message.show();
                                return false;
                            }
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
    $('#add_item_form').ajaxForm({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: itemScannedSuccess});
        

});

function salesBeforeSubmit(formData, jqForm, options)
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
    //$('.waiting').hide();
    setTimeout(function(){$('#ReceivingItem_item_id').focus();}, 10);
} 

</script>