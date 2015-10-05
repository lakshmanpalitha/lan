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
                                            First Name
                                        </label>
                                        <input type="text" name="First_name" class="validate[required,minSize[4]] form-control" id="First_name" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Password
                                        </label>
                                        <input type="password" name="Password" class="validate[required,minSize[5]] form-control" id="user_Password" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Repeat Password
                                        </label>
                                        <input type="password" name="Repeat_password" class="validate[required,equals[user_Password],minSize[5]] form-control" id="Repeat_password" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Email Address
                                        </label>
                                        <input type="" name="Email_address" class="validate[required,custom[email]] form-control" id="Email_address" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Repeat Email Address
                                        </label>
                                        <input type="" name="Repeat_email_address" class="validate[required,custom[email],equals[Email_address]] form-control" id="Repeat_email_address" value="">
                                    </div>
                                </div>
                            </form>
                            <div class="mBtm-20 visible-xs">
                            </div>

                            <div class="col-md-6">
                                <h3 class="dark-grey">
                                    Terms and Conditions
                                </h3>
                                <p>By using our website you agree to be legally bound by these terms, which shall take effect immediately on your first use of our website. If you do not agree to be legally bound by all the following terms please do not access and/or use our website.</p>

                                <button onclick="register()" class="btn btn-primary btn-lg btn-raised ripple-effect">
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
        if($("#user_register_form").validationEngine('validate')){
            try {
                loading('error_register');
                var nURL = "<?php echo URL . FRONTEND ?>users/jsonRegister/";
                var param = $('#user_register_form').serialize();
                ajaxRequest(nURL, param, function(jsonData) {
                    if (jsonData) {
                        endLoading('error_register');
                        if (jsonData.success == true) {
                            jQuery('#error_register').html(jsonData.data);
                            document.getElementById("user_register_form").reset();
                        } else {
                            jQuery('#error_register').html(jsonData.error);
                        }
                    }else{
                        endLoading('error_register');
                        document.getElementById("user_register_form").reset();
                    }
                });
            }
            catch (err) {
                endLoading('error_register');
                document.getElementById("user_register_form").reset();
                return false;
            }
        }

    }
    </script>
</html>