<?php
/* @var $this VideosController */
/* @var $data Videos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('song_name')); ?>:</b>
	<?php echo CHtml::encode($data->song_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('artist_name')); ?>:</b>
	<?php echo CHtml::encode($data->artist_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slug')); ?>:</b>
	<?php echo CHtml::encode($data->slug); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s3_bucket')); ?>:</b>
	<?php echo CHtml::encode($data->s3_bucket); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_name')); ?>:</b>
	<?php echo CHtml::encode($data->file_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('bpm')); ?>:</b>
	<?php echo CHtml::encode($data->bpm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('song_key')); ?>:</b>
	<?php echo CHtml::encode($data->song_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_size')); ?>:</b>
	<?php echo CHtml::encode($data->file_size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('genre')); ?>:</b>
	<?php echo CHtml::encode($data->genre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sub_genre')); ?>:</b>
	<?php echo CHtml::encode($data->sub_genre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sub_sub_genre')); ?>:</b>
	<?php echo CHtml::encode($data->sub_sub_genre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s3_url')); ?>:</b>
	<?php echo CHtml::encode($data->s3_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_by')); ?>:</b>
	<?php echo CHtml::encode($data->modified_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_entered')); ?>:</b>
	<?php echo CHtml::encode($data->date_entered); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_modified')); ?>:</b>
	<?php echo CHtml::encode($data->date_modified); ?>
	<br />

	*/ ?>

</div>