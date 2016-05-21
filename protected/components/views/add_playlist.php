<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'playlist-form',
    'action' => array('/home/AjaxAddPlaylistWithSong'),
    'enableClientValidation' => true,
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'validateOnChange' => true,
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array('class' => 'form-details')
));
?>
<div class="row">
    <div class="col-md-12">
        <?php echo $form->error($model, 'name', array('class'=>'validateTips')); ?>
        <?php echo $form->textField($model, 'name', array('placeholder' => 'Enter Playlist Name', 'class' => 't_box')); ?>
        <input type="hidden" name="playlist_song" value="" id="playlist_song" class="t_box" >
    </div>
    <div class="row mar-t-50">
        <div class="col-md-4">&nbsp;</div>
        <div class="col-md-4">
            <?php echo CHtml::submitButton('Create Playlist', array('class' => 'btn')); ?>
        </div>
    <div class="col-md-4">&nbsp;</div>
    </div>
</div>

<?php $this->endWidget(); ?>
