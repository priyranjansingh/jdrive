<?php
        if (!empty($notifications)) {
            foreach ($notifications as $notification) {
                ?>
                <?php if ($notification->is_read == 0) { ?>
                    <div class="row pad-5 unread">
                        <a class="unread_notifications" id="<?php echo $notification->id; ?>" data-url="<?php echo getNotificationUrl($notification->notification_type, $notification->related_to_id); ?>"   href="javascript:void(0)"><?php echo $notification->message; ?></a>
                    </div>
                <?php } else {
                    ?>
                    <div class="row pad-5 read">
                        <a class="read_notifications"  href="<?php echo getNotificationUrl($notification->notification_type, $notification->related_to_id); ?>"><?php echo $notification->message; ?></a>
                    </div>
                <?php
                }
            }
        } else {
            ?>   
            <div class="row no-notification">Sorry there is not any notifications for you</div>
            <?php
        }
        ?>
