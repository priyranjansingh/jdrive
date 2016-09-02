
var lovers = null;
var jp = null;
var last_track = null;
var prev_track = null;
var current_track = null;

function jplayer() {
    var jThis = this;
    this.init = function(container) {
        jp = $(container);

        jp.jPlayer({
            solution: "html,flash", // Flash with an HTML5 fallback.
            swfPath: "jquery.jplayer.swf",
            supplied: "mp3,mp4",
            ready: function(event) {
                var $time = $(event.jPlayer.options.cssSelectorAncestor + " .jp-current-time");
            },
            play: function() {
                jThis.activate();
            },
            stop: function() {
                jThis.destroy();
            },
            pause: function() {
                jThis.deactivate();
            },
            ended: function(obj) {
            },
            timeupdate: function() {
                //showTimeLeft();
            },
            volume: 0.8
        });

        // init slider
        $("#jp_volume .volume").slider({
            value: 80,
            range: "min",
            orientation: "horizontal",
            min: 1,
            slide: function(event, ui) {
                jp.jPlayer('volume', ui.value / 100);
            },
            start: function(event, ui) {
            },
            stop: function(event, ui) {
                // end slide event
                // cookie
            }
        });


        // init observers 
        // player

        $('#jp_controls').on('click', function(evt) {
            var elm = evt.target;

            if ($(elm).closest('.jp-control').length > 0 && last_track) {
                if ($(elm).hasClass('jp-next')) {
                    jThis.playNext();
                }
                else if ($(elm).hasClass('jp-prev')) {

                    jThis.playPrev();
                }
                else {
                    if (current_track) {
                        // current_track.removeClass('active').addClass('pause');
                        $('.play.jp-control').toggleClass('active');
                        jp.jPlayer("pause");

                    } else {
                        // last_track.removeClass('pause').addClass('active');
                        jThis.playTrack(last_track);

                    }
                }
            } else {
                playTrack($('#releases tbody tr:first'));
                $('#releases tbody tr:first').addClass('active');
            }
        });


        // releases 
        $('#releases').on('click', function(evt) {
            var elm = evt.target;

            if ($(elm).closest('.play').length > 0) {
                clickOnTrack($(elm).closest('.play'));
            }
        });



        $('#mute').on('click', function(evt) {
            var elm = evt.target;
            if ($(elm).closest('.jp-vol').length > 0) {
                $(elm).closest('#mute').toggleClass('muted');
                $('#mute').hasClass('muted') ? jp.jPlayer({"muted": true}) : jp.jPlayer({"muted": false});
            } else {

            }
        });
    }

    // declare functions

    this.activate = function() {
        $("#play").removeClass('pause').addClass('active');

        var progress = $('.jp-audio');
        jp.jPlayer("option", "cssSelectorAncestor", '.jp-audio');
    }
    this.deactivate = function() {
        $("#play").removeClass('active').addClass('pause');

        jp.jPlayer("pause");
        current_track = null;
    }

    this.playNext = function() {
        var next = last_track.next('tr.track');

        if (next.length > 0) {

            var sample = next.attr('id');
            jp.jPlayer("setMedia", {
                mp3: '/demo/html/lovers/samples/' + sample + '.LOFI.mp3'
            });

            last_track.removeClass('pause').removeClass('active');
            jThis.playTrack(next);
            next.addClass('active');

        } else {
            current_track = null;
        }
    }

    this.playPrev = function() {
        var prev = last_track.prev('tr.track');

        if (prev.length > 0) {
            var sample = prev.attr('id');
            jp.jPlayer("setMedia", {
                mp3: '/demo/html/lovers/samples/' + sample + '.LOFI.mp3'
            });
            last_track.removeClass('pause').removeClass('active');
            jThis.playTrack(prev);
            prev.addClass('active');
        } else {
        }
    }

    function showTimeLeft() {
    }

    this.playTrack = function(track) {
        // var sample = track.attr('id');
        jp.jPlayer("setMedia", {
            mp3: track
        });

        current_track = track;
        last_track = track;


        // update track duration

        jp.jPlayer("play");
    }

    this.clickOnTrack = function(track) {
        if (current_track && current_track.attr('id') == track.attr('id')) {

            jp.jPlayer("pause");
            track.removeClass('active').addClass('pause');
        } else {
            if (last_track) {
                last_track.removeClass('pause').removeClass('active');
            }
            track.removeClass('pause').addClass('active');
            jThis.playTrack(track);

        }
    }
}



