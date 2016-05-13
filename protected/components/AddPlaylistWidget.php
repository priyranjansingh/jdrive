<?php  
	Yii::import("application.modules.home.models.Playlists", true);
	class AddPlaylistWidget extends CWidget {
		public function run() {
		    $model = new Playlists;
		    $this->render('add_playlist',array('model'=>$model));
		} 
	} 
?>