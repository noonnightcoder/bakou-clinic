<?php if ( $count_item>0 ) { ?> 
    <div align="right">
    <?php echo TbHtml::linkButton(Yii::t('app','Draft'),array(
            'color'=>TbHtml::BUTTON_COLOR_WARNING,
            'size'=>TbHtml::BUTTON_SIZE_SMALL,
            'icon'=>'glyphicon-pause white',
            'url'=>Yii::app()->createUrl('SaleItem/SuspendSale/'),
            'class'=>'suspend-sale',
            'title' => Yii::t( 'app', 'Draft' ),
    )); ?>

    <?php echo TbHtml::linkButton(Yii::t('app','Cancel Sale'),array(
            'color'=>TbHtml::BUTTON_COLOR_DANGER,
            'size'=>TbHtml::BUTTON_SIZE_SMALL,
            'icon'=>'glyphicon-remove white',
            'url'=>Yii::app()->createUrl('SaleItem/CancelSale/'),
            'class'=>'cancel-sale',
            'title' => Yii::t( 'app', 'Cancel' ),
    )); ?>     
    </div>
<?php } ?>