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
                                                <li role="presentation">
                                                    <a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">
                                                        reviews
                                                    </a>
                                                </li>

                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="home">
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade active in" id="tab-1">
                                                            <h4>
                                                                Description
                                                            </h4>
                                                            <p class="lead">
                                                                <i>
                                                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper 
                                                                </i>
                                                            </p>
                                                            <p>
                                                                Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.
                                                            </p>
                                                            <div class="section-title-wr">
                                                                <h4 class="section-title left">
                                                                    Additional details
                                                                </h4>
                                                            </div>
                                                            <table class="table table-bordered table-striped table-hover table-responsive">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                Property Size:
                                                                            </strong>
                                                                            2300 Sq Ft
                                                                        </td>
                                                                        <td>
                                                                            <strong>
                                                                                Lot size:
                                                                            </strong>
                                                                            5000 Sq Ft
                                                                        </td>
                                                                        <td>
                                                                            <strong>
                                                                                Price:
                                                                            </strong>
                                                                            $23000
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                Rooms:
                                                                            </strong>
                                                                            5
                                                                        </td>
                                                                        <td>
                                                                            <strong>
                                                                                Bedrooms:
                                                                            </strong>
                                                                            4
                                                                        </td>
                                                                        <td>
                                                                            <strong>
                                                                                Bathrooms:
                                                                            </strong>
                                                                            2
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                Garages:
                                                                            </strong>
                                                                            2
                                                                        </td>
                                                                        <td>
                                                                            <strong>
                                                                                Roofing:
                                                                            </strong>
                                                                            New
                                                                        </td>
                                                                        <td>
                                                                            <strong>
                                                                                Structure Type:
                                                                            </strong>
                                                                            Bricks
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                Year built:
                                                                            </strong>
                                                                            1991
                                                                        </td>
                                                                        <td>
                                                                            <strong>
                                                                                Available from:
                                                                            </strong>
                                                                            1 August 2014
                                                                        </td>
                                                                        <td>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="section-title-wr">
                                                                <h4 class="section-title left">
                                                                    Location details
                                                                </h4>
                                                            </div>
                                                            <table class="table table-bordered table-striped table-hover table-responsive">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                <strong>
                                                                                    Property Size:
                                                                                </strong>
                                                                                2300 Sq Ft
                                                                            </strong>
                                                                        </td>
                                                                        <td>
                                                                            <strong>
                                                                                Lot size:
                                                                            </strong>
                                                                            5000 Sq Ft
                                                                        </td>
                                                                        <td>
                                                                            <strong>
                                                                                Price:
                                                                            </strong>
                                                                            $23000
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                Rooms:
                                                                            </strong>
                                                                            5
                                                                        </td>
                                                                        <td>
                                                                            <strong>
                                                                                Bedrooms:
                                                                            </strong>
                                                                            4
                                                                        </td>
                                                                        <td>
                                                                            <strong>
                                                                                Bathrooms:
                                                                            </strong>
                                                                            2
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                Garages:
                                                                            </strong>
                                                                            2
                                                                        </td>
                                                                        <td>
                                                                            <strong>
                                                                                Roofing:
                                                                            </strong>
                                                                            New
                                                                        </td>
                                                                        <td>
                                                                            <strong>
                                                                                Structure Type:
                                                                            </strong>
                                                                            Bricks
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                Year built:
                                                                            </strong>
                                                                            1991
                                                                        </td>
                                                                        <td>
                                                                            <strong>
                                                                                Available from:
                                                                            </strong>
                                                                            1 August 2014
                                                                        </td>
                                                                        <td>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- /tab content -->
                                                        <div role="tabpanel" class="tab-pane" id="reviews">
                                                            <section class="tab-content">
                                                                <!-- comment start -->
                                                                <div class="comment clearfix">
                                                                    <div class="comment-avatar">
                                                                        <img src="images/avatar-2.jpg" alt="avatar">
                                                                    </div>
                                                                    <header>
                                                                        <h3>
                                                                            Really Nice!
                                                                        </h3>
                                                                        <div class="comment-meta stars">
                                                                            <i class="ti-star">
                                                                            </i>
                                                                            <i class="ti-star">
                                                                            </i>
                                                                            <i class="ti-star">
                                                                            </i>
                                                                            <i class="ti-start">
                                                                            </i>
                                                                            <i class="ti-star">
                                                                            </i>
                                                                            | Today, 10:31
                                                                        </div>
                                                                        <!--/.stars -->
                                                                    </header>
                                                                    <div class="comment-content">
                                                                        <div class="comment-body clearfix">
                                                                            <p>
                                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                                            </p>
                                                                            <a href="#l" class="btn btn-sm btn-default  btn-raised ripple-effect pull-right">
                                                                                <i class="fa fa-reply">
                                                                                </i>
                                                                                Reply
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- comment end -->
                                                                <!-- comment start -->
                                                                <div class="comment clearfix">
                                                                    <div class="comment-avatar">
                                                                        <img src="images/avatar-1.jpg" alt="avatar">
                                                                    </div>
                                                                    <header>
                                                                        <h3>
                                                                            Worth to Buy!
                                                                        </h3>
                                                                        <div class="comment-meta stars">
                                                                            <i class="ti-star">
                                                                            </i>
                                                                            <i class="ti-star">
                                                                            </i>
                                                                            <i class="ti-star">
                                                                            </i>
                                                                            <i class="ti-start">
                                                                            </i>
                                                                            <i class="ti-star">
                                                                            </i>
                                                                            | Today, 10:31
                                                                        </div>
                                                                        <!--/.stars -->
                                                                    </header>
                                                                    <div class="comment-content">
                                                                        <div class="comment-body clearfix">
                                                                            <p>
                                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                                            </p>
                                                                            <a href="#l" class="btn btn-sm btn-default  btn-raised ripple-effect pull-right">
                                                                                <i class="fa fa-reply">
                                                                                </i>
                                                                                Reply
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- comment end -->
                                                                <h4 class="margin-bottom-20">
                                                                    Post a Comment
                                                                </h4>
                                                                <form action="#" method="post" id="comment-form" class="comments" novalidate="novalidate">
                                                                    <fieldset>
                                                                        <div class="row space-xs">
                                                                            <div class="col-md-6">
                                                                                <div>
                                                                                    <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div>
                                                                                    <input type="text" name="email" id="email" placeholder="Email" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="space-xs">
                                                                            <div>
                                                                                <textarea rows="8" name="message" id="message" placeholder="Write comment here ..." class="form-control">
                                                                                </textarea>
                                                                            </div>
                                                                        </div>
                                                                        <p>
                                                                            <button type="submit" class="btn btn-green btn-raised ripple-effect">
                                                                                Submit Comment
                                                                            </button>
                                                                        </p>
                                                                    </fieldset>
                                                                    <p class="form-allowed-tags">
                                                                        You may use these
                                                                        <abbr>
                                                                            HTML
                                                                        </abbr>
                                                                        tags and attributes:
                                                                        <br>
                                                                        <br>

                                                                        <code>
                                                                            &lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt; &lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;strike&gt; &lt;strong&gt; 
                                                                        </code>
                                                                    </p>
                                                                </form>
                                                            </section>
                                                        </div>

                                                        <!-- /tab -->
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
                                                <a id="index_pro_button_<?php echo $this->bid_product[0]->product_id ?>" class="btn btn-success btn-lg btn-raised ripple-effect btn-block" data-toggle="modal" data-target="#myModal">
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
                            <div class="terms-and-conditions bg-white shadow mTop-20">
                                <div class="widget-inner">
                                    <hr data-symbol="ADDITIONAL INFO">
                                    <div class="content">
                                        <ul class="tick">
                                            <li>
                                                Stay
                                                <strong>
                                                    for four 
                                                </strong>
                                                in a studio or one-bedroom villa
                                            </li>
                                            <li>
                                                The offer includes:
                                                <strong>
                                                    3 night at hotel ***
                                                </strong>
                                            </li>
                                            <li>
                                                Buy deal as a gift to other person easy
                                            </li>
                                            <li>
                                                <strong>
                                                    Breakfast included
                                                </strong>
                                            </li>
                                            <li>
                                                Additional fees:
                                                <strong>
                                                    $15 resort fee per night 
                                                </strong>
                                                paid at check-in. $100 refundable security deposit required on major credit card at check-in.
                                            </li>
                                            <li>
                                                <strong>
                                                    Private balconies
                                                </strong>
                                                are available in the tastefully decorated studios and one-bedroom villas.
                                            </li>
                                            <li>
                                                <strong>
                                                    Stay cool
                                                </strong>
                                                as you swim beneath a cascading waterfall in the outdoor pool, where you can watch dive-in movies on Wednesday, Thursday, and Saturday nights.
                                            </li>
                                            <li>
                                                Deal valid:
                                                <b>
                                                    15.10.2015.
                                                </b>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /widget inner -->
                            </div>
                            <div class="widget">
                                <div class="deal-entry green deal-entry-sm mTop-20">
                                    <div class="offer-discount">
                                        -71%
                                    </div>
                                    <div class="image ripple-effect">
                                        <a href="#" target="_blank" title="#">
                                            <img src="images/affiliate-12.jpg" alt="#" class="img-responsive">
                                        </a>
                                        <span class="bought">
                                            <i class="ti-tag">
                                            </i>
                                            21
                                        </span>
                                        <div class="caption">
                                            <h5 class="media-heading">
                                                <a href="#">
                                                    Plaza Resort Hotel &amp; SPA
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                    <footer class="info_bar clearfix">
                                        <div class="prices clearfix">
                                            <div class="procent">
                                                -71%
                                            </div>
                                            <div class="price">
                                                <i class="ti-money">
                                                </i>

                                                <b>
                                                    54,00
                                                </b>
                                            </div>
                                            <div class="old-price">
                                                <span>
                                                    <i class="ti-money">
                                                    </i>
                                                    171,00
                                                </span>
                                            </div>
                                        </div>
                                    </footer>
                                </div>
                                <!-- /deal entry -->
                                <div class="deal-entry green deal-entry-sm">
                                    <div class="offer-discount">
                                        -71%
                                    </div>
                                    <div class="image ripple-effect">
                                        <a href="#" target="_blank" title="#">
                                            <img src="images/affiliate-13.jpg" alt="#" class="img-responsive">
                                        </a>
                                        <span class="bought">
                                            <i class="ti-tag">
                                            </i>
                                            21
                                        </span>
                                        <div class="caption">
                                            <h5 class="media-heading">
                                                <a href="#">
                                                    Plaza Resort Hotel &amp; SPA
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                    <footer class="info_bar clearfix">
                                        <div class="prices clearfix">
                                            <div class="procent">
                                                -71%
                                            </div>
                                            <div class="price">
                                                <i class="ti-money">
                                                </i>

                                                <b>
                                                    54,00
                                                </b>
                                            </div>
                                            <div class="old-price">
                                                <span>
                                                    <i class="ti-money">
                                                    </i>
                                                    171,00
                                                </span>
                                            </div>
                                        </div>
                                    </footer>
                                </div>
                                <!-- /deal entry -->
                            </div>
                            <!-- /.widget -->
                        </div>
                        <!-- /col 4 - sidebar -->

                    </div>
                    <!-- /main row -->
                </section>
            <?php } ?>
            <!-- /#page ends -->
            <div class="cta-box bg-blue-1 clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12 pull-right">
                            <a href="#" class="btn btn-raised btn-primary ripple-effect btn-lg" data-original-title="" title="">
                                <i class="ti-shopping-cart">
                                </i>
                                &nbsp; Purchase Now
                            </a>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <h3>
                                Welcome to Kupon. Responsive Deal Template
                            </h3>
                            <p>
                                Carefully designed to bring you the best performance, usage and customization experience!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
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
            bid_info_each('<?php echo $this->bid_product[0]->product_id ?>');
        });
    </script>

    <!-- Mirrored from pamukovic.com/demo/kupon/details.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Jun 2015 05:35:04 GMT -->
</html>