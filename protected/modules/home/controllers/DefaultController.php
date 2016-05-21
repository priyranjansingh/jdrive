<?php

class DefaultController extends Controller {

    public $layout = '//layouts/home_main';
    public $param = 'value';

    public function actionIndex() {
        $songs = Songs::model()->findAll(array("condition" => "status = '1' AND type = '1' AND is_shared = 0 AND deleted = 0", "order" => "date_entered desc", "limit" => 20));
        $videos = Videos::model()->findAll(array("condition" => "status = '1' AND type ='2' AND  is_shared = 0 AND deleted = 0", "order" => "date_entered desc", "limit" => 20));
        $this->render('index', array('songs' => $songs, 'videos' => $videos));
    }

    public function actionLoginCheck() {
        if (Yii::app()->user->isGuest) {
            echo "GUEST";
        } else {
            echo "USER";
        }
    }

    public function actionLogin() {

        // pre($_POST['FrontUserLogin'],true);
        if (Yii::app()->user->isGuest) {
            $model = new FrontUserLogin;

            if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
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

    public function actionSearch() {
        $srch_str = $_GET['Search']['srch_txt'];

        $songs = Songs::model()->findAll(array("condition" => "status = '1' AND type='1' AND deleted = 0 AND is_shared = 0 AND (song_name like '%$srch_str%' OR artist_name like '%$srch_str%' )   ", "order" => "date_entered desc"));
        $videos = Songs::model()->findAll(array("condition" => "status = '1' AND type='2' AND deleted = 0 AND is_shared = 0 AND (song_name like '%$srch_str%' OR artist_name like '%$srch_str%' )   ", "order" => "date_entered desc"));
        $dj = Users::model()->findAll(array("condition" => "status = '1' AND is_admin = '0'  AND deleted = 0 AND (username like '%$srch_str%' OR first_name like '%$srch_str%' OR last_name like '%$srch_str%' )   ", "order" => "date_entered desc"));
        $this->render('search_result', array('songs' => $songs, 'videos' => $videos, 'dj' => $dj));
    }

    public function actionDj($user) {
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->request->urlReferrer);
        } else {
            $user = Users::model()->find(array("condition" => "username = '$user'"));
            $logged_in_user_id = Yii::app()->user->id;
            $recommended_list = Users::model()->getRecommendList($logged_in_user_id, "limited");

            $song_list = Songs::model()->findAll(array("condition" => "status = '1' AND type='1' AND deleted = 0 AND created_by = '$user->id'    ", "order" => "date_entered desc", "limit" => 20));
            $video_list = Songs::model()->findAll(array("condition" => "status = '1' AND type='2' AND deleted = 0 AND created_by = '$user->id'    ", "order" => "date_entered desc", "limit" => 20));
            $total_track_list = count($song_list) + count($video_list);
            $following_list = Followers::model()->findAll(array("condition" => "follower_id = '$user->id'"));
            $follow_unfollow = Followers::model()->find(array("condition" => " user_id = '$user->id' AND follower_id = '$logged_in_user_id' "));
            if (!empty($follow_unfollow)) {
                if ($follow_unfollow->deleted == 0) {
                    $follow_unfollow_text = "Unfollow";
                } else if ($follow_unfollow->deleted == 1) {
                    $follow_unfollow_text = "Follow";
                }
            } else {
                $follow_unfollow_text = "Follow";
            }




            $this->render('dj_profile', array(
                'user' => $user,
                'song_list' => $song_list,
                'video_list' => $video_list,
                'total_track_list' => $total_track_list,
                'following_list' => $following_list,
                'follow_unfollow_text' => $follow_unfollow_text,
                'recommended_list' => $recommended_list,
            ));
        }
    }

