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
            <section id="page" class="container">
                <!--/.frame -->
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-12 clearfix">
                                <div class="hr-link">
                                    <hr class="mBtm-50 mTop-30" data-symbol="How to Bid - (ලන්සු තබන්නේ කෙසෙද?)">

                                    <div class="help-block">
                                        <h4>Go to : <a href="http://lansuwa.com/" target="_blank">http://lansuwa.com</a> </h4>
                                        <h4>පළමුව අපගෙ වෙබ් අඩවියට ලොග් වන්න.මෙහිදී ඔබට අපගේ ලන්සු තැබිය හැකි සියලු නිෂ්පදිත තිරයෙ දිස්වනවා අත. ඔබ විසින් ලන්සු තැබීමට කැමති භාණ්ඩය මත ක්ලික් කරන්න.එවිට එම භාණ්ඩයට අදාල වෙබ් පිටුව විවර වනවා ඇත.</h4>
                                        <img src="<?php echo URL . FRONTEND ?>public/images/help/lansuwa-how-to-bid-01.png" alt="add" class="img-responsive">
                                    </div>

                                    <div class="help-block">
                                        <h4>Click on “PLACE BID” Button</h4>
                                        <h4>දැන් ඔබගේ තිරයේ දකුනු පසින් දක්නට ඇති “PLACE BID  "   මත ක්ලික් කරන්න. එවිට ලොගින් මෙනුව විවර වෙනු ඇත.</h4>
                                        <img src="<?php echo URL . FRONTEND ?>public/images/help/lansuwa-how-to-bid-02.png" alt="add" class="img-responsive">
                                    </div>

                                    <div class="help-block">
                                        <h4>Enter your email and password > Click Login</h4>
                                        <h4>ලොගින් මෙනුව තුල ඔබගේ ඊ මේල් ලිපිනය හා රහස් කේතය නිවැරදිව සටහන් කොට ලොගින් අයිකනය මත ක්ලික් කරන්න.</h4>
                                        <img src="<?php echo URL . FRONTEND ?>public/images/help/lansuwa-how-to-bid-03.png" alt="add" class="img-responsive">
                                    </div>

                                    <div class="help-block">
                                        <h4>Enter your bid value and click “PLACE BID”</h4>
                                        <h4>එවිට ඔබට "Place Your Bid Online   " මෙනුව විවර වනු ඇත.එහිදී ඔබට ඔබගේ අවම බිඩ් අගය සදහන් කල හැහ.ඉන් පසුව " Bid Now" ස්විචය මත ක්ලික් කරන්න.</h4>
                                        <img src="<?php echo URL . FRONTEND ?>public/images/help/lansuwa-how-to-bid-04.png" alt="add" class="img-responsive">
                                    </div>

                                    <div class="help-block">
                                        <h4>You can see the Successful message</h4>
                                        <h4>එවිට ඔබ තැබු බිඩ් අගය අපගේ පද්ධතිය තුල "Save" වන අතර ක්රියාවලිය නිවැරදිව සිදු වු බව ඔබට දිස්වන "Popup Massage" මගින් තහවුරු කරගත හැක.</h4>
                                        <img src="<?php echo URL . FRONTEND ?>public/images/help/lansuwa-how-to-bid-05.png" alt="add" class="img-responsive">
                                    </div>



                                    <div class="help-block">
                                        <h4>You have to wait for next bid until end of the waiting time given by the system. </h4>
                                        <h4>එක් භාණ්ඩයක් මත "bid" තබා එම භාණ්ඩය මත ඔබට නැවත  වරක් "bid" තැබීමට නම් ඒ සදහා ලබා දෙන "waiting time" ඉවර වන තුරු සිටිය යුතුය.</h4>

                                    </div>

                                    <div class="help-block">
                                        <h4>To more help please watch the video.</h4>
                                        <h4>පහත වීඩියෝව නැරබීමෙන් ඔබට තවත් උපකාර වනු ඇත.</h4>
                                        <iframe width="100%" height="400" src="https://www.youtube.com/embed/C8ySnUw0ab8?rel=0" frameborder="0" allowfullscreen></iframe>
                                    </div>


                                    <div class="help-block">
                                        <h4><a href="<?php echo URL ?>front/index/how_to_register" target="_blank">How to Crate an Accout</a></h4>
                                        <h4><a href="<?php echo URL  ?>front/index/how_to_register" target="_blank">ලන්සුව තුල ලියාපදින්චි වන්නේ කෙසේද යන්න දැන ගැනීමට මෙතැන ක්ලික් කරන්න.</a></h4>
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
                                            <a href="<?php echo URL . FRONTEND ?>bid/detail/<?php echo base64_encode($pro->product_id) ?>/" target="_blank" title="#">
                                                <img src="<?php echo URL ?>public/uploads/product/large/<?php echo $pro->def_image ?>" alt="#" class="img-responsive">
                                            </a>
                                            <span class="bought">
                                                <i class="ti-tag"></i>169 bids
                                            </span>
                                        </div>
                                        <!-- /.image -->
                                        <div class="title">
                                            <a href="<?php echo URL . FRONTEND ?>bid/detail/<?php echo base64_encode($pro->product_id) ?>/" target="_blank" title="ATLETIKA 3 mēnešu abonements">
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