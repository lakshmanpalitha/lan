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

            <section id="page" class="container mTop-30 mBtm-50">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body frameLR bg-white shadow space-sm">
                            <div id="error_register" class="col-sm-12">

                            </div>
                            <form id="user_register_form">
                                <div class="col-md-6">
                                    <h3 class="dark-grey">
                                        Registration
                                    </h3>
                                    <div class="form-group">
                                        <label>
                                            Name
                                        </label>
                                        <input type="" name="name" class="form-control" id="name" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Password
                                        </label>
                                        <input type="password" name="pwd" class="form-control" id="pwd" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Repeat Password
                                        </label>
                                        <input type="password" name="re_pwd" class="form-control" id="re_pwd" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Email Address
                                        </label>
                                        <input type="" name="email" class="form-control" id="email" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Repeat Email Address
                                        </label>
                                        <input type="" name="re_email" class="form-control" id="re_email" value="">
                                    </div>
                                </div>
                            </form>
                            <div class="mBtm-20 visible-xs">
                            </div>

                            <div class="col-md-6">
                                <h3 class="dark-grey">
                                    Terms and Conditions
                                </h3>
                                <p>
                                    By clicking on "Register" you agree to The Company's' Terms and Conditions
                                </p>
                                <p>
                                    While rare, prices are subject to change based on exchange rate fluctuations - should such a fluctuation happen, we may request an additional payment. You have the option to request a full refund or to pay the new price. (Paragraph 13.5.8)
                                </p>
                                <p>
                                    Should there be an error in the description or pricing of a product, we will provide you with a full refund (Paragraph 13.5.6)
                                </p>
                                <p>
                                    Acceptance of an order by us is dependent on our suppliers ability to provide the product. (Paragraph 13.5.6)
                                </p>

                                <button onclick="register()" class="btn btn-primary btn-raised ripple-effect">
                                    Register
                                </button>
                            </div>
                        </div>
                        <!-- /inner wrap -->
                    </div>
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
                                    function register()
                                    {
                                        //loading('loading');
                                        var nURL = "<?php echo URL . FRONTEND ?>users/jsonRegister/";
                                        var param = $('#user_register_form').serialize();
                                        ajaxRequest(nURL, param, function(jsonData) {
                                            if (jsonData) {
                                                //endLoading('loading');
                                                if (jsonData.success == true) {

                                                } else {
                                                    jQuery('#error_register').html(jsonData.error)
                                                }
                                            }
                                        });
                                    }
    </script>
</html>