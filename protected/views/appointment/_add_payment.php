<?php echo $form->textFieldControlGroup($model,'total_amount',array('rows'=>1 , 'cols'=>10, 'class'=>'span2','disabled'=>'disabled')); ?>
<!--<div class="form-group"><label class="col-sm-3 control-label" for="actual_amount">Actual Amount</label> 
<div class="col-md-5">-->
    <?php echo $form->textFieldControlGroup($model,'actual_amount'); ?>
    <!--<strong><?php //echo $form->error($model,'actual_amount'); ?></strong>
</div></div>--->

