<?php

class DefaultController extends Controller {

    public $layout = '//layouts/home_main';

    public function actionIndex() {
        $this->render('index');
    }

    public function actionProfile() {
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->request->urlReferrer);
        } else {
            $logged_in_user_id = Yii::app()->user->id;
            $user = Users::model()->find(array("condition" => "id = '$logged_in_user_id'"));
            $recommended_list = Users::model()->getRecommendList($logged_in_user_id);
            
            

            $shared_songs = SongShare::model()->findAll(array("select" => "song_id", "condition" => "user_id = '$logged_in_user_id' AND type='1' "));
            $shared_videos = SongShare::model()->findAll(array("select" => "song_id", "condition" => "user_id = '$logged_in_user_id' AND type='2' "));

            if (!empty($shared_songs)) {
                $shared_songs_ids = array();
                foreach ($shared_songs as $s) {
                    array_push($shared_songs_ids, "'$s->song_id'");
                }
                $ids = implode(',', $shared_songs_ids);
                $song_list = Songs::model()->findAll(
                        array(
                            "condition" =>
                            "status = '1' AND type='1' AND deleted = 0 AND"
                            . " ((created_by = '$logged_in_user_id') OR (id IN($ids)) )  ", "order" => "date_entered desc")
                );
            } else {
                $song_list = Songs::model()->findAll(
                        array(
                            "condition" =>
                            "status = '1' AND type='1' AND deleted = 0 AND"
                            . " created_by = '$logged_in_user_id' ", "order" => "date_entered desc")
                );
            }
            
            
            
            if (!empty($shared_videos)) {
                $shared_videos_ids = array();
                foreach ($shared_videos as $s) {
                    array_push($shared_videos_ids, "'$s->song_id'");
                }
                $v_ids = implode(',', $shared_videos_ids);
                $video_list = Songs::model()->findAll(
                        array(
                            "condition" =>
                            "status = '1' AND type='2' AND deleted = 0 AND"
                            . " ((created_by = '$logged_in_user_id') OR (id IN($ids)) )  ", "order" => "date_entered desc")
                );
            } else {
                $video_list = Songs::model()->findAll(
                        array(
                            "condition" =>
                            "status = '1' AND type='2' AND deleted = 0 AND"
                            . " created_by = '$logged_in_user_id' ", "order" => "date_entered desc")
                );
            }
            
            
            
            
            
            
            

           // $song_list = Songs::model()->findAll(array("condition" => "status = '1' AND type='1' AND deleted = 0 AND created_by = '$logged_in_user_id'    ", "order" => "date_entered desc", "limit" => 20));
           // $video_list = Songs::model()->findAll(array("condition" => "status = '1' AND type='2' AND deleted = 0 AND created_by = '$logged_in_user_id'    ", "order" => "date_entered desc", "limit" => 20));
            $total_track_list = count($song_list) + count($video_list);
            $following_list = Followers::model()->findAll(array("condition" => "follower_id = '$logged_in_user_id'"));
            $follow_unfollow = Followers::model()->find(array("condition" => " user_id = '$logged_in_user_id' AND follower_id = '$logged_in_user_id' "));
            if (!empty($follow_unfollow)) {
                if ($follow_unfollow->deleted == 0) {
                    $follow_unfollow_text = "Unfollow";
                } else if ($follow_unfollow->deleted == 1) {
                    $follow_unfollow_text = "Follow";
                }
            } else {
                $follow_unfollow_text = "Follow";
            }
           // pre($song_list,true);

            $this->render('profile', array(
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

    public function actionEdit() {
        if (Yii::app()->user->isGuest) {
            $this->redirect(base_url());
        } else {
            $logged_in_user_id = Yii::app()->user->id;
            $model = Users::model()->findByPk($logged_in_user_id);

            $this->render('edit', array('model' => $model));
        }
    }

    public function actionDrive() {
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->request->urlReferrer);
        } else {
            $logged_in_user_id = Yii::app()->user->id;

            $shared_songs = SongShare::model()->findAll(array("select" => "song_id", "condition" => "user_id = '$logged_in_user_id' "));

            if (!empty($shared_songs)) {
                $shared_songs_ids = array();
                foreach ($shared_songs as $s) {
                    array_push($shared_songs_ids, "'$s->song_id'");
                }
                $ids = implode(',', $shared_songs_ids);
                $song_list = Songs::model()->findAll(
                        array(
                            "condition" =>
                            "status = '1' AND type='1' AND deleted = 0 AND"
                            . " ((created_by = '$logged_in_user_id') OR (id IN($ids)) )  ", "order" => "date_entered desc")
                );
            } else {
                $song_list = Songs::model()->findAll(
                        array(
                            "condition" =>
                            "status = '1' AND type='1' AND deleted = 0 AND"
                            . " created_by = '$logged_in_user_id' ", "order" => "date_entered desc")
                );
            }

            $genres = Genres::model()->findAll(array("condition" => "parent = '0'"));
            $this->render('drive', array('song_list' => $song_list, 'genres' => $genres, 'logged_in_user_id' => $logged_in_user_id));
        }
    }

    public function actionAjaxSongType() {
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->request->urlReferrer);
        } else {
            $song_type = $_POST['song_type'];
            if ($song_type == 'audio') {
                $type = 1;
            } else if ($song_type == 'video') {
                $type = 2;
            }
            $logged_in_user_id = Yii::app()->user->id;

            $shared_songs = SongShare::model()->findAll(array("select" => "song_id", "condition" => "user_id = '$logged_in_user_id' "));

            if (!empty($shared_songs)) {
                $shared_songs_ids = array();
                foreach ($shared_songs as $s) {
                    array_push($shared_songs_ids, "'$s->song_id'");
                }
                $ids = implode(',', $shared_songs_ids);
                $song_list = Songs::model()->findAll(
                        array(
                            "condition" =>
                            "status = '1' AND type='$type' AND deleted = 0 AND"
                            . " ((created_by = '$logged_in_user_id') OR (id IN($ids)) )  ", "order" => "date_entered desc")
                );
            } else {
                $song_list = Songs::model()->findAll(
                        array(
                            "condition" =>
                            "status = '1' AND type='$type' AND deleted = 0 AND"
                            . " created_by = '$logged_in_user_id' ", "order" => "date_entered desc")
                );
            }

            $this->renderPartial('ajax_drive', array('song_list' => $song_list,'logged_in_user_id' => $logged_in_user_id));
        }
    }

    public function actionAjaxDrive() {
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->request->urlReferrer);
        } else {
            $genre = $_POST['genre'];
            $song_type = $_POST['song_type'];
            if ($song_type == 'audio') {
                $type = 1;
            } else if ($song_type == 'video') {
                $type = 2;
            }
            $logged_in_user_id = Yii::app()->user->id;
            
             $shared_songs = SongShare::model()->findAll(array("select" => "song_id", "condition" => "user_id = '$logged_in_user_id' "));

            if (!empty($shared_songs)) {
                $shared_songs_ids = array();
                foreach ($shared_songs as $s) {
                    array_push($shared_songs_ids, "'$s->song_id'");
                }
                $ids = implode(',', $shared_songs_ids);
                $song_list = Songs::model()->findAll(
                        array(
                            "condition" =>
                            "status = '1' AND type='$type' AND genre='$genre' AND deleted = 0 AND"
                            . " ((created_by = '$logged_in_user_id') OR (id IN($ids)) )  ", "order" => "date_entered desc")
                );
            } else {
                $song_list = Songs::model()->findAll(
                        array(
                            "condition" =>
                            "status = '1' AND type='$type' AND genre='$genre' AND deleted = 0 AND"
                            . " created_by = '$logged_in_user_id' ", "order" => "date_entered desc")
                );
            }
            
            
            $this->renderPartial('ajax_drive', array('song_list' => $song_list,'logged_in_user_id' => $logged_in_user_id));
        }
    }

    public function actionSongDetail() {
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->request->urlReferrer);
        } else {
            $song = $_POST['song'];
            $song_model = Songs::model()->findByPk($song);
            $this->renderPartial('ajax_edit_song', array('song_model' => $song_model));
            $script = Yii::app()->clientScript->scripts[CClientScript::POS_READY]['CActiveForm#song_edit_form'];
            echo "<script type='text/javascript'>$script</script>";
        }
    }

    public function actionEditSong($song) {
        $song_model = Songs::model()->findByPk($song);
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'song_edit_form') {
            echo CActiveForm::validate($song_model);
            Yii::app()->end();
        }
        if (isset($_POST['Songs'])) {
            $song_model->attributes = $_POST['Songs'];
            if ($song_model->validate()) {
                $song_model->save();
                $this->redirect(base_url() . '/user/drive');
            } else {
                pre($song_model->getErrors());
            }
        }
    }

    public function actionAjaxDelete() {
        if (Yii::app()->user->id) {
            $song = $_POST['song'];
            $song_detail = Songs::model()->findByPk($song);
            if (!empty($song_detail)) {

                // deleting from the downloads table
                Downloads::model()->deleteAll(array("condition" => "song_id = '$song_detail->id'"));

                // deleting from the song_like table
                SongLike::model()->deleteAll(array("condition" => "song_id = '$song_detail->id'"));

                // deleting from the playlist_songs table

                PlaylistSongs::model()->deleteAll(array("condition" => "song_id = '$song_detail->id'"));

                // deleting from the amazon bucket
                $s3 = new AS3;
                $result = $s3->deleteSong($song_detail->s3_bucket, $song_detail->file_name);


                if ($song_detail->is_shared == 0) {
                    $shared_songs = Songs::model()->findAll(array("condition" => "file_name = '$song_detail->file_name' AND is_shared = 1 ", "order" => "date_entered asc"));
                    if (!empty($shared_songs)) {
                        $song_model = $shared_songs[0];
                        $song_model->is_shared = 0;
                        $song_model->save();
                    }
                }

                // deleting from the media table 
                $song_detail->delete();
                echo "success";
            } else {
                echo "failure";
            }
        }
    }

    public function actionPaymenthistory(){
        if (Yii::app()->user->id) {
            $model=new Transactions('search');
            $model->unsetAttributes();

            $this->render('payment_history',array(
                'model'=>$model,
            ));
        } else {
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    protected function gridPlan($data)
    {
        $plan = $data->plan_id;
        return Plans::model()->find(array("condition" => "stripe_plan = '$plan'"))->plan_name;
    }
    
    public function actionPlans() {
        
        $this->layout = '//layouts/payment_main';
        //$user = Yii::app()->session['register_user_info'];
       
        //$user = unserialize($user);
        //pre($user,true);
        $user_id = Yii::app()->user->id;
        $user_plan = UserPlan::model()->getUserActivePlan($user_id);
       
        $plans = BaseModel::getAll('Plans', array('order' => 'plan_serial ASC'));
        $this->render('plans', array('plans' => $plans, 'user_plan' => $user_plan));
    }

}
