<?php
$this->breadcrumbs=array(
        'Employees'=>array('admin'),
	'Update',
);
?>

<?php
    $fullname = ucwords($model->first_name . ' ' . $model->last_name);
?>

<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
              'title' => Yii::t('app','Update Employee') . ' : ' . '<span class="text-success bigger-120">' . $fullname .'</span>',
              'headerIcon' => 'ace-icon fa fa-user',
              'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
              'content' => $this->renderPartial('_form', array('model'=>$model,'user'=>$user, 'disabled' => $disabled), true),
 )); ?>  

<?php $this->endWidget(); ?>