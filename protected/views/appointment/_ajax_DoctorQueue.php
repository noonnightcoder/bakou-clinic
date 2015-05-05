<?php $this->widget('yiiwheels.widgets.grid.WhGridView', array(
    'id' => 'waiting-queue',
    'dataProvider' => $model->get_doctor_queue(),
    'htmlOptions' => array('class' => 'table-responsive panel'),
    'template' => "{items}",
    'columns' => array(
        /* array('name'=>'id',
                'header'=>'#',
         ),*/
        array(
            'name' => 'app_id',
            'headerHtmlOptions' => array('style' => 'display:none'),
            'htmlOptions' => array('style' => 'display:none'),
        ),
        array(
            'name' => 'patient_id',
            'headerHtmlOptions' => array('style' => 'display:none'),
            'htmlOptions' => array('style' => 'display:none'),
        ),
        array(
            'name' => 'doctor_id',
            'headerHtmlOptions' => array('style' => 'display:none'),
            'htmlOptions' => array('style' => 'display:none'),
        ),
        //'patient_id',
        //'patient_name',
        array(
            'name' => 'patient_name',
            'header' => 'Patient Name',
        ),
        array(
            'name' => 'display_id',
            'header' => 'Patient ID',
        ),
        //'appointment_date',
        array(
            'name' => 'appointment_date',
            'header' => 'Appointment',
        ),
        array(
            'name' => 'title',
            'header' => 'Tittle'
        ),
        //'status',
        array(
            'name' => 'status',
            'header' => 'Status',
            'value' => array($this, "gridLeaveStatusColumn"),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'deleteConfirmation' => 'Are you sure you want to Cancel the appointment?',
            //'template'=>'{view}{delete}',
            'template' => '<div class="hidden-sm hidden-xs btn-group">{consult}{delete}</div>',
            'buttons' => array(
                'consult' => array(
                    'label' => Yii::t('app', 'Consult'),
                    'url' => 'Yii::app()->createUrl("Appointment/Consultation", array("appoint_id"=>$data["app_id"],"doctor_id"=>$data["doctor_id"],"patient_id"=>$data["patient_id"]))',
                    'options' => array(
                        'data-toggle' => 'tooltip',
                        'data-update-dialog-title' => 'Consultation',
                        'class' => 'btn btn-xs btn-success',
                        'title' => Yii::t('app', 'Consultation'),
                    ),
                ),
                //http://bit.ly/1bdSADp
                'delete' => array(
                    'label' => Yii::t('app', 'Cancel'),
                    'url' => 'Yii::app()->createUrl("Appointment/CancelAppointment", array("appoint_id"=>$data["app_id"],"doctor_id"=>$data["doctor_id"],"patient_id"=>$data["patient_id"]))',
                    'icon' => 'bigger-120 ace-icon fa fa-eraser',
                    'options' => array(
                        'class' => 'btn btn-xs btn-warning',
                        'title' => Yii::t('app', 'Cancel Consultation')
                    ),

                ),
            ),
        ),
    ),
)); ?>

