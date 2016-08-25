<div class="inner_con">
    <div class="left_bar">
        <a href="<?php echo base_url(); ?>/user/drive" class="active"><i class="fa fa-cloud"></i></a>
        <a href="<?php echo base_url(); ?>/user/profile"><i class="fa fa-user"></i></a>
    </div>
    <div class="left_menu">
        <div class="tilel_bar">
            <h4>Recent Uploaded Songs</h4>
            <div id="drive_song_type_container" class="av_tab">
                <span id="audio" class="audio_t active drive_song_type">Audio</span>
                <span id="video" class="video_t drive_song_type">Video</span>
            </div>        
        </div>
        <div class="cat_titel">Categories</div>
        <ul>
            <?php
            if (!empty($genres)) {
                foreach ($genres as $genre) {
                    ?>   
                    <li><a  class="drive_genre_class"  data-genre="<?php echo $genre->id; ?>"  href="javascript:void(0)"><?php echo $genre->name; ?></a></li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
    <div class="right_pan">
        <div class="t_bar">
            <a href="<?php echo base_url(); ?>/user/drive" class="tbar_l"><i class="fa fa-cloud"></i></a>
            <!--div  class="tbar_r">
                <a href="#" class="btn_small bg_white fc_black"><i class="fa fa-plus-square"></i> New Folder</a>
                <span class="l_view active"><i class="fa fa-list"></i></span>
                <span class="g_view"><i class="fa fa-th-large"></i></span>
            </div-->
        </div>

        <div id="mydrive_container"  class="table_wrap">
            <table width="100%" border="1" cellspacing="0" cellpadding="0" class="c_table">
                <?php
                if (!empty($song_list)) {
                    ?>
                    <thead>
                    <th><i class="fa fa-plus"></i></th>
                    <th>Type</th>
                    <th>Song File</th>
                    <th>Date Created</th>
                    <th style='width:80px;'>Action</th>
                    </thead>
                    <?php
                } else {
                    ?>    
                    <thead>
                    <th>No Record Found </th>
                    </thead>    
                    <?php
                }
                ?>
                <tbody>
                    <?php
                    if (!empty($song_list)) {
                        foreach ($song_list as $song) {
                            ?>    
                            <tr>
                                <td><i class="fa fa-plus"></i></td>
                                <td>
                                    <?php
                                    if ($song->type == 1) {
                                        echo "Song";
                                    } else if ($song->type == 2) {
                                        echo "Video";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $song->file_name; ?></td>
                                <td><?php echo $song->date_entered; ?></td>
                                <td>
                                    <?php
                                    if ($song->type == 1) {
                                        $type = "song";
                                    } else if ($song->type == 2) {
                                        $type = "video";
                                    }
                                    ?>

                                    <a href="javascript:void(0)" class="play_btn" data-song="<?php echo $song->id; ?>" ><i data-song="<?php echo $song->id; ?>" data-type="<?php echo $type; ?>"  class="fa fa-play" aria-hidden="true"></i></a>
                                    <a class="drive_download_btn" href="<?php echo base_url(); ?>/user/download?file=<?php echo $song->id; ?>"  data-song="<?php echo $song->id; ?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                    <?php if ($logged_in_user_id == $song->created_by) { ?>
                                        <a href="#" class="edit_btn" data-song="<?php echo $song->id; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href="#" class="delete_btn" data-song="<?php echo $song->id; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        <?php
                                        $file_mode = ($song->acl == 0) ? "Public" : "Private";
                                        ?>
                                        <input type="button" data-song="<?php echo $song->id; ?>" name="file_mode_btn" value="<?php echo $file_mode; ?>" class="btn-xs bg_red fc_white file_mode_btn">
                                    <?php
                                    } else {
                                        ?>   
                                        <a href="#" class="unshare_btn" data-song="<?php echo $song->id; ?>"><i title="Unshare this song" class="fa fa-times" aria-hidden="true"></i></a>
                                            <?php
                                        }
                                        ?>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>






<script src="<?php echo base_url(); ?>/assets/js/drive/drive.js"></script>