<?php
$baseUrl = Yii::app()->theme->baseUrl;
?>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/songdetail.js"></script>
<div class="inner_con bg_grey">
    <div class="wraper fc_black">
        <div class="sd_banner">
            <div class="col-lg-4 a_list">
                <div class="i_info">
                    <?php
                    if (!empty($media->album_art)) {
                        $src = $media->album_art;
                    } else {
                        $src = $baseUrl . "/img/alb1.jpg";
                    }
                    ?>
                <img src="<?php echo $src; ?>" alt="<?php echo $media->song_name; ?>" />
                    <span class="play_btn">
                        <i class="fa fa-play-circle-o" style="font-size: 200px;" 
                            data-song="<?php echo $media->slug; ?>" 
                        <?php if($media->type == 1): ?>
                            data-type="song"
                        <?php else: ?>
                            data-type="video"
                        <?php endif; ?>
                        ></i>
                    </span>
                </div>
            </div>
            <div class="col-lg-8 song_d">
                <h2><?php echo $media->song_name; ?></h2>
                <p class="by-s"> Artist: <strong><?php echo $media->artist_name; ?></strong></p>
                <p class="by-s"> By: <strong><?php echo $media->user->username; ?></strong></p>
                <div class="ico_p">
                    <span><i class="fa fa-arrow-up" aria-hidden="true"></i> <?php echo time_elapsed_string($media->date_entered); ?></span>
                </div>
                <div class="btn_p">
                    <a href="javascript:void(0)" data-dj="<?php echo $media->created_by; ?>" data-user ="<?php echo Yii::app()->user->id; ?>" id="follow_unfollow">
                        <i class="fa fa-user-plus" aria-hidden="true"></i> <?php echo $follow_unfollow_text; ?>
                    </a>
                    <a href="javascript:void(0)" class="detail_upload" data-song="<?php echo $media->id; ?>" data-user="<?php echo Yii::app()->user->id; ?>">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                    </a>
                    <a href="javascript:void(0)" class="detail_playlist" data-song="<?php echo $media->id; ?>" data-user="<?php echo Yii::app()->user->id; ?>">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                    <a href="javascript:void(0)" class="detail_download" data-song="<?php echo $media->id; ?>" data-user="<?php echo Yii::app()->user->id; ?>">
                        <i class="fa fa-download" aria-hidden="true"></i><span><?php echo $song_download_count; ?></span>
                    </a>
                    <a href="javascript:void(0)" class="detail_like" data-song="<?php echo $media->id; ?>" data-user="<?php echo Yii::app()->user->id; ?>">
                        <i class="fa fa-heart" aria-hidden="true"></i><span><?php echo $song_like_count; ?></span>
                    </a> 
<?php
if ($media->type == 1) {
    $type = "song";
} else if ($media->type == 2) {
    $type = "video";
}
?>
                    <a href="javascript:void(0)" class="play_btn" data-song="<?php echo $media->id; ?>" data-user="<?php echo Yii::app()->user->id; ?>">
                        <i data-song="<?php echo $media->slug; ?>" data-type="<?php echo $type; ?>"  class="fa fa-play" aria-hidden="true"></i>
                    </a> 
                </div>
            </div>
        </div>

        <div class="row mart15">
            <div class="col-lg-8">
                <div class="song_dp">
                    <h4 class="titel_p">Comments</h4>
                    <div class="s_detail">
                        <div class="comment-post">
                            <div class="comment-avatar">
<?php
$user = Users::model()->findByPk(Yii::app()->user->id);
if (empty($user->profile_pic)):
    ?>
                                    <img src="<?php echo base_url(); ?>/themes/home/img/avatar.jpg" alt="user">
                                <?php else: ?>
                                    <img src="<?php echo base_url() . '/assets/user-profile/' . $user->profile_pic; ?>" alt="user">
                                <?php endif; ?>
                            </div>
                            <textarea id="comment_msg" placeholder="Enter Comment Message Here"></textarea>
                            <input type="hidden" id="comment_song" value="<?php echo $media->id; ?>" />
                            <button class="btn btn-warning" id="comment_btn">Submit</button>
                        </div>
                        <div class="comments">
                            <div m-new-comment-container=""></div>
                            <?php foreach ($comments as $comment): ?>
                            <div class="comment-container">
                                <div class="comment-item">
                                    <div class="comment-avatar">
                                        <a href="#">
                                            <?php
                                            $user = Users::model()->findByPk($comment->user);
                                            if (empty($user->profile_pic)):
                                            ?>
                                                <img src="<?php echo base_url(); ?>/themes/home/img/avatar.jpg" alt="user">
                                            <?php else: ?>
                                                <img src="<?php echo base_url() . '/assets/user-profile/' . $user->profile_pic; ?>" alt="user">
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                    <div class="comment">
                                        <div class="comment-head cf">
                                            <a href="#" class="comment-author"><?php echo $user->username; ?></a>
                                            <span class="card-stats">
                                                <span class="card-posted"><?php echo $comment->date_entered; ?></span>
                                            </span>
                                        </div>
                                        <div class="comment-body">
                                            <div class="comment-body-cropped">
                                                <p><?php echo $comment->comment; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="sd_footer">
                        <span><i class="fa fa-flag" aria-hidden="true"></i> Report</span>
                        <span><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Mark as spam</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="wiget">
                    <h2>Liked by</h2>
                    <div class="w_con">
<?php
if (!empty($like_arr)) {
    foreach ($like_arr as $key => $val) {
        ?>
                                <a href="<?php echo base_url() ?>/home/dj?user=<?php echo $key; ?>">
                                    <img height="50" width="50" src="<?php echo base_url(); ?>/assets/user-profile/<?php echo $val; ?>">
                                </a>
                                <?php
                            }
                        } else {
                            echo "Be the first to like this.";
                        }
                        ?>
                    </div>
                </div>            
            </div>
        </div>
    </div>
</div>