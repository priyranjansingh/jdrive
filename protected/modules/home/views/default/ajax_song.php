<?php
$baseUrl = Yii::app()->theme->baseUrl;
?>   
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
    } else {
        echo "No result found";
    }
    ?>



</ul>