$(".drive_genre_class").click(function() {
    $(".drive_genre_class").removeClass('drive_active_cat');
    $(this).addClass('drive_active_cat');
    $(".loading").show();
    var song_type = $(".drive_song_type.active").attr('id'); // audio or video
    var genre = $(this).data('genre');
    //alert(song_type);
    $.ajax({
        url: base_url + "/user/AjaxDrive",
        method: "POST",
        data: {'song_type': song_type, 'genre': genre},
        success: function(data) {
            $("#mydrive_container").html(data);
            $(".loading").hide();
        }
    })
})


$(".drive_song_type").click(function() {
    $(".loading").show();
    var n = $(".drive_active_cat").length;
    if (n > 0)
    {
        var song_type = $(this).attr('id'); // audio or video
        var genre = $(".drive_active_cat").data('genre');
        //alert(song_type);
        $.ajax({
            url: base_url + "/user/AjaxDrive",
            method: "POST",
            data: {'song_type': song_type, 'genre': genre},
            success: function(data) {
                $("#mydrive_container").html(data);
                $(".loading").hide();
            }
        })
    }
    else
    {
        var song_type = $(this).attr("id");
        $.ajax({
            url: base_url + "/user/AjaxSongType",
            method: "POST",
            data: {'song_type': song_type},
            success: function(data) {
                $("#mydrive_container").html(data);
                $(".loading").hide();
            }

        })
    }
});


$('body').on("click",".edit_btn",function(){
    var song = $(this).data('song');
    $.ajax({
        url: base_url + "/user/SongDetail",
        method: "POST",
        data: {'song': song},
        success: function(data) {
            $("#edit_song_div_body").html(data);
            $("#edit_song_div").modal('show');
            $(".loading").hide();
        }
    })
});


