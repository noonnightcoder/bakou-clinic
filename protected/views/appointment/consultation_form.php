<?php $this->breadcrumbs = array(
    'Waiting Queue' => array('appointment/WaitingQueue'),
    Yii::t('app', 'Consultation'),
);
?>
<?php $this->widget('bootstrap.widgets.TbTabs', array(
        'type'=>'tabs',
        'placement'=>'above', // 'above', 'right', 'below' or 'left'
        'tabs'=>array(
            array('label'=>Yii::t('app','Consultation'),
                    'id'=>'tab_1', 
                    'content'=>$this->renderPartial('_create_consult', 
                            array('model'=>$model,
                                    'patient_name'=>$patient_name,
                                    'chk_bill_saved'=>$chk_bill_saved,
                                    'visit'=>$visit,
                                    'employee'=>$employee,
                                    'treatment'=>$treatment,
                                    'patient'=>$patient,
                                    'treatment_items'=>$treatment_items,
                                    'medicine'=>$medicine,
                                    'visit_id'=>$visit_id,
                                    'treatment_selected_items'=>$treatment_selected_items,
                                    'medicine_selected_items'=>$medicine_selected_items,
                                ),true
                            ),
                            'active'=>true
                ),
            array('label'=>Yii::t('app','Blood Test'),'id'=>'tab_2', 'content'=>$this->renderPartial('_bloodtest_form',array('lab_items'=>$lab_items),true)),
        ),
        //'events'=>array('shown'=>'js:loadContent')
    )); ?> 