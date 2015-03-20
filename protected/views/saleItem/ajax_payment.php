<?php if ($count_item <> 0) { ?>    
            <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'payment-form',
                'enableAjaxValidation' => false,
                'layout' => TbHtml::FORM_LAYOUT_INLINE,
            ));
            ?>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td><?php echo Yii::t('app', 'Item in Cart'); ?> :</td>
                            <td><?php echo $count_item; ?></td>
                        </tr>
                        <?php if ($gdiscount!==NULL && $gdiscount>0) { ?>
                        <tr>
                            <td><?php echo Yii::t('app', 'Sub Total'); ?> :</td>
                            <td><span class="badge badge-info bigger-120"><?php echo Yii::app()->settings->get('site', 'currencySymbol') . number_format($sub_total, Yii::app()->shoppingCart->getDecimalPlace(), '.', ','); ?></span></td>
                        </tr>
                        <tr>
                            <td><?php echo $gdiscount . '% ' . Yii::t('app', 'Discount'); ?> :</td>
                            <td><span class="badge badge-info bigger-120"><?php echo Yii::app()->settings->get('site', 'currencySymbol') . number_format($sub_total/$gdiscount, Yii::app()->shoppingCart->getDecimalPlace(), '.', ','); ?></span></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td><?php echo Yii::t('app', 'Total'); ?> :</td>
                            <td><span class="badge badge-info bigger-120"><?php echo Yii::app()->settings->get('site', 'currencySymbol') . number_format($total, Yii::app()->shoppingCart->getDecimalPlace(), '.', ','); ?></span></td>
                        </tr>
                        <tr>
                            <td><?php echo Yii::t('app', 'Amount Due'); ?>:</td>
                            <td><span class="badge badge-important bigger-120"><?php echo Yii::app()->settings->get('site', 'currencySymbol') . number_format($total, Yii::app()->shoppingCart->getDecimalPlace(), '.', ','); ?><span></td>
                        </tr>
                        <tr>
                            <td><?php echo Yii::t('app', 'Payment Type'); ?>:</td>
                            <td><?php echo $form->dropDownList($model, 'payment_type', InvoiceItem::itemAlias('payment_type'), array('id' => 'payment_type_id')); ?> </td>
                        </tr>
                        <tr>
                            <td colspan="2" style='text-align:right'><?php echo $form->textFieldControlGroup($model, 'payment_amount', array('class' => 'form-control', 'value' => Yii::app()->numberFormatter->format('0.00', $amount_due), 'style' => 'text-align: right', 'maxlength' => 10, 'id' => 'payment_amount_id', 'data-url' => Yii::app()->createUrl('SaleItem/AddPayment/'),)); ?> </td>
                        </tr>
                        <tr>
                            <td colspan="2" style='text-align:right'><?php
                                echo TbHtml::linkButton(Yii::t('app', 'Add Payment'), array(
                                    'color' => TbHtml::BUTTON_COLOR_INFO,
                                    'size' => TbHtml::BUTTON_SIZE_MINI,
                                    'icon' => 'glyphicon-plus white',
                                    'url' => Yii::app()->createUrl('SaleItem/AddPayment/'),
                                    'class' => 'add-payment',
                                    'title' => Yii::t('app', 'Add Payment'),
                                ));
                                ?>   
                            </td>
                        </tr>
                    </tbody>
                </table>

            <?php // Only show this part if there is at least one payment entered.
            if ($count_payment > 0) {
            ?>
                <table class="table table-striped table-condensed">
                    <thead class="thin-border-bottom">
                        <tr><th>Type</th><td>Amount</th><th></tr>
                    </thead>
                    <tbody id="payment_content">
                        <?php foreach ($payments as $id => $payment): ?>
                        <tr>
                            <td><?php echo $payment['payment_type']; ?></td>
                            <td><?php echo Yii::app()->numberFormatter->formatCurrency(($payment['payment_amount']), Yii::app()->settings->get('site', 'currencySymbol')); ?></td>
                            <!--
                            <td><a class='delete' title='Cancel Payment' rel='tooltip' href='#'><i class='icon-remove'></i></a></td>
                            -->
                            <td>
                                <?php
                                echo TbHtml::linkButton('', array(
                                    //'color'=>TbHtml::BUTTON_COLOR_INFO,
                                    'size' => TbHtml::BUTTON_SIZE_MINI,
                                    'icon' => 'glyphicon-remove',
                                    'url' => Yii::app()->createUrl('SaleItem/DeletePayment', array('payment_id' => $payment['payment_type'])),
                                    'class' => 'delete-payment',
                                    'title' => Yii::t('app', 'Delete Payment'),
                                ));
                                ?>     
                            </td>
                        </tr>
                        <?php endforeach; ?>
                <?php } ?>

                <?php if ($count_payment > 0) { ?>
                    <td colspan="3" style='text-align:right'>
                    <?php
                    echo TbHtml::linkButton(Yii::t('app', 'Complete Sale'), array(
                        'color' => TbHtml::BUTTON_COLOR_SUCCESS,
                        //'size'=>TbHtml::BUTTON_SIZE_SMALL,
                        'icon' => 'glyphicon glyphicon-off white',
                        'url' => Yii::app()->createUrl('SaleItem/CompleteSale/'),
                        'class' => 'complete-sale',
                        'title' => Yii::t('app', 'Complete Sale'),
                    ));
                    ?>        
                    </td>    
                <?php } ?> 
                <!--
                <div id="comment_content" align="right">
                <?php //echo $form->textArea($model,'comment',array('rows'=>1, 'cols'=>20,'class'=>'input-small','maxlength'=>250,'id'=>'comment_id'));  ?>
                </div>
                -->
                </tbody>
            </table>

            <?php $this->endWidget(); ?> 
    </div> <!-- /section:custom/widget-main -->    
<?php } ?>  