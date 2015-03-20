<style>
<!--    
span {
    display:inline-block;
}
span img {
    width: 120px;
    height: 9em;
}
em {
    padding-top:4.5em;
    padding-bottom:4.5em;
}
</style>
<!-- #section:first.div.layout -->
<div class="col-xs-7">
    <div class="message" style="display:none">
            <div class="alert in alert-block fade alert-success">Transaction Failed !</div>
    </div>

    <div class="grid-view widget-box" id="grid_cart">  
            <div class="widget-header widget-header-flat widget-header-small">
                    <i class="ace-icon fa fa-shopping-cart"></i>
                    <h5 class="widget-title">Shopping Cart</h5>
                    <div class="widget-toolbar">
                            <div class="badge badge-info">
                                   <?php echo Yii::t('app','Item in Cart') . ' : ' .  $count_item;  ?> 
                            </div>
                    </div>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                        'action'=>Yii::app()->createUrl($this->route),
                        'method'=>'get',
                        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
                )); ?>    
                    <?php 
                    $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                        'asDropDownList' => false,
                        'model'=> $model, 
                        'attribute'=>'item_id',
                        'pluginOptions' => array(
                                'placeholder' => Yii::t('app','Type item name or scan bar code'),
                                'multiple'=>false,
                                'width' => '50%',
                                //'tokenSeparators' => array(',', ' '),
                                'allowClear'=>true,
                                'minimumInputLength'=>1,
                                'ajax' => array(
                                    'url' => Yii::app()->createUrl('Item/getItem/'), 
                                    'dataType' => 'json',
                                    'cache'=>true,
                                    'data' => 'js:function(term,page) {
                                                return {
                                                    term: term, 
                                                    page_limit: 10,
                                                    quietMillis: 100, //How long the user has to pause their typing before sending the next request
                                                    apikey: "e5mnmyr86jzb9dhae3ksgd73" // Please create your own key!
                                                };
                                            }',
                                    'results' => 'js:function(data,page){
                                        var remote = $(this);
                                        arr=data.results;
                                        var more = arr.filter(function(value) { return value !== undefined }).length;
                                        if (more==1)
                                        {
                                            var item_id=0;
                                            $.each(data.results, function(key,value){
                                                item_id=value.id;
                                            });
                                            var gridCart=$("#grid_cart");
                                            $.ajax({url: "Index",
                                                    dataType : "json",
                                                    data : {item_id : item_id},
                                                    type : "post",
                                                    beforeSend: function() { $(".waiting").show(); },
                                                    complete: function() { $(".waiting").hide(); },
                                                    success : function(data) {
                                                            if (data.status==="success")
                                                            {
                                                                console.log($(this).attr("id"));
                                                                gridCart.html(data.div_gridcart);
                                                                remote.select2("data", null);
                                                                location.reload();
                                                            }
                                                            else 
                                                            {
                                                               console.log(data.message);
                                                            }
                                                      }
                                                });
                                            }
                                        return { results: data.results };
                                     }',
                                ),
                                'initSelection' => 'js:function (element, callback) {
                                       var id=$(element).val();
                                       console.log(id);
                                }',
                                //'htmlOptions'=>array('id'=>'search_item_id'),
                        )));
                    ?>

                    <?php echo TbHtml::linkButton('',array(
                        'color'=>TbHtml::BUTTON_COLOR_INFO,
                        'size'=>TbHtml::BUTTON_SIZE_SMALL,
                        'icon'=>'glyphicon-hand-up white',
                        'url'=>$this->createUrl('Item/SelectItem/'),
                        'class'=>'update-dialog-open-link',
                        'data-update-dialog-title' => Yii::t('app','select items'),
                    )); ?>

                    <?php echo TbHtml::linkButton(Yii::t('app','Suspended Sale'),array(
                        'color'=>TbHtml::BUTTON_COLOR_INFO,
                        'size'=>TbHtml::BUTTON_SIZE_SMALL,
                        'icon' => 'glyphicon-pause white',
                        'url'=>Yii::app()->createUrl('SaleSuspended/Admin/'),
                     )); ?>


                     <?php /*echo TbHtml::linkButton(Yii::t( 'app', 'New Item' ),array(
                        'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        'size'=>TbHtml::BUTTON_SIZE_MINI,
                        'icon'=>'plus white',
                        'url'=>$this->createUrl('Item/Create/',array('grid_cart'=>'S')),
                        'class'=>'update-dialog-open-link',
                        'data-update-dialog-title' => Yii::t( 'app', 'form.client._form.header_create' ),
                    )); */?> 

                <?php $this->endWidget(); ?> <!--/endformWidget--> 
                <br>

                <div class="slim-scroll" data-height="350">

                    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                            'id'=>'sale-item-form',
                            'enableAjaxValidation'=>false,
                            'layout'=>TbHtml::FORM_LAYOUT_INLINE,
                    )); ?>
                    <?php /*
                    if (isset($warning))
                    {
                        echo TbHtml::alert(TbHtml::ALERT_COLOR_WARNING, $warning);
                    } */
                    ?>
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr><th><?php echo Yii::t('app','Item Name'); ?></th>
                                <th><?php echo Yii::t('app','Price'); ?></th>
                                <th><?php echo Yii::t('app','Quantity'); ?></th>
                                <th class="<?php echo Yii::app()->settings->get('system','discount'); ?>"><?php echo Yii::t('app','Discount'); ?></th>
                                <th><?php echo Yii::t('app','Total'); ?></th>
                                <th><?php echo Yii::t('app',''); ?></th>
                            </tr>
                        </thead>
                        <tbody id="cart_contents">
                            <?php foreach(array_reverse($items,true) as $id=>$item): ?>
                                <?php
                                    if (substr($item['discount'],0,1)=='$')
                                    {
                                        $total_item=number_format($item['price']*$item['quantity']-substr($item['discount'],1),Yii::app()->shoppingCart->getDecimalPlace());
                                    }    
                                    else  
                                    {  
                                        $total_item=number_format(($item['price']*$item['quantity']-$item['price']*$item['quantity']*$item['discount']/100),Yii::app()->shoppingCart->getDecimalPlace());
                                    } 
                                    $item_id=$item['item_id'];
                                    $cur_item_info= Item::model()->findbyPk($item_id);
                                    $qty_in_stock=$cur_item_info->quantity;
                                    $cur_item_unit= ItemUnitQuantity::model()->findbyPk($item_id);
                                    $unit_name='';
                                    if ($cur_item_unit)
                                    {
                                        $item_unit=ItemUnit::model()->findbyPk($cur_item_unit->unit_id);
                                        $unit_name=$item_unit->unit_name;
                                    }
                                ?>
                                    <tr>
                                        <td> 
                                            <?php echo $item['name']; ?><br/>
                                            <span class="text-info"><?php echo $qty_in_stock . ' ' . $unit_name .  ' ' . Yii::t('app','in stock') ?> </span>
                                        </td>
                                        <td><?php echo $form->textField($model,"[$item_id]price",array('value'=>$item['price'],'class'=>'input-small alignRight numeric editable-box numpad','id'=>"price_$item_id",'placeholder'=>'Price','data-id'=>"$item_id",'maxlength'=>50,'onkeypress'=>'return isNumberKey(event)')); ?></td>
                                        <td>
                                            <?php echo $form->textField($model,"[$item_id]quantity",array('value'=>$item['quantity'],'class'=>'input-small alignRight numeric editable-box numpad','id'=>"quantity_$item_id",'placeholder'=>'Quantity','data-id'=>"$item_id",'maxlength'=>50,'onkeypress'=>'return isNumberKey(event)')); ?>
                                        </td>
                                        <td class="<?php echo Yii::app()->settings->get('system','discount'); ?>">
                                            <?php echo $form->textField($model,"[$item_id]discount",array('value'=>$item['discount'],'class'=>'input-small alignRight editable-box numpad','id'=>"discount_$item_id",'placeholder'=>'Discount','data-id'=>"$item_id",'maxlength'=>50)); ?></td>
                                        <td><?php echo $total_item; ?>
                                        <td>
                                            <?php echo TbHtml::linkButton('',array(
                                                'color'=>TbHtml::BUTTON_COLOR_DANGER,
                                                'size'=>TbHtml::BUTTON_SIZE_MINI,
                                                'icon'=>'glyphicon-trash',
                                                'url'=>array('DeleteItem','item_id'=>$item_id),
                                                'class'=>'delete-item',
                                                'title' => Yii::t( 'app', 'Remove' ),
                                            )); ?>
                                        </td>    
                                    </tr>
                                <?php //$this->endWidget(); ?>  <!--/endformWidget-->     
                            <?php endforeach; ?> <!--/endforeach-->
                        </tbody>
                    </table>
                    <?php $this->endWidget(); ?>  <!--/endformWidget--> 

                     <?php if (empty($items)) {
                           echo Yii::t('app','There are no items in the cart');
                     } ?> 

                </div><!--/endslimscrool-->

                <!--
                <div class="row">
                    <div class="col-xs-7">
                        <div class="dl-horizontal pull-right">
                            <dt><?php //echo Yii::t('app','Total'); ?> :</dt><dd><span class="label label-info"><?php //echo '$'.number_format($total,Yii::app()->shoppingCart->getDecimalPlace(), '.', ','); ?></span></dd>
                            <dt><?php //echo Yii::t('app','Amount Due'); ?>:</dt><dd><span class="label label-important"><?php //echo '$'.number_format($amount_due,Yii::app()->shoppingCart->getDecimalPlace(), '.', ',');  ?></span></dd>
                        </div>
                        <div class="span6 pull-left">
                            <?php /*
                                if(isset($customer)) {
                                    $this->renderPartial('touchscreen/_client_selected',array('model'=>$model,'customer'=>$customer,'customer_mobile_no'=>$customer_mobile_no));
                                } else {
                                    $this->renderPartial('touchscreen/_client',array('model'=>$model)); 
                                }  
                              * 
                              */
                            ?>
                        </div>
                    </div>
                </div>
                -->

                <?php
                // Only show this part if there is at least one payment entered.
                if($count_payment > 0)
                {
                ?>
                 <table class="table">
                    <!-- 
                   <thead>
                       <tr> <th>Type</th><th>Amount</th></tr>
                   </thead>
                   -->
                   <tbody id="payment_content">
                       <?php foreach($payments as $id=>$payment):  ?>
                       <tr>
                           <td><?php echo $payment['payment_type']; ?></td>
                           <td><?php echo Yii::app()->numberFormatter->formatCurrency(($payment['payment_amount']),Yii::app()->settings->get('site', 'currencySymbol')); ?></td>
                           <td>
                            <?php echo TbHtml::linkButton('',array(
                                    'color'=>TbHtml::BUTTON_COLOR_DANGER,
                                    'size'=>TbHtml::BUTTON_SIZE_MINI,
                                    'icon'=>'remove',
                                    'url'=>Yii::app()->createUrl('SaleItem/DeletePayment',array('payment_id'=>$payment['payment_type'])),
                                    'class'=>'delete-payment',
                                    'title' => Yii::t( 'app', 'Delete Payment' ),
                            )); ?>     
                           </td>
                       </tr>
                       <?php endforeach; ?>
                   </tbody>
                 </table>
                <?php } ?>

                <?php if ( $count_item<>0 ) { ?> 
                <div class="widget-toolbox padding-8 clearfix">
                        <div class="pull-right">
                            <?php if ($count_payment>0) { ?>   
                                   <?php echo TbHtml::linkButton(Yii::t('app','Complete Sale'),array(
                                       'color'=>TbHtml::BUTTON_COLOR_INFO,
                                       'size'=>TbHtml::BUTTON_SIZE_SMALL,
                                       'icon'=>'glyphicon-off white',
                                       'url'=>Yii::app()->createUrl('SaleItem/CompleteSale/'),
                                       'class'=>'complete-sale pull-right',
                                       'title' => Yii::t( 'app', 'Complete Sale' ),
                                )); ?>
                            <?php } else { ?>
                               <?php echo TbHtml::linkButton(Yii::t('app','Add Payment'),array(
                                      'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
                                      'size'=>TbHtml::BUTTON_SIZE_SMALL,
                                      'icon'=>'glyphicon-heart white',
                                      'url'=>Yii::app()->createUrl('SaleItem/AddPayment/'),
                                      'class'=>'add-payment pull-right',
                                      'title' => Yii::t( 'app', 'Add Payment' ),
                               )); ?> 
                            <?php } ?>
                            <div style="display: none;">
                               <?php echo $form->dropDownList($model,'payment_type',InvoiceItem::itemAlias('payment_type'),array('class'=>'span2 pull-right','id'=>'payment_type_id')); ?> 
                            </div>
                            <div class="pull-right">
                            <?php echo $form->textField($model,'payment_amount',array('value'=>$amount_due,'class'=>'input-small numpad','style'=>'text-align: right','maxlength'=>10,'id'=>'payment_amount_id','data-url'=>Yii::app()->createUrl('SaleItem/AddPayment/'),)); ?>
                            </div>
                        </div>
                        <div class="pull-left">
                         <?php echo TbHtml::linkButton(Yii::t('app','Cancel Sale'),array(
                                'color'=>TbHtml::BUTTON_COLOR_DANGER,
                                'size'=>TbHtml::BUTTON_SIZE_SMALL,
                                'icon'=>'glyphicon-remove white',
                                'url'=>Yii::app()->createUrl('SaleItem/CancelSale/'),
                                'class'=>'cancel-sale pull-left',
                                'title' => Yii::t( 'app', 'Void Sale' ),
                        )); ?> 
                        <?php echo TbHtml::linkButton(Yii::t('app','form.button.suspendsale'),array(
                                'color'=>TbHtml::BUTTON_COLOR_WARNING,
                                'size'=>TbHtml::BUTTON_SIZE_SMALL,
                                'icon'=>'glyphicon-pause white',
                                'url'=>Yii::app()->createUrl('SaleItem/SuspendSale/'),
                                'class'=>'suspend-sale pull-left',
                                'title' => Yii::t( 'app', 'Suspend' ),
                        )); ?>
                        </div>
                </div><!--/endtoolbarfooter-->
                <?php } ?>
             </div> <!--/endwiget-main-->
          </div><!--/endwiget-body-->
    </div> <!--/endgridcartdiv-->

