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
                'visible'=> Yii::app()->user->checkAccess('report.index') || Yii::app()->user->checkAccess('appointment.index')
            ),
            array('label'=>'<span class="menu-text">'. strtoupper(Yii::t('menu','Patient')) . '</span>', 'icon'=>'menu-icon fa fa-group','url'=>Yii::app()->urlManager->createUrl('patient/index'),
                'active'=>$this->id=='contact' || $this->id=='appointment' || strtolower($this->id)=='default' || $this->id=='location' ,
                'visible'=>Yii::app()->user->checkAccess('maintask.service'),
                'items'=>array(
                    array('label'=>Yii::t('menu','Patient'),'icon'=> 'fa fa-users', 'url'=>Yii::app()->urlManager->createUrl('contact/admin'), 'active'=>$this->id=='contact',
                        'visible'=>Yii::app()->user->checkAccess('contact.index') ||Yii::app()->user->checkAccess('contact.create') ||Yii::app()->user->checkAccess('contact.view')
                    ),
                    array('label'=>Yii::t('menu','Appointment'),'icon'=> 'fa fa-calendar', 'url'=>Yii::app()->urlManager->createUrl('appointment/appointmentdash'),'active'=>$this->id .'/'. $this->action->id=='appointment/appointmentdash',
                        'visible'=>Yii::app()->user->checkAccess('appointment.index')
                            || Yii::app()->user->checkAccess('appointment.create')
                            || Yii::app()->user->checkAccess('appointment.delete')
                            || Yii::app()->user->checkAccess('appointment.update')
                    ),
                    array('label'=>Yii::t('menu','Waiting Queue'),'icon'=> 'fa fa-user-md', 'url'=>Yii::app()->urlManager->createUrl('appointment/WaitingQueue'),'active'=>$this->id .'/'. $this->action->id=='appointment/WaitingQueue',
                        'visible'=>Yii::app()->user->checkAccess('appointment.waitingqueue')
                    ),
                    array('label'=>Yii::t('menu','Prescription Bill'),'icon'=> 'fa fa-plus-square', 'url'=>Yii::app()->urlManager->createUrl('appointment/Prescription'), 'active'=>$this->id=='Prescription',
                        'visible'=>Yii::app()->user->checkAccess('prescription.view')
                    ),
                    array('label'=>Yii::t('menu','Laboratory'),'icon'=> 'fa fa-stethoscope', 'url'=>Yii::app()->urlManager->createUrl('appointment/labocheck'), 'active'=>$this->id=='labocheck',
                        'visible'=>Yii::app()->user->checkAccess('laboratory.view')
                    ),
                    array('label'=>Yii::t('menu','Pharmacy'),'icon'=> 'fa fa-ambulance', 'url'=>Yii::app()->urlManager->createUrl('appointment/pharmacy'), 'active'=>$this->id=='pharmacy',
                        'visible'=>Yii::app()->user->checkAccess('pharmacy.view')
                    ),
                )
            ),
            array('label'=>'<span class="menu-text">' . strtoupper(Yii::t('menu','Transaction')) .'</span>', 'icon'=>'menu-icon fa fa-desktop','url'=>Yii::app()->urlManager->createUrl('receivingItem/index'),'active'=>$this->id .'/'. $this->action->id=='receivingItem/index',
                'visible'=> Yii::app()->user->checkAccess('maintask.transaction'),
                'items'=>array(
                    array('label'=> Yii::t('menu','Receive from Supplier'),'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('receivingItem/index',array('trans_mode'=>'receive')), 'active'=>$this->id .'/'. $this->action->id .'/'.Yii::app()->request->getQuery('trans_mode')=='receivingItem/index/receive','visible'=>Yii::app()->user->checkAccess('transaction.receive')),
                    array('label'=> Yii::t('menu','Return to Supplier'), 'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('receivingItem/index',array('trans_mode'=>'return')),'active'=>$this->id .'/'. $this->action->id .'/'.Yii::app()->request->getQuery('trans_mode')=='receivingItem/index/return','visible'=>Yii::app()->user->checkAccess('transaction.return')),
                    //array('label'=> Yii::t('menu','Adjustment In'),'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('receivingItem/index',array('trans_mode'=>'adjustment_in')),'active'=>$this->id .'/'. $this->action->id.'/'.Yii::app()->request->getQuery('trans_mode')=='receivingItem/index/adjustment_in','visible'=>Yii::app()->user->checkAccess('transaction.adjustin')),
                    //array('label'=> Yii::t('menu','Adjustment Out'),'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('receivingItem/index',array('trans_mode'=>'adjustment_out')),'active'=>$this->id .'/'. $this->action->id.'/'.Yii::app()->request->getQuery('trans_mode')=='receivingItem/index/adjustment_out','visible'=>Yii::app()->user->checkAccess('transaction.adjustout')),
                    array('label'=> Yii::t('menu','Physical Count'),'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('receivingItem/index',array('trans_mode'=>'physical_count')),'active'=>$this->id .'/'. $this->action->id.'/'.Yii::app()->request->getQuery('trans_mode')=='receivingItem/index/physical_count','visible'=>Yii::app()->user->checkAccess('transaction.count')),
                )
            ),
            array('label'=>'<span class="menu-text">'. strtoupper(Yii::t('menu','Setting')) . '</span>', 'icon'=>'menu-icon fa fa-cogs','url'=>Yii::app()->urlManager->createUrl('settings/index'),
                'active'=>$this->id=='employee' || $this->id=='clinic' || $this->id=='treatment' || $this->id=='item',
                'visible'=>Yii::app()->user->checkAccess('maintask.setting'),
                'items'=>array(
                    array('label'=>Yii::t('menu', 'Clinic'), 'icon'=> 'fa fa-h-square', 'url'=>Yii::app()->urlManager->createUrl('clinic/ClinicInfo'), 'active'=>$this->id .'/'. $this->action->id=='clinic/ClinicInfo',
                    'visible'=> Yii::app()->user->checkAccess('clinic.index') 
                        || Yii::app()->user->checkAccess('clinic.create') 
                        || Yii::app()->user->checkAccess('clinic.update') 
                        || Yii::app()->user->checkAccess('clinic.delete')
                    ),
                    array('label'=>Yii::t('menu', 'Employee'), 'icon'=> TbHtml::ICON_USER, 'url'=>Yii::app()->urlManager->createUrl('employee/admin'), 'active'=>$this->id .'/'. $this->action->id=='employee/admin',
                    'visible'=> Yii::app()->user->checkAccess('employee.index') 
                        || Yii::app()->user->checkAccess('employee.create') 
                        || Yii::app()->user->checkAccess('employee.update') 
                        || Yii::app()->user->checkAccess('employee.delete')
                    ),
                    array('label'=>Yii::t('menu', 'Treatment'), 'icon'=> TbHtml::ICON_PLUS_SIGN, 'url'=>Yii::app()->urlManager->createUrl('treatment/admin'), 'active'=>$this->id .'/'. $this->action->id=='treatment/admin',
                    'visible'=> Yii::app()->user->checkAccess('treatment.index') 
                        || Yii::app()->user->checkAccess('treatment.create') 
                        || Yii::app()->user->checkAccess('treatment.update') 
                        || Yii::app()->user->checkAccess('treatment.delete')
                    ),
                    array('label'=>Yii::t('menu', 'Item'), 'icon'=> TbHtml::ICON_SHOPPING_CART, 'url'=>Yii::app()->urlManager->createUrl('Item/admin'), 'active'=>$this->id .'/'. $this->action->id=='Item/admin',
                    'visible'=> Yii::app()->user->checkAccess('item.index') 
                        || Yii::app()->user->checkAccess('item.create') 
                        || Yii::app()->user->checkAccess('item.update') 
                        || Yii::app()->user->checkAccess('item.delete')
                    ),
                )
            ),
            array('label'=>'<span class="menu-text">' . strtoupper(Yii::t('menu', 'About US')) . '</span>', 'icon'=>'menu-icon fa fa-info-circle', 'url'=>Yii::app()->urlManager->createUrl('site/about'), 'active'=>$this->id .'/'. $this->action->id=='site/about'),
            ),
        )
    );
?>
<!-- #section:basics/sidebar.layout.minimize -->
<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
    <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
</div>
<!-- /section:basics/sidebar.layout.minimize -->
<script type="text/javascript">
    try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
</script>
