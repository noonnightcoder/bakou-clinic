<?php $this->breadcrumbs = array(
    'Patient' => array('contact/'.$_GET['patient_id']),
    'Report',
);
?>

<div class="col-sm-12">
    <div class="widget-box">
        <div class="widget-header widget-header-flat widget-header-small">
            <i class="ace-icon fa fa-stethoscope"></i>
            <h4 class="widget-title">Patient : <?php echo ucwords($patient_name); ?></h4>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                 <div class="profile-user-info profile-user-info-striped">

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Age </div>

                            <div class="profile-info-value">
                                <span class="editable" id="age"><?php echo $patient->age; ?></span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Gender </div>

                            <div class="profile-info-value">
                                <span class="editable" id="about"><?php echo $patient->sex; ?></span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Address </div>

                            <div class="profile-info-value">
                                <i class="fa fa-map-marker light-orange bigger-110"></i>
                                <span class="editable" id="country"><?php echo $patient->address_line_1; ?></span>
                                <span class="editable" id="city"><?php //echo $patient->address_line_2; ?></span>
                            </div>
                        </div>


                    <div class="profile-info-row">
                        <div class="profile-info-name"> Last Visit </div>

                        <div class="profile-info-value">
                            <span class="editable" id="login">3 days ago</span>
                        </div>
                    </div>
                    <div class="profile-info-row" id="re-visit">
                        <div class="profile-info-name"> Re-Visit </div>

                        <div class="profile-info-value">
                            <?php echo TbHtml::linkButton(Yii::t( 'app', 'Add' ),array(
                                    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
                                    'size'=>TbHtml::BUTTON_SIZE_MINI,
                                    'icon'=>'glyphicon-plus white',
                                    'url'=>$this->createUrl('create'),
                            )); ?>
                        </div>
                    </div>
                 </div>


               <!-- <div class="profile-user-info profile-user-info-striped">
                    <div class="col-xs-12">
                        <ul class="list-unstyled spaced">
                            <?php /*foreach ($treatment_selected_items as $id => $item): */?>
                                <li>
                                    <h2> <i class="ace-icon fa fa-check icon-animated-bell bigger-110 orange"></i><?php /*echo $item['treatment']; */?></h2>
                                </li>
                            <?php /*endforeach; */?>
                        </ul>
                    </div>
                </div>-->

            </div>
        </div>
    </div>
</div>


<?php /*$box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
    'title' => Yii::t('app', 'Laboratory') . ' : ' . ucwords($patient_name),
    'headerIcon' => 'ace-icon fa fa-user',
    'htmlHeaderOptions' => array('class' => 'widget-header-flat widget-header-small'),
    'content' => $this->renderPartial('_laboratory', array(
        'model' => $model,
        'visit' => $visit,
        'employee' => $employee,
        'treatment' => $treatment,
        'patient' => $patient,
        'medicine' => $medicine,
        'treatment_selected_items' => $treatment_selected_items,
        'medicine_selected_items' => $medicine_selected_items,
        'visit_id' => $visit_id
    ), true),
)); */?>

<?php /*$this->endWidget(); */?>
<div class="col-sm-12">
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
                array('name'=>'id',
                       'header'=>'#', 
                ),
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
<?php //$this->endWidget(); ?>

</div>


<div class="waiting"><!-- Place at bottom of page --></div>

<script>
$(document).ready(function()
{  
    $('#re-visit').on('click','a',function(e) {
        //e.preventDefault();
        //a_href = $(this).attr("href");
        var ans = confirm("Are you sure that you want to submit?");
        if(ans===false)
        { 
            return false;
        }
    });
});
</script>