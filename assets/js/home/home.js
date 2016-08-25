$(document).ready(function() {
    var just_added_audio_offset = 0;
    var just_added_video_offset = 0;
    var trending_audio_offset = 0;
    var trending_video_offset = 0;
    var playlist_offset = 0;



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
        else if ($("#category_name").hasClass('genre_active'))
        {
            var song_type = $(".home_song_type.active").attr('id'); // audio or video
            var genre = $("#category_name").data('genre');
            $.ajax({
                url: base_url + "/home/HomeGenre",
                method: "POST",
                data: {'song_type': song_type, 'genre': genre},
                success: function(data) {
                    $("#home_media_container").html(data);
                    $(".loading").hide();
                }
            })
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

        $("#category_name").html('Categories');
        $("#category_name").data('genre', '');
        $("#category_name").removeClass('genre_active');

        $("#home_song_type_container").show();
        $(".loading").show();
        var song_type = $(".home_song_type.active").attr('id'); // audio or video
        $.ajax({
            url: base_url + "/home/HomeAjaxTrending",
            method: "POST",
            dataType: 'json',
            data: {'song_type': song_type},
            success: function(data) {
                $("#home_media_container #parent_ul").html(data.song_list);
                if (data.song_count < 20)
                {
                    $("#see_more").hide();
                }
                else
                {
                    $("#see_more").show();
                }
                $(".loading").hide();
            }
        })

    })


    $("#home_just_added").click(function() {
        $("#category_name").html('Categories');
        $("#category_name").data('genre', '');
        $("#category_name").removeClass('genre_active');
        just_added_audio_offset = just_added_video_offset = trending_audio_offset = trending_video_offset = playlist_offset = 0;
        $("#home_song_type_container").show();
        $(".loading").show();
        var song_type = $(".home_song_type.active").attr('id'); // audio or video
        $.ajax({
            url: base_url + "/home/HomeAjaxJustAdded",
            method: "POST",
            data: {'song_type': song_type},
            dataType: 'json',
            success: function(data) {
                $("#home_media_container #parent_ul").html(data.song_list);
                if (data.song_count < 20)
                {
                    $("#see_more").hide();
                }
                else
                {
                    $("#see_more").show();
                }
                $(".loading").hide();

            }
        })
    })


    $(".genre_class").click(function() {

        $("#home_trending").removeClass('select');
        $("#home_just_added").removeClass("select");
        $("#home_playlist").removeClass("select");

        $("#category_name").html($(this).data('name'));
        $("#category_name").data('genre', $(this).data('genre'));
        $("#category_name").addClass('genre_active');
        $("#home_song_type_container").show();
        $(".loading").show();
        var song_type = $(".home_song_type.active").attr('id'); // audio or video
        var genre = $(this).data('genre');
        $.ajax({
            url: base_url + "/home/HomeGenre",
            method: "POST",
            data: {'song_type': song_type, 'genre': genre},
            success: function(data) {
                $("#home_media_container").html(data);
                $(".loading").hide();
            }
        })
    })






    $("#home_playlist").click(function() {
        $("#category_name").html('Categories');
        $("#category_name").data('genre', '');
        $("#category_name").removeClass('genre_active');

        just_added_audio_offset = just_added_video_offset = trending_audio_offset = trending_video_offset = playlist_offset = 0;
        $("#home_song_type_container").hide();
        $(".loading").show();
        var user = $(".home_song_type.active").data('user'); // dj user id
        $.ajax({
            url: base_url + "/home/HomeAjaxPlaylist",
            method: "POST",
            data: {'user': user},
            dataType: 'json',
            success: function(data) {
                $("#home_media_container #parent_ul").html(data.playlist);
                if (data.playlist_count < 20)
                {
                    $("#see_more").hide();
                }
                $(".loading").hide();
            }
        })

    })



    $('body').on('click', '.home_playlist_songs', function() {
        $(".loading").show();
        var playlist = $(this).data('id'); // playlist id
        $.ajax({
            url: base_url + "/home/HomeAjaxPlaylistSongs",
            method: "POST",
            dataType : 'json',
            data: {'playlist': playlist},
            success: function(data) {
                $("#home_media_container #parent_ul").html(data.playlist_songs);
                $("#see_more").hide();
                $(".loading").hide();
            }
        })
    });


    $('body').on("click", ".subscription_btn", function() {
        $(".loading").show();
        var plan = $(this).data('plan');
        $.ajax({
            url: base_url + "/home/AjaxPlanDetail",
            method: "POST",
            data: {'plan': plan},
            success: function(data) {
                $("#subscription_div_body").html(data);
                $("#subscription_div").modal('show');
                $(".loading").hide();
            }
        })
    });


    $("#see_more").click(function() {
        $(".loading").show();
        var song_type = $(".home_song_type.active").attr('id'); // audio or video
        if ($("#home_just_added").hasClass('select'))
        {
            if (song_type == 'audio')
            {
                just_added_audio_offset = just_added_audio_offset + 20;
                $.ajax({
                    url: base_url + "/home/loadMoreJustAdded",
                    method: "POST",
                    dataType: 'json',
                    data: {'song_type': song_type, just_added_audio_offset: just_added_audio_offset},
                    success: function(data) {
                        $("#home_media_container #parent_ul").append(data.song_list);
                        if (data.song_count < 20)
                        {
                            $("#see_more").hide();
                        }
                        $(".loading").hide();
                    }
                })
            }
            else if (song_type == 'video')
            {
                just_added_video_offset = just_added_video_offset + 20;
                $.ajax({
                    url: base_url + "/home/loadMoreJustAdded",
                    method: "POST",
                    dataType: 'json',
                    data: {'song_type': song_type, just_added_video_offset: just_added_video_offset},
                    success: function(data) {
                        $("#home_media_container #parent_ul").append(data.song_list);
                        if (data.song_count < 20)
                        {
                            $("#see_more").hide();
                        }
                        $(".loading").hide();
                    }
                })
            }


        }
        else if ($("#home_trending").hasClass('select'))
        {
            if (song_type == 'audio')
            {
                trending_audio_offset = trending_audio_offset + 20;
                $.ajax({
                    url: base_url + "/home/loadMoreTrending",
                    method: "POST",
                    dataType: 'json',
                    data: {'song_type': song_type, trending_audio_offset: trending_audio_offset},
                    success: function(data) {
                        $("#home_media_container #parent_ul").append(data.song_list);
                        if (data.song_count < 20)
                        {
                            $("#see_more").hide();
                        }
                        $(".loading").hide();
                    }
                })
            }
            else if (song_type == 'video')
            {
                trending_video_offset = trending_video_offset + 20;
                $.ajax({
                    url: base_url + "/home/loadMoreTrending",
                    method: "POST",
                    dataType: 'json',
                    data: {'song_type': song_type, trending_video_offset: trending_video_offset},
                    success: function(data) {
                        $("#home_media_container #parent_ul").append(data.song_list);
                        if (data.song_count < 20)
                        {
                            $("#see_more").hide();
                        }
                        $(".loading").hide();
                    }
                })
            }
        }
        else if ($("#home_playlist").hasClass('select'))
        {
            playlist_offset = playlist_offset + 20;
            $.ajax({
                url: base_url + "/home/loadMorePlaylist",
                method: "POST",
                dataType: 'json',
                data: {playlist_offset: playlist_offset},
                success: function(data) {
                    $("#home_media_container #parent_ul").append(data.playlist);
                    if (data.playlist_count < 20)
                    {
                        $("#see_more").hide();
                    }
                    $(".loading").hide();
                }
            })
        }



    })







})