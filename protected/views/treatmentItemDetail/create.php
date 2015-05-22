<?php
/* @var $this TreatmentItemDetailController */
/* @var $model TreatmentItemDetail */
?>

<?php
$this->breadcrumbs=array(
	'Treatment Item Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TreatmentItemDetail', 'url'=>array('index')),
	array('label'=>'Manage TreatmentItemDetail', 'url'=>array('admin')),
);
?>

<h1>Create TreatmentItemDetail</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>