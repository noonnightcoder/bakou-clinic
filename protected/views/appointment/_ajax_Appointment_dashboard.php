<?php
$box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
    'title' => Yii::t('app', 'Dashboard'),
    'headerIcon' => 'ace-icon fa fa-tachometer',
    'htmlHeaderOptions' => array('class' => 'widget-header-flat widget-header-small'),
));
?>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true, // display a larger alert block?
    'fade' => true, // use transitions?
    'closeText' => '&times;', // close link text - if set to false, no close link is displayed
    'alerts' => array( // configurations per alert type
        'success' => array('block' => true, 'fade' => true, 'closeText' => '&times;'),
        'error' => array('block' => true, 'fade' => true, 'closeText' => '&times;'),
    ),
)); ?>
<?php
echo "<table class=\"items table table-bordered\"><thead><tr><th>No</th>";
foreach ($doctors as $doctor) {
    echo '<th>' . $doctor . '</th>';
    //echo $doctor;
}
echo "</tr></thead>";
echo "<tbody id='appointment-dash'>";
for ($i = 1; $i < 10; $i++) {
    if ($i % 2 == 0) {
        $class = "class='even'";
    } else {
        $class = "class='odd'";
    }

    echo "<tr><td class='appointment_time'>" . $i . "</td>";
    foreach ($doctors as $doc_id => $doc) {
        //$doc=$doctor;
        $url = Yii::app()->createUrl('Appointment/create', array("doctor_id" => $doc_id,"patient_id"=>$_GET['patient_id']));

        $count = 0;
        echo "<td><table id=\"innertbl\"><tr $class>";

        foreach ($appointment as $app) {
            if ($doc_id == $app['doc_id']) {
                if ($i == $app['id']) {
                    $change_doc_url = Yii::app()->createUrl('Appointment/update',
                        array('appt_id' => $app['appointment_id'], 'doctor_id' => $app['doc_id']));
                    $cancel_url = Yii::app()->createUrl('Appointment/CancelAppointment',
                        array('appoint_id' => $app['appointment_id'], 'doctor_id' => $app['doc_id']));

                    if ($app['status'] != 'Waiting') {
                        echo "<td id='" . $app['status'] . "'><a href='#'>" . $app['fullname'] . "</a></td>";
                    } else {
                        echo "<td id='" . $app['status'] . "'>" . $app['fullname'] . "<a href='$cancel_url' title='Cancel Appointment' class='fa fa-times cancle-appointment'></a></td>";
                    }

                    //echo "<td id='" . $app['status']. "'><a href='#'>" . $app['fullname'] . "</a></td>";
                    //echo "<td id='" . $app['status']. "'>" . $app['fullname'] . "<a href='$change_doc_url' title='Change Doctor' class='fa fa-exchange'></a><a href='$cancel_url' title='Cancel Appointment' class='fa fa-times'></a></td>";
                    /*switch($app['status'])
                    {
                        case 'Waiting':
                            echo "<td id='" . $app['status']. "'><a href='#'>" . $app['fullname'] . "</a></td>";
                            break;
                        case 'Consultant':
                            echo "<td id='" . $app['status']. "'><a href='#'>" . $app['fullname'] . "</a></td>";
                            break;
                        default:
                            break;
                    }*/
                    $count++;
                }
            }
        }
        if ($count == 0) {
            //echo $class;
            echo "<td id=\"blank\"><a href=$url>" . ' ' . "</a></td>";
        }
        echo "</tr></table></td>";

    }
    echo "</tr>";
}
echo "</tbody></table><br /><br /><table>";
echo "<tr><td id = \"Appointments\" style=\"height: 15px;width: 15px;\"></td>";
echo "<td id = \"action\">appointment</td>";
echo "<td id = \"Consultation\" style=\"height: 15px;width: 15px;\"></td>";
echo "<td id = \"action\">consultation</td></tr>";
echo "<tr><td id =\"Complete\" style=\"height: 15px;width: 15px;\"></td>";
echo "<td id = \"action\">complete appointment</td>";
echo "<td id = \"Cancel\" style=\"height: 15px;width: 15px;\"></td>";
echo "<td id = \"action\">cancelled appointment </td></tr>";
echo "<tr><td id = \"Waiting\" style=\"height: 15px;width: 15px;\"></td>";
echo "<td id = \"action\">waiting</td>";
echo "</tr></table></div></br>";
?>
<?php $this->endWidget(); ?>