<?php
	$form = $this->beginWidget('CActiveForm', array(
	        'id'=>'login-form',
	        'action'=>array('/home/login'),
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
            <?php echo $form->textField($model,'username',array('placeholder'=>'Enter Email','class'=>'t_box')); ?>
            <?php echo $form->error($model, 'username'); ?>
        </div>
    </div>
    <div class="m_row"> <i class="fa fa-lock"></i>
        <div class="mr_col">
            <?php echo $form->passwordField($model,'password',array('placeholder'=>'Enter Password','class'=>'t_box')); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>
    </div>
    <div class="m_row mart15">
        <label><span class="ck_box">
                <input type="checkbox">
                <span></span></span> Remember Me</label>
        <a class="fr" id="forgot_pass_link" href="#" data-dismiss="modal" data-toggle="modal" data-target="#Forgotpass">Forgot Password?</a></div>
    <div class="m_row tar">
        <?php echo CHtml::submitButton('Login & Continue',array('class'=>'btn_small fc_white bg_blue')); ?>
    </div>
    <div class="m_row tac">New to JOCKDRIVE? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#Signup-pop">Sign Up</a></div>
<?php $this->endWidget(); ?>