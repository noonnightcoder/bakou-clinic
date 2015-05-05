<div class="">
    <div class="row">
        <!--PAGE CONTENT BEGINS-->
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12 widget-container-col summary_header">
                    <div class="infobox infobox-red">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-calendar icon-animated-vertical""></i>
                        </div>
                        <div class="infobox-data">
                            <span class="infobox-data-number"><?php echo $report->dbQueue(); ?></span>

                            <div class="infobox-content"><?php echo CHtml::link(Yii::t('app;', 'Appointment Queue'),
                                    Yii::app()->createUrl("appointment/appointmentdash")); ?></div>
                        </div>
                    </div>

                    <div class="infobox infobox-green">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-shopping-cart"></i>
                        </div>
                        <div class="infobox-data">
                            <span
                                class="infobox-data-number"><?php /*echo number_format($report->totalSale2Y(),Yii::app()->shoppingCart->getDecimalPlace()); */ ?></span>

                            <div class="infobox-content"><?php echo CHtml::link('Today\'s Visit',
                                    Yii::app()->createUrl("report/SaleReportTab")); ?></div>
                        </div>
                    </div>

                    <div class="infobox infobox-blue">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-shopping-cart"></i>
                        </div>

                        <div class="infobox-data">
                            <span
                                class="infobox-data-number"><?php //echo number_format($report->totalSale2D(),Yii::app()->shoppingCart->getDecimalPlace()); */?></span>

                            <div class="infobox-content">Total Visits</div>
                        </div>
                    </div>

                    <div class="infobox infobox-blue">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-users"></i>
                        </div>
                        <div class="infobox-data">
                            <span class="infobox-data-number"><?php echo $report->dbcountPatient(); ?></span>

                            <div class="infobox-content"><?php echo CHtml::link('Total Patients',
                                    Yii::app()->createUrl("contact/admin")); ?></div>
                        </div>
                    </div>

                    <div class="infobox infobox-green">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-user icon-animated-vertical"></i>
                        </div>
                        <div class="infobox-data">
                            <span class="infobox-data-number"><?php echo $report->dbcountPatientReg2D(); ?></span>

                            <div class="infobox-content"><?php echo CHtml::link('New Patient Today',
                                    Yii::app()->createUrl("contact/admin")); ?></div>
                        </div>
                    </div>

                    <div class="infobox infobox-orange2">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-square-o"></i>
                        </div>
                        <div class="infobox-data">
                            <span class="infobox-data-number"><?php echo $report->outofStock(); ?></span>

                            <div class="infobox-content"><?php echo CHtml::link(Yii::t('app;', 'Out of Stock'),
                                    Yii::app()->createUrl("report/inventory", array('filter' => 'outstock'))); ?></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--/row-->
    </div>
</div>
