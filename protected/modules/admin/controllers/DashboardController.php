<?php

class DashboardController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function actionError()
    {
        $this->layout = '//layouts/login_main';
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

	public function actionIndex()
	{
		if(isFrontUserLoggedIn()){
			$this->render('index');
		} else {
			$this->redirect(CController::createUrl("/admin/login"));
		}
	}
}