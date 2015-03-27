<style>
.btn-group {
  display: flex !important;
}
</style>
<div class="row" id="contact">
    <div class="col-xs-12 widget-container-col ui-sortable">
<?php
/* @var $this ContactController */
/* @var $model Contact */
    $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
                  'title' => Yii::t('app','List of Contact'),
                  'headerIcon' => 'ace-icon fa fa-users',
                  'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
    ));
?>    
<?php
$this->breadcrumbs=array(
            Yii::t('menu','Contact')=>array('admin'),
            Yii::t('app','Manage'),
    );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#contact-grid').yiiGridView('update', {
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
<?php echo TbHtml::linkButton(Yii::t( 'app', 'Add New' ),array(
            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
            'size'=>TbHtml::BUTTON_SIZE_SMALL,
            'icon'=>'glyphicon-plus white',
            'url'=>$this->createUrl('create'),
    )); ?>
<?php if(Yii::app()->user->hasFlash('success')):?>
        <?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<?php endif; ?> 
<?php $this->widget('bootstrap.widgets.TbGridView',array(
            'id'=>'contact-grid',
            'dataProvider'=>$model->search(),
            'htmlOptions'=>array('class'=>'table-responsive panel'),
            'columns'=>array(
		//'id',
                array(
                    'name'=>'fullname',
                    'header'=>'Patient Name', 
                ),
                /*array(
                    'name'=>'last_name',
                    'header'=>'Last Name', 
                    'filter'=>FALSE
                ),*/
                array(
                    'name'=>'display_id',
                    'header'=>'Display ID', 
                    'filter'=>FALSE
                ),
                array(
                    'name'=>'display_name',
                    'header'=>'Display Name', 
                ),
                array(
                    'name'=>'dob',
                    'header'=>'Date Of Birth', 
                ),
                array(
                    'name'=>'sex',
                    'header'=>'Sex', 
                ),
                array(
                    'name'=>'phone_number',
                    'header'=>'Phone Number', 
                    'filter'=>FALSE
                ),
                /*array(
                    'name'=>'type',
                    'header'=>'Type', 
                    'filter'=>FALSE
                ),*/
                array(
                    'name'=>'address_line_1',
                    'header'=>'Address', 
                    'filter'=>FALSE
                ),
                /*array(
                    'name'=>'country',
                    'header'=>'Country', 
                    'filter'=>FALSE
                ),*/
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'<div class="hidden-sm hidden-xs btn-group">{history}{update}{delete}</div>',
                    'htmlOptions'=>array('class'=>'nowrap'),
                    'buttons' => array(
                            /*'view' => array(
                              //'url'=>'Yii::app()->createUrl("client/delete/",array("id"=>$data->id))',
                              'options' => array(
                                  'class'=>'btn btn-xs btn-success',
                                ),   
                            ),*/
                            'history' => array(
                                'label' => Yii::t('app','History'),
                                'url'=> 'Yii::app()->createUrl("contact/index/",array("id"=>$data->patient_id))',
                                'options' => array(
                                  'class'=>'btn btn-xs btn-primary',
                                ), 
                            ),
                            'update' => array(
                                'icon' => 'ace-icon fa fa-edit',
                                'url'=>'Yii::app()->createUrl("contact/update/",array("id"=>$data->contact_id))',  
                                'options' => array(
                                  'class'=>'btn btn-xs btn-info',
                                ), 
                            ),
                            'delete' => array(
                               'label'=>'Delete',
                               'url'=>'Yii::app()->createUrl("contact/delete/",array("id"=>$data->contact_id))',
                               'options' => array(
                                  'class'=>'btn btn-xs btn-danger',
                               ),
                               'visible'=>'Yii::app()->user->checkAccess("contact.delete")', 
                            ),
                    )    
		),
	),
)); ?>
<?php $this->endWidget(); ?>
    </div>
</div>