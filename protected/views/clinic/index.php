<?php
$this->breadcrumbs=array(
        'Clinic'=>array('ClinicInfo'),
	'Update',
);
?>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
)); ?>

<?php $this->widget('bootstrap.widgets.TbTabs', array(
        'type'=>'tabs',
        'placement'=>'above', // 'above', 'right', 'below' or 'left'
        'tabs'=>array(
            array('label'=>Yii::t('app','Clinic Info'),'id'=>'tab_1', 'content'=>$this->renderPartial('_form', array('model'=>$model,),true),'active'=>true),
            array('label'=>Yii::t('app','Exchange Rate'),'id'=>'tab_2', 'content'=>$this->renderPartial('_exchange_rate',array('setting'=>$setting,),true)),
        ),
        //'events'=>array('shown'=>'js:loadContent')
    )); ?> 