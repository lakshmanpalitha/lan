<div class="slider">
    <div class="container">
        <div class="row">
            <div id="grid-slider" class="flexslider">
                <ul class="slides">
                    <?php
                    if (!empty($this->bid_products)) {
                        $i = 0;
                        foreach ($this->bid_products as $pro) {
                            if ($i == HOME_SLIDER_DISPLAY_MAX_PRODUCT)
                                break;
                            ?>
                            <li>
                                <div class="col-sm-7 col-lg-8 omega">
                                    <article class="bg-image entry-lg" data-image-src="<?php echo URL ?>public/uploads/product/large/<?php echo $pro->def_image ?>">
                                        <div class="deal-short-entry bg-green">
                                            <p>
                                                <?php echo $pro->product_short_description ?>
                                            </p>
                                        </div>
                                    </article>
                                </div>
                                <div class="col-sm-5 col-lg-4 alpha entry-lg">
                                    <div class="bid_pro_list buyPanel animated fadeIn bg-white Aligner shadow">
                                        <div class="content">
                                            <span id="<?php echo $pro->product_id ?>" class="bid_pro_id"></span>
                                            <div class="deal-content">
                                                <h3>
                                                    <?php echo $pro->product_name ?>
                                                </h3>
                                                <p>
                                                    <?php echo $pro->product_short_description ?>
                                                </p>
                                            </div>
                                            <ul class="deal-price list-unstyled list-inline">
<!--                                                <li class="price">-->
<!--                                                    <h3>-->
<!--                                                        <p>Real Price</p>Rs.--><?php ////echo $pro->product_real_price ?>
<!--                                                    </h3>-->
<!--                                                </li>-->
                                                <li class="buy-now">
                                                    <a href="<?php echo URL . FRONTEND ?>bid/detail/<?php echo base64_encode($pro->product_id) ?>/" id="sidebar_pro_button_<?php echo $pro->product_id ?>" class="btn btn-success btn-raised ripple-effect">
                                                        BID NOW
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="dealAttributes">
                                                <div class="timeLeft text-center">
                                                    <p>
                                                        Hurry up Only a few time left
                                                    </p>
                                                    <span id="sidebar_pro_timer_<?php echo $pro->product_id ?>" class="time"></span>
                                                </div>
                                                <ul class="statistic list-unstyled list-inline">
                                                    <li>
                                                        <p>
                                                            <i class="ti-user"></i>
                                                            <b><span id="sidebar_pro_user_count_<?php echo $pro->product_id ?>"></span></b> Person
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <i class="ti-tag"></i>
                                                        <b><span id="sidebar_pro_bid_count_<?php echo $pro->product_id ?>"></span></b> Bids
                                                    </li>
                                                </ul>
                                                <div class="social-sharing text-center" data-permalink="http://labs.carsonshold.com/social-sharing-buttons">
                                                    <!-- https://developers.facebook.com/docs/plugins/share-button/ -->
                                                    <a target="_blank" href="http://www.facebook.com/sharer.php?u=http://themeforest.net/user/codenpixel" class="share-facebook">
                                                        <span class="icon icon-facebook">
                                                        </span>
                                                        <span class="share-title">
                                                            Share
                                                        </span>
                                                        <span class="share-count is-loaded">
                                                            150
                                                        </span>
                                                    </a>
                                                    <!-- https://dev.twitter.com/docs/intents -->
                                                    <a target="_blank" href="http://twitter.com/share?url=http://themeforest.net/user/codenpixel" class="share-twitter">
                                                        <span class="icon icon-twitter">
                                                        </span>
                                                        <span class="share-title">
                                                            Tweet
                                                        </span>
                                                        <span class="share-count is-loaded">
                                                            62
                                                        </span>
                                                    </a>

                                                </div>
                                                <!--/.social sharing -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /#buypanel -->
                            </li>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>