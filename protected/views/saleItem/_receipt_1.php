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

<?php
if (isset($error_message))
{
    echo TbHtml::alert(TbHtml::ALERT_COLOR_ERROR, $error_message);
    exit();
}
?>
<div class="container" id="receipt_wrapper"> 
    <div class="row">
        <div class="col-xs-5">
            <!-- <div class="panel panel-default"> -->
                <!-- <div class="panel-body"> -->
                    <p>
                        <?php if (Yii::app()->settings->get('receipt', 'printcompanyLogo')=='1') { ?>
                            <?php echo TbHtml::image(Yii::app()->baseUrl . '/images/tube3.jpg','Company\'s logo',array('width'=>'70')); ?> <br>
                            <!-- <h5> Tube Plastic </h5> -->
                        <?php } ?>
                    </p>
                <!-- </div> -->
            <!-- </div> -->
        </div>
        <div class="col-xs-6 col-xs-offset-1 text-right">
            <!-- <div class="panel panel-default"> -->
                    <p>
                        <?php if (Yii::app()->settings->get('receipt', 'printcompanyName')=='1') { ?>    
                            <strong>
                            <?php echo TbHtml::encode(Yii::app()->settings->get('site', 'companyName')); ?> 
                            </strong>  <br>
                        <?php } ?>
                       
                        <?php if (Yii::app()->settings->get('receipt', 'printcompanyPhone')=='1') { ?>    
                            <?php echo TbHtml::encode(Yii::app()->settings->get('site', 'companyPhone')); ?><br>
                        <?php } ?>    
                        <?php if (Yii::app()->settings->get('receipt', 'printcompanyAddress')=='1') { ?>    
                            <?php echo TbHtml::encode(Yii::app()->settings->get('site', 'companyAddress')); ?><br>
                        <?php } ?>
                         <?php if (Yii::app()->settings->get('receipt', 'printcompanyAddress1')=='1') { ?>    
                            <?php echo TbHtml::encode(Yii::app()->settings->get('site', 'companyAddress1')); ?><br>
                        <?php } ?>    
                        <?php if (Yii::app()->settings->get('receipt', 'printtransactionTime')=='1') { ?> 
                            <?php echo TbHtml::encode($transaction_time); ?><br>
                        <?php } ?>
                    </p>
            <!-- </div> -->
        </div>
    </div>
    <!-- / end client details section -->
    
    <div class="row">
        
        <div class="col-xs-6">
            <!-- <div class="panel panel-default"> -->
                    <p>
                        <?php echo Yii::t('app','Cashier') . " : ". TbHtml::encode(ucwords($employee)); ?> <br>
                        <?php echo Yii::t('app','Customer') . " : ". TbHtml::encode(ucwords($cust_fullname)); ?> <br>
                    </p>
            <!-- </div> -->
        </div>
        
        <div class="col-xs-6 col-xs-offset-0 text-right">
            
            <!-- <div class="panel panel-default"> -->
                    <p>
                        <?php echo TbHtml::encode(Yii::t('app','Invoice ID') . " : "  . $sale_id); ?> <br>
                        <?php echo TbHtml::encode(Yii::t('app','Date') . " : ". $transaction_date); ?> <br>
                    </p>
            <!-- </div> -->
        </div>
        
        <table class="table" id="receipt_items">
            <thead>
                <tr>
                    <th><?php echo Yii::t('app','Name'); ?></th>
                    <th class="center"><?php echo Yii::t('app','Price'); ?></th>
                    <th class="center" ><?php echo TbHtml::encode(Yii::t('app','Qty')); ?></th>
                    <!--
                    <th class="<?php //echo Yii::app()->settings->get('sale','discount'); ?>">
                        <?php //echo TbHtml::encode(Yii::t('app','Discount')); ?>
                    </th>
                    -->
                    <th class="text-right"><?php echo TbHtml::encode(Yii::t('app','Total')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; ?>
                <?php foreach(array_reverse($items,true) as $id=>$item): ?>
                    <?php
                        $i=$i+1;
                        $discount_arr=Common::Discount($item['discount']);
                        $discount_amount=$discount_arr[0];
                        $discount_symbol=$discount_arr[1];
                        if ($discount_symbol=='$') {
                            $total_item=number_format($item['price']*$item['quantity']-$discount_amount,Yii::app()->shoppingCart->getDecimalPlace());
                        } else {
                            $total_item=number_format($item['price']*$item['quantity']-$item['price']*$item['quantity']*$discount_amount/100,Yii::app()->shoppingCart->getDecimalPlace());
                        }
                    ?>
                    <tr>                
                        <td><?php echo TbHtml::encode($item['name']); ?></td>
                        <td class="center"><?php echo TbHtml::encode(number_format($item['price'],Yii::app()->shoppingCart->getDecimalPlace())); ?></td>
                        <td class="center"><?php echo TbHtml::encode($item['quantity']); ?></td>
                        <!-- <td class="<?php //echo Yii::app()->settings->get('sale','discount'); ?>"><?php //echo TbHtml::encode($item['discount']); ?></td> -->
                        <td class="text-right"><?php echo TbHtml::encode($total_item); ?>
                    </tr>
                <?php endforeach; ?> <!--/endforeach-->  
                    <tr class="gift_receipt_element">
                        <td colspan="3" style='text-align:right;border-top:2px solid #000000;'>Sub Total</td>
                        <td colspan="1" style='text-align:right;border-top:2px solid #000000;'> <?php echo Yii::app()->settings->get('site', 'currencySymbol') . number_format($sub_total,Yii::app()->shoppingCart->getDecimalPlace(), '.', ','); ?></td>
                    </tr>
                    <tr class="gift_receipt_element">
                        <td colspan="3" class="text-right">Total</td>
                        <td colspan="1" class="text-right"><?php echo TbHtml::encode(Yii::app()->settings->get('site', 'currencySymbol') . number_format($total,Yii::app()->shoppingCart->getDecimalPlace(), '.', ',')); ?></td>
                    </tr>    
                    <?php foreach($payments as $payment_id=>$payment): ?> 
                    <tr class="gift_receipt_element">
                        <td colspan="3" class="text-right">Payment</td>
                        <td colspan="1" class="text-right"> <?php echo TbHtml::encode(Yii::app()->settings->get('site', 'currencySymbol') . number_format($payment['payment_amount'],Yii::app()->shoppingCart->getDecimalPlace(), '.', ',')); ?> </td>  
                    </tr>
                    <?php endforeach;?>
                    <tr class="gift_receipt_element">
                        <td colspan="3" class="text-right">Change Due</td>
                        <td colspan="1" class="text-right"> <?php echo TbHtml::encode(Yii::app()->settings->get('site', 'currencySymbol') . number_format($amount_change,Yii::app()->shoppingCart->getDecimalPlace(), '.', ',')); ?> </td>  
                    </tr>
            </tbody>
        </table>
        
        <div id="sale_return_policy"> <?php echo TbHtml::encode(Yii::t('app',Yii::app()->settings->get('site', 'returnPolicy'))); ?> </div>
        
    </div>
     
</div>

<script>
function printpage()
{
    setTimeout(window.location.href='index',500);
    window.print();
    return true;
}
window.onload=printpage();
</script>