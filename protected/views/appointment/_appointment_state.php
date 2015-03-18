<?php 
if($status=='Waiting'){ 
    echo TbHtml::labelTb('Waiting',array('color' => TbHtml::LABEL_COLOR_WARNING));  
}elseif ($status=='Complete') {
    echo TbHtml::labelTb('Complete',array('color' => TbHtml::LABEL_COLOR_SUCCESS));  
}elseif ($status=='Cancel') {
    echo TbHtml::labelTb('Cancel',array('color' => TbHtml::LABEL_COLOR_SUCCESS));  
}else{
   echo TbHtml::labelTb('Consultant', array('color' => TbHtml::LABEL_COLOR_INVERSE));
}
?>