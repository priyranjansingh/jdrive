<?php
	$form = $this->beginWidget('CActiveForm', array(
	        'id'=>'srch-form',
	        'action'=>array('/home/search'),
                 'method' => 'GET',
	        'enableClientValidation'=>true,
	        'clientOptions'=>array(
                'validateOnChange'=>true,
	            'validateOnSubmit'=>true,
	        )
	    ));
?>
   <?php echo $form->textField($model,'srch_txt',array('placeholder'=>'Search...','class'=>'s_box')); ?>
   <?php  $form->error($model, 'srch_txt'); ?>
   <input type="search"  class="search-btn"/>
   <input type="submit" value="">
 
    
<?php $this->endWidget(); ?>