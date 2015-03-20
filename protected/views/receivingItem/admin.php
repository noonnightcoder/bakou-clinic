<!-- PAGE CONTENT ENDS -->
<div id="register_container"> 

<div class="col-xs-12 col-sm-8 widget-container-col">
    <div class="message" style="display:none">
        <div class="alert in alert-block fade alert-success">Transaction Failed !</div>
    </div>

    <?php $this->renderPartial('_search',array(
            'model'=>$model,'trans_header'=>Yii::t('menu',$trans_header)
    )); ?>

    <div class="grid-view" id="grid_cart">  
        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                'id'=>'receiving-item-form',
                'enableAjaxValidation'=>false,
                'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        )); ?>
        <?php 
        if (isset($warning))
        {
            echo TbHtml::alert(TbHtml::ALERT_COLOR_INFO, $warning);
        }
        ?>
        <table class="table table-striped table-hover">
            <thead>
                <tr><th><?php echo Yii::t('app','Item Name'); ?></th>
                    <th><?php echo Yii::t('app','Buy Price'); ?></th>
                    <th><?php echo Yii::t('app','Sell Price'); ?></th>
                    <th><?php echo Yii::t('app','Quantity'); ?></th>
                    <th class="<?php echo Yii::app()->settings->get('sale', 'discount'); ?>"><?php echo Yii::t('app','Discount Amount'); ?></th>
                    <th class='<?php echo $expiredate_class; ?>'><?php echo Yii::t('app','model.receivingitem.expire_date'); ?></th>
                    <th><?php echo Yii::t('app','Total'); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="cart_contents">
                <?php foreach(array_reverse($items,true) as $id=>$item): ?>
                    <?php
                        if (substr($item['discount'],0,1)=='$')
                        {
                            $total_item=($item['cost_price']*$item['quantity']-substr($item['discount'],1));
                        }    
                        else  
                        {  
                            $total_item=($item['cost_price']*$item['quantity']-$item['cost_price']*$item['quantity']*$item['discount']/100);
                        }
                        
                        $item_id=$item['item_id'];
                        $cur_item_info= Item::model()->findbyPk($item_id);
                        $qty_in_stock=$cur_item_info->quantity;
                       
                        $item_expiredate_class='';
                        if ( $item['is_expire'] == 0 ) {
                            $item_expiredate_class='disabled';
                        }
                        
                        /*
                        $n_expire=0;
                        if (Yii::app()->receivingCart->getMode()<>'receive') {
                            $n_expire=ItemExpire::model()->count('item_id=:item_id and quantity>0',array('item_id'=>(int)$item['item_id']));
                        }
                         * 
                        */
                    ?>
                        <tr>
                            <td> 
                                <?php echo $item['name']; ?><br/>
                                <span class="text-info"><?php echo $qty_in_stock . ' ' . Yii::t('app','in stock') ?> </span>
                            </td>
                            <td>
                                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                                        'method'=>'post',
                                        'action' => Yii::app()->createUrl('receivingItem/editItem/',array('item_id'=>$item['item_id'])),
                                        'htmlOptions'=>array('class'=>'line_item_form'),
                                    ));
                                ?>
                                    <?php echo $form->textField($model,"cost_price",array('value'=>$item['cost_price'],'class'=>'input-small input-grid','id'=>"cost_price_$item_id",'placeholder'=>yii::t('app','Buy Price'),'maxlength'=>10,)); ?>
                                <?php $this->endWidget(); ?> 
                            </td>
                            <td>
                                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                                        'method'=>'post',
                                        'action' => Yii::app()->createUrl('receivingItem/editItem/',array('item_id'=>$item['item_id'])),
                                        'htmlOptions'=>array('class'=>'line_item_form'),
                                    ));
                                ?>
                                    <?php echo $form->textField($model,"unit_price",array('value'=>$item['unit_price'],'class'=>'input-small input-grid','id'=>"unit_price_$item_id",'placeholder'=>Yii::t('app','Sell Price'),'maxlength'=>10)); ?>
                                <?php $this->endWidget(); ?> 
                            </td>
                            <td>
                                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                                        'method'=>'post',
                                        'action' => Yii::app()->createUrl('receivingItem/editItem/',array('item_id'=>$item['item_id'])),
                                        'htmlOptions'=>array('class'=>'line_item_form'),
                                    ));
                                ?>
                                    <?php echo $form->textField($model,"quantity",array('value'=>$item['quantity'],'class'=>'input-small quantity','id'=>"quantity_$item_id",'placeholder'=>'Quantity','maxlength'=>10)); ?>
                                <?php $this->endWidget(); ?> 
                            </td>
                            <td class="<?php echo Yii::app()->settings->get('sale', 'discount'); ?>"><?php echo $form->textField($model,"discount",array('value'=>$item['discount'],'class'=>'input-small input-grid','placeholder'=>'Discount','maxlength'=>50)); ?></td>
                            <td class='<?php echo $expiredate_class; ?>'>
                                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                                        'method'=>'post',
                                        'action' => Yii::app()->createUrl('receivingItem/editItem/',array('item_id'=>$item['item_id'])),
                                        'htmlOptions'=>array('class'=>'line_item_form'),
                                    ));
                                ?>
                                    <?php $this->widget('yiiwheels.widgets.maskinput.WhMaskInput',array('model'=>$model,'attribute' => 'expire_date','mask' => '00/00/0000','value'=>$item['expire_date'],'htmlOptions' => array('id'=>"expire_date_$item_id",'placeholder' => '00/00/0000','value'=>$item['expire_date'],'class' => "input-xs input-grid","$item_expiredate_class"=>true))); ?>
                                    <?php //echo $form->textField($model,"expire_date",array('value'=>$item['expire_date'],'class'=>'input-small input-grid','id'=>"expire_date_$item_id",'placeholder'=>Yii::t('app','Expire Date'),'maxlength'=>20)); ?>
                                <?php $this->endWidget(); ?> 
                            </td>   
                           
                            <!--
                            <td> 
                                <?php /*
                                if ( $n_expire>0 ) { 
                                    echo TbHtml::dropDownList('expire_date','',ItemExpire::model()->getItemExpDate($item['item_id']),array('id'=>"expiredate_$item_id",
                                            'options'=>array($item['expire_date']=>array('selected'=>true)),
                                            'class'=>"expiredate input-sm",'data-id'=>"$item_id")); 
                                } else { 
                                     $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array('name' => 'datepickertest','value'=>$item['expire_date'],'pluginOptions' => array('format' => 'yyyy-mm-dd'),'htmlOptions'=>array('value'=>$item['expire_date'],'id'=>"expiredate_$item_id",'data-id'=>"$item_id",'class'=>'input-small'))); 
                                }
                                */ ?>
                            </td>
                            -->
                            <td><?php echo $total_item; ?>
                            <td><?php echo TbHtml::linkButton('',array(
                                    'color'=>TbHtml::BUTTON_COLOR_DANGER,
                                    'size'=>TbHtml::BUTTON_SIZE_MINI,
                                    'icon'=>'glyphicon-trash',
                                    'url'=>array('deleteItem','item_id'=>$item_id),
                                    'class'=>'delete-item',
                                    //'title' => Yii::t( 'app', 'Remove' ),
                                )); ?>
                            </td>
                        </tr> 
                <?php endforeach; ?> <!--/endforeach-->

            </tbody>
        </table>
        <?php $this->endWidget(); ?>  <!--/endformWidget-->     

        <?php
        if (empty($items)) {
            echo Yii::t('app','There are no items in the cart');
        }    

        ?> 

    </div> <!--/endgridcartdiv-->


