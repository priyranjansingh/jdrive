<?php

class DefaultController extends Controller
{
	public $layout = '//layouts/home_main';
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionProfile()
	{
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

	public function actionEdit()
	{
		if (Yii::app()->user->isGuest) {
            $this->redirect(base_url());
        } else {
        	$logged_in_user_id = Yii::app()->user->id;
            $model = Users::model()->findByPk($logged_in_user_id);

            $this->render('edit',array('model' => $model));
        }
	}
}