<ul class="l_titel">
   
    <a href="javascript:void(0)" class="widget_upload" data-song="<?php echo $song_id; ?>" data-user="<?php echo Yii::app()->user->id; ?>" >
        <li><i class="fa fa-upload"></i> </li>
    </a> 
   <a href="javascript:void(0)" class="widget_playlist" data-song="<?php echo $song_id; ?>" data-user="<?php echo Yii::app()->user->id; ?>" >
    <li><i class="fa fa-plus"></i></li>
   </a> 
    <a href="javascript:void(0)" class="widget_download" data-song="<?php echo $song_id; ?>" data-user="<?php echo Yii::app()->user->id; ?>" >
    <li><i class="fa fa-download"></i> <span><?php  echo $song_download_count;   ?></span></li>
    </a>
    <a href="javascript:void(0)" class="widget_like" data-song="<?php echo $song_id; ?>" data-user="<?php echo Yii::app()->user->id; ?>" >
    <li><i class="fa fa-heart-o"></i> <span><?php echo $song_like_count;  ?></span></li>
    </a>
</ul>

