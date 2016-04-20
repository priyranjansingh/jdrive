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
        if (Yii::app()->user->isGuest) {
            $model = new FrontUserLogin;
            $this->performAjaxValidation($model,'login-form');
            if (isset($_POST['FrontUserLogin'])) {
                $model->attributes = $_POST['FrontUserLogin'];
                if ($model->validate()) {
                    $this->redirect(Yii::app()->controller->module->returnUrl);
                }
            }
            $this->render('index', array('model' => $model));
        } else {
            $this->redirect(Yii::app()->controller->module->returnUrl);
        }
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
