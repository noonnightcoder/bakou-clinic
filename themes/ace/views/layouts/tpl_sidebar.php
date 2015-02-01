<!--
<div class="sidebar-shortcuts" id="sidebar-shortcuts">
    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
        <?php //echo TbHtml::linkButton('', array('url'=>Yii::app()->urlManager->createUrl('settings/index'),'color' => TbHtml::BUTTON_COLOR_DANGER,'icon'=>'ace-icon fa fa-cog','size'=> TbHtml::BUTTON_SIZE_SMALL)); ?>
        <?php //echo TbHtml::linkButton('', array('url'=>Yii::app()->urlManager->createUrl('client/admin'),'color' => TbHtml::BUTTON_COLOR_WARNING,'icon'=>'ace-icon fa fa-group','size'=> TbHtml::BUTTON_SIZE_SMALL)); ?>
        <?php //echo TbHtml::linkButton('', array('url'=>Yii::app()->urlManager->createUrl('report/SaleReportTab'),'color' => TbHtml::BUTTON_COLOR_SUCCESS,'icon'=>'ace-icon fa fa-signal','size'=> TbHtml::BUTTON_SIZE_SMALL)); ?>
        <?php //echo TbHtml::linkButton('', array('url'=>Yii::app()->urlManager->createUrl('report/SaleInvoice'),'color' => TbHtml::BUTTON_COLOR_INFO,'icon'=>'ace-icon fa fa-pencil','size'=> TbHtml::BUTTON_SIZE_SMALL)); ?>
    </div>
    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>
            <span class="btn btn-info"></span>
            <span class="btn btn-warning"></span>
            <span class="btn btn-danger"></span>
    </div>
