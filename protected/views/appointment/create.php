<?php $this->breadcrumbs=array(
        'Appointment'=>array('appointmentdash'),
	    'New Appointment',
);
?>
<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
                'title' => Yii::t('app','New Appointment'),
                'headerIcon' => 'ace-icon fa fa-clock-o',
                'headerButtons' => array(
                    TbHtml::buttonGroup(
                        array(
                            array('label' => Yii::t('app','New Patient'),'url' =>Yii::app()->createUrl('Contact/create'),'icon'=>'ace-icon fa fa-plus white'),
                        ),array('color'=>TbHtml::BUTTON_COLOR_INFO,'size'=>TbHtml::BUTTON_SIZE_SMALL)
                    ),
                ),
                'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
                'content' => $this->renderPartial('_form', array('model'=>$model,'patient'=>$patient,'contact'=>$contact, 'user'=>$user), true),
 )); ?>  

<?php $this->endWidget(); ?>

<div class="waiting"><!-- Place at bottom of page --></div>