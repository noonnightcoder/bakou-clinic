<style>
.btn-group {
  display: flex !important;
}
</style>
<?php
$this->breadcrumbs=array(
	Yii::t('menu','Supplier')=>array('admin'),
	Yii::t('app','Manage'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('supplier-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="row" id="supplier_cart">

        <?php if( Yii::app()->user->hasFlash('warning') || Yii::app()->user->hasFlash('success') ):?>
            <?php $this->widget('bootstrap.widgets.TbAlert'); ?>
        <?php endif; ?> 

    <?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
                  'title' => Yii::t('app','List of Suppliers'),
                  'headerIcon' => 'fa-icon fa fa-users',
                  'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),  
    ));?> 

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
            'icon'=>'fa-icon fa fa-plus white',
            'url'=>$this->createUrl('create'),
            'data-update-dialog-title' => Yii::t( 'app', 'New Supplier' ),
    )); ?>


    <?php $this->widget('yiiwheels.widgets.grid.WhGridView',array(
            'id'=>'supplier-grid',
            'fixedHeader' => true,
            //'headerOffset' => 40,
            //'responsiveTable' => true,
            'htmlOptions'=>array('class'=>'table-responsive panel'),
            'dataProvider'=>$model->search(),
            'columns'=>array(
                    array('name'=>'id',
                          'headerHtmlOptions'=>array('class'=>'hidden-480 hidden-xs'),
                          'htmlOptions'=>array('class' => 'hidden-480 hidden-xs'),
                    ),
                    array('name'=>'company_name',
                            'value' => 'CHtml::link($data->company_name, Yii::app()->createUrl("supplier/update",array("id"=>$data->primaryKey)))',
                            'type'  => 'raw',   
                    ),
                    'first_name',
                    'last_name',
                    array('name'=>'mobile_no',
                          //'headerHtmlOptions'=>array('class'=>'hidden-480 hidden-xs'),
                          //'htmlOptions'=>array('class' => 'hidden-480 hidden-xs'),
                    ),
                    array('name'=>'address1',
                          //'headerHtmlOptions'=>array('class'=>'hidden-480 hidden-xs'),
                          //'htmlOptions'=>array('class' => 'hidden-480 hidden-xs'),
                    ), 
                    array('name'=>'status',
                        'type'=>'raw',
                        'value'=>'$data->status=="1" ? TbHtml::labelTb("Activated", array("color" => TbHtml::LABEL_COLOR_SUCCESS)) : TbHtml::labelTb("De-Activated", array("color" => TbHtml::LABEL_COLOR_WARNING))',
                        //'headerHtmlOptions'=>array('class'=>'hidden-480 hidden-xs'),
                        //'htmlOptions'=>array('class' => 'hidden-480 hidden-xs'),  
                    ),
                    //'address2',
                    /*
                    'city_id',
                    'country_code',
                    'email',
                    'notes',
                    */
                    array('class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'<div class="hidden-sm hidden-xs btn-group">{view}{update}{delete}{undeleted}</div>',  
                        'htmlOptions'=>array('class'=>'nowrap'),
                        'buttons' => array(
                            'view' => array(
                              'click' => 'updateDialogOpen',    
                              'url'=>'Yii::app()->createUrl("supplier/view/",array("id"=>$data->id))',
                              'options' => array(
                                  'class'=>'btn btn-xs btn-success',
                                  'data-update-dialog-title' => Yii::t( 'app', 'View Supplier' ),
                                ),   
                            ),
                            'update' => array(
                              'icon' => 'ace-icon fa fa-edit',
                              'label'=>Yii::t('app','Update'),  
                              'options' => array(
                                  'class'=>'btn btn-xs btn-info',
                                ), 
                            ),   
                            'delete' => array(
                               'label'=>Yii::t('app','Delete'),
                               'options' => array(
                                  'class'=>'btn btn-xs btn-danger',
                                ), 
                                'visible'=>'$data->status=="1" && Yii::app()->user->checkAccess("supplier.delete")',
                            ),
                            'undeleted' => array(
                               'label'=>Yii::t('app','Undo Delete Item'),
                               'url'=>'Yii::app()->createUrl("Supplier/UndoDelete", array("id"=>$data->id))',
                               'icon'=>'bigger-120 glyphicon-refresh',
                               'options' => array(
                                   'class'=>'btn btn-xs btn-warning btn-undodelete',
                               ), 
                               'visible'=>'$data->status=="0" && Yii::app()->user->checkAccess("supplier.delete")',
                            ),
                         ),
                    ),
                    /*
                    array('class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'<div class="hidden-md hidden-lg"><div class="inline position-relative">
                                        <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto"><i class="ace-icon fa fa-cog icon-only bigger-110"></i></button>
                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                        <li>{view}</li><li>{update}</li><li>{delete1}</li>
                                        </ul></div></div>', 
                        'htmlOptions'=>array('class'=>'nowrap'),
                        'buttons' => array(
                            'view' => array(
                              'click' => 'updateDialogOpen',    
                              'url'=>'Yii::app()->createUrl("supplier/view/",array("id"=>$data->id))',
                              'options' => array(
                                  'class'=>'btn btn-xs btn-success',
                                  'data-update-dialog-title' => Yii::t( 'app', 'View Supplier' ),
                                ),   
                            ),
                            'update' => array(
                              'icon' => 'ace-icon fa fa-edit',
                              //'url'=>'Yii::app()->createUrl("supplier/update/",array("id"=>$data->id))',  
                              'label'=>Yii::t('app','Update'),  
                              'options' => array(
                                  'class'=>'btn btn-xs btn-info',
                              ), 
                            ),   
                            'delete1' => array(
                               'label'=>Yii::t('app','Delete'),
                               'options' => array(
                                  'class'=>'btn btn-xs btn-danger',
                                ), 
                            ),
                         ),
                    ),
                     * 
                    */
            ),
    )); ?>

    <?php $this->endWidget(); ?>

</div>
    
<?php 
    Yii::app()->clientScript->registerScript( 'undoDelete', "
        jQuery( function($){
            $('div#supplier_cart').on('click','a.btn-undodelete',function(e) {
                e.preventDefault();
                if (!confirm('Are you sure you want to do undo delete this item?')) {
                    return false;
                }
                var url=$(this).attr('href');
                $.ajax({url:url,
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                            $.fn.yiiGridView.update('supplier-grid');
                            return false;
                          }
                    });
                });
        });
      ");
 ?>  

<div class="waiting"><!-- Place at bottom of page --></div>

<?php Yii::app()->clientScript->registerScript('alertTimeout', '$(".alert").fadeTo(4000, 0).slideUp(1500, function() { $(this).remove(); });');