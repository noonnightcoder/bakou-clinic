<style>
#sale_return_policy {
    width: 80%;
    margin: 0 auto;
    text-align: center;
}   

/*Receipt styles start*/
#receipt_wrapper {
    font-family: Arial;
    width: 98% !important;
    font-size: 13px !important;
    margin: 0 auto !important;
    padding: 0 !important;
}

#receipt_items td {
  //position: relative;
  padding: 3px;
}

@media print {
    body {
        position: relative;
    }

    #footer {
        position: fixed;
        bottom: 0;
        width:100%;
    }
}
</style>

<div class="container" id="receipt_wrapper"> 
    <div class="row">
        <div class="col-xs-5">
            <p>
                <?php echo TbHtml::image(Yii::app()->baseUrl . '/images/shop_logo.png','Company\'s logo',array('width'=>'150')); ?> <br>
            </p>
        </div>
        <div class="col-xs-6 col-xs-offset-1 text-right">
            <p>   
                <strong>
                    <?php echo TbHtml::encode($clinic_name); ?> 
                </strong>  <br>
                <?php echo TbHtml::encode($clinic_mobile); ?><br>
                <?php echo TbHtml::encode($clinic_address); ?><br>
            </p> 
            
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <p>   
                <strong>
                    <?php echo TbHtml::encode(Yii::t('app','Client Code') . " : "  .$client->display_id); ?> 
                </strong>  <br>
                <?php echo TbHtml::encode(Yii::t('app','Client Name') . " : "  .$client->fullname.' Age:'.$client->age.' Sex:'.$client->sex); ?> <br>
                <?php echo TbHtml::encode(Yii::t('app','Client Address') . " : "  .$client->address_line_1); ?> <br>                    
                <?php echo TbHtml::encode(Yii::t('app','Visit Date') . " : "  . $visit_date); ?><br>
            </p>
        </div>
    </div>
    <div class="gift_receipt_element">
        <table id="receipt_items" style="width:100%">
            <tr>
                <td align="center"><h3><strong>LABORATORY RESULT</strong></h3></td>
            </tr>
            <tr>            
                <td style='text-align:right;border-top:1px solid #000000;'></td>
            </tr>
        </table>  
    </div>
    <div class="gift_receipt_element">
        <table class="table" id="receipt_items">
            <thead>
                <tr>
                    <th> <?php echo TbHtml::encode(Yii::t('app','TEST PERFORMED')); ?></th>
                    <th> <?php echo TbHtml::encode(Yii::t('app','RESULT')); ?></th>
                    <th> <?php echo TbHtml::encode(Yii::t('app','CAPTION')); ?></th>
                    <th> <?php echo TbHtml::encode(Yii::t('app','LAB TYPE')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lab_selected as $val) {?>
                    <?php
                        $lab_items_name=$val['treatment_item'];
                        $blood_id = $val['blood_id'];
                        $blood_item_id = $val['id'];
                        $val_col1= $val['val_result_col1'];
                        $val_col2= $val['val_result_col2'];
                        //&nscr;
                        echo "<tr>";
                            echo "<td>";
                            echo $val['treatment_item']."<br/>";
                            echo "</td>";
                            echo "<td>";
                            if($val['blood_id']==4)
                            {
                                echo "Group: ";
                                echo $val_col1;
                                echo "<p>";
                                echo "Rh: ";
                                echo $val_col2;
                            }elseif($val['blood_id']==16 || $val['blood_id']==17){
                                echo "mm: ";
                                echo $val_col1;
                                echo "<p>";
                                echo "sec: ";
                                echo $val_col2;
                            }elseif($val['blood_id']==19){
                                echo "IgG: ";
                                echo $val_col1;
                                echo "<p>";
                                echo "IgM: ";
                                echo $val_col2;
                            }elseif($val['blood_id']==29){
                                echo "To: ";
                                echo $val_col1;
                                echo "<p>";
                                echo "TH: ";
                                echo $val_col2;
                            }elseif($val['blood_id']==44){
                                echo "SGOT(ASAT): ";
                                echo $val_col1;
                                echo "<p>";
                                echo "SGPT(ALAT): ";
                                echo $val_col2;
                            }else{
                                echo $val_col1;
                            }
                            echo "</td>";
                            echo "<td>";
                                echo $val['caption'];
                            echo "</td>";
                            echo "<td>";
                                echo $val['lab_type'];
                            echo "</td>";
                        echo "</tr>";
                    ?>
                <?php }?>
            </tbody> 
        </table>    
    </div> 
</div>
<p><p>
<div id="footer">
    <div class="row">
        <div class="col-xs-3">
            <table id="receipt_items" style="width:100%">            
                <tr>            
                    <td style='text-align:right;border-top:1px solid #000000;'></td>                
                </tr>
                <tr><td>Doctor: <?php echo $doctor->doctor_name; ?></td></tr>
                <tr><td>Date:<?php echo date('d-M-Y') ?></td></tr>
            </table>
        </div>
        <div class="col-xs-3"></div>
        <!--<div class="col-xs-3">Account Process </div>-->
        <div class="col-xs-3"></div>
        <div class="col-xs-3 align-right">
            <table id="receipt_items" style="width:100%">            
                <tr>            
                    <td style='text-align:right;border-top:1px solid #000000;'></td>                
                </tr>
                <tr style='text-align:left'><td>Lab-Tech: <?php echo $lab_tech->doctor_name; ?></td></tr>
                <tr style='text-align:left'><td>Date:<?php echo date('d-M-Y') ?></td></tr>
            </table>
        </div>
    </div>
</div>
<?php $url = Yii::app()->createUrl('Appointment/labocheck/'); ?>
<script>
$(window).bind("load", function() {
    setTimeout(window.location.href='<?php echo $url; ?>',5000);
    window.print();
    return true;
});    
</script>