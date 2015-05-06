<?php
//    $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
//        'title' => Yii::t('app', 'List of Medicine'),
//        'headerIcon' => 'ace-icon fa fa-users',
//        'htmlHeaderOptions' => array('class' => 'widget-header-flat widget-header-small'),
//    ));
?>
<?php $this->widget('yiiwheels.widgets.grid.WhGridView',array(
            'id'=>'waiting-queue',
            'dataProvider'=>$model->showBillDetail($visit_id),
            //'htmlOptions'=>array('class'=>'table-responsive panel'),
            'template' => "{items}",
            'columns'=>array(
               /* array('name'=>'id',
                       'header'=>'#', 
                ),*/
                array('name'=>'patient_id',
                        'headerHtmlOptions' => array('style' => 'display:none'),
                        'htmlOptions' => array('style' => 'display:none'),
                ),
                array('name'=>'visit_id',
                        'headerHtmlOptions' => array('style' => 'display:none'),
                        'htmlOptions' => array('style' => 'display:none'),
                ),
                //'patient_id',
                //'patient_name',
                /*array('name'=>'fullname',
                       'header'=>'Patient Name', 
                ),*/
                array('name'=>'visit_date',
                       'header'=>'Visit Date', 
                ),
		//'appointment_date',
                array('name'=>'item',
                       'header'=>'Item', 
                ),
                array('name'=>'dosage',
                       'header'=>'Dosage', 
                ),
                array('name'=>'consuming_time',
                       'header'=>'Time',
                ),
                array('name'=>'duration',
                       'header'=>'Duration', 
                ),
                array('name'=>'instruction',
                       'header'=>'Instruction', 
                ),
		array('name'=>'quantity',
                        'header'=>'Quantity', 
                        'value'=>'round($data["quantity"])'
                ),
                //'status',
                /*array('name'=>'unit_price',
                        'header'=>'Total', 
                        'value'=> 'number_format($data["unit_price"],2,".",",")'
                ),*/
                /*array('name'=>'info',
                       'header'=>'Information', 
                ),*/
	),
)); ?>

