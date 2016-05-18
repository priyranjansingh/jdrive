<div class="inner_con">
    <div class="left_bar">
        <a href="#"><i class="fa fa-cloud"></i></a>
        <a href="#"><i class="fa fa-user"></i></a>
    </div>
    <div class="left_menu">
        <div class="tilel_bar">
            <h4>MY Drive</h4>
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
            <a href="#" class="tbar_l"><i class="fa fa-cloud"></i></a>
            <div  class="tbar_r">
                <a href="#" class="btn_small bg_white fc_black"><i class="fa fa-plus-square"></i> New Folder</a>
                <span class="l_view active"><i class="fa fa-list"></i></span>
                <span class="g_view"><i class="fa fa-th-large"></i></span>
            </div>
        </div>

        <div id="mydrive_container"  class="table_wrap">
            <table width="100%" border="1" cellspacing="0" cellpadding="0" class="c_table">
                <?php
                if (!empty($song_list)) {
                    ?>
                    <thead>
                    <th><i class="fa fa-plus"></i></th>
                    <th>Artist Name</th>
                    <th>Song Title</th>
                    <th>BPM</th>
                    <th>KEY</th>
                    <th>GENRE</th>
                    <th>Date Created</th>
                    <th>Action</th>
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
                                <td><i class="fa fa-file-audio-o"></i> <?php echo $song->artist_name; ?></td>
                                <td><?php echo $song->song_name; ?></td>
                                <td><?php echo $song->bpm; ?></td>
                                <td><?php echo $song->song_key; ?></td>
                                <td><?php echo $song->media_genre->name; ?></td>
                                <td>2015-11-30 12:35</td>
                                <td>
                                    <a href="#" class=""><i class="fa fa-play" aria-hidden="true"></i></a>
                                    <a href="#" class=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                     <a href="#" class=""><i class="fa fa-trash" aria-hidden="true"></i></a>
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