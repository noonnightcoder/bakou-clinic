<?php
/* @var $this ContactController */
/* @var $model Contact */
?>
<?php $this->breadcrumbs=array(
        'Contact'=>array('admin'),
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

<?php //echo $this->renderPartial('_form',array('model'=>$model,'user'=>$user)); ?>