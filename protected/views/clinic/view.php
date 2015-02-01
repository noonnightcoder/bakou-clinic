<?php
/* @var $this ClinicController */
/* @var $model Clinic */
?>

<?php
$this->breadcrumbs=array(
	'Clinics'=>array('index'),
	$model->clinic_id,
);

$this->menu=array(
	array('label'=>'List Clinic', 'url'=>array('index')),
	array('label'=>'Create Clinic', 'url'=>array('create')),
	array('label'=>'Update Clinic', 'url'=>array('update', 'id'=>$model->clinic_id)),
	array('label'=>'Delete Clinic', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->clinic_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Clinic', 'url'=>array('admin')),
);
?>

<h1>View Clinic #<?php echo $model->clinic_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'clinic_id',
		'start_time',
		'end_time',
		'time_interval',
		'clinic_name',
		'tag_line',
		'clinic_address',
		'landline',
		'mobile',
		'email',
		'next_followup_days',
	),
)); ?>