<style>
.btn-group {
  display: flex !important;
}
</style>
<div class="row" id="contact">
    <div class="col-xs-12 widget-container-col ui-sortable"> 
<?php
/* @var $this ContactController */
/* @var $model Contact */
    $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
                  'title' => Yii::t('app','List of Medicine'),
                  'headerIcon' => 'ace-icon fa fa-users',
                  'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
    ));
?> 
<?php
/* @var $this TreatmentController */
/* @var $model Treatment */
$this->breadcrumbs=array(
            Yii::t('menu','Item')=>array('admin'),
            Yii::t('app','Manage'),
    );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#treatment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo TbHtml::linkButton(Yii::t('app','Search'),array('class'=>'search-button btn','size'=>TbHtml::BUTTON_SIZE_SMALL,'icon'=>'ace-icon fa fa-search',)); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>    
</div><!-- search-form -->

<?php echo TbHtml::linkButton(Yii::t( 'app', 'Add New' ),array(
            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
            'size'=>TbHtml::BUTTON_SIZE_SMALL,
            'icon'=>'glyphicon-plus white',
            'url'=>$this->createUrl('create'),
    )); ?>
<?php if(Yii::app()->user->hasFlash('success')):?>
        <?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<?php endif; ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
            'id'=>'treatment-grid',
            'dataProvider'=>$model->search(),
            'htmlOptions'=>array('class'=>'table-responsive panel'),
            'columns'=>array(
		'id',
		'name',
		'item_number',
		'category_id',
		'supplier_id',
		'cost_price',
		/*
		'unit_price',
		'quantity',
		'reorder_level',
		'location',
		'allow_alt_description',
		'is_serialized',
		'description',
		'status',
		'created_date',
		'modified_date',
		'is_expire',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
<?php $this->endWidget(); ?>
    </div>
</div>