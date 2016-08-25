<?php
$baseUrl = Yii::app()->theme->baseUrl;
?>   
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
                    <?php // echo $count; ?>
                    <!--</div>-->
                    <div  class="it_m">
                        <h5>
                            <a href="<?php echo base_url() . '/media?name=' . $song->slug; ?>"><?php echo elipsis($song->song_name, '..', 35); ?></a>
                        </h5>
                        <h6><?php echo elipsis($song->artist_name, '..', 35); ?></h6>
                    </div>
                    <div  class="it_r"> 
                        <div class="bpm">
                            <?php if (!empty($song->bpm)): ?>
                                BPM: <span><?php echo $song->bpm; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="key">
                            <?php if (!empty($song->song_key)): ?>
                                KEY: <span><?php echo $song->song_key; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </li>  


            <?php
            $count = $count + 1;
        }
    }
    else {
        ?>    
        <li>
            No record found
        </li>    

        <?php
    }
    ?>


