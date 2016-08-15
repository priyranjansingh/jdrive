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
                    <?php
                    if ($song->type == 1) {
                        $type = "song";
                    } else if ($song->type == 2) {
                        $type = "video";
                    }
                    ?>
                    <a href="javascript:void(0)" class="play_btn" data-song="<?php echo $song->id; ?>" ><i data-song="<?php echo $song->slug; ?>" data-type="<?php echo $type; ?>"  class="fa fa-play" aria-hidden="true"></i></a>
                    <a class="drive_download_btn" href="<?php echo base_url(); ?>/user/download?file=<?php echo $song->id; ?>"  data-song="<?php echo $song->id; ?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                    <?php if ($logged_in_user_id == $song->created_by) { ?>
                        <a href="#" class="edit_btn" data-song="<?php echo $song->id; ?>" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a href="#" class="delete_btn" data-song="<?php echo $song->id; ?>" ><i class="fa fa-trash" aria-hidden="true"></i></a>
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