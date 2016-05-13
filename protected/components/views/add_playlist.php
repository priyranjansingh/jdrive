<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'playlist-form',
    'action' => array('/home/AjaxAddPlaylistWithSong'),
    'enableClientValidation' => true,
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'validateOnChange' => true,
        'validateOnSubmit' => true,
    )
        ));
?>
<div class="m_row">
    <div class="mr_col">
        <?php echo $form->textField($model, 'name', array('placeholder' => 'Enter Playlist Name', 'class' => 't_box')); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
</div>

<div class="m_row">
    <div class="mr_col">
        <input type="hidden" name="playlist_song" value="" id="playlist_song" class="t_box" >
    </div>
</div>




<div class="m_row tar">
    <?php echo CHtml::submitButton('Create Playlist', array('class' => 'btn_small fc_white bg_blue')); ?>
</div>
<?php $this->endWidget(); ?>
