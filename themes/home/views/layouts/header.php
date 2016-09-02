<div class="header">
    <div class="col-md-2 logo_p">
        <a href="<?php echo base_url(); ?>">
			<img src="<?php echo $baseUrl; ?>/img/logo.png" />
		</a>
    </div>
    <div class="col-md-10 tar">
    	<div class="s_pan">
        	<span class="search">
                     <?php $this->widget('SearchWidget'); ?>
            </span>
            
            <?php if(!Yii::app()->user->isGuest){ ?>
            <div class="noti">
            <a href="javascript:void(0)" data-toggle="modal" id="notification"><i class="fa fa-bell"></i> <span class="badge"><?php echo getNotificationCount(Yii::app()->user->id);  ?></span></a>
            <div class="noti_con" id="notification_popup">
                <p class="titel">Notifications</p>
                <div class="" id="notifications">
                </div>
            </div>
            </div>
			<?php } ?>
        </div>
    
        <div class="togg_bar"><span class="togg_menu"><i class="fa fa-navicon"></i></span></div>
        <ul class="h_menu">
            <li>
				<a href="<?php echo base_url(); ?>/home/discover"><i class="fa fa-th-large"></i> <span id="category_name" data-genre="" class="">Categories</span> <i class="fa fa-angle-down"></i></a>
                <ul class="sub_menu">
                    <li><a href="<?php echo base_url(); ?>/home/genre?name=beats">Beats</a></li>
					<li><a href="<?php echo base_url(); ?>/home/genre?name=classical">Classical</a></li>
					<li><a href="<?php echo base_url(); ?>/home/genre?name=hip-hop">Hip-Hop</a></li>
					<li><a href="<?php echo base_url(); ?>/home/genre?name=pop">Pop</a></li>
					<li><a href="<?php echo base_url(); ?>/home/genre?name=rock">Rock</a></li>
                </ul>
            </li>
            <?php if(Yii::app()->user->isGuest): ?>
            <li><a href="#" data-toggle="modal" data-target="#Signup-pop">Sign Up</a></li>
            <li><a href="#" data-toggle="modal" data-target="#Login-pop">Login</a></li>
            <?php else: ?>
            
            <li><a href="#" data-toggle="modal" id="upload_file"><i class="fa fa-cloud-upload"></i> Upload</a></li>
            <li><a href="#"><?php echo Users::model()->findByPk(Yii::app()->user->id)->username; ?> <i class="fa fa-angle-down"></i></a>
                <ul class="sub_menu">
                    <li><a href="<?php echo base_url().'/user/profile'; ?>">My Profile</a></li>
                    <li><a href="<?php echo base_url().'/user/drive'; ?>">My Drive</a></li>
                    <li><a href="<?php echo base_url().'/user/recentupload'; ?>">My Unpublished Songs</a></li>
                    <li><a href="<?php echo base_url().'/user/plans'; ?>">My Plans</a></li>
                    <li><a href="<?php echo base_url().'/user/paymenthistory'; ?>">Payment History</a></li>
                    <li><a href="<?php echo base_url().'/user/changepassword'; ?>">Change Password</a></li>
                    <li><a href="<?php echo base_url().'/home/logout'; ?>">Logout</a></li>
                </ul>
            </li>
            <?php endif; ?>
            <li>
				<a href="#">More <i class="fa fa-angle-down"></i></a>
                <ul class="sub_menu">
                    <li><a href="<?php echo base_url().'/about-us'; ?>">About Us</a></li>
                    <li><a href="#">Feedback</a></li>
                    <li><a href="<?php echo base_url().'/contact-us'; ?>">Contact Us</a></li>
                    <li><a href="<?php echo base_url().'/terms'; ?>">Terms</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
