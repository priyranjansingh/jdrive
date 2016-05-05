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

    public function actionSignup()
    {
        if (Yii::app()->user->isGuest) {
            $model = new Registration;
            if(isset($_POST['ajax']) && $_POST['ajax']==='signup-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            if (isset($_POST['Registration'])) {
                $model->attributes = $_POST['Registration'];
                $model->role_id = getParam('front_user_role');
                if ($model->validate()) {
                    $model->password = md5($model->password);
                    $model->confirm_password = $model->password;
                    $model->save();
                    Yii::app()->session['register_user_info'] = serialize($model);
                    $this->redirect(base_url() . '/home/chooseplans');
                } else {
                    pre($model->getErrors());
                }
            }
            // $this->render('register', array('model' => $model));
        } else {
            $this->redirect(array("myaccount"));
        }
    }

    public function actionChooseplans()
    {
        // echo "I am Here";
        $plans = BaseModel::getAll('Plans');
        $this->render('plans',array('plans' => $plans));
    }

    public function actionPayment($plan)
    {
        $this->layout = '//layouts/payment_main';
        $plan = Plans::model()->findByPk($plan);
        if($plan === null)
        {
            $this->redirect(array('chooseplans'));
        } else {
            Yii::app()->session['register_user_plan'] = serialize($plan);
            $this->render("payment",array('plan'=>$plan));
        }
    }

    public function actionProcess()
    {
        if(isset($_POST['stripeToken']))
        {
            require('./assets/stripe/init.php');
            $token = $_POST['stripeToken'];
            $plan = Yii::app()->session['register_user_plan'];
            $plan = unserialize($plan);
            $user = Yii::app()->session['register_user_info'];
            $user = unserialize($user);
            $secret_key = getParam('stripe_secret_key');
            \Stripe\Stripe::setApiKey($secret_key);
            $customer = \Stripe\Customer::create(array(
              "source" => $token,
              "plan" => $plan->stripe_plan,
              "email" => $user->email,
              "id" => $user->id)
            );
            // createS3bucket($user->username);
            $aws = new AS3;
            $bucket = $user->username.'-'.create_guid_section(6);
            $aws->addBucket($bucket);
            $user_model = Users::model()->findByPk($user->id);
            $user_model->s3_bucket = $bucket;
            $user_model->save();
            $user_plan = new UserPlan;
            $user_plan->plan_id = $plan->id;
            $user_plan->user_id = $user->id;
            $user_plan->plan_start_date = date("Y-m-d");
            $user_plan->plan_end_date = date("Y-m-d", strtotime('+'.$plan->plan_duration.' '.$plan->plan_duration_type.'s'));
            $user_plan->save();
            Yii::app()->session['payment_success'] = true;
            $this->redirect(array('success'));
            // pre($customer,true);
        }
    }

    public function actionTest()
    {
        $test = Test::model()->findByPk('9d3b5927-122c-11e6-a8fe-3c07717072c4');
        $event = $test->response;
        // pre(json_decode(substr($event, 19)),true);
        $event = json_decode(substr($event, 19));
        $data = $event->data->object;
        $invoice = $data->lines->data[0];
        pre($invoice,true);
        require('./assets/stripe/init.php');
     
        $secret_key = getParam('stripe_secret_key');
   
        \Stripe\Stripe::setApiKey($secret_key);
        // successful payment
        $customer = \Stripe\Customer::retrieve($data->customer);
        pre($customer,true);

    }

    public function actionWebhook($listner)
    {

         if(isset($listner) && $listner == 'stripe') {
     
            global $stripe_options;
     
            require('./assets/stripe/init.php');
     
            $secret_key = getParam('stripe_secret_key');
       
            \Stripe\Stripe::setApiKey($secret_key);
     
            // retrieve the request's body and parse it as JSON
            $body = @file_get_contents('php://input');
            $model = new Test;
            $model->response = $body;
            $model->type = 'response';
            $model->save();
            // grab the event information
            $event_json = json_decode($body);
     
            // this will be used to retrieve the event from Stripe
            $event_id = $event_json->id;
     
            if(isset($event_json->id)) {
     
                try {
                    // to verify this is a real event, we re-retrieve the event from Stripe 
                    $event = \Stripe\Event::retrieve($event_id);
                    $model = new Test;
                    $model->response = $event;
                    $model->type = 'event';
                    $model->save();
                    $event = substr($event, 19);
                    $evemt = json_decode($event);
                    $data = $event->data->object;
                    $invoice = $data->lines->data[0];
                    // successful payment
                    if($event->type == 'invoice.payment_succeeded') {
                        // send a payment receipt email here
     
                        // retrieve the payer's information
                        $customer = \Stripe\Customer::retrieve($data->customer);
                        // pre($customer,true);
                        $email = $customer->email;
     
                        $amount = $invoice->amount / 100; // amount comes in as amount in cents, so we need to convert to dollars
                        
                        $jd_inv = Invoice::model()->findByPk(getParam('invoice'));
                        
                        $t_model = new Transactions;
                        $t_model->invoice = $jd_inv->invoice_text.'-'.$jd_inv->invoice_count;
                        $t_model->user_id = $customer->sources->data[0]->customer;
                        $t_model->plan_id = $invoice->plan->id;
                        $t_model->transaction_id = $invoice->id;
                        $t_model->payment_method = 'stripe';
                        $t_model->amount = $amount;
                        $t_model->details = $body;
                        $t_model->save();

                        $jd_inv->invoice_count = $jd_inv->invoice_count + 1;
                        $jd_inv->save();

                        $subject = 'Jock Drive Payment Receipt';
                        $headers = 'From: <info@dealrush.in>';
                        $message = "Hello User,\n\n";
                        $message .= "You have successfully made a payment of " . $amount . "\n";
                        $message .= "Thank you.";
     
                        mail($email, $subject, $message, $headers);
                    }
     
                } catch (Exception $e) {
                    $headers = 'From: <info@dealrush.in>';
                    mail('neeraj24a@gmail.com', 'Jockdrive Payment Exception', $e, $headers);
                }
            }
        }
    }

    public function actionSuccess()
    {
        if(isset(Yii::app()->session['payment_success'])){
            $plan = Yii::app()->session['register_user_plan'];
            $plan = unserialize($plan);
            echo date('d/m/Y', strtotime('+1 years'));
            pre($plan,true);
            // $this->render('success',array('plan' => $plan));
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
