<?php
$baseUrl = Yii::app()->theme->baseUrl;
?> 

<div class="inner_con">
    <div class="left_bar">
        <a href="<?php echo base_url(); ?>/user/drive" ><i class="fa fa-cloud"></i></a>
        <a href="<?php echo base_url(); ?>/user/profile" class="active"><i class="fa fa-user"></i></a>
    </div>
    <div class="left_menu">
        <div class="tilel_bar">
            <h4>Following</h4>      
        </div>
        <ul class="left_list">
            <?php
            if (!empty($following_list)) {
                foreach ($following_list as $following) {
                    ?>        
                    <a href="<?php echo base_url() ?>/home/dj?user=<?php echo $following->user_details->username; ?>">
                        <li>
                            <?php
                            if (!empty($following->user_details->profile_pic)) {
                                $user_file = $following->user_details->profile_pic;
                            } else {
                                $user_file = "no_dj1.jpg";
                            }
                            ?>

                            <div class="left_thumb">

                                <img src="<?php echo base_url(); ?>/assets/user-profile/<?php echo $user_file; ?>">

                            </div>
                            <div class="left_con">
                                <?php echo $following->user_details->username; ?> <i class="fa fa-star fc_red"></i>
                                <div class="small_sec"><span><i class="fa fa-users"></i> <?php echo count($following->user_details->followers_list); ?></span> <span><i class="fa fa-volume-up"></i> <?php echo count($following->user_details->songs_list) + count($following->user_details->videos_list) ?></span></div>
                            </div>            
                        </li> 
                    </a>
                    <?php
                }
            } else {
                ?> 
                <li>
                    No records
                </li>
                <?php
            }
            ?>

        </ul>
        <?php
        if (count($following_list) > 5) {
            ?>
            <div class="tar"><a href="#" class="more">More <i class="fa fa-angle-right"></i></a></div>

        <?php } ?>

        <div class="tilel_bar mart15">
            <h4>Recommend</h4>      
        </div>
        <ul class="left_list "  id="recommended_container">    
            <?php
            if (!empty($recommended_list)) {
                foreach ($recommended_list as $recommended) {
                    if (!empty($recommended->profile_pic)) {
                        $user_file = $recommended->profile_pic;
                    } else {
                        $user_file = "no_dj1.jpg";
                    }
                    ?>
                    <a href="<?php echo base_url() ?>/home/dj?user=<?php echo $recommended->username; ?>">
                        <li>
                            <div class="left_thumb">
                                <img src="<?php echo base_url(); ?>/assets/user-profile/<?php echo $user_file; ?>">
                            </div>
                            <div class="left_con">
                                <?php echo $recommended->username; ?> <i class="fa fa-star fc_red"></i>
                                <div class="small_sec"><span><i class="fa fa-users"></i> <?php echo count($recommended->followers_list); ?></span> <span><i class="fa fa-volume-up"></i> <?php echo count($recommended->songs_list) + count($recommended->videos_list) ?></span></div>
                            </div>
                            <div class="flow_p">
                                <a href="javascript:void(0)" class="btn" data-dj="<?php echo $recommended->id; ?>" data-user ="<?php echo Yii::app()->user->id; ?>" id="follow_unfollow_recommend">
                                    Follow
                                </a>
                            </div>                             
                        </li>
                    </a>     
                    <?php
                }
            } else {
                ?>    
                <li>
                    No Records
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
        if (count($recommended_list) > 5) {
            ?>
            <div class="tar"><a href="#" class="more">More <i class="fa fa-angle-right"></i></a></div>

        <?php } ?>
    </div>
    <div class="right_pan">
        <?php 
        if(!empty($user->profile_background))
        {
            $background_src = base_url()."/assets/user-background/".$user->profile_background;
        } 
        else
        {
            $background_src = $baseUrl."/img/pro_banner.jpg";
        }     
        
        ?>
        <div class="pro_banner" style="background:url(<?php echo $background_src ?>);">
            <div class="change_btn">
				<a href="<?php echo base_url() . '/user/edit' ?>">Edit Profile</a>
				<br />
				<a href="#" data-toggle="modal" data-target="#Profile-Bg">Change Profile Background</a>
			</div>
            <div class="count_t"><h2><?php echo $total_track_list; ?></h2> Tracks</div>
            <div class="pro_con">
                <h1>
                    <?php echo $user->username; ?>
                </h1>
                <h3><span id="followers_count"><?php echo count($user->followers_list); ?></span> Followers</h3>
                <!--<p><a href="javascript:void(0)" data-dj="<?php echo $user->id; ?>" data-user ="<?php echo Yii::app()->user->id; ?>" id="follow_unfollow"><?php echo $follow_unfollow_text; ?></a></p>-->
                <p><a href="#">
                        <?php
                        if (!empty($user->country_name->name)) {
                            echo $user->country_name->name . ',';
                        };
                        ?>
                        <?php
                        if (!empty($user->state_name->name)) {
                            echo $user->state_name->name;
                        }
                        ?></a></p>
                <p>
                    <?php if (!empty($user->twitter)): ?>
                        <a target="_blank" href="<?php echo $user->twitter; ?>">
                            <i class="fa fa-twitter-square fc_tw"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($user->youtube)): ?>
                        <a target="_blank" href="<?php echo $user->youtube; ?>">
                            <i class="fa fa-youtube-square fc_red"></i>
                        </a> 
                    <?php endif; ?>
                    <?php if (!empty($user->facebook)): ?>
                        <a target="_blank" href="<?php echo $user->facebook; ?>">
                            <i class="fa fa-facebook-square fc_fb"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($user->instagram)): ?>
                        <a target="_blank" href="<?php echo $user->instagram; ?>">
                            <i class="fa fa-instagram fc_in"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($user->gplus)): ?>
                        <a target="_blank" href="<?php echo $user->gplus; ?>">
                            <i class="fa fa-google-plus-square fc_in"></i>
                        </a>
                    <?php endif; ?>
                </p>
            </div>
        </div>

        <div class="t_bar">
            <?php if ($user->is_paid == 0): ?>
                <div class="row">
                    <div class="col-md-9">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $total_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $total_percent; ?>%;background: red;">
                                <span class="sr-only">Total Upload: <?php echo number_format($total_size, 2); ?> GB / 5 GB</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="upload_text">
                            <span>Total Upload: <?php echo number_format($total_size, 2); ?> GB / 5 GB</span>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-md-10">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width: 1%;background: red;">
                                <span class="sr-only">Total Upload: <?php echo number_format($total_size, 2); ?> GB</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="upload_text">
                            <span>Total Upload: <?php echo number_format($total_size, 2); ?> GB</span>
                        </div>
                    </div>
                </div>
                
            <?php endif; ?>
            <ul class="sub_top">
                <li><a class="main_type" id="trending" data-type="trending" href="javascript:void(0)">Trending</a></li>
                <li><a class="main_type" id="just_added" data-type="just_added" href="javascript:void(0)">Just Added</a></li>
                <li><a class="main_type" id="playlist" data-type="playlist" href="javascript:void(0)">Playlist</a></li>
                <li><a class="main_type" id="my_drive" data-type="my_drive"  href="javascript:void(0)">My Drive</a></li>
                <li><a class="main_type" id="my_likes" data-type="my_likes"  href="javascript:void(0)">My Favorites</a></li>
            </ul>

            <div id="song_type_container" class="av_tab">
                <span id="audio" data-user="<?php echo $user->id; ?>" class="audio_t active song_type">Audio</span><span id="video" data-user="<?php echo $user->id; ?>" class="video_t song_type">Video</span>
            </div>    
        </div>

        <div id="media_container">
            <ul class="a_list i_page">

                <?php
                if (!empty($song_list)) {
                    $count = 1;
                    foreach ($song_list as $song) {
                        ?>    
                        <li>
                            <div class="i_info"> 
                                <?php
                                $src = $baseUrl . "/img/alb1.jpg";
                                if (!empty($song->album_art)):
                                    $src = $song->album_art;
                                endif;
                                ?>
                                <img src="<?php echo $src; ?>" />  
                                <span class="play_btn">
                                    <i class="fa fa-play-circle-o" 
                                       data-song="<?php echo $song->slug; ?>" 
                                       <?php if ($song->type == 1): ?>
                                           data-type="song"
                                       <?php else: ?>
                                           data-type="video"
                                       <?php endif; ?>
                                       ></i>
                                </span>
                                <?php $this->widget('SongWidget', array("song_id" => $song->id)); ?>
                            </div>
                            <div class="i_titel">
                                <!--<div class="it_l">
                                <?php // echo $count;  ?>
                                <!--</div>-->
                                <div  class="it_m">
                                    <h5><?php echo elipsis($song->song_name, '..', 35); ?></h5>
                                    <h6><?php echo elipsis($song->artist_name, '..', 35); ?></h6>
                                </div>
                                <div  class="it_r"> 
                                    <div class="bpm">
                                        BPM: <span><?php echo $song->bpm; ?></span> 
                                    </div>
                                    <div class="key">
                                        KEY: <span><?php echo $song->song_key; ?></span>
                                    </div>
                                </div>
                            </div>
                        </li>  


                        <?php
                        $count = $count + 1;
                    }
                }
                ?>



            </ul>
        </div>    

    </div>
