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
                  'title' => Yii::t('app','Waiting Queue'),
                  'headerIcon' => 'ace-icon fa fa-users',
                  'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
    ));
?>         
<?php
/* @var $this AppointmentController */
/* @var $model Appointment */
$this->breadcrumbs=array(
            Yii::t('menu','Appoionment')=>array('admin'),
            Yii::t('app','Manage'),
    );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#waiting-queue').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php echo TbHtml::linkButton(Yii::t('app','Search'),array('class'=>'search-button btn','size'=>TbHtml::BUTTON_SIZE_SMALL,'icon'=>'ace-icon fa fa-search',)); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php if (Yii::app()->user->checkAccess('appointment.create')) {?>
<?php echo TbHtml::linkButton(Yii::t( 'app', 'Add New' ),array(
            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
            'size'=>TbHtml::BUTTON_SIZE_SMALL,
            'icon'=>'glyphicon-plus white',
            'url'=>$this->createUrl('create'),
    )); ?>
<?php } ?>
<?php if(Yii::app()->user->hasFlash('success')):?>
        <?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<?php endif; ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
            'id'=>'waiting-queue',
            'dataProvider'=>$model->get_doctor_queue(),
            //'htmlOptions'=>array('class'=>'table-responsive panel'),
            'template' => "{items}",
            'columns'=>array(
                array('name'=>'id',
                       'header'=>'#', 
                ),
		array('name'=>'app_id',
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
		'title',
                //'status',
                array('name'=>'status',
                  'header'=>'Status',
                  'value' =>array($this,"gridLeaveStatusColumn"),
                 ), 
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'deleteConfirmation'=>'Are you sure you want to Cancel the appointment?',
                    'template'=>'{view}{delete}',
                    //'template'=>'<div class="hidden-sm hidden-xs btn-group">{view}{update}{delete}{undeleted}</div>',
                    'buttons'=>array(
                        'view' => array(
                            'label' => 'Consultant',                            
                            'url'=>'Yii::app()->createUrl("Appointment/Consultation", array("appoint_id"=>$data["app_id"],"doctor_id"=>$data["doctor_id"],"patient_id"=>$data["patient_id"]))',
                            /*'options' => array(
                                'class'=>'fa fa-user-md',
                            ),*/
                        ),
                        //http://bit.ly/1bdSADp
                        'delete' => array(
                            'label' => 'Cancel',
                            'url'=>'Yii::app()->createUrl("Appointment/cancelAppointment", array("appoint_id"=>$data["app_id"],"doctor_id"=>$data["doctor_id"],"patient_id"=>$data["patient_id"]))',
                            
                        ),
                    ),
                ),
	),
)); ?>
<?php $this->endWidget(); ?>
    </div>
</div>