    public function actionSongType() {
        $user_id = $_POST['user'];
        $song_type = $_POST['song_type'];
        if ($song_type == 'audio') {
            $song_list = Songs::model()->findAll(array("condition" => "status = '1' AND type='1' AND deleted = 0 AND created_by = '$user_id'    ", "order" => "date_entered desc", "limit" => 20));
        } else if ($song_type == 'video') {
            $song_list = Songs::model()->findAll(array("condition" => "status = '1' AND type='2' AND deleted = 0 AND created_by = '$user_id'    ", "order" => "date_entered desc", "limit" => 20));
        }
        $this->renderPartial('ajax_song', array('song_list' => $song_list));
    }
    
    
     public function actionHomeSongType() {
        $song_type = $_POST['song_type'];
        if ($song_type == 'audio') {
            $song_list = Songs::model()->findAll(array("condition" => "status = '1' AND type='1' AND deleted = 0  ", "order" => "date_entered desc", "limit" => 20));
        } else if ($song_type == 'video') {
            $song_list = Songs::model()->findAll(array("condition" => "status = '1' AND type='2' AND deleted = 0  ", "order" => "date_entered desc", "limit" => 20));
        }
        $this->renderPartial('home_ajax_song', array('song_list' => $song_list));
    }
    
    
    

    public function actionAjaxTrending() {
        $user = $_POST['user'];
        $song_type = $_POST['song_type'];
        if ($song_type == 'audio') {
            $trending_song = Downloads::model()->trendingSong($user);
            $this->renderPartial('ajax_song', array('song_list' => $trending_song));
        } else if ($song_type == 'video') {
            $trending_video = Downloads::model()->trendingVideo($user);
            $this->renderPartial('ajax_song', array('song_list' => $trending_video));
        }
    }
    
    public function actionHomeAjaxTrending() {
        $song_type = $_POST['song_type'];
        if ($song_type == 'audio') {
            $trending_song = Downloads::model()->HomeTrendingSong();
            $this->renderPartial('home_ajax_song', array('song_list' => $trending_song));
        } else if ($song_type == 'video') {
            $trending_video = Downloads::model()->HomeTrendingVideo();
            $this->renderPartial('home_ajax_song', array('song_list' => $trending_video));
        }
    }

    public function actionAjaxJustAdded() {
        $user = $_POST['user'];
        $song_type = $_POST['song_type'];
        if ($song_type == 'audio') {
            $song = Users::model()->AjaxJustAdded($user, 1);
            $this->renderPartial('ajax_song', array('song_list' => $song));
        } else if ($song_type == 'video') {
            $video = Users::model()->AjaxJustAdded($user, 2);
            $this->renderPartial('ajax_song', array('song_list' => $video));
        }
    }
    
    public function actionHomeAjaxJustAdded() {
        $song_type = $_POST['song_type'];
        if ($song_type == 'audio') {
            $song = Users::model()->HomeAjaxJustAdded(1);
            $this->renderPartial('home_ajax_song', array('song_list' => $song));
        } else if ($song_type == 'video') {
            $video = Users::model()->HomeAjaxJustAdded(2);
            $this->renderPartial('home_ajax_song', array('song_list' => $video));
        }
    }
    
    public function actionHomeGenre() {
        $song_type = $_POST['song_type'];
        $genre = $_POST['genre'];
        if ($song_type == 'audio') {
            $song = Users::model()->HomeGenre(1,$genre);
            $this->renderPartial('home_ajax_song', array('song_list' => $song));
        } else if ($song_type == 'video') {
            $video = Users::model()->HomeGenre(2,$genre);
            $this->renderPartial('home_ajax_song', array('song_list' => $video));
        }
    }
    
    
    

    public function actionVerifysong(){
        $song = $_POST['song'];
        $media = Media::model()->find(array('condition' => "slug = '$song'"));
        if($media === null){
            $array['error'] = true;
        } else {
            Yii::app()->s3->setAuth(Yii::app()->params['access_key_id'], Yii::app()->params['secret_access_key']);
            $url = Yii::app()->s3->getAuthenticatedURL($media->s3_bucket, $media->file_name, 600, false, false);
            $array['error'] = false;
            $array['song_name'] = $media->song_name;
            $array['artist_name'] = $media->artist_name;
            $array['url'] = $url;
        }

        echo json_encode($array, true);
    }
    

