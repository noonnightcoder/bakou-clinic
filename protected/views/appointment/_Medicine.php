<!--<form class="form-search">-->						
    <?php 
        /*$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'model'=>$item,
                'attribute'=>'id',
                'name'=>'Medicine_id',
                'source'=>$this->createUrl('appointment/suggestItem'),
                //'scriptFile'=>'',
                //'scriptUrl'=> Yii::app()->theme->baseUrl.'/js/',    
                'htmlOptions'=>array(
                    'size'=>'30',
                    //'class' => 'nav-search-input'
                ),
                'options'=>array(
                    'showAnim'=>'fold',
                    'minLength'=>'1',
                    'delay' => 10,
                    'autoFocus'=> false,
                    'select'=>'js:function(event, ui) {
                        event.preventDefault();
                        $("#Medicine_id").val(ui.item.id);
                        $("#add_item_form").ajaxSubmit({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: itemScannedSuccess});
                    }',
                    //'search' => 'js:function(){ $(".waiting").show(); }',
                    //'open' => 'js:function(){ $(".waiting").hide(); }',
                ),
            ));*/
    ?>
<i class="ace-icon fa fa fa-medkit nav-search-icon"></i>

<?php 
$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
    'asDropDownList' => false,
    'model'=> $medicine, 
    'attribute'=>'id',
    //'name'=>'Medicine_id',
    'pluginOptions' => array(
            'placeholder' => Yii::t('app','Select Medicine'),
            'multiple'=>false,
            'width' => '350px',
            //'tokenSeparators' => array(',', ' '),
            'allowClear'=>true,
            'minimumInputLength'=>1,
            'ajax' => array(
                'url' => Yii::app()->createUrl('appointment/GetMedicine/'), 
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
                'results' => 'js:function(data){
                    arr=data.results;
                    var myResults = [];
                    $.each(arr, function (index, item) {
                        myResults.push({
                            id: item.id,
                            text: item.name + " " + item.unit_price
                        });
                    });
                    return {
                        results: myResults
                    };
                 }',
            ),
            'initSelection' => "js:function (element, callback) {
                    var id=$(element).val();
                    if (id!=='') {
                        $.ajax('".$this->createUrl('/appointment/InitMedicine')."', {
                            dataType: 'json',
                            data: { id: id }
                        }).done(function(data) {callback(data);}); //http://www.eha.ee/labs/yiiplay/index.php/en/site/extension?view=select2
                    }
            }",
            //'htmlOptions'=>array('id'=>'search_item_id'),
    )));
?>
<!--</span>
</form>-->

