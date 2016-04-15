<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'songs-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
<div class="box-body">
	<div class="form-group">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'song_name'); ?>
			<?php echo $form->textField($model,'song_name',array('size'=>'60','maxlength'=>'128','class' => 'form-control')); ?>
			<?php echo $form->error($model,'song_name'); ?>
		</div>
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'artist_name'); ?>
			<?php echo $form->textField($model,'artist_name',array('size'=>'60','maxlength'=>'128','class' => 'form-control')); ?>
			<?php echo $form->error($model,'artist_name'); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'s3_bucket'); ?>
			<?php echo $form->dropDownList($model,'s3_bucket',[],array('empty'=>'Select S3 Bucket','class' => 'form-control')); ?>
			<?php echo $form->error($model,'s3_bucket'); ?>
		</div>
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'file_name'); ?>
			<?php echo $form->fileField($model,'file_name',array('class' => 'form-control')); ?>
			<?php echo $form->error($model,'file_name'); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-4">
			<?php echo $form->labelEx($model,'genre'); ?>
			<?php echo $form->dropDownList($model,'genre',$genres,
									array(
										'empty'=>'Select Genre',
										'class' => 'form-control',
										'ajax' => array(
									                'type' => 'POST',
									                'url' => CController::createUrl('childs'),
									                'update' => '#Songs_sub_genre',
									                'data' => array('genre' => 'js:this.value'),
						        				))
							        		); ?>
			<?php echo $form->error($model,'genre'); ?>
		</div>
		<div class="col-xs-4">
			<?php echo $form->labelEx($model,'sub_genre'); ?>
			<?php echo $form->dropDownList($model,'sub_genre',[],
									array(
										'empty'=>'Select Sub Genre',
										'class' => 'form-control',
										'ajax' => array(
									                'type' => 'POST',
									                'url' => CController::createUrl('childs'),
									                'update' => '#Songs_sub_sub_genre',
									                'data' => array('genre' => 'js:this.value'),
						        				))
									); ?>
			<?php echo $form->error($model,'sub_genre'); ?>
		</div>
		<div class="col-xs-4">
			<?php echo $form->labelEx($model,'sub_sub_genre'); ?>
			<?php echo $form->dropDownList($model,'sub_sub_genre',[],array('empty'=>'Select Sub Sub Genre','class' => 'form-control')); ?>
			<?php echo $form->error($model,'sub_sub_genre'); ?>
		</div>
	</div>
</div>
<div class="box-footer">
    <?php echo CHtml::link('Back', array('/admin/songs'), array("class" => 'btn btn-info pull-right', "style" => "margin-left:10px;")); ?>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => 'btn btn-info pull-right')); ?>
</div>
<?php $this->endWidget(); ?>
