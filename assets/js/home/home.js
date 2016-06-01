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
            data: {'song_type': song_type},
            success: function(data) {
                $("#home_media_container").html(data);
                $(".loading").hide();
            }
        })

    })


    $("#home_just_added").click(function() {
        $("#category_name").html('Categories');
        $("#category_name").data('genre', '');
        $("#category_name").removeClass('genre_active');

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



    $('body').on('click', '.home_playlist_songs', function() {
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


    $('body').on("click", ".subscription_btn", function() {
        $(".loading").show();
        var plan = $(this).data('plan');
        $.ajax({
            url: base_url + "/home/AjaxPlanDetail",
            method: "POST",
            data: {'plan': plan},
            success: function(data) {
                //alert(data);
                $("#subscription_div_body").html(data);
                $("#subscription_div").modal('show');
                $(".loading").hide();
            }
        })
    });









})