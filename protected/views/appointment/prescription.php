<style>
.btn-group {
  display: flex !important;
}
</style>
<div class="row" id="contact">
    <div class="col-xs-12 widget-container-col ui-sortable">
<?php
/* @var $this ContactController */
/* @var $model Contact */
    $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
                  'title' => Yii::t('app','Prescription'),
                  'headerIcon' => 'ace-icon fa fa-medkit',
                  'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
    ));
?>         
<?php
/* @var $this AppointmentController */
/* @var $model Appointment */
$this->breadcrumbs=array(
            Yii::t('menu','Prescription')=>array('prescription'),
            //Yii::t('app','Report'),
    );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#medicine-form-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php echo TbHtml::linkButton(Yii::t('app','Search'),array('class'=>'search-button btn','size'=>TbHtml::BUTTON_SIZE_SMALL,'icon'=>'ace-icon fa fa-search',)); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search_patient',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php if(Yii::app()->user->hasFlash('success')):?>
        <?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<?php endif; ?>

<?php $this->widget('yiiwheels.widgets.grid.WhGridView',array(
            'id'=>'medicine-form-grid',
            'dataProvider'=>$model->showBill(),
            'htmlOptions'=>array('class'=>'table-responsive panel'),
            'template' => "{items}",
            'columns'=>array(
               /* array('name'=>'id',
                       'header'=>'#', 
                ),*/
		array('name'=>'appointment_id',
                        'headerHtmlOptions' => array('style' => 'display:none'),
                        'htmlOptions' => array('style' => 'display:none'),
                ),
                array('name'=>'patient_id',
                        'headerHtmlOptions' => array('style' => 'display:none'),
                        'htmlOptions' => array('style' => 'display:none'),
                ),
                array('name'=>'doctor_id',
                        'headerHtmlOptions' => array('style' => 'display:none'),
                        'htmlOptions' => array('style' => 'display:none'),
                ),
                array('name'=>'visit_id',
                        'headerHtmlOptions' => array('style' => 'display:none'),
                        'htmlOptions' => array('style' => 'display:none'),
                ),
                //'patient_id',
                //'patient_name',
                array('name'=>'patient_name',
                       'header'=>'Patient Name', 
                ),
                array('name'=>'display_id',
                       'header'=>'Patient ID', 
                ),
		//'appointment_date',
                array('name'=>'appointment_date',
                       'header'=>'Appointment', 
                ),
                array('name'=>'title',
                       'header'=>'Title', 
                ),
                array('name'=>'status',
                       'header'=>'Status', 
                ),
                /*array('name'=>'status',
                  'header'=>'Status',
                  'value' =>array($this,"gridLeaveStatusColumn"),
                 ),*/
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    //'template'=>'{view}',
                    'template'=>'<div class="hidden-sm hidden-xs btn-group">{detail}</div>',
                    'buttons'=>array(
                        'detail' => array(
                            'label' => Yii::t('app','Detail'),                            
                            'url'=>'Yii::app()->createUrl("Appointment/prescriptionDetail", array("visit_id"=>$data["visit_id"]))',
                            'options' => array(
                                'data-toggle' => 'tooltip', 
                                'data-update-dialog-title' => 'Detail',
                                'class'=>'btn btn-xs btn-info', 
                                'title'=>'Detail',
                            ),
                        ),
                    ),
                ),
	),
)); ?>
<?php $this->endWidget(); ?>
    </div>
</div>
