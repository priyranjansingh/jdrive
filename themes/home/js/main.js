/*
 * jQuery File Upload Plugin JS Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';
    var mode = $(".file_mode:checked").val();
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: base_url+'/home/upload',
        formData: {mode: mode},
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            base_url+'/themes/home/bimp/cors/result.html?%s'
        )
    );

    if (window.location.hostname === 'blueimp.github.io') {
        // Demo settings:
        $('#fileupload').fileupload('option', {
            url: '//jquery-file-upload.appspot.com/',
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
            maxFileSize: 5000000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
        });
        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '//jquery-file-upload.appspot.com/',
                type: 'HEAD'
            }).fail(function () {
                $('<div class="alert alert-danger"/>')
                    .text('Upload server currently unavailable - ' +
                            new Date())
                    .appendTo('#fileupload');
            });
        }
    } else {
        // Load existing files:
        $('#fileupload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });
    }

$(document).on("click",".play_btn",function(){
        
        var song = $(this).find('i').attr("data-song"),
            type = $(this).find('i').attr("data-type");
        $.ajax({
            url: base_url+"/home/verifysong",
            type: "POST",
            data: { song: song}
        }).done(function(data){
            data = $.parseJSON(data);
            if(type == "song"){
                // prevIsClosed = true;
                // $("#jquery_jplayer_1").jPlayer("stop");
                // $("#jquery_jplayer_1").jPlayer("destroy");
                // $('#pp_full_res').hide();
                // $('.pp_fade').hide();
                // $('.pp_pic_holder').fadeOut('fast');
                $("#jquery_jplayer_1").jPlayer("stop");
                $("#jquery_jplayer_1").jPlayer("destroy");
                $('#jp_audio_song').text(data.song_name);
                $('#jp_audio_artist').text(data.artist_name);
                $("#jquery_jplayer_1").jPlayer({
                    cssSelectorAncestor: "#jp-interface-container",
                    keyEnabled: true,
                    ready: function () {
                        $("#jquery_jplayer_1").jPlayer("setMedia", {
                            title: data.song_name,
                            mp3: data.url
                        }).jPlayer("play");
                    },
                    play: function() { // To avoid multiple jPlayers playing together.
                        $("#jquery_jplayer_1").jPlayer("pauseOthers");
                    },
                    swfPath: "jquery.jplayer.swf",
                    supplied: "mp3",
                    /*timeupdate: function(event) { // 4Hz
                        if(!p){
                            // Restrict playback to first 90 seconds.
                            if (event.jPlayer.status.currentTime > 90) {
                                $("#beau_player").jPlayer('stop');
                            }
                        }
                    }*/
                });
            } /*else {
                $("#beau_player").jPlayer("stop");
                $("#beau_player").jPlayer("destroy");
                $("#jquery_jplayer_1").jPlayer("stop");
                $("#jquery_jplayer_1").jPlayer("destroy");
    
                    //set variables
                    var playertitle = data.songName;
                    //load modal
                    $('.pp_description').html(playertitle);
                    if(prevIsClosed){
                        $('#pp_full_res').hide();
                        $('.pp_pic_holder').hide();
                        $('.pp_pic_holder').css({'top': 0, 'right': 0 });
                        $('.pp_pic_holder').fadeIn('fast');
                        $('.pp_pic_holder').animate({
                            'top': 400,
                            'right': 0,
                            'width': 360,
                            height: 300
                        }, 'fast', function () {
                            $('.pp_details').width(320);
                            $('.pp_description').width(287);
                            $('.pp_description').html(playertitle);
                            $('.pp_fade').fadeIn('fast');
                        });
                        //make modal draggable
                        $('.pp_pic_holder').drag();
                        $('#pp_full_res').show();
                        prevIsClosed = false;
                    }
                    //set player
                    $("#jquery_jplayer_1").jPlayer({
                        ready: function () {
                            $(this).jPlayer("setMedia", {
                                m4v: data.file
                            }).jPlayer("play");
                        },
                        timeupdate: function(event) { // 4Hz
                              // Restrict playback to first 90 seconds.
                            if(!p){
                                if (event.jPlayer.status.currentTime > 90) {
                                    $("#jquery_jplayer_1").jPlayer('stop');
                                }
                            }
                        },
                        swfPath: "assets/js/jquery.jplayer.swf",
                        supplied: "m4v",
                        size: {
                            width: "320px",
                            height: "180px"
                        }
                    });
            }
            
            NProgress.done();*/
        });
    });

});