</div><!--#sidebar-shortcuts-->
<?php 
$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'submenuHtmlOptions'=>array('class'=>'submenu'),
    'encodeLabel' => false,
    'items' => array(
            array('label'=>'<span class="menu-text">' . strtoupper(Yii::t('menu', 'Dashboard')) . '</span>', 'icon'=>'menu-icon fa fa-tachometer', 'url'=>Yii::app()->urlManager->createUrl('dashboard/view'), 'active'=>$this->id .'/'. $this->action->id=='dashboard/view'?true:false,
                    'visible'=> Yii::app()->user->checkAccess('report.index')
            ),
            /*
            array('label'=>'<span class="menu-text">' . strtoupper(Yii::t('menu', 'Item')) . '</span>', 'icon'=>'menu-icon fa fa-coffee', 'url'=>Yii::app()->urlManager->createUrl('item/admin'), 'active'=>$this->id .'/'. $this->action->id=='item/admin',
                'visible'=> Yii::app()->user->checkAccess('item.index') || Yii::app()->user->checkAccess('item.create') || Yii::app()->user->checkAccess('item.update') || Yii::app()->user->checkAccess('item.delete')),
            array('label'=>'<span class="menu-text">' . strtoupper(Yii::t('menu','Transaction')) .'</span>', 'icon'=>'menu-icon fa fa-desktop','url'=>Yii::app()->urlManager->createUrl('receivingItem/index'),'active'=>$this->id .'/'. $this->action->id=='receivingItem/index',
                'visible'=> Yii::app()->user->checkAccess('transaction.receive') || Yii::app()->user->checkAccess('transaction.return') || Yii::app()->user->checkAccess('transaction.adjustin') || Yii::app()->user->checkAccess('transaction.adjustout') || Yii::app()->user->checkAccess('transaction.count') ,
                'items'=>array(
                    array('label'=> Yii::t('menu','Receive from Supplier'),'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('receivingItem/index',array('trans_mode'=>'receive')), 'active'=>$this->id .'/'. $this->action->id .'/'.Yii::app()->request->getQuery('trans_mode')=='receivingItem/index/receive','visible'=>Yii::app()->user->checkAccess('transaction.receive')),
                    array('label'=> Yii::t('menu','Return to Supplier'), 'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('receivingItem/index',array('trans_mode'=>'return')),'active'=>$this->id .'/'. $this->action->id .'/'.Yii::app()->request->getQuery('trans_mode')=='receivingItem/index/return','visible'=>Yii::app()->user->checkAccess('transaction.return')),
                    array('label'=> Yii::t('menu','Adjustment In'),'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('receivingItem/index',array('trans_mode'=>'adjustment_in')),'active'=>$this->id .'/'. $this->action->id.'/'.Yii::app()->request->getQuery('trans_mode')=='receivingItem/index/adjustment_in','visible'=>Yii::app()->user->checkAccess('transaction.adjustin')),
                    array('label'=> Yii::t('menu','Adjustment Out'),'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('receivingItem/index',array('trans_mode'=>'adjustment_out')),'active'=>$this->id .'/'. $this->action->id.'/'.Yii::app()->request->getQuery('trans_mode')=='receivingItem/index/adjustment_out','visible'=>Yii::app()->user->checkAccess('transaction.adjustout')),
                    array('label'=> Yii::t('menu','Physical Count'),'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('receivingItem/index',array('trans_mode'=>'physical_count')),'active'=>$this->id .'/'. $this->action->id.'/'.Yii::app()->request->getQuery('trans_mode')=='receivingItem/index/physical_count','visible'=>Yii::app()->user->checkAccess('transaction.count')),
            )),
            array('label'=>'<span class="menu-text">' . strtoupper(Yii::t('menu', 'Sale')). '</span>', 'icon'=>'menu-icon fa fa-shopping-cart', 'url'=>Yii::app()->urlManager->createUrl('saleItem/index'), 'active'=>$this->id .'/'. $this->action->id=='saleItem/index',
                'visible'=> Yii::app()->user->checkAccess('sale.edit') || Yii::app()->user->checkAccess('sale.discount') || Yii::app()->user->checkAccess('sale.editprice') ),
            array('label'=>'<span class="menu-text">' . strtoupper(Yii::t('menu', 'Report')) .'</span>', 'icon'=>'menu-icon fa fa-signal', 'url'=>Yii::app()->urlManager->createUrl('report/reporttab'),'active'=>$this->id =='report',
                           'visible'=> Yii::app()->user->checkAccess('report.index') || Yii::app()->user->checkAccess('invoice.index') || Yii::app()->user->checkAccess('invoice.print') || Yii::app()->user->checkAccess('invoice.delete') || Yii::app()->user->checkAccess('invoice.update') ,
                'items'=>array(
                    array('label'=> Yii::t('app','Sale Invoices'),'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('report/SaleInvoice'), 'active'=>$this->id .'/'. $this->action->id =='report/SaleInvoice',
                        'visible'=> Yii::app()->user->checkAccess('invoice.index') || Yii::app()->user->checkAccess('invoice.print') || Yii::app()->user->checkAccess('invoice.delete') || Yii::app()->user->checkAccess('invoice.update')
                    ),
                    array('label'=> Yii::t('app','Sale Item Summary'),'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('report/SaleItemSummary'), 'active'=>$this->id .'/'. $this->action->id =='report/SaleItemSummary',
                        'visible'=> Yii::app()->user->checkAccess('report.index') 
                    ),
                    array('label'=> Yii::t('app','Sales Reports'), 'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('report/SaleReportTab'),'active'=>$this->id .'/'. $this->action->id =='report/SaleReportTab',
                        'visible'=> Yii::app()->user->checkAccess('report.index') 
                    ),
                    array('label'=> Yii::t('app','Item Expiry'), 'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('report/itemExpiry'),'active'=>$this->id .'/'. $this->action->id =='report/itemExpiry',
                        'visible'=> Yii::app()->user->checkAccess('report.index')  || Yii::app()->settings->get('item', 'itemExpireDate')=='1' 
                        ),
                    array('label'=> Yii::t('app','Inventories'), 'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('report/Inventory'),'active'=>$this->id .'/'. $this->action->id =='report/Inventory',
                        'visible'=> Yii::app()->user->checkAccess('report.index') 
                    ),
                    array('label'=>Yii::t('app','Stock Count'), 'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('report/StockCount'),'active'=>$this->id .'/'. $this->action->id =='report/StockCount',
                        'visible'=> Yii::app()->user->checkAccess('report.index') 
                    ),
                    array('label'=>Yii::t('menu','Transaction'), 'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('report/Transaction'),'active'=>$this->id .'/'. $this->action->id =='report/Transaction',
                        'visible'=> Yii::app()->user->checkAccess('report.index') 
                    ),
                    array('label'=>Yii::t('app','Total Asset'), 'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('report/ItemAsset'),'active'=>$this->id .'/'. $this->action->id =='report/ItemAsset',
                        'visible'=> Yii::app()->user->checkAccess('report.index') 
                    ),
            )),
             * 
            */
            array('label'=>'<span class="menu-text">'. strtoupper(Yii::t('menu','PIM')) . '</span>', 'icon'=>'menu-icon fa fa-group','url'=>Yii::app()->urlManager->createUrl('client/admin'),
                           'active'=>$this->id=='employee' || $this->id=='supplier' || $this->id=='client' || $this->id=='publisher',
                           'visible'=> Yii::app()->user->checkAccess('store.update') || Yii::app()->user->checkAccess('employee.index') || Yii::app()->user->checkAccess('client.index'),
                           'items'=>array(
                               /*
                               array('label'=>Yii::t('menu', 'Customer') , 'icon'=> TbHtml::ICON_USER, 'url'=>Yii::app()->urlManager->createUrl('client/admin'), 'active'=>$this->id .'/'. $this->action->id=='client/admin',
                                   'visible'=> Yii::app()->user->checkAccess('client.index') || Yii::app()->user->checkAccess('client.create') || Yii::app()->user->checkAccess('client.update') || Yii::app()->user->checkAccess('client.delete')
                               ),
                                * 
                               */
                               array('label'=>Yii::t('menu', 'Employee'), 'icon'=> TbHtml::ICON_USER, 'url'=>Yii::app()->urlManager->createUrl('employee/admin'), 'active'=>$this->id .'/'. $this->action->id=='employee/admin',
                                   'visible'=> Yii::app()->user->checkAccess('employee.index') || Yii::app()->user->checkAccess('employee.create') || Yii::app()->user->checkAccess('employee.update') || Yii::app()->user->checkAccess('employee.delete')
                               ),
                               //array('label'=>Yii::t('menu', 'Publisher'), 'icon'=> TbHtml::ICON_USER, 'url'=>Yii::app()->urlManager->createUrl('publisher/admin'), 'active'=>$this->id .'/'. $this->action->id=='publisher/admin','visible'=>Yii::app()->user->checkAccess('supplier.index')),
                               /*
                               array('label'=>Yii::t('menu','Supplier'), 'icon'=> TbHtml::ICON_USER, 'url'=>Yii::app()->urlManager->createUrl('supplier/admin'), 'active'=>$this->id .'/'. $this->action->id=='supplier/admin','visible'=>Yii::app()->user->checkAccess('supplier.index'),
                                    'visible'=> Yii::app()->user->checkAccess('supplier.index') || Yii::app()->user->checkAccess('supplier.create') || Yii::app()->user->checkAccess('supplier.update') || Yii::app()->user->checkAccess('supplier.delete')
                               ),
                                * 
                               */
            )),
            array('label'=>'<span class="menu-text">'. strtoupper(Yii::t('menu','Settings')) . '</span>', 'icon'=>'menu-icon fa fa-cogs','url'=>Yii::app()->urlManager->createUrl('settings/index'),
                           'active'=>$this->id=='priceTier' || strtolower($this->id)=='default' || $this->id=='store' || $this->id=='settings' || $this->id=='location',
                           'visible'=>Yii::app()->user->checkAccess('store.update'),
                           'items'=>array(
                               //array('label'=>Yii::t('menu', 'Employee'), 'icon'=> TbHtml::ICON_USER, 'url'=>Yii::app()->urlManager->createUrl('employee/admin'), 'active'=>$this->id .'/'. $this->action->id=='employee/admin','visible'=>Yii::app()->user->checkAccess('employee.index')),
                               //array('label'=>Yii::t('menu', 'Publisher'), 'icon'=> TbHtml::ICON_USER, 'url'=>Yii::app()->urlManager->createUrl('publisher/admin'), 'active'=>$this->id .'/'. $this->action->id=='publisher/admin','visible'=>Yii::app()->user->checkAccess('supplier.index')),
                               //array('label'=>Yii::t('menu','Supplier'), 'icon'=> TbHtml::ICON_USER, 'url'=>Yii::app()->urlManager->createUrl('supplier/admin'), 'active'=>$this->id .'/'. $this->action->id=='supplier/admin','visible'=>Yii::app()->user->checkAccess('supplier.index')),
                               //array('label'=>Yii::t('menu','Price Tier'),'icon'=> TbHtml::ICON_ADJUST, 'url'=>Yii::app()->urlManager->createUrl('priceTier/admin'), 'active'=>$this->id .'/'. $this->action->id=='priceTier/admin','visible'=>Yii::app()->user->checkAccess('store.update')),
                               //array('label'=>Yii::t('menu','Location'),'icon'=> TbHtml::ICON_MAP_MARKER, 'url'=>Yii::app()->urlManager->createUrl('location/admin'), 'active'=>$this->id .'/'. $this->action->id=='location/admin','visible'=>Yii::app()->user->checkAccess('store.update')),
                               array('label'=>Yii::t('menu','Shop Setting'),'icon'=> TbHtml::ICON_COG, 'url'=>Yii::app()->urlManager->createUrl('settings/index'), 'active'=>$this->id=='settings','visible'=>Yii::app()->user->checkAccess('store.update')),
                               //array('label'=>Yii::t('menu','Branch'),'icon'=> TbHtml::ICON_HOME, 'url'=>Yii::app()->urlManager->createUrl('store/admin'), 'active'=>$this->id .'/'. $this->action->id=='store/admin','visible'=>Yii::app()->user->checkAccess('store.update')),
                               //array('label'=>Yii::t('menu','Database Backup'),'icon'=> TbHtml::ICON_HDD, 'url'=>Yii::app()->urlManager->createUrl('backup/default/index'),'active'=> $this->id =='default'),
            )),
            array('label'=>'<span class="menu-text">' . strtoupper(Yii::t('menu', 'About US')) . '</span>', 'icon'=>'menu-icon fa fa-info-circle', 'url'=>Yii::app()->urlManager->createUrl('site/about'), 'active'=>$this->id .'/'. $this->action->id=='site/about'),
    ), 
)); 
?>

<!-- #section:basics/sidebar.layout.minimize -->
<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
    <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
</div>

<!-- /section:basics/sidebar.layout.minimize -->
<script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
</script>