<?php
if (isset($error_message))
{
    echo TbHtml::alert(TbHtml::ALERT_COLOR_ERROR, $error_message);
    exit();
}
?>
<style>
.panel {
    border: 0;
}
 div.special > div[class*="col-"] {
       padding: 0; 
      }
</style>
<div class="container"> 
    <div class="row">
        <div class="col-xs-5">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>
                        <?php if (Yii::app()->settings->get('receipt', 'printcompanyLogo')=='1') { ?>
                            <?php echo TbHtml::image(Yii::app()->baseUrl . '/images/logo.png','Company\'s logo',array('width'=>'100')); ?> <br>
                        <?php } ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-xs-offset-1 text-right">
            <div class="panel panel-default">
                    <p>
                        <?php if (Yii::app()->settings->get('receipt', 'printcompanyName')=='1') { ?>    
                            <?php echo TbHtml::encode(Yii::app()->settings->get('site', 'companyName')); ?><br>
                        <?php } ?>
                        <?php if (Yii::app()->settings->get('receipt', 'printcompanyAddress')=='1') { ?>    
                            <?php echo TbHtml::encode(Yii::app()->settings->get('site', 'companyAddress')); ?><br>
                        <?php } ?>
                        <?php if (Yii::app()->settings->get('receipt', 'printcompanyPhone')=='1') { ?>    
                            <?php echo TbHtml::encode(Yii::app()->settings->get('site', 'companyPhone')); ?><br>
                        <?php } ?>
                        <?php if (Yii::app()->settings->get('receipt', 'printtransactionTime')=='1') { ?> 
                            <?php echo TbHtml::encode($transaction_time); ?><br>
                        <?php } ?>
                    </p>
            </div>
        </div>
    </div>
    <!-- / end client details section -->
    
    <div class="row">
        
        <div class="col-xs-6">
            <div class="panel panel-default">
                    <p>
                        <?php echo Yii::t('app','Cashier') . " : ". TbHtml::encode(ucwords($employee)); ?> <br>
                        <?php echo Yii::t('app','Customer') . " : ". TbHtml::encode(ucwords($cust_fullname)); ?> <br>
                    </p>
      
            </div>
        </div>
        
        <div class="col-xs-6 col-xs-offset-0 text-right">
            <div class="panel panel-default">
                
                    <p>
                        <?php echo TbHtml::encode(Yii::t('app','Invoice ID') . " : "  . $sale_id); ?> <br>
                        <?php echo TbHtml::encode(Yii::t('app','Date') . " : ". $transaction_date); ?> <br>
                    </p>
           
            </div>
        </div>
        
        <table class="table">
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
                    <th class="center"><?php echo TbHtml::encode(Yii::t('app','Total')); ?></th>
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
                        <td colspan="1" style='text-align:right;border-top:2px solid #000000;'> <?php echo number_format($sub_total,Yii::app()->shoppingCart->getDecimalPlace(), '.', ','); ?></td>
                    </tr>
                    <tr class="gift_receipt_element">
                        <td colspan="3" class="text-right">Total</td>
                        <td colspan="1" class="text-right"><?php echo TbHtml::encode(number_format($total,Yii::app()->shoppingCart->getDecimalPlace(), '.', ',')); ?></td>
                    </tr>    
                    <?php foreach($payments as $payment_id=>$payment): ?> 
                    <tr class="gift_receipt_element">
                        <td colspan="3" class="text-right">Payment</td>
                        <td colspan="1" class="text-right"> <?php echo TbHtml::encode(number_format($payment['payment_amount'],Yii::app()->shoppingCart->getDecimalPlace(), '.', ',')); ?> </td>  
                    </tr>
                    <?php endforeach;?>
            </tbody>
        </table>
    </div>
    
    <div class="row text-right">
        <div class="col-xs-7 col-xs-offset-2">
            <p>
           
                    Sub Total : <br>
                    <?php if ($total_discount!==NULL && $total_discount>0) { ?> Discount : <br> <?php }?>
                    Total : <br>
                    <?php echo Yii::t('app','Paid Amount') . ' : '; ?> <br>
                    <?php echo Yii::t('app','Change Due') . " : "; ?>
            </p>
        </div>
        <div class="col-xs-3">
            <p>
                <?php echo number_format($sub_total,Yii::app()->shoppingCart->getDecimalPlace(), '.', ','); ?><br>
                <?php if ($total_discount!==NULL && $total_discount>0) { ?> <?php echo '%' . $total_discount; ?> <br> <?php } ?>
                <?php echo TbHtml::encode(number_format($total,Yii::app()->shoppingCart->getDecimalPlace(), '.', ',')); ?> <br>
                <?php foreach($payments as $payment_id=>$payment): ?> 
                    <?php echo TbHtml::encode(number_format($payment['payment_amount'],Yii::app()->shoppingCart->getDecimalPlace(), '.', ',')); ?> <br>
                 <?php endforeach;?>
                <?php echo TbHtml::encode(number_format($amount_change,Yii::app()->shoppingCart->getDecimalPlace(), '.', ',')); ?> <br>
         
            <p>
        </div>
    </div>
    
</div>

<script>
function printpage()
{
    setTimeout(window.location.href='index',500);
    window.print();
    return true;
}
//window.onload=printpage();
</script>