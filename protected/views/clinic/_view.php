<?php
/* @var $this ClinicController */
/* @var $data Clinic */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('clinic_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->clinic_id),array('view','id'=>$data->clinic_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_time')); ?>:</b>
	<?php echo CHtml::encode($data->start_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_time')); ?>:</b>
	<?php echo CHtml::encode($data->end_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_interval')); ?>:</b>
	<?php echo CHtml::encode($data->time_interval); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('clinic_name')); ?>:</b>
	<?php echo CHtml::encode($data->clinic_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tag_line')); ?>:</b>
	<?php echo CHtml::encode($data->tag_line); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('clinic_address')); ?>:</b>
	<?php echo CHtml::encode($data->clinic_address); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('landline')); ?>:</b>
	<?php echo CHtml::encode($data->landline); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($data->mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('next_followup_days')); ?>:</b>
	<?php echo CHtml::encode($data->next_followup_days); ?>
	<br />

	*/ ?>

</div>