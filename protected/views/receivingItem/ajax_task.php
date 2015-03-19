<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
        'title' => Yii::t('app','Total Quantity') . ' : ' . $count_item,
        'headerIcon' => 'icon-tasks',
));?>   

    <table class="table table-bordered table-condensed">
        <tbody>
            <tr>
                <td><?php echo Yii::t('app', 'Item in Cart'); ?> :</td>
                <td><?php echo $count_item; ?></td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app', 'Total'); ?> :</td>
                <td><span class="badge badge-info bigger-120"><?php echo Yii::app()->settings->get('site', 'currencySymbol') . number_format($total, Yii::app()->shoppingCart->getDecimalPlace(), '.', ','); ?></span></td>
            </tr>
        </tbody>
    </table>

    <?php if ( $count_item<>0 ) { ?>
        <div align="right">       
        <?php echo TbHtml::linkButton(Yii::t('app','Cancel'),array(
                'color'=>TbHtml::BUTTON_COLOR_DANGER,
                'size'=>TbHtml::BUTTON_SIZE_SMALL,
                'icon'=>'glyphicon-remove',
                'url'=>Yii::app()->createUrl('ReceivingItem/CancelRecv/'),
                'class'=>'cancel-recv',
                'title' => Yii::t( 'app', 'Cancel' ),
        )); ?>

        <?php echo TbHtml::linkButton(Yii::t('app','Done'),array(
                'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
                'size'=>TbHtml::BUTTON_SIZE_SMALL,
                'icon'=>'glyphicon-off white',
                'url'=>Yii::app()->createUrl('ReceivingItem/CompleteRecv/'),
                'class'=>'complete-recv',
                'title' => Yii::t( 'app', 'Complete' ),
         )); ?>         
        </div>
      <?php } ?>
 <?php $this->endWidget(); ?> <!--/endtaskwidget-->