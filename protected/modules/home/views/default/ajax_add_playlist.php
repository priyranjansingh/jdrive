<?php
if (!empty($playlist)) {
    foreach ($playlist as $plist) {
        ?> 
        <div class="m_row">
            <div class="mr_col">
                <a class="selected_playlist" data-song="<?php echo $song_id; ?>" data-playlist="<?php echo $plist->id; ?>" href="javascript:void(0)"> <?php echo $plist->name; ?> </a> 
            </div>
        </div>
        <?php
    }
}
else 
{
?>    
    <div class="m_row">
            <div class="mr_col">
                No Playlist Added Yet       
            </div>
        </div>
<?php
}    
?>





