<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                'id'=>'exchange_rate',
                //'name'=>'exchange_rate',
                'enableAjaxValidation'=>false,
                'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        )); ?>
<div class="form-group"> 
    <label class="col-sm-3 control-label" for="value"><?php echo Yii::t('app','Primary [$] to Secondary [៛]'); ?></label>  
    <div class="col-md-9">
        <?php $setting->value=Yii::app()->session['exchange_rate'];?>
        <?php echo $form->textField($setting,'value',array('placeholder'=>'$ to ៛','id'=>'xchange_rate','span'=>5,'maxlength'=>50)); ?>
    </div>
</div>
<div class="form-actions">
    <?php echo TbHtml::submitButton(Yii::t('app','Save'),array(
           'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
           //'size'=>TbHtml::BUTTON_SIZE_SMALL,
    )); ?>
</div>    
<?php $this->endWidget(); ?>
<script>
    $(document).ready(function() {
    $("#xchange_rate").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
</script>

