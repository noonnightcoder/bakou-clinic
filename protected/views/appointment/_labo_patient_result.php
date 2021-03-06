<?php $this->widget('yiiwheels.widgets.grid.WhGridView',array(
            'id'=>'lab-result',
            'dataProvider'=>$LabResult->showLabResult($visit_id),
            'htmlOptions'=>array('class'=>'table-responsive panel'),
            'template' => "{items}",
            'columns'=>array(                
                array('name'=>'id',
                        'headerHtmlOptions' => array('style' => 'display:none'),
                        'htmlOptions' => array('style' => 'display:none'),
                ),
                array('name'=>'visit_id',
                        'headerHtmlOptions' => array('style' => 'display:none'),
                        'htmlOptions' => array('style' => 'display:none'),
                ),
                array('name'=>'lab_item_name',
                       'header'=>'Lab Item Name', 
                ),
		//'appointment_date',
                array('name'=>'result',
                       'header'=>'Result', 
                ),
		array('name'=>'caption',
                        'header'=>'Caption', 
                ),
	),
)); ?>