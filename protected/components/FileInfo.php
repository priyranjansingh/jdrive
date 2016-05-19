<?php
	
	require_once('getid3/getid3.php');
	class FileInfo {
		public $data;
		
		public function __construct($file) {
			$getID3 = new getID3;
			$info = $getID3->analyze($file);
			if(!empty($info['tags']['id3v2']['title'])){
				$this->data['song'] = $info['tags']['id3v2']['title'][0];
				$this->data['artist'] = $info['tags']['id3v2']['artist'][0];
				if(!empty($info['tags']['id3v2']['genre'])){
					$this->data['genre'] = $info['tags']['id3v2']['genre'][0];	
				} else {
					$this->data['genre'] = "NA";
				}
				if(!empty($info['tags']['id3v2']['album'])){
					$this->data['album'] = $info['tags']['id3v2']['album'][0];
				} else {
					$this->data['album'] = "";
				}
				
				$this->data['error'] = false;
			} else {
				$this->data['error'] = true;
			}
		}

	}

?>