<?php
/* @var $this TreatmentItemDetailController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Treatment Item Details',
);

$this->menu=array(
	array('label'=>'Create TreatmentItemDetail','url'=>array('create')),
	array('label'=>'Manage TreatmentItemDetail','url'=>array('admin')),
);
?>

<h1>Treatment Item Details</h1>

<?php $this->widget('\TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>