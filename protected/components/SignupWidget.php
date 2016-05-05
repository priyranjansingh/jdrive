<?php  
	Yii::import("application.modules.home.models.Registration", true);
	class SignupWidget extends CWidget {
		public function run() {
		    $model = new Registration;

		    $this->render('signupForm',array('model'=>$model));
		} 
	} 
?>