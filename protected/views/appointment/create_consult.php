<?php $this->breadcrumbs = array(
    'Waiting Queue' => array('appointment/WaitingQueue'),
    Yii::t('app', 'Consultation'),
);
?>
<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
    'title' => Yii::t('app', 'Patient') . ' : ' . $patient_name, //. ' :  ' . $patient->age . ' Year',
    'headerIcon' => 'ace-icon fa fa-stethoscope',
    'headerButtons' => array(
        TbHtml::linkButton(Yii::t('app', 'Patient History'), array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_SMALL,
            //'icon'=>'ace-icon fa fa-undo white',
            'url' => $this->createUrl('contact/PatientHistory', array("id" => $_GET['patient_id'])),
            'class' => 'update-dialog-open-link',
            'data-update-dialog-title' => Yii::t('app', 'Patient History'),
        )),
    ),
    'htmlHeaderOptions' => array('class' => 'widget-header-flat widget-header-small'),
    'content' => $this->renderPartial('_CompleteConsult', array(
        'model' => $model,
        'visit' => $visit,
        'employee' => $employee,
        'treatment' => $treatment,
        'patient' => $patient,
        'treatment_items' => $treatment_items,
        'treatment_selected_items' => $treatment_selected_items,
        'medicine' => $medicine,
        'medicine_selected_items' => $medicine_selected_items,
        'visit_id' => $visit_id,
        'chk_bill_saved' => $chk_bill_saved
    ), true, false),
)); ?>

<?php $this->endWidget(); ?>

<div class="waiting"><!-- Place at bottom of page --></div>