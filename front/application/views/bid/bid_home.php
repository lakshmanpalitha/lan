<!DOCTYPE html>
<html lang="en">
    <!-- Mirrored from pamukovic.com/demo/kupon/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Jun 2015 05:34:34 GMT -->
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
            <?php include DOC_PATH . FRONTEND . "application/views/_templates/slider.php"; ?>
            <!-- /slider -->


            <section id="page" class="container">
                <div class="shadow bg-white mTop-30 frameLR">
                    <div class="row">
                        <div class="col-md-3 col-sm-4">
                            <div class="l-element">
                                <div class="box-icon">
                                    <div class="icon-wrap">
                                        <i class="ti-target">
                                        </i>
                                    </div>
                                    <div class="text">
                                        <h4>
                                            Find Your Deal
                                        </h4>
                                        <p>
                                            Find perfect offer
                                        </p>
                                    </div>
                                </div>
                                <!--/.icon box -->
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="l-element">
                                <div class="box-icon">
                                    <div class="icon-wrap">
                                        <i class="ti-shopping-cart">
                                        </i>
                                    </div>
                                    <div class="text">
                                        <h4>
                                            Buy Deal
                                        </h4>
                                        <p>
                                            Buy or save your deal
                                        </p>
                                    </div>
                                </div>
                                <!--/.icon box -->
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="l-element">
                                <div class="box-icon">
                                    <div class="icon-wrap">
                                        <i class="fa fa-smile-o">
                                        </i>
                                    </div>
                                    <div class="text">
                                        <h4>
                                            Up to 80% Discount
                                        </h4>
                                        <p>
                                            Save hundreds of dollars
                                        </p>
                                    </div>
                                </div>
                                <!--/.icon box -->
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="l-element">
                                <div class="box-icon">
                                    <div class="icon-wrap">
                                        <i class="ti-star">
                                        </i>
                                    </div>
                                    <div class="text">
                                        <h4>
                                            Five star Support
                                        </h4>
                                        <p>
                                            +1 234-567-890
                                        </p>
                                    </div>
                                </div>
                                <!--/.icon box -->
                            </div>
                        </div>
                    </div>
                    <!--/.row -->
                </div>
                <!--/.frame -->
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-12 clearfix">
                                <div class="hr-link">
                                    <hr class="mBtm-50 mTop-30" data-symbol="FEATURED BIDS">
                                    <div class="view-all">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (!empty($this->bid_products)) {
                            $bid_itm_count = 0;
                            foreach ($this->bid_products as $pro) {
                                if ($bid_itm_count == 0) {
                                    echo '<div class="row">';
                                } else if ($bid_itm_count % 2 == 0) {
                                    echo '</div><div class="row">';
                                }
                                ?>
                                <div class="col-sm-6">
                                    <div class="deal-entry green">
                                        <div class="image ripple-effect">
                                            <a href="<?php echo URL . FRONTEND ?>bid/detail/<?php echo base64_encode($pro->product_id) ?>/" title="#">
                                                <img src="<?php echo URL ?>public/uploads/product/large/<?php echo $pro->def_image ?>" alt="#" class="img-responsive">
                                            </a>
                                            <span class="bought">
                                                <i class="ti-tag"></i><?php echo $pro->bid_count ?> bids
                                            </span>
                                        </div>
                                        <!-- /.image -->
                                        <div class="title">
                                            <a href="<?php echo URL . FRONTEND ?>bid/detail/<?php echo base64_encode($pro->product_id) ?>/"  title="ATLETIKA 3 mēnešu abonements">
                                                <?php echo $pro->product_name ?>
                                            </a>
                                        </div>
                                        <div class="entry-content">
                                            <p>
                                                <?php echo $pro->product_short_description ?>
                                            </p>
                                        </div>
                                        <!--/.entry content -->
                                        <footer class="info_bar clearfix">
                                            <ul class="unstyled list-inline row">
                                                <li id="index_pro_timer_<?php echo $pro->product_id ?>" class="time col-sm-7 col-xs-6 col-lg-8"> 

                                                </li>

                                                <li class="info_link col-sm-5 col-xs-6 col-lg-4">
                                                    <a id="index_pro_button_<?php echo $pro->product_id ?>" href="<?php echo URL . FRONTEND ?>bid/detail/<?php echo base64_encode($pro->product_id) ?>/" class="btn btn-block btn-default btn-raised btn-sm">
                                                        Bid Now
                                                    </a>
                                                </li>
                                            </ul>
                                        </footer>
                                    </div>
                                </div>
                                <?php
                                $bid_itm_count++;
                            }
                            echo "</div>";
                        }
                        ?>
                        <!--/row -->
                    </div>
                    <!-- /col 8 -->
                    <?php include DOC_PATH . FRONTEND . "application/views/_templates/right_col.php"; ?>
                    <!-- /main row -->
                </div>
            </section>
            <!-- /#page ends -->
            <?php include DOC_PATH . FRONTEND . "application/views/_templates/welcome.php"; ?>
            <!-- /.CTA -->
            <?php include DOC_PATH . FRONTEND . "application/views/_templates/footer.php"; ?>      
        </div>
        <!-- /animitsion -->
        <!-- JS files -->
        <?php include DOC_PATH . FRONTEND . "application/views/_templates/js.php"; ?>


    </body>
    <script>
        $(document).ready(function() {
            bid_info();
        });
    </script>
</html>