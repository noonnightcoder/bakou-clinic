<?php
/* @var $this TreatmentItemDetailController */
/* @var $data TreatmentItemDetail */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('t_group_id')); ?>:</b>
	<?php echo CHtml::encode($data->t_group_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('treatment_item')); ?>:</b>
	<?php echo CHtml::encode($data->treatment_item); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit_price')); ?>:</b>
	<?php echo CHtml::encode($data->unit_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caption')); ?>:</b>
	<?php echo CHtml::encode($data->caption); ?>
	<br />


</div>