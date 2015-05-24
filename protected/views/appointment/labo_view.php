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
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        //'id'=>'doctor_consult',
        //'action'=>Yii::app()->createUrl('appointment/DoctorConsult'),
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'id' => 'add_client_result',
    )); ?>
<div class="col-sm-12">    
    <table class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="display:none">ID</th>
            <th>Lab Item</th>
            <th>Value</th>
            <th>Caption</th>
        </tr>
    </thead>
    <tbody id='treatment_contents'>
    <?php 
        foreach ($lab_selected as $val)
        {
            //print_r($val);
            $lab_items=$val['treatment_item'];
            $blood_id = $val['blood_id'];
            echo "<tr>";
                echo "<td>"; 
                    echo $val['treatment_item']."<br/>";
                echo "</td>";                
                echo "<td>"; 
                    if($val['blood_id']==4)
                    {
                        echo "<input class='blood-result-input' type='text' name='lab_items_f[$blood_id]' style='width:100px;' placeholder='Blood Group'>";
                        echo " ";
                        echo "<input class='blood-result-input' type='text' name='lab_items_s[$blood_id]' style='width:100px;' placeholder='Rh'>";  
                    }elseif($val['blood_id']==16 || $val['blood_id']==17){
                        echo "<input class='blood-result-input' type='text' name='lab_items_f[$blood_id]' style='width:100px;' placeholder='mm'>";
                        echo " ";
                        echo "<input class='blood-result-input' type='text' name='lab_items_s[$blood_id]' style='width:100px;' placeholder='sec'>";
                    }elseif($val['blood_id']==19){
                        echo "<input class='blood-result-input' type='text' name='lab_items_f[$blood_id]' style='width:100px;' placeholder='IgG'>";
                        echo " ";
                        echo "<input class='blood-result-input' type='text' name='lab_items_s[$blood_id]' style='width:100px;' placeholder='IgM'>";
                    }elseif($val['blood_id']==29){
                        echo "<input class='blood-result-input' type='text' name='lab_items_f[$blood_id]' style='width:100px;' placeholder='To'>";
                        echo " ";
                        echo "<input class='blood-result-input' type='text' name='lab_items_s[$blood_id]' style='width:100px;' placeholder='TH'>";
                    }elseif($val['blood_id']==44){
                        echo "<input class='blood-result-input' type='text' name='lab_items_f[$blood_id]' style='width:100px;' placeholder='SGOT(ASAT)'>";
                        echo " ";
                        echo "<input class='blood-result-input' type='text' name='lab_items_s[$blood_id]' style='width:100px;' placeholder='SGPT(ALAT)'>";
                    }else{
                        echo "<input class='blood-result-input' type='text' name='lab_items_f[$blood_id]' style='width:200px;' placeholder='$lab_items'>";
                    }
                echo "</td>";;
                echo "<td>"; 
                    echo $val['caption']."<br/>";
                echo "</td>";
            echo "</tr>";    
        }       
    ?>
    </tbod>
    </table>    
</div>
<div class="col-sm-12">
            <div class="form-actions" id="form-actions">
                <?php echo TbHtml::submitButton(Yii::t('app', 'Save'), array(
                    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                    'size' => TbHtml::BUTTON_SIZE_SMALL,
                    'id' => 'save-labo-form',
                    'name' => 'Save_labo'
                    //'size'=>TbHtml::BUTTON_SIZE_SMALL,
                )); ?>
            </div>
</div> 
<?php $this->endWidget(); ?>
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
)); */

?>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function() {
	$('#save-labo-form').on('click',function(e) {
            var isValid = true;
		$('input[type="text"]').each(function() {
			if ($.trim($(this).val()) == '') {
				isValid = false;
				$(this).css({
					"border": "1px solid red",
					"background": "#FFCECE"
				});
                                
                                //Validate input field
                                //http://bit.ly/1FIzQaX
			}
			else {
				$(this).css({
					"border": "",
					"background": ""
				});
			}
		});
		if (isValid == false)
                {    
			e.preventDefault();
                }
        }); 
        
        $(".blood-result-input").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                     // Allow: Ctrl+A, Command+A
                    (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
                     // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                             // let it happen, don't do anything
                             return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
            }
        });
    });
</script>    

<!--

--><?php /*$this->endWidget(); */?>

<div class="waiting"><!-- Place at bottom of page --></div>