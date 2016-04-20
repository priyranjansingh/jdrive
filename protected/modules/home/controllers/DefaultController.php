<?php

class DefaultController extends Controller {
    public $layout = '//layouts/home_main';
    public $param = 'value';

    public function actionIndex() {
        $songs =  Songs::model()->findAll(array("condition" => "status = '1' AND deleted = 0","order"=>"date_entered desc","limit"=>20));
        $videos = Videos::model()->findAll(array("condition" => "status = '2' AND deleted = 0","order"=>"date_entered desc","limit"=>20));
        $this->render('index',array('songs'=>$songs,'videos'=>$videos));
    }

    public function actionLogin()
    {

        // pre($_POST['FrontUserLogin'],true);
        if (Yii::app()->user->isGuest) {
            $model = new FrontUserLogin;

            if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            if (isset($_POST['FrontUserLogin'])) {
                $model->attributes = $_POST['FrontUserLogin'];
                if ($model->validate() && $model->login()) {
                    $this->redirect(Yii::app()->user->returnUrl);
                }
            }
            $this->render('index', array('model' => $model));
        } else {
            die("here");
            $this->redirect(Yii::app()->user->returnUrl);
        }
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->baseUrl.'/home');
    }

    /**
     * Performs the AJAX validation.
     * @param Genres $model the model to be validated
     */
    protected function performAjaxValidation($model, $form_id)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']===$form_id)
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
