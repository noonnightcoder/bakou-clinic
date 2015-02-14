<?php $this->breadcrumbs=array(
        'Contact'=>array('admin'),
	'Create',
);
?>
<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
              'title' => Yii::t('app','Clinic Info'),
              'headerIcon' => 'ace-icon fa fa-user',
              'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
              'content' => $this->renderPartial('_form', array('model'=>$model,), true),
 )); ?>  

<?php $this->endWidget(); ?>