<?php
$baseUrl = Yii::app()->theme->baseUrl;
?>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/songdetail.js"></script>
<div class="inner_con bg_grey">
    <div class="wraper fc_black">
        <div class="sd_banner">
            <div class="col-lg-4 tac">
                <img src="<?php echo $media->album_art; ?>" alt="<?php echo $media->song_name; ?>" />
            </div>
            <div class="col-lg-8 song_d">
                <h2><?php echo $media->song_name; ?></h2>
                <p class="by-s"> Artist: <strong><?php echo $media->artist_name; ?></strong></p>
                <p class="by-s"> By: <strong><?php echo $media->user->first_name . ' ' . $media->user->last_name; ?></strong></p>
                <div class="ico_p">
                    <span><i class="fa fa-arrow-up" aria-hidden="true"></i> 3 days ago</span>
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
                        <i class="fa fa-download" aria-hidden="true"></i><span><?php echo $song_like_count; ?></span>
                    </a>
                    <a href="javascript:void(0)" class="detail_like" data-song="<?php echo $media->id; ?>" data-user="<?php echo Yii::app()->user->id; ?>">
                        <i class="fa fa-heart" aria-hidden="true"></i><span><?php echo $song_download_count; ?></span>
                    </a>                    
                </div>
            </div>
        </div>

        <div class="row mart15">
            <div class="col-lg-8">
                <div class="song_dp">
                    <h4 class="titel_p">Comments</h4>
                    <div class="s_detail">
                        <textarea id="comment_msg" placeholder="Enter Comment Message Here"></textarea>
                        <input type="hidden" id="comment_song" value="<?php echo $media->id; ?>" />
                        <button class="btn btn-warning" id="comment_btn">Submit</button>
                        <div class="comments">
                            <?php foreach ($comments as $comment): ?>
                                <div class="comment">
                                    <div class="user_pic">
                                        <?php
                                        $user = Users::model()->findByPk($comment->user);
                                        if (empty($user->profile_pic)):
                                            ?>
                                            <img src="<?php echo base_url(); ?>/themes/home/img/avatar.jpg" alt="user">
                                        <?php else: ?>
                                            <img src="<?php echo base_url() . '/assets/user-profile/' . $user->profile_pic; ?>" alt="user">
    <?php endif; ?>

                                        <div><?php echo $user->username; ?></div>
                                    </div>
                                    <div class="user_comment">
    <?php echo $comment->comment; ?>
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
                        foreach ($like_arr as $key => $val) {
                            ?>
                        <a href="<?php echo base_url() ?>/home/dj?user=<?php echo $key; ?>">
                            <img height="50" width="50" src="<?php echo base_url(); ?>/assets/user-profile/<?php echo $val; ?>">
                        </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>            
            </div>
        </div>
    </div>
</div>