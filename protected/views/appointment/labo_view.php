<?php $this->breadcrumbs=array(
        'Contact'=>array('admin'),
	'Create',
);
?>

<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
              'title' => Yii::t('app','Consultation') . ' : ' . $employee->doctor_name,
              'headerIcon' => 'ace-icon fa fa-user',
              'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small') ,
              'content' => $this->renderPartial('_laboratory', array('model'=>$model,'visit'=>$visit,
                                'employee'=>$employee,'treatment'=>$treatment,
                                'patient'=>$patient,'medicine'=>$medicine,
                                'treatment_selected_items'=>$treatment_selected_items,
                                'medicine_selected_items'=>$medicine_selected_items,
                                'visit_id'=>$visit_id), true,false),
 )); ?>  

<?php $this->endWidget(); ?>

<div class="waiting"><!-- Place at bottom of page --></div>