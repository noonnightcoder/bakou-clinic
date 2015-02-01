<div class="span10" style="float: none;margin-left: auto; margin-right: auto;">
<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
              'title' => Yii::t('app','Manage Database Backup Files'),
              'headerIcon' => 'ace-icon fa fa-hdd-o',
              'content' => $this->renderPartial('_list', array('dataProvider'=>$dataProvider), true),
              'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
 )); ?>  

<?php $this->endWidget(); ?>
</div>
