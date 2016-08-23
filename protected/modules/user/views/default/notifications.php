<div class="inner_con bg_grey">
    <div class="wraper">
        <h2 class="fw600 mart15 marb15 titel">Notifications</h2>
        <div class="col-sm-12">
            <?php
            if (!empty($notifications)) {
                foreach ($notifications as $notification) {
                    ?>
                    <div>
                        <?php if($notification->is_read==0){  ?>
                        <a class="unread_notifications" id="<?php echo $notification->id;  ?>" data-url="<?php echo getNotificationUrl($notification->notification_type, $notification->related_to_id); ?>"   href="javascript:void(0)"><?php echo $notification->message; ?></a>
                        <?php } else {
                         ?>   
                       <a class="read_notifications"  href="<?php echo getNotificationUrl($notification->notification_type, $notification->related_to_id); ?>"><?php echo $notification->message; ?></a>
                        <?php     
                        } ?>
                    </div>
                    <?php
                }
                if(count($notifications) > 10)
                {
                ?>
            <div>
                <a href="<?php echo base_url().'/user/notifications'  ?>">See All</a>
            </div>
                <?php     
                }    
            } else {
                ?>   
                <div>Sorry there is not any notifications for you</div>
                <?php
            }
            ?>
        </div>
    </div>
</div>