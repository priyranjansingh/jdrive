<?php
/* @var $this VideosController */
/* @var $model Videos */

$this->breadcrumbs=array(
	'Videoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Videos', 'url'=>array('index')),
	array('label'=>'Manage Videos', 'url'=>array('admin')),
);
?>

<h1>Create Videos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>