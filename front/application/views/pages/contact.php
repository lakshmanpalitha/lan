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
            <div class="col-sm-8 mTop-30">
                <div class="inner-wrap frameLR bg-white shadow clearfix ">
                    <hr data-symbol="OUR LOCATION">
                    <div class="google-maps">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d180923.20573680187!2d18.431035300000026!3d44.88417339999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475c3ce74d1a2ad7%3A0xec92baaa82e344b0!2zR3JhZGHEjWFj!5e0!3m2!1sen!2sba!4v1430647606971"
                            width="600" height="450" frameborder="0" style="border:0">
                        </iframe>
                    </div>
                    <hr data-symbol="CONTACT FORM">
                    <!-- widget -->
                    <div class="widget contact-widget">
                        <h4 class="widget-title">
                            Your data will be safe!
                        </h4>

                        <form class="contact-form clearfix" action="#" method="post" novalidate="novalidate">
                            <p>
                                Your email address will not be published. Required fields are marked *
                            </p>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <p class="input-block">
                                        <label class="required">
                                            Name
                          <span>
                            (*)
                          </span>
                                        </label>
                                        <input type="text" class="form-control" placeholder="Name">
                                    </p>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <p class="input-block">
                                        <label class="required">
                                            Email
                          <span>
                            (*)
                          </span>
                                        </label>
                                        <input type="text" class="form-control" placeholder="Email">
                                    </p>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <p class="input-block">

                                        <label class="required">
                                            Website
                                        </label>
                                        <input type="text" class="form-control" placeholder="Web site">

                                    </p>
                                </div>
                            </div>
                            <!-- row -->

                            <p class="textarea-block">

                                <label class="required" for="contact_message">
                                    Your message
                      <span>
                        (*)
                      </span>
                                </label>
                                <textarea rows="6" cols="88" id="contact_message" name="message" class="form-control"></textarea>
                            </p>

                            <p class="contact-button clearfix">

                                <input type="submit" class="btn btn-raised ripple-effect btn-success"
                                       id="submit-contact" value="Send message">
                            </p>
                        </form>
                        <div id="response">
                        </div>
                    </div>
                    <!-- punica-contact-widget -->
                </div>
                <!-- /inner wrap -->
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
    $(document).ready(function () {
        bid_info();
    });
</script>
</html>