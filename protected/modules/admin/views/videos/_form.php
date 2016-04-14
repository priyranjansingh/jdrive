<?php
/* @var $this VideosController */
/* @var $model Videos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'videos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>36,'maxlength'=>36)); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'song_name'); ?>
		<?php echo $form->textField($model,'song_name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'song_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'artist_name'); ?>
		<?php echo $form->textField($model,'artist_name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'artist_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s3_bucket'); ?>
		<?php echo $form->textField($model,'s3_bucket',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'s3_bucket'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'file_name'); ?>
		<?php echo $form->textField($model,'file_name',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'file_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type'); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bpm'); ?>
		<?php echo $form->textField($model,'bpm',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'bpm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'song_key'); ?>
		<?php echo $form->textField($model,'song_key',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'song_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'file_size'); ?>
		<?php echo $form->textField($model,'file_size',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'file_size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'genre'); ?>
		<?php echo $form->textField($model,'genre',array('size'=>36,'maxlength'=>36)); ?>
		<?php echo $form->error($model,'genre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sub_genre'); ?>
		<?php echo $form->textField($model,'sub_genre',array('size'=>36,'maxlength'=>36)); ?>
		<?php echo $form->error($model,'sub_genre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sub_sub_genre'); ?>
		<?php echo $form->textField($model,'sub_sub_genre',array('size'=>36,'maxlength'=>36)); ?>
		<?php echo $form->error($model,'sub_sub_genre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s3_url'); ?>
		<?php echo $form->textArea($model,'s3_url',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'s3_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deleted'); ?>
		<?php echo $form->textField($model,'deleted'); ?>
		<?php echo $form->error($model,'deleted'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by',array('size'=>36,'maxlength'=>36)); ?>
		<?php echo $form->error($model,'created_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified_by'); ?>
		<?php echo $form->textField($model,'modified_by',array('size'=>36,'maxlength'=>36)); ?>
		<?php echo $form->error($model,'modified_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_entered'); ?>
		<?php echo $form->textField($model,'date_entered'); ?>
		<?php echo $form->error($model,'date_entered'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_modified'); ?>
		<?php echo $form->textField($model,'date_modified'); ?>
		<?php echo $form->error($model,'date_modified'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->