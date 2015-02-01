<?php
$this->breadcrumbs=array(
        'Employees'=>array('admin'),
	'Create',
);
?>

<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
              'title' => Yii::t('app','New Employee'),
              'headerIcon' => 'ace-icon fa fa-user',
              'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
              'content' => $this->renderPartial('_form', array('model'=>$model,'user'=>$user, 'disabled' => $disabled), true),
 )); ?>  

<?php $this->endWidget(); ?>

<?php //echo $this->renderPartial('_form',array('model'=>$model,'user'=>$user)); ?>


