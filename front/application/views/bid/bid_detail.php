<!DOCTYPE html>
<html lang="en">


    <!-- Mirrored from pamukovic.com/demo/kupon/details.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Jun 2015 05:35:04 GMT -->
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <?php include DOC_PATH . FRONTEND . "application/views/_templates/head.php"; ?>
    </head>

    <body>
        <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
            <header>
                <?php include DOC_PATH . FRONTEND . "application/views/_templates/topbar.php"; ?>
                <?php include DOC_PATH . FRONTEND . "application/views/_templates/nav.php"; ?>
                <!-- /#nav wrap -->
            </header>
            <?php include DOC_PATH . FRONTEND . "application/views/_templates/search.php"; ?>
            <!-- /.search form -->

            <?php
            if (!empty($this->bid_product)) {
                ?>
                <section id="inner-page" class="container">
                    <div class="row">
                        <div class="col-lg-8 col-sm-7">
                            <?php
                            if (!empty($this->bid_product[0]->images)) {
                                $img_arr = explode(",", $this->bid_product[0]->images);
                                ?>
                                <div class="post-media">
                                    <div id="slider" class="flexslider">                                   
                                        <ul class="slides">
                                            <?php
                                            foreach ($img_arr as $img) {
                                                ?>
                                                <li>
                                                    <img class="img-responsive" alt="" src="<?php echo URL ?>public/uploads/product/large/<?php echo trim($img) ?>">
                                                </li>
                                            <?php } ?>
                                        </ul>                                   
                                    </div>
                                    <!--/slider -->
                                    <div id="carousel" class="flexslider">
                                        <ul class="slides">
                                            <?php
                                            foreach ($img_arr as $img) {
                                                ?>
                                                <li>
                                                    <img src="<?php echo URL ?>public/uploads/product/thumb/thumb_<?php echo trim($img) ?>" alt="" />
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <!--/.carousel sinc -->
                                </div>
                            <?php } ?>
                            <!--/.post media -->
                            <div class="row mTop-20">

                                <!-- /col 5 -->
                                <div class="col-sm-5 col-lg-12">

                                    <div class="widget-inner bg-white shadow mBtm-20">
                                        <div role="tabpanel" id="tabs" class="tabbable responsive">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active">
                                                    <a href="#tab-1" aria-controls="home" role="tab" data-toggle="tab">
                                                        Overview
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="home">
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade active in" id="tab-1">
                                                            <?php echo $this->bid_product[0]->product_description ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/tabs -->
                                            </div>
                                            <!-- /inner widget -->
                                        </div>
                                    </div>


                                </div>
                                <!-- col 7 -->
                            </div>
                        </div>
                        <!-- /col 8 -->
                        <div class="col-sm-4">
                            <div class="widget-inner bg-white shadow">
                                <div class="buyPanel animated fadeInLeft bg-white Aligner">
                                    <div class="content">
                                        <div class="deal-content">
                                            <h3>
                                                <?php echo $this->bid_product[0]->product_name ?>
                                            </h3>
                                            <p>
                                                <?php echo $this->bid_product[0]->product_short_description ?>
                                            </p>
                                        </div>
                                        <ul class="deal-price list-unstyled list-inline">
                                            <li class="price">
                                                <h3>
                                                    <?php echo $this->bid_product[0]->product_real_price ?>
                                                </h3>
                                            </li>
                                            <li class="buy-now">
                                                <a style="display:none;" onclick="showAjaxModal('<?php echo base64_encode($this->bid_product[0]->product_id) ?>')" id="index_pro_button_<?php echo $this->bid_product[0]->product_id ?>" class="btn btn-success btn-lg btn-raised ripple-effect btn-block">
                                                    PLACE BID
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="dealAttributes">

                                            <!-- /.value info -->
                                            <div class="timeLeft text-center">
                                                <p>
                                                    Hurry up Only a few Bid left
                                                </p>
                                                <span id="index_pro_timer_<?php echo $this->bid_product[0]->product_id ?>" class="time">
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
                            <!--/inner widget -->
                        </div>

                        <!-- /col 4 - sidebar -->
                        <?php include DOC_PATH . FRONTEND . "application/views/_templates/right_col.php"; ?>
                    </div>
                    <!-- /main row -->
                </section>
            <?php } ?>
            <!-- /#page ends -->
            <?php include DOC_PATH . FRONTEND . "application/views/_templates/welcome.php"; ?>
            <!-- /.CTA -->
            <?php include DOC_PATH . FRONTEND . "application/views/_templates/bidpop.php"; ?>
            <?php include DOC_PATH . FRONTEND . "application/views/_templates/footer.php"; ?>
        </div>
        <!-- /animitsion -->
        <!-- JS files -->
        <?php include DOC_PATH . FRONTEND . "application/views/_templates/js.php"; ?>

    </body>
    <script>
                                                $(document).ready(function() {
                                                    bid_info_each('<?php echo base64_encode($this->bid_product[0]->product_id) ?>');
                                                });

                                                var interval;
                                                function showAjaxModal(val)
                                                {
                                                    loading('bid_popup_body');
                                                    $('#bid_model').modal('show', {backdrop: 'static'});
                                                    $("#pro-id").val(val);
                                                    bidCheck(val);

                                                }
                                                function bidCheck(val)
                                                {
                                                    var nURL = "<?php echo URL . FRONTEND ?>users/jsonCheckAccess/" + val + "/";
                                                    var param = '';
                                                    ajaxRequest(nURL, param, function(jsonData) {
                                                        if (jsonData) {
                                                            endLoading('bid_popup_body');
                                                            if (jsonData.success == true) {
                                                                $('#bid_popup_body').html(jsonData.data)
                                                            } else {
                                                                $('#bid_popup_body').html(jsonData.error)
                                                            }
                                                        }
                                                    });
                                                }
                                                function login() {
                                                    var pro_id = $("#pro-id").val();
                                                    var nURL = "<?php echo URL . FRONTEND ?>users/jsonLogin/";
                                                    var param = $('#user_login_form').serialize();
                                                    loading('bid_popup_body');
                                                    ajaxRequest(nURL, param, function(jsonData) {
                                                        if (jsonData) {
                                                            endLoading('bid_popup_body');
                                                            if (jsonData.success == true) {
                                                                bidCheck(pro_id);
                                                            } else {
                                                                $('#bid_popup_body').html(jsonData.error)
                                                            }
                                                        }
                                                    });
                                                }
                                                $(document).on("keypress", '#bid_price', function(event) {
                                                    if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
                                                            ((event.which < 48 || event.which > 57) &&
                                                                    (event.which != 0 && event.which != 8))) {
                                                        event.preventDefault();
                                                    }

                                                    var text = $(this).val();
                                                    if (text.length > 7 && event.which != 0 && event.which != 8) {
                                                        event.preventDefault();
                                                    } else
                                                    if ((text.indexOf('.') != -1) &&
                                                            (text.substring(text.indexOf('.')).length > 1) &&
                                                            (event.which != 0 && event.which != 8)) {
                                                        var num = text.split(".");
                                                        $(this).val(num[0] + "." + (num[1] * 10));
                                                        event.preventDefault();

                                                    }
                                                });

                                                function bidnow() {
                                                    var nURL = "<?php echo URL . FRONTEND ?>users/userBid/";
                                                    var param = $('#user_bid_form').serialize();
                                                    loading('bid_popup_body');
                                                    ajaxRequest(nURL, param, function(jsonData) {
                                                        if (jsonData) {
                                                            endLoading('bid_popup_body');
                                                            if (jsonData.success == true) {
                                                                $('#bid_popup_body').html(jsonData.data)
                                                            } else {
                                                                $('#bid_popup_body').html(jsonData.error)
                                                            }
                                                        }
                                                    });
                                                }

    </script>

    <!-- Mirrored from pamukovic.com/demo/kupon/details.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Jun 2015 05:35:04 GMT -->
</html>