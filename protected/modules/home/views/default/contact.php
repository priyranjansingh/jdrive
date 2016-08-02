<div class="inner_con bg_grey">
	<div class="wraper fc_black">
	<h2 class="fw600 mart15 marb15 titel">Contact Us</h2>
    <div class="row">
        <div class="col-md-8">
            <?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
					echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
				}
				$form = $this->beginWidget('CActiveForm', array(
						'id'=>'contact-form',
						'enableClientValidation'=>true,
						'enableAjaxValidation'=> true,
						'clientOptions'=>array(
							'validateOnChange'=>true,
							'validateOnSubmit'=>true,
						)
					));
			?>
            <div class="row mart15">
                <div class="col-md-6">
                    <?php echo $form->textField($model,'name',array('placeholder'=>'Name*','class'=>'t_box')); ?>
					<?php echo $form->error($model, 'name'); ?>
                </div>   
                <div class="col-md-6">
                    <?php echo $form->textField($model,'email',array('placeholder'=>'Email*','class'=>'t_box')); ?>
					<?php echo $form->error($model, 'email'); ?>
                </div>
            </div> 
            <div class="row mart15">
                <div class="col-md-12">
                    <?php echo $form->textField($model,'subject',array('placeholder'=>'Subject*','class'=>'t_box')); ?>
					<?php echo $form->error($model, 'subject'); ?>
                </div>   
            </div>                
            <div class="row mart15">
                <div class="col-md-12">
					<?php echo $form->textArea($model,'message',array('placeholder'=>'Message*','class'=>'t_area','rows'=>'5','cols' => '40')); ?>
					<?php echo $form->error($model, 'message'); ?>
                </div>   
            </div> 
            <div class="row mart15">
                <div class="col-md-12 tar">
					<?php echo CHtml::submitButton('Submit',array('class'=>'btn_big bg_red fc_white')); ?>
                </div>   
            </div> 
            <?php $this->endWidget(); ?>
        </div>
        <div class="col-md-4">
            <h4 class="fw400 marb15">CORPORATE OFFICE</h4>
            <p><i class="fa fa-map-marker fc_org"></i> Vivamus porttitor molestie est,<br>
                Lorem ipsum dolor sit amet,<br>
                Suspendisse bibendum vel dolor (East),<br>
                 Fusce &ndash; 400099. Nullam ,Aenean.</p>
            <p><i class="fa fa-phone fc_org"></i> 011-1235647859</p>
            <p><i class="fa fa-envelope fc_org"></i> enquiry@jockdrive.com</p>

    
    
        </div>
    </div>    

    </div>
</div>