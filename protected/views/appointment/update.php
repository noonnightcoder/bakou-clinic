<?php
/* @var $this AppointmentController */
/* @var $model Appointment */
?>

<?php
$this->breadcrumbs=array(
	'Appointments'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Appointment', 'url'=>array('index')),
	array('label'=>'Create Appointment', 'url'=>array('create')),
	array('label'=>'View Appointment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Appointment', 'url'=>array('admin')),
);
?>

    <h1>Update Appointment <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>