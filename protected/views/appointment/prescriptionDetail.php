<style>
.btn-group {
  display: flex !important;
}
</style>
<div class="row" id="contact">
<div class="col-xs-12 col-sm-8 widget-container-col">
<?php
/* @var $this ContactController */
/* @var $model Contact */
    $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
                  'title' => Yii::t('app','Prescription Detail'),
                  'headerIcon' => 'ace-icon fa fa-users',
                  'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
    ));
?>         
<?php
/* @var $this AppointmentController */
/* @var $model Appointment */
$this->breadcrumbs=array(
            Yii::t('menu','Appoionment')=>array('prescription'),
            Yii::t('app','Manage'),
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

<?php $this->widget('bootstrap.widgets.TbGridView',array(
            'id'=>'waiting-queue',
            'dataProvider'=>$model->showBillDetail($visit_id),
            //'htmlOptions'=>array('class'=>'table-responsive panel'),
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
                array('name'=>'fullname',
                       'header'=>'Patient Name', 
                ),
                array('name'=>'visit_date',
                       'header'=>'Visit Date', 
                ),
		//'appointment_date',
                array('name'=>'item',
                       'header'=>'Item', 
                ),
		array('name'=>'quantity',
                       'header'=>'Quantity', 
                ),
                //'status',
                array('name'=>'unit_price',
                       'header'=>'Price', 
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
            <?php $count_item=2;if ($count_item <> 0) { ?>
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'finish_sale_form',
                        //'action' => Yii::app()->createUrl('appointment/completeSale/'),
                        'enableAjaxValidation' => false,
                        'layout' => TbHtml::FORM_LAYOUT_INLINE,
                    ));
                    ?>
                        <table class="table table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td><?php echo Yii::t('app', 'Item Select'); ?> :</td>
                                    <td><?php $count_payment =0; echo $count_item; ?></td>
                                </tr>                                
                                <tr>
                                    <td><?php echo Yii::t('app', 'Total'); ?> :</td>
                                    <td><span class="badge badge-info bigger-120"><?php //echo Yii::app()->settings->get('site', 'currencySymbol') . number_format($total, Yii::app()->shoppingCart->getDecimalPlace(), '.', ','); ?></span></td>
                                </tr>
                                 <tr>
                                    <td><?php echo Yii::t('app', 'Total in KHR'); ?> :</td>
                                    <td><span class="badge badge-success bigger-120">
                                         <?php //echo Yii::app()->settings->get('site', 'altcurrencySymbol') . number_format($total_khr, 0, '.', ','); ?>

                                         <?php //echo Yii::app()->settings->get('site', 'altcurrencySymbol') . number_format($total_khr_round, 0, '.', ','); ?>
                                        </span>
                                    </td>
                                </tr>                                
                                <?php if (@$count_payment == 0) { ?>                                     
                                    <tr>
                                        <td colspan="2" style='text-align:right'><?php
                                            echo TbHtml::linkButton(Yii::t('app', 'Add Payment'), array(
                                                'color' => TbHtml::BUTTON_COLOR_INFO,
                                                'size' => TbHtml::BUTTON_SIZE_MINI,
                                                'icon' => 'glyphicon-plus white',
                                                'url' => Yii::app()->createUrl('payment/AddPayment/'),
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
                                        echo TbHtml::linkButton(Yii::t('app', 'Complete Sale'), array(
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
