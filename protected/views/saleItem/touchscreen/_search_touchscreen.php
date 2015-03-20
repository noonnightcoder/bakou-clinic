<?php 
    Yii::app()->clientScript->registerScript( 'searchItem', "
        jQuery( function($){
            $('div#grid_cart').on('change','#SaleItem_item_id',function(e) {
                e.preventDefault();
                var remote = $('#SaleItem_item_id');
                var item_id=remote.val();
                var gridCart=$('#grid_cart');
                $.ajax({url: 'Index',
                        dataType : 'json',
                        data : {item_id : item_id},
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                                if (data.status==='success')
                                {
                                    gridCart.html(data.div_gridcart);
                                    //remote.select2('open');
                                }
                                else 
                                {
                                   console.log(data.message);
                                }
                          }
                    });
                });
        });
      ");
 ?>

<?php 
    Yii::app()->clientScript->registerScript( 'deleteItem', "
        jQuery( function($){
            $('div#grid_cart').on('click','a.delete-item',function(e) {
                e.preventDefault();
                var url=$(this).attr('href');
                var gridCart=$('#grid_cart');
                $.ajax({url:url,
                        dataType : 'json',
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                                if (data.status==='success')
                                {
                                    gridCart.html(data.div_gridcart);
                                    //$('#SaleItem_item_id').select2('open');
                                    
                                }
                                else 
                                {
                                  alert('something worng');
                                  return false;
                                }
                          }
                    });
                });
        });
      ");
 ?>  

<?php 
    Yii::app()->clientScript->registerScript( 'cancelSale', "
        jQuery( function($){
            $('div#grid_cart').on('click','a.cancel-sale',function(e) {
                e.preventDefault();
                if (!confirm('Are you sure you want to clear this sale? All items will cleared.'))
                {
                  return false;
                }
                var url=$(this).attr('href');
                var gridCart=$('#grid_cart');
                var message=$('.message');
                $.ajax({url:url,
                        dataType : 'json',
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                                if (data.status==='success')
                                {
                                    message.hide();
                                    gridCart.html(data.div_gridcart);
                                }
                                else 
                                {
                                   console.log(data.div);
                                }
                          }
                    });
                });
        });
      ");
 ?>  

<?php 
    Yii::app()->clientScript->registerScript( 'SuspendedSale', "
        jQuery( function($){
            $('#grid_cart').on('click','a.suspend-sale',function(e) {
                e.preventDefault();
                if (!confirm('Are you sure you want to suspend this sale?'))
                {
                  return false;
                }
                var url=$(this).attr('href');
                var message=$('.message');
                var remote = $('#SaleItem_item_id');
                var gridCart=$('#grid_cart');
                $.ajax({url:url,
                        dataType : 'json',
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                                if (data.status==='success')
                                {
                                    
                                    message.hide();
                                    gridCart.html(data.div_gridcart);
                                    //remote.select2('data', null);
                                    //remote.select2('open');
                                }
                                else if (data.status==='receiptprinting')
                                {
                                    window.location.href=data.div_receipt;
                                }
                                else if (data.status ==='failed')
                                {
                                    message.slideToggle();
                                    message.html(data.message);
                                    message.show();
                                    return false;
                                }
                          }
                    });
                });
        });
      ");
 ?> 

<?php 
    Yii::app()->clientScript->registerScript( 'touchItem', "
        jQuery( function($){
            $('div#product_show').on('click','a.list-product',function(e) {
                e.preventDefault();
                $('#myModal').modal('hide');
                var remote = $('#SaleItem_item_id');
                var url=$(this).attr('href');
                var gridCart=$('#grid_cart');
                $.ajax({url:url,
                        dataType : 'json',
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                                if (data.status==='success')
                                {
                                    gridCart.html(data.div_gridcart);
                                    //remote.select2('open');
                                }
                                else 
                                {
                                  alert('something worng');
                                  return false;
                                }
                          }
                }); 
             });
         });
      ");
 ?> 

<?php /*
    Yii::app()->clientScript->registerScript( 'editItem', "
        jQuery( function($){
            $('div#grid_cart').on('change','.editable-box',function(e) {
                e.preventDefault();
                var frmCtlVal=$(this).val();
                var item_id=$(this).data('id');
                var quantity=$('#quantity_'+ item_id).val();
                var price=$('#price_'+ item_id).val();
                var discount=$('#discount_'+ item_id).val();
                var gridCart=$('#grid_cart');
                var message=$('.message');
                $.ajax({
                        url: 'EditItem',
                        dataType : 'json',
                        data : {item_id : item_id, quantity : quantity, discount : discount, price : price},
                        type : 'post',
                        //beforeSend: function() { $('.waiting').show(); },
                        //complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                                if (data.status==='success')
                                {
                                     message.hide();
                                     gridCart.html(data.div_gridcart);
                                     //$('#SaleItem_item_id').select2('open');
                                }    
                                else
                                {
                                    alert('someting wrong');
                                     return false;
                                }
                       }
                 });
            });
        });
      "); 
    * 
    */
 ?> 

