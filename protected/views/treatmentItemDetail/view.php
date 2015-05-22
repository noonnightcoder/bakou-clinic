<?php
/* @var $this TreatmentItemDetailController */
/* @var $model TreatmentItemDetail */
?>

<?php
$this->breadcrumbs=array(
	'Treatment Item Details'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TreatmentItemDetail', 'url'=>array('index')),
	array('label'=>'Create TreatmentItemDetail', 'url'=>array('create')),
	array('label'=>'Update TreatmentItemDetail', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TreatmentItemDetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TreatmentItemDetail', 'url'=>array('admin')),
);
?>

<h1>View TreatmentItemDetail #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		't_group_id',
		'treatment_item',
		'unit_price',
		'caption',
	),
)); ?>