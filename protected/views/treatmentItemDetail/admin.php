<?php
/* @var $this TreatmentItemDetailController */
/* @var $model TreatmentItemDetail */


$this->breadcrumbs=array(
	'Treatment Item Details'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TreatmentItemDetail', 'url'=>array('index')),
	array('label'=>'Create TreatmentItemDetail', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#treatment-item-detail-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Treatment Item Details</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('\TbGridView',array(
	'id'=>'treatment-item-detail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		't_group_id',
		'treatment_item',
		'unit_price',
		'caption',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>