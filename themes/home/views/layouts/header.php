<div class="header">
    <div class="col-md-2 logo_p"><img src="<?php echo $baseUrl; ?>/img/logo.gif" /></div>
    <div class="col-md-10">
        <div class="togg_bar"><span class="togg_menu"><i class="fa fa-navicon"></i></span></div>
        <ul class="h_menu">
            <li><span class="search">
                    <input type="text" class="s_box" placeholder="Search..."/>
                    <input type="search"  class="search-btn"/>
                </span></li>
            <li><a href="#"><i class="fa fa-th-large"></i> Categories <i class="fa fa-angle-down"></i></a>
                <ul class="dropdown-menu sub_menu">
                    <?php $genres = Genres::model()->findAll(array("condition" => "parent = ''")); ?>

                    <?php foreach($genres as $genre): ?>
                        <li><a href="#"><?php echo $genre->name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php if(Yii::app()->user->isGuest): ?>
            <li><a href="#" data-toggle="modal" data-target="#Signup-pop">Sign Up</a></li>
            <li><a href="#" data-toggle="modal" data-target="#Login-pop">Login</a></li>
            <?php else: ?>
            <li><a href="#" data-toggle="modal" data-target="#Upload-pop"><i class="fa fa-cloud-upload"></i> Upload</a></li>
            <li><a href="#"><?php echo Users::model()->findByPk(Yii::app()->user->id)->username; ?> <i class="fa fa-angle-down"></i></a>
                <ul class="sub_menu">
                    <li><a href="#">My Profile</a></li>
                    <li><a href="#">Payment History</a></li>
                    <li><a href="<?php echo base_url().'/home/logout'; ?>">Logout</a></li>
                </ul>
            </li>
            <?php endif; ?>
            <li><a href="#">More <i class="fa fa-angle-down"></i></a>
                <ul class="sub_menu">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Feedback</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>