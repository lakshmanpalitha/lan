<div class="slider">
    <div class="container">
        <div class="row">
            <div id="grid-slider" class="flexslider">
                <ul class="slides">
                    <?php
                    if (!empty($this->bid_products)) {
                        foreach ($this->bid_products as $pro) {
                            ?>
                            <li>
                                <div class="col-sm-7 col-lg-8 omega">
                                    <article class="bg-image entry-lg" data-image-src="<?php echo URL ?>public/uploads/product/large/<?php echo $pro->def_image ?>">
                                        <div class="deal-short-entry bg-green">
                                            <p>
                                                <?php echo $pro->product_description ?>
                                            </p>
                                        </div>
                                    </article>
                                </div>
                                <div class="col-sm-5 col-lg-4 alpha entry-lg">
                                    <div class="buyPanel animated fadeIn bg-white Aligner shadow">
                                        <div class="content">
                                            <div class="deal-content">
                                                <h3>
                                                    <?php echo $pro->product_name ?>
                                                </h3>
                                                <p>
                                                     <?php echo $pro->product_description ?>
                                                </p>
                                            </div>
                                            <ul class="deal-price list-unstyled list-inline">
                                                <li class="price">
                                                    <h3>
                                                        <p>Real Price</p>Rs.<?php echo $pro->product_real_price ?>
                                                    </h3>
                                                </li>
                                                <li class="buy-now">
                                                    <a class="btn btn-success btn-raised ripple-effect">
                                                        BID NOW
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="dealAttributes">
                                                <div class="timeLeft text-center">
                                                    <p>
                                                        Hurry up Only a few time left
                                                    </p>
                                                    <span class="time">
                                                        <i class="ti-timer color-green">
                                                        </i>
                                                        <b>
                                                            8
                                                        </b>
                                                        d. 
                                                        <b>
                                                            20
                                                        </b>
                                                        st. 
                                                        <b>
                                                            58
                                                        </b>
                                                        min.
                                                        <b>
                                                            20
                                                        </b>
                                                        sec.
                                                    </span>
                                                </div>
                                                <ul class="statistic list-unstyled list-inline">
                                                    <li>
                                                        <p>
                                                            <i class="ti-user">
                                                            </i>
                                                            <b>
                                                                2500
                                                            </b>
                                                            Person
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <i class="ti-tag">
                                                        </i>
                                                        <b>
                                                            8245
                                                        </b>
                                                        Bids
                                                    </li>
                                                    <li>
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
                        <?php }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>