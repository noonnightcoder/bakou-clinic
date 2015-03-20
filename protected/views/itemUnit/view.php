<?php
/* @var $this ItemUnitController */
/* @var $model ItemUnit */
?>

<?php
$this->breadcrumbs=array(
	'Item Units'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ItemUnit', 'url'=>array('index')),
	array('label'=>'Create ItemUnit', 'url'=>array('create')),
	array('label'=>'Update ItemUnit', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ItemUnit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ItemUnit', 'url'=>array('admin')),
);
?>

<h1>View ItemUnit #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'unit_name',
	),
)); ?>