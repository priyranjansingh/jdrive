 <div class="footer">
            <!--<div class="sound_bar"><img src="<?php echo $baseUrl;?>/img/74.gif"><img src="<?php echo $baseUrl;?>/img/73.gif"><img src="<?php echo $baseUrl;?>/img/74.gif"></div>-->
            <section class="player" id="player_container" style="display:none">
                <div class="row">
                    <span class="close_player" style="display:none">X</span>
                    <div class="col-lg-3 col-md-1 col-sm-1">
                        <div class="jp-album">
                            <div class="row ">
                                <div class="col-lg-2 col-md-4 col-sm-1">
                                    <div class="jp-cover" id="album_art">
                                        <img src="<?php echo $baseUrl;?>/img/thumb.jpg" alt="cover">
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-8 col-sm-11">
                                    <div class="jp-title">
                                        <span class="now-playing">Now playing:</span>
                                        <span class="title song-title">Hello - Adele</span>
                                    </div>
                                    <div class="rating">
                                        <span class="star star-rate star-s">
                                            <span style="width:78%"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="player-tracklist opacity" id="player_tracklist" style="display: none;">
                                <div class="playlist" id="releases" style="">
                                    <table class="table release">
                                        <colgroup>
                                            <col class="no">
                                            <col>
                                            <col>
                                            <col>
                                            <col>
                                        </colgroup>
                                        
                                        <thead>
                                            <tr>
                                                <th colspan="2">Song Name</th>
                                                <th>Artist Name</th>
                                                <th>Genre</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="5191362" class="track play">
                                                <td><div>01</div></td>
                                                <td>Phrakture - Sanctuary Gone (Instrumental Mix)</td>
                                                <td>Breaks</td>
                                                <td>8:59 / 130 BPM</td>
                                                <td>$2.49</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>          
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-11 col-sm-11 nopadding">
                        <div id="jpId" style="width: 0px; height: 0px;">
                            <img id="jp_poster_0" style="width: 0px; height: 0px; display: none;">
                            <audio id="jp_audio_0" preload="metadata"></audio>
                        </div>
                        <div class="jp-audio">
                            <div class="jp-controls-wrap">
                                <div class="jp-controls" id="jp_controls">
                                    <div id="backward" class="jp-prev jp-control"></div>
                                    <div class="play jp-control" id="playpause"></div>
                                    <div id="forward" class="jp-next jp-control"></div>
                                </div>
                            </div>
                            <div class="jp-bar">
                                <div class="jp-progress">
<!--                                    <progress id="progress" class="progress progress-striped" value="0" max="100"></progress>-->
                                    <div class="jp-bg">
                                        <div id="waveform" style="background-image:url('<?php echo $baseUrl?>/img/download.png'); "></div>
                                    </div>
                                    <!--<div class="jp-seek-bar">
                                        <div class="jp-play-bar"></div>
                                        <div class="jp-seek-wf"></div>
                                    </div>-->
                                </div>
                                <!--<div class="jp-time duration" id="duration">00:00</div>
                                <div class="jp-time jp-current-time" id="current_time">00:00</div>-->
                            </div>
                            <div id="jp_volume" class="vol-wrapper jp-volume">
                                <div class="volume"></div>
                                <div class="jp-vol" id="mute"></div>
                            </div>
                            <div class="playlist" id="playlist"></div>
                        </div>
                    </div>
                </div>
            </section>
           
        <script>
           var wavesurfer = WaveSurfer.create({
                container: '#waveform',
                backend: 'MediaElement',
                waveColor: 'white',
                progressColor: 'red',
                cursorColor: 'red',
                barWidth: 2,
                height: 40,
                maxCanvasWidth: 510
            });
            
            $(document).ready(function() {
                $("#playpause").click(function() {
                    wavesurfer.playPause();
                     $('.play.jp-control').toggleClass('active');
                });
                $("#forward").click(function() {
                    wavesurfer.skipForward();
                });
                $("#backward").click(function() {
                    wavesurfer.skipBackward();
                });
            })

        </script>
        </div>