<?php

Yii::import("application.modules.home.models.Songs", true);

class SongWidget extends CWidget {

    public $song_id;

    public function run() {
        $song_detail = Songs::model()->findByPk($this->song_id);
        $song_like_count = count($song_detail->like_details);
        $song_download_count = count($song_detail->download_details);
        $this->render('songView', array(
            "song_id" => $this->song_id,
            'song_like_count' => $song_like_count,
            'song_download_count' => $song_download_count,
        ));
    }

}

?>