    public function actionAjaxMyDrive() {
        $user = $_POST['user'];
        $song_type = $_POST['song_type'];
        if ($song_type == 'audio') {
            $song_list = Songs::model()->findAll(array("condition" => "status = '1' AND type='1' AND deleted = 0 AND created_by = '$user'    ", "order" => "date_entered desc", "limit" => 20));
            $this->renderPartial('ajax_song', array('song_list' => $song_list));
        } else if ($song_type == 'video') {
            $video_list = Songs::model()->findAll(array("condition" => "status = '1' AND type='2' AND deleted = 0 AND created_by = '$user'    ", "order" => "date_entered desc", "limit" => 20));
            $this->renderPartial('ajax_song', array('song_list' => $video_list));
        }
    }

    public function actionAjaxPlaylist() {
        $user = $_POST['user'];
        $playlists = Playlists::model()->findAll(array("condition" => "status = '1'  AND deleted = 0 AND user_id = '$user'    ", "order" => "date_entered desc", "limit" => 20));
        $this->renderPartial('ajax_playlist', array('playlists' => $playlists));
    }
    
    
    
      public function actionHomeAjaxPlaylist() {
        $playlists = Playlists::model()->findAll(array("condition" => "status = '1'  AND deleted = 0 ", "order" => "date_entered desc", "limit" => 20));
        $this->renderPartial('home_ajax_playlist', array('playlists' => $playlists));
    }
   
    

    public function actionAjaxPlaylistSongs() {
        $playlist = $_POST['playlist'];
        $song_type = $_POST['song_type'];
        if($song_type =='audio')
        {
            $type = 1;
        } 
        else if($song_type =='video')
        {
            $type = 2;
        }    
        $playlist_detail = Playlists::model()->findByPk($playlist);
        $playlist_songs = PlaylistSongs::model()->findAll(array("condition" => "playlist_id = '$playlist' AND type='$type' "));
        $this->renderPartial('ajax_playlist_songs', array('playlist_songs' => $playlist_songs,'playlist'=>$playlist,'playlist_name' => $playlist_detail->name));
    }
    
    public function actionHomeAjaxPlaylistSongs() {
        $playlist = $_POST['playlist'];
        $playlist_detail = Playlists::model()->findByPk($playlist);
        $playlist_songs = PlaylistSongs::model()->findAll(array("condition" => "playlist_id = '$playlist'"));
        $this->renderPartial('home_ajax_playlist_songs', array('playlist_songs' => $playlist_songs, 'playlist_name' => $playlist_detail->name));
    }

    public function actionFollowUnfollow() {
        if (Yii::app()->user->id) {
            $return_arr = array();
            $user_id = $_POST['dj_id'];
            $follower_id = $_POST['user_id'];
            $follow_unfollow = Followers::model()->find(array("condition" => " user_id = '$user_id' AND follower_id = '$follower_id' "));
            if (empty($follow_unfollow)) {
                $follower_model = new Followers;
                $follower_model->user_id = $user_id;
                $follower_model->follower_id = $follower_id;
                $follower_model->created_by = $follower_id;
                $follower_model->save();
                $user = Users::model()->find(array("condition" => "id = '$user_id'"));
                $dj_followers_count = count($user->followers_list);
                $return_arr['followers_count'] = $dj_followers_count;
                $return_arr['follow_unfollow_text'] = "Unfollow";
                echo json_encode($return_arr);
            } else {
                if ($follow_unfollow->deleted == 0) {
                    $follow_unfollow->deleted = 1;
                    $follow_unfollow->save();
                    $user = Users::model()->find(array("condition" => "id = '$user_id'"));
                    $dj_followers_count = count($user->followers_list);
                    $return_arr['followers_count'] = $dj_followers_count;
                    $return_arr['follow_unfollow_text'] = "Follow";
                    echo json_encode($return_arr);
                } else if ($follow_unfollow->deleted == 1) {
                    $follow_unfollow->deleted = 0;
                    $follow_unfollow->save();
                    $user = Users::model()->find(array("condition" => "id = '$user_id'"));
                    $dj_followers_count = count($user->followers_list);
                    $return_arr['followers_count'] = $dj_followers_count;
                    $return_arr['follow_unfollow_text'] = "Unfollow";
                    echo json_encode($return_arr);
                }
            }
        }
    }

