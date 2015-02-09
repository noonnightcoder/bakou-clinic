<?php
/* @var $this TreatmentController */
/* @var $model Treatment */
?>

<?php
$this->breadcrumbs=array(
	'Treatments'=>array('admin'),
	'Create',
);
?>

<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
              'title' => Yii::t('app','New Patient'),
              'headerIcon' => 'ace-icon fa fa-user',
              'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
              'content' => $this->renderPartial('_form', array('model'=>$model,), true),
 )); ?>  

<?php $this->endWidget(); ?>