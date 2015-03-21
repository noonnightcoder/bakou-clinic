<div class="register_container">
<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), 
            'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
        ),
)); ?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        //'id'=>'doctor_consult',
        //'action'=>Yii::app()->createUrl('appointment/DoctorConsult'),
        'enableAjaxValidation'=>false,
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        'id'=>'add_item_form',
)); ?>

    <?php if(Yii::app()->user->hasFlash('error')):?>
        <?php $this->widget('bootstrap.widgets.TbAlert'); ?>
    <?php endif; ?>
    <div class="col-sm-6"> 

        <?php echo $form->textAreaControlGroup($visit,'sympton',array('rows'=>1 , 'cols'=>10, 'class'=>'span2','disabled'=>'disabled')); ?>

        <?php echo $form->textAreaControlGroup($visit,'assessment',array('rows'=>1 , 'cols'=>10, 'class'=>'span2','disabled'=>'disabled')); ?>
    </div>

    <div class="col-sm-6">
        <!--<h4 class="header blue bolder smaller"><i class="ace-icon fa fa-key blue"></i><?php //echo Yii::t('app','Treatment Result') ?></h4>--->

        <?php echo $form->textAreaControlGroup($visit,'observation',array('rows'=>1 , 'cols'=>10, 'class'=>'span2','disabled'=>'disabled')); ?>
        <?php echo $form->textAreaControlGroup($visit,'plan',array('rows'=>1 , 'cols'=>10, 'class'=>'span2','disabled'=>'disabled')); ?>
    </div>
    <div class="col-sm-12">
        <?php $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
            'title' => Yii::t('app','Treatment'),
            'headerIcon' => 'ace-icon fa fa-medkit',
            'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
            //'content' => $this->renderPartial('_form_treatment'),
        ));?> 
            <div class="grid-view" id="select_treatment_form">                
                <?php $this->renderPartial('_labo_treatment', array('treatment_selected_items' => $treatment_selected_items,'treatment'=>$treatment), false) ?> 
            </div>
        <?php $this->endWidget(); ?> 
    </div>  

    <div class="col-sm-12" id="medicine_form">
        <?php $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
                'title' => 'Medicine',
                'headerIcon' => 'ace-icon fa fa-medkit',
                'htmlHeaderOptions'=>array('class'=>'widget-header-flat widget-header-small'),
                //'content' => $this->renderPartial('_form', array('model'=>$model,'model_search'=>$model_search,'leave_detail_wrapper'=>$leave_detail_wrapper,'employee_id'=>$employee_id), true),
            ));?> 
                <div id="select_medicine_form">
                    <?php $this->renderPartial('_labo_medicine', array('medicine_selected_items'=>$medicine_selected_items,'medicine'=>$medicine), false); ?>
                </div>
        <?php $this->endWidget(); ?> 
    </div>


<?php $this->endWidget(); ?>
    
</div> 