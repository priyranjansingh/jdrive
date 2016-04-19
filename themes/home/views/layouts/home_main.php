<!doctype html>
<html>
    <head>
        <meta charset="utf-8">

        <title>JOCKDRIVE</title>

        <?php
        $baseUrl = Yii::app()->theme->baseUrl;
        $cs = Yii::app()->getClientScript();
        Yii::app()->clientScript->registerCoreScript('jquery');
        ?>

        <!--Css-->
        <link href="<?php echo $baseUrl; ?>/css/font-awesome.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $baseUrl; ?>/css/chosen.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $baseUrl; ?>/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $baseUrl; ?>/css/jquery.fileupload.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $baseUrl; ?>/css/owl.carousel.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $baseUrl; ?>/css/jplayer.pink.flag.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $baseUrl; ?>/css/responsive.css" rel="stylesheet" type="text/css">

        <!-- jquery -->
        <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery-1.11.2.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/chosen.jquery.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/bootstrap.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/owl.carousel.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/jquery.jplayer.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/jplayer.playlist.min.js"></script>
        <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/custom.js"></script>
    </head>

    <body>
        <!--Header-->
        <?php require_once('header.php'); ?>
        <!--Header--> 
        <!--Content-->
        <?php echo $content; ?>
        <!--Content--> 
        <!--Footer-->
        <?php require_once('footer.php'); ?>
        <!--Footer--> 

        <!--popup-->
        <div class="modal fade" id="Upload-pop">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Upload File</h4>
                    </div>
                    <div class="modal-body">
                        <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
                            <!-- Redirect browsers with JavaScript disabled to the origin page -->
                            <noscript>
                            <input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/">
                            </noscript>
                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                            <div class="row fileupload-buttonbar">
                                <div class="col-lg-8"> 
                                    <!-- The fileinput-button span is used to style the file input field as button --> 
                                    <span class="btn btn-success fileinput-button"> <i class="fa fa-plus"></i> <span>Add files...</span>
                                        <input type="file" name="files[]" multiple>
                                    </span>
                                    <button type="submit" class="btn btn-primary start"> <i class="fa fa-arrow-circle-o-up"></i> <span>Start upload</span> </button>
                                    <button type="reset" class="btn btn-warning cancel"> <i class="fa fa-ban"></i> <span>Cancel upload</span> </button>
                                    <button type="button" class="btn btn-danger delete"> <i class="fa fa-trash"></i> <span>Delete</span> </button>
                                    <input type="checkbox" class="toggle">
                                    <!-- The global file processing state --> 
                                    <span class="fileupload-process"></span> </div>
                                <!-- The global progress state -->
                                <div class="col-lg-4 fileupload-progress fade"> 
                                    <!-- The global progress bar -->
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                    </div>
                                    <!-- The extended global progress state -->
                                    <div class="progress-extended">&nbsp;</div>
                                </div>
                            </div>
                            <!-- The table listing the files available for upload/download -->
                            <table role="presentation" class="table utable">
                                <tbody class="files">
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="Signup-pop">
            <div class="modal-dialog" role="document">
                <div class="modal-content log_pan">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">SIGN UP JOCKDRIVE</h4>
                    </div>
                    <div class="modal-body">
                        <!--<div class="">
                            <?php
                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'registration-form',
                                'enableClientValidation' => true,
                                //'enableAjaxValidation'=>true,
                                'clientOptions' => array(
                                    'validateOnSubmit' => true,
                                ),
                                'htmlOptions' => array(
                                    'autcomplete' => "off",
                                ),
                            ));
                            ?>
                            <form id="" name="" method="POST">
                                <div class="m_row"> <i class="fa fa-envelope"></i>
                                    <div class="mr_col">
                                        <?php // echo $form->textField($model, 'email', array("placeholder" => "Email *", "class" => "t_box")); ?>
                                    </div>
                                </div>
                                <div class="m_row"> <i class="fa fa-lock"></i>
                                    <div class="mr_col">
                                        <input type="password" class="t_box" placeholder="Password">
                                    </div>
                                </div>
                                <div class="m_row"> <i class="fa fa-lock"></i>
                                    <div class="mr_col">
                                        <input type="password" class="t_box" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="m_row mart15">
                                    <label><span class="ck_box">
                                            <input type="checkbox">
                                            <span></span></span> Agree to</label>
                                    <a href="#">Terms and Conditions</a>
                                    <div class="mr_col"><span class="error" style="display:none"></span></div>
                                </div>
                                <div class="m_row tar">
                                    <input type="submit" value="Register" class="btn_small fc_white bg_blue">
                                </div>
                            </form>
                              <?php $this->endWidget(); ?>  
                            <div class="m_row tac"> Already have a JOCKDRIVE? <a class="log_btn" href="#" data-dismiss="modal" data-toggle="modal" data-target="#Login-pop">Login Now</a></div>
                        </div>-->
                    </div>
                    <div class="modal-footer"> 
                        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>--> 
                    </div>
                </div>
            </div>
        </div>

      
        <div class="modal fade" id="Login-pop">
            <div class="modal-dialog" role="document">
                <div class="modal-content log_pan">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">LOGIN</h4>
                    </div>
                    <div class="modal-body">
                        <?php $this->widget('LoginWidget'); ?>
                        <!--<form id="" name="" method="POST">
                            <div class="m_row"> <i class="fa fa-user"></i>
                                <div class="mr_col">
                                    <input type="text" class="t_box" placeholder="Enter Email ID">
                                </div>
                            </div>
                            <div class="m_row"> <i class="fa fa-lock"></i>
                                <div class="mr_col">
                                    <input type="password" class="t_box" placeholder="Password">
                                </div>
                            </div>
                            <div class="m_row mart15">
                                <label><span class="ck_box">
                                        <input type="checkbox">
                                        <span></span></span> Remember Me</label>
                                <a class="fr" href="#" data-dismiss="modal" data-toggle="modal" data-target="#Forgotpass">Forgot Password?</a></div>
                            <div class="m_row tar">
                                <input type="submit" value="Login &amp; Continue" class="btn_small fc_white bg_blue">
                            </div>
                            <div class="m_row tac">New to JOCKDRIVE? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#Signup-pop">Sign Up</a></div>
                        </form>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="Forgotpass">
            <div class="modal-dialog" role="document">
                <div class="modal-content log_pan">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Recover Password</h4>
                    </div>
                    <div class="modal-body">
                        <form id="" name="" method="POST">
                            <div class="m_row"> <i class="fa fa-envelope"></i>
                                <div class="mr_col">
                                    <input type="email" class="t_box" placeholder="Enter Email ID">
                                </div>
                            </div>
                            <div class="m_row mart15">
                                <div class="mr_col">
                                    <input type="submit" value="Submit" class="btn_small bg_blue">
                                </div>
                            </div>
                            <div class="m_row mart15">To Login: <a class="log_btn" href="#" data-dismiss="modal" data-toggle="modal" data-target="#Login-pop">Click Here</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- The template to display files available for upload -->
        <script id="template-upload" type="text/x-tmpl">
            {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-upload fade">
            <td>
            <span class="preview"></span>
            </td>
            <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
            </td>
            <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
            </td>
            <td class="last">
            {% if (!i && !o.options.autoUpload) { %}
            <button class="btn btn-primary start" disabled>
            <i class="fa fa-arrow-circle-o-up"></i>
            <span>Start</span>
            </button>
            {% } %}
            {% if (!i) { %}
            <button class="btn btn-warning cancel">
            <i class="fa fa-ban"></i>
            <span>Cancel</span>
            </button>
            {% } %}
            </td>
            </tr>
            {% } %}
        </script>
        <!-- The template to display files available for download -->
        <script id="template-download" type="text/x-tmpl">
            {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download fade">
            <td>
            <span class="preview">
            {% if (file.thumbnailUrl) { %}
            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
            {% } %}
            </span>
            </td>
            <td>
            <p class="name">
            {% if (file.url) { %}
            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
            {% } else { %}
            <span>{%=file.name%}</span>
            {% } %}
            </p>
            {% if (file.error) { %}
            <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
            </td>
            <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
            </td>
            <td class="last">
            {% if (file.deleteUrl) { %}
            <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
            <i class="fa fa-trash"></i>
            <span>Delete</span>
            </button>
            <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
            <button class="btn btn-warning cancel">
            <i class="glyphicon glyphicon-ban-circle"></i>
            <span>Cancel</span>
            </button>
            {% } %}
            </td>
            </tr>
            {% } %}
        </script>

        <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
        <script src="<?php echo $baseUrl; ?>/js/vendor/jquery.ui.widget.js"></script>
        <!-- The Templates plugin is included to render the upload/download listings -->
        <script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
        <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
        <script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
        <!-- The Canvas to Blob plugin is included for image resizing functionality -->
        <script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
        <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->

        <!-- blueimp Gallery script -->
        <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
        <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
        <script src="<?php echo $baseUrl; ?>/js/jquery.iframe-transport.js"></script>
        <!-- The basic File Upload plugin -->
        <script src="<?php echo $baseUrl; ?>/js/jquery.fileupload.js"></script>
        <!-- The File Upload processing plugin -->
        <script src="<?php echo $baseUrl; ?>/js/jquery.fileupload-process.js"></script>
        <!-- The File Upload image preview & resize plugin -->
        <script src="<?php echo $baseUrl; ?>/js/jquery.fileupload-image.js"></script>
        <!-- The File Upload audio preview plugin -->
        <script src="<?php echo $baseUrl; ?>/js/jquery.fileupload-audio.js"></script>
        <!-- The File Upload video preview plugin -->
        <script src="<?php echo $baseUrl; ?>/js/jquery.fileupload-video.js"></script>
        <!-- The File Upload validation plugin -->
        <script src="<?php echo $baseUrl; ?>/js/jquery.fileupload-validate.js"></script>
        <!-- The File Upload user interface plugin -->
        <script src="<?php echo $baseUrl; ?>/js/jquery.fileupload-ui.js"></script>
        <!-- The main application script -->
        <script src="<?php echo $baseUrl; ?>/js/main.js"></script>
        <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
        <!--[if (gte IE 8)&(lt IE 10)]>
        <script src="js/cors/jquery.xdr-transport.js"></script>
        <![endif]-->

        <script type="text/javascript">
            //<![CDATA[
            $(document).ready(function() {

                new jPlayerPlaylist({
                    jPlayer: "#jquery_jplayer_1",
                    cssSelectorAncestor: "#jp_container_1"
                }, [
                    {
                        title: "Cro Magnon Man",
                        artist: "The Stark Palace",
                        mp3: "http://www.jplayer.org/audio/mp3/TSP-01-Cro_magnon_man.mp3",
                        oga: "http://www.jplayer.org/audio/ogg/TSP-01-Cro_magnon_man.ogg",
                        poster: "http://www.jplayer.org/audio/poster/The_Stark_Palace_640x360.png"
                    },
                    {
                        title: "Your Face",
                        artist: "The Stark Palace",
                        mp3: "http://www.jplayer.org/audio/mp3/TSP-05-Your_face.mp3",
                        oga: "http://www.jplayer.org/audio/ogg/TSP-05-Your_face.ogg",
                        poster: "http://www.jplayer.org/audio/poster/The_Stark_Palace_640x360.png"
                    },
                    {
                        title: "Hidden",
                        artist: "Miaow",
                        mp3: "http://www.jplayer.org/audio/mp3/Miaow-02-Hidden.mp3",
                        oga: "http://www.jplayer.org/audio/ogg/Miaow-02-Hidden.ogg",
                        poster: "http://www.jplayer.org/audio/poster/Miaow_640x360.png"
                    },
                    {
                        title: "Big Buck Bunny Trailer",
                        artist: "Blender Foundation",
                        m4v: "http://www.jplayer.org/video/m4v/Big_Buck_Bunny_Trailer.m4v",
                        ogv: "http://www.jplayer.org/video/ogv/Big_Buck_Bunny_Trailer.ogv",
                        webmv: "http://www.jplayer.org/video/webm/Big_Buck_Bunny_Trailer.webm",
                        poster: "http://www.jplayer.org/video/poster/Big_Buck_Bunny_Trailer_480x270.png"
                    },
                    {
                        title: "Finding Nemo Teaser",
                        artist: "Pixar",
                        m4v: "http://www.jplayer.org/video/m4v/Finding_Nemo_Teaser.m4v",
                        ogv: "http://www.jplayer.org/video/ogv/Finding_Nemo_Teaser.ogv",
                        webmv: "http://www.jplayer.org/video/webm/Finding_Nemo_Teaser.webm",
                        poster: "http://www.jplayer.org/video/poster/Finding_Nemo_Teaser_640x352.png"
                    },
                    {
                        title: "Cyber Sonnet",
                        artist: "The Stark Palace",
                        mp3: "http://www.jplayer.org/audio/mp3/TSP-07-Cybersonnet.mp3",
                        oga: "http://www.jplayer.org/audio/ogg/TSP-07-Cybersonnet.ogg",
                        poster: "http://www.jplayer.org/audio/poster/The_Stark_Palace_640x360.png"
                    },
                    {
                        title: "Incredibles Teaser",
                        artist: "Pixar",
                        m4v: "http://www.jplayer.org/video/m4v/Incredibles_Teaser.m4v",
                        ogv: "http://www.jplayer.org/video/ogv/Incredibles_Teaser.ogv",
                        webmv: "http://www.jplayer.org/video/webm/Incredibles_Teaser.webm",
                        poster: "http://www.jplayer.org/video/poster/Incredibles_Teaser_640x272.png"
                    },
                    {
                        title: "Tempered Song",
                        artist: "Miaow",
                        mp3: "http://www.jplayer.org/audio/mp3/Miaow-01-Tempered-song.mp3",
                        oga: "http://www.jplayer.org/audio/ogg/Miaow-01-Tempered-song.ogg",
                        poster: "http://www.jplayer.org/audio/poster/Miaow_640x360.png"
                    },
                    {
                        title: "Lentement",
                        artist: "Miaow",
                        mp3: "http://www.jplayer.org/audio/mp3/Miaow-03-Lentement.mp3",
                        oga: "http://www.jplayer.org/audio/ogg/Miaow-03-Lentement.ogg",
                        poster: "http://www.jplayer.org/audio/poster/Miaow_640x360.png"
                    }
                ], {
                    swfPath: "../../dist/jplayer",
                    solution: "flash, html",
                    supplied: "webmv, ogv, m4v, oga, mp3",
                    useStateClassSkin: true,
                    autoBlur: false,
                    smoothPlayBar: true,
                    keyEnabled: true,
                    audioFullScreen: true
                });
            });
            //]]>
        </script>
    </body>
</html>
