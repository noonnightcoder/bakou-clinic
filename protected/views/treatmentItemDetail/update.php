<?php
/* @var $this TreatmentItemDetailController */
/* @var $model TreatmentItemDetail */
?>

<?php
$this->breadcrumbs=array(
	'Treatment Item Details'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TreatmentItemDetail', 'url'=>array('index')),
	array('label'=>'Create TreatmentItemDetail', 'url'=>array('create')),
	array('label'=>'View TreatmentItemDetail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TreatmentItemDetail', 'url'=>array('admin')),
);
?>

    <h1>Update TreatmentItemDetail <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>