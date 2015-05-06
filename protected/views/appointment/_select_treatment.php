<i class="ace-icon fa fa fa-h-square "></i>
<?php 
$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
    'asDropDownList' => false,
    'model'=> $treatment, 
    'attribute'=>'id',
    'pluginOptions' => array(
            'placeholder' => Yii::t('app','Select Treatment'),
            'multiple'=>false,
            'width' => '350px',
            //'tokenSeparators' => array(',', ' '),
            'allowClear'=>true,
            //'minimumInputLength'=>1,
            'ajax' => array(
                'url' => Yii::app()->createUrl('/appointment/GetTreatment/'), 
                'dataType' => 'json',
                'cache'=>true,
                'data' => 'js:function(term,page) {
                            return {
                                term: term, 
                                page_limit: 10,
                                quietMillis: 100, 
                                apikey: "e5mnmyr86jzb9dhae3ksgd73" 
                            };
                        }',
                'results' => 'js:function(data,page){
                    return { results: data.results };
                 }',
            ),
            'initSelection' => "js:function (element, callback) {
                    var id=$(element).val();
                    if (id!=='') {
                        $.ajax('".$this->createUrl('/appointment/InitTreatment')."', {
                            dataType: 'json',
                            data: { id: id }
                        }).done(function(data) {callback(data);}); //http://www.eha.ee/labs/yiiplay/index.php/en/site/extension?view=select2
                    }
            }",
            'createSearchChoice' => 'js:function(term, data) {
                if ($(data).filter(function() {
                    return this.text.localeCompare(term) === 0;
                }).length === 0) {
                    return {id:term, text: term, isNew: true};
                }
            }',
            'formatResult' => 'js:function(term) {
                if (term.isNew) {
                    return "<span class=\"label label-important\">New</span> " + term.text;
                }
                else {
                    return term.text;
                }
            }',
    )));
?>


