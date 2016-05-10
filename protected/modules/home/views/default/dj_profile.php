<?php
$baseUrl = Yii::app()->theme->baseUrl;
?> 

<div class="inner_con">
    <div class="left_bar">
        <a href="#"><i class="fa fa-cloud"></i></a>
        <a href="#"><i class="fa fa-user"></i></a>
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
        <ul class="left_list ">
            <li>
                <div class="left_thumb"><img src="<?php echo $baseUrl; ?>/img/alb1.jpg"></div>
                <div class="left_con">
                    Gramatik <i class="fa fa-star fc_red"></i>
                    <div class="small_sec"><span><i class="fa fa-users"></i> 430k</span> <span><i class="fa fa-volume-up"></i> 172</span></div>
                </div>
                <div class="flow_p">
                    <a href="#" class="btn">Follow</a>
                </div>                             
            </li>
            <li>
                <div class="left_thumb"><img src="<?php echo $baseUrl; ?>/img/alb1.jpg"></div>
                <div class="left_con">
                    Gramatik <i class="fa fa-star fc_red"></i>
                    <div class="small_sec"><span><i class="fa fa-users"></i> 430k</span> <span><i class="fa fa-volume-up"></i> 172</span></div>
                </div>
                <div class="flow_p">
                    <a href="#" class="btn">Follow</a>
                </div>                             
            </li>
            <li>
                <div class="left_thumb"><img src="<?php echo $baseUrl; ?>/img/alb1.jpg"></div>
                <div class="left_con">
                    Gramatik <i class="fa fa-star fc_red"></i>
                    <div class="small_sec"><span><i class="fa fa-users"></i> 430k</span> <span><i class="fa fa-volume-up"></i> 172</span></div>
                </div>
                <div class="flow_p">
                    <a href="#" class="btn">Follow</a>
                </div>                             
            </li>                        
        </ul>
        <div class="tar"><a href="#" class="more">More <i class="fa fa-angle-right"></i></a></div>         

    </div>
    <div class="right_pan">
        <div class="pro_banner" style="background:url(<?php echo $baseUrl; ?>/img/pro_banner.jpg)">
            <div class="change_btn"><a href="#">Change Background</a></div>
            <div class="count_t"><h2><?php echo count($user->songs_list) + count($user->videos_list); ?></h2> Tracks</div>
            <div class="pro_con">
                <h1>
                    <?php echo $user->username; ?>
                </h1>
                <h3><?php echo count($user->followers_list); ?> Followers</h3>
                <p><a href="#">Follow</a> <a href="#">UnFollow</a></p>
                <p><a href="#"><?php
                        if (!empty($user->country_name->name)) {
                            echo $user->country_name->name;
                        };
                        ?>,<?php
                        if (!empty($user->state_name->name)) {
                            echo $user->state_name->name;
                        }
                        ?></a></p>
                <p><a href="#"><i class="fa fa-twitter-square fc_tw"></i></a> <a href="#"><i class="fa fa-youtube-square fc_red"></i></a> <a href="#"><i class="fa fa-facebook-square fc_fb"></i></a> <a href="#"><i class="fa fa-linkedin-square fc_in"></i></a> </p>
            </div>
        </div>
        <div class="t_bar">
            <ul class="sub_top">
                <li><a href="#">Trending</a></li>
                <li><a href="#">Just Added</a></li>
                <li><a href="#">Playlist</a></li>
                <li><a href="#">My Drive</a></li>
            </ul>

            <div class="av_tab">
                <span class="audio_t active">Audio</span><span class="video_t">Video</span>
            </div>    
        </div>


        <ul class="a_list i_page">
           
             <?php
            if (!empty($song_list)) {
                $count = 1;
                foreach ($song_list as $song) {
                    ?>    
                    <li>
                        <div class="i_info"> <img src="<?php echo $baseUrl; ?>/img/alb1.jpg" /> <span class="play_btn"><i class="fa fa-play-circle-o"></i></span>
                            <ul class="l_titel">
                                <li><i class="fa fa-upload"></i></li>
                                <li><i class="fa fa-plus"></i></li>
                                <li><i class="fa fa-history"></i></li>
                                <li><i class="fa fa-retweet"></i> <span>19</span></li>
                                <li><i class="fa fa-heart-o"></i> <span>38</span></li>
                            </ul>
                        </div>
                        <div class="i_titel">
                            <div class="it_l"><?php echo $count; ?></div>
                            <div  class="it_m">
                                <h5><?php echo $song->song_name; ?></h5>
                                <span><?php echo $song->artist_name; ?></span> </div>
                            <div  class="it_r"> <strong><?php echo $song->bpm; ?>BPM</strong> <strong>9A</strong> </div>
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