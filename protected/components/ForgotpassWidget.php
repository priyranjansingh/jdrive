<?php  
	Yii::import("application.modules.user.models.ForgotPassword", true);
	class ForgotpassWidget extends CWidget {
		public function run() {
		    $model = new ForgotPassword;
		    $this->render('forgotpasswordForm',array('model'=>$model));
		} 
	} 
?>