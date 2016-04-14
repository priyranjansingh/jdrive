<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'genres-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div class="box-body">
	<div class="form-group">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'genre_for'); ?>
			<?php echo $form->dropDownList($model,'genre_for',getParam('genre_for'),
																			array(
																				'empty'=>'Select Genre For',
																				'class' => 'form-control',
																				'ajax' => array(
																	                'type' => 'POST',
																	                'url' => CController::createUrl('parents'),
																	                'update' => '#Genres_parent',
																	                'data' => array('genre_for' => 'js:this.value'),
															        			))); ?>
			<?php echo $form->error($model,'genre_for'); ?>
		</div>
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'parent'); ?>
			<?php echo $form->dropDownList($model,'parent',[],array('empty'=>'Select Parent','class' => 'form-control')); ?>
			<p>Note: Dont Choose Parent If want to create Parent Genre.</p>
			<?php echo $form->error($model,'parent'); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('size'=>'60','maxlength'=>'128','class' => 'form-control')); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>
		<div class="col-xs-6"></div>
	</div>
</div>
<div class="box-footer">
    <?php echo CHtml::link('Back', array('/admin/genres'), array("class" => 'btn btn-info pull-right', "style" => "margin-left:10px;")); ?>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => 'btn btn-info pull-right')); ?>
</div>
<?php $this->endWidget(); ?>
