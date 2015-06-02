<style>
#sale_return_policy {
    width: 80%;
    margin: 0 auto;
    text-align: center;
}   

/*Receipt styles start*/
#receipt_wrapper {
    font-family: Arial;
    width: 92% !important;
    font-size: 11px !important;
    margin: 0 auto !important;
    padding: 0 !important;
}

    
#receipt_items td {
  //position: relative;
  padding: 3px;
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
</div>
<div class="container">
    <div class="col-sm-12">
        <table id="receipt_items" style="width:100%">
                <tr>
                    <td align="center"><h3><strong>LABORATORY RESULT</strong></h3></td>
                </tr>
                <tr>            
                    <td style='text-align:right;border-top:1px solid #000000;'></td>
                </tr>
            </table>  
    </div>
</div>    
<?php //echo $visit_date; ?>