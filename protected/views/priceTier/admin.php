<style>
.btn-group {
  display: flex !important;
}
</style>

<div class="row" id="pricetier_cart">

    <?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
                  'title' => Yii::t('app','List of Price Tier'),
                  'headerIcon' => 'ace-icon fa fa-list',
                  'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
    )); ?>

    <?php

    $this->breadcrumbs=array(
            Yii::t('app','Price Tier')=>array('admin'),
            Yii::t('app','Manage'),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
            $('.search-form').toggle();
            return false;
    });
    $('.search-form form').submit(function(){
            $('#price-tier-grid').yiiGridView('update', {
                    data: $(this).serialize()
            });
            return false;
    });
    ");
    ?>


    <?php echo TbHtml::linkButton(Yii::t('app','Search'),array('class'=>'search-button btn','size'=>TbHtml::BUTTON_SIZE_SMALL,'icon'=>'ace-icon fa fa-search',)); ?>
    <div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
    )); ?>
    </div><!-- search-form -->

    <?php $this->widget( 'ext.modaldlg.EModalDlg' ); ?>

    <?php echo TbHtml::linkButton(Yii::t( 'app', 'Add New' ),array(
            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
            'size'=>TbHtml::BUTTON_SIZE_SMALL,
            'icon'=>'ace-icon fa fa-plus white',
            'url'=>$this->createUrl('create'),
            'class'=>'update-dialog-open-link',
            'data-refresh-grid-id'=>'price-tier-grid',
            'data-update-dialog-title' => Yii::t('app','New Price Tier'),

    )); ?>

    <?php $this->widget('yiiwheels.widgets.grid.WhGridView',array(
            'id'=>'price-tier-grid',
            'type' => TbHtml::GRID_TYPE_HOVER,
            'fixedHeader' => true,
            //'responsiveTable' => true,
            'dataProvider'=>$model->search(),
            //'filter'=>$model,
            'columns'=>array(
                    'id',
                    'tier_name',
                    array('name'=>'status',
                        'type'=>'raw',
                        'value'=>'$data->status==1 ? TbHtml::labelTb("Activated", array("color" => TbHtml::LABEL_COLOR_SUCCESS)) : TbHtml::labelTb("De-Activated", array("color" => TbHtml::LABEL_COLOR_WARNING))', 
                    ),
                    'modified_date',
                    //'deleted',
                    array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'header'=> Yii::t('app','Edit'),
                        'template'=>'<div class="btn-group">{update}{delete}{undeleted}</div>',
                        //'htmlOptions'=>array('class'=>'btn-group'),
                        'buttons' => array(
                            'update' => array(
                              'click' => 'updateDialogOpen',
                              'label'=>'Update Price Tier',
                              'icon'=>'ace-icon fa fa-edit',  
                              'options' => array(
                                  'data-update-dialog-title' => Yii::t('app','Update Price Tier'),
                                  'data-refresh-grid-id'=>'supplier-grid',
                                  'class'=>'btn btn-xs btn-primary',
                                ), 
                            ),
                            'delete' => array(
                                'label'=>Yii::t('app','Delete Price Tier'),
                                'options' => array(
                                    'data-update-dialog-title' => Yii::t('app','Update Item'),
                                    'titile'=>'Edit Item',
                                    'class'=>'btn btn-xs btn-danger',
                                ),
                                'visible'=>'$data->status=="1" && Yii::app()->user->checkAccess("item.delete")',
                            ),
                            'undeleted' => array(
                                'label'=>Yii::t('app','Undo Delete Price Tier'),
                                'url'=>'Yii::app()->createUrl("PriceTier/UndoDelete", array("id"=>$data->id))',
                                'icon'=>'bigger-120 glyphicon-refresh',
                                'options' => array(
                                    'class'=>'btn btn-xs btn-warning btn-undodelete',
                                ), 
                                'visible'=>'$data->status=="0" && Yii::app()->user->checkAccess("item.delete")',
                            ),
                         ),
                    ),
            ),
    )); ?>

    <?php $this->endWidget(); ?>

</div>

<?php 
    Yii::app()->clientScript->registerScript( 'undoDelete', "
        jQuery( function($){
            $('div#pricetier_cart').on('click','a.btn-undodelete',function(e) {
                e.preventDefault();
                if (!confirm('Are you sure you want to do undo delete this Item?')) {
                    return false;
                }
                var url=$(this).attr('href');
                $.ajax({url:url,
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                            $.fn.yiiGridView.update('price-tier-grid');
                            return false;
                          }
                    });
                });
        });
      ");
 ?>  

<div class="waiting"><!-- Place at bottom of page --></div>