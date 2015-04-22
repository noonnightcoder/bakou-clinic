<style>
.btn-group {
  display: flex !important;
}
</style>
<div class="row" id="bill-payment-form">
<?php
/* @var $this ContactController */
/* @var $model Contact */
    $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
                  'title' => Yii::t('app','Pharmacy Detail').' Patient: '.TbHtml::labelTb($patient_name, array('color' => TbHtml::LABEL_COLOR_SUCCESS)),
                  'headerIcon' => 'ace-icon fa fa-users',
                  'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
    ));
?>         
<?php
/* @var $this AppointmentController */
/* @var $model Appointment */
$this->breadcrumbs=array(
            Yii::t('menu','Pharmacy')=>array('pharmacy'),
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

<?php $this->widget('yiiwheels.widgets.grid.WhGridView',array(
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
                array('name'=>'dosage',
                       'header'=>'Dosage', 
                ),
                array('name'=>'consuming_time',
                       'header'=>'Consuming Time', 
                ),
                array('name'=>'duration',
                       'header'=>'Duration', 
                ),
                array('name'=>'instruction',
                       'header'=>'Instruction', 
                ),
		array('name'=>'quantity',
                        'header'=>'Quantity', 
                        'value'=>'round($data["quantity"])'
                ),
                //'status',
                array('name'=>'unit_price',
                        'header'=>'Total', 
                        'value'=> 'number_format($data["unit_price"],2,".",",")'
                ),
                /*array('name'=>'info',
                       'header'=>'Information', 
                ),*/
	),
)); ?>
<?php $this->endWidget(); ?>
</div>

<div class="waiting"><!-- Place at bottom of page --></div>

