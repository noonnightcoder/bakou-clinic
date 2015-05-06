<?php
$this->breadcrumbs=array(
	Yii::t('app','Patient')=>array('contact/admin'),
	Yii::t('app','Index'),
);


?>
<div id="patient_his_container">
    <!--<div class="profile-user-info profile-user-info-striped">

        <div class="profile-info-row">
            <div class="profile-info-name"> Patient Name </div>

            <div class="profile-info-value">
                <span class="editable" id="username"><?php /*echo $patient->fullname; */?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> Age </div>

            <div class="profile-info-value">
                <span class="editable" id="age"><?php /*echo $patient->age; */?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> Gender </div>

            <div class="profile-info-value">
                <span class="editable" id="about"><?php /*echo $patient->sex; */?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> Address </div>

            <div class="profile-info-value">
                <i class="fa fa-map-marker light-orange bigger-110"></i>
                <span class="editable" id="country"><?php /*echo $patient->address_line_1; */?></span>
                <span class="editable" id="city"><?php /*//echo $patient->address_line_2; */?></span>
            </div>
        </div>


        <div class="profile-info-row">
            <div class="profile-info-name"> Last Visit </div>

            <div class="profile-info-value">
                <span class="editable" id="login">3 days ago</span>
            </div>
        </div>

    </div>-->

    <?php $this->renderPartial('_visited', array('visit'=>$visit,'patient_id'=>$patient_id),false,true); ?>


<?php //$this->endWidget(); ?>
</div>