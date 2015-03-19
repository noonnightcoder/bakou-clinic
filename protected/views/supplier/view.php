<?php
$this->breadcrumbs=array(
	Yii::t('menu','Supplier')=>array('admin'),
	Yii::t('app','View'),
);
?>

<h5>View Supplier : <?php echo $model->company_name; ?></h5>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'company_name',
		'first_name',
		'last_name',
		'mobile_no',
		'address1',
		'address2',
		'city_id',
		'country_code',
		'email',
		'notes',
	),
)); ?>
