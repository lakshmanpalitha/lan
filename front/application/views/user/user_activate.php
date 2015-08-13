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
            <div class="alert  alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
                <strong>
                    Warning!
                </strong>
                <?php echo (isset($this->error) ? $this->error : ''); ?>
            </div>
            
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
                        jQuery('#error_register').html("Account Created.");
                        document.getElementById("user_register_form").reset();
                    } else {
                        jQuery('#error_register').html(jsonData.error);
                    }
                }
            });
        }
    </script>
</html>