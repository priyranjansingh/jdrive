<ul class="l_titel">
    <?php if (Yii::app()->user->isGuest): ?>
        <li>
            <a href="javascript:void(0)" class="widget_upload" data-song="<?php echo $song_id; ?>" data-user="<?php echo Yii::app()->user->id; ?>" >
                <i class="fa fa-upload"></i>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)" class="widget_playlist" data-song="<?php echo $song_id; ?>" data-user="<?php echo Yii::app()->user->id; ?>" >
                <i class="fa fa-plus"></i>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)" class="widget_download" data-song="<?php echo $song_id; ?>" data-user="<?php echo Yii::app()->user->id; ?>" >
                <i class="fa fa-download"></i> <span><?php echo $song_download_count; ?></span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)" class="widget_like" data-song="<?php echo $song_id; ?>" data-user="<?php echo Yii::app()->user->id; ?>" >
                <i class="fa fa-heart-o"></i> <span><?php echo $song_like_count; ?></span>
            </a>
        </li>
    <?php else: ?>
        <?php if (Yii::app()->session['is_paid']): ?>
            <li>
                <a href="javascript:void(0)" class="widget_upload" data-song="<?php echo $song_id; ?>" data-user="<?php echo Yii::app()->user->id; ?>" >
                    <i class="fa fa-upload"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" class="widget_playlist" data-song="<?php echo $song_id; ?>" data-user="<?php echo Yii::app()->user->id; ?>" >
                    <i class="fa fa-plus"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" class="widget_download" data-song="<?php echo $song_id; ?>" data-user="<?php echo Yii::app()->user->id; ?>" >
                    <i class="fa fa-download"></i> <span><?php echo $song_download_count; ?></span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" class="widget_like" data-song="<?php echo $song_id; ?>" data-user="<?php echo Yii::app()->user->id; ?>" >
                    <i class="fa fa-heart-o"></i> <span><?php echo $song_like_count; ?></span>
                </a>
            </li>
        <?php else: ?>
            <li>
                <a href="javascript:void(0)" class="widget_upload" data-song="<?php echo $song_id; ?>" data-user="<?php echo Yii::app()->user->id; ?>" >
                    <i class="fa fa-upload"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" class="widget_playlist" data-song="<?php echo $song_id; ?>" data-user="<?php echo Yii::app()->user->id; ?>" >
                    <i class="fa fa-plus"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" class="widget_download" data-song="<?php echo $song_id; ?>" data-user="<?php echo Yii::app()->user->id; ?>" >
                    <i class="fa fa-download"></i> <span><?php echo $song_download_count; ?></span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" class="widget_like" data-song="<?php echo $song_id; ?>" data-user="<?php echo Yii::app()->user->id; ?>" >
                    <i class="fa fa-heart-o"></i> <span><?php echo $song_like_count; ?></span>
                </a>
            </li>
        <?php endif; ?>
    <?php endif; ?>
</ul>

