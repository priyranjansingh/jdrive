<?php  
	Yii::import("application.modules.home.models.FrontUserLogin", true);
	class LoginWidget extends CWidget {
		public function run() {
		    $model = new FrontUserLogin;

		    $this->render('loginForm',array('model'=>$model));
		} 
	} 
?>