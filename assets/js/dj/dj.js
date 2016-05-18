$(document).ready(function() {
    $(".song_type").click(function() {
        $(".loading").show();
        if ($("#trending").hasClass('select'))
        {
            $("#trending").trigger("click");
        }
        else if ($("#just_added").hasClass('select'))
        {
            $("#just_added").trigger("click");
        }
        else if ($("#playlist").hasClass('select'))
        {
            var playlist = $("#playlist_name_container").data('playlist');
            var song_type = $(".song_type.active").attr('id'); // audio or video
            $.ajax({
                url: base_url + "/home/AjaxPlaylistSongs",
                method: "POST",
                data: {'playlist': playlist, 'song_type': song_type},
                success: function(data) {
                    $("#song_type_container").show();
                    $("#media_container").html(data);
                    $(".loading").hide();
                }
            })

        }
        else if ($("#my_drive").hasClass('select'))
        {
            $("#my_drive").trigger("click");
        }
        else
        {
            var user = $(this).data('user');
            var song_type = $(this).attr("id");
            $.ajax({
                url: base_url + "/home/SongType",
                method: "POST",
                data: {'user': user, 'song_type': song_type},
                success: function(data) {
                    $("#media_container").html(data);
                    $(".loading").hide();
                }

            })
        }


    })

    $("#follow_unfollow").click(function() {
        $(".loading").show();
        var user_id = $(this).data('user');
        var dj_id = $(this).data('dj');
        $.ajax({
            url: base_url + "/home/FollowUnfollow",
            method: "POST",
            data: {'user_id': user_id, 'dj_id': dj_id},
            dataType: 'json',
            success: function(data) {
                $("#follow_unfollow").html(data.follow_unfollow_text);
                $("#followers_count").html(data.followers_count);
                $(".loading").hide();
            }

        })

    });

    $("#follow_unfollow_recommend").click(function() {
        $(".loading").show();
        var user_id = $(this).data('user');
        var dj_id = $(this).data('dj');
        $.ajax({
            url: base_url + "/home/FollowUnfollowRecommend",
            method: "POST",
            data: {'user_id': user_id, 'dj_id': dj_id},
            success: function(data) {
                $("#recommended_container").html(data);
                $(".loading").hide();
            }

        })
    });


    $("#trending").click(function() {
        $("#play_btn_container").hide();
        $("#song_type_container").show();
        $(".loading").show();
        var song_type = $(".song_type.active").attr('id'); // audio or video
        var user = $(".song_type.active").data('user'); // dj user id
        $.ajax({
            url: base_url + "/home/AjaxTrending",
            method: "POST",
            data: {'user': user, 'song_type': song_type},
            success: function(data) {
                $("#media_container").html(data);
                $(".loading").hide();
            }
        })

    })


    $("#just_added").click(function() {
        $("#play_btn_container").hide();
        $("#song_type_container").show();
        $(".loading").show();
        var song_type = $(".song_type.active").attr('id'); // audio or video
        var user = $(".song_type.active").data('user'); // dj user id
        $.ajax({
            url: base_url + "/home/AjaxJustAdded",
            method: "POST",
            data: {'user': user, 'song_type': song_type},
            success: function(data) {
                $("#media_container").html(data);
                $(".loading").hide();
            }
        })

    })

    $("#my_drive").click(function() {
        $("#play_btn_container").hide();
        $("#song_type_container").show();
        $(".loading").show();
        var song_type = $(".song_type.active").attr('id'); // audio or video
        var user = $(".song_type.active").data('user'); // dj user id
        $.ajax({
            url: base_url + "/home/AjaxMyDrive",
            method: "POST",
            data: {'user': user, 'song_type': song_type},
            success: function(data) {
                $("#media_container").html(data);
                $(".loading").hide();
            }
        })

    })



    $("#playlist").click(function() {
        $("#play_btn_container").hide();
        $("#song_type_container").hide();
        $(".loading").show();
        var user = $(".song_type.active").data('user'); // dj user id
        $.ajax({
            url: base_url + "/home/AjaxPlaylist",
            method: "POST",
            data: {'user': user},
            success: function(data) {
                $("#media_container").html(data);
                $(".loading").hide();
            }
        })

    })



    $('body').on('click', '.playlist_songs', function() {
        $(".loading").show();
        var playlist = $(this).data('id'); // playlist id
        var song_type = $(".song_type.active").attr('id'); // audio or video
        $.ajax({
            url: base_url + "/home/AjaxPlaylistSongs",
            method: "POST",
            data: {'playlist': playlist, 'song_type': song_type},
            success: function(data) {
                $("#song_type_container").show();
                $("#media_container").html(data);
                $("#play_btn_container").show();
                $("#play_all").data("type",song_type);
                $(".loading").hide();
            }
        })
    });








})