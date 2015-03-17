<?php $this->breadcrumbs=array(
        'Contact'=>array('admin'),
	'Create',
);
?>
<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
              'title' => Yii::t('app','Consultation') . ' : ' . $employee->doctor_name,
              'headerIcon' => 'ace-icon fa fa-user',
              'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small') ,
              'content' => $this->renderPartial('_CompleteConsult', array('model'=>$model,'visit'=>$visit,
                                'employee'=>$employee,'treatment'=>$treatment,
                                'patient'=>$patient,'treatment_items'=>$treatment_items,
                                'treatment_selected_items'=>$treatment_selected_items,
                                'medicine'=>$medicine,'medicine_selected_items'=>$medicine_selected_items), true,false),
 )); ?>  

<?php $this->endWidget(); ?>