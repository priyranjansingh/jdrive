<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'forgotpassword-form',
    'action' => array('/user/forgotpassword'),
    'enableClientValidation' => true,
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'validateOnChange' => true,
        'validateOnSubmit' => true,
        'afterValidate' => 'js:mySubmitFormFunction',
    )
        ));
?>
<div class="m_row"> <i class="fa fa-user"></i>
    <div class="mr_col">
        <?php echo $form->textField($model, 'username', array('placeholder' => 'Enter Email or Username', 'class' => 't_box')); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>
</div>


<div class="m_row tar">
    <?php echo CHtml::submitButton('Submit', array('class' => 'btn_small fc_white bg_blue')); ?>
</div>
<div class="m_row tac">New to JOCKDRIVE? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#Signup-pop">Sign Up</a></div>
<?php $this->endWidget(); ?>
<script>

    function mySubmitFormFunction(form, data, hasError) {
        if (!hasError) {
            // No errors! Do your post and stuff
            // FYI, this will NOT set $_POST['ajax']... 
            $(".loading").show();
            var username = $("#ForgotPassword_username").val();
            $.ajax({
                url: base_url + "/user/ajaxforgotpassword",
                method: "POST",
                data: {'username': username},
                dataType : 'json',
                success: function(data) {
                    $(".loading").hide();
                    $("#forgot_form").hide();
                    $("#success_message").html(data.message);
                    $("#forgot_message").show();
                    alert(data.status);
                }
            })


        }
        // Always return false so that Yii will never do a traditional form submit
        return false;
    }

</script>