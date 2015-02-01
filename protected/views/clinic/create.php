<?php
/* @var $this ClinicController */
/* @var $model Clinic */
?>

<?php
$this->breadcrumbs=array(
	'Clinics'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Clinic', 'url'=>array('index')),
	array('label'=>'Manage Clinic', 'url'=>array('admin')),
);
?>

<h1>Create Clinic</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>