$(document).ready(function() {

    $(".widget_upload").click(function() {
        var song_id = $(this).data('song');
        var user_id = $(this).data('user');

        $.ajax({
            url: base_url + "/home/WidgetUpload",
            method: "POST",
            data: {'song_id': song_id, 'user_id': user_id},
            success: function(data) {
                 $('#widget_success_upload').modal('show');
                $(".loading").hide();
            }
        })
    })
    
    $(".widget_like").click(function() { 
        var song_id = $(this).data('song');
        var user_id = $(this).data('user');
        var container = $(this); 
        $.ajax({
            url: base_url + "/home/WidgetLike",
            method: "POST",
            data: {'song_id': song_id, 'user_id': user_id},
            success: function(data) {
                container.find('span').html(data);
                $(".loading").hide();
            }
        })
    })
    
    $(".widget_download").click(function() {
        var song_id = $(this).data('song');
        window.location.href = base_url+"/home/WidgetDownload?file="+song_id;

    })
    
    $(".widget_playlist").click(function() {
        var song_id = $(this).data('song');
        $.ajax({
            url: base_url + "/home/WidgetAddToPlaylist",
            method: "POST",
            data: {'song_id': song_id},
            success: function(data) {
                $('#ajax_add_playlist').find(".modal-body").html(data);
                $("#playlist_song").val(song_id);
                $('#ajax_add_playlist').modal('show');
            }
        })

    })
    
    
    $("body").on("click",".selected_playlist",function(){
       var song = $(this).data('song');
       var playlist = $(this).data('playlist');
       $.ajax({
           url : base_url+"/home/AjaxAddToPlaylist",
           method:"POST",
           data:{'song':song,'playlist':playlist},
           success: function(data)
           {
               $('#ajax_add_playlist').modal('hide');
           }
           
       })
    });
    



})