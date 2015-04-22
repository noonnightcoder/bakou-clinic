<style>
.btn-group {
  display: flex !important;
}
</style>
<div class="row" id="bill-payment-form">
<div class="col-xs-12 col-sm-8 widget-container-col">
<?php
/* @var $this ContactController */
/* @var $model Contact */
    $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
                  'title' => 'Patient: '.TbHtml::labelTb($patient_name, array('color' => TbHtml::LABEL_COLOR_SUCCESS)),
                      'headerIcon' => 'ace-icon fa fa-users',
                  'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
    ));
?>         
<?php
/* @var $this AppointmentController */
/* @var $model Appointment */
$this->breadcrumbs=array(
            Yii::t('menu','Prescription Bill')=>array('prescription'),
            Yii::t('app','Bill Detail'),
    );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#appointment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php if(Yii::app()->user->hasFlash('success')):?>
        <?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<?php endif; ?>

<?php $this->widget('yiiwheels.widgets.grid.WhGridView',array(
            'id'=>'waiting-queue',
            'dataProvider'=>$model->showPrescriptionDetail($visit_id),
            'htmlOptions'=>array('class'=>'table-responsive panel'),
            'template' => "{items}",
            'columns'=>array(
                array('name'=>'id',
                       'header'=>'#', 
                ),
                array('name'=>'patient_id',
                        'headerHtmlOptions' => array('style' => 'display:none'),
                        'htmlOptions' => array('style' => 'display:none'),
                ),
                array('name'=>'visit_id',
                        'headerHtmlOptions' => array('style' => 'display:none'),
                        'htmlOptions' => array('style' => 'display:none'),
                ),
                //'patient_id',
                //'patient_name',
                /*array('name'=>'fullname',
                       'header'=>'Patient Name', 
                ),*/
                array('name'=>'visit_date',
                       'header'=>'Visit Date', 
                ),
		//'appointment_date',
                array('name'=>'item',
                       'header'=>'Item', 
                ),
		array('name'=>'quantity',
                        'header'=>'Quantity', 
                        'value'=> 'round($data["quantity"])'
                ),
                //'status',
                array('name'=>'unit_price',
                        'header'=>'Total', 
                        'value'=> 'number_format($data["unit_price"], 2, ".", ",")'
                ),
                array('name'=>'info',
                       'header'=>'Information', 
                ),
	),
)); ?>
<?php $this->endWidget(); ?>
</div>
<div class="col-xs-12 col-sm-4 widget-container-col">
    <div class="row">
        <div class="sidebar-nav" id="payment_cart">
            <?php if ($count_item <> 0) { ?>
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'finish_sale_form',
                        'action' => Yii::app()->createUrl('appointment/completeSale?visit_id='.$visit_id),
                        'enableAjaxValidation' => false,
                        'layout' => TbHtml::FORM_LAYOUT_INLINE,
                    ));
                    ?>
                        <table class="table table-bordered table-condensed">
                            <tbody id="payment-form">
                                <tr>
                                    <td style="display:none">
                                        <input type="text" name="amount" value="<?php echo @$amount; ?>">
                                    </td>
                                </tr>
                               <!-- <tr>
                                    <td><?php /*echo Yii::t('app', 'Item Select'); */?> :</td>
                                    <td><?php /*echo $count_item; */?></td>
                                </tr>  -->
                                <tr>
                                    <td><?php echo Yii::t('app', 'Total'); ?> :</td>
                                    <td>
                                        <span class="badge badge-info bigger-120">
                                            <?php echo Yii::app()->settings->get('site', 'currencySymbol').number_format(@$amount, 2, '.', ','); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo Yii::t('app', 'Amount to Pay'); ?> :</td>
                                    <td>
                                        <span class="badge badge-warning bigger-120">
                                            <?php echo Yii::app()->settings->get('site', 'currencySymbol').number_format(@$actual_amount, 2, '.', ','); ?>
                                        </span>
                                    </td>
                                </tr>
                                <!--<tr>
                                    <td><?php echo Yii::t('app', 'Total in KHR'); ?> :</td>
                                    <td>
                                        <span class="badge badge-success bigger-120">
                                            <?php //echo @$amount*4000 ?>
                                        </span>
                                    </td>
                                </tr> --->
                                <?php if ($count_payment > 0) { ?>
                                    <?php foreach ($payments as $id => $payment): ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo TbHtml::linkButton('', array(
                                                'size' => TbHtml::BUTTON_SIZE_MINI,
                                                'color' => TbHtml::BUTTON_COLOR_DANGER,
                                                'icon' => 'glyphicon-remove',
                                                'url' => Yii::app()->createUrl('appointment/DeletePayment', array('visit_id' => $payment['visit_id'])),
                                                'class' => 'delete-payment pull-right',
                                                'title' => Yii::t('app', 'Delete Payment'),
                                            ));
                                            ?>  
                                            <?php echo Yii::t('App','Paid Amount[Cash]'); ?></td>
                                        <td>
                                            <span class="badge badge-success bigger-120">
                                                <?php echo number_format($payment['payment_amount'], 2, '.', ','); ?><?php //echo $payment['payment_amount']*4000; ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
                                <?php if (@$count_payment == 0) { ?>                                     
                                    <tr>
                                        <td colspan="2" style='text-align:right'><?php
                                            echo TbHtml::linkButton(Yii::t('app', 'Add Payment'), array(
                                                'color' => TbHtml::BUTTON_COLOR_INFO,
                                                'size' => TbHtml::BUTTON_SIZE_MINI,
                                                'icon' => 'glyphicon-plus white',
                                                'url' => Yii::app()->createUrl('appointment/AddPayment?visit_id='.$visit_id),
                                                'class' => 'add-payment',
                                                //'title' => Yii::t('app', 'Add Payment'),
                                            ));
                                            ?>   
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <?php if (@$count_payment > 0) { ?>
                            <table class="table table-striped table-condensed">
                                        <td colspan="3" style='text-align:right'>
                                        <?php
                                        echo TbHtml::linkButton(Yii::t('app', 'Complete Payment'), array(
                                            'color' => TbHtml::BUTTON_COLOR_SUCCESS,
                                            'icon' => 'glyphicon glyphicon-off white',
                                            //'url' => Yii::app()->createUrl('appointment/CompleteSale/'),
                                            'class' => 'complete-sale',
                                            'id' => 'finish_sale_button',
                                            //'title' => Yii::t('app', 'Complete Sale'),
                                        ));
                                        ?>        
                                        </td>
                                    <?php //} ?>

                                </tbody>
                            </table>
                    <?php } ?>

                <?php $this->endWidget(); ?> 
             <?php } ?>    

        </div> <!-- /section:custom/widget-main -->    

    </div> <!-- payment cart -->
</div>    
    
</div>

<div class="waiting"><!-- Place at bottom of page --></div>

<script>
$(document).ready(function()
{
     $('#payment_cart').on('click','a.complete-sale',function(e) {
        e.preventDefault();
        $("#finish_sale_button").hide();
        $('#finish_sale_form').submit();
    });
 });
</script>

<?php 
    Yii::app()->clientScript->registerScript( 'addPayment', "
        jQuery( function($){
            $('tbody#payment-form').on('click','a.add-payment',function(e) {
                e.preventDefault();
                var url=$(this).attr('href');
                $.ajax({
                    url:url,
                    type : 'post',
                    beforeSend: function() { $('.waiting').show(); },
                    complete: function() { $('.waiting').hide(); },
                    success : function(data) {
                        $('#bill-payment-form').html(data);
                    }
                });
            });
        });
      ");
 ?> 

<?php 
    Yii::app()->clientScript->registerScript( 'deletePayment', "
        jQuery( function($){
            $('tbody#payment-form').on('click','a.delete-payment',function(e) {
                e.preventDefault();
                var url=$(this).attr('href');
                $.ajax({
                    url:url,
                    type : 'post',
                    beforeSend: function() { $('.waiting').show(); },
                    complete: function() { $('.waiting').hide(); },
                    success : function(data) {
                        $('#bill-payment-form').html(data);
                    }
                });
            });
        });
      ");
 ?> 

