<?php
	$form = $this->beginWidget('CActiveForm', array(
	        'id'=>'signup-form',
	        'action'=>array('/home/signup'),
	        'enableClientValidation'=>true,
            'enableAjaxValidation'=> true,
	        'clientOptions'=>array(
                'validateOnChange'=>true,
	            'validateOnSubmit'=>true,
	        )
	    ));
?>
    <div class="m_row"> <i class="fa fa-user"></i>
        <div class="mr_col">
            <?php echo $form->textField($model,'email',array('placeholder'=>'Enter Email','class'=>'t_box')); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>
    </div>
    <div class="m_row"> <i class="fa fa-user"></i>
        <div class="mr_col">
            <?php echo $form->textField($model,'username',array('placeholder'=>'Enter Username','class'=>'t_box')); ?>
            <?php echo $form->error($model, 'username'); ?>
        </div>
    </div>
    <div class="m_row"> <i class="fa fa-lock"></i>
        <div class="mr_col">
            <?php echo $form->passwordField($model,'password',array('placeholder'=>'Enter Password','class'=>'t_box')); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>
    </div>
    <div class="m_row"> <i class="fa fa-lock"></i>
        <div class="mr_col">
            <?php echo $form->passwordField($model,'confirm_password',array('placeholder'=>'Confirm Password','class'=>'t_box')); ?>
            <?php echo $form->error($model, 'confirm_password'); ?>
        </div>
    </div>

    <div class="m_row tar">
        <?php echo CHtml::submitButton('Signup & Continue',array('class'=>'btn_small fc_white bg_blue')); ?>
    </div>
    <div class="m_row tac">Already a Member? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#Login-pop">Login</a></div>
<?php $this->endWidget(); ?>