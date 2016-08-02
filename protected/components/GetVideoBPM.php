<?php

require_once('getid3/getid3.php');

class GetVideoBPM {

    public $bpm = '';


    public function __construct($filename,$file_location) {
	$sample_file = "/var/www/vhosts/videotoolz20.com/public_html/v3/assets/sample/video/".$filename;
        // Initialize getID3 engine
        $getID3 = new getID3;

        $DirectoryToScan = $file_location; // change to whatever directory you want to scan
        $dir = opendir($DirectoryToScan);
        while (readdir($dir) !== false) {
            $FullFileName = realpath($DirectoryToScan . '/' . $filename);
			// if ((substr($FullFileName, 0, 1) != '.') && is_file($FullFileName)) {
                // set_time_limit(30);
				//echo 'ffmpeg -i '."'".$FullFileName."'".' -t 00:01:30 -c copy '."'".$sample_file."'";
				$cmd = '/usr/bin/ffmpeg -i '."'".$FullFileName."'".' -t 00:01:30 -c copy '."'".$sample_file."'";
				$output = exec($cmd . ' 2>&1', $output, $return);
				//pre($output,true);
                // pre($FullFileName,true);
                $ThisFileInfo = $getID3->analyze($FullFileName);
                // pre($ThisFileInfo,true);
                //pre($ThisFileInfo['tags']['quicktime']['bpm'][0],true);
                //$this->bpm = round($ThisFileInfo['bitrate'] / 1110);
				if(isset($ThisFileInfo['tags']['quicktime']['bpm'][0])){
					$this->bpm = $ThisFileInfo['tags']['quicktime']['bpm'][0];
				} else {
					$this->bpm = 128;
				}
                // if (copy("$DirectoryToScan/" . $filename, $file_location . $filename)) {
                //     unlink("$DirectoryToScan/" . $filename);
                // }
            // }
        }
    }

}

?>
