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

            $song_list = Songs::model()->findAll(array("condition" => "status = '1' AND type='1' AND deleted = 0 AND created_by = '$logged_in_user_id'    ", "order" => "date_entered desc", "limit" => 20));
            $video_list = Songs::model()->findAll(array("condition" => "status = '1' AND type='2' AND deleted = 0 AND created_by = '$logged_in_user_id'    ", "order" => "date_entered desc", "limit" => 20));
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
            $song_list = Songs::model()->findAll(array("condition" => "status = '1' AND type='1' AND deleted = 0 AND created_by = '$logged_in_user_id' ", "order" => "date_entered desc"));
            $genres = Genres::model()->findAll(array("condition" => "parent = '0'"));
            $this->render('drive', array('song_list' => $song_list, 'genres' => $genres));
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
            $song_list = Songs::model()->findAll(array("condition" => "status = '1' AND type='$type' AND deleted = 0 AND created_by = '$logged_in_user_id' ", "order" => "date_entered desc"));
            $this->renderPartial('ajax_drive', array('song_list' => $song_list));
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
            $song_list = Songs::model()->findAll(array("condition" => "status = '1' AND type='$type' AND genre='$genre' AND deleted = 0 AND created_by = '$logged_in_user_id' ", "order" => "date_entered desc"));
            $this->renderPartial('ajax_drive', array('song_list' => $song_list));
        }
    }

    public function actionSongDetail() {
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->request->urlReferrer);
        } else {
            $song = $_POST['song'];
            $song_model = Songs::model()->findByPk($song);
            $this->renderPartial('ajax_edit_song', array('song_model' => $song_model));
        }
    }
    
    public function actionEditSong($song) {
             $song_model = Songs::model()->findByPk($song);
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'song_edit_form') {
                echo CActiveForm::validate($song_model);
                Yii::app()->end();
            }
            if (isset($_POST['Songs'])) {
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
        
    }
    
    
    

}
