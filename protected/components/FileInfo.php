<?php
	
	require_once('getid3/getid3.php');
	class FileInfo {
		public $data;
		
		public function __construct($file, $type) {
			$getID3 = new getID3;
			$info = $getID3->analyze($file);
                        $filename = $info['filename'];
                        $arr = explode("-", $filename);
                        
                        if($type == 1){
                            if(!empty($info['tags']['id3v2'])) {
								if(isset($info['tags']['id3v2']['title'])){
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
									if(!empty($info['tags']['id3v2']['bpm'])){
										$this->data['bpm'] = $info['tags']['id3v2']['bpm'];
									} else {
										$this->data['bpm'] = "";
									}
									
									if(!empty($info['tags']['id3v2']['initial_key'])){
										$this->data['key'] = $info['tags']['id3v2']['initial_key'];
									} else {
										$this->data['key'] = "";
									}
									$this->data['error'] = false;
								} else {
									$this->data['artist'] = trim($arr[0]);
									$song = trim($arr[1]);
									$name = explode(".mp",$song);
									$this->data['song'] = trim($name[0]);
									$this->data['album'] = "";
									$this->data['genre'] = "NA";
									$this->data['bpm'] = "";
									$this->data['key'] = "";
								}
                            } else {
								$this->data['error'] = true;
                            }
                        } else {
                            if(!empty($info['tags']['quicktime'])) {
                                $this->data['error'] = false;
                                if(isset($info['tags']['quicktime']['bpm'][0])){
                                    $this->data['bpm'] = $info['tags']['quicktime']['bpm'][0];
                                } else {
                                    $this->data['bpm'] = 0;
                                }

                                if(isset($info['tags']['quicktime']['artist'][0])){
                                    $this->data['artist'] = $info['tags']['quicktime']['artist'][0];
                                } else {
                                    $this->data['artist'] = trim($arr[0]);
                                }

                                if(isset($info['tags']['quicktime']['title'][0])){
                                    $this->data['song'] = $info['tags']['quicktime']['title'][0];
                                } else {
                                    $song = trim($arr[1]);
                                    $name = explode(".mp",$song);
                                    $this->data['song'] = trim($name[0]);
                                }

                                if(isset($info['tags']['quicktime']['genre'][0])){
                                    $this->data['genre'] = $info['tags']['quicktime']['genre'][0];
                                } else {
                                    $this->data['genre'] = 'NA';
                                }
                            } else {
                                $this->data['error'] = true;
                            }
                        }
			
		}

	}

?>