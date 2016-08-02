<?php
require_once('getid3/getid3.php');

class UpdateVideoBPM {
    public $data;
    
    public function __construct($filePath) {

        $getID3 = new getID3;
        $ThisFileInfo = $getID3->analyze($filePath);
        $filename = $ThisFileInfo['filename'];
        $arr = explode("-", $filename);
        
        if(isset($ThisFileInfo['tags']['quicktime']['bpm'][0])){
            $data['bpm'] = $ThisFileInfo['tags']['quicktime']['bpm'][0];
        } else {
            $data['bpm'] = 0;
        }
        
        if(isset($ThisFileInfo['tags']['quicktime']['artist'][0])){
            $data['artist'] = $ThisFileInfo['tags']['quicktime']['artist'][0];
        } else {
            $data['artist'] = trim($arr[0]);
        }
        
        if(isset($ThisFileInfo['tags']['quicktime']['title'][0])){
            $data['song'] = $ThisFileInfo['tags']['quicktime']['title'][0];
        } else {
            $song = trim($arr[1]);
            $name = explode(".mp",$song);
            $data['song'] = trim($name[0]);
        }
        
        if(isset($ThisFileInfo['tags']['quicktime']['genre'][0])){
            $data['genre'] = $ThisFileInfo['tags']['quicktime']['genre'][0];
        } else {
            $data['genre'] = 'NA';
        }

    }

}

?>