function createMedia() {
    this.media = {
        player: null
    }

    this.init = function() {
        this.media.player = new jplayer();
        this.media.player.init("#jpId");
    }
}

$(document).on("click", ".play_btn", function() {
    $("#player_container").slideDown("slow");
    if (wavesurfer.isPlaying())
    {
        wavesurfer.stop();
        $('.play.jp-control').toggleClass('active');
    }
    var song = $(this).find('i').attr("data-song"),
            type = $(this).find('i').attr("data-type");
            $(".loading").show();
    $.ajax({
        url: base_url + "/home/verifysong",
        type: "POST",
        data: {song: song}
    }).done(function(data) {
        data = $.parseJSON(data);
        if (type == "song") {
            $('#waveform').css('background-image', 'url(' + base_url + '/themes/home/img/download.png)');
//            $("#jquery_jplayer_1").jPlayer( "destroy" );
//            this.media = {
//                player: null
//            }
            
            /*wavesurfer.on('loading', function (percents) {
                document.getElementById('progress').value = percents;
                if(percents == "100"){
                    $('.play.jp-control').click();
                    $(".loading").hide();
                }
            });*/
            
            wavesurfer.on('finish', function (wavesurfer) {
                $('.play.jp-control').toggleClass('active');
            });

            wavesurfer.on('loading', function(percents) {
                if (percents == "100") {
                    $('#waveform').css('background-image', 'none');
                }
            });

            $(".loading").hide();
            wavesurfer.on('finish', function(wavesurfer) {
                $('.play.jp-control').toggleClass('active');
            });
            //wavesurfer.load(base_url+"/assets/demo.mp3");

            wavesurfer.load(data.url);
            wavesurfer.play();
            $('.play.jp-control').toggleClass('active');
//              wavesurfer.on('ready', function() {
//               
//            });
            //this.media.player = new jplayer();
            //this.media.player.init("#jpId");
            //this.media.player.playTrack(data.url);
            $('.jp-title span.song-title').html(data.artist_name + " - " + data.song_name);
            $("#album_art img").attr('src', data.album_art);
//            $('.play.jp-control').toggleClass('active');
        } else {
            $("#video_container").modal('show');
            this.media = {
                player: null
            }
            $("#jpId").jPlayer("destroy");
            //set player
            $('#video_title').html(data.artist_name + " - " + data.song_name);
            $("#jquery_jplayer_1").jPlayer({
                ready: function() {
                    $(this).jPlayer("setMedia", {
                        m4v: data.url
                    }).jPlayer("play");
                },
                swfPath: "jquery.jplayer.swf",
                supplied: "m4v",
                size: {
                    width: "570px",
                    height: "280px"
                }
            });
        }
    });
});

$(document).on("click", "#video_close", function() {
    $("#jquery_jplayer_1").jPlayer("destroy");
    $(".loading").hide();
});

$("#video_container").draggable({handle: "div#video_title"});

var ino = $('#navigation');
var footer = $('.footer');
var $tElems = $('.inner a');
var ct = $('.inner a').length;
var al = {queue: true, duration: 800, easing: "easeInOutQuad"};
var al2 = {queue: true, duration: 400, easing: "easeInOutQuad"};
var bo = $('.body-overlay');
var $mem = $('.member-box');
var memlenght = $('.member-box').length;
var $project = $('.box a');
var projectlenght = $('.box a').length;

lovers = new createMedia();


