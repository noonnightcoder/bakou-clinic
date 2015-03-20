<?php
$this->breadcrumbs=array(
	Yii::t('menu','Item')=>array('admin'),
	Yii::t('app','Manage'),
);
?>
<div class="row" id="item_cart">
<div class="col-xs-12">
    
<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
              'title' => Yii::t('app','List of Items'),
              'headerIcon' => 'ace-icon fa fa-list',
              'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
)); ?>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('item-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link(Yii::t('app','Advanced Search'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget( 'ext.modaldlg.EModalDlg' ); ?>

<?php if ( Yii::app()->user->checkAccess('item.create') ) { ?>

    <?php echo TbHtml::linkButton(Yii::t( 'app', 'Add New' ),array(
            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
            'size'=>TbHtml::BUTTON_SIZE_SMALL,
            'icon'=>'ace-icon fa fa-plus white',
            'url'=>$this->createUrl('createImage'),
    )); ?>

    <?php echo TbHtml::linkButton(Yii::t( 'app', 'New Category' ),array(
            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
            'size'=>TbHtml::BUTTON_SIZE_SMALL,
            'icon'=>'glyphicon-briefcase white',
            'url'=>$this->createUrl('category/create'),
            'class'=>'update-dialog-open-link',
            'data-update-dialog-title' => Yii::t('app','New Category'),
    )); ?>

    <?php echo TbHtml::linkButton(Yii::t( 'app', 'List of Categories' ),array(
            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
            'size'=>TbHtml::BUTTON_SIZE_SMALL,
            'icon'=>'glyphicon-list white',
            'url'=>$this->createUrl('category/admin'),
    )); ?>

<?php } ?>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<?php endif; ?>  

<?php $this->widget('yiiwheels.widgets.grid.WhGridView',array(
	'id'=>'item-grid',
        'fixedHeader' => true,
        'type' => TbHtml::GRID_TYPE_HOVER,
        //'headerOffset' => 40,
        //'responsiveTable' => true,
        'htmlOptions'=>array('class'=>'table-responsive'),
	'dataProvider'=>$model->search(),
	'columns'=>array(
                /*
		array('name'=>'id',
                      'value'=>'CHtml::link(CHtml::image(Yii::app()->controller->createUrl("loadImage", array("id"=>$data->primaryKey))),array(Yii::app()->controller->createUrl("loadImage", array("id"=>$data->primaryKey))),array("data-rel"=>"colorbox"));',
                      'type'=>'raw',
                ),
                  * 
                */
		array('name'=>'item_number',
                      'header'=>'ItemNumber'
                      //'headerHtmlOptions'=>array('class'=>'hidden-480 hidden-xs hidden-md'),
                      //'htmlOptions'=>array('class' => 'hidden-480 hidden-xs hidden-md'),
                ),  
                array('name'=>'name',
                      'header'=>'Name', 
                      'value' => 'CHtml::link($data->name, Yii::app()->createUrl("item/UpdateImage",array("id"=>$data->primaryKey)))',
                     'type'  => 'raw',   
                ), /*
                array('name'=>'description',
                      'headerHtmlOptions'=>array('class'=>'hidden-480 hidden-xs'),
                      'htmlOptions'=>array('class' => 'hidden-480 hidden-xs'),
                ),
                 * 
                */
                array('name'=>'location',
                      //'headerHtmlOptions'=>array('class'=>'hidden-480 hidden-xs hidden-md'),
                      //'htmlOptions'=>array('class' => 'hidden-480 hidden-xs hidden-md'),
                ),
               
		array('name' => 'category_id',
                      'header'=>'Category',
                      //'headerHtmlOptions'=>array('class'=>'hidden-480 hidden-xs hidden-md'),  
                      'value' => '$data->category_id==null? " " : $data->category->name',
                      //'htmlOptions'=>array('class' => 'hidden-480 hidden-xs hidden-md'),  
                ),
                /*
		array('name'=>'supplier_id',
                      'value'=>'($data->supplier_id==null || $data->supplier_id==0)? "N/A" : $data->supplier->company_name'
                ),
                 * 
                */
                /*
                array('name'=>'cost_price',
                      'headerHtmlOptions'=>array('class'=>'hidden-480 hidden-xs hidden-md'),
                      'htmlOptions'=>array('class' => 'hidden-480 hidden-xs hidden-md'),
                ),
                 * 
                */ 
                array('name'=>'unit_price',
                      'header'=>'SellPrice',
                ),
                array('name'=>'quantity',
                    //'headerHtmlOptions'=>array('class'=>'hidden-480 hidden-xs hidden-md'),
                    //'htmlOptions'=>array('class' => 'hidden-480 hidden-xs hidden-md'),  
                ),
                array('name'=>'status',
                    'type'=>'raw',
                    'value'=>'$data->status==1 ? TbHtml::labelTb("Activated", array("color" => TbHtml::LABEL_COLOR_SUCCESS)) : TbHtml::labelTb("De-Activated", array("color" => TbHtml::LABEL_COLOR_WARNING))', 
                    //'value' => 'TbHtml::labelTb($data->status)',
                    //'headerHtmlOptions'=>array('class'=>'hidden-480'),
                    //'htmlOptions'=>array('class' => 'hidden-480'),  
                ),
                array('class'=>'bootstrap.widgets.TbButtonColumn',
                      'template'=>'<div class="hidden-sm hidden-xs btn-group">{detail}{cost}{price}{delete}{undeleted}</div>',
                      'buttons' => array(
                          'detail' => array(
                            'click' => 'updateDialogOpen',   
                            'label'=>Yii::t('app','Stock'),
                            'url'=>'Yii::app()->createUrl("Inventory/admin", array("item_id"=>$data->id))',
                            'options' => array(
                                'data-toggle' => 'tooltip', 
                                'data-update-dialog-title' => 'Stock History',
                                'class'=>'btn btn-xs btn-pink', 
                                'title'=>'Stock History',
                              ), 
                          ),
                          'cost' => array(
                            'click' => 'updateDialogOpen',
                            'label'=>Yii::t('app','Cost'),
                            'url'=>'Yii::app()->createUrl("Item/CostHistory", array("item_id"=>$data->id))',
                            'options' => array(
                                'data-update-dialog-title' => Yii::t('app','Cost History'),
                                'class'=>'btn btn-xs btn-info',
                                'title'=>'Cost History',
                            ),
                            'visible'=>'Yii::app()->user->checkAccess("item.create") || Yii::app()->user->checkAccess("item.update")',   
                          ),
                          'price' => array(
                            'click' => 'updateDialogOpen',
                            //'label'=>"<span class='text-info'>" . Yii::t('app','Price') . "</span><i class='icon-info-sign'></i> ",
                            'label'=>Yii::t('app','Price'),  
                            'url'=>'Yii::app()->createUrl("Item/PriceHistory", array("item_id"=>$data->id))',
                            'options' => array(
                                'data-update-dialog-title' => Yii::t('app','Price History'),
                                'class'=>'btn btn-xs btn-success',
                                'title'=>'Price History',
                            ), 
                            'visible'=>'Yii::app()->user->checkAccess("item.create") || Yii::app()->user->checkAccess("item.update")',   
                          ),
                          /*
                          'edit' => array(
                            'label'=>Yii::t('app','Edit Item'),
                            'url'=>'Yii::app()->createUrl("Item/UpdateImage", array("id"=>$data->id))',  
                            'icon'=>'bigger-120 ace-icon fa fa-edit',
                            'visible'=>'Yii::app()->user->checkAccess("item.update")',
                            'options' => array(
                                'class' => 'btn btn-xs btn-info',
                            )
                          ),
                           * 
                          */
                          'delete' => array(
                            'label'=>Yii::t('app','Delete Item'),
                            'icon'=>'bigger-120 glyphicon-trash',
                            'options' => array(
                                'class'=>'btn btn-xs btn-danger',
                             ), 
                             'visible'=>'$data->status=="1" && Yii::app()->user->checkAccess("item.delete")', 
                          ),
                          'undeleted' => array(
                            'label'=>Yii::t('app','Undo Delete Item'),
                            'url'=>'Yii::app()->createUrl("Item/UndoDelete", array("id"=>$data->id))',
                            'icon'=>'bigger-120 glyphicon-refresh',
                            'options' => array(
                                'class'=>'btn btn-xs btn-warning btn-undodelete',
                            ), 
                            'visible'=>'$data->status=="0" && Yii::app()->user->checkAccess("item.delete")',
                           ),
                       ),
                 ), 
                 array('class'=>'bootstrap.widgets.TbButtonColumn',
                      'template'=>'<div class="hidden-md hidden-lg"><div class="inline position-relative">
                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto"><i class="ace-icon fa fa-cog icon-only bigger-110"></i></button>
                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                    <li>{stock}</li><li>{cost1}</li><li>{price}</li><li>{delete1}</li><li>{undeleted1}</li>
                                    </ul></div></div>',
                      //'htmlOptions'=>array('class'=>'hidden-sm hidden-xs btn-group'),
                      'buttons' => array(
                           'stock' => array(
                            'click' => 'updateDialogOpen',
                            'label'=>Yii::t('app','Stock'),
                            'url'=>'Yii::app()->createUrl("Inventory/admin", array("item_id"=>$data->id))',
                            'options' => array(
                                'data-toggle' => 'tooltip', 
                                'data-update-dialog-title' => 'Stock History',
                                'class'=>'btn btn-sm btn-pink', 
                                'title'=>'Stock History',
                              ), 
                          ),
                          'cost1' => array(
                            'click' => 'updateDialogOpen',
                            'label'=>Yii::t('app','Cost'),
                            'url'=>'Yii::app()->createUrl("Item/CostHistory", array("item_id"=>$data->id))',
                            'options' => array(
                                'data-update-dialog-title' => Yii::t('app','Cost History'),
                                'class'=>'btn btn-sm btn-info',
                                'title'=>'Cost History',
                            ),
                            'visible'=>'Yii::app()->user->checkAccess("item.create") || Yii::app()->user->checkAccess("item.update")',   
                          ),
                          'price' => array(
                            'click' => 'updateDialogOpen',
                            //'label'=>"<span class='text-info'>" . Yii::t('app','Price') . "</span><i class='icon-info-sign'></i> ",
                            'label'=>Yii::t('app','Price'),  
                            'url'=>'Yii::app()->createUrl("Item/PriceHistory", array("item_id"=>$data->id))',
                            'options' => array(
                                'data-update-dialog-title' => Yii::t('app','Price History'),
                                'class'=>'btn btn-sm btn-success',
                                'title'=>'Price History',
                            ),
                            'visible'=>'Yii::app()->user->checkAccess("item.create") || Yii::app()->user->checkAccess("item.update")',   
                          ),
                          /*
                          'update1' => array(
                            'label'=>Yii::t('app','Edit Item'),
                            'icon'=>'bigger-120 ace-icon fa fa-edit',
                            'options' => array(
                                'class'=>'btn btn-xs btn-info',
                             ), 
                          ),
                           * 
                          */
                          'delete1' => array(
                            'label'=>Yii::t('app','Delete Item'),  
                            'url'=>'Yii::app()->createUrl("item/delete/",array("id"=>$data->id))',
                            'icon'=>'bigger-120 glyphicon-trash',
                            'options' => array(
                                'class'=>'btn btn-xs btn-danger',
                            ), 
                            'visible'=>'$data->status=="1" && Yii::app()->user->checkAccess("item.delete")',
                          ),
                          'undeleted1' => array(
                            'label'=>Yii::t('app','Undo Delete Item'),
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
</div>

<div class="panel panel-default">
       <div class="panel-heading">
                <h3 class="panel-title">User</h3>
        </div>
      <div class="table-responsive">
        <table class="table table-hover">
                <thead>
                  <tr>
                          <th>col1</th>
                          <th>col2</th>
                          <th>col3</th>
                          <th>col4</th>
                          <th>col5</th>
                          <th>col6</th>
                          <th>col7</th>
                          <th>col8</th>
                          <th>col9</th>
                          <th>col10323423234234</th>
                  </tr>
          </thead>
          <tbody>
                  <tr>
                        <td>Testing</td>
                        <td>Testingwithlongword</td>
                        <td>2ndverylongwordfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff</td>
                        <td>Testing</td>
                        <td>Testing</td>
                        <td>Testing</td>
                        <td>Testing</td>
                        <td>Testing</td>
                        <td>Testing</td>
                        <td>Testing</td>
                  </tr>
          </tbody>

        </table>
</div>
</div>

<script>
$(document).ready(function () {
window.setTimeout(function() {
    $(".alert").fadeTo(2000, 0).slideUp(2000, function(){
        $(this).remove(); 
    });
}, 2000); 
});
</script>

<?php 
    Yii::app()->clientScript->registerScript( 'undoDelete', "
        jQuery( function($){
            $('div#item_cart').on('click','a.btn-undodelete',function(e) {
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
                            $.fn.yiiGridView.update('item-grid');
                            return false;
                          }
                    });
                });
        });
      ");
 ?>  

<div class="waiting"><!-- Place at bottom of page --></div>