</div>  <!-- #section:first.div.layout -->

<!-- #section:second.div.layout -->
<div class="col-xs-5" id="product_show"> 
    <div class="widget-box">
        <!-- #section:custom/widget-box.header.options -->
        <div class="widget-header widget-header-flat widget-header-small">
            <h5 class="widget-title">Product Category</h5>
        </div>
      
        <div class="widget-body">
         <div class="widget-main">   
            <div class="slider1">
               <!-- Product Categories -->
                   <?php  foreach ($categories as $category) { ?>    
                   <div class="slide">
                   <a href="<?php echo Yii::app()->createUrl("saleItem/index",array("category_id"=>$category->id)); ?>" title="<?php echo $category->name; ?>" class="list-item">
                      <?php echo TbHtml::imagePolaroid('holder.js/300x90/ace/text:' . ucfirst($category->name),$category->name); ?>
                   </a>
                   </div>
                   <?php } ?>
                   <div class="slide">
                   <a href="<?php echo Yii::app()->createUrl("saleItem/index",array("category_id"=>-1)); ?>" title="Other">
                       <?php echo TbHtml::imagePolaroid('holder.js/300x96/ace/text:Other'); ?>
                   </a>
                   </div>
               <!-- //Product Categories  -->
             </div> 
         </div>
        </div>
    </div>
   
    <div class="produc-list">
        <ul class="ace-thumbnails">
            <?php  foreach ($products as $product) { ?>
            <?php 
                $item_image= ItemImage::model()->find('item_id=:itemId',array(':itemId'=> $product->id));
            ?>
            <li>
                <a href="<?php echo Yii::app()->createUrl("saleItem/indexpara",array("item_id"=>$product->id)); ?>" title="<?php echo $product->name; ?>" data-rel="colorbox" class="list-product">
                    <span>
                    <?php 
                        if ($item_image) { 
                            $uri = 'data:image/png;base64,'.base64_encode($item_image->thumbnail);
                            echo CHtml::image($uri,'Produt Image');
                        }else {
                            //echo CHtml::image(Yii::app()->baseUrl . '/images/image.png','Product Image');
                            echo TbHtml::imagePolaroid('holder.js/125x117/acename/text:' . $product->name);
                        }

                    ?>
                    <span>
                    <!--<img alt="120x100" src=<?php //echo Yii::app()->baseUrl . '/images/image.png'; ?> width="120px" height="100px" />-->
                    <div class="tags">
                            <span class="label label-info"><?php echo $product->name; ?></span>
                            <span class="label label-success arrowed-in"><?php echo number_format($product->unit_price,Yii::app()->shoppingCart->getDecimalPlace()); ?></span>
                    </div>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
       
</div> <!--/end2nddiv-->   

<?php $this->renderPartial('touchscreen/_search_touchscreen'); ?>

<div class="waiting"><!-- Place at bottom of page --></div>

<script type="text/javascript">
    $(function() {
        $('.slim-scroll').each(function () {
                 var $this = $(this);
                 $this.slimScroll({
                         height: $this.data('height') || 100,
                         railVisible:true
                 });
         });
         
         /*
         $('.numpad').keyboard({
		layout: 'num',
		restrictInput : true, // Prevent keys not in the displayed keyboard from being typed in
		preventPaste : true,  // prevent ctrl-v and right click
		autoAccept : false,
	});
        */
       
       $('.numpad').keyboard({
            layout: 'custom',
            customLayout: {
             'default' : [
              '$ {bksp} {clear}',
              '7 8 9',
              '4 5 6',
              '1 2 3',
              '0 . {a} {c}'
             ]
            },
            maxLength : 6,
            restrictInput : true, // Prevent keys not in the displayed keyboard from being typed in
            preventPaste : true,  // prevent ctrl-v and right click
            useCombos : false // don't want A+E to become a ligature
        });
               
    }); 
    $(document).ready(function(){
        $('.slider1').bxSlider({
            slideWidth: 200,
            minSlides: 3,
            maxSlides: 4,
            slideMargin: 10,
            infiniteLoop: false,
            pager: false,
            hideControlOnEnd: true,
          });
    });
    
    Holder.add_theme("ace", {background:"#438EB9", foreground:"#fff",size:38, font: "Open Sans",}) 
    Holder.add_theme("acename", {background:"#438EB9", foreground:"#fff",size:20, font: "Open Sans",})
</script>