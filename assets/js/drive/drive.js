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


$('body').on("click", ".edit_btn", function() {
    $(".loading").show();
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

$('body').on("click", ".drive_download_btn", function() {
    var song = $(this).data('song');
    window.location.href = base_url + "/user/download?file=" + song;
});





$('body').on("click", ".delete_btn", function() {
    var song = $(this).data('song');
    $("#delete_yes").data('song', song);
    $("#delete_no").data('song', song);
    $("#delete_song_div").modal('show');
});



$('body').on("click", ".delete_option", function() {
    var song = $(this).data('song');
    var type = $(this).attr('id');
    if (type == 'delete_yes')
    {
        $(".loading").show();
        $.ajax({
            url: base_url + "/user/AjaxDelete",
            method: "POST",
            data: {'song': song},
            success: function(data) {
                $(".loading").hide();
                if (data == 'success')
                {

                    window.location.href = base_url + "/user/drive";
                }
                else
                {
                    window.location.href = base_url + "/user/drive";
                }
            }
        })
    }
    else
    {
        $("#delete_song_div").modal('hide');
    }
});


$('body').on("click", ".file_mode_btn", function() {
    $(".loading").show();
    var song = $(this).data('song');
    var current_object = $(this);
    $.ajax({
        url: base_url + "/user/ajaxChangeFileMode",
        method: "POST",
        dataType: "json",
        data: {'song': song},
        success: function(data) {
            if (data.label)
            {
                current_object.attr('value', data.label);
            }
            $(".loading").hide();
        }
    })
});


