<?php
	require('gracenote/Gracenote.class.php');
// $clientID  = "1147939910-58D33C3A6106FF75E8A80FDFE9B36758"; // Put your Client ID here.
// $clientTag = "58D33C3A6106FF75E8A80FDFE9B36758"; // Put your Client Tag here.
// $api = new Gracenote\WebAPI\GracenoteWebAPI($clientID, $clientTag, '34435820625666996-40DF3AACF34B631C07FE7208586E9FC7');
// $results = $api->searchTrack("Pitbull", "M.I.A.M.I.", "Melting Pot (Ft. Trick Daddy)", Gracenote\WebAPI\GracenoteWebAPI::BEST_MATCH_ONLY);
// print_r($results[0]['album_art_url']);

	class ApiSearch {

		public $album_art = null;
		public $genre = null;

		public function __construct($artist, $song, $album){
			$api = new Gracenote\WebAPI\GracenoteWebAPI(getParam('api_client_id'), getParam('api_client_tag'), getParam('api_user_id'));
			$results = $api->searchTrack($artist, $album, $song, Gracenote\WebAPI\GracenoteWebAPI::BEST_MATCH_ONLY);
			// pre($results,true);
			if(!empty($results[0]['album_art_url'])){
				$this->album_art = $results[0]['album_art_url'];	
			}
			
			if(!empty($results[0]['genre'])){
				$this->genre = $results[0]['genre'][0]['text'];
			} else {
				$this->genre = "NA";
			}
		}

	}

?>