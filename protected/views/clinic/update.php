<?php
$this->breadcrumbs=array(
        'Clinic'=>array('index'),
	'Update',
);
?>

<?php
    //$fullname = ucwords($model->first_name . ' ' . $model->last_name);
?>

<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
              'title' => Yii::t('app','Update Info'),
              'headerIcon' => 'ace-icon fa fa-user',
              'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
              'content' => $this->renderPartial('_form', array('model'=>$model,), true),
 )); ?>  

<?php $this->endWidget(); ?>