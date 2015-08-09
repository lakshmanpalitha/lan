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

                            <div class="col-md-6">
                                <h3 class="dark-grey">
                                    Login
                                </h3>
                                <form id="user_login_form">
                                    <div class="form-group">
                                        <label>
                                            Email Address
                                        </label>
                                        <input type="" name="email" class="form-control" id="email" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Password
                                        </label>
                                        <input type="password" name="pwd" class="form-control" id="pwd" value="">
                                    </div>                                   
                                </form>
                                <div class="form-group">
                                    <a  onclick="login()" class="btn btn-primary btn-raised ripple-effect">
                                        Login
                                    </a>
                                </div>
                                <P><a href="" >Forgot my passowrd<a></a></P>
                            </div>

                            <div class="mBtm-20 visible-xs">
                            </div>

                            <div class="col-md-6">
                                <h3 class="dark-grey">
                                    or Register
                                </h3>
                                <a  target="_blank" href="<?php echo URL . FRONTEND ?>users/register/" class="btn btn-primary btn-raised ripple-effect">
                                    Create Account
                                </a>
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
                                        function login() {
                                            var nURL = "<?php echo URL . FRONTEND ?>users/jsonLogin/";
                                            var param = $('#user_login_form').serialize();
                                            loading('bid_popup_body');
                                            ajaxRequest(nURL, param, function(jsonData) {
                                                if (jsonData) {
                                                    endLoading('bid_popup_body');
                                                    if (jsonData.success == true) {
                                                        window.location.href = "<?php echo URL . FRONTEND ?>users/profile/";
                                                    } else {
                                                        $('#bid_popup_body').html(jsonData.error)
                                                    }
                                                }
                                            });
                                        }
    </script>
</html>