</div>
<div class="modal fade" id="Profile-Bg">
	<div class="modal-dialog" role="document">
		<div class="modal-content log_pan">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">CHANGE PROFILE BACKGROUND</h4>
			</div>
			<div class="modal-body">
				<?php	
					$form = $this->beginWidget('CActiveForm', array(
						'id'=>'profile-bg-change-form',
						'action'=>array('/user/bg'),
						'enableClientValidation'=>true,
						//'enableAjaxValidation'=> true,
						'clientOptions'=>array(
							'validateOnSubmit'=>true,
						),
						'htmlOptions'=>array('enctype'=>'multipart/form-data'),
					));
				?>
				<div class="m_row"><i class="fa fa-user"></i>
					<div class="mr_col">
						<?php echo $form->labelEx($bg,'profile',array('class'=>'t_box')); ?>
						<?php echo $form->fileField($bg,'profile',array('class'=>'t_box')); ?>
						<?php echo $form->error($bg, 'profile'); ?>
					</div>
				</div>
				<div class="m_row tar">
					<?php echo CHtml::submitButton('Change Image',array('class'=>'btn_small fc_white bg_blue')); ?>
				</div>
				<?php $this->endWidget(); ?>
			</div>
			<div class="modal-footer"> 
				<!--<button type="button" clapro_bannerss="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>--> 
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>/assets/js/dj/dj.js"></script>
