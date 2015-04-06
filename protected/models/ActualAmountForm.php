<?php
    class ActualAmountForm extends CFormModel
    {
        public $actual_amount;
        
        public function rules()
	{
		return array(			
			array('actual_amount','amount_validate','required'),
		);
	}
        
        public function amount_validate($attribute,$params)
        {
            //echo $this->patient_id;
            if($this->actual_amount=='')
            {
                $this->addError('actual_amount','Actual Amount cannot be blank');
                //Yii::app()->end();
            }
        }
    }
?>