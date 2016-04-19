<?php

class DefaultController extends Controller {
    public $layout = '//layouts/home_main';
    public $param = 'value';

    public function actionIndex() {
        $model = new Registration;
        if (isset($_POST['Registration'])) {
            $model->attributes = $_POST['Registration'];
            if ($model->validate()) {
                $model->password = HomeModule::encrypting($model->password);
                $model->confirm_password = $model->password;
                $model->email = $model->email;

                $role_id = getParam('front_user_role');
                $model->role_id = $role_id;
                $model->status = 0;
                $model->save();
                // mail sending
//                $route = 'activate';
//                $params = array('activation_key' => $model->activation_key);
//                $url = $this->createUrl($route, $params);
//                $url = $_SERVER['SERVER_NAME'] . $url;
//                $to = $model->email;
//                $subject = 'Account Activation Link';
//                $message = ' <a href="' . $url . '">Click on the link</a>';
//                mailsend($to, "arommatech@gmail.com", $subject, $message);
//                $this->redirect(base_url() . '/user/success');
                // end of mail sending
                //Yii::app()->session['user_id'] = $model->id;
                //Yii::app()->session['user_name'] = $model->username;
                //$this->redirect(array("myaccount"));
            }
        }
        $this->render('index',array('model' => $model));
    }

}