// ie fix of prop indexOf
if (!Array.prototype.indexOf) {
    Array.prototype.indexOf = function(obj, start) {
        for (var i = (start || 0), j = this.length; i < j; i++) {
            if (this[i] === obj) {
                return i;
            }
        }
        return -1;
    }
}

(function($) {
    $(function() {
        $('.player').click(function(evt) {
            var elm = evt.target;
            if ($(elm).closest('#playlist').length) {
                $('#player_tracklist').fadeToggle();
            }
        });

    });

    $(function() {
        $("#comment_btn").click(function(e) {
            $(".loading").show();
            var msg = $("#comment_msg").val();
            var song = $("#comment_song").val();
            var comment = "";
            if (msg.length > 0) {
                $.ajax({
                    url: base_url + '/add-comment',
                    method: "POST",
                    data: {"msg": msg, "song": song},
                    success: function(data) {
                        var record = $.parseJSON(data);
                        if (record.error == "0") {
							
							comment += '<div class="comment-container">';
								comment += '<div class="comment-item">';
									comment += '<div class="comment-avatar">';
										comment += '<a href="/backup/home/dj?user=' + record.user + '">';
											comment += '<img src="' + record.avatar + '" alt="user">';
										comment += '</a>';
									comment += '</div>';
									comment += '<div class="comment">';
										comment += '<div class="comment-head cf">';
											comment += '<a href="#" class="comment-author">' + record.user + '</a>';
											comment += '<span class="card-stats">';
												comment += '<span class="card-posted">';
													comment += '<i class="fa fa-calendar-o"></i>'+record.time+'</span>';
												comment += '</span>';
											comment += '</div>';
										comment += '<div class="comment-body">';
											comment += '<div class="comment-body-cropped">';
												comment += '<p>'+record.msg+'</p>';
											comment += '</div>';
										comment += '</div>';
									comment += '</div>';
								comment += '</div>';
                            comment += '</div>';
						    $(".comments").prepend(comment);
                        } else {
                            alert("Comment Not Saved Please try Again");
                        }
                    }
                });
            } else {
                alert("Please Enter Comment Message First");
            }
            $(".loading").hide();
        });
    });

})(jQuery);



$(document).ready(function() {
    $("#upload_file").click(function() {
        $(".loading").show();
        $.ajax({
            url: base_url + "/home/LoginCheck",
            success: function(data) {
                if (data == 'GUEST')
                {
                    $(".loading").hide();
                    $("#Login-pop").modal('show');
                }
                else if (data == 'USER')
                {
                    $.ajax({
                        url: base_url + "/user/CheckUploadLimit",
                        method: "POST",
                        dataType: "json",
                        success: function(data) {
                            if (data.status == 'CROSSED')
                            {
                                $('#crossed_upload_limit').modal('show');
                            }
                            else if (data.status == 'NOTCROSSED')
                            {
                                $('#Upload-pop').modal('show');
                            }
                            $(".loading").hide();
                        }
                    })
                }
            }
        })

    })


    $('body').on('click','.unread_notifications',function(){
        $(".loading").show();
        var notification_id = $(this).attr('id');
        var url = $(this).data('url');
        $.ajax({
            url: base_url + "/user/readNotification",
            method: "POST",
            data: {notification_id: notification_id},
            dataType: "json",
            success: function(data) {
                if (data.status == 'SUCCESS')
                {
                    window.location.href = url;
                }
                $(".loading").hide();
            }
        })
    });



    $("#notification").click(function() {
        // first check whether popup is opened or not
        // if it is opened then close otherwise fire ajax
        if ($("#notification_popup").is(":visible"))
        {
            $("#notification_popup").hide();
        }
        else
        {
            $(".loading").show();
            $.ajax({
                url: base_url + "/user/getNotification",
                success: function(data) {
                    $(".badge").html(0);
                    $("#notifications").html(data);
                    $("#notification_popup").show();
                    $(".loading").hide();
                }
            })
        }
    });
    
    $("#user_profile_image").click(function(){
        $("#Users_profile_pic").click();
    });







})




