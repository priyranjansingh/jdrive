<?php
$baseUrl = Yii::app()->theme->baseUrl;
?> 

<div class="inner_con bg_grey">
    <?php
    if (!empty($songs)) {
        ?>
        <div class="wraper fc_black">
            <h2 class="fw600 mart15 marb15">Audio Songs</h2>
            <div class="row">
                <div class="h_con">
                    <div class="wraper">
                        <ul class="a_list">
                            <?php
                            if (!empty($songs)) {
                                $count = 1;
                                foreach ($songs as $song) {
                                    ?>    
                                    <li>
                                        <div class="i_info"> <img src="<?php echo $baseUrl; ?>/img/alb1.jpg" /> <span class="play_btn"><i class="fa fa-play-circle-o"></i></span>
                                            <?php $this->widget('SongWidget',array("song_id"=>$song->id)); ?>
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

            </div>    

        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($videos)) {
        ?>    
        <div class="wraper fc_black">
            <h2 class="fw600 mart15 marb15">Video Songs</h2>
            <div class="row">
                <div class="h_con">
                    <div class="wraper">
                        <ul class="a_list">
                            <?php
                            if (!empty($videos)) {
                                $count = 1;
                                foreach ($videos as $song) {
                            ?>    
                                    <li>
                                        <div class="i_info"> <img src="<?php echo $baseUrl; ?>/img/alb1.jpg" /> <span class="play_btn"><i class="fa fa-play-circle-o"></i></span>
                                             <?php $this->widget('SongWidget',array("song_id"=>$song->id)); ?>
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

            </div>    

        </div>  

        <?php
    }
    ?>
    <?php
    if (!empty($dj)) {
        ?>    
        <div class="wraper fc_black">
            <h2 class="fw600 mart15 marb15">DJ</h2>
            <div class="row">
                <div class="h_con">
                    <div class="wraper">
                        <ul class="a_list">
                            <?php
                            if (!empty($dj)) {
                                $count = 1;
                                foreach ($dj as $user) {
                                    ?>    
                                    <li>
                                        <div>
                                            <?php  
                                            if(!empty($user->profile_pic))
                                            {
                                                $file_name = $user->profile_pic;
                                            } 
                                            else 
                                            {
                                                $file_name = "no_dj1.jpg";
                                            }
                                            
                                            ?>
                                            <a href="<?php echo base_url()  ?>/home/dj?user=<?php echo $user->username;  ?>">
                                                <img src="<?php echo base_url() ?>/assets/user-profile/<?php echo $file_name ?>" /> 
                                            </a>    
                                            <div class="i_titel">
                                            <div class="it_l"><?php echo $count; ?></div>
                                            <div  class="it_m">
                                                <h5><?php echo $user->username; ?></h5>
                                                <span><i class="fa fa-users"></i> <?php echo count($user->followers_list); ?></span> 
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

        </div>  

        <?php
    }
    ?>
    

</div>
