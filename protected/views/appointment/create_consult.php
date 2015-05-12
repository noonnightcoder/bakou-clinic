<?php $this->breadcrumbs = array(
    'Waiting Queue' => array('appointment/WaitingQueue'),
    Yii::t('app', 'Consultation'),
);
?>

<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
    'title' => Yii::t('app', 'Patient') . ' : ' . $patient_name, //. ' :  ' . $patient->age . ' Year',
    'headerIcon' => 'ace-icon fa fa-stethoscope',
    'headerButtons' => array(
        TbHtml::buttonGroup(
            array(
                array('label' => Yii::t('app','Revisit'),                    
                    'url' =>Yii::app()->createUrl('visit/revisit/',array("visit_id" => $_GET['visit_id'],"patient_id"=>$_GET['patient_id'],"doctor_id"=>$_GET['doctor_id'])),
                    'icon'=>'ace-icon fa fa-history white',
                    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                    'size' => TbHtml::BUTTON_SIZE_SMALL,
                    'class'=>'re-visit',
                ),
                array('label'=>' | ',
                    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                    'size' => TbHtml::BUTTON_SIZE_SMALL,
                ),
                array('label'=>Yii::t('app','Patient History'),
                    'url' => $this->createUrl('contact/PatientHistory', array("id" => $_GET['patient_id'])),
                    'icon'=>'ace-icon fa fa-list white',
                    'class' => 'update-dialog-open-link',
                    'data-update-dialog-title' => Yii::t('app', 'Patient History'),
                    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                    'size' => TbHtml::BUTTON_SIZE_SMALL,
                )
            )
        ),
        /*TbHtml::linkButton(Yii::t('app', 'Revisit'), array(
                'color' => TbHtml::BUTTON_COLOR_WARNING,
                'size' => TbHtml::BUTTON_SIZE_SMALL,
                'icon' => 'glyphicon-plus white',
                //'url' => Yii::app()->createUrl('SaleItem/SuspendSale/'),
                'class' => 're-visit',
                //'title' => Yii::t('app', 'Suspend Sale'),
            )),
        TbHtml::linkButton(Yii::t('app', 'Patient History'), array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_SMALL,
            'url' => $this->createUrl('contact/PatientHistory', array("id" => $_GET['patient_id'])),
            'class' => 'update-dialog-open-link',
            'data-update-dialog-title' => Yii::t('app', 'Patient History'),
        )),*/
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

<?php //$this->renderPartial('/contact/_visited', array('visit'=>$visit,'patient_id'=>18),false,true); ?>

<div class="waiting"><!-- Place at bottom of page --></div>
