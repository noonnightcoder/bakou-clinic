<?php
$this->breadcrumbs=array(
        'Clinic'=>array('ClinicInfo'),
	'Update',
);
?>

<?php $this->widget('bootstrap.widgets.TbTabs', array(
        'type'=>'tabs',
        'placement'=>'above', // 'above', 'right', 'below' or 'left'
        'tabs'=>array(
            array('label'=>Yii::t('app','Clinic Info'),'id'=>'tab_1', 'content'=>$this->renderPartial('_form', array('model'=>$model,),true),'active'=>true),
            array('label'=>Yii::t('app','Exchange Rate'),'id'=>'tab_2', 'content'=>$this->renderPartial('_form', array('setting' => $setting, 'values' => $values, 'category' => $category),true)),
        ),
        //'events'=>array('shown'=>'js:loadContent')
    )); ?> 