<div class="inner_con bg_grey">
    <div class="wraper fc_black">
        <h2 class="fw600 mart15 marb15 titel">Subscription Plan</h2>

        <section id="pricePlans">
            <ul id="plans" class="cd-pricing-wrapper">
                <?php
                if (!empty($plans)) {
                    foreach ($plans as $plan) {
                        ?>         
                        <li class="plan">
                            <ul class="planContainer">
                                <li class="title pre_p">
                                    <h2><?php echo $plan->plan_name; ?></h2>
                                    <div class="cd-price">
                                        <span class="cd-currency">$</span>
                                        <span class="cd-value"><?php echo $plan->plan_price; ?></span>
                                        <span class="cd-duration"><?php echo $plan->plan_duration; ?></span>
                                    </div>
                                    <span class="sub_t"></span>
                                </li>
                                                    <!--<li class="price"><p class="bestPlanPrice">$20/month</p></li>-->
                                <li>
                                    <ul class="options">
                                        <li class="separetor">
                                            <span>
                                                <strong>
                                                    <em>1</em> <?php echo $plan->plan_desc; ?>
                                                </strong>
                                            </span></li>
                                        <li class="separetor"><span><strong>Premium Badge</strong></span></li>
                                        <li class="separetor"><span><strong>No Adverts</strong></span></li>
                                        <li class="separetor"><span><strong>Advanced Profile Customisation</strong></span></li>
                                        <li class="separetor"><span>Basic Statistics</span></li>
                                        <li><span>&nbsp;</span></li>
                                        <li><span>&nbsp;</span></li>
                                        <li ><span>No Extras</span></li>
                                        <li><span>&nbsp;</span></li>
                                        <li class="separetor"><span>&nbsp;</span></li>

                                    </ul>
                                </li>
                                <li class="button">
                                    <a href="javascript:void(0)" data-plan="<?php echo $plan->id;  ?>" class="pre_p subscription_btn" >Select</a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                }
                ?>

               
            </ul> <!-- End ul#plans -->
        </section> 
    </div>
</div>

<script src="<?php echo base_url(); ?>/assets/js/home/home.js"></script>