</div> <!--/span8-->
    
<div class="col-xs-12 col-sm-4 widget-container-col">
    <!-- #section:canel-cart.layout -->
    <div class="row">
        <div id="cancel_cart">
            <?php if ($count_item <> 0) { ?> 
                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'cancel_recv_form',
                    'action' => Yii::app()->createUrl('receivingItem/cancelRecv/'),
                    'layout' => TbHtml::FORM_LAYOUT_INLINE,
                ));
                ?>
                    <div align="right">
                        <?php /*
                        echo TbHtml::linkButton(Yii::t('app', 'Suspend Sale'), array(
                            'color' => TbHtml::BUTTON_COLOR_WARNING,
                            'size' => TbHtml::BUTTON_SIZE_SMALL,
                            'icon' => 'glyphicon-pause white',
                            'url' => Yii::app()->createUrl('SaleItem/SuspendSale/'),
                            'class' => 'suspend-sale',
                            //'title' => Yii::t('app', 'Suspend Sale'),
                        ));
                         * 
                        */
                        ?>

                        <?php
                        echo TbHtml::linkButton(Yii::t('app', 'Cancel Recv'), array(
                            'color' => TbHtml::BUTTON_COLOR_DANGER,
                            'size' => TbHtml::BUTTON_SIZE_SMALL,
                            'icon' => '	glyphicon-remove white',
                            'url' => Yii::app()->createUrl('receivingItem/cancelRecv/'),
                            'class' => 'cancel-receiving',
                            'id' => 'cancel_receiving_button',
                            //'title' => Yii::t('app', 'Cancel Receiving'),
                        ));
                        ?>     
                    </div>
                <?php $this->endWidget(); ?>  
            <?php } ?>
        </div>    
    </div> <!-- #section:canel-cart.layout -->
    
    <div class="row">
        <div class="sidebar-nav" id="supplier_cart">
            <?php 
            if(isset($supplier)) 
            {
                $this->widget('yiiwheels.widgets.box.WhBox', array(
                       'title' => Yii::t('app','Supplier Info'),
                       'headerIcon' => 'menu-icon fa fa-info-circle',
                       'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'), 
                       'content' => $this->renderPartial('_supplier_selected',array('model'=>$model,'supplier'=>$supplier,'trans_mode'=>$trans_mode),true),
                 ));
            }else 
            { 
                $this->widget('yiiwheels.widgets.box.WhBox', array(
                       'title' => Yii::t('app','Select Supplier (Optional)'),
                       'headerIcon' => 'menu-icon fa fa-users',
                       'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),  
                       'content' => $this->renderPartial('_supplier',array('model'=>$model,'count_item'=>$count_item,'trans_mode'=>$trans_mode),true)
                 ));
            }
            ?>
         </div>
    </div>
    
    <div class="row">
        <div id="task_cart">
             <?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
                    'title' => Yii::t('app','Total Quantity') . ' : ' . $count_item,
                    'headerIcon' => 'menu-icon fa fa-tasks',
                    'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
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
        </div>
    </div>
</div> <!--/span4-->

<!-- PAGE CONTENT ENDS -->

<div class="waiting"><!-- Place at bottom of page --></div>

