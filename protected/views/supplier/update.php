<?php
$this->breadcrumbs=array(
        Yii::t('app','Supplier')=>array('admin'),
	Yii::t('app','Update'),
);

?>

<?php if( Yii::app()->user->hasFlash('warning') || Yii::app()->user->hasFlash('success') ):?>
    <?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<?php endif; ?> 

<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
              'title' => Yii::t('app','Update Supplier'),
              'headerIcon' => 'ace-icon fa fa-user',
              'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
              'content' => $this->renderPartial('_form', array('model'=>$model), true),
 )); ?>  

<?php $this->endWidget(); ?>