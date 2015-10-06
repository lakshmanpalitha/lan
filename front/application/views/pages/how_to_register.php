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
                                    <hr class="mBtm-50 mTop-30" data-symbol="How to create an account - (ගිණුමක් සැකසීම)">

                                    <div class="help-block">
                                        <h4>Go to : <a href="http://lansuwa.com/front/users/register/" target="_blank">http://lansuwa.com/front/users/register/</a> </h4>
                                        <h4>ඉහත ලින්ක් එක වෙත යන්න</h4>
                                        <img src="<?php echo URL . FRONTEND ?>public/images/help/lansuwa-registor-account-01.png" alt="add" class="img-responsive">
                                    </div>

                                    <div class="help-block">
                                        <h4>Fill out a form > Click on “REGESTER” Button</h4>
                                        <h4>ලබා දී ඇති පෝරමය පුරවා "REGESTER" මත ක්ලික් කරන්න.</h4>
                                        <img src="<?php echo URL . FRONTEND ?>public/images/help/lansuwa-registor-account-02.png" alt="add" class="img-responsive">
                                    </div>

                                    <div class="help-block">
                                        <h4>It will display message like below.</h4>
                                        <h4>ඔබට පහත ආකාරයේ පණිවුඩයක් දිස්වනු ඇත.</h4>
                                        <img src="<?php echo URL . FRONTEND ?>public/images/help/lansuwa-registor-account-03.png" alt="add" class="img-responsive">
                                    </div>

                                    <div class="help-block">
                                        <h4>Llog in your email Account > Open “Lansuwa Registration” Mail</h4>
                                        <h4>දැන් ඔබගේ ඊ-මේල් ගිණුම වෙත යන්න. පහත පරිදි ඊ-මේල් පණිවුඩයක් ලැබී තිබෙනු ඇත.</h4>
                                        <img src="<?php echo URL . FRONTEND ?>public/images/help/lansuwa-registor-account-04.png" alt="add" class="img-responsive">
                                    </div>

                                    <div class="help-block">
                                        <h4>Click “Click to activate your account” > You will redirect the Login page.</h4>
                                        <h4>ඊ-මේල් පණිවුඩය තුල ඇති "Click to activate your account" මත ක්ලික් කරන්න.</h4>
                                        <img src="<?php echo URL . FRONTEND ?>public/images/help/lansuwa-registor-account-05.png" alt="add" class="img-responsive">
                                    </div>

                                    <div class="help-block">
                                        <h4>Enter your Email and password and Click “ Login “ Button</h4>
                                        <h4>දැන් ඔබගේ ඊ-මේල් ලිපිනය හා මුර පදය යොදා "Login" මත ක්ලික් කරන්න.</h4>
                                        <img src="<?php echo URL . FRONTEND ?>public/images/help/lansuwa-registor-account-07.png" alt="add" class="img-responsive">
                                    </div>


                                    <div class="help-block">
                                        <h4>Your Registration Complete.</h4>
                                        <h4>එවිට ඔබට පහත පරිදි දිස්වනු ඇත. දැන් ඔබගේ ගිණුම සකසා අවසන්. ඔබට ලන්සු තබීම ආරම්භ කල හැක.</h4>
                                        <img src="<?php echo URL . FRONTEND ?>public/images/help/lansuwa-registor-account-08.png" alt="add" class="img-responsive">
                                    </div>


                                    <div class="help-block">
                                        <h4>To more help please watch the video.</h4>
                                        <h4>පහත වීඩියෝව නැරබීමෙන් ඔබට තවත් උපකාර වනු ඇත.</h4>
                                        <iframe width="100%" height="400" src="https://www.youtube.com/embed/UuuAxj1ro4I?rel=0" frameborder="0" allowfullscreen></iframe>
                                    </div>


                                    <div class="help-block">
                                        <h4><a href="<?php echo URL ?>front/index/how_to_bid" target="_blank">How to bid ?</a></h4>
                                        <h4><a href="<?php echo URL ?>front/index/how_to_bid" target="_blank">ලන්සු තබන්නේ කෙසේද යන්න දැන ගැනීමට මෙතැන ක්ලික් කරන්න.</a></h4>
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