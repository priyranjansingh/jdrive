$(document).ready(function() {
    $(".home_song_type").click(function() {
        $(".loading").show();
        if ($("#home_trending").hasClass('select'))
        {
            $("#home_trending").trigger("click");
        }
        else if ($("#home_just_added").hasClass('select'))
        {
            $("#home_just_added").trigger("click");
        }
        else if ($("#home_playlist").hasClass('select'))
        {

        }
        else
        {
            var song_type = $(this).attr("id");
            $.ajax({
                url: base_url + "/home/HomeSongType",
                method: "POST",
                data: {'song_type': song_type},
                success: function(data) {
                    $("#home_media_container").html(data);
                    $(".loading").hide();
                }

            })
        }


    })

    
    

    $("#home_trending").click(function() {
        $("#home_song_type_container").show();
        $(".loading").show();
        var song_type = $(".home_song_type.active").attr('id'); // audio or video
        $.ajax({
            url: base_url + "/home/HomeAjaxTrending",
            method: "POST",
            data: {'song_type': song_type},
            success: function(data) {
                $("#home_media_container").html(data);
                $(".loading").hide();
            }
        })

    })
    
    
     $("#home_just_added").click(function() {
        $("#home_song_type_container").show();
        $(".loading").show();
        var song_type = $(".home_song_type.active").attr('id'); // audio or video
        $.ajax({
            url: base_url + "/home/HomeAjaxJustAdded",
            method: "POST",
            data: {'song_type': song_type},
            success: function(data) {
                $("#home_media_container").html(data);
                $(".loading").hide();
            }
        })
    })
    
    
    
    $("#home_playlist").click(function() {
         $("#home_song_type_container").hide();
        $(".loading").show();
        var user = $(".home_song_type.active").data('user'); // dj user id
        $.ajax({
            url: base_url + "/home/HomeAjaxPlaylist",
            method: "POST",
            data: {'user': user},
            success: function(data) {
                $("#home_media_container").html(data);
                $(".loading").hide();
            }
        })

    })
    
   
    
    $('body').on('click','.home_playlist_songs',function(){
       $(".loading").show();
        var playlist = $(this).data('id'); // playlist id
        $.ajax({
            url: base_url + "/home/HomeAjaxPlaylistSongs",
            method: "POST",
            data: {'playlist': playlist},
            success: function(data) {
                $("#home_media_container").html(data);
                $(".loading").hide();
            }
        })
    });
    
    
    





})