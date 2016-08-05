<?php
$baseUrl = Yii::app()->theme->baseUrl;
?> 

<div class="inner_con bg_grey">
    <?php
    if (!empty($songs)) {
        ?>
        <div class="wraper fc_black no-bot-margin">
            <h2 class="fw600 mart15 marb15 titel">Songs</h2>
            <div class="row">
                <div class="h_con">
                    <div class="wraper">
                        <ul class="a_list">
                            <?php
                            if (!empty($songs)) {
                                foreach ($songs as $song) {
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
                                                       data-type="song"
                                                   ></i>
                                            </span>
                                            <?php $this->widget('SongWidget', array("song_id" => $song->id)); ?>
                                        </div>
                                        <div class="i_titel">
                                            <div  class="it_m">
                                                <h5>
                                                    <a href="<?php echo base_url() . '/media?name=' . $song->slug; ?>"><?php echo elipsis($song->song_name, '..', 35); ?></a>
                                                </h5>
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
                                }
                            }
                            ?>

                        </ul>
                    </div>
                </div>     

            </div>    

        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($videos)) {
        ?>    
        <div class="wraper fc_black no-bot-margin">
            <h2 class="fw600 mart15 marb15 titel">Videos</h2>
            <div class="row">
                <div class="h_con">
                    <div class="wraper">
                        <ul class="a_list">
                            <?php
                            if (!empty($videos)) {
                                foreach ($videos as $song) {
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
                                                       data-type="video"
                                                   ></i>
                                            </span>
                                            <?php $this->widget('SongWidget', array("song_id" => $song->id)); ?>
                                        </div>
                                        <div class="i_titel">
                                            <div  class="it_m">
                                                <h5>
                                                    <a href="<?php echo base_url() . '/media?name=' . $song->slug; ?>"><?php echo elipsis($song->song_name, '..', 35); ?></a>
                                                </h5>
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
                                }
                            }
                            ?>

                        </ul>
                    </div>
                </div>     

            </div>    

        </div>  

        <?php
    }
    ?>
    <?php
    if (!empty($dj)) {
        ?>    
        <div class="wraper fc_black">
            <h2 class="fw600 mart15 marb15 titel">DJs</h2>
            <div class="row">
                <div class="h_con">
                    <div class="wraper">
                        <ul class="a_list">
                            <?php
                            if (!empty($dj)) {
                                foreach ($dj as $user) {
                                    ?>
                                    <li>
                                        <div class="i_info"> 
                                            <?php
                                            if (!empty($user->profile_pic)) {
                                                $file_name = $user->profile_pic;
                                            } else {
                                                $file_name = "avatar.jpg";
                                            }
                                            ?>
                                            <a href="<?php echo base_url() ?>/home/dj?user=<?php echo $user->username; ?>">
                                                <img src="<?php echo base_url() ?>/assets/user-profile/<?php echo $file_name ?>" /> 
                                            </a>
                                        </div>
                                        <div class="i_titel">
                                            <div  class="it_m">
                                                <h5>
                                                    <a href="<?php echo base_url() ?>/home/dj?user=<?php echo $user->username; ?>">
                                                        <?php echo $user->username; ?>
                                                    </a>
                                                </h5>
                                                <span><i class="fa fa-users"></i> <?php echo count($user->followers_list); ?></span> 
                                            </div>
                                        </div>
                                    </li>
                                <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>     

            </div>    

        </div>  

    <?php
}
?>


</div>