    public function actionFollowUnfollowRecommend() {
        if (Yii::app()->user->id) {
            $return_arr = array();
            $user_id = $_POST['dj_id'];
            $follower_id = $_POST['user_id'];
            $follow_unfollow = Followers::model()->find(array("condition" => " user_id = '$user_id' AND follower_id = '$follower_id' "));
            if (empty($follow_unfollow)) {
                $follower_model = new Followers;
                $follower_model->user_id = $user_id;
                $follower_model->follower_id = $follower_id;
                $follower_model->created_by = $follower_id;
                $follower_model->save();
                $user = Users::model()->find(array("condition" => "id = '$user_id'"));
                $dj_followers_count = count($user->followers_list);
            } else {
                if ($follow_unfollow->deleted == 0) {
                    $follow_unfollow->deleted = 1;
                    $follow_unfollow->save();
                    $user = Users::model()->find(array("condition" => "id = '$user_id'"));
                    $dj_followers_count = count($user->followers_list);
                } else if ($follow_unfollow->deleted == 1) {
                    $follow_unfollow->deleted = 0;
                    $follow_unfollow->save();
                    $user = Users::model()->find(array("condition" => "id = '$user_id'"));
                    $dj_followers_count = count($user->followers_list);
                }
            }
            $logged_in_user_id = Yii::app()->user->id;
            $recommended_list = Users::model()->getRecommendList($logged_in_user_id, "limited");
            $this->renderPartial('ajax_recommended', array('recommended_list' => $recommended_list));
        }
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->baseUrl . '/home');
    }

    public function actionSignup() {
        if (Yii::app()->user->isGuest) {
            $model = new Registration;
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'signup-form') {
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

    public function actionChooseplans() {
        // echo "I am Here";
        $plans = BaseModel::getAll('Plans');
        $this->render('plans', array('plans' => $plans));
    }

    public function actionPayment($plan) {
        $this->layout = '//layouts/payment_main';
        $plan = Plans::model()->findByPk($plan);
        if ($plan === null) {
            $this->redirect(array('chooseplans'));
        } else {
            Yii::app()->session['register_user_plan'] = serialize($plan);
            $this->render("payment", array('plan' => $plan));
        }
    }

    public function actionProcess() {
        if (isset($_POST['stripeToken'])) {
            require('./assets/stripe/init.php');
            $token = $_POST['stripeToken'];
            $plan = Yii::app()->session['register_user_plan'];
            $plan = unserialize($plan);
            //pre($plan,true);
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
            $bucket = $user->username . '-' . create_guid_section(6);
            $aws->addBucket($bucket);
            $user_model = Users::model()->findByPk($user->id);
            $user_model->s3_bucket = $bucket;
            $user_model->save();
            $user_plan = new UserPlan;
            $user_plan->plan_id = $plan->id;
            $user_plan->user_id = $user->id;
            $user_plan->plan_start_date = date("Y-m-d");
            $user_plan->plan_end_date = date("Y-m-d", strtotime('+' . $plan->plan_duration . ' ' . $plan->plan_duration_type . 's'));
            $user_plan->save();
            Yii::app()->session['payment_success'] = true;
            $this->redirect(array('success'));
            // pre($customer,true);
        }
    }

    public function actionTest() {
        // $info = new FileInfo("assets/temp/Kehlani - 24 7 (Dirty).mp3");
       // $url = "http://arommatech-dc6421.s3.amazonaws.com/Kehlani%20-%2024%207%20%28Dirty%29.mp3?AWSAccessKeyId=AKIAJBTQKEKGZSJDLKSA&Expires=1463690396&Signature=LgTUyehhZ1CKWQiDojA2RP2Cy2s%3D";
       // $info = getSongBPM($url);
        // getSongBPM($url);
        // $api = new ApiSearch($info->data['artist'], $info->data['song'], $info->data['album']);
        // pre($api);
        
        $model = Media::model()->findAll();
        pre($model,true);
    }

    public function actionWebhook($listner) {

        if (isset($listner) && $listner == 'stripe') {

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

            if (isset($event_json->id)) {

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
                    if ($event->type == 'invoice.payment_succeeded') {
                        // send a payment receipt email here
                        // retrieve the payer's information
                        $customer = \Stripe\Customer::retrieve($data->customer);
                        // pre($customer,true);
                        $email = $customer->email;

                        $amount = $invoice->amount / 100; // amount comes in as amount in cents, so we need to convert to dollars

                        $jd_inv = Invoice::model()->findByPk(getParam('invoice'));

                        $t_model = new Transactions;
                        $t_model->invoice = $jd_inv->invoice_text . '-' . $jd_inv->invoice_count;
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

    public function actionSuccess() {
        if (isset(Yii::app()->session['payment_success'])) {
            $user = Yii::app()->session['register_user_info'];
            $user = unserialize($user);

            $model = new AutoLogin;
            // pre($user->username);
            // pre($user->password);
            // new AutoIdentity($user->username,$user->password);
            $model->username = $user->username;
            $model->password = $user->password;
            if ($model->validate() && $model->login()) {
                $this->redirect(array('purchased'));
            } else {
                pre($model->getErrors(), true);
            }
            $this->redirect(array('purchased'));
        }
    }

    public function actionPurchased() {
        if (isset(Yii::app()->session['payment_success'])) {
            $plan = Yii::app()->session['register_user_plan'];
            $plan = unserialize($plan);
            $this->render('success', array('plan' => $plan));
        }
    }

    public function actionUpload() {
        $mode = 'authenticated-read';
        if(isset($_REQUEST['mode'])){
            $mode = $_REQUEST['mode'];    
        }
        
        $user_id = Yii::app()->user->id;
        $bucket = Users::model()->findByPk($user_id)->s3_bucket;
        $upload_handler = new UploadHandlerS3(null, true, null, $bucket, $mode);
        // pre($upload_handler,true);
    }

    public function actionAddsongs() {
        $temp = Temp::model()->findAll();
        if($temp !== null){
            Yii::app()->s3->setAuth(Yii::app()->params['access_key_id'], Yii::app()->params['secret_access_key']);
            foreach ($temp as $t) {
                $file_url = Yii::app()->s3->getAuthenticatedURL($t->s3_bucket, $t->file_name, 3600, false, false);
                // pre($file_url,true);
                if (copy($file_url, "assets/temp/" . $t->file_name)) {
                    $info = new FileInfo("assets/temp/" . $t->file_name);
                    if($info->data['error'] === false){
                        $g = $info->data['genre'];
                        $api = new ApiSearch($info->data['artist'], $info->data['song'], $info->data['album']);
                        if($g == "NA"){
                            $g = $api->genre;
                        }
                        $genre = Genres::model()->find(array("condition" => "name = '$g'"));
                        if ($genre === null) {
                            $g_model = new Genres;
                            $g_model->name = $g;
                            $g_model->parent = null;
                            if ($g_model->save()) {
                                $g = $g_model->id;
                            } else {
                                pre($g_model->getErrors(), true);
                            }
                        } else {
                            $g = $genre->id;
                        }
                        $bpm = getSongBPM($file_url);
                        $key = getSongKey($file_url);
                        $model = new Media;
                        $model->id = create_guid();
                        $model->type = $t->type;
                        $model->song_name = $info->data['song'];
                        $model->artist_name = $info->data['artist'];
                        $model->acl = $t->acl;
                        $model->genre = $g;
                        $model->s3_url = $t->s3_url;
                        $model->s3_bucket = $t->s3_bucket;
                        $model->file_name = $t->file_name;
                        $model->album_art = $api->album_art;
                        $model->bpm = $bpm;
                        $model->song_key = $key;
                        $model->created_by = $t->user_id;
                        $model->modified_by = $t->user_id;
                        $model->status = 1;
                        $model->deleted = 0;
                        $model->date_entered = date("Y-m-d H:i:s");
                        $model->date_modified = date("Y-m-d H:i:s");
                        if ($model->save()) {
                            unlink("assets/temp/" . $t->file_name);
                            Temp::model()->deleteByPk($t->id);
                        } else {
                            pre($api->bpm);
                            pre($model->getErrors(), true);
                        }
                    } else {
                        unlink("assets/temp/" . $t->file_name);
                        Temp::model()->deleteByPk($t->id);
                    }
                }
            }
        }
    }

    /**
     * Performs the AJAX validation.
     * @param Genres $model the model to be validated
     */
    protected function performAjaxValidation($model, $form_id) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === $form_id) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionWidgetUpload() {
        $user_id = $_POST['user_id'];
        $song_id = $_POST['song_id'];
        $song_detail = Songs::model()->findByPk($song_id);

        $model = new Songs;
        $model->song_name = $song_detail->song_name;
        $model->artist_name = $song_detail->artist_name;
        $model->slug = $song_detail->slug;
        $model->s3_bucket = $song_detail->s3_bucket;
        $model->file_name = $song_detail->file_name;
        $model->type = $song_detail->type;
        $model->bpm = $song_detail->bpm;
        $model->song_key = $song_detail->song_key;
        //  $model->file_size = $song_detail->file_size;
        $model->genre = $song_detail->genre;
        $model->sub_genre = $song_detail->sub_genre;
        $model->sub_sub_genre = $song_detail->sub_sub_genre;
        $model->s3_url = $song_detail->s3_url;
        $model->is_shared = 1;
        $model->status = $song_detail->status;
        $model->deleted = $song_detail->deleted;
        $model->created_by = $user_id;
        $model->modified_by = $user_id;
        $model->save();
        echo "success";
    }

    public function actionWidgetLike() {
        if (Yii::app()->user->id) {
            $user_id = $_POST['user_id'];
            $song_id = $_POST['song_id'];
            $song_like = SongLike::model()->find(array("condition" => " user_id = '$user_id' AND song_id = '$song_id' "));
            if (empty($song_like)) {
                $song_like_model = new SongLike;
                $song_like_model->user_id = $user_id;
                $song_like_model->song_id = $song_id;
                $song_like_model->save();
                $song = Songs::model()->find(array("condition" => "id = '$song_id'"));
                $song_like_count = count($song->like_details);
            } else {
                if ($song_like->deleted == 0) {
                    $song_like->deleted = 1;
                    $song_like->save();
                    $song = Songs::model()->find(array("condition" => "id = '$song_id'"));
                    $song_like_count = count($song->like_details);
                } else if ($song_like->deleted == 1) {
                    $song_like->deleted = 0;
                    $song_like->save();
                    $song = Songs::model()->find(array("condition" => "id = '$song_id'"));
                    $song_like_count = count($song->like_details);
                }
            }
            echo $song_like_count;
        }
    }

    public function actionWidgetDownload($file) {
        
        $song_detail = Songs::model()->findByPk($file);
        
        $user_id = Yii::app()->user->id;
        $download_model = new Downloads;
        $download_model->user_id = $user_id;
        $download_model->song_id = $song_detail->id;
        $download_model->owner_id = $song_detail->created_by;
        $download_model->type = $song_detail->type;
        $download_model->save();
        
        $s3 = new AS3;
        $result = $s3->getSong($song_detail->s3_bucket, $song_detail->file_name);

        // try {
            // Display the object in the browser
            header("Content-Type: {$result['ContentType']}");
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.$song_detail->file_name);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            ob_clean();
            flush();
            echo $result['Body'];
        // } catch (S3Exception $e) {
            // echo $e->getMessage() . "\n";
        // }
/*
        Yii::app()->s3->setAuth(Yii::app()->params['access_key_id'], Yii::app()->params['secret_access_key']);


        


        $file = $song_detail->file_name;
        $bucket_name = $song_detail->s3_bucket;
        $result = Yii::app()->s3->getObject($bucket_name, $file);
        $result_info = Yii::app()->s3->getObjectInfo($bucket_name, $file);
        header("Content-Type: {$result_info['type']}");
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$file);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        ob_clean();
        flush();
        echo $result->body;
        */


//        if (file_exists($file)) {
//
//            $user_id = Yii::app()->user->id;
//            $download_model = new Downloads;
//            $download_model->user_id = $user_id;
//            $download_model->song_id = $song_detail->id;
//            $download_model->owner_id = $song_detail->created_by;
//            $download_model->type = $song_detail->type;
//            $download_model->save();
//
//
//            header('Content-Description: File Transfer');
//            header('Content-Type: application/octet-stream');
//            header('Content-Disposition: attachment; filename=' . basename($file));
//            header('Content-Transfer-Encoding: binary');
//            header('Expires: 0');
//            header('Cache-Control: must-revalidate');
//            header('Pragma: public');
//            header('Content-Length: ' . filesize($file));
//            ob_clean();
//            flush();
//            readfile($file);
//            exit;
//        }
    }

    public function actionWidgetAddToPlaylist() {
        $song_id = $_POST['song_id'];
        $user_id = Yii::app()->user->id;
        $playlist = Playlists::model()->findAll(array("condition" => "user_id = '$user_id'"));
        $playlist_model = new Playlists;
        $this->renderPartial('ajax_add_playlist', array('playlist' => $playlist, 'song_id' => $song_id, 'playlist_model' => $playlist_model));
    }

    public function actionAjaxAddToPlaylist() {
        $song = $_POST['song'];
        $playlist = $_POST['playlist'];
        $song_detail = Songs::model()->findByPk($song);
        $playlist_model = PlaylistSongs::model()->find(array("condition" => "playlist_id = '$playlist' AND song_id ='$song' AND deleted = 0 "));
        if (empty($playlist_model)) {
            $playlist_new_model = new PlaylistSongs;
            $playlist_new_model->playlist_id = $playlist;
            $playlist_new_model->song_id = $song;
            $playlist_new_model->type = $song_detail->type;
            $playlist_new_model->validate();
            $playlist_new_model->save();
        }
    }

    public function actionAjaxAddPlaylistWithSong() {
        $model = new Playlists;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'playlist-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Playlists'])) {
            $model->attributes = $_POST['Playlists'];
            $model->user_id = Yii::app()->user->id;
            if ($model->validate()) {
                $model->save();
                // adding to playlist_songs table
                
                $song_detail = Songs::model()->findByPk($_POST['playlist_song']);

                $playlist_songs = new PlaylistSongs;
                $playlist_songs->playlist_id = $model->id;
                $playlist_songs->song_id = $_POST['playlist_song'];
                $playlist_songs->type = $song_detail->type;
                $playlist_songs->save();


                $this->redirect(Yii::app()->request->urlReferrer);
            }
        }
    }

    

}