<?php 
    Yii::app()->clientScript->registerScript( 'addPayment', "
        jQuery( function($){
            $('#grid_cart').on('click','a.add-payment',function(e) {
                e.preventDefault();
                var url=$(this).attr('href');
                var gridCart=$('#grid_cart');
                var message=$('.message');
                var payment_id=$('#payment_type_id').val();
                var payment_amount=$('#payment_amount_id').val();
                $.ajax({url:url,
                        dataType : 'json',
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        data : {payment_id : payment_id, payment_amount : payment_amount},
                        success : function(data) {
                                if (data.status==='success')
                                {
                                    message.hide();
                                    gridCart.html(data.div_gridcart);
                                }
                                else 
                                {
                                   console.log(data.div);
                                }
                          }
                    });
                });
        });
      ");
 ?>  

<?php 
    Yii::app()->clientScript->registerScript( 'enterPayment', "
        jQuery( function($){
            $('#grid_cart').on('keypress','#payment_amount_id',function(e) {
                if (e.keyCode == 13 || e.which == 13)
                {    
                    e.preventDefault();
                    var url=$(this).data('url');
                    var gridCart=$('#grid_cart');
                    var totalCart=$('#total_cart');
                    var paymentCart=$('#payment_cart');
                    var message=$('.message');
                    var payment_id=$('#payment_type_id').val();
                    var payment_amount=$(this).val();
                    //alert('Hit enter key');
                    $.ajax({url:url,
                            dataType : 'json',
                            type : 'post',
                            beforeSend: function() { $('.waiting').show(); },
                            complete: function() { $('.waiting').hide(); },
                            data : {payment_id : payment_id, payment_amount : payment_amount},
                            success : function(data) {
                                    message.hide();
                                    gridCart.html(data.div_gridcart);
                                    totalCart.html(data.div_totalcart);
                                    paymentCart.html(data.div_paymentcart);
                             }
                      }); // end ajax
                      //return false;
                  } // end if
             });
        });
      ");
 ?> 

<?php 
    Yii::app()->clientScript->registerScript( 'deletePayment', "
        jQuery( function($){
            $('#grid_cart').on('click','a.delete-payment',function(e) {
                e.preventDefault();
                var url=$(this).attr('href');
                var gridCart=$('#grid_cart');
                var message=$('.message');
                $.ajax({url:url,
                        dataType : 'json',
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                                if (data.status==='success')
                                {
                                    message.hide();
                                    gridCart.html(data.div_gridcart);
                                }
                                else 
                                {
                                   console.log(data.div);
                                }
                          }
                    });
                });
        });
      ");
 ?>  

<?php 
    Yii::app()->clientScript->registerScript( 'completeSale', "
        jQuery( function($){
            $('#grid_cart').on('click','a.complete-sale',function(e) {
                e.preventDefault();
                if (!confirm('Are you sure you want to submit this sale? This cannot be undone.'))
                {
                  return false;
                }
                var url=$(this).attr('href');
                var message=$('.message');
                $.ajax({url:url,
                        dataType : 'json',
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                                if (data.status==='success')
                                {
                                    window.location.href=data.div_receipt;
                                }
                                else if (data.status ==='failed')
                                {
                                    message.hide();
                                    message.slideToggle();
                                    message.html(data.message);
                                    message.show();
                                    return false;
                                }
                          }
                    });
                });
        });
      ");
 ?>  

<?php 
    Yii::app()->clientScript->registerScript( 'removeCustomer', "
        jQuery( function($){
            $('#grid_cart').on('click','a.detach-customer', function(e) {
                e.preventDefault();
                var gridCart=$('#grid_cart');
                $.ajax({url: 'RemoveCustomer',
                        dataType : 'json',
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                                if (data.status==='success')
                                {
                                    gridCart.html(data.div_gridcart);
                                }
                                else 
                                {
                                   console.log(data.message);
                                }
                          }
                    });
                });
        });
      ");
 ?> 

<?php /*
    Yii::app()->clientScript->registerScript( 'slimScroll', "
        jQuery( function($){
            $('.slim-scroll').each(function() {
                var ss = $(this);
                ss.slimScroll({
                        height: ss.data('height') || 100,
                        railVisible:true
                });
            });
        });
    "); 
    * 
 */
 ?> 

<?php 
    Yii::app()->clientScript->registerScript( 'acceptedEditItem', "
        jQuery( function($){
            $('div#grid_cart').on('accepted.keyboard','.numpad',function(e) {
                e.preventDefault();
                var frmCtlVal=$(this).val();
                var item_id=$(this).data('id');
                var quantity=$('#quantity_'+ item_id).val();
                var price=$('#price_'+ item_id).val();
                var discount=$('#discount_'+ item_id).val();
                var gridCart=$('#grid_cart');
                var message=$('.message');
                $.ajax({
                        url: 'EditItem',
                        dataType : 'json',
                        data : {item_id : item_id, quantity : quantity, discount : discount, price : price},
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                                if (data.status==='success')
                                {
                                     message.hide();
                                     gridCart.html(data.div_gridcart);
                                     //$('#SaleItem_item_id').select2('open');
                                }    
                                else
                                {
                                    alert('someting wrong');
                                     return false;
                                }
                       }
                 });
            });
        });
      "); 
 ?> 


<script>
function isNumber(n) {
  //return !isNaN(parseFloat(n)) && isFinite(n);
  console.log(n);
}   
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode;
    return (charCode<=31 ||  charCode==46 || (charCode>=48 && charCode<=57) || (charCode==45));
}
</script>