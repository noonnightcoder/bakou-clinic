<?php
/* @var $this TreatmentController */
/* @var $model Treatment */
?>

<?php
$this->breadcrumbs=array(
	'Treatments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Treatment', 'url'=>array('index')),
	array('label'=>'Create Treatment', 'url'=>array('create')),
	array('label'=>'Update Treatment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Treatment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Treatment', 'url'=>array('admin')),
);
?>

<h1>View Treatment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'treatment',
		'price',
	),
)); ?>