<?php $this->breadcrumbs = array(
    'Laboratory' => array('labocheck'),
    'Report',
);
?>

<div class="col-sm-6">
    <div class="widget-box">
        <div class="widget-header widget-header-flat widget-header-small">
            <i class="ace-icon fa fa-stethoscope"></i>
            <h4 class="widget-title">Laboratory : <?php echo ucwords($patient_name); ?></h4>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                 <div class="profile-user-info profile-user-info-striped">
                         <div class="profile-info-row">
                            <div class="profile-info-name"> Patient Name </div>

                            <div class="profile-info-value">
                                <span class="editable" id="username"><?php echo $patient_name; ?></span>
                            </div>
                        </div>

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
                 </div>


                <div class="profile-user-info profile-user-info-striped">
                    <div class="col-xs-12">
                        <ul class="list-unstyled spaced">
                            <?php foreach ($treatment_selected_items as $id => $item): ?>
                                <li>
                                    <h2> <i class="ace-icon fa fa-check icon-animated-bell bigger-110 orange"></i><?php echo $item['treatment']; ?></h2>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.col -->
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
)); */?><!--

--><?php /*$this->endWidget(); */?>

<div class="waiting"><!-- Place at bottom of page --></div>