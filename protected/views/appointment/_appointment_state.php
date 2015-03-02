<?php 
if($status=='Waiting'){ 
    echo TbHtml::labelTb('Waiting',array('color' => TbHtml::LABEL_COLOR_WARNING));  
}else{
   echo TbHtml::labelTb('Consultant', array('color' => TbHtml::LABEL_COLOR_SUCCESS));
}
?>