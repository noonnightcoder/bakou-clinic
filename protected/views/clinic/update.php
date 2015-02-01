<?php
/* @var $this ClinicController */
/* @var $model Clinic */
?>

<?php
$this->breadcrumbs=array(
	'Clinics'=>array('index'),
	$model->clinic_id=>array('view','id'=>$model->clinic_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Clinic', 'url'=>array('index')),
	array('label'=>'Create Clinic', 'url'=>array('create')),
	array('label'=>'View Clinic', 'url'=>array('view', 'id'=>$model->clinic_id)),
	array('label'=>'Manage Clinic', 'url'=>array('admin')),
);
?>

    <h1>Update Clinic <?php echo $model->clinic_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>