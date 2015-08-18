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
            <!-- /.search form -->
            <section id="page" class="container mTop-30 mBtm-50">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body frameLR bg-white shadow space-sm">
                            <div id="error_login" class="col-sm-12">

                            </div>
                            <div class="col-md-6">
                                <h3 class="dark-grey">
                                    Login
                                </h3>
                                <form id="reset_pwd">
                                    <div class="form-group">
                                        <label>
                                            Email Address
                                        </label>
                                        <input type="" name="email" class="form-control" id="email" value="">
                                    </div>                                 
                                </form>
                                <div class="form-group">
                                    <a  onclick="resetPwd()" class="btn btn-primary btn-raised ripple-effect">
                                        Login
                                    </a>
                                </div>
                            </div>

                            <div class="mBtm-20 visible-xs">
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
                                        function resetPwd() {
                                            var nURL = "<?php echo URL . FRONTEND ?>users/jsonResetPwd/";
                                            var param = $('#reset_pwd').serialize();
                                            loading('error_login');
                                            ajaxRequest(nURL, param, function(jsonData) {
                                                if (jsonData) {
                                                    endLoading('error_login');
                                                    if (jsonData.success == true) {
                                                        jQuery('#error_login').html(jsonData.data);
                                                    } else {
                                                        jQuery('#error_login').html(jsonData.error);
                                                    }
                                                }
                                            });
                                        }
    </script>
</html>