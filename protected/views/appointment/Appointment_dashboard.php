<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/queue_dash.css" />
<div class="row" id="contact">
    <div class="grid-view">
<?php
/* @var $this ContactController */
/* @var $model Contact */
    $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
                  'title' => Yii::t('app','Dashboad'),
                  'headerIcon' => 'ace-icon fa fa-users',
                  'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
    ));
?>
<?php
//print_r($doctors);
//die();
echo "<table class=\"items table table-bordered\"><thead><tr><th>No</th>";
foreach ($doctors as $doctor) 
    {
            echo '<th>' . $doctor . '</th>';
            //echo $doctor;
    }
echo "</tr></thead>";
echo "<tbody>";
    for ($i = 1; $i < 10; $i++)
    {
        if($i%2==0) { $class= "class='even'"; }else{ $class="class='odd'"; }
        
        echo "<tr><td class='appointment_time'>" .$i . "</td>";
        foreach ($doctors as $doc_id=>$doc) 
        {
            //$doc=$doctor;
            $url=Yii::app()->createUrl('Appointment/create',array("doctor_id"=>$doc_id));
            $count=0;
            echo "<td><table id=\"innertbl\"><tr $class>";
            foreach ($appointment as $app)
            {
                if($doc_id==$app['doc_id'])
                {
                    if($i==$app['id'])
                    {
                        echo "<td id='" . $app['status']. "'><a href='#'>" . $app['fullname'] . "</a></td>";
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
            if($count==0)
            {
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
    </div>
</div>