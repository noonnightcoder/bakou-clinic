<?php
$chk_lab = TransactionLog::model()->find('visit_id=:visit_id and transaction_name="Lab"',array('visit_id'=>$_GET['visit_id']));
if(!empty($chk_lab))
{
    $disabled = "disabled";
}else{
    $disabled = "";
}
?>
<div class="form"> 
   <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                'id'=>'bloodtest-form',
                'enableAjaxValidation'=>false,
                'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,                
                //'htmlOptions'=> array('enctype'=>'multipart/form-data',)
        )); ?>
    <?php    
        //$chk_group = TreatmentGroup::model()->findbypk($i);
        //$chk_child = TreatmentItemDetail::model()->count("t_group_id=$i");
    ?>
    <div class="form-group">
        <div class="col-sm-4">
            <label class="control-label" for="hematology"><strong><u>Hematology</u></strong></label>
            <p>
            <div>
                <?php echo CHtml::activeCheckboxList($lab_items, 'hematology',  TreatmentItemDetail::model()->getTestlist(1),array('disabled'=>$disabled)); ?>
            </div>    
            <label class="control-label" for="immuno_hematology"><strong><u>Immuno Hematology</u></strong></label>
            <p>
            <div>
                <?php echo CHtml::activeCheckboxList($lab_items, 'immuno_hematology',  TreatmentItemDetail::model()->getTestlist(2),array('disabled'=>$disabled)); ?>
            </div>
            <label class="control-label" for="immunology"><strong><u>Immuno</u></strong></label>
            <p>
            <div>
                <?php echo CHtml::activeCheckboxList($lab_items, 'immunology',  TreatmentItemDetail::model()->getTestlist(3),array('disabled'=>$disabled)); ?>
            </div>
            <label class="control-label" for="hormones"><strong><u>Hormones</u></strong></label>
            <p>
            <div>
                <?php echo CHtml::activeCheckboxList($lab_items, 'hormones',  TreatmentItemDetail::model()->getTestlist(4),array('disabled'=>$disabled)); ?>
            </div>

            <label class="control-label" for="coagulation"><strong><u>Coagulation</u></strong></label>
            <p>
            <div>
                <?php echo CHtml::activeCheckboxList($lab_items, 'coagulation',  TreatmentItemDetail::model()->getTestlist(5),array('disabled'=>$disabled)); ?>
            </div>
        </div>
        <div class="col-sm-4">
            <label class="control-label" for="serology"><strong><u>Serology</u></strong></label>
            <p>
            <div>
                <?php echo CHtml::activeCheckboxList($lab_items, 'serology',  TreatmentItemDetail::model()->getTestlist(6),array('disabled'=>$disabled)); ?>
            </div> 
            <label class="control-label" for="micro_biology"><strong><u>Micro Biology</u></strong></label>
            <p>
            <div>
                <?php echo CHtml::activeCheckboxList($lab_items, 'micro_biology',  TreatmentItemDetail::model()->getTestlist(7),array('disabled'=>$disabled)); ?>
            </div>
        </div>
        <div class="col-sm-4">
            <label class="control-label" for="blood_biochemistry"><strong><u>Blood Biochemistry</u></strong></label>
            <p>
            <div>
                <?php echo CHtml::activeCheckboxList($lab_items, 'blood_biochemistry',  TreatmentItemDetail::model()->getTestlist(8),array('disabled'=>$disabled)); ?>
            </div>
            <label class="control-label" for="urology"><strong><u>Urology</u></strong></label>
            <p>
            <div>
                <?php echo CHtml::activeCheckboxList($lab_items, 'urology',  TreatmentItemDetail::model()->getTestlist(9),array('disabled'=>$disabled)); ?>
            </div>
            <label class="control-label" for="bacteriology"><strong><u>Bacteriology</u></strong></label>
            <p>
            <div>
                <?php echo CHtml::activeCheckboxList($lab_items, 'bacteriology',  TreatmentItemDetail::model()->getTestlist(10),array('disabled'=>$disabled)); ?>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-actions" id="form-actions">
                <?php echo TbHtml::submitButton(Yii::t('app', 'Save'), array(
                    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                    'size' => TbHtml::BUTTON_SIZE_SMALL,
                    'id' => 'save-bloodtest-form',
                    'name' => 'Save_bloodtest'
                    //'size'=>TbHtml::BUTTON_SIZE_SMALL,
                )); ?>
            </div>
        </div> 
    </div>       
    <?php $this->endWidget(); ?>
</div>

<?php
$url = Yii::app()->createUrl('TreatmentItemDetail/LabAnalyzed/visit_id/'.$_GET['visit_id']);
Yii::app()->clientScript->registerScript('lab_detail', "
    $('#save-bloodtest-form').on('click',function(e) {
        e.preventDefault();
        data = $('form').serialize();
        $.ajax({
            type: 'POST',
            url:'$url',
            data:data,
            beforeSend: function() { $('.waiting').show(); },
            complete: function() { $('.waiting').hide(); },
            success : function(data) {
                location.reload(); 
            }
        });
    });
");